-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Sep 2026 pada 03.00
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
-- Database: `ukk_paket_4_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_buku` varchar(30) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(150) DEFAULT NULL,
  `tahun_terbit` smallint(5) UNSIGNED DEFAULT NULL,
  `rak` varchar(50) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `tersedia` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(500) DEFAULT NULL,
  `file_pdf` varchar(500) DEFAULT NULL,
  `status` enum('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  `kondisi` varchar(30) NOT NULL DEFAULT 'Baik',
  `keterangan_kondisi` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `judul`, `slug`, `pengarang`, `penerbit`, `tahun_terbit`, `rak`, `isbn`, `kategori_id`, `stok`, `tersedia`, `deskripsi`, `gambar`, `file_pdf`, `status`, `kondisi`, `keterangan_kondisi`, `created_at`, `updated_at`) VALUES
(1, 'BK001', 'Laskar Pelangi', 'laskar-pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'A-1', '9789793062792', 1, 5, 4, 'Novel inspiratif tentang anak-anak Belitung.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Rusak Ringan', 'halaman 10 hilang/sobek', '2026-09-20 00:35:23', '2026-09-20 08:33:26'),
(2, 'BK002', 'Bumi Manusia', 'bumi-manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'A-2', '9789799731234', 1, 3, 3, 'Novel sejarah Indonesia.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-21 18:06:23'),
(3, 'BK003', 'Clean Code', 'clean-code', 'Robert C. Martin', 'Prentice Hall', 2008, 'B-1', '9780132350884', 3, 4, 2, 'Panduan menulis kode yang bersih.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-21 19:24:29'),
(4, 'BK004', 'Sejarah Indonesia Modern', 'sejarah-indonesia-modern', 'M.C. Ricklefs', 'UGM Press', 2008, 'C-1', '9789794201234', 4, 2, 2, 'Sejarah Indonesia masa kolonial hingga modern.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-21 11:03:35'),
(5, 'BK005', 'Atomic Habits', 'atomic-habits', 'James Clear', 'Avery', 2018, 'D-1', '9780735211292', 2, 6, 6, 'Cara membangun kebiasaan baik.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(6, 'BK006', 'Laravel for Beginners', 'laravel-for-beginners', 'John Doe', 'Tech Press', 2023, 'B-2', '9781234567890', 3, 3, 3, 'Pengenalan framework Laravel.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-21 19:26:17'),
(7, 'BK007', 'Matematika Dasar', 'matematika-dasar', 'Tim Edukasi', 'Erlangga', 2020, 'E-1', '9789791234567', 5, 10, 10, 'Buku pelajaran matematika SD.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-21 11:03:19'),
(8, 'BK008', 'Negeri 5 Menara', 'negeri-5-menara', 'Ahmad Fuadi', 'Gramedia', 2009, 'A-3', '9789792248612', 1, 4, 4, 'Novel tentang pesantren dan mimpi.', NULL, 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 'tersedia', 'Baik', NULL, '2026-09-20 00:35:23', '2026-09-20 20:41:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', 'fiksi', 'Novel dan cerita fiksi', '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(2, 'Non-Fiksi', 'non-fiksi', 'Pengetahuan umum', '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(3, 'Teknologi', 'teknologi', 'Komputer dan teknologi', '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(4, 'Sejarah', 'sejarah', 'Sejarah dan biografi', '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(5, 'Pendidikan', 'pendidikan', 'Buku pelajaran', '2026-09-20 00:35:23', '2026-09-20 00:35:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_pengunjung`
--

CREATE TABLE `log_pengunjung` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(150) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_pengunjung`
--

INSERT INTO `log_pengunjung` (`id`, `path`, `ip`, `created_at`, `updated_at`) VALUES
(1, 'katalog', '124.40.251.142', '2026-09-20 07:40:09', '2026-09-20 07:40:09'),
(2, 'katalog', '124.40.251.142', '2026-09-20 07:41:09', '2026-09-20 07:41:09'),
(3, 'katalog', '124.40.251.142', '2026-09-20 07:50:50', '2026-09-20 07:50:50'),
(4, 'katalog', '124.40.251.142', '2026-09-20 07:52:42', '2026-09-20 07:52:42'),
(5, 'katalog', '124.40.251.142', '2026-09-20 08:01:25', '2026-09-20 08:01:25'),
(6, 'katalog', '124.40.251.142', '2026-09-20 08:03:11', '2026-09-20 08:03:11'),
(7, 'katalog', '124.40.251.142', '2026-09-20 08:25:05', '2026-09-20 08:25:05'),
(8, 'katalog', '124.40.251.142', '2026-09-20 08:25:07', '2026-09-20 08:25:07'),
(9, 'katalog', '124.40.251.142', '2026-09-20 08:30:05', '2026-09-20 08:30:05'),
(10, 'katalog', '124.40.251.142', '2026-09-20 08:32:33', '2026-09-20 08:32:33'),
(11, 'katalog', '124.40.251.142', '2026-09-20 16:57:04', '2026-09-20 16:57:04'),
(12, 'katalog', '124.40.251.142', '2026-09-20 16:58:05', '2026-09-20 16:58:05'),
(13, 'katalog', '124.40.251.142', '2026-09-20 16:59:12', '2026-09-20 16:59:12'),
(14, 'katalog', '124.40.251.142', '2026-09-20 16:59:19', '2026-09-20 16:59:19'),
(15, 'katalog', '124.40.251.142', '2026-09-20 17:41:54', '2026-09-20 17:41:54'),
(16, 'katalog', '124.40.251.142', '2026-09-20 17:42:26', '2026-09-20 17:42:26'),
(17, 'katalog', '124.40.251.142', '2026-09-20 17:43:06', '2026-09-20 17:43:06'),
(18, 'katalog', '124.40.251.142', '2026-09-20 17:43:31', '2026-09-20 17:43:31'),
(19, 'katalog', '124.40.251.142', '2026-09-20 17:43:50', '2026-09-20 17:43:50'),
(20, 'katalog', '124.40.251.142', '2026-09-20 17:44:12', '2026-09-20 17:44:12'),
(21, 'katalog', '124.40.251.142', '2026-09-20 17:53:57', '2026-09-20 17:53:57'),
(22, 'katalog', '124.40.251.142', '2026-09-20 17:54:23', '2026-09-20 17:54:23'),
(23, 'katalog', '124.40.251.142', '2026-09-20 17:54:37', '2026-09-20 17:54:37'),
(24, 'katalog', '124.40.251.142', '2026-09-20 17:55:14', '2026-09-20 17:55:14'),
(25, 'katalog', '124.40.251.142', '2026-09-20 18:05:01', '2026-09-20 18:05:01'),
(26, 'katalog', '124.40.251.142', '2026-09-20 18:05:30', '2026-09-20 18:05:30'),
(27, 'katalog', '124.40.251.142', '2026-09-20 18:06:09', '2026-09-20 18:06:09'),
(28, 'katalog', '124.40.251.142', '2026-09-20 18:08:02', '2026-09-20 18:08:02'),
(29, 'katalog', '124.40.251.142', '2026-09-20 18:10:10', '2026-09-20 18:10:10'),
(30, 'katalog', '124.40.251.142', '2026-09-20 18:18:54', '2026-09-20 18:18:54'),
(31, 'katalog', '124.40.251.142', '2026-09-20 18:19:27', '2026-09-20 18:19:27'),
(32, 'katalog', '124.40.251.142', '2026-09-20 18:38:17', '2026-09-20 18:38:17'),
(33, 'katalog', '124.40.251.142', '2026-09-20 18:52:02', '2026-09-20 18:52:02'),
(34, 'katalog', '124.40.251.142', '2026-09-20 18:53:06', '2026-09-20 18:53:06'),
(35, 'katalog', '124.40.251.142', '2026-09-20 18:59:56', '2026-09-20 18:59:56'),
(36, 'katalog', '124.40.251.142', '2026-09-20 19:00:16', '2026-09-20 19:00:16'),
(37, 'katalog', '124.40.251.142', '2026-09-20 19:01:04', '2026-09-20 19:01:04'),
(38, 'katalog', '124.40.251.142', '2026-09-20 19:01:08', '2026-09-20 19:01:08'),
(39, 'katalog', '124.40.251.142', '2026-09-20 19:13:46', '2026-09-20 19:13:46'),
(40, 'katalog', '124.40.251.142', '2026-09-20 19:15:08', '2026-09-20 19:15:08'),
(41, 'katalog', '124.40.251.142', '2026-09-20 19:16:25', '2026-09-20 19:16:25'),
(42, 'katalog', '124.40.251.142', '2026-09-20 19:17:53', '2026-09-20 19:17:53'),
(43, 'katalog', '124.40.251.142', '2026-09-20 19:17:56', '2026-09-20 19:17:56'),
(44, 'katalog', '124.40.251.142', '2026-09-20 19:17:58', '2026-09-20 19:17:58'),
(45, 'katalog', '124.40.251.142', '2026-09-20 19:18:03', '2026-09-20 19:18:03'),
(46, 'katalog', '124.40.251.142', '2026-09-20 19:38:11', '2026-09-20 19:38:11'),
(47, 'katalog', '124.40.251.142', '2026-09-20 19:38:54', '2026-09-20 19:38:54'),
(48, 'katalog', '124.40.251.142', '2026-09-20 19:39:58', '2026-09-20 19:39:58'),
(49, 'katalog', '124.40.251.142', '2026-09-20 19:40:05', '2026-09-20 19:40:05'),
(50, 'katalog', '124.40.251.142', '2026-09-20 19:40:35', '2026-09-20 19:40:35'),
(51, 'katalog', '124.40.251.142', '2026-09-20 19:50:54', '2026-09-20 19:50:54'),
(52, 'katalog', '124.40.251.142', '2026-09-20 19:51:54', '2026-09-20 19:51:54'),
(53, 'katalog', '124.40.251.142', '2026-09-20 20:15:32', '2026-09-20 20:15:32'),
(54, 'katalog', '124.40.251.142', '2026-09-20 20:16:26', '2026-09-20 20:16:26'),
(55, 'katalog', '124.40.251.142', '2026-09-20 20:17:06', '2026-09-20 20:17:06'),
(56, 'katalog', '124.40.251.142', '2026-09-20 20:40:01', '2026-09-20 20:40:01'),
(57, 'katalog', '124.40.251.142', '2026-09-20 20:40:41', '2026-09-20 20:40:41'),
(58, 'katalog', '124.40.251.142', '2026-09-20 20:41:38', '2026-09-20 20:41:38'),
(59, 'katalog', '124.40.251.142', '2026-09-20 20:41:58', '2026-09-20 20:41:58'),
(60, 'katalog', '124.40.251.142', '2026-09-20 20:42:02', '2026-09-20 20:42:02'),
(61, 'katalog', '52.167.144.195', '2026-09-20 22:02:06', '2026-09-20 22:02:06'),
(62, 'katalog', '40.77.167.38', '2026-09-21 01:25:25', '2026-09-21 01:25:25'),
(63, 'katalog', '103.210.35.3', '2026-09-21 09:49:09', '2026-09-21 09:49:09'),
(64, 'katalog', '103.210.35.3', '2026-09-21 10:20:03', '2026-09-21 10:20:03'),
(65, 'katalog', '103.210.35.3', '2026-09-21 10:22:52', '2026-09-21 10:22:52'),
(66, 'katalog', '103.210.35.3', '2026-09-21 10:23:29', '2026-09-21 10:23:29'),
(67, 'katalog', '103.210.35.3', '2026-09-21 11:00:56', '2026-09-21 11:00:56'),
(68, 'katalog', '103.210.35.3', '2026-09-21 11:02:13', '2026-09-21 11:02:13'),
(69, 'katalog', '103.210.35.3', '2026-09-21 11:03:55', '2026-09-21 11:03:55'),
(70, 'katalog', '103.210.35.3', '2026-09-21 11:21:40', '2026-09-21 11:21:40'),
(71, 'katalog', '103.210.35.3', '2026-09-21 11:23:42', '2026-09-21 11:23:42'),
(72, 'katalog', '103.210.35.3', '2026-09-21 11:24:13', '2026-09-21 11:24:13'),
(73, 'katalog', '103.210.35.3', '2026-09-21 12:14:24', '2026-09-21 12:14:24'),
(74, 'katalog', '103.210.35.3', '2026-09-21 12:14:30', '2026-09-21 12:14:30'),
(75, 'katalog', '103.210.35.3', '2026-09-21 12:16:59', '2026-09-21 12:16:59'),
(76, 'katalog', '103.210.35.3', '2026-09-21 12:18:36', '2026-09-21 12:18:36'),
(77, 'katalog', '103.210.35.3', '2026-09-21 12:19:03', '2026-09-21 12:19:03'),
(78, 'katalog', '103.210.35.3', '2026-09-21 12:20:24', '2026-09-21 12:20:24'),
(79, 'katalog', '40.77.167.55', '2026-09-21 12:53:11', '2026-09-21 12:53:11'),
(80, 'katalog', '172.253.7.118', '2026-09-21 13:15:51', '2026-09-21 13:15:51'),
(81, 'katalog', '103.210.35.3', '2026-09-21 13:18:13', '2026-09-21 13:18:13'),
(82, 'katalog', '103.210.35.3', '2026-09-21 13:41:37', '2026-09-21 13:41:37'),
(83, 'katalog', '103.210.35.3', '2026-09-21 13:41:43', '2026-09-21 13:41:43'),
(84, 'katalog', '103.210.35.3', '2026-09-21 13:43:59', '2026-09-21 13:43:59'),
(85, 'katalog', '103.210.35.3', '2026-09-21 13:44:02', '2026-09-21 13:44:02'),
(86, 'katalog', '103.210.35.3', '2026-09-21 13:44:03', '2026-09-21 13:44:03'),
(87, 'katalog', '103.210.35.3', '2026-09-21 13:45:16', '2026-09-21 13:45:16'),
(88, 'katalog', '124.40.251.142', '2026-09-21 17:57:05', '2026-09-21 17:57:05'),
(89, 'katalog', '124.40.251.142', '2026-09-21 18:00:48', '2026-09-21 18:00:48'),
(90, 'katalog', '124.40.251.142', '2026-09-21 18:03:31', '2026-09-21 18:03:31'),
(91, 'katalog', '124.40.251.142', '2026-09-21 18:05:29', '2026-09-21 18:05:29'),
(92, 'katalog', '124.40.251.142', '2026-09-21 18:05:53', '2026-09-21 18:05:53'),
(93, 'katalog', '124.40.251.142', '2026-09-21 18:05:57', '2026-09-21 18:05:57'),
(94, 'katalog', '124.40.251.142', '2026-09-21 18:11:43', '2026-09-21 18:11:43'),
(95, 'katalog', '124.40.251.142', '2026-09-21 18:12:29', '2026-09-21 18:12:29'),
(96, 'katalog', '124.40.251.142', '2026-09-21 18:13:08', '2026-09-21 18:13:08'),
(97, 'katalog', '124.40.251.142', '2026-09-21 19:08:56', '2026-09-21 19:08:56'),
(98, 'katalog', '124.40.251.142', '2026-09-21 19:09:00', '2026-09-21 19:09:00'),
(99, 'katalog', '124.40.251.142', '2026-09-21 19:11:19', '2026-09-21 19:11:19'),
(100, 'katalog', '124.40.251.142', '2026-09-21 19:13:37', '2026-09-21 19:13:37'),
(101, 'katalog', '124.40.251.142', '2026-09-21 19:23:13', '2026-09-21 19:23:13'),
(102, 'katalog', '124.40.251.142', '2026-09-21 19:23:52', '2026-09-21 19:23:52'),
(103, 'katalog', '124.40.251.142', '2026-09-21 19:24:58', '2026-09-21 19:24:58'),
(104, 'katalog', '124.40.251.142', '2026-09-21 19:27:39', '2026-09-21 19:27:39'),
(105, 'katalog', '52.167.144.166', '2026-09-21 19:29:48', '2026-09-21 19:29:48'),
(106, 'katalog', '124.40.251.142', '2026-09-21 19:45:30', '2026-09-21 19:45:30'),
(107, 'katalog', '124.40.251.142', '2026-09-21 19:54:56', '2026-09-21 19:54:56'),
(108, 'katalog', '124.40.251.142', '2026-09-21 19:55:28', '2026-09-21 19:55:28'),
(109, 'katalog', '127.0.0.1', '2026-09-21 18:15:27', '2026-09-21 18:15:27'),
(110, 'katalog', '127.0.0.1', '2026-09-21 23:35:36', '2026-09-21 23:35:36'),
(111, 'katalog', '127.0.0.1', '2026-09-21 23:44:35', '2026-09-21 23:44:35'),
(112, 'katalog', '127.0.0.1', '2026-09-22 17:35:01', '2026-09-22 17:35:01'),
(113, 'katalog', '127.0.0.1', '2026-09-22 17:35:06', '2026-09-22 17:35:06'),
(114, 'katalog', '127.0.0.1', '2026-09-22 17:39:20', '2026-09-22 17:39:20'),
(115, 'katalog', '127.0.0.1', '2026-09-22 17:39:36', '2026-09-22 17:39:36'),
(116, 'katalog', '127.0.0.1', '2026-09-23 17:54:04', '2026-09-23 17:54:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_stok`
--

CREATE TABLE `log_stok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `perubahan` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text DEFAULT NULL,
  `tipe` varchar(50) NOT NULL DEFAULT 'info',
  `sudah_dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `pengguna_id`, `judul`, `pesan`, `tipe`, `sudah_dibaca`, `created_at`, `updated_at`) VALUES
(1, 3, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Laskar Pelangi\".', 'info', 1, '2026-09-20 07:41:18', '2026-09-20 08:19:36'),
(2, 3, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Clean Code\".', 'info', 1, '2026-09-20 07:52:56', '2026-09-20 08:19:36'),
(3, 3, 'Peminjaman disetujui', '\"Clean Code\" disetujui. Jatuh tempo 27 Sep 2026', 'success', 1, '2026-09-20 08:04:32', '2026-09-20 08:19:36'),
(4, 3, 'Pengingat jatuh tempo', 'Buku \"Clean Code\" jatuh tempo 27 Sep 2026. Segera kembalikan untuk menghindari denda.', 'warning', 1, '2026-09-20 08:04:42', '2026-09-20 08:19:36'),
(5, 3, 'Peminjaman disetujui', '\"Laskar Pelangi\" disetujui. Jatuh tempo 27 Sep 2026', 'success', 1, '2026-09-20 08:33:26', '2026-09-21 19:28:35'),
(6, 3, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Matematika Dasar\".', 'info', 1, '2026-09-20 17:44:35', '2026-09-21 19:28:35'),
(7, 3, 'Peminjaman disetujui', '\"Matematika Dasar\" disetujui. Jatuh tempo 27 Sep 2026', 'success', 1, '2026-09-20 17:56:29', '2026-09-21 19:28:35'),
(8, 3, 'Pengajuan pengembalian', 'Pengajuan pengembalian dikirim, menunggu verifikasi petugas.', 'info', 1, '2026-09-20 18:06:38', '2026-09-21 19:28:35'),
(9, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Negeri 5 Menara\".', 'info', 1, '2026-09-20 18:10:32', '2026-09-20 20:17:13'),
(10, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Sejarah Indonesia Modern\".', 'info', 1, '2026-09-20 18:53:17', '2026-09-20 20:17:13'),
(11, 4, 'Peminjaman disetujui', '\"Negeri 5 Menara\" disetujui. Jatuh tempo 23 Sep 2026', 'success', 1, '2026-09-20 19:02:11', '2026-09-20 20:17:13'),
(12, 4, 'Peminjaman disetujui', '\"Sejarah Indonesia Modern\" disetujui. Jatuh tempo 27 Sep 2026', 'success', 1, '2026-09-20 19:43:01', '2026-09-20 20:17:13'),
(13, 4, 'Pengajuan pengembalian', 'Pengajuan pengembalian dikirim, menunggu verifikasi petugas.', 'info', 1, '2026-09-20 19:59:44', '2026-09-20 20:17:13'),
(14, 4, 'Pengajuan pengembalian', 'Pengajuan pengembalian dikirim, menunggu verifikasi petugas.', 'info', 1, '2026-09-20 20:16:57', '2026-09-20 20:17:13'),
(15, 4, 'Buku dikembalikan', 'Pengembalian \"Negeri 5 Menara\" disetujui.', 'success', 1, '2026-09-20 20:41:27', '2026-09-20 20:41:42'),
(16, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Laravel for Beginners\".', 'info', 1, '2026-09-21 10:23:53', '2026-09-21 11:04:00'),
(17, 3, 'Buku dikembalikan', 'Pengembalian \"Matematika Dasar\" disetujui.', 'success', 1, '2026-09-21 11:03:19', '2026-09-21 19:28:35'),
(18, 4, 'Buku dikembalikan', 'Pengembalian \"Sejarah Indonesia Modern\" disetujui.', 'success', 1, '2026-09-21 11:03:35', '2026-09-21 11:04:00'),
(19, 4, 'Peminjaman disetujui', '\"Laravel for Beginners\" disetujui. Jatuh tempo 28 Sep 2026', 'success', 1, '2026-09-21 11:03:46', '2026-09-21 11:04:00'),
(20, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Bumi Manusia\".', 'info', 1, '2026-09-21 11:24:28', '2026-09-21 18:03:57'),
(21, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Clean Code\".', 'info', 1, '2026-09-21 12:20:14', '2026-09-21 18:03:57'),
(22, 4, 'Peminjaman disetujui', '\"Bumi Manusia\" disetujui. Jatuh tempo 28 Sep 2026', 'success', 1, '2026-09-21 18:04:55', '2026-09-21 18:13:34'),
(23, 4, 'Pengajuan pengembalian', 'Pengajuan pengembalian dikirim, menunggu verifikasi petugas.', 'info', 1, '2026-09-21 18:05:46', '2026-09-21 18:13:34'),
(24, 4, 'Buku dikembalikan', 'Pengembalian \"Bumi Manusia\" disetujui.', 'success', 1, '2026-09-21 18:06:23', '2026-09-21 18:13:34'),
(25, 4, 'Pengajuan pengembalian', 'Pengajuan pengembalian dikirim, menunggu verifikasi petugas.', 'info', 1, '2026-09-21 18:17:13', '2026-09-21 19:12:02'),
(26, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Negeri 5 Menara\".', 'info', 1, '2026-09-21 19:13:47', '2026-09-21 19:25:35'),
(27, 4, 'Peminjaman disetujui', '\"Clean Code\" disetujui. Jatuh tempo 28 Sep 2026', 'success', 1, '2026-09-21 19:24:29', '2026-09-21 19:25:35'),
(28, 4, 'Buku dikembalikan', 'Pengembalian \"Laravel for Beginners\" disetujui.', 'success', 1, '2026-09-21 19:26:17', '2026-09-21 19:26:33'),
(29, 4, 'Peminjaman ditolak', 'Pengajuan pinjam \"Negeri 5 Menara\" ditolak.', 'warning', 0, '2026-09-21 19:27:00', '2026-09-21 19:27:00'),
(30, 3, 'Pengajuan pengembalian', 'Pengajuan pengembalian dikirim, menunggu verifikasi petugas.', 'info', 0, '2026-09-21 19:28:48', '2026-09-21 19:28:48'),
(31, 4, 'Pengajuan pinjam dikirim', 'Menunggu persetujuan petugas untuk \"Sejarah Indonesia Modern\".', 'info', 0, '2026-09-21 19:55:40', '2026-09-21 19:55:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_staf`
--

CREATE TABLE `notifikasi_staf` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(150) NOT NULL,
  `pesan` text NOT NULL,
  `tipe` varchar(30) NOT NULL DEFAULT 'info',
  `sudah_dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi_staf`
--

INSERT INTO `notifikasi_staf` (`id`, `judul`, `pesan`, `tipe`, `sudah_dibaca`, `created_at`, `updated_at`) VALUES
(1, 'Pengajuan pinjam baru', 'Ada pengajuan pinjam menunggu persetujuan.', 'info', 1, '2026-09-20 07:41:18', '2026-09-20 08:24:14'),
(2, 'Pengajuan pinjam baru', 'Ada pengajuan pinjam menunggu persetujuan.', 'info', 1, '2026-09-20 07:52:56', '2026-09-20 08:24:14'),
(3, 'Pinjam disetujui', 'Pengajuan pinjam disetujui petugas.', 'success', 1, '2026-09-20 08:04:32', '2026-09-20 08:24:14'),
(4, 'Pinjam disetujui', 'Pengajuan pinjam disetujui petugas.', 'success', 1, '2026-09-20 08:33:26', '2026-09-20 20:15:55'),
(5, 'Pengajuan pinjam baru', 'Ada pengajuan pinjam menunggu persetujuan.', 'info', 1, '2026-09-20 17:44:35', '2026-09-20 20:15:55'),
(6, 'Pinjam disetujui', 'Pengajuan pinjam disetujui petugas.', 'success', 1, '2026-09-20 17:56:29', '2026-09-20 20:15:55'),
(7, 'Pengajuan pengembalian', 'Budi Santoso mengajukan pengembalian: \"Matematika Dasar\"', 'info', 1, '2026-09-20 18:06:38', '2026-09-20 20:15:55'),
(8, 'Pengajuan pinjam baru', 'Ipan mengajukan pinjam: \"Negeri 5 Menara\"', 'info', 1, '2026-09-20 18:10:32', '2026-09-20 20:15:55'),
(9, 'Pengajuan pinjam baru', 'Ada pengajuan pinjam menunggu persetujuan.', 'info', 1, '2026-09-20 18:53:17', '2026-09-20 20:15:55'),
(10, 'Pinjam disetujui', 'Pengajuan pinjam disetujui petugas.', 'success', 1, '2026-09-20 19:02:11', '2026-09-20 20:15:55'),
(11, 'Pinjam disetujui', 'Pengajuan pinjam disetujui petugas.', 'success', 1, '2026-09-20 19:43:01', '2026-09-20 20:15:55'),
(12, 'Pengajuan pengembalian', 'Anggota mengajukan pengembalian buku.', 'info', 1, '2026-09-20 19:59:44', '2026-09-20 20:15:55'),
(13, 'Pengajuan pengembalian', 'Anggota mengajukan pengembalian buku.', 'info', 1, '2026-09-20 20:16:57', '2026-09-20 20:17:23'),
(14, 'Pengajuan pinjam baru', 'Ipan mengajukan pinjam: \"Laravel for Beginners\"', 'info', 1, '2026-09-21 10:23:53', '2026-09-21 11:02:00'),
(15, 'Pinjam disetujui', 'Pengajuan pinjam disetujui petugas.', 'success', 1, '2026-09-21 11:03:46', '2026-09-21 11:24:41'),
(16, 'Pengajuan peminjaman baru', 'Anggota: Ipan | Buku: \"Bumi Manusia\" | Status: menunggu persetujuan petugas.', 'info', 1, '2026-09-21 11:24:28', '2026-09-21 11:24:41'),
(17, 'Pengajuan peminjaman baru', 'Anggota: Ipan | Buku: \"Clean Code\" | Status: menunggu persetujuan petugas.', 'info', 1, '2026-09-21 12:20:14', '2026-09-21 18:04:30'),
(18, 'Peminjaman disetujui', 'Anggota: Ipan | Buku: \"Bumi Manusia\" | Status: disetujui.', 'success', 1, '2026-09-21 18:04:55', '2026-09-21 18:05:10'),
(19, 'Pengajuan pengembalian baru', 'Anggota: Ipan | Buku: \"Bumi Manusia\" | Status: menunggu verifikasi petugas.', 'info', 1, '2026-09-21 18:05:46', '2026-09-21 18:06:06'),
(20, 'Pengajuan pengembalian baru', 'Anggota: Ipan | Buku: \"Laravel for Beginners\" | Status: menunggu verifikasi petugas.', 'info', 1, '2026-09-21 18:17:13', '2026-09-21 19:14:13'),
(21, 'Pengajuan peminjaman baru', 'Anggota: Ipan | Buku: \"Negeri 5 Menara\" | Status: menunggu persetujuan petugas.', 'info', 1, '2026-09-21 19:13:47', '2026-09-21 19:14:13'),
(22, 'Peminjaman disetujui', 'Anggota: Ipan | Buku: \"Clean Code\" | Status: disetujui.', 'success', 1, '2026-09-21 19:24:29', '2026-09-21 19:24:49'),
(23, 'Pengajuan pengembalian baru', 'Anggota: Budi Santoso | Buku: \"Laskar Pelangi\" | Status: menunggu verifikasi petugas.', 'info', 1, '2026-09-21 19:28:48', '2026-09-21 19:29:00'),
(24, 'Pengajuan peminjaman baru', 'Anggota: Ipan | Buku: \"Sejarah Indonesia Modern\" | Status: menunggu persetujuan petugas.', 'info', 1, '2026-09-21 19:55:40', '2026-09-21 19:55:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kunci` varchar(100) NOT NULL,
  `nilai` text DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `kunci`, `nilai`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'denda_per_hari', '2000', 'Tarif denda per hari (Rp)', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(2, 'maks_hari_pinjam', '3', 'Maksimal hari pinjam', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(3, 'maks_buku_aktif', '6', 'Maksimal buku aktif per anggota', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(4, 'nama_perpustakaan', 'Perpustakaan Digital SDN 1 Kalidadap', 'Nama perpustakaan', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(5, 'alamat_perpus', 'SDN Kalidadap 1, Selopamioro, Imogiri, Bantul, DIY', 'Alamat', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(6, 'kontak_whatsapp', '62882005509840', 'WhatsApp admin', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(7, 'notif_wa_staf', '0', 'Kirim WA ke staf', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(8, 'notif_wa_anggota', '0', 'Kirim WA ke anggota', '2026-09-20 00:35:23', '2026-09-21 18:16:03'),
(11, 'vapid_public', 'BNxGAtVW5s1vX-tv7Pf2iPxoZZU85UF5yah-0pCBAhfuDmfjFe3pgThF1_25kpm3Hazxb25ZWU0j5R7djSbyMsY', 'VAPID public', '2026-09-20 11:25:44', '2026-09-20 11:25:44'),
(12, 'vapid_private', '1rrH94Q7EDAjMH1frV1TnnDwLO5sgprBCLlQxyrTBIc', 'VAPID private', '2026-09-20 11:25:44', '2026-09-20 11:25:44'),
(13, 'wa_gateway', 'fonnte', NULL, '2026-09-21 18:16:03', '2026-09-21 18:16:03'),
(14, 'wa_api_token', '', NULL, '2026-09-21 18:16:03', '2026-09-21 18:16:03'),
(15, 'wa_api_url', '', NULL, '2026-09-21 18:16:03', '2026-09-21 18:16:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','anggota') NOT NULL DEFAULT 'anggota',
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `telepon` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `status`, `telepon`, `nis`, `kelas`, `alamat`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@sdn1kalidadap.sch.id', NULL, '$2y$10$wF6I/pvCzMbQgzWvBppMJu0LAt9pE41r1FxGs3DOiLpfPjJEV0Zxy', 'admin', 'aktif', '081234567890', NULL, NULL, 'SDN 1 Kalidadap', NULL, NULL, '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(2, 'Petugas Sirkulasi', 'petugas@sdn1kalidadap.sch.id', NULL, '$2y$10$uWL3S48l51.vJFFTO3xSQOQ4Z7kCvJ9x9ScptZQItgJea8JAStKS6', 'petugas', 'aktif', '081298765432', NULL, NULL, 'SDN 1 Kalidadap', 'uploads/avatars/u2_1790124278_zZBFdD.png', NULL, '2026-09-20 00:35:23', '2026-09-22 17:44:38'),
(3, 'Budi Santoso', 'anggota@sdn1kalidadap.sch.id', NULL, '$2y$10$XwxvqL8NV49azyZALlpOXeOpEQQq4gpR3A0bjZtWUX3xrobzS/V/G', 'anggota', 'aktif', '08111222333', '2024001', '6A', 'Selopamioro, Imogiri', NULL, NULL, '2026-09-20 00:35:23', '2026-09-20 00:35:23'),
(4, 'Ipan', 'ipan@sdn1kalidadap.sch.id', NULL, '$2y$12$8sb4A7wcA2BrgurL0Dp82OYKBkelBdZWevus7WLVrt5WNWW84WOHC', 'anggota', 'aktif', '0812568', '777888', 'XII RPL 2', 'Kalidadap 1', NULL, NULL, '2026-09-20 18:09:42', '2026-09-20 18:09:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_kontak`
--

CREATE TABLE `pesan_kontak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `sudah_dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `balasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `push_subscription`
--

CREATE TABLE `push_subscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endpoint` varchar(500) NOT NULL,
  `p256dh` varchar(255) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'anggota',
  `pengguna_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `push_subscription`
--

INSERT INTO `push_subscription` (`id`, `endpoint`, `p256dh`, `auth`, `role`, `pengguna_id`, `user_agent`, `created_at`, `updated_at`, `user_id`) VALUES
(50, 'https://fcm.googleapis.com/fcm/send/cILMFq6NQUg:APA91bFDoCRg76zBvdgM9QA1fi5SlYU-Frjo8KHOnquzt7Pfz6zlYXPDxtkU3pfacY0sAeON8D2kVz8k96Nr5cZbAfg_gxP8zqmuqu8ql9T4s8PiHdKoDKqP70bxlnxUgXMtrSpPdg7Q', 'BN6rkOcrMq1Ckvgq6GTCaBIT_BXVvgsCb26CDWJ1IJds7edzZz2NCfOiUzqpKUAFvpiYwASCrfgGwP0cXhPdnrs', 'sOIET5nAqiEu5aGy9yw0ZA', 'anggota', 4, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', '2026-09-20 19:51:40', '2026-09-20 19:51:40', 4),
(75, 'https://fcm.googleapis.com/fcm/send/fiIsUybcY3c:APA91bEosPAs0bvianeW2jInPf-gOPjklyrpMdP_YfSwbyurWxyBkGijC7JetQLOaLvBLpJJuc38YCueMo8-GzK-3OGdzISl0Kmp0-7XoIvQUbkZ9vQ4ha2rDNtvsBlZxYC-8mO3V96J', 'BO3k4Y9sBrUJj2yesxDu8mJo3LQb9q5LNSA6JaXT1oCEWCsMfFNh6xy8DRKtGu-Cfh1IQ_ALpXaXe9Qgnpwv_bg', 'ga-lzLosmIt3yY2S3gDDrw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 11:03:50', '2026-09-21 11:03:50', 1),
(76, 'https://fcm.googleapis.com/fcm/send/fZPZGJYkGBI:APA91bENHk75FbtmnJHI_SZpwh7VyTHIlB447HTJG-usLH2be1_3AX9E_ipZyxaaAYipJfLR4wAMx7f-GPNbfmHIyIR4KxGdNa37XnlTq-tZfX8L8J3Se_aUUTHVHtGSvcVy4w5ayp5S', 'BO769TU2FDSWOzDa35MH1o35Ys_C4KpDfKxG2LcvZmNCHQ5KXvKnckUDwlHtkZDWeyyJDcLpfgbVoOXU44bIQcU', '0ITnbv_coPyMl971fg5dyA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 11:22:02', '2026-09-21 11:22:02', 1),
(77, 'https://fcm.googleapis.com/fcm/send/ehB5IHjvs8k:APA91bEZAlydPEtzE0NU9c5n7IyQdgDr09YXGSh635BQ9wRnCFIVosvFrsxfBLmVQrMhYQWSqgw-t8jqnpJjQWKdJ5gLvvGFnUFLMo5Oq_pXihjDHA5lduItDCNqpse0ebp95HlHAjSQ', 'BFENMttQPp1kqu5WeXeKXO6-onlNQaPqBArLGEUPY8iUTdooZ0rEGyhHapG_lLa4UE5wS6guZTsM8EtYRMUvJEY', 'rvvQRVywzkNrp3C8Db9Dtg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 11:24:46', '2026-09-21 11:24:46', 1),
(78, 'https://fcm.googleapis.com/fcm/send/cgjU9XpGBgU:APA91bHSAFcMpMBNdOqjrFOiq0rwyvf1123vYqQQf2iFcsFHpMcd9f4on6CZ9EnjV_QOZRlcRNNgzkwli4_wcTTP-CU2U2NxJsV4H4woQ2vU4TIhv6SkCJLz2AIBySrY9SpneEvrgaMh', 'BAwGpNmbRp1hN8C56NsmN5cHWFndbcmtlqSp7ps3uIwXdRGi9bUBqxn0A5Q46ywUL0E8NrZZ6B-25-HWWlcAzqU', 'wFumVi1w-KAaPADhmJxmqw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 12:18:12', '2026-09-21 12:18:12', 1),
(79, 'https://fcm.googleapis.com/fcm/send/e-uF96Ve_mI:APA91bGK_TMa48-iRDHArVoptxnaqDFWpyKCDlVCf__C9Un-4ZwO6NOwmVddhjFkTA86RrXXHUHMqD_Wfis9CVIdxeH_UeSN7tiXzSVv6Hv_xYJTviPqtAnL6WFk0Wg0KBozf6yu1aYX', 'BIoQ2WpIRVGy_6-r9WNN-aoEZc38ksKhjRXVhG4W7aK_D9r1ulO8V-DODRzflUTAq9TF4Ey1ORqwr0HkjX1A404', 'x0A-v0mUPX-SEtcQhtNo1w', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 13:18:20', '2026-09-21 13:18:20', 1),
(80, 'https://fcm.googleapis.com/fcm/send/elm-ENcTe5Y:APA91bFCPxfLUEk5QH2ivwxgSbVKxqqefY3gZiu7MOp4QphfO_--alFL7XuR6exRhPxD3ZaflQCjTfbAE17Tp3pasP_39IgYEEES8bGIVml8tcw9djmH8xW32HU3CoERzLpo-EuWBSdu', 'BN_CwG0aCAL3t49p8qVCU_FJPuTbwbNfa42H1Jyb7Z-H1_CGxXDTjSOvBDfB5K3QBhWBWXwwzNU8ZJ4e24fA2xI', 'JimKpi1yWhEACx3m7Te_WQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 13:18:34', '2026-09-21 13:18:34', 1),
(81, 'https://fcm.googleapis.com/fcm/send/dnqBQCfbtOE:APA91bFchOa17nZ8Fj3HKNMtq6qp0e2GWbzl160eHq82ICcnHh1u4CzEu0On5rjJFG-ENlCuxMzjmZtDBcTkm_TRWDDkrdgbOQKYmB_WLm_ClfI4-wEQVW1LRVJsV35l86o-hJo8hVFT', 'BAyIKkoiK9TjhOmpL4MxCrFKkCHjoyH3y47DBefod9A2ToBGoguozWxuDVbPCTxAiVQgXsb0TAhw_xB-qDg70_M', 'aze6YBLz5qvQcC5_uJHuzQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 13:42:16', '2026-09-21 13:42:16', 1),
(82, 'https://fcm.googleapis.com/fcm/send/dk4zgfZtseM:APA91bELo2CeQz2JOSd9CdP7pUkdpUclymaTLshiUNkbdkKSz7ziJVXbGhU6qLM2UAErE9vNG0vCjxAW4LRVqZ3lHk-6x__Bs-aDDKMhaaNCXupp_PWST5gPBoxX1Thsy8tJHNNiqSTe', 'BJYFJDPKkavzgPpMDThUbJ4diu1xV0eHuleGTWVk0kE9Ferky6yLl0GYWs9ekuTkCdwdJbzRETZbjsBX_WOPIdU', 'wN1ZGJuUmbryWIm5VbBoog', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 13:42:28', '2026-09-21 13:42:28', 1),
(83, 'https://fcm.googleapis.com/fcm/send/ey-_TFfxtp4:APA91bGtwUPhg-CV1JGC7mYVuWw6FvVuAGN2yccClsmB_nVf8Jum1G5o1S1USggyraGIzlM2cejzPY-kXNoCh2ITJtdYhlvRwT7JRLphz-Ab-JXvxhyoQuuTN4vSu2R313BJkMgZPvdq', 'BL9j9J-BQilE67MEhQ_Dw1hQFZkFfEphl9g55cBcHCY1RQp1u5JBoSG6F6vZIHuV7ojrouF1PHuoKrOSk3mmSus', '5YX9mKunvAJaA7SMPl1ZIg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 13:42:53', '2026-09-21 13:42:53', 1),
(84, 'https://fcm.googleapis.com/fcm/send/f7c6YcZNV2U:APA91bFK8fAFrozxWkNQh460KGTxOiSGqP3zHtLcGqG27EfBBRy51bJV6JpbSvG1oXIsjk04revdmAeEfNtlkykj8SosHvvgxKLT0olXFTFKIXaq2pM4V3Ah64XU7LxHLzwCNJxKQX7F', 'BBAVNEb_k6GWuuW2sNlIX1jFJQHIge_DqTQbuI4X6LeLM87iJnHgjkvFIl7obEMEWJHDBgI5CZg3MUFXpLR4UxA', 'kw5MP4nrGHKYjyoChgNFRg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 13:44:43', '2026-09-21 13:44:43', 1),
(85, 'https://fcm.googleapis.com/fcm/send/d4uPu6F0y0Y:APA91bEkqYViZGnqFQ4dOonHH3GN1mzeRt96kvLNdpFoEEDtMfu_Un9f-naADJWAll4wZP-bdJyRTMHTYWO1Tz_O0oMDWXDxaDrlAwmYdCzVsTtnS_QNm1eZooaqxSwLrfDdc2vnRNKt', 'BCSWbc5JwGKyUFOFZD6UECLebYOQ_bAEdLQOoRZiQXvgUYdXs3rmnvizVbXQp2CwgXFDfaYmFd7PZm131O5gGoc', 'dff36aj1wG3zT0PD1G0esg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:04:30', '2026-09-21 18:04:30', 1),
(86, 'https://fcm.googleapis.com/fcm/send/eW9yr0eRrWo:APA91bG9a0GqenBDt8lminTUMFfiEYlwAGDk_1XoNta4t_UW98EYvYEnu9ZMES-MvpaO8CADY25xTgVSA3muIHUcksUPd5R-lWJf0FAMcUHIg50jJXNcWMMPgYYUTmXHXvqXAuHU1Wgk', 'BGJESukDYoIQoQ3u13K4irXGjKcWCzkeHDBH8j0ubB4uvNeE75IFu5Tdu0XDoBvRTV_Ge73dFiqAbdqkCOCeMXw', 'WVjdqH2dBI4hjzBo94WdTQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:04:35', '2026-09-21 18:04:35', 1),
(87, 'https://fcm.googleapis.com/fcm/send/fWBQ7GTogYs:APA91bFF5bU19-Zw3bFHuKrrkOpkGSzgJbA4FUpJdWczakNYD5DOg4j8usexyFgDvUzvClfdUri8UTJlYDtcqeyh9aMGXjZgsUDl7tkdm6PgMQfWujCQTYxvXZUdPqP5NKFe0_qcnDCg', 'BK6h_GGOa0R7k70T7Pdr15grIMoCy7FFVczfmJZooudwg9NfcJbijRJCOT-9n0PyYrRHiHwZoS5GnnbcadMZv18', '5ZyjfkdVtFDvwYR-vu6Ppw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:04:41', '2026-09-21 18:04:41', 1),
(88, 'https://fcm.googleapis.com/fcm/send/fb-MSPlxmb4:APA91bFPhR1BP_3gaThS9KHK4q-w1lol6w5ltNUth_iXlbAY9iuHmBvoJCE7TQeGCcJl6JLJyfjLVyp5YjYdR4V5lKjt98LvLzI1T6BjZzwFoeijFRXZef1Qp_kZRX3K3MVwiKyOFF8i', 'BI67lJbgUxSJvGxXAomF9x1Rc3aELAY-fmupvD_3-HhOuGSrzuhxmDdEp5LEoIvReAsM0nthvzM-qghDJJdy9z0', '94IP7Gxt3M7y1r1cVsmw-g', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:04:59', '2026-09-21 18:04:59', 1),
(89, 'https://fcm.googleapis.com/fcm/send/de6xzjBrXpY:APA91bHOWKRn995VUFCHzVvM08Bnix6wrofi4N3GcXOjjnysgJz9rSynxxF56l-Wvc29YqOzfnVWK8Hsi395XfTrJMo0t1dwapc4ccwQl3ng0GAPB9KsMsey9_BTvJmB5ozhMiXrgoc0', 'BDzk5TJiccCO1mjCNc746851xCgRtDjdyna98jGMLYQFOA-fic-8-VKTL4h7FGOCIctA9sQGysdSr84O5FxSVdQ', '_97ivJDYU1x1zdWftBka0g', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:05:15', '2026-09-21 18:05:15', 1),
(90, 'https://fcm.googleapis.com/fcm/send/eKKj-RSf7A0:APA91bFsQYfIqjc-4n88z4Cr5QrLVDAL4EMfZpz8F4nWkEWfJN0TLHOh1e4QSNRLMDH8YluFD3H41Ty9EFGlESU7f5siC_688wd3O08_VKows32sGW70VablK4UUHrMrEkmkEXRIullE', 'BIFou0rfn5h1IkPHy7Ty7n3ue-Q3yZDvgqPayOCrKbhF5F2w7Z2qIwYr7lmIXvNV51MjexMnEycNxBiM2awrCz8', 'Iht8EWp3zIKmpjFcN9SBdQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:06:11', '2026-09-21 18:06:11', 1),
(91, 'https://fcm.googleapis.com/fcm/send/exQ5iU2jGsM:APA91bFTKcCqTBgkr-SsFLMC8_c6rvcHG4CthfZgodEHWrB2aBDZ5gQuOLzxfFzvUSKis33c8P-2-C209e2iiz3KRUwq88w0UdDXN2MHz7-TmwdpoOhwDeyuXjcLy5zboBw_mn8Jwtmi', 'BAMLeL3YQISH840BBq1lqkX68BxbPflpLztBUxYOj10heF_wHPIrK-zdMk5TpAHDDZyArZuwh0I--A3U8y1UzYw', 'knSZUdc3aMRTVgZPbkTbrg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:06:23', '2026-09-21 18:06:23', 1),
(92, 'https://fcm.googleapis.com/fcm/send/e6iXTNcpILk:APA91bFtr-RNMbbBNGT5yNmNMzdVbEKr_ybGg7hlDeou5NJqab1QVIt9INpq-EZarSCskIWajj9TcTbhvLRz9h_sb4KPSVKWyNOnp1egYjzYL39iIenuGRp4qnvLfA3XU5hTjKp6hFcR', 'BNakaU2TVVayHBNcxZEMhWAd_Tk0_xyfV6PfrrQe9rAq8qlpB3_A3lHo-uYuvVBPtM3D2AUaMUz2dkRkJxVtAeU', 'UqLIoF9g7nPLQvHOFpWVLA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:06:29', '2026-09-21 18:06:29', 1),
(93, 'https://fcm.googleapis.com/fcm/send/fP4yTxKMTi8:APA91bE-AcB5PMrZrzLdF_wAghH51irvcf9hmT_155ULtW1ER93voGndfwkAGYkunQmZMyI72EuR8IsKPD_SJVBeg-BHxxSvEFitvbr4HhFNcHK3rYp7evNA-BLVYlG_9uB87uQrZBtQ', 'BGVO0LH7pN4PYIrDP7wZEBJ0k3QFq8PZY-CvabsgYHsWW0EonwzIaxKosMmm6Nbfk9K3S6OGpOATt-Pusia3w70', 'Iz5BPnAosSAtDi5DKMDNeQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:12:53', '2026-09-21 18:12:53', 1),
(94, 'https://fcm.googleapis.com/fcm/send/fjXtTw7TkHw:APA91bEd_tnTh_1S7YwHcPXV9DLlu5WhfJaImmyRhpXK7G4oBQOoYOHvnAP4KesgIelvlwyFfnCQCxNcZH8F0egEoNUoh32yNX5JXpjc0BW8-N3lqxQ4DaQiT5m-lqxOWYLAiPSZ-i9F', 'BItLyHlMevCJOM7p0BV_gbxMJU5bkCSQzd0jiuw52FfSVOdcEZsLMDyUPUW1Kr9SV4dEIGSis_On1bCVPgY4pwk', 'hGmvoFPUsFVXI0rWaA2Pmw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:13:02', '2026-09-21 18:13:02', 1),
(95, 'https://fcm.googleapis.com/fcm/send/eprcdRKztI8:APA91bH5f4MJD74YxGqQiH7Rp73Kt-4Hls9FzZYKSgW_oDa37dru8j2FcCulkNufuriPGNIzkbwqgrz9Ztpt4CSbEpvKMH-lWoOZvMcqvQQyc88FQKIfm-VMNWrWFoxSyDD_LH6ndc2i', 'BH3HFVCIr5slcHOvdmINi0ryZ7RqXtCFr5_Sof9MI8ReXnJf-qqbtuvSlmCjpDxTal69zUMNi6qCCjA5rODsDyU', '3Ub0kz5jATbAbWmps784Sw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:13:51', '2026-09-21 18:13:51', 1),
(96, 'https://fcm.googleapis.com/fcm/send/cUcg8DoJcDM:APA91bGFW8MzW76tHQddwH0_99AaeJMfvfEKC-aXLiyG4bw_mZr0_kjXwIQbKzasJlhomfWfkVDXnzv423RGlw_CxaZaaHIr5Bfx6swLefMbVc7v-d_u19zeGsXjMxuRuTvUoQL5DWVY', 'BPGZnXeUwLL3m68E_MuA6I1g6WYmGmE3ZMTNsKZzezJ8AhHU1N5OLpNpaOupdPs8YvitqFOnIrgXa1FCJ_sOSa4', 'U8ALzSaJUPS4V60fQ0r5MQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:16:12', '2026-09-21 18:16:12', 1),
(97, 'https://fcm.googleapis.com/fcm/send/dULRCW4mbtQ:APA91bF1MbUrqQWxSLq96LBBwjX1vfENJCzls8BPUDG1SkCJ5TNEYCoB359Gh2rqZIG8UToj_gvktTBsXiASclnquR5IQEJsTCK3xO-oM61f5Yu-N_MQBfYblCvUGkCK3-3XN8BU_zl-', 'BGHlmi8pDWT0qxs9HgSX-et0EjKINxyRvKxJ5C0qA1K-phmQ-6jJFMN0Qzy5j-IvEfYPjkKbX3LZxMRIH0MOOe4', '0_1j0yS7SUkx0INAvzoU9Q', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 18:16:18', '2026-09-21 18:16:18', 1),
(98, 'https://fcm.googleapis.com/fcm/send/dUJnUAryYlE:APA91bGflrFeFe1mXqXAu3dOAVaOGqAmsKsf_EQcSkufYWdsfvt4M26JVmdgfLrtwgTxQYZrqsIQGHnhP_C7Ho8WOW7Py-sXJLKC5low6BntK1KloywCGvmIQ05l6K4xJ-gkoTRMAXMO', 'BOlqrwdD1wncpjypy5I4_CQhxsDsB3lPn0MF8Hyn5IsN3ZE3CnhnYuCsIXEaaknRRFAobcdNVgcYCBEp-2pq3lk', '2NmY87GGWvnYYUfEjL5CBA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:09:32', '2026-09-21 19:09:32', 1),
(99, 'https://fcm.googleapis.com/fcm/send/e1SkzlJAMv4:APA91bF2P6q6K9Mef3RFqBW2WuQ1uNf8BTZ_VL9Z-gHR0SvbDmoYRSM68mOezq4taZ9VXHfpFxPoYOi1WTAsPyy3oRHIpNI7JpKErukwsHPpGMOG1dSMKdYHJLTSmkgWQfWAOddTx1ox', 'BCMrPsOHdhHJikxKesQ5291__JQEebCc7-SlETlw6fCy-Yo_TyjIRI4kj_NjDi_sQ5rsVqBpR9c0BJSXcbzfXc4', 'nqtnLPbQcywXoT8Wqhq_LQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:34', '2026-09-21 19:12:34', 1),
(100, 'https://fcm.googleapis.com/fcm/send/fmCfDm4DssM:APA91bFfwP4leUJZ4__dkuWTBxvYSpUCDozFcVeVCxi6aFJBb-TfHj_V_-AVKac6apWqwwEqk637HFMTfnpT-HeJ-eIh2Jq3SPbnphN3dMDFI7ZuDYvxjGKpcGy2aG-Om-KiINBUlqEq', 'BP22efRb7x1im2lilWG7VIloKaANtkuu0m19I03D0OA9ixDx8uuel_GzgmnK3m48FCVDm_-ycqFhgdveZSTrD6E', 'Gd3mCq3lG_Qs2h11ScNZDA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:35', '2026-09-21 19:12:35', 1),
(101, 'https://fcm.googleapis.com/fcm/send/dwgM0XHXnJI:APA91bGvrftOLuvGE6-rJoZ_kHSt3CjJIeaCTzI9p-x5dgoN-_yt_vutc5lboJWSmNNEEeWccjJ1eZ3mCJNhhJNIFg1inWxrW-sG0lbXhTFWgs7ZE9Xg5Huo9Y88rKQL52IAk5Tu5tcY', 'BKIKy52FnlyvCnReMXAKdA_3fHCSijPEL31_whSuvfVE06pFsS6-M7db9aknErPVl6upEOkvMhOaezWe9U7wMMg', 'BdrKe2LxrOkPyxFG1gk10Q', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:35', '2026-09-21 19:12:35', 1),
(102, 'https://fcm.googleapis.com/fcm/send/cgm_R0EFjW0:APA91bGFSOEzHkO5X7_1qvZ4Nr3i6RefP9Bk4xzMWuLHD8jJAK3YNgiwKN-ilIQ5ZvJ5xUhEihG3p09ydlb0gFd6thM7rS1qwJum-ehmdxsV5PYL09VUJSe2uegsoaTy95Fn8w4ns_6K', 'BAci-mdJmwY_Z-UbWLcHCdEX8-8agotG9ik0eic0tlO7u3c9t2waOak1-qUwZWig70xJMxCLg5DS_bA3DqCUBcU', 'BDy9bylbq6maKd-8XBne1g', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:37', '2026-09-21 19:12:37', 1),
(103, 'https://fcm.googleapis.com/fcm/send/e_iodK5aLPo:APA91bEHavr1FAKfOGqFa7azLOKstgb2Br5eZ0kbWv3P0ohsinimn2lKlSLKi0JoLoCB0t10922MYHbCFLCxuG7Pl_ZEPETdOAIJVcC8BcZoeP8CTyis9RMArfDhMYrWVuDSjwrKgwAt', 'BIFEGvzEAWln7KZZhEKypdMaLsTnYt3_AWaAv6onZ9AiFjXBOyHE7HA7beIm14lBJOMk6Q1nU_1hdgZc5Umw4cg', 'zzAORhx6h2KLmwAianYO8A', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:38', '2026-09-21 19:12:38', 1),
(104, 'https://fcm.googleapis.com/fcm/send/c2vM3kT7ZDw:APA91bFTDdoh1IPNU-BiqqrLXnsNjV6VSOwAT2IE9SUgOJnxo8MB21b1YZibw-36PFkkzWeiB1q6pFXj15WXVqWYPkWxX0IEdAgCRnoMroLd65qiB6YxZtw8u-oe8x2PhvhTNlcdPw_-', 'BEGDQQ4iBYnsKNoLvGEmqfFaF73QrL4IGRVkyyt2MhFGE7q9KLfYtyqY8xCavlhN4BBZ5RfiuEcPd6Hx6zR30As', 'pSUSdDwHtAM-DQzqa65RGA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:46', '2026-09-21 19:12:46', 1),
(105, 'https://fcm.googleapis.com/fcm/send/f9wmYuBcDns:APA91bFyphZAqyTVmxL4CB20rJL_5MTWRpqxC6XhhQuDTWExU_Q8mD0MF_LHHROWkaiGkbZHImWt6ZA1myrPjY2nzfzyIajPQkjCazGTlu_dGVGX2yp3Hn7m0EeCvgIRU2OVcdaCbMrv', 'BAzzc7qkfZGmwkgSG5zLPRHtTl2XnBMT-Uum9PsQmkQo48BFt3sHARTZTch79kYqfZ7V5pP0YJhcCKBC9-A9ZA8', 'KiqOhp_N1Rr1xt3JvgcTjA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:48', '2026-09-21 19:12:48', 1),
(106, 'https://fcm.googleapis.com/fcm/send/eGggWthFGPI:APA91bGiLLVk_l23ShJAF88rMzCM-X10J-Pkgnd_ek9A-gJX7d6hbIrG20Ym6oxe0fF4eF9mrooyFIhh3tJdoYqRQZyDgO8CFmyFfSBmAiQXrxRFjCfuRG_mIrq0kOjB4sy4LUnrBG29', 'BMIacDT10pVu_bQ1N0R0BC2zvTe01G6sh1ZZmDLrTlhQw56LamwsOSpXeZraUJb_HcLw879QYaAK-VOC_1YSzlA', 'Bc86q9Ix-iGM_V8S3Vojew', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:12:49', '2026-09-21 19:12:49', 1),
(107, 'https://fcm.googleapis.com/fcm/send/dYHDZh9Jncs:APA91bE38IkI-aX_KClZU93a7KPbIJ5LLxTumWgNrSRkqSCul4Qcu88OS12KPS7Q9slVy7mfXjNrsOWFJUS92a4frt5EakYnnkS1QNHxlBdu8_tAWRTGH1i1EGa9Jr-xnTpsKHLMj6gs', 'BKAbzOfaktHTGBQLS0QUms1WTutZDmTLK5k3ZN8-ZHMMQA97VrdMGTk4icCROx210wN--9SM2nlm-F50X2tcHdY', '1Fdwu70ZcdjnrDSn-_q2Bg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:14:23', '2026-09-21 19:14:23', 1),
(108, 'https://fcm.googleapis.com/fcm/send/fgG7PC9dIPA:APA91bFqITN4StNLDsZBYbkc2_-3fNhG-5D-v-to0n4bTEC4koAT--JAGRiWOtl5gVsP6wecnM1W5YZ-WGW_5BWsKya_IWxhl0HQXif3qie6vuTCF4QHPU3c5SDB3ItJVidH83Cg0Fx3', 'BBtUUEZwOzxIWUU59JeY7m-LPy0_Kl-wGXyAQPJYEhpaxY5dXzjVgyX-E13uAokxUiK9Y7lA-OR1oHLb3yJWiW8', 'VjKDx7s5xOsLwPOJnQbRQA', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:23:36', '2026-09-21 19:23:36', 1),
(109, 'https://fcm.googleapis.com/fcm/send/e3-oKCK4hqM:APA91bEqJ5nL9vwpsiS98VnhG32ExN__ytuXwI2LMhAcGr5wEXq_qwSjW3Wi7OQp-Insxj8w2iDn3uO6d4zI39RqOXL_a1l97swRl4sElOK8bcczteb_Pl_oYN0RVQBpX1nIvyUMAhyp', 'BCT3Eeo_qQiC356Z5EOEDjtkQgWBD55GjAZW5pjaSkQOtoKcNLhbKBAi7F6CPC3BNx7q8ry52fOi39f8HVY_n8A', 'sPJ3WzTfW2lwVXLjod4nrw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:24:26', '2026-09-21 19:24:26', 1),
(110, 'https://fcm.googleapis.com/fcm/send/e9TQVmACwzg:APA91bFSUU6sFwe0ssmGttbYw736In3ASUoz42jAY835KsK4UIzx7ObT7yafOIRmOgBYTEiAcl0oELvgC8hjCWGqYicML9x0PhmFmMAY47L5zDmiReR-_5N6YE_SxmlISCk8uEh-XAOW', 'BBZUf4BthlwgBKZ8lpaWTpF5161J9N_aoGKTrnMn9BxQ5hF0-0-bt0ZoKZijeguKOnQlYInYkcal9NMYPbbO1n0', 'wNH6hTpVPIHB59g9qdXCdw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:24:33', '2026-09-21 19:24:33', 1),
(111, 'https://fcm.googleapis.com/fcm/send/fJnjLlRi3os:APA91bH48kiHYhOn20g5zu-CzHU5hh4Uo1DdxUVoYCoD3IoVGrRoPV3Ozw27usAwcXS5lMUv1EZUGvploVEVTQ7lA6hyiNqrYDfVqCtC1u-GrnnzS-o0LG4zI9M1MsWh4fVD2AjdePgf', 'BMRiG-oUdCiwmWiGMOk8hohnaDJ_ilwvdZsfx0x66CE8sZ1OPtzqX8yZEfYDAu7AUb9NknzDURsuL2S3ibDMdGE', 'uyeSfgC_OT9j95WPW43Fvw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:24:54', '2026-09-21 19:24:54', 1),
(112, 'https://fcm.googleapis.com/fcm/send/fMsvFFBQxm4:APA91bG6-OPS6lwKNb2LvILQfb0iIzWxiDXfzVXM7zyZmzYv1oBLSXBhlDKqkuTNQ9A6mOhFsr6_2NDCCCzWuGSuTebAeudfluMvQK3SyC8FJc64QvQMxaWjb2dyBPZ8dMPtxyEtH9QF', 'BBdwhhEffSj4sgxsWtB4rlaDRpuNuxvJE_kGYKIPQsg7L7lr9iwff-oIrAUWhG8ycgeaHYE7oaweh8kW6kj0QRM', 'w4INjigtj1lXVg5fpJWwoQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:26:07', '2026-09-21 19:26:07', 1),
(113, 'https://fcm.googleapis.com/fcm/send/fvOLnLkx3xY:APA91bHvi6hk_-kXLAE4vBCjZa1VN_Epd6eyy44Il8nDv7T641EKcZEF2DZOGHt3E1QzmUkO9_EFkAQ4vWqySGlH-I1ViNbvFlmz1VT3QAmSWU8GMZ9I8QBInzeqK8oXtZWkGKfVUSlh', 'BItdiHrXJq7UD3k7weXgkRF2Y527oytgWUM4jFZlNxk3P4PjFiK5KGA5jPQ0g-F0KIrDxnK7Jv7Q70sJMw7PIAA', '5s3uPrD1WQLz67ZdDNMX7Q', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:26:19', '2026-09-21 19:26:19', 1),
(114, 'https://fcm.googleapis.com/fcm/send/cc7lFI6Ia6I:APA91bFFVjn6jsTcwHetWt3UMvnW3s0PiDirbCEZsgv_J0HfBxCofDu6wgzLnZOSI3huki7wEaXBJ0U61PwLrIXqHuVTqNN6UBoa2Z7wCJNFF4XSPXwHJVAzElr5QrzOBz63aXxRgjCi', 'BOd3UOaQGW7Y0l4wuH-39HVVM35H3_HAtHSS--HQksPvxPYQ7Y8HUjwr76wUt09Z-QwDJB7PmhsbsK4-KavVrNw', 'mO3WSRgSVvdBUvPAsr2sCw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:26:25', '2026-09-21 19:26:25', 1),
(115, 'https://fcm.googleapis.com/fcm/send/exdHrHdoUdI:APA91bHsB6EgkOz13x-Jqzbp_T7xBdLCYETgDQJXB7M_TG7EOf5XypNP2bvMQ5OYYhb14kyPc6ONdubw3S3TQie7LcyGmUKOM6dYkWh4bDjMn1z04sKg37QbxBc4pt4X0LAMkAhJZ99Y', 'BNrw89aUw8uecojD5Iz-IzHaGVTGex3FedlG9MG6Q_z96Tu_A8mSh3RVooWmCBHFdcd350E5Q8dHKtl17hQc12Q', 'GjJHUy87hF6vUt23Z3a0sg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:27:04', '2026-09-21 19:27:04', 1),
(116, 'https://fcm.googleapis.com/fcm/send/dOLB-C5Otp4:APA91bEQyy3qTZHBel0BScx4XH9W0eog9RiqXkqcFiuI_duNPzzavobU3Z_mGRIplQ9rLRPhy4FKkVUUksPsUoMwWd2DAVN48WaFG8-VyUPaMq_h2LJvUIjsiQ_mJIIqMCs3lGr2sgKb', 'BCjK02xQPa0qOrfZeq46scGBK9gFYLVJj4T1CkJcmm-DUDYTJ03Mi2PR3dQzrdb1cys2qhSJKoGKcAJOpSDg8p4', 'g1F_ZUkiAz1OG44LWN2UTg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:27:29', '2026-09-21 19:27:29', 1),
(117, 'https://fcm.googleapis.com/fcm/send/dmI6VifOmgI:APA91bEvAWS8M4LSajeyAOx9SSUj_uTZ6CM-ulx6OxdEgiiwGQCdbRfsxe1LDTNIIk8RoLFp1LvnZisDgx9sZR3OwNHu5v6iHTqWCVY2tOkmZWRsyLwu40DF4m8YuKJwfqjD2omv9xly', 'BOrqjmVpvY1Di9R2p-f-f2ctjGGNSTEQnFSTmH3fGB1L79bundzNJGAhmOOBBQmseC5uK9utSN-KtIgGVbZZSG8', '10suHw_8hCyPzg4EIPWsuQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:27:31', '2026-09-21 19:27:31', 1),
(118, 'https://fcm.googleapis.com/fcm/send/fSLXJnwyrEM:APA91bH05zmSRpOw22bOc-hG1jsmanz-RGPDfvvpcYG85GGWCNd76JkFePT6-XTSg7vhbxKlSg9-4dYDeA17_NGEzdd5DabUJAwEmCsbusazP2IEAyLmizGIioV--BGLgiN5ZIF-VaR6', 'BCJbtdiQEHENF0dQOj8CHvDMol_-qnz3rU9y76251aighsVH-emyROJdnmJDDIyXJ-AQp8zDRDCRJP6nK47rrHM', 'M2RW2D_dggE6AofJWMVxpg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:27:31', '2026-09-21 19:27:31', 1),
(119, 'https://fcm.googleapis.com/fcm/send/c-VJ41XLSkY:APA91bE4-Qf1RN-9nq2LakwsWOPPpfwCKwojEfFp6PUagCz9lpqRLaQiMz7HwPMz470tmHzDeWjN17iJ17fqcerdBOz0C-TMD6q8QS5albGtrIIiN_qs38ptuy3caVwGI-b029QQTBId', 'BB6haN68W54FmOQdPgziR0HTRlJs0lZMaH1RvU0h6tGmzCG9uunNljy3Crte7hQq__un-D7Fs-0Q7rs0WzJ5brQ', '6RTUiWco9KQR9EO7w2hFWw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:28:01', '2026-09-21 19:28:01', 1),
(120, 'https://fcm.googleapis.com/fcm/send/cn8r2TNyrNU:APA91bH0AW9Kz3cfUok3UW7rqywnp_G2NTaRYAnLAHPkDD493zzjCBXz1FjEN_i7YjxAbbxqnNsiSjUW7oT3PNn8a7ZTmk30TS-z3efgpJ0lMiXgPY4YbdeQHpqgEHjYaXH-Zf7E2xAj', 'BCZ3uaPInHL5SaWI15MVnSb8B5MBpK0MKLCt99nuA75S97zMFcA6rLqFc9Kj-upx65FeirXu6XVbZ9RooVOrCfM', '7_D0DncAZqXmOeoKbbqIqw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:06', '2026-09-21 19:29:06', 1),
(121, 'https://fcm.googleapis.com/fcm/send/eByYtlOdMQA:APA91bG0z9OqalD6Wsl1fQbgsZBcRgg4_c6x0dPQ-61ED-rMZvB7UUc_jXrryobhGKuCK6dkUJOXtDap1SpFA7y0Gk-9sxg6h5T5SFb43oPKRXY-PVro9kQMN_wqPfa1tJWVbZgmRM0x', 'BOjhc62KrrMH0ibui-Iwn8BccFQYreZtB8C2f-2zQZM0j4zSeBVy_rvDcSsIxPdPKUWQZruJc_L6K1sAQY46Q_g', 'nO6eaa4r6n1JPMdM_93vVQ', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:17', '2026-09-21 19:29:17', 1),
(122, 'https://fcm.googleapis.com/fcm/send/dMglBppS80I:APA91bHhOipr0vIvdkyKCPPEejo9Iesc2LFDTMGC8PF7KvmxR0PmIIAakS0jnHvem2heHY48WGLmfnuJqfzyytB5b-_Mq-NiuJptko4fbP8_Sm6TBVsBIg5UCl_5lq52bol1sIoKcdd-', 'BHBXE4StccKtxIhkpDf5KISCYQJRPv6FV_qKi0NiyfQsi0fp_idhs_nIZmAQC9IBvq31K96iieVDkoem_i-mrfs', '40Bhjggbj4jX2zNK6GXJeg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:22', '2026-09-21 19:29:22', 1),
(123, 'https://fcm.googleapis.com/fcm/send/fu_QuD_N2QQ:APA91bF-JtlP7IhdriYS4gigEsgMjVnjEpxrG410aafEsgL6lHgR9s8qtf30xBzsAzbyMPXIw4yNaZXQl8eVFdPkjsWS88EiE-f017Jb5AE4gZtUzIt-OpAKirn52tBDdQP3_le-Bf5v', 'BNvLNE5uvJ6KiXPJuqvQ-DNL2bc6FCF1W9qjKv59VVED_QNdUtCskxL6AkEMHry-gZK9w89a2617_nLm3BYe_ks', 'n7fIHMzYZHD3o5KAqwScNg', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:23', '2026-09-21 19:29:23', 1),
(124, 'https://fcm.googleapis.com/fcm/send/cpHHiLOi5dw:APA91bH8SIxODjsLLmhEYvMSVMqZUwfjCQ81z0YQCq63FUZIduN9YgjFVjo0ceGJUJucKLfmI1WSGPAynLEQr54h4CXO16Rg3oydM3F91uFu3bUAMZtz_H07NukW3RiMDXHood9ryVfQ', 'BFuHeVVmb3lt2kfKx3wwZLnLeceLEc5hSsBfVJoVSncjnQYbaML8kVsZRLBM46WKmsMvjBwNCPYupmv-aDQ7t5I', 't2PgNqGYxZvHakyQ8pj_Kw', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:24', '2026-09-21 19:29:24', 1),
(125, 'https://fcm.googleapis.com/fcm/send/ekLInt7ycm0:APA91bET0fWI6C1K1BmElDhgp3V24YpxvkqVAn20Vzd1FGTQ_sKCm7SgSmWa8y190FxNqu_9idSdQLCrMv5WnTAXpRpOFmYrihXQR_AQKG2Cj-LSaqYBKSGr7orBXyPLPMebgAIsQI1D', 'BAm3Z6hZc44_iuy1VYIo44LzIBn2wxG2YKnVF_OKJcU7J_O1pMsn13IRx3lXR6Ezvc2Jte469l4SNCR-oiRru0Q', '7j4dphi79gLQVBZgSTo28w', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:24', '2026-09-21 19:29:24', 1),
(126, 'https://fcm.googleapis.com/fcm/send/c5jB58BXP2U:APA91bHS8wRrwMNPX__VcxZ5BhfTir6bSlYDMeo7g6APlIqF5asJdUsdz_xsk9b61RNY4-vRIP96WpoivWF9A-7Kyc3lTRJbOydkPVZQa7fKFfIPm3Fi4ZVRYT4hmMoQHVItimcY5cC8', 'BPsgX2mea7rWVnfkygMIvK9xf7QQ3Ud9zKoQkpA6M43bWWA6xWw5SXNEurEh_RZcy09_uSc5t37ZDcYrW9TeBKU', 'FcfHAeEDexC3a0u5naW02Q', 'admin', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 19:29:38', '2026-09-21 19:29:38', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(40) DEFAULT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `lama_hari` smallint(5) UNSIGNED NOT NULL DEFAULT 7,
  `jumlah_perpanjang` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `tgl_kembali` date DEFAULT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'dipinjam',
  `denda` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `denda_lunas` tinyint(1) NOT NULL DEFAULT 0,
  `kondisi_buku` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `alasan_tolak` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `pengguna_id`, `buku_id`, `tgl_pinjam`, `tgl_jatuh_tempo`, `lama_hari`, `jumlah_perpanjang`, `tgl_kembali`, `waktu_kembali`, `status`, `denda`, `denda_lunas`, `kondisi_buku`, `catatan`, `alasan_tolak`, `created_at`, `updated_at`) VALUES
(1, NULL, 3, 1, '2026-09-20', '2026-09-27', 7, 0, NULL, NULL, 'menunggu_verifikasi', 0, 0, NULL, NULL, NULL, '2026-09-20 07:41:18', '2026-09-21 19:28:48'),
(2, NULL, 3, 3, '2026-09-20', '2026-09-27', 7, 0, NULL, NULL, 'dipinjam', 0, 0, NULL, NULL, NULL, '2026-09-20 07:52:56', '2026-09-20 08:04:32'),
(3, NULL, 3, 7, '2026-09-20', '2026-09-27', 7, 0, '2026-09-21', '2026-09-21 04:03:19', 'dikembalikan', 0, 0, 'baik', NULL, NULL, '2026-09-20 17:44:35', '2026-09-21 11:03:19'),
(4, NULL, 4, 8, '2026-09-20', '2026-09-23', 3, 0, '2026-09-20', '2026-09-20 13:41:27', 'dikembalikan', 0, 0, 'baik', NULL, NULL, '2026-09-20 18:10:32', '2026-09-20 20:41:27'),
(5, NULL, 4, 4, '2026-09-20', '2026-09-27', 7, 0, '2026-09-21', '2026-09-21 04:03:35', 'dikembalikan', 0, 0, 'baik', NULL, NULL, '2026-09-20 18:53:17', '2026-09-21 11:03:35'),
(6, NULL, 4, 6, '2026-09-21', '2026-09-28', 7, 0, '2026-09-21', '2026-09-21 12:26:17', 'dikembalikan', 0, 0, 'baik', NULL, NULL, '2026-09-21 10:23:53', '2026-09-21 19:26:17'),
(7, NULL, 4, 2, '2026-09-21', '2026-09-28', 7, 0, '2026-09-21', '2026-09-21 11:06:23', 'dikembalikan', 0, 0, 'baik', NULL, NULL, '2026-09-21 11:24:28', '2026-09-21 18:06:23'),
(8, NULL, 4, 3, '2026-09-21', '2026-09-28', 7, 0, NULL, NULL, 'dipinjam', 0, 0, NULL, NULL, NULL, '2026-09-21 12:20:14', '2026-09-21 19:24:29'),
(9, NULL, 4, 8, '2026-09-21', '2026-09-28', 7, 0, NULL, NULL, 'ditolak', 0, 0, NULL, NULL, NULL, '2026-09-21 19:13:47', '2026-09-21 19:27:00'),
(10, NULL, 4, 4, '2026-09-21', '2026-09-28', 7, 0, NULL, NULL, 'menunggu_pinjam', 0, 0, NULL, NULL, NULL, '2026-09-21 19:55:40', '2026-09-21 19:55:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `komentar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id`, `pengguna_id`, `buku_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 5, 'Bagus', '2026-09-21 12:20:00', '2026-09-21 12:20:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buku_slug_unique` (`slug`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`),
  ADD KEY `idx_buku_judul` (`judul`),
  ADD KEY `idx_buku_pengarang` (`pengarang`),
  ADD KEY `idx_buku_kategori` (`kategori_id`),
  ADD KEY `idx_buku_status` (`status`),
  ADD KEY `idx_buku_created` (`created_at`);

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_fav` (`pengguna_id`,`buku_id`),
  ADD KEY `idx_fav_pengguna` (`pengguna_id`),
  ADD KEY `idx_fav_buku` (`buku_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_slug_unique` (`slug`);

--
-- Indeks untuk tabel `log_pengunjung`
--
ALTER TABLE `log_pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_log_created` (`created_at`);

--
-- Indeks untuk tabel `log_stok`
--
ALTER TABLE `log_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_notif_pengguna` (`pengguna_id`),
  ADD KEY `idx_notif_dibaca` (`sudah_dibaca`),
  ADD KEY `idx_notif_user_read` (`pengguna_id`,`sudah_dibaca`);

--
-- Indeks untuk tabel `notifikasi_staf`
--
ALTER TABLE `notifikasi_staf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_nstaf_dibaca` (`sudah_dibaca`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengaturan_kunci_unique` (`kunci`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`),
  ADD KEY `idx_pengguna_role` (`role`),
  ADD KEY `idx_pengguna_status` (`status`),
  ADD KEY `idx_pengguna_role_status` (`role`,`status`);

--
-- Indeks untuk tabel `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pesan_dibaca` (`sudah_dibaca`);

--
-- Indeks untuk tabel `push_subscription`
--
ALTER TABLE `push_subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_push_pengguna` (`pengguna_id`),
  ADD KEY `idx_push_role` (`role`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_pengguna_id_foreign` (`pengguna_id`),
  ADD KEY `transaksi_buku_id_foreign` (`buku_id`),
  ADD KEY `idx_trx_pengguna` (`pengguna_id`),
  ADD KEY `idx_trx_buku` (`buku_id`),
  ADD KEY `idx_trx_status` (`status`),
  ADD KEY `idx_trx_tgl_pinjam` (`tgl_pinjam`),
  ADD KEY `idx_trx_tgl_tempo` (`tgl_jatuh_tempo`),
  ADD KEY `idx_trx_status_tempo` (`status`,`tgl_jatuh_tempo`),
  ADD KEY `idx_trx_created` (`created_at`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ulasan_buku` (`buku_id`),
  ADD KEY `idx_ulasan_pengguna` (`pengguna_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_pengunjung`
--
ALTER TABLE `log_pengunjung`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `log_stok`
--
ALTER TABLE `log_stok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_staf`
--
ALTER TABLE `notifikasi_staf`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `push_subscription`
--
ALTER TABLE `push_subscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
