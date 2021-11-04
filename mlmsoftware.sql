-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2021 at 07:15 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlmsoftware`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `sponcer_id` bigint(20) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`id`, `user_id`, `username`, `sponcer_id`, `browser`, `ip`, `login_time`, `logout_time`, `login_date`) VALUES
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-01-06 05:16:24', '0000-00-00 00:00:00', '2021-01-06'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-01-06 05:56:05', '0000-00-00 00:00:00', '2021-01-06'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-01-10 06:57:21', '0000-00-00 00:00:00', '2021-01-10'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-02-02 04:04:33', '0000-00-00 00:00:00', '2021-02-02'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-02-03 05:56:57', '0000-00-00 00:00:00', '2021-02-03'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-02-19 02:06:02', '0000-00-00 00:00:00', '2021-02-19'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-02-20 02:04:31', '0000-00-00 00:00:00', '2021-02-20'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-02-20 03:26:23', '0000-00-00 00:00:00', '2021-02-20'),
(0, 8032428, 'Rayees khan', 0, 'Chrome', '::1', '2021-03-16 08:27:43', '0000-00-00 00:00:00', '2021-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `pair_count`
--

CREATE TABLE `pair_count` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `no_of_pair` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pair_count`
--

INSERT INTO `pair_count` (`id`, `user_id`, `date`, `no_of_pair`) VALUES
(1, 8032428, '2020-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pin`
--

CREATE TABLE `pin` (
  `id` int(11) NOT NULL,
  `pin_value` bigint(20) NOT NULL,
  `alocate_user` bigint(20) NOT NULL,
  `pin_price` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pin`
--

INSERT INTO `pin` (`id`, `pin_value`, `alocate_user`, `pin_price`, `status`) VALUES
(1, 55555, 8032428, 100, 1),
(2, 12345, 8032428, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `aadhar_details` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `sponcer_id` bigint(20) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `password`, `mobile`, `email`, `aadhar_details`, `address`, `position`, `sponcer_id`, `profile`, `status`, `created_date`) VALUES
(1, 8032428, 'Rayees khan', '123456', 9554540271, 'rayees@gmail.com', '098765432176', 'Lucknow', 0, 0, '', '', '2020-12-17'),
(2, 2305567, 'Khan Rayees', '1234567', 987654321, 'khan@gmail.com', '098765432109', 'Lucknow', 0, 8032428, '1608485223_deca1bb5bc12aadbd942.jpg', 'Active', '2020-12-17'),
(3, 3359801, 'Abdal', '123456', 978654321, 'abdal@gmail.com', '098765432109', 'Lucknow', 1, 8032428, '', 'Active', '2020-12-17'),
(4, 1346547, 'Shahid', '123456', 987654321, 'rayeesinfotech@gmail.com', '098765432198', 'Lucknow', 0, 2305567, '', 'Active', '2020-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallate`
--

CREATE TABLE `user_wallate` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `sponcer_id` bigint(20) NOT NULL,
  `level_income` float NOT NULL,
  `position` int(11) NOT NULL,
  `left_count` bigint(10) NOT NULL,
  `right_count` bigint(10) NOT NULL,
  `placement_id` int(11) NOT NULL,
  `right_side` int(11) NOT NULL,
  `left_side` int(11) NOT NULL,
  `income_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_wallate`
--

INSERT INTO `user_wallate` (`id`, `user_id`, `sponcer_id`, `level_income`, `position`, `left_count`, `right_count`, `placement_id`, `right_side`, `left_side`, `income_date`) VALUES
(1, 8032428, 0, 80, 0, 2, 1, 0, 3359801, 2305567, '2020-12-17 19:14:58'),
(2, 2305567, 8032428, 40, 0, 1, 0, 8032428, 0, 1346547, '2020-12-17 07:50:55'),
(3, 3359801, 8032428, 0, 1, 0, 0, 8032428, 0, 0, '2020-12-17 07:51:51'),
(4, 1346547, 2305567, 0, 0, 0, 0, 2305567, 0, 0, '2020-12-20 09:27:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pair_count`
--
ALTER TABLE `pair_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_wallate`
--
ALTER TABLE `user_wallate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pair_count`
--
ALTER TABLE `pair_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pin`
--
ALTER TABLE `pin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_wallate`
--
ALTER TABLE `user_wallate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
