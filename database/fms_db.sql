-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220609.11e34a6fec
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 10:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `ftype` tinyint(1) NOT NULL DEFAULT 2,
  `folder_id` int(30) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `is_admin` tinyint(4) DEFAULT 0,
  `is_dean` tinyint(4) DEFAULT 0,
  `is_hod` tinyint(4) DEFAULT 0,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `description`, `user_id`, `ftype`, `folder_id`, `file_type`, `file_path`, `is_public`, `is_admin`, `is_dean`, `is_hod`, `date_updated`) VALUES
(42, 'Feedback', 'Feedback From ADMIN', 1, 3, 27, 'pdf', '1654029120_Feedback.pdf', 1, 0, 0, 0, '2022-06-01 02:02:39'),
(45, 'Feedback', 'Feedback Photo From Admin', 1, 3, 27, 'png', '1654029300_Feedback.png', 1, 0, 0, 0, '2022-06-01 02:05:18'),
(46, 'Feedback', 'Feedback Text File', 1, 3, 27, 'txt', '1654029300_Feedback.txt', 1, 0, 0, 0, '2022-06-01 02:05:40'),
(47, 'naac', 'NAAC Image From Admin', 1, 1, 28, 'jpg', '1654029360_naac.jpg', 1, 0, 0, 0, '2022-06-01 02:06:38'),
(48, 'NAAC', 'Naac Doc From Admin', 1, 1, 28, 'pdf', '1654029420_NAAC.pdf', 1, 0, 0, 0, '2022-06-01 02:07:02'),
(49, 'NAAC', 'NAAC Text Doc', 1, 1, 28, 'txt', '1654029420_NAAC.txt', 1, 0, 0, 0, '2022-06-01 02:07:56'),
(50, 'NBA', 'NBA pdf Doc From Admin', 1, 2, 17, 'pdf', '1654029480_NBA.pdf', 1, 0, 0, 0, '2022-06-01 02:08:33'),
(51, 'Feedback', 'Feedback from HOD', 7, 3, 22, 'txt', '1654029540_Feedback.txt', 1, 0, 0, 0, '2022-06-01 02:09:49'),
(52, 'NAAC', 'NAAC doc From HOD', 7, 1, 23, 'pdf', '1654029660_NAAC.pdf', 1, 0, 0, 0, '2022-06-01 02:11:07'),
(53, 'nba', 'NBA Photo From HOD', 7, 2, 24, 'png', '1654029660_nba.png', 1, 0, 0, 0, '2022-06-01 02:11:34'),
(54, 'Feedback', 'Feedback Image from DEAN', 6, 3, 19, 'png', '1654029780_Feedback.png', 1, 0, 0, 0, '2022-06-01 02:13:01'),
(55, 'NAAC', 'NAAC doc From DEAN', 6, 1, 20, 'pdf', '1654029780_NAAC.pdf', 1, 0, 0, 0, '2022-06-01 02:13:31'),
(56, 'Software Requirements Specification', 'Admin doc', 1, 4, 29, 'pdf', '1654030980_Software Requirements Specification.pdf', 0, 1, 0, 0, '2022-06-01 02:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `parent_id`) VALUES
(17, 1, 'NBA Documents', 0),
(19, 6, 'Feedbacks', 0),
(20, 6, 'NAAC Documents', 0),
(21, 6, 'NBA Documents', 0),
(22, 7, 'Feedbacks', 0),
(23, 7, 'NAAC Documents', 0),
(24, 7, 'NBA Documents', 0),
(27, 1, 'Feedbacks', 0),
(28, 1, 'NAAC Documents', 0),
(29, 1, 'Admin Folder', 0),
(30, 6, 'dean folder', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=Dean, 3=Hod'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin', 1),
(6, 'dean', 'dean', 'dean', 2),
(7, 'hod', 'hod', 'hod', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
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
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



