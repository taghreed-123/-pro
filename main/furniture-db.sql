-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 06:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(400) NOT NULL,
  `category_type` int(1) NOT NULL DEFAULT 1,
  `category_notes` text DEFAULT NULL,
  `category_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--



-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `complaint_seller_id` int(11) DEFAULT NULL,
  `complaint_customer_id` int(11) NOT NULL,
  `complaint_order_id` int(11) DEFAULT NULL,
  `complaint_msg` text NOT NULL,
  `complaint_notes` text DEFAULT NULL,
  `complaint_type` int(11) DEFAULT 0,
  `complaint_image` varchar(400) DEFAULT NULL,
  `complaint_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `complaints_orders_sellers_customers_view`
-- (See below for the actual view)
--
CREATE TABLE `complaints_orders_sellers_customers_view` (
`complaint_id` int(11)
,`complaint_seller_id` int(11)
,`complaint_customer_id` int(11)
,`complaint_order_id` int(11)
,`complaint_msg` text
,`complaint_notes` text
,`complaint_type` int(11)
,`complaint_image` varchar(400)
,`complaint_date` date
,`order_id` int(11)
,`order_user_id` int(11)
,`order_store_id` int(11)
,`order_price` decimal(11,2)
,`order_type` varchar(400)
,`order_width` int(11)
,`order_height` int(11)
,`order_status` varchar(400)
,`order_image` varchar(400)
,`order_notes` text
,`order_address` varchar(400)
,`order_charge_address` varchar(400)
,`order_build_number` varchar(200)
,`order_date` date
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
,`custmer_id` int(11)
,`custmer_full_name` varchar(300)
,`custmer_email` varchar(300)
,`custmer_pwd` varchar(400)
,`custmer_phone` varchar(400)
,`custmer_type` varchar(400)
,`custmer_store` varchar(400)
,`custmer_active` int(11)
,`custmer_image` varchar(400)
,`custmer_city` varchar(400)
,`custmer_location` text
,`custmer_category` text
,`custmer_notes` text
,`custmer_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `favorite_seller_id` int(11) NOT NULL,
  `favorite_customer_id` int(11) NOT NULL,
  `favorite_product_id` int(11) NOT NULL,
  `favorite_notes` text DEFAULT NULL,
  `favorite_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `favorites_products_view`
-- (See below for the actual view)
--
CREATE TABLE `favorites_products_view` (
`favorite_id` int(11)
,`favorite_seller_id` int(11)
,`favorite_customer_id` int(11)
,`favorite_product_id` int(11)
,`favorite_notes` text
,`favorite_date` date
,`product_id` int(11)
,`product_user_id` int(11)
,`product_name` varchar(400)
,`product_category` varchar(400)
,`product_desc` text
,`product_image` varchar(500)
,`product_notes` text
,`product_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `feedback_seller_id` int(11) DEFAULT NULL,
  `feedback_customer_id` int(11) NOT NULL,
  `feedback_product_id` int(11) DEFAULT NULL,
  `feedback_order_id` int(11) DEFAULT NULL,
  `feedback_msg` text NOT NULL,
  `feedback_notes` text DEFAULT NULL,
  `feedback_type` int(11) NOT NULL DEFAULT 0,
  `feedback_owner` int(11) NOT NULL,
  `feedback_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `feedbacks_sellers_customers_orders_view`
-- (See below for the actual view)
--
CREATE TABLE `feedbacks_sellers_customers_orders_view` (
`feedback_id` int(11)
,`feedback_seller_id` int(11)
,`feedback_customer_id` int(11)
,`feedback_product_id` int(11)
,`feedback_order_id` int(11)
,`feedback_msg` text
,`feedback_notes` text
,`feedback_type` int(11)
,`feedback_date` date
,`feedback_owner` int(11)
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
,`custmer_id` int(11)
,`custmer_full_name` varchar(300)
,`custmer_email` varchar(300)
,`custmer_pwd` varchar(400)
,`custmer_phone` varchar(400)
,`custmer_type` varchar(400)
,`custmer_store` varchar(400)
,`custmer_active` int(11)
,`custmer_image` varchar(400)
,`custmer_city` varchar(400)
,`custmer_location` text
,`custmer_category` text
,`custmer_notes` text
,`custmer_date` date
,`order_id` int(11)
,`order_user_id` int(11)
,`order_store_id` int(11)
,`order_price` decimal(11,2)
,`order_type` varchar(400)
,`order_width` int(11)
,`order_height` int(11)
,`order_status` varchar(400)
,`order_image` varchar(400)
,`order_notes` text
,`order_address` varchar(400)
,`order_charge_address` varchar(400)
,`order_build_number` varchar(200)
,`order_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `feedbacks_sellers_customers_view`
-- (See below for the actual view)
--
CREATE TABLE `feedbacks_sellers_customers_view` (
`feedback_id` int(11)
,`feedback_seller_id` int(11)
,`feedback_customer_id` int(11)
,`feedback_product_id` int(11)
,`feedback_order_id` int(11)
,`feedback_msg` text
,`feedback_notes` text
,`feedback_type` int(11)
,`feedback_date` date
,`feedback_owner` int(11)
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
,`custmer_id` int(11)
,`custmer_full_name` varchar(300)
,`custmer_email` varchar(300)
,`custmer_pwd` varchar(400)
,`custmer_phone` varchar(400)
,`custmer_type` varchar(400)
,`custmer_store` varchar(400)
,`custmer_active` int(11)
,`custmer_image` varchar(400)
,`custmer_city` varchar(400)
,`custmer_location` text
,`custmer_category` text
,`custmer_notes` text
,`custmer_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `followers_id` int(11) NOT NULL,
  `followers_seller_id` int(11) NOT NULL,
  `followers_customer_id` int(11) NOT NULL,
  `followers_notes` text DEFAULT NULL,
  `followers_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `followers_customer_view`
-- (See below for the actual view)
--
CREATE TABLE `followers_customer_view` (
`followers_id` int(11)
,`followers_seller_id` int(11)
,`followers_customer_id` int(11)
,`followers_notes` text
,`followers_date` date
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `followers_seller_view`
-- (See below for the actual view)
--
CREATE TABLE `followers_seller_view` (
`followers_id` int(11)
,`followers_seller_id` int(11)
,`followers_customer_id` int(11)
,`followers_notes` text
,`followers_date` date
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_user_id` int(11) NOT NULL,
  `order_store_id` int(11) NOT NULL,
  `order_price` decimal(11,2) DEFAULT 0.00,
  `order_type` varchar(400) DEFAULT NULL,
  `order_width` int(11) DEFAULT 0,
  `order_height` int(11) DEFAULT 0,
  `order_status` varchar(400) DEFAULT NULL,
  `order_image` varchar(400) DEFAULT NULL,
  `order_notes` text DEFAULT NULL,
  `order_address` varchar(400) DEFAULT NULL,
  `order_charge_address` varchar(400) DEFAULT NULL,
  `order_build_number` varchar(200) DEFAULT NULL,
  `order_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `orders_seller_view`
-- (See below for the actual view)
--
CREATE TABLE `orders_seller_view` (
`order_id` int(11)
,`order_user_id` int(11)
,`order_store_id` int(11)
,`order_price` decimal(11,2)
,`order_type` varchar(400)
,`order_width` int(11)
,`order_height` int(11)
,`order_status` varchar(400)
,`order_image` varchar(400)
,`order_notes` text
,`order_address` varchar(400)
,`order_charge_address` varchar(400)
,`order_build_number` varchar(200)
,`order_date` date
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_user_id` int(11) NOT NULL,
  `payment_order_id` int(11) NOT NULL,
  `payment_type` varchar(400) DEFAULT 'card',
  `payment_card_type` varchar(400) DEFAULT NULL,
  `payment_card_amount` varchar(400) DEFAULT NULL,
  `payment_card_status` varchar(400) DEFAULT 'valid',
  `payment_card_number` varchar(400) DEFAULT NULL,
  `payment_card_name` varchar(400) DEFAULT NULL,
  `payment_card_expiry` varchar(400) DEFAULT NULL,
  `payment_card_code` varchar(400) NOT NULL,
  `payment_notes` text DEFAULT NULL,
  `payment_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--



-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_user_id` int(11) NOT NULL,
  `product_name` varchar(400) NOT NULL,
  `product_category` varchar(400) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(500) DEFAULT NULL,
  `product_notes` text DEFAULT NULL,
  `product_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `products_feedbacks_customers_view`
-- (See below for the actual view)
--
CREATE TABLE `products_feedbacks_customers_view` (
`product_id` int(11)
,`product_user_id` int(11)
,`product_name` varchar(400)
,`product_category` varchar(400)
,`product_desc` text
,`product_image` varchar(500)
,`product_notes` text
,`product_date` date
,`feedback_id` int(11)
,`feedback_seller_id` int(11)
,`feedback_customer_id` int(11)
,`feedback_product_id` int(11)
,`feedback_order_id` int(11)
,`feedback_msg` text
,`feedback_notes` text
,`feedback_type` int(11)
,`feedback_date` date
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(300) NOT NULL,
  `user_email` varchar(300) NOT NULL,
  `user_pwd` varchar(400) NOT NULL,
  `user_phone` varchar(400) DEFAULT NULL,
  `user_type` varchar(400) DEFAULT 'user',
  `user_store` varchar(400) DEFAULT NULL,
  `user_active` int(11) DEFAULT 0,
  `user_image` varchar(400) DEFAULT NULL,
  `user_city` varchar(400) DEFAULT NULL,
  `user_location` text DEFAULT NULL,
  `user_category` text DEFAULT NULL,
  `user_notes` text DEFAULT NULL,
  `user_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `users_products_view`
-- (See below for the actual view)
--
CREATE TABLE `users_products_view` (
`product_id` int(11)
,`product_user_id` int(11)
,`product_name` varchar(400)
,`product_category` varchar(400)
,`product_desc` text
,`product_image` varchar(500)
,`product_notes` text
,`product_date` date
,`user_id` int(11)
,`user_full_name` varchar(300)
,`user_email` varchar(300)
,`user_pwd` varchar(400)
,`user_phone` varchar(400)
,`user_type` varchar(400)
,`user_store` varchar(400)
,`user_active` int(11)
,`user_image` varchar(400)
,`user_city` varchar(400)
,`user_location` text
,`user_category` text
,`user_notes` text
,`user_date` date
);

-- --------------------------------------------------------

--
-- Structure for view `complaints_orders_sellers_customers_view`
--
DROP TABLE IF EXISTS `complaints_orders_sellers_customers_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `complaints_orders_sellers_customers_view`  AS   (select `c`.`complaint_id` AS `complaint_id`,`c`.`complaint_seller_id` AS `complaint_seller_id`,`c`.`complaint_customer_id` AS `complaint_customer_id`,`c`.`complaint_order_id` AS `complaint_order_id`,`c`.`complaint_msg` AS `complaint_msg`,`c`.`complaint_notes` AS `complaint_notes`,`c`.`complaint_type` AS `complaint_type`,`c`.`complaint_image` AS `complaint_image`,`c`.`complaint_date` AS `complaint_date`,`o`.`order_id` AS `order_id`,`o`.`order_user_id` AS `order_user_id`,`o`.`order_store_id` AS `order_store_id`,`o`.`order_price` AS `order_price`,`o`.`order_type` AS `order_type`,`o`.`order_width` AS `order_width`,`o`.`order_height` AS `order_height`,`o`.`order_status` AS `order_status`,`o`.`order_image` AS `order_image`,`o`.`order_notes` AS `order_notes`,`o`.`order_address` AS `order_address`,`o`.`order_charge_address` AS `order_charge_address`,`o`.`order_build_number` AS `order_build_number`,`o`.`order_date` AS `order_date`,`o`.`user_id` AS `user_id`,`o`.`user_full_name` AS `user_full_name`,`o`.`user_email` AS `user_email`,`o`.`user_pwd` AS `user_pwd`,`o`.`user_phone` AS `user_phone`,`o`.`user_type` AS `user_type`,`o`.`user_store` AS `user_store`,`o`.`user_active` AS `user_active`,`o`.`user_image` AS `user_image`,`o`.`user_city` AS `user_city`,`o`.`user_location` AS `user_location`,`o`.`user_category` AS `user_category`,`o`.`user_notes` AS `user_notes`,`o`.`user_date` AS `user_date`,`customer`.`user_id` AS `custmer_id`,`customer`.`user_full_name` AS `custmer_full_name`,`customer`.`user_email` AS `custmer_email`,`customer`.`user_pwd` AS `custmer_pwd`,`customer`.`user_phone` AS `custmer_phone`,`customer`.`user_type` AS `custmer_type`,`customer`.`user_store` AS `custmer_store`,`customer`.`user_active` AS `custmer_active`,`customer`.`user_image` AS `custmer_image`,`customer`.`user_city` AS `custmer_city`,`customer`.`user_location` AS `custmer_location`,`customer`.`user_category` AS `custmer_category`,`customer`.`user_notes` AS `custmer_notes`,`customer`.`user_date` AS `custmer_date` from ((`complaints` `c` join `orders_seller_view` `o` on(`c`.`complaint_order_id` = `o`.`order_id`)) join `users` `customer` on(`c`.`complaint_customer_id` = `customer`.`user_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `favorites_products_view`
--
DROP TABLE IF EXISTS `favorites_products_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `favorites_products_view`  AS   (select `f`.`favorite_id` AS `favorite_id`,`f`.`favorite_seller_id` AS `favorite_seller_id`,`f`.`favorite_customer_id` AS `favorite_customer_id`,`f`.`favorite_product_id` AS `favorite_product_id`,`f`.`favorite_notes` AS `favorite_notes`,`f`.`favorite_date` AS `favorite_date`,`p`.`product_id` AS `product_id`,`p`.`product_user_id` AS `product_user_id`,`p`.`product_name` AS `product_name`,`p`.`product_category` AS `product_category`,`p`.`product_desc` AS `product_desc`,`p`.`product_image` AS `product_image`,`p`.`product_notes` AS `product_notes`,`p`.`product_date` AS `product_date` from (`favorites` `f` join `products` `p` on(`f`.`favorite_product_id` = `p`.`product_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `feedbacks_sellers_customers_orders_view`
--
DROP TABLE IF EXISTS `feedbacks_sellers_customers_orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `feedbacks_sellers_customers_orders_view`  AS   (select `v`.`feedback_id` AS `feedback_id`,`v`.`feedback_seller_id` AS `feedback_seller_id`,`v`.`feedback_customer_id` AS `feedback_customer_id`,`v`.`feedback_product_id` AS `feedback_product_id`,`v`.`feedback_order_id` AS `feedback_order_id`,`v`.`feedback_msg` AS `feedback_msg`,`v`.`feedback_notes` AS `feedback_notes`,`v`.`feedback_type` AS `feedback_type`,`v`.`feedback_date` AS `feedback_date`,`v`.`feedback_owner` AS `feedback_owner`,`v`.`user_id` AS `user_id`,`v`.`user_full_name` AS `user_full_name`,`v`.`user_email` AS `user_email`,`v`.`user_pwd` AS `user_pwd`,`v`.`user_phone` AS `user_phone`,`v`.`user_type` AS `user_type`,`v`.`user_store` AS `user_store`,`v`.`user_active` AS `user_active`,`v`.`user_image` AS `user_image`,`v`.`user_city` AS `user_city`,`v`.`user_location` AS `user_location`,`v`.`user_category` AS `user_category`,`v`.`user_notes` AS `user_notes`,`v`.`user_date` AS `user_date`,`v`.`custmer_id` AS `custmer_id`,`v`.`custmer_full_name` AS `custmer_full_name`,`v`.`custmer_email` AS `custmer_email`,`v`.`custmer_pwd` AS `custmer_pwd`,`v`.`custmer_phone` AS `custmer_phone`,`v`.`custmer_type` AS `custmer_type`,`v`.`custmer_store` AS `custmer_store`,`v`.`custmer_active` AS `custmer_active`,`v`.`custmer_image` AS `custmer_image`,`v`.`custmer_city` AS `custmer_city`,`v`.`custmer_location` AS `custmer_location`,`v`.`custmer_category` AS `custmer_category`,`v`.`custmer_notes` AS `custmer_notes`,`v`.`custmer_date` AS `custmer_date`,`o`.`order_id` AS `order_id`,`o`.`order_user_id` AS `order_user_id`,`o`.`order_store_id` AS `order_store_id`,`o`.`order_price` AS `order_price`,`o`.`order_type` AS `order_type`,`o`.`order_width` AS `order_width`,`o`.`order_height` AS `order_height`,`o`.`order_status` AS `order_status`,`o`.`order_image` AS `order_image`,`o`.`order_notes` AS `order_notes`,`o`.`order_address` AS `order_address`,`o`.`order_charge_address` AS `order_charge_address`,`o`.`order_build_number` AS `order_build_number`,`o`.`order_date` AS `order_date` from (`feedbacks_sellers_customers_view` `v` join `orders` `o` on(`v`.`feedback_order_id` = `o`.`order_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `feedbacks_sellers_customers_view`
--
DROP TABLE IF EXISTS `feedbacks_sellers_customers_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `feedbacks_sellers_customers_view`  AS   (select `f`.`feedback_id` AS `feedback_id`,`f`.`feedback_seller_id` AS `feedback_seller_id`,`f`.`feedback_customer_id` AS `feedback_customer_id`,`f`.`feedback_product_id` AS `feedback_product_id`,`f`.`feedback_order_id` AS `feedback_order_id`,`f`.`feedback_msg` AS `feedback_msg`,`f`.`feedback_notes` AS `feedback_notes`,`f`.`feedback_type` AS `feedback_type`,`f`.`feedback_date` AS `feedback_date`,`f`.`feedback_owner` AS `feedback_owner`,`seller`.`user_id` AS `user_id`,`seller`.`user_full_name` AS `user_full_name`,`seller`.`user_email` AS `user_email`,`seller`.`user_pwd` AS `user_pwd`,`seller`.`user_phone` AS `user_phone`,`seller`.`user_type` AS `user_type`,`seller`.`user_store` AS `user_store`,`seller`.`user_active` AS `user_active`,`seller`.`user_image` AS `user_image`,`seller`.`user_city` AS `user_city`,`seller`.`user_location` AS `user_location`,`seller`.`user_category` AS `user_category`,`seller`.`user_notes` AS `user_notes`,`seller`.`user_date` AS `user_date`,`customer`.`user_id` AS `custmer_id`,`customer`.`user_full_name` AS `custmer_full_name`,`customer`.`user_email` AS `custmer_email`,`customer`.`user_pwd` AS `custmer_pwd`,`customer`.`user_phone` AS `custmer_phone`,`customer`.`user_type` AS `custmer_type`,`customer`.`user_store` AS `custmer_store`,`customer`.`user_active` AS `custmer_active`,`customer`.`user_image` AS `custmer_image`,`customer`.`user_city` AS `custmer_city`,`customer`.`user_location` AS `custmer_location`,`customer`.`user_category` AS `custmer_category`,`customer`.`user_notes` AS `custmer_notes`,`customer`.`user_date` AS `custmer_date` from ((`feedbacks` `f` join `users` `seller` on(`f`.`feedback_seller_id` = `seller`.`user_id`)) join `users` `customer` on(`f`.`feedback_customer_id` = `customer`.`user_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `followers_customer_view`
--
DROP TABLE IF EXISTS `followers_customer_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `followers_customer_view`  AS   (select `f`.`followers_id` AS `followers_id`,`f`.`followers_seller_id` AS `followers_seller_id`,`f`.`followers_customer_id` AS `followers_customer_id`,`f`.`followers_notes` AS `followers_notes`,`f`.`followers_date` AS `followers_date`,`u`.`user_id` AS `user_id`,`u`.`user_full_name` AS `user_full_name`,`u`.`user_email` AS `user_email`,`u`.`user_pwd` AS `user_pwd`,`u`.`user_phone` AS `user_phone`,`u`.`user_type` AS `user_type`,`u`.`user_store` AS `user_store`,`u`.`user_active` AS `user_active`,`u`.`user_image` AS `user_image`,`u`.`user_city` AS `user_city`,`u`.`user_location` AS `user_location`,`u`.`user_category` AS `user_category`,`u`.`user_notes` AS `user_notes`,`u`.`user_date` AS `user_date` from (`followers` `f` join `users` `u` on(`f`.`followers_customer_id` = `u`.`user_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `followers_seller_view`
--
DROP TABLE IF EXISTS `followers_seller_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `followers_seller_view`  AS   (select `f`.`followers_id` AS `followers_id`,`f`.`followers_seller_id` AS `followers_seller_id`,`f`.`followers_customer_id` AS `followers_customer_id`,`f`.`followers_notes` AS `followers_notes`,`f`.`followers_date` AS `followers_date`,`u`.`user_id` AS `user_id`,`u`.`user_full_name` AS `user_full_name`,`u`.`user_email` AS `user_email`,`u`.`user_pwd` AS `user_pwd`,`u`.`user_phone` AS `user_phone`,`u`.`user_type` AS `user_type`,`u`.`user_store` AS `user_store`,`u`.`user_active` AS `user_active`,`u`.`user_image` AS `user_image`,`u`.`user_city` AS `user_city`,`u`.`user_location` AS `user_location`,`u`.`user_category` AS `user_category`,`u`.`user_notes` AS `user_notes`,`u`.`user_date` AS `user_date` from (`followers` `f` join `users` `u` on(`f`.`followers_seller_id` = `u`.`user_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `orders_seller_view`
--
DROP TABLE IF EXISTS `orders_seller_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders_seller_view`  AS   (select `o`.`order_id` AS `order_id`,`o`.`order_user_id` AS `order_user_id`,`o`.`order_store_id` AS `order_store_id`,`o`.`order_price` AS `order_price`,`o`.`order_type` AS `order_type`,`o`.`order_width` AS `order_width`,`o`.`order_height` AS `order_height`,`o`.`order_status` AS `order_status`,`o`.`order_image` AS `order_image`,`o`.`order_notes` AS `order_notes`,`o`.`order_address` AS `order_address`,`o`.`order_charge_address` AS `order_charge_address`,`o`.`order_build_number` AS `order_build_number`,`o`.`order_date` AS `order_date`,`up`.`user_id` AS `user_id`,`up`.`user_full_name` AS `user_full_name`,`up`.`user_email` AS `user_email`,`up`.`user_pwd` AS `user_pwd`,`up`.`user_phone` AS `user_phone`,`up`.`user_type` AS `user_type`,`up`.`user_store` AS `user_store`,`up`.`user_active` AS `user_active`,`up`.`user_image` AS `user_image`,`up`.`user_city` AS `user_city`,`up`.`user_location` AS `user_location`,`up`.`user_category` AS `user_category`,`up`.`user_notes` AS `user_notes`,`up`.`user_date` AS `user_date` from (`orders` `o` join `users` `up` on(`o`.`order_store_id` = `up`.`user_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `products_feedbacks_customers_view`
--
DROP TABLE IF EXISTS `products_feedbacks_customers_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_feedbacks_customers_view`  AS   (select `p`.`product_id` AS `product_id`,`p`.`product_user_id` AS `product_user_id`,`p`.`product_name` AS `product_name`,`p`.`product_category` AS `product_category`,`p`.`product_desc` AS `product_desc`,`p`.`product_image` AS `product_image`,`p`.`product_notes` AS `product_notes`,`p`.`product_date` AS `product_date`,`f`.`feedback_id` AS `feedback_id`,`f`.`feedback_seller_id` AS `feedback_seller_id`,`f`.`feedback_customer_id` AS `feedback_customer_id`,`f`.`feedback_product_id` AS `feedback_product_id`,`f`.`feedback_order_id` AS `feedback_order_id`,`f`.`feedback_msg` AS `feedback_msg`,`f`.`feedback_notes` AS `feedback_notes`,`f`.`feedback_type` AS `feedback_type`,`f`.`feedback_date` AS `feedback_date`,`u`.`user_id` AS `user_id`,`u`.`user_full_name` AS `user_full_name`,`u`.`user_email` AS `user_email`,`u`.`user_pwd` AS `user_pwd`,`u`.`user_phone` AS `user_phone`,`u`.`user_type` AS `user_type`,`u`.`user_store` AS `user_store`,`u`.`user_active` AS `user_active`,`u`.`user_image` AS `user_image`,`u`.`user_city` AS `user_city`,`u`.`user_location` AS `user_location`,`u`.`user_category` AS `user_category`,`u`.`user_notes` AS `user_notes`,`u`.`user_date` AS `user_date` from ((`products` `p` join `feedbacks` `f` on(`f`.`feedback_product_id` = `p`.`product_id`)) join `users` `u` on(`f`.`feedback_customer_id` = `u`.`user_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `users_products_view`
--
DROP TABLE IF EXISTS `users_products_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_products_view`  AS   (select `products`.`product_id` AS `product_id`,`products`.`product_user_id` AS `product_user_id`,`products`.`product_name` AS `product_name`,`products`.`product_category` AS `product_category`,`products`.`product_desc` AS `product_desc`,`products`.`product_image` AS `product_image`,`products`.`product_notes` AS `product_notes`,`products`.`product_date` AS `product_date`,`users`.`user_id` AS `user_id`,`users`.`user_full_name` AS `user_full_name`,`users`.`user_email` AS `user_email`,`users`.`user_pwd` AS `user_pwd`,`users`.`user_phone` AS `user_phone`,`users`.`user_type` AS `user_type`,`users`.`user_store` AS `user_store`,`users`.`user_active` AS `user_active`,`users`.`user_image` AS `user_image`,`users`.`user_city` AS `user_city`,`users`.`user_location` AS `user_location`,`users`.`user_category` AS `user_category`,`users`.`user_notes` AS `user_notes`,`users`.`user_date` AS `user_date` from (`products` join `users` on(`products`.`product_user_id` = `users`.`user_id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `complaint_seller_id` (`complaint_seller_id`),
  ADD KEY `complaint_customer_id` (`complaint_customer_id`),
  ADD KEY `complaint_order_id` (`complaint_order_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `favorite_seller_id` (`favorite_seller_id`),
  ADD KEY `favorite_customer_id` (`favorite_customer_id`),
  ADD KEY `favorite_product_id` (`favorite_product_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_seller_id` (`feedback_seller_id`),
  ADD KEY `feedback_customer_id` (`feedback_customer_id`),
  ADD KEY `feedback_product_id` (`feedback_product_id`),
  ADD KEY `feedback_order_id` (`feedback_order_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`followers_id`),
  ADD KEY `followers_seller_id` (`followers_seller_id`),
  ADD KEY `followers_customer_id` (`followers_customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user_id` (`order_user_id`),
  ADD KEY `order_store_id` (`order_store_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_user_id` (`payment_user_id`),
  ADD KEY `payment_order_id` (`payment_order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_user_id` (`product_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `followers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`complaint_seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`complaint_customer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `complaints_ibfk_3` FOREIGN KEY (`complaint_order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`favorite_seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`favorite_customer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`favorite_product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`feedback_seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`feedback_customer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `feedbacks_ibfk_3` FOREIGN KEY (`feedback_product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `feedbacks_ibfk_4` FOREIGN KEY (`feedback_order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`followers_seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followers_customer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_store_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`payment_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`payment_order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
