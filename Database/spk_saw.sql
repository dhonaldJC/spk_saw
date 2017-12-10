-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2017 at 10:35 AM
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
(1, 'C1', 'Absensi', 15),
(2, 'C2', 'Target Value', 25),
(3, 'C3', 'Perilaku', 30),
(4, 'C4', 'Target POM', 20),
(6, 'C5', 'Class', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nim` varchar(35) NOT NULL,
  `kode_kriteria_SAW` varchar(2) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`nim`, `kode_kriteria_SAW`, `nilai`) VALUES
('karyawan', 'C1', 1),
('karyawan', 'C2', 4),
('karyawan', 'C3', 4),
('karyawan', 'C4', 3),
('karyawan', 'C5', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nim` varchar(35) NOT NULL,
  `name` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `jabatan` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` int(5) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nim`, `name`, `jenis_kelamin`, `jabatan`, `password`, `hak_akses`) VALUES
(2, 'admin', 'Admin Sistem', 'Laki-Laki', 'Human Resource Departement', '21232f297a57a5a743894a0e4a801fc3', 1),
(4, 'testing', 'testing', '', 'Human Resource Departement', 'ae2b1fca515949e5d54fb22b8ed95575', 2),
(5, 'karyawan', 'karyawan', '', 'Human Resource Departement', '21232f297a57a5a743894a0e4a801fc3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `kdSubKriteria` int(11) NOT NULL,
  `subKriteria` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `kode_kriteria_SAW` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`kdSubKriteria`, `subKriteria`, `value`, `kode_kriteria_SAW`) VALUES
(1, '1-7 hari', 1, 'C1'),
(2, '8- 14 hari', 2, 'C1'),
(3, '15- 21 hari', 3, 'C1'),
(4, '22- 28 hari', 4, 'C1'),
(5, '77-100', 4, 'C2'),
(6, '51 -76', 3, 'C2'),
(7, '36-50', 2, 'C2'),
(8, '1-35', 1, 'C2'),
(9, 'Sangat Baik', 4, 'C3'),
(10, 'Baik', 3, 'C3'),
(11, 'Cukup', 2, 'C3'),
(12, 'Kurang', 1, 'C3'),
(13, '77-100', 4, 'C4'),
(14, '51-76', 3, 'C4'),
(15, '36-50', 2, 'C4'),
(16, '1-35', 1, 'C4'),
(17, '4-5 tahun', 4, 'C5'),
(18, '3-4 tahun', 3, 'C5'),
(19, '1-3 tahun', 2, 'C5'),
(20, '6 bulan - 1 tahun', 1, 'C5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jab`),
  ADD KEY `kode_jabatan` (`kode_jabatan`);

--
-- Indexes for table `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  ADD PRIMARY KEY (`id_kriteria_SAW`),
  ADD KEY `kode_kriteria_WP` (`kode_kriteria_SAW`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD UNIQUE KEY `indexNilai` (`nim`,`kode_kriteria_SAW`) USING BTREE,
  ADD KEY `kdKriteria` (`kode_kriteria_SAW`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`kdSubKriteria`),
  ADD KEY `kode_kriteria_SAW` (`kode_kriteria_SAW`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  MODIFY `id_kriteria_SAW` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `kdSubKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengguna` (`nim`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kode_kriteria_SAW`) REFERENCES `kriteria_saw` (`kode_kriteria_SAW`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`kode_kriteria_SAW`) REFERENCES `kriteria_saw` (`kode_kriteria_SAW`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
