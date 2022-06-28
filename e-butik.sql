-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2022 at 07:40 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-butik`
--
CREATE DATABASE IF NOT EXISTS `e-butik` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `e-butik`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(6) NOT NULL,
  `billing_full_name` varchar(150) NOT NULL,
  `billing_street` varchar(150) NOT NULL,
  `billing_postal_code` varchar(20) NOT NULL,
  `billing_city` varchar(90) NOT NULL,
  `billing_country` varchar(90) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` VALUES(1, 3, 766, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 16:49:20');
INSERT INTO `orders` VALUES(2, 3, 766, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 16:56:02');
INSERT INTO `orders` VALUES(3, 3, 766, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 16:57:30');
INSERT INTO `orders` VALUES(4, 3, 383, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 16:58:31');
INSERT INTO `orders` VALUES(5, 3, 330, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 17:00:45');
INSERT INTO `orders` VALUES(6, 3, 1149, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 17:01:44');
INSERT INTO `orders` VALUES(7, 3, 1128, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 17:03:26');
INSERT INTO `orders` VALUES(8, 3, 330, 'YosephBerhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-21 17:03:44');
INSERT INTO `orders` VALUES(9, 3, 947, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-22 13:12:46');
INSERT INTO `orders` VALUES(10, 3, 947, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-23 10:13:15');
INSERT INTO `orders` VALUES(11, 3, 1277, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-23 10:24:29');
INSERT INTO `orders` VALUES(12, 4, 383, ' ', '', '', '', '', '2022-06-23 18:01:22');
INSERT INTO `orders` VALUES(13, 3, 383, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-23 18:03:55');
INSERT INTO `orders` VALUES(14, 3, 947, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-28 09:13:07');
INSERT INTO `orders` VALUES(15, 3, 564, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-28 09:33:43');
INSERT INTO `orders` VALUES(16, 3, 383, 'Yoseph Berhane', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-28 09:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` VALUES(1, 0, 2, 2, 383, 'Peek-a-Boo Bear Toy', '2022-06-21 16:57:30');
INSERT INTO `order_items` VALUES(2, 0, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-21 16:58:31');
INSERT INTO `order_items` VALUES(3, 0, 1, 1, 330, 'Peek-A-Boo Elephant Toy', '2022-06-21 17:00:45');
INSERT INTO `order_items` VALUES(4, 0, 2, 3, 383, 'Peek-a-Boo Bear Toy', '2022-06-21 17:01:44');
INSERT INTO `order_items` VALUES(5, 0, 3, 2, 564, 'Baby Crib Backpack', '2022-06-21 17:03:26');
INSERT INTO `order_items` VALUES(6, 0, 1, 1, 330, 'Peek-A-Boo Elephant Toy', '2022-06-21 17:03:44');
INSERT INTO `order_items` VALUES(7, 9, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-22 13:12:46');
INSERT INTO `order_items` VALUES(8, 9, 3, 1, 564, 'Baby Crib Backpack', '2022-06-22 13:12:46');
INSERT INTO `order_items` VALUES(9, 10, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-23 10:13:15');
INSERT INTO `order_items` VALUES(10, 10, 3, 1, 564, 'Baby Crib Backpack', '2022-06-23 10:13:15');
INSERT INTO `order_items` VALUES(11, 11, 3, 1, 564, 'Baby Crib Backpack', '2022-06-23 10:24:29');
INSERT INTO `order_items` VALUES(12, 11, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-23 10:24:29');
INSERT INTO `order_items` VALUES(13, 11, 1, 1, 330, 'Peek-A-Boo Elephant Toy', '2022-06-23 10:24:29');
INSERT INTO `order_items` VALUES(14, 12, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-23 18:01:22');
INSERT INTO `order_items` VALUES(15, 13, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-23 18:03:55');
INSERT INTO `order_items` VALUES(16, 14, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-28 09:13:07');
INSERT INTO `order_items` VALUES(17, 14, 3, 1, 564, 'Baby Crib Backpack', '2022-06-28 09:13:07');
INSERT INTO `order_items` VALUES(18, 15, 3, 1, 564, 'Baby Crib Backpack', '2022-06-28 09:33:43');
INSERT INTO `order_items` VALUES(19, 16, 2, 1, 383, 'Peek-a-Boo Bear Toy', '2022-06-28 09:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` VALUES(1, 'Peek-A-Boo Elephant Toy', 'Your baby`s new best friend!👶                \r\n✅ Super soft ✅ Perfect size ✅ Interactive fun          \r\n✅ A wonderful gift for all children 👶 ', 330, 16, 'img/item-1.jpg');
INSERT INTO `products` VALUES(2, 'Peek-a-Boo Bear Toy', '🐻A super-soft friend!🥰 \r\n✅ Unmatched Quality\r\n✅ Stimulates Baby’s Senses\r\n✅ Appropriate for ages 0+ \r\n🛒 Get Yours Here → \r\n', 383, 24, 'img/item-2.png');
INSERT INTO `products` VALUES(3, 'Baby Crib Backpack', 'Portable, and convenient!💁\r\n✅ Spacious, durable, comfortable, and waterproof \r\n✅ Approved by busy, on-the-go moms!👍\r\n ', 564, 40, 'img/item-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(3, 'yoseph', 'Yoseph', 'Berhane', 'yosephbet@gmail.com', '$2y$12$pEZwfUiF9muNoM.xbuQAbOfevSgNOir/nzX.NRmgcaqKnoQAhmZF.', '+46703566108', 'Bergsgatan 1A', '63226', 'Eskilstuna', 'Sweden', '2022-06-16 08:38:24', 'img/profile-image.jpg');
INSERT INTO `users` VALUES(4, '', '', '', '', '$2y$12$eZdXAm/gnwNm5RjBw6kVNeBLUo7zMRoWCnfWmvgEJVy7RUBkI.xYW', '', '', '', '', '', '2022-06-23 16:01:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
