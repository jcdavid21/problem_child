-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2025 at 12:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `problemchild_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address_region` varchar(255) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `address_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_id`, `full_name`, `phone_number`, `address_region`, `postal_code`, `street_name`, `address_default`) VALUES
(12, 6, 'Andrei', '0909090909', 'Parulan Plaridel Bulacan', '3004', 'Lipana St.', 0),
(14, 9, 'Andrei', '9879789789', 'Parulan Plaridel Bulacan', '3004', 'Lipana St.', 1),
(15, 12, 'Petr Jhayiel Quinto', '096352521211', 'Plaridel', '3004', 'Rocka Tabang', 1),
(17, 13, 'Juan Carlo', '09565535401', 'Kaligayahan', '1124', 'Lot 4 Calle Jayson', 1),
(18, 15, 'Christian Lugo', '09565535401', 'Novaliches', '1124', 'Bayan', 1),
(19, 14, 'Golden Miral', '09565535401', 'Novaliches', '1124', 'Bayan Glori', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `checkbox` int(11) NOT NULL DEFAULT 0,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `variation_id`, `quantity`, `price`, `checkbox`, `status_id`) VALUES
(1, 14, 12, 1, 350, 1, 4),
(5, 14, 12, 1, 350, 1, 4),
(6, 14, 11, 1, 350, 1, 4),
(7, 13, 14, 2, 700, 1, 4),
(8, 13, 16, 1, 500, 0, 0),
(9, 15, 44, 2, 700, 1, 4),
(10, 15, 29, 1, 350, 1, 4),
(11, 15, 16, 3, 1050, 1, 4),
(12, 14, 12, 1, 350, 1, 4),
(13, 14, 16, 1, 500, 1, 4),
(21, 14, 29, 2, 1100, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'T-SHIRT'),
(2, 'HOODIES'),
(3, 'BOTTOMS');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivered_to` varchar(150) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `deliver_address` varchar(255) NOT NULL,
  `pay_method` varchar(50) NOT NULL,
  `pay_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `uploaded_date` date NOT NULL DEFAULT current_timestamp(),
  `availability` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_image`, `price`, `category_id`, `uploaded_date`, `availability`) VALUES
(1, 'Ink Noir ', 'Ink Noir is a captivating and stylish clothing item offered by Problem Child, characterized by its dark and sophisticated design.', 'uploads/773892.png', 350, 1, '2022-12-08', 1),
(2, 'Chalkboard Chic', 'Chalkboard Chic is a trendy and artistic fashion statement from Problem Child.', 'uploads/337036.png', 350, 1, '2022-12-08', 1),
(9, 'Blushing Breeze', 'Blushing Breeze Embrace comfort and style with our Blushing Breeze collection. Crafted with the perfect blend of warmth and fashion, these hoodies offer a cozy haven while keeping you on-trend.', 'uploads/649370.png', 500, 2, '2023-12-08', 1),
(10, 'Whiskered Gray', 'Whiskered Gray Experience urban sophistication with our Whiskered Gray collection. These hoodies effortlessly blend street style with comfort, featuring a timeless gray hue and whiskered details for a touch of rugged charm.', 'uploads/626367.png', 500, 2, '2023-12-08', 1),
(15, 'Hooded Grayscale', 'Hooded Grayscale Elevate your child\'s fashion with our Hooded Grayscale bottoms from Problem Child Clothing.', 'uploads/735165.png', 500, 3, '2023-12-08', 1),
(16, 'Happy Brown', 'Happy Brown Infuse joy into your child\'s wardrobe with our Happy Brown bottoms from Problem Child Clothing.', 'uploads/891770.png', 550, 3, '2023-12-08', 1),
(28, 'Penshoppe Shirt', 'None', 'uploads/985171-Navy_Blue_2.jpg', 350, 1, '2025-01-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_size_variation`
--

CREATE TABLE `product_size_variation` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_size_variation`
--

INSERT INTO `product_size_variation` (`variation_id`, `product_id`, `size_id`, `quantity_in_stock`) VALUES
(1, 1, 4, 51),
(2, 2, 3, 50),
(3, 2, 2, 50),
(6, 3, 3, 50),
(7, 4, 2, 50),
(8, 5, 4, 50),
(9, 6, 2, 50),
(10, 7, 2, 50),
(11, 1, 2, 48),
(12, 1, 1, 39),
(13, 1, 3, 49),
(14, 2, 1, 48),
(15, 2, 4, 50),
(16, 9, 1, 48),
(17, 9, 2, 50),
(18, 9, 3, 47),
(19, 9, 4, 46),
(20, 10, 1, 50),
(21, 10, 2, 50),
(22, 10, 3, 50),
(23, 10, 4, 50),
(24, 15, 1, 50),
(25, 15, 2, 50),
(26, 15, 3, 50),
(27, 15, 4, 50),
(28, 16, 1, 50),
(29, 16, 2, 47),
(30, 16, 3, 50),
(31, 16, 4, 50),
(44, 28, 1, 28),
(45, 28, 2, 30),
(46, 28, 3, 30),
(47, 28, 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_log`
--

CREATE TABLE `tbl_audit_log` (
  `log_user_id` int(11) DEFAULT NULL,
  `log_username` varchar(50) DEFAULT NULL,
  `log_user_type` varchar(50) DEFAULT NULL,
  `log_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_log`
--

INSERT INTO `tbl_audit_log` (`log_user_id`, `log_username`, `log_user_type`, `log_date`) VALUES
(14, 'golden@gmail.com', '1', '2025-01-07 16:49:54'),
(14, 'golden@gmail.com', '1', '2025-01-07 16:58:16'),
(14, 'golden@gmail.com', '1', '2025-01-07 16:58:36'),
(14, 'golden@gmail.com', '1', '2025-01-08 08:06:34'),
(14, 'golden@gmail.com', '1', '2025-01-08 11:36:32'),
(14, 'golden@gmail.com', '1', '2025-01-08 11:48:03'),
(14, 'golden@gmail.com', '1', '2025-01-08 11:52:29'),
(14, 'golden@gmail.com', '1', '2025-01-08 13:01:44'),
(14, 'golden@gmail.com', '1', '2025-01-08 13:13:03'),
(14, 'golden@gmail.com', '1', '2025-01-08 14:13:58'),
(14, 'golden@gmail.com', '1', '2025-01-09 08:59:58'),
(14, 'golden', '1', '2025-01-09 09:10:02'),
(14, 'golden', '1', '2025-01-09 09:17:57'),
(14, 'golden', '1', '2025-01-09 09:19:04'),
(14, 'golden', '1', '2025-01-09 09:25:42'),
(14, 'golden', '1', '2025-01-09 09:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

CREATE TABLE `tbl_audit_trail` (
  `trail_user_id` int(11) DEFAULT NULL,
  `trail_username` varchar(50) DEFAULT NULL,
  `trail_activity` varchar(50) DEFAULT NULL,
  `trail_user_type` varchar(50) DEFAULT NULL,
  `trail_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_trail`
--

INSERT INTO `tbl_audit_trail` (`trail_user_id`, `trail_username`, `trail_activity`, `trail_user_type`, `trail_date`) VALUES
(14, 'golden miral', 'Checked out items', 'Admin', '2025-01-07 09:50:45'),
(14, 'golden miral', 'Activated product with ID: 1', 'Admin', '2025-01-07 10:02:21'),
(14, 'golden miral', 'Deactivated product with ID: 1', 'Admin', '2025-01-07 10:02:30'),
(14, 'golden miral', 'Activated product with ID: 1', 'Admin', '2025-01-07 10:02:36'),
(14, 'golden miral', 'Checked out items', 'Admin', '2025-01-07 10:04:49'),
(14, 'golden miral', 'Updated product details for product ID: 1', 'Admin', '2025-01-07 10:24:10'),
(14, 'golden miral', 'Updated product details for product ID: 2', 'Admin', '2025-01-07 10:24:23'),
(14, 'golden miral', 'Updated product details for product ID: 2', 'Admin', '2025-01-07 10:35:22'),
(14, 'golden miral', 'Updated product details for product ID: 2', 'Admin', '2025-01-07 10:35:29'),
(14, 'golden miral', 'Checked out items', 'Admin', '2025-01-08 06:24:03'),
(14, 'golden miral', 'Checked out items', 'Admin', '2025-01-08 07:12:59'),
(14, 'golden miral', 'Updated product details for product ID: 1', 'Admin', '2025-01-09 02:02:53'),
(14, 'golden miral', 'Updated product details for product ID: 1', 'Admin', '2025-01-09 09:04:13'),
(14, 'golden miral', 'Checked out items', 'Admin', '2025-01-09 09:20:41'),
(14, 'golden miral', 'Updated product details for product ID: 1', 'Admin', '2025-01-09 09:23:34'),
(14, 'golden miral', 'Updated product details for product ID: 1', 'Admin', '2025-01-09 09:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `fd_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `fd_comment` varchar(255) NOT NULL,
  `fd_date` date DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`fd_id`, `product_id`, `fd_comment`, `fd_date`, `user_id`, `variation_id`) VALUES
(8, 2, 'Wow', '2025-01-09', 13, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `cart_id`) VALUES
(1, 1),
(2, 5),
(2, 6),
(3, 7),
(4, 9),
(5, 10),
(5, 11),
(6, 12),
(7, 13),
(8, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_id`, `address_id`, `shipping_fee`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 17, 60),
(4, 18, 60),
(5, 18, 60),
(6, 19, 0),
(7, 19, 0),
(8, 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`status_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Delivered'),
(5, 'Cancelled'),
(6, 'Admin Cart');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_details`
--

CREATE TABLE `tbl_product_details` (
  `product_id` int(11) NOT NULL,
  `first_img` varchar(255) DEFAULT NULL,
  `second_img` varchar(255) DEFAULT NULL,
  `third_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_details`
--

INSERT INTO `tbl_product_details` (`product_id`, `first_img`, `second_img`, `third_img`) VALUES
(1, 'crop1.png', 'crop2.jpg', 'crop3.jpg'),
(2, 'crop4.png', 'crop5.jpg', 'crop6.png'),
(9, NULL, NULL, NULL),
(10, NULL, NULL, NULL),
(15, NULL, NULL, NULL),
(16, NULL, NULL, NULL),
(28, '985171-Navy_Blue_1.jpg', '985171-Navy_Blue_3.jpg', '985171-Navy_Blue_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `receipt_img` varchar(255) DEFAULT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `deposit_amount` float NOT NULL,
  `uploaded_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `user_id`, `order_id`, `receipt_img`, `receipt_number`, `deposit_amount`, `uploaded_date`) VALUES
(5, 14, 1, NULL, '2092574583819', 350, '2025-01-07'),
(6, 14, 2, NULL, '9327215776002', 700, '2025-01-07'),
(7, 13, 3, '677e605589a68.jpeg', '2134214213111', 760, '2025-01-08'),
(8, 15, 4, '677e65e1a12ce.jpeg', '2134214213111', 760, '2025-01-08'),
(9, 15, 5, '677e66d156ba3.jpeg', '2134214213111', 1110, '2025-01-08'),
(10, 14, 6, NULL, '3649210914891', 350, '2025-01-08'),
(11, 14, 7, NULL, '7871410466876', 500, '2025-01-08'),
(12, 14, 8, NULL, '9785988442358', 1100, '2025-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tracking_number`
--

CREATE TABLE `tbl_tracking_number` (
  `tracking_id` int(11) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tracking_number`
--

INSERT INTO `tbl_tracking_number` (`tracking_id`, `tracking_number`, `order_id`) VALUES
(2, '9321342', 5),
(3, '832134', 3),
(4, '45123452', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_activity` varchar(100) NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`user_id`, `user_name`, `user_type`, `user_activity`, `activity_date`, `item_id`) VALUES
(14, 'golden miral', '1', 'Claimed items', '2025-01-08 16:00:00', 3),
(14, 'golden miral', '1', 'Claimed items', '2025-01-09 09:18:16', 4),
(14, 'golden miral', '1', 'Checked out items', '2025-01-09 09:20:41', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `contact_no` varchar(10) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT '../images/icon/profile.png',
  `registered_at` date NOT NULL DEFAULT current_timestamp(),
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `status_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `contact_no`, `gender`, `date_of_birth`, `picture_path`, `registered_at`, `isAdmin`, `status_id`) VALUES
(9, 'Andrei', 'Sabularse', 'andrei@gmail.com', '$2y$10$MJCMb4iKdHQpDI98n.yshOf4lEKSbgN8eRvcGsTLnLGxNdvQDmslS', '0908714345', 'male', '1999-02-10', '../images/icon/profile.png', '2024-10-29', 0, 1),
(10, 'admin', 'admin', 'admin@gmail.com', '$2y$10$pG.lIBmNuf3Rp/83Xzv/SeHnyFtiES3IY/UXil9zXDoOln74jZp6a', '', NULL, NULL, '../images/icon/profile.png', '2024-11-03', 1, 1),
(11, 'amon', 'rius', 'amon@gmmail.com', '$2y$10$qSrnYFWCGYO.9x5AkNjPQepGHyuqe.4bwsj/kTOyZ.O1X5kmfm1kC', '', NULL, NULL, '../images/icon/profile.png', '2024-11-16', 0, 1),
(12, 'Petr ', 'Quinto', 'petr@gmail.com', '$2y$10$RqKF8vXtlnOkJmxlIjjdDehgZ8jicA8xyn8N.yKngbslCdPND54Q2', '', NULL, NULL, '../images/icon/profile.png', '2024-11-16', 0, 1),
(13, 'Jc', 'David', 'jcdavid123c@gmail.com', '$2y$10$CLDQD5tMxLrNRwePaA67M.GzhojJ0YN05Jx5QZXVLArs12A3/MvAW', NULL, NULL, NULL, '../images/icon/profile.png', '2025-01-02', 0, 1),
(14, 'golden', 'miral', 'golden@gmail.com', '$2y$10$jonf7TdxUfReZjrlHhJc2es1cbsue/KyxjTdun9FqLcKtQ25rhYT.', NULL, NULL, NULL, '../images/icon/profile.png', '2025-01-04', 1, 1),
(15, 'christian', 'lugo', 'lugo@gmail.com', '$2y$10$KimS1J4w9CsjzdJ3EOvQAufyTpvBgVQsXX/dZv/7xUeRYHJfpFwG.', NULL, NULL, NULL, '../images/icon/profile.png', '2025-01-04', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_size_variation`
--
ALTER TABLE `product_size_variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD UNIQUE KEY `uc_ps` (`product_id`,`size_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_product_details`
--
ALTER TABLE `tbl_product_details`
  ADD UNIQUE KEY `variation_id` (`product_id`);

--
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_tracking_number`
--
ALTER TABLE `tbl_tracking_number`
  ADD PRIMARY KEY (`tracking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`),
  ADD UNIQUE KEY `uc_wish` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_size_variation`
--
ALTER TABLE `product_size_variation`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_tracking_number`
--
ALTER TABLE `tbl_tracking_number`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`variation_id`) REFERENCES `product_size_variation` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
