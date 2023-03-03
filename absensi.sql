-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2023 pada 05.20
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `inisial` char(5) NOT NULL,
  `kaprog` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`, `inisial`, `kaprog`) VALUES
(1, 'Rekayasa Perangkat Lunak', '', ''),
(2, 'Teknik Bisnis Sepeda Motor', '', ''),
(3, 'Teknik Kendaraan Ringan Otomotif', '', ''),
(4, 'Teknik Audio Video', '', ''),
(5, 'Desain Pemodelan dan Informasi Bangunan', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_kelas` varchar(15) NOT NULL,
  `wali_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `id_jurusan`, `nama_kelas`, `wali_kelas`) VALUES
(1, 1, 'X RPL 1', ''),
(2, 1, 'X RPL 2', ''),
(3, 1, 'X RPL 3', ''),
(4, 1, 'XI RPL 1', ''),
(5, 1, 'XI RPL 2', ''),
(6, 1, 'XI RPL 3', ''),
(7, 1, 'XII RPL 1', ''),
(8, 1, 'XII RPL 2', ''),
(9, 1, 'XII RPL 3', ''),
(10, 2, 'X TBSM 1', ''),
(11, 2, 'X TBSM 2', ''),
(12, 2, 'X TBSM 3', ''),
(13, 2, 'XI TBSM 1', ''),
(14, 2, 'XI TBSM 2', ''),
(15, 2, 'XI TBSM 3', ''),
(16, 2, 'XII TBSM 1', ''),
(17, 2, 'XII TBSM 2', ''),
(18, 2, 'XII TBSM 3', ''),
(19, 3, 'X TKRO 1', ''),
(20, 3, 'X TKRO 2', ''),
(21, 3, 'X TKRO 3', ''),
(22, 3, 'XI TKRO 1', ''),
(23, 3, 'XI TKRO 2', ''),
(24, 3, 'XI TKRO 3', ''),
(25, 3, 'XII TKRO 1', ''),
(26, 3, 'XII TKRO 2', ''),
(27, 3, 'XII TKRO 3', ''),
(30, 4, 'X TAV 1', ''),
(31, 4, 'X TAV 2', ''),
(32, 4, 'X TAV 3', ''),
(33, 4, 'XI TAV 1', ''),
(34, 4, 'XI TAV 2', ''),
(35, 4, 'XI TAV 3', ''),
(36, 4, 'XII TAV 1', ''),
(37, 4, 'XII TAV 2', ''),
(38, 4, 'XII TAV 3', ''),
(39, 5, 'X DPIB 1', ''),
(40, 5, 'X DPIB 2', ''),
(41, 5, 'XI DPIB 1', ''),
(42, 5, 'XI DPIB 2', ''),
(43, 5, 'XII DPIB 1', ''),
(44, 5, 'XII DPIB 2', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `nis` char(15) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `pin`, `nis`, `nama_siswa`, `id_jurusan`, `id_kelas`, `foto`) VALUES
(2, '', '1234567891', 'Jimmy McGill', 1, 9, 'foto.jpg'),
(6, '', '12313', 'asfas', 4, 35, 'user.png'),
(7, '', '569484', 'dfadsf', 4, 34, 'user.png'),
(8, '', '1231212', '3123123', 4, 38, 'user.png'),
(9, '', '3423423', '4wefsdfsdf', 5, 42, '1726503650-4wefsdfsdf.jpg'),
(11, '', '34234234', 'gsdgadgadgdg dfgdfgsgadgadg fhkdjsfgsdgsrg', 5, 42, 'user.png'),
(12, '', '3424', 'sdfsdf', 4, 36, '939385006-sdfsdf.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` char(20) NOT NULL,
  `password` text NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `level` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `email`, `username`, `password`, `nama_user`, `level`) VALUES
(1, '', '12345678910', 'caf1a3dfb505ffed0d024130f58c5cfa', 'Walter H. White', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kelas dengan jurusan` (`id_jurusan`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `siswa dengan jurusan` (`id_jurusan`),
  ADD KEY `siswa dengan kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `kelas dengan jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `siswa dengan jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa dengan kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
