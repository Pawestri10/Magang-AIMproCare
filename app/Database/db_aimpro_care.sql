-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Okt 2026 pada 07.25
-- Versi server: 8.0.45
-- Versi PHP: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `db_aimpro_care`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-09-28 08:03:41', '2026-09-28 08:03:41'),
(2, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-09-28 08:03:57', '2026-09-28 08:03:57'),
(3, 1, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-09-28 08:04:59', '2026-09-28 08:04:59'),
(4, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-09-28 08:05:19', '2026-09-28 08:05:19'),
(5, 2, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-09-28 08:05:21', '2026-09-28 08:05:21'),
(6, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-09-28 08:05:35', '2026-09-28 08:05:35'),
(7, 1, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-09-28 15:08:21', '2026-09-28 15:08:21'),
(8, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-09-28 15:08:41', '2026-09-28 15:08:41'),
(9, 1, 'CREATE', 'Administrator menambahkan produk ASUS Ryzen 7.', '2026-09-28 15:25:49', '2026-09-28 15:25:49'),
(10, 1, 'UPDATE', 'Administrator memperbarui produk ASUS Ryzen 7.', '2026-09-28 15:26:21', '2026-09-28 15:26:21'),
(11, 1, 'DELETE', 'Administrator menghapus produk ASUS Ryzen 7.', '2026-09-28 15:27:04', '2026-09-28 15:27:04'),
(12, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-09-29 09:30:27', '2026-09-29 09:30:27'),
(13, 2, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-09-29 09:46:56', '2026-09-29 09:46:56'),
(14, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-09-29 09:47:35', '2026-09-29 09:47:35'),
(15, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-09-29 11:18:10', '2026-09-29 11:18:10'),
(16, 1, 'CREATE_CUSTOMER', 'Menambahkan data pembeli ID 1.', '2026-09-29 14:46:17', '2026-09-29 14:46:17'),
(17, 1, 'CREATE_CUSTOMER', 'Menambahkan data pembeli ID 2.', '2026-09-29 14:49:53', '2026-09-29 14:49:53'),
(18, 1, 'UPDATE_CUSTOMER', 'Memperbarui data pembeli ID 2.', '2026-09-29 15:09:21', '2026-09-29 15:09:21'),
(19, 1, 'UPDATE_CUSTOMER', 'Memperbarui data pembeli ID 2.', '2026-09-29 15:09:34', '2026-09-29 15:09:34'),
(20, 1, 'UPDATE_CUSTOMER', 'Memperbarui data pembeli ID 2.', '2026-09-29 15:11:54', '2026-09-29 15:11:54'),
(21, 1, 'UPDATE_CUSTOMER', 'Memperbarui data pembeli ID 2.', '2026-09-29 15:13:06', '2026-09-29 15:13:06'),
(22, 1, 'DELETE_CUSTOMER', 'Menghapus data pembeli ID 2.', '2026-09-29 15:20:46', '2026-09-29 15:20:46'),
(23, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-09-30 09:52:46', '2026-09-30 09:52:46'),
(24, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-09-30 11:42:13', '2026-09-30 11:42:13'),
(25, 1, 'CREATE_CUSTOMER', 'Menambahkan data pembeli ID 3.', '2026-09-30 13:29:48', '2026-09-30 13:29:48'),
(26, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-01 09:56:04', '2026-10-01 09:56:04'),
(27, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 7.', '2026-10-01 09:58:22', '2026-10-01 09:58:22'),
(28, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 8.', '2026-10-01 11:11:59', '2026-10-01 11:11:59'),
(29, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-01 13:36:38', '2026-10-01 13:36:38'),
(30, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-01 13:37:04', '2026-10-01 13:37:04'),
(31, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 6.', '2026-10-01 14:02:05', '2026-10-01 14:02:05'),
(32, 1, 'CREATE', 'Administrator menambahkan produk Acer 12.', '2026-10-01 14:03:09', '2026-10-01 14:03:09'),
(33, 1, 'UPDATE', 'Administrator memperbarui produk Acer 12.', '2026-10-01 14:03:34', '2026-10-01 14:03:34'),
(34, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 14:06:16', '2026-10-01 14:06:16'),
(35, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 14:47:18', '2026-10-01 14:47:18'),
(36, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 15:32:19', '2026-10-01 15:32:19'),
(37, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 15:35:21', '2026-10-01 15:35:21'),
(38, 1, 'CREATE_CUSTOMER', 'Menambahkan data pembeli ID 4.', '2026-10-01 15:42:54', '2026-10-01 15:42:54'),
(39, 1, 'UPDATE', 'Administrator memperbarui produk Acer 13.', '2026-10-01 15:43:31', '2026-10-01 15:43:31'),
(40, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 15:47:15', '2026-10-01 15:47:15'),
(41, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 15:49:45', '2026-10-01 15:49:45'),
(42, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 15:54:26', '2026-10-01 15:54:26'),
(43, 1, 'UPDATE', 'Administrator memperbarui produk Acer 10.', '2026-10-01 15:57:01', '2026-10-01 15:57:01'),
(44, 1, 'UPDATE', 'Administrator memperbarui produk Acer 11.', '2026-10-01 15:57:11', '2026-10-01 15:57:11'),
(45, 1, 'UPDATE', 'Administrator memperbarui produk Acer 10.', '2026-10-01 15:58:12', '2026-10-01 15:58:12'),
(46, 1, 'UPDATE', 'Administrator memperbarui produk Acer 10.', '2026-10-01 15:58:55', '2026-10-01 15:58:55'),
(47, 1, 'UPDATE', 'Administrator memperbarui produk Acer 10.', '2026-10-01 15:58:59', '2026-10-01 15:58:59'),
(48, 1, 'create', 'Menyimpan transaksi penjualan untuk unit dengan ID 9.', '2026-10-01 16:02:39', '2026-10-01 16:02:39'),
(49, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-02 09:36:54', '2026-10-02 09:36:54'),
(50, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-02 09:59:26', '2026-10-02 09:59:26'),
(51, 1, 'UPDATE', 'Administrator memperbarui produk Laptop Acer 10.', '2026-10-02 10:48:10', '2026-10-02 10:48:10'),
(52, 1, 'UPDATE', 'Administrator memperbarui produk Laptop ThinkPad 12.', '2026-10-02 10:48:19', '2026-10-02 10:48:19'),
(53, 1, 'UPDATE', 'Administrator memperbarui produk Laptop asus vivobook 14.', '2026-10-02 10:48:43', '2026-10-02 10:48:43'),
(54, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-02 13:06:49', '2026-10-02 13:06:49'),
(55, 1, 'activate', 'Mengaktifkan garansi untuk transaksi ID 12 dengan nomor garansi AIM-WRT-2026-000001.', '2026-10-02 13:23:54', '2026-10-02 13:23:54'),
(56, 1, 'activate', 'Mengaktifkan garansi untuk transaksi ID 4 dengan nomor garansi AIM-WRT-2026-000002.', '2026-10-02 13:32:08', '2026-10-02 13:32:08'),
(57, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 7 dengan nomor garansi AIM-WRT-2026-000003.', '2026-10-02 14:16:37', '2026-10-02 14:16:37'),
(58, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-02 14:30:46', '2026-10-02 14:30:46'),
(59, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 1 dengan nomor garansi AIM-WRT-2026-000003.', '2026-10-02 16:04:27', '2026-10-02 16:04:27'),
(60, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-05 09:42:24', '2026-10-05 09:42:24'),
(61, 1, 'CREATE_CUSTOMER', 'Menambahkan data pembeli ID 5.', '2026-10-05 11:28:41', '2026-10-05 11:28:41'),
(62, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 10 dengan nomor garansi AIM-WRT-2026-000004.', '2026-10-05 11:29:23', '2026-10-05 11:29:23'),
(63, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-05 11:42:20', '2026-10-05 11:42:20'),
(64, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 11 dengan nomor garansi AIM-WRT-2026-000005.', '2026-10-05 13:17:51', '2026-10-05 13:17:51'),
(65, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-06 09:24:32', '2026-10-06 09:24:32'),
(66, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-06 09:24:50', '2026-10-06 09:24:50'),
(67, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-06 14:23:18', '2026-10-06 14:23:18'),
(68, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-07 09:08:42', '2026-10-07 09:08:42'),
(69, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-07 09:08:59', '2026-10-07 09:08:59'),
(70, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-07 15:59:06', '2026-10-07 15:59:06'),
(71, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-07 15:59:07', '2026-10-07 15:59:07'),
(72, 1, 'Perubahan Status Klaim', 'Admin mengubah status klaim AIM-CLM-2026-000004 dari \"Pengajuan Baru\" menjadi \"Klaim Diterima\".', '2026-10-07 16:12:49', '2026-10-07 16:12:49'),
(73, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-10 08:38:46', '2026-10-10 08:38:46'),
(74, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-10 10:46:35', '2026-10-10 10:46:35'),
(75, 1, 'Perubahan Status Klaim', 'Admin mengubah status klaim AIM-CLM-2026-000002 dari \"Pengajuan Baru\" menjadi \"Sedang Diverifikasi\".', '2026-10-10 10:55:56', '2026-10-10 10:55:56'),
(76, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-10 14:47:13', '2026-10-10 14:47:13'),
(77, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-10 14:58:14', '2026-10-10 14:58:14'),
(78, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-10 21:23:23', '2026-10-10 21:23:23'),
(79, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-10 21:27:16', '2026-10-10 21:27:16'),
(80, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-11 09:03:38', '2026-10-11 09:03:38'),
(81, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-11 15:43:56', '2026-10-11 15:43:56'),
(82, 1, 'Perubahan Status Klaim', 'Admin mengubah status klaim AIM-CLM-2026-000006 dari \"Pengajuan Baru\" menjadi \"Sedang Diverifikasi\".', '2026-10-11 16:15:45', '2026-10-11 16:15:45'),
(83, 1, 'Perubahan Status Klaim', 'Admin mengubah status klaim AIM-CLM-2026-000006 dari \"Sedang Diverifikasi\" menjadi \"Selesai\".', '2026-10-11 16:17:56', '2026-10-11 16:17:56'),
(84, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 12 dengan nomor garansi AIM-WRT-2026-000006.', '2026-10-11 16:34:29', '2026-10-11 16:34:29'),
(85, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-11 16:35:56', '2026-10-11 16:35:56'),
(86, 1, 'CREATE', 'Administrator menambahkan produk Mouse Robot.', '2026-10-11 16:36:42', '2026-10-11 16:36:42'),
(87, 1, 'UPDATE_CUSTOMER', 'Memperbarui data pembeli ID 3.', '2026-10-11 16:36:57', '2026-10-11 16:36:57'),
(88, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 13 dengan nomor garansi AIM-WRT-2026-000006.', '2026-10-11 16:39:36', '2026-10-11 16:39:36'),
(89, 1, 'UPDATE_CUSTOMER', 'Memperbarui data pembeli ID 1.', '2026-10-11 16:54:28', '2026-10-11 16:54:28'),
(90, 1, 'CREATE', 'Administrator menambahkan produk Headset Robot.', '2026-10-11 16:54:56', '2026-10-11 16:54:56'),
(91, 1, 'create', 'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID 14 dengan nomor garansi AIM-WRT-2026-000007.', '2026-10-11 16:56:32', '2026-10-11 16:56:32'),
(92, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-11 19:25:43', '2026-10-11 19:25:43'),
(93, 1, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-10-11 21:11:24', '2026-10-11 21:11:24'),
(94, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-11 21:11:36', '2026-10-11 21:11:36'),
(95, 1, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-10-11 21:12:20', '2026-10-11 21:12:20'),
(96, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-11 21:12:35', '2026-10-11 21:12:35'),
(97, 1, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-10-11 21:27:40', '2026-10-11 21:27:40'),
(98, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-11 21:27:51', '2026-10-11 21:27:51'),
(99, 2, 'LOGOUT', 'Pengguna berhasil logout dari sistem.', '2026-10-11 21:28:01', '2026-10-11 21:28:01'),
(100, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-11 21:28:14', '2026-10-11 21:28:14'),
(101, 1, 'LOGIN', 'Administrator berhasil login ke dalam sistem.', '2026-10-12 07:30:07', '2026-10-12 07:30:07'),
(102, 2, 'LOGIN', 'Petugas QC berhasil login ke dalam sistem.', '2026-10-12 11:40:18', '2026-10-12 11:40:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_histories`
--

CREATE TABLE `claim_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `warranty_claim_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `changed_at` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `claim_histories`
--

INSERT INTO `claim_histories` (`id`, `warranty_claim_id`, `user_id`, `status`, `note`, `changed_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Pengajuan Baru', 'Klaim diajukan oleh pembeli melalui halaman public.', '2026-10-06 11:18:22', '2026-10-06 11:18:22', '2026-10-06 11:18:22'),
(2, 2, NULL, 'Pengajuan Baru', 'Klaim diajukan oleh pembeli melalui halaman public.', '2026-10-06 12:56:10', '2026-10-06 12:56:10', '2026-10-06 12:56:10'),
(3, 3, NULL, 'Pengajuan Baru', 'Klaim diajukan oleh pembeli melalui halaman public.', '2026-10-06 13:42:09', '2026-10-06 13:42:09', '2026-10-06 13:42:09'),
(4, 4, NULL, 'Pengajuan Baru', 'Klaim diajukan oleh pembeli melalui halaman public.', '2026-10-06 15:12:54', '2026-10-06 15:12:54', '2026-10-06 15:12:54'),
(5, 4, 1, 'Klaim Diterima', 'baik', '2026-10-07 16:12:49', '2026-10-07 16:12:49', '2026-10-07 16:12:49'),
(6, 2, 1, 'Sedang Diverifikasi', 'Bentar yaa', '2026-10-10 10:55:56', '2026-10-10 10:55:56', '2026-10-10 10:55:56'),
(7, 5, NULL, 'Pengajuan Baru', 'Klaim diajukan oleh pembeli melalui halaman public.', '2026-10-11 16:01:32', '2026-10-11 16:01:32', '2026-10-11 16:01:32'),
(8, 6, NULL, 'Pengajuan Baru', 'Klaim diajukan oleh pembeli melalui halaman public.', '2026-10-11 16:04:32', '2026-10-11 16:04:32', '2026-10-11 16:04:32'),
(9, 6, 1, 'Sedang Diverifikasi', 'Bentar ya', '2026-10-11 16:15:45', '2026-10-11 16:15:45', '2026-10-11 16:15:45'),
(10, 6, 1, 'Selesai', 'Sudah ya', '2026-10-11 16:17:56', '2026-10-11 16:17:56', '2026-10-11 16:17:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `whatsapp`, `email`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pawestri ', '085709439400', 'pawestri@gmail.com', 'Kota Madiun', '2026-09-29 14:46:17', '2026-10-11 16:54:28', NULL),
(2, 'Gusti w', '08123456789', '', 'Caruban', '2026-09-29 14:49:53', '2026-09-29 15:20:46', '2026-09-29 15:20:46'),
(3, 'iqbal ramadhan', '085709439400', '', 'Madiun', '2026-09-30 13:29:47', '2026-10-11 16:36:57', NULL),
(4, 'Niky', '08123456789', '', 'Maidun', '2026-10-01 15:42:54', '2026-10-01 15:42:54', NULL),
(5, 'Mario', '08123456789', 'mario@gmail.com', 'Caruban', '2026-10-05 11:28:41', '2026-10-05 11:28:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-09-21-080734', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1789978929, 1),
(2, '2026-09-21-082821', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', 1789979591, 2),
(3, '2026-09-21-083715', 'App\\Database\\Migrations\\CreateCustomersTable', 'default', 'App', 1789981188, 3),
(4, '2026-09-21-091727', 'App\\Database\\Migrations\\CreateNotificationsTable', 'default', 'App', 1789982740, 4),
(5, '2026-09-21-092801', 'App\\Database\\Migrations\\CreateSettingsTable', 'default', 'App', 1789983041, 5),
(6, '2026-09-21-093431', 'App\\Database\\Migrations\\CreateProductUnitsTable', 'default', 'App', 1789983516, 6),
(7, '2026-09-23-093620', 'App\\Database\\Migrations\\CreateQcInspectionsTable', 'default', 'App', 1790156725, 7),
(8, '2026-09-23-095107', 'App\\Database\\Migrations\\CreateQcChecklistItemsTable', 'default', 'App', 1790157563, 8),
(9, '2026-09-23-100119', 'App\\Database\\Migrations\\CreateQcDocumentationsTable', 'default', 'App', 1790157983, 9),
(10, '2026-09-23-101015', 'App\\Database\\Migrations\\CreateSalesTable', 'default', 'App', 1790158336, 10),
(11, '2026-09-23-101432', 'App\\Database\\Migrations\\CreateWarrantiesTable', 'default', 'App', 1790158625, 11),
(12, '2026-09-23-101813', 'App\\Database\\Migrations\\CreateWarrantyClaimsTable', 'default', 'App', 1790158832, 12),
(13, '2026-09-23-102358', 'App\\Database\\Migrations\\CreateClaimHistoriesTable', 'default', 'App', 1790159106, 13),
(14, '2026-09-23-102710', 'App\\Database\\Migrations\\CreateActivityLogsTable', 'default', 'App', 1790159399, 14),
(15, '2026-10-01-034052', 'App\\Database\\Migrations\\AddWarrantyDurationUnitToSales', 'default', 'App', 1790826258, 15),
(16, '2026-10-06-035205', 'App\\Database\\Migrations\\AllowNullUserIdInClaimHistories', 'default', 'App', 1791258761, 16),
(17, '2026-10-06-062602', 'App\\Database\\Migrations\\AddTrackingTokenToWarrantyClaims', 'default', 'App', 1791268115, 17),
(18, '2026-10-11-103558', 'App\\Database\\Migrations\\AddReminderFieldsToNotifications', 'default', 'App', 1791715010, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `warranty_id` int UNSIGNED DEFAULT NULL,
  `reminder_date` date DEFAULT NULL,
  `recipient` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `template` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sent_at` datetime DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `gateway_response` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `warranty_id`, `reminder_date`, `recipient`, `template`, `sent_at`, `status`, `gateway_response`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '085709439400', 'claim_submitted', '2026-10-11 16:01:32', 'failed', 'HTTP 401 - {\n    \"success\": false,\n    \"status\": false,\n    \"error\": \"INVALID_API_KEY\",\n    \"message\": \"API key tidak valid. Periksa key Anda di dashboard → Nomor WhatsApp.\"\n}', '2026-10-11 16:01:32', '2026-10-11 16:01:32'),
(2, NULL, NULL, '085709439400', 'claim_submitted', '2026-10-11 16:04:32', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7914,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:04:32', '2026-10-11 16:04:32'),
(3, NULL, NULL, '085709439400', 'claim_status_changed', '2026-10-11 16:15:46', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7915,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:15:46', '2026-10-11 16:15:46'),
(4, NULL, NULL, '085709439400', 'claim_completed', '2026-10-11 16:17:56', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7916,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:17:56', '2026-10-11 16:17:56'),
(5, NULL, NULL, '08123456789', 'warranty_activated', '2026-10-11 16:34:29', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7917,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"08123456789\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:34:29', '2026-10-11 16:34:29'),
(6, NULL, NULL, '085709439400', 'warranty_activated', '2026-10-11 16:39:36', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7918,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:39:36', '2026-10-11 16:39:36'),
(7, NULL, NULL, '085709439400', 'warranty_activated', '2026-10-11 16:56:33', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7919,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:56:33', '2026-10-11 16:56:33'),
(8, NULL, NULL, '085709439400', 'warranty_card_issued', '2026-10-11 16:56:33', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7920,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 16:56:33', '2026-10-11 16:56:33'),
(9, 9, '2026-10-11', '085709439400', 'warranty_expiring', '2026-10-11 18:17:08', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7927,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 18:17:09', '2026-10-11 18:17:09'),
(10, 8, '2026-10-11', '085709439400', 'warranty_expiring', '2026-10-11 18:27:09', 'success', 'HTTP 200 - {\n    \"success\": true,\n    \"message\": \"Pesan berhasil dikirim.\",\n    \"data\": {\n        \"outbox_id\": 7933,\n        \"device_id\": 21,\n        \"from\": \"6285799948100\",\n        \"to\": \"085709439400\",\n        \"status\": \"sent\"\n    }\n}', '2026-10-11 18:27:09', '2026-10-11 18:27:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `model`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'produk tes 1', 'brand tes', 'model tes', '2026-09-24 03:38:09', '2026-09-24 04:08:19', NULL),
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore', '2026-09-24 03:39:40', '2026-09-24 04:24:52', '2026-09-24 04:24:52'),
(3, 'Laptop asus vivobook 14', 'ASUS', 'model 2', '2026-09-24 03:40:45', '2026-10-02 10:48:43', NULL),
(4, 'Laptop ThinkPad 12', 'ThinkPad', 'L390', '2026-09-28 15:10:06', '2026-10-02 10:48:19', NULL),
(5, 'ASUS Ryzen 7', 'ASUS', 'vivobook 15', '2026-09-28 15:25:49', '2026-09-28 15:27:04', '2026-09-28 15:27:04'),
(6, 'Laptop Acer 10', 'Acer', 'ACR12', '2026-10-01 14:03:09', '2026-10-02 10:48:10', NULL),
(7, 'Mouse Robot', 'ROBOT', 'mouse14', '2026-10-11 16:36:42', '2026-10-11 16:36:42', NULL),
(8, 'Headset Robot', 'ROBOT', 'RE20', '2026-10-11 16:54:56', '2026-10-11 16:54:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_units`
--

CREATE TABLE `product_units` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `serial_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_units`
--

INSERT INTO `product_units` (`id`, `product_id`, `serial_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SN-TEST-001', 'Terjual', '2026-09-24 07:55:30', '2026-10-02 16:04:27'),
(5, 1, 'SN-test002', 'Tidak Lolos QC', '2026-09-24 08:37:11', '2026-09-27 16:36:26'),
(6, 3, 'SN-TEST-003', 'Terjual', '2026-09-27 15:02:14', '2026-10-02 13:32:08'),
(7, 3, 'SN-TEST-004', 'Terjual', '2026-09-28 06:23:09', '2026-10-02 14:16:37'),
(9, 6, 'SN-TEST-006', 'Terjual', '2026-10-01 14:04:27', '2026-10-02 13:23:53'),
(10, 4, 'SN-TEST-007', 'Terjual', '2026-10-02 16:06:16', '2026-10-05 11:29:23'),
(11, 3, 'SN-TEST-008', 'Terjual', '2026-10-05 11:42:55', '2026-10-05 13:17:51'),
(13, 7, 'SN-TEST-009', 'Terjual', '2026-10-11 16:37:39', '2026-10-11 16:39:36'),
(14, 8, 'SN-TEST-011', 'Terjual', '2026-10-11 16:55:14', '2026-10-11 16:56:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_checklist_items`
--

CREATE TABLE `qc_checklist_items` (
  `id` bigint UNSIGNED NOT NULL,
  `qc_inspection_id` bigint UNSIGNED NOT NULL,
  `item_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `result` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `qc_checklist_items`
--

INSERT INTO `qc_checklist_items` (`id`, `qc_inspection_id`, `item_name`, `result`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(2, 1, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(3, 1, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(4, 1, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(5, 1, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(6, 1, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(7, 1, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(8, 2, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(9, 2, 'Produk tidak lecet atau retak', 'Tidak', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(10, 2, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(11, 2, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(12, 2, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(13, 2, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(14, 2, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(15, 3, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(16, 3, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(17, 3, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(18, 3, 'Kelengkapan produk sesuai', 'Tidak', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(19, 3, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(20, 3, 'Fungsi dasar berjalan', 'Tidak', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(21, 3, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(22, 4, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(23, 4, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(24, 4, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(25, 4, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(26, 4, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(27, 4, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(28, 4, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(36, 6, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(37, 6, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(38, 6, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(39, 6, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(40, 6, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(41, 6, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(42, 6, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(43, 7, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(44, 7, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(45, 7, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(46, 7, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(47, 7, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(48, 7, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(49, 7, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(50, 8, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(51, 8, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(52, 8, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(53, 8, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(54, 8, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(55, 8, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(56, 8, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(57, 9, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(58, 9, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(59, 9, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(60, 9, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(61, 9, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(62, 9, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(63, 9, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(71, 11, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(72, 11, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(73, 11, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(74, 11, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(75, 11, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(76, 11, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(77, 11, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(78, 12, 'Kemasan dalam kondisi baik', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(79, 12, 'Produk tidak lecet atau retak', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(80, 12, 'Nomor seri produk sesuai dengan kemasan', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(81, 12, 'Kelengkapan produk sesuai', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(82, 12, 'Produk dapat dinyalakan', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(83, 12, 'Fungsi dasar berjalan', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(84, 12, 'Tidak ditemukan kerusakan', 'Ya', NULL, '2026-10-11 16:55:50', '2026-10-11 16:55:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_documentations`
--

CREATE TABLE `qc_documentations` (
  `id` bigint UNSIGNED NOT NULL,
  `qc_inspection_id` bigint UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `qc_documentations`
--

INSERT INTO `qc_documentations` (`id`, `qc_inspection_id`, `type`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'unboxing_video', 'uploads/qc/6/1790526803_8e136bcaa7d52431c478.mp4', '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(2, 1, 'serial_photo', 'uploads/qc/6/1790526803_80afd6fdba9ca1d811e5.png', '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(3, 1, 'product_photo', 'uploads/qc/6/1790526803_45d326a6a778498bdd6f.png', '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(4, 2, 'unboxing_video', 'uploads/qc/5/1790526986_a04155ef8a6b92ef8ebe.mp4', '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(5, 2, 'serial_photo', 'uploads/qc/5/1790526986_3077751c798b6e9db42d.png', '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(6, 2, 'product_photo', 'uploads/qc/5/1790526986_a6d84f48202b4f289bc2.png', '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(7, 3, 'unboxing_video', 'uploads/qc/7/1790576675_7179936fb9442364dec5.mp4', '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(8, 3, 'serial_photo', 'uploads/qc/7/1790576675_92f669be9dacd1699452.png', '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(9, 3, 'product_photo', 'uploads/qc/7/1790576675_6cb8f80ec0123efcc4e0.png', '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(10, 4, 'unboxing_video', 'uploads/qc/7/1790649122_54b4c45a361feb231487.mp4', '2026-09-29 09:32:02', '2026-09-29 09:32:02'),
(11, 4, 'serial_photo', 'uploads/qc/7/1790649122_199575aeba684b317c5f.png', '2026-09-29 09:32:02', '2026-09-29 09:32:02'),
(12, 4, 'product_photo', 'uploads/qc/7/1790649122_1a4ff2ee0731aea42af3.png', '2026-09-29 09:32:02', '2026-09-29 09:32:02'),
(16, 6, 'unboxing_video', 'uploads/qc/9/1790838309_0a050e24ea9b215c1bda.mp4', '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(17, 6, 'serial_photo', 'uploads/qc/9/1790838309_5909da4298c2115fe970.png', '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(18, 6, 'product_photo', 'uploads/qc/9/1790838309_8713543e57f6f2bb4fd5.png', '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(19, 7, 'unboxing_video', 'uploads/qc/1/1790927353_1750e133089601269215.mp4', '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(20, 7, 'serial_photo', 'uploads/qc/1/1790927353_170a4219458619286c88.png', '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(21, 7, 'product_photo', 'uploads/qc/1/1790927353_5974654f354bc1f894a8.png', '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(22, 8, 'unboxing_video', 'uploads/qc/10/1790932009_1f48dd03b2d8643dee5f.mp4', '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(23, 8, 'serial_photo', 'uploads/qc/10/1790932009_96ecf2e7a96bd4ec95e0.png', '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(24, 8, 'product_photo', 'uploads/qc/10/1790932009_570e81fd869a8c07528c.png', '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(25, 9, 'unboxing_video', 'uploads/qc/11/1791175446_7a67756f57fcaeacfcd9.mp4', '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(26, 9, 'serial_photo', 'uploads/qc/11/1791175446_6fd1b533d96fc77dbf8c.png', '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(27, 9, 'product_photo', 'uploads/qc/11/1791175446_b1134363a546d1cfd05e.png', '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(31, 11, 'unboxing_video', 'uploads/qc/13/1791711525_531ed1296c4ee5f4c7be.mp4', '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(32, 11, 'serial_photo', 'uploads/qc/13/1791711525_799c154572709b95259d.png', '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(33, 11, 'product_photo', 'uploads/qc/13/1791711525_77bce5d702b13c9ee90d.png', '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(34, 12, 'unboxing_video', 'uploads/qc/14/1791712550_51aff4aa4508e53c3e7b.mp4', '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(35, 12, 'serial_photo', 'uploads/qc/14/1791712550_21ae80813af22550e344.png', '2026-10-11 16:55:50', '2026-10-11 16:55:50'),
(36, 12, 'product_photo', 'uploads/qc/14/1791712550_9930894baddd694be750.png', '2026-10-11 16:55:50', '2026-10-11 16:55:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_inspections`
--

CREATE TABLE `qc_inspections` (
  `id` bigint UNSIGNED NOT NULL,
  `product_unit_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `inspection_date` date NOT NULL,
  `physical_condition` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `completeness` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `result` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `qc_inspections`
--

INSERT INTO `qc_inspections` (`id`, `product_unit_id`, `user_id`, `inspection_date`, `physical_condition`, `completeness`, `result`, `notes`, `created_at`, `updated_at`) VALUES
(1, 6, 2, '2026-09-27', 'Baik', 'Lengkap', 'Lolos QC', 'Baik', '2026-09-27 16:33:23', '2026-09-27 16:33:23'),
(2, 5, 2, '2026-09-27', 'baik', 'Lengkap', 'Tidak Lolos QC', 'Kurang', '2026-09-27 16:36:26', '2026-09-27 16:36:26'),
(3, 7, 2, '2026-09-28', 'Baik', 'Lengkap', 'Perlu Pemeriksaan Ulang', 'Kurang', '2026-09-28 06:24:35', '2026-09-28 06:24:35'),
(4, 7, 2, '2026-09-29', 'Baik', 'Lengkap', 'Lolos QC', 'JOS', '2026-09-29 09:32:01', '2026-09-29 09:32:01'),
(6, 9, 2, '2026-10-01', 'Baik', 'Lengkap', 'Lolos QC', 'Lengkap', '2026-10-01 14:05:09', '2026-10-01 14:05:09'),
(7, 1, 2, '2026-10-02', 'Baik', 'Lengkap', 'Lolos QC', 'jos', '2026-10-02 14:49:13', '2026-10-02 14:49:13'),
(8, 10, 2, '2026-10-02', 'Baik', 'Lengkap', 'Lolos QC', 'aip', '2026-10-02 16:06:49', '2026-10-02 16:06:49'),
(9, 11, 2, '2026-10-05', 'Baik', 'Lengkap', 'Lolos QC', 'sipp', '2026-10-05 11:44:06', '2026-10-05 11:44:06'),
(11, 13, 2, '2026-10-11', 'Baik', 'Lengkap', 'Lolos QC', 'JOS', '2026-10-11 16:38:45', '2026-10-11 16:38:45'),
(12, 14, 2, '2026-10-11', 'Baik', 'Lengkap', 'Lolos QC', 'SIP', '2026-10-11 16:55:50', '2026-10-11 16:55:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `product_unit_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `invoice_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `purchase_location` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `marketplace_order_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warranty_duration` int NOT NULL,
  `warranty_duration_unit` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warranty_start_date` date NOT NULL,
  `purchase_receipt_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `product_unit_id`, `customer_id`, `purchase_date`, `invoice_number`, `purchase_location`, `marketplace_order_number`, `warranty_duration`, `warranty_duration_unit`, `warranty_start_date`, `purchase_receipt_path`, `notes`, `created_at`, `updated_at`) VALUES
(4, 6, 3, '2026-10-01', 'INV-003', 'Tokopedia', '', 1, 'Tahun', '2026-10-01', 'uploads/sales/1790838125_7995f764320ab215b047.png', '', '2026-10-01 14:02:05', '2026-10-01 14:02:05'),
(12, 9, 4, '2026-10-01', 'INV-005', 'Tokopedia', '', 2, 'Bulan', '2026-10-01', NULL, '', '2026-10-01 16:02:39', '2026-10-01 16:02:39'),
(16, 1, 3, '2026-10-02', 'INV-008', 'Lazada', '', 3, 'Bulan', '2026-10-02', 'uploads/sales/1790931867_7d01a48046416fc67503.png', 'jos', '2026-10-02 16:04:27', '2026-10-02 16:04:27'),
(17, 10, 5, '2026-10-05', 'INV-009', 'Lazada', '', 2, 'Tahun', '2026-10-05', NULL, '', '2026-10-05 11:29:23', '2026-10-05 11:29:23'),
(18, 11, 1, '2026-10-05', 'INV-0010', 'Shopee', '', 3, 'Bulan', '2026-10-05', NULL, '', '2026-10-05 13:17:51', '2026-10-05 13:17:51'),
(20, 13, 3, '2026-10-11', 'INV-0010', 'Lazada', '', 2, 'Bulan', '2026-10-11', NULL, '', '2026-10-11 16:39:36', '2026-10-11 16:39:36'),
(21, 14, 1, '2026-10-11', 'INV-010', 'Lazada', '', 1, 'Tahun', '2026-10-11', NULL, '', '2026-10-11 16:56:32', '2026-10-11 16:56:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'wa_template_warranty_activated', 'Halo {nama}, garansi produk Anda berhasil diaktifkan.\r\nNomor garansi: {nomor_garansi}\r\nMulai: {tanggal_mulai}\r\nBerakhir: {tanggal_berakhir}\r\nTerima kasih telah menggunakan AIMPro Technology.', '2026-10-11 11:28:27', '2026-10-11 18:28:56'),
(2, 'wa_template_warranty_card_issued', 'Halo {nama}, kartu garansi digital Anda telah diterbitkan.\r\n\r\nNomor garansi: {nomor_garansi}\r\n\r\nSilakan buka tautan berikut untuk melihat kartu garansi Anda:\r\n{tautan_kartu}\r\n\r\nTerima kasih telah menggunakan AIMPro Technology.', '2026-10-11 11:28:27', '2026-10-11 18:28:56'),
(3, 'wa_template_warranty_expiring', 'Halo {nama}, masa garansi produk Anda akan segera berakhir.\r\n\r\nNomor garansi: {nomor_garansi}\r\nTanggal berakhir: {tanggal_berakhir}\r\nSisa masa garansi: {sisa_hari} hari.\r\n\r\nTerima kasih telah menggunakan AIMPro Technology.', '2026-10-11 11:28:27', '2026-10-11 18:28:56'),
(4, 'wa_template_claim_submitted', 'Halo {nama}, pengajuan klaim {nomor_klaim} berhasil kami terima. Status: {status}.', '2026-10-11 11:28:27', '2026-10-11 18:28:56'),
(5, 'wa_template_claim_status_changed', 'Halo {nama}, status klaim {nomor_klaim} telah berubah menjadi {status}. Catatan: {catatan}.', '2026-10-11 11:28:28', '2026-10-11 18:28:56'),
(6, 'wa_template_claim_completed', 'Halo {nama}, proses klaim {nomor_klaim} telah selesai. Terima kasih.', '2026-10-11 11:28:28', '2026-10-11 18:28:56'),
(7, 'wa_expiry_reminder_days', '7', '2026-10-11 11:28:28', '2026-10-11 18:28:56'),
(8, 'wakita_api_key', 'f7D5ur/Zu8WSMAWP1LITh9N+D8r1tORDFvTnxXHZVsmRwV6tG1YGKN1IT/6dEFjZGeH/Ey5bN842fKB3CA5V6cJKO6Vib752yAnf5akqyzdG99FgYzbay9t3+UrBDPS+sn3NWFnYWysRMEkb7siirBMlhnDvNxw=', '2026-10-11 11:29:17', '2026-10-11 16:03:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('Administrator','Petugas QC') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'admin@aimpro.care', '$2y$12$jVJm2C/LcYxeTuf.Seo8Lu1hzah3xZhJriC8PDqXumYdoe..w3xX.', 'Administrator', '2026-09-23 11:29:06', '2026-09-23 11:29:06', NULL),
(2, 'Petugas QC', 'qc@aimpro.care', '$2y$12$JdxwoMViABhgu1x2cBhFuuMdPz5qIrenZlJR7GymAfDU35dV5EYLC', 'Petugas QC', '2026-09-23 11:29:07', '2026-09-23 11:29:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warranties`
--

CREATE TABLE `warranties` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `warranty_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `qr_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warranties`
--

INSERT INTO `warranties` (`id`, `sale_id`, `warranty_number`, `start_date`, `end_date`, `status`, `qr_token`, `created_at`, `updated_at`) VALUES
(1, 12, 'AIM-WRT-2026-000001', '2026-10-01', '2026-10-01', 'Garansi Aktif', 'c79f1b68e9c50088b0753ee37d7e9a1ec57d63039b2eaba5e7d06fa188257b19', '2026-10-02 13:23:53', '2026-10-02 13:23:53'),
(2, 4, 'AIM-WRT-2026-000002', '2026-10-01', '2026-10-01', 'Garansi Aktif', '70b2404a6e40dd938b2866a3e0b5f46e9f1ba71f97adcaa427757f7c92a599a9', '2026-10-02 13:32:08', '2026-10-02 13:32:08'),
(4, 16, 'AIM-WRT-2026-000003', '2026-10-02', '2027-01-02', 'Garansi Aktif', '3100a56c3b7840de97ee5c6f768d2b270999e82f74fce41b61d8ef954e77ef1a', '2026-10-02 16:04:27', '2026-10-02 16:04:27'),
(5, 17, 'AIM-WRT-2026-000004', '2026-10-05', '2028-10-05', 'Garansi Aktif', 'fc881f3039bb91e0720be6710a6056cee7a7844373efcafc3146543f91f21788', '2026-10-05 11:29:23', '2026-10-05 11:29:23'),
(6, 18, 'AIM-WRT-2026-000005', '2026-10-05', '2027-01-05', 'Garansi Aktif', 'd5dc5fa802aa2922b57e6fe0fc747f28616ec191edec51a863e3f91b109bdbfa', '2026-10-05 13:17:51', '2026-10-05 13:17:51'),
(8, 20, 'AIM-WRT-2026-000006', '2026-10-11', '2026-12-11', 'Garansi Aktif', '77e16de5dd8dbbc16930671495130faf1caff0d1d579a37553618c0db8c307ef', '2026-10-11 16:39:36', '2026-10-11 16:39:36'),
(9, 21, 'AIM-WRT-2026-000007', '2026-10-11', '2027-10-11', 'Garansi Aktif', 'a22cb66d64c01c8b8fe8d8ea4c513152e8be48e2dd62d6491fcfd2a1068977f1', '2026-10-11 16:56:32', '2026-10-11 16:56:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warranty_claims`
--

CREATE TABLE `warranty_claims` (
  `id` bigint UNSIGNED NOT NULL,
  `warranty_id` bigint UNSIGNED NOT NULL,
  `claim_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tracking_token` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `complaint` text COLLATE utf8mb4_general_ci NOT NULL,
  `damage_started_at` date NOT NULL,
  `damage_photo_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `damage_video_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_general_ci,
  `agreement` tinyint(1) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warranty_claims`
--

INSERT INTO `warranty_claims` (`id`, `warranty_id`, `claim_number`, `tracking_token`, `complaint`, `damage_started_at`, `damage_photo_path`, `damage_video_path`, `whatsapp`, `delivery_method`, `shipping_address`, `agreement`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'AIM-CLM-2026-000001', '7d74ffe808a197000891706df01dcc27cf37a4c4275a2887d4263bb970605eb2', 'Mati', '2026-10-06', 'uploads/claims/1791260302_e7a9e0e0ba03fbf60913.png', NULL, '08123456789', 'Penyerahan Langsung', NULL, 1, 'Pengajuan Baru', '2026-10-06 11:18:22', '2026-10-06 11:18:22'),
(2, 1, 'AIM-CLM-2026-000002', 'd385c98554274be3df8401a97375325cc7ad5c4c514e5190bc2504d6a7cdc327', 'Pecah', '2026-10-06', 'uploads/claims/1791266170_60747ed5a6601d7a4c64.png', 'uploads/claims/1791266170_b4897b1bb7464f6b2539.mp4', '08123456789', 'Penyerahan Langsung', NULL, 1, 'Sedang Diverifikasi', '2026-10-06 12:56:10', '2026-10-10 10:55:56'),
(3, 5, 'AIM-CLM-2026-000003', 'c2e40f0628a113cdccc27b70c70582b24520c28ea654bd70dded51899b4cba5a', 'Pecah', '2026-10-06', 'uploads/claims/1791268929_fa2890ae106d08577b94.png', 'uploads/claims/1791268929_d5a081184d34d38f124a.mp4', '08123456789', 'Pengiriman', 'Madiun', 1, 'Pengajuan Baru', '2026-10-06 13:42:09', '2026-10-06 13:42:09'),
(4, 5, 'AIM-CLM-2026-000004', '296e4e42408116feb969581d53bcf95438b46f5d358a93d3901b732b34b28d00', 'Ilang', '2026-10-06', 'uploads/claims/1791274374_e835a3055e95ce03d331.png', NULL, '08123456789', 'Penyerahan Langsung', NULL, 1, 'Klaim Diterima', '2026-10-06 15:12:54', '2026-10-07 16:12:49'),
(5, 6, 'AIM-CLM-2026-000005', '2dda7e50bb347b48bcc1096714f773bea3ff9191dfdba90afdc1fc217df107ad', 'Pecah', '2026-10-08', 'uploads/claims/1791709292_287f79431cf4f1ecd9cd.png', 'uploads/claims/1791709292_6c714def250f20724466.mp4', '085709439400', 'Penyerahan Langsung', NULL, 1, 'Pengajuan Baru', '2026-10-11 16:01:32', '2026-10-11 16:01:32'),
(6, 6, 'AIM-CLM-2026-000006', 'aa3eebf544e5dac29cfa646ec74c291242eeb8ee93f6038b95412581034217cc', 'Pecah', '2026-10-06', 'uploads/claims/1791709472_60d6eff6bce47badd898.png', 'uploads/claims/1791709472_ca236077c69cd94e40f5.mp4', '085709439400', 'Penyerahan Langsung', NULL, 1, 'Selesai', '2026-10-11 16:04:32', '2026-10-11 16:17:56');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `claim_histories`
--
ALTER TABLE `claim_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warranty_claim_id` (`warranty_claim_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_notifications_expiry_reminder` (`template`,`warranty_id`,`reminder_date`,`status`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `qc_checklist_items`
--
ALTER TABLE `qc_checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qc_inspection_id` (`qc_inspection_id`);

--
-- Indeks untuk tabel `qc_documentations`
--
ALTER TABLE `qc_documentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qc_inspection_id` (`qc_inspection_id`);

--
-- Indeks untuk tabel `qc_inspections`
--
ALTER TABLE `qc_inspections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_unit_id` (`product_unit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_unit_id` (`product_unit_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_id` (`sale_id`),
  ADD UNIQUE KEY `warranty_number` (`warranty_number`),
  ADD UNIQUE KEY `qr_token` (`qr_token`);

--
-- Indeks untuk tabel `warranty_claims`
--
ALTER TABLE `warranty_claims`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `claim_number` (`claim_number`),
  ADD KEY `warranty_id` (`warranty_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `claim_histories`
--
ALTER TABLE `claim_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `qc_checklist_items`
--
ALTER TABLE `qc_checklist_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `qc_documentations`
--
ALTER TABLE `qc_documentations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `qc_inspections`
--
ALTER TABLE `qc_inspections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `warranties`
--
ALTER TABLE `warranties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `warranty_claims`
--
ALTER TABLE `warranty_claims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `claim_histories`
--
ALTER TABLE `claim_histories`
  ADD CONSTRAINT `claim_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `claim_histories_warranty_claim_id_foreign` FOREIGN KEY (`warranty_claim_id`) REFERENCES `warranty_claims` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `product_units`
--
ALTER TABLE `product_units`
  ADD CONSTRAINT `product_units_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `qc_checklist_items`
--
ALTER TABLE `qc_checklist_items`
  ADD CONSTRAINT `qc_checklist_items_qc_inspection_id_foreign` FOREIGN KEY (`qc_inspection_id`) REFERENCES `qc_inspections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `qc_documentations`
--
ALTER TABLE `qc_documentations`
  ADD CONSTRAINT `qc_documentations_qc_inspection_id_foreign` FOREIGN KEY (`qc_inspection_id`) REFERENCES `qc_inspections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `qc_inspections`
--
ALTER TABLE `qc_inspections`
  ADD CONSTRAINT `qc_inspections_product_unit_id_foreign` FOREIGN KEY (`product_unit_id`) REFERENCES `product_units` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `qc_inspections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `sales_product_unit_id_foreign` FOREIGN KEY (`product_unit_id`) REFERENCES `product_units` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `warranties`
--
ALTER TABLE `warranties`
  ADD CONSTRAINT `warranties_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `warranty_claims`
--
ALTER TABLE `warranty_claims`
  ADD CONSTRAINT `warranty_claims_warranty_id_foreign` FOREIGN KEY (`warranty_id`) REFERENCES `warranties` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
