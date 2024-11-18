<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/93c0950cc1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Import SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/facemesh"></script>

</head>

<body>
    <!-- Cửa sổ ẩn chứa webcam và canvas -->
    <div id="virtual-try-on-window" class="hidden" style="">
        <div class="try-on-window" style="text-align: center;">
            <video id="webcam" playsinline width="640" height="480"></video>
            <canvas id="overlay" width="640" height="480"></canvas>
            <div class="loader-div">
                <img class="loader-img" src="{{asset('img/loading.gif')}}" alt="" style="height: 10px;width: auto;">
            </div>

        </div>
        <div class="button-container">
            <button id="stop-btn" class="try-on-btn">Tắt Webcam</button>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="loginOverlay" style="display: none;">
        @include('auth.login')
    </div>
    <div id="registerOverlay" style="display: none;">
        @include('auth.register')
    </div>

    @include('user.layout.header')

    @yield('content')

    @include('user.layout.footer')
    <script src="{{url('js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
            // Lắng nghe sự kiện click trên các liên kết phân trang
            $(document).on('click', '.pagination a', function (event) {
                // Không thực hiện mặc định của liên kết
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                // Chuyển hướng đến trang mới với thông số 'page'
                window.location.href = '?page=' + page;
            });
        });

        $(document).ready(function () {
            const tryOnWindow = document.getElementById('virtual-try-on-window');
            let videoStream = null;
            let glassesImage = new Image(); // Ảnh kính sẽ được đặt ở đây sau khi tìm được
            const videoElement = document.getElementById('webcam');
            const canvasElement = document.getElementById('overlay');
            const canvasCtx = canvasElement.getContext('2d');
            let isWebcamActive = false; // Biến cờ để theo dõi trạng thái webcam

            // Lắng nghe sự kiện click trên nút thử ảo
            $(".try-on-btn").on("click", async function () {
                $(".loader-div").css('display', 'block'); // Hiển thị loader khi bắt đầu
                // Ẩn toàn bộ các phần tử khác
                tryOnWindow.classList.remove('hidden');  // Bỏ lớp `hidden`
                $(".loader-img").show();  // Hiển thị loader khi bắt đầu

                // Thiết lập autoplay cho video khi khởi tạo webcam
                videoElement.setAttribute('autoplay', 'true');

                // Kích hoạt webcam và canvas
                //startWebcam();

                // Đảm bảo không có vấn đề gì xảy ra khi người dùng bắt đầu thử ảo
                let glassesImageElement = $(this).siblings(".glasses-image")[0];  // Tìm <img> gần nhất trong cùng container
                if (!glassesImageElement) {
                    return; // Thoát nếu không tìm thấy ảnh
                }
                let glassesImageSrc = glassesImageElement.src;

                let glassesImage = new Image();
                glassesImage.src = glassesImageSrc;

                glassesImage.onload = () => {
                    // Hàm xử lý xóa nền trắng của ảnh kính (sau khi tải ảnh)
                    removeWhiteBackground(glassesImage);
                };
                await setupWebcam(); // Khởi động webcam
                const model = await facemesh.load(); // Tải mô hình facemesh
                isWebcamActive = true; // Đánh dấu webcam đã bật
                detectFace(model); // Phát hiện khuôn mặt và dán kính
            });

            // Stop the webcam when the stop button is clicked
            $("#stop-btn").on("click", function () {
                stopWebcam();  // Call the stop webcam function
                tryOnWindow.classList.add('hidden');  // Thêm lớp `hidden`
            });

            // Function to stop the webcam
            function stopWebcam() {
                
                if (videoStream) {
                    let tracks = videoStream.getTracks();
                    tracks.forEach(track => track.stop());  // Stop all tracks of the webcam stream
                    videoStream = null;
                }
                isWebcamActive = false; // Đánh dấu webcam đã tắt
            }

            // Hàm xóa nền trắng của ảnh kính
            function removeWhiteBackground(image) {
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');
                tempCanvas.width = image.width;
                tempCanvas.height = image.height;

                tempCtx.drawImage(image, 0, 0);
                const imageData = tempCtx.getImageData(0, 0, tempCanvas.width, tempCanvas.height);
                const data = imageData.data;

                for (let i = 0; i < data.length; i += 4) {
                    const r = data[i];     // Red
                    const g = data[i + 1]; // Green
                    const b = data[i + 2]; // Blue
                    const a = data[i + 3]; // Alpha

                    // Nếu pixel là màu trắng hoặc gần trắng thì xóa nó (chuyển alpha thành 0)
                    if (r > 200 && g > 200 && b > 200) {
                        data[i + 3] = 0; // Làm cho pixel này trong suốt
                    }
                }

                tempCtx.putImageData(imageData, 0, 0);
                image.src = tempCanvas.toDataURL(); // Cập nhật ảnh đã xóa nền
            }

            // Hàm xóa nền trắng của ảnh kính
            function removeWhiteBackground(image) {
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');
                tempCanvas.width = image.width;
                tempCanvas.height = image.height;

                // Vẽ ảnh kính lên tempCanvas để xử lý nền
                tempCtx.drawImage(image, 0, 0);

                const imageData = tempCtx.getImageData(0, 0, tempCanvas.width, tempCanvas.height);
                const data = imageData.data;

                // Duyệt qua từng pixel và xóa những pixel màu trắng hoặc gần trắng
                for (let i = 0; i < data.length; i += 4) {
                    const r = data[i];     // Red
                    const g = data[i + 1]; // Green
                    const b = data[i + 2]; // Blue
                    const a = data[i + 3]; // Alpha

                    // Nếu pixel là màu trắng hoặc gần trắng thì xóa nó (chuyển alpha thành 0)
                    if (r > 200 && g > 200 && b > 200) {
                        data[i + 3] = 0; // Làm cho pixel này trong suốt
                    }
                }

                // Đưa dữ liệu đã chỉnh sửa trở lại tempCanvas
                tempCtx.putImageData(imageData, 0, 0);

                // Cập nhật ảnh kính đã xóa nền
                glassesImage.src = tempCanvas.toDataURL();
            }

            // Thiết lập webcam
            async function setupWebcam() {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                videoStream = stream;  // Store the video stream for later use
                videoElement.srcObject = stream;

                return new Promise((resolve) => {
                    videoElement.onloadeddata = () => {
                        resolve(videoElement);
                    };
                });
            }

            // Phát hiện khuôn mặt và dán kính
            async function detectFace(model) {
                async function predict() {
                    if (!isWebcamActive) return; // Kiểm tra xem webcam có đang hoạt động không, nếu không thì dừng

                    // Sử dụng videoElement trực tiếp
                    const predictions = await model.estimateFaces(videoElement);

                    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

                    if (predictions.length > 0) {
                        $(".loader-div").css('display', 'none'); // Hiển thị loader khi bắt đầu
                        predictions.forEach((prediction) => {
                            const keypoints = prediction.scaledMesh;

                            // Lấy tọa độ mắt trái và mắt phải
                            const leftEye = keypoints[33];
                            const rightEye = keypoints[263];

                            // Tính toán vị trí và kích thước của kính
                            const glassesWidth = Math.abs(rightEye[0] - leftEye[0]) * 2.0;
                            const glassesHeight = glassesWidth / 2;
                            let glassesX = leftEye[0] - glassesWidth * 0.5;
                            let glassesY = leftEye[1] - glassesHeight * 0.75;

                            // Tùy chỉnh vị trí kính (điều chỉnh các giá trị ở đây)
                            const offsetX = 65;  // Di chuyển kính sang phải (số dương) hoặc trái (số âm)
                            const offsetY = 30; // Di chuyển kính lên (số âm) hoặc xuống (số dương)

                            glassesX += offsetX;  // Tùy chỉnh vị trí sang trái/phải
                            glassesY += offsetY;  // Tùy chỉnh vị trí lên/xuống

                            // Cập nhật vị trí của kính theo tỷ lệ video và canvas
                            const scaleX = canvasElement.width / videoElement.videoWidth;
                            const scaleY = canvasElement.height / videoElement.videoHeight;

                            //console.log('Glasses X:', glassesX, 'Glasses Y:', glassesY, 'Glasses Width:', glassesWidth, 'Glasses Height:', glassesHeight); // Kiểm tra thông tin kính
                            // Vẽ kính lên canvas, điều chỉnh theo tỷ lệ video và canvas
                            canvasCtx.drawImage(
                                glassesImage,
                                glassesX * scaleX,
                                glassesY * scaleY,
                                glassesWidth * scaleX,
                                glassesHeight * scaleY
                            );
                            $(".loader-div").css('display', 'none'); // Ẩn loader khi mô hình tải xong
                        });

                    }

                    if (isWebcamActive) {
                        requestAnimationFrame(predict);  // Tiếp tục vòng lặp nếu webcam đang chạy
                    }
                    //requestAnimationFrame(predict);
                }

                predict(); // Bắt đầu vòng lặp nhận diện
            }
        });
    </script>
    
    <script src="{{url('js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>

</html>