-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 06:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` char(5) NOT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  `nama` varchar(80) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_penerbit` char(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kategori`, `nama`, `harga`, `stok`, `id_penerbit`, `created_at`) VALUES
('B1001', 'Bisnis', 'Bisnis Online', 75000, 9, 'SP01', '2025-07-15 04:03:40'),
('B1002', 'Bisnis', 'Etika Bisnis dan Tanggung Jawab Sosial', 67500, 20, 'SP01', '2025-07-15 04:03:40'),
('K1001', 'Keilmuan', 'Analisis & Perancangan Sistem Informasi', 50000, 60, 'SP01', '2025-07-15 04:03:40'),
('K1002', 'Keilmuan', 'Artifical Intelligence', 45000, 60, 'SP01', '2025-07-15 04:03:40'),
('K2003', 'Keilmuan', 'Autocad 3 Dimensi', 40000, 25, 'SP01', '2025-07-15 04:03:40'),
('K3004', 'Keilmuan', 'Cloud Computing Technology', 85000, 15, 'SP01', '2025-07-15 04:03:40'),
('N1001', 'Novel', 'Cahaya Di Penjuru Hati', 68000, 10, 'SP02', '2025-07-15 04:03:40'),
('N1002', 'Novel', 'Aku Ingin Cerita', 48000, 12, 'SP03', '2025-07-15 04:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` char(4) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama`, `alamat`, `kota`, `telepon`) VALUES
('SP01', 'Penerbit Informatika', 'Jl. Buah Batu No. 121', 'Bandung', '0813-2220-1946'),
('SP02', 'Andi Offset', 'Jl. Suryalaya IX No.3', 'Bandung', '0878-3903-0688'),
('SP03', 'Danendra', 'Jl Moch. Toha 44', 'Bandung', '022-5201215');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `fk_penerbit` (`id_penerbit`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
