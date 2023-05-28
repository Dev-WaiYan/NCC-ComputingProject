-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 08:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncc_computing_pj_myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin1', '$2y$10$ohzGUHxd4T42LD9udxjOu.Tf8u1/7FqFDA2LBv17WvUlhhtEZ29bm', 1, '2023-05-03 15:04:21', '2023-05-03 15:04:21'),
(2, 'staff1', '$2y$10$ohzGUHxd4T42LD9udxjOu.Tf8u1/7FqFDA2LBv17WvUlhhtEZ29bm', 2, '2023-05-13 07:50:17', '2023-05-13 07:50:17'),
(3, 'admin2', '$2y$10$hb3aPqbmD5zllkDH4/f/3uH4OvMQMZzLMqGMCM80EXs4EBC15yYnW', 1, '2023-05-28 08:28:44', '2023-05-28 08:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-05-03 14:39:30', '2023-05-03 14:39:30'),
(2, 'staff', '2023-05-03 14:39:30', '2023-05-03 14:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(6, 'user2', 'user2@gmail.com', '0912345', '$2y$10$mzi4NTh9cL44gxAfuxeX/./qFx/7U7w7KhMThB7j2YmNu16lxqJDa', '2023-05-28 02:03:29', '2023-05-28 02:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer_product_reviews`
--

CREATE TABLE `customer_product_reviews` (
  `id` int(11) NOT NULL,
  `review` varchar(5000) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `deli_address` varchar(255) NOT NULL,
  `is_deliver_success` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `deli_address`, `is_deliver_success`, `created_at`, `updated_at`) VALUES
(9, 6, 'deli address  - 1', 1, '2023-05-28 09:12:15', '2023-05-28 09:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`) VALUES
(9, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_screen_shot` varchar(500) NOT NULL,
  `is_payment_verified` tinyint(1) DEFAULT NULL,
  `payment_verified_admin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_confirm_at` timestamp NULL DEFAULT NULL,
  `totalCheckoutAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_screen_shot`, `is_payment_verified`, `payment_verified_admin_id`, `created_at`, `payment_confirm_at`, `totalCheckoutAmount`) VALUES
(8, 9, '64731aef04c3f.jpg', 1, 1, '2023-05-28 09:12:15', '2023-05-28 04:53:35', 790);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(500) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `cover_img` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `cover_img`, `price`, `product_category_id`, `created_at`, `updated_at`) VALUES
(7, 'IdeaPad Slim 3 (15″ AMD) Laptop', 'Make a statement wherever you go with the IdeaPad Slim 3 laptop, built for lightness and thinness, measuring up to 10% slimmer than the previous generation. Available in Arctic Grey and Abyss Blue, this sturdy build stands up to harsh drops with military-grade durability for extreme travel conditions.', '<h3>Smarter mobility</h3><ul><li>Harness agile performance from AMD Ryzen™ 7000 Series Mobile Processors</li><li>Experience rich media on a sharp 15.6″ touchscreen display and Dolby Audio™</li><li>Versatile ports that let you connect all your favorite peripherals</li><li>Lenovo AI Engine learns your computing habits and makes your laptop run smoother</li><li>An environmentally responsible device with EPEAT® Silver certification and built from post-consumer recycled contents</li></ul>', 'uploads/6473171b51611.jpeg', 690, 8, '2023-05-28 08:55:55', '2023-05-28 08:55:55'),
(8, 'IdeaPad Slim 3i (15″ Intel) Laptop', 'Engineered with military-grade quality, the IdeaPad Slim 3i laptop is ideal for on-the-go work, school, or entertainment. Powered by up to 13th Gen Intel® Core™ processors, this 15″ touchscreen device boasts speedy responsiveness for all your apps—so you can multitask to your heart’s content. Plus, huge amounts of storage mean you can save your entire multimedia library on your PC without compromise.', '<h3>The smarter choice for mobility</h3><ul><li>Wide-angle 15″ touchscreen laptop powered by up to 13th Gen Intel® Core™ processors</li><li>Settings let you optimize performance, extend battery life, &amp; keep the system cooler</li><li>Stay unplugged for longer with rapid-charging technology&nbsp;</li><li>Instantaneous login &amp; bootup with fingerprint-reader activated power button&nbsp;</li><li>Great for videocalls: webcam with privacy shutter, Dolby Audio™, &amp; noise cancellation</li></ul>', 'uploads/647317ea1628d.jpeg', 790, 8, '2023-05-28 08:59:22', '2023-05-28 08:59:22'),
(9, 'ThinkPad Bluetooth Silent Mouse', 'The ThinkPad Bluetooth Silent Mouse takes a well-worn concept and turns it on its head, delivering a productivity device that doesn’t get in the way of the busy professionals who use it. It sculpted to be comfortable to rest your palm on, with a low-profile, minimalist design that makes the mouse easy to carry and fit into pockets without bulging. ', '<h2>Key Details</h2><ul><li>Dual-host Bluetooth 5.0 to switch between 2 devices</li><li>Swift Pair to conveniently connect to new devices</li><li>Silent buttons without the annoying click sounds</li><li>Blue optical sensor that works on most surfaces</li><li>On-the-fly DPI adjustment: 2400, 1600, 800</li><li>Up to 1 year batter life on a single AA battery (may vary based on usage)</li></ul>', 'uploads/6473185ca599a.jpeg', 27, 9, '2023-05-28 09:01:16', '2023-05-28 09:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(8, 'laptop', '2023-05-28 08:38:42', '2023-05-28 08:38:42'),
(9, 'mouse', '2023-05-28 08:57:20', '2023-05-28 08:57:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`role_name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_product_reviews`
--
ALTER TABLE `customer_product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_product_reviews`
--
ALTER TABLE `customer_product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `admin_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_product_reviews`
--
ALTER TABLE `customer_product_reviews`
  ADD CONSTRAINT `customer_product_reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_product_reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
