-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `demo_cart`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者帳號',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者密碼',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理者帳號';

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `created_at`, `updated_at`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '2019-12-05 00:43:04', '2019-12-05 00:43:04');

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `csId` varchar(11) NOT NULL,
  `csName` varchar(20) NOT NULL,
  `csAdress` varchar(999) NOT NULL,
  `csPhone` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`csId`, `csName`, `csAdress`, `csPhone`, `created_at`, `updated_at`) VALUES
('CS001', 'Alex', '台北市大安區復興南路一段390號 3號15樓', '0912345678', '2020-01-09 16:55:52', '2020-01-21 10:15:32'),
('CS002', 'Bill', '台北市大安區復興南路一段390號2號2樓', '0123456789', '2020-01-10 10:34:49', '2020-01-21 10:15:44'),
('CS003', 'Cala', '台北市大安區和平東路二段106號11樓', '0198456789', '2020-01-10 10:34:49', '2020-01-21 10:16:02'),
('CS004', 'Delt', '台北市士林區基河路363號', '0773456789', '2020-01-10 10:34:49', '2020-01-21 10:17:01'),
('CS005', 'Eels', '台北市萬華區大理街132之10號', '0123459989', '2020-01-10 10:34:49', '2020-01-21 10:16:31'),
('CS006', 'FEED', '新北市三重區集美街55號', '0123455589', '2020-01-10 10:34:49', '2020-01-21 10:16:45');

-- --------------------------------------------------------

--
-- 資料表結構 `orderbuyer`
--

CREATE TABLE `orderbuyer` (
  `orderId` varchar(20) NOT NULL,
  `buyerName` varchar(20) NOT NULL,
  `buyerPhone` varchar(10) NOT NULL,
  `buyerAdress` varchar(99) NOT NULL,
  `invoiceType` varchar(10) NOT NULL,
  `taxNo` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderId` int(20) NOT NULL,
  `pId` varchar(20) NOT NULL,
  `count` int(20) NOT NULL,
  `outStatus` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orderdetail`
--

INSERT INTO `orderdetail` (`orderId`, `pId`, `count`, `outStatus`, `created_at`, `updated_at`) VALUES
(62, 'p002', 1, '', '2020-01-18 22:03:34', '2020-01-18 22:03:34'),
(62, 'p004', 3, '', '2020-01-18 22:03:34', '2020-01-18 22:03:34'),
(63, 'p002', 3, '', '2020-01-18 22:04:16', '2020-01-18 22:04:16'),
(63, 'p004', 1, '', '2020-01-18 22:04:16', '2020-01-18 22:04:16'),
(63, 'p008', 2, '', '2020-01-18 22:04:16', '2020-01-21 17:13:02'),
(64, 'p004', 2, '', '2020-01-18 22:04:47', '2020-01-21 17:19:46'),
(64, 'p003', 9, '退貨申請', '2020-01-18 22:04:47', '2020-02-04 14:34:59'),
(64, 'p002', 1, '', '2020-01-18 22:04:47', '2020-01-21 17:19:57'),
(65, 'p003', 2, '', '2020-01-18 22:07:09', '2020-01-21 17:13:08'),
(65, 'p005', 1, '', '2020-01-18 22:07:09', '2020-01-21 17:13:09'),
(65, 'p008', 1, '', '2020-01-18 22:07:09', '2020-01-18 22:07:09'),
(66, 'p002', 3, '', '2020-01-18 22:07:43', '2020-01-18 22:07:43'),
(66, 'p003', 1, '', '2020-01-18 22:07:43', '2020-01-18 22:07:43'),
(73, 'p002', 1, '', '2020-01-18 22:46:48', '2020-01-18 22:46:48'),
(74, 'p001', 1, '', '2020-01-19 16:05:22', '2020-01-19 16:05:22'),
(74, 'p004', 2, '', '2020-01-19 16:05:22', '2020-01-19 16:05:22'),
(75, 'p001', 2, '退貨申請', '2020-01-21 09:17:38', '2020-02-04 14:35:05'),
(76, 'p002', 1, '', '2020-01-21 18:07:32', '2020-01-21 18:07:32'),
(76, 'p008', 1, '', '2020-01-21 18:07:32', '2020-01-21 18:07:32'),
(77, 'p001', 2, '退貨申請', '2020-01-21 18:55:20', '2020-02-04 14:35:07'),
(77, 'p004', 2, '退貨申請', '2020-01-21 18:55:20', '2020-02-04 14:35:10'),
(77, 'p008', 1, '退貨申請', '2020-01-21 18:55:20', '2020-02-04 14:35:11'),
(77, 'p003', 5, '退貨申請', '2020-01-21 18:55:20', '2020-02-04 14:35:13'),
(78, 'p001', 1, '退貨申請', '2020-01-21 19:04:09', '2020-02-04 14:35:16'),
(78, 'p002', 1, '退貨申請', '2020-01-21 19:04:09', '2020-02-04 14:35:19'),
(78, 'p003', 1, '退貨申請', '2020-01-21 19:04:09', '2020-02-04 14:35:03'),
(78, 'p004', 1, '', '2020-01-21 19:04:09', '2020-01-21 19:04:09'),
(78, 'p005', 1, '退貨申請', '2020-01-21 19:04:09', '2020-02-04 14:34:56'),
(79, 'p001', 100, '', '2020-01-21 19:43:07', '2020-01-21 19:43:07'),
(79, 'p002', 100, '', '2020-01-21 19:43:07', '2020-01-21 19:43:07'),
(80, 'p001', 1, '退貨申請', '2020-01-21 21:15:03', '2020-02-04 14:35:02'),
(81, 'p003', 2, '', '2020-01-22 09:50:46', '2020-01-22 09:50:46'),
(82, 'p002', 2, '', '2020-01-22 10:05:11', '2020-01-22 10:05:11'),
(82, 'p003', 1, '', '2020-01-22 10:05:11', '2020-01-22 10:05:11'),
(82, 'p001', 1, '', '2020-01-22 10:05:11', '2020-01-22 10:05:11'),
(82, 'p005', 3, '', '2020-01-22 10:05:11', '2020-01-22 10:05:11'),
(83, 'p002', 3, '', '2020-01-22 10:05:47', '2020-01-22 10:05:47'),
(83, 'p003', 1, '', '2020-01-22 10:05:47', '2020-01-22 10:05:47'),
(84, 'p001', 2, '', '2020-01-22 12:10:21', '2020-01-22 12:10:21'),
(85, 'p008', 3, '', '2020-01-22 12:12:20', '2020-01-22 12:12:20'),
(86, 'p001', 1, '', '2020-01-22 12:22:04', '2020-01-22 12:22:04'),
(86, 'p002', 1, '退貨申請', '2020-01-22 12:22:04', '2020-02-04 14:35:00'),
(87, 'p008', 1, '', '2020-01-22 13:17:46', '2020-01-22 13:17:46'),
(87, 'p001', 1, '', '2020-01-22 13:17:46', '2020-01-22 13:17:46'),
(88, 'p008', 1, '', '2020-01-22 14:51:11', '2020-01-22 14:51:11'),
(88, 'p003', 1, '', '2020-01-22 14:51:11', '2020-01-22 14:51:11'),
(88, 'p001', 2, '', '2020-01-22 14:51:11', '2020-01-22 14:51:11'),
(89, 'p001', 1, '', '2020-02-03 14:24:59', '2020-02-03 14:24:59'),
(89, 'p002', 1, '', '2020-02-03 14:24:59', '2020-02-03 14:24:59'),
(90, 'p003', 1, '', '2020-02-04 14:37:10', '2020-02-04 14:38:12'),
(90, 'p001', 5, '', '2020-02-04 14:37:10', '2020-02-04 14:37:10'),
(91, 'p006', 1, '', '2020-02-04 14:38:37', '2020-02-04 14:38:57'),
(91, 'p002', 1, '', '2020-02-04 14:38:37', '2020-02-04 14:38:37'),
(92, 'p001', 1, '', '2020-02-04 15:39:21', '2020-02-04 15:39:21'),
(93, 'p002', 1, '', '2020-02-04 15:39:50', '2020-02-04 15:39:50'),
(94, 'p001', 9, '', '2020-02-05 17:28:06', '2020-02-05 17:28:06'),
(94, 'p005', 3, '', '2020-02-05 17:28:06', '2020-02-05 17:28:06'),
(94, 'p007', 1, '', '2020-02-05 17:28:06', '2020-02-05 17:28:06'),
(94, 'p003', 1, '', '2020-02-05 17:28:06', '2020-02-05 17:28:06'),
(94, 'p004', 1, '', '2020-02-05 17:28:06', '2020-02-05 17:28:06'),
(94, 'p008', 2, '', '2020-02-05 17:28:06', '2020-02-05 17:28:06'),
(95, 'p007', 1, '', '2020-02-07 17:30:15', '2020-02-07 17:30:15'),
(95, 'p004', 1, '', '2020-02-07 17:30:15', '2020-02-07 17:30:15');

-- --------------------------------------------------------

--
-- 資料表結構 `orderlist`
--

CREATE TABLE `orderlist` (
  `orderId` int(100) NOT NULL,
  `csId` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `marketingType` varchar(99) NOT NULL,
  `paymentType` varchar(20) NOT NULL,
  `shippingWay` varchar(20) NOT NULL,
  `outStatus` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orderlist`
--

INSERT INTO `orderlist` (`orderId`, `csId`, `total`, `marketingType`, `paymentType`, `shippingWay`, `outStatus`, `created_at`, `updated_time`) VALUES
(62, 'CS004', '140', '', 'CreditCard', '訂單成立', '已出貨', '2020-01-18 22:03:34', '2020-01-21 09:20:10'),
(63, 'CS006', '260', '', 'CreditCard', '訂單成立', '已出貨', '2020-01-18 22:04:16', '2020-01-21 09:20:05'),
(64, 'CS001', '370', '', 'CreditCard', '訂單成立', '退貨申請中', '2020-01-18 22:04:47', '2020-01-21 17:12:03'),
(65, 'CS002', '190', '', 'CreditCard', '訂單成立', '已出貨', '2020-01-18 22:07:09', '2020-01-21 17:35:53'),
(66, 'CS003', '90', '', 'CreditCard', '訂單成立', '已出貨', '2020-01-18 22:07:43', '2020-01-21 09:20:16'),
(73, 'CS003', '20', '', 'CreditCard', '訂單成立', '已出貨', '2020-01-18 22:46:48', '2020-01-21 17:35:53'),
(74, 'CS004', '90', '', 'CreditCard', '訂單成立', '已出貨', '2020-01-19 16:05:22', '2020-01-21 17:35:53'),
(75, 'CS001', '20', '', 'CreditCard', '訂單成立', '退貨申請中', '2020-01-21 09:17:38', '2020-01-21 20:02:06'),
(76, 'CS001', '100', '', 'ATM', '訂單成立', '已出貨', '2020-01-21 18:07:32', '2020-01-22 09:50:53'),
(77, 'CS001', '330', '', 'ATM', '訂單成立', '退貨申請中', '2020-01-21 18:55:20', '2020-01-21 18:55:58'),
(78, 'CS001', '150', '', 'Cashondelivery', '訂單成立', '退貨申請中', '2020-01-21 19:04:09', '2020-01-21 19:04:30'),
(79, 'CS001', '3000', '', 'ATM', '訂單成立', '已出貨', '2020-01-21 19:43:07', '2020-01-21 21:16:02'),
(80, 'CS001', '10', '', 'ATM', '訂單成立', '退貨申請中', '2020-01-21 21:15:03', '2020-01-21 21:18:18'),
(81, 'CS001', '60', '', 'ATM', '訂單成立', '已出貨', '2020-01-22 09:50:46', '2020-01-22 12:11:03'),
(82, 'CS001', '230', '', 'SamsunPay', '訂單成立', '已出貨', '2020-01-22 10:05:11', '2020-01-22 12:11:03'),
(83, 'CS001', '90', '', 'ATM', '訂單成立', '已出貨', '2020-01-22 10:05:47', '2020-01-22 12:11:03'),
(84, 'CS001', '20', '', 'ATM', '訂單成立', '已出貨', '2020-01-22 12:10:21', '2020-01-22 12:11:03'),
(85, 'CS001', '240', '', 'ATM', '訂單成立', '已出貨', '2020-01-22 12:12:20', '2020-01-22 12:19:28'),
(86, 'CS001', '30', '', 'ATM', '訂單成立', '退貨成功', '2020-01-22 12:22:04', '2020-02-03 17:04:20'),
(87, 'CS001', '90', '', 'ATM', '訂單成立', '待出貨', '2020-01-22 13:17:46', '2020-01-22 13:17:46'),
(88, 'CS001', '130', '', 'ATM', '訂單成立', '待出貨', '2020-01-22 14:51:11', '2020-01-22 14:51:11'),
(89, 'CS005', '30', '', 'ATM', '訂單成立', '待出貨', '2020-02-03 14:24:59', '2020-02-03 14:24:59'),
(90, 'CS001', '50', '', 'CreditCard', '訂單成立', '待出貨', '2020-02-04 14:37:10', '2020-02-04 14:37:10'),
(91, 'CS001', '20', '', 'ATM', '訂單成立', '待出貨', '2020-02-04 14:38:37', '2020-02-04 14:38:37'),
(92, 'CS001', '10', '', 'Cashondelivery', '訂單成立', '待出貨', '2020-02-04 15:39:21', '2020-02-04 15:39:21'),
(93, 'CS001', '20', '', 'CreditCard', '訂單成立', '待出貨', '2020-02-04 15:39:50', '2020-02-04 15:39:50'),
(94, 'CS004', '540', '', 'ATM', '訂單成立', '待出貨', '2020-02-05 17:28:05', '2020-02-05 17:28:05'),
(95, 'CS004', '110', '', 'ATM', '訂單成立', '待出貨', '2020-02-07 17:30:15', '2020-02-07 17:30:15');

-- --------------------------------------------------------

--
-- 資料表結構 `outlist`
--

CREATE TABLE `outlist` (
  `outId` int(11) NOT NULL,
  `csId` varchar(20) NOT NULL,
  `orderId` int(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `undated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(20) NOT NULL,
  `paymentName` varchar(20) NOT NULL,
  `paymentCName` varchar(20) NOT NULL,
  `paymentImg` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `payment`
--

INSERT INTO `payment` (`paymentId`, `paymentName`, `paymentCName`, `paymentImg`, `created_at`, `updated_at`) VALUES
(1, 'ATM', 'ATM轉帳', 'payment_type_20200203100343.png', '2020-01-19 00:31:30', '2020-02-03 17:03:43'),
(2, 'CreditCard', '信用卡', 'payment_type_20200203095508.png', '2020-01-19 01:01:35', '2020-02-03 16:55:08'),
(4, 'Cashondelivery', '貨到付款', 'payment_type_20200203095554.png', '2020-01-19 01:07:43', '2020-02-03 16:55:54'),
(5, 'IbonPay', 'Ibon付款', 'payment_type_20200203095605.jpg', '2020-01-19 01:09:37', '2020-02-03 16:56:05'),
(6, 'linePay', 'linePay', 'payment_type_20200203095926.png', '2020-01-19 16:06:35', '2020-02-03 16:59:26'),
(7, 'SamsunPay', 'SamsunPay', 'payment_type_20200203100029.png', '2020-01-19 16:08:06', '2020-02-03 17:00:29');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `pId` varchar(20) NOT NULL,
  `pName` varchar(20) NOT NULL,
  `price` int(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`pId`, `pName`, `price`, `created_at`, `updated_time`) VALUES
('p001', 'p001', 10, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p002', 'p002', 20, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p003', 'p003', 30, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p004', 'p004', 40, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p005', 'p005', 50, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p006', 'p006', 60, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p007', 'p007', 70, '0000-00-00 00:00:00', '2020-01-08 14:45:05'),
('p008', 'p008', 80, '0000-00-00 00:00:00', '2020-01-08 14:45:05');

-- --------------------------------------------------------

--
-- 資料表結構 `returndetail`
--

CREATE TABLE `returndetail` (
  `returnId` int(11) NOT NULL,
  `pId` varchar(20) NOT NULL,
  `count` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `returndetail`
--

INSERT INTO `returndetail` (`returnId`, `pId`, `count`, `created_at`, `updated_at`) VALUES
(1, 'p002', '1', '2020-01-21 20:01:38', '2020-01-21 20:01:38'),
(1, 'p005', '1', '2020-01-21 20:01:38', '2020-01-21 20:01:38'),
(2, 'p001', '2', '2020-01-21 20:02:06', '2020-01-21 20:02:06'),
(3, 'p001', '1', '2020-01-21 21:18:18', '2020-01-21 21:18:18'),
(4, 'p002', '1', '2020-01-22 13:12:59', '2020-01-22 13:12:59');

-- --------------------------------------------------------

--
-- 資料表結構 `returnlist`
--

CREATE TABLE `returnlist` (
  `returnId` int(11) NOT NULL,
  `orderId` varchar(20) NOT NULL,
  `returnPay` varchar(20) NOT NULL,
  `buyerName` varchar(20) NOT NULL,
  `buyerPhone` varchar(10) NOT NULL,
  `buyerAdress` varchar(30) NOT NULL,
  `returnReason` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `returnlist`
--

INSERT INTO `returnlist` (`returnId`, `orderId`, `returnPay`, `buyerName`, `buyerPhone`, `buyerAdress`, `returnReason`, `created_at`, `updated_at`) VALUES
(1, '78', '70', '0912345678', '', '台北市大安區復興南路一段390號 3號15樓', '2.5', '2020-01-21 20:01:38', '2020-01-21 20:01:38'),
(2, '75', '20', '0912345678', '', '台北市大安區復興南路一段390號 3號15樓', '1', '2020-01-21 20:02:06', '2020-01-21 20:02:06'),
(3, '80', '10', '0912345678', '', '台北市大安區復興南路一段390號 3號15樓', '123', '2020-01-21 21:18:18', '2020-01-21 21:18:18'),
(4, '86', '20', '0912345678', '', '台北市大安區復興南路一段390號 3號15樓', '234', '2020-01-22 13:12:59', '2020-01-22 13:12:59');

-- --------------------------------------------------------

--
-- 資料表結構 `shopcart`
--

CREATE TABLE `shopcart` (
  `csId` varchar(20) NOT NULL,
  `pId` varchar(20) NOT NULL,
  `count` int(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `shopcart`
--

INSERT INTO `shopcart` (`csId`, `pId`, `count`, `created_at`, `updated_time`) VALUES
('CS001', 'p003', 1, '2020-02-04 15:40:42', '2020-02-04 15:40:42'),
('CS001', 'p008', 3, '2020-02-04 15:40:46', '2020-02-06 09:09:38'),
('CS005', 'p006', 1, '2020-02-05 18:45:34', '2020-02-05 18:45:34'),
('CS005', 'p005', 3, '2020-02-05 18:53:57', '2020-02-05 18:53:59'),
('CS005', 'p001', 4, '2020-02-05 19:03:23', '2020-02-05 19:14:07'),
('CS001', 'p001', 4, '2020-02-06 09:26:52', '2020-02-06 09:27:01'),
('CS001', 'p005', 1, '2020-02-06 09:27:03', '2020-02-06 09:27:03'),
('', 'p003', 2, '2020-02-07 13:19:11', '2020-02-07 17:08:04'),
('', 'p001', 3, '2020-02-07 13:19:14', '2020-02-07 17:09:59'),
('', 'p002', 1, '2020-02-07 17:06:53', '2020-02-07 17:06:53'),
('', 'p006', 2, '2020-02-07 17:06:54', '2020-02-07 17:08:05'),
('', 'p007', 1, '2020-02-07 17:09:07', '2020-02-07 17:09:07'),
('', '', 1, '2020-02-07 17:10:34', '2020-02-07 17:10:34'),
('CS004', 'p005', 1, '2020-02-07 17:31:56', '2020-02-07 17:31:56'),
('CS004', 'p007', 1, '2020-02-07 17:31:58', '2020-02-07 17:31:58');

-- --------------------------------------------------------

--
-- 資料表結構 `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `studentId` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '學號',
  `studentName` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '學生姓名',
  `studentGender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '學生性別',
  `studentBirthday` date NOT NULL COMMENT '學生生日',
  `studentPhoneNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '學生手機號碼',
  `studentDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '個人描述',
  `studentImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '照片檔案名稱',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='學生資料表';

--
-- 傾印資料表的資料 `students`
--

INSERT INTO `students` (`id`, `studentId`, `studentName`, `studentGender`, `studentBirthday`, `studentPhoneNumber`, `studentDescription`, `studentImg`, `created_at`, `updated_at`) VALUES
(2, 'S001', '陳同學', '女', '1995-02-21', '0911111111', '你好，我是陳同學…\r\n請多指教…', NULL, '2019-12-06 00:37:09', '2019-12-10 18:52:53'),
(3, 'S002', '王同學', '男', '1996-03-22', '0922222222', '你好，我是王同學…\r\n請多指教…', NULL, '2019-12-08 21:33:36', '2019-12-10 18:52:55'),
(7, 'S003', '江同學', '女', '2000-07-25', '0966666666', '你好，我是江同學…\r\n請多指教…', NULL, '2019-12-08 22:02:24', '2019-12-10 18:52:58'),
(8, 'S004', '周同學', '男', '2001-08-26', '0977777777', '你好，我是周同學…\r\n請多指教…', NULL, '2019-12-08 22:02:57', '2019-12-10 18:53:01'),
(9, 'S005', '劉同學', '男', '2002-09-27', '0988888888', '你好，我是劉同學…\r\n請多指教…', NULL, '2019-12-08 22:03:48', '2019-12-10 18:53:03'),
(18, 'S006', '張同學', '女', '1995-07-13', '0987666555', '你好，我是張同學…\r\n請多指教…', NULL, '2019-12-10 18:41:50', '2019-12-10 18:53:04');

-- --------------------------------------------------------

--
-- 資料表結構 `table 9`
--

CREATE TABLE `table 9` (
  `categoryId` int(20) NOT NULL,
  `categoryName` varchar(20) NOT NULL,
  `categoryParentId` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `table 9`
--

INSERT INTO `table 9` (`categoryId`, `categoryName`, `categoryParentId`, `created_at`, `updated_at`) VALUES
(1, '全部', 0, '2019-12-30 11:42:35', '2019-12-30 11:42:35'),
(2, '相機/攝影機', 1, '2019-12-30 11:43:57', '2019-12-30 11:43:57'),
(3, 'rest', 0, '2020-01-09 10:13:43', '2020-01-09 10:13:43');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`csId`);

--
-- 資料表索引 `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`orderId`);

--
-- 資料表索引 `outlist`
--
ALTER TABLE `outlist`
  ADD PRIMARY KEY (`outId`);

--
-- 資料表索引 `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pId`);

--
-- 資料表索引 `returnlist`
--
ALTER TABLE `returnlist`
  ADD PRIMARY KEY (`returnId`);

--
-- 資料表索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `orderId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `outlist`
--
ALTER TABLE `outlist`
  MODIFY `outId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `returnlist`
--
ALTER TABLE `returnlist`
  MODIFY `returnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
