-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 02:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--
CREATE DATABASE IF NOT EXISTS `grocery` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `grocery`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `name`, `emailid`, `password`) VALUES
(1, 'himani', 'himaniaasoda1999@gmail.com', 8814);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cid` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `name`, `parent_id`) VALUES
(1, 'grocery', 0),
(2, 'Personal care', 0),
(3, 'home care', 0),
(4, 'Vegetable', 0),
(5, 'masala and spice', 1),
(6, 'oil rice', 1),
(7, 'pluses', 1),
(8, 'Cereal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ord`
--

DROP TABLE IF EXISTS `ord`;
CREATE TABLE `ord` (
  `oid` int(10) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `date` datetime(6) DEFAULT NULL,
  `quntity` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `payid` int(10) NOT NULL,
  `total amount` int(20) DEFAULT NULL,
  `paymenttype` varchar(50) DEFAULT NULL,
  `oid` int(10) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `pid` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `price`, `discount`, `weight`, `pic`, `cid`) VALUES
(1, 'diswash vim jell', 50, 10, NULL, 'images/17.png', 3),
(2, 'vim bar', 14, 10, '200gm', 'images/18.png', 3),
(3, 'Fortune Sunflower Oil', 400, 10, ' 5 Ltr', 'images/1.png', 6),
(4, 'meggimasla', 2, 0, '(2gm)', 'images/meggi.jpg', 5),
(5, 'Jeggry', 50, 55, '(1 kg)', 'images/j2.jpg', 6),
(6, 'rice', 500, 0, '(5kg)', 'images/rice2.jpg', 6),
(7, 'mili tea', 85, 90, '(250gm)', 'images/m4.jpg', 6),
(8, 'Wagbakri tea', 95, 10, '(250gm)', 'images/w.jpg', 6),
(9, 'suger', 40, 42, '(1kg)', 'images/s.jpg', 6),
(10, 'sing dana', 20, 25, '(250gm)', 'images/so2.jpg', 6),
(11, 'suger', 40, 0, '(1 kg)', 'images/s3.jpg', 6),
(12, 'Mungdal', 50, 55, '(500 gm)', 'images/mu.jpg', 7),
(13, 'Tuver dal', 100, 10, '(1kg)', 'images/tuver.jpg', 7),
(14, 'Mag Mogar dal', 50, 60, '(500 gm)', 'images/mungf.jpg', 7),
(15, 'Urad dal', 100, 12, '(1 kg)', 'images/urad.jpg', 7),
(16, 'Masur dal', 60, 65, '(1 kg)', 'images/masur.jpg', 7),
(17, 'Chana dal', 40, 50, '(500 gm)', 'images/chanadal.jpg', 7),
(18, 'Chana', 50, 55, '(1 kg)', 'images/chana.jpg', 8),
(19, 'Mug', 40, 50, '(1 kg)', 'images/mung.jpg', 8),
(20, 'Urad', 100, 10, '(1 kg)', 'images/ur.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `mobile`, `address1`, `gender`, `username`, `password`) VALUES
(25, 'himani', 1236547898, 'visnager, VILLAGE=ASODA', 'on', 'daxrp', '6034'),
(26, 'himani', 2147483647, 'visnager, VILLAGE=ASODA', 'on', 'hds', 'hd6034'),
(27, 'himani', 2147483647, 'visnager, VILLAGE=ASODA', 'on', 'hds', '6034hd'),
(28, '', 0, '', '', '', ''),
(29, 'himani', 2147483647, 'visnager, VILLAGE=ASODA', 'on', 'hds', '6034hd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ord`
--
ALTER TABLE `ord`
  MODIFY `oid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ord`
--
ALTER TABLE `ord`
  ADD CONSTRAINT `ord_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ord_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `ord` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
