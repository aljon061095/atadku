-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 04:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atadku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_commission`
--

CREATE TABLE `admin_commission` (
  `id` int(11) NOT NULL,
  `admin_commission` int(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_commission`
--

INSERT INTO `admin_commission` (`id`, `admin_commission`, `date_added`) VALUES
(1, 400, '2023-01-07 10:05:39'),
(2, 500, '2023-01-07 10:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `full_name`, `address`, `email_address`, `username`, `password`, `date_created`) VALUES
(1, 'Admin Admin', 'Admin Address', 'admin@admin.com', 'admin', '$2y$10$5C0.wZ3fnmIligx.WQXQx.eyTQcepG6g2vhn2UQEf02qbTE7UDIPC', '2022-10-29 07:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `commission` int(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `driver_id`, `commission`, `date_added`) VALUES
(1, 2, 49, '2022-10-25 14:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `number` int(30) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `profile`, `full_name`, `address`, `number`, `email_address`, `username`, `password`, `id_type`, `valid_id`, `user_type`, `status`, `is_deleted`, `date_created`) VALUES
(1, 'customer_profile_1666404720_profile.png', 'Aljon Quiambao', '0199 Kundol Street', 2147483647, 'aljonq@gmail.com', 'aljonq', '$2y$10$5C0.wZ3fnmIligx.WQXQx.eyTQcepG6g2vhn2UQEf02qbTE7UDIPC', '', '', 'customer', 1, 0, '2022-10-22 10:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charge`
--

CREATE TABLE `delivery_charge` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `delivery_charge` int(255) DEFAULT NULL,
  `admin_commission` int(255) DEFAULT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_info`
--

CREATE TABLE `delivery_info` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_info`
--

INSERT INTO `delivery_info` (`id`, `restaurant_id`, `order_id`, `customer_id`, `item_id`, `name`, `price`, `quantity`, `payment_method`, `account_name`, `account_number`, `order_date`) VALUES
(1, 0, 0, 1, 0, '', 0, 0, 'online_payment', 'Aljon Quiambao', '2147483647', '2022-10-25 09:51:25'),
(2, 0, 0, 1, 0, '', 0, 0, 'online_payment', 'Aljon Quiambao', '2147483647', '2022-10-25 11:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `number` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `valid_id` varchar(1000) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `profile`, `full_name`, `address`, `email_address`, `number`, `username`, `password`, `id_type`, `valid_id`, `status`, `is_deleted`, `date_created`) VALUES
(1, '1666449480_John Doe', 'John Doe', '1234  Lourdes Sur East, Angeles City', 'john_doe@gmail.com', 2147483647, 'john_doe', 'john_doe', '', '1666449480_7.jpg', 1, 0, '2022-10-22 22:38:11'),
(2, 'driver_profile_1666452120_profile.png', 'Lebron James', '0199 Kundol Street', 'lebron_james@gmail.com', 2147483647, 'lebron_james', '$2y$10$N4xHsZxiHSBWp69tsLd3lOiXximvQ.7/AbTDKRDd2u7sQOVwMXTZy', '9', 'valid_id_1666452120_pic1.jpg', 1, 0, '2022-10-22 23:22:40'),
(3, 'driver_profile_1666501320_profile.png', 'John Doe', '0199 Kundol Street', 'john_doe@gmail.com', 2147483647, 'john_doe', '$2y$10$.TMkSJM9qnNB.MRZlDZY5eDO0vgkoTPF/J9Hah3kYHcoNO5yQUxHS', '9', 'valid_id_1666501320_pic1.jpg', 1, 0, '2022-10-23 13:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT current_timestamp(),
  `submitted_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food_list`
--

CREATE TABLE `food_list` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `images` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_list`
--

INSERT INTO `food_list` (`id`, `restaurant_id`, `food_name`, `price`, `images`, `description`, `status`, `is_deleted`, `date_added`) VALUES
(1, 1, 'Rib Eye Steak', 1000, 'food_1666329060_food_1665547920_1.png', 'A steak is a thick cut of meat generally sliced across the muscle fibers, sometimes including a bone.', 1, 0, '2022-10-21 13:11:20'),
(2, 1, 'Hungarain Sausage', 280, 'food_1665547980_2.png', 'It is made from pork, szalonna (Hungarian bacon fat), garlic, pepper, caraway, and a Hungarian red paprika.', 1, 0, '2022-10-21 13:12:46'),
(3, 1, 'Chicken Barbeque', 360, 'food_1666329180_food_1665548100_3.png', 'The best BBQ chicken breasts are cooked on the grill or in the oven and sweetened with BBQ sauce for moist and juicy barbecue chicken breasts every time.', 1, 0, '2022-10-21 13:13:41'),
(4, 1, 'Baby Back Ribs', 800, 'food_1666329360_food_1665548220_4.png', 'Baby back ribs are taken from around loin, the muscle that runs along the pigs back on either side of the spine.', 1, 0, '2022-10-21 13:16:09'),
(5, 1, 'Baby Back Ribs with Fries and Salad', 700, 'food_1666329360_food_1665548280_5.png', 'Half rack of baby back ribs with fries and rice and vegetable on the side.', 1, 0, '2022-10-21 13:16:55'),
(6, 2, 'Cappuccino', 120, 'food_1666329420_food_1665373020_1.png', 'A cappuccino is the perfect balance of espresso, steamed milk and foam.', 1, 0, '2022-10-21 13:17:51'),
(7, 2, 'Coffee Arabica', 170, 'food_1666329480_food_1665378840_2.png', 'Arabica tends to have a smoother, sweeter taste, with flavour notes of chocolate and sugar. ', 1, 0, '2022-10-21 13:18:32'),
(8, 2, 'Chocolate Coffee', 150, 'food_1666329540_food_1665379080_3.png', 'A mocha, also known as a cafe mocha or caffè mocha, is a coffee drink made with chocolate, espresso, and milk.', 1, 0, '2022-10-21 13:19:06'),
(9, 2, 'ice', 180, 'food_1666329540_food_1665379320_4.png', 'A rich flavor that with a slight caramel flavor or a fully caramel flavor with a little coffee.', 1, 0, '2022-10-21 13:19:53'),
(10, 3, 'Tapsilog', 160, 'food_1666329660_food_1665556500_9.png', 'Consists of beef tapa, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:21:25'),
(11, 3, 'Tocinolog', 140, 'food_1666329660_food_1665556680_10.png', 'Consists of pork tocino, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:21:48'),
(12, 3, 'Bangusilog', 120, 'food_1666329720_food_1665556740_11.png', 'Consists of half bangus fish, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:22:23'),
(13, 3, 'Chorizolog', 140, 'food_1666329720_food_1665556800_12.png', 'Consists of pork chorizo, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:22:47'),
(14, 4, 'Baby Tako Takoyaki', 40, 'food_1666329840_food_1665564060_13.png', 'Consist of octopus bites with secret sauce. 40/pc', 1, 0, '2022-10-21 13:24:38'),
(15, 4, 'Original Takoyaki', 30, 'food_1666329900_food_1665564240_15.png', 'Original taste of secret sauce. 30/pc', 1, 0, '2022-10-21 13:25:30'),
(16, 5, 'Shoyu Ramen', 210, 'food_1666329960_food_1665711780_17.png', 'Shoyu ramen is a ramen dish with a broth made of soy sauce. ', 1, 0, '2022-10-21 13:26:51'),
(17, 5, 'Tantan Ramen', 240, 'food_1666330020_food_1665712200_18.png', 'Tan Tan ramen is a Japanese dish with a spicy, creamy noodle broth that is made from peanut powder, sesame paste and chilli oil.', 1, 0, '2022-10-21 13:27:29'),
(18, 5, 'Tonkotsu Ramen', 230, 'food_1665712260_19.png', 'Tonkotsu ramen is a Japanese noodle soup made with a pork bone broth—ton means pork and kotsu means bone.', 1, 0, '2022-10-21 13:28:06'),
(19, 6, 'Super Supreme', 389, 'food_1666330320_food_1665712620_20.png', 'Richly decked with nine delicious toppings - beef, ham, italian, sausage, pepperoni, seasoned pork, bell\r\npeppers, mushrooms, onions, and pineapples.', 1, 0, '2022-10-21 13:32:00'),
(20, 6, 'Bacon & Mushroom', 359, 'food_1666330380_food_1665712740_21.png', 'Two layers of toasted bacon with bell peppers, mushrooms and onions on signature Pizza sauce.', 1, 0, '2022-10-21 13:33:03'),
(21, 6, 'Veggies Lovers', 329, 'food_1666330380_food_1665712980_24.png', 'Crunchy bell peppers, mushrooms, chunky onions, and juicy pineapples on a double layers of mozzarella cheese.', 1, 0, '2022-10-21 13:33:59'),
(22, 6, 'Pepperoni Lovers', 329, 'food_1666330440_food_1665712920_23.png', 'A true classic- pepperoni and mozzarella\r\ncheese on our signature pizza sauce.', 1, 0, '2022-10-21 13:34:32'),
(23, 7, 'Grilled Chesee Burger', 229, 'food_1666330620_food_1665713400_29.png', 'Crispy crust on the outside with patty and bacon jam and cheese on the inside!', 1, 0, '2022-10-21 13:37:36'),
(24, 7, 'Cheesy Bacon Jalapeno', 229, 'food_1666330740_food_1665713580_27.png', 'Get some heat with with the new flavor of burger that will truly satisfy your chessy-bacon carvibg with a twist.', 1, 0, '2022-10-21 13:39:11'),
(25, 7, 'Bacon & Mushroom Burger', 229, 'food_1666330800_food_1665713700_26.png', 'Bacon and mushroom with cheddar cheese.', 1, 0, '2022-10-21 13:40:01'),
(26, 8, 'Okinawa Milktea', 90, 'food_1666330860_30.png', 'Okinawa milk tea is a type of milk tea that draws influence from the Okinawa region of Japan.', 1, 0, '2022-10-21 13:41:31'),
(27, 8, 'Green Matcha Milktea', 120, 'food_1666330920_31.png', 'Naturally sweet, vegetal grassy flavor with a smooth and creamy finish.', 1, 0, '2022-10-21 13:42:22'),
(28, 9, 'Original Glazed', 40, 'food_1666331040_33.png', 'Donut dipped in light honey glaze.', 1, 0, '2022-10-21 13:44:26'),
(29, 9, 'Heaven Berry', 45, 'food_1666331040_34.png', 'Donut filled with strawberry cream filling, dipped in strawberry milk chocolate, and garnished with white chocolate.', 1, 0, '2022-10-21 13:44:51'),
(30, 2, 'sasasa', 120, 'food_1671281880_main_logo.png', 'adadadadada', 1, 0, '2022-12-17 20:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `file_name` varchar(1000) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `item_id`, `file_name`, `date_created`) VALUES
(1, 1, 'logo_1666326360_logo_1665297840_1.png', '2022-10-21 12:26:01'),
(2, 2, 'logo_1666326420_logo_1665298440_2.png', '2022-10-21 12:27:50'),
(3, 3, 'logo_1666326600_logo_1665298860_3.png', '2022-10-21 12:30:36'),
(4, 4, 'logo_1666326720_logo_1665299580_7.png', '2022-10-21 12:32:17'),
(5, 5, 'logo_1666326780_logo_1665299820_8.png', '2022-10-21 12:33:22'),
(6, 6, 'logo_1666326840_logo_1665300000_9.png', '2022-10-21 12:34:12'),
(7, 7, '1666326900_The Best Burger', '2022-10-21 12:35:15'),
(8, 8, 'logo_1666326960_logo_1665300360_11.png', '2022-10-21 12:36:16'),
(9, 9, 'logo_1666327020_logo_1665300480_12.png', '2022-10-21 12:37:09'),
(10, 1, 'logo_1666327080_logo_1665981480_1.png', '2022-10-21 12:38:02'),
(11, 10, 'logo_1666327080_valid_id_1665982380_2.png', '2022-10-21 12:38:50'),
(12, 2, 'logo_1666327200_logo_1665982380_2.png', '2022-10-21 12:40:34'),
(13, 3, 'logo_1666327320_3.png', '2022-10-21 12:42:18'),
(14, 4, 'logo_1666327380_4.png', '2022-10-21 12:43:35'),
(15, 5, 'logo_1666327440_5.png', '2022-10-21 12:44:47'),
(16, 6, 'logo_1666327560_6.png', '2022-10-21 12:46:19'),
(17, 1, 'food_1666329060_food_1665547920_1.png', '2022-10-21 13:11:20'),
(18, 2, 'food_1666329120_food_1665548100_3.png', '2022-10-21 13:12:46'),
(19, 3, 'food_1666329180_food_1665548100_3.png', '2022-10-21 13:13:41'),
(20, 4, 'food_1666329360_food_1665548220_4.png', '2022-10-21 13:16:09'),
(21, 5, 'food_1666329360_food_1665548280_5.png', '2022-10-21 13:16:55'),
(22, 6, 'food_1666329420_food_1665373020_1.png', '2022-10-21 13:17:51'),
(23, 7, 'food_1666329480_food_1665378840_2.png', '2022-10-21 13:18:32'),
(24, 8, 'food_1666329540_food_1665379080_3.png', '2022-10-21 13:19:06'),
(25, 9, 'food_1666329540_food_1665379320_4.png', '2022-10-21 13:19:53'),
(26, 10, 'food_1666329660_food_1665556500_9.png', '2022-10-21 13:21:25'),
(27, 11, 'food_1666329660_food_1665556680_10.png', '2022-10-21 13:21:48'),
(28, 12, 'food_1666329720_food_1665556740_11.png', '2022-10-21 13:22:23'),
(29, 13, 'food_1666329720_food_1665556800_12.png', '2022-10-21 13:22:47'),
(30, 14, 'food_1666329840_food_1665564060_13.png', '2022-10-21 13:24:38'),
(31, 15, 'food_1666329900_food_1665564240_15.png', '2022-10-21 13:25:30'),
(32, 16, 'food_1666329960_food_1665711780_17.png', '2022-10-21 13:26:51'),
(33, 17, 'food_1666330020_food_1665712200_18.png', '2022-10-21 13:27:29'),
(34, 18, '1666330080_Tonkotsu Ramen', '2022-10-21 13:28:06'),
(35, 19, 'food_1666330320_food_1665712620_20.png', '2022-10-21 13:32:00'),
(36, 20, 'food_1666330380_food_1665712740_21.png', '2022-10-21 13:33:03'),
(37, 21, 'food_1666330380_food_1665712980_24.png', '2022-10-21 13:33:59'),
(38, 22, 'food_1666330440_food_1665712920_23.png', '2022-10-21 13:34:32'),
(39, 23, 'food_1666330620_food_1665713400_29.png', '2022-10-21 13:37:36'),
(40, 24, 'food_1666330740_food_1665713580_27.png', '2022-10-21 13:39:11'),
(41, 25, 'food_1666330800_food_1665713700_26.png', '2022-10-21 13:40:01'),
(42, 26, 'food_1666330860_30.png', '2022-10-21 13:41:31'),
(43, 27, 'food_1666330920_31.png', '2022-10-21 13:42:22'),
(44, 28, 'food_1666331040_33.png', '2022-10-21 13:44:26'),
(45, 29, 'food_1666331040_34.png', '2022-10-21 13:44:51'),
(46, 1, 'item_1666331400_38.png', '2022-10-21 13:50:33'),
(47, 2, 'item_1666331520_39.png', '2022-10-21 13:52:25'),
(48, 3, 'item_1666331880_43.png', '2022-10-21 13:58:14'),
(49, 1, 'customer_profile_1666404720_profile.png', '2022-10-22 10:12:00'),
(50, 1, '1666449480_John Doe', '2022-10-22 22:38:11'),
(51, 2, 'driver_profile_1666452120_profile.png', '2022-10-22 23:22:40'),
(52, 3, 'driver_profile_1666501320_profile.png', '2022-10-23 13:02:43'),
(53, 30, 'food_1671281880_main_logo.png', '2022-12-17 20:58:18'),
(54, 4, 'item_1671329400_qr_code.png', '2022-12-18 10:10:19'),
(55, 4, '1671695700_', '2022-12-22 15:55:58'),
(56, 5, '1671695760_', '2022-12-22 15:56:07'),
(57, 6, '1671695820_', '2022-12-22 15:57:48'),
(58, 9, '1675689300_SASASASA', '2023-02-06 21:15:03'),
(59, 17, 'profile_1676523060_323584578_480320030955319_8610256235098291637_n.jpg', '2023-02-16 12:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `images` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `store_id`, `item_name`, `price`, `images`, `description`, `status`, `is_deleted`, `date_added`) VALUES
(1, 1, 'Black Polo Shirt', 250, 'item_1666331400_38.png', 'A black top with short sleeves, a placket neckline, and two or three buttons.', 1, 0, '2023-02-07 13:50:33'),
(2, 1, 'Gray Tshirt', 150, 'item_1666331520_39.png', 'A lightweight, usually knitted, pullover shirt, close-fitting and with a round neckline and short sleeves, worn as an undershirt or outer garment.', 1, 0, '2022-10-21 13:52:25'),
(3, 2, 'Dictionary', 400, 'item_1666331880_43.png', 'A reference book that lists words in order—usually, for Western languages, alphabetical—and gives their meanings.', 1, 0, '2022-10-21 13:58:14'),
(4, 3, 'Iphone ', 12000, 'item_1671329400_qr_code.png', 'Test', 1, 0, '2022-12-18 10:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `convo_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unread , 1= read',
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `convo_id`, `user_id`, `message`, `status`, `date_created`) VALUES
(1, 1, 1, 'test', 1, '2021-09-07 15:23:12'),
(2, 2, 1, 'tesrt eeee', 1, '2021-09-22 16:19:24'),
(3, 1, 1, 'hi bidder2', 1, '2021-09-07 15:23:12'),
(4, 1, 1, 'test', 1, '2021-09-07 15:23:12'),
(5, 1, 1, '123', 1, '2021-09-07 15:23:12'),
(6, 1, 2, 'hello bidder_user?', 1, '2021-09-07 15:24:12'),
(7, 1, 1, 'hello', 1, '2021-09-29 16:00:37'),
(8, 2, 3, 'Hello', 1, '2021-09-30 07:13:47'),
(9, 3, 4, 'Hello Bidder2', 1, '2021-09-29 16:00:41'),
(10, 3, 4, 'Hi Bidder 2', 1, '2021-09-29 16:02:45'),
(11, 3, 4, 'Test', 1, '2021-09-29 16:03:12'),
(12, 3, 2, 'Hi Auctioneer', 1, '2021-09-29 16:03:32'),
(13, 3, 4, 'Hello', 1, '2021-09-29 16:04:04'),
(14, 4, 2, 'Hell Admin. How are you?', 1, '2021-09-29 16:05:38'),
(15, 4, 3, 'Hi', 1, '2021-09-29 16:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url_id` int(11) DEFAULT NULL,
  `notification` text NOT NULL,
  `is_for_admin` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `url_id`, `notification`, `is_for_admin`, `status`, `data_posted`) VALUES
(1, 0, 2, 'Your order is now accepted by the rider. Your delivery rider is  Lebron James. Thank you!', 1, 1, '2022-10-31 08:54:18'),
(2, 2, 0, 'Lebron James accepted 1 for delivery.', 2, 1, '2022-10-31 08:54:18'),
(3, 1, 1, 'There was an item for pickup from Aljon Quiambao that needs your approval.', 1, 1, '2022-12-18 10:15:41'),
(4, 1, 1, 'You have pending orders from . See order details. Thank you!', 1, 1, '2022-12-19 11:16:06'),
(5, 1, 1, 'Your order is now on queue. The delivery rider will contact you soon. Thank you!', 1, 1, '2022-12-19 11:16:06'),
(6, 17, 2, 'You have pending orders from . See order details. Thank you!', 1, 1, '2023-02-16 12:58:39'),
(7, 2, 17, 'Your order is now on queue. The delivery rider will contact you soon. Thank you!', 1, 1, '2023-02-16 12:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `order_id` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `charge` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` int(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `restaurant_id`, `store_id`, `order_id`, `item_id`, `driver_id`, `name`, `price`, `quantity`, `total`, `charge`, `order_date`, `payment_method`, `account_name`, `account_number`, `status`, `is_deleted`) VALUES
(1, 1, 1, 0, '941854295554846606', 1, 2, 'Rib Eye Steak', 1000, 2, '2000', 49, '2022-10-25 11:04:19', 'online_payment', 'Aljon Quiambao', 2147483647, 2, 0),
(2, 1, 2, 0, '805465911617880235', 7, 0, 'Coffee Arabica', 170, 2, '0', 0, '2022-12-17 18:48:00', 'online_payment', 'Aljon Quiambao', 2147483647, 1, 0),
(3, 1, 1, 0, '819666303831458609', 1, 0, 'Rib Eye Steak', 1000, 1, '', 0, '2022-12-19 11:16:06', 'online_payment', 'Aljon Quiambao', 2147483647, 1, 0),
(4, 17, 2, 0, '222586810904446162', 1, 0, 'Rib Eye Steak', 1000, 1, '', 0, '2023-02-16 12:58:39', '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_id`, `description`, `date_updated`) VALUES
(1, 1, 'Your order is now on queue. The delivery rider will contact you soon. Thank you!', '2022-10-25 11:41:35'),
(2, 1, 'Your order is now approved. Your delivery rider is  Lebron James. Thank you!', '2022-10-25 13:36:47'),
(3, 0, 'Your order is now delivered. Thank you for choosing our delivery system!', '2022-10-25 14:17:57'),
(4, 1, 'Your order is now delivered. Thank you for choosing our delivery system!', '2022-10-25 14:18:28'),
(5, 0, 'Your order is now delivered. Thank you for choosing our delivery system!', '2022-10-25 14:44:08'),
(6, 1, 'Your order is now delivered. Thank you for choosing our delivery system! \r\n        On the bottom right of the page, find the feedback icon then kindly give us feedback.', '2022-10-25 14:55:52'),
(7, 0, 'Your order is now delivered. Thank you for choosing our delivery system! \r\n        On the bottom right of the page, find the feedback icon then kindly give us feedback.', '2022-10-25 14:56:29'),
(8, 2, 'Your order is now on queue. The delivery rider will contact you soon. Thank you!', '2022-12-19 11:16:06'),
(9, 2147483647, 'Your order is now on queue. The delivery rider will contact you soon. Thank you!', '2023-02-16 12:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

CREATE TABLE `pickup` (
  `id` int(11) NOT NULL,
  `pickup_code` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_number` int(255) NOT NULL,
  `sender_address` varchar(1000) NOT NULL,
  `item_details` varchar(1000) NOT NULL,
  `notes` text NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_number` int(255) NOT NULL,
  `recipient_address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `driver_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pickup`
--

INSERT INTO `pickup` (`id`, `pickup_code`, `sender_name`, `sender_number`, `sender_address`, `item_details`, `notes`, `recipient_name`, `recipient_number`, `recipient_address`, `message`, `driver_id`, `status`, `is_deleted`, `date_added`) VALUES
(1, '99cd6ed4', 'Aljon Quiambao', 1234567890, '0199 Kundol Street', 'document', 'Notes', 'Grant Quiambao', 1234567890, 'Ferrari Street', 'test greetings', 2, 2, 0, '2022-10-23 16:05:49'),
(2, '48ea2b7f', 'Aljon Quiambao', 2147483647, '0199 Kundol Street', 'document', 'Test Driver Notes', 'Test Recipient', 1234567, 'Dau', 'Test Greetings', 0, 1, 0, '2022-12-18 10:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_status`
--

CREATE TABLE `pickup_status` (
  `id` int(11) NOT NULL,
  `pickup_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pickup_status`
--

INSERT INTO `pickup_status` (`id`, `pickup_id`, `description`, `date_updated`) VALUES
(1, 1, 'The item for pickup is now on queue. Just wait for the administrator approval.', '2022-10-23 16:05:49'),
(2, 0, 'The item for pickup is now approved. Your delivery rider is  Lebron James. \n            The rider will contact you soon. Thank you!', '2022-10-23 16:21:39'),
(3, 1, 'The item for pickup is now approved. Your delivery rider is  Lebron James. \n            The rider will contact you soon. Thank you!', '2022-10-23 16:23:22'),
(4, 2, 'The item for pickup is now on queue. Just wait for the administrator approval.', '2022-12-18 10:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `posts` text NOT NULL,
  `number_like` int(255) NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `images` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `store_id`, `product_name`, `price`, `images`, `description`, `status`, `is_deleted`, `date_added`) VALUES
(1, 2, 'Rib Eye Steak', 1000, 'food_1666329060_food_1665547920_1.png', 'A steak is a thick cut of meat generally sliced across the muscle fibers, sometimes including a bone.', 1, 0, '2022-10-21 13:11:20'),
(2, 2, 'Hungarain Sausage', 280, 'food_1665547980_2.png', 'It is made from pork, szalonna (Hungarian bacon fat), garlic, pepper, caraway, and a Hungarian red paprika.', 1, 0, '2022-10-21 13:12:46'),
(3, 2, 'Chicken Barbeque', 360, 'food_1666329180_food_1665548100_3.png', 'The best BBQ chicken breasts are cooked on the grill or in the oven and sweetened with BBQ sauce for moist and juicy barbecue chicken breasts every time.', 1, 0, '2022-10-21 13:13:41'),
(4, 2, 'Baby Back Ribs', 800, 'food_1666329360_food_1665548220_4.png', 'Baby back ribs are taken from around loin, the muscle that runs along the pigs back on either side of the spine.', 1, 0, '2022-10-21 13:16:09'),
(5, 2, 'Baby Back Ribs with Fries and Salad', 700, 'food_1666329360_food_1665548280_5.png', 'Half rack of baby back ribs with fries and rice and vegetable on the side.', 1, 0, '2022-10-21 13:16:55'),
(6, 3, 'Cappuccino', 160, 'food_1666329420_food_1665373020_1.png', 'A cappuccino is the perfect balance of espresso, steamed milk and foam.', 0, 0, '2022-10-21 13:17:51'),
(7, 3, 'Coffee Arabica', 170, 'food_1666329480_food_1665378840_2.png', 'Arabica tends to have a smoother, sweeter taste, with flavour notes of chocolate and sugar. ', 1, 0, '2022-10-21 13:18:32'),
(8, 3, 'Chocolate Coffee', 150, 'food_1666329540_food_1665379080_3.png', 'A mocha, also known as a cafe mocha or caffè mocha, is a coffee drink made with chocolate, espresso, and milk.', 1, 0, '2022-10-21 13:19:06'),
(9, 3, 'ice', 180, 'food_1666329540_food_1665379320_4.png', 'A rich flavor that with a slight caramel flavor or a fully caramel flavor with a little coffee.', 1, 0, '2022-10-21 13:19:53'),
(10, 4, 'Tapsilog', 160, 'food_1666329660_food_1665556500_9.png', 'Consists of beef tapa, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:21:25'),
(11, 4, 'Tocinolog', 140, 'food_1666329660_food_1665556680_10.png', 'Consists of pork tocino, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:21:48'),
(12, 4, 'Bangusilog', 120, 'food_1666329720_food_1665556740_11.png', 'Consists of half bangus fish, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:22:23'),
(13, 4, 'Chorizolog', 140, 'food_1666329720_food_1665556800_12.png', 'Consists of pork chorizo, fried egg, and garlic fried rice.', 1, 0, '2022-10-21 13:22:47'),
(14, 5, 'Baby Tako Takoyaki', 40, 'food_1666329840_food_1665564060_13.png', 'Consist of octopus bites with secret sauce. 40/pc', 1, 0, '2022-10-21 13:24:38'),
(15, 5, 'Original Takoyaki', 30, 'food_1666329900_food_1665564240_15.png', 'Original taste of secret sauce. 30/pc', 1, 0, '2022-10-21 13:25:30'),
(16, 6, 'Shoyu Ramen', 210, 'food_1666329960_food_1665711780_17.png', 'Shoyu ramen is a ramen dish with a broth made of soy sauce. ', 1, 0, '2022-10-21 13:26:51'),
(17, 6, 'Tantan Ramen', 240, 'food_1666330020_food_1665712200_18.png', 'Tan Tan ramen is a Japanese dish with a spicy, creamy noodle broth that is made from peanut powder, sesame paste and chilli oil.', 1, 0, '2022-10-21 13:27:29'),
(18, 6, 'Tonkotsu Ramen', 230, 'food_1665712260_19.png', 'Tonkotsu ramen is a Japanese noodle soup made with a pork bone broth—ton means pork and kotsu means bone.', 1, 0, '2022-10-21 13:28:06'),
(19, 7, 'Super Supreme', 389, 'food_1666330320_food_1665712620_20.png', 'Richly decked with nine delicious toppings - beef, ham, italian, sausage, pepperoni, seasoned pork, bell\r\npeppers, mushrooms, onions, and pineapples.', 1, 0, '2022-10-21 13:32:00'),
(20, 7, 'Bacon & Mushroom', 359, 'food_1666330380_food_1665712740_21.png', 'Two layers of toasted bacon with bell peppers, mushrooms and onions on signature Pizza sauce.', 1, 0, '2022-10-21 13:33:03'),
(21, 7, 'Veggies Lovers', 329, 'food_1666330380_food_1665712980_24.png', 'Crunchy bell peppers, mushrooms, chunky onions, and juicy pineapples on a double layers of mozzarella cheese.', 1, 0, '2022-10-21 13:33:59'),
(22, 7, 'Pepperoni Lovers', 329, 'food_1666330440_food_1665712920_23.png', 'A true classic- pepperoni and mozzarella\r\ncheese on our signature pizza sauce.', 1, 0, '2022-10-21 13:34:32'),
(23, 8, 'Grilled Chesee Burger', 229, 'food_1666330620_food_1665713400_29.png', 'Crispy crust on the outside with patty and bacon jam and cheese on the inside!', 1, 0, '2022-10-21 13:37:36'),
(24, 8, 'Cheesy Bacon Jalapeno', 229, 'food_1666330740_food_1665713580_27.png', 'Get some heat with with the new flavor of burger that will truly satisfy your chessy-bacon carvibg with a twist.', 1, 0, '2022-10-21 13:39:11'),
(25, 8, 'Bacon & Mushroom Burger', 229, 'food_1666330800_food_1665713700_26.png', 'Bacon and mushroom with cheddar cheese.', 1, 0, '2022-10-21 13:40:01'),
(26, 8, 'Okinawa Milktea', 90, 'food_1666330860_30.png', 'Okinawa milk tea is a type of milk tea that draws influence from the Okinawa region of Japan.', 1, 0, '2022-10-21 13:41:31'),
(27, 8, 'Green Matcha Milktea', 120, 'food_1666330920_31.png', 'Naturally sweet, vegetal grassy flavor with a smooth and creamy finish.', 1, 0, '2022-10-21 13:42:22'),
(28, 9, 'Original Glazed', 40, 'food_1666331040_33.png', 'Donut dipped in light honey glaze.', 1, 0, '2022-10-21 13:44:26'),
(29, 9, 'Heaven Berry', 45, 'food_1666331040_34.png', 'Donut filled with strawberry cream filling, dipped in strawberry milk chocolate, and garnished with white chocolate.', 1, 0, '2022-10-21 13:44:51'),
(30, 10, 'Black Polo Shirt', 250, 'item_1666331400_38.png', 'A black top with short sleeves, a placket neckline, and two or three buttons.', 1, 0, '2022-10-21 13:50:33'),
(31, 10, 'Gray Tshirt', 150, 'item_1666331520_39.png', 'A lightweight, usually knitted, pullover shirt, close-fitting and with a round neckline and short sleeves, worn as an undershirt or outer garment.', 1, 0, '2022-10-21 13:52:25'),
(32, 11, 'Dictionary', 400, 'item_1666331880_43.png', 'A reference book that lists words in order—usually, for Western languages, alphabetical—and gives their meanings.', 1, 0, '2022-10-21 13:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `tin` int(25) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `business_permit` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `logo`, `owner_name`, `tin`, `id_type`, `valid_id`, `business_permit`, `address`, `username`, `password`, `type`, `status`, `is_deleted`, `date_created`) VALUES
(1, 'Barbeque Smoke and Grill', 'logo_1666326360_logo_1665297840_1.png', 'John Doe', 2147483647, '1', 'valid_id_1666326360_logo_1665297840_1.png', '', '0122 Mc Arthur Highway, Brgy. Balibago, Angeles City', 'bbq_smoke', '$2y$10$XzfcrHq4AGOsRWB4OygSX.gM1mP0tAx/d4eOyamG0mVHkyi404LA2', '', 1, 0, '2022-10-21 12:26:01'),
(2, 'Hutt Cafe Coffee House', 'logo_1666326420_logo_1665298440_2.png', 'Hazel Talinio', 12345678, '2', 'valid_id_1666326420_logo_1665298440_2.png', '', '0199 Kundol Street, Brgy. Ninoy Aquino, Marisol, Angeles City', 'hutt_cafe', '$2y$10$Bt11ML/cBJ/mpYe8ZZTvme81WFqoWo73VZwmC17pPoSt8gliDBKYK', '', 1, 0, '2022-10-21 12:27:50'),
(3, 'Best Brucnh Delicious Food', 'logo_1666326600_logo_1665298860_3.png', 'Lebron James', 2147483647, '1', 'valid_id_1666326600_logo_1665298860_3.png', '', '1234  Lourdes Sur East, Angeles City', 'best_brunch', '$2y$10$Xzv/4Qeea/Lv1TLY.UBo8.wa36whpZ8Iacgf30BtUUwvCDo979rgm', '', 1, 0, '2022-10-21 12:30:36'),
(4, 'Yummy Takoyaki', 'logo_1666326720_logo_1665299580_7.png', 'Jayson Tatum', 12345678, '1', 'valid_id_1666326720_logo_1665299580_7.png', '', '1312 Claro M. Recto, Angeles City', 'yummy_takoyaki', '$2y$10$wOgqFpS5ndamvIitm24hS.80nRl.NkxKA2EogIFl6EgQLNrJNeQK6', '', 1, 0, '2022-10-21 12:32:17'),
(5, 'Ramendo Ramen House', 'logo_1666326780_logo_1665299820_8.png', 'Calvin Abueva', 12345678, '5', 'valid_id_1666326780_logo_1665299820_8.png', '', '1888 LA Building, Mc Arthur Highway, Salapungan, Angeles City', 'ramendo', '$2y$10$UAwDCjUc1KLUEGXj43ra8eJrnFgK7dzouwQd7n.PV/N6686P.sEuO', '', 1, 0, '2022-10-21 12:33:22'),
(6, 'Pizza Point', 'logo_1666326840_logo_1665300000_9.png', 'Kylie Erving', 12345678, '3', 'valid_id_1666326840_logo_1665300000_9.png', '', '314141 Balibago, Angeles City', 'pizza_point', '$2y$10$dHDEI48P4Rjiacg/DAXaluWvGb0v0tbUnPEbylwQir8qdKU3EZv02', '', 1, 0, '2022-10-21 12:34:12'),
(7, 'The Best Burger', 'logo_1665300240_10.png', 'Steve Nash', 123456789, '3', 'valid_id_1666326900_logo_1665300240_10.png', '', '4567 Mayon St., Agapito del Rosario, Angeles City', 'thebestburger', '$2y$10$Z94171EtjI/v.U1aPh4a7urzZxx1GkNHPUDoDSiRDuEAYrKDgmpSS', '', 1, 0, '2022-10-21 12:35:15'),
(8, 'Teandahan Milk tea House', 'logo_1666326960_logo_1665300360_11.png', 'Kobe Bryant', 12345678, '3', 'valid_id_1666326960_logo_1665300360_11.png', '', '4143 Santo Domingo, Angeles City', 'teandahan', '$2y$10$/2uRd78m6DoaHRZoo8OvXuPT3/222pq.ATMPAfFnuyOP.Vv.H8NK.', '', 1, 0, '2022-10-21 12:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `sales` int(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `restaurant_id`, `sales`, `date_added`) VALUES
(1, 1, 2000, '2022-10-25 14:44:08'),
(2, 2, 2000, '2022-10-25 14:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `delivery_charge` int(255) DEFAULT NULL,
  `admin_commission` int(255) DEFAULT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `owner_id`, `delivery_charge`, `admin_commission`, `date_updated`) VALUES
(1, 2, 79, 10, '2022-10-28 17:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `tin` int(25) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `business_permit` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_blocked` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `logo`, `owner_name`, `tin`, `id_type`, `valid_id`, `business_permit`, `address`, `username`, `password`, `type`, `status`, `is_blocked`, `is_deleted`, `date_created`) VALUES
(1, 'Barbeque Smoke and Grill', 'logo_1666326360_logo_1665297840_1.png', 'John Doe', 2147483647, '1', 'valid_id_1666326360_logo_1665297840_1.png', '', '0122 Mc Arthur Highway, Brgy. Balibago, Angeles City', 'bbq_smoke', '$2y$10$XzfcrHq4AGOsRWB4OygSX.gM1mP0tAx/d4eOyamG0mVHkyi404LA2', '', 1, 0, 1, '2022-10-21 12:26:01'),
(2, 'Hutt Cafe Coffee House', 'logo_1666326420_logo_1665298440_2.png', 'Hazel Talinio', 12345678, '2', 'valid_id_1666326420_logo_1665298440_2.png', '', '0199 Kundol Street, Brgy. Ninoy Aquino, Marisol, Angeles City', 'hutt_cafe', '$2y$10$Bt11ML/cBJ/mpYe8ZZTvme81WFqoWo73VZwmC17pPoSt8gliDBKYK', '', 1, 1, 0, '2022-10-21 12:27:50'),
(3, 'Best Brucnh Delicious Food', 'logo_1666326600_logo_1665298860_3.png', 'Lebron James', 2147483647, '1', 'valid_id_1666326600_logo_1665298860_3.png', '', '1234  Lourdes Sur East, Angeles City', 'best_brunch', '$2y$10$Xzv/4Qeea/Lv1TLY.UBo8.wa36whpZ8Iacgf30BtUUwvCDo979rgm', '', 1, 0, 0, '2022-10-21 12:30:36'),
(4, 'Yummy Takoyaki', 'logo_1666326720_logo_1665299580_7.png', 'Jayson Tatum', 12345678, '1', 'valid_id_1666326720_logo_1665299580_7.png', '', '1312 Claro M. Recto, Angeles City', 'yummy_takoyaki', '$2y$10$wOgqFpS5ndamvIitm24hS.80nRl.NkxKA2EogIFl6EgQLNrJNeQK6', '', 1, 0, 0, '2022-10-21 12:32:17'),
(5, 'Ramendo Ramen House', 'logo_1666326780_logo_1665299820_8.png', 'Calvin Abueva', 12345678, '5', 'valid_id_1666326780_logo_1665299820_8.png', '', '1888 LA Building, Mc Arthur Highway, Salapungan, Angeles City', 'ramendo', '$2y$10$UAwDCjUc1KLUEGXj43ra8eJrnFgK7dzouwQd7n.PV/N6686P.sEuO', '', 1, 0, 0, '2022-10-21 12:33:22'),
(6, 'Pizza Point', 'logo_1666326840_logo_1665300000_9.png', 'Kylie Erving', 12345678, '3', 'valid_id_1666326840_logo_1665300000_9.png', '', '314141 Balibago, Angeles City', 'pizza_point', '$2y$10$dHDEI48P4Rjiacg/DAXaluWvGb0v0tbUnPEbylwQir8qdKU3EZv02', '', 1, 0, 0, '2022-10-21 12:34:12'),
(7, 'The Best Burger', 'logo_1665300240_10.png', 'Steve Nash', 123456789, '3', 'valid_id_1666326900_logo_1665300240_10.png', '', '4567 Mayon St., Agapito del Rosario, Angeles City', 'thebestburger', '$2y$10$Z94171EtjI/v.U1aPh4a7urzZxx1GkNHPUDoDSiRDuEAYrKDgmpSS', '', 1, 0, 0, '2022-10-21 12:35:15'),
(8, 'Teandahan Milk tea House', 'logo_1666326960_logo_1665300360_11.png', 'Kobe Bryant', 12345678, '3', 'valid_id_1666326960_logo_1665300360_11.png', '', '4143 Santo Domingo, Angeles City', 'teandahan', '$2y$10$/2uRd78m6DoaHRZoo8OvXuPT3/222pq.ATMPAfFnuyOP.Vv.H8NK.', '', 1, 0, 0, '2022-10-21 12:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `test_store`
--

CREATE TABLE `test_store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `tin` int(25) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `commission` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_store`
--

INSERT INTO `test_store` (`id`, `name`, `logo`, `owner_name`, `tin`, `address`, `username`, `password`, `id_type`, `valid_id`, `commission`, `status`, `date_created`) VALUES
(1, 'LA Clothing Stores', 'logo_1666327080_logo_1665981480_1.png', 'Lorna Alavarado', 12345678, '4145 Balubad St., Pulung Maragul, Angeles City', 'la_clothing', '$2y$10$9ZJ7UuWXAYEAAk3yL9wHGOhbZSwZKRKndq9XD.h6XTJah.cIu1o8u', '2', 'valid_id_1666327080_logo_1665981480_1.png', 0, 1, '2022-10-21 12:38:02'),
(2, 'Borcelle Book Store', 'logo_1666327200_logo_1665982380_2.png', 'Maja Salvador', 12345678, '200 Borcelle Building, Mc Arthur Highway, Balibago, Angeles City', 'borcelle', '$2y$10$dCHYN/JwRoTKRjopoW8eiOul6BOtPdYW/dVqzg1k8IzsPxI8cgehi', '2', 'valid_id_1666327200_valid_id_1665982380_2.png', 0, 1, '2022-10-21 12:40:34'),
(3, 'Phone Store', 'logo_1666327320_3.png', 'Daniel Padilla', 12345678, '2111 Ferrari Street, Balibago, Angeles City', 'phone_store', '$2y$10$IurrQlq/VqyY7XOzFWZMW.BMbuS2FK5.sdRos652aPGkTj9n2f1p.', '6', 'valid_id_1666327320_3.png', 0, 1, '2022-10-21 12:42:18'),
(4, 'Sunny Glasses Store', 'logo_1666327380_4.png', 'Sunny Glasses', 12345678, '123456 Diamond Subdivision, Brgy. Balibago, Angeles City', 'sunny_glasses', '$2y$10$HrNrG1fa84vuCB9yv3H0UetwFKzsM2Hst353OOmq8euaOdv4tNyLm', '4', 'valid_id_1666327380_4.png', 0, 1, '2022-10-21 12:43:35'),
(5, 'Keep Watch Service and Store', 'logo_1666327440_5.png', 'Kathryn Bernardo', 12345678, '4567 Mayon St., Agapito del Rosario, Angeles City', 'keep_watch_store', '$2y$10$11xlgWDLmQaszbZUv3ydF./qUenSS2YThNbLLYHr/IKk10mxni5f6', '8', 'valid_id_1666327440_5.png', 0, 1, '2022-10-21 12:44:47'),
(6, 'Larana Inc. Shoe Store', 'logo_1666327560_6.png', 'Basty Duterte', 12345678, '1234 Nissan Street, Brgy. Cuayan, Angeles City', 'li_shorestore', '$2y$10$Aa6FSR7ykUyRXRQh4XwJdeYDh4RfRYDy34J2uZPMxTYVHhBef8VPi', '7', 'valid_id_1666327560_6.png', 0, 1, '2022-10-21 12:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `user_ids` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `user_ids`) VALUES
(1, '2,1'),
(2, '3,1'),
(3, '2,4'),
(4, '3,2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Error reading structure for table atadku.users: #1932 - Table &#039;atadku.users&#039; doesn&#039;t exist in engine
-- Error reading data for table atadku.users: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `atadku`.`users`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `tin` int(25) NOT NULL,
  `business_permit` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_blocked` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`id`, `full_name`, `profile`, `email_address`, `number`, `owner_name`, `tin`, `business_permit`, `id_type`, `valid_id`, `address`, `username`, `password`, `user_type`, `is_blocked`, `is_deleted`, `status`, `date_created`) VALUES
(1, 'Aljon Quiambao', 'customer_profile_1666404720_profile.png', '', 0, '', 0, '', '', '', '0199 Kundol Street', 'aljonq', '$2y$10$omPJDMftxwPafsJkk4CtyO2N8amcQa2Xy0woYIFbprHE.W2xSFVt6', 'customer', 0, 0, 1, '2023-02-10 10:15:28'),
(3, 'Hutt Cafe Coffee House', 'logo_1666326420_logo_1665298440_2.png', '', 0, 'Hazel Talinio', 12345678, '', '2', 'valid_id_1666326420_logo_1665298440_2.png', '0199 Kundol Street, Brgy. Ninoy Aquino, Marisol, Angeles City', 'hutt_cafe', '$2y$10$Bt11ML/cBJ/mpYe8ZZTvme81WFqoWo73VZwmC17pPoSt8gliDBKYK', 'owner', 0, 0, 1, '2022-10-21 12:27:50'),
(4, 'Best Brucnh Delicious Food', 'logo_1666326600_logo_1665298860_3.png', '', 0, 'Lebron James', 2147483647, '', '1', 'valid_id_1666326600_logo_1665298860_3.png', '1234  Lourdes Sur East, Angeles City', 'best_brunch', '$2y$10$Xzv/4Qeea/Lv1TLY.UBo8.wa36whpZ8Iacgf30BtUUwvCDo979rgm', 'owner', 0, 0, 1, '2022-10-21 12:30:36'),
(5, 'Yummy Takoyaki', 'logo_1666326720_logo_1665299580_7.png', '', 0, 'Jayson Tatum', 12345678, '', '1', 'valid_id_1666326720_logo_1665299580_7.png', '1312 Claro M. Recto, Angeles City', 'yummy_takoyaki', '$2y$10$wOgqFpS5ndamvIitm24hS.80nRl.NkxKA2EogIFl6EgQLNrJNeQK6', 'owner', 0, 0, 1, '2022-10-21 12:32:17'),
(6, 'Ramendo Ramen House', 'logo_1666326780_logo_1665299820_8.png', '', 0, 'Calvin Abueva', 12345678, '', '5', 'valid_id_1666326780_logo_1665299820_8.png', '1888 LA Building, Mc Arthur Highway, Salapungan, Angeles City', 'ramendo', '$2y$10$UAwDCjUc1KLUEGXj43ra8eJrnFgK7dzouwQd7n.PV/N6686P.sEuO', 'owner', 0, 0, 1, '2022-10-21 12:33:22'),
(7, 'Pizza Point', 'logo_1666326840_logo_1665300000_9.png', '', 0, 'Kylie Erving', 12345678, '', '3', 'valid_id_1666326840_logo_1665300000_9.png', '314141 Balibago, Angeles City', 'pizza_point', '$2y$10$dHDEI48P4Rjiacg/DAXaluWvGb0v0tbUnPEbylwQir8qdKU3EZv02', 'owner', 0, 0, 1, '2022-10-21 12:34:12'),
(8, 'The Best Burger', 'logo_1665300240_10.png', '', 0, 'Steve Nash', 123456789, '', '3', 'valid_id_1666326900_logo_1665300240_10.png', '4567 Mayon St., Agapito del Rosario, Angeles City', 'thebestburger', '$2y$10$Z94171EtjI/v.U1aPh4a7urzZxx1GkNHPUDoDSiRDuEAYrKDgmpSS', 'owner', 0, 0, 1, '2022-10-21 12:35:15'),
(9, 'Teandahan Milk tea House', 'logo_1666326960_logo_1665300360_11.png', '', 0, 'Kobe Bryant', 12345678, '', '3', 'valid_id_1666326960_logo_1665300360_11.png', '4143 Santo Domingo, Angeles City', 'teandahan', '$2y$10$/2uRd78m6DoaHRZoo8OvXuPT3/222pq.ATMPAfFnuyOP.Vv.H8NK.', 'owner', 0, 0, 1, '2022-10-21 12:36:16'),
(10, 'LA Clothing Stores', 'logo_1666327080_logo_1665981480_1.png', '', 0, 'Lorna Alavarado', 12345678, '', '2', 'valid_id_1666327080_logo_1665981480_1.png', '4145 Balubad St., Pulung Maragul, Angeles City', 'la_clothing', '$2y$10$9ZJ7UuWXAYEAAk3yL9wHGOhbZSwZKRKndq9XD.h6XTJah.cIu1o8u', 'owner', 0, 0, 1, '2022-10-21 12:38:02'),
(11, 'Borcelle Book Store', 'logo_1666327200_logo_1665982380_2.png', '', 0, 'Maja Salvador', 12345678, '', '2', 'valid_id_1666327200_valid_id_1665982380_2.png', '200 Borcelle Building, Mc Arthur Highway, Balibago, Angeles City', 'borcelle', '$2y$10$dCHYN/JwRoTKRjopoW8eiOul6BOtPdYW/dVqzg1k8IzsPxI8cgehi', 'owner', 0, 0, 1, '2022-10-21 12:40:34'),
(12, 'Phone Store', 'logo_1666327320_3.png', '', 0, 'Daniel Padilla', 12345678, '', '6', 'valid_id_1666327320_3.png', '2111 Ferrari Street, Balibago, Angeles City', 'phone_store', '$2y$10$IurrQlq/VqyY7XOzFWZMW.BMbuS2FK5.sdRos652aPGkTj9n2f1p.', 'owner', 0, 0, 1, '2022-10-21 12:42:18'),
(13, 'Sunny Glasses Store', 'logo_1666327380_4.png', '', 0, 'Sunny Glasses', 12345678, '', '4', 'valid_id_1666327380_4.png', '123456 Diamond Subdivision, Brgy. Balibago, Angeles City', 'sunny_glasses', '$2y$10$HrNrG1fa84vuCB9yv3H0UetwFKzsM2Hst353OOmq8euaOdv4tNyLm', 'owner', 0, 0, 1, '2022-10-21 12:43:35'),
(14, 'Keep Watch Service and Store', 'logo_1666327440_5.png', '', 0, 'Kathryn Bernardo', 12345678, '', '8', 'valid_id_1666327440_5.png', '4567 Mayon St., Agapito del Rosario, Angeles City', 'keep_watch_store', '$2y$10$11xlgWDLmQaszbZUv3ydF./qUenSS2YThNbLLYHr/IKk10mxni5f6', 'owner', 0, 0, 1, '2022-10-21 12:44:47'),
(15, 'Larana Inc. Shoe Store', 'logo_1666327560_6.png', '', 0, 'Basty Duterte', 12345678, '', '7', 'valid_id_1666327560_6.png', '1234 Nissan Street, Brgy. Cuayan, Angeles City', 'li_shorestore', '$2y$10$Aa6FSR7ykUyRXRQh4XwJdeYDh4RfRYDy34J2uZPMxTYVHhBef8VPi', 'owner', 0, 0, 1, '2022-10-21 12:46:19'),
(16, 'Lebron James', 'driver_profile_1666452120_profile.png', 'lebron_james@gmail.com', 0, '', 0, '', '9', 'valid_id_1666452120_pic1.jpg', '0199 Kundol Street', 'lebron_james', '$2y$10$N4xHsZxiHSBWp69tsLd3lOiXximvQ.7/AbTDKRDd2u7sQOVwMXTZy', 'driver', 0, 0, 1, '2023-02-15 20:08:47'),
(17, 'Grant Quiambao', 'profile_1676523060_323584578_480320030955319_8610256235098291637_n.jpg', 'aljonquiambao.mcc@gmail.com', 0, '', 0, '1676523060_', '12', 'valid_id_1676523060_323584578_480320030955319_8610256235098291637_n.jpg', '1234 Nissan Street, Brgy. Cuayan, Angeles City', 'grantq', '$2y$10$.nA9/duj01f/6CHn8NTIvuqeZUO.ZQ6PvyPA2BFCpCFdxHcTPctnK', 'customer', 0, 0, 1, '2023-02-16 12:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `valid_id_type`
--

CREATE TABLE `valid_id_type` (
  `id` int(11) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `valid_id_type`
--

INSERT INTO `valid_id_type` (`id`, `id_type`, `date_created`) VALUES
(1, 'Land Transportation Office (LTO) Driver’s License', '2022-10-21 12:22:47'),
(2, 'Unified Multi-Purpose Identification (UMID) Card', '2022-10-21 12:22:47'),
(3, 'Social Security System (SSS) Card', '2022-10-21 12:22:47'),
(4, 'Government Service Insurance System (GSIS) Card', '2022-10-21 12:22:47'),
(5, 'Philippine Passport', '2022-10-21 12:22:47'),
(6, 'Professional Regulatory Commission (PRC) ID', '2022-10-21 12:22:47'),
(7, 'Philippine Identification (PhilID)/ePhilID', '2022-10-21 12:22:47'),
(8, 'Overseas Workers Welfare Administration (OWWA) E-Card', '2022-10-21 12:22:47'),
(9, 'Senior Citizen ID', '2022-10-21 12:22:47'),
(10, 'COMELEC Voter’s ID or Voter’s Certificate', '2022-10-21 12:22:47'),
(11, 'Airman License', '2022-10-21 12:22:47'),
(12, 'Philippine Postal ID', '2022-10-21 12:22:47'),
(13, 'Seafarer’s Record Book ', '2022-10-21 12:22:47'),
(14, 'School ID (if applicable)', '2022-10-21 12:22:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_commission`
--
ALTER TABLE `admin_commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_charge`
--
ALTER TABLE `delivery_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_info`
--
ALTER TABLE `delivery_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_list`
--
ALTER TABLE `food_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_status`
--
ALTER TABLE `pickup_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_store`
--
ALTER TABLE `test_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valid_id_type`
--
ALTER TABLE `valid_id_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_commission`
--
ALTER TABLE `admin_commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_charge`
--
ALTER TABLE `delivery_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_info`
--
ALTER TABLE `delivery_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_list`
--
ALTER TABLE `food_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pickup`
--
ALTER TABLE `pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pickup_status`
--
ALTER TABLE `pickup_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `test_store`
--
ALTER TABLE `test_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `valid_id_type`
--
ALTER TABLE `valid_id_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
