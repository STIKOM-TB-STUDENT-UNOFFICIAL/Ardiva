-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2025 pada 03.53
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
-- Database: `stikomtb_ardiva`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `instrumen`
--

CREATE TABLE `instrumen` (
  `idinstrumen` int(11) NOT NULL,
  `namainstrumen` varchar(100) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `instrumen`
--

INSERT INTO `instrumen` (`idinstrumen`, `namainstrumen`, `tahun`) VALUES
(18, 'Test', '2024'),
(19, 'Test Lagi', '2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `insub_detail`
--

CREATE TABLE `insub_detail` (
  `idinsub` int(11) NOT NULL,
  `idinstrumen` int(11) DEFAULT NULL,
  `idsubkegiatan_detail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `insub_detail`
--

INSERT INTO `insub_detail` (`idinsub`, `idinstrumen`, `idsubkegiatan_detail`) VALUES
(99, 18, 12),
(100, 19, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `idkegiatan` int(11) NOT NULL,
  `kegiatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`idkegiatan`, `kegiatan`) VALUES
(1, 'Belajar Mengajar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_file`
--

CREATE TABLE `m_file` (
  `idfile` int(11) NOT NULL,
  `idsubkegiatan_detail` int(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `topik` varchar(75) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `thnakademik` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_file_detail`
--

CREATE TABLE `m_file_detail` (
  `id_file_detail` int(11) NOT NULL,
  `id_m_file` int(11) NOT NULL,
  `filename` varchar(220) NOT NULL,
  `file` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkegiatan`
--

CREATE TABLE `subkegiatan` (
  `idsubkegiatan` int(11) NOT NULL,
  `idkegiatan` int(11) DEFAULT NULL,
  `namasubkegiatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `subkegiatan`
--

INSERT INTO `subkegiatan` (`idsubkegiatan`, `idkegiatan`, `namasubkegiatan`) VALUES
(1, 1, 'PJJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkegiatan_detail`
--

CREATE TABLE `subkegiatan_detail` (
  `idsubkegiatan_detail` int(11) NOT NULL,
  `idsubkegiatan` int(11) DEFAULT NULL,
  `namasubkegiatan_detail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `subkegiatan_detail`
--

INSERT INTO `subkegiatan_detail` (`idsubkegiatan_detail`, `idsubkegiatan`, `namasubkegiatan_detail`) VALUES
(12, 1, 'sdffsdfdsffsdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id` int(11) NOT NULL,
  `tahun` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id`, `tahun`) VALUES
(1, '2025/2026');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `instrumen`
--
ALTER TABLE `instrumen`
  ADD PRIMARY KEY (`idinstrumen`);

--
-- Indeks untuk tabel `insub_detail`
--
ALTER TABLE `insub_detail`
  ADD PRIMARY KEY (`idinsub`),
  ADD KEY `idinstrumen` (`idinstrumen`),
  ADD KEY `idsubkegiatan_detail` (`idsubkegiatan_detail`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`idkegiatan`);

--
-- Indeks untuk tabel `m_file`
--
ALTER TABLE `m_file`
  ADD PRIMARY KEY (`idfile`),
  ADD KEY `idsubkegiatan_detail` (`idsubkegiatan_detail`);

--
-- Indeks untuk tabel `m_file_detail`
--
ALTER TABLE `m_file_detail`
  ADD PRIMARY KEY (`id_file_detail`),
  ADD KEY `id_m_file` (`id_m_file`);

--
-- Indeks untuk tabel `subkegiatan`
--
ALTER TABLE `subkegiatan`
  ADD PRIMARY KEY (`idsubkegiatan`) USING BTREE,
  ADD KEY `idkegiatan` (`idkegiatan`);

--
-- Indeks untuk tabel `subkegiatan_detail`
--
ALTER TABLE `subkegiatan_detail`
  ADD PRIMARY KEY (`idsubkegiatan_detail`),
  ADD KEY `idsubkegiatan` (`idsubkegiatan`);

--
-- Indeks untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `instrumen`
--
ALTER TABLE `instrumen`
  MODIFY `idinstrumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `insub_detail`
--
ALTER TABLE `insub_detail`
  MODIFY `idinsub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `idkegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_file`
--
ALTER TABLE `m_file`
  MODIFY `idfile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_file_detail`
--
ALTER TABLE `m_file_detail`
  MODIFY `id_file_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `subkegiatan`
--
ALTER TABLE `subkegiatan`
  MODIFY `idsubkegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `subkegiatan_detail`
--
ALTER TABLE `subkegiatan_detail`
  MODIFY `idsubkegiatan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `insub_detail`
--
ALTER TABLE `insub_detail`
  ADD CONSTRAINT `insub_detail_ibfk_1` FOREIGN KEY (`idinstrumen`) REFERENCES `instrumen` (`idinstrumen`),
  ADD CONSTRAINT `insub_detail_ibfk_2` FOREIGN KEY (`idsubkegiatan_detail`) REFERENCES `subkegiatan_detail` (`idsubkegiatan_detail`);

--
-- Ketidakleluasaan untuk tabel `m_file`
--
ALTER TABLE `m_file`
  ADD CONSTRAINT `m_file_ibfk_1` FOREIGN KEY (`idsubkegiatan_detail`) REFERENCES `subkegiatan_detail` (`idsubkegiatan_detail`);

--
-- Ketidakleluasaan untuk tabel `m_file_detail`
--
ALTER TABLE `m_file_detail`
  ADD CONSTRAINT `m_file_detail_ibfk_1` FOREIGN KEY (`id_m_file`) REFERENCES `m_file` (`idfile`);

--
-- Ketidakleluasaan untuk tabel `subkegiatan`
--
ALTER TABLE `subkegiatan`
  ADD CONSTRAINT `subkegiatan_ibfk_1` FOREIGN KEY (`idkegiatan`) REFERENCES `kegiatan` (`idkegiatan`);

--
-- Ketidakleluasaan untuk tabel `subkegiatan_detail`
--
ALTER TABLE `subkegiatan_detail`
  ADD CONSTRAINT `subkegiatan_detail_ibfk_1` FOREIGN KEY (`idsubkegiatan`) REFERENCES `subkegiatan` (`idsubkegiatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
