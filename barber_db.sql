-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2025 pada 08.23
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
-- Database: `barber_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(25) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `id`, `password`) VALUES
('adit', 1, '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `layanan_terpilih` text DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Belum','Proses','Selesai') DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `nomor_antrian`, `nama`, `phone`, `tanggal`, `waktu`, `layanan_terpilih`, `total_harga`, `created_at`, `status`) VALUES
(51, 3, 'utan', '9171', '2025-04-18', '09:43:00', 'Cukur Jenggot, Perawatan Rambut', 70000, '2025-04-18 02:44:03', 'Selesai'),
(52, 4, 'dadang', '512', '2025-04-18', '10:18:00', 'Potong Rambut, smoting', 85000, '2025-04-18 03:19:02', 'Proses'),
(53, 5, 'pakdidi', '81719', '2025-04-18', '10:19:00', 'Potong Rambut, Cat warna rambut, smoting', 135000, '2025-04-18 03:19:31', 'Proses'),
(54, 6, 'bokem', '96', '2025-04-18', '10:19:00', 'Potong Rambut, Cukur Jenggot', 70000, '2025-04-18 03:20:05', 'Belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_pesanan`
--

CREATE TABLE `laporan_pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `layanan_terpilih` text NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan_pesanan`
--

INSERT INTO `laporan_pesanan` (`id`, `nama`, `phone`, `tanggal`, `waktu`, `layanan_terpilih`, `total_harga`, `created_at`, `bulan`, `tahun`) VALUES
(1, 'adit', '112', '2025-04-16', '10:41:00', 'Potong Rambut, Perawatan Rambut, Cat warna rambut', 130000.00, '2025-04-16 16:18:11', 0, 0),
(2, 'messi', '10', '2025-04-16', '15:42:00', 'potong rambut', 85000.00, '2025-04-16 16:18:11', 0, 0),
(3, 'mbape', '10', '2025-04-16', '20:59:00', 'Potong Rambut, Cat warna rambut', 90000.00, '2025-04-16 16:18:11', 0, 0),
(4, 'rapinha', '11', '2025-05-16', '21:47:00', 'Potong Rambut, smoting', 85000.00, '2025-04-16 16:49:18', 0, 0),
(5, 'hehhehe', '262719', '2025-05-17', '08:39:00', 'Potong Rambut, Cat warna rambut', 90000.00, '2025-04-17 04:01:57', 0, 0),
(6, 'adit', '1919', '2025-05-23', '09:00:00', 'Potong Rambut, Perawatan Rambut, Cat warna rambut', 130000.00, '2025-04-17 04:01:57', 0, 0),
(7, 'antri', '112', '2025-04-17', '09:33:00', 'Potong Rambut, Perawatan Rambut, Cat warna rambut', 130000.00, '2025-04-17 04:35:07', 0, 0),
(8, 'Struktur data', '17281', '2025-04-17', '15:37:00', 'Potong Rambut', 40000.00, '2025-04-17 10:38:20', 0, 0),
(9, 'messiGOAT', '10', '2025-04-18', '07:12:00', 'Potong Rambut, smoting', 85000.00, '2025-04-18 05:21:24', 0, 0),
(10, 'ninabobo', '62718', '2025-04-18', '09:38:00', 'Potong Rambut, Cukur Jenggot, Perawatan Rambut, smoting', 155000.00, '2025-04-18 05:21:24', 0, 0),
(11, 'utan', '9171', '2025-04-18', '09:43:00', 'Cukur Jenggot, Perawatan Rambut', 70000.00, '2025-04-18 05:21:24', 0, 0),
(12, 'dadang', '512', '2025-04-18', '10:18:00', 'Potong Rambut, smoting', 85000.00, '2025-04-18 05:21:24', 0, 0),
(13, 'pakdidi', '81719', '2025-04-18', '10:19:00', 'Potong Rambut, Cat warna rambut, smoting', 135000.00, '2025-04-18 05:21:24', 0, 0),
(14, 'bokem', '96', '2025-04-18', '10:19:00', 'Potong Rambut, Cukur Jenggot', 70000.00, '2025-04-18 05:21:24', 0, 0),
(15, 'kai', '3939', '2025-04-18', '10:20:00', 'Potong Rambut, smoting', 85000.00, '2025-04-18 05:21:24', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_antrian`
--

CREATE TABLE `nomor_antrian` (
  `id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nomor_antrian`
--

INSERT INTO `nomor_antrian` (`id`, `nomor`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_services`
--

CREATE TABLE `pesanan_services` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan_services`
--

INSERT INTO `pesanan_services` (`id`, `pesanan_id`, `service_id`) VALUES
(155, 51, 2),
(156, 51, 3),
(159, 52, 1),
(160, 52, 6),
(164, 53, 1),
(165, 53, 4),
(166, 53, 6),
(169, 54, 1),
(170, 54, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `name`, `price`) VALUES
(1, 'Potong Rambut', 40000),
(2, 'Cukur Jenggot', 30000),
(3, 'Perawatan Rambut', 40000),
(4, 'Cat warna rambut', 50000),
(6, 'smoting', 45000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_pesanan`
--
ALTER TABLE `laporan_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_services`
--
ALTER TABLE `pesanan_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `laporan_pesanan`
--
ALTER TABLE `laporan_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pesanan_services`
--
ALTER TABLE `pesanan_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan_services`
--
ALTER TABLE `pesanan_services`
  ADD CONSTRAINT `pesanan_services_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `detail_pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
