-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2020 at 04:03 AM
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
  `customer_nic` char(12) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `posting_date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_nic`, `vehicle_id`, `from_date`, `to_date`, `posting_date`, `message`, `status`, `is_deleted`) VALUES
(1, '980171329V', 2, '2020-11-19 00:00:00', '2020-11-20 00:00:00', '2020-11-12 00:00:00', 'Testing message', 0, 0);

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
  `light_bill_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `nic`, `email`, `phone`, `address`, `image`, `nic_copy`, `license_copy`, `light_bill_copy`, `is_deleted`) VALUES
(1, 'Sandun Maduwantha', '852145631V', 'sandun@gmail.com', '0774125896', 'Kamburupitiya, Matara', 'user1.jpg', 'nic1.jpg', 'license1.jpg', 'bill1.jpg', 0),
(2, 'Sagara Madushanka', '752360210V', 'sagara@gmail.com', '0785403102', 'Kamburupitiya, Matara', 'user1.jpg', 'nic1.jpg', 'license1.jpg', 'bill1.jpg', 0),
(3, 'Chanaka Priyantha', '885412365V', 'chamara@gmail.com', '0721542039', 'Akuressa, Matara', 'user1.jpg', 'nic1.jpg', 'license1.jpg', 'bill1.jpg', 0),
(4, 'Nipun Upekshaka', '995210364V', 'nipun@gmail.com', '0742531024', 'Thangalla, Matara', 'user1.jpg', 'nic1.jpg', 'license1.jpg', 'bill1.jpg', 0),
(5, 'Prasad Ukwaththage', '752360210V', 'prasad@gmail.com', '0785403102', 'Kamburupitiya, Matara', 'user1.jpg', 'nic1.jpg', 'license1.jpg', 'bill1.jpg', 0),
(6, 'Peter bSirimewan', '885412365V', 'chamara@gmail.com', '0721542039', 'Akuressa, Matara', 'user1.jpg', 'nic1.jpg', 'license1.jpg', 'bill1.jpg', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_message`
--

INSERT INTO `customer_message` (`id`, `name`, `email`, `subject`, `message`, `received_time`, `is_replied`) VALUES
(1, 'Senevirathna', 'sene@gmail.com', 'Testing 1', 'This is a testing 1 message', '2020-10-20 07:25:32', 0),
(11, 'Ravindu Mihiranga', 'ravi@gmail.com', 'Testing 2 message', 'This is a testing 2 message from ravindu.', '2020-11-11 07:25:32', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damage`
--

INSERT INTO `damage` (`id`, `vehicle_id`, `description`, `date`, `image`, `reserved_id`, `fix_amount`, `is_solved`, `is_deleted`) VALUES
(1, 2, 'Window cracked', '2020-11-02', 'crack.jpg', 1, 5000, 1, 0),
(2, 1, 'Window cracked', '2020-10-20', 'crack.jpg', 2, 7500, 0, 0);

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

--
-- Dumping data for table `gps_track`
--

INSERT INTO `gps_track` (`id`, `vehicle_id`, `track_time`, `track_lng`, `track_lat`, `is_deleted`) VALUES
(1, 1, '2020-11-12 09:12:11', '6.047501', '80.733408', 0);

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
  `nic_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guarantor`
--

INSERT INTO `guarantor` (`id`, `reserved_id`, `name`, `nic`, `phone`, `address`, `nic_copy`, `is_deleted`) VALUES
(1, 1, 'Bandara', '854126350V', 785412365, 'Beliatta, Matara', 'license1.jpg', 0);

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
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nic_copy` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outsourcing_supplier`
--

INSERT INTO `outsourcing_supplier` (`id`, `name`, `nic`, `email`, `phone`, `address`, `nic_copy`, `is_deleted`) VALUES
(1, 'Wanigasekara', '756984120V', 'wanige@gmail.com', 741745825, 'Beliatte, Matara', 'nic.jpg', 0);

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

--
-- Dumping data for table `outsourcing_vehicle`
--

INSERT INTO `outsourcing_vehicle` (`id`, `supplier_id`, `title`, `registered_number`, `seat`, `fuel_type`, `ac`, `transmission`, `image`, `price_per_day`, `additional_price_per_km`, `additional_price_per_hour`, `system_registered_date`, `insurence_date`, `revenue_license_date`, `is_service_out`, `is_deleted`) VALUES
(1, 1, 'Toyota Prius hybrid 3rd generation', 'SP KW 4512', 4, 'P', 1, 'A', 'car.jpg', 5000, 20, 200, '2020-10-04', '2020-09-26', '2020-09-26', 0, 0),
(2, 1, 'Toyota Prius hybrid 1rd generation', 'SP KP 4512', 4, 'P', 1, 'A', 'car.jpg', 4500, 20, 200, '2018-10-04', '2019-09-26', '2019-09-26', 0, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`id`, `customer_id`, `vehicle_id`, `from_date`, `to_date`, `start_meter_value`, `stop_meter_value`, `advance_payment`, `is_returned`, `is_deleted`) VALUES
(1, 1, 2, '2020-11-10 08:35:00', '2020-11-11 13:20:00', 850, NULL, 2500, 0, 0),
(2, 3, 1, '2020-10-25 08:35:00', '2020-10-26 13:20:00', 8420, 8700, 0, 1, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `vehicle_id`, `type`, `date`, `amount`) VALUES
(1, 2, 'I', '2020-11-10 08:35:00', 2500),
(2, 1, 'I', '2020-10-26 00:00:00', 10000);

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
('ADM001', 'Abhaya', '980171329V', 'admin@abhaya.com', '771637551', 'Beliatta', 'user2.jpg', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0),
('CSR001', 'Test Cashier', '980171329V', 'cashier@abhaya.com', '771637551', 'Matara', 'user1.jpg', 'cashier', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0),
('CSR002', 'Test Cashier 1', '980171329V', 'cashier1@abhaya.com', '771637551', 'Thangalla', 'user3.jpg', 'cashier', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `title`, `registered_number`, `seat`, `fuel_type`, `ac`, `transmission`, `image`, `price_per_day`, `additional_price_per_km`, `additional_price_per_hour`, `system_registered_date`, `insurence_date`, `revenue_license_date`, `is_service_out`, `is_deleted`) VALUES
(1, 'Toyota Prius hybrid 3rd generation', 'SP KW 4512', 4, 'P', 1, 'A', 'car.jpg', 5000, 20, 200, '2020-09-23', '2020-08-10', '2020-08-15', 0, 0),
(2, 'Toyota Prius hybrid 1rd generation', 'SP KP 4512', 4, 'P', 1, 'A', 'car.jpg', 4500, 20, 200, '2018-10-04', '2019-09-20', '2019-09-26', 0, 0),
(3, 'Honda Vezel 2017', 'SP CAV 8512', 5, 'D', 1, 'A', 'car.jpg', 5000, 50, 250, '2019-01-04', '2020-11-02', '2020-11-10', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
