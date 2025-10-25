-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2024 at 04:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian_obat`
--

CREATE TABLE `tbl_antrian_obat` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `no_antrian` smallint NOT NULL,
  `jam_ambil` time NOT NULL,
  `jam_panggil` time DEFAULT NULL,
  `status_panggil` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_antrian_obat`
--

INSERT INTO `tbl_antrian_obat` (`id`, `tanggal`, `no_antrian`, `jam_ambil`, `jam_panggil`, `status_panggil`) VALUES
(1, '2024-08-03', 1, '11:48:43', NULL, 'N'),
(2, '2024-08-03', 2, '11:48:50', '11:49:06', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth`
--

CREATE TABLE `tbl_auth` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_auth`
--

INSERT INTO `tbl_auth` (`id`, `username`, `password`, `remember_token`) VALUES
(1, 'admin_antrian_rs', '$2y$10$Nr6MQkYLAE.UWjAH2cmV4.kIe4WkfFpKn2yvu9ZQilLTZQGBsCBV6', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_antrian_obat`
--
ALTER TABLE `tbl_antrian_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_antrian_obat`
--
ALTER TABLE `tbl_antrian_obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
