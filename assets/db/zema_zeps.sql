-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2023 at 03:33 PM
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
-- Database: `zema_zeps`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_status`
--

CREATE TABLE `app_status` (
  `app_status_id` int(11) NOT NULL,
  `app_status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_status`
--

INSERT INTO `app_status` (`app_status_id`, `app_status_name`) VALUES
(4, 'Completed'),
(2, 'Incomplete'),
(1, 'Pending'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `client_log`
--

CREATE TABLE `client_log` (
  `Log_ID` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `Login_Time` datetime NOT NULL,
  `Logout_Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_type`
--

CREATE TABLE `id_type` (
  `id_type_id` int(11) NOT NULL,
  `id_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iron_permit`
--

CREATE TABLE `iron_permit` (
  `ip_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `permit_name` varchar(100) NOT NULL DEFAULT 'Iron Scraper Application ',
  `address_of_office` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `type_of_iron` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `date_of_arrival` varchar(255) DEFAULT NULL,
  `place_of_storage` varchar(255) DEFAULT NULL,
  `duration_of_storage` varchar(255) DEFAULT NULL,
  `uses` varchar(255) DEFAULT NULL,
  `duration_of_uses` varchar(255) DEFAULT NULL,
  `amount_disposed` float DEFAULT NULL,
  `disposal_date` varchar(255) DEFAULT NULL,
  `app_status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plastic_permit`
--

CREATE TABLE `plastic_permit` (
  `plastic_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `app_name` varchar(20) NOT NULL DEFAULT 'Plastic Application',
  `app_date` date NOT NULL,
  `type_of_plastic` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `date_of_arrival` varchar(255) DEFAULT NULL,
  `place_of_storage` varchar(255) DEFAULT NULL,
  `duration_of_storage` varchar(255) DEFAULT NULL,
  `uses` varchar(255) DEFAULT NULL,
  `duration_of_uses` varchar(255) DEFAULT NULL,
  `amount_disposed` int(11) DEFAULT NULL,
  `disposal_date` varchar(255) DEFAULT NULL,
  `app_status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plastic_permit`
--

INSERT INTO `plastic_permit` (`plastic_id`, `vendor_id`, `app_name`, `app_date`, `type_of_plastic`, `reason`, `amount`, `size`, `date_of_arrival`, `place_of_storage`, `duration_of_storage`, `uses`, `duration_of_uses`, `amount_disposed`, `disposal_date`, `app_status_id`) VALUES
(1, 15, 'Plastic Application', '2023-09-13', 'i', 'ii', 88, '8', '2023-08-28', '8', '77', '888', '8', 8, '2023-08-28', 1),
(2, 16, 'Plastic Application', '2023-09-13', '8', '8', 8, '8', '2023-08-28', '88', '8', 'iii', '88', 8, '2023-08-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_client`
--

CREATE TABLE `tb_client` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `id_type_id` varchar(255) DEFAULT NULL,
  `id_number` int(11) NOT NULL,
  `id_photo` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_client`
--

INSERT INTO `tb_client` (`client_id`, `first_name`, `middle_name`, `last_name`, `address`, `email`, `phone_number`, `nationality`, `id_type_id`, `id_number`, `id_photo`, `profile_photo`, `username`, `password`, `position`) VALUES
(4, 'Usama', '', 'Talib', '', 'hatari@gmao.com', 0, 'Tanzanian', 'national-id', 0, 'super.admin-national-id.png', 'super.admin-Prof.png', 'super.admin', '$2y$10$7kAhzerfTFQxpqJHo6zoaujt56Ytqj8jNjBqHHl5fv1GgIr9FHq0m', ''),
(5, 'Usama', '', 'Talib', '', 'hatari@gmao.com', 0, 'Tanzanian', 'national-id', 0, 'super.admin-national-id.png', 'super.admin-Prof.png', 'super.admin', '$2y$10$v1hMes0sd2uDn1v47PEfo.3H8d2bl9rKwSJjRVizG8.V.wGwTLkgy', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `position` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_vendor`
--

CREATE TABLE `tb_vendor` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `id_type_id` int(11) NOT NULL,
  `id_photo` varchar(255) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_no` int(255) NOT NULL,
  `role_in_office` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_vendor`
--

INSERT INTO `tb_vendor` (`vendor_id`, `first_name`, `middle_name`, `last_name`, `address`, `phone_number`, `email`, `nationality`, `id_type_id`, `id_photo`, `office_address`, `contact_person_name`, `contact_person_no`, `role_in_office`) VALUES
(2, '6', '6', '6', '6', 6, 'mamenmsau@gmail.com', '6', 1, 'phoyto', '6', '66', 6, '6'),
(3, '6', '6', '6', '6', 6, 'mamenmsau@gmail.com', '6', 1, 'phoyto', '6', '66', 6, '6'),
(4, 'i', 'i', 'i', 'i', 444, 'mamenmsau@gmail.com', 'i', 1, 'phoyto', 'sasa', '99', 88, 'sasa'),
(5, 'i', 'i', 'i', 'i', 444, 'mamenmsau@gmail.com', 'i', 1, 'phoyto', 'sasa', '99', 88, 'sasa'),
(6, 'ii', 'i', 'i', 'ii', 88, 'mamenmsau@gmail.com', 'i', 1, 'phoyto', 'i', 'i', 333, 'i'),
(7, 'ii', 'i', 'i', 'ii', 88, 'mamenmsau@gmail.com', 'i', 1, 'phoyto', 'i', 'i', 333, 'i'),
(8, '8', 'i', 'ii', 'i', 8, 'mamenmsau@gmail.com', 'i', 1, 'phoyto', '8', 'i', 88, '8'),
(9, '7', '7', '7', '7', 7, 'mamenmsau@gmail.com', '77', 1, 'phoyto', '7', '7', 7, '7'),
(10, '7', '7', '7', '7', 7, 'mamenmsau@gmail.com', '77', 1, 'phoyto', '7', '7', 7, '7'),
(11, '7', '7', '7', '7', 7, 'mamenmsau@gmail.com', '77', 1, 'phoyto', '7', '7', 7, '7'),
(12, '7', '7', '7', '7', 7, 'mamenmsau@gmail.com', '77', 1, 'phoyto', '7', '7', 7, '7'),
(13, '7', '7', '7', '7', 7, 'mamenmsau@gmail.com', '77', 1, 'phoyto', '7', '7', 7, '7'),
(14, 'i', '88', '8', '8', 8, 'mamenmsau@gmail.com', '8', 1, 'phoyto', '8', '8', 88, '8'),
(15, '7', '7', '7', '7', 77, 'mamenmsau@gmail.com', '7', 1, 'phoyto', '7', '77', 7, '7'),
(16, '8', '8', '8', '8', 8, 'mamenmsau@gmail.com', '8', 1, 'phoyto', '8', '8', 8, '8');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `Log_ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Login_Time` datetime NOT NULL,
  `Logout_Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_status`
--
ALTER TABLE `app_status`
  ADD PRIMARY KEY (`app_status_id`),
  ADD KEY `pp_id` (`app_status_name`);

--
-- Indexes for table `client_log`
--
ALTER TABLE `client_log`
  ADD KEY `client_logs` (`client_id`);

--
-- Indexes for table `iron_permit`
--
ALTER TABLE `iron_permit`
  ADD PRIMARY KEY (`ip_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `plastic_permit`
--
ALTER TABLE `plastic_permit`
  ADD PRIMARY KEY (`plastic_id`),
  ADD KEY `client_id` (`vendor_id`),
  ADD KEY `plastic_status` (`app_status_id`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD KEY `user_logs` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_status`
--
ALTER TABLE `app_status`
  MODIFY `app_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plastic_permit`
--
ALTER TABLE `plastic_permit`
  MODIFY `plastic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_client`
--
ALTER TABLE `tb_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_log`
--
ALTER TABLE `client_log`
  ADD CONSTRAINT `client_logs` FOREIGN KEY (`client_id`) REFERENCES `tb_client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plastic_permit`
--
ALTER TABLE `plastic_permit`
  ADD CONSTRAINT `plastic_status` FOREIGN KEY (`app_status_id`) REFERENCES `app_status` (`app_status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_logs` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
