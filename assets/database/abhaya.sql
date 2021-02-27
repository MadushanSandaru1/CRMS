-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2021 at 03:26 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abhaya1`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_nic` char(12) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` char(10) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `posting_date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_nic`, `customer_name`, `customer_email`, `customer_phone`, `vehicle_id`, `from_date`, `to_date`, `posting_date`, `message`, `status`, `is_deleted`) VALUES
(7, '199825634125', 'Hiruni Weerasinghe', 'sandaru1@gmail.com', '0768541230', 10, '2021-01-22 08:45:00', '2021-01-23 08:45:00', '2021-01-21 08:16:00', 'Test message', 0, 0),
(6, '823654123V', 'Madura Wanniarachchi', 'tg2017233@gmail.com', '0725641230', 10, '2021-01-26 08:45:00', '2021-01-28 08:45:00', '2021-01-21 03:16:00', 'Test message', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nic` char(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nic_copy` varchar(255) NOT NULL,
  `license_copy` varchar(255) NOT NULL,
  `light_bill_copy` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `nic`, `email`, `phone`, `address`, `image`, `nic_copy`, `license_copy`, `light_bill_copy`, `is_deleted`) VALUES
(2, 'Nisal Perera', '189014589653', 'lahirusampath8899@gmail.com', '0715236485', 'Kaluthara', '1212dcf6219515a60862645abd903ee0.png', 'f0993cf66a317181a51e933d28d2582d.jpg', 'b629b468dc69d2cf5e366bde1e8e7cde.jpg', NULL, 0),
(3, 'Chamari Alwis', '925634127V', 'lahirusampath3366@gmail.com', '0785241365', 'Ampara', '1212dcf6219515a60862645abd903ee0.png', 'f0993cf66a317181a51e933d28d2582d.jpg', 'b629b468dc69d2cf5e366bde1e8e7cde.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_message`
--

DROP TABLE IF EXISTS `customer_message`;
CREATE TABLE IF NOT EXISTS `customer_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `received_time` datetime NOT NULL DEFAULT current_timestamp(),
  `is_replied` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_message`
--

INSERT INTO `customer_message` (`id`, `name`, `email`, `subject`, `message`, `received_time`, `is_replied`) VALUES
(1, 'Pubudu Wanigasekara', 'lahirusampath8899@gmail.com', 'Testing', 'This is a test message', '2021-01-21 07:53:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `damage`
--

DROP TABLE IF EXISTS `damage`;
CREATE TABLE IF NOT EXISTS `damage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `d_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `reserved_id` int(11) NOT NULL,
  `fix_amount` float NOT NULL,
  `is_solved` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gps_track`
--

DROP TABLE IF EXISTS `gps_track`;
CREATE TABLE IF NOT EXISTS `gps_track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT current_timestamp(),
  `track_lng` decimal(11,6) NOT NULL,
  `track_lat` decimal(11,6) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guarantor`
--

DROP TABLE IF EXISTS `guarantor`;
CREATE TABLE IF NOT EXISTS `guarantor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reserved_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nic` char(12) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nic_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outsourcing_supplier`
--

DROP TABLE IF EXISTS `outsourcing_supplier`;
CREATE TABLE IF NOT EXISTS `outsourcing_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nic` char(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nic_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outsourcing_vehicle`
--

DROP TABLE IF EXISTS `outsourcing_vehicle`;
CREATE TABLE IF NOT EXISTS `outsourcing_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `registered_number` varchar(15) NOT NULL,
  `seat` int(11) NOT NULL,
  `fuel_type` char(1) NOT NULL,
  `ac` tinyint(1) NOT NULL DEFAULT 0,
  `transmission` char(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price_per_day` float NOT NULL,
  `additional_price_per_km` float NOT NULL,
  `additional_price_per_hour` float NOT NULL,
  `system_registered_date` date NOT NULL,
  `insurence_date` date NOT NULL,
  `revenue_license_date` date NOT NULL,
  `is_service_out` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

DROP TABLE IF EXISTS `reserved`;
CREATE TABLE IF NOT EXISTS `reserved` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `start_meter_value` float NOT NULL,
  `stop_meter_value` float DEFAULT NULL,
  `advance_payment` float NOT NULL DEFAULT 0,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`id`, `customer_id`, `vehicle_id`, `from_date`, `to_date`, `start_meter_value`, `stop_meter_value`, `advance_payment`, `is_returned`, `is_deleted`) VALUES
(11, 3, 9, '2021-01-21 08:43:00', '2021-01-23 08:44:00', 1230, NULL, 5000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `vehicle_id`, `type`, `date`, `amount`) VALUES
(23, 9, 'E', '2021-01-21 08:47:00', 1520),
(22, 9, 'I', '2021-01-21 08:44:00', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` char(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nic` char(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` char(7) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `nic`, `email`, `phone`, `address`, `image`, `role`, `password`, `is_deleted`) VALUES
('2', 'Hashan Bandara', '199236547895', 'lahirusampath8899@gmail.com', '0712541203', 'No 23/01, Wincent Road, Beliatta, Matara.', 'cashier.jpg', 'cashier', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0),
('1', 'Admin Abhaya', '982365412V', 'lahirusampath8899@gmail.com', '0771524369', 'No 23/01, Wincent Road, Beliatta, Matara.', 'admin.jpg', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `registered_number` varchar(15) NOT NULL,
  `seat` int(11) NOT NULL,
  `fuel_type` char(1) NOT NULL,
  `ac` tinyint(1) NOT NULL DEFAULT 0,
  `transmission` char(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price_per_day` float NOT NULL,
  `additional_price_per_km` float NOT NULL,
  `additional_price_per_hour` float NOT NULL,
  `system_registered_date` date NOT NULL,
  `insurence_date` date NOT NULL,
  `revenue_license_date` date NOT NULL,
  `is_service_out` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `title`, `registered_number`, `seat`, `fuel_type`, `ac`, `transmission`, `image`, `price_per_day`, `additional_price_per_km`, `additional_price_per_hour`, `system_registered_date`, `insurence_date`, `revenue_license_date`, `is_service_out`, `is_deleted`) VALUES
(11, 'Test Type', 'SP KW4512', 6, 'D', 0, 'M', 'v6.jpg', 1420, 75, 90, '2021-01-21', '2021-01-21', '2021-01-21', 0, 0),
(10, 'Toyota Yaris Or Similar', 'SP KS1012', 4, 'P', 0, 'M', 'v7.png', 1850, 100, 80, '2021-01-21', '2020-01-18', '2020-01-18', 0, 0),
(9, 'Mitsubishi Eclipse Cross Or Similar', 'SP CAV8512', 4, 'D', 1, 'A', 'v9.jpg', 2500, 150, 100, '2021-01-21', '2020-08-04', '2020-08-04', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
