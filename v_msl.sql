-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2022 pada 02.24
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
-- Database: `v_msl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_kelompok`
--

CREATE TABLE `anggota_kelompok` (
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `benar_salah`
--

CREATE TABLE `benar_salah` (
  `id_benar_salah` int(11) NOT NULL,
  `id_tes` int(11) NOT NULL,
  `soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `alasan` text NOT NULL,
  `kode_soal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_mahasiswa`
--

CREATE TABLE `detail_mahasiswa` (
  `id_detail_mahasiswa` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `asal_universitas` enum('UIN Sunan Gunung Djati Bandung','UIN Raden Fatah Palembang','UIN Mataram','IAIN Palangkaraya') NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `tempat_lahir` enum('Kota (Tinggal di pusat pemerintahan)','Desa (Jauh dari pusat pemerintahan)') NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `asal_sekolah_lain` text NOT NULL,
  `status_ekonomi` enum('Kelompok Atas (upper class)','Kelompok menengah (middle class)','Kelompok Bawah (lower class)') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_mahasiswa`
--

INSERT INTO `detail_mahasiswa` (`id_detail_mahasiswa`, `id_mahasiswa`, `asal_universitas`, `nim`, `jurusan`, `tanggal_lahir`, `gender`, `tempat_lahir`, `asal_sekolah`, `asal_sekolah_lain`, `status_ekonomi`) VALUES
(32, 68, 'UIN Sunan Gunung Djati Bandung', '1986249712087', 'Jurusan1', '2022-08-06', 'Perempuan', 'Kota (Tinggal di pusat pemerintahan)', 'Sekolah Menengah Atas (SMA)', '', 'Kelompok Atas (upper class)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskusi`
--

CREATE TABLE `diskusi` (
  `id_pesan` int(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `foto` text NOT NULL,
  `nama_modul` enum('Elastisitas','Rangkaian Listrik') NOT NULL,
  `pesan` text NOT NULL,
  `tgl` datetime NOT NULL,
  `level` enum('0','1','2') NOT NULL,
  `pesan_hapus` enum('','dihapus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskusi_kelompok`
--

CREATE TABLE `diskusi_kelompok` (
  `id_pesan` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `foto` text NOT NULL,
  `pesan` text NOT NULL,
  `tgl` datetime NOT NULL,
  `level` enum('0','1','2') NOT NULL,
  `pesan_hapus` enum('','dihapus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `essay`
--

CREATE TABLE `essay` (
  `id_essay` int(11) NOT NULL,
  `id_tes` int(11) NOT NULL,
  `soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `kode_soal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_benar_salah`
--

CREATE TABLE `jawaban_benar_salah` (
  `id_jawaban_benar_salah` int(11) NOT NULL,
  `id_jawaban_mahasiswa` int(11) NOT NULL,
  `id_benar_salah` int(11) NOT NULL,
  `jawaban_benar_salah` text NOT NULL,
  `alasan_benar_salah` text NOT NULL,
  `kode_soal_benar_salah` varchar(20) NOT NULL,
  `nilai_benar_salah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_essay`
--

CREATE TABLE `jawaban_essay` (
  `id_jawaban_essay` int(11) NOT NULL,
  `id_essay` int(11) NOT NULL,
  `id_jawaban_mahasiswa` int(11) NOT NULL,
  `jawaban_essay` text NOT NULL,
  `nilai_essay` varchar(10) NOT NULL,
  `kode_soal_essay` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_mahasiswa`
--

CREATE TABLE `jawaban_mahasiswa` (
  `id_jawaban_mahasiswa` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `id_tes` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `judul_tes` varchar(100) NOT NULL,
  `tgl_tes` date NOT NULL,
  `total_nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_menjodohkan`
--

CREATE TABLE `jawaban_menjodohkan` (
  `id_jawaban_menjodohkan` int(11) NOT NULL,
  `id_menjodohkan` int(11) NOT NULL,
  `id_jawaban_mahasiswa` int(11) NOT NULL,
  `jawaban_menjodohkan` text NOT NULL,
  `alasan_menjodohkan` text NOT NULL,
  `kode_soal_menjodohkan` varchar(20) NOT NULL,
  `nilai_menjodohkan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_pg`
--

CREATE TABLE `jawaban_pg` (
  `id_jawaban_pg` int(11) NOT NULL,
  `id_pg` int(11) NOT NULL,
  `id_jawaban_mahasiswa` int(11) NOT NULL,
  `jawaban_pg` text NOT NULL,
  `alasan_pg` text NOT NULL,
  `nilai_pg` varchar(10) NOT NULL,
  `kode_soal_pg` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `id_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_sekolah`) VALUES
(19, 'XII-A1', 71),
(20, 'XII-A2', 71),
(35, 'admin', 73),
(56, 'XII-A3', 71);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_user`
--

CREATE TABLE `kelas_user` (
  `id_kelas_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas_user`
--

INSERT INTO `kelas_user` (`id_kelas_user`, `id_user`, `id_kelas`) VALUES
(15, 0, 35),
(62, 67, 20),
(63, 67, 56),
(64, 68, 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE `kelompok` (
  `id_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(200) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`id_kelompok`, `nama_kelompok`, `id_kelas`) VALUES
(1, 'Kelompok 1', 20),
(4, 'Hi Permissionn', 20),
(7, 'qwerty', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menjodohkan`
--

CREATE TABLE `menjodohkan` (
  `id_menjodohkan` int(11) NOT NULL,
  `id_tes` int(11) NOT NULL,
  `soal` text NOT NULL,
  `pilihan` text NOT NULL,
  `jawaban` text NOT NULL,
  `alasan` text NOT NULL,
  `kode_soal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_jawaban` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nama_modul` enum('Elastisitas','Rangkaian Listrik') NOT NULL,
  `tanggal` date NOT NULL,
  `menentukan_ide` text NOT NULL,
  `ide_alternatif` text NOT NULL,
  `mendiskusikan_ide` text NOT NULL,
  `pertanyaan_konseptual1` text NOT NULL,
  `pertanyaan_konseptual2` text NOT NULL,
  `prediksi` text NOT NULL,
  `bahan_dan_peralatan` text NOT NULL,
  `eksplorasi` text NOT NULL,
  `pengukuran` text NOT NULL,
  `pengolahan` text NOT NULL,
  `analisis` text NOT NULL,
  `eksplanasi1` text NOT NULL,
  `eksplanasi2` text NOT NULL,
  `kesimpulan` text NOT NULL,
  `presentasi` text NOT NULL,
  `evaluasi_dan_refleksi` text NOT NULL,
  `total_nilai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_modul`
--

CREATE TABLE `nilai_modul` (
  `id_nilai` int(11) NOT NULL,
  `id_jawaban` int(11) NOT NULL,
  `menentukan_ide` varchar(20) NOT NULL,
  `ide_alternatif` varchar(20) NOT NULL,
  `mendiskusikan_ide` varchar(20) NOT NULL,
  `pertanyaan_konseptual` varchar(20) NOT NULL,
  `prediksi` varchar(20) NOT NULL,
  `bahan_dan_peralatan` varchar(20) NOT NULL,
  `eksplorasi` varchar(20) NOT NULL,
  `pengukuran` varchar(20) NOT NULL,
  `pengolahan` varchar(20) NOT NULL,
  `analisis` varchar(20) NOT NULL,
  `eksplanasi` varchar(20) NOT NULL,
  `kesimpulan` varchar(20) NOT NULL,
  `presentasi` varchar(20) NOT NULL,
  `evaluasi_dan_refleksi` varchar(20) NOT NULL,
  `total_nilai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengantar`
--

CREATE TABLE `pengantar` (
  `id_pengantar` int(11) NOT NULL,
  `isi_pengantar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengantar`
--

INSERT INTO `pengantar` (`id_pengantar`, `isi_pengantar`) VALUES
(2, '<p>&nbsp;&nbsp;</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Aspek Kognitif</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Capaian pembelajaran menurut KKNI dalam aspek pengetahuan meliputi: menguasai konsep dasar kependidikan yang mencakup perkembangan peserta didik, teori-teori belajar, hakikat sains dan pola pikir ilmiah; menguasai metode pembelajaran inovatif yang berorientasi kecakapan personal, sosial dan akademik (<em>life skill</em>) pada pembelajaran fisika; menguasai prinsip-prinsip pengembangan media pembelajaran fisika berbasis ilmu pengetahuan, teknologi yang kontekstual, khususnya Teknologi Informasi dan Komunikasi (TIK), dan lingkungan sekitar; menguasai pengelolaan sumber daya pada penyelenggaraan kelas, laboratorium fisika dan lembaga pendidikan dan menguasai konsep fisika berdasarkan fenomena alam yang mendukung pembelajaran fisika di sekolah.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Aspek Afektif</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Capaian pembelajaran dalam aspek sikap dan tata nilai meliputi: memiliki moral, etika, etos kerja, dan tanggung jawab yang tinggi terhadap tugas serta bangga menjadi calon guru fisika; berpikir terbuka, kritis, inovatif, kreatif dan percaya diri dalam mengemban tugasnya sebagai guru fisika; bekerja sama dan memiliki kepekaan sosial dan kepedulian tinggi terhadap masyarakat dan lingkungannya.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Capaian pembelajaran dalam aspek <strong>keterampilan kerja khusus meliputi: m</strong>erencanakan, melaksanakan, dan mengevaluasi pembelajaran fisika berbasis aktivitas belajar untuk mengembangkan kemampuan berpikir sesuai dengan karakteristik materi fisika, dan sikap ilmiah sesuai dengan karakteristik peserta didik pada pembelajaran kurikuler, kokurikuler dan ekstra kurikuler dengan memanfaatkan berbagai sumber belajar berbasis ilmu pengetahuan, teknologi yang kontekstual dan lingkungan sekitar; mengkaji dan menerapkan berbagai metode pembelajaran inovatif yang telah teruji; mengelola sumberdaya dan aktivitas yang mencakup penyelenggaraan kelas, laboratorium fisika dan lembaga pendidikan secara komprehensif; mengambil keputusan strategis berdasarkan kajian terhadap masalah mutu, relevansi dan akses di bidang pendidikan dalam penyelenggaraan kelas, laboratorium fisika dan lembaga pendidikan yang menjadi tanggung jawabnya.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Aspek Psikomotor</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Capaian pembelajaran dalam aspek <strong>keterampilan kerja khusus meliputi: m</strong>erencanakan, melaksanakan, dan mengevaluasi pembelajaran fisika berbasis aktivitas belajar untuk mengembangkan kemampuan berpikir sesuai dengan karakteristik materi fisika, dan sikap ilmiah sesuai dengan karakteristik peserta didik pada pembelajaran kurikuler, kokurikuler dan ekstra kurikuler dengan memanfaatkan berbagai sumber belajar berbasis ilmu pengetahuan, teknologi yang kontekstual dan lingkungan sekitar; mengkaji dan menerapkan berbagai metode pembelajaran inovatif yang telah teruji; mengelola sumberdaya dan aktivitas yang mencakup penyelenggaraan kelas, laboratorium fisika dan lembaga pendidikan secara komprehensif; mengambil keputusan strategis berdasarkan kajian terhadap masalah mutu, relevansi dan akses di bidang pendidikan dalam penyelenggaraan kelas, laboratorium fisika dan lembaga pendidikan yang menjadi tanggung jawabnya.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pg`
--

CREATE TABLE `pg` (
  `id_pg` int(11) NOT NULL,
  `id_tes` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `alasan` text NOT NULL,
  `kode_soal` varchar(20) NOT NULL,
  `soal` text NOT NULL,
  `jawaban_asli` char(5) NOT NULL,
  `alasan_asli` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `foto_sekolah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `foto_sekolah`) VALUES
(71, 'Sekolah 1', 'sekolah.png'),
(73, 'Admin', 'sekolah.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes`
--

CREATE TABLE `tes` (
  `id_tes` int(11) NOT NULL,
  `judul_tes` varchar(200) NOT NULL,
  `durasi` char(5) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `jumlah_soal` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes_kelas`
--

CREATE TABLE `tes_kelas` (
  `id_tes_kelas` int(11) NOT NULL,
  `id_tes` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `passconf` text NOT NULL,
  `telepon` char(15) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `foto` text NOT NULL,
  `level` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `passconf`, `telepon`, `id_sekolah`, `foto`, `level`) VALUES
(0, 'Admin', 'admin', 'caf1a3dfb505ffed0d024130f58c5cfa', '321', '091823097123', 73, 'user.png', '0'),
(67, 'Guru123', 'guru123', '202cb962ac59075b964b07152d234b70', '123', '123', 71, 'user.png', '1'),
(68, 'Mhs123', '123', '202cb962ac59075b964b07152d234b70', '123', '123', 71, 'user.png', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `benar_salah`
--
ALTER TABLE `benar_salah`
  ADD PRIMARY KEY (`id_benar_salah`),
  ADD KEY `id_tes` (`id_tes`);

--
-- Indeks untuk tabel `detail_mahasiswa`
--
ALTER TABLE `detail_mahasiswa`
  ADD PRIMARY KEY (`id_detail_mahasiswa`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `diskusi_kelompok`
--
ALTER TABLE `diskusi_kelompok`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `essay`
--
ALTER TABLE `essay`
  ADD PRIMARY KEY (`id_essay`),
  ADD KEY `id_tes` (`id_tes`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indeks untuk tabel `jawaban_benar_salah`
--
ALTER TABLE `jawaban_benar_salah`
  ADD PRIMARY KEY (`id_jawaban_benar_salah`),
  ADD KEY `id_jawaban_mahasiswa` (`id_jawaban_mahasiswa`),
  ADD KEY `id_benar_salah` (`id_benar_salah`);

--
-- Indeks untuk tabel `jawaban_essay`
--
ALTER TABLE `jawaban_essay`
  ADD PRIMARY KEY (`id_jawaban_essay`),
  ADD KEY `id_jawaban_mahasiswa` (`id_jawaban_mahasiswa`),
  ADD KEY `jawaban_essay_ibfk_1` (`id_essay`);

--
-- Indeks untuk tabel `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  ADD PRIMARY KEY (`id_jawaban_mahasiswa`),
  ADD KEY `id_mahasiswa` (`nama_mahasiswa`),
  ADD KEY `id_tes` (`id_tes`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `jawaban_mahasiswa_ibfk_5` (`id_mahasiswa`);

--
-- Indeks untuk tabel `jawaban_menjodohkan`
--
ALTER TABLE `jawaban_menjodohkan`
  ADD PRIMARY KEY (`id_jawaban_menjodohkan`),
  ADD KEY `id_jawaban_mahasiswa` (`id_jawaban_mahasiswa`),
  ADD KEY `id_menjodohkan` (`id_menjodohkan`);

--
-- Indeks untuk tabel `jawaban_pg`
--
ALTER TABLE `jawaban_pg`
  ADD PRIMARY KEY (`id_jawaban_pg`),
  ADD KEY `id_pg` (`id_pg`),
  ADD KEY `id_jawaban_mahasiswa` (`id_jawaban_mahasiswa`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indeks untuk tabel `kelas_user`
--
ALTER TABLE `kelas_user`
  ADD PRIMARY KEY (`id_kelas_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kelas_user_ibfk_1` (`id_kelas`);

--
-- Indeks untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `menjodohkan`
--
ALTER TABLE `menjodohkan`
  ADD PRIMARY KEY (`id_menjodohkan`),
  ADD KEY `id_tes` (`id_tes`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `modul_ibfk_1` (`id_mahasiswa`);

--
-- Indeks untuk tabel `nilai_modul`
--
ALTER TABLE `nilai_modul`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_jawaban` (`id_jawaban`);

--
-- Indeks untuk tabel `pengantar`
--
ALTER TABLE `pengantar`
  ADD PRIMARY KEY (`id_pengantar`);

--
-- Indeks untuk tabel `pg`
--
ALTER TABLE `pg`
  ADD PRIMARY KEY (`id_pg`),
  ADD KEY `id_tes` (`id_tes`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`id_tes`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indeks untuk tabel `tes_kelas`
--
ALTER TABLE `tes_kelas`
  ADD PRIMARY KEY (`id_tes_kelas`),
  ADD KEY `id_tes` (`id_tes`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `benar_salah`
--
ALTER TABLE `benar_salah`
  MODIFY `id_benar_salah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `detail_mahasiswa`
--
ALTER TABLE `detail_mahasiswa`
  MODIFY `id_detail_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_pesan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `diskusi_kelompok`
--
ALTER TABLE `diskusi_kelompok`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `essay`
--
ALTER TABLE `essay`
  MODIFY `id_essay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jawaban_benar_salah`
--
ALTER TABLE `jawaban_benar_salah`
  MODIFY `id_jawaban_benar_salah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `jawaban_essay`
--
ALTER TABLE `jawaban_essay`
  MODIFY `id_jawaban_essay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  MODIFY `id_jawaban_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `jawaban_menjodohkan`
--
ALTER TABLE `jawaban_menjodohkan`
  MODIFY `id_jawaban_menjodohkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `jawaban_pg`
--
ALTER TABLE `jawaban_pg`
  MODIFY `id_jawaban_pg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `kelas_user`
--
ALTER TABLE `kelas_user`
  MODIFY `id_kelas_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `menjodohkan`
--
ALTER TABLE `menjodohkan`
  MODIFY `id_menjodohkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `nilai_modul`
--
ALTER TABLE `nilai_modul`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `pengantar`
--
ALTER TABLE `pengantar`
  MODIFY `id_pengantar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pg`
--
ALTER TABLE `pg`
  MODIFY `id_pg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `tes`
--
ALTER TABLE `tes`
  MODIFY `id_tes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tes_kelas`
--
ALTER TABLE `tes_kelas`
  MODIFY `id_tes_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  ADD CONSTRAINT `anggota_kelompok_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_kelompok_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `benar_salah`
--
ALTER TABLE `benar_salah`
  ADD CONSTRAINT `benar_salah_ibfk_1` FOREIGN KEY (`id_tes`) REFERENCES `tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_mahasiswa`
--
ALTER TABLE `detail_mahasiswa`
  ADD CONSTRAINT `detail_mahasiswa_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diskusi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `diskusi_kelompok`
--
ALTER TABLE `diskusi_kelompok`
  ADD CONSTRAINT `diskusi_kelompok_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diskusi_kelompok_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `essay`
--
ALTER TABLE `essay`
  ADD CONSTRAINT `essay_ibfk_1` FOREIGN KEY (`id_tes`) REFERENCES `tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_benar_salah`
--
ALTER TABLE `jawaban_benar_salah`
  ADD CONSTRAINT `jawaban_benar_salah_ibfk_1` FOREIGN KEY (`id_jawaban_mahasiswa`) REFERENCES `jawaban_mahasiswa` (`id_jawaban_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_benar_salah_ibfk_2` FOREIGN KEY (`id_benar_salah`) REFERENCES `benar_salah` (`id_benar_salah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_essay`
--
ALTER TABLE `jawaban_essay`
  ADD CONSTRAINT `jawaban_essay_ibfk_1` FOREIGN KEY (`id_essay`) REFERENCES `essay` (`id_essay`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_essay_ibfk_2` FOREIGN KEY (`id_jawaban_mahasiswa`) REFERENCES `jawaban_mahasiswa` (`id_jawaban_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  ADD CONSTRAINT `jawaban_mahasiswa_ibfk_2` FOREIGN KEY (`id_tes`) REFERENCES `tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_mahasiswa_ibfk_3` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_mahasiswa_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_mahasiswa_ibfk_5` FOREIGN KEY (`id_mahasiswa`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_menjodohkan`
--
ALTER TABLE `jawaban_menjodohkan`
  ADD CONSTRAINT `jawaban_menjodohkan_ibfk_1` FOREIGN KEY (`id_jawaban_mahasiswa`) REFERENCES `jawaban_mahasiswa` (`id_jawaban_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_menjodohkan_ibfk_2` FOREIGN KEY (`id_menjodohkan`) REFERENCES `menjodohkan` (`id_menjodohkan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_pg`
--
ALTER TABLE `jawaban_pg`
  ADD CONSTRAINT `jawaban_pg_ibfk_1` FOREIGN KEY (`id_pg`) REFERENCES `pg` (`id_pg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_pg_ibfk_2` FOREIGN KEY (`id_jawaban_mahasiswa`) REFERENCES `jawaban_mahasiswa` (`id_jawaban_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_user`
--
ALTER TABLE `kelas_user`
  ADD CONSTRAINT `kelas_user_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD CONSTRAINT `kelompok_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menjodohkan`
--
ALTER TABLE `menjodohkan`
  ADD CONSTRAINT `menjodohkan_ibfk_1` FOREIGN KEY (`id_tes`) REFERENCES `tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modul_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modul_ibfk_3` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_modul`
--
ALTER TABLE `nilai_modul`
  ADD CONSTRAINT `nilai_modul_ibfk_1` FOREIGN KEY (`id_jawaban`) REFERENCES `modul` (`id_jawaban`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pg`
--
ALTER TABLE `pg`
  ADD CONSTRAINT `pg_ibfk_1` FOREIGN KEY (`id_tes`) REFERENCES `tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tes`
--
ALTER TABLE `tes`
  ADD CONSTRAINT `tes_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tes_kelas`
--
ALTER TABLE `tes_kelas`
  ADD CONSTRAINT `tes_kelas_ibfk_1` FOREIGN KEY (`id_tes`) REFERENCES `tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tes_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
