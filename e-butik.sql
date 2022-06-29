-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2022 at 11:51 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(9) NOT NULL,
  `billing_full_name` varchar(150) NOT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_postal_code` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `billing_full_name`, `billing_street`, `billing_postal_code`, `billing_city`, `billing_country`, `create_date`) VALUES
(83, 53, 1149, 'Yoseph Berhane', '+46703566108', 'Eskilstuna', 'Eskilstuna', 'sweden', '2022-06-29 13:44:01'),
(84, 53, 330, 'Yoseph Berhane', '+46703566108', 'Eskilstuna', 'Eskilstuna', 'sweden', '2022-06-29 13:44:35'),
(85, 14, 650, 'Maisa Abusalem', 'Mellangaten 16A', '41301', 'Gothenburg', 'Sweden', '2022-06-29 13:46:12'),
(86, 14, 499, 'Maisa Abusalem', 'Mellangaten 16A', '41301', 'Gothenburg', 'Sweden', '2022-06-29 13:46:27'),
(87, 54, 1149, 'Julian Julian', 'Mellangaten 16A', '41301', 'Stockholm', 'Sweden', '2022-06-29 13:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_title`, `quantity`, `unit_price`, `created_at`) VALUES
(84, 83, 2, 'Peek-a-Boo Bear Toy', 1, 320, '2022-06-29 13:44:01'),
(85, 83, 1, 'Peek-A-Boo Elephant Toy', 1, 330, '2022-06-29 13:44:01'),
(86, 83, 3, 'Baby Crib Backpack', 1, 499, '2022-06-29 13:44:01'),
(87, 84, 1, 'Peek-A-Boo Elephant Toy', 1, 330, '2022-06-29 13:44:35'),
(88, 85, 1, 'Peek-A-Boo Elephant Toy', 1, 330, '2022-06-29 13:46:12'),
(89, 85, 2, 'Peek-a-Boo Bear Toy', 1, 320, '2022-06-29 13:46:12'),
(90, 86, 3, 'Baby Crib Backpack', 1, 499, '2022-06-29 13:46:27'),
(91, 87, 1, 'Peek-A-Boo Elephant Toy', 1, 330, '2022-06-29 13:49:02'),
(92, 87, 2, 'Peek-a-Boo Bear Toy', 1, 320, '2022-06-29 13:49:02'),
(93, 87, 3, 'Baby Crib Backpack', 1, 499, '2022-06-29 13:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

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

INSERT INTO `products` (`id`, `title`, `description`, `price`, `stock`, `img_url`) VALUES
(1, 'Peek-A-Boo Elephant Toy', 'Your baby`s new best friend! 👶❤                  \r\n✅ Super soft ✅ Perfect size ✅ Interactive fun          \r\n✅ A wonderful gift for all children 👶', 330, 50, 'img/item-1.jpg'),
(2, 'Peek-a-Boo Bear Toy', '🐻A super-soft friend!🥰 \r\n✅ Unmatched Quality\r\n✅ Stimulates Baby’s Senses\r\n✅ Appropriate for ages 0+ \r\n🛒 Get Yours Here →', 320, 150, 'img/item-2.png'),
(3, 'Baby Crib Backpack', 'Portable, and convenient!💁\r\n✅ Spacious, durable, comfortable, and waterproof \r\n✅ Approved by busy, on-the-go moms!👍', 499, 150, 'img/item-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_url` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `create_date`, `img_url`) VALUES
(14, 'mai', 'Maisa', 'Abusalem', 'mai_as2015@hotmail.com', '$2y$12$QE692zoGC2TOyDawQGy9JeePFS3qnRErsGJvMgT2tP.DP1XunM8vm', '0733676622', 'Mellangaten 16A', '41301', 'Gothenburg', 'Sweden', '2022-06-18 09:35:47', 'img/pexels-pixabay-36029.jpg'),
(53, 'Yoseph', 'Yoseph', 'Berhane', 'yosephbet@gmail.com', '$2y$12$BxjIb7.NnaiapYVbG3sFneeLv3ex0/Wh4UthpGOUS69tTDKfO2ele', '+46703566108', '+46703566108', '68886', 'Eskilstuna', 'Sweden', '2022-06-29 11:43:26', NULL),
(54, 'julian', 'Julian', 'Julian', 'julian@gmail.com', '$2y$12$Ymjr0JMiNvh.3xR3CVa.SenkBzh5MXEZILHXwlHGG5WCwVXYP.MT2', '0700635858', 'Mellangaten 16A', '41301', 'Stockholm', 'Sweden', '2022-06-29 11:49:02', NULL);

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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
