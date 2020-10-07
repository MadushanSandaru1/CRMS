-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2020 at 05:09 AM
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
-- Database: `abhaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` char(12) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `posting_date` datetime NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nic_copy` varchar(255) NOT NULL,
  `license_copy` varchar(255) NOT NULL,
  `light_bill_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_message`
--

INSERT INTO `customer_message` (`id`, `name`, `email`, `subject`, `message`, `received_time`, `is_replied`) VALUES
(1, 'Test Message', 'madushansandaru1@gmail.com', '0771637551', 'For how many persons I can make a reservation? Are bookings for groups possible online?', '2020-06-09 08:34:18', 1),
(3, 'Madushan', 'tg2017233@gmail.com', 'Testing', 'Test message', '2020-10-04 03:33:59', 0),
(4, 'aa', 'tg211@gg.vjuj', 'aaa', 'aaaaaaaaaaaaaaaa', '2020-10-04 04:07:37', 0),
(5, 'addd', 'Jhuh@gmail.com', 'hjh', 'jhihji', '2020-10-04 04:10:16', 0),
(6, 'wsjakhbn', 'ggg@hhh.bjj', 'hjnh', 'joihjio', '2020-10-04 04:14:29', 0),
(7, 'mashan', 'mashan@gm.com', 'mash', 'mashan sanda', '2020-10-04 04:19:01', 0),
(8, 'Madushan Sandaruwan', 'sandaru1wgm@gmail.com', 'Testing', 'This is a Test message', '2020-10-04 04:32:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `damage`
--

DROP TABLE IF EXISTS `damage`;
CREATE TABLE IF NOT EXISTS `damage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `reserved_id` int(11) NOT NULL,
  `fix_amount` float NOT NULL,
  `is_solved` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gps_track`
--

DROP TABLE IF EXISTS `gps_track`;
CREATE TABLE IF NOT EXISTS `gps_track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT current_timestamp(),
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `license_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

DROP TABLE IF EXISTS `reserved`;
CREATE TABLE IF NOT EXISTS `reserved` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` char(12) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `start_meter_value` float NOT NULL,
  `stop_meter_value` float NOT NULL,
  `advance_payment` float NOT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `phone` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` char(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `title`, `registered_number`, `seat`, `fuel_type`, `ac`, `transmission`, `image`, `price_per_day`, `additional_price_per_km`, `additional_price_per_hour`, `system_registered_date`, `insurence_date`, `revenue_license_date`, `is_service_out`, `is_deleted`) VALUES
(1, 'Toyota Prius hybrid 3rd generation', 'SP KW 4512', 4, 'P', 1, 'A', 'car.jpg', 5000, 20, 200, '2020-10-04', '2020-09-26', '2020-09-26', 0, 0),
(2, 'Toyota Prius hybrid 1rd generation', 'SP KP 4512', 4, 'P', 1, 'A', 'car.jpg', 4500, 20, 200, '2018-10-04', '2019-09-26', '2019-09-26', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
