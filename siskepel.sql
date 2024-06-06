-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 03:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siskepel`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_survey_dan_soal`
-- (See below for the actual view)
--
CREATE TABLE `detail_survey_dan_soal` (
`soal_id` int(11)
,`survey_id` int(11)
,`kategori_id` int(11)
,`no_urut` int(11)
,`soal_jenis` enum('skala','isian','y/n')
,`soal_nama` varchar(500)
,`survey_jenis` enum('ortu','mahasiswa','tendik','dosen','alumni','industri')
,`survey_nama` varchar(50)
,`survey_deskripsi` text
,`survey_tanggal` datetime
,`kategori_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_nama`) VALUES
(1, 'Fasilitas'),
(2, 'Akademik'),
(3, 'Pelayanan'),
(4, 'Alumni');

-- --------------------------------------------------------

--
-- Table structure for table `m_survey`
--

CREATE TABLE `m_survey` (
  `survey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_jenis` enum('ortu','mahasiswa','tendik','dosen','alumni','industri') NOT NULL,
  `survey_kode` varchar(20) NOT NULL,
  `survey_nama` varchar(50) NOT NULL,
  `survey_deskripsi` text NOT NULL,
  `survey_tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_survey`
--

INSERT INTO `m_survey` (`survey_id`, `user_id`, `survey_jenis`, `survey_kode`, `survey_nama`, `survey_deskripsi`, `survey_tanggal`) VALUES
(1, 1, 'mahasiswa', 'mhs', 'Survey Fasilitas Mahasiswa 2024', 'Survey Fasilitas Mahasiswa 2024', '2024-06-06 00:00:00'),
(2, 1, 'mahasiswa', 'mhs', 'Survey Akademik Mahasiswa 2024', 'Survey Akademik Mahasiswa 2024', '2024-06-06 00:00:00'),
(3, 1, 'mahasiswa', 'mhs', 'Survey Pelayanan Mahasiswa 2024', 'Survey Pelayanan Mahasiswa 2024', '2024-06-06 00:00:00'),
(4, 1, 'alumni', 'mhs', 'Survey Pelayanan Alumni 2024', 'Survey Pelayanan Alumni 2024', '2024-06-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_survey_soal`
--

CREATE TABLE `m_survey_soal` (
  `soal_id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `soal_jenis` enum('skala','isian','y/n') DEFAULT NULL,
  `soal_nama` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_survey_soal`
--

INSERT INTO `m_survey_soal` (`soal_id`, `survey_id`, `kategori_id`, `no_urut`, `soal_jenis`, `soal_nama`) VALUES
(1, 1, 1, 1, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan tempat parkir di kampus?'),
(2, 1, 1, 2, 'skala', 'Bagaimana penilaian Anda terhadap fasilitas olahraga di kampus?'),
(3, 1, 1, 3, 'skala', 'Bagaimana penilaian Anda terhadap kenyamanan ruang kelas?'),
(4, 1, 1, 4, 'skala', 'Bagaimana penilaian Anda terhadap kenyamanan ruang laboratorium?'),
(5, 1, 1, 5, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(6, 1, 1, 6, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(7, 1, 1, 7, 'skala', 'Bagaimana penilaian Anda terhadap perpustakaan di kampus?'),
(8, 1, 1, 8, 'skala', 'Bagaimana penilaian Anda terhadap kualitas jaringan Wi-Fi di kampus?'),
(9, 1, 1, 9, 'skala', 'Bagaimana penilaian Anda terhadap kantin di kampus?'),
(10, 1, 1, 10, 'skala', 'Bagaimana penilaian Anda terhadap fasilitas poliklinik di kampus?'),
(11, 2, 2, 1, 'skala', 'Bagaimana penilaian Anda terhadap kualitas pengajaran dosen di kampus?'),
(12, 2, 2, 2, 'skala', 'Bagaimana penilaian Anda terhadap kurikulum di program studi Anda?'),
(13, 2, 2, 3, 'skala', 'Bagaimana penilaian Anda terhadap sistem evaluasi dan penilaian di kampus?'),
(14, 2, 2, 4, 'skala', 'Bagaimana penilaian Anda terhadap dukungan akademik yang diberikan oleh kampus?'),
(15, 2, 2, 5, 'skala', 'Bagaimana penilaian Anda terhadap sumber daya penunjang pembelajaran, seperti perpustakaan dan laboratorium?'),
(16, 2, 2, 6, 'skala', 'Bagaimana penilaian Anda terhadap kualitas bimbingan akadmeik yang diberikan oleh dosen di kampus?'),
(17, 2, 2, 7, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan dosen untuk konsultasi?'),
(18, 2, 2, 8, 'skala', 'Bagaimana penilaian Anda terhadap penggunaan teknologi dalam proses pembelajaran?'),
(19, 2, 2, 9, 'skala', 'Bagaimana penilaian Anda terhadap kualitas materi yang diberikan oleh dosen?'),
(20, 2, 2, 10, 'skala', 'Pertanyaan menyusul'),
(21, 3, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(22, 3, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(23, 3, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(24, 3, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(25, 3, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(26, 3, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(27, 3, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(28, 3, 3, 8, 'skala', 'menyusul'),
(29, 3, 3, 9, 'skala', 'menyusul'),
(30, 3, 3, 10, 'skala', 'menyusul'),
(31, 4, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(32, 4, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(33, 4, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(34, 4, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(35, 4, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(36, 4, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(37, 4, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(38, 4, 3, 8, 'skala', 'menyusul'),
(39, 4, 3, 9, 'skala', 'menyusul'),
(40, 4, 3, 10, 'skala', 'menyusul');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `username`, `nama`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(3, 'silmy', 'Silmy Maulia Dewi', '123', 'mahasiswa'),
(4, 'new', 'new', 'new', 'mahasiswa'),
(5, 'mimi', 'mimi', '123', 'mahasiswa'),
(6, 'ingga', 'ingga', '123', 'tendik'),
(7, 'sari', 'sari', '1212', 'tendik');

-- --------------------------------------------------------

--
-- Table structure for table `m_user_data`
--

CREATE TABLE `m_user_data` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `tahun_mengajar` int(4) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tahun_masuk` int(4) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `no_peg` varchar(20) DEFAULT NULL,
  `tahun_lulus` int(4) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `umur` int(3) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `penghasilan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `perusahaan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `nim_mahasiswa` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(30) NOT NULL,
  `nama_prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_user_data`
--

INSERT INTO `m_user_data` (`user_id`, `nama`, `nim`, `jurusan`, `prodi`, `nip`, `tahun_mengajar`, `no_telp`, `email`, `tahun_masuk`, `unit`, `no_peg`, `tahun_lulus`, `jenis_kelamin`, `umur`, `pendidikan`, `pekerjaan`, `penghasilan`, `jabatan`, `perusahaan`, `kota`, `role`, `nim_mahasiswa`, `nama_mahasiswa`, `nama_prodi`) VALUES
(3, 'Silmy Maulia Dewi', '123456', 'Jurusan Teknologi Informasi', NULL, '', NULL, '09087678', '123456@student.polinema.ac.id', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(4, 'new', '2241760090', 'Jurusan Administrasi Niaga', 'D4 Sistem Informasi Bisnis', '', NULL, '089876543210', 'silmy.smd@gmail.com', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(5, 'mimi', '123456', 'Jurusan Teknologi Informasi', 'D4 Sistem Informasi Bisnis', '', NULL, '09087678', '123456@student.polinema.ac.id', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(6, 'ingga', '', '', '', '', NULL, '', '', 0, '5', '12345', 0, '', 0, NULL, '', '', '', '', '', 'tendik', '', '', ''),
(7, 'sari', '', '', '', '', NULL, '', '', 0, '6', '1111', 0, '', 0, NULL, '', '', '', '', '', 'tendik', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_alumni`
--

CREATE TABLE `t_jawaban_alumni` (
  `jawaban_alumni_id` int(11) NOT NULL,
  `responden_alumni_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_dosen`
--

CREATE TABLE `t_jawaban_dosen` (
  `jawaban_dosen_id` int(11) NOT NULL,
  `responden_dosen_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_industri`
--

CREATE TABLE `t_jawaban_industri` (
  `jawaban_industri_id` int(11) NOT NULL,
  `responden_industri_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_mahasiswa`
--

CREATE TABLE `t_jawaban_mahasiswa` (
  `jawaban_mahasiswa_id` int(11) NOT NULL,
  `responden_mahasiswa_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_ortu`
--

CREATE TABLE `t_jawaban_ortu` (
  `jawaban_ortu_id` int(11) NOT NULL,
  `responden_ortu_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_tendik`
--

CREATE TABLE `t_jawaban_tendik` (
  `jawaban_tendik_id` int(11) NOT NULL,
  `responden_tendik_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_alumni`
--

CREATE TABLE `t_responden_alumni` (
  `responden_alumni_id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `responden_tanggal` datetime DEFAULT NULL,
  `responden_nim` varchar(20) DEFAULT NULL,
  `responden_nama` varchar(50) DEFAULT NULL,
  `responden_prodi` varchar(100) DEFAULT NULL,
  `responden_email` varchar(100) DEFAULT NULL,
  `responden_hp` varchar(20) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_dosen`
--

CREATE TABLE `t_responden_dosen` (
  `responden_dosen_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `responden_tanggal` datetime NOT NULL,
  `responded_nip` varchar(20) NOT NULL,
  `responden_nama` varchar(50) NOT NULL,
  `responden_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_industri`
--

CREATE TABLE `t_responden_industri` (
  `responden_industri_id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `responden_tanggal` datetime DEFAULT NULL,
  `responden_nama` varchar(50) DEFAULT NULL,
  `responden_jabatan` varchar(50) DEFAULT NULL,
  `responden_perusahaan` varchar(50) DEFAULT NULL,
  `responden_email` varchar(100) DEFAULT NULL,
  `responden_hp` varchar(20) DEFAULT NULL,
  `responden_kota` varbinary(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_mahasiswa`
--

CREATE TABLE `t_responden_mahasiswa` (
  `responden_mahasiswa_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `responden_tanggal` datetime NOT NULL,
  `responden_nim` varchar(20) NOT NULL,
  `responden_nama` varchar(50) NOT NULL,
  `responden_prodi` varchar(100) NOT NULL,
  `responden_email` varchar(100) NOT NULL,
  `responden_hp` varchar(20) NOT NULL,
  `tahun_masuk` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_ortu`
--

CREATE TABLE `t_responden_ortu` (
  `responden_ortu_id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `responden_tanggal` datetime DEFAULT NULL,
  `responden_jk` enum('L','P') DEFAULT NULL,
  `responden_umur` tinyint(4) DEFAULT NULL,
  `responden_hp` varchar(20) DEFAULT NULL,
  `responden_pendidikan` varchar(30) DEFAULT NULL,
  `responden_pekerjaan` varchar(50) DEFAULT NULL,
  `responden_penghasilan` varchar(20) DEFAULT NULL,
  `mahasiswa_nim` varchar(20) DEFAULT NULL,
  `mahasiswa_nama` varchar(50) DEFAULT NULL,
  `mahasiswa_prodi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_tendik`
--

CREATE TABLE `t_responden_tendik` (
  `responden_tendik_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `responden_tanggal` datetime NOT NULL,
  `responden_nopeg` varchar(20) NOT NULL,
  `responden_nama` varchar(50) NOT NULL,
  `responden_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `detail_survey_dan_soal`
--
DROP TABLE IF EXISTS `detail_survey_dan_soal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_survey_dan_soal`  AS SELECT `m_survey_soal`.`soal_id` AS `soal_id`, `m_survey_soal`.`survey_id` AS `survey_id`, `m_survey_soal`.`kategori_id` AS `kategori_id`, `m_survey_soal`.`no_urut` AS `no_urut`, `m_survey_soal`.`soal_jenis` AS `soal_jenis`, `m_survey_soal`.`soal_nama` AS `soal_nama`, `m_survey`.`survey_jenis` AS `survey_jenis`, `m_survey`.`survey_nama` AS `survey_nama`, `m_survey`.`survey_deskripsi` AS `survey_deskripsi`, `m_survey`.`survey_tanggal` AS `survey_tanggal`, `m_kategori`.`kategori_nama` AS `kategori_nama` FROM ((`m_survey_soal` join `m_survey` on(`m_survey`.`survey_id` = `m_survey_soal`.`survey_id`)) join `m_kategori` on(`m_kategori`.`kategori_id` = `m_survey_soal`.`kategori_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `m_survey`
--
ALTER TABLE `m_survey`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `m_survey_soal`
--
ALTER TABLE `m_survey_soal`
  ADD PRIMARY KEY (`soal_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `m_user_data`
--
ALTER TABLE `m_user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `t_jawaban_alumni`
--
ALTER TABLE `t_jawaban_alumni`
  ADD PRIMARY KEY (`jawaban_alumni_id`),
  ADD KEY `responden_alumni_id` (`responden_alumni_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `t_jawaban_dosen`
--
ALTER TABLE `t_jawaban_dosen`
  ADD PRIMARY KEY (`jawaban_dosen_id`),
  ADD KEY `responden_dosen_id` (`responden_dosen_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `t_jawaban_industri`
--
ALTER TABLE `t_jawaban_industri`
  ADD PRIMARY KEY (`jawaban_industri_id`),
  ADD KEY `responden_industri_id` (`responden_industri_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `t_jawaban_mahasiswa`
--
ALTER TABLE `t_jawaban_mahasiswa`
  ADD PRIMARY KEY (`jawaban_mahasiswa_id`),
  ADD KEY `responden_mahasiswa_id` (`responden_mahasiswa_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `t_jawaban_ortu`
--
ALTER TABLE `t_jawaban_ortu`
  ADD PRIMARY KEY (`jawaban_ortu_id`),
  ADD KEY `responden_ortu_id` (`responden_ortu_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `t_jawaban_tendik`
--
ALTER TABLE `t_jawaban_tendik`
  ADD PRIMARY KEY (`jawaban_tendik_id`),
  ADD KEY `responden_tendik_id` (`responden_tendik_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `t_responden_alumni`
--
ALTER TABLE `t_responden_alumni`
  ADD PRIMARY KEY (`responden_alumni_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `t_responden_dosen`
--
ALTER TABLE `t_responden_dosen`
  ADD PRIMARY KEY (`responden_dosen_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `t_responden_industri`
--
ALTER TABLE `t_responden_industri`
  ADD PRIMARY KEY (`responden_industri_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `t_responden_mahasiswa`
--
ALTER TABLE `t_responden_mahasiswa`
  ADD PRIMARY KEY (`responden_mahasiswa_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `t_responden_ortu`
--
ALTER TABLE `t_responden_ortu`
  ADD PRIMARY KEY (`responden_ortu_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `t_responden_tendik`
--
ALTER TABLE `t_responden_tendik`
  ADD PRIMARY KEY (`responden_tendik_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_survey`
--
ALTER TABLE `m_survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_survey_soal`
--
ALTER TABLE `m_survey_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_jawaban_alumni`
--
ALTER TABLE `t_jawaban_alumni`
  MODIFY `jawaban_alumni_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jawaban_dosen`
--
ALTER TABLE `t_jawaban_dosen`
  MODIFY `jawaban_dosen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jawaban_industri`
--
ALTER TABLE `t_jawaban_industri`
  MODIFY `jawaban_industri_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jawaban_mahasiswa`
--
ALTER TABLE `t_jawaban_mahasiswa`
  MODIFY `jawaban_mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jawaban_ortu`
--
ALTER TABLE `t_jawaban_ortu`
  MODIFY `jawaban_ortu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jawaban_tendik`
--
ALTER TABLE `t_jawaban_tendik`
  MODIFY `jawaban_tendik_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_responden_alumni`
--
ALTER TABLE `t_responden_alumni`
  MODIFY `responden_alumni_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_responden_dosen`
--
ALTER TABLE `t_responden_dosen`
  MODIFY `responden_dosen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_responden_industri`
--
ALTER TABLE `t_responden_industri`
  MODIFY `responden_industri_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_responden_mahasiswa`
--
ALTER TABLE `t_responden_mahasiswa`
  MODIFY `responden_mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_responden_ortu`
--
ALTER TABLE `t_responden_ortu`
  MODIFY `responden_ortu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_responden_tendik`
--
ALTER TABLE `t_responden_tendik`
  MODIFY `responden_tendik_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_survey`
--
ALTER TABLE `m_survey`
  ADD CONSTRAINT `m_survey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `m_survey_soal`
--
ALTER TABLE `m_survey_soal`
  ADD CONSTRAINT `m_survey_soal_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `m_kategori` (`kategori_id`),
  ADD CONSTRAINT `m_survey_soal_ibfk_2` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);

--
-- Constraints for table `t_jawaban_alumni`
--
ALTER TABLE `t_jawaban_alumni`
  ADD CONSTRAINT `t_jawaban_alumni_ibfk_1` FOREIGN KEY (`responden_alumni_id`) REFERENCES `t_responden_alumni` (`responden_alumni_id`),
  ADD CONSTRAINT `t_jawaban_alumni_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `m_survey_soal` (`soal_id`);

--
-- Constraints for table `t_jawaban_dosen`
--
ALTER TABLE `t_jawaban_dosen`
  ADD CONSTRAINT `t_jawaban_dosen_ibfk_1` FOREIGN KEY (`responden_dosen_id`) REFERENCES `t_responden_dosen` (`responden_dosen_id`),
  ADD CONSTRAINT `t_jawaban_dosen_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `m_survey_soal` (`soal_id`);

--
-- Constraints for table `t_jawaban_industri`
--
ALTER TABLE `t_jawaban_industri`
  ADD CONSTRAINT `t_jawaban_industri_ibfk_1` FOREIGN KEY (`responden_industri_id`) REFERENCES `t_responden_industri` (`responden_industri_id`),
  ADD CONSTRAINT `t_jawaban_industri_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `m_survey_soal` (`soal_id`);

--
-- Constraints for table `t_jawaban_mahasiswa`
--
ALTER TABLE `t_jawaban_mahasiswa`
  ADD CONSTRAINT `t_jawaban_mahasiswa_ibfk_1` FOREIGN KEY (`responden_mahasiswa_id`) REFERENCES `t_responden_mahasiswa` (`responden_mahasiswa_id`),
  ADD CONSTRAINT `t_jawaban_mahasiswa_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `m_survey_soal` (`soal_id`);

--
-- Constraints for table `t_jawaban_ortu`
--
ALTER TABLE `t_jawaban_ortu`
  ADD CONSTRAINT `t_jawaban_ortu_ibfk_1` FOREIGN KEY (`responden_ortu_id`) REFERENCES `t_responden_ortu` (`responden_ortu_id`),
  ADD CONSTRAINT `t_jawaban_ortu_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `m_survey_soal` (`soal_id`);

--
-- Constraints for table `t_jawaban_tendik`
--
ALTER TABLE `t_jawaban_tendik`
  ADD CONSTRAINT `t_jawaban_tendik_ibfk_1` FOREIGN KEY (`responden_tendik_id`) REFERENCES `t_responden_tendik` (`responden_tendik_id`),
  ADD CONSTRAINT `t_jawaban_tendik_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `m_survey_soal` (`soal_id`);

--
-- Constraints for table `t_responden_alumni`
--
ALTER TABLE `t_responden_alumni`
  ADD CONSTRAINT `t_responden_alumni_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);

--
-- Constraints for table `t_responden_dosen`
--
ALTER TABLE `t_responden_dosen`
  ADD CONSTRAINT `t_responden_dosen_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);

--
-- Constraints for table `t_responden_industri`
--
ALTER TABLE `t_responden_industri`
  ADD CONSTRAINT `t_responden_industri_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);

--
-- Constraints for table `t_responden_mahasiswa`
--
ALTER TABLE `t_responden_mahasiswa`
  ADD CONSTRAINT `t_responden_mahasiswa_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);

--
-- Constraints for table `t_responden_ortu`
--
ALTER TABLE `t_responden_ortu`
  ADD CONSTRAINT `t_responden_ortu_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);

--
-- Constraints for table `t_responden_tendik`
--
ALTER TABLE `t_responden_tendik`
  ADD CONSTRAINT `t_responden_tendik_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `m_survey` (`survey_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
