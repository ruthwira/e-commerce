-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2024 at 12:39 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `barang_id` int NOT NULL,
  `barang_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barang_remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barang_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barang_harga` int NOT NULL,
  `barang_stock` int NOT NULL,
  `barang_gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`barang_id`, `barang_name`, `barang_remarks`, `barang_kategori`, `barang_harga`, `barang_stock`, `barang_gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kaos', 'kaos perempuan', 'pakaian perempuan', 35000, 10, 'kaos.jpg', '2023-12-29 10:29:37', '2023-12-29 10:29:37', NULL),
(2, 'sepatu', 'sepatu merk all start', 'pakaian pria', 35000, 10, 'sepatu.jpg', '2023-12-29 10:29:37', '2023-12-29 10:29:37', NULL),
(3, 'kemeja', 'kemeja pria hijau', 'kemeja pria', 35000, 10, 'kemeja.jpg', '2023-12-29 10:29:37', '2023-12-29 10:29:37', NULL),
(4, 'tas', 'tas hitam wanita', 'tas wanita', 35000, 10, 'tas.jpg', '2023-12-29 10:29:37', '2023-12-29 10:29:37', NULL),
(5, 'Senter', 'Senter Everydaycccasda', 'Perkakas', 34000, 12, '1703828227_42dbe79dde894be88f29.jpg', '2023-12-29 05:12:39', '2023-12-29 05:55:27', '2023-12-29 05:55:27'),
(6, 'test', 'ASDASD', 'asda', 1231, 1231, '1703828513_3c1d4cf0ebd3ada89b66.jpg', '2023-12-29 05:41:53', '2023-12-29 05:42:03', '2023-12-29 05:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `keranjang_id` int NOT NULL,
  `user_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`keranjang_id`, `user_id`, `barang_id`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 2, 2, 5, '2024-01-05 02:01:31', '2024-01-05 02:12:38', '2024-01-05 02:12:38'),
(3, 2, 1, 3, '2024-01-05 02:14:55', '2024-01-05 02:15:00', '2024-01-05 02:15:00'),
(4, 2, 1, 2, '2024-01-05 02:16:46', '2024-01-05 02:32:08', '2024-01-05 02:32:08'),
(5, 2, 2, 1, '2024-01-05 02:16:54', '2024-01-05 02:32:08', '2024-01-05 02:32:08'),
(6, 2, 3, 3, '2024-01-05 03:11:30', '2024-01-05 03:11:35', '2024-01-05 03:11:35'),
(7, 2, 1, 1, '2024-01-05 10:14:09', '2024-01-05 10:14:13', '2024-01-05 10:14:13'),
(8, 2, 1, 5, '2024-01-05 10:14:24', '2024-01-05 10:14:33', NULL),
(9, 2, 2, 6, '2024-01-05 10:15:34', '2024-01-05 10:15:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `pesanan_id` int NOT NULL,
  `pesanan_by` int NOT NULL COMMENT 'user_id yang melakukan pesanan',
  `pesanan_status` int NOT NULL DEFAULT '0' COMMENT '0 -> belum klik bayar\r\n1 -> sudah bayar, belum dikonfirmasi admin\r\n2 -> sudah bayar dan konfirmasi\r\n3 -> sudah dikirim\r\n4 -> sudah diterima',
  `pesanan_total` int NOT NULL DEFAULT '0',
  `pesanan_pembayaran` varchar(16) NOT NULL,
  `pesanan_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`pesanan_id`, `pesanan_by`, `pesanan_status`, `pesanan_total`, `pesanan_pembayaran`, `pesanan_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 2, 3, 105000, 'BCA', NULL, '2024-01-05 02:32:08', '2024-01-05 03:11:11', NULL),
(4, 2, 1, 105000, 'Gopay', NULL, '2024-01-05 03:11:35', '2024-01-05 03:11:40', NULL),
(5, 2, 3, 35000, 'BNI', '1704631032_80e1fb06e63cc24789ff.jpg', '2024-01-05 10:14:13', '2024-01-07 12:39:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan_detail`
--

CREATE TABLE `tb_pesanan_detail` (
  `pesanan_detail_id` int NOT NULL,
  `pesanan_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `barang_jml` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pesanan_detail`
--

INSERT INTO `tb_pesanan_detail` (`pesanan_detail_id`, `pesanan_id`, `barang_id`, `barang_jml`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 2, 1, '2024-01-05 02:32:08', '2024-01-05 02:32:08', NULL),
(2, 3, 1, 2, '2024-01-05 02:32:08', '2024-01-05 02:32:08', NULL),
(3, 4, 3, 3, '2024-01-05 03:11:35', '2024-01-05 03:11:35', NULL),
(4, 5, 1, 1, '2024-01-05 10:14:13', '2024-01-05 10:14:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int NOT NULL,
  `username` varchar(16) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `fullname`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Admin TokOnline', '$2y$10$fxCvscFDgmKyfmm7DAx.ievGuCsHbpoBXY8UJoPXGFmH1LWfTFBdK', 99, '2023-12-29 10:34:43', '2023-12-29 10:34:43', NULL),
(2, 'user1', 'User Coba 1', '$2y$10$fxCvscFDgmKyfmm7DAx.ievGuCsHbpoBXY8UJoPXGFmH1LWfTFBdK', 1, '2023-12-29 04:19:45', '2023-12-29 04:19:45', NULL),
(3, 'user2', 'User Coba 2', '$2y$10$5F/ElzRfeIFAuk6dVOsWN.TOeOpGlSHdlAuwFhwGoX7uFE6AiXTyS', 1, '2023-12-29 04:20:49', '2023-12-29 04:20:49', NULL),
(4, 'user3', 'USer COba 3', '$2y$10$hWRGOCd9W.DApaZlLEp0Be0O7R1NGYOQ.3qURvHd0w9dqbrCHcmZK', 1, '2023-12-29 04:21:44', '2023-12-29 04:21:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`keranjang_id`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`pesanan_id`);

--
-- Indexes for table `tb_pesanan_detail`
--
ALTER TABLE `tb_pesanan_detail`
  ADD PRIMARY KEY (`pesanan_detail_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `barang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `keranjang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `pesanan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pesanan_detail`
--
ALTER TABLE `tb_pesanan_detail`
  MODIFY `pesanan_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
