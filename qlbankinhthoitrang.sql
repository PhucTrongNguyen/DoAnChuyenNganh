-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 08:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlbankinhthoitrang`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` char(5) NOT NULL,
  `staff_id` char(5) DEFAULT NULL,
  `cus_id` char(5) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` char(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `staff_id`, `cus_id`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ACC01', NULL, 'C001', 'user1', '#N10t022000', '2024-09-27 13:13:35', '2024-09-27 13:13:35', NULL),
('ACC02', NULL, 'C002', 'user2', '#N11t012006', '2024-09-27 13:13:35', '2024-09-27 13:13:35', NULL),
('ACC03', 'ST003', NULL, 'admin', '#N10t042004', '2024-09-27 13:13:35', '2024-09-27 13:13:35', NULL),
('ACC04', 'ST004', NULL, 'sell', '#N19t042000', '2024-09-27 13:13:35', '2024-09-27 13:13:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` char(5) NOT NULL,
  `cus_id` char(5) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `cus_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
('CART1', 'C001', 2, '2024-09-27 13:15:04', '2024-09-27 13:15:04', NULL),
('CART2', 'C002', 1, '2024-09-27 13:15:04', '2024-09-27 13:15:04', NULL),
('CART3', 'C003', 3, '2024-09-27 13:15:04', '2024-09-27 13:15:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `cart_id` char(5) NOT NULL,
  `proc_id` char(5) NOT NULL
) ;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`cart_id`, `proc_id`) VALUES
('CART1', 'P0001'),
('CART1', 'P0001'),
('CART2', 'P0003'),
('CART3', 'P0004');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cate_id` char(5) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_id`, `category`, `created_at`, `updated_at`, `deleted_at`) VALUES
('C0001', 'Sunglasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0002', 'Prescription Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0003', 'Reading Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0004', 'Safety Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0005', 'Sports Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0006', 'Blue Light Blocking Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0007', 'Fashion Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0008', 'Kids Glasses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0009', 'Contact Lenses', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL),
('C0010', 'Accessories', '2024-09-27 10:26:24', '2024-09-27 10:26:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cmmt_id` char(5) NOT NULL,
  `cus_id` char(5) DEFAULT NULL,
  `evaluate` text DEFAULT NULL
) ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmmt_id`, `cus_id`, `evaluate`) VALUES
('CM001', 'C001', 'Sản phẩm rất tốt!'),
('CM002', 'C002', 'Dịch vụ giao hàng nhanh chóng.'),
('CM003', 'C003', 'Giá cả hợp lý.'),
('CM004', 'C004', 'Chất lượng sản phẩm cần cải thiện.'),
('CM005', 'C005', 'Rất hài lòng với sản phẩm này.'),
('CM006', 'C006', 'Giao hàng không đúng hẹn.'),
('CM007', 'C007', 'Dịch vụ khách hàng rất tận tâm.'),
('CM008', 'C008', 'Sản phẩm không như mong đợi.'),
('CM009', 'C009', 'Tôi sẽ mua lại lần nữa.'),
('CM010', 'C010', 'Không hài lòng với chất lượng.');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` char(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `google_id` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `name`, `email`, `phone`, `address`, `google_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('C001', 'Nguyễn Văn A', 'a@example.com', '0901234567', 'Hà Nội', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C002', 'Trần Thị B', 'b@example.com', '0901234568', 'Hồ Chí Minh', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C003', 'Lê Văn C', 'c@example.com', '0901234569', 'Đà Nẵng', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C004', 'Phạm Thị D', 'd@example.com', '0901234570', 'Hải Phòng', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C005', 'Nguyễn Văn E', 'e@example.com', '0901234571', 'Cần Thơ', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C006', 'Trần Văn F', 'f@example.com', '0901234572', 'Nha Trang', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C007', 'Lê Thị G', 'g@example.com', '0901234573', 'Biên Hòa', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C008', 'Phạm Văn H', 'h@example.com', '0901234574', 'Vũng Tàu', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C009', 'Nguyễn Thị I', 'i@example.com', '0901234575', 'Thái Nguyên', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL),
('C010', 'Trần Văn J', 'j@example.com', '0901234576', 'Nam Định', '', '2024-09-27 12:19:17', '2024-09-27 12:19:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `goodsreceipts`
--

CREATE TABLE `goodsreceipts` (
  `proc_id` char(5) NOT NULL,
  `staff_id` char(5) NOT NULL,
  `sup_id` char(5) NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` decimal(10,0) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date_entry` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `goodsreceipts`
--

INSERT INTO `goodsreceipts` (`proc_id`, `staff_id`, `sup_id`, `unit`, `price`, `quantity`, `amount`, `date_entry`, `created_at`, `updated_at`, `deleted_at`) VALUES
('GR001', 'ST001', 'S0001', 'pieces', 50, 10, 500, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR002', 'ST002', 'S0002', 'pieces', 40, 15, 600, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR003', 'ST003', 'S0003', 'pieces', 30, 20, 600, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR004', 'ST004', 'S0004', 'pieces', 25, 25, 625, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR005', 'ST005', 'S0005', 'pieces', 60, 5, 300, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR006', 'ST006', 'S0006', 'pieces', 45, 12, 540, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR007', 'ST007', 'S0007', 'pieces', 55, 8, 440, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR008', 'ST008', 'S0008', 'pieces', 70, 3, 210, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR009', 'ST009', 'S0009', 'pieces', 65, 7, 455, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL),
('GR010', 'ST010', 'S0010', 'pieces', 80, 2, 160, '2024-09-27 10:27:39', '2024-09-27 10:27:39', '2024-09-27 10:27:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` char(5) NOT NULL,
  `cus_id` char(5) DEFAULT NULL,
  `staff_id` char(5) DEFAULT NULL,
  `proc_id` char(5) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `amount` float DEFAULT NULL
) ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cus_id`, `staff_id`, `proc_id`, `unit`, `quantity`, `price`, `amount`) VALUES
('ORD1', 'C001', 'ST001', 'P0001', 'kg', 2, 100, 200),
('ORD10', 'C010', 'ST010', 'P0010', 'kg', 5, 90, 450),
('ORD2', 'C002', 'ST002', 'P0002', 'kg', 1, 150, 150),
('ORD3', 'C003', 'ST003', 'P0003', 'kg', 3, 200, 600),
('ORD4', 'C004', 'ST004', 'P0004', 'kg', 5, 50, 250),
('ORD5', 'C005', 'ST005', 'P0005', 'kg', 2, 80, 160),
('ORD6', 'C006', 'ST006', 'P0006', 'kg', 4, 75, 300),
('ORD7', 'C007', 'ST007', 'P0007', 'kg', 1, 300, 300),
('ORD8', 'C008', 'ST008', 'P0008', 'kg', 2, 120, 240),
('ORD9', 'C009', 'ST009', 'P0009', 'kg', 3, 60, 180);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `proc_id` char(5) NOT NULL,
  `cate_id` char(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`proc_id`, `cate_id`, `name`, `quantity`, `price`, `picture`, `created_at`, `updated_at`, `deleted_at`) VALUES
('P0001', 'C0001', 'Aviator Sunglasses', 100, 50, 'aviator.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0002', 'C0002', 'Rectangular Prescription Glasses', 80, 40, 'rectangular.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0003', 'C0003', 'Classic Reading Glasses', 150, 30, 'reading.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0004', 'C0004', 'Safety Goggles', 60, 25, 'safety.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0005', 'C0005', 'Sports Sunglasses', 70, 60, 'sports.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0006', 'C0006', 'Blue Light Blocking Glasses', 90, 45, 'bluelight.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0007', 'C0007', 'Fashion Cat Eye Glasses', 110, 55, 'cateye.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0008', 'C0008', 'Kids Colorful Glasses', 130, 20, 'kids.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0009', 'C0009', 'Daily Contact Lenses', 200, 80, 'contact.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL),
('P0010', 'C0010', 'Eyewear Accessories', 300, 10, 'accessories.jpg', '2024-09-27 10:28:02', '2024-09-27 10:28:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` char(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ST001', 'Alice Nguyen', 'alice@store.com', '111-222-3333', '123 Main St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST002', 'Bob Tran', 'bob@store.com', '222-333-4444', '456 Elm St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST003', 'Charlie Ho', 'charlie@store.com', '333-444-5555', '789 Oak St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST004', 'Diana Vu', 'diana@store.com', '444-555-6666', '321 Pine St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST005', 'Eva Le', 'eva@store.com', '555-666-7777', '654 Maple St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST006', 'Frank Pham', 'frank@store.com', '666-777-8888', '987 Cedar St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST007', 'Grace Kim', 'grace@store.com', '777-888-9999', '135 Birch St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST008', 'Hank Do', 'hank@store.com', '888-999-0000', '246 Spruce St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST009', 'Ivy Nguyen', 'ivy@store.com', '999-000-1111', '357 Willow St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL),
('ST010', 'Jack Chen', 'jack@store.com', '000-111-2222', '468 Fir St', '2024-09-27 10:27:21', '2024-09-27 10:27:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppilers`
--

CREATE TABLE `suppilers` (
  `sup_id` char(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `suppilers`
--

INSERT INTO `suppilers` (`sup_id`, `name`, `address`, `phone`, `brand`, `created_at`, `updated_at`, `deleted_at`) VALUES
('S0001', 'Vision Co.', '123 Vision St, City', '123-456-7890', 'Vision Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0002', 'Style Eyewear', '456 Style Ave, City', '234-567-8901', 'Style Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0003', 'Clear Sight Inc.', '789 Clear Rd, City', '345-678-9012', 'Clear Sight', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0004', 'Sunny Days', '321 Sunny St, City', '456-789-0123', 'Sunny Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0005', 'Fashion Frames', '654 Fashion Blvd, City', '567-890-1234', 'Fashion Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0006', 'Lens Masters', '987 Lens St, City', '678-901-2345', 'Lens Master', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0007', 'Kids Vision', '135 Kids St, City', '789-012-3456', 'Kids Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0008', 'Eye Care Solutions', '246 Eye St, City', '890-123-4567', 'Eye Care', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0009', 'Outdoor Gear', '357 Outdoor St, City', '901-234-5678', 'Outdoor Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL),
('S0010', 'Luxury Lenses', '468 Luxury St, City', '012-345-6789', 'Luxury Brand', '2024-09-27 10:26:38', '2024-09-27 10:26:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `fk_accounts_staffs` (`staff_id`),
  ADD KEY `fk_accounts_customers` (`cus_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_carts_customers` (`cus_id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD KEY `fk_cartproduct_carts` (`cart_id`),
  ADD KEY `fk_cartproduct_products` (`proc_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmmt_id`),
  ADD KEY `fk_comments_customers` (`cus_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `goodsreceipts`
--
ALTER TABLE `goodsreceipts`
  ADD PRIMARY KEY (`proc_id`,`staff_id`,`sup_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_products` (`proc_id`),
  ADD KEY `fk_orders_customers` (`cus_id`),
  ADD KEY `fk_orders_staffs` (`staff_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`proc_id`),
  ADD KEY `fk_products_categories` (`cate_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `suppilers`
--
ALTER TABLE `suppilers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_accounts_customers` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`),
  ADD CONSTRAINT `fk_accounts_staffs` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`staff_id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_customers` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `fk_cartproduct_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `fk_cartproduct_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `fk_cartproduct_products` FOREIGN KEY (`proc_id`) REFERENCES `products` (`proc_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_customers` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customers` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`),
  ADD CONSTRAINT `fk_orders_products` FOREIGN KEY (`proc_id`) REFERENCES `products` (`proc_id`),
  ADD CONSTRAINT `fk_orders_staffs` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`staff_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`cate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
