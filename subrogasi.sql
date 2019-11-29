-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2017 at 04:13 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_subrogasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `subrogasi`
--

CREATE TABLE `subrogasi` (
  `subrogasi_id` int(11) NOT NULL,
  `subrogasi_nosp` varchar(50) NOT NULL,
  `subrogasi_sisapiutang` int(20) NOT NULL,
  `subrogasi_totalpiutang` int(20) NOT NULL,
  `subrogasi_SKIM` varchar(40) NOT NULL,
  `subrogasi_sertifikat` varchar(100) NOT NULL,
  `subrogasi_tglklaim` datetime NOT NULL,
  `debitur_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `subrogasi_agunan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subrogasi`
--

INSERT INTO `subrogasi` (`subrogasi_id`, `subrogasi_nosp`, `subrogasi_sisapiutang`, `subrogasi_totalpiutang`, `subrogasi_SKIM`, `subrogasi_sertifikat`, `subrogasi_tglklaim`, `debitur_id`, `bank_id`, `product_id`, `subrogasi_agunan`) VALUES
(12, '5310502002223', 0, 10000000, 'ARRUM', 'MTG 2013 03.0 2 06457', '2017-07-30 08:32:10', 3, 3, 5, 0),
(16, 'asda', 0, 0, 'KREASI', 'dasdas', '2017-08-15 16:39:02', 3, 4, 6, 9),
(17, 'asasda', 0, 0, 'MKR', 'dasdad', '2017-08-15 16:39:21', 4, 3, 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subrogasi`
--
ALTER TABLE `subrogasi`
  ADD PRIMARY KEY (`subrogasi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subrogasi`
--
ALTER TABLE `subrogasi`
  MODIFY `subrogasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
