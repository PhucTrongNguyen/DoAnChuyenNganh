# -*- coding: utf-8 -*-
import cv2
import numpy as np
import dlib
import sys
import boto3
import os
from PIL import Image, ImageTk
import tkinter as tk
import logging
import io

class WebcamApp:
    def __init__(self, window):
        self.window = window
        self.window.title("Webcam App")

        # Video capture and flags
        self.video_capture = cv2.VideoCapture(0)
        self.stop_flag = False

        # Cấu hình ghi log
        logging.basicConfig(filename='app.log', level=logging.INFO,
                    format='%(asctime)s %(levelname)s:%(message)s')

        # Load dlib's face detector and facial landmark predictor
        try:
            self.detector = dlib.get_frontal_face_detector()
            self.predictor = dlib.shape_predictor("D:\\Hufi\\HK07\\DoAnChuyenNganh\\Ecommerce-Glasses\\websitebankinhthoitrang\\public\\shape_predictor_5_face_landmarks.dat")
            logging.info("Tải thành công predictor!")
        except Exception as e:
            logging.error(f"Lỗi khi tải dlib predictor: {e}")
            raise

        # Nhận đường dẫn ảnh từ tham số dòng lệnh
        image_path = sys.argv[1]

        # Load glasses with transparency (RGBA image)
        self.glass_image = cv2.imread(image_path, cv2.IMREAD_UNCHANGED)

        # Check if glasses image has alpha channel
        if self.glass_image.shape[2] == 4:
            self.glass_alpha = self.glass_image[:, :, 3]  # Extract alpha channel
            self.glass_image = self.glass_image[:, :, :3]  # Extract RGB
        else:
            self.gray_glasses = cv2.cvtColor(self.glass_image, cv2.COLOR_BGR2GRAY)
            _, self.glass_alpha = cv2.threshold(self.gray_glasses, 240, 255, cv2.THRESH_BINARY_INV)
            print("Glasses image does not have an alpha channel for transparency.")
        # Create canvas to display the webcam feed
        self.canvas = tk.Canvas(window, width=640, height=480)
        self.canvas.pack()

        # Add a stop button
        self.stop_button = tk.Button(window, text="Stop Camera", command=self.close_program)
        self.stop_button.pack()

        # Start the webcam feed update
        self.update_camera()

    def update_camera(self):
        if not self.stop_flag:
            ret, frame = self.video_capture.read()
            if ret:
                final_image = self.detect_face_and_overlay_glasses(frame)

                # Convert the frame to an image and display it on the canvas
                self.current_image = Image.fromarray(cv2.cvtColor(final_image, cv2.COLOR_BGR2RGB))
                self.photo = ImageTk.PhotoImage(image=self.current_image)
                self.canvas.create_image(0, 0, image=self.photo, anchor=tk.NW)
            
            # Update the webcam feed every 15 milliseconds
            self.window.after(15, self.update_camera)
    
    def detect_face_and_overlay_glasses(self, image):
        gray_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
        faces = self.detector(gray_image)

        if len(faces) > 0:
            for face in faces:
                # 2. Get landmarks
                landmarks = self.predictor(gray_image, face)

                # Extract eye coordinates
                left_eye_x = landmarks.part(36).x
                left_eye_y = landmarks.part(36).y
                right_eye_x = landmarks.part(45).x
                right_eye_y = landmarks.part(45).y

                # Calculate centers of eyes
                eye_centers = [(left_eye_x, left_eye_y), (right_eye_x, right_eye_y)]

                # 3. Calculate coordinates and size of glasses
                glass_width_resize = 1.5 * abs(eye_centers[1][0] - eye_centers[0][0])
                scale_factor = glass_width_resize / self.glass_image.shape[1]

                # Resize the glasses image and the alpha channel
                resize_glasses = cv2.resize(self.glass_image, None, fx=scale_factor, fy=scale_factor)
                resize_glass_alpha = cv2.resize(self.glass_alpha, None, fx=scale_factor, fy=scale_factor)

                # Calculate position of the glasses
                glass_x = int((eye_centers[0][0] + eye_centers[1][0]) / 2 - resize_glasses.shape[1] / 2)
                glass_y = int((eye_centers[0][1] + eye_centers[1][1]) / 2 - resize_glasses.shape[0] / 2)

                # Ensure glasses stay within the image bounds
                if glass_x >= 0 and glass_y >= 0 and glass_x + resize_glasses.shape[1] <= image.shape[1] and glass_y + resize_glasses.shape[0] <= image.shape[0]:
                    # 4. Draw glasses on the face
                    overlay_image = np.ones(image.shape, np.uint8) * 255
                    overlay_image[int(glass_y):int(glass_y + resize_glasses.shape[0]),
                                  int(glass_x):int(glass_x + resize_glasses.shape[1])] = resize_glasses

                    gray_overlay = cv2.cvtColor(overlay_image, cv2.COLOR_BGR2GRAY)
                    _, mask = cv2.threshold(gray_overlay, 127, 255, cv2.THRESH_BINARY)

                    # Extract background and face (except glasses) from original image
                    background = cv2.bitwise_and(image, image, mask=mask)

                    mask_inv = cv2.bitwise_not(mask)

                    # Extract glasses from overlay
                    glasses = cv2.bitwise_and(overlay_image, overlay_image, mask=mask_inv)
                    
                    # Kết hợp nền và kính
                    final_image = cv2.add(background, glasses)
                    return final_image
                    
        return image
    
    def close_program(self):
        self.stop_flag = True
        self.video_capture.release()
        self.window.quit()

# Run the Tkinter app
root = tk.Tk()
app = WebcamApp(root)
root.mainloop()
