-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 11:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `id` int(11) NOT NULL,
  `user` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acno` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountholdername` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branchname` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsccode` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forcompany` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scancopy` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`id`, `user`, `bankid`, `acno`, `accountholdername`, `branchname`, `ifsccode`, `userid`, `type`, `forcompany`, `scancopy`, `created_at`, `updated_at`) VALUES
(1, NULL, '1', '32500100003959', NULL, 'BHUBANESWAR', 'BARB0CUTTRD', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:50:13', '2020-03-13 10:50:13'),
(2, NULL, '1', '33670100000527', NULL, 'BHAWANIPATNA', 'BARB0BHAWAN', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:51:42', '2020-03-13 10:51:42'),
(3, NULL, '3', '600202010004754', NULL, 'BHAWANIPATNA', 'UBIN0560022', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:52:52', '2020-03-13 10:52:52'),
(4, NULL, '2', '30949422251', NULL, 'BHUBANESHWAR', 'SBIN0010930', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:53:41', '2020-03-13 10:53:41'),
(5, NULL, '4', '913010019409151', NULL, 'BHUBANESWAR', 'UTIB0000024', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:54:30', '2020-03-13 10:54:30'),
(6, NULL, '1', '33670200000058', NULL, 'BHAWANIPATNA', 'BARB0BHAWAN', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:55:44', '2020-03-13 10:55:44'),
(7, NULL, '2', '30949604728', NULL, 'BHUBANESHWAR', 'SBIN0010930', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:56:38', '2020-03-13 10:56:38'),
(8, NULL, '1', '33670500000207', NULL, 'BHAWANIPATNA', 'BARB0BHAWAN', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:57:29', '2020-03-13 10:57:29'),
(9, NULL, '1', '32500200000233', NULL, 'BHUBANESHWAR', 'BARB0CUTTRD', '1', 'COMPANY', NULL, NULL, '2020-03-13 10:59:46', '2020-03-13 10:59:46'),
(10, NULL, '3', '600201010050058', NULL, 'BHAWANIPATNA', 'UBIN0560022', '1', 'COMPANY', NULL, NULL, '2020-03-13 11:00:29', '2020-03-13 11:00:29'),
(11, NULL, '1', '123456', 'subham3', 'bbsr1', '123456', '1', 'COMPANY', NULL, '1590988242.Screenshot (5).png', '2020-06-01 05:10:42', '2020-06-01 05:16:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
