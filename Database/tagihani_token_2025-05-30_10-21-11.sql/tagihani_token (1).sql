-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2025 pada 15.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tagihani_token`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `api`
--

CREATE TABLE `api` (
  `id` bigint(255) NOT NULL,
  `api` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `api`
--

INSERT INTO `api` (`id`, `api`) VALUES
(1, '75QESVYKPINBG4A5PYWD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE `config` (
  `id_config` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`id_config`, `judul`, `image`) VALUES
(1, 'Web Token', 'edcc6623fb469c0ad1e36a49e86d8419');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_customer`
--

CREATE TABLE `data_customer` (
  `id` bigint(255) NOT NULL,
  `id_customer` varchar(255) NOT NULL,
  `template_invoice_id` int(100) NOT NULL,
  `nm_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `metersatul` varchar(255) NOT NULL DEFAULT '0',
  `concentratorid_metersatul` varchar(255) NOT NULL,
  `status_metersatul` enum('Deactive','Active') NOT NULL,
  `meterdual` varchar(255) DEFAULT '0',
  `concentratorid_meterdual` varchar(255) NOT NULL,
  `status_meterdual` enum('Deactive','Active') NOT NULL,
  `metertigal` varchar(255) DEFAULT '0',
  `concentratorid_metertigal` varchar(255) NOT NULL,
  `status_metertigal` enum('Deactive','Active') NOT NULL,
  `meterempatl` varchar(255) DEFAULT NULL,
  `concentratorid_meterempatl` varchar(255) NOT NULL,
  `status_meterempatl` enum('Deactive','Active') NOT NULL,
  `metersatua` varchar(255) DEFAULT NULL,
  `concentratorid_metersatua` varchar(255) NOT NULL,
  `status_metersatua` enum('Deactive','Active') NOT NULL,
  `meterduaa` varchar(255) DEFAULT NULL,
  `concentratorid_meterduaa` varchar(255) NOT NULL,
  `status_meterduaa` enum('Deactive','Active') NOT NULL,
  `metertigaa` varchar(255) DEFAULT NULL,
  `concentratorid_metertigaa` varchar(255) NOT NULL,
  `status_metertigaa` enum('Deactive','Active') NOT NULL,
  `meterempata` varchar(255) DEFAULT NULL,
  `concentratorid_meterempata` varchar(255) NOT NULL,
  `status_meterempata` enum('Deactive','Active') NOT NULL,
  `metersatug` varchar(100) NOT NULL,
  `concentratorid_metersatug` varchar(255) NOT NULL,
  `status_metersatug` enum('Deactive','Active') NOT NULL,
  `meterduag` varchar(100) NOT NULL,
  `concentratorid_meterduag` varchar(255) NOT NULL,
  `status_meterduag` enum('Deactive','Active') NOT NULL,
  `metertigag` varchar(100) NOT NULL,
  `concentratorid_metertigag` varchar(255) NOT NULL,
  `status_metertigag` enum('Deactive','Active') NOT NULL,
  `meterempatg` varchar(100) NOT NULL,
  `concentratorid_meterempatg` varchar(255) NOT NULL,
  `status_meterempatg` enum('Deactive','Active') NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_customer`
--

INSERT INTO `data_customer` (`id`, `id_customer`, `template_invoice_id`, `nm_lengkap`, `username`, `password`, `alamat`, `telepon`, `metersatul`, `concentratorid_metersatul`, `status_metersatul`, `meterdual`, `concentratorid_meterdual`, `status_meterdual`, `metertigal`, `concentratorid_metertigal`, `status_metertigal`, `meterempatl`, `concentratorid_meterempatl`, `status_meterempatl`, `metersatua`, `concentratorid_metersatua`, `status_metersatua`, `meterduaa`, `concentratorid_meterduaa`, `status_meterduaa`, `metertigaa`, `concentratorid_metertigaa`, `status_metertigaa`, `meterempata`, `concentratorid_meterempata`, `status_meterempata`, `metersatug`, `concentratorid_metersatug`, `status_metersatug`, `meterduag`, `concentratorid_meterduag`, `status_meterduag`, `metertigag`, `concentratorid_metertigag`, `status_metertigag`, `meterempatg`, `concentratorid_meterempatg`, `status_meterempatg`, `last_login`) VALUES
(32, '171717', 0, 'tes2', 'pasar', 'pasar', 'pasar klitik lor', '090808080808', '47100041277', '0', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '2024-07-12'),
(33, '123', 0, 'Gerhana', 'Gerhana', '123456', 'BLOK Z', '123', '58101282968', '0', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '2024-07-31'),
(34, 'HERU', 4, 'HERU', 'HERU', '12', 'dwad', '4324234', '43242', '34234', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '', '', 'Deactive', '2025-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hargacu`
--

CREATE TABLE `hargacu` (
  `id_harga` int(4) NOT NULL,
  `id_desc` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `harga` bigint(255) NOT NULL,
  `ppn` bigint(255) NOT NULL,
  `admin` bigint(255) NOT NULL,
  `total` bigint(255) NOT NULL,
  `kwh` bigint(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `hargacu`
--

INSERT INTO `hargacu` (`id_harga`, `id_desc`, `judul`, `jenis`, `harga`, `ppn`, `admin`, `total`, `kwh`) VALUES
(4, '0001', 'Rp. 5.000 ( 5 kWh )', 'listrik', 5000, 550, 1000, 6550, 5),
(10, '', 'Rp. 50.000 ( 50 Kwh )', 'listrik', 50000, 5500, 1500, 57000, 50),
(11, '', 'Rp. 100.000 ( 100 Kwh )', 'listrik', 100000, 11000, 1500, 112500, 100),
(12, '', 'Rp. 200.000 ( 200 Kwh )', 'listrik', 200000, 22000, 1500, 223500, 20000),
(14, '', 'Rp. 500.000 ( 500 Kwh )', 'listrik', 500000, 55000, 1500, 556500, 500),
(15, '', 'Rp. 50.000 ( 25 m2 )', 'air', 50000, 5550, 1000, 56550, 25),
(16, '', 'Rp. 20.000 ( 10 m2 )', 'air', 20000, 2200, 1000, 23200, 10),
(17, '', 'Rp. 50.000 ( 25 m3 )', 'gas', 50000, 5550, 1000, 56550, 25),
(18, '', 'Rp. 20.000 ( 10 m3 )', 'gas', 20000, 2200, 1000, 23200, 10),
(19, '', 'Tariff', '', 1485, 11, 2500, 3996, 100000),
(20, '', 'HARGA NORMAL', '', 1750, 11, 2000, 3761, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_a`
--

CREATE TABLE `laporan_a` (
  `id_laporan` int(255) NOT NULL,
  `jenis_meter` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `meter` varchar(255) NOT NULL,
  `id_customer` varchar(255) NOT NULL,
  `nm_lengkap` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `price_token` double NOT NULL,
  `rate` varchar(255) NOT NULL,
  `ppn` double NOT NULL,
  `admin` double NOT NULL,
  `amount` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `laporan_a`
--

INSERT INTO `laporan_a` (`id_laporan`, `jenis_meter`, `judul`, `meter`, `id_customer`, `nm_lengkap`, `price`, `price_token`, `rate`, `ppn`, `admin`, `amount`, `token`, `tanggal`, `alamat`, `telepon`) VALUES
(136, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47000995952', '171078', 'tomo', '57000', 50000, '', 5500, 1500, '50', '6690 8283 6092 3440 0599', '15-05-2024 04:52:07 pm', 'wdadawd', '0855555555555'),
(137, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100041277', '171070', 'testing', '112500', 100000, '', 11000, 1500, '100', '3772 1827 0614 1596 2202', '18-05-2024 08:33:18 am', 'di Bekasi', '087878787878'),
(138, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47100041277', '171070', 'testing', '23200', 20000, '', 2200, 1000, '10', '6896 6575 3974 9926 4813', '06-06-2024 04:21:23 pm', 'di Bekasi', '087878787878'),
(139, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '58101282968', '123', 'Gerhana', '57000', 50000, '', 5500, 1500, '50', '5545 9195 7591 6607 6061', '07-06-2024 11:29:00 am', 'BLOK Z', '123'),
(140, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '100', '6811 2182 3834 9681 0523', '07-06-2024 11:31:07 am', 'BLOK Z', '123'),
(141, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '58101282968', '123', 'Gerhana', '57000', 50000, '', 5500, 1500, '50', '1083 0250 3669 7704 9457', '09-06-2024 04:22:43 pm', 'BLOK Z', '123'),
(142, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '100', '6653 1044 8022 3067 4843', '11-06-2024 11:28:40 am', 'BLOK Z', '123'),
(143, 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '47100041277', '171070', 'testing', '6550', 5000, '', 550, 1000, '5', '3237 3988 0127 1869 7071', '23-06-2024 01:20:56 pm', 'di Bekasi', '087878787878'),
(144, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '100', '6908 7906 2242 7005 0866', '04-07-2024 11:49:44 am', 'BLOK Z', '123'),
(145, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100041277', '171070', 'testing', '112500', 100000, '', 11000, 1500, '100', '6053 3219 9645 1106 9956', '04-07-2024 12:06:33 pm', 'di Bekasi', '087878787878'),
(146, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100041277', '171070', 'testing', '112500', 100000, '', 11000, 1500, '100', '7137 8207 5368 0393 8974', '04-07-2024 12:06:34 pm', 'di Bekasi', '087878787878'),
(147, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '100', '4744 2113 8054 9956 6145', '04-07-2024 12:10:54 pm', 'BLOK Z', '123'),
(148, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '10000', '2997 0588 8989 5478 5951', '04-07-2024 12:17:52 pm', 'BLOK Z', '123'),
(149, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '10000', '3736 2936 7702 2361 5825', '04-07-2024 12:24:11 pm', 'BLOK Z', '123'),
(150, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '10000', '5342 6100 4535 4401 9692', '04-07-2024 12:41:25 pm', 'BLOK Z', '123'),
(151, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '1012500', 1000000, '', 11000, 1500, '10000', '4659 8361 5902 1373 3616', '04-07-2024 02:13:12 pm', 'BLOK Z', '123'),
(152, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100051441', '171070', 'testing', '1012500', 1000000, '', 11000, 1500, '10000', '4250 8915 7608 6531 0989', '04-07-2024 03:16:01 pm', 'di Bekasi', '087878787878'),
(153, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100051441', '171070', 'testing', '1012500', 1000000, '', 11000, 1500, '10000', '0518 1688 3656 2029 4272', '04-07-2024 03:35:36 pm', 'di Bekasi', '087878787878'),
(154, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100051441', '171070', 'testing', '1012500', 1000000, '', 11000, 1500, '10000', '4146 5228 6529 3174 4155', '04-07-2024 03:41:09 pm', 'di Bekasi', '087878787878'),
(155, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100051441', '171070', 'testing', '1012500', 1000000, '', 11000, 1500, '10000', '0004 1613 8598 6002 7575', '04-07-2024 03:43:48 pm', 'di Bekasi', '087878787878'),
(156, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '1012500', 1000000, '', 11000, 1500, '10000', '2348 9064 9805 6610 5540', '04-07-2024 03:47:11 pm', 'BLOK Z', '123'),
(157, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '58101282968', '123', 'Gerhana', '57000', 50000, '', 5500, 1500, '50', '3884 4482 6622 4745 2579', '04-07-2024 03:50:53 pm', 'BLOK Z', '123'),
(158, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '58101282968', '123', 'Gerhana', '57000', 50000, '', 5500, 1500, '500', '0593 9251 9379 0906 6062', '04-07-2024 03:58:00 pm', 'BLOK Z', '123'),
(159, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '58101282968', '123', 'Gerhana', '57000', 50000, '', 5500, 1500, '5000', '6903 9348 6414 2607 2691', '04-07-2024 04:01:13 pm', 'BLOK Z', '123'),
(160, 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '58101282968', '123', 'Gerhana', '6550', 5000, '', 550, 1000, '50000', '4792 7479 4493 6684 1052', '04-07-2024 04:04:17 pm', 'BLOK Z', '123'),
(161, 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '58101282968', '123', 'Gerhana', '6550', 5000, '', 550, 1000, '500', '1828 3090 9086 9512 1700', '04-07-2024 04:07:53 pm', 'BLOK Z', '123'),
(162, 'listrik', 'Rp. 200.000 ( 200 Kwh ) ', '58101282968', '123', 'Gerhana', '223500', 200000, '', 22000, 1500, '200', '2446 7626 3113 8907 7182', '04-07-2024 04:11:14 pm', 'BLOK Z', '123'),
(163, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '1', '1114 9872 0245 1876 9537', '04-07-2024 05:00:26 pm', 'BLOK Z', '123'),
(164, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '1', '2090 5751 8874 7153 1823', '04-07-2024 05:01:37 pm', 'BLOK Z', '123'),
(165, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', '123', 'Gerhana', '112500', 100000, '', 11000, 1500, '100', '0760 6513 5831 1328 4145', '04-07-2024 05:03:14 pm', 'BLOK Z', '123'),
(166, 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '58101282968', '123', 'Gerhana', '57000', 50000, '', 5500, 1500, '50', '4863 9425 3412 3195 6861', '04-07-2024 05:05:01 pm', 'BLOK Z', '123'),
(167, 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '58101282968', '123', 'Gerhana', '6550', 5000, '', 550, 1000, '5', '7001 0578 7895 4350 1538', '04-07-2024 05:07:05 pm', 'BLOK Z', '123'),
(168, 'listrik', 'Rp. 500.000 ( 500 Kwh ) ', '47100051441', '171070', 'testing', '556500', 500000, '', 55000, 1500, '500', '3598 8334 2475 3889 0525', '05-07-2024 10:08:47 am', 'di Bekasi', '087878787878'),
(169, 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100051441', '171070', 'testing', '112500', 100000, '', 11000, 1500, '100', '6173 0182 4395 1105 4586', '08-07-2024 02:35:55 pm', 'di Bekasi', '087878787878'),
(170, 'listrik', 'Rp. 500.000 ( 500 Kwh ) ', '58101282968', '123', 'Gerhana', '556500', 500000, '', 55000, 1500, '500', '4634 7084 7459 9443 0847', '10-07-2024 11:06:31 pm', 'BLOK Z', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_cu`
--

CREATE TABLE `laporan_cu` (
  `id` bigint(255) NOT NULL,
  `id_C` bigint(255) NOT NULL,
  `id_for` bigint(255) NOT NULL,
  `id_customer` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `jenis_meter` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `meter` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `price_token` double NOT NULL,
  `rate` decimal(65,0) NOT NULL,
  `ppn` double NOT NULL,
  `admin` double NOT NULL,
  `amount` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `status_vending` varchar(20) NOT NULL,
  `uniq` varchar(255) NOT NULL,
  `trx` varchar(255) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `expire_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `laporan_cu`
--

INSERT INTO `laporan_cu` (`id`, `id_C`, `id_for`, `id_customer`, `invoice`, `nama`, `alamat`, `telepon`, `jenis_meter`, `judul`, `meter`, `price`, `price_token`, `rate`, `ppn`, `admin`, `amount`, `token`, `tanggal`, `status`, `status_vending`, `uniq`, `trx`, `created_at`, `expire_at`) VALUES
(293, 16, 10, '171078', 'INV-104511', 'tomo', '', '0855555555555', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47000995952', 57000, 50000, 0, 5500, 1500, '50', '5249 0767 5089 9677 4750', '15-05-2024 11:44:20 am', 'diclaim', 'false', '', '', '', '2024-05-16'),
(294, 16, 10, '171078', 'INV-114341', 'tomo', '', '0855555555555', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47000995952', 57000, 50000, 0, 5500, 1500, '50', '', '', 'expired', '', '', '', '', '2024-05-16'),
(295, 31, 10, '171070', 'INV-091857', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47100041277', 57000, 50000, 0, 5500, 1500, '50', '5249 0767 5089 9677 4750', '15-05-2024 11:44:20 am', 'diclaim', 'false', '', '', '', '2024-05-24'),
(296, 31, 10, '171070', 'INV-110537', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47100041277', 57000, 50000, 0, 5500, 1500, '50', '', '', 'expired', '', '', '', '', '2024-06-04'),
(298, 31, 10, '171070', 'INV-050531', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47100041277', 57000, 50000, 0, 5500, 1500, '50', '', '', 'expired', '', '', '', '', '2024-06-07'),
(299, 31, 10, '171070', 'INV-050755', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47100041277', 57000, 50000, 0, 5500, 1500, '50', '3362 0223 6985 9015 8223', '06-06-2024 05:10:17 pm', 'diclaim', 'false', '', '', '', '2024-06-07'),
(300, 33, 11, '123', 'INV-113337', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '0396 0151 3354 1765 1355', '07-06-2024 11:35:24 am', 'diclaim', 'false', '', '', '', '2024-06-08'),
(301, 33, 11, '123', 'INV-031315', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '5260 1885 7304 1108 8214', '07-06-2024 03:15:23 pm', 'diclaim', 'false', '', '', '', '2024-06-08'),
(302, 31, 4, '171070', 'INV-024502', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '47100041277', 6550, 5000, 0, 550, 1000, '5', '', '', 'expired', '', '', '', '', '2024-06-11'),
(303, 33, 11, '123', 'INV-093830', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '6507 4488 4671 9934 9114', '11-06-2024 09:41:14 am', 'diclaim', 'false', '', '', '', '2024-06-12'),
(304, 33, 11, '123', 'INV-113447', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '7246 4727 2250 6485 0549', '11-06-2024 11:38:38 am', 'diclaim', 'false', '', '', '', '2024-06-12'),
(305, 33, 11, '123', 'INV-125924', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '2418 3935 7371 6753 7905', '11-06-2024 01:03:20 pm', 'diclaim', 'false', '', '', '', '2024-06-12'),
(306, 33, 11, '123', 'INV-105738', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '0745 5594 0969 1170 2009', '13-06-2024 10:58:47 am', 'diclaim', 'false', '', '', '', '2024-06-14'),
(307, 33, 11, '123', 'INV-124745', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '2692 2897 8798 2053 9047', '20-06-2024 12:49:12 pm', 'diclaim', 'false', '', '', '', '2024-06-21'),
(308, 33, 11, '123', 'INV-044046', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '1974 0888 5306 0228 1214', '21-06-2024 04:41:49 pm', 'diclaim', 'false', '', '', '', '2024-06-22'),
(309, 34, 4, 'dwa', 'INV-064503', 'dwad', 'dwad', '4324234', 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '43242', 6550, 5000, 0, 550, 1000, '5', '1974 0888 5306 0228 1214', '21-06-2024 04:41:49 pm', 'diclaim', '', '', '', '', '2024-06-23'),
(310, 31, 10, '171070', 'INV-083417', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 50.000 ( 50 Kwh ) ', '47100041277', 57000, 50000, 0, 5500, 1500, '50', '3899 5989 9146 6312 2032', '22-06-2024 08:36:43 pm', 'diclaim', 'false', '', '', '', '2024-06-23'),
(311, 33, 11, '123', 'INV-122616', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '4399 9302 1741 0689 2854', '24-06-2024 12:31:17 pm', 'diclaim', 'false', '', '', '', '2024-06-25'),
(312, 33, 11, '123', 'INV-085907', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '0416 8576 4361 7141 5076', '26-06-2024 09:01:28 am', 'diclaim', 'false', '', '', '', '2024-06-27'),
(313, 32, 11, '171717', 'INV-100300', 'tes2', 'pasar klitik lor', '090808080808', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100041277', 112500, 100000, 0, 11000, 1500, '100', '3860 1071 6399 0224 5616', '04-07-2024 10:06:25 am', 'diclaim', 'false', '', '', '', '2024-07-05'),
(314, 32, 11, '171717', 'INV-100941', 'tes2', 'pasar klitik lor', '090808080808', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '47100041277', 112500, 100000, 0, 11000, 1500, '100', '2580 4204 1840 8314 8990', '04-07-2024 10:11:42 am', 'diclaim', 'false', '', '', '', '2024-07-05'),
(315, 33, 11, '123', 'INV-101205', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '1459 1107 0953 6995 3200', '04-07-2024 10:13:18 am', 'diclaim', 'false', '', '', '', '2024-07-05'),
(316, 33, 11, '123', 'INV-114545', 'Gerhana', 'BLOK Z', '123', 'listrik', 'Rp. 100.000 ( 100 Kwh ) ', '58101282968', 112500, 100000, 0, 11000, 1500, '100', '4159 2891 5666 5886 2873', '04-07-2024 11:46:47 am', 'diclaim', 'false', '', '', '', '2024-07-05'),
(317, 31, 4, '171070', 'INV-051841', 'testing', 'di Bekasi', '087878787878', 'listrik', 'Rp. 5.000 ( 5 kWh ) ', '47100051441', 6550, 5000, 0, 550, 1000, '5', '', '', 'expired', '', '', '', '', '2024-07-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meter`
--

CREATE TABLE `meter` (
  `id` bigint(255) NOT NULL,
  `id_M` bigint(255) NOT NULL,
  `metersatu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `meter`
--

INSERT INTO `meter` (`id`, `id_M`, `metersatu`) VALUES
(1, 1, '47000995952'),
(2, 2, '1333333333333331');

-- --------------------------------------------------------

--
-- Struktur dari tabel `template_invoice`
--

CREATE TABLE `template_invoice` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_vendor` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `greeting_footer_receipt` varchar(255) NOT NULL,
  `path_featured_receipt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `template_invoice`
--

INSERT INTO `template_invoice` (`id`, `name`, `name_vendor`, `address`, `greeting_footer_receipt`, `path_featured_receipt`) VALUES
(4, 'model 1', 'model 1', 'dwadawda', 'dwadawda', 'uploads/receipt/logo/1719057147.png'),
(5, 'Pasar Jaya', 'Pasar Jaya Jakarta', 'Jln Pahlawan No 3 Demak Jakarta', 'Tukarkan 10 Struk, untuk 1sendok Cantik di SAITEC', 'uploads/receipt/logo/1719122605.jpg'),
(6, 'Model 2', 'SAITEC', 'Bekasi', 'Terima Kasih', 'uploads/receipt/logo/1720149217.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name_vendor` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `greeting_footer_receipt` varchar(255) NOT NULL,
  `path_featured_receipt` varchar(255) NOT NULL,
  `level` enum('admin','siswa') NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name_vendor`, `address`, `username`, `password`, `gambar`, `greeting_footer_receipt`, `path_featured_receipt`, `level`, `last_login`) VALUES
(1, 'Saitec', 'Ruko Grand Mall', 'demo', '9e8e2db3bc5ed9dbf33f7bcd0ce401a7', '26886919e11a1bf19d76519477c2d98f', 'Tiada Hujan, yang menyejukkan hati', 'uploads/receipt/logo/1717665797.png', 'admin', '2025-02-06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indeks untuk tabel `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_customer` (`id_customer`),
  ADD UNIQUE KEY `id_customer_2` (`id_customer`);

--
-- Indeks untuk tabel `hargacu`
--
ALTER TABLE `hargacu`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `laporan_a`
--
ALTER TABLE `laporan_a`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `laporan_cu`
--
ALTER TABLE `laporan_cu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `meter`
--
ALTER TABLE `meter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `template_invoice`
--
ALTER TABLE `template_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `api`
--
ALTER TABLE `api`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `hargacu`
--
ALTER TABLE `hargacu`
  MODIFY `id_harga` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `laporan_a`
--
ALTER TABLE `laporan_a`
  MODIFY `id_laporan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT untuk tabel `laporan_cu`
--
ALTER TABLE `laporan_cu`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT untuk tabel `meter`
--
ALTER TABLE `meter`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `template_invoice`
--
ALTER TABLE `template_invoice`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
