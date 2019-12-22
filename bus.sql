-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2019 at 08:39 AM
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
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_type` varchar(30) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `user_type`) VALUES
(2, 'pattu', '49e654be128806a40728da361043a0fa', 'pattu@gmail.com', 'admin'),
(20, 'raushan', '25d55ad283aa400af464c76d713c07ad', 'raushan@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `book_detail`
--

CREATE TABLE `book_detail` (
  `seat_no` int(30) NOT NULL,
  `route_id` int(30) NOT NULL,
  `journey_date` date NOT NULL,
  `booking_date` date NOT NULL,
  `rent` int(30) NOT NULL,
  `bus_type` varchar(50) NOT NULL,
  `choice` varchar(50) NOT NULL,
  `customer_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_detail`
--

INSERT INTO `book_detail` (`seat_no`, `route_id`, `journey_date`, `booking_date`, `rent`, `bus_type`, `choice`, `customer_id`) VALUES
(1, 39, '2018-08-31', '2018-08-29', 800, 'Deluxe', 'B1,B2', 10),
(2, 41, '2018-08-31', '2018-08-29', 1000, 'Deluxe', 'A1,A2,A3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus_detail`
--

CREATE TABLE `bus_detail` (
  `bus_no` varchar(25) NOT NULL,
  `bus_type` varchar(50) NOT NULL,
  `total_seat` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL DEFAULT 'new india',
  `staus` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_detail`
--

INSERT INTO `bus_detail` (`bus_no`, `bus_type`, `total_seat`, `bus_name`, `staus`) VALUES
('BA5KA1011', 'Deluxe', 32, 'new india', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `username`, `password`, `address`, `city`, `gender`, `contact_no`, `email`) VALUES
(1, 'uttammahat', '36b8d1ef000113045261277d75b72897', 'suryabianyak', 'suryabinayak', 'male', '9813100180', 'uttammahat@gmail.com'),
(9, 'uttam', 'ccf8486cfd1f76323cb1c684b5d254fd', 'bkt', 'bkt', 'male', '9813100180', 'uttam@gmail.com'),
(10, 'ram', '4641999a7679fcaef2df0e26d11e3c72', 'bkt', 'bkt', 'male', '9843130130', 'ram@gmail.com'),
(11, 'raushan', '25f9e794323b453885f5181f1b624d0b', 'sdfs', 'delhi', 'male', '8109299136', 'raushan@monkhub.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `customer_id` int(11) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `trans_type` varchar(50) NOT NULL,
  `total_rent` int(11) NOT NULL,
  `current_phone_no` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`customer_id`, `owner_name`, `bank`, `trans_type`, `total_rent`, `current_phone_no`) VALUES
(10, 'Ram', '', 'cash', 1600, 2147483647),
(1, 'Uttam Mahat', '', 'cash', 3000, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `route_detail`
--

CREATE TABLE `route_detail` (
  `route_id` int(11) NOT NULL,
  `departure_station` varchar(50) NOT NULL,
  `arrival_station` varchar(50) NOT NULL,
  `via_station` varchar(50) NOT NULL,
  `rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_detail`
--

INSERT INTO `route_detail` (`route_id`, `departure_station`, `arrival_station`, `via_station`, `rent`) VALUES
(37, 'Delhi', 'Lakhimpur', 'Gola', 500),
(39, 'Lakhimpur', 'Delhi', 'Gola', 500);

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE `time_table` (
  `time_table_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `departure_station` varchar(50) NOT NULL,
  `arrival_station` varchar(50) NOT NULL,
  `via_station` varchar(50) NOT NULL,
  `departure_time` varchar(50) NOT NULL,
  `arrival_time` varchar(50) NOT NULL,
  `rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`time_table_id`, `route_id`, `departure_station`, `arrival_station`, `via_station`, `departure_time`, `arrival_time`, `rent`) VALUES
(1, 37, 'Delhi', 'Lakhimpur', 'Gola', '20:00', '04:00', 500),
(2, 39, 'Lakhimpur', 'Delhi', 'Gola', '19:00', '03:00', 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `book_detail`
--
ALTER TABLE `book_detail`
  ADD PRIMARY KEY (`seat_no`);

--
-- Indexes for table `bus_detail`
--
ALTER TABLE `bus_detail`
  ADD PRIMARY KEY (`bus_no`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `route_detail`
--
ALTER TABLE `route_detail`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `time_table`
--
ALTER TABLE `time_table`
  ADD PRIMARY KEY (`time_table_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `book_detail`
--
ALTER TABLE `book_detail`
  MODIFY `seat_no` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `route_detail`
--
ALTER TABLE `route_detail`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `time_table`
--
ALTER TABLE `time_table`
  MODIFY `time_table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
