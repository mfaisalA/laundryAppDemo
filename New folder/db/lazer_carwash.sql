-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 11:32 AM
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
-- Database: `lazer_carwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_contact` varchar(255) NOT NULL,
  `vehicle_brand` varchar(255) NOT NULL,
  `vehicle_model_year` varchar(255) NOT NULL,
  `vehicle_model_name` varchar(255) DEFAULT NULL,
  `car_location` text,
  `description` text,
  `_datetime` datetime NOT NULL,
  `appointment_status` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `reg_no`, `cus_name`, `cus_email`, `cus_contact`, `vehicle_brand`, `vehicle_model_year`, `vehicle_model_name`, `car_location`, `description`, `_datetime`, `appointment_status`, `status`, `created_date`) VALUES
(1, 1, 'R2564', 'Mohammad Jalal', 'fais@mail.com', '353453', 'Toyota', '2009', 'Yaris', 'buiding 450, road 321, block 576, riffa', 'Engine Heatup', '2018-07-03 12:00:00', 5, 1, '2017-09-27 15:34:25'),
(5, 2, 'R5002', 'Isa Bin Hamad', 'isa@mail.com', '36598654', 'Mazda', '2012', 'Wagon', '', 'noise coming from suspension', '2018-05-01 15:00:00', 2, 1, '2017-09-30 16:03:28'),
(6, 3, 'K8654', 'Abdullah Saleh', 'abdullah@mail.com', '36989872', 'Nissan', '2010', 'Maxima', 'buiding 20, road 321, block 576, riffa', 'Needed battery change', '2018-06-02 12:00:00', 4, 1, '2017-09-30 16:06:14'),
(10, 1, 'B7585', 'Mohammad Jalal', 'mohammad@mail.com', '369658458', 'Toyota', '2017', 'Corolla', 'buiding 450, road 321, block 576, riffa', 'failure', '2018-06-08 15:00:00', 5, 1, '2017-10-03 17:34:06'),
(11, 1, 'R8855', 'Mohammad Jalal', 'jalal@mail.com', '36524187', 'Ford', '2006', 'Mustang', NULL, NULL, '2018-06-15 02:11:00', 1, 1, '2018-06-09 11:12:02'),
(12, 1, 'A7865', 'Mohammad Jalal', 'jalal@mail.com', '36524187', 'Nissan', '2015', 'Tida', 'Riffa', NULL, '2018-06-15 15:12:00', 1, 1, '2018-06-09 12:14:49'),
(13, 1, 'L5676', 'Mohammad Jalal', 'jalal@mail.com', '36524187', 'Nissan', '2015', 'Tida', 'Riffa', NULL, '2018-06-15 15:12:00', 3, 1, '2018-06-09 12:14:56'),
(14, 1, 'H6578', 'Mohammad Jalal', 'jalal@mail.com', '36524187', 'Nissan', '2013', 'Sunny', 'Arad', NULL, '2018-06-13 16:17:00', 1, 1, '2018-06-10 10:18:36'),
(15, 1, 'G4005', 'Mohammad Jalal', 'jalal@mail.com', '36524187', 'Toyota', '2003', 'Camry', 'Riffa', NULL, '2018-06-15 10:42:00', 4, 1, '2018-06-10 10:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_services`
--

CREATE TABLE `appointment_services` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_services`
--

INSERT INTO `appointment_services` (`id`, `appointment_id`, `service_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 15, 2, 1),
(5, 15, 4, 1);

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
(1, 'Mohammad Jalal', 'jalal@mail.com', '36524187', 'falt 11, building 90H, road 980, block 997, riffa', 'jalal', '123', '2018-06-04 14:40:42'),
(2, 'Mohammad Rashid', 'rashid@mail.com', '36524187', 'villa 200,  road 520, block 997, sanad', 'rashid', '123', '2018-06-04 14:41:45'),
(3, 'Ali Asgher', 'ali@mail.com', '34589078', 'Riffa', 'ali', '123', '2018-06-06 11:23:48');

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
(2, 0, 15, '123412341234', 'Mohammad Jalal', '9.5', '2018-06-10 12:33:11', 2);

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
(1, 'Body Polish', '4.5', 1),
(2, 'Interior Polish', '5', 1),
(3, 'Tire & Wheel Polish', '3', 1),
(4, 'Steam Wash', '3.5', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_brands`
--

CREATE TABLE `vehicle_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_brands`
--

INSERT INTO `vehicle_brands` (`id`, `name`, `image`, `status`) VALUES
(1, 'Toyota', 'toyota-logo.jpg', 1),
(2, 'Nissan', 'nissan-logo.jpg', 1),
(3, 'Honda', 'honda-logo.jpg', 1),
(4, 'Kia', 'Kia-logo.jpg', 0),
(6, 'chevrolet', '69586.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model_names`
--

CREATE TABLE `vehicle_model_names` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vehicle_brand_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_model_names`
--

INSERT INTO `vehicle_model_names` (`id`, `name`, `vehicle_brand_id`, `status`) VALUES
(1, 'corrola', 1, 1),
(2, 'maxima', 2, 1),
(3, 'land cruiser', 1, 1),
(5, 'tahoe', 6, 1),
(6, 'petrol', 2, 1),
(7, 'altima', 2, 1),
(9, 'camry', 1, 1),
(10, 'civic', 3, 1),
(11, 'sunny', 2, 1),
(12, 'yaris', 1, 1),
(13, 'Accord', 3, 1);

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
-- Indexes for table `vehicle_brands`
--
ALTER TABLE `vehicle_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_model_names`
--
ALTER TABLE `vehicle_model_names`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `appointment_services`
--
ALTER TABLE `appointment_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_brands`
--
ALTER TABLE `vehicle_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_model_names`
--
ALTER TABLE `vehicle_model_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
