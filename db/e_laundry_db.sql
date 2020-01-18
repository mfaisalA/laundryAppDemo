-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 01:45 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_laundry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_contact` varchar(255) NOT NULL,
  `location` text,
  `additional_instructions` text,
  `_datetime` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `delivery_type` varchar(255) NOT NULL DEFAULT 'normal',
  `payment_type` varchar(255) NOT NULL DEFAULT 'Cash On Delivery',
  `total_amount` varchar(255) NOT NULL DEFAULT '0',
  `appointment_status` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `cus_name`, `cus_email`, `cus_contact`, `location`, `additional_instructions`, `_datetime`, `delivery_date`, `delivery_type`, `payment_type`, `total_amount`, `appointment_status`, `status`, `created_date`) VALUES
(20, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-06-27 00:00:00', '2018-06-28 00:00:00', 'urgent', 'Cash On Delivery', '1.680', 1, 1, '2018-06-26 12:36:39'),
(21, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-06-21 00:00:00', '2018-06-23 00:00:00', 'normal', 'Cash On Delivery', '1.1', 4, 1, '2018-06-20 12:38:53'),
(22, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-06-30 00:00:00', '2018-07-03 00:00:00', 'normal', 'Cash On Delivery', '1.6', 2, 1, '2018-06-20 12:50:48'),
(23, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-07-10 00:00:00', '2018-07-13 00:00:00', 'normal', 'Cash On Delivery', '0.9', 1, 1, '2018-07-02 13:07:15'),
(24, 2, 'Mohammad Rashid', 'rashid@mail.com', '36524187', 'villa 200,  road 520, block 997, sanad', NULL, '2018-06-21 13:11:00', '2018-06-24 13:11:00', 'normal', 'Cash On Delivery', '0.4', 4, 1, '2018-06-20 13:13:17'),
(25, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-06-30 12:12:00', '2018-07-03 12:12:00', 'normal', 'Cash On Delivery', '1.5', 1, 1, '2018-06-25 12:18:53'),
(26, 1, 'Saleh Al Bashar', 'saleh@mail.com', '36524187', 'Flat 11, building 90H, road 980, block 997, riffa', NULL, '2018-07-17 11:02:00', '2018-07-20 11:02:00', 'normal', 'Cash On Delivery', '1.700', 1, 1, '2018-07-09 11:04:29'),
(27, 1, 'Saleh Al Bashar', 'saleh@mail.com', '36524187', 'Flat 11, building 90H, road 980, block 997, riffa', NULL, '2018-07-31 13:18:00', '2018-08-03 13:18:00', 'normal', 'Cash On Delivery', '2.200', 1, 1, '2018-07-09 11:19:29'),
(28, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-07-26 16:51:00', '2018-07-29 16:51:00', 'normal', 'Cash On Delivery', '3.900', 2, 1, '2018-07-09 15:54:52'),
(29, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-08-31 12:23:00', '2018-09-03 12:23:00', 'normal', 'Cash On Delivery', '1.200', 1, 1, '2018-08-01 12:24:47'),
(30, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-08-31 12:52:00', '2018-09-03 12:52:00', 'normal', 'Cash On Delivery', '0.400', 1, 1, '2018-08-01 12:53:32'),
(31, 3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', NULL, '2018-08-31 12:52:00', '2018-09-03 12:52:00', 'normal', 'Cash On Delivery', '0.400', 1, 1, '2018-08-01 12:55:29'),
(32, 1, 'Saleh Al Bashar', 'saleh@mail.com', '36524187', 'Flat 11, building 90H, road 980, block 997, riffa', NULL, '2018-08-30 13:00:00', '2018-09-02 13:00:00', 'normal', 'Cash On Delivery', '1.000', 1, 1, '2018-08-01 13:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_services`
--

CREATE TABLE `appointment_services` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_services`
--

INSERT INTO `appointment_services` (`id`, `appointment_id`, `service_id`, `qty`, `status`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 1),
(3, 1, 3, 1, 1),
(4, 15, 2, 1, 1),
(5, 15, 4, 1, 1),
(6, 6, 3, 1, 1),
(7, 10, 1, 1, 1),
(8, 10, 2, 1, 1),
(9, 11, 1, 1, 1),
(10, 11, 2, 1, 1),
(11, 12, 1, 1, 1),
(12, 12, 2, 1, 1),
(13, 13, 1, 1, 1),
(14, 14, 2, 1, 1),
(15, 14, 1, 1, 1),
(16, 14, 2, 1, 1),
(17, 16, 2, 1, 1),
(18, 16, 6, 1, 1),
(19, 17, 1, 3, 1),
(20, 17, 3, 1, 1),
(21, 17, 4, 1, 1),
(22, 17, 7, 2, 1),
(23, 18, 1, 2, 1),
(24, 18, 3, 1, 1),
(25, 18, 7, 1, 1),
(26, 19, 2, 2, 1),
(27, 19, 1, 2, 1),
(28, 19, 5, 1, 1),
(29, 19, 4, 3, 1),
(30, 20, 5, 1, 1),
(31, 21, 1, 2, 1),
(32, 21, 3, 1, 1),
(33, 22, 2, 2, 1),
(34, 22, 6, 2, 1),
(35, 22, 1, 1, 1),
(36, 23, 2, 2, 1),
(37, 23, 6, 1, 1),
(38, 24, 1, 2, 1),
(39, 25, 1, 1, 1),
(40, 25, 5, 1, 1),
(41, 25, 3, 1, 1),
(42, 25, 1, 1, 1),
(43, 25, 5, 1, 1),
(44, 25, 3, 1, 1),
(45, 26, 1, 2, 1),
(46, 26, 3, 1, 1),
(47, 27, 1, 3, 1),
(48, 27, 5, 2, 1),
(49, 27, 4, 2, 1),
(50, 28, 5, 3, 1),
(51, 28, 3, 3, 1),
(52, 29, 6, 2, 1),
(53, 29, 1, 1, 1),
(54, 30, 2, 2, 1),
(55, 31, 2, 2, 1),
(56, 32, 6, 2, 1),
(57, 32, 6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area_code` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `area_code`, `status`) VALUES
(1, 'Manama', 'mnm', 1),
(2, 'Riffa', 'rfa', 1),
(3, 'Muharraq', 'mhr', 1),
(4, 'Hamad Town', 'hmt', 1),
(5, 'A\'ali', 'aal', 1),
(6, 'Isa Town', 'ist', 1),
(7, 'Sitra', 'str', 1),
(8, 'Budaiya', 'bdy', 1),
(9, 'Adliya', 'adl', 1),
(10, 'Jidhafs', 'jdf', 1),
(11, 'Seef', 'adl', 1),
(12, 'Hidd', 'jdf', 1),
(13, 'Arad', 'ard', 1),
(14, 'Jurdab', 'jrd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `complaint` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `email`, `contact`, `complaint`, `status`, `created_date`) VALUES
(1, 'Rashid AlAtawi', 'rashid@mail.com', '34589899', 'Still did not receive my laundry it has been more than 2 days', 1, '2018-08-01 14:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `contact`, `address`, `username`, `password`, `created_date`) VALUES
(1, 'Saleh Al Bashar', 'saleh@mail.com', '36524187', 'Flat 11, building 90H, road 980, block 997, riffa', 'saleh', '123', '2018-06-04 14:40:42'),
(2, 'Mohammad Rashid', 'rashid@mail.com', '36524187', 'villa 200,  road 520, block 997, sanad', 'rashid', '123', '2018-06-04 14:41:45'),
(3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Flat 52, building 525, road 680, block 997, riffa', 'ali', '123', '2018-06-06 11:23:48'),
(4, 'hoora', 'hoora@mail.com', '36945455', 'riffa', 'hoora', '123', '2018-07-09 15:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `appointment_id`, `card_number`, `name`, `amount`, `created_date`, `status`) VALUES
(1, 1, 5, '', '', '10', '2018-06-04 14:28:20', 1),
(2, 0, 15, '123412341234', 'Mohammad Jalal', '9.5', '2018-06-10 12:33:11', 2),
(3, 0, 24, '', '', '0.2', '2018-06-20 13:14:23', 1),
(4, 0, 21, '', '', '1', '2018-06-20 14:55:40', 1),
(5, 0, 22, '', '', '0.8999999999999999', '2018-06-25 12:15:48', 1),
(6, 0, 28, '', '', '1.3', '2018-07-09 15:57:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `charges` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `charges`, `status`) VALUES
(1, 'Shirt Wash', '.2', 1),
(2, 'Pants Wash', '.2', 1),
(3, 'Suit Wash & Iron', '.8', 1),
(4, 'Thawb Wash', '.3', 1),
(5, 'Shirt Wash & Iron', '.5', 1),
(6, 'Pants Wash & Iron', '.5', 1),
(7, 'Thawb Wash & Iron', '0.7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`, `created_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2017-09-27 14:58:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_services`
--
ALTER TABLE `appointment_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `appointment_services`
--
ALTER TABLE `appointment_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
