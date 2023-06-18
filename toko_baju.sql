-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 03:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_baju`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `stok` enum('Tersedia','Habis') DEFAULT 'Tersedia',
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `foto`, `detail`, `harga`, `stok`, `kategori_id`) VALUES
(161, 'Kerudung Bergo', '6469ab789d440.jpeg', 'Kerudung Bergo berbagai macam model', 47000, 'Tersedia', 469),
(162, 'Kemeja Pria Hitam', '6469afdb3cc5c.jpg', 'Kemeja pria dengan bahan berkualitas dan nyaman', 135000, 'Tersedia', 470),
(163, 'V-Neck Dress', '6469b0a434dbb.jpg', 'Dress dengan model V-Neck sangat nyaman dipakai untuk acara pesta', 86000, 'Tersedia', 471),
(164, 'Kemeja Batik Motif Mega Mendung', '6469b7d1e62fe.jpeg', 'Batik Mega Mendung berkualitas dan nyaman dipakai', 85000, 'Tersedia', 470),
(165, 'Gamis Muslim Katun Medina', '6469bd32339e7.jpg', 'Gamis Muslim dengan bahan premium dan nyaman', 175000, 'Tersedia', 472),
(166, 'Kemeja Flannel Premium Pria', '6469bdce5111c.jpeg', 'Kemeja Flannel bahan premium dan lembut', 95000, 'Tersedia', 470),
(167, 'Satin Dress Korea', '6469bed433422.jpeg', 'Korean Satin Dress bahan premium dengan berbagai macam model', 73000, 'Tersedia', 471),
(168, 'Kerudung Segi Empat Premium', '64702ca8e4b88.jpg', 'Kerudung Segi Empat dengan bahan super lembut dan nyaman digunakan', 35000, 'Habis', 469),
(169, 'Gamis Polos Simpel', '6476a32d4bf11.jpg', 'Gamis bahan woolpeach premium Resleting depan (busui friendly)\r\nUjung tangan menggunakan karet (wudhu friendly)\r\nBagian badan polos\r\nRealpict 100%', 69000, 'Tersedia', 472);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL,
  `foto_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `foto_kategori`) VALUES
(469, 'Kerudung', ''),
(470, 'Kemeja Pria', ''),
(471, 'Dress', ''),
(472, 'Gamis', '');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `nama_produk`, `harga`, `foto`) VALUES
(65, 'Kemeja Pria Hitam', 135000, '6469afdb3cc5c.jpg'),
(67, 'Gamis Muslim Katun Medina', 175000, '6469bd32339e7.jpg'),
(69, 'Satin Dress Korea', 73000, '6469bed433422.jpeg'),
(70, 'Kerudung Bergo', 47000, '6469ab789d440.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_lengkap`, `username`, `password`) VALUES
(111, 'Admin1', 'admin', '$2a$12$GWbLTfg9CDIECTD3EUlfrOsNizanWFaFDXnsOhx7hNCqmlG2StzpG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `nama_barang` (`nama_barang`),
  ADD KEY `kategori_barang` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=473;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `kategori_barang` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
