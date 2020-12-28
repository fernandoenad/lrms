-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 06:27 AM
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
-- Database: `lrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--
-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `con_id` int(11) NOT NULL,
  `con_cou_id` int(11) NOT NULL,
  `con_title` varchar(100) NOT NULL,
  `con_description` text NOT NULL,
  `con_attachment` varchar(100) NOT NULL,
  `con_datefrom` date NOT NULL,
  `con_dateto` date NOT NULL,
  `con_sort` int(11) NOT NULL,
  `con_display` int(11) NOT NULL,
  `con_per_id` int(11) NOT NULL,
  `con_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--
-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cou_id` int(11) NOT NULL,
  `cou_cat_id` int(11) NOT NULL,
  `cou_name` varchar(100) NOT NULL,
  `cou_per_id` int(11) NOT NULL,
  `cou_sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--
-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `dow_id` int(11) NOT NULL,
  `dow_con_id` int(11) NOT NULL,
  `dow_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `download`
--
-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_info`) VALUES
('a:10:{i:0;s:31:\"Schools Division Office - Bohol\";i:1;s:9:\"SDO Bohol\";i:2;s:24:\"deped.bohol@deped.gov.ph\";i:3;s:26:\"https://www.depedbohol.org\";i:4;s:22:\"0050 Lino Chatto Drive\";i:5;s:0:\"\";i:6;s:14:\"Cogon District\";i:7;s:10:\"Tagbilaran\";i:8;s:5:\"Bohol\";i:9;s:27:\"Region VII, Central Visayas\";}');
-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `per_id` int(11) NOT NULL,
  `per_fname` varchar(100) NOT NULL,
  `per_lname` varchar(100) NOT NULL,
  `per_uname` varchar(50) NOT NULL,
  `per_pword` varchar(50) NOT NULL,
  `per_role` int(11) NOT NULL,
  `per_status` int(11) NOT NULL DEFAULT 1,
  `per_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`per_id`, `per_fname`, `per_lname`, `per_uname`, `per_pword`, `per_role`, `per_status`, `per_datetime`) VALUES
(1, 'LRMS', 'Admin', 'lrms.admin', '297d1e319d0203ded8d074d53ca0e61e', 1, 1, NOW());

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `cou_id` (`con_cou_id`) USING BTREE,
  ADD KEY `per_id` (`con_per_id`) USING BTREE;

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cou_id`),
  ADD KEY `cat_id` (`cou_cat_id`) USING BTREE,
  ADD KEY `per_id` (`cou_per_id`) USING BTREE;

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`dow_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`per_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `dow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
