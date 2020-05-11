-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 07:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `projectotherdocuments`
--

CREATE TABLE `projectotherdocuments` (
  `id` int(11) NOT NULL,
  `project_id` varchar(20) DEFAULT NULL,
  `documentname` varchar(50) DEFAULT NULL,
  `document` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectotherdocuments`
--

INSERT INTO `projectotherdocuments` (`id`, `project_id`, `documentname`, `document`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '153', 'ff', '15891726691277674245eb8d9bdb6db5logo1.png', '2020-05-11 04:51:09', '2020-05-11 05:03:45', '2020-05-11 05:03:45'),
(4, '153', 'a', '158917401910797706645eb8df034639davatar.png', '2020-05-11 05:13:39', '2020-05-11 05:13:39', NULL),
(5, '153', 'ff', '158917405817396464645eb8df2a149a5logo1.png', '2020-05-11 05:14:18', '2020-05-11 05:14:39', '2020-05-11 05:14:39'),
(6, '153', 'com', '158917417214300348575eb8df9c431e6logo1.png', '2020-05-11 05:16:12', '2020-05-11 05:16:12', NULL),
(7, '153', 'doc', '158917424914807266325eb8dfe9277beavatar.png', '2020-05-11 05:17:29', '2020-05-11 05:18:31', '2020-05-11 05:18:31'),
(8, '153', 'hu', '15891744189911612845eb8e092d4797avatar.png', '2020-05-11 05:20:18', '2020-05-11 05:20:36', '2020-05-11 05:20:36'),
(9, '153', 'document1', '158917454511764787095eb8e1112a6e7bg-04.jpg', '2020-05-11 05:22:25', '2020-05-11 05:22:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projectotherdocuments`
--
ALTER TABLE `projectotherdocuments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projectotherdocuments`
--
ALTER TABLE `projectotherdocuments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
