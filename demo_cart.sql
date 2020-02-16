-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

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
  `orderId` varchar(20) NOT NULL COMMENT '訂單編號',
  `buyerName` varchar(20) NOT NULL COMMENT '購買人姓名',
  `buyerPhone` varchar(10) NOT NULL COMMENT '購買人電話',
  `buyerAdress` varchar(99) NOT NULL COMMENT '購買人地址',
  `invoiceType` varchar(10) NOT NULL COMMENT '發票類別',
  `taxNo` int(10) NOT NULL COMMENT '統一編號',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderId` int(20) NOT NULL COMMENT '訂單編號',
  `pId` varchar(20) NOT NULL COMMENT '產品ID',
  `count` int(20) NOT NULL COMMENT '購買數量',
  `outStatus` varchar(20) NOT NULL COMMENT '產品狀態',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orderdetail`
--

INSERT INTO `orderdetail` (`orderId`, `pId`, `count`, `outStatus`, `created_at`, `updated_at`) VALUES
(1, 'p006', 1, '已出貨', '2020-02-16 10:41:53', '2020-02-16 10:41:53'),
(1, 'p008', 1, '退貨處理中', '2020-02-16 10:41:53', '2020-02-16 10:41:53'),
(2, 'p007', 2, '退貨處理中', '2020-02-16 10:42:00', '2020-02-16 10:42:00'),
(2, 'p001', 1, '退貨處理中', '2020-02-16 10:42:00', '2020-02-16 10:42:00'),
(3, 'p006', 2, '退貨完成', '2020-02-16 10:42:05', '2020-02-16 10:42:05'),
(3, 'p003', 1, '已出貨', '2020-02-16 10:42:05', '2020-02-16 10:42:05'),
(4, 'p002', 1, '退貨完成', '2020-02-16 10:43:07', '2020-02-16 10:43:07'),
(5, 'p005', 1, '退貨完成', '2020-02-16 10:43:11', '2020-02-16 10:43:11'),
(6, 'p008', 1, '退貨處理中', '2020-02-16 11:07:04', '2020-02-16 11:07:04'),
(6, 'p003', 1, '退貨處理中', '2020-02-16 11:07:04', '2020-02-16 11:07:04'),
(7, 'p003', 1, '', '2020-02-16 11:12:25', '2020-02-16 11:12:25'),
(8, 'p006', 2, '', '2020-02-16 11:12:32', '2020-02-16 11:12:32'),
(8, 'p005', 1, '', '2020-02-16 11:12:32', '2020-02-16 11:12:32'),
(9, 'p004', 1, '', '2020-02-16 13:31:29', '2020-02-16 13:31:29'),
(9, 'p006', 1, '', '2020-02-16 13:31:29', '2020-02-16 13:31:29');

-- --------------------------------------------------------

--
-- 資料表結構 `orderlist`
--

CREATE TABLE `orderlist` (
  `orderId` int(100) NOT NULL COMMENT '訂單編號',
  `csId` varchar(20) NOT NULL COMMENT '會員ID',
  `total` varchar(20) NOT NULL COMMENT '訂單總額',
  `marketingType` varchar(99) NOT NULL COMMENT '行銷類別',
  `paymentType` varchar(20) NOT NULL COMMENT '付款類別',
  `shippingWay` varchar(20) NOT NULL COMMENT '運送類別',
  `outStatus` varchar(20) NOT NULL COMMENT '訂單狀態',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orderlist`
--

INSERT INTO `orderlist` (`orderId`, `csId`, `total`, `marketingType`, `paymentType`, `shippingWay`, `outStatus`, `created_at`, `updated_time`) VALUES
(1, 'CS002', '140', '', 'ATM', '宅配到府', '已出貨', '2020-02-16 10:41:53', '2020-02-16 10:41:53'),
(2, 'CS002', '150', '', 'IbonPay', '宅配到府', '已出貨', '2020-02-16 10:42:00', '2020-02-16 10:42:00'),
(3, 'CS002', '150', '', 'CreditCard', '宅配到府', '已出貨', '2020-02-16 10:42:05', '2020-02-16 10:42:05'),
(4, 'CS002', '20', '', 'ATM', '宅配到府', '退貨完成', '2020-02-16 10:43:07', '2020-02-16 10:43:07'),
(5, 'CS002', '50', '', 'Cashondelivery', '宅配到府', '退貨完成', '2020-02-16 10:43:11', '2020-02-16 10:43:11'),
(6, 'CS002', '110', '', 'ATM', '宅配到府', '已出貨', '2020-02-16 11:07:04', '2020-02-16 11:07:04'),
(7, 'CS002', '30', '', 'ATM', '宅配到府', '訂單成立', '2020-02-16 11:12:25', '2020-02-16 11:12:25'),
(8, 'CS002', '170', '', 'ATM', '宅配到府', '訂單成立', '2020-02-16 11:12:32', '2020-02-16 11:12:32'),
(9, 'CS002', '100', '', 'CreditCard', '宅配到府', '訂單成立', '2020-02-16 13:31:29', '2020-02-16 13:31:29');

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
  `returnId` int(11) NOT NULL COMMENT '退貨編號',
  `pId` varchar(20) NOT NULL COMMENT '產品ID',
  `count` varchar(20) NOT NULL COMMENT '退貨數量',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `returndetail`
--

INSERT INTO `returndetail` (`returnId`, `pId`, `count`, `created_at`, `updated_at`) VALUES
(1, 'p005', '1', '2020-02-16 10:59:39', '2020-02-16 10:59:39'),
(2, 'p002', '1', '2020-02-16 11:03:25', '2020-02-16 11:03:25'),
(3, 'p006', '2', '2020-02-16 11:05:14', '2020-02-16 11:05:14'),
(7, 'p008', '1', '2020-02-16 13:38:14', '2020-02-16 13:38:14'),
(8, 'p003', '1', '2020-02-16 13:38:39', '2020-02-16 13:38:39'),
(9, 'p008', '1', '2020-02-16 13:38:46', '2020-02-16 13:38:46');

-- --------------------------------------------------------

--
-- 資料表結構 `returnlist`
--

CREATE TABLE `returnlist` (
  `returnId` int(11) NOT NULL COMMENT '退貨編號',
  `orderId` varchar(20) NOT NULL COMMENT '訂單編號',
  `returnStatus` varchar(20) NOT NULL COMMENT '退貨狀態',
  `returnPay` varchar(20) NOT NULL COMMENT '退款金額',
  `buyerName` varchar(20) NOT NULL COMMENT '購買人姓名',
  `buyerPhone` varchar(10) NOT NULL COMMENT '購買人電話',
  `buyerAdress` varchar(30) NOT NULL COMMENT '購買人地址',
  `returnReason` varchar(150) NOT NULL COMMENT '退貨原因',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `returnlist`
--

INSERT INTO `returnlist` (`returnId`, `orderId`, `returnStatus`, `returnPay`, `buyerName`, `buyerPhone`, `buyerAdress`, `returnReason`, `created_at`, `updated_at`) VALUES
(1, '5', '退貨完成', '50', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '134', '2020-02-16 10:59:39', '2020-02-16 10:59:39'),
(2, '4', '退貨完成', '20', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '', '2020-02-16 11:03:25', '2020-02-16 11:03:25'),
(3, '3', '退貨完成', '120', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '', '2020-02-16 11:05:14', '2020-02-16 11:05:14'),
(5, '5', '退貨處理中', '0', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '456', '2020-02-16 13:31:38', '2020-02-16 13:31:38'),
(6, '5', '退貨處理中', '0', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', 'tyty', '2020-02-16 13:31:44', '2020-02-16 13:31:44'),
(7, '6', '退貨處理中', '80', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '123', '2020-02-16 13:38:14', '2020-02-16 13:38:14'),
(8, '6', '退貨處理中', '30', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '123', '2020-02-16 13:38:39', '2020-02-16 13:38:39'),
(9, '1', '退貨處理中', '80', 'Bill', '0123456789', '台北市大安區復興南路一段390號2號2樓', '', '2020-02-16 13:38:46', '2020-02-16 13:38:46');

-- --------------------------------------------------------

--
-- 資料表結構 `shopcart`
--

CREATE TABLE `shopcart` (
  `csId` varchar(20) NOT NULL COMMENT '會員ID',
  `pId` varchar(20) NOT NULL COMMENT '產品ID',
  `count` int(20) DEFAULT NULL COMMENT '產品數量',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_time` datetime NOT NULL DEFAULT current_timestamp()
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
  MODIFY `orderId` int(100) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `returnlist`
--
ALTER TABLE `returnlist`
  MODIFY `returnId` int(11) NOT NULL AUTO_INCREMENT COMMENT '退貨編號', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
