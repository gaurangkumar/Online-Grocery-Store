-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2020 at 11:18 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `name`, `email`, `password`) VALUES
(1, 'himani', 'himaniaasoda1999@gmail.com', '8814');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `msg` varchar(100) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `name`, `mobile`, `msg`, `uid`) VALUES
(1, 'dax', '9106682997', 'good', NULL),
(2, 'dax', '9106682997', 'good', NULL),
(3, 'dax', '9106682997', 'good', NULL),
(4, 'dax', '9106682997', 'good', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ord`
--

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
(19, 'Mug', 40, 55, '1 kg', 'images/mung.jpg', 8),
(25, 'clinic plush', 50, 54, '700 ml', 'images/1602260557-clinic.jpg', 2),
(26, 'chik', 50, 54, '700 ml', 'images/1602266961-chick.jpg', 2),
(27, 'Dettol', 40, 0, '4 pc', 'images/1602267040-d3.jpg', 2),
(28, 'Dettol Handwash', 30, 40, '250ml', 'images/1602267137-dh.jpg', 2),
(29, 'lifebuoy', 50, 50, '4 pc', 'images/1602267355-life.jpg', 2),
(31, 'surf excel', 150, 160, '1kg', 'images/1602267705-surf2.jpg', 3),
(33, 'Nirma', 40, 50, '1 kg', 'images/1602267875-nirma.jpg', 3),
(38, 'brinjal', 40, 50, '1kg', 'images/1602268367-31.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `mobile`, `address1`, `gender`, `username`, `password`) VALUES
(32, 'himani', '9106682997', 'visnager, VILLAGE=ASODA', '', 'himani', 'hd6034'),
(33, 'divya', '9979331605', 'visnager, VILLAGE=ASODA', '', 'daxrp', 'dk7845'),
(34, 'kishan', '9714304713', 'visnager', '', 'kishan rp', 'kr9856'),
(35, 'rajubhai', '9979331605', 'asoda', '', 'daxrp', 'rp1236'),
(36, 'sonali', '1236547898', 'visnager,', '', 'sonali', 'sp1236');

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
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `feedback_ibfk_1` (`uid`);

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
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
