-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 07:11 AM
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
-- Database: `modern_eats`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `full_name`, `email`, `hashed_password`, `telephone`, `created_at`, `updated_at`) VALUES
(1, 'Mohan', 'mohan@gmail.com', '$2y$10$PZeMgPe53ZoKu.rPTzPf6uURRFVwI9CHvU5B0A4t18sM.NdrU1lkK', '1234567890', '2025-04-17 06:58:54', '2025-04-17 06:58:54'),
(2, 'admin', 'admin1@gmail.com', '$2y$10$MhS3WsLZLnj5vBYIlRmQae784ucbPy39D3vwaNQ6I8YHTavCjXqe.', '0101010101', '2025-05-07 17:17:59', '2025-05-07 17:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `price`, `available`) VALUES
(41, 'Butter Chicken', 700.00, 1),
(42, 'Panner Tikka', 350.00, 1),
(43, 'Chicken Biryani', 600.00, 1),
(44, 'Aloo Paratha', 180.00, 1),
(45, 'Samosa', 120.00, 1),
(46, 'Classic Margherita', 999.00, 1),
(47, 'Lasagna', 850.00, 1),
(48, 'Spaghetti Carbonara', 1100.00, 1),
(49, 'Fettuccine Alfredo', 950.00, 1),
(50, 'Ravioli', 899.00, 1),
(51, 'Tacos', 450.00, 1),
(52, 'Chicken Burrito', 550.00, 1),
(53, 'Cheese Quesadilla', 450.00, 1),
(54, 'Chicken Enchiladas', 700.00, 1),
(55, 'Churros', 250.00, 1),
(56, 'Spring Rolls', 250.00, 1),
(57, 'Chow Mein', 350.00, 1),
(58, 'Fried Rice', 400.00, 1),
(59, 'Dim Sum', 300.00, 1),
(60, 'Sweet and Sour Chicken', 550.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `order_time` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','preparing','delivered','cancelled') DEFAULT 'pending',
  `payment_status` enum('unpaid','paid') DEFAULT 'unpaid',
  `payment_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `phone`, `order_time`, `total_amount`, `status`, `payment_status`, `payment_id`) VALUES
(1, '', '99999999999', '2025-05-07 20:03:59', 0.00, 'pending', 'unpaid', NULL),
(2, '', '129192192', '2025-05-07 20:09:43', 0.00, 'pending', 'unpaid', NULL),
(3, '', '999999999', '2025-05-07 20:14:13', 0.00, 'pending', 'unpaid', NULL),
(4, '', 'htrfhfghhfgh', '2025-05-07 20:17:07', 0.00, 'pending', 'unpaid', NULL),
(5, 'Bro', '8999999', '2025-05-07 20:18:47', 300.00, 'pending', 'unpaid', NULL),
(6, 'Ojas Sonawane', '9999999999', '2025-05-07 22:40:24', 2000.00, 'pending', 'unpaid', NULL),
(7, 'Omkar Narvekar', '999999999', '2025-05-07 23:19:57', 2180.00, 'pending', 'unpaid', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 5, 44, 1, 180.00),
(2, 5, 45, 1, 120.00),
(3, 6, 53, 2, 450.00),
(4, 6, 48, 1, 1100.00),
(5, 7, 44, 1, 180.00),
(6, 7, 47, 1, 850.00),
(7, 7, 52, 1, 550.00),
(8, 7, 43, 1, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `cust_id` int(11) UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `cust_contact` varchar(15) NOT NULL,
  `number_of_people` tinyint(3) UNSIGNED NOT NULL CHECK (`number_of_people` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_tables`
--

CREATE TABLE `reservation_tables` (
  `cust_id` int(11) UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `table_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(14541, 'new', 'new@gmail.com', '$2y$10$iK5xUUdBk2t5.kw.r.BCcOBVVkosA6x0kjX44ZLiDyEe36p4WgSei', '2025-05-01 20:02:00'),
(18242, 'Bro1', 'bro@gmail.com', '$2y$10$LOTfOYUeGN7JXahNBsKO6ufxlskd1UNd7ITOu.DzAoTWo8uv60bhu', '2025-05-01 19:26:31'),
(20475, 'pratik', 'p@gmail.com', '$2y$10$UJ7yee6dR6SlX4IhFekUYewx1po9jT/lSDvahkeKssqUyDTQW/K9S', '2025-05-02 07:30:05'),
(50190, 'Bro', 'bbbbbb@gmail.com', '$2y$10$PDnaVo8zdDookfqwrkXQA.quE/grijgMC8zyjIR/w50JoSwhkrpyS', '2025-05-07 13:12:36'),
(60223, 'Ojas Sonawane', 'ojassonawane5@gmail.com', '$2y$10$6vA027cnx/OSEcXHI2c.SOwrMgLdQSG/pJVRNBydoDYAbb/uQzhVO', '2025-05-07 17:05:33'),
(71022, 'Omkar', 'omkar@gmail.com', '$2y$10$96loHnu0azog4b2VefSuTOF5WAasx42XYQnysQ44DdsQ9cpCR/9Q2', '2025-05-01 17:59:09'),
(80906, 'Brow', 'bew@gmail.com', '$2y$10$BritW59Qy6twYuJdRQ8BI.Iq3CfIxk/baHG57jRKHlhs8lfDMyjXO', '2025-05-01 19:30:25'),
(99760, 'Omkar Narvekar', 'codeninja0709@gmail.com', '$2y$10$JOt.5kPGL7rd4InuvNa2meydtu9p4EkWL8.Jmsmw4VSv2XijZOE7W', '2025-05-07 17:28:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`cust_id`,`reservation_date`,`reservation_time`);

--
-- Indexes for table `reservation_tables`
--
ALTER TABLE `reservation_tables`
  ADD PRIMARY KEY (`cust_id`,`reservation_date`,`reservation_time`,`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`id`);

--
-- Constraints for table `reservation_tables`
--
ALTER TABLE `reservation_tables`
  ADD CONSTRAINT `reservation_tables_ibfk_1` FOREIGN KEY (`cust_id`,`reservation_date`,`reservation_time`) REFERENCES `reservations` (`cust_id`, `reservation_date`, `reservation_time`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
