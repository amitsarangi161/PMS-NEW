-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 11:37 AM
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
-- Table structure for table `openingbalances`
--

CREATE TABLE `openingbalances` (
  `id` int(11) NOT NULL,
  `bankid` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `openingbalances`
--

INSERT INTO `openingbalances` (`id`, `bankid`, `date`, `amount`, `created_at`, `updated_at`) VALUES
(1, '1', '2020-06-17', '3000', '2020-06-01 06:04:29', '2020-06-01 06:04:29'),
(2, '8', '2020-06-19', '4000', '2020-06-01 06:04:52', '2020-06-01 06:04:52'),
(3, '1', '2020-06-17', '3000', '2020-06-01 06:29:18', '2020-06-01 06:29:18'),
(4, '11', '2020-06-17', '5000', '2020-06-01 06:46:29', '2020-06-01 06:46:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `openingbalances`
--
ALTER TABLE `openingbalances`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `openingbalances`
--
ALTER TABLE `openingbalances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
