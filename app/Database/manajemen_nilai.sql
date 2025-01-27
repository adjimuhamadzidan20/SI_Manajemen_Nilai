-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2025 pada 14.45
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

--
-- Dumping data untuk tabel `dt_jurusan`
--

INSERT INTO `dt_jurusan` (`id_jurusan`, `kd_jurusan`, `nama_jurusan`, `nama_panjang`) VALUES
(1, 'JU001', 'RPL 1', 'Rekayasa Perangkat Lunak'),
(2, 'JU002', 'AFPP 1', 'Airflame Power Plant'),
(6, 'JU003', 'AFPP 2', 'Airflame Power Plant'),
(7, 'JU004', 'TKR 1', 'Teknik Kendaraan Ringan'),
(8, 'JU005', 'Hotel 1', 'Hotel & Pariwisata'),
(9, 'JU006', 'TP 1', 'Teknik Permesinan'),
(10, 'JU007', 'TITL', 'Teknik Listrik');

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

--
-- Dumping data untuk tabel `dt_kelas`
--

INSERT INTO `dt_kelas` (`id_kelas`, `kd_kelas`, `id_jurusan`, `kelas`, `id_periode`) VALUES
(13, 'KE001', 1, 'X', 4),
(15, 'KE002', 2, 'X', 4),
(16, 'KE003', 6, 'X', 4),
(18, 'KE004', 1, 'XI', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_mapel`
--

CREATE TABLE `dt_mapel` (
  `id_mapel` int(20) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `guru` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dt_mapel`
--

INSERT INTO `dt_mapel` (`id_mapel`, `kd_mapel`, `nama_mapel`, `kelas`, `guru`) VALUES
(9, 'MA001', 'Informatika', 'X', 'Adji Muhamad Zidan S.Kom'),
(10, 'MA002', 'Dasar Program Keahlian', 'X', 'Adji Muhamad Zidan S.Kom'),
(11, 'MA003', 'Basis Data', 'XI', 'Adji Muhamad Zidan S.Kom');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_nilai_pas`
--

CREATE TABLE `dt_nilai_pas` (
  `id_pas` int(20) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `id_mapel` int(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `nilai_pas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_nilai_pts`
--

CREATE TABLE `dt_nilai_pts` (
  `id_pts` int(20) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `id_mapel` int(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `nilai_pts` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_nilai_tugas`
--

CREATE TABLE `dt_nilai_tugas` (
  `id_tugas` int(20) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `id_mapel` int(20) NOT NULL,
  `id_kelas` int(20) NOT NULL,
  `id_jurusan` int(20) NOT NULL,
  `id_periode` int(20) NOT NULL,
  `semester` varchar(30) NOT NULL,
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
  `na_sumatif` int(30) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dt_nilai_tugas`
--

INSERT INTO `dt_nilai_tugas` (`id_tugas`, `id_siswa`, `id_mapel`, `id_kelas`, `id_jurusan`, `id_periode`, `semester`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `nilai_5`, `nilai_6`, `nilai_7`, `nilai_8`, `nilai_9`, `na_materi`, `LM_1`, `LM_2`, `LM_3`, `na_sumatif`) VALUES
(9, 3, 9, 13, 1, 4, 'Ganjil', 0, 0, 0, 80, 80, 85, 80, 75, 85, 81, 0, 82, 80, 81),
(10, 4, 9, 13, 1, 4, 'Ganjil', 0, 0, 0, 80, 78, 77, 82, 75, 77, 78, 0, 78, 78, 78),
(11, 6, 9, 13, 1, 4, 'Ganjil', 75, 80, 78, 80, 78, 88, 80, 75, 77, 79, 82, 82, 77, 80);

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

--
-- Dumping data untuk tabel `dt_periode_ajaran`
--

INSERT INTO `dt_periode_ajaran` (`id_periode`, `kd_ajaran`, `semester_pertama`, `semester_kedua`, `tahun_ajaran`) VALUES
(4, 'PA001', 'Semester 1 (Ganjil)', 'Semester 2 (Genap)', '2024/2025'),
(12, 'PA002', 'Semester 1 (Ganjil)', 'Semester 2 (Genap)', '2025/2026');

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
-- Dumping data untuk tabel `dt_siswa`
--

INSERT INTO `dt_siswa` (`id_siswa`, `kd_siswa`, `nis`, `nisn`, `nama_siswa`, `id_kelas`, `id_jurusan`, `id_periode`) VALUES
(3, 'PD001', 2019001, 2020001, 'Adji Muhamad Zidan', 13, 1, 4),
(4, 'PD002', 2019002, 2020002, 'Shinta Amelia', 13, 1, 4),
(5, 'PD003', 2019010, 2020010, 'Fulan Deni', 15, 2, 4),
(6, 'PD004', 2019003, 2020003, 'Reyhan Hidayat', 13, 1, 4),
(7, 'PD005', 2019004, 2020004, 'Rohman', 13, 1, 4);

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
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `dt_nilai_pas`
--
ALTER TABLE `dt_nilai_pas`
  ADD PRIMARY KEY (`id_pas`),
  ADD KEY `id_siswa` (`id_siswa`,`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `dt_nilai_pts`
--
ALTER TABLE `dt_nilai_pts`
  ADD PRIMARY KEY (`id_pts`),
  ADD KEY `id_siswa` (`id_siswa`,`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `dt_nilai_tugas`
--
ALTER TABLE `dt_nilai_tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_siswa` (`id_siswa`,`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_kelas` (`id_kelas`,`id_jurusan`),
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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_jurusan`
--
ALTER TABLE `dt_jurusan`
  MODIFY `id_jurusan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `dt_kelas`
--
ALTER TABLE `dt_kelas`
  MODIFY `id_kelas` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `dt_mapel`
--
ALTER TABLE `dt_mapel`
  MODIFY `id_mapel` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `dt_nilai_pas`
--
ALTER TABLE `dt_nilai_pas`
  MODIFY `id_pas` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_nilai_pts`
--
ALTER TABLE `dt_nilai_pts`
  MODIFY `id_pts` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dt_nilai_tugas`
--
ALTER TABLE `dt_nilai_tugas`
  MODIFY `id_tugas` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `dt_periode_ajaran`
--
ALTER TABLE `dt_periode_ajaran`
  MODIFY `id_periode` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `dt_siswa`
--
ALTER TABLE `dt_siswa`
  MODIFY `id_siswa` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Ketidakleluasaan untuk tabel `dt_nilai_pas`
--
ALTER TABLE `dt_nilai_pas`
  ADD CONSTRAINT `dt_nilai_pas_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `dt_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_pas_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `dt_mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dt_nilai_pts`
--
ALTER TABLE `dt_nilai_pts`
  ADD CONSTRAINT `dt_nilai_pts_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `dt_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_pts_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `dt_mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dt_nilai_tugas`
--
ALTER TABLE `dt_nilai_tugas`
  ADD CONSTRAINT `dt_nilai_tugas_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `dt_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_tugas_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `dt_mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_tugas_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `dt_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_tugas_ibfk_4` FOREIGN KEY (`id_jurusan`) REFERENCES `dt_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_nilai_tugas_ibfk_5` FOREIGN KEY (`id_periode`) REFERENCES `dt_periode_ajaran` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

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
