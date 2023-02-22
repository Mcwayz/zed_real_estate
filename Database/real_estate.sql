-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 12:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_type`
--

CREATE TABLE `ad_type` (
  `id` int(11) NOT NULL,
  `ad_type` varchar(40) DEFAULT NULL,
  `type_desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ad_type`
--

INSERT INTO `ad_type` (`id`, `ad_type`, `type_desc`) VALUES
(1, 'Rent', 'Renting, also known as hiring or letting, is an agreement where a payment is made for the temporary use of a good, service or property owned by another.'),
(2, 'Sale', 'The exchange of a property for money; the action of selling something.');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `user_id` int(11) NOT NULL,
  `nrc_no` tinytext DEFAULT NULL,
  `nrc_attachment` varchar(255) DEFAULT NULL,
  `client_province` text DEFAULT NULL,
  `client_city` text DEFAULT NULL,
  `client_town` text DEFAULT NULL,
  `date_time` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`user_id`, `nrc_no`, `nrc_attachment`, `client_province`, `client_city`, `client_town`, `date_time`) VALUES
(1, '11234567890', '1670852202_Airtel-Money.png', 'Lusaka Province', 'Lusaka', 'Lusaka', NULL),
(23, '400532/10/1', '1671199464_PXL_20221213_100932119.MP.jpg', 'Lusaka Province', 'Lusaka', 'Lusaka', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `comment_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments_tbl`
--

INSERT INTO `comments_tbl` (`id`, `property_id`, `user_id`, `comment`, `comment_date`) VALUES
(3, 1, 22, 'Kale Bwangu', '2022-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `property_owner_id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `ad_type_id` int(11) NOT NULL,
  `property_status` varchar(10) DEFAULT NULL,
  `property_amount` varchar(255) DEFAULT NULL,
  `visibility` tinytext DEFAULT NULL,
  `no_of_views` int(11) NOT NULL,
  `property_details` text DEFAULT NULL,
  `ad` int(11) DEFAULT NULL,
  `upload_date` varchar(20) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `property_owner_id`, `property_type_id`, `ad_type_id`, `property_status`, `property_amount`, `visibility`, `no_of_views`, `property_details`, `ad`, `upload_date`) VALUES
(1, 1, 2, 1, 'Available', '4500', '0', 0, 'Kamwala South', NULL, '2022-11-05 17:09:00'),
(3, 1, 2, 2, 'Available', '50000', '0', 25, '2 Story Building in Libala South', NULL, '2022-12-14 17:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `property_attachments`
--

CREATE TABLE `property_attachments` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `property_attachment` varchar(255) DEFAULT NULL,
  `upload_date` varchar(60) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_attachments`
--

INSERT INTO `property_attachments` (`id`, `property_id`, `property_attachment`, `upload_date`) VALUES
(1, 1, 'ADVT Errors.png', '2022-11-05 17:14:44'),
(2, 1, 'CDET Errors.png', '2022-11-05 17:14:44'),
(3, 1, 'hinata.jpg', '2022-11-05 17:14:44'),
(4, 1, 'hinata.png', '2022-11-05 17:14:44'),
(5, 1, 'Save Score.png', '2022-11-05 17:14:44'),
(6, 1, 'TAC Online.png', '2022-11-05 17:14:44'),
(7, 1, 'WhatsApp Image 2022-08-22 at 08.32.13.jpeg', '2022-11-05 17:14:44'),
(8, 3, '3.png', '2022-12-14 17:57:45'),
(9, 3, '2.png', '2022-12-14 17:57:45'),
(10, 3, '1.png', '2022-12-14 17:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `property_chats`
--

CREATE TABLE `property_chats` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_msg` text DEFAULT NULL,
  `client_msg_date` varchar(50) DEFAULT NULL,
  `property_owner_msg` text DEFAULT NULL,
  `property_owner_msg_date` varchar(50) DEFAULT NULL,
  `property_attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property_owners`
--

CREATE TABLE `property_owners` (
  `user_id` int(11) NOT NULL,
  `nrc_no` tinytext DEFAULT NULL,
  `nrc_attachment` varchar(255) DEFAULT NULL,
  `proof_of_residence` varchar(255) DEFAULT NULL,
  `owner_province` text DEFAULT NULL,
  `owner_city` text DEFAULT NULL,
  `owner_town` text DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `date_time` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_owners`
--

INSERT INTO `property_owners` (`user_id`, `nrc_no`, `nrc_attachment`, `proof_of_residence`, `owner_province`, `owner_city`, `owner_town`, `email_address`, `date_time`) VALUES
(1, '24889244', 'NRC_0q304o0.jpg', 'Bill Statement', 'Lusaka', 'Lusaka', 'Libala', 'chales.phiri@izyane.com', '2022-11-05'),
(22, '400532/10/1', '1671270325_PXL_20221213_100932119.MP.jpg', '1671270325_PXL_20221214_150535764.jpg', 'Lusaka Province', 'Lusaka', 'Lusaka', 'chiyembekezop@yahoo.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `id` int(11) NOT NULL,
  `property_type` varchar(40) DEFAULT NULL,
  `type_desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`id`, `property_type`, `type_desc`) VALUES
(1, 'Land', 'Property for rent'),
(2, 'House', 'A building for human habitation, especially one that consists of a ground floor and one or more upper storeys'),
(3, 'Office', 'A room, set of rooms, or building used as a place for commercial, professional, or bureaucratic work.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` varchar(500) DEFAULT NULL,
  `txn_date` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `property_id`, `client_id`, `amount`, `txn_date`) VALUES
(4017687, 1, 1, '4500', '2022-12-12 15:47:05'),
(4028091, 3, 23, '50000', '2022-12-16 16:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` tinytext DEFAULT NULL,
  `lastname` tinytext DEFAULT NULL,
  `email_address` text DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `role` tinytext DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email_address`, `phone_no`, `role`, `password`, `profile_pic`) VALUES
(1, 'Chiyembekezo', 'Phiri', 'chiyembekezop11@gmail.com', '0974071573', 'Admin', '1234567', ''),
(22, 'Chiyembekezo', 'Xavier', 'chiyembekezop@yahoo.com', '0974071573', 'User', '1234567', '1670945086_Racheal.png'),
(23, 'Lotus', 'IO', 'lotuszm.io@gmail.com', '0974071573', 'User', '1234567', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_type`
--
ALTER TABLE `ad_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_owner_id` (`property_owner_id`),
  ADD KEY `property_type_id` (`property_type_id`),
  ADD KEY `ad_type_id` (`ad_type_id`);

--
-- Indexes for table `property_attachments`
--
ALTER TABLE `property_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_chats`
--
ALTER TABLE `property_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `property_owners`
--
ALTER TABLE `property_owners`
  ADD KEY `property_owners_ibfk_1` (`user_id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_type`
--
ALTER TABLE `ad_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_attachments`
--
ALTER TABLE `property_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `property_chats`
--
ALTER TABLE `property_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4028207;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD CONSTRAINT `comments_tbl_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `comments_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`ad_type_id`) REFERENCES `ad_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`property_type_id`) REFERENCES `property_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_attachments`
--
ALTER TABLE `property_attachments`
  ADD CONSTRAINT `property_attachments_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_chats`
--
ALTER TABLE `property_chats`
  ADD CONSTRAINT `property_chats_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `property_chats_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`user_id`);

--
-- Constraints for table `property_owners`
--
ALTER TABLE `property_owners`
  ADD CONSTRAINT `property_owners_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
