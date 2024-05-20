-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Maio-2024 às 15:29
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(3, '330.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-12 21:19:06'),
(4, '320.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-12 21:40:27'),
(5, '475.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-12 21:45:39'),
(6, '465.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 19:41:47'),
(7, '165.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 19:58:05'),
(8, '165.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 19:58:41'),
(9, '475.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 19:59:03'),
(10, '165.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 20:02:29'),
(11, '165.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 20:03:24'),
(12, '165.00', 'delivered', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-13 20:03:58'),
(13, '320.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:11:03'),
(14, '485.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:11:43'),
(15, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:15:48'),
(16, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:16:46'),
(17, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:20:08'),
(18, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:20:45'),
(19, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:39:02'),
(20, '475.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:40:21'),
(21, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:41:05'),
(22, '310.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:42:21'),
(23, '620.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 17:43:17'),
(24, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 18:09:59'),
(25, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 18:11:19'),
(26, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 18:14:18'),
(27, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 18:16:03'),
(28, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:13:14'),
(29, '485.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:14:24'),
(30, '485.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:15:31'),
(31, '485.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:16:16'),
(32, '485.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:16:42'),
(33, '485.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:17:24'),
(34, '485.00', 'not paid', 1, 2147483647, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:17:42'),
(35, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:36:18'),
(36, '320.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:36:47'),
(37, '320.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 19:44:11'),
(38, '155.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 22:37:27'),
(39, '320.00', 'not paid', 1, 2124548758, 'Curitiba', 'Rua do aprendizado, 1000', '2024-05-18 23:11:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 5, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-12 21:45:39'),
(2, 5, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-12 21:45:39'),
(3, 5, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-12 21:45:39'),
(4, 6, '3', 'White Shoes', 'featured3.jpg', '155.00', 2, 1, '2024-05-13 19:41:47'),
(5, 6, '6', 'Slack coat', 'clothes2.jpg', '155.00', 1, 1, '2024-05-13 19:41:47'),
(6, 7, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-13 19:58:05'),
(7, 8, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-13 19:58:41'),
(8, 9, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-13 19:59:03'),
(9, 9, '1', 'White Shoes', 'featured1.jpg', '155.00', 2, 1, '2024-05-13 19:59:03'),
(10, 10, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-13 20:02:29'),
(11, 11, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-13 20:03:24'),
(12, 12, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-13 20:03:58'),
(13, 13, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 17:11:03'),
(14, 13, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-18 17:11:03'),
(15, 14, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 17:11:43'),
(16, 14, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 17:11:43'),
(17, 15, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 17:15:48'),
(18, 16, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 17:16:46'),
(19, 17, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 17:20:08'),
(20, 18, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 17:20:45'),
(21, 19, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 17:39:02'),
(22, 20, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-18 17:40:21'),
(23, 20, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 17:40:21'),
(24, 20, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 17:40:21'),
(25, 21, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 17:41:05'),
(26, 22, '1', 'White Shoes', 'featured1.jpg', '155.00', 2, 1, '2024-05-18 17:42:21'),
(27, 23, '1', 'White Shoes', 'featured1.jpg', '155.00', 2, 1, '2024-05-18 17:43:17'),
(28, 23, '6', 'Slack coat', 'clothes2.jpg', '155.00', 2, 1, '2024-05-18 17:43:17'),
(29, 24, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 18:09:59'),
(30, 25, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 18:11:19'),
(31, 26, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 18:14:18'),
(32, 27, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 18:16:03'),
(33, 28, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:13:14'),
(34, 29, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:14:24'),
(35, 29, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 19:14:24'),
(36, 30, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:15:31'),
(37, 30, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 19:15:31'),
(38, 31, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:16:16'),
(39, 31, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 19:16:16'),
(40, 32, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:16:42'),
(41, 32, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 19:16:42'),
(42, 33, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:17:24'),
(43, 33, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 19:17:24'),
(44, 34, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 19:17:42'),
(45, 34, '2', 'White Shirt', 'featured2.jpg', '165.00', 2, 1, '2024-05-18 19:17:42'),
(46, 35, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 19:36:18'),
(47, 36, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 19:36:47'),
(48, 36, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-18 19:36:47'),
(49, 37, '3', 'White Shoes', 'featured3.jpg', '155.00', 1, 1, '2024-05-18 19:44:11'),
(50, 37, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-18 19:44:11'),
(51, 38, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 22:37:27'),
(52, 39, '1', 'White Shoes', 'featured1.jpg', '155.00', 1, 1, '2024-05-18 23:11:57'),
(53, 39, '2', 'White Shirt', 'featured2.jpg', '165.00', 1, 1, '2024-05-18 23:11:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'White Shoes', 'shoes', 'awesome white shoes', 'featured1.jpg', 'featured2.jpg', 'featured3.jpg', 'featured4.jpg', '155.00', 0, 'white'),
(2, 'White Shirt', 'shirt', 'awesome white shirt', 'featured2.jpg', 'featured2.jpg', 'featured2.jpg', 'featured2.jpg', '165.00', 0, 'white'),
(3, 'White Shoes', 'shoes', 'awesome white shoes', 'featured3.jpg', 'featured3.jpg', 'featured3.jpg', 'featured3.jpg', '155.00', 0, 'white'),
(4, 'White Shoes', 'shoes', 'awesome white shoes', 'featured4.jpg', 'featured4.jpg', 'featured4.jpg', 'featured4.jpg', '155.00', 0, 'white'),
(5, 'Slack coat', 'coats', 'awesome white shoes', 'clothes1.jpg', 'clothes1.jpg', 'clothes1.jpg', 'clothes1.jpg', '155.00', 0, 'white'),
(6, 'Slack coat', 'coats', 'awesome white shoes', 'clothes2.jpg', 'clothes2.jpg', 'clothes2.jpg', 'clothes1.jpg', '155.00', 0, 'white'),
(7, 'Slack coat', 'coats', 'awesome white shoes', 'clothes3.jpg', 'clothes3.jpg', 'clothes3.jpg', 'clothes1.jpg', '155.00', 0, 'white'),
(8, 'Slack coat', 'coats', 'awesome white shoes', 'clothes4.jpg', 'clothes4.jpg', 'clothes4.jpg', 'clothes4.jpg', '155.00', 0, 'white');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Leonardo', 'moreiraleos123@gmail.com', '$2y$10$6KziLU6T/3Tvmy/7Fq.kMubD00vSrDhsnVnF.OE.uvg/cvOvlBWDm'),
(4, 'Leonardo', 'email@email.com', '$2y$10$FNMBhkxBFEUTRvC2kldNUu5/k4fkC4PojHoPBGmN9f2Sx3KEAA5zS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
