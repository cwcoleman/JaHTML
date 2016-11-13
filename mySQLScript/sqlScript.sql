-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2016 at 01:12 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro`
--
CREATE DATABASE IF NOT EXISTS `chhur4gu_rj_pic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chhur4gu_hackathon`;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `ID` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`ID`, `location`, `branch`) VALUES
(1, 'Newport News, VA', 'Newport News, VA');

-- --------------------------------------------------------

--
-- Table structure for table `no_tech_order`
--

CREATE TABLE `no_tech_order` (
  `ID` int(11) NOT NULL,
  `timeStamp` varchar(100) NOT NULL,
  `ipaddr` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `orderUniqId` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `no_tech_order`
--

INSERT INTO `no_tech_order` (`ID`, `timeStamp`, `ipaddr`, `active`, `orderUniqId`) VALUES
(1, '11-12-2016 21:01:06.092700', '::1', 1, '5827831214a70'),
(2, '11-12-2016 21:01:34.708700', '::1', 1, '5827832eab4e1'),
(3, '11-12-2016 21:32:28.378400', '::1', 1, '58278a6c58ed9'),
(4, '11-12-2016 21:52:41.610100', '::1', 1, '58278f2994c56'),
(5, '11-12-2016 22:37:53.704500', '::1', 1, '582799c1abdac'),
(6, '11-12-2016 22:38:12.459300', '::1', 1, '582799d470079'),
(7, '11-12-2016 22:46:39.881600', '::1', 1, '58279bcfd71c9'),
(8, '11-13-2016 01:02:21.497800', '::1', 1, '5827bb9d78dd9'),
(9, '11-13-2016 01:10:38.746300', '::1', 1, '5827bd8eb5c59'),
(10, '11-13-2016 01:11:08.272900', '::1', 1, '5827bdac42528');

-- --------------------------------------------------------

--
-- Table structure for table `order_to_technician`
--

CREATE TABLE `order_to_technician` (
  `ID` int(11) NOT NULL,
  `technicianId` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `timeStamp` varchar(100) NOT NULL,
  `ip_addr` varchar(100) NOT NULL,
  `orderUniqId` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_to_technician`
--

INSERT INTO `order_to_technician` (`ID`, `technicianId`, `status`, `timeStamp`, `ip_addr`, `orderUniqId`) VALUES
(1, '1', 'NEW', '11-12-2016 20:58:18.691000', '::1', '5827826aa6d44'),
(2, '1', 'NEW', '11-12-2016 22:36:23.717900', '::1', '58279967aeac8'),
(3, '1', 'NEW', '11-12-2016 22:37:39.836800', '::1', '582799b3c9d67'),
(4, '1', 'NEW', '11-12-2016 22:38:56.850600', '::1', '58279a00cdaab'),
(5, '1', 'NEW', '11-12-2016 23:16:57.554100', '::1', '5827a2e98710e'),
(6, '1', 'NEW', '11-12-2016 23:22:58.897900', '::1', '5827a452db0a5'),
(7, '1', 'NEW', '11-12-2016 23:23:50.155700', '::1', '5827a48623f54'),
(8, '1', 'NEW', '11-12-2016 23:24:41.320300', '::1', '5827a4b94c4a0'),
(9, '1', 'NEW', '11-12-2016 23:25:50.594200', '::1', '5827a4fe8f132'),
(10, '1', 'NEW', '11-12-2016 23:38:25.622800', '::1', '5827a7f196761'),
(11, '1', 'NEW', '11-12-2016 23:55:23.335100', '::1', '5827abeb508dc'),
(12, '1', 'NEW', '11-12-2016 23:56:58.550300', '::1', '5827ac4a84fca'),
(13, '1', 'NEW', '11-12-2016 23:57:21.555300', '::1', '5827ac6184965'),
(14, '1', 'NEW', '11-12-2016 23:57:58.966900', '::1', '5827ac86ebb6e'),
(15, '1', 'NEW', '11-12-2016 23:59:42.237600', '::1', '5827acee39b05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `desc_prob` varchar(1000) DEFAULT NULL,
  `close_branch` varchar(1000) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `prob_picture` varchar(1000) DEFAULT NULL,
  `prob_video` varchar(1000) DEFAULT NULL,
  `user` varchar(1000) NOT NULL,
  `uniqId` varchar(100) NOT NULL,
  `ip_addr` varchar(100) NOT NULL,
  `timeStamp` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `techId` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `desc_prob`, `close_branch`, `date`, `prob_picture`, `prob_video`, `user`, `uniqId`, `ip_addr`, `timeStamp`, `status`, `techId`) VALUES
(2, 'test', 'Newport', '11/16/2016', '', '', 'test', '58277e61bd482', '::1', '11-12-2016 20:41:05.775300', NULL, NULL),
(3, 'test', 'Newport', '11/16/2016', '', '', 'test', '58277e7476071', '::1', '11-12-2016 20:41:24.483400', NULL, NULL),
(4, 'hjadsb', 'Newport', '11/16/2016', '', '', 'test', '5827812a401c0', '::1', '11-12-2016 20:52:58.262600', NULL, NULL),
(5, 'hjadsb', 'Newport', '11/16/2016', '', '', 'test', '582781d99a798', '::1', '11-12-2016 20:55:53.632800', NULL, NULL),
(6, 'hjadsb', 'Newport', '11/16/2016', '', '', 'test', '58278243f2b71', '::1', '11-12-2016 20:57:39.994200', NULL, NULL),
(7, 'hjadsb', 'Newport', '11/16/2016', '', '', 'test', '5827826aa6d44', '::1', '11-12-2016 20:58:18.683400', NULL, NULL),
(8, 'test1', 'Virginia Beach', '11/16/2016', '', '', 'test', '5827829659901', '::1', '11-12-2016 20:59:02.366900', NULL, NULL),
(9, 'test1', 'Virginia Beach', '11/16/2016', '', '', 'test', '582782bbab37c', '::1', '11-12-2016 20:59:39.701300', NULL, NULL),
(10, 'test1', 'Virginia Beach', '11/16/2016', '', '', 'test', '58278305c188d', '::1', '11-12-2016 21:00:53.792700', NULL, NULL),
(11, 'test1', 'Virginia Beach', '11/16/2016', '', '', 'test', '5827831214a70', '::1', '11-12-2016 21:01:06.084600', NULL, NULL),
(12, 'test1', 'Virginia Beach', '11/16/2016', '', '', 'test', '5827832eab4e1', '::1', '11-12-2016 21:01:34.701700', NULL, NULL),
(13, '', 'sfdd', '11/16/2016', '', '', 'test', '58278a6c58ed9', '::1', '11-12-2016 21:32:28.364300', NULL, NULL),
(14, '', 'asdlkn', '11/16/2016', '', '', 'test', '58278f2994c56', '::1', '11-12-2016 21:52:41.609400', NULL, NULL),
(15, 'askdjb', 'Newport', '11/16/2016', '', '', 'test', '58279967aeac8', '::1', '11-12-2016 22:36:23.716100', 'Assigned', '1'),
(16, 'askdjb', 'Newport', '11/16/2016', '', '', 'test', '58279967aeac8', '::1', '11-12-2016 22:36:23.717600', 'Assigned', '1'),
(17, 'asdkbjb', 'Newport', '11/16/2016', '', '', 'test', '582799b3c9d67', '::1', '11-12-2016 22:37:39.827200', 'Assigned', '1'),
(18, 'asdkjb', 'Virginia Beach', '11/16/2016', '', '', 'test', '582799c1abdac', '::1', '11-12-2016 22:37:53.704500', 'Assigned', ''),
(19, 'asdkjb', 'Virginia Beach', '11/16/2016', '', '', 'test', '582799d470079', '::1', '11-12-2016 22:38:12.459300', 'NEW', ''),
(20, 'asdkjn', 'Newport News', '11/16/2016', '', '', 'test', '58279a00cdaab', '::1', '11-12-2016 22:38:56.843000', 'Assigned', '1'),
(21, 'askdjb', 'Virginia Beach', '11/16/2016', '', '', 'test', '58279bcfd71c9', '::1', '11-12-2016 22:46:39.881600', 'NEW', ''),
(22, '', 'Newport News', '11/16/2016', '', '', 'test', '5827a2e98710e', '::1', '11-12-2016 23:16:57.553700', 'Assigned', '1'),
(23, '', 'Newport News', '11/16/2016', '', '', 'test', '5827a452db0a5', '::1', '11-12-2016 23:22:58.897600', 'Assigned', '1'),
(24, '', 'Newport News', '11/16/2016', '', '', 'test', '5827a48623f54', '::1', '11-12-2016 23:23:50.147700', 'Assigned', '1'),
(25, '', 'Newport News', '11/16/2016', '', '', 'test', '5827a4b94c4a0', '::1', '11-12-2016 23:24:41.313400', 'Assigned', '1'),
(26, 'Test', 'Newport News', '11/16/2016', '', '', 'test', '5827a4fe8f132', '::1', '11-12-2016 23:25:50.586500', 'Assigned', '1'),
(27, 'Fix my AC!', 'Newport News', '11/16/2016', '', '', 'test', '5827a7f196761', '::1', '11-12-2016 23:38:25.622500', 'Assigned', '1'),
(28, 'Fix The AC!!', 'Newport News', '11/16/2016', '', '', 'test', '5827abeb508dc', '::1', '11-12-2016 23:55:23.334800', 'Assigned', '1'),
(29, 'Test', 'Newport News', '11/16/2016', '', '', 'test', '5827ac4a84fca', '::1', '11-12-2016 23:56:58.550000', 'Assigned', '1'),
(30, 'Test', 'Newport News', '11/16/2016', '', '', 'test', '5827ac6184965', '::1', '11-12-2016 23:57:21.544400', 'Assigned', '1'),
(31, 'Test', 'Newport News', '11/16/2016', '9.jpg', '', 'test', '5827ac86ebb6e', '::1', '11-12-2016 23:57:58.966600', 'Assigned', '1'),
(32, 'Ac is broken', 'Newport', '11/16/2016', '10.jpg', '', 'test', '5827acee39b05', '::1', '11-12-2016 23:59:42.237400', 'Assigned', '1'),
(33, 'Fix my AC!', 'Virginia Beach', '11/16/2016', '', '', 'test', '5827bb9d78dd9', '::1', '11-13-2016 01:02:21.497800', 'NEW', ''),
(34, 'Fix it!!', 'Virginia Beach', '11/16/2016', '', '', 'test', '5827bd8eb5c59', '::1', '11-13-2016 01:10:38.746300', 'NEW', ''),
(35, 'Fix it!!', 'Virginia Beach', '11/16/2016', '6.jpg', '', 'test', '5827bdac42528', '::1', '11-13-2016 01:11:08.272900', 'NEW', '');

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `ID` int(11) NOT NULL,
  `techID` varchar(100) DEFAULT NULL,
  `techName` varchar(100) DEFAULT NULL,
  `techLocation` varchar(100) DEFAULT NULL,
  `techAvail` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`ID`, `techID`, `techName`, `techLocation`, `techAvail`) VALUES
(1, '001', 'Test', 'Newport News, VA', 0),
(2, '002', 'Test', 'Newport News, VA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userz`
--

CREATE TABLE `userz` (
  `uname` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `timeStamp` varchar(100) NOT NULL,
  `ip_addr` varchar(100) NOT NULL,
  `level` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userz`
--

INSERT INTO `userz` (`uname`, `pass`, `name`, `email`, `lname`, `timeStamp`, `ip_addr`, `level`) VALUES
('a', 'a', 'a', 'a', 'a', '', '', NULL),
('test', 'a', 'test', 'test', 'test', '11-12-2016 20:13:54.398700', '::1', NULL),
('admin', 'admin', 'admin', 'admin', 'admin', '11-12-2016 7:33:00', '::1', 'admin'),
('s', 'c', 'test1', 's', 'test2', '11-13-2016 01:01:20.298700', '::1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `no_tech_order`
--
ALTER TABLE `no_tech_order`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_to_technician`
--
ALTER TABLE `order_to_technician`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userz`
--
ALTER TABLE `userz`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `no_tech_order`
--
ALTER TABLE `no_tech_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order_to_technician`
--
ALTER TABLE `order_to_technician`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
