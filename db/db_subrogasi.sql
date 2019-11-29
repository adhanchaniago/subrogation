-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 04:59 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_username` varchar(25) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_name` varchar(40) NOT NULL,
  `admin_level` varchar(15) NOT NULL,
  `admin_created` datetime NOT NULL,
  `admin_session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_password`, `admin_name`, `admin_level`, `admin_created`, `admin_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', '2017-07-28 05:22:21', 'u7ch39os9ge3pbkt45g3ev2616'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'user', '2017-07-28 16:19:02', '2ceet7ckhu493lhb96nb1feos5');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_cabang` varchar(50) NOT NULL,
  `bank_kcp` varchar(50) NOT NULL,
  `categorybank_id` int(11) NOT NULL,
  `bank_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_cabang`, `bank_kcp`, `categorybank_id`, `bank_created`) VALUES
(3, 'Cabang Bandar Jaya', 'Bandar Jaya', 3, '2017-07-29 06:38:47'),
(4, 'Cabang Sukabumi', 'Sukabumi', 3, '2017-07-29 07:29:52'),
(5, 'Cabang Braga', 'Cabang Braga', 4, '2017-07-30 08:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `categorybank`
--

CREATE TABLE `categorybank` (
  `categorybank_id` int(11) NOT NULL,
  `categorybank_name` varchar(50) NOT NULL,
  `categorybank_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorybank`
--

INSERT INTO `categorybank` (`categorybank_id`, `categorybank_name`, `categorybank_created`) VALUES
(3, 'PT. Bank Rakyat Indonesia (Persero)', '2017-07-29 06:38:22'),
(4, 'PT. BJB Syariah', '2017-07-30 08:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `debitur`
--

CREATE TABLE `debitur` (
  `debitur_id` int(11) NOT NULL,
  `debitur_name` varchar(35) NOT NULL,
  `debitur_notelp` varchar(12) NOT NULL,
  `debitur_address` varchar(255) NOT NULL,
  `debitur_gender` varchar(25) NOT NULL,
  `debitur_age` int(11) NOT NULL,
  `debitur_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debitur`
--

INSERT INTO `debitur` (`debitur_id`, `debitur_name`, `debitur_notelp`, `debitur_address`, `debitur_gender`, `debitur_age`, `debitur_created`) VALUES
(3, 'Ali Abdul Wahid', '081320471970', 'Cibiru Asri', 'Pria', 20, '2017-07-29 06:37:54'),
(4, 'Siti', '08123456789', 'Cimahi', 'Wanita', 19, '2017-07-30 08:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(3) NOT NULL,
  `identitas_website` varchar(250) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_alamat` varchar(250) NOT NULL,
  `identitas_notelp` char(20) NOT NULL,
  `identitas_favicon` varchar(250) NOT NULL,
  `identitas_author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_alamat`, `identitas_notelp`, `identitas_favicon`, `identitas_author`) VALUES
(1, 'Subrogasi', 'Subrogasi - Jamkrindo', 'subrogasi, jamkrindo, website, php', 'Indonesia', '0812345689', '658569jamkrindo.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `jamkrindo`
--

CREATE TABLE `jamkrindo` (
  `jamkrindo_id` int(11) NOT NULL,
  `jamkrindo_norek` varchar(40) NOT NULL,
  `jamkrindo_created` datetime NOT NULL,
  `bank_id` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jamkrindo`
--

INSERT INTO `jamkrindo` (`jamkrindo_id`, `jamkrindo_norek`, `jamkrindo_created`, `bank_id`) VALUES
(0, 'zzzzzzzzzz', '2017-08-15 18:04:46', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_created`) VALUES
(5, 'Kredit Usaha Rakyat', '2017-07-29 06:39:21'),
(6, 'Kredit Mikro', '2017-07-30 08:30:38'),
(7, 'Kredit Umum', '2017-07-30 08:30:44');

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

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `tindakan_id` int(11) NOT NULL,
  `subrogasi_id` int(11) NOT NULL,
  `tindakan_jenis` varchar(255) NOT NULL,
  `tindakan_hasil` varchar(255) NOT NULL,
  `tindakan_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`tindakan_id`, `subrogasi_id`, `tindakan_jenis`, `tindakan_hasil`, `tindakan_created`) VALUES
(4, 13, 'Mengajukan Permohonan eksekusi ke bank', 'Permohonan Eksekusi', '2017-07-30 08:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `subrogasi_id` int(11) NOT NULL,
  `transaksi_sumberpenerimaan` varchar(30) NOT NULL,
  `transaksi_jenispenerimaan` varchar(30) NOT NULL,
  `transaksi_norekjamkrindo` varchar(50) NOT NULL,
  `transaksi_namarekjamkrindo` varchar(50) NOT NULL,
  `transaksi_bankjamkrindo` int(11) NOT NULL,
  `transaksi_norekbank` varchar(50) NOT NULL,
  `transaksi_namarekbank` varchar(50) NOT NULL,
  `transaksi_bank` int(11) NOT NULL,
  `transaksi_jumlah` int(20) NOT NULL,
  `transaksi_nobukti` varchar(50) NOT NULL,
  `transaksi_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `subrogasi_id`, `transaksi_sumberpenerimaan`, `transaksi_jenispenerimaan`, `transaksi_norekjamkrindo`, `transaksi_namarekjamkrindo`, `transaksi_bankjamkrindo`, `transaksi_norekbank`, `transaksi_namarekbank`, `transaksi_bank`, `transaksi_jumlah`, `transaksi_nobukti`, `transaksi_created`) VALUES
(10, 12, 'Angsuran', 'Transfer', '512345678', 'Jamkrindo', 4, '598765432', 'Asep', 5, 5000000, '5170502003515', '2017-07-30 08:35:16'),
(11, 12, 'Angsuran', 'Transfer', '512345678', 'Jamkrindo', 3, '58765432', 'Asep', 5, 2500000, '5120502003045', '2017-07-30 08:36:10'),
(12, 12, 'Angsuran', 'Transfer', '512345678', 'Jamkrindo', 4, '587665432', 'Asep', 5, 2500000, '5320201011462', '2017-07-30 08:36:52'),
(13, 13, 'Angsuran', 'Transfer', '512345678', 'Jamkrindo', 4, '598765432', 'ASep', 5, 1000000, '5310502002223', '2017-07-30 08:38:19'),
(14, 13, 'Angsuran', 'Transfer', '512345678', 'Jamkrindo', 4, '58765432', 'Asep', 5, 500000, '5170502003515', '2017-07-30 08:38:53'),
(15, 13, 'Angsuran', 'Transfer', '', 'Perum Jamkrindo', 5, 'zzzzzzzzzz', 'aaaaaaaaa', 3, 500000, '1212', '2017-08-15 18:37:49'),
(16, 13, 'Angsuran', 'Transfer', 'zzzzzzzzzz', 'Perum Jamkrindo', 5, 'werwrw', 'rwrew', 3, 1000, '1212', '2017-08-15 18:39:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `categorybank`
--
ALTER TABLE `categorybank`
  ADD PRIMARY KEY (`categorybank_id`);

--
-- Indexes for table `debitur`
--
ALTER TABLE `debitur`
  ADD PRIMARY KEY (`debitur_id`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `jamkrindo`
--
ALTER TABLE `jamkrindo`
  ADD PRIMARY KEY (`jamkrindo_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `subrogasi`
--
ALTER TABLE `subrogasi`
  ADD PRIMARY KEY (`subrogasi_id`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`tindakan_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categorybank`
--
ALTER TABLE `categorybank`
  MODIFY `categorybank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `debitur`
--
ALTER TABLE `debitur`
  MODIFY `debitur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `identitas_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subrogasi`
--
ALTER TABLE `subrogasi`
  MODIFY `subrogasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `tindakan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
