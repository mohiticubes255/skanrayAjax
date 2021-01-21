-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 01:26 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skanray`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_token` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `latitude` varchar(150) NOT NULL,
  `longitude` varchar(150) NOT NULL,
  `is_default` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `add_to_card`
--

CREATE TABLE `add_to_card` (
  `id` bigint(20) NOT NULL,
  `cid` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `price` varchar(500) NOT NULL,
  `quenty` varchar(500) NOT NULL,
  `total_amount` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_to_card`
--

INSERT INTO `add_to_card` (`id`, `cid`, `product_id`, `product_name`, `price`, `quenty`, `total_amount`) VALUES
(24, '1611046738000', '11', 'SkanDR 630', '4000', '1', '4000'),
(25, '1611046738000', '12', 'SkanRAD 300i', '5000', '1', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `all_order`
--

CREATE TABLE `all_order` (
  `id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `contact` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `total_product` varchar(500) NOT NULL,
  `total_amount` varchar(500) NOT NULL,
  `payment_type` varchar(500) NOT NULL,
  `payment_status` varchar(500) NOT NULL,
  `delever` varchar(500) NOT NULL,
  `delever_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `all_order`
--

INSERT INTO `all_order` (`id`, `name`, `email`, `contact`, `city`, `date`, `total_product`, `total_amount`, `payment_type`, `payment_status`, `delever`, `delever_date`) VALUES
(3, 'Mohit', 'mohitchack255@gmail.com', '8962334644', 'Gwalior', '2021-01-18 17:43:15', '3', '16000', 'COD', 'Done', 'Done', ''),
(4, 'Mohit', 'mohitchack255@gmail.com', '8962334644', 'Gwalior', '2021-01-18 17:49:11', '3', '15000', 'COD', 'Done', 'Done', ''),
(5, 'Mohit', 'mohitchack255@gmail.com', '8962334644', 'Gwalior', '2021-01-19 12:05:27', '3', '16000', 'COD', 'Pending', 'Pending', ''),
(6, 'Mohit', 'mohit.chack@icubeswire.com', '8962334644', 'Gwalior', '2021-01-19 12:08:30', '3', '15500', 'COD', 'Pending', 'Pending', ''),
(7, 'Mohit', 'mohit.chack@icubeswire.com', '8962334644', 'Gwalior', '2021-01-19 12:25:56', '4', '24500', 'COD', 'Pending', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `varient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `add_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `parent_id`, `sort_order`, `add_date`) VALUES
(1, 'X-ray Systems', '', 0, 1, '2021-01-14 12:31:07'),
(2, 'Surgical C-Arm', '', 0, 2, '2021-01-12 12:35:15'),
(3, 'ventilators', '', 0, 3, '2021-01-12 12:36:50'),
(4, 'Central Nursing status', '', 0, 4, '2021-01-14 12:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon` varchar(15) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `min_order` decimal(10,2) NOT NULL,
  `max_discount` decimal(10,2) NOT NULL,
  `per_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `txn_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `varient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `product_meta` text NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oreder_product`
--

CREATE TABLE `oreder_product` (
  `id` bigint(20) NOT NULL,
  `order_id` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `price` varchar(500) NOT NULL,
  `quenty` varchar(500) NOT NULL,
  `total_amount` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreder_product`
--

INSERT INTO `oreder_product` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quenty`, `total_amount`) VALUES
(1, '3', '13', 'Skan C', '2000', '1', '2000'),
(2, '3', '12', 'SkanRAD 300i', '5000', '2', '10000'),
(3, '3', '11', 'SkanDR 630', '4000', '1', '4000'),
(4, '4', '11', 'SkanDR 630', '4000', '3', '12000'),
(5, '4', '6', 'Skan Respiro', '500', '2', '1000'),
(6, '4', '13', 'Skan C', '2000', '1', '2000'),
(7, '5', '13', 'Skan C', '2000', '1', '2000'),
(8, '5', '11', 'SkanDR 630', '4000', '1', '4000'),
(9, '5', '8', 'Skyview', '5000', '2', '10000'),
(10, '6', '11', 'SkanDR 630', '4000', '1', '4000'),
(11, '6', '8', 'Skyview', '5000', '2', '10000'),
(12, '6', '9', 'Microskan 2000', '1500', '1', '1500'),
(13, '7', '12', 'SkanRAD 300i', '5000', '2', '10000'),
(14, '7', '8', 'Skyview', '5000', '1', '5000'),
(15, '7', '9', 'Microskan 2000', '1500', '1', '1500'),
(16, '7', '11', 'SkanDR 630', '4000', '2', '8000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL DEFAULT 0,
  `product_name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `dicount_price` int(11) NOT NULL,
  `features` longtext NOT NULL,
  `images` text NOT NULL,
  `summary` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('y','n') NOT NULL DEFAULT 'n',
  `add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `speciality_id`, `product_name`, `price`, `dicount_price`, `features`, `images`, `summary`, `description`, `status`, `add_date`) VALUES
(1, 1, 0, 'Microskan', 1000, 700, 'Ultra light mobile HF X-Ray (<55 kg)|Hand-held and integrated console for parameter setting and exposure control|Tube-head rotation|Suitable for NICU, ICU, Trauma, Ortho & Ambulance', 'product-5ffea25cb9424.png|product-5ffea2662b865.png|product-5ffea2662bab3.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'y', '2021-01-13 05:19:18'),
(2, 1, 0, 'Microskan Ion', 1000, 800, 'Ultra light mobile HF X-Ray (<55 kg)|2.8kW, 200kHz, 60mA with APR|Hand-held and integrated console for parameter setting and exposure control|90° collimator rotation|Tube-head rotation|Suitable for NICU, ICU, Trauma, Ortho & Ambulance|Battery operated version of microSkan,providing up-to 200 exposures on fullcharge', 'product-5ffe83821bab2.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'y', '2021-01-13 05:22:10'),
(4, 3, 0, 'PRANAA', 20000, 19000, 'Standby for centralised air supply|Continuous pressure and hours-run displa|Peltier driven de-humidification|Pump temperature protection|Easily attachable with SkanRespiro™ and SkanRespiro Plus™', 'product-5ffff194443e6.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'n', '2021-01-13 07:16:45'),
(5, 3, 0, 'SkanRespiro Plus', 500, 300, 'Paediatric to Adult ICU Ventilator with advanced compressor design|Volume & pressure controlled breath types|Invasive & non-invasive applications as standard', 'product-60002773d50ed.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'n', '2021-01-13 07:18:23'),
(6, 3, 0, 'Skan Respiro', 600, 500, 'Paediatric to Adult ICU Ventilator with advanced compressor design|Volume & pressure controlled breath types|Invasive & non-invasive applications as standard|In-built nebulizer port', 'product-5ffea2662bab3.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'n', '2021-01-13 07:20:09'),
(7, 4, 0, 'Skyline 55', 700, 600, 'Windows based Central Nursing Station|Monitoring of 8/16 Beds|Wired & wireless connectivity to patient Monitors (Monitor Dependent)|Multi-parameter & multi-bed modes with detailed views|Up-to 72 Hours of waveform disclosure', 'product-5ffff194443e6.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'n', '2021-01-13 07:21:57'),
(8, 4, 0, 'Skyview', 7000, 5000, 'Remote monitoring solution for multiple central stations|Monitoring of patient data over LAN/web|Secure patient data access', 'product-5ffe83821bab2.png', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated v', 'Battery operated version of microSkan,providing up-to 200 exposures on fullcharge Battery operated version of microSkan,providing up-to 200 exposures on fullcharge ', 'n', '2021-01-13 07:24:12'),
(9, 1, 1, 'Microskan 2000', 2000, 1500, 'Ultra light mobile HF X-Ray (<55 kg)|2.8kW, 200kHz, 60mA with APR|Hand-held and integrated console for parameter setting and exposure control|90° collimator rotation|Tube-head rotation|Suitable for NICU, ICU, Trauma, Ortho & Ambulance', 'product-5ffff194443e6.png', 'Suitable for NICU, ICU, Trauma, Ortho & Ambulance Suitable for NICU, ICU, Trauma, Ortho & Ambulance ', 'Suitable for NICU, ICU, Trauma, Ortho & Ambulance Suitable for NICU, ICU, Trauma, Ortho & Ambulance', 'y', '2021-01-14 07:24:04'),
(10, 1, 1, 'SkanDR 630i', 5000, 4500, '50kW HF generator with flat panel|digital radiography platform|kVp Range: 40-150|mA Range: 10-630|16-bit dynamic range, 100 μm pixel pitch|17”x17” CsI Flat panel detector', 'product-600023a1af8ae.png', '17”x17” CsI Flat panel detector 17”x17” CsI Flat panel detector 17”x17” CsI Flat panel detector 17”x', '17”x17” CsI Flat panel detector 17”x17” CsI Flat panel detector 17”x17” CsI Flat panel detector', 'y', '2021-01-14 10:57:37'),
(11, 1, 1, 'SkanDR 630', 5000, 4000, '50kW HF generator with flat panel|digital radiography platform|kVp Range: 40-150|mA Range: 10-630', 'product-60002773d50ed.png', 'mA Range: 10-630 mA Range: 10-630 mA Range: 10-630 mA Range: 10-630 ', 'mA Range: 10-630 mA Range: 10-630 mA Range: 10-630 mA Range: 10-630', 'y', '2021-01-14 11:13:55'),
(12, 1, 2, 'SkanRAD 300i', 6000, 5000, '32kW HF Fixed RAD system|kVp: 40kV-125kV|mA: 10mA-400mA', 'product-600027e82ffcd.png', 'mA: 10mA-400mA mA: 10mA-400mA mA: 10mA-400mAmA: 10mA-400mA', 'mA: 10mA-400mA mA: 10mA-400mA mA: 10mA-400mAmA: 10mA-400mA mA: 10mA-400mA ', 'y', '2021-01-14 11:15:52'),
(13, 2, 0, 'Skan C', 8000, 2000, 'Near Zero leakage radiation|High-Frequency generator technology with switching range from 80-250 kHz|3.5 kW dual processor monoblock generator with proprietary radiation shielding technology', 'product-60013382e0fee.png', '3.5 kW dual processor monoblock generator with proprietary radiation shielding technology 3.5 kW dua', '3.5 kW dual processor monoblock generator with proprietary radiation shielding technology', 'y', '2021-01-15 06:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_additional`
--

CREATE TABLE `product_additional` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `per` varchar(250) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `images` text NOT NULL,
  `stocks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `SPECIALITYID` int(11) NOT NULL,
  `speciality_name` varchar(255) NOT NULL,
  `speciality_creation` datetime NOT NULL,
  `speciality_status` enum('y','n') NOT NULL DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`SPECIALITYID`, `speciality_name`, `speciality_creation`, `speciality_status`) VALUES
(1, 'RADIOLOGY', '2021-01-14 10:56:58', 'y'),
(2, 'INTENSIVE CARE', '2021-01-14 12:16:40', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `txn_amount` decimal(10,2) NOT NULL,
  `delivery_charges` decimal(10,2) NOT NULL,
  `coupon_discount` decimal(10,2) NOT NULL,
  `coupon_text` varchar(50) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `payment_method` enum('cod','online') NOT NULL DEFAULT 'cod',
  `address_meta` text NOT NULL,
  `txn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `profile` varchar(42) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `password` varchar(255) NOT NULL,
  `forgot_token` varchar(250) NOT NULL,
  `token_datetime` datetime DEFAULT NULL,
  `display_name` varchar(200) NOT NULL,
  `role` int(11) NOT NULL,
  `activated` enum('y','n') NOT NULL DEFAULT 'n',
  `verified_email` enum('y','n') NOT NULL DEFAULT 'n',
  `verified_mobile` enum('y','n') NOT NULL DEFAULT 'n',
  `last_login` datetime NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `mobile`, `profile`, `otp`, `password`, `forgot_token`, `token_datetime`, `display_name`, `role`, `activated`, `verified_email`, `verified_mobile`, `last_login`, `registration_date`) VALUES
(1, 'admin@skanray.com', '7982938284', '', '', '$2y$10$dbz695BzTxBsIz2ksXsjouoUdEzMvzdd5OqPB18FInFSnkfjOrUua', '', NULL, 'Admin', 1, 'y', 'y', 'y', '2020-04-03 15:13:22', '2020-04-03 15:13:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete_address` (`user_id`);

--
-- Indexes for table `add_to_card`
--
ALTER TABLE `add_to_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_order`
--
ALTER TABLE `all_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remove_user_cart` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oreder_product`
--
ALTER TABLE `oreder_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `product_additional`
--
ALTER TABLE `product_additional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`SPECIALITYID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_token`
--
ALTER TABLE `access_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_to_card`
--
ALTER TABLE `add_to_card`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `all_order`
--
ALTER TABLE `all_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oreder_product`
--
ALTER TABLE `oreder_product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_additional`
--
ALTER TABLE `product_additional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `SPECIALITYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `delete_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `remove_user_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
