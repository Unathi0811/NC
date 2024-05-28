-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 11:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`) VALUES
(1, 'unathi', 'unathi123', 'unathi@gmail.com'),
(15, 'unathi', '$2y$10$QwACwIwQnj25SCGciaynsuLfVc9XIHiWmF9zyhQ3P5xYpPVtEy13G', 'unathi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(6) UNSIGNED NOT NULL,
  `nanny_id` varchar(255) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `nanny_id`, `booking_date`, `children`, `active`) VALUES
(1, '1', '2024-05-28', 10, 1),
(2, '1', '2024-05-27', 10, 0),
(3, '0', '0000-00-00', 0, 0),
(4, '0', '0000-00-00', 0, 0),
(5, '0', '0000-00-00', 0, 0),
(6, '0', '0000-00-00', 0, 0),
(7, '0', '0000-00-00', 0, 0),
(8, '0', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nannies`
--

CREATE TABLE `nannies` (
  `nanny_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hourly_rate` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `available` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nannies`
--

INSERT INTO `nannies` (`nanny_id`, `name`, `hourly_rate`, `password`, `available`) VALUES
('1', 'test', '$2', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parent_info`
--

CREATE TABLE `parent_info` (
  `id` int(30) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` int(12) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_info`
--

INSERT INTO `parent_info` (`id`, `first_name`, `last_name`, `phone`, `email`, `PASSWORD`, `confirm_password`, `profile_picture`) VALUES
(1, 'Unathi', 'Suru', 1234567890, 'unathi.suru@example.com', 'password123', 'password123', 'john_doe.jpg'),
(2, 'Jane', 'Smith', 987654321, 'jane.smith@example.com', 'password456', 'password456', 'jane_smith.jpg'),
(3, 'Robert', 'Johnson', 2147483647, 'robert.johnson@example.com', 'password789', 'password789', 'robert_johnson.jpg'),
(4, 'Emily', 'Davis', 2147483647, 'emily.davis@example.com', 'password101', 'password101', 'emily_davis.jpg'),
(1, 'Unathi', 'Suru', 1234567890, 'unathi.suru@example.com', 'password123', 'password123', 'https://s.yimg.com/fz/api/res/1.2/ic4vchsl1KhMQ6yl7NFbIQ--~C/YXBwaWQ9c3JjaGRkO2ZpPWZpbGw7aD0xNTI7cT04MDt3PTk2/https://s.yimg.com/zb/imgv1/04572560-afe1-3e22-a800-de152ae40ead/t_1024x1024'),
(NULL, NULL, NULL, NULL, NULL, '$2y$10$vloNbncpybcK1sKoi7fiH.rWkMTMsY7DOOETPIDGVDpIlfxSp./FW', NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, '$2y$10$VviSFrRO6aNrRejSPbiBCOCssAz.MWIixY1SZ7m1JbNEK9FI0VSOi', NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, '$2y$10$Z9Htwcy2GOJN7JNDpqEmJurKFnmgC0DzAsH9VbKgaZqVM6pqY/LcW', NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(6) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal` int(10) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `cardnumber` int(16) NOT NULL,
  `expirydate` varchar(2) NOT NULL,
  `expiryyear` varchar(4) NOT NULL,
  `cvv` int(3) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `fName` varchar(255) DEFAULT NULL,
  `lName` varchar(255) DEFAULT NULL,
  `phone` int(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `re_enter_password` varchar(255) DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`fName`, `lName`, `phone`, `email`, `pass`, `re_enter_password`, `profilePic`) VALUES
('Unathi', 'Suru', 823116058, 'skylersur0811@gmail.com', 'Unathi0811.', 'nathi0811.', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `Ethnicity` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `password` varchar(14) NOT NULL,
  `confirm_password` varchar(14) NOT NULL,
  `Resume` varchar(255) NOT NULL,
  `Certificate` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `profile_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `name`, `surname`, `email`, `phone`, `Ethnicity`, `language`, `password`, `confirm_password`, `Resume`, `Certificate`, `verified`, `profile_image`) VALUES
(1, 'Unathi', 'Suru', 'skylersur0811@gmail.com', '0735993961', '', 'xhosa', '$2y$10$GituwNH', '', 'certificate mam.pdf', 'Test 2.pdf', 1, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(4, 'Thokozile', 'Suru', 'thokozilesuru60@gmail.com', '0790317570', '', 'xhosa', '$2y$10$UCRUU4M', '', 'WhatsApp Image 2024-03-21 at 07.42.10.jpeg', 'INSIGHT ARCHITECTS DOCUMENT  BAY02A1.docx', 0, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(5, 'Thokozile', 'Suru', 'thokozilesuru60@gmail.com', '0790317570', '', 'xhosa', '$2y$10$AXyLaML', '', 'WhatsApp Image 2024-03-21 at 07.42.10.jpeg', 'INSIGHT ARCHITECTS DOCUMENT  BAY02A1.docx', 1, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(6, 'Thokozile', 'Suru', 'thokozilesuru60@gmail.com', '0790317570', '', 'xhosa', '$2y$10$kir.J8/', '', 'WhatsApp Image 2024-03-21 at 07.42.10.jpeg', 'INSIGHT ARCHITECTS DOCUMENT  BAY02A1.docx', 0, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(7, 'Gugu', 'Khoza', 'guguk708@gmail.com', '0671748203', '', 'afrikaans', '$2y$10$K7loE4L', '', 'certificate mam.pdf', 'Test 2.pdf', 0, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(8, 'Gugu', 'Khoza', 'guguk708@gmail.com', '0671748203', '', 'afrikaans', '$2y$10$ysfF0j6', '', 'certificate mam.pdf', 'Test 2.pdf', 0, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(9, 'Gugu', 'Khoza', 'guguk708@gmail.com', '0671748203', '', 'afrikaans', '$2y$10$L63HLle', '', 'certificate mam.pdf', 'Test 2.pdf', 0, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(10, 'Gugu', 'Khoza', 'guguk708@gmail.com', '0671748203', '', 'afrikaans', '$2y$10$ZJ3b9xC', '', 'certificate mam.pdf', 'Test 2.pdf', 0, 'https://www.pixelstalk.net/wp-content/uploads/2016/07/3840x2160-Images-Free-Download.jpg'),
(11, 'Thokozile', 'Suru', 'skylersur0811@gmail.com', '0790317570', '', 'zulu', '$2y$10$Q6Kf8kn', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(12, 'Thokozile', 'Suru', 'skylersur0811@gmail.com', '0790317570', '', 'zulu', '$2y$10$dZ6noJL', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(13, 'Thokozile', 'Suru', 'skylersur0811@gmail.com', '0790317570', '', 'zulu', '$2y$10$qoBdIZT', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(14, 'Thokozile', 'Suru', 'skylersur0811@gmail.com', '0790317570', '', 'zulu', '$2y$10$2UADfYl', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(15, 'doody', 'boody', 'doody@gmail.com', '0893116758', '', 'zulu', '$2y$10$HuO1jJh', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(16, 'doody', 'boody', 'doody@gmail.com', '0893116758', '', 'zulu', '$2y$10$8qlbmyP', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(17, 'doody', 'boody', 'doody@gmail.com', '0893116758', '', 'zulu', '$2y$10$4FP1Dsa', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(18, 'doody', 'boody', 'doody@gmail.com', '0893116758', '', 'zulu', '$2y$10$.6YvTWE', '', 'certificate mam.pdf', 'Test 2.pdf', 0, ''),
(19, 'doody', 'boody', 'doody@gmail.com', '0893115676', '', 'sesotho', '$2y$10$oADUm8d', '', 'certificate mam.pdf', 'certificate mam.pdf', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
