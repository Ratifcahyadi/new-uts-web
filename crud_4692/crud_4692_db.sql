-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 02:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_4692_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(5) NOT NULL,
  `kd_mk` int(11) NOT NULL,
  `nm_mk` varchar(64) NOT NULL,
  `ds_mk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `kd_mk`, `nm_mk`, `ds_mk`) VALUES
(7, 31, 'Bahasa Indonesia', 'Membawa KBBI Edisi Terbaru'),
(8, 34, 'Matematika', 'Belajar Kalkulus'),
(9, 73, 'Jaringan Kompoter', 'Membawa Tang Crimping dan LAN Tester'),
(10, 16, 'Bahasa Inggris', 'Create A Result Paper');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(5) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(255) NOT NULL,
  `materi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `kode`, `nama`, `tanggal`, `judul`, `materi`) VALUES
(23, 31, 'Bahasa Indonesia', '2022-11-20', 'Kalimat Efektif', 'Pertemuan-7-Kalimat Efektif.pdf'),
(24, 73, 'Jaringan Kompoter', '2022-11-13', 'logical-and-physical-mode-exploration', '1.0.5-packet-tracer---logical-and-physical-mode-exploration.pdf'),
(25, 73, 'Jaringan Kompoter', '2022-11-14', 'network-representation', '1.5.7-packet-tracer---network-representation.pdf'),
(32, 16, 'Bahasa Inggris', '2022-11-15', 'BARE INFINITIVE', 'BARE INFINITIVE (DT016).pdf'),
(33, 16, 'Bahasa Inggris', '2022-11-16', 'Gerund', 'Gerund (DT016).pdf'),
(34, 16, 'Bahasa Inggris', '2022-11-17', 'TO-INFINITIVE', 'TO-INFINITIVE (DT016).pdf'),
(35, 16, 'Bahasa Inggris', '2022-11-18', 'VERB PHRASE', 'VERB PHRASE (DT016).pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
