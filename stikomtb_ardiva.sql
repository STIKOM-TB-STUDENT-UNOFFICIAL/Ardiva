-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2025 pada 10.12
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
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_prodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `userid`, `kode_prodi`) VALUES
(1, 'admin', 'UV'),
(2, 'irfan', 'SI'),
(3, 'solikhun', 'TI'),
(4, '0118088603', 'KA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instrumen`
--

CREATE TABLE `instrumen` (
  `idinstrumen` int(11) NOT NULL,
  `namainstrumen` varchar(100) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `insub_detail`
--

CREATE TABLE `insub_detail` (
  `idinsub` int(11) NOT NULL,
  `idinstrumen` int(11) DEFAULT NULL,
  `idsubkegiatan_detail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `idkegiatan` int(11) NOT NULL,
  `kegiatan` varchar(100) DEFAULT NULL,
  `kode_prodi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`idkegiatan`, `kegiatan`, `kode_prodi`) VALUES
(12, 'TI Aja', 'TI'),
(13, 'SI aja', 'SI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_system`
--

CREATE TABLE `login_system` (
  `userid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `level` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'mahasiswa',
  `blokir` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `login_system`
--

INSERT INTO `login_system` (`userid`, `password`, `nama_lengkap`, `foto`, `level`, `blokir`, `last_login`) VALUES
('0118088603', 'f0233d140392b858011ccfccc0de9de9', 'irfan damanik', NULL, 'dosen', 'N', NULL),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 'admin', 'N', '2025-11-24 10:10:20'),
('irfan', '21232f297a57a5a743894a0e4a801fc3', 'irfan damanik', NULL, 'admin', 'N', '2025-11-24 07:23:29'),
('solikhun', '75179dc414f14ae1fa84164e2f0ab053', 'Solikhun', NULL, 'admin', 'N', '2025-11-24 07:23:08');

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
  `thnakademik` varchar(9) DEFAULT NULL,
  `kode_prodi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_file_detail`
--

CREATE TABLE `m_file_detail` (
  `id_file_detail` int(11) NOT NULL,
  `id_m_file` int(11) NOT NULL,
  `filename` varchar(220) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` longblob NOT NULL,
  `kode_prodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `kode_prodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_prodi` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`kode_prodi`, `nama_prodi`) VALUES
('IF', 'Informatika'),
('KA', 'Komputerisasi Akutansi'),
('MI', 'Manajemen Informatika'),
('SI', 'Sistem Informasi'),
('TI', 'Teknik Informatika'),
('UV', 'Universal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkegiatan`
--

CREATE TABLE `subkegiatan` (
  `idsubkegiatan` int(11) NOT NULL,
  `idkegiatan` int(11) DEFAULT NULL,
  `namasubkegiatan` varchar(100) DEFAULT NULL,
  `kode_prodi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkegiatan_detail`
--

CREATE TABLE `subkegiatan_detail` (
  `idsubkegiatan_detail` int(11) NOT NULL,
  `idsubkegiatan` int(11) DEFAULT NULL,
  `namasubkegiatan_detail` varchar(100) DEFAULT NULL,
  `kode_prodi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id` int(11) NOT NULL,
  `tahun` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_prodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id`, `tahun`, `kode_prodi`) VALUES
(6, '2025/2026', 'UV'),
(7, '2025/2026', 'SI'),
(8, '2015/2016', 'TI');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `kode_prodi` (`kode_prodi`);

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
  ADD PRIMARY KEY (`idkegiatan`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indeks untuk tabel `login_system`
--
ALTER TABLE `login_system`
  ADD PRIMARY KEY (`userid`);

--
-- Indeks untuk tabel `m_file`
--
ALTER TABLE `m_file`
  ADD PRIMARY KEY (`idfile`),
  ADD KEY `idsubkegiatan_detail` (`idsubkegiatan_detail`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indeks untuk tabel `m_file_detail`
--
ALTER TABLE `m_file_detail`
  ADD PRIMARY KEY (`id_file_detail`),
  ADD KEY `id_m_file` (`id_m_file`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kode_prodi`);

--
-- Indeks untuk tabel `subkegiatan`
--
ALTER TABLE `subkegiatan`
  ADD PRIMARY KEY (`idsubkegiatan`) USING BTREE,
  ADD KEY `idkegiatan` (`idkegiatan`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indeks untuk tabel `subkegiatan_detail`
--
ALTER TABLE `subkegiatan_detail`
  ADD PRIMARY KEY (`idsubkegiatan_detail`),
  ADD KEY `idsubkegiatan` (`idsubkegiatan`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indeks untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `instrumen`
--
ALTER TABLE `instrumen`
  MODIFY `idinstrumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `insub_detail`
--
ALTER TABLE `insub_detail`
  MODIFY `idinsub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `idkegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `m_file`
--
ALTER TABLE `m_file`
  MODIFY `idfile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `m_file_detail`
--
ALTER TABLE `m_file_detail`
  MODIFY `id_file_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `subkegiatan`
--
ALTER TABLE `subkegiatan`
  MODIFY `idsubkegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `subkegiatan_detail`
--
ALTER TABLE `subkegiatan_detail`
  MODIFY `idsubkegiatan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD CONSTRAINT `hak_akses_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `login_system` (`userid`),
  ADD CONSTRAINT `hak_akses_ibfk_3` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Ketidakleluasaan untuk tabel `insub_detail`
--
ALTER TABLE `insub_detail`
  ADD CONSTRAINT `insub_detail_ibfk_1` FOREIGN KEY (`idinstrumen`) REFERENCES `instrumen` (`idinstrumen`),
  ADD CONSTRAINT `insub_detail_ibfk_2` FOREIGN KEY (`idsubkegiatan_detail`) REFERENCES `subkegiatan_detail` (`idsubkegiatan_detail`);

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Ketidakleluasaan untuk tabel `m_file`
--
ALTER TABLE `m_file`
  ADD CONSTRAINT `m_file_ibfk_1` FOREIGN KEY (`idsubkegiatan_detail`) REFERENCES `subkegiatan_detail` (`idsubkegiatan_detail`),
  ADD CONSTRAINT `m_file_ibfk_2` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Ketidakleluasaan untuk tabel `m_file_detail`
--
ALTER TABLE `m_file_detail`
  ADD CONSTRAINT `m_file_detail_ibfk_1` FOREIGN KEY (`id_m_file`) REFERENCES `m_file` (`idfile`),
  ADD CONSTRAINT `m_file_detail_ibfk_2` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Ketidakleluasaan untuk tabel `subkegiatan`
--
ALTER TABLE `subkegiatan`
  ADD CONSTRAINT `subkegiatan_ibfk_1` FOREIGN KEY (`idkegiatan`) REFERENCES `kegiatan` (`idkegiatan`),
  ADD CONSTRAINT `subkegiatan_ibfk_2` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Ketidakleluasaan untuk tabel `subkegiatan_detail`
--
ALTER TABLE `subkegiatan_detail`
  ADD CONSTRAINT `subkegiatan_detail_ibfk_1` FOREIGN KEY (`idsubkegiatan`) REFERENCES `subkegiatan` (`idsubkegiatan`),
  ADD CONSTRAINT `subkegiatan_detail_ibfk_2` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Ketidakleluasaan untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD CONSTRAINT `tahun_akademik_ibfk_1` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
