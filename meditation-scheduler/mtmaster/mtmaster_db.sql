-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: june 06, 2022 at 06:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtmaster_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mt_table`
--

CREATE TABLE `mt_table` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(10) NOT NULL,
  `is_completed` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_table`
--

INSERT INTO `mt_table` (`id`, `name`, `date`, `time`, `is_completed`) VALUES
(4, 'Sammy', '2020-08-06', '10 Mins', '0'),
(5, 'Sam', '2020-08-25', '10 Mins', '0'),
(6, 'Abhi', '2020-08-08', '2 Hours', '0'),
(7, 'Rajesh', '2020-08-29', '1 Hour', '0');

-- --------------------------------------------------------

--
-- Table structure for table `time_dropdown_values`
--

CREATE TABLE `time_dropdown_values` (
  `id` int(11) NOT NULL,
  `time_value` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_dropdown_values`
--

INSERT INTO `time_dropdown_values` (`id`, `time_value`) VALUES
(1, '5 Mins'),
(2, '10 Mins'),
(3, '15 Mins'),
(4, '30 Mins'),
(5, '1 Hour'),
(6, '2 Hours');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mt_table`
--
ALTER TABLE `mt_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_dropdown_values`
--
ALTER TABLE `time_dropdown_values`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mt_table`
--
ALTER TABLE `mt_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `time_dropdown_values`
--
ALTER TABLE `time_dropdown_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
