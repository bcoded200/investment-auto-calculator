-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 12:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `amount_invested` int(50) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `earned_amount` int(50) NOT NULL,
  `date_invested` datetime(6) NOT NULL,
  `end_date` datetime(6) NOT NULL,
  `total_return` int(50) NOT NULL,
  `expected_return` int(50) NOT NULL,
  `nextprofit_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `amount_invested`, `plan_name`, `earned_amount`, `date_invested`, `end_date`, `total_return`, `expected_return`, `nextprofit_date`) VALUES
(4, 200, 'TEST', 8, '2022-05-30 03:00:38.000000', '2022-06-04 12:00:00.000000', 0, 40, '2022-05-31 08:46:13.000000'),
(5, 500, 'BASIC', 24, '2022-05-30 03:08:10.000000', '2022-06-11 12:00:00.000000', 0, 144, '2022-05-31 03:49:22.000000'),
(6, 4000, 'SILVER', 140, '2022-05-30 03:08:26.000000', '2022-06-09 12:00:00.000000', 0, 1400, '2022-05-31 08:44:11.000000'),
(7, 12000, 'PREMIUM', 2160, '2022-05-30 03:08:48.000000', '2022-06-14 12:00:00.000000', 0, 10800, '2022-05-31 08:56:46.000000'),
(8, 45000, 'GOLD', 4500, '2022-05-30 03:09:13.000000', '2022-06-17 12:00:00.000000', 0, 81000, '2022-05-31 03:44:24.000000'),
(11, 100000, 'PROCESSOR-BASED', 16000, '2022-05-30 03:12:20.000000', '2022-06-21 12:00:00.000000', 0, 176000, '2022-05-31 08:54:45.000000');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(20) NOT NULL,
  `bundle` varchar(200) DEFAULT NULL,
  `plan` varchar(100) DEFAULT NULL,
  `minimium` int(20) DEFAULT NULL,
  `maximium` int(100) DEFAULT NULL,
  `percentage` varchar(20) DEFAULT NULL,
  `referal_bonus` varchar(20) DEFAULT NULL,
  `commission` varchar(100) DEFAULT NULL,
  `main_fee` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `payout` varchar(20) DEFAULT NULL,
  `th` varchar(200) DEFAULT NULL,
  `no_of_times` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `bundle`, `plan`, `minimium`, `maximium`, `percentage`, `referal_bonus`, `commission`, `main_fee`, `duration`, `payout`, `th`, `no_of_times`) VALUES
(12, 'BASIC', 'Mining', 500, 3999, '2.5', '5', '0', '0', '12 Days', '1 day', '10 TH/S - 35 TH/S', '5'),
(13, 'SILVER', 'Mining', 4000, 11999, '3.5', '5', '0', '0', '10 Days', '1 day', '10 TH/S - 35 TH/S', '10'),
(14, 'PREMIUM', 'Mining', 12000, 44999, '6', '6.5', '0', '0', '15 Days', '1 day', '10 TH/S - 35 TH/S', '13'),
(15, 'GOLD', 'Mining', 45000, 200000, '10', '8', '0', '0', '18 Days', '1 day', '10 TH/S - 35 TH/S', '18'),
(24, 'PROCESSOR-BASED', 'Trading', 100000, 499999, '8', '10', '0', '0', '22 Days', '1 day', '10 TH/S - 35 TH/S', '21'),
(25, 'TEST', 'Mining', 200, 200, '4', '3', '0', '0', '5 Days', '1 day', '10 TH/S - 35 TH/S', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
