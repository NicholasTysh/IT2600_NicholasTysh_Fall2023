-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2021 at 02:42 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it1150`
--

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `user_id` varchar(45) NOT NULL,
  `crn` varchar(45) NOT NULL,
  `semester` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `crn` varchar(45) NOT NULL,
  `course_id` varchar(45) DEFAULT NULL,
  `semester` varchar(45) NOT NULL,
  `room` varchar(45) DEFAULT NULL,
  `days` varchar(45) DEFAULT NULL,
  `times` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
-- Updated with working data
--

INSERT INTO `sections` (`crn`, `course_id`, `semester`, `room`, `days`, `times`) VALUES
('11301', 'IT-2700', 'Spring 2025', 'D205', 'W', '900-1050'),
('12175', 'IT-2351', 'Spring 2024', 'D205', 'T', '1000-1150'),
('12375', 'IT-1150', 'Fall 2022', 'D207', 'M', '1030-1145'),
('12378', 'IT-2320', 'Spring 2024', 'D205', 'R', '1000-1150'),
('12382', 'IT-2650', 'Summer 2024', 'D205', 'MW', '1300-1515'),
('12383', 'IT-2660', 'Spring 2024', 'D205', 'MWF', '1300-1515'),
('13226', 'IT-2080', 'Spring 2024', 'GT 205', 'TR', '900-1050'),
('13227', 'IT-1080', 'Spring 2024', 'GT 205', 'MW', '900-1050'),
('13229', 'IT-1200', 'Spring 2026', 'GT 205', 'TR', '1100-1250'),
('13230', 'IT-2090', 'Fall 2025', 'GT 205', 'MW', '1100-1250'),
('13231', 'IT-2100', 'Spring 2024', 'GT 213', 'TR', '1300-1450'),
('13232', 'IT-1050', 'Spring 2024', 'GT 205', 'W', '1800-2050'),
('13233', 'IT-2110', 'Spring 2024', 'GT 205', 'MW', '1300-1450'),
('13234', 'IT-2200', 'Spring 2024', 'GT 205', 'M', '1500-1750'),
('13235', 'IT-2600', 'Spring 2024', 'GT 205', 'TR', '1400-1550'),
('13237', 'IT-2030', 'Spring 2024', 'GT 213', 'TR', '1000-1150'),
('13469', 'IT-1050', 'Spring 2024', 'D205', 'M', '1000-1150'),
('13470', 'IT-1050', 'Spring 2024', 'D205', 'MW', '1800-1950'),
('13853', 'IT-1025', 'Spring 2024', 'D205', 'M', '900-1015'),
('13854', 'IT-1025', 'Spring 2024', 'D205', 'MWF', '1800-1950');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`user_id`,`crn`,`semester`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`crn`,`semester`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

