-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 09:57 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog3`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_assign_company`
--

CREATE TABLE `agent_assign_company` (
  `id` int(11) UNSIGNED NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_assign_company`
--

INSERT INTO `agent_assign_company` (`id`, `agent_id`, `company_id`, `is_verified`) VALUES
(17, 6, 16, 1),
(18, 7, 58, 0),
(19, 6, 61, 0),
(20, 8, 65, 1),
(21, 8, 65, 1);

-- --------------------------------------------------------

--
-- Table structure for table `agent_seller_agreement`
--

CREATE TABLE `agent_seller_agreement` (
  `id` int(11) UNSIGNED NOT NULL,
  `document` varchar(200) DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `items` varchar(255) DEFAULT NULL,
  `discount_applied_on` varchar(200) DEFAULT NULL,
  `if_quantity` int(11) DEFAULT NULL,
  `if_order_amount` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_seller_agreement`
--

INSERT INTO `agent_seller_agreement` (`id`, `document`, `unique_id`, `items`, `discount_applied_on`, `if_quantity`, `if_order_amount`, `discount`, `buyer_id`, `seller_id`, `agent_id`, `created_at`, `updated_at`) VALUES
(5, NULL, '619170937', ',39,41,', 'quantity', 44, 0, 85, 84, 18, 19, '2021-04-23 09:42:16', '2021-04-23 09:42:16'),
(9, '16214133611-homepage-desktop-wsc.jpg', '621413362', ',16,17,18,19,', 'quantity', 10, 0, 5, 46, 18, 1, '2021-05-19 08:36:01', '2021-05-19 08:36:01'),
(10, '16216048860_3_3.PNG', '621604887', ',16,17,18,19,', 'over_all_order', 0, 1500, 10, 16, 18, 4, '2021-05-21 13:48:06', '2021-05-21 13:48:06'),
(11, '16219516850_3_3.PNG', '621951686', ',16,17,23,26,', 'over_all_order', 0, 25000, 15, 58, 18, 1, '2021-05-25 14:08:05', '2021-05-25 14:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'aa', 1, '2021-03-03 12:12:40', NULL),
(2, 'test', 1, '2021-03-03 12:12:48', NULL),
(3, 'test', 1, '2021-03-03 12:17:03', NULL),
(4, 'zczxc', 1, '2021-03-03 12:18:51', NULL),
(5, 'hiiii', 1, '2021-03-05 06:11:38', NULL),
(6, 'test 3', 86, '2021-03-12 01:22:40', NULL),
(7, 'germents', 18, '2021-03-18 11:49:17', NULL),
(8, 'misbah caegorey', 92, '2021-04-05 08:07:36', NULL),
(9, 'Toy', 18, '2021-04-07 11:39:04', NULL),
(10, 'germent', 18, '2021-04-07 11:56:00', NULL),
(11, 'Oil', 18, '2021-04-07 11:56:00', NULL),
(12, 'Toy', 93, '2021-04-07 12:27:28', NULL),
(13, 'germent', 93, '2021-04-07 12:27:28', NULL),
(14, 'Oil', 93, '2021-04-07 12:27:28', NULL),
(15, 'Toy', 94, '2021-04-07 01:34:43', NULL),
(16, 'germent', 94, '2021-04-07 01:34:44', NULL),
(17, 'Oil', 94, '2021-04-07 01:34:44', NULL),
(18, 'Toy', 97, '2021-04-08 01:45:55', NULL),
(19, 'germent', 97, '2021-04-08 01:45:55', NULL),
(20, 'Oil', 97, '2021-04-08 01:45:55', NULL),
(21, 'Toy', 92, '2021-04-12 08:59:33', NULL),
(22, 'germent', 92, '2021-04-12 08:59:33', NULL),
(23, 'Oil', 92, '2021-04-12 08:59:33', NULL),
(24, 'germents', 18, '2021-04-16 06:14:30', NULL),
(25, 'Toy', 114, '2021-04-23 10:23:12', NULL),
(26, 'germent', 114, '2021-04-23 10:23:12', NULL),
(27, 'Oil', 114, '2021-04-23 10:23:12', NULL),
(28, 'Toy', 117, '2021-05-20 01:26:59', NULL),
(29, 'germent', 117, '2021-05-20 01:26:59', NULL),
(30, 'Oil', 117, '2021-05-20 01:26:59', NULL),
(31, 'Toy', 139, '2021-08-06 07:23:08', NULL),
(32, 'germent', 139, '2021-08-06 07:23:08', NULL),
(33, 'Oil', 139, '2021-08-06 07:23:08', NULL),
(34, 'Toy', 140, '2021-08-06 09:11:39', NULL),
(35, 'germent', 140, '2021-08-06 09:11:39', NULL),
(36, 'Oil', 140, '2021-08-06 09:11:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comapny`
--

CREATE TABLE `comapny` (
  `id` int(11) NOT NULL,
  `comapny` varchar(256) DEFAULT NULL,
  `comapny_type` varchar(256) DEFAULT NULL,
  `company_name` varchar(256) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `ntn` varchar(256) DEFAULT NULL,
  `cnic_number` varchar(256) DEFAULT NULL,
  `user_type` varchar(256) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `ntn_number` varchar(256) DEFAULT NULL,
  `ntn_image` text DEFAULT NULL,
  `registered_address` text DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `landline_number` varchar(256) DEFAULT NULL,
  `strn_number` varchar(256) DEFAULT NULL,
  `strn_image` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_status` varchar(256) DEFAULT NULL,
  `company_type` text DEFAULT NULL,
  `cnic_front_image` text DEFAULT NULL,
  `cnic_back_image` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comapny`
--

INSERT INTO `comapny` (`id`, `comapny`, `comapny_type`, `company_name`, `organization_name`, `ntn`, `cnic_number`, `user_type`, `logo`, `ntn_number`, `ntn_image`, `registered_address`, `delivery_address`, `landline_number`, `strn_number`, `strn_image`, `user_id`, `company_status`, `company_type`, `cnic_front_image`, `cnic_back_image`, `created_at`, `updated_at`) VALUES
(11, 'registered', 'PVT ltd', 'Max mart', NULL, 'ntn', '421012584654654', NULL, NULL, '654646546545', NULL, 'civic center karachi,karachi', 'civic center karachi,karachi', '1314654654654', '', NULL, 79, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-11 07:20:14', '2021-03-11 07:20:18'),
(12, 'registered', 'PVT ltd', 'asdaada', NULL, 'ntn', '564646546464', NULL, NULL, '56465465564', NULL, 'assdadasd', 'adadsasds', '654654654654', '', NULL, 80, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-11 10:47:08', '2021-03-11 01:41:23'),
(13, 'unregistered', NULL, NULL, 'asdfcsdsd', NULL, '564654654564', NULL, NULL, NULL, NULL, 'asdasddas sddfsdf', '654assdsad', '56456564654', NULL, NULL, 81, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-11 12:58:30', '2021-03-11 01:23:54'),
(14, 'registered', 'PVT ltd', 'asdcsdxzc', NULL, 'ntn', '56464654564', NULL, NULL, '64654564564', NULL, 'asdsdsd', 'asdasdads', '654654654', '', NULL, 82, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-11 01:53:11', '2021-03-11 01:53:16'),
(15, 'registered', 'PVT ltd', 'xczcxxzc', NULL, 'ntn', '6546546465564', NULL, NULL, '564654654654', NULL, 'awsadssa sddf', 'sadsadasd', '6546546546', '', NULL, 83, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-11 02:04:36', '2021-03-11 02:06:24'),
(16, 'registered', 'PVT ltd', 'abbas wear house', NULL, 'ntn', '45654654654654', 'buyer', NULL, '65465465465', '16215998109550_3_2.PNG', 'test rfsf', 'asdasdsd', '65464654', '', '16215998109550_3_2.PNG', 84, NULL, ',1,2,3,4,5,6,7,', '16215998109550_3_2.PNG', '16215998109550_3_2.PNG', '2021-03-11 02:10:00', '2021-03-11 02:27:29'),
(17, 'registered', 'PVT ltd', 'adasdad', NULL, 'ntn', '35646546546', NULL, NULL, '5646465464', NULL, 'adasdasd', 'adasdasd', '646464654', '', NULL, 85, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-11 03:00:59', '2021-03-11 03:01:20'),
(18, 'registered', 'PVT ltd', 'aedasdasd', NULL, 'ntn', '6546546465464', NULL, NULL, '65464646546546', NULL, 'asdsasdsad sdasd', 'sadasdasd', '65456464645', '', NULL, 84, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-12 07:51:04', '2021-03-12 07:51:08'),
(19, 'registered', 'PVT ltd', 'abbas wear house', NULL, 'ntn', '45654654654654', NULL, NULL, '65465465465', NULL, 'test rfsf', 'asdasdsd', '65464654', '', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 08:35:50', NULL),
(20, 'registered', 'PVT ltd', 'asdasdasdasd', NULL, 'ntn', '3541654654654', 'seller', NULL, '654654654', NULL, 'awdasdasd', 'sadsdsad', '88888888', '', NULL, 87, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-16 08:40:34', '2021-03-16 11:16:01'),
(21, 'registered', 'PVT ltd', 'dzdzxzc', NULL, 'ntn', '6526545464', 'seller', NULL, '654654654654', NULL, 'adsadsad sdfsdf', 'szdcsddc', '654654654654', '', NULL, 88, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-16 01:16:56', '2021-03-16 01:25:09'),
(22, 'registered', 'PVT ltd', 'test', NULL, 'ntn', '654646465464', '', NULL, 'sadsd6464654', NULL, 'sadsdasd', 'asdadda aadad', '66464664', '', NULL, 89, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-03-29 01:58:09', '2021-03-29 01:59:06'),
(23, 'registered', 'PVT ltd', 'misbah interprice', NULL, 'ntn', '314321321321231', 'seller', NULL, '1312132213132', NULL, 'test misbah', 'test misbah', '3654654654654', '', NULL, 92, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-04-05 07:12:11', '2021-04-05 07:26:08'),
(24, 'registered', 'PVT ltd', 'zczzxc', NULL, 'ntn', '6546464654', NULL, '16183155208361616394392484WIN_20191029_16_02_38_Pro (2).jpg', '6465464654', NULL, 'szxczxcxc', 'zdvcxcvvxc', '6546464645', '', NULL, 18, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-04-07 10:17:06', '2021-04-13 12:05:20'),
(25, 'registered', 'PVT ltd', 'Ammas  and sons', NULL, 'ntn', '6465464654564564', 'seller', NULL, '64646464', NULL, 'asdsadasdsd', 'asdasdsad', '65464654654', '', NULL, 93, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-04-07 12:23:01', '2021-04-07 12:23:24'),
(26, 'unregistered', NULL, NULL, 'test', NULL, '5465465465', NULL, NULL, NULL, NULL, 'sadsdsd', 'zscszdcxzc', '65465465465', NULL, NULL, 93, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-04-07 12:24:39', '2021-04-07 12:24:44'),
(27, 'registered', 'PVT ltd', 'asdsasd', NULL, 'ntn', '654564654654', 'seller', NULL, '64654564654', NULL, 'sadazsd', 'dascasdds', '6465465464', '', NULL, 94, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-04-07 01:30:18', '2021-04-07 01:30:21'),
(28, 'registered', 'PVT ltd', 'company 2', NULL, 'ntn', '464654654654654', 'seller', NULL, '654654654564', NULL, 'asdazsasd', 'asdasasd', '654654654', '', NULL, 94, NULL, '1,2,3,4,5,6,7', NULL, NULL, '2021-04-07 02:27:18', '2021-04-07 02:27:21'),
(29, 'registered', 'PVT ltd', 'fdsfdsfdsf', NULL, 'ntn', '65464656654654', 'seller', NULL, '6564654655654', NULL, 'asdaassd asdad', 'adsassad asdsad', '6565465654', '', NULL, 95, NULL, ',1,2,', NULL, NULL, '2021-04-08 12:18:50', '2021-04-08 12:27:47'),
(30, 'registered', 'PVT ltd', 'sxdcxdzxc', NULL, 'ntn', '6546545646546', 'seller', NULL, '64654564654', NULL, 'asdassad sddf', '646asdasd', '64654654564', '', NULL, 96, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-08 01:35:13', '2021-04-08 01:38:52'),
(31, 'registered', 'PVT ltd', 'asdasd', NULL, 'ntn', '655464654654', 'seller', NULL, '654564654654564', NULL, 'adcasdsd', 'assdasdds', '65465465465', '', NULL, 97, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-08 01:39:27', '2021-04-08 01:39:31'),
(32, 'registered', 'PVT ltd', 'adsdsad', NULL, 'ntn', '654564654', 'seller', NULL, '646565465', NULL, 'sdfsdf', 'sdfsddf', '64654654654', '', NULL, 97, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-08 01:46:22', '2021-04-08 01:46:26'),
(33, 'registered', 'PVT ltd', 'test 2', NULL, 'ntn', '654645646464', 'seller', NULL, '6asdd', NULL, 'dcdzsc sddsads', 'zdczxcxzc zd', '64646464', '', NULL, 18, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-09 01:53:14', '2021-04-09 01:53:20'),
(34, 'registered', 'PVT ltd', 'test 3', NULL, 'ntn', '566565656464', 'seller', NULL, '3364564654', NULL, 'adssdad', '6546sfvxv', '65465456654', '', NULL, 18, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-09 02:18:43', '2021-04-09 02:18:48'),
(35, 'registered', 'PVT ltd', 'adczs', NULL, 'ntn', '65464654', 'seller', NULL, '3641654654', NULL, 'asdcasd dsfsdf', 'zxdcvxzc', '6546464645', '', NULL, 86, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-12 07:53:22', '2021-04-12 07:53:24'),
(36, 'registered', 'PVT ltd', 'zdsczxc', NULL, 'ntn', '646465464', 'seller', NULL, '654654564654', NULL, 'asscxzxc', 'zdczdc', '65464654654', '', NULL, 92, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-12 08:42:08', '2021-04-12 08:42:11'),
(37, 'unregistered', NULL, NULL, 'zdczzxc', NULL, '56465464', 'seller', NULL, NULL, NULL, 'dsczdc', '6dzczc', '65465464', NULL, NULL, 92, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-12 09:06:06', '2021-04-12 09:06:11'),
(38, 'registered', 'PVT ltd', 'zxczzxc', NULL, 'ntn', '56456654', 'seller', NULL, 'zdxdczx', NULL, 'zdzczxczxc', 'zdxczxcc', '65464654', '', NULL, 98, NULL, NULL, NULL, NULL, '2021-04-12 10:31:38', NULL),
(39, 'registered', 'PVT ltd', 'sdzccc', NULL, 'ntn', '564646464', 'seller', NULL, 'adaas646654', NULL, '6zcxzc', 'sdzcszdc', '65464564654', '', NULL, 99, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-12 11:38:38', '2021-04-12 11:38:41'),
(40, 'registered', 'PVT ltd', 'asdczdczc', NULL, 'ntn', '4646465464', 'buyer', NULL, '646465464', NULL, 'asxzxxc xffvx', 'zdczxzxc', '5446564654', '', NULL, 100, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-12 11:40:02', '2021-04-12 11:40:06'),
(41, 'unregistered', NULL, NULL, 'szxczxc', NULL, '6464646', 'seller', NULL, NULL, NULL, 'zsxczxczc', 'zdczxczxc', '6546464', NULL, NULL, 101, NULL, NULL, NULL, NULL, '2021-04-13 07:40:07', NULL),
(42, 'unregistered', NULL, NULL, 'dfvxcvxcv', NULL, '236123123', 'seller', '16182999202831617091009675chair.jpg', NULL, NULL, 'xdczxzxcxc', 'zczczczc', '63456456', NULL, NULL, 101, NULL, NULL, NULL, NULL, '2021-04-13 07:45:20', NULL),
(43, 'registered', 'PVT ltd', 'zdxcxzczc', NULL, 'ntn', '654664', 'seller', NULL, 'szxczxc', NULL, '66', 'zxczxc', '6514654654', '', NULL, 90, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-13 11:05:24', '2021-04-13 11:05:27'),
(44, 'registered', 'PVT ltd', 'zxczczc', NULL, 'ntn', '646654564', 'buyer', '1618311999169logo-245x73.png', '654654654654', NULL, 'asdxasdad', 'asadsasdd', '65465465464', '', NULL, 103, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-13 11:06:39', '2021-04-13 11:06:43'),
(45, 'unregistered', NULL, NULL, 'dczsczxc', NULL, '6546464', 'buyer', '1618894986511616394392484WIN_20191029_16_02_38_Pro (2).jpg', NULL, NULL, 'zczxczx', 'zczczcx', '5645646654', NULL, NULL, 105, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-20 05:03:06', '2021-04-20 05:08:20'),
(46, 'unregistered', NULL, NULL, 'awsdadasd', NULL, '654665464654', 'buyer', '1618981136452161555542860t-shirt-white-back-500x500.png', NULL, NULL, 'ddadad asdada', 'asdasdad assaDD', '6546546564', NULL, NULL, 108, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-21 04:58:56', '2021-04-21 04:59:00'),
(47, 'registered', 'PVT ltd', '465asxdas', NULL, 'ntn', '65464654', 'seller', '1619215201718161555542860t-shirt-white-back-500x500.png', '65465464', NULL, 'dcdzsczdc', 'sczxczxc', '654654645', '', NULL, 111, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-23 10:00:01', '2021-04-23 10:00:06'),
(48, 'unregistered', NULL, NULL, 'dczcxzxc', NULL, '24654654', 'seller', '1619216203902161555542860t-shirt-white-back-500x500.png', NULL, NULL, 'czxzczc', 'zxczzxczcxx', '6546465', NULL, NULL, 114, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-23 10:16:43', '2021-04-23 10:19:26'),
(49, 'registered', 'PVT ltd', 'asdzdszsdasd', NULL, 'ntn sales tax', '665465464', 'seller', NULL, '6546464654', NULL, 'adddsadsd', 'asdsasdds', '6546564', '65464654', NULL, 114, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-23 10:22:41', '2021-04-23 10:22:46'),
(50, 'unregistered', NULL, NULL, 'dczxczxc', NULL, '5646654654', 'buyer', NULL, NULL, NULL, '6546464adczdc', 'saddszdc', '65464654', NULL, NULL, 115, NULL, ',1,2,3,4,5,6,7,', NULL, NULL, '2021-04-23 10:25:19', '2021-04-23 10:25:24'),
(51, 'registered', 'PVT ltd', 'asdadads', NULL, 'ntn', '6465465654', 'seller', NULL, '5646654', NULL, 'adasd', NULL, '646546565', '', NULL, 116, NULL, NULL, '1621499995444t-shirt-white-back-500x500.png', '1621499995624t-shirt-white-front-500x500.png', '2021-05-20 08:39:55', NULL),
(52, 'registered', 'PVT ltd', 'Minimax20', NULL, 'ntn', '6464646546546', 'seller', '1621517178452logo-245x73.png', '46464654654', NULL, 'asddsds sddfsf', 'sdfsdff sdfsdf', '64654654654', '', NULL, 117, NULL, ',1,2,3,4,5,6,7,', '1621517178991t-shirt-white-back-500x500.png', '1621517178435t-shirt-white-front-500x500.png', '2021-05-20 01:26:18', '2021-05-20 01:26:25'),
(53, 'registered', 'PVT ltd', 'sdfsdfsf', NULL, 'ntn', '56464654654644', 'buyer', '1621518874996logo-245x73.png', '4564664', NULL, 'sadsd', 'dacsadds', '646465465', '', NULL, 119, NULL, ',1,2,3,4,5,6,7,', '16215188742553.png', '16215188748184.png', '2021-05-20 01:54:34', '2021-05-20 01:54:39'),
(54, 'registered', 'PVT ltd', 'adasdad', NULL, 'ntn', '45646565464', 'buyer', '1621599810606logo-245x73.png', '56456664654', NULL, 'adeasdsad', 'sdadsadsda', '646465465654', '', NULL, 120, NULL, ',1,2,3,4,5,6,7,', '16215998102720_3_1.PNG', '16215998109550_3_2.PNG', '2021-05-21 12:23:30', '2021-05-21 12:29:16'),
(55, 'unregistered', NULL, NULL, 'sdfcsdfsdf', NULL, '65464655', 'buyer', '16216002629400_3_3.PNG', NULL, NULL, 'dfgdffgfg', 'dfgdfgdfdfg', '4564564646', NULL, NULL, 121, NULL, ',1,2,3,4,5,6,7,', '16216002625990_3_1.PNG', '16216002629770_3_2.PNG', '2021-05-21 12:31:02', '2021-05-21 12:31:06'),
(56, 'registered', 'PVT ltd', 'seller generate company', NULL, 'ntn', '414646546464', 'buyer', '1621603830629logo-245x73.png', '6546464654', NULL, 'asdasdsd sadssd', 'sdsad adasd', '6546456646', '', NULL, 122, NULL, ',1,2,3,4,5,6,7,', '1621603830845WIN_20191029_16_02_38_Pro (2).jpg', '1621603830967WIN_20191029_16_02_38_Pro.jpg', '2021-05-21 01:30:30', '2021-05-21 01:30:34'),
(57, 'unregistered', NULL, NULL, 'asdasdasd', NULL, '6546464', 'buyer', '1621603925637WIN_20191029_16_02_42_Pro.jpg', NULL, NULL, 'adsasdsd', 'sadsadd', '65464654', NULL, NULL, 123, NULL, ',1,2,3,4,5,6,7,', '1621603925823WIN_20191029_16_02_38_Pro (2).jpg', '162160392545WIN_20191029_16_02_38_Pro.jpg', '2021-05-21 01:32:05', '2021-05-21 01:32:10'),
(58, 'registered', 'PVT ltd', 'R buyer company', NULL, 'ntn', '42646646546', 'buyer', '1621949046721logo.png', '6464654666546', NULL, 'adasd sdfds', 'asdsad sdfsf', '65465665654', '', NULL, 129, NULL, ',1,2,3,4,5,6,7,', '1621949046187t-shirt-white-back-500x500.png', '1621949046528t-shirt-white-front-500x500.png', '2021-05-25 01:24:06', '2021-05-25 01:24:13'),
(59, 'registered', 'PVT ltd', 'adasad', NULL, 'ntn', '13123131313213', 'seller', '16224551006981-homepage-desktop-wsc.jpg', 'szczxczx', '1622455100365WIN_20191029_16_02_38_Pro (2).jpg', 'asddcas', 'scxzc', '26315113', '', NULL, 130, NULL, NULL, '1622455100987QRcode_QRNormal (1).jpg', '162245510071QRcode_QRNormal.jpg', '2021-05-31 09:58:20', NULL),
(60, 'registered', 'PVT ltd', 'test company', NULL, 'ntn', '425654646465', 'buyer', '1622812848568logo-245x73.png', '4564646466465', '1622812848585dann.PNG', 'wsgjasdhjasd', 'gfdfgdgd', '65465465465446', '', NULL, 132, NULL, ',1,2,3,4,5,6,7,', '16228128483980_3_1.PNG', '16228128489970_3_2.PNG', '2021-06-04 01:20:48', '2021-06-04 01:20:51'),
(61, 'registered', 'PVT ltd', 'asdasdasd', NULL, 'ntn', '564654654', 'buyer', '16228132022120_3_1.PNG', '654654654654', '1622813202728WIN_20191029_16_02_42_Pro.jpg', 'akjdwhajshdjads', 'saedasdad', '546456654654', '', NULL, 134, NULL, ',1,2,3,4,5,6,7,', '1622813202119WIN_20191029_16_02_38_Pro (2).jpg', '1622813202443WIN_20191029_16_02_39_Pro.jpg', '2021-06-04 01:26:42', '2021-06-04 01:26:45'),
(62, 'registered', 'PVT ltd', 'jhsdjsdj', NULL, 'ntn', '6546546464', 'seller', '1628080378561chair_2.png', '6464646464', '1628080378106QRcode_QRNormal (1).jpg', 'sddsdd', 'sddsdsd', '6546546546465', '', NULL, 138, NULL, ',1,2,3,4,5,6,7,', '162808037838QRcode_QRNormal (1).jpg', '1628080378547circle-cropped.png', '2021-08-04 12:32:58', '2021-08-04 12:33:03'),
(63, 'registered', 'PVT ltd', 'test aqeel', NULL, 'ntn', '56464564654', 'seller', '1628234516853about_us.png', '665465464', '16282345163903.png', 'test address', 'test address', '4566465465464', '', NULL, 139, NULL, ',1,2,3,4,5,6,7,', '16282345162011611816724492.JPEG', '1628234516450amna.png', '2021-08-06 07:21:56', '2021-08-06 07:22:00'),
(64, 'registered', 'PVT ltd', 'aqeel buyer', NULL, 'ntn', '3541564654564', 'seller', '1628235205366QRcode_QRNormal.jpg', '64564646465654', '1628235205657circle-cropped.png', 'sedsdds aesdsd', 'asdad sadadsdsa', '56456465464', '', NULL, 140, NULL, ',1,2,3,4,5,6,7,', '16282352050chair_2.png', '1628235205828chair_2.png', '2021-08-06 07:33:25', '2021-08-06 07:33:28'),
(65, 'registered', 'PVT ltd', 'asdadadad', NULL, 'ntn', '654646545646', 'buyer', '1628240983187QRcode_QRNormal.jpg', '65464646465', '1628240983991QRcode_QRNormal.jpg', 'adsazdsasd', 'sadasdasd', '6464654654', '', NULL, 141, NULL, ',1,2,3,4,5,6,7,', '162824098395QRcode_QRNormal.jpg', '1628240983476QRcode_QRNormal.jpg', '2021-08-06 09:09:43', '2021-08-06 09:09:47'),
(66, 'unregistered', NULL, NULL, 'samoo', NULL, '654654654564', 'seller', '1628241580966WIN_20191029_16_02_38_Pro (2).jpg', NULL, NULL, 'asdadasdasd', 'asdasdasd', '65464646464', NULL, NULL, 140, NULL, ',1,2,3,4,5,6,7,', '1628241580310WIN_20191029_16_02_38_Pro.jpg', '1628241580389WIN_20191029_16_02_38_Pro.jpg', '2021-08-06 09:19:40', '2021-08-06 09:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_type`
--

INSERT INTO `company_type` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Industrial material', 1, '2021-03-10 18:36:08', NULL),
(2, 'Stationary', 1, '2021-03-10 18:36:33', NULL),
(3, 'Pharmaceutical', 1, '2021-03-10 18:37:58', NULL),
(4, 'Metals', 1, '2021-03-10 18:38:16', NULL),
(5, 'Consumar goods', 1, '2021-03-10 18:38:53', NULL),
(6, 'Computer and accessories', 1, '2021-03-10 18:38:53', NULL),
(7, 'Paint and accessories', 1, '2021-03-10 18:38:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `csv`
--

CREATE TABLE `csv` (
  `id` int(11) NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `csv`
--

INSERT INTO `csv` (`id`, `firstname`, `lastname`, `email`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Noor Mohommad', 'Hashmi', 'hashimtajir@gmail.com', 'male', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT 1,
  `seller_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_invoice` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_id`, `is_paid`, `seller_id`, `buyer_id`, `created_at`, `is_invoice`) VALUES
(82, 118, 0, 18, 84, '2021-06-24 11:26:00', 1),
(83, 119, 0, 18, 84, '2021-06-30 12:57:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

CREATE TABLE `delivery_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `quantity` varchar(256) DEFAULT NULL,
  `received_quantity` varchar(256) DEFAULT NULL,
  `is_received` tinyint(1) DEFAULT 0,
  `is_delivered` tinyint(1) DEFAULT 0,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`id`, `order_id`, `item_id`, `delivery_id`, `quantity`, `received_quantity`, `is_received`, `is_delivered`, `created_on`) VALUES
(101, 118, 76, 82, '2', '2', 1, 1, '2021-06-24 11:26:00'),
(102, 119, 76, 83, '2', '2', 1, 1, '2021-06-30 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `order_id` varchar(256) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT 0,
  `is_partial` tinyint(1) DEFAULT 0,
  `delivery_id` varchar(256) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_company_id` int(11) DEFAULT NULL,
  `buyer_company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `order_id`, `is_completed`, `is_partial`, `delivery_id`, `seller_id`, `buyer_id`, `seller_company_id`, `buyer_company_id`) VALUES
(29, '118', 1, 0, '82', 18, 84, 34, 16),
(30, '119', 0, 0, '83', 18, 84, 34, 16);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `is_received` tinyint(1) DEFAULT 0,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `invoice_id`, `quantity`, `order_id`, `item_id`, `delivery_id`, `is_received`, `created_on`) VALUES
(28, 29, 2, 118, 76, 82, 0, '2021-06-24 01:33:01'),
(29, 30, 2, 119, 76, 83, 0, '2021-06-30 01:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_12_145959_create_permission_tables', 1),
(4, '2021_04_07_105540_create_csv_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(3, 'App\\User', 14),
(3, 'App\\User', 15),
(3, 'App\\User', 16),
(3, 'App\\User', 17),
(3, 'App\\User', 18),
(3, 'App\\User', 86),
(3, 'App\\User', 90),
(3, 'App\\User', 91),
(3, 'App\\User', 92),
(3, 'App\\User', 93),
(3, 'App\\User', 94),
(3, 'App\\User', 95),
(3, 'App\\User', 96),
(3, 'App\\User', 97),
(3, 'App\\User', 98),
(3, 'App\\User', 99),
(3, 'App\\User', 101),
(3, 'App\\User', 111),
(3, 'App\\User', 113),
(3, 'App\\User', 114),
(3, 'App\\User', 116),
(3, 'App\\User', 117),
(3, 'App\\User', 126),
(3, 'App\\User', 127),
(3, 'App\\User', 128),
(3, 'App\\User', 130),
(3, 'App\\User', 135),
(3, 'App\\User', 136),
(3, 'App\\User', 138),
(3, 'App\\User', 139),
(3, 'App\\User', 140),
(4, 'App\\User', 19),
(4, 'App\\User', 20),
(4, 'App\\User', 21),
(4, 'App\\User', 22),
(4, 'App\\User', 23),
(4, 'App\\User', 24),
(4, 'App\\User', 25),
(4, 'App\\User', 26),
(4, 'App\\User', 27),
(4, 'App\\User', 28),
(4, 'App\\User', 29),
(4, 'App\\User', 30),
(4, 'App\\User', 31),
(4, 'App\\User', 32),
(4, 'App\\User', 33),
(4, 'App\\User', 34),
(4, 'App\\User', 35),
(4, 'App\\User', 36),
(4, 'App\\User', 37),
(4, 'App\\User', 38),
(4, 'App\\User', 39),
(4, 'App\\User', 40),
(4, 'App\\User', 41),
(4, 'App\\User', 42),
(4, 'App\\User', 43),
(4, 'App\\User', 44),
(4, 'App\\User', 45),
(4, 'App\\User', 46),
(4, 'App\\User', 47),
(4, 'App\\User', 48),
(4, 'App\\User', 49),
(4, 'App\\User', 79),
(4, 'App\\User', 80),
(4, 'App\\User', 82),
(4, 'App\\User', 84),
(4, 'App\\User', 85),
(4, 'App\\User', 87),
(4, 'App\\User', 88),
(4, 'App\\User', 89),
(4, 'App\\User', 100),
(4, 'App\\User', 102),
(4, 'App\\User', 103),
(4, 'App\\User', 105),
(4, 'App\\User', 108),
(4, 'App\\User', 115),
(4, 'App\\User', 119),
(4, 'App\\User', 120),
(4, 'App\\User', 121),
(4, 'App\\User', 122),
(4, 'App\\User', 123),
(4, 'App\\User', 129),
(4, 'App\\User', 132),
(4, 'App\\User', 134),
(4, 'App\\User', 141),
(5, 'App\\User', 104),
(5, 'App\\User', 109),
(5, 'App\\User', 118),
(5, 'App\\User', 124),
(5, 'App\\User', 125),
(5, 'App\\User', 131),
(5, 'App\\User', 133),
(5, 'App\\User', 142);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `is_paid` tinyint(1) DEFAULT 0,
  `is_delivered` tinyint(1) DEFAULT 0,
  `is_recived` tinyint(1) DEFAULT 0,
  `is_rejected` tinyint(1) DEFAULT 0,
  `total_price` varchar(256) DEFAULT NULL,
  `total_price_with_ST` varchar(256) DEFAULT NULL,
  `comapny_id` int(11) DEFAULT NULL,
  `seller_company_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_partial` tinyint(1) DEFAULT 0,
  `partial_amount` varchar(256) DEFAULT NULL,
  `change_gst` varchar(256) DEFAULT NULL,
  `reject_reason` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `is_paid`, `is_delivered`, `is_recived`, `is_rejected`, `total_price`, `total_price_with_ST`, `comapny_id`, `seller_company_id`, `seller_id`, `buyer_id`, `created_at`, `updated_at`, `is_partial`, `partial_amount`, `change_gst`, `reject_reason`) VALUES
(118, 0, 1, 1, 0, '2400', '2640', 16, 34, 18, 84, '2021-06-24 11:25:44', NULL, 0, NULL, NULL, NULL),
(119, 0, 1, 1, 0, '2400', '2640', 16, 34, 18, 84, '2021-06-30 12:57:36', NULL, 0, NULL, NULL, NULL),
(120, 0, 0, 0, 0, '2400', '2640', 65, 64, 140, 141, '2021-08-06 09:18:05', NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `is_delivered` tinyint(1) DEFAULT 0,
  `is_received` tinyint(1) DEFAULT 0,
  `is_rejected` tinyint(1) DEFAULT 0,
  `is_paid` tinyint(1) DEFAULT 0,
  `payment_id` int(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `delivery_id`, `is_delivered`, `is_received`, `is_rejected`, `is_paid`, `payment_id`, `created_at`) VALUES
(151, 118, 76, 2, 82, 1, 1, 0, 0, 0, '2021-06-24 11:25:44'),
(152, 119, 76, 2, 83, 1, 1, 0, 0, 0, '2021-06-30 12:57:36'),
(153, 120, 83, 2, NULL, 0, 0, 0, 0, 0, '2021-08-06 09:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `total_payment` varchar(256) DEFAULT NULL,
  `tax_detection` varchar(256) DEFAULT NULL,
  `adjustement_amount` varchar(256) DEFAULT NULL,
  `cheque_amount` varchar(256) DEFAULT NULL,
  `cheque_number` varchar(256) DEFAULT NULL,
  `cheque_date` varchar(256) DEFAULT NULL,
  `bank` varchar(256) DEFAULT NULL,
  `final_amount` varchar(256) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `invoice_id`, `total_payment`, `tax_detection`, `adjustement_amount`, `cheque_amount`, `cheque_number`, `cheque_date`, `bank`, `final_amount`, `created_on`) VALUES
(4, 15, '4600', '4.5', '4000', '4000', '64646564', '2021-06-14', 'AL HABIB', '4000', '2021-06-14 09:14:58'),
(5, 15, '4600', '4.5', '807', '807', '54646464', '2021-06-14', 'aszszxc', '807', '2021-06-14 02:24:01'),
(6, 18, '4800', '4.5', '4000', '4000', '654654654', '2021-06-15', 'al habib', '4000', '2021-06-15 01:23:54'),
(7, 18, '4800', '4.5', '1016', '1016', '64665464', '2021-06-15', 'al habib', '1016', '2021-06-15 02:14:46'),
(8, 19, '2000', '4.5', '2090', '2090', '51465465464', '2021-06-16', 'assfdsd', '2090', '2021-06-16 12:13:51'),
(9, 20, '2400', '4.5', '2508', '2508', '6464654', '2021-06-16', 'aedasas', '2508', '2021-06-16 12:56:16'),
(10, 22, '2400', '4.5', '2508', '2508', '6546464', '2021-06-17', 'al habib', '2508', '2021-06-17 10:03:34'),
(11, 23, '2400', '4.5', '2508', '2508', '3415646546', '2021-06-21', 'al habib', '2508', '2021-06-21 12:37:55'),
(12, 25, '2400', '4.5', '2508', '2508', '65464654', '2021-06-21', 'al habib', '2508', '2021-06-21 01:01:18'),
(13, 26, '4400', '4.5', '2000', '2000', '12345678955', '2021-06-21', 'Al habib', '2000', '2021-06-21 02:02:28'),
(14, 26, '4400', '4.5', '2598', '2598', '645646', '2021-06-21', 'al habib', '2598', '2021-06-21 02:06:59'),
(15, 27, '2000', '4.5', '1000', '1000', '56146464', '2021-06-22', 'al habib', '1000', '2021-06-22 11:42:14'),
(16, 29, '2400', '4.5', '2508', '2508', '654646', '2021-06-24', 'al habib', '2508', '2021-06-24 01:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users_manage', 'web', '2021-03-02 03:20:34', '2021-03-02 03:20:34'),
(2, 'inventory', 'web', '2021-03-03 09:23:42', '2021-03-03 09:23:42'),
(3, 'company', 'web', '2021-03-08 06:12:25', '2021-03-08 06:12:25'),
(4, 'buyer list', 'web', '2021-04-12 09:26:22', '2021-04-12 09:26:22'),
(5, 'company list', 'web', '2021-04-13 23:20:51', '2021-04-13 23:20:51'),
(6, 'create_buyer', 'web', '2021-04-19 22:56:23', '2021-04-19 23:01:15'),
(7, 'create_seller', 'web', '2021-04-19 23:22:14', '2021-04-19 23:22:14'),
(8, 'create_contract', 'web', '2021-05-19 03:07:36', '2021-05-19 03:07:36'),
(9, 'admin buyer list', 'web', '2021-06-18 02:37:48', '2021-06-18 02:37:48'),
(10, 'admin seller list', 'web', '2021-06-24 09:45:56', '2021-06-24 09:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `is_show` tinyint(1) DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `discount_price` varchar(256) DEFAULT NULL,
  `acutal_price` varchar(256) DEFAULT NULL,
  `gst` varchar(256) DEFAULT NULL,
  `skucode` varchar(256) DEFAULT NULL,
  `discription` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `exported` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `is_show`, `category_id`, `company_id`, `name`, `discount_price`, `acutal_price`, `gst`, `skucode`, `discription`, `images`, `exported`, `created_by`, `created_at`, `updated_at`) VALUES
(13, 1, 1, NULL, 'hii', '1000', '1200', NULL, '3', 'asddads', '161495200370_3_3.PNG ,1614952003369dann.PNG', '0', 2, '2021-03-05 01:46:43', NULL),
(14, 1, 2, NULL, 'test', '100', '1200', NULL, '3', 'szcxzxc', '16149521433360_3_1.PNG,16149521432830_3_2.PNG', '', 2, '2021-03-05 01:49:03', NULL),
(15, 1, 6, NULL, 'sdfsfsf', '1200', '1000', NULL, '7', 'test', '161555542860t-shirt-white-back-500x500.png', '', 86, '2021-03-12 01:23:48', NULL),
(16, 1, 7, NULL, 'test dsd', '1200', '1400', NULL, '8', 'test', '1616068210913t-shirt-white-back-500x500.png,1616068210626t-shirt-white-front-500x500.png', '', 18, '2021-03-29 11:52:49', NULL),
(17, 1, 7, NULL, 'farman', '1200', '1500', NULL, '8', 'dszcsdzcz', '1616394392484WIN_20191029_16_02_38_Pro (2).jpg', '', 18, '2021-03-29 11:52:38', NULL),
(18, 1, 7, NULL, 'dasas', '1000', '1500', NULL, '8', 'dcasddzxc', '1617091009675chair.jpg', '', 18, '2021-03-30 07:56:49', NULL),
(19, 1, 7, NULL, 'asdasd', '1200', '1400', NULL, '8', 'asdadsasd', '1617091317387chair_2.jpg', '', 18, '2021-03-30 08:01:57', NULL),
(20, 1, 8, 23, 'test', '1200', '1400', NULL, '9', 'test', '1617610104823t-shirt-white-back-500x500.png', ',36,', 92, '2021-04-05 08:08:24', NULL),
(21, 1, 8, 23, 'zadscazcz', '1200', '1400', NULL, '9', 'ascxzxczxc', '1617611529534t-shirt-white-front-500x500.png', ',36,', 92, '2021-04-05 08:32:09', NULL),
(22, 1, 9, 24, '1st product', '1200', '1400', NULL, '11', 'test1', NULL, '0', 18, '2021-04-07 11:55:59', NULL),
(23, 1, 10, 24, '2st product', '1000', '1200', NULL, '11', 'test2', NULL, '0', 18, '2021-04-07 11:56:00', NULL),
(24, 1, 11, 24, '3st product', '200', '300', NULL, '12', 'test3', NULL, '0', 18, '2021-04-07 11:56:00', NULL),
(25, 0, 9, 24, '1st product', '1200', '1400', NULL, '11', 'test1', NULL, '0,33,', 18, '2021-04-07 12:21:00', NULL),
(26, 1, 10, 24, '2st product', '1000', '1200', NULL, '11', 'test2', NULL, '0', 18, '2021-04-07 12:21:00', NULL),
(27, 1, 11, 24, '3st product', '200', '300', NULL, '12', 'test3', NULL, '0', 18, '2021-04-07 12:21:00', NULL),
(28, 1, 12, 26, '1st product', '1200', '1400', NULL, '13', 'test1', NULL, '0,25,', 93, '2021-04-07 12:27:28', NULL),
(29, 1, 13, 26, '2st product', '1000', '1200', '10', '13', 'test2', NULL, '0,25,', 93, '2021-04-07 12:27:28', NULL),
(30, 1, 14, 26, '3st product', '200', '300', '10', '14', 'test3', NULL, '0,25,', 93, '2021-04-07 12:27:29', NULL),
(31, 1, 12, 25, '1st product', '1200', '1400', '10', '13', 'test1', NULL, '0', 93, '2021-04-07 12:33:24', NULL),
(32, 1, 13, 25, '2st product', '1000', '1200', '10', '13', 'test2', NULL, '0', 93, '2021-04-07 12:33:24', NULL),
(33, 1, 14, 25, '3st product', '200', '300', '10', '14', 'test3', NULL, '', 93, '2021-04-07 12:33:24', NULL),
(34, 1, 12, 25, '1st product', '1200', '1400', '10', '13', 'test1', NULL, '', 93, '2021-04-07 01:02:41', NULL),
(35, 1, 13, 25, '2st product', '1000', '1200', '10', '13', 'test2', NULL, '', 93, '2021-04-07 01:02:41', NULL),
(36, 1, 14, 25, '3st product', '200', '300', '10', '14', 'test3', NULL, '', 93, '2021-04-07 01:02:41', NULL),
(37, 1, 15, 27, '1st product', '1200', '1400', '10', '15', 'test1', NULL, ',28,', 94, '2021-04-07 01:34:44', NULL),
(38, 1, 16, 27, '2st product', '1000', '1200', '10', '15', 'test2', NULL, '', 94, '2021-04-07 01:34:44', NULL),
(39, 1, 17, 27, '3st product', '200', '300', '10', '16', 'test3', NULL, '', 94, '2021-04-07 01:34:44', NULL),
(40, 1, 15, 27, 'asdadssda', '6464', '1500', '10', '15', 'zdczczxc', '161780425396161555542860t-shirt-white-back-500x500.png', '', 94, '2021-04-07 02:04:13', NULL),
(42, 1, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, '', NULL, NULL, NULL),
(43, 1, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, '', NULL, NULL, NULL),
(44, 1, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 1, 15, 28, '1st product', '1000', '1400', NULL, '15', 'test1', NULL, '', 94, '2021-04-08 10:24:59', NULL),
(46, 1, 15, 28, '1st product', '1200', '1400', NULL, '15', 'test1', NULL, '', 94, '2021-04-08 11:40:59', NULL),
(47, 1, 16, 28, '2st product', '1000', '1200', NULL, '15', 'test2', NULL, '', 94, '2021-04-08 11:40:59', NULL),
(48, 1, 17, 28, '3st product', '200', '300', NULL, '16', 'test3', NULL, '', 94, '2021-04-08 11:40:59', NULL),
(49, 1, 18, 31, '1st product', '1200', '1400', NULL, '17', 'test1', NULL, ',32,', 97, '2021-04-08 01:45:55', NULL),
(50, 1, 19, 31, '2st product', '1000', '1200', NULL, '17', 'test2', NULL, '', 97, '2021-04-08 01:45:55', NULL),
(51, 1, 20, 31, '3st product', '200', '300', NULL, '18', 'test3', NULL, '', 97, '2021-04-08 01:45:56', NULL),
(52, 1, 18, 32, 'asdzsd', '3665', '45654', '6', '17', 'sxzxczxc', NULL, '', 97, '2021-04-08 02:23:36', NULL),
(53, 1, 18, 32, '1st product', '1200', '1400', NULL, '17', 'test1', NULL, '', 97, '2021-04-08 01:59:47', NULL),
(54, 1, 19, 32, 'dzdczc', '654654', '5646', '10', '18', 'dczcxzxczxc', NULL, '', 97, '2021-04-08 02:01:46', NULL),
(55, 0, 9, 33, '1st product', '1200', '1400', '10', '11', 'test1', '1621603390159t-shirt-white-back-500x500.png', '', 18, '2021-05-21 01:23:10', NULL),
(56, 1, 8, 36, 'test', '1200', '1400', NULL, '9', 'test', '1617610104823t-shirt-white-back-500x500.png', ',23,', 92, '2021-04-12 08:42:23', NULL),
(57, 1, 8, 36, 'zadscazcz', '1200', '1400', NULL, '9', 'ascxzxczxc', '1617611529534t-shirt-white-front-500x500.png', ',23,', 92, '2021-04-12 08:58:23', NULL),
(58, 1, 21, 23, '1st product', '1200', '1400', NULL, '19', 'test1', NULL, ',36,', 92, '2021-04-12 08:59:33', NULL),
(59, 1, 22, 23, '2st product', '1000', '1200', NULL, '19', 'test2', NULL, '', 92, '2021-04-12 08:59:33', NULL),
(60, 1, 23, 23, '3st product', '200', '300', NULL, '9', 'test3', NULL, ',36,', 92, '2021-04-12 08:59:33', NULL),
(61, 1, 8, 23, 'test', '1200', '1400', NULL, '9', 'test', '1617610104823t-shirt-white-back-500x500.png', ',36,', 92, '2021-04-12 08:59:50', NULL),
(62, 1, 8, 23, 'zadscazcz', '1200', '1400', NULL, '9', 'ascxzxczxc', '1617611529534t-shirt-white-front-500x500.png', ',36,', 92, '2021-04-12 09:00:36', NULL),
(63, 1, 8, 36, 'test', '1200', '1400', NULL, '9', 'test', '1617610104823t-shirt-white-back-500x500.png', '', 92, '2021-04-12 09:01:23', NULL),
(64, 1, 21, 36, '1st product', '1200', '1400', NULL, '19', 'test1', NULL, '', 92, '2021-04-12 09:02:22', NULL),
(65, 1, 23, 36, '3st product', '200', '300', NULL, '9', 'test3', NULL, '', 92, '2021-04-12 09:03:09', NULL),
(66, 1, 8, 36, 'zadscazcz', '1200', '1400', NULL, '9', 'ascxzxczxc', '1617611529534t-shirt-white-front-500x500.png', '', 92, '2021-04-12 09:05:07', NULL),
(67, 1, 9, 24, '1st product', '1200', '1400', NULL, '11', 'test1', NULL, '', 18, '2021-04-13 12:46:33', NULL),
(68, 1, 10, 24, '2st product', '1000', '1200', NULL, '11', 'test2', NULL, '', 18, '2021-04-13 12:46:33', NULL),
(69, 1, 11, 24, '3st product', '200', '300', NULL, '12', 'test3', NULL, '', 18, '2021-04-13 12:46:33', NULL),
(70, 1, 25, 49, '1st product', '1200', '1400', NULL, '20', 'test1', NULL, '', 114, '2021-04-23 10:23:12', NULL),
(71, 1, 26, 49, '2st product', '1000', '1200', NULL, '20', 'test2', NULL, '', 114, '2021-04-23 10:23:12', NULL),
(72, 1, 27, 49, '3st product', '200', '300', NULL, '21', 'test3', NULL, '', 114, '2021-04-23 10:23:12', NULL),
(73, 1, 28, 52, '1st product', '1200', '1400', NULL, '22', 'test1', NULL, '', 117, '2021-05-20 01:26:59', NULL),
(74, 1, 29, 52, '2st product', '1000', '1200', NULL, '22', 'test2', NULL, '', 117, '2021-05-20 01:26:59', NULL),
(75, 1, 30, 52, '3st product', '200', '300', NULL, '23', 'test3', NULL, '', 117, '2021-05-20 01:26:59', NULL),
(76, 1, 9, 34, '1st product', '1200', '1400', '10', '12', 'test1', NULL, '', 18, '2021-06-04 01:38:15', NULL),
(77, 1, 10, 34, '2st product', '1000', '1200', NULL, '11', 'test2', NULL, '', 18, '2021-05-25 12:24:56', NULL),
(78, 1, 11, 34, '3st product', '200', '300', NULL, '12', 'test3', NULL, '', 18, '2021-05-25 12:24:56', NULL),
(79, 1, 31, 63, '1st product', '1200', '1400', NULL, '24', 'test1', NULL, '', 139, '2021-08-06 07:23:08', NULL),
(80, 1, 32, 63, '2st product', '1000', '1200', NULL, '24', 'test2', NULL, '', 139, '2021-08-06 07:23:08', NULL),
(81, 1, 33, 63, '3st product', '200', '300', NULL, '25', 'test3', NULL, '', 139, '2021-08-06 07:23:08', NULL),
(82, 1, 32, 63, 'shoes', '1200', '1800', '10', '24', 'test', '1628234654333chair_2.png', '', 139, '2021-08-06 07:24:14', NULL),
(83, 1, 34, 64, '1st product', '1200', '1400', NULL, '26', 'test1', NULL, '', 140, '2021-08-06 09:11:39', NULL),
(84, 1, 35, 64, '2st product', '1000', '1200', NULL, '26', 'test2', NULL, '', 140, '2021-08-06 09:11:39', NULL),
(85, 1, 36, 64, '3st product', '200', '300', NULL, '27', 'test3', NULL, '', 140, '2021-08-06 09:11:40', NULL),
(86, 1, 34, 66, '1st product', '1200', '1400', NULL, '26', 'test1', NULL, '', 140, '2021-08-06 09:20:11', NULL),
(87, 1, 35, 66, '2st product', '1000', '1200', NULL, '26', 'test2', NULL, '', 140, '2021-08-06 09:20:12', NULL),
(88, 1, 36, 66, '3st product', '200', '300', NULL, '27', 'test3', NULL, '', 140, '2021-08-06 09:20:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `buyer_company_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `seller_company_id` int(11) DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL,
  `pending_date_time` datetime DEFAULT NULL,
  `approved_date_time` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`id`, `buyer_id`, `buyer_company_id`, `seller_id`, `seller_company_id`, `status`, `pending_date_time`, `approved_date_time`, `created_on`, `updated_on`) VALUES
(40, 84, 16, 18, 34, 'approved', '2021-05-24 12:56:13', NULL, '2021-05-24 12:56:13', NULL),
(41, 84, 16, 90, 43, 'pending', '2021-05-24 12:58:39', NULL, '2021-05-24 12:58:39', NULL),
(42, 129, 58, 18, 34, 'pending', '2021-05-25 01:24:41', NULL, '2021-05-25 01:24:41', NULL),
(43, 84, 16, 18, 33, 'approved', '2021-06-04 11:23:22', NULL, '2021-06-04 11:23:22', NULL),
(44, 134, 61, 18, 34, 'pending', '2021-06-04 01:33:07', NULL, '2021-06-04 01:33:07', NULL),
(45, 141, 65, 139, 63, 'approved', '2021-08-06 09:10:19', NULL, '2021-08-06 09:10:19', NULL),
(46, 141, 65, 140, 64, 'approved', '2021-08-06 09:11:52', NULL, '2021-08-06 09:11:52', NULL),
(47, 141, 65, 140, 66, 'approved', '2021-08-06 09:20:22', NULL, '2021-08-06 09:20:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2021-03-02 03:20:34', '2021-03-02 03:20:34'),
(2, 'Sub Admin', 'web', '2021-03-02 06:05:04', '2021-03-02 06:05:04'),
(3, 'seller', 'web', '2021-03-02 07:22:52', '2021-03-02 07:22:52'),
(4, 'buyer', 'web', '2021-03-08 03:51:07', '2021-03-08 03:51:07'),
(5, 'Sale Agent', 'web', '2021-04-19 22:48:45', '2021-04-19 22:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(3, 4),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(6, 5),
(7, 3),
(8, 5),
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `saller_agent`
--

CREATE TABLE `saller_agent` (
  `agent_id` int(11) UNSIGNED NOT NULL,
  `agent_name` varchar(200) DEFAULT NULL,
  `agent_email` varchar(200) DEFAULT NULL,
  `agent_phone` varchar(100) DEFAULT NULL,
  `discount_percentage` float DEFAULT NULL,
  `assign_area_lat` varchar(200) DEFAULT NULL,
  `assign_area_long` varchar(200) DEFAULT NULL,
  `assign_company` varchar(255) DEFAULT NULL,
  `display_image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `area_assign` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saller_agent`
--

INSERT INTO `saller_agent` (`agent_id`, `agent_name`, `agent_email`, `agent_phone`, `discount_percentage`, `assign_area_lat`, `assign_area_long`, `assign_company`, `display_image`, `user_id`, `area_assign`, `created_by`, `created_at`) VALUES
(6, 'adsadsad', 'asdads@gmail.com', '0325584145885', 10, '24.9728707', '67.0643315', NULL, '16227227951-homepage-desktop-wsc.jpg', 131, 'North Karachi, Karachi, Pakistan', 18, NULL),
(7, 'eeddasd', 'asdasdd@gmail.com', '6546465465654', 25, '24.8607343', '67.0011364', NULL, '16228130590_3_1.PNG', 133, 'Karachi, Pakistan', 18, NULL),
(8, 'asdadad', 'abbasawa@gmail.com', '65464654656', 10, '24.9372146', '67.042281', NULL, '1628241401QRcode_QRNormal (1).jpg', 142, 'North Nazimabad, Karachi, Pakistan', 140, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sku_code`
--

CREATE TABLE `sku_code` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sku_code`
--

INSERT INTO `sku_code` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 1, '2021-03-05 11:58:06', NULL),
(2, 'alu', 1, '2021-03-05 12:21:59', NULL),
(3, 'ai', 1, '2021-03-05 12:23:25', NULL),
(4, 'hi', 1, '2021-03-05 12:23:45', NULL),
(5, 'hii', 1, '2021-03-05 12:24:59', NULL),
(6, 'ali', 1, '2021-03-05 12:26:33', NULL),
(7, 'abcd', 86, '2021-03-12 01:23:00', NULL),
(8, 'aaaaa', 18, '2021-03-18 11:49:24', NULL),
(9, 'liter', 92, '2021-04-05 08:07:47', NULL),
(11, 'per ', 18, '2021-04-07 11:48:01', NULL),
(12, 'liter', 18, '2021-04-07 11:56:00', NULL),
(13, 'per ', 93, '2021-04-07 12:27:28', NULL),
(14, 'liter', 93, '2021-04-07 12:27:29', NULL),
(15, 'per ', 94, '2021-04-07 01:34:44', NULL),
(16, 'liter', 94, '2021-04-07 01:34:44', NULL),
(17, 'per ', 97, '2021-04-08 01:45:55', NULL),
(18, 'liter', 97, '2021-04-08 01:45:55', NULL),
(19, 'per ', 92, '2021-04-12 08:59:33', NULL),
(20, 'per ', 114, '2021-04-23 10:23:12', NULL),
(21, 'liter', 114, '2021-04-23 10:23:12', NULL),
(22, 'per ', 117, '2021-05-20 01:26:59', NULL),
(23, 'liter', 117, '2021-05-20 01:26:59', NULL),
(24, 'per ', 139, '2021-08-06 07:23:08', NULL),
(25, 'liter', 139, '2021-08-06 07:23:08', NULL),
(26, 'per ', 140, '2021-08-06 09:11:39', NULL),
(27, 'liter', 140, '2021-08-06 09:11:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_operator` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile_token` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `field_of_interest` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `user_type`, `password`, `phone_operator`, `remember_token`, `created_at`, `updated_at`, `mobile_token`, `temp_password`, `created_by`, `field_of_interest`, `status`) VALUES
(1, 'Admin', 'admin@admin.com', '03331347148', 'super_admin', '$2y$10$nWSns2nspNy/eQCelfCHZ.ieNpfOtjfygZf1mz1Pm7SzNXz9hawpi', NULL, 'wyGed7BZpxTFTQ8Uwp1lxDy4OOa3vU1GKQe2N6n44VuM5SQl1IRpaTR97FHm', '2021-03-02 03:20:35', '2021-03-02 03:20:35', NULL, NULL, NULL, NULL, 1),
(18, 'aliad', 'ali@gmail.com', '033312345678', NULL, '$2y$10$s.KLV6HZCkGjneOjNLIjkuMCGLuYHHreqynVxWfQt9pDW7WSk2taW', NULL, NULL, '2021-03-04 05:17:02', '2021-03-04 05:17:02', NULL, NULL, NULL, '1,3', 1),
(84, 'Abbas ss', 'abbas@gmail.com', '03117777777', NULL, '$2y$10$qiJczVlk.nODG7rMrhsd0uKUgD.QtSzT3EMMYWoNT.rTp6V4g3nNW', NULL, NULL, '2021-03-11 09:08:22', '2021-03-11 09:08:22', NULL, NULL, NULL, NULL, 1),
(85, 'test_1', 'test11@gmail.com', '0311656546546', NULL, '$2y$10$5885fjh8gTDrjde35QEPUuw.f8em76WS45xfx1YtJzxbVJxiXDeWa', NULL, NULL, '2021-03-11 09:59:44', '2021-03-11 09:59:44', NULL, NULL, NULL, '5', 1),
(86, 'test_2', 'testseller@gmail.com', '03111111111', NULL, '$2y$10$H1KHSDc3Ha7TOtzK.ZHSm.x1FuHK3gHlpazI3sjg2sJJuoWw05ES6', NULL, NULL, '2021-03-12 08:19:45', '2021-03-12 08:19:45', NULL, NULL, NULL, '1,2,3', 1),
(87, 'danyial', 'danyial@gmail.com', '03112222222', NULL, '$2y$10$Q5m7qaG1Nw/mfv.rvLfqIuQ0GTrc9MEzuUnFgOPU5pJHcrercwsXK', NULL, NULL, '2021-03-16 03:40:16', '2021-03-16 03:40:16', NULL, NULL, NULL, NULL, 1),
(88, 'abbas', 'abbas11@gmail.com', '034328965458', NULL, '$2y$10$7W5k6zpon8xaNJVgktwIc.bm0WiUav3INCZrVJ6A.U9hjdnH8FHJS', NULL, NULL, '2021-03-16 08:15:52', '2021-03-16 08:15:52', NULL, NULL, NULL, NULL, 1),
(89, 'raheel', 'raheel12@gmail.com', '031199999999', NULL, '$2y$10$sNwmMAnhq1dGvYuVnYpICuw3SnQQlh/iaXi5itC/B0.ckKwQ/xE9u', NULL, NULL, '2021-03-29 08:43:04', '2021-03-29 08:43:04', NULL, NULL, NULL, NULL, 1),
(90, 'abbas', 'abbas22@gmail.com', '0311546498498', NULL, '$2y$10$zCusdoY28.mpKipSj3YdF.DGBMH198FL/ZZAl3/cTcRUkL15/YPyu', NULL, NULL, '2021-04-02 09:51:43', '2021-04-02 09:51:43', NULL, NULL, NULL, NULL, 1),
(91, 'abbas', 'abbas122@gmail.com', '0311565465465', NULL, '$2y$10$MAMbp9UqR3rZQEKFNShvL.sUxsXVE4Y1YHWtLeux5w6mtGMseWvQ2', NULL, NULL, '2021-04-02 09:52:35', '2021-04-02 09:52:35', NULL, NULL, NULL, NULL, 1),
(92, 'misbah', 'misbah@gmail.com', '03116666666', NULL, '$2y$10$p691gTKFRqbhPuTKZdO0FO8uDAMQ7ypFfTjVMouWvjP5GmUwYaDe6', NULL, NULL, '2021-04-05 01:36:50', '2021-04-05 01:36:50', NULL, NULL, NULL, NULL, 1),
(93, 'ammas', 'ammas@gmail.com', '03021111111', NULL, '$2y$10$ZFGF0PoOxp47aPZtAS0l7OKSTg2HJXhwdWyxiBGsTgzJbNVReLKMO', NULL, NULL, '2021-04-07 07:22:23', '2021-04-07 07:22:23', NULL, NULL, NULL, NULL, 1),
(94, 'zsdczxczxc', 'zxczxc@gmail.com', '0301888899999', NULL, '$2y$10$WRxydJBUMpn8Sh5D8aWbSOkXpB0zO.dXf2mrG7ty8qOtL2tHMOVXS', NULL, NULL, '2021-04-07 07:57:30', '2021-04-07 07:57:30', NULL, NULL, NULL, NULL, 1),
(95, 'ammad majno', 'majno@gmail.com', '031144444444', NULL, '$2y$10$DF8amCu7vIXrFgg2.m9RaOkGulzS.fwDLfxNOndI6wrNzCtvwK.HW', NULL, NULL, '2021-04-08 07:18:27', '2021-04-08 07:18:27', NULL, NULL, NULL, NULL, 1),
(97, 'sddsfsdlsjfj', 'sdsad@gmail.com', '0311985525822', NULL, '$2y$10$Il.5RPfFFooF4gAUrC/PBuyzIbgwx7eib6CpYbRlAS66Tga3cjK0G', NULL, NULL, '2021-04-08 08:39:12', '2021-04-08 08:39:12', NULL, NULL, NULL, NULL, 1),
(98, 'szdczczcx', 'zczxc@gmail.com', '03116464654', NULL, '$2y$10$8EP7zt4TM4nEX.7rl9.mUuXoo5magv4LpTlaLj.Wq4g8K391Uw/hq', NULL, NULL, '2021-04-12 05:31:07', '2021-04-12 05:31:07', NULL, NULL, NULL, NULL, 1),
(99, 'faroo', 'faroo@gmail.com', '0311646465654', NULL, '$2y$10$s1gWNZ8t2w1ljpQZlZfYHeJAP9p6dISbmgxGXR87uAeq8Nt7K0JPO', NULL, NULL, '2021-04-12 06:38:23', '2021-04-12 06:38:23', NULL, NULL, NULL, NULL, 1),
(100, 'xczxzc', 'asasz@gmial.com', '031198798798798797', NULL, '$2y$10$10cfrQ3OAnCOgl4U9vPyNeF15pq5xbxHpEsHX/fPchUTAgLA0dh4y', NULL, NULL, '2021-04-12 06:39:39', '2021-04-12 06:39:39', NULL, NULL, NULL, NULL, 1),
(101, 'sdcxczxzc', 'wwww@gmail.com', '0311333333333', NULL, '$2y$10$NUQrv5UDs56IbNCWTR8qVerlC1x26voKTsIOO0JKmGWTl8EAfPYpy', NULL, NULL, '2021-04-13 01:52:08', '2021-04-13 01:52:08', NULL, NULL, NULL, NULL, 1),
(102, 'sdfsdzdc', 'zdxczxc@gmail.com', '0311654654444', NULL, '$2y$10$a3n0fUnZRYQ8byBVpaPv8.a6DVPcWgNY3kR7ijqQkWX6mi3h4APDa', NULL, NULL, '2021-04-13 02:46:12', '2021-04-13 02:46:12', NULL, NULL, NULL, NULL, 1),
(103, 'farhan', 'faan@gamil.com', '03061111111', NULL, '$2y$10$z8V0AI6t1sSRpJ1EKDOfsOnb/GqPsDbp008CzTj3e0u2yZsL5NoLK', NULL, NULL, '2021-04-13 06:06:09', '2021-04-13 06:06:09', NULL, NULL, NULL, NULL, 1),
(104, 'test', 'test@gmail.com', '03565465464654', 'sale_agent', '$2y$10$WlXGvK9ewPNGqRCL9xLpn.9ppf5jIKEiA3cDrDbT7KDFEePOpvilS', NULL, NULL, '2021-04-19 01:46:16', '2021-04-25 22:37:32', NULL, NULL, NULL, NULL, 1),
(105, 'alsdjksdskdj', 'asdasd@gmail.com', '03116465464564', NULL, '$2y$10$Hnyk9UTaF8oK7dELaBMHFOG7rMq1v1ZExADefPMqetaS6Xp4MWpKO', NULL, NULL, '2021-04-20 00:00:43', '2021-04-20 00:00:43', NULL, NULL, NULL, NULL, 1),
(106, 'zxczczxc', 'zsczcxc@gmail.com', '031165465464', NULL, '$2y$10$zQn1LyJuTDohRfA3SMgnhOyc8aB/xGCfXnS3DUg0n/SAaJu1uO9pq', NULL, NULL, '2021-04-20 23:46:38', '2021-04-20 23:46:38', NULL, NULL, NULL, NULL, 1),
(107, 'zxczczxc', 'zsaczcxc@gmail.com', '0311646546464', NULL, '$2y$10$54p11E0yBqoN0i9JQhtNsuXxIBqHgc5bRjwSZED4mGXqlDiF9BcvK', NULL, NULL, '2021-04-20 23:53:57', '2021-04-20 23:53:57', NULL, NULL, NULL, NULL, 1),
(108, 'zddczdczxczcx', 'fffff@gmail.com', '031164645665654', NULL, '$2y$10$s.KLV6HZCkGjneOjNLIjkuMCGLuYHHreqynVxWfQt9pDW7WSk2taW', NULL, NULL, '2021-04-20 23:58:10', '2021-04-20 23:58:10', NULL, NULL, 104, NULL, 1),
(109, 'Farman', 'farmanfruit@gmail.com', '03201115555', 'sale_agent', '$2y$10$s.KLV6HZCkGjneOjNLIjkuMCGLuYHHreqynVxWfQt9pDW7WSk2taW', NULL, NULL, '2021-04-22 23:44:32', '2021-04-22 23:44:32', NULL, NULL, NULL, NULL, 1),
(110, 'dfdsd', 'sdfsdf@gmail.com', '03116546465464', NULL, '$2y$10$k89Ce0Du4QmG29Wd7fOAqOJidMoK1GOiYQzKg0ieuxQ5vJmOzA.W2', NULL, NULL, '2021-04-23 16:56:50', '2021-04-23 16:56:50', NULL, NULL, NULL, NULL, 1),
(111, 'dfdsd', 'sdfsdsf@gmail.com', '03116546546546', NULL, '$2y$10$NdLz9jvA9O6lJgOsvuTeH./C9COOk/muP2aFN3oR2g2j2ZvEGTemS', NULL, NULL, '2021-04-23 16:59:39', '2021-04-23 16:59:39', NULL, NULL, NULL, NULL, 1),
(112, 'asdzdczc', 'vvzdxzcx@gmail.com', '031165465464', NULL, '$2y$10$iZ1u0l2mHwEOjVobzl63OeOPQoHYe5KexI3oJFE/rEuOpJ0IuuDzO', NULL, NULL, '2021-04-23 17:09:35', '2021-04-23 17:09:35', NULL, NULL, NULL, NULL, 1),
(113, 'adczczxc', 'ffff@gmail.com', '0311654646546', NULL, '$2y$10$yJofPaR3ftJtZoSViZFnyePVHLYL4drEP/3x95MH95NGunxy7X.qK', NULL, NULL, '2021-04-23 17:15:56', '2021-04-23 17:15:56', NULL, NULL, NULL, NULL, 1),
(114, 'dczxczxc', 'cxv@gmail.com', '031164654646', NULL, '$2y$10$9x4v5YJK.xyq0CKa0ejSPOfPqfYE/4iHiHioZtyYeWH.rYrwoEwga', NULL, NULL, '2021-04-23 17:16:20', '2021-04-23 17:16:20', NULL, NULL, NULL, NULL, 1),
(115, 'sdczdxc', 'zxcxzxc@gmail.com', '03116464654654', NULL, '$2y$10$Ve5QnkzVPBA/i/gCcj2ICeX6lS8mja7G0EUtMLJW/1ZQswZLVTwM2', NULL, NULL, '2021-04-23 17:25:01', '2021-04-23 17:25:01', NULL, NULL, 109, NULL, 1),
(116, 'test abbas 8', 'abbas8@gmail.com', '031165665464', NULL, '$2y$10$/PofcA2rUOqasl89CtC7HOwTb0ea6vW2H3AcJ1Y.nQY3k3h21DFNW', NULL, NULL, '2021-05-20 02:11:40', '2021-05-20 02:11:40', NULL, NULL, NULL, NULL, 1),
(117, 'Minimax 20', 'minimax20@gmail.com', '0311965855464', NULL, '$2y$10$sSaC6snWiANZCzvZ2h28leIEMatwZcUDRSWPTfahIlWAmDHeSzRcu', NULL, NULL, '2021-05-20 08:24:56', '2021-05-20 08:24:56', NULL, NULL, NULL, NULL, 1),
(118, 'Minimax agent 2', 'minimaxagent2@gmail.com', '03113649433', 'sale_agent', '$2y$10$.FiGNPwHpTucDFOP6hjId..YDaVe/EZXp./c.jWc9mN6NRtt2alRi', NULL, NULL, '2021-05-20 08:46:20', '2021-05-20 08:46:20', NULL, NULL, NULL, NULL, 1),
(119, 'Sales agent buyer', 'agent_buyer@gmail.com', '03116546464654', NULL, '$2y$10$hNrYgB782OXNCosgkYJMieGFUSTHnJfsZAHFkRclNf.bwuTuOheEa', NULL, NULL, '2021-05-20 08:53:32', '2021-05-20 08:53:32', NULL, NULL, 118, NULL, 1),
(120, 'test seller account', 'selleraccount@gmail.com', '03125488654564', NULL, '$2y$10$9lQKVGyWM3xIW6Mq8ONz4uTcaX6C60l76kIzivVy5SmwKXY4KXCti', NULL, NULL, '2021-05-21 07:14:34', '2021-05-21 07:14:34', NULL, NULL, NULL, NULL, 1),
(121, 'test', 'dasd@gmail.com', '031188974546', NULL, '$2y$10$rh5Jax1GFwI5DCs.dk7oFuq62FjTG8K0jGJxd3pSbZqdM6h/8yrfa', NULL, NULL, '2021-05-21 07:30:42', '2021-05-21 07:30:42', NULL, NULL, NULL, NULL, 1),
(122, 'buyer register saller', 'seller_register@gmail.com', '03046564654656', NULL, '$2y$10$26pOg4vseq7/QCxk9RDxyOD3KuKJuvSjSPHJTceMkoHCRWAFQPDe2', NULL, NULL, '2021-05-21 08:25:32', '2021-05-21 08:25:32', NULL, NULL, NULL, NULL, 1),
(123, 'sadasdasd sdsda', 'sdfs@gmail.com', '031166464646', NULL, '$2y$10$AjCWywD4Z8Z/WmPd/Bed9OMHOPD75Qplpkc/yP4mKIX.f48IZFwV.', NULL, NULL, '2021-05-21 08:31:41', '2021-05-21 08:31:41', NULL, NULL, NULL, NULL, 1),
(124, 'Amir', 'amie1@gmial.com', '03218888888', 'sale_agent', '$2y$10$EmscNmCTFftTMasQKYUocOlpcpBUxyD8Jj3dw11mQ9ex0mO1cIyai', NULL, NULL, '2021-05-21 08:43:34', '2021-05-21 08:43:34', NULL, NULL, NULL, NULL, 1),
(125, 'Sxasdasd', 'dasds@gmail.com', '654646464', 'sale_agent', '$2y$10$UJkrkhxnBUh6/RVbQC5lKefjkb3H6Q5QbN/bYERJmias8Bh.9Kae2', NULL, NULL, '2021-05-24 05:21:49', '2021-05-24 05:21:49', NULL, NULL, NULL, NULL, 1),
(126, 'adasedsd', 'sdsfd@gmail.com', 'Telenor6466654', NULL, '$2y$10$p4QSCXnVPjWXuBK5SjXkgeGf.F/0HRv8P1KyR.LI9u3FNKMcSLdNG', NULL, NULL, '2021-05-24 07:14:43', '2021-05-24 07:14:43', NULL, NULL, NULL, NULL, 1),
(127, 'sdfdsddc', 'sdfcsdf@gmail.com', '031164646465464', NULL, '$2y$10$SxiGofm5rMLx04Jp.6OvfOHE5J.JGT4nEY7agfrA9uvC/dPjFm8Fu', NULL, NULL, '2021-05-24 07:31:27', '2021-05-24 07:31:27', NULL, NULL, NULL, NULL, 1),
(128, 'sdcsadasd', 'asdsaasdd@gmail.com', '031165464654', NULL, '$2y$10$fBtjU20BKOMSUw1NkK9CDeTL.hseBHaA7g2koZ8ZH./GU7G7TIMhy', 'Zong', NULL, '2021-05-24 07:33:16', '2021-05-24 07:33:16', NULL, NULL, NULL, NULL, 1),
(129, 'Reheel Buyer', 'raheel_buyer@gmial.om', '03459999999', NULL, '$2y$10$bQbyGxT8tT4ClAmz3teoMec8527IksIUb/xXadouxmK/7B2RVaqqK', 'Telenor', NULL, '2021-05-25 08:22:35', '2021-05-25 08:22:35', NULL, NULL, NULL, NULL, 1),
(130, 'test abbas', 'abbas111@gmail.com', '031164646556', NULL, '$2y$10$eLcp4ZW5w69AXJThkvxzzuuMMnJJaLbFiplx9G0edjztmzhdrcbKG', 'Zong', NULL, '2021-05-31 02:02:58', '2021-05-31 02:02:58', NULL, NULL, NULL, NULL, 1),
(131, 'adsadsad', 'asdads@gmail.com', '0325584145885', 'sale_agent', '$2y$10$eW.AYZ4rCx1Rfqx3vbjZdeOeonZn9IMJ5emtoDZD4wDvwGHzlZgbW', NULL, NULL, '2021-06-03 07:19:55', '2021-06-03 07:19:55', NULL, NULL, NULL, NULL, 1),
(132, 'test buyer 5', 'buyer5@gmail.com', '030312345678', NULL, '$2y$10$GRr6uFyPx41ZbJpu/cfceuOIPgto6GZBmaZ50X9vNYrdhdpwojJwi', 'Jazz', NULL, '2021-06-04 08:16:27', '2021-06-04 08:16:27', NULL, NULL, NULL, NULL, 1),
(133, 'eeddasd', 'asdasdd@gmail.com', '6546465465654', 'sale_agent', '$2y$10$Aw0Xftkk/RqEjRQC4SIGD.YOicaU9yG9TM5380P3ORahBG0eqY2uG', NULL, NULL, '2021-06-04 08:24:20', '2021-06-04 08:24:20', NULL, NULL, NULL, NULL, 1),
(134, 'Test 4 buyer', 'buyer4@gmail.com', '0311898798798798', NULL, '$2y$10$4Meu6VgiXi39YyDDMiuPROvYJPGTGxAZ30J6bJlgFxmD1SgfpFsZi', 'Zong', NULL, '2021-06-04 08:26:07', '2021-06-04 08:26:07', NULL, NULL, NULL, NULL, 1),
(135, 'asdzsczc', 'zxzxcczc@gmail.com', '0311958654646', NULL, '$2y$10$aP0RV7mqULlHuXVYnUtq4OI62nuIR8bmxg6yMjb.iCXQ/NuGXFLma', 'Zong', NULL, '2021-06-15 09:30:58', '2021-06-15 09:30:58', NULL, NULL, NULL, NULL, 1),
(136, 'hgfhfgh', 'dsfds@gmail.com', '03118847987668', NULL, '$2y$10$SYGPG/ZowZYNrjCouPatYO93kcpsCQCGLzvws1c5W6mRs4m.jVCgu', 'Zong', NULL, '2021-06-16 00:29:53', '2021-06-16 00:29:53', NULL, NULL, NULL, NULL, 1),
(137, 'test 6', 'test6@gmail.com', '031184875484787', NULL, '$2y$10$L1bi2fPVWx78laA9rcRkcuh7AlmhtJnXN3NDKHXE1zFufhAjdSp/e', 'Zong', NULL, '2021-06-21 08:16:49', '2021-06-21 08:16:49', NULL, NULL, NULL, NULL, 1),
(138, 'test 4', 'test4@gmail.com', '030212345678', NULL, '$2y$10$moh9pMHfNPDWc8ITUcjjW.ZSCtcOViE3n7kgooYUuAUHDHwXSOzIe', 'Jazz', NULL, '2021-08-04 06:41:23', '2021-08-04 06:41:23', NULL, NULL, NULL, NULL, 1),
(139, 'ahmed ali', 'ahmedali@gmail.com', '03366656583651463', NULL, '$2y$10$Y7BjJQOYV7GtyzAyErO5nuhQ/.hFSqT4lURrPEvKi0jh8xuCs3awK', 'Ufone', NULL, '2021-08-06 02:20:43', '2021-08-06 02:20:43', NULL, NULL, NULL, NULL, 1),
(140, 'buyer aqeel', 'buyer_ageel@gmail.com', '0311969558555', NULL, '$2y$10$0XREbGA2lI4uO5gooQonYO06hWQnJIJAi4jamfFm9GRt52zyMvcsa', 'Zong', NULL, '2021-08-06 02:32:24', '2021-08-06 02:32:24', NULL, NULL, NULL, NULL, 1),
(141, 'dcsadads', 'asdasddgg@gmail.com', '031168465146456', NULL, '$2y$10$LQGepFTP233pGB7sA9m.RevgQAOHF9dF7Ax3L.zV2dPq5mKTHVNUu', 'Zong', NULL, '2021-08-06 04:08:20', '2021-08-06 04:08:20', NULL, NULL, NULL, NULL, 1),
(142, 'asdadad', 'abbasawa@gmail.com', '65464654656', 'sale_agent', '$2y$10$LGKn5t0q55Ggjh1VO9hvSugxrtnnc0sxyN7m9vIGY07.hG7CjEVTa', NULL, NULL, '2021-08-06 04:16:41', '2021-08-06 04:16:41', NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_assign_company`
--
ALTER TABLE `agent_assign_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_seller_agreement`
--
ALTER TABLE `agent_seller_agreement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comapny`
--
ALTER TABLE `comapny`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD PRIMARY KEY (`id`,`created_on`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD KEY `id` (`id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `saller_agent`
--
ALTER TABLE `saller_agent`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `sku_code`
--
ALTER TABLE `sku_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_assign_company`
--
ALTER TABLE `agent_assign_company`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `agent_seller_agreement`
--
ALTER TABLE `agent_seller_agreement`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `comapny`
--
ALTER TABLE `comapny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `delivery_items`
--
ALTER TABLE `delivery_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `relation`
--
ALTER TABLE `relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `saller_agent`
--
ALTER TABLE `saller_agent`
  MODIFY `agent_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sku_code`
--
ALTER TABLE `sku_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
