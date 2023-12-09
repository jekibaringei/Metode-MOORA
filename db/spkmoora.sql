-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 09, 2023 at 12:21 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkmoora`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` varchar(25) NOT NULL,
  `nama_alternatif` varchar(80) NOT NULL,
  `c1` varchar(25) NOT NULL,
  `c2` varchar(25) NOT NULL,
  `c3` varchar(25) NOT NULL,
  `c4` varchar(25) NOT NULL,
  `c5` varchar(25) NOT NULL,
  `c6` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
('101', 'Sangra Eko', '3', '5', '3', '4', '3', '3'),
('102', 'Sumarjono', '2', '5', '3', '4', '5', '4'),
('103', 'Wahyu S', '3', '5', '5', '5', '3', '4'),
('104', 'Kirman', '2', '5', '3', '3', '3', '4'),
('105', 'Irhas', '2', '3', '3', '4', '3', '4'),
('106', 'Yustiana', '5', '3', '5', '4', '5', '4'),
('107', 'Diki', '1', '5', '1', '3', '3', '2');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `tanggal` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id`, `kode`, `tanggal`) VALUES
(2, 'k001', '08 - Dec - 2023 | 22 : 59 : 19');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(80) NOT NULL,
  `bobot` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `type`) VALUES
(1, 'Absen', '0.10', 'Cost'),
(2, 'Masa Kerja', '0.15', 'Benefit'),
(3, 'Pencapaian Kerja', '0.25', 'Benefit'),
(4, 'Kerjasama', '0.20', 'Benefit'),
(5, 'Komunikasi', '0.10', 'Benefit'),
(6, 'Tanggung Jawab', '0.20', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'user', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `kode_hasil` varchar(20) NOT NULL,
  `id_alternatif` varchar(25) NOT NULL,
  `nama_alternatif` varchar(80) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `kode_hasil`, `id_alternatif`, `nama_alternatif`, `total`) VALUES
(50, 'k001', '101', 'Sangra Eko', '0.273'),
(51, 'k001', '102', 'Sumarjono', '0.328'),
(52, 'k001', '103', 'Wahyu S', '0.367'),
(53, 'k001', '104', 'Kirman', '0.288'),
(54, 'k001', '105', 'Irhas', '0.282'),
(55, 'k001', '106', 'Yustiana', '0.316'),
(56, 'k001', '107', 'Diki', '0.206');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
