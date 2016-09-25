-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2016 at 08:19 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL,
  `superid` int(10) DEFAULT NULL,
  `capprove` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cname` (`cname`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `superid`, `capprove`) VALUES
(1, 'Electronics', 0, 1),
(2, 'Clothes', 0, 1),
(3, 'Mobile', 1, 1),
(4, 'Pendrive', 1, 0),
(5, 'Hard Disk', 1, 1),
(6, 'Book', 0, 1),
(7, 'Pearson', 6, 1),
(8, 'Jeans', 2, 1),
(9, 'Medicines', 0, 1),
(10, 'General', 9, 1),
(11, 'Shirt', 2, 1),
(16, 'Men', 0, 1),
(15, 'Women', 0, 1),
(14, 'Saree', 15, 1),
(17, 'Suits', 16, 1),
(18, 'Engineering', 6, 1),
(19, 'Medical ', 6, 1),
(20, 'Television', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `cmid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `usid` int(10) NOT NULL,
  `cmnt` varchar(100) NOT NULL,
  `uos` int(1) NOT NULL,
  PRIMARY KEY (`cmid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmid`, `pid`, `usid`, `cmnt`, `uos`) VALUES
(4, 35, 3, 'Nice product\r\n', 0),
(5, 36, 3, 'Nice Product\r\n', 0),
(6, 44, 7, 'heyyy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_request`
--

DROP TABLE IF EXISTS `delivery_request`;
CREATE TABLE IF NOT EXISTS `delivery_request` (
  `uid` int(10) NOT NULL,
  `spid` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distance`
--

DROP TABLE IF EXISTS `distance`;
CREATE TABLE IF NOT EXISTS `distance` (
  `sid` int(10) NOT NULL,
  `dis` double NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distance`
--

INSERT INTO `distance` (`sid`, `dis`) VALUES
(23, 0),
(24, 5.0390423427611),
(25, 3.5634648186048),
(26, 6.0573791890553),
(27, 5.4697321673034),
(28, 3.9634580619756),
(29, 3.7174364595585),
(30, 7.2751558861417),
(31, 3.1800003103031);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(50) NOT NULL AUTO_INCREMENT,
  `cid` int(50) NOT NULL,
  `sid` int(10) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `pdesc` varchar(100) DEFAULT NULL,
  `pprice` int(10) NOT NULL,
  `pqty` int(10) NOT NULL,
  `pimage` varchar(100) DEFAULT NULL,
  `prating` int(1) NOT NULL,
  `papprove` int(1) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `cid`, `sid`, `pname`, `pdesc`, `pprice`, `pqty`, `pimage`, `prating`, `papprove`) VALUES
(44, 8, 25, 'Pepe Jeans ', 'Casual jeans', 799, 18, 'jpg', 3, 1),
(45, 11, 25, 'Indigo Nation', 'Formal ', 999, 20, 'jpg', 0, 1),
(40, 3, 23, 'Moto g3', 'motorola', 13000, 6, 'jpg', 4, 1),
(41, 4, 24, 'HP Pendrive 8 gb', 'usb pendrive', 199, 5, 'jpg', 1, 1),
(42, 5, 24, 'Segat hd', '1 tb', 5999, 2, 'jpg', 4, 1),
(43, 3, 24, 'iphone 6s plus', 'smart phone', 65000, 2, 'jpg', 2, 1),
(53, 17, 25, 'Formal', 'Low cost', 3999, 6, 'jpg', 0, 1),
(52, 17, 25, 'Casual Suit', 'Low cost', 2999, 4, 'jpg', 0, 1),
(51, 17, 26, 'Formal Suit', 'High quality suits', 9999, 2, 'jpg', 0, 1),
(50, 14, 26, 'silk saree', 'high range materials ', 5999, 5, 'jpg', 0, 1),
(39, 5, 23, 'WD', 'Western Digital', 50000, 3, 'jpg', 0, 1),
(37, 4, 23, 'HP Pendrive', 'usb 3.0', 399, 15, 'jpg', 0, 1),
(38, 4, 23, 'Sandisk Pendrive ', 'usb 2.0', 299, 5, 'jpg', 0, 1),
(36, 3, 23, 'Iphone 5', 'Apple product', 35000, 2, 'jpg', 3, 1),
(35, 3, 23, 'Iphone 6s', 'Apple product', 53000, 5, 'jpg', 5, 1),
(54, 8, 26, 'Casual jeans', 'for women only', 1599, 6, 'jpg', 4, 1),
(55, 18, 27, 'Computer Organization ', 'Pearson Publication', 499, 5, 'jpg', 1, 1),
(56, 18, 27, 'DBMS', 'Database Management System', 399, 55, 'jpg', 2, 1),
(57, 19, 27, 'Anatomy books', 'For all medical branches', 1299, 3, 'jpg', 5, 1),
(58, 18, 28, 'Computer Organization ', 'Engineering book gtu students', 259, 5, 'jpg', 3, 1),
(59, 7, 28, 'IPM', 'IIt banglore', 2999, 1, 'jpg', 0, 1),
(60, 3, 29, 'iphone 6s ', 'smart phone', 50000, 6, 'jpg', 4, 1),
(61, 3, 29, 'Iphone 5', 'Apple product', 25000, 9, 'jpg', 0, 1),
(62, 3, 29, 'HTC ONE m10', 'smart phone', 49500, 1, 'jpg', 4, 1),
(63, 3, 29, 'iphone 5c', 'Apple product', 24000, 1, 'jpg', 3, 1),
(64, 3, 23, 'iphone 5c', 'yellow', 21000, 2, 'jpg', 0, 1),
(65, 3, 23, 'Nexus 6p', '32 gb', 38500, 7, 'jpg', 0, 1),
(66, 3, 23, 'Samsung Galaxy S7', '32 gb black', 49000, 1, 'jpg', 0, 1),
(67, 3, 23, 'Galaxy S7 edge', 'black 64 gb', 65000, 3, 'jpg', 0, 1),
(68, 3, 23, 'Moto x2', 'motorola 32 gb', 25000, 8, 'jpg', 0, 1),
(69, 3, 23, 'iphone 4', '16 gb black', 12000, 1, 'jpg', 0, 1),
(70, 3, 23, 'iphone 4 white', '16 gb', 9000, 1, 'jpg', 0, 1),
(71, 3, 23, 'Oneplus one', '64 gb black', 18000, 2, 'jpg', 0, 1),
(72, 3, 23, 'Oneplus One 16gb', 'white', 16000, 1, 'jpg', 0, 1),
(73, 3, 23, 'Oneplus two', '64 gb black', 24000, 1, 'jpg', 0, 1),
(74, 3, 23, 'oppo f1', 'smart phone', 26000, 12, 'jpg', 0, 1),
(75, 3, 23, 'Sony z5', 'sony xperia z5', 45000, 3, 'jpg', 0, 1),
(76, 3, 30, 'HTC ONE m10', '64 gb', 60000, 4, 'jpg', 0, 1),
(77, 3, 30, 'Samsung s7', '64 gb', 59000, 5, 'jpg', 0, 1),
(78, 3, 30, 'Nexus 6p', '64 gb', 45000, 2, 'jpg', 0, 1),
(79, 3, 30, 'oppo f1', 'smart phone', 26000, 5, 'jpg', 0, 1),
(80, 3, 30, 'Oneplus 2', 'oneplus product', 25000, 5, 'jpg', 0, 1),
(81, 3, 30, 'Sony Xperia ', 'sony xperia z5', 45500, 25, 'jpg', 0, 1),
(82, 3, 30, 'Moto x2', 'motorola 32 gb', 26000, 7, 'jpg', 0, 1),
(83, 3, 30, 'Iphone 5', '128 gb', 35000, 2, 'jpg', 0, 1),
(84, 10, 31, 'CPM', 'General use', 40, 2500, 'jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `rateid` int(25) NOT NULL AUTO_INCREMENT,
  `uid` int(25) NOT NULL,
  `pid` int(25) NOT NULL DEFAULT '-1',
  `sid` int(25) NOT NULL DEFAULT '-1',
  `rate` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rateid`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rateid`, `uid`, `pid`, `sid`, `rate`) VALUES
(1, 3, -1, 25, 4),
(7, 1, -1, 23, 3),
(8, 3, -1, 23, 1),
(33, 1, 36, -1, 4),
(32, 3, 36, -1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `rapprove` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rid`, `uid`, `pid`, `sid`, `rapprove`) VALUES
(15, 3, 36, 23, 1),
(14, 3, 59, 28, 0),
(13, 3, 44, 25, 1),
(12, 3, 35, 23, 0),
(16, 3, 37, 23, 0),
(17, 1, 40, 23, 0),
(18, 3, 64, 23, 1),
(19, 1, 36, 23, 1),
(20, 1, 35, 23, 0),
(21, 1, 57, 27, 0),
(23, 1, 80, 30, 0),
(24, 7, 44, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `sid` int(8) NOT NULL AUTO_INCREMENT,
  `sname` varchar(25) NOT NULL,
  `semail` varchar(50) NOT NULL,
  `smobile` varchar(20) NOT NULL,
  `spass` varchar(50) NOT NULL,
  `saddress` varchar(150) DEFAULT NULL,
  `spincode` varchar(10) DEFAULT NULL,
  `srating` int(1) NOT NULL DEFAULT '0',
  `sprofile` varchar(5) DEFAULT NULL,
  `sremember` varchar(30) DEFAULT NULL,
  `sapprove` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sid`, `sname`, `semail`, `smobile`, `spass`, `saddress`, `spincode`, `srating`, `sprofile`, `sremember`, `sapprove`) VALUES
(28, 'A to Z book store', 'atoz@gmail.com', '7955662231', 'HgrIpV17IIJ jM', 'Gurukul Road', '380052', 5, 'jpg', NULL, 1),
(27, 'S S Book Stall', 'ssb@gmail.com', '7927414142', 'HgrIpV17IIJ jM', 'Ranip Road', '382480', 3, 'jpg', NULL, 1),
(26, 'Deepkala Clothing', 'deepkala@gmail.com', '98985566223', 'toIIj$URZz6O', 'maninagar', '380008', 0, 'jpg', NULL, 1),
(25, 'Anand Emporium', 'anand@gmail.com', '7855522100', 'toIIj$URZz6O', 'Sivranjani Cross road', '380015', 2, 'jpg', NULL, 1),
(24, 'Harshal Electronics', 'helec@gmail.com', '89895544356', 'toIIj$URZz6O', 'Ghatlodia Ahmedabad', '380061', 1, 'jpg', NULL, 1),
(23, 'Navrang Mobile Shop', 'navrang@co.in', '9898959848', 'toIIj$URZz6O', 'Nirav Complex Navrangpura', '380009', 2, 'jpg', NULL, 1),
(29, 'zorba mobile shop', 'zorba@gmail.com', '9825048480', 'toIIj$URZz6O', 'shahibag road', '380004', 4, 'jpg', NULL, 1),
(30, 'Hem Mobile Store', 'hem@gmail.com', '7854220011', 'toIIj$URZz6O', 'Thaltej road', '380054', 3, 'jpg', NULL, 1),
(31, 'Vishvesh Medical Store', 'vishvesh@gmail.com', '2748455699', 'toIIj$URZz6O', 'Naranpura', '380013', 0, '', NULL, 1),
(32, 'Jayhind sweets', 'jayhind@co.in', '8877552200', 'toIIj$URZz6O', 'stadium road ahmedabad', '380015', 0, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `uname` varchar(25) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `umobile` varchar(20) NOT NULL,
  `upass` varchar(50) NOT NULL,
  `uaddress` varchar(150) DEFAULT NULL,
  `upincode` varchar(10) DEFAULT NULL,
  `uprofile` varchar(5) DEFAULT NULL,
  `uremember` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `uemail`, `umobile`, `upass`, `uaddress`, `upincode`, `uprofile`, `uremember`) VALUES
(1, 'Nirav', 'nirav6895@gmail.com', '8866882892', '$VjpDiFWv&DI', 'ahmedabad', '380060', 'jpg', NULL),
(3, 'Brij Shah', 'brijshah62@gmail.com', '09898789159', 'toIIj$URZz6O', '14, gandhi purshotam park', '380001', 'jpg', NULL),
(4, 'Abhishek', 'abhi@gmail.com', '9898789159', 'toIIj$URZz6O', 'navrang char rasta', '380015', '', NULL),
(5, 'Krunal Shah', 'krunal@gmail.com', '9898789159', 'toIIj$URZz6O', 'paldi', '380007', '', NULL),
(6, 'jignesh', 'js@gmail.com', '94287542544', '8p;IjZwJ+CpjN', 'ahs', '365544', '', NULL),
(7, 'tarpit desai', 'taps@co.in', '9898753652', 'toIIj$URZz6O', 'Ghatlodia Ahmedabad', '380060', '', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
