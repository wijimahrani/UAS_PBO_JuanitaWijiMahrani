-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 02:59 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1b_juanitawijimahrani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(10,2) NOT NULL,
  `jenis_karyawan` enum('Kontrak','Tetap','Magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(12,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(12,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
(1, 'Andi Saputra', 'IT', 22, 250000.00, 'Kontrak', 12, 'PT Sumber Daya', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'HRD', 20, 220000.00, 'Kontrak', 6, 'PT Talenta', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', 'Keuangan', 21, 240000.00, 'Kontrak', 12, 'PT Mitra Kerja', NULL, NULL, NULL, NULL),
(4, 'Deni Pratama', 'Produksi', 24, 230000.00, 'Kontrak', 18, 'PT Outsource Nusantara', NULL, NULL, NULL, NULL),
(5, 'Eka Wulandari', 'Marketing', 22, 245000.00, 'Kontrak', 12, 'PT Talenta', NULL, NULL, NULL, NULL),
(6, 'Farhan Akbar', 'IT', 20, 260000.00, 'Kontrak', 24, 'PT Sumber Daya', NULL, NULL, NULL, NULL),
(7, 'Gina Putri', 'Gudang', 25, 210000.00, 'Kontrak', 6, 'PT Mitra Kerja', NULL, NULL, NULL, NULL),
(8, 'Hendra Wijaya', 'IT', 22, 350000.00, 'Tetap', NULL, NULL, 1500000.00, 'OS001', NULL, NULL),
(9, 'Indah Permata', 'Keuangan', 21, 340000.00, 'Tetap', NULL, NULL, 1400000.00, 'OS002', NULL, NULL),
(10, 'Joko Susilo', 'HRD', 20, 330000.00, 'Tetap', NULL, NULL, 1350000.00, 'OS003', NULL, NULL),
(11, 'Kartika Dewi', 'Marketing', 22, 345000.00, 'Tetap', NULL, NULL, 1450000.00, 'OS004', NULL, NULL),
(12, 'Lukman Hakim', 'Produksi', 24, 355000.00, 'Tetap', NULL, NULL, 1550000.00, 'OS005', NULL, NULL),
(13, 'Maya Sari', 'IT', 21, 360000.00, 'Tetap', NULL, NULL, 1600000.00, 'OS006', NULL, NULL),
(14, 'Nanda Putra', 'Gudang', 25, 320000.00, 'Tetap', NULL, NULL, 1300000.00, 'OS007', NULL, NULL),
(15, 'Olivia Putri', 'IT', 20, 100000.00, 'Magang', NULL, NULL, NULL, NULL, 1500000.00, 'Ya'),
(16, 'Pandu Prakoso', 'Marketing', 18, 95000.00, 'Magang', NULL, NULL, NULL, NULL, 1400000.00, 'Tidak'),
(17, 'Qori Aulia', 'HRD', 19, 90000.00, 'Magang', NULL, NULL, NULL, NULL, 1300000.00, 'Ya'),
(18, 'Rafi Nugraha', 'Keuangan', 20, 100000.00, 'Magang', NULL, NULL, NULL, NULL, 1500000.00, 'Ya'),
(19, 'Salsa Anindita', 'Produksi', 22, 110000.00, 'Magang', NULL, NULL, NULL, NULL, 1600000.00, 'Tidak'),
(20, 'Teguh Ramadhan', 'Gudang', 21, 95000.00, 'Magang', NULL, NULL, NULL, NULL, 1450000.00, 'Ya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
