-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2015 at 04:36 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osas`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `credit` decimal(4,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `credit`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 'fsdfdsfdsf', 'sdfdfdffdfdf', '3.00', 1, 1, 1, 1444662671, 1444663384, '127.0.0.1'),
(2, 'cse 101', 'dfgfgf', '1.50', 1, 1, 1, 1444663190, 1444663405, '127.0.0.1'),
(3, 'cse 102', 'dfdf', '3.00', 1, 1, 1, 1444663310, 1444663604, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `parent_id`, `name`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 0, NULL, 1, 0, 0, 1444675695, 1444675695, ''),
(2, 0, NULL, 1, 0, 0, 1444675709, 1444675709, '');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `can_create` tinyint(4) NOT NULL DEFAULT '0',
  `can_read` tinyint(4) NOT NULL DEFAULT '0',
  `can_update` tinyint(4) NOT NULL DEFAULT '0',
  `can_delete` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active, 0 = Inactive',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `terminal` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '0',
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL DEFAULT '0',
  `designation_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = Inactive, 1 = Active',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='User information table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `employee_id`, `student_id`, `designation_id`, `first_name`, `last_name`, `contact_no`, `address`, `username`, `email`, `password`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 0, 0, 0, 0, 'Md Mahfuzur', 'Rahman', '01928172957', 'Khilkhet, Dhaka', 'admin', 'shawon922@gmail.com', '4fabdf02e0d9dc342c107698a52c9029dd5904ec', 1, 0, 0, 0, 1444584304, '::1'),
(2, 1, 0, 0, 0, 'fdfdf', 'sdfdsf', 'sdf', 'fgdgdfgdg', 'localhost', 'sdfdfsdf@gamil.com', '11a2015b4a07c32dc14c1a74fa8de123d6ce48d1', 1, 1, 0, 1444371861, 1444371861, '127.0.0.1'),
(3, 1, 0, 0, 0, 'A.K.M.', 'Ashrafuzzaman', '+8801674196502', 'Ranpura,Dhaka', 'aubcse', 'ashrafjkhjkfl@gmail.com', '54821dccecd41c6bef68a257bf70422bf02b7c81', 1, 1, 0, 1444385696, 1444385696, '127.0.0.1'),
(4, 2, 0, 0, 0, 'fgfdgdfgf', 'fgfgf', '+8801674196502', 'sdfsdffd', 'fdgfdgfdgfg123', 'sdfsdfsdfdfsdf@gamil.com', '54821dccecd41c6bef68a257bf70422bf02b7c81', 1, 1, 1, 1444583098, 1444583929, '127.0.0.1'),
(5, 2, 0, 0, 0, 'fdfdfsdfsf', 'sdfsdf', '+8801674196502', 'sdfsdfsd', 'admin1', 'sdfsdfsdfddfsdf@gamil.com', '54821dccecd41c6bef68a257bf70422bf02b7c81', 0, 1, 0, 1444583187, 1444584613, '127.0.0.1'),
(6, 3, 0, 0, 0, 'Mahamudul Nobi ', 'Mohon', '01751187215', 'khilkhet Dhaka', 'mohon', 'mn.mohon@gmail.com', 'c02596644b2ee0c8db2b7e5c825236f680d849ec', 1, 1, 0, 1444675371, 1444675371, '192.168.0.101');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `login` int(20) NOT NULL,
  `logout` int(20) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `browser_info` text NOT NULL,
  `server_signature` text NOT NULL,
  `server_software` text NOT NULL,
  `server_ip` varchar(20) NOT NULL,
  `server_mac` varchar(100) NOT NULL,
  `user_mac` varchar(100) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 = Improper logout, 1 = Proper logout',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Login information of users';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
