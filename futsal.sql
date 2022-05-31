-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2022 pada 05.29
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futsal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `receipt_image` text DEFAULT NULL,
  `is_confirmed` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `field_id`, `total_price`, `receipt_image`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(6, 11, 1, 0, NULL, 0, '2022-02-24 00:00:00', '2022-02-24 00:00:00'),
(7, 11, 5, 0, NULL, 0, '2022-02-24 00:00:00', '2022-03-04 11:18:20'),
(8, 11, 5, 80000, NULL, 0, '2022-02-25 00:00:00', '2022-02-25 00:00:00'),
(9, 11, 5, 80000, NULL, 0, '2022-02-25 00:00:00', '2022-02-25 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_booking`
--

CREATE TABLE `detail_booking` (
  `detail_booking_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `field_number` int(11) NOT NULL,
  `booking_time` text NOT NULL,
  `booking_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_booking`
--

INSERT INTO `detail_booking` (`detail_booking_id`, `booking_id`, `field_number`, `booking_time`, `booking_date`) VALUES
(4, 6, 0, '6', 'Thu, 24 Feb 2022'),
(5, 6, 0, '14', 'Thu, 24 Feb 2022'),
(6, 6, 1, '10', 'Thu, 24 Feb 2022'),
(7, 7, 0, '10', 'Thu, 24 Feb 2022'),
(8, 7, 0, '11', 'Thu, 24 Feb 2022'),
(9, 7, 0, '17', 'Fri, 25 Feb 2022'),
(10, 7, 0, '18', 'Fri, 25 Feb 2022'),
(11, 8, 0, '15', 'Fri, 25 Feb 2022'),
(12, 8, 0, '6', 'Sat, 26 Feb 2022'),
(13, 9, 0, '15', 'Fri, 25 Feb 2022'),
(14, 9, 0, '6', 'Sat, 26 Feb 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `field_name` text NOT NULL,
  `address` text NOT NULL,
  `subdistrict` text NOT NULL,
  `district` text NOT NULL,
  `city` text NOT NULL,
  `province` text NOT NULL,
  `number_of_fields` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `field_image` text NOT NULL DEFAULT 'default.jpg',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `bank_account` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `field`
--

INSERT INTO `field` (`field_id`, `field_name`, `address`, `subdistrict`, `district`, `city`, `province`, `number_of_fields`, `price`, `owner_id`, `created_at`, `updated_at`, `field_image`, `is_active`, `bank_account`) VALUES
(1, 'Futsal baru', 'Jl. Pagedangan 1213312', '', '', '', '', 2, 0, 9, '2022-02-18 00:00:00', '2022-02-18 00:00:00', 'default.jpg', 1, 'BCA 10123 A.n Sunaryo'),
(5, 'asd', 'A112', 'Pasir Ampo__3603140002', 'Kresek__3603140', 'Kabupaten Tangerang__3603', 'Banten__36', 1, 40000, 10, '2022-02-18 00:00:00', '2022-02-25 00:00:00', 'default.jpg', 1, 'BCA 10123 A.n Sunaryo'),
(7, '', '', '', '', '', '', 0, 0, 16, '2022-03-04 12:13:18', '2022-03-04 12:13:18', 'default.jpg', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forgot_password`
--

CREATE TABLE `forgot_password` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `link` text NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `forgot_password`
--

INSERT INTO `forgot_password` (`request_id`, `user_id`, `updated_at`, `created_at`, `link`, `is_valid`) VALUES
(1, 16, '2022-02-28 09:03:13', '2022-02-28 09:03:13', '9c13896831327b09a62c61b99f543adf', 1),
(2, 16, '2022-02-28 09:05:03', '2022-02-28 09:05:03', 'ed65e4bfd5458689950a483e71545f1d', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `owner_request`
--

CREATE TABLE `owner_request` (
  `owner_request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `owner_request`
--

INSERT INTO `owner_request` (`owner_request_id`, `user_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 'aasd', 1, '2022-03-04 12:02:21', '2022-03-04 12:02:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'member'),
(2, 'owner'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team` varchar(50) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `team`
--

INSERT INTO `team` (`team_id`, `team`, `leader_id`, `created_at`, `updated_at`) VALUES
(12, 'juragan', 16, '2022-03-03', '2022-03-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `phone_number` text NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `team_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` text NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `phone_number`, `role_id`, `team_id`, `created_at`, `updated_at`, `image`) VALUES
(8, 'a@g.com', 'hahaha', 'Admin', '08123123', 3, NULL, '2022-02-17 09:57:55', '2022-02-25 10:21:04', 'default.jpg'),
(9, 'o@g.com', 'hahaha', 'owner', '08912', 2, NULL, '2022-02-18 05:39:12', '2022-02-18 05:39:12', 'default.jpg'),
(10, 'm@g.com', 'hahaha', 'Member', '081', 2, NULL, '2022-02-18 07:10:59', '2022-02-25 10:35:15', 'default.jpg'),
(11, 'f@g.com', 'hahaha', 'fadel', '0812', 1, NULL, '2022-02-18 08:55:09', '2022-03-04 11:17:13', 'default.jpg'),
(16, 'erickgennady@gmail.com', 'hahaha', 'erick', '08991712772', 2, 12, '2022-02-28 08:21:22', '2022-03-04 11:47:03', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indeks untuk tabel `detail_booking`
--
ALTER TABLE `detail_booking`
  ADD PRIMARY KEY (`detail_booking_id`);

--
-- Indeks untuk tabel `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indeks untuk tabel `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`request_id`);

--
-- Indeks untuk tabel `owner_request`
--
ALTER TABLE `owner_request`
  ADD PRIMARY KEY (`owner_request_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detail_booking`
--
ALTER TABLE `detail_booking`
  MODIFY `detail_booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `owner_request`
--
ALTER TABLE `owner_request`
  MODIFY `owner_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
