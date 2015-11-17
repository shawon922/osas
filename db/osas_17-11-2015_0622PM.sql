-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2015 at 06:21 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  `department_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `credit` decimal(4,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `code`, `name`, `credit`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 1, '1001', 'Programming Language 1', '3.00', 1, 7, 0, 1447353251, 1447353251, '127.0.0.1'),
(2, 1, '1002', 'Programming Language 2', '3.00', 1, 7, 0, 1447353294, 1447353294, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `short_name` varchar(30) NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `short_name`, `code`, `description`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 'Computer Science and Engineering', 'CSE', '6', '', 1, 1, 0, 1447348096, 1447348096, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `description`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 'Lecturer', '', 1, 1, 0, 1447348175, 1447348175, '127.0.0.1'),
(2, 'Assistant Professor', '', 1, 1, 0, 1447348221, 1447348221, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
`id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `designation_id` int(11) NOT NULL,
  `employee_code` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `date_of_birth` int(11) NOT NULL,
  `date_of_joining` int(11) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text,
  `email` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = Inactive, 1 = Active',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Employee information table';

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `designation_id`, `employee_code`, `first_name`, `last_name`, `gender`, `date_of_birth`, `date_of_joining`, `contact_no`, `address`, `email`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 1, 1, 'CSE-1', 'Md Mahfuzur', 'Rahman', 1, 728780400, 1443650400, '01928172957', 'Dhaka', 'mmrs.std@gmail.com', 1, 1, 0, 1447347835, 1447347835, '127.0.0.1');

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
-- Table structure for table `offer_courses`
--

DROP TABLE IF EXISTS `offer_courses`;
CREATE TABLE IF NOT EXISTS `offer_courses` (
`id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `semester` tinyint(4) NOT NULL,
  `year` year(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer_courses`
--

INSERT INTO `offer_courses` (`id`, `department_id`, `course_id`, `user_id`, `semester`, `year`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 1, 1, 7, 1, 2015, 1, 7, 0, 1447696890, 1447696890, '::1'),
(2, 1, 2, 7, 1, 2015, 1, 7, 0, 1447696890, 1447696890, '::1'),
(3, 1, 1, 7, 1, 2015, 1, 7, 0, 1447697264, 1447697264, '::1'),
(4, 1, 2, 7, 1, 2015, 1, 7, 0, 1447697264, 1447697264, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `offer_course_children`
--

DROP TABLE IF EXISTS `offer_course_children`;
CREATE TABLE IF NOT EXISTS `offer_course_children` (
`id` int(11) NOT NULL,
  `offer_course_id` int(11) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer_course_children`
--

INSERT INTO `offer_course_children` (`id`, `offer_course_id`, `batch`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 1, '50', 1, 7, 0, 1447696890, 1447696890, ''),
(2, 1, '49', 1, 7, 0, 1447696890, 1447696890, ''),
(3, 1, '48', 1, 7, 0, 1447696890, 1447696890, ''),
(4, 2, '50', 1, 7, 0, 1447696890, 1447696890, ''),
(5, 2, '49', 1, 7, 0, 1447696890, 1447696890, ''),
(6, 2, '48', 1, 7, 0, 1447696890, 1447696890, ''),
(7, 2, '47', 1, 7, 0, 1447696890, 1447696890, ''),
(8, 3, '50', 1, 7, 0, 1447697264, 1447697264, '::1'),
(9, 3, '49', 1, 7, 0, 1447697264, 1447697264, '::1'),
(10, 3, '48', 1, 7, 0, 1447697264, 1447697264, '::1'),
(11, 4, '50', 1, 7, 0, 1447697264, 1447697264, '::1'),
(12, 4, '49', 1, 7, 0, 1447697264, 1447697264, '::1'),
(13, 4, '48', 1, 7, 0, 1447697264, 1447697264, '::1'),
(14, 4, '47', 1, 7, 0, 1447697264, 1447697264, '::1');

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
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `id_no` varchar(20) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `date_of_birth` int(11) NOT NULL,
  `date_of_admission` int(11) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text,
  `email` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Inactive, 1 = Active',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `terminal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Student information table';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='User information table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `department_id`, `employee_id`, `student_id`, `designation_id`, `first_name`, `last_name`, `contact_no`, `address`, `username`, `email`, `password`, `status`, `created_by`, `modified_by`, `created`, `modified`, `terminal`) VALUES
(1, 1, 0, 0, 0, 0, 'Md Mahfuzur', 'Rahman', '1234567899', 'Khilkhet, Dhaka', 'admin', 'shawon922@gmail.com', '4fabdf02e0d9dc342c107698a52c9029dd5904ec', 1, 0, 0, 0, 1444584304, '::1'),
(2, 1, 0, 0, 0, 0, 'fdfdf', 'sdfdsf', 'sdf', 'fgdgdfgdg', 'localhost', 'sdfdfsdf@gamil.com', '11a2015b4a07c32dc14c1a74fa8de123d6ce48d1', 1, 1, 0, 1444371861, 1444371861, '127.0.0.1'),
(3, 1, 0, 0, 0, 0, 'A.K.M.', 'Ashrafuzzaman', '+8801674196502', 'Ranpura,Dhaka', 'aubcse', 'ashrafjkhjkfl@gmail.com', '54821dccecd41c6bef68a257bf70422bf02b7c81', 1, 1, 0, 1444385696, 1444385696, '127.0.0.1'),
(4, 2, 0, 0, 0, 0, 'fgfdgdfgf', 'fgfgf', '+8801674196502', 'sdfsdffd', 'fdgfdgfdgfg123', 'sdfsdfsdfdfsdf@gamil.com', '54821dccecd41c6bef68a257bf70422bf02b7c81', 1, 1, 1, 1444583098, 1444583929, '127.0.0.1'),
(5, 2, 0, 0, 0, 0, 'fdfdfsdfsf', 'sdfsdf', '+8801674196502', 'sdfsdfsd', 'admin1', 'sdfsdfsdfddfsdf@gamil.com', '54821dccecd41c6bef68a257bf70422bf02b7c81', 0, 1, 0, 1444583187, 1444584613, '127.0.0.1'),
(6, 3, 0, 0, 0, 0, 'Mahamudul Nobi ', 'Mohon', '01751187215', 'khilkhet Dhaka', 'mohon', 'mn.mohon@gmail.com', 'c02596644b2ee0c8db2b7e5c825236f680d849ec', 1, 1, 0, 1444675371, 1444675371, '192.168.0.101'),
(7, 2, 1, 1, 0, 1, 'Md Mahfuzur', 'Rahman', '01928172957', 'Dhaka', 'mmrs.std01928172957', 'mmrs.std@gmail.com', '74f7316c8d5f4d5d28c8f4d035c2092f402abdab', 1, 1, 7, 1447347835, 1447353883, '127.0.0.1');

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
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_courses`
--
ALTER TABLE `offer_courses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_course_children`
--
ALTER TABLE `offer_course_children`
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
-- Indexes for table `students`
--
ALTER TABLE `students`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `offer_courses`
--
ALTER TABLE `offer_courses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `offer_course_children`
--
ALTER TABLE `offer_course_children`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
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
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
