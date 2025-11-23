-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2025 at 09:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jetway`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`, `full_name`, `created_at`) VALUES
(1, 'Marvin', 'Backend', 'Marvin Arif Pratama', '2025-11-23 08:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `flight_id` int NOT NULL,
  `passenger_count` int NOT NULL,
  `base_price` decimal(12,2) NOT NULL,
  `insurance_price` decimal(12,2) DEFAULT '0.00',
  `baggage_price` decimal(12,2) DEFAULT '0.00',
  `delay_price` decimal(12,2) DEFAULT '0.00',
  `booking_code` varchar(50) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `flight_id`, `passenger_count`, `base_price`, `insurance_price`, `baggage_price`, `delay_price`, `booking_code`, `total_price`, `status`, `created_at`, `booking_date`) VALUES
(1, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JWB7482BEA21', '3500000.00', 'pending', '2025-11-21 12:39:59', '2025-11-21 12:39:59'),
(2, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JW44506C7E61', '3500000.00', 'pending', '2025-11-21 12:39:59', '2025-11-21 12:39:59'),
(3, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JW4EAD6585E6', '3500000.00', 'pending', '2025-11-21 12:40:13', '2025-11-21 12:40:13'),
(4, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JWED03730336', '2100000.00', 'pending', '2025-11-21 13:30:27', '2025-11-21 13:30:27'),
(5, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JW39D1955BEA', '3500000.00', 'pending', '2025-11-22 02:09:18', '2025-11-22 02:09:18'),
(6, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JW308B0D2080', '3500000.00', 'pending', '2025-11-22 02:25:06', '2025-11-22 02:25:06'),
(7, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JW96D8DF7E64', '2100000.00', 'pending', '2025-11-22 02:28:16', '2025-11-22 02:28:16'),
(8, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JW07A9C91615', '2100000.00', 'pending', '2025-11-22 02:31:15', '2025-11-22 02:31:15'),
(9, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JWB1F0E78C0A', '3500000.00', 'pending', '2025-11-22 02:40:35', '2025-11-22 02:40:35'),
(10, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JWA5C72C8FD1', '2100000.00', 'pending', '2025-11-22 02:47:17', '2025-11-22 02:47:17'),
(11, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JW21BF0B6E13', '2100000.00', 'pending', '2025-11-22 13:26:16', '2025-11-22 13:26:16'),
(12, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JW1389BB3FA4', '3500000.00', 'pending', '2025-11-22 13:37:12', '2025-11-22 13:37:12'),
(13, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JW452CBF8088', '3500000.00', 'pending', '2025-11-22 13:38:59', '2025-11-22 13:38:59'),
(14, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JWC324373A1D', '3500000.00', 'pending', '2025-11-22 13:45:55', '2025-11-22 13:45:55'),
(15, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JWFE7C58A752', '3500000.00', 'pending', '2025-11-22 13:49:36', '2025-11-22 13:49:36'),
(16, 11, 1, 1, '3500000.00', '0.00', '0.00', '0.00', 'JWC40FFF948C', '3500000.00', 'pending', '2025-11-22 13:49:47', '2025-11-22 13:49:47'),
(17, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JW9A71B90288', '2100000.00', 'pending', '2025-11-22 13:56:04', '2025-11-22 13:56:04'),
(18, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JWBE4ED4AB1D', '5800000.00', 'pending', '2025-11-22 14:02:44', '2025-11-22 14:02:44'),
(19, 11, 2, 1, '2100000.00', '0.00', '0.00', '0.00', 'JWCE280F9296', '2100000.00', 'pending', '2025-11-22 14:03:40', '2025-11-22 14:03:40'),
(23, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JW3F32182543', '5800000.00', 'pending', '2025-11-23 08:27:36', '2025-11-23 08:27:36'),
(24, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JWF412296451', '5800000.00', 'pending', '2025-11-23 08:27:41', '2025-11-23 08:27:41'),
(25, 11, 5, 1, '11700000.00', '0.00', '0.00', '0.00', 'JW539A17FAF9', '11700000.00', 'pending', '2025-11-23 09:04:56', '2025-11-23 09:04:56'),
(26, 11, 5, 1, '11700000.00', '0.00', '0.00', '0.00', 'JW9D36B72BC2', '11700000.00', 'pending', '2025-11-23 09:04:59', '2025-11-23 09:04:59'),
(27, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JW8A73C208EA', '5800000.00', 'pending', '2025-11-23 09:19:10', '2025-11-23 09:19:10'),
(28, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JWB01E7BD91A', '5800000.00', 'pending', '2025-11-23 09:19:13', '2025-11-23 09:19:13'),
(29, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JW650B8BB22C', '5800000.00', 'pending', '2025-11-23 09:19:55', '2025-11-23 09:19:55'),
(30, 11, 3, 1, '5800000.00', '0.00', '0.00', '0.00', 'JW80599CD88E', '5800000.00', 'pending', '2025-11-23 09:19:57', '2025-11-23 09:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int NOT NULL,
  `airline` varchar(100) DEFAULT NULL,
  `airline_logo` varchar(255) DEFAULT NULL,
  `departure_airport` varchar(20) NOT NULL,
  `departure_airport_name` varchar(100) DEFAULT NULL,
  `departure_city` varchar(100) DEFAULT NULL,
  `departure_time` time NOT NULL,
  `arrival_airport` varchar(20) NOT NULL,
  `arrival_airport_name` varchar(100) DEFAULT NULL,
  `arrival_city` varchar(100) DEFAULT NULL,
  `arrival_time` time NOT NULL,
  `flight_date` date DEFAULT NULL,
  `flight_code` varchar(20) DEFAULT NULL,
  `flight_class` varchar(50) DEFAULT NULL,
  `baggage_weight` int DEFAULT '0',
  `cabin_baggage_weight` int DEFAULT '0',
  `duration` varchar(20) DEFAULT NULL,
  `price` int NOT NULL,
  `available_seats` int NOT NULL DEFAULT '150'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `airline`, `airline_logo`, `departure_airport`, `departure_airport_name`, `departure_city`, `departure_time`, `arrival_airport`, `arrival_airport_name`, `arrival_city`, `arrival_time`, `flight_date`, `flight_code`, `flight_class`, `baggage_weight`, `cabin_baggage_weight`, `duration`, `price`, `available_seats`) VALUES
(1, 'Batik Air', '/FOTO/logo Batik Air.png', 'CGK', 'Soekarno Hatta Intl', NULL, '11:40:00', 'SIN', 'Changi', NULL, '14:35:00', NULL, 'ID-7624', 'Economy', 16, 7, '1h45m', 3500000, 139),
(2, 'Lion Air', '/FOTO/logo Lion air.png', 'CGK', 'Soekarno Hatta Intl', NULL, '07:00:00', 'SIN', 'Changi', NULL, '11:35:00', NULL, 'JT-153', 'Economy', 15, 7, '1h45m', 2100000, 143),
(3, 'Garuda Air', '/FOTO/logo Garuda.png', 'CGK', 'Soekarno Hatta Intl', NULL, '03:30:00', 'SIN', 'Changi', NULL, '05:45:00', NULL, 'GA-6722', 'Premium Economy', 15, 7, '1h45m', 5800000, 145),
(4, 'Citilink', '/FOTO/logo Citilink.png', 'CGK', 'Soekarno Hatta Intl', NULL, '04:50:00', 'SIN', 'Changi', NULL, '06:10:00', NULL, 'QG-6914', 'Economy', 7, 7, '1h40m', 2800000, 149),
(5, 'Sriwijaya Air', '/FOTO/logo Sriwijaya.png', 'CGK', 'Soekarno Hatta Intl', NULL, '12:00:00', 'SIN', 'Changi', NULL, '14:05:00', NULL, 'SJ-233', 'Economy', 20, 7, '1h45m', 11700000, 148);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `email`, `password`, `last_login`, `created_at`, `updated_at`) VALUES
(11, 'Kenzo', 'Kenzo@gmail.com', '$2y$10$36ldYFKsmAia5U5DgSbe5eswKRuLMq3KaEhHIXheiA3zhA5HfGjpW', '2025-11-23 02:04:16', '2025-10-31 04:03:53', '2025-11-23 02:04:16'),
(12, 'Daniel', 'daniel@gmail.com', '$2y$10$dYiilnaYYvML5.bEMUxyxug0NXQNpjGeAy/qry5Dx4meIWblsm6OO', '2025-11-23 09:27:07', '2025-11-14 03:38:24', '2025-11-23 09:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `city`, `phone`, `address`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 11, 'Kenzo', 'Rivaldo', 'Male', '2009-06-23', 'Pontianak', '08126969999', 'PAL', NULL, '2025-11-10 23:53:02', '2025-11-10 23:57:50'),
(2, 12, 'DANIEL', 'FT', 'Male', '2025-11-11', 'Pontianak', '081269699988', 'CP', NULL, '2025-11-14 03:38:59', '2025-11-14 03:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_amount` int DEFAULT '0',
  `discount_percent` int DEFAULT '0',
  `max_discount` int DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discount_amount`, `discount_percent`, `max_discount`, `expires_at`, `is_active`) VALUES
(1, 'POTONG50K', 50000, 0, NULL, '2026-01-22 09:13:46', 1),
(2, 'DISKON10', 0, 10, 150000, '2025-12-23 09:13:46', 1),
(3, 'NEWUSER', 0, 20, 200000, '2026-02-21 09:13:46', 1),
(4, 'INSFREE', 225000, 0, NULL, '2026-01-07 09:13:46', 1),
(5, 'MEGADEAL', 300000, 0, NULL, '2025-12-08 09:13:46', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_code` (`booking_code`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user` (`user_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_user_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
