-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2019 at 12:24 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_sheet_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobsheet`
--

CREATE TABLE `jobsheet` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `recieving_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `model` varchar(25) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `other_things` varchar(25) NOT NULL,
  `isTempered` tinyint(1) DEFAULT '0',
  `isPhysicalDamaged` tinyint(1) DEFAULT '0',
  `isLiquidDamaged` tinyint(1) DEFAULT '0',
  `condition_of_mobile` varchar(100) NOT NULL,
  `problem_description` varchar(100) NOT NULL,
  `estimated_amount` int(10) NOT NULL,
  `isRepaired` tinyint(1) DEFAULT '0',
  `isDelivered` tinyint(1) DEFAULT '0',
  `isReturned` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_time` datetime DEFAULT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobsheet`
--

INSERT INTO `jobsheet` (`customer_id`, `customer_name`, `customer_contact`, `customer_email`, `recieving_date`, `model`, `imei`, `password`, `other_things`, `isTempered`, `isPhysicalDamaged`, `isLiquidDamaged`, `condition_of_mobile`, `problem_description`, `estimated_amount`, `isRepaired`, `isDelivered`, `isReturned`, `delivery_time`, `shop_id`) VALUES
(4, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-10 03:33:04', '123456789012345', 'Apple iPhone 6S', '0000', 'No', NULL, NULL, NULL, 'Liquid Damaged', 'Dead Recieved', 1000, 1, 1, 0, '0000-00-00 00:00:00', 8),
(5, 'Sagar Paraswal', '8878841872', 'sagar@gmail.com', '2019-04-10 03:37:18', 'Apple iPhone 6S', '123456789012345', '1234', 'Cover', NULL, NULL, NULL, 'Tempered', 'Display Issue', 2500, 0, 1, 1, '0000-00-00 00:00:00', 2),
(6, 'Mayank Valechha', '8878841872', 'mayank@email.com', '2019-04-20 01:26:21', 'Apple iPhone 6S', '123456789012345', '0000', 'No', NULL, NULL, NULL, 'Tempered', 'Display Issue', 1000, 1, 1, 1, '0000-00-00 00:00:00', 2),
(7, 'Darpan', '9893012345', 'darpan@gmail.com', '2019-04-24 00:58:31', 'Apple iPhone X', '123456654321000', '0012', 'No', 0, 0, 0, 'Ok', 'Software Issue', 350, 1, 1, 0, '0000-00-00 00:00:00', 6),
(12, 'Mayank Valechha', '9926427904', 'mayank@email.com', '2019-04-26 11:30:46', 'iPhone XR', '123456789012345', 'No', 'No', 0, 0, 0, 'Ok', 'Dead Recieved', 3000, 1, 1, 0, '0000-00-00 00:00:00', 6),
(13, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-26 11:42:02', 'Apple iPhone 6S', '123456789012345', '0000', 'No', 0, 0, 1, 'Tempered', 'Dead Recieved', 1000, 0, 1, 1, '0000-00-00 00:00:00', 6),
(14, 'Darpan', '9329377750', 'darpan@gmail.com', '2019-04-26 11:45:25', 'Apple iPhone X', '123456789012345', '0000', 'No', 0, 1, 1, 'Tempered', 'Water Damaged', 4000, 1, 1, 0, '0000-00-00 00:00:00', 6),
(15, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-27 02:42:35', 'Apple iPhone 6S', '123456789000000', '0000', 'No', 1, 1, 1, 'Ok', 'Water Damage', 1500, 1, 1, 0, '0000-00-00 00:00:00', 6),
(17, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-28 22:41:38', 'Apple iPhone 6S', '123456789012345', '0000', 'No', 0, 1, 1, 'Tempered', 'Water Damage', 1500, 1, 1, 0, '0000-00-00 00:00:00', 2),
(19, 'Lakshya Khatri', '8109300610', 'lakshak67@gmail.com', '2019-04-29 02:01:32', 'iPhone XS Max', '111111111111111', '123456', 'No', 0, 1, 0, '', 'Display Broken', 2000, 0, 1, 1, '0000-00-00 00:00:00', 2),
(21, 'Priya', '9826012345', 'priya@gmail.com', '2019-04-30 01:10:25', 'Apple iPhone 5S', '123456789012345', '123456', 'No', 0, 1, 1, 'Screw not found', 'Display Broken', 3000, 1, 1, 0, NULL, 8),
(22, 'Lakshya Khatri', '8109300610', 'mayank@email.com', '2019-04-30 01:11:24', 'Apple iPhone 6S', '123456789012345', '0000', 'No', 0, 0, 0, 'Screw not found', 'Speaker Not Working', 600, 0, 1, 1, NULL, 8),
(23, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-30 01:18:09', 'Apple iPhone 6S', '123456789012345', '0000', 'No', 0, 0, 0, 'Ok', 'Ringer Problem', 800, 0, 1, 1, NULL, 7),
(24, 'Darpan Valechha', '9754168188', 'darpan@gmail.com', '2019-04-30 01:19:44', 'Apple iPhone 7 Plus', '000000000000007', '007007', 'No', 1, 0, 0, 'Front Screw Missing, Motherboard Nets not found', 'Heating Problem', 2500, 1, 1, 0, NULL, 7),
(25, 'Sagar Valechha', '8878841872', 'sagar@gmail.com', '2019-04-30 01:21:42', 'iPhone XR', '222222222222222', '0000', 'No', 0, 1, 0, 'Dents on Body', 'Display Broken', 17000, 1, 1, 0, NULL, 7),
(26, 'Sagar Paraswal', '8878841872', 'mayank@email.com', '2019-04-30 01:36:30', 'Apple iPhone 6S', '123456789012345', '007007', 'Cover', 0, 0, 1, 'Water Damaged', 'Water Damage, Dead Recieved', 1500, 1, 1, 0, NULL, 7),
(27, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-30 01:56:44', 'Apple iPhone 6S', '123456789012345', '0012', 'No', 1, 0, 0, 'Front Screw Missing, Motherboard Nets not found', 'Water Damage, Dead Recieved', 2500, 0, 1, 1, NULL, 7),
(28, 'Sagar Paraswal', '8878841872', 'sagar@gmail.com', '2019-04-30 01:57:35', 'Apple iPhone X', '987654321012345', '1234', 'No', 0, 0, 1, 'Liquid Damaged', 'Dead Received', 6000, 0, 1, 1, NULL, 7),
(29, 'Aayushi Hardiya', '7566208885', 'aayushi@gmail.com', '2019-04-30 02:17:55', 'MI Note 5 Pro', '222222222222222', '1214', 'Black Leather Cover', 0, 1, 0, 'Ok', 'Display Glass Broken', 1900, 0, 0, 0, NULL, 7),
(30, 'Disha', '9926427904', 'disha@gmail.com', '2019-04-30 02:37:18', 'Apple iPhone 7 Plus Rose ', '333333333333333', '0000', 'Pink Cover', 0, 1, 0, 'Ok', 'Display Broken', 9000, 0, 1, 1, NULL, 2),
(31, 'Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-30 02:40:23', 'Apple iPhone 6S', '123456789012345', '123456', 'No', 1, 0, 0, 'Front Screw Missing, Motherboard Nets not found', 'Speaker Not Working', 1500, 0, 1, 1, '2019-04-30 00:00:00', 2),
(32, 'Sagar Paraswal', '8878841872', 'sagar@gmail.com', '2019-04-30 02:52:01', 'iPhone XS Max', '222222222222222', 'No', 'No', 0, 0, 0, 'Ok', 'Vibrator Issue', 1300, 0, 1, 1, '2019-04-30 02:52:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shopkeepers`
--

CREATE TABLE `shopkeepers` (
  `shop_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopkeepers`
--

INSERT INTO `shopkeepers` (`shop_id`, `name`, `address`, `email`, `contact`, `password`, `created_at`) VALUES
(1, 'CODVOW', 'Floor No 105, IT Park 3, Indore', 'help@codvow.com', '9826098260', 'e10adc3949ba59abbe56e057f20f883e', '2019-04-03 16:48:59'),
(2, 'Valechha\'s Mobile Care', 'Shop No.2 Makhija Complex, Near Bank of India, Sindhi Colony Main Road, Indore', 'help@valechha.com', '9329377750', 'e10adc3949ba59abbe56e057f20f883e', '2019-04-03 16:55:47'),
(6, 'XYZ Mobile Care', 'Floor No 3, City Center, Indore 452001', '', '9893098930', 'e10adc3949ba59abbe56e057f20f883e', '2019-04-06 13:09:59'),
(7, 'Mayank Valechha', 'Indore 452001', '', '1234567890', 'e10adc3949ba59abbe56e057f20f883e', '2019-04-10 02:29:40'),
(8, 'Mayank', 'Indore 452001', '', '9876543210', 'e10adc3949ba59abbe56e057f20f883e', '2019-04-10 02:43:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shopkeepers`
--
ALTER TABLE `shopkeepers`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobsheet`
--
ALTER TABLE `jobsheet`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `shopkeepers`
--
ALTER TABLE `shopkeepers`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD CONSTRAINT `jobsheet_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shopkeepers` (`shop_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
