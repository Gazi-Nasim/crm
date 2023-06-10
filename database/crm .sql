-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 08:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('super','admin','marketing','support','dealer','customar') NOT NULL DEFAULT 'dealer',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `parent`, `phone`, `role`, `status`) VALUES
(1, 'Super admin', 'super@gmail.com', '12345', 0, '01711765788', 'super', 'active'),
(2, 'Nasim Admin', 'admin@gmail.com', '12345', 1, '645678', 'admin', 'active'),
(3, 'Gazi Nasim(Admin)', 'gazinasim@gmail.com', '12345', 1, '01928788589', 'admin', 'active'),
(4, 'Nasim', 'nasimadmin@gmail.com', '12345', 1, '345678', 'admin', 'active'),
(5, 'Nasim Gazi Marketing', 'marketing@gmail.com', '12345', 2, '4564678', 'marketing', 'active'),
(6, 'Marketing One Ad4', 'marketingadmin4one@gmail.com', '12345', 4, '1234', 'marketing', 'active'),
(7, 'Mamun marketing', 'mamun@gmgh.com', '12345', 2, '19288589', 'marketing', 'inactive'),
(8, 'MD. Babar Ali', 'mdbabarali@gmail.com', '12345', 5, '4564678', 'dealer', 'inactive'),
(9, 'MD Babu', 'babu@gmail.com', '12345', 7, '1928858', 'dealer', 'inactive'),
(10, 'md panna', 'dealer@gmail.com', '12345', 7, '4564678', 'dealer', 'active'),
(11, 'jasim molla', 'jasim@gmail.com', '12345', 5, '4564678', 'dealer', 'active'),
(12, 'dealer Mamun_firsrt', 'mafirstdler@gmail.com', '12345', 7, '4564678', 'dealer', 'active'),
(13, 'Marketing Two  Ad4', 'marketingadmin4two@gmail.com', '12345', 4, '4564678', 'marketing', 'active'),
(14, 'Markting One(G-Ad)', 'marketingOne@gmail.com', '12345', 3, '4564678', 'marketing', 'active'),
(15, 'MarketingTwo(G-Ad)', 'marketingTwo@gmail.com', '12345', 3, '4564678', 'marketing', 'active'),
(20, 'Dealer One', 'dealerone@gmail.com', '12345', 6, '0876', 'dealer', 'active'),
(22, 'Dealer One2', 'dealerone@gmail.com', '12345', 6, '0876', 'dealer', 'active'),
(29, 'Customar1', 'customar1@gmail.com', '12345', 10, '4564678', 'dealer', 'active'),
(34, 'cname', 'gfhjkl@gmgh.com', '12345', 10, '4564678', 'customar', 'active'),
(35, 'cname', 'gfhjkl@gmgh.com', '12345', 10, '4564678', 'customar', 'active'),
(38, 'customar5', 'customar5@gmail.com', '12345', 10, '4564678', 'customar', 'active'),
(39, 'dealer two', 'dealertwo@gmail.com', '12345', 14, '34567', 'dealer', 'active'),
(40, 'mamunCustomar1', 'mamncustomar1@gmail.com', '12345', 12, '7654e3', 'customar', 'active'),
(42, 'Nasim Gazi', 'dealerrr@email.com', '12345', 14, '19288589', 'dealer', 'active'),
(43, 'Nasim Gazi dealer', 'pnna@gmail.com', '12345', 14, '19288589', 'dealer', 'active'),
(44, 'Tauhid ', 'gazinasim001@gmail.com', '12345', 14, '19288589', 'dealer', 'active'),
(45, 'Ahmad', 'gazinasim001@gmail.com', '12345', 14, '192589', 'dealer', 'active'),
(46, 'Reza', 'gfhjkl@gmgh.com', '12345', 14, '192589', 'dealer', 'active'),
(47, 'Tawhid', 'ta@gsh', '', 14, '41867', 'dealer', 'active'),
(48, 'marketing-of-four', 'iufwrtijerk', '12345', 4, '54895', 'marketing', 'active'),
(49, 'yrgery', 'ngjdfhg@gmail.com', '2154', 14, '548652', 'dealer', 'active'),
(50, 'yrgery', 'ngjdfhg@gmail.com', '2154', 14, '548652', 'dealer', 'active'),
(54, 'Nasim Gaziasdfsdgfh', 'gfhjkl@gmgh.com', '618528', 1, '19288589', 'dealer', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `admin_target`
--

CREATE TABLE `admin_target` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `target_month` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_target`
--

INSERT INTO `admin_target` (`id`, `admin_id`, `amount`, `target_month`, `created_at`) VALUES
(1, 2, '300000.00', '2023-03', '2023-03-02 00:00:00'),
(2, 7, '200000.00', '2023-04', '2023-02-04 08:08:50'),
(3, 2, '300000.00', '2023-03', '2023-03-02 00:00:00'),
(4, 3, '1500.00', '2023-03', '2023-03-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `name` char(255) NOT NULL,
  `phone` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `address` char(255) NOT NULL,
  `organization` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `dealer_id`, `name`, `phone`, `email`, `address`, `organization`) VALUES
(2, 10, 'panna2', '234567', 'iffigskajk', 'ucghbjnkm', 'akghsfhi'),
(4, 12, 'customar mamun', '4564678', 'mamuncus1@gmail.com', 'Dhaka,Bangladesh', 'Mamungroup'),
(6, 12, 'Foiz Ahmed', '876546770801', 'foiz@gmail.com', 'Foizpur,Dhaka', 'Foiz Industrize Limited'),
(8, 10, 'panna Customar2', '098765', 'panna2@gmail.com', 'Pannapur, Hakaliki, Dhaka', 'Panna Group'),
(12, 10, 'Topu Khan', '4564678019', 'topu@gmail.com', 'KachuDanga', 'Topu Limited'),
(13, 10, 'nazmiu', '0193215627', 'mun@gmail.co', '354/31', 'rupkothaaa'),
(15, 43, 'Tuhin', '0968587767', 'tuhin@gmail.com', 'Tuhinpur, Chattagram', 'Tuhin LTD');

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoice`
--

CREATE TABLE `customer_invoice` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `type` enum('taxable','performa') NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_invoice`
--

INSERT INTO `customer_invoice` (`id`, `dealer_id`, `customer_id`, `type`, `invoice_id`, `product_id`, `price`, `quantity`, `total`, `vat`, `discount`, `payable`, `created_at`, `created_by`) VALUES
(21, 10, 2, 'taxable', 8, 2, '20000.00', '2.00', '40000.00', '4.00', '2.00', '278398.40', '2023-02-09 11:50:00', 10),
(22, 10, 2, 'taxable', 8, 1, '11000.00', '2.00', '22000.00', '4.00', '2.00', '278398.40', '2023-02-09 11:50:00', 10),
(23, 10, 2, 'taxable', 8, 3, '5000.00', '3.00', '15000.00', '4.00', '2.00', '278398.40', '2023-02-09 11:50:00', 10),
(24, 10, 2, 'taxable', 8, 4, '50000.00', '4.00', '200000.00', '2.00', '2.00', '278398.40', '2023-02-09 11:50:00', 10),
(25, 10, 2, 'taxable', 7, 1, '11000.00', '3.00', '33000.00', '55.00', '3.00', '96951.50', '2023-02-09 09:44:00', 10),
(26, 10, 2, 'taxable', 7, 2, '20000.00', '1.00', '20000.00', '44.00', '3.00', '96951.50', '2023-02-09 09:44:00', 10),
(34, 10, 2, 'taxable', 5, 2, '20000.00', '2.00', '40000.00', '4.00', '4.00', '58236.00', '2023-02-10 09:13:00', 10),
(35, 10, 2, 'taxable', 5, 3, '5000.00', '1.00', '5000.00', '4.00', '4.00', '58236.00', '2023-02-10 09:13:00', 10),
(36, 10, 8, 'taxable', 9, 1, '11000.00', '4.00', '44000.00', '4.00', '2.00', '146764.80', '2023-02-11 21:12:00', 10),
(37, 10, 8, 'taxable', 9, 2, '20000.00', '5.00', '100000.00', '4.00', '2.00', '146764.80', '2023-02-11 21:12:00', 10),
(43, 10, 2, 'taxable', 10, 1, '11000.00', '5.00', '55000.00', '4.00', '3.00', '436197.00', '2023-02-11 21:59:00', 10),
(44, 10, 2, 'taxable', 10, 2, '20000.00', '5.00', '100000.00', '4.00', '3.00', '436197.00', '2023-02-11 21:59:00', 10),
(45, 10, 2, 'taxable', 10, 4, '50000.00', '5.00', '250000.00', '10.00', '3.00', '436197.00', '2023-02-11 21:59:00', 10),
(46, 10, 8, 'taxable', 11, 1, '11000.00', '1.00', '11000.00', '0.00', '4.00', '63360.00', '2023-02-10 22:19:00', 10),
(47, 10, 8, 'taxable', 11, 3, '5000.00', '1.00', '5000.00', '0.00', '4.00', '63360.00', '2023-02-10 22:19:00', 10),
(48, 10, 8, 'taxable', 11, 4, '50000.00', '1.00', '50000.00', '0.00', '4.00', '63360.00', '2023-02-10 22:19:00', 10),
(49, 10, 8, 'taxable', 12, 1, '11000.00', '4.00', '44000.00', '0.00', '1.00', '192060.00', '2023-02-11 22:27:00', 10),
(50, 10, 8, 'taxable', 12, 4, '50000.00', '3.00', '150000.00', '0.00', '1.00', '192060.00', '2023-02-11 22:27:00', 10),
(55, 10, 2, 'taxable', 16, 4, '50000.00', '1.00', '50000.00', '4.00', '2.00', '73382.40', '2023-02-11 23:00:00', 10),
(56, 10, 2, 'taxable', 16, 1, '11000.00', '2.00', '22000.00', '4.00', '2.00', '73382.40', '2023-02-11 23:00:00', 10),
(61, 10, 2, 'taxable', 17, 3, '5000.00', '1.00', '5000.00', '4.00', '4.00', '48816.00', '2023-02-11 23:31:00', 10),
(62, 10, 2, 'taxable', 17, 1, '11000.00', '1.00', '11000.00', '0.00', '4.00', '48816.00', '2023-02-11 23:31:00', 10),
(63, 10, 2, 'taxable', 17, 1, '11000.00', '3.00', '33000.00', '5.00', '4.00', '48816.00', '2023-02-11 23:31:00', 10),
(64, 10, 2, 'taxable', 18, 1, '11000.00', '1.00', '11000.00', '9.00', '0.00', '11990.00', '2023-02-14 09:12:00', 10),
(66, 10, 2, 'taxable', 19, 2, '20000.00', '2.00', '40000.00', '4.00', '0.00', '57050.00', '2023-02-12 09:17:00', 10),
(67, 10, 2, 'taxable', 19, 3, '5000.00', '3.00', '15000.00', '3.00', '0.00', '57050.00', '2023-02-12 09:17:00', 10),
(69, 10, 2, 'taxable', 13, 3, '5000.00', '1.00', '5000.00', '0.00', '2.00', '35280.00', '2023-02-11 22:28:00', 10),
(70, 10, 2, 'taxable', 13, 2, '20000.00', '1.00', '20000.00', '0.00', '2.00', '35280.00', '2023-02-11 22:28:00', 10),
(71, 10, 2, 'taxable', 13, 1, '11000.00', '1.00', '11000.00', '0.00', '2.00', '35280.00', '2023-02-11 22:28:00', 10),
(72, 10, 2, 'taxable', 20, 3, '5000.00', '2.00', '10000.00', '4.00', '2.00', '134534.40', '2023-02-12 09:45:00', 10),
(73, 10, 2, 'taxable', 20, 1, '11000.00', '2.00', '22000.00', '4.00', '2.00', '134534.40', '2023-02-12 09:45:00', 10),
(74, 10, 2, 'taxable', 20, 4, '50000.00', '2.00', '100000.00', '4.00', '2.00', '134534.40', '2023-02-12 09:45:00', 10),
(97, 3, 2, 'taxable', 21, 3, '5000.00', '4.00', '20000.00', '4.00', '3.00', '270862.80', '2023-02-19 15:01:00', 3),
(98, 3, 2, 'taxable', 21, 2, '20000.00', '4.00', '80000.00', '4.00', '3.00', '270862.80', '2023-02-19 15:01:00', 3),
(99, 3, 2, 'taxable', 21, 1, '11000.00', '4.00', '44000.00', '71.00', '3.00', '270862.80', '2023-02-19 15:01:00', 3),
(100, 3, 2, 'taxable', 21, 4, '50000.00', '1.00', '50000.00', '100.00', '3.00', '270862.80', '2023-02-19 15:01:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `collected_by` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `trade_license` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `vat_no` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `upazilla` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`id`, `admin_id`, `trade_license`, `address`, `company_name`, `bank_account`, `vat_no`, `photo`, `district`, `upazilla`, `status`) VALUES
(3, 20, 'pink-flowers_XYIZLJI756.jpg', 'Gopalgonj', 'abc', 'ac', '2345', 'bird-wildlife_WMBIVCVEUG.jpg', 'dd', 'dd', 'active'),
(5, 22, 'pink-flowers_XYIZLJI756.jpg', 'Gopalgonj', 'abc', 'ac', '2345', 'bird-wildlife_WMBIVCVEUG.jpg', 'dd', 'dd', 'active'),
(7, 42, '', 'MUNSHIR CHAR, GIMADANGA', 'GAZI SALAH UDDIN', 'dc', '2345', '', 'dd', 'aksjhf', 'active'),
(8, 43, '330018530_670705058142844_4184054109777314107_n.jpg', 'MUNSHIR CHAR, GIMADANGA', 'GAZI SALAH UDDIN', '987', '2345', 'shohel_sir.jpg', 'Bogra', 'Kalkini', 'active'),
(9, 47, '323890860_762979144722763_4255244792265059392_n.jpg', 'fdgh', 'dfghfd', '5464', '5458', 'shohel_sir.jpg', 'kdghj', 'dd', 'active'),
(10, 49, '330018530_670705058142844_4184054109777314107_n.jpg', 'dlisgkj', 'difu', '354985', '2548', '323890860_762979144722763_4255244792265059392_n.jpg', 'dpofikgh0', 'kfugg', 'active'),
(11, 50, '330018530_670705058142844_4184054109777314107_n.jpg', 'dlisgkj', 'difu', '354985', '2548', '323890860_762979144722763_4255244792265059392_n.jpg', 'dpofikgh0', 'kfugg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_target`
--

CREATE TABLE `dealer_target` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `target_month` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealer_target`
--

INSERT INTO `dealer_target` (`id`, `admin_id`, `amount`, `target_month`, `created_at`) VALUES
(1, 39, '300000.00', '2023-04-08', '2023-03-08 00:00:00'),
(2, 45, '1500055.00', '2023-04-08', '2023-03-08 00:00:00'),
(3, 8, '170000.00', '2023-03-08', '2023-02-08 00:00:00'),
(4, 11, '300500.00', '2023-03-08', '2023-02-08 00:00:00'),
(5, 8, '170000.00', '2023-03-08', '2023-02-08 00:00:00'),
(6, 11, '300500.00', '2023-03-08', '2023-02-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `dealer_id`, `invoice_id`, `product_id`, `price`, `quantity`, `total`, `vat`, `discount`, `payable`, `created_at`, `created_by`) VALUES
(5, 22, 3, 2, '20000.00', '1.00', '20000.00', '0.00', '1.00', '20000.00', '0000-00-00 00:00:00', 1),
(6, 22, 3, 3, '5000.00', '1.00', '20000.00', '0.00', '1.00', '5000.00', '0000-00-00 00:00:00', 1),
(7, 22, 3, 2, '20000.00', '1.00', '20000.00', '0.00', '1.00', '20000.00', '0000-00-00 00:00:00', 1),
(10, 20, 5, 1, '11000.00', '1.00', '50000.00', '0.00', '0.00', '11000.00', '0000-00-00 00:00:00', 1),
(11, 20, 5, 2, '20000.00', '1.00', '50000.00', '0.00', '0.00', '20000.00', '0000-00-00 00:00:00', 1),
(12, 20, 5, 4, '50000.00', '1.00', '50000.00', '0.00', '0.00', '50000.00', '0000-00-00 00:00:00', 1),
(13, 44, 6, 1, '11000.00', '1.00', '50000.00', '0.00', '0.00', '11000.00', '2023-02-07 12:16:00', 1),
(14, 44, 6, 2, '20000.00', '1.00', '50000.00', '0.00', '0.00', '20000.00', '2023-02-07 12:16:00', 1),
(15, 44, 6, 4, '50000.00', '1.00', '50000.00', '0.00', '0.00', '50000.00', '2023-02-07 12:16:00', 1),
(16, 45, 7, 2, '20000.00', '66.00', '11000.00', '0.00', '0.00', '1320000.00', '2023-02-02 12:16:00', 1),
(17, 45, 7, 1, '11000.00', '1.00', '11000.00', '0.00', '0.00', '11000.00', '2023-02-02 12:16:00', 1),
(18, 46, 8, 1, '11000.00', '1.00', '50000.00', '0.00', '0.00', '11000.00', '2023-02-12 12:17:00', 1),
(19, 46, 8, 4, '50000.00', '1.00', '50000.00', '0.00', '0.00', '50000.00', '2023-02-12 12:17:00', 1),
(20, 47, 9, 1, '11000.00', '1.00', '50000.00', '0.00', '0.00', '11000.00', '2023-02-19 12:26:00', 1),
(21, 47, 9, 3, '5000.00', '1.00', '50000.00', '0.00', '0.00', '5000.00', '2023-02-19 12:26:00', 1),
(22, 47, 9, 4, '50000.00', '1.00', '50000.00', '0.00', '0.00', '50000.00', '2023-02-19 12:26:00', 1),
(23, 8, 10, 1, '11000.00', '5.00', '750000.00', '5.00', '3.00', '57750.00', '2023-02-09 12:47:00', 41),
(24, 8, 10, 2, '20000.00', '5.00', '750000.00', '5.00', '3.00', '105000.00', '2023-02-09 12:47:00', 41),
(25, 8, 10, 3, '5000.00', '15.00', '750000.00', '5.00', '3.00', '78750.00', '2023-02-09 12:47:00', 41),
(26, 8, 10, 4, '50000.00', '15.00', '750000.00', '5.00', '3.00', '787500.00', '2023-02-09 12:47:00', 41),
(27, 11, 11, 1, '11000.00', '2.00', '100000.00', '3.00', '2.00', '22660.00', '2023-02-22 22:35:00', 1),
(28, 11, 11, 2, '20000.00', '2.00', '100000.00', '2.00', '2.00', '40800.00', '2023-02-22 22:35:00', 1),
(29, 11, 11, 4, '50000.00', '2.00', '100000.00', '2.00', '2.00', '102000.00', '2023-02-22 22:35:00', 1),
(33, 44, 13, 2, '20000.00', '2.00', '200000.00', '4.00', '2.00', '41600.00', '2023-02-23 09:32:00', 3),
(34, 44, 13, 4, '50000.00', '4.00', '200000.00', '4.00', '2.00', '208000.00', '2023-02-23 09:32:00', 3),
(38, 46, 15, 2, '20000.00', '5.00', '500000.00', '4.00', '2.00', '104000.00', '0000-00-00 00:00:00', 3),
(39, 46, 15, 3, '5000.00', '5.00', '500000.00', '4.00', '2.00', '26000.00', '0000-00-00 00:00:00', 3),
(40, 46, 15, 4, '50000.00', '10.00', '500000.00', '4.00', '2.00', '520000.00', '0000-00-00 00:00:00', 3),
(66, 20, 14, 1, '11000.00', '5.00', '40000.00', '4.00', '2.00', '57200.00', '0000-00-00 00:00:00', 10),
(67, 20, 14, 3, '5000.00', '4.00', '40000.00', '4.00', '2.00', '20800.00', '0000-00-00 00:00:00', 10),
(68, 20, 14, 2, '20000.00', '2.00', '40000.00', '0.00', '2.00', '40000.00', '0000-00-00 00:00:00', 10),
(81, 42, 16, 1, '11000.00', '14.00', '750000.00', '40.00', '3.00', '215600.00', '2023-02-24 23:12:00', 3),
(82, 42, 16, 2, '20000.00', '14.00', '750000.00', '40.00', '3.00', '392000.00', '2023-02-24 23:12:00', 3),
(83, 42, 16, 3, '5000.00', '24.00', '750000.00', '40.00', '3.00', '168000.00', '2023-02-24 23:12:00', 3),
(84, 42, 16, 4, '50000.00', '15.00', '750000.00', '8.00', '3.00', '810000.00', '2023-02-24 23:12:00', 3),
(88, 8, 18, 1, '11000.00', '2.00', '40000.00', '4.00', '2.00', '22880.00', '2023-03-08 10:33:00', 2),
(89, 8, 18, 2, '20000.00', '2.00', '40000.00', '4.00', '2.00', '41600.00', '2023-03-08 10:33:00', 2),
(90, 8, 17, 1, '11000.00', '3.00', '50000.00', '4.00', '2.00', '34320.00', '2023-03-08 10:34:00', 2),
(91, 8, 17, 3, '5000.00', '3.00', '50000.00', '4.00', '2.00', '15600.00', '2023-03-08 10:34:00', 2),
(92, 8, 17, 4, '50000.00', '1.00', '50000.00', '4.00', '2.00', '52000.00', '2023-03-08 10:34:00', 2),
(93, 11, 19, 1, '11000.00', '10.00', '75000.00', '5.00', '2.00', '115500.00', '2023-03-08 10:36:00', 5),
(94, 11, 19, 4, '50000.00', '5.00', '75000.00', '15.00', '2.00', '287500.00', '2023-03-08 10:36:00', 5),
(95, 11, 19, 3, '5000.00', '15.00', '75000.00', '4.00', '2.00', '78000.00', '2023-03-08 10:36:00', 5),
(96, 8, 2, 2, '5500.00', '4.00', '400000.00', '4.00', '4.00', '22880.00', '2023-02-14 10:19:48', 5),
(97, 8, 2, 2, '20000.00', '20.00', '400000.00', '5.00', '4.00', '420000.00', '2023-02-14 10:19:48', 5),
(104, 11, 20, 1, '11000.00', '10.00', '1251484.30', '3.00', '2.00', '3679362.96', '2023-03-08 11:51:00', 2),
(105, 11, 20, 2, '20000.00', '15.00', '1251484.30', '5.00', '2.00', '3679362.96', '2023-03-08 11:51:00', 2),
(106, 11, 20, 4, '50000.00', '5.00', '1251484.30', '8.00', '2.00', '3679362.96', '2023-03-08 11:51:00', 2),
(114, 11, 21, 1, '11000.00', '5.00', '57750.00', '5.00', '3.00', '249775.00', '2023-03-08 13:06:00', 2),
(115, 11, 21, 2, '20000.00', '6.00', '132000.00', '10.00', '3.00', '249775.00', '2023-03-08 13:06:00', 2),
(116, 11, 21, 3, '5000.00', '7.00', '40250.00', '15.00', '3.00', '249775.00', '2023-03-08 13:06:00', 2),
(117, 11, 21, 3, '5000.00', '5.00', '27500.00', '10.00', '3.00', '249775.00', '2023-03-08 13:06:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `upazilla` varchar(255) NOT NULL,
  `status` enum('pending','contacted','aggrement') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `admin_id`, `name`, `address`, `company_name`, `phone`, `email`, `district`, `upazilla`, `status`) VALUES
(2, 5, 'Nobel Islam', 'fkafgk', 'ksdhfij', '45678', 'haoh@gmail.com', 'afhj', 'aksjhf', 'pending'),
(4, 3, 'dfgsdfhg', 'dfgsdg', 'dfgsd', '5487', 'gazinasi@gh;ldk', 'dd', 'dd', 'pending'),
(5, 3, 'sifatsdfs', 'sdfgsarg', 'dsfgsdgh', '2654845', 'iourtgk@gmail.com', 'dd', 'ddjhujhghhnjgb', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_target`
--

CREATE TABLE `marketing_target` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `target_month` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marketing_target`
--

INSERT INTO `marketing_target` (`id`, `admin_id`, `amount`, `target_month`, `created_at`) VALUES
(1, 5, '222220.00', '2023-04', '2023-04-02 00:00:00'),
(5, 48, '1500055.00', '2023-02-13', '2023-02-19 00:00:00'),
(6, 5, '222220.00', '2023-04', '2023-04-02 00:00:00'),
(7, 5, '222220.00', '2023-04', '2023-04-02 00:00:00'),
(9, 5, '222220.00', '2023-04', '2023-04-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `collected_by` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `dealer_id`, `collected_by`, `amount`, `created_at`) VALUES
(1, 8, 5, '2000.00', '2022-12-05 20:58:02'),
(2, 9, 5, '20000.00', '2022-12-06 21:08:06'),
(3, 9, 7, '20000.00', '2022-12-08 12:04:32'),
(4, 10, 7, '30000.00', '2022-12-07 12:04:32'),
(5, 8, 5, '600000.00', '2022-12-05 20:58:02'),
(6, 39, 14, '60000.00', '2023-02-21 14:52:32'),
(7, 42, 15, '55000.00', '2023-02-21 14:52:32'),
(8, 11, 5, '150000.00', '2023-03-05 17:03:18'),
(11, 12, 7, '1500055.00', '2023-03-05 17:14:25'),
(12, 12, 7, '1500055.00', '2023-03-05 17:15:28'),
(13, 12, 7, '1500055.00', '2023-03-05 17:16:08'),
(14, 12, 7, '1500055.00', '2023-03-05 17:16:58'),
(15, 8, 5, '300000.00', '2023-03-05 20:13:59'),
(16, 12, 7, '99999999.99', '2023-03-05 20:16:13'),
(17, 12, 7, '99999999.99', '2023-03-05 20:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dealer_price` decimal(10,2) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `dealer_price`, `mrp`, `unit`, `vat`, `status`) VALUES
(1, 'realme 25s', '11000.00', '1200.00', '23', '5.00', 'active'),
(2, 'oppo A117k', '20000.00', '25000.00', '7', '4.00', 'active'),
(3, 'Nokia', '5000.00', '5500.00', '2', '5.00', 'active'),
(4, 'Nokia Lumia', '50000.00', '55000.00', '1', '3.00', 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `admin_target`
--
ALTER TABLE `admin_target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer_id` (`dealer_id`);

--
-- Indexes for table `customer_invoice`
--
ALTER TABLE `customer_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customar_id` (`customer_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `dealer_target`
--
ALTER TABLE `dealer_target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `marketing_target`
--
ALTER TABLE `marketing_target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer_id` (`dealer_id`,`collected_by`),
  ADD KEY `collected_by` (`collected_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `admin_target`
--
ALTER TABLE `admin_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer_invoice`
--
ALTER TABLE `customer_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dealer_target`
--
ALTER TABLE `dealer_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marketing_target`
--
ALTER TABLE `marketing_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
