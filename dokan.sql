-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2020 at 03:48 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dokan`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `link`, `status`, `added_by`, `added_date`, `updated_date`) VALUES
(3, 'test', 'Banner-20180924032413-141.jpg', 'http://google.com', 'Active', 3, '2018-09-24 19:09:13', NULL),
(6, 'dokan', 'Banner-20180930062103-797.png', 'http://google.com', 'Active', 3, '2018-09-30 10:06:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_parent` tinyint(4) DEFAULT 1,
  `parent_id` int(11) DEFAULT 0,
  `show_in_menu` tinyint(4) DEFAULT 1,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `summary`, `is_parent`, `parent_id`, `show_in_menu`, `image`, `STATUS`, `added_by`, `added_date`, `updated_date`) VALUES
(19, 'clothes', 'mens cool pants shirt and other avaialable', 1, 0, 1, 'Category-20180924034503-662.jpg', 'Active', 3, '2018-09-24 19:30:03', '2018-09-30 02:56:52'),
(21, 'Bags and Purses', '', 1, 0, 1, 'Category-20180924035125-188.jpg', 'Active', 3, '2018-09-24 19:36:25', NULL),
(23, 'watches and jwellery', '', 1, 0, 1, 'Category-20180924035233-79.jpg', 'Active', 3, '2018-09-24 19:37:33', NULL),
(24, 'Electronic', 'all electronic material', 1, 0, 1, 'Category-20180929111105-455.jpg', 'Active', 3, '2018-09-30 02:56:05', NULL),
(25, 'Mobile', 'smart phone,anoride ', 1, 0, 1, 'Category-20180929111342-456.jpg', 'Active', 3, '2018-09-30 02:58:42', NULL),
(26, 'ladies cloth', 'female dress', 0, 19, 1, 'Category-20180930120259-984.jpg', 'Active', 3, '2018-09-30 03:47:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `child_cat_id` int(11) NOT NULL DEFAULT 0,
  `summary` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `brand` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_cost` float DEFAULT NULL,
  `is_branded` tinyint(4) DEFAULT 1,
  `is_featured` tinyint(4) NOT NULL DEFAULT 1,
  `status` enum('Active','inactive') COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `cat_id`, `child_cat_id`, `summary`, `description`, `price`, `discount`, `brand`, `vendor`, `delivery_cost`, `is_branded`, `is_featured`, `status`, `added_by`, `added_date`, `updated_date`) VALUES
(18, 'bags', 21, 0, 'ladies bags', '&lt;p&gt;asum bag fo rgirl&lt;/p&gt;', 2000, 1, '', 'daraz', 0, 0, 1, 'Active', 3, '2018-09-26 23:03:03', NULL),
(19, 'werffew', 21, 0, 'r', '&lt;p&gt;hgh&lt;/p&gt;', 6465, 2, 'Rolax', 'Amazon', 123, 1, 0, 'Active', 3, '2018-09-26 23:06:03', NULL),
(21, 'samsung', 19, 0, 'qsdqqsdsd', '&lt;p&gt;wsf&lt;/p&gt;', 132, 1, '', 'daraz', 0, 1, 0, 'Active', 3, '2018-09-30 02:24:38', NULL),
(23, 'shoes', 19, 0, 'woolen shoes', '&lt;p&gt;blck white&lt;/p&gt;', 1200, 1, 'puma', 'Amazon', 0, 1, 0, 'Active', 3, '2018-09-30 02:34:14', NULL),
(24, 'watch', 23, 0, 'goodwatch', '&lt;p&gt;weelll&amp;nbsp;&lt;/p&gt;', 3000, 2, 'TITAn', 'daraz', 0, 0, 1, 'Active', 3, '2018-09-30 02:35:55', NULL),
(25, 'laptop', 24, 0, 'i5 laptop', '&lt;p&gt;black in color ,size15\'\' 500 gb hardddisk&lt;/p&gt;', 300000, 6, 'DEll', 'flipcart', 500, 1, 1, 'Active', 3, '2018-09-30 03:41:47', NULL),
(26, 'kurta', 19, 0, 'ladies drress', '&lt;p&gt;cofortable,light fashionable&lt;/p&gt;', 450, 10, '', 'daraz', 0, 0, 1, 'Active', 3, '2018-09-30 03:44:32', NULL),
(27, 'AC', 24, 0, 'coolll asum ac', '&lt;p&gt;cheap branded&lt;/p&gt;', 100000, 10, 'phiips', 'quickdeal', 450, 1, 0, 'Active', 3, '2018-09-30 03:49:55', NULL),
(28, 'jacket', 19, 26, 'wow ateste on the marrket u never have this before what you say', '&lt;p&gt;lorem epsum&lt;/p&gt;', 2000, 5, 'denim', 'amazon', 50, 1, 0, 'Active', 5, '2019-09-19 11:47:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`) VALUES
(1, 1, 'Product-20180918070157-928.jpg'),
(2, 2, 'Product-20180918070643-386.jpg'),
(3, 3, 'Product-20180918091258-337.jpg'),
(4, 4, 'Product-20180918091925-60.jpg'),
(5, 5, 'Product-20180925062259-747.jpg'),
(6, 6, 'Product-20180925062452-416.jpg'),
(7, 7, 'Product-20180925062604-318.jpg'),
(8, 8, 'Product-20180925062713-891.jpg'),
(9, 9, 'Product-20180925062813-928.jpg'),
(10, 10, 'Product-20180925062908-25.jpg'),
(11, 11, 'Product-20180925063009-996.jpg'),
(12, 12, 'Product-20180925063111-585.jpg'),
(13, 13, 'Product-20180926010012-407.jpg'),
(14, 14, 'Product-20180926010120-778.jpg'),
(15, 15, 'Product-20180926063653-327.jpg'),
(16, 16, 'Product-20180926064209-41.jpg'),
(17, 17, 'Product-20180926071647-481.jpg'),
(18, 18, 'Product-20180926071803-47.jpg'),
(19, 19, 'Product-20180926072103-666.jpg'),
(20, 20, 'Product-20180926072200-506.jpg'),
(21, 21, 'Product-20180929103938-618.jpg'),
(22, 22, 'Product-20180929095730-959.jpg'),
(23, 23, 'Product-20180929104914-438.jpg'),
(24, 24, 'Product-20180929105055-785.jpg'),
(25, 25, 'Product-20180929115647-829.jpg'),
(26, 26, 'Product-20180929115932-474.jpg'),
(27, 27, 'Product-20180930120455-255.jpg'),
(28, 28, 'Product-20190919080211-64.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('Admin','Customer','Vendor') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','inactive') COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `status`, `api_token`, `remember_token`, `added_date`, `updated_date`) VALUES
(2, 'sandeep pant', 'sandeep@dokan.com', 'd0bd80bfba3cc1d737287acbaf484e2682bf78c1', 'Customer', 'Active', 'OdWgHwgFCvHExVDRdgqZzAD0Ngu4FvYSvJ5cvy461nJfzmuD07qF5dYFwsq1k4yASOfWjoZBh9zZAYq1G7bwPfrScUM7t5XviqGj', NULL, '2018-09-07 15:53:49', '2018-09-30 04:07:57'),
(3, 'sandeep', 'test@test.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Admin', 'Active', 'pXAj1NM0Cert07uz79QZGerz1xJL7fJceB3W0ZCcte6OnHUNfO0AuemiQ1496vsrj2PTQe8a7eMlUTXm2FxtR63yIkTjDmrH0m3A', '', '0000-00-00 00:00:00', '2018-12-03 12:30:05'),
(5, 'sandeep pant', 'sandeeppant024@gmail.com', 'ad9280c159074d9ec90899b584f520606e83d10e', 'Admin', 'Active', 'CQvYUiGjv6Vx3aiHlv4Ouy5lZ98rBTOL5uJIrxeCZZer56IQ65u4c8ympWaHoWH93GSazDSLtjhBFIZiwyV0COz7krxH0fcgsEPT', NULL, '2019-09-19 11:42:44', '2019-09-19 11:44:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
