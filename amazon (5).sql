-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 أكتوبر 2023 الساعة 09:58
-- إصدار الخادم: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amazon`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `name_admin` varchar(50) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `password_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `name_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`id_cat`, `name_cat`) VALUES
(1, 'جوالات'),
(7, 'سماعات'),
(8, 'ساعات'),
(9, 'التلفزيون'),
(10, 'الكمبيوتر');

-- --------------------------------------------------------

--
-- بنية الجدول `customars`
--

CREATE TABLE `customars` (
  `id` int(11) NOT NULL,
  `name_cust` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_cust` varchar(50) NOT NULL,
  `phone_cust` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `customars`
--

INSERT INTO `customars` (`id`, `name_cust`, `email`, `password_cust`, `phone_cust`) VALUES
(1, 'wajdi', 'alhajri123wajdi321@gmail.com', '12345', '772520163'),
(3, 'algaamei', 'algaamei2023@gmail.com', '11111', '716238927'),
(5, 'zakarya', 'zakarya2023@gmail.com', '12321', '778596152'),
(8, 'wajdi', 'wajdi@gmil.com', '55', '7777777777'),
(9, 'mohammed', 'm.algamei@gmial.com', '11', '716238927'),
(10, 'mohammed', 'm@gmil.com', '22', '716238927');

-- --------------------------------------------------------

--
-- بنية الجدول `prudocts`
--

CREATE TABLE `prudocts` (
  `id_prud` int(11) NOT NULL,
  `name_prud` varchar(50) NOT NULL,
  `price_prud` double NOT NULL,
  `desc_prud` varchar(200) NOT NULL,
  `sourc_img` varchar(100) NOT NULL,
  `date_prud` date NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `prudocts`
--

INSERT INTO `prudocts` (`id_prud`, `name_prud`, `price_prud`, `desc_prud`, `sourc_img`, `date_prud`, `id_cat`) VALUES
(21, 'سماعة', 250, 'اللون,اسود,السماع,بلوتوث', 'images/31+Ge-LRDeL._AC_UF226,226_FMjpg_.jpeg', '2023-09-30', 7),
(23, 'جوال مدرع مزود بخازن شحن', 1000, 'اللون,ابيض,مزايا 1,يعمل بتقنية 5G', 'images/41MzPAypT-L._AC_UF452,452_FMjpg_.jpg', '2023-09-27', 1),
(24, 'ساعة اطفال - كيوت', 550, 'اللون,ازرق,تتوفر خاصية,امكانية اللمس,مزية 1,تركب له شريحة', 'images/hour.jpg', '2023-09-30', 8),
(25, 'شاشة تلفزيون', 250, 'اللون,اسود,تعمل بتقنية,HD,البوصة,28', 'images/Samsung,-65-Inch,-4K-UHD-10+,-Smart-TV.png', '2023-10-01', 9),
(26, 'كمبيوتر محمول', 150, 'اللون,ابيض', 'images/41ts7XHSjjL._AC_UF452,452_FMjpg_.jpg', '2023-10-01', 10),
(27, 'سماعة ذكية', 50, 'اللون,اسود,مزاياء 1,تتميز بالصوت الصافي خالي من التشويش', 'images/31056J3NgVL._AC_UF452,452_FMjpg_.jpg', '2023-09-30', 7),
(28, 'سماعة راس', 500, 'اللون,اسود,مزاياء,مكرفون - اخراخ', 'images/head1.jpg', '2023-09-30', 7);

-- --------------------------------------------------------

--
-- بنية الجدول `purchases`
--

CREATE TABLE `purchases` (
  `id_cust` int(11) NOT NULL,
  `id_prud` int(11) NOT NULL,
  `quantity_order` int(11) NOT NULL,
  `status_order` varchar(50) NOT NULL,
  `delivery` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `purchases`
--

INSERT INTO `purchases` (`id_cust`, `id_prud`, `quantity_order`, `status_order`, `delivery`) VALUES
(10, 28, 18, ' تم الدفع ', 1),
(10, 21, 1, ' تم الدفع ', 1),
(10, 24, 7, ' تم الدفع ', 1),
(10, 25, 8, ' تم الدفع ', 1),
(10, 26, 9, 'لم يتم الدفع بعد', 1),
(10, 23, 1, 'لم يتم الدفع بعد', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`) USING BTREE;

--
-- Indexes for table `customars`
--
ALTER TABLE `customars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prudocts`
--
ALTER TABLE `prudocts`
  ADD PRIMARY KEY (`id_prud`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD KEY `id_prud` (`id_prud`),
  ADD KEY `id_cust` (`id_cust`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customars`
--
ALTER TABLE `customars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prudocts`
--
ALTER TABLE `prudocts`
  MODIFY `id_prud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `prudocts`
--
ALTER TABLE `prudocts`
  ADD CONSTRAINT `prudocts_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON UPDATE CASCADE;

--
-- القيود للجدول `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`id_cust`) REFERENCES `customars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`id_prud`) REFERENCES `prudocts` (`id_prud`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
