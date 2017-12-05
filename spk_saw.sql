-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2017 at 06:12 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jab` int(11) NOT NULL,
  `kode_jabatan` varchar(10) NOT NULL,
  `nama_jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jab`, `kode_jabatan`, `nama_jabatan`) VALUES
(1, 'Jab_001', 'Human Resource Departement');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_saw`
--

CREATE TABLE `kriteria_saw` (
  `id_kriteria_SAW` int(11) NOT NULL,
  `kode_kriteria_SAW` varchar(2) NOT NULL,
  `kriteria_SAW` text NOT NULL,
  `bobot_kriteria_SAW` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_saw`
--

INSERT INTO `kriteria_saw` (`id_kriteria_SAW`, `kode_kriteria_SAW`, `kriteria_SAW`, `bobot_kriteria_SAW`) VALUES
(1, 'C1', 'Inovasi dan Orisinilitas Produk', 0.3),
(2, 'C2', 'Potensi Pasar/Peluang Pasar ', 0.3),
(3, 'C3', 'Proses Produksi ', 0.2),
(4, 'C4', 'Organisasi', 0.15),
(6, 'te', 'testing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nim` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tanggal_lahir` varchar(30) NOT NULL,
  `jabatan` varchar(55) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` int(5) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nim`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `jabatan`, `password`, `hak_akses`) VALUES
(1, 'staff', 'Kusnadi', 'Laki-Laki', '25-04-2017', 'Ilmu Komputer', '1253208465b1efa876f982d8a9e73eef', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jab`);

--
-- Indexes for table `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  ADD PRIMARY KEY (`id_kriteria_SAW`),
  ADD KEY `kode_kriteria_WP` (`kode_kriteria_SAW`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  MODIFY `id_kriteria_SAW` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
