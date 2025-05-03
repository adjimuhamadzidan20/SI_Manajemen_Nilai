-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2025 pada 05.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_nilai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_admin`
--

CREATE TABLE `dt_admin` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dt_admin`
--

INSERT INTO `dt_admin` (`id`, `username`, `password`, `nama_admin`, `status`, `alamat`, `email`) VALUES
(1, 'admin123', '0192023a7bbd73250516f069df18b500', 'Adji Muhamad Zidan', 'Administrator', 'Jatirahayu, Kota Bekasi', 'adjimuhamadzidan@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_jurusan`
--

CREATE TABLE `dt_jurusan` (
  `id_jurusan` int(20) NOT NULL,
  `kd_jurusan` varchar(30) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `nama_panjang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_kelas`
--

CREATE TABLE `dt_kelas` (
  `id_kelas` int(20) NOT NULL,
  `kd_kelas` varchar(30) NOT NULL,
  `id_jurusan` int(20) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `id_periode` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_mapel`
--

CREATE TABLE `dt_mapel` (
  `id_mapel` int(20) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `id_jurusan` int(20) NOT NULL,
  `id_periode` int(20) NOT NULL,
  `guru` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_nilai_murid`
--

CREATE TABLE `dt_nilai_murid` (
  `id_nilai` int(20) NOT NULL,
  `id_siswa` int(20) DEFAULT 0,
  `id_mapel` int(20) DEFAULT 0,
  `kelas` varchar(20) DEFAULT '0',
  `id_jurusan` int(20) DEFAULT 0,
  `id_periode` int(20) DEFAULT 0,
  `semester` varchar(30) DEFAULT '0',
  `nilai_1` int(20) DEFAULT 0,
  `nilai_2` int(20) DEFAULT 0,
  `nilai_3` int(20) DEFAULT 0,
  `nilai_4` int(20) DEFAULT 0,
  `nilai_5` int(20) DEFAULT 0,
  `nilai_6` int(20) DEFAULT 0,
  `nilai_7` int(20) DEFAULT 0,
  `nilai_8` int(20) DEFAULT 0,
  `nilai_9` int(20) DEFAULT 0,
  `na_materi` int(30) DEFAULT 0,
  `LM_1` int(30) DEFAULT 0,
  `LM_2` int(30) DEFAULT 0,
  `LM_3` int(3) DEFAULT 0,
  `na_sumatif` int(30) DEFAULT 0,
  `pts` int(20) NOT NULL,
  `pat` int(20) NOT NULL,
  `nilai_akhir` int(20) NOT NULL,
  `nilai_rapor` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_periode_ajaran`
--

CREATE TABLE `dt_periode_ajaran` (
  `id_periode` int(20) NOT NULL,
  `kd_ajaran` varchar(30) NOT NULL,
  `semester_pertama` varchar(35) NOT NULL,
  `semester_kedua` varchar(35) NOT NULL,
  `tahun_ajaran` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_siswa`
--

CREATE TABLE `dt_siswa` (
  `id_siswa` int(20) NOT NULL,
  `kd_siswa` varchar(30) NOT NULL,
  `nis` int(40) NOT NULL,
  `nisn` int(40) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_kelas` int(20) NOT NULL,
  `id_jurusan` int(20) NOT NULL,
  `id_periode` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dt_admin`
--
ALTER TABLE `dt_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dt_jurusan`
--
ALTER TABLE `dt_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `dt_kelas`
--
ALTER TABLE `dt_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `dt_mapel`
--
ALTER TABLE `dt_mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `dt_nilai_murid`
--
ALTER TABLE `dt_nilai_murid`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_siswa` (`id_siswa`,`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `dt_periode_ajaran`
--
ALTER TABLE `dt_periode_ajaran`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `dt_siswa`
--
ALTER TABLE `dt_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_kelas` (`id_kelas`,`id_jurusan`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dt_admin`
--
ALTER TABLE `dt_admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dt_jurusan`
--
ALTER TABLE `dt_jurusan`
  MODIFY `id_jurusan` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_kelas`
--
ALTER TABLE `dt_kelas`
  MODIFY `id_kelas` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_mapel`
--
ALTER TABLE `dt_mapel`
  MODIFY `id_mapel` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_nilai_murid`
--
ALTER TABLE `dt_nilai_murid`
  MODIFY `id_nilai` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_periode_ajaran`
--
ALTER TABLE `dt_periode_ajaran`
  MODIFY `id_periode` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_siswa`
--
ALTER TABLE `dt_siswa`
  MODIFY `id_siswa` int(20) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dt_kelas`
--
ALTER TABLE `dt_kelas`
  ADD CONSTRAINT `dt_kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `dt_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_kelas_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `dt_periode_ajaran` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dt_mapel`
--
ALTER TABLE `dt_mapel`
  ADD CONSTRAINT `dt_mapel_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `dt_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_mapel_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `dt_periode_ajaran` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dt_nilai_murid`
--
ALTER TABLE `dt_nilai_murid`
  ADD CONSTRAINT `dt_nilai_murid_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `dt_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_murid_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `dt_mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_murid_ibfk_4` FOREIGN KEY (`id_jurusan`) REFERENCES `dt_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_murid_ibfk_5` FOREIGN KEY (`id_periode`) REFERENCES `dt_periode_ajaran` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dt_siswa`
--
ALTER TABLE `dt_siswa`
  ADD CONSTRAINT `dt_siswa_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `dt_periode_ajaran` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `dt_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_siswa_ibfk_3` FOREIGN KEY (`id_jurusan`) REFERENCES `dt_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
