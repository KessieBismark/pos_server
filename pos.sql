-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2023 at 10:03 PM
-- Server version: 10.5.22-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bistech3_super`
--
CREATE DATABASE IF NOT EXISTS `bistech3_super` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bistech3_super`;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'Accra'),
(2, 'Kumasi');

-- --------------------------------------------------------

--
-- Table structure for table `cash_balance`
--

CREATE TABLE `cash_balance` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cash_balance`
--

INSERT INTO `cash_balance` (`id`, `amount`, `month`, `year`, `branch`) VALUES
(512, 658.56, 12, 2022, 2),
(511, 658.56, 11, 2022, 2),
(510, 658.56, 10, 2022, 2),
(509, 0, 9, 2022, 2),
(508, 0, 8, 2022, 2),
(507, 0, 7, 2022, 2),
(506, 0, 6, 2022, 2),
(505, 0, 5, 2022, 2),
(504, 0, 4, 2022, 2),
(503, 0, 3, 2022, 2),
(502, 0, 2, 2022, 2),
(501, 0, 1, 2022, 2),
(428, 0, 1, 2022, 1),
(429, 0, 2, 2022, 1),
(430, 0, 3, 2022, 1),
(431, 0, 4, 2022, 1),
(432, 0, 5, 2022, 1),
(433, 0, 6, 2022, 1),
(434, 0, 7, 2022, 1),
(435, 0, 8, 2022, 1),
(436, 0, 9, 2022, 1),
(437, 0, 10, 2022, 1),
(438, 2272.54, 11, 2022, 1),
(439, 2272.54, 12, 2022, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cash_balance_month`
--

CREATE TABLE `cash_balance_month` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `week` int(11) NOT NULL,
  `date` date NOT NULL,
  `year` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `month` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cash_balance_month`
--

INSERT INTO `cash_balance_month` (`id`, `amount`, `week`, `date`, `year`, `branch`, `month`) VALUES
(52, '223.80', 4, '2022-11-28', 2022, 1, 11),
(51, '717.04', 3, '2022-11-21', 2022, 1, 11),
(50, '413.90', 2, '2022-11-14', 2022, 1, 11),
(49, '0.00', 1, '2022-11-07', 2022, 1, 11),
(56, '658.56', 4, '2022-10-24', 2022, 2, 10),
(55, '658.56', 3, '2022-10-17', 2022, 2, 10),
(54, '0.00', 2, '2022-10-10', 2022, 2, 10),
(53, '0.00', 1, '2022-10-03', 2022, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(8, 'Herbals', 'CHOCHO CREAM'),
(7, 'Add product category', 'Something about the product\'s category');

-- --------------------------------------------------------

--
-- Table structure for table `cf_das`
--

CREATE TABLE `cf_das` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cf_dash`
--

CREATE TABLE `cf_dash` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `closed_month`
--

CREATE TABLE `closed_month` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `closed_month`
--

INSERT INTO `closed_month` (`id`, `year`, `month`, `branch`, `date`) VALUES
(15, 2022, 10, 2, '2022-12-18 18:50:24'),
(14, 2022, 11, 1, '2022-12-18 13:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `gps` text NOT NULL,
  `slogan` text DEFAULT NULL,
  `website` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `contact`, `address`, `gps`, `slogan`, `website`, `email`, `logo`) VALUES
(12, 'Bryhtlinks Group of Companies', '+233540231373', 'N/A', 'Online Service', 'leader in soft Techs', 'www.netcomtechgh.com', 'info@netcomtechs.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `discount` double NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `contact`, `address`, `discount`) VALUES
(2, 'John doe', 'info@companydomain.com', '0544634846', '36 Mineral Street, Rhode Island', 5),
(5, 'Adiyiah  pharmacy', 'adiyiahpharm@gmail.com', '0540665650', 'Dunkirk - Kumasi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `cheque_no` varchar(200) DEFAULT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp(),
  `branch` int(11) DEFAULT NULL,
  `t_type` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `sub_id`, `amount`, `date`, `description`, `type`, `cheque_no`, `entry_date`, `branch`, `t_type`) VALUES
(1, 1, 2432.00, '2022-11-04', 'Fgfdgfg', 'Cash', '', '2022-11-04 20:34:28', 0, 2),
(2, 1, 434.00, '1970-01-01', 'Gfhj gfhfghfg', 'Cash', '', '2022-11-08 23:17:31', NULL, 2),
(3, 1, 104.00, '2022-10-19', 'Gfhj gfhfghfg', 'Cash', '', '2022-11-08 23:18:00', NULL, 2),
(4, 1, 434.00, '2022-11-06', 'Fgh fhfghfg gfhfgh', 'Cash', '', '2022-11-08 23:18:30', NULL, 2),
(5, 1, 556.78, '2022-11-01', 'Yny  yyrhhhy y hyh  yjyjyjhyjy', 'Cash', '', '2022-11-09 08:22:33', NULL, 2),
(6, 1, 45.00, '2022-11-09', '', 'Cash', '', '2022-11-11 11:47:40', 1, 2),
(7, 1, 200.00, '2023-03-21', '', 'Cash', '', '2023-03-21 12:11:04', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exp_category`
--

CREATE TABLE `exp_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exp_category`
--

INSERT INTO `exp_category` (`id`, `name`, `description`) VALUES
(1, 'Very', 'fgfdgdf adfdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `exp_sub_category`
--

CREATE TABLE `exp_sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exp_sub_category`
--

INSERT INTO `exp_sub_category` (`id`, `name`, `cat_id`) VALUES
(1, 'Good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `cheque_no` varchar(200) DEFAULT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp(),
  `branch` int(11) DEFAULT NULL,
  `t_type` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `sub_id`, `amount`, `date`, `description`, `type`, `cheque_no`, `entry_date`, `branch`, `t_type`) VALUES
(83, 4, 0.00, '2022-10-24', 'Total sales in week 4 of October 2022', 'Cash', NULL, '2022-11-20 14:25:39', 2, 1),
(82, 4, 0.00, '2022-10-17', 'Total sales in week 3 of October 2022', 'Cash', NULL, '2022-11-20 14:25:39', 2, 1),
(80, 4, 0.00, '2022-10-03', 'Total sales in week 1 of October 2022', 'Cash', NULL, '2022-11-20 14:25:39', 2, 1),
(81, 4, 329.28, '2022-10-10', 'Total sales in week 2 of October 2022', 'Cash', NULL, '2022-11-20 14:25:39', 2, 1),
(26, 2, 458.90, '2022-11-03', 'Fevfgfg rwtrtrt  trtrt', 'Mobile Money', '', '2022-11-09 13:00:06', 1, 1),
(25, 2, 458.90, '2022-11-01', 'Fe rtyetrtrte  rtert rretert rtertrtrt', 'Cash', '', '2022-11-09 12:56:41', 1, 1),
(24, 3, 458.90, '2022-11-07', 'Yigy uhuh ouhuh ouhuhu uhuhuhu ugygy igyg hgyu', 'Cash', '', '2022-11-09 12:13:58', 1, 1),
(84, 4, 0.00, '2022-11-07', 'Total sales in week 1 of November 2022', 'Cash', NULL, '2022-12-18 13:57:27', 1, 1),
(85, 4, 717.04, '2022-11-14', 'Total sales in week 2 of November 2022', 'Cash', NULL, '2022-12-18 13:57:27', 1, 1),
(86, 4, 223.80, '2022-11-21', 'Total sales in week 3 of November 2022', 'Cash', NULL, '2022-12-18 13:57:27', 1, 1),
(87, 4, 0.00, '2022-11-28', 'Total sales in week 4 of November 2022', 'Cash', NULL, '2022-12-18 13:57:27', 1, 1),
(88, 4, 0.00, '2022-10-03', 'Total sales in week 1 of October 2022', 'Cash', NULL, '2022-12-18 18:50:24', 2, 1),
(89, 4, 329.28, '2022-10-10', 'Total sales in week 2 of October 2022', 'Cash', NULL, '2022-12-18 18:50:24', 2, 1),
(90, 4, 0.00, '2022-10-17', 'Total sales in week 3 of October 2022', 'Cash', NULL, '2022-12-18 18:50:24', 2, 1),
(91, 4, 0.00, '2022-10-24', 'Total sales in week 4 of October 2022', 'Cash', NULL, '2022-12-18 18:50:24', 2, 1),
(92, 3, 1.00, '2022-12-15', '', 'Cash', '', '2022-12-18 18:51:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `in_category`
--

CREATE TABLE `in_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `in_category`
--

INSERT INTO `in_category` (`id`, `name`, `description`) VALUES
(1, 'Other', 'try'),
(3, 'Investment', ''),
(4, 'Sales & services', '');

-- --------------------------------------------------------

--
-- Table structure for table `in_sub_category`
--

CREATE TABLE `in_sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `in_sub_category`
--

INSERT INTO `in_sub_category` (`id`, `name`, `cat_id`) VALUES
(3, 'Owner investment', 3),
(2, 'Fsdg', 1),
(4, 'Sales', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `total` double(10,2) NOT NULL,
  `payable` double(10,2) NOT NULL,
  `rep` int(11) NOT NULL,
  `payment` double(10,2) NOT NULL DEFAULT 0.00,
  `balance` double(10,2) NOT NULL DEFAULT 0.00,
  `discount` double(10,2) NOT NULL,
  `cid` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `book` tinyint(4) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `paid` tinyint(4) NOT NULL DEFAULT 1,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `total`, `payable`, `rep`, `payment`, `balance`, `discount`, `cid`, `branch`, `book`, `date`, `paid`, `entry_date`) VALUES
(76, 343.00, 329.28, 2, 329.28, 0.00, 13.72, 3, 2, 0, '2022-10-13 00:00:00', 1, '2022-12-18 14:25:36'),
(77, 388.67, 380.90, 2, 380.90, 0.00, 7.77, 2, 1, 1, '2022-11-17 00:00:00', 1, '2022-12-18 14:25:36'),
(78, 45.67, 43.84, 2, 45.00, 1.16, 1.83, 3, 2, 1, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(79, 343.00, 336.14, 2, 340.00, 3.86, 6.86, 2, 1, 0, '2022-11-16 00:00:00', 1, '2022-12-18 14:25:36'),
(90, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(81, 343.00, 329.28, 2, 330.00, 0.72, 13.72, 4, 2, 1, '2022-11-19 00:00:00', 1, '2022-12-18 14:25:36'),
(82, 343.00, 336.14, 2, 340.00, 3.86, 6.86, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(89, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(88, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(87, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(86, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(91, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 1, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(92, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 1, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(93, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 1, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(94, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(95, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 1, 0, '2022-11-23 00:00:00', 1, '2022-12-18 14:25:36'),
(96, 343.00, 336.14, 2, 340.00, 3.86, 6.86, 2, 2, 0, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(97, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 1, 0, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(98, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(99, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 2, 0, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(100, 45.67, 43.84, 2, 45.00, 1.16, 1.83, 3, 2, 0, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(101, 45.67, 43.84, 2, 45.00, 1.16, 1.83, 3, 2, 0, '2022-11-24 00:00:00', 1, '2022-12-18 14:25:36'),
(102, 777.34, 761.79, 2, 762.00, 0.21, 15.55, 2, 1, 0, '2022-12-17 00:00:00', 1, '2022-12-18 14:25:36'),
(103, 1074.67, 1031.68, 2, 1100.00, 68.32, 42.99, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(104, 1074.67, 1031.68, 2, 1100.00, 68.32, 42.99, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(105, 731.67, 702.40, 2, 720.00, 17.60, 29.27, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(106, 434.34, 416.97, 2, 500.00, 83.03, 17.37, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(107, 434.34, 416.97, 2, 500.00, 83.03, 17.37, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(108, 434.34, 416.97, 2, 500.00, 83.03, 17.37, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(109, 434.34, 416.97, 2, 500.00, 83.03, 17.37, 4, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(110, 525.68, 504.65, 2, 510.00, 5.35, 21.03, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(111, 434.34, 416.97, 2, 500.00, 83.03, 17.37, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(112, 731.67, 702.40, 2, 710.00, 7.60, 29.27, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(113, 777.34, 746.25, 2, 750.00, 3.75, 31.09, 4, 2, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(114, 343.00, 329.28, 2, 330.00, 0.72, 13.72, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(115, 343.00, 329.28, 2, 330.00, 0.72, 13.72, 4, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(116, 45.67, 43.84, 2, 50.00, 6.16, 1.83, 3, 2, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(117, 0.00, 0.00, 2, 56.00, 56.00, 0.00, 2, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(118, 0.00, 0.00, 2, 56.00, 56.00, 0.00, 2, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(119, 0.00, 0.00, 2, 45.00, 45.00, 0.00, 2, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(120, 45.67, 43.84, 2, 50.00, 6.16, 1.83, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(121, 388.67, 380.90, 2, 0.00, 0.00, 7.77, 2, 1, 1, '2022-12-18 00:00:00', 0, '2022-12-18 14:25:36'),
(122, 45.67, 43.84, 2, 45.00, 1.16, 1.83, 3, 2, 1, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(123, 228.35, 219.22, 2, 220.00, 0.78, 9.13, 4, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(124, 343.00, 329.28, 2, 0.00, 0.00, 13.72, 3, 1, 1, '2022-12-18 00:00:00', 0, '2022-12-18 14:25:36'),
(125, 686.00, 658.56, 2, 660.00, 1.44, 27.44, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 14:25:36'),
(126, 45.67, 44.76, 2, 45.00, 0.24, 0.91, 2, 1, 1, '2022-12-18 00:00:00', 1, '2022-12-18 15:15:16'),
(127, 1715.00, 1646.40, 2, 1650.00, 3.60, 68.60, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 19:56:05'),
(128, 1715.00, 1646.40, 2, 1650.00, 3.60, 68.60, 3, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 19:58:16'),
(129, 91.34, 87.69, 2, 90.00, 2.31, 3.65, 4, 2, 0, '2022-12-18 00:00:00', 1, '2022-12-18 19:59:23'),
(130, 343.00, 329.28, 2, 330.00, 0.72, 13.72, 4, 1, 0, '2022-12-18 00:00:00', 1, '2022-12-18 20:09:55'),
(131, 91.34, 87.69, 2, 90.00, 2.31, 3.65, 3, 1, 0, '2022-12-19 00:00:00', 1, '2022-12-19 08:29:21'),
(132, 731.67, 702.40, 2, 703.00, 0.60, 29.27, 3, 2, 0, '2023-02-15 00:00:00', 1, '2023-02-15 12:30:39'),
(133, 731.67, 717.04, 2, 722.00, 4.96, 14.63, 2, 2, 0, '2023-03-07 00:00:00', 1, '2023-03-07 11:08:38'),
(134, 93.67, 89.92, 2, 90.00, 0.08, 3.75, 4, 2, 0, '2023-03-07 00:00:00', 1, '2023-03-07 16:16:37'),
(135, 343.00, 329.28, 2, 400.00, 70.72, 13.72, 3, 2, 0, '2023-03-21 00:00:00', 1, '2023-03-21 11:33:09'),
(136, 45.67, 43.84, 2, 50.00, 6.16, 1.83, 3, 1, 0, '2023-03-21 00:00:00', 1, '2023-03-21 11:34:48'),
(137, 48.00, 46.08, 2, 50.00, 3.92, 1.92, 3, 2, 0, '2023-03-21 00:00:00', 1, '2023-03-21 11:37:22'),
(138, 45.67, 43.84, 2, 50.00, 6.16, 1.83, 3, 1, 0, '2023-03-21 00:00:00', 1, '2023-03-21 11:39:39'),
(139, 24.00, 23.04, 2, 24.00, 0.96, 0.96, 3, 2, 0, '2023-03-21 00:00:00', 1, '2023-03-21 11:41:35'),
(140, 24.00, 23.04, 2, 24.00, 0.96, 0.96, 4, 2, 0, '2023-03-21 00:00:00', 1, '2023-03-21 11:44:47'),
(141, 710.00, 681.60, 2, 700.00, 18.40, 28.40, 3, 1, 0, '2023-03-22 00:00:00', 1, '2023-03-22 09:59:49'),
(142, 686.00, 672.28, 2, 700.00, 27.72, 13.72, 5, 1, 0, '2023-03-29 00:00:00', 1, '2023-03-29 13:53:48'),
(143, 686.00, 651.70, 2, 700.00, 48.30, 34.30, 2, 1, 0, '2023-04-10 00:00:00', 1, '2023-04-10 14:11:55'),
(144, 1402.00, 1331.90, 2, 1500.00, 168.10, 70.10, 2, 1, 0, '2023-06-26 00:00:00', 1, '2023-06-26 13:29:42'),
(145, 343.00, 325.85, 2, 0.00, 0.00, 17.15, 2, 2, 1, '2023-08-19 00:00:00', 0, '2023-08-19 11:34:22'),
(146, 358.00, 350.84, 2, 351.00, 0.16, 7.16, 5, 2, 0, '2023-08-19 00:00:00', 1, '2023-08-19 13:56:36'),
(147, 15.00, 14.25, 2, 14.50, 0.25, 0.75, 2, 2, 0, '2023-08-19 00:00:00', 1, '2023-08-19 14:18:58'),
(148, 2088.00, 1983.60, 2, 2000.00, 16.40, 104.40, 2, 2, 0, '2023-08-19 00:00:00', 1, '2023-08-19 21:24:25'),
(149, 150.00, 142.50, 2, 0.00, 0.00, 7.50, 2, 1, 1, '2023-08-19 00:00:00', 0, '2023-08-19 21:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `sub_total` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`id`, `sales_id`, `service_id`, `price`, `date`, `quantity`, `sub_total`) VALUES
(96, 131, 2, 45.67, '2022-12-19 08:29:21', 2, 91.34),
(95, 130, 1, 343.00, '2022-12-18 20:09:55', 1, 343.00),
(94, 129, 2, 45.67, '2022-12-18 19:59:23', 2, 91.34),
(93, 128, 1, 343.00, '2022-12-18 19:58:16', 5, 1715.00),
(92, 127, 1, 343.00, '2022-12-18 19:56:05', 5, 1715.00),
(91, 126, 2, 45.67, '2022-12-18 15:15:16', 1, 45.67),
(90, 125, 1, 343.00, '2022-12-18 14:10:52', 2, 686.00),
(89, 124, 1, 343.00, '2022-12-18 14:10:25', 1, 343.00),
(88, 123, 2, 45.67, '2022-12-18 13:57:12', 5, 228.35),
(87, 122, 2, 45.67, '2022-12-18 13:45:53', 1, 45.67),
(86, 121, 2, 45.67, '2022-12-18 13:29:33', 1, 45.67),
(85, 121, 1, 343.00, '2022-12-18 13:29:33', 1, 343.00),
(84, 120, 2, 45.67, '2022-12-18 13:05:06', 1, 45.67),
(83, 116, 2, 45.67, '2022-12-18 11:57:26', 1, 45.67),
(82, 115, 1, 343.00, '2022-12-18 11:56:11', 1, 343.00),
(81, 114, 1, 343.00, '2022-12-18 11:51:27', 1, 343.00),
(80, 113, 2, 45.67, '2022-12-18 11:48:26', 2, 91.34),
(79, 113, 1, 343.00, '2022-12-18 11:48:26', 2, 686.00),
(78, 112, 2, 45.67, '2022-12-18 11:43:32', 1, 45.67),
(77, 112, 1, 343.00, '2022-12-18 11:43:32', 2, 686.00),
(76, 111, 1, 343.00, '2022-12-18 11:19:33', 1, 343.00),
(75, 111, 2, 45.67, '2022-12-18 11:19:33', 2, 91.34),
(74, 110, 2, 45.67, '2022-12-18 11:14:54', 4, 182.68),
(73, 110, 1, 343.00, '2022-12-18 11:14:54', 1, 343.00),
(72, 109, 1, 343.00, '2022-12-18 11:06:47', 1, 343.00),
(71, 109, 2, 45.67, '2022-12-18 11:06:47', 2, 91.34),
(97, 132, 1, 343.00, '2023-02-15 12:30:40', 2, 686.00),
(98, 132, 2, 45.67, '2023-02-15 12:30:40', 1, 45.67),
(99, 133, 1, 343.00, '2023-03-07 11:08:38', 2, 686.00),
(100, 133, 2, 45.67, '2023-03-07 11:08:39', 1, 45.67),
(101, 134, 2, 45.67, '2023-03-07 16:16:39', 1, 45.67),
(102, 134, 3, 24.00, '2023-03-07 16:16:40', 2, 48.00),
(103, 135, 1, 343.00, '2023-03-21 11:33:09', 1, 343.00),
(104, 136, 2, 45.67, '2023-03-21 11:34:48', 1, 45.67),
(105, 137, 3, 24.00, '2023-03-21 11:37:23', 2, 48.00),
(106, 138, 2, 45.67, '2023-03-21 11:39:39', 1, 45.67),
(107, 139, 3, 24.00, '2023-03-21 11:41:35', 1, 24.00),
(108, 140, 3, 24.00, '2023-03-21 11:44:47', 1, 24.00),
(109, 141, 3, 24.00, '2023-03-22 09:59:50', 1, 24.00),
(110, 141, 1, 343.00, '2023-03-22 09:59:50', 2, 686.00),
(111, 142, 1, 343.00, '2023-03-29 13:53:49', 2, 686.00),
(112, 143, 1, 343.00, '2023-04-10 14:11:55', 2, 686.00),
(113, 144, 1, 343.00, '2023-06-26 13:29:42', 4, 1372.00),
(114, 144, 4, 15.00, '2023-06-26 13:29:43', 2, 30.00),
(115, 145, 1, 343.00, '2023-08-19 11:34:23', 1, 343.00),
(116, 146, 1, 343.00, '2023-08-19 13:56:53', 1, 343.00),
(117, 146, 4, 15.00, '2023-08-19 13:56:53', 1, 15.00),
(118, 147, 4, 15.00, '2023-08-19 14:18:58', 1, 15.00),
(119, 148, 1, 343.00, '2023-08-19 21:24:25', 6, 2058.00),
(120, 148, 4, 15.00, '2023-08-19 21:24:26', 2, 30.00),
(121, 149, 4, 15.00, '2023-08-19 21:49:47', 10, 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rep_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment` double DEFAULT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `cost` double NOT NULL,
  `booking` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `sub_category`, `description`, `quantity`, `unit_price`, `cost`, `branch`) VALUES
(1, 'Pizza', 1, '', 6000, 353.00, 343.00, 1),
(2, 'Fried rice', 4, 'gfgfdg', 300, 4.00, 45.67, 2),
(4, 'Lonart', 1, '', 1234, 20.00, 15.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `receiver`, `message`, `date`) VALUES
(1, '', 'rgrgd 4ttwerewr', '2022-11-25 08:43:18'),
(2, '', 'This Message finds you well', '2023-03-22 18:07:17'),
(3, '0542089814', 'hi', '2023-08-19 14:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `sms_api`
--

CREATE TABLE `sms_api` (
  `id` int(11) NOT NULL,
  `api` text NOT NULL,
  `header` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sms_api`
--

INSERT INTO `sms_api` (`id`, `api`, `header`) VALUES
(3, 'OnNhbmtvZmExOQ==', 'Bistech_GH');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `cat_id`) VALUES
(1, 'Main product', 7);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`) VALUES
(1, 'income'),
(2, 'expenses');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `reset_password` varchar(200) DEFAULT NULL,
  `reset` tinyint(4) NOT NULL DEFAULT 0,
  `verify_email` tinyint(4) NOT NULL DEFAULT 1,
  `verify_code` varchar(200) DEFAULT NULL,
  `role` varchar(200) NOT NULL,
  `access` text NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `contact`, `password`, `reset_password`, `reset`, `verify_email`, `verify_code`, `role`, `access`, `branch`) VALUES
(2, 'kessie bismark', 'kessiebismark19@gmail.com', '0542089814', 'J+j20nZ0+zMF0obwtM8NTQ==', NULL, 0, 0, 'xKfmju9Iq3NtW9uNG2uoQA==', 'Super Admin', 'SC0,SC2,SC3,SSC0,SSC1,SSC2,SSC3,SSE0,SSE1,SSE2,SSE3,B1,SS0,SS1,SR0,SR1,C0,C1,C2,C3,SP0,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IIE0,IIE1,IIE2,IIE3,IIE4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EEE0,EEE1,EEE2,EEE3,EEE4,CR0,B2,B3,CR1,CR2,CR3,SP1,SP2,B0,S0,S1,S2,SR2,IE0,IE1,IE2,IE3,IE4,EE0,EE1,EE2,EE3,EE4,SR3,SR4,C4,CF0,CF1,CF2,CF3,CF4,PS0,PS2,PS1,SC1,SE0,SE1,SE2,SE3,PE3,PE2,PE1,PE0,PSC0,PSC1,PSC2,PSC3,PC0,PC1,PC2,PC3', 0),
(11, 'Kwasi Baidoo ', 'baidookwasi1993@gmail.com', '0555873812', '7MDN3eF5i0mx+e3XnGLLxQ==', NULL, 0, 0, 'GIRBJ68/gu9nRTZ0g7RVdA==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0),
(13, 'nana ecolog', 'qweccikyei@outlook.com', '0557041300', 'Tg28vHsipMs1Rxb+mfShYA==', NULL, 0, 0, 'WDNxrw420iBF847ghvWwGg==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0),
(14, 'Bright Dadzie', 'brightyorke900@gmail.com', '0540231373', 'TRHOdfGQXF9zkbnM/A4qCQ==', 'uea/MnBYnrOVkm2MdtXOKA==', 0, 0, 'VZwPesv5xBqEnO5jXZRvNg==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0),
(15, 'Kwame Adu Gyamfi', 'abigadus@yahoo.com', '0244290756', '/+G/H4vA/XVPGqwhlFcEOw==', NULL, 0, 0, 'a2Dn0u5trOkUK7kMSvfj7g==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0),
(20, 'Lewis Adjei ', 'lewisadjei3@gmail.com', '0544634846', 'J+j20nZ0+zMF0obwtM8NTQ==', NULL, 0, 0, '+IOPBUtoY6A6913Z0Faa/w==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0),
(18, 'Augustine Morgan', 'morganaugustine138@gmail.com', '0556639082', 'G0yH1R+XTa0LcAmZdK+9wg==', NULL, 0, 0, 'WYKy29nr//Y1F1bi+3QAoQ==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0),
(21, NULL, 'nanatsibu.nt@gmail.com', '0249001178', NULL, NULL, 0, 1, 'SUWgXmRb4krgpUBgqMJcNg==', 'Super Admin', 'PC0,PC1,PC2,PC3,PSC0,PSC1,PSC2,PSC3,PE0,PE1,PE2,PE3,VR0,VR1,VR2,PS0,PS1,PS2,S0,S1,S2,SR0,SR1,SR2,C0,C1,C2,C3,B0,B1,B2,B3,CR0,CR1,CR2,CR3,SP0,SP1,IC0,IC1,IC2,IC3,IC4,ISC0,ISC1,ISC2,ISC3,ISC4,IE0,IE1,IE2,IE3,IE4,CF0,CF1,CF2,CF3,CF4,EC0,EC1,EC2,EC3,EC4,ESC0,ESC1,ESC2,ESC3,ESC4,EE0,EE1,EE2,EE3,EE4', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_balance`
--
ALTER TABLE `cash_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_balance_month`
--
ALTER TABLE `cash_balance_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cf_das`
--
ALTER TABLE `cf_das`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cf_dash`
--
ALTER TABLE `cf_dash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closed_month`
--
ALTER TABLE `closed_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch` (`branch`);

--
-- Indexes for table `exp_category`
--
ALTER TABLE `exp_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_sub_category`
--
ALTER TABLE `exp_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch` (`branch`);

--
-- Indexes for table `in_category`
--
ALTER TABLE `in_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_sub_category`
--
ALTER TABLE `in_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_api`
--
ALTER TABLE `sms_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_balance`
--
ALTER TABLE `cash_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `cash_balance_month`
--
ALTER TABLE `cash_balance_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cf_das`
--
ALTER TABLE `cf_das`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cf_dash`
--
ALTER TABLE `cf_dash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `closed_month`
--
ALTER TABLE `closed_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exp_category`
--
ALTER TABLE `exp_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exp_sub_category`
--
ALTER TABLE `exp_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `in_category`
--
ALTER TABLE `in_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `in_sub_category`
--
ALTER TABLE `in_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_api`
--
ALTER TABLE `sms_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
