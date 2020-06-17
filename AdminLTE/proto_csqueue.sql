-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 05:47 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proto_csqueue`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app`
--

CREATE TABLE `tbl_app` (
  `a_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `a_date` date NOT NULL,
  `s_time` varchar(10) NOT NULL,
  `e_time` varchar(10) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `a_valid` int(11) NOT NULL,
  `active_a` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_app`
--

INSERT INTO `tbl_app` (`a_id`, `stu_id`, `f_id`, `c_id`, `a_date`, `s_time`, `e_time`, `reason`, `a_valid`, `active_a`) VALUES
(1, 5, 3, 2, '2020-04-01', '02:15', '02:30', 'test Appointment 1', 0, 1),
(2, 5, 4, 1, '2020-04-13', '2:30', '2:45', 'Test Appointment 2 ', 0, 1),
(4, 5, 3, 2, '2020-04-13', '03:45', '04:00', 'Test', 0, 1),
(5, 12, 4, 1, '2020-04-17', '16:30', '04:45', 'test', 0, 1),
(6, 5, 11, 2, '2020-04-23', '09:30', '09:45', 'Class Notes.', 0, 1),
(7, 12, 3, 2, '2020-04-20', '03:30', '03:45', 'test', 0, 1),
(8, 12, 3, 2, '2020-04-20', '03:45', '04:00', 'test', 0, 1),
(9, 12, 11, 2, '2020-04-23', '09:15', '09:30', 'Leave Application.', 0, 1),
(10, 12, 11, 2, '2020-04-23', '09:00', '09:15', 'Presentation.', 0, 1),
(18, 5, 3, 2, '2020-04-20', '14:15', '02:30', 'Project discussion.', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appsche`
--

CREATE TABLE `tbl_appsche` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_login_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `s_th` varchar(11) NOT NULL,
  `s_tm` varchar(11) NOT NULL,
  `e_th` varchar(11) NOT NULL,
  `e_tm` varchar(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_appsche`
--

INSERT INTO `tbl_appsche` (`id`, `login_id`, `c_id`, `p_login_id`, `day`, `s_th`, `s_tm`, `e_th`, `e_tm`, `valid`) VALUES
(1, 3, 2, 4, 'Monday', '14', '15', '19', '15', 1),
(2, 4, 2, 4, 'Wednesday', '12', '30', '16', '30', 1),
(3, 4, 2, 4, 'Friday', '16', '00', '20', '30', 1),
(4, 11, 1, 11, 'Thursday', '8', '45', '13', '45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `c_id` int(11) NOT NULL,
  `c_code` varchar(40) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `level` varchar(40) NOT NULL,
  `dept` int(11) NOT NULL,
  `valid` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`c_id`, `c_code`, `c_name`, `level`, `dept`, `valid`, `active`) VALUES
(1, 'COMP001', 'Advanced Software Engineering Topics', 'Masters', 1, 1, 0),
(2, 'COMP002', 'Advanced Computing Concepts', 'Masters', 1, 1, 0),
(3, 'MECH001', 'Fundamentals of Fluid Mechanics', 'Masters', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_c_list`
--

CREATE TABLE `tbl_c_list` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_c_list`
--

INSERT INTO `tbl_c_list` (`id`, `c_id`, `p_id`, `valid`) VALUES
(1, 1, 4, 1),
(2, 2, 3, 1),
(3, 2, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dept`
--

CREATE TABLE `tbl_dept` (
  `d_id` int(11) NOT NULL,
  `d_no` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dept`
--

INSERT INTO `tbl_dept` (`d_id`, `d_no`, `d_name`) VALUES
(1, 1, 'Computer Science'),
(2, 2, 'Mechnical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail`
--

CREATE TABLE `tbl_detail` (
  `detail_id` int(40) NOT NULL,
  `login_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `dept` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail`
--

INSERT INTO `tbl_detail` (`detail_id`, `login_id`, `name`, `dob`, `gender`, `address`, `profile_pic`, `dept`, `valid`) VALUES
(1, 0, '', '0000-00-00', '', '', 'photos/Default.png', 0, 0),
(2, 2, 'Parth Kamani', '1997-08-08', 'Male', 'Windsor', 'photos/Default.png', 1, 1),
(3, 3, 'Urvish Tank', '1997-05-29', 'Male', 'windsor', 'photos/Default.png', 1, 1),
(4, 4, 'Riya Patel', '1997-09-24', 'Female', 'windsor', 'photos/Default.png', 1, 1),
(5, 5, 'Abhinand Pandya', '1997-12-15', 'Male', 'windsor', 'photos/Default.png', 1, 1),
(6, 6, 'Jaimin', '1997-01-31', 'Male', 'windsor', 'photos/Default.png', 1, 1),
(8, 11, 'Krutika', '1995-07-28', 'Female', 'Windsor, Ontario, CA', 'photos/Default.png', 1, 1),
(9, 12, 'Kishan', '1996-06-17', 'Male', 'Windsor', 'photos/Default.png', 1, 1),
(10, 13, 'Rahul', '1997-02-25', 'Male', 'Windsor, Ontario, Ca', 'photos/Default.png', 1, 1),
(18, 21, 'Ramesh', '1997-02-25', 'Male', 'Windsor', 'photos/Default.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `faq_id` int(11) NOT NULL,
  `p_type` varchar(30) NOT NULL,
  `problem` varchar(200) NOT NULL,
  `solution` varchar(200) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `upvote` int(11) NOT NULL,
  `downvote` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`faq_id`, `p_type`, `problem`, `solution`, `added_by`, `date`, `upvote`, `downvote`, `valid`) VALUES
(1, 'General', 'Open hours for CAW Student Center Cafeteria?', 'Timing: 09:00 A.M to 05:00 P.M', '2', '2020-03-14', 2, 0, 1),
(2, 'General', 'How to Login into Wi-fi?', 'Connect to Open available wi-fi network in campus and login with UWinsite login credentials.', '2', '2020-03-14', 5, 0, 1),
(8, 'Academic', 'What is Software Engineering?', 'Software engineering is the systematic application of engineering approaches to the development of software. Software engineering is a sub-field of computing science.', '11', '2020-04-17', 0, 0, 1),
(12, 'Academic', 'What is Software Testing?', 'Software testing is an investigation conducted to provide stakeholders with information about the quality of the software product or service under test.', '11', '2020-04-17', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `phone_no` bigint(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `email_id`, `phone_no`, `password`, `type`, `active`) VALUES
(1, '', 0, '', 0, 0),
(2, 'parth@gmail.com', 5199956283, 'admin@1234', 0, 1),
(3, 'urvish@gmail.com', 5199983745, 'admin@1234', 1, 1),
(4, 'riya@gmail.com', 5198789032, 'admin@1234', 2, 1),
(5, 'abhi@gmail.com', 5194638245, 'admin@1234', 3, 1),
(6, 'jaimin@gmail.com', 5192765389, 'admin@1234', 0, 1),
(11, 'krutika@gmail.com', 8798767875, 'admin@12345', 1, 1),
(12, 'kishan@gmail.com', 9876567898, 'admin@1234', 3, 1),
(13, 'rahul@gmail.com', 5723451679, 'admin@1234', 2, 1),
(21, 'ramesh@gmail.com', 5728231679, 'admin@1234', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supp`
--

CREATE TABLE `tbl_supp` (
  `s_id` int(11) NOT NULL,
  `problem` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `s_date` date NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supp`
--

INSERT INTO `tbl_supp` (`s_id`, `problem`, `added_by`, `s_date`, `valid`) VALUES
(1, 'test', 11, '2020-04-16', 0),
(2, 'test', 11, '2020-04-16', 0),
(3, 'test11', 11, '2020-04-16', 0),
(11, 'Adding Appointment Issue.', 5, '2020-04-17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_app`
--
ALTER TABLE `tbl_app`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `tbl_appsche`
--
ALTER TABLE `tbl_appsche`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_c_list`
--
ALTER TABLE `tbl_c_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tbl_detail`
--
ALTER TABLE `tbl_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_supp`
--
ALTER TABLE `tbl_supp`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_app`
--
ALTER TABLE `tbl_app`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_appsche`
--
ALTER TABLE `tbl_appsche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_c_list`
--
ALTER TABLE `tbl_c_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_detail`
--
ALTER TABLE `tbl_detail`
  MODIFY `detail_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_supp`
--
ALTER TABLE `tbl_supp`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
