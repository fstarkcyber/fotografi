-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jun 2022 pada 16.47
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fotografi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `parrent_id` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `sequence` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `icon`, `parrent_id`, `role_id`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', 'ni ni-tv-2', 0, 1, 1, '2022-06-08 18:44:14', '2022-06-08 18:56:51'),
(2, 'Master Data', 'master-data', 'ni ni-diamond', 0, 1, 2, '2022-06-08 18:55:17', '2022-06-08 18:56:52'),
(3, 'Daftar Paket', 'paket', 'ni ni-bag-17', 2, 1, 1, '2022-06-08 18:56:50', '2022-06-14 16:17:53'),
(4, 'Daftar User', 'users', 'ni ni-circle-08', 0, 1, 5, '2022-06-09 17:56:30', '2022-06-16 15:20:43'),
(5, 'Daftar Transaksi', 'transaksi', 'ni ni-money-coins', 0, 1, 3, '2022-06-09 17:58:57', '2022-06-17 16:18:32'),
(6, 'Dashboard', 'dashboard', 'ni ni-tv-2', 0, 3, 1, '2022-06-09 17:58:57', '2022-06-09 18:03:41'),
(7, 'Daftar Paket', 'paket-c', 'ni ni-bag-17', 0, 3, 2, '2022-06-09 17:58:57', '2022-06-09 18:03:41'),
(8, 'Riwayat Transaksi', 'transaksi-c', 'ni ni-money-coins', 0, 3, 4, '2022-06-09 17:58:57', '2022-06-16 15:16:31'),
(9, 'Jadwal', 'jadwal-c', 'ni ni-calendar-grid-58', 0, 3, 5, '2022-06-09 17:58:57', '2022-06-16 14:15:14'),
(10, 'Booking', 'booking-c', 'ni ni-time-alarm', 0, 3, 3, '2022-06-09 17:58:57', '2022-06-16 14:27:04'),
(11, 'Daftar Jadwal', 'jadwal', 'ni ni-calendar-grid-58', 0, 1, 4, '2022-06-09 17:58:57', '2022-06-16 15:20:51'),
(12, 'Dashboard', 'dashboard', 'ni ni-tv-2', 0, 2, 1, '2022-06-09 17:58:57', '2022-06-09 18:03:41'),
(13, 'Daftar Paket', 'paket-f', 'ni ni-bag-17', 0, 2, 2, '2022-06-09 17:58:57', '2022-06-09 18:03:41'),
(14, 'Jadwal', 'jadwal-f', 'ni ni-calendar-grid-58', 0, 2, 5, '2022-06-09 17:58:57', '2022-06-16 14:15:14'),
(15, 'Laporan', 'laporan', 'ni ni-book-bookmark', 0, 1, 5, '2022-06-09 17:58:57', '2022-06-29 19:42:51'),
(16, 'Hasil Foto', 'hasil-foto-f', 'ni ni-calendar-grid-58', 0, 2, 6, '2022-06-09 17:58:57', '2022-06-16 14:15:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packets`
--

CREATE TABLE `packets` (
  `id_packet` bigint(20) UNSIGNED NOT NULL,
  `packet_name` varchar(150) DEFAULT NULL,
  `packet_duration` varchar(150) DEFAULT NULL,
  `packet_price` int(10) UNSIGNED DEFAULT NULL,
  `packet_description` text DEFAULT NULL,
  `membership` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `packets`
--

INSERT INTO `packets` (`id_packet`, `packet_name`, `packet_duration`, `packet_price`, `packet_description`, `membership`, `created_at`, `updated_at`) VALUES
(1, 'Paket 1', '3 Hours of Usage', 500000, 'Kostum, 1 Backround. 15 Foto (Original Photo), 7 Foto Edit, Tidak Cetak', 'no', '2022-06-14 17:02:38', '2022-06-14 17:03:45'),
(2, 'Paket 2', '6 Hours of Usage', 800000, 'Kostum, 3 Background, 27 Foto, (Original Photo), 15 Foto Edit, 3 Cetak', 'no', '2022-06-14 17:03:43', NULL),
(3, 'Paket 3', '10 Hours of Usage', 1200000, 'Kostum, 5 Background, 40 Foto (Original Photo), 20 Foto Edit, 10 Cetak', 'no', '2022-06-14 17:04:46', NULL),
(4, 'Paket 4', '10 Hours of Usage', 1800000, 'Kostum, 7 Background, 50 Foto (Original Photo), 25 Foto Edit, Cetak Album', 'no', '2022-06-14 17:05:35', NULL),
(5, 'Paket 5', 'Unlimited Shoot', 2500000, 'Kostum, Make up, All Background, 80 Foto (Full HD), 40 Foto Edit, Album Jumbo', 'no', '2022-06-14 17:06:46', NULL),
(6, 'Paket 6', 'Unlimited Shoot', 5000000, 'Kostum, Make up, All Background, 110 Foto (Full HD), 60 Foto Edit, Album Jumbo', 'no', '2022-06-14 17:07:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `packet_images`
--

CREATE TABLE `packet_images` (
  `id_packet_images` bigint(20) UNSIGNED NOT NULL,
  `packet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_name` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `packet_images`
--

INSERT INTO `packet_images` (`id_packet_images`, `packet_id`, `image_name`) VALUES
(1, 1, 'paket-1.jpeg'),
(2, 2, 'paket-2.jpeg'),
(3, 3, 'paket-3.jpeg'),
(4, 4, 'paket-4.jpeg'),
(5, 5, 'paket-5.jpeg'),
(6, 6, 'paket-6.jpeg'),
(18, 1, '1.png'),
(19, 1, '2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '2022-06-08 08:41:40', NULL),
(2, 'Fotografer', 'fotografer', '2022-06-09 11:06:46', NULL),
(3, 'Customer', 'customer', '2022-06-09 11:06:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` bigint(20) UNSIGNED NOT NULL,
  `packet_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'customer id',
  `booking_code` varchar(20) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `datetime_fix` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `payment_image` varchar(50) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_validation_at` datetime DEFAULT NULL,
  `payment_validation_by` bigint(20) UNSIGNED DEFAULT NULL,
  `photographer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photographer_take_booking` datetime DEFAULT NULL,
  `photographer_finish_confirm` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `packet_id`, `customer_id`, `booking_code`, `datetime`, `datetime_fix`, `note`, `payment_image`, `payment_date`, `payment_validation_at`, `payment_validation_by`, `photographer_id`, `photographer_take_booking`, `photographer_finish_confirm`, `created_at`, `updated_at`) VALUES
(12, 1, 8, '20220628150940', '2022-06-30 08:00:00', '2022-06-30 09:00:00', 'mohon konfirmasi segera', '20220628150940.png', '2022-06-28 15:10:02', '2022-06-28 15:10:48', 1, 3, '2022-06-28 15:12:26', '2022-06-29 12:04:21', '2022-06-28 20:09:40', '2022-06-29 17:04:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_images`
--

CREATE TABLE `transaction_images` (
  `id_transaction_image` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaction_images`
--

INSERT INTO `transaction_images` (`id_transaction_image`, `transaction_id`, `image_name`) VALUES
(6, 12, 'Legok_Printing1.png'),
(7, 12, '2.png'),
(8, 12, '1.png'),
(9, 12, 'awan.png'),
(10, 12, 'tamara.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `status` bigint(20) DEFAULT 0,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `hp`, `remember_token`, `role_id`, `status`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Fatoni', 'admin@mindotek.com', NULL, '$2y$10$UFcHvhQLBZxdLT69jXnc3uQ94yDw1EiD4zA7/o5.ZTS4UMFPtlsqW', '089676490971', NULL, 1, 1, '8d7cce30957206cd83a26b986052f5c4.png', '2022-06-08 08:42:08', NULL),
(3, 'Melani', 'fotografer@mindotek.com', NULL, '$2y$10$UFcHvhQLBZxdLT69jXnc3uQ94yDw1EiD4zA7/o5.ZTS4UMFPtlsqW', '0881912738123', NULL, 2, 1, '404bb8b63c9f2637a44bf01e9b5c11e6.jpg', '2022-06-08 08:42:08', NULL),
(8, 'Ilham Taufik', 'customer@mindotek.com', NULL, '$2y$10$X4d6ZFlIn7kV3NVcLffGd.lxCLVfuB5UE7KVB0iofYSNW3ZJ7IMRy', '08815925920', NULL, 3, 1, '98a17bdf0919701abfd1d236d1b1374a.png', '2022-06-28 13:06:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_menus` (`role_id`);

--
-- Indeks untuk tabel `packets`
--
ALTER TABLE `packets`
  ADD PRIMARY KEY (`id_packet`);

--
-- Indeks untuk tabel `packet_images`
--
ALTER TABLE `packet_images`
  ADD PRIMARY KEY (`id_packet_images`),
  ADD KEY `id_packet_fk` (`packet_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`slug`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `trx_user_id_fk` (`customer_id`),
  ADD KEY `trx_packet_fk` (`packet_id`);

--
-- Indeks untuk tabel `transaction_images`
--
ALTER TABLE `transaction_images`
  ADD PRIMARY KEY (`id_transaction_image`),
  ADD KEY `images_transaction_id_fk` (`transaction_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `roles_users` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `packets`
--
ALTER TABLE `packets`
  MODIFY `id_packet` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `packet_images`
--
ALTER TABLE `packet_images`
  MODIFY `id_packet_images` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaction_images`
--
ALTER TABLE `transaction_images`
  MODIFY `id_transaction_image` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `role_menus` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `packet_images`
--
ALTER TABLE `packet_images`
  ADD CONSTRAINT `id_packet_fk` FOREIGN KEY (`packet_id`) REFERENCES `packets` (`id_packet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `trx_packet_fk` FOREIGN KEY (`packet_id`) REFERENCES `packets` (`id_packet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_user_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_images`
--
ALTER TABLE `transaction_images`
  ADD CONSTRAINT `images_transaction_id_fk` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id_transaction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `roles_users` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
