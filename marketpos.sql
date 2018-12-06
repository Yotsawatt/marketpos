-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 08:47 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderall`
--

CREATE TABLE `orderall` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `queueorder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_number` int(11) NOT NULL,
  `product_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_totalprice` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_price` int(11) NOT NULL,
  `moneyin` int(11) NOT NULL,
  `sumchange` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_number` int(11) NOT NULL,
  `product_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_id`, `product_category`, `barcode`, `product_name`, `product_price`, `product_number`, `product_unit`) VALUES
(3, '001', 'สินค้าสำเร็จรูป', '8859169830018', 'ขิงดองซีอิ้วเห็ดหอม', 65, 99, 'ซอง'),
(4, '002', 'สินค้าสำเร็จรูป', '8859169810010', 'ขิงดองสามรส', 45, 99, 'ซอง'),
(5, '003', 'สินค้าสำเร็จรูป', '8859169840017', 'หน่อขิงดองสามรส', 45, 99, 'ซอง'),
(6, '004', 'สินค้าสำเร็จรูป', '8859169850108', 'ขิงแช่อิ่มอบแห้งสูตรผสมน้ำผิ้ง', 59, 100, 'กระปุก'),
(7, '005', 'สินค้าสำเร็จรูป', '8859169881010', 'กระเจี๊ยบปรุงรส', 59, 100, 'กระปุก'),
(8, '006', 'สินค้าสำเร็จรูป', '8859169850023', 'ขิงแช่อิ่มอบแห้ง', 35, 99, 'กระปุก'),
(9, '007', 'เครื่องดื่ม', '8858735501109', 'นาโนแซน กล่อง 6 ขวด', 480, 99, 'กล่อง'),
(10, '008', 'เครื่องดื่ม', '8858735501093', 'นาโนแซน กล่อง 12 ขวด', 860, 100, 'กล่อง'),
(11, '009', 'ไอศครีม', '8859169855110', 'ไอศครีมกระเจี๊ยบแดง', 65, 99, 'กระปุก'),
(12, '010', 'ไอศครีม', '8859169854113', 'ไอศครีมชาเขียวข้าวคั่ว', 65, 99, 'กระปุก'),
(13, '011', 'ไอศครีม', '8859169851112', 'ไอศครีมมะเขือม่วงญี่ปุ่น', 65, 98, 'กระปุก'),
(14, '012', 'ไอศครีม', '8859169857114', 'ไอศครีมรสช็อคโกแลต', 65, 99, 'กระปุก');

-- --------------------------------------------------------

--
-- Table structure for table `temp_order`
--

CREATE TABLE `temp_order` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_number` int(11) NOT NULL,
  `product_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_totalprice` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderall`
--
ALTER TABLE `orderall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderall`
--
ALTER TABLE `orderall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `temp_order`
--
ALTER TABLE `temp_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
