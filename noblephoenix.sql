-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-09-19 16:31:26
-- 服务器版本： 10.4.14-MariaDB
-- PHP 版本： 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `noblephoenix`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'teikkeen@gmail.com', 'adminpassword');

-- --------------------------------------------------------

--
-- 表的结构 `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(3, 'ELBA'),
(4, 'Faber'),
(5, 'Panasonic'),
(6, 'Philips'),
(7, 'Tefal'),
(8, 'Cornell');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Kitchen Appliances'),
(2, 'Air Conditioner'),
(3, 'Audio-Visual Appliances'),
(4, 'Clean Electrical Appliances'),
(5, 'Refrigeneration Appliances');

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `customer` (
  `Cust_No` int(9) NOT NULL,
  `Cust_Name` varchar(30) DEFAULT NULL,
  `Cust_Email` varchar(35) DEFAULT NULL,
  `ProdCount` int(5) DEFAULT NULL,
  `Sub_Total` double(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`Cust_No`, `Cust_Name`, `Cust_Email`, `ProdCount`, `Sub_Total`) VALUES
(1, 'Zhou Yan', 'gai666@gmail.com', 5, 500.50),
(2, 'Jackson Wang', 'jackson123@gmail.com', 10, 5000.00),
(3, 'Benzo', 'benzo555@gmail.com', 8, 2500.60);

-- --------------------------------------------------------

--
-- 表的结构 `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(10) NOT NULL,
  `delivery_company` varchar(255) NOT NULL,
  `delivery_price` double(15,2) NOT NULL,
  `delivery_company_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_company`, `delivery_price`, `delivery_company_image`) VALUES
(4, 'POS Laju', 7.60, 'poslaju.png'),
(5, 'DHL ', 5.50, 'dhl.png'),
(6, 'GDex', 6.90, 'gdex.png'),
(7, 'TA-Q-BIN', 5.80, 'taqbin.jpg'),
(8, 'City-Link Express', 6.70, 'ciliex.png'),
(9, 'Aramex', 9.90, 'aramex.png');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `order_status` varchar(5) NOT NULL,
  `payment_status` varchar(5) NOT NULL,
  `delivery_status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `trx_id`, `order_status`, `payment_status`, `delivery_status`) VALUES
(200919285, 5, 'trx9998033U5', 'CT', 'PD', 'SG'),
(200919321, 1, 'trx4562181U1', 'CT', 'PD', 'SG'),
(200919541, 1, 'trx2503324U1', 'CT', 'PD', 'SG'),
(200919785, 5, 'trx6758025U5', 'CT', 'PD', 'SG'),
(2009182399, 99, 'trx5485876U99', 'CT', 'PD', 'SG'),
(2009186699, 99, 'trx1000701U99', 'CT', 'PD', 'SG'),
(2009187999, 99, 'trx7971781U99', 'CT', 'PD', 'SG'),
(2009191299, 99, 'trx7789001U99', 'CT', 'PD', 'SG'),
(2009192499, 99, 'trx4048370U99', 'CT', 'PD', 'SG'),
(2009193199, 99, 'trx9911285U99', 'CT', 'PD', 'SG'),
(2009196299, 99, 'trx1699929U99', 'CT', 'PD', 'SG');

-- --------------------------------------------------------

--
-- 表的结构 `orders_info`
--

CREATE TABLE `orders_info` (
  `order_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `cardname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardnumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amt` double(15,2) DEFAULT NULL,
  `cvv` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `orders_info`
--

INSERT INTO `orders_info` (`order_id`, `user_id`, `delivery_id`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv`) VALUES
(200919285, 5, 6, 'hongqingyun', '3434-6465-4647-3439', '23/45', 1, 1993.10, 324),
(200919321, 1, 6, 'Wong Teik Keen', '1433-4644-9343-5466', '04/25', 1, 393.10, 232),
(200919541, 1, 4, 'TeikKeen', '1433-4644-9343-5466', '03.43', 1, 1192.40, 232),
(200919785, 5, 6, 'hongqingyun', '2424-2424-2464-7654', '23/21', 1, 2243.10, 354),
(2009182399, 99, 5, 'hongqingyun', '2424-2424-2464-7654', '23/21', 1, 65.00, 322),
(2009186699, 99, 5, 'Wong Teik Keen', '1212-1212-1212-1212', '12/12', 2, 2059.50, 121),
(2009187999, 99, 6, 'hongqingyun', '2424-2424-2464-7654', '23/22', 1, 6743.10, 343),
(2009191299, 5, 8, 'hongqingyun', '2324-3434-5452-4546', '12/53', 1, 623.30, 543),
(2009192499, 99, 3, 'wesdsd', '1212-1212-1212-1212', '12/12', 1, 1200.00, 121),
(2009193199, 99, 5, 'Hi Ning', '3436-5675-8664-7683', '12/20', 2, 11655.50, 456),
(2009196299, 99, 4, '', '', '', 1, 407.60, 0);

-- --------------------------------------------------------

--
-- 表的结构 `order_products`
--

CREATE TABLE `order_products` (
  `order_pro_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `amt` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `order_products`
--

INSERT INTO `order_products` (`order_pro_id`, `order_id`, `product_id`, `qty`, `amt`) VALUES
(16, 2009187999, 74971, 3, 6750.00),
(17, 2009182399, 74984, 1, 65.00),
(18, 2009186699, 74971, 1, 2250.00),
(19, 2009186699, 74972, 1, 630.00),
(22, 2009192499, 74974, 3, 1200.00),
(23, 2009195599, 74971, 1, 2250.00),
(25, 2009191299, 74984, 1, 65.00),
(26, 2009191299, 74971, 1, 2250.00),
(28, 200919785, 74971, 1, 2250.00),
(29, 200919285, 74974, 5, 2000.00),
(30, 200919541, 74974, 3, 1200.00),
(31, 200919321, 74974, 1, 400.00),
(37, 2009196299, 74974, 1, 400.00);

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(15,2) NOT NULL,
  `product_promo_price` double(15,2) NOT NULL,
  `product_quantity` int(100) NOT NULL,
  `product_published` int(255) DEFAULT NULL,
  `product_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_promo_price`, `product_quantity`, `product_published`, `product_desc`, `product_image`, `product_keywords`) VALUES
(74971, 1, 'ELBA', 'ELBA Designer Hood PRIMO EHG9325STBK', 2500.00, 2250.00, 892, 104, 'dddadadd', '5f648b811575f.jpg', 'ELBA Kitchen Appliances'),
(74972, 1, 'Faber', 'Faber Build In Glass Hob FBR-FGH573/76BK', 700.00, 630.00, 199, 49, 'Premium Tempered Glass Safety Device 5.2kW Powerful Flame', '5f648be874915.jpg', 'Faber Glass Hob'),
(74974, 4, 'Panasonic', 'Panasonic 2800W Optimal Iron NI-WT970NSK', 400.00, 400.00, 918, 25, 'R32 Energy SavingLED Temperature Display100% Copper PipesBlue Fin5 Years Compressor + 2 Years General Warranty', '5f64d24ab49e3.jpg', 'irons'),
(74979, 4, 'Philips ', 'Philips Azur Advanced Steam Iron PLP-GC4933', 500.20, 450.18, 968, 32, 'Guaranteed no burns\r\n3000W\r\n55 g/min continuous steam\r\n230g steam boost\r\nSteamGlide Plus soleplate\r\n', '5f64d3749fc18.jpg', 'irons'),
(74984, 4, 'Tefal ', 'Tefal Easy Gliss Dry Iron TEF-FS4030', 100.00, 65.00, 200, 28, 'Great results is what the Tefal FS4030 can deliver, thanks to its lightweight and sturdy properties. Equipped with a Durilium soleplate, it glides effortless on all types of fabrics.\r\n', '5f64d4ec5d17c.jpg', 'irons'),
(74985, 5, 'Cornell ', 'Cornell Evaporative Air Cooler CAC-PD63ECO', 1000.40, 900.36, 2000, 0, 'Trying to get a good night sleep or an afternoon siesta, or even having a chillaxing with a small gathering, can already make you break into a sweaty frenzy. Cornell Air Cooler CAC-PD63ECO might just be what you need. This Air Cooler helps you to stay coo', '5f64f288c3a9a.jpg', 'Cooler');

-- --------------------------------------------------------

--
-- 表的结构 `product_review`
--

CREATE TABLE `product_review` (
  `id` int(8) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rate_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `product_review`
--

INSERT INTO `product_review` (`id`, `user_id`, `product_id`, `user_name`, `user_email`, `description`, `rate_time`) VALUES
(12, 1, 74979, 'Teik Keen', 'wongtk-wm19@student.tarc.edu.my', 'Good', '19 Sep 2020 10:35:47 AM'),
(15, 1, 74972, 'Teik Keen', 'wongtk-wm19@student.tarc.edu.my', '', '19 Sep 2020 10:44:03 AM'),
(16, 99, 74979, 'Ning De  ', 'gannn500@yahoo.com', 'Good', '19 Sep 2020 07:50:22 PM'),
(23, 1, 74985, 'Teik Keen  ', 'wongtk-wm19@student.tarc.edu.my', 'Good Quality', '19 Sep 2020 03:26:08 PM'),
(24, 5, 74985, 'Qin Yun  ', 'hongqy87@gmail.com', '', '19 Sep 2020 03:26:52 PM'),
(25, 99, 74974, 'Ning De  ', 'gannn500@yahoo.com', '', '19 Sep 2020 05:23:22 PM'),
(26, 99, 74972, 'Ning De  ', 'gannn500@yahoo.com', '', '19 Sep 2020 06:47:54 PM');

-- --------------------------------------------------------

--
-- 表的结构 `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `rating`
--

INSERT INTO `rating` (`id`, `review_id`, `user_id`, `rating`) VALUES
(9, 12, 1, 4),
(12, 15, 1, 3),
(13, 16, 99, 5),
(20, 23, 1, 4),
(21, 24, 5, 4),
(22, 25, 99, 3),
(23, 26, 99, 4);

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address`, `city`, `state`, `zip`) VALUES
(1, 'Teik Keen', 'Wong', 'wongtk-wm19@student.tarc.edu.my', 'teikkeen', '011-363398', 'No 11, Jalan RP5/10, Taman Rawang Perdana', 'Rawang', 'Selangor', 48000),
(5, 'Qin Yun', 'Hong', 'hongqy87@gmail.com', 'hongqingyun', '012-456789', 'No 1222, Jalan KP 11/122, Taman King QJ', 'Petaling Jaya', 'Kuala Lumpur', 78500),
(99, 'Ning De', 'Gan', 'gannn500@yahoo.com', 'whatever', '011-456987', 'No 99, Jalan 34/300, Taman Ling Long', 'Ara Damansara', 'Kuala Lumpur', 56700);

-- --------------------------------------------------------

--
-- 表的结构 `user_info_backup`
--

CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- 表的索引 `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- 表的索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_No`);

--
-- 表的索引 `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- 表的索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- 表的索引 `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_pro_id`);

--
-- 表的索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_brand_3` (`product_brand`),
  ADD KEY `product_cat` (`product_cat`),
  ADD KEY `product_brand` (`product_brand`),
  ADD KEY `product_brand_2` (`product_brand`),
  ADD KEY `product_brand_4` (`product_brand`);

--
-- 表的索引 `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- 表的索引 `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `review_id` (`review_id`);

--
-- 表的索引 `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- 表的索引 `user_info_backup`
--
ALTER TABLE `user_info_backup`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `orders_info`
--
ALTER TABLE `orders_info`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2009196300;

--
-- 使用表AUTO_INCREMENT `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74986;

--
-- 使用表AUTO_INCREMENT `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- 限制导出的表
--

--
-- 限制表 `orders_info`
--
ALTER TABLE `orders_info`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- 限制表 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`);

--
-- 限制表 `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
