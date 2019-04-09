-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 12:07 AM
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
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `recieving_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `brand` varchar(50) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `model` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `other_things` varchar(25) NOT NULL,
  `condition_of_mobile` varchar(100) NOT NULL,
  `problem_description` varchar(100) NOT NULL,
  `estimated_amount` varchar(10) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobsheet`
--

INSERT INTO `jobsheet` (`customer_name`, `customer_contact`, `customer_email`, `recieving_date`, `brand`, `imei`, `model`, `password`, `other_things`, `condition_of_mobile`, `problem_description`, `estimated_amount`, `shop_id`) VALUES
('', '', '', '2019-04-10 03:29:11', '', '', '', '', '', '', '', '', 8),
('', '', '', '2019-04-10 03:29:15', '', '', '', '', '', '', '', '', 8),
('Mayank Valechha', '', '', '2019-04-10 03:32:51', '', '', '', '', '', '', '', '', 8),
('Mayank Valechha', '9329377750', 'mayank@email.com', '2019-04-10 03:33:04', '', 'Apple iPhone 6S', '123456789012345', '0000', 'No', 'Liquid Damaged', 'Dead Recieved', '1000', 8),
('Sagar Paraswal', '8878841872', 'sagar@gmail.com', '2019-04-10 03:37:18', '', 'Apple iPhone 6S', '123456789000000', '1234', 'Cover', 'Tempered', 'Display Issue', '3000', 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `totaljobsheet`
--

CREATE TABLE `totaljobsheet` (
  `total_jobsheets` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shopkeepers`
--
ALTER TABLE `shopkeepers`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `totaljobsheet`
--
ALTER TABLE `totaljobsheet`
  ADD KEY `shop_id` (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopkeepers`
--
ALTER TABLE `shopkeepers`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD CONSTRAINT `jobsheet_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shopkeepers` (`shop_id`);

--
-- Constraints for table `totaljobsheet`
--
ALTER TABLE `totaljobsheet`
  ADD CONSTRAINT `totaljobsheet_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shopkeepers` (`shop_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
