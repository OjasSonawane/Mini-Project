-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 16, 2025 at 02:21 PM
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

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`cust_id`, `reservation_date`, `reservation_time`, `customer_name`, `cust_contact`, `number_of_people`) VALUES
(4193, '2025-04-18', '17:00:00', 'shinchan', '919191919191', 2),
(4193, '2025-04-18', '18:00:00', 'shinchan', '919191919191', 2),
(4193, '2025-04-18', '19:30:00', 'shinchan', '919191919191', 2),
(4193, '2025-05-01', '17:30:00', 'shinchan', '5235255325', 3),
(4193, '2025-05-01', '20:00:00', 'shinchan', '5235255325', 3),
(5807, '2025-04-05', '22:30:00', 'Rohan Anmulwad', '66786969766', 2),
(10425, '2025-03-07', '16:00:00', '1600', '2424244', 32),
(10425, '2025-03-14', '12:00:00', '1600', '98765432123', 3),
(10425, '2025-03-28', '17:30:00', '1600', '8232935975', 22),
(22636, '2025-03-30', '14:00:00', 'ofsjfaos', '929292929299', 1),
(34445, '2025-03-08', '13:30:00', 'Pratik ', '5831238591', 5),
(60614, '2025-03-14', '17:00:00', 'Om Solashe', '7666249377', 2),
(80432, '2025-03-07', '16:00:00', 'JOJo', '1234567890', 4),
(81325, '2025-04-17', '17:00:00', '1700', '87593752525', 2),
(81325, '2025-04-17', '17:30:00', '1700', '87593752525', 2),
(81325, '2025-04-17', '18:30:00', '1700', '87593752525', 2),
(88428, '2025-04-17', '16:30:00', 'Omkar', '8429279283', 2),
(89687, '2025-03-07', '20:00:00', 'John Doe', '1234567890', 3),
(90229, '2025-03-07', '16:00:00', 'Omkar Narvekar', '6544665465', 3);

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

--
-- Dumping data for table `reservation_tables`
--

INSERT INTO `reservation_tables` (`cust_id`, `reservation_date`, `reservation_time`, `table_id`) VALUES
(4193, '2025-04-18', '17:00:00', 3),
(4193, '2025-05-01', '20:00:00', 8),
(5807, '2025-04-05', '22:30:00', 1),
(5807, '2025-04-05', '22:30:00', 2),
(5807, '2025-04-05', '22:30:00', 3),
(5807, '2025-04-05', '22:30:00', 4),
(5807, '2025-04-05', '22:30:00', 5),
(5807, '2025-04-05', '22:30:00', 6),
(5807, '2025-04-05', '22:30:00', 7),
(5807, '2025-04-05', '22:30:00', 8),
(5807, '2025-04-05', '22:30:00', 9),
(5807, '2025-04-05', '22:30:00', 10),
(5807, '2025-04-05', '22:30:00', 11),
(5807, '2025-04-05', '22:30:00', 12),
(5807, '2025-04-05', '22:30:00', 13),
(5807, '2025-04-05', '22:30:00', 14),
(5807, '2025-04-05', '22:30:00', 15),
(5807, '2025-04-05', '22:30:00', 16),
(5807, '2025-04-05', '22:30:00', 17),
(10425, '2025-03-07', '16:00:00', 7),
(10425, '2025-03-07', '16:00:00', 10),
(10425, '2025-03-07', '16:00:00', 14),
(10425, '2025-03-28', '17:30:00', 10),
(22636, '2025-03-30', '14:00:00', 3),
(22636, '2025-03-30', '14:00:00', 10),
(34445, '2025-03-08', '13:30:00', 0),
(60614, '2025-03-14', '17:00:00', 6),
(80432, '2025-03-07', '16:00:00', 4),
(88428, '2025-04-17', '16:30:00', 2),
(88428, '2025-04-17', '16:30:00', 6),
(89687, '2025-03-07', '20:00:00', 0),
(90229, '2025-03-07', '16:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `created_at`, `last_login`) VALUES
(4193, 'shinchan', 'shinchan@gmail.com', '$2y$10$9R5kWbKgUPgzExEBF9xZ9u7LyeVAdL82WTSU6OkiNUU8Zo1a6EzGq', '2025-04-16 11:55:05', NULL),
(47566, 'uj', 'uj@gmail.com', '$2y$10$2BUASOOkpGTRUvW7LvgeguowSHKLLAOdFKVcP1VmD0GpkFf1DFtOK', '2025-04-16 10:43:01', NULL),
(81325, '1700', '1700@gmail.com', '$2y$10$c2UL9KXKjDCuMDs8aWe2EujIVXzLTks1KDVcJpbHdb4c3ktlDr1HC', '2025-04-16 11:07:34', NULL),
(88428, 'Omkar', 'omkar@gmail.com', '$2y$10$zGdDZkRMTbrSxnf66qmY8ei5u42mwic7nmiygfaDET0TlsOkWNMK2', '2025-04-15 06:43:43', NULL),
(91295, 'bro', 'bro@gmail.com', '$2y$10$UKk3dupPEfB0vGvyYqwGNe8RtjQugC9oRRFqHqsVFr.dRTP4/579a', '2025-04-16 10:52:58', NULL);

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation_tables`
--
ALTER TABLE `reservation_tables`
  ADD CONSTRAINT `reservation_tables_ibfk_1` FOREIGN KEY (`cust_id`,`reservation_date`,`reservation_time`) REFERENCES `reservations` (`cust_id`, `reservation_date`, `reservation_time`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
