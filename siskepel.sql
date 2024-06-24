-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 12:37 PM
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
-- Stand-in structure for view `average_jawaban_per_kategori_4`
-- (See below for the actual view)
--
CREATE TABLE `average_jawaban_per_kategori_4` (
`kategori_id` int(11)
,`no_urut` int(11)
,`average_jawaban` double
);

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
(1, 1, 'mahasiswa', 'AM2024', 'Survei Akademik Mahasiswa 2024', 'Survei Akademik Mahasiswa 2024', '2024-06-20 00:00:00'),
(2, 1, 'mahasiswa', 'FM2024', 'Survei Fasilitas Mahasiswa 2024', 'Survei Fasilitas Mahasiswa 2024', '2024-06-20 00:00:00'),
(3, 1, 'mahasiswa', 'PM2024', 'Survei Pelayanan Mahasiswa 2024', 'Survei Pelayanan Mahasiswa 2024', '2024-06-20 00:00:00'),
(4, 1, 'dosen', 'AD2024', 'Survei Akademik Dosen 2024', 'Survei Akademik Dosen 2024', '2024-06-20 00:00:00'),
(5, 1, 'dosen', 'FD2024', 'Survei Fasilitas Dosen 2024', 'Survei Fasilitas Dosen 2024', '2024-06-20 00:00:00'),
(6, 1, 'dosen', 'PD2024', 'Survei Pelayanan Dosen 2024', 'Survei Pelayanan Dosen 2024', '2024-06-20 00:00:00'),
(7, 1, 'tendik', 'PT2024', 'Survei Pelayanan Tendik 2024', 'Survei Pelayanan Tendik 2024', '2024-06-20 00:00:00'),
(8, 1, 'tendik', 'FT2024', 'Survei Fasilitas Tendik 2024', 'Survei Fasilitas Tendik 2024', '2024-06-21 00:00:00'),
(9, 1, 'alumni', 'PA2024', 'Survei Pelayanan Alumni 2024', 'Survei Pelayanan Alumni 2024', '2024-06-21 00:00:00'),
(10, 1, 'alumni', 'AA2024', 'Survei Alumni Alumni 2024', 'Survei Alumni Alumni 2024', '2024-06-21 00:00:00'),
(11, 1, 'ortu', 'POT2024', 'Survei Pelayanan Orang Tua 2024', 'Survei Pelayanan Orang Tua 2024', '2024-06-21 00:00:00'),
(12, 1, 'industri', 'PI2024', 'Survei Pelayanan Industri 2024', 'Survei Pelayanan Industri 2024', '2024-06-21 00:00:00'),
(13, 1, 'industri', 'AI2024', 'Survei Alumni Industri 2024', 'Survei Alumni Industri 2024', '2024-06-21 00:00:00');

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
(1, 1, 2, 1, 'skala', 'Bagaimana penilaian Anda terhadap kualitas pengajaran dosen di kampus?'),
(2, 1, 2, 2, 'skala', 'Bagaimana penilaian Anda terhadap kurikulum di program studi?'),
(3, 1, 2, 3, 'skala', 'Bagaimana penilaian Anda terhadap sistem evaluasi dan penilaian di kampus?'),
(4, 1, 2, 4, 'skala', 'Bagaimana penilaian Anda terhadap dukungan akademik yang diberikan oleh kampus?'),
(5, 1, 2, 5, 'skala', 'Bagaimana penilaian Anda terhadap sumber daya penunjang pembelajaran, seperti perpustakaan dan laboratorium?'),
(6, 1, 2, 6, 'skala', 'Bagaimana penilaian Anda terhadap kualitas bimbingan akadmeik yang diberikan oleh dosen di kampus?'),
(7, 1, 2, 7, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan dosen untuk konsultasi?'),
(8, 1, 2, 8, 'skala', 'Bagaimana penilaian Anda terhadap penggunaan teknologi dalam proses pembelajaran?'),
(9, 1, 2, 9, 'skala', 'Bagaimana penilaian Anda terhadap kualitas materi kuliah yang disampaikan?'),
(10, 1, 2, 10, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan bahan bacaan dan referensi di perpustakaan untuk mendukung pengajaran dan penelitian?'),
(11, 2, 1, 1, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan tempat parkir di kampus?'),
(12, 2, 1, 2, 'skala', 'Bagaimana penilaian Anda terhadap fasilitas olahraga di kampus? '),
(13, 2, 1, 3, 'skala', 'Bagaimana penilaian Anda terhadap kondisi fasilitas ruang yang disediakan?'),
(14, 2, 1, 4, 'skala', 'Bagaimana penilaian Anda terhadap kenyamanan ruang laboratorium?'),
(15, 2, 1, 5, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(16, 2, 1, 6, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(17, 2, 1, 7, 'skala', 'Bagaimana penilaian Anda terhadap perpustakaan di kampus?'),
(18, 2, 1, 8, 'skala', 'Bagaimana penilaian Anda terhadap kualitas jaringan Wi-Fi di kampus?'),
(19, 2, 1, 9, 'skala', 'Bagaimana penilaian Anda terhadap kantin di kampus?'),
(20, 2, 1, 10, 'skala', 'Bagaimana penilaian Anda terhadap kualitas peralatan teknologi (komputer, proyektor, dll.) yang tersedia?'),
(21, 3, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(22, 3, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(23, 3, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(24, 3, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(25, 3, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(26, 3, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(27, 3, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(28, 3, 3, 8, 'skala', 'Bagaimana penilaian Anda terhadap layanan informasi online kampus (situs web, portal)?'),
(29, 3, 3, 9, 'skala', 'Bagaimana penilaian Anda terhadap akses informasi akademik di kampus?'),
(30, 3, 3, 10, 'skala', 'Bagaimana penilaian Anda terhadap kecepatan respon dari staf administrasi dalam memberikan informasi yang dibutuhkan?'),
(31, 4, 2, 1, 'skala', 'Bagaimana penilaian Anda terhadap kualitas pengajaran dosen di kampus?'),
(32, 4, 2, 2, 'skala', 'Bagaimana penilaian Anda terhadap kurikulum di program studi?'),
(33, 4, 2, 3, 'skala', 'Bagaimana penilaian Anda terhadap sistem evaluasi dan penilaian di kampus?'),
(34, 4, 2, 4, 'skala', 'Bagaimana penilaian Anda terhadap dukungan akademik yang diberikan oleh kampus?'),
(35, 4, 2, 5, 'skala', 'Bagaimana penilaian Anda terhadap sumber daya penunjang pembelajaran, seperti perpustakaan dan laboratorium?'),
(36, 4, 2, 6, 'skala', 'Bagaimana penilaian Anda terhadap kualitas bimbingan akadmeik yang diberikan oleh dosen di kampus?'),
(37, 4, 2, 7, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan dosen untuk konsultasi?'),
(38, 4, 2, 8, 'skala', 'Bagaimana penilaian Anda terhadap penggunaan teknologi dalam proses pembelajaran?'),
(39, 4, 2, 9, 'skala', 'Bagaimana penilaian Anda terhadap kualitas materi kuliah yang disampaikan?'),
(40, 4, 2, 10, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan bahan bacaan dan referensi di perpustakaan untuk mendukung pengajaran dan penelitian?'),
(41, 5, 1, 1, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan tempat parkir di kampus?'),
(42, 5, 1, 2, 'skala', 'Bagaimana penilaian Anda terhadap fasilitas olahraga di kampus? '),
(43, 5, 1, 3, 'skala', 'Bagaimana penilaian Anda terhadap kondisi fasilitas ruang yang disediakan?'),
(44, 5, 1, 4, 'skala', 'Bagaimana penilaian Anda terhadap kenyamanan ruang laboratorium?'),
(45, 5, 1, 5, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(46, 5, 1, 6, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(47, 5, 1, 7, 'skala', 'Bagaimana penilaian Anda terhadap perpustakaan di kampus?'),
(48, 5, 1, 8, 'skala', 'Bagaimana penilaian Anda terhadap kualitas jaringan Wi-Fi di kampus?'),
(49, 5, 1, 9, 'skala', 'Bagaimana penilaian Anda terhadap kantin di kampus?'),
(50, 5, 1, 10, 'skala', 'Bagaimana penilaian Anda terhadap kualitas peralatan teknologi (komputer, proyektor, dll.) yang tersedia?'),
(51, 6, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(52, 6, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(53, 6, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(54, 6, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(55, 6, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(56, 6, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(57, 6, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(58, 6, 3, 8, 'skala', 'Bagaimana penilaian Anda terhadap layanan informasi online kampus (situs web, portal)?'),
(59, 6, 3, 9, 'skala', 'Bagaimana penilaian Anda terhadap akses informasi akademik di kampus?'),
(60, 6, 3, 10, 'skala', 'Bagaimana penilaian Anda terhadap kecepatan respon dari staf administrasi dalam memberikan informasi yang dibutuhkan?'),
(61, 7, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(62, 7, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(63, 7, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(64, 7, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(65, 7, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(66, 7, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(67, 7, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(68, 7, 3, 8, 'skala', 'Bagaimana penilaian Anda terhadap layanan informasi online kampus (situs web, portal)?'),
(69, 7, 3, 9, 'skala', 'Bagaimana penilaian Anda terhadap akses informasi akademik di kampus?'),
(70, 7, 3, 10, 'skala', 'Bagaimana penilaian Anda terhadap kecepatan respon dari staf administrasi dalam memberikan informasi yang dibutuhkan?'),
(71, 8, 1, 1, 'skala', 'Bagaimana penilaian Anda terhadap ketersediaan tempat parkir di kampus?'),
(72, 8, 1, 2, 'skala', 'Bagaimana penilaian Anda terhadap fasilitas olahraga di kampus? '),
(73, 8, 1, 3, 'skala', 'Bagaimana penilaian Anda terhadap kondisi fasilitas ruang yang disediakan?'),
(74, 8, 1, 4, 'skala', 'Bagaimana penilaian Anda terhadap kenyamanan ruang laboratorium?'),
(75, 8, 1, 5, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(76, 8, 1, 6, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(77, 8, 1, 7, 'skala', 'Bagaimana penilaian Anda terhadap perpustakaan di kampus?'),
(78, 8, 1, 8, 'skala', 'Bagaimana penilaian Anda terhadap kualitas jaringan Wi-Fi di kampus?'),
(79, 8, 1, 9, 'skala', 'Bagaimana penilaian Anda terhadap kantin di kampus?'),
(80, 8, 1, 10, 'skala', 'Bagaimana penilaian Anda terhadap kualitas peralatan teknologi (komputer, proyektor, dll.) yang tersedia?'),
(81, 9, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(82, 9, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(83, 9, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(84, 9, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(85, 9, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(86, 9, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(87, 9, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(88, 9, 3, 8, 'skala', 'Bagaimana penilaian Anda terhadap layanan informasi online kampus (situs web, portal)?'),
(89, 9, 3, 9, 'skala', 'Bagaimana penilaian Anda terhadap akses informasi akademik di kampus?'),
(90, 9, 3, 10, 'skala', 'Bagaimana penilaian Anda terhadap kecepatan respon dari staf administrasi dalam memberikan informasi yang dibutuhkan?'),
(91, 10, 4, 1, 'skala', 'Bagaimana penilaian Anda terhadap kualitas pendidikan yang Anda terima selama berkuliah di kampus?'),
(92, 10, 4, 2, 'skala', 'Bagaimana penilaian Anda terhadap persiapan kampus dalam mempersiapkan Anda untuk karier setelah lulus?'),
(93, 10, 4, 3, 'skala', 'Bagaimana penilaian Anda terhadap hubungan dengan sesama alumni dan jaringan alumni di kampus?'),
(94, 10, 4, 4, 'skala', 'Bagaimana penilaian Anda terhadap dukungan yang diberikan oleh kampus kepada para-alumni?'),
(95, 10, 4, 5, 'skala', 'Bagaimana penilaian Anda terhadap kampus yang memfasilitasi kegiatan dan acara yang melibatkan para-alumni?'),
(96, 10, 4, 6, 'skala', 'Bagaimana Anda menilai kualitas pendidikan yang diterima oleh alumni dari kampus kami?'),
(97, 10, 4, 7, 'skala', 'Seberapa baik keterampilan teknis yang dimiliki oleh alumni dari kampus kami?'),
(98, 10, 4, 8, 'skala', 'Bagaimana kemampuan alumni dari kampus kami dalam beradaptasi dengan lingkungan kerja di perusahaan Anda?'),
(99, 10, 4, 9, 'skala', 'Seberapa baik kemampuan komunikasi alumni dari kampus kami?'),
(100, 10, 4, 10, 'skala', 'Bagaimana Anda menilai keterampilan kerja tim alumni dari kampus kami?'),
(101, 11, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(102, 11, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(103, 11, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(104, 11, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(105, 11, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(106, 11, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(107, 11, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(108, 11, 3, 8, 'skala', 'Bagaimana penilaian Anda terhadap layanan informasi online kampus (situs web, portal)?'),
(109, 11, 3, 9, 'skala', 'Bagaimana penilaian Anda terhadap akses informasi akademik di kampus?'),
(110, 11, 3, 10, 'skala', 'Bagaimana penilaian Anda terhadap kecepatan respon dari staf administrasi dalam memberikan informasi yang dibutuhkan?'),
(111, 12, 3, 1, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan administrasi di kampus?'),
(112, 12, 3, 2, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan di perpustakaan?'),
(113, 12, 3, 3, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan keuangan dan pembayaran di kampus?'),
(114, 12, 3, 4, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan informasi dan bantuan di kampus?'),
(115, 12, 3, 5, 'skala', 'Bagaimana penilaian Anda terhadap pelayanan kesehatan di kampus?'),
(116, 12, 3, 6, 'skala', 'Bagaimana penilaian Anda terhadap keamanan di area kampus?'),
(117, 12, 3, 7, 'skala', 'Bagaimana penilaian Anda terhadap kebersihan di area kampus?'),
(118, 12, 3, 8, 'skala', 'Bagaimana penilaian Anda terhadap layanan informasi online kampus (situs web, portal)?'),
(119, 12, 3, 9, 'skala', 'Bagaimana penilaian Anda terhadap akses informasi akademik di kampus?'),
(120, 12, 3, 10, 'skala', 'Bagaimana penilaian Anda terhadap kecepatan respon dari staf administrasi dalam memberikan informasi yang dibutuhkan?'),
(121, 13, 4, 1, 'skala', 'Bagaimana penilaian Anda terhadap kualitas pendidikan yang Anda terima selama berkuliah di kampus?'),
(122, 13, 4, 2, 'skala', 'Bagaimana penilaian Anda terhadap persiapan kampus dalam mempersiapkan Anda untuk karier setelah lulus?'),
(123, 13, 4, 3, 'skala', 'Bagaimana penilaian Anda terhadap hubungan dengan sesama alumni dan jaringan alumni di kampus?'),
(124, 13, 4, 4, 'skala', 'Bagaimana penilaian Anda terhadap dukungan yang diberikan oleh kampus kepada para-alumni?'),
(125, 13, 4, 5, 'skala', 'Bagaimana penilaian Anda terhadap kampus yang memfasilitasi kegiatan dan acara yang melibatkan para-alumni?'),
(126, 13, 4, 6, 'skala', 'Bagaimana Anda menilai kualitas pendidikan yang diterima oleh alumni dari kampus kami?'),
(127, 13, 4, 7, 'skala', 'Seberapa baik keterampilan teknis yang dimiliki oleh alumni dari kampus kami?'),
(128, 13, 4, 8, 'skala', 'Bagaimana kemampuan alumni dari kampus kami dalam beradaptasi dengan lingkungan kerja di perusahaan Anda?'),
(129, 13, 4, 9, 'skala', 'Seberapa baik kemampuan komunikasi alumni dari kampus kami?'),
(130, 13, 4, 10, 'skala', 'Bagaimana Anda menilai keterampilan kerja tim alumni dari kampus kami?');

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
(15, 'dosenn', 'dosen', 'dosen', 'dosen'),
(16, 'mhs', 'mhs', 'mhs', 'mahasiswa'),
(17, 'ingga', 'Ingga chintia sari', 'ingga', 'mahasiswa'),
(18, 'dini', 'dini', 'dini', 'dosen'),
(19, 'doni', 'Doni', 'doni', 'alumni'),
(20, 'ahmad', 'Ahmad', 'ahmad', 'tendik'),
(22, 'budi', 'Budi', 'budi', 'industri'),
(23, 'industri', 'industri', 'industri', 'industri'),
(25, 'silmy', 'Silmy Maulia Dewi', 'silmy', 'mahasiswa'),
(26, 'ortu', 'ortu', 'ortu', 'ortu'),
(27, 'tendik', 'tendik', 'tendik', 'tendik'),
(28, 'syahrul', 'Syahrul', 'syahrul', 'alumni'),
(30, 'dodo', 'Dodo', 'dodo', 'dosen'),
(32, 'ana', 'ana', 'ana', 'alumni'),
(33, 'fifa', 'fifa', 'fifa', 'industri'),
(34, 'nana', 'Nana', 'nana', 'mahasiswa'),
(35, 'gogo', 'gogo', 'gogo', 'tendik'),
(36, 'lidya', 'Lidya', 'lidya', 'alumni'),
(37, 'luna', 'Luna', 'luna', 'dosen'),
(39, 'new', 'asd', 'sa', 'mahasiswa'),
(40, 'fatma', 'Fatma', 'fatma', 'ortu'),
(41, 'tata', 'tata', 'tata', 'ortu'),
(42, 'ot', 'ot', 'ot', 'ortu'),
(43, 'indus ', 'indus', 'indus', 'industri'),
(44, 'test', 'test', 'ppp', 'mahasiswa'),
(45, 'jojon', 'jojon', 'jojon', 'ortu'),
(46, 'otr', 'otr', 'otr', 'ortu'),
(47, 'jamil', 'jamil', 'jamil', 'ortu'),
(48, 'nm', 'nm', 'nm', 'ortu'),
(50, 'jamul', 'jamul', 'jamul', 'ortu'),
(51, 'hana', 'Hana', 'hana', 'ortu'),
(52, 'fatoni', 'Fatoni', 'fatoni', 'ortu'),
(53, 'kaka', 'kaka', 'kaka', 'ortu'),
(54, 'papi', 'papi', 'papi', 'ortu'),
(55, 'maulana', 'Maulana', 'maulana', 'ortu'),
(56, 'ana', 'ana', 'ana', 'ortu'),
(57, 'yuliana', 'yuliana', 'yuliana', 'ortu'),
(58, 'tahu', 'tahu', 'tahu', 'ortu'),
(59, 'tika', 'Tika', 'tika', 'ortu'),
(60, 'qqq', 'qqq', 'qqq', 'mahasiswa'),
(61, 'www', 'www', 'www', 'dosen'),
(62, 'rrr', 'rrr', 'rrr', 'tendik'),
(63, 'ttt', 'ttt', 'ttt', 'alumni'),
(64, 'yyy', 'yyy', 'yyy', 'ortu');

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

INSERT INTO `m_user_data` (`user_id`, `nama`, `nim`, `jurusan`, `prodi`, `nip`, `no_telp`, `email`, `tahun_masuk`, `unit`, `no_peg`, `tahun_lulus`, `jenis_kelamin`, `umur`, `pendidikan`, `pekerjaan`, `penghasilan`, `jabatan`, `perusahaan`, `kota`, `role`, `nim_mahasiswa`, `nama_mahasiswa`, `nama_prodi`) VALUES
(15, 'dosen', '', '', '', '1234567', '', '', 0, '5', '', 0, '', 0, NULL, '', '', '', '', '', 'dosen', '', '', ''),
(16, 'mhs', '2241760104', 'Jurusan Teknologi Informasi', 'Sistem Informasi Bisniss', '', '01231231232', 'kagendra147@gmail.com', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(17, 'Ingga chintia sari', '2241760018', 'Jurusan Teknologi Informasi', 'SIB', '', '085604472988', 'ingga@gmail.com', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(19, 'Doni', '2041760019', '', 'SIB', '', '088235725787', 'doni@gmail.com', 0, '', '', 2021, '', 0, NULL, '', '', '', '', '', 'alumni', '', '', ''),
(20, 'Ahmad', '', '', '', '', '', '', 0, '2', '116734', 0, '', 0, NULL, '', '', '', '', '', 'tendik', '', '', ''),
(22, 'Budi', '', '', '', '', '0889327648', 'berkah@gmail.com', 0, '', '', 0, '', 0, NULL, '', '', 'HRD', 'PT.Berkah', 'Malang', 'industri', '', '', ''),
(23, 'industri', '', '', '', '', '087667289223', '123456@student.polinema.ac.id', 0, '', '', 0, '', 0, NULL, '', '', 'kepala staf', 'Ez parky', 'Malang', 'industri', '', '', ''),
(25, 'Silmy Maulia Dewi', '2241760090', 'Jurusan Teknologi Informasi', 'SIB', '', '085604472988', 'silmy@gmail.com', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(26, 'ortu', '', '', '', '', '089876543210', '', 0, '', '', 0, 'Laki-laki', 35, NULL, '', '2.000.000', '', '', '', '', '2232457755', 'SIB', ''),
(27, 'tendik', '', '', '', '', '', '', 0, '2', '12345', 0, '', 0, NULL, '', '', '', '', '', 'tendik', '', '', ''),
(28, 'Syahrul', '2241760100', '', 'SIB', '', '085604472989', 'syahrul@gmail.com', 0, '', '', 2022, '', 0, NULL, '', '', '', '', '', 'alumni', '', '', ''),
(30, 'Dodo', '', '', '', '009456', '', '', 0, '3', '', 0, '', 0, NULL, '', '', '', '', '', 'dosen', '', '', ''),
(32, 'ana', '123456', '', 'D4 Akuntansi', '', '1234567890', '123456@student.polinema.ac.id', 0, '', '', 2022, '', 0, NULL, '', '', '', '', '', 'alumni', '', '', ''),
(33, 'fifa', '', '', '', '', '45235434', '123456@student.polinema.ac.id', 0, '', '', 0, '', 0, NULL, '', '', 'kepala staf', 'lalala', 'Malang', 'industri', '', '', ''),
(34, 'Nana', '2041760019', 'Jurusan Teknologi Informasi', 'SIB', '', '085604472989', 'nana@gmail.com', 2023, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(35, 'gogo', '', '', '', '', '', '', 0, '8', '12345', 0, '', 0, NULL, '', '', '', '', '', 'tendik', '', '', ''),
(36, 'Lidya', '2241760100', '', 'SIB', '', '085604472989', 'lidya@gmail,com', 0, '', '', 2021, '', 0, NULL, '', '', '', '', '', 'alumni', '', '', ''),
(37, 'Luna', '', '', '', '009567', '', '', 0, '2', '', 0, '', 0, NULL, '', '', '', '', '', 'dosen', '', '', ''),
(38, 'Yoga', '2241760045', '', 'SIB', '', '085604472989', 'yoga@gmail.com', 0, '', '', 2022, '', 0, NULL, '', '', '', '', '', 'alumni', '', '', ''),
(40, 'Fatma', '', '', '', '', '085604472989', '', 0, '', '', 0, 'Perempuan', 45, NULL, '', '3.000.000', '', '', '', '', '2241760055', 'SIB', ''),
(41, 'tata', '', '', '', '', '09087678', '', 0, '', '', 0, 'Perempuan', 21, NULL, '', '500', '', '', '', '', '2241760069', 'sib', ''),
(43, 'indus', '', '', '', '', '081111111111', 'phd@gmail.com', 0, '', '', 0, '', 0, NULL, '', '', 'ketua', 'Pizza Hut ', 'Malang Raya', 'industri', '', '', ''),
(44, 'test', '2241760122', 'Jurusan Administrasi Niaga', 'Sistem Informasi Bisniss', '', '01231231222', 'kage@gmail.com', 2022, '', '', 0, '', 0, NULL, '', '', '', '', '', 'Mahasiswa', '', '', ''),
(45, 'jojon', '', '', '', '', '087667289223', '', 0, '', '', 0, 'Laki-laki', 50, NULL, '', '2.000.000', '', '', '', '', '2232457755', 'sib', ''),
(46, 'otr', '', '', '', '', '0123123123', '', 0, '', '', 0, 'Laki-laki', 32, NULL, '', '1000', '', '', '', 'dosen', '123123', 'asdasdasd', ''),
(47, 'jamil', '', '', '', '', '0912309000', '', 0, '', '', 0, 'Laki-laki', 37, NULL, '', '10000000', '', '', '', 'ortu', '1233332', 'SIB', ''),
(48, 'nm', '', '', '', '', '0912309000', '', 0, '', '', 0, 'Laki-laki', 37, NULL, '', '10000000', '', '', '', 'ortu', '1233332', 'SIB', ''),
(50, 'jamul', '', '', '', '', '08812345', '', 0, '', '', 0, 'Laki-laki', 35, 'S1', '', '1000000', '', '', '', 'ortu', '1233322', 'SIB', ''),
(51, 'Hana', '', '', '', '', '085604472989', '', 0, '', '', 0, 'Perempuan', 45, 'SMA', '', '3.000.000', '', '', '', 'ortu', '2241760055', 'Siska', 'SIB'),
(52, 'Fatoni', '', '', '', '', '085604472989', '', 0, '', '', 0, 'Laki-laki', 45, 'SMA', '', '3.000.000', '', '', '', 'ortu', '2241760055', 'Andi', 'SIB'),
(53, 'kaka', '', '', '', '', '087667289223', '', 0, '', '', 0, 'Laki-laki', 55, 's1 manajemen', '', '2.000.000', '', '', '', 'ortu', '2232457755', 'putra', 'ti'),
(54, 'papi', '', '', '', '', '087667289223', '', 0, '', '', 0, 'Laki-laki', 35, 'sd', '', '2.000.000', '', '', '', 'ortu', '2232457755', 'putra', 'ti'),
(55, 'Maulana', '', '', '', '', '085604472989', '', 0, '', '', 0, 'Laki-laki', 45, 'SMA', 'Wiraswasta', '3.000.000', '', '', '', 'ortu', '2241760055', 'Andi', 'SIB'),
(57, 'yuliana', '', '', '', '', '12134', '', 0, '', '', 0, 'Perempuan', 45, 'SMA', 'Wiraswasta', '3.000.000', '', '', '', 'ortu', '2241760055', 'Andi', 'SIB'),
(58, 'tahu', '', '', '', '', '1234567890', '', 0, '', '', 0, 'Laki-laki', 35, 'sd', 'hahhaaha', '2.000.000', '', '', '', 'ortu', '2232457755', 'putra', 'd4 teknik industri'),
(59, 'Tika', '', '', '', '', '12134', '', 0, '', '', 0, 'Perempuan', 45, 'SMA', 'Wiraswasta', '3.000.000', '', '', '', 'ortu', '2241760055', 'Andi', 'SIB'),
(60, 'qqq', '123456', 'Jurusan Akuntansi', 'D4 Akuntansi', '', '0856782334621', '123456@student.polinema.ac.id', 2023, '', '', 0, '', 0, '', '', '', '', '', '', 'Mahasiswa', '', '', ''),
(61, 'www', '', '', '', '1234567', '', '', 0, '5', '', 0, '', 0, '', '', '', '', '', '', 'dosen', '', '', ''),
(62, 'rrr', '', '', '', '', '', '', 0, '8', '12345', 0, '', 0, '', '', '', '', '', '', 'tendik', '', '', ''),
(63, 'ttt', '123456', '', 'D4 Akuntansi', '', '45235434', '123456@student.polinema.ac.id', 0, '', '', 2022, '', 0, '', '', '', '', '', '', 'alumni', '', '', ''),
(64, 'yyy', '', '', '', '', '09087678', '', 0, '', '', 0, 'Laki-laki', 21, 's1 manajemen', 'hahhaaha', '2.000.000', '', '', '', 'ortu', '2232457755', 'putra', 'd4 teknik industri');

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

--
-- Dumping data for table `t_jawaban_alumni`
--

INSERT INTO `t_jawaban_alumni` (`jawaban_alumni_id`, `responden_alumni_id`, `soal_id`, `jawaban`) VALUES
(1, 28, 91, '4'),
(2, 28, 92, '4'),
(3, 28, 93, '4'),
(4, 28, 94, '4'),
(5, 28, 95, '4'),
(6, 28, 96, '4'),
(7, 28, 97, '4'),
(8, 28, 98, '4'),
(9, 28, 99, '4'),
(10, 28, 100, '4'),
(11, 32, 91, '1'),
(12, 32, 92, '2'),
(13, 32, 93, '1'),
(14, 32, 94, '1'),
(15, 32, 95, '2'),
(16, 32, 96, '1'),
(17, 32, 97, '2'),
(18, 32, 98, '3'),
(19, 32, 99, '3'),
(20, 32, 100, '3'),
(21, 32, 91, '1'),
(22, 32, 92, '2'),
(23, 32, 93, '2'),
(24, 32, 94, '2'),
(25, 32, 95, '1'),
(26, 32, 96, '2'),
(27, 32, 97, '2'),
(28, 32, 98, '1'),
(29, 32, 99, '1'),
(30, 32, 100, '2'),
(31, 32, 91, '4'),
(32, 32, 92, '4'),
(33, 32, 93, '4'),
(34, 32, 94, '4'),
(35, 32, 95, '4'),
(36, 32, 96, '4'),
(37, 32, 97, '4'),
(38, 32, 98, '4'),
(39, 32, 99, '4'),
(40, 32, 100, '4'),
(41, 32, 81, '1'),
(42, 32, 82, '2'),
(43, 32, 83, '2'),
(44, 32, 84, '1'),
(45, 32, 85, '3'),
(46, 32, 86, '3'),
(47, 32, 87, '4'),
(48, 32, 88, '3'),
(49, 32, 89, '4'),
(50, 32, 90, '3'),
(51, 32, 91, '1'),
(52, 32, 92, '1'),
(53, 32, 93, '2'),
(54, 32, 94, '1'),
(55, 32, 95, '2'),
(56, 32, 96, '2'),
(57, 32, 97, '1'),
(58, 32, 98, '1'),
(59, 32, 99, '4'),
(60, 32, 100, '4'),
(61, 36, 81, '4'),
(62, 36, 82, '4'),
(63, 36, 83, '4'),
(64, 36, 84, '4'),
(65, 36, 85, '4'),
(66, 36, 86, '4'),
(67, 36, 87, '4'),
(68, 36, 88, '4'),
(69, 36, 89, '4'),
(70, 36, 90, '4'),
(71, 36, 91, '4'),
(72, 36, 92, '4'),
(73, 36, 93, '4'),
(74, 36, 94, '4'),
(75, 36, 95, '4'),
(76, 36, 96, '4'),
(77, 36, 97, '4'),
(78, 36, 98, '4'),
(79, 36, 99, '4'),
(80, 36, 100, '4'),
(81, 32, 81, '4'),
(82, 32, 82, '4'),
(83, 32, 83, '4'),
(84, 32, 84, '4'),
(85, 32, 85, '4'),
(86, 32, 86, '4'),
(87, 32, 87, '4'),
(88, 32, 88, '4'),
(89, 32, 89, '4'),
(90, 32, 90, '4'),
(91, 38, 81, '4'),
(92, 38, 82, '5'),
(93, 38, 83, '4'),
(94, 38, 84, '4'),
(95, 38, 85, '4'),
(96, 38, 86, '5'),
(97, 38, 87, '4'),
(98, 38, 88, '4'),
(99, 38, 89, '4'),
(100, 38, 90, '4'),
(101, 38, 91, '4'),
(102, 38, 92, '4'),
(103, 38, 93, '4'),
(104, 38, 94, '4'),
(105, 38, 95, '4'),
(106, 38, 96, '4'),
(107, 38, 97, '4'),
(108, 38, 98, '4'),
(109, 38, 99, '4'),
(110, 38, 100, '4'),
(111, 32, 81, '1'),
(112, 32, 82, '2'),
(113, 32, 83, '1'),
(114, 32, 84, '1'),
(115, 32, 85, '2'),
(116, 32, 86, '3'),
(117, 32, 87, '2'),
(118, 32, 88, '2'),
(119, 32, 89, '1'),
(120, 32, 90, '3'),
(121, 32, 81, '1'),
(122, 32, 82, '2'),
(123, 32, 83, '1'),
(124, 32, 84, '1'),
(125, 32, 85, '2'),
(126, 32, 86, '2'),
(127, 32, 87, '2'),
(128, 32, 88, '1'),
(129, 32, 89, '1'),
(130, 32, 90, '2'),
(131, 63, 91, '1'),
(132, 63, 92, '3'),
(133, 63, 93, '4'),
(134, 63, 94, '2'),
(135, 63, 95, '2'),
(136, 63, 96, '1'),
(137, 63, 97, '4'),
(138, 63, 98, '3'),
(139, 63, 99, '3'),
(140, 63, 100, '3');

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

--
-- Dumping data for table `t_jawaban_dosen`
--

INSERT INTO `t_jawaban_dosen` (`jawaban_dosen_id`, `responden_dosen_id`, `soal_id`, `jawaban`) VALUES
(1, 15, 51, '4'),
(2, 15, 52, '4'),
(3, 15, 53, '4'),
(4, 15, 54, '4'),
(5, 15, 55, '4'),
(6, 15, 56, '4'),
(7, 15, 57, '4'),
(8, 15, 58, '4'),
(9, 15, 59, '4'),
(10, 15, 60, '4'),
(11, 30, 31, '4'),
(12, 30, 32, '4'),
(13, 30, 33, '4'),
(14, 30, 34, '4'),
(15, 30, 35, '4'),
(16, 30, 36, '4'),
(17, 30, 37, '4'),
(18, 30, 38, '4'),
(19, 30, 39, '4'),
(20, 30, 40, '4'),
(21, 18, 31, '5'),
(22, 18, 32, '4'),
(23, 18, 33, '5'),
(24, 18, 34, '5'),
(25, 18, 35, '4'),
(26, 18, 36, '4'),
(27, 18, 37, '4'),
(28, 18, 38, '4'),
(29, 18, 39, '4'),
(30, 18, 40, '4'),
(31, 37, 51, '4'),
(32, 37, 52, '4'),
(33, 37, 53, '5'),
(34, 37, 54, '4'),
(35, 37, 55, '5'),
(36, 37, 56, '4'),
(37, 37, 57, '4'),
(38, 37, 58, '4'),
(39, 37, 59, '5'),
(40, 37, 60, '4'),
(41, 37, 41, '4'),
(42, 37, 42, '4'),
(43, 37, 43, '4'),
(44, 37, 44, '4'),
(45, 37, 45, '4'),
(46, 37, 46, '4'),
(47, 37, 47, '4'),
(48, 37, 48, '4'),
(49, 37, 49, '4'),
(50, 37, 50, '4'),
(51, 61, 41, '2'),
(52, 61, 42, '4'),
(53, 61, 43, '2'),
(54, 61, 44, '4'),
(55, 61, 45, '4'),
(56, 61, 46, '4'),
(57, 61, 47, '4'),
(58, 61, 48, '5'),
(59, 61, 49, '3'),
(60, 61, 50, '3');

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

--
-- Dumping data for table `t_jawaban_industri`
--

INSERT INTO `t_jawaban_industri` (`jawaban_industri_id`, `responden_industri_id`, `soal_id`, `jawaban`) VALUES
(1, 23, 121, '4'),
(2, 23, 122, '4'),
(3, 23, 123, '4'),
(4, 23, 124, '4'),
(5, 23, 125, '4'),
(6, 23, 126, '4'),
(7, 23, 127, '4'),
(8, 23, 128, '4'),
(9, 23, 129, '4'),
(10, 23, 130, '4'),
(11, 33, 111, '1'),
(12, 33, 112, '2'),
(13, 33, 113, '1'),
(14, 33, 114, '2'),
(15, 33, 115, '1'),
(16, 33, 116, '2'),
(17, 33, 117, '1'),
(18, 33, 118, '4'),
(19, 33, 119, '4'),
(20, 33, 120, '4'),
(21, 33, 121, '1'),
(22, 33, 122, '2'),
(23, 33, 123, '1'),
(24, 33, 124, '2'),
(25, 33, 125, '2'),
(26, 33, 126, '1'),
(27, 33, 127, '1'),
(28, 33, 128, '2'),
(29, 33, 129, '2'),
(30, 33, 130, '2'),
(31, 22, 111, '4'),
(32, 22, 112, '4'),
(33, 22, 113, '4'),
(34, 22, 114, '4'),
(35, 22, 115, '4'),
(36, 22, 116, '4'),
(37, 22, 117, '4'),
(38, 22, 118, '4'),
(39, 22, 119, '4'),
(40, 22, 120, '4'),
(41, 22, 121, '3'),
(42, 22, 122, '4'),
(43, 22, 123, '5'),
(44, 22, 124, '4'),
(45, 22, 125, '3'),
(46, 22, 126, '4'),
(47, 22, 127, '4'),
(48, 22, 128, '4'),
(49, 22, 129, '3'),
(50, 22, 130, '4'),
(51, 43, 111, '3'),
(52, 43, 112, '3'),
(53, 43, 113, '3'),
(54, 43, 114, '3'),
(55, 43, 115, '3'),
(56, 43, 116, '3'),
(57, 43, 117, '3'),
(58, 43, 118, '3'),
(59, 43, 119, '3'),
(60, 43, 120, '3');

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

--
-- Dumping data for table `t_jawaban_mahasiswa`
--

INSERT INTO `t_jawaban_mahasiswa` (`jawaban_mahasiswa_id`, `responden_mahasiswa_id`, `soal_id`, `jawaban`) VALUES
(1, 25, 1, '4'),
(2, 25, 2, '4'),
(3, 25, 3, '4'),
(4, 25, 4, '4'),
(5, 25, 5, '4'),
(6, 25, 6, '4'),
(7, 25, 7, '4'),
(8, 25, 8, '4'),
(9, 25, 9, '4'),
(10, 25, 10, '4'),
(11, 25, 11, '4'),
(12, 25, 12, '4'),
(13, 25, 13, '4'),
(14, 25, 14, '4'),
(15, 25, 15, '4'),
(16, 25, 16, '4'),
(17, 25, 17, '4'),
(18, 25, 18, '4'),
(19, 25, 19, '4'),
(20, 25, 20, '4'),
(21, 25, 21, '4'),
(22, 25, 22, '4'),
(23, 25, 23, '4'),
(24, 25, 24, '4'),
(25, 25, 25, '4'),
(26, 25, 26, '4'),
(27, 25, 27, '4'),
(28, 25, 28, '4'),
(29, 25, 29, '4'),
(30, 25, 30, '4'),
(31, 17, 11, '4'),
(32, 17, 12, '4'),
(33, 17, 13, '4'),
(34, 17, 14, '4'),
(35, 17, 15, '4'),
(36, 17, 16, '4'),
(37, 17, 17, '4'),
(38, 17, 18, '4'),
(39, 17, 19, '4'),
(40, 17, 20, '4'),
(41, 34, 11, '4'),
(42, 34, 12, '4'),
(43, 34, 13, '4'),
(44, 34, 14, '4'),
(45, 34, 15, '4'),
(46, 34, 16, '4'),
(47, 34, 17, '4'),
(48, 34, 18, '4'),
(49, 34, 19, '4'),
(50, 34, 20, '4'),
(51, 34, 1, '4'),
(52, 34, 2, '5'),
(53, 34, 3, '4'),
(54, 34, 4, '4'),
(55, 34, 5, '4'),
(56, 34, 6, '5'),
(57, 34, 7, '4'),
(58, 34, 8, '5'),
(59, 34, 9, '5'),
(60, 34, 10, '5'),
(61, 34, 21, '4'),
(62, 34, 22, '4'),
(63, 34, 23, '4'),
(64, 34, 24, '4'),
(65, 34, 25, '4'),
(66, 34, 26, '4'),
(67, 34, 27, '4'),
(68, 34, 28, '4'),
(69, 34, 29, '4'),
(70, 34, 30, '4'),
(71, 17, 1, '4'),
(72, 17, 2, '4'),
(73, 17, 3, '4'),
(74, 17, 4, '4'),
(75, 17, 5, '4'),
(76, 17, 6, '4'),
(77, 17, 7, '4'),
(78, 17, 8, '4'),
(79, 17, 9, '4'),
(80, 17, 10, '4'),
(81, 17, 21, '4'),
(82, 17, 22, '4'),
(83, 17, 23, '4'),
(84, 17, 24, '4'),
(85, 17, 25, '4'),
(86, 17, 26, '4'),
(87, 17, 27, '4'),
(88, 17, 28, '4'),
(89, 17, 29, '4'),
(90, 17, 30, '4'),
(91, 16, 1, '5'),
(92, 16, 2, '5'),
(93, 16, 3, '3'),
(94, 16, 11, '3'),
(95, 16, 12, '3'),
(96, 16, 13, '3'),
(97, 16, 14, '3'),
(98, 16, 15, '3'),
(99, 16, 16, '3'),
(100, 16, 17, '3'),
(101, 16, 18, '3'),
(102, 16, 19, '3'),
(103, 16, 20, '3'),
(104, 44, 1, '5'),
(105, 44, 2, '5'),
(106, 44, 3, '5'),
(107, 44, 4, '5'),
(108, 44, 5, '5'),
(109, 44, 6, '5'),
(110, 44, 7, '5'),
(111, 44, 8, '5'),
(112, 44, 9, '5'),
(113, 44, 10, '5'),
(114, 60, 1, '4'),
(115, 60, 2, '3'),
(116, 60, 3, '3'),
(117, 60, 4, '4'),
(118, 60, 5, '3'),
(119, 60, 6, '3'),
(120, 60, 7, '5'),
(121, 60, 8, '5'),
(122, 60, 9, '4'),
(123, 60, 10, '1');

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

--
-- Dumping data for table `t_jawaban_ortu`
--

INSERT INTO `t_jawaban_ortu` (`jawaban_ortu_id`, `responden_ortu_id`, `soal_id`, `jawaban`) VALUES
(1, 26, 101, '4'),
(2, 26, 102, '4'),
(3, 26, 103, '4'),
(4, 26, 104, '4'),
(5, 26, 105, '4'),
(6, 26, 106, '4'),
(7, 26, 107, '4'),
(8, 26, 108, '4'),
(9, 26, 109, '4'),
(10, 26, 110, '4'),
(11, 40, 101, '4'),
(12, 40, 102, '4'),
(13, 40, 103, '4'),
(14, 40, 104, '4'),
(15, 40, 105, '4'),
(16, 40, 106, '4'),
(17, 40, 107, '4'),
(18, 40, 108, '4'),
(19, 40, 109, '4'),
(20, 40, 110, '4'),
(21, 41, 101, '1'),
(22, 41, 102, '3'),
(23, 41, 103, '3'),
(24, 41, 104, '3'),
(25, 41, 105, '2'),
(26, 41, 106, '3'),
(27, 41, 107, '5'),
(28, 41, 108, '4'),
(29, 41, 109, '4'),
(30, 41, 110, '4'),
(31, 51, 101, '4'),
(32, 51, 102, '4'),
(33, 51, 103, '4'),
(34, 51, 104, '4'),
(35, 51, 105, '4'),
(36, 51, 106, '4'),
(37, 51, 107, '4'),
(38, 51, 108, '4'),
(39, 51, 109, '4'),
(40, 51, 110, '4'),
(41, 52, 101, '4'),
(42, 52, 102, '4'),
(43, 52, 103, '4'),
(44, 52, 104, '4'),
(45, 52, 105, '4'),
(46, 52, 106, '4'),
(47, 52, 107, '4'),
(48, 52, 108, '4'),
(49, 52, 109, '4'),
(50, 52, 110, '4'),
(51, 54, 101, '1'),
(52, 54, 102, '4'),
(53, 54, 103, '4'),
(54, 54, 104, '3'),
(55, 54, 105, '4'),
(56, 54, 106, '3'),
(57, 54, 107, '3'),
(58, 54, 108, '5'),
(59, 54, 109, '4'),
(60, 54, 110, '3'),
(61, 55, 101, '4'),
(62, 55, 102, '4'),
(63, 55, 103, '4'),
(64, 55, 104, '5'),
(65, 55, 105, '4'),
(66, 55, 106, '4'),
(67, 55, 107, '4'),
(68, 55, 108, '5'),
(69, 55, 109, '4'),
(70, 55, 110, '4'),
(71, 58, 101, '1'),
(72, 58, 102, '5'),
(73, 58, 103, '4'),
(74, 58, 104, '3'),
(75, 58, 105, '3'),
(76, 58, 106, '3'),
(77, 58, 107, '3'),
(78, 58, 108, '2'),
(79, 58, 109, '3'),
(80, 58, 110, '4'),
(81, 59, 101, '4'),
(82, 59, 102, '4'),
(83, 59, 103, '4'),
(84, 59, 104, '4'),
(85, 59, 105, '4'),
(86, 59, 106, '4'),
(87, 59, 107, '4'),
(88, 59, 108, '4'),
(89, 59, 109, '4'),
(90, 59, 110, '4'),
(91, 64, 101, '1'),
(92, 64, 102, '3'),
(93, 64, 103, '3'),
(94, 64, 104, '4'),
(95, 64, 105, '3'),
(96, 64, 106, '4'),
(97, 64, 107, '3'),
(98, 64, 108, '3'),
(99, 64, 109, '4'),
(100, 64, 110, '3');

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

--
-- Dumping data for table `t_jawaban_tendik`
--

INSERT INTO `t_jawaban_tendik` (`jawaban_tendik_id`, `responden_tendik_id`, `soal_id`, `jawaban`) VALUES
(1, 27, 71, '4'),
(2, 27, 72, '4'),
(3, 27, 73, '4'),
(4, 27, 74, '4'),
(5, 27, 75, '4'),
(6, 27, 76, '4'),
(7, 27, 77, '4'),
(8, 27, 78, '4'),
(9, 27, 79, '4'),
(10, 27, 80, '4'),
(11, 35, 61, '1'),
(12, 35, 62, '2'),
(13, 35, 63, '5'),
(14, 35, 64, '4'),
(15, 35, 65, '4'),
(16, 35, 66, '4'),
(17, 35, 67, '3'),
(18, 35, 68, '3'),
(19, 35, 69, '2'),
(20, 35, 70, '3'),
(21, 35, 71, '1'),
(22, 35, 72, '2'),
(23, 35, 73, '2'),
(24, 35, 74, '1'),
(25, 35, 75, '2'),
(26, 35, 76, '5'),
(27, 35, 77, '5'),
(28, 35, 78, '3'),
(29, 35, 79, '3'),
(30, 35, 80, '4'),
(31, 35, 62, '5'),
(32, 20, 61, '3'),
(33, 20, 62, '4'),
(34, 20, 63, '5'),
(35, 20, 64, '4'),
(36, 20, 65, '4'),
(37, 20, 66, '4'),
(38, 20, 67, '4'),
(39, 20, 68, '4'),
(40, 20, 69, '4'),
(41, 20, 70, '4'),
(42, 20, 71, '4'),
(43, 20, 72, '3'),
(44, 20, 73, '4'),
(45, 20, 74, '4'),
(46, 20, 75, '5'),
(47, 20, 76, '4'),
(48, 20, 77, '4'),
(49, 20, 78, '4'),
(50, 20, 79, '4'),
(51, 20, 80, '4'),
(52, 62, 61, '2'),
(53, 62, 62, '4'),
(54, 62, 63, '4'),
(55, 62, 64, '5'),
(56, 62, 65, '3'),
(57, 62, 66, '3'),
(58, 62, 67, '4'),
(59, 62, 68, '4'),
(60, 62, 69, '3'),
(61, 62, 70, '3');

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

--
-- Dumping data for table `t_responden_alumni`
--

INSERT INTO `t_responden_alumni` (`responden_alumni_id`, `survey_id`, `responden_tanggal`, `responden_nim`, `responden_nama`, `responden_prodi`, `responden_email`, `responden_hp`, `tahun_lulus`) VALUES
(28, 10, '2024-06-22 19:38:23', '2241760100', 'Syahrul', 'SIB', 'syahrul@gmail.com', '085604472989', '2022'),
(32, 10, '2024-06-22 20:25:47', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(32, 10, '2024-06-22 20:26:54', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(32, 10, '2024-06-22 20:33:43', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(32, 9, '2024-06-22 21:09:00', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(32, 10, '2024-06-22 21:09:12', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(36, 9, '2024-06-22 21:35:16', '2241760100', 'Lidya', 'SIB', 'lidya@gmail,com', '085604472989', '2021'),
(36, 10, '2024-06-22 21:35:36', '2241760100', 'Lidya', 'SIB', 'lidya@gmail,com', '085604472989', '2021'),
(32, 9, '2024-06-23 05:57:38', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(38, 9, '2024-06-23 05:59:15', '2241760045', 'Yoga', 'SIB', 'yoga@gmail.com', '085604472989', '2022'),
(38, 10, '2024-06-23 05:59:35', '2241760045', 'Yoga', 'SIB', 'yoga@gmail.com', '085604472989', '2022'),
(32, 9, '2024-06-23 17:01:26', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(32, 9, '2024-06-23 18:16:30', '123456', 'ana', 'D4 Akuntansi', '123456@student.polinema.ac.id', '1234567890', '2022'),
(63, 10, '2024-06-24 17:33:58', '123456', 'ttt', 'D4 Akuntansi', '123456@student.polinema.ac.id', '45235434', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_dosen`
--

CREATE TABLE `t_responden_dosen` (
  `responden_dosen_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `responden_tanggal` datetime NOT NULL,
  `responden_nip` varchar(20) NOT NULL,
  `responden_nama` varchar(50) NOT NULL,
  `responden_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_responden_dosen`
--

INSERT INTO `t_responden_dosen` (`responden_dosen_id`, `survey_id`, `responden_tanggal`, `responden_nip`, `responden_nama`, `responden_unit`) VALUES
(15, 6, '2024-06-22 19:40:02', '1234567', 'dosen', '5'),
(30, 4, '2024-06-22 21:50:05', '009456', 'Dodo', '3'),
(37, 6, '2024-06-23 05:56:09', '009567', 'Luna', '2'),
(37, 5, '2024-06-23 05:56:29', '009567', 'Luna', '2'),
(61, 5, '2024-06-24 17:30:05', '1234567', 'www', '5');

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

--
-- Dumping data for table `t_responden_industri`
--

INSERT INTO `t_responden_industri` (`responden_industri_id`, `survey_id`, `responden_tanggal`, `responden_nama`, `responden_jabatan`, `responden_perusahaan`, `responden_email`, `responden_hp`, `responden_kota`) VALUES
(23, 13, '2024-06-22 19:42:29', 'industri', 'kepala staf', 'Ez parky', '123456@student.polinema.ac.id', '087667289223', 0x4d616c616e67),
(33, 12, '2024-06-22 20:56:38', 'fifa', 'kepala staf', 'lalala', '123456@student.polinema.ac.id', '45235434', 0x4d616c616e67),
(33, 13, '2024-06-22 20:56:48', 'fifa', 'kepala staf', 'lalala', '123456@student.polinema.ac.id', '45235434', 0x4d616c616e67),
(22, 12, '2024-06-23 05:45:25', 'Budi', 'HRD', 'PT.Berkah', 'berkah@gmail.com', '0889327648', 0x4d616c616e67),
(22, 13, '2024-06-23 05:45:53', 'Budi', 'HRD', 'PT.Berkah', 'berkah@gmail.com', '0889327648', 0x4d616c616e67),
(43, 12, '2024-06-23 19:15:23', 'indus', 'ketua', 'Pizza Hut ', 'phd@gmail.com', '081111111111', 0x4d616c616e672052617961);

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

--
-- Dumping data for table `t_responden_mahasiswa`
--

INSERT INTO `t_responden_mahasiswa` (`responden_mahasiswa_id`, `survey_id`, `responden_tanggal`, `responden_nim`, `responden_nama`, `responden_prodi`, `responden_email`, `responden_hp`, `tahun_masuk`) VALUES
(25, 1, '2024-06-22 19:32:44', '2241760090', 'Silmy Maulia Dewi', 'SIB', 'silmy@gmail.com', '085604472988', '2022'),
(25, 2, '2024-06-22 19:33:01', '2241760090', 'Silmy Maulia Dewi', 'SIB', 'silmy@gmail.com', '085604472988', '2022'),
(25, 3, '2024-06-22 19:33:19', '2241760090', 'Silmy Maulia Dewi', 'SIB', 'silmy@gmail.com', '085604472988', '2022'),
(17, 2, '2024-06-22 19:43:01', '2241760018', 'Ingga chintia sari', 'SIB', 'ingga@gmail.com', '085604472988', '2022'),
(34, 2, '2024-06-22 21:01:09', '2041760019', 'Nana', 'SIB', 'nana@gmail.com', '085604472989', '2023'),
(34, 1, '2024-06-22 21:01:44', '2041760019', 'Nana', 'SIB', 'nana@gmail.com', '085604472989', '2023'),
(34, 3, '2024-06-22 21:03:07', '2041760019', 'Nana', 'SIB', 'nana@gmail.com', '085604472989', '2023'),
(17, 1, '2024-06-22 21:14:21', '2241760018', 'Ingga chintia sari', 'SIB', 'ingga@gmail.com', '085604472988', '2022'),
(17, 3, '2024-06-22 21:20:25', '2241760018', 'Ingga chintia sari', 'SIB', 'ingga@gmail.com', '085604472988', '2022'),
(16, 1, '2024-06-23 16:55:59', '2241760104', 'mhs', 'Sistem Informasi Bisniss', 'kagendra147@gmail.com', '01231231232', '2022'),
(16, 2, '2024-06-23 17:06:17', '2241760104', 'mhs', 'Sistem Informasi Bisniss', 'kagendra147@gmail.com', '01231231232', '2022'),
(44, 1, '2024-06-23 19:17:57', '2241760122', 'test', 'Sistem Informasi Bisniss', 'kage@gmail.com', '01231231222', '2022'),
(60, 1, '2024-06-24 17:28:26', '123456', 'qqq', 'D4 Akuntansi', '123456@student.polinema.ac.id', '0856782334621', '2023');

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
  `mahasiswa_prodi` varchar(100) DEFAULT NULL,
  `responden_nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_responden_ortu`
--

INSERT INTO `t_responden_ortu` (`responden_ortu_id`, `survey_id`, `responden_tanggal`, `responden_jk`, `responden_umur`, `responden_hp`, `responden_pendidikan`, `responden_pekerjaan`, `responden_penghasilan`, `mahasiswa_nim`, `mahasiswa_nama`, `mahasiswa_prodi`, `responden_nama`) VALUES
(26, 11, '2024-06-22 19:41:17', '', 35, '089876543210', NULL, '', '2.000.000', '2232457755', 'SIB', '', NULL),
(40, 11, '2024-06-23 18:16:04', '', 45, '085604472989', NULL, '', '3.000.000', '2241760055', 'SIB', '', NULL),
(41, 11, '2024-06-23 18:57:37', '', 21, '09087678', NULL, '', '500', '2241760069', 'sib', '', NULL),
(51, 11, '2024-06-23 20:43:26', '', 45, '085604472989', 'SMA', '', '3.000.000', '2241760055', 'Siska', 'SIB', NULL),
(52, 11, '2024-06-24 12:20:48', '', 45, '085604472989', 'SMA', '', '3.000.000', '2241760055', 'Andi', 'SIB', NULL),
(54, 11, '2024-06-24 15:37:27', '', 35, '087667289223', 'sd', '', '2.000.000', '2232457755', 'putra', 'ti', NULL),
(55, 11, '2024-06-24 15:56:23', '', 45, '085604472989', 'SMA', 'Wiraswasta', '3.000.000', '2241760055', 'Andi', 'SIB', NULL),
(58, 11, '2024-06-24 17:02:32', '', 35, '1234567890', 'sd', 'hahhaaha', '2.000.000', '2232457755', 'putra', 'd4 teknik industri', 'tahu'),
(59, 11, '2024-06-24 17:16:26', '', 45, '12134', 'SMA', 'Wiraswasta', '3.000.000', '2241760055', 'Andi', 'SIB', 'Tika'),
(64, 11, '2024-06-24 17:35:49', '', 21, '09087678', 's1 manajemen', 'hahhaaha', '2.000.000', '2232457755', 'putra', 'd4 teknik industri', 'yyy');

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

--
-- Dumping data for table `t_responden_tendik`
--

INSERT INTO `t_responden_tendik` (`responden_tendik_id`, `survey_id`, `responden_tanggal`, `responden_nopeg`, `responden_nama`, `responden_unit`) VALUES
(27, 8, '2024-06-22 19:40:40', '12345', 'tendik', '2'),
(35, 7, '2024-06-22 21:00:52', '12345', 'gogo', '8'),
(35, 8, '2024-06-22 21:01:03', '12345', 'gogo', '8'),
(35, 7, '2024-06-22 21:02:39', '12345', 'gogo', '8'),
(20, 7, '2024-06-23 05:50:18', '116734', 'Ahmad', '2'),
(20, 8, '2024-06-23 05:51:25', '116734', 'Ahmad', '2'),
(62, 7, '2024-06-24 17:32:18', '12345', 'rrr', '8');

-- --------------------------------------------------------

--
-- Structure for view `average_jawaban_per_kategori_4`
--
DROP TABLE IF EXISTS `average_jawaban_per_kategori_4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `average_jawaban_per_kategori_4`  AS SELECT `mk`.`kategori_id` AS `kategori_id`, `ms`.`no_urut` AS `no_urut`, (avg(ifnull(`tj_m`.`jawaban`,0)) + avg(ifnull(`tj_d`.`jawaban`,0)) + avg(ifnull(`tj_t`.`jawaban`,0)) + avg(ifnull(`tj_o`.`jawaban`,0))) / 4 AS `average_jawaban` FROM (((((`m_kategori` `mk` join `m_survey_soal` `ms` on(`mk`.`kategori_id` = `ms`.`kategori_id`)) left join `t_jawaban_mahasiswa` `tj_m` on(`ms`.`soal_id` = `tj_m`.`soal_id`)) left join `t_jawaban_dosen` `tj_d` on(`ms`.`soal_id` = `tj_d`.`soal_id`)) left join `t_jawaban_tendik` `tj_t` on(`ms`.`soal_id` = `tj_t`.`soal_id`)) left join `t_jawaban_ortu` `tj_o` on(`ms`.`soal_id` = `tj_o`.`soal_id`)) GROUP BY `mk`.`kategori_id`, `ms`.`no_urut` ;

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
  ADD PRIMARY KEY (`jawaban_alumni_id`);

--
-- Indexes for table `t_jawaban_dosen`
--
ALTER TABLE `t_jawaban_dosen`
  ADD PRIMARY KEY (`jawaban_dosen_id`);

--
-- Indexes for table `t_jawaban_industri`
--
ALTER TABLE `t_jawaban_industri`
  ADD PRIMARY KEY (`jawaban_industri_id`);

--
-- Indexes for table `t_jawaban_mahasiswa`
--
ALTER TABLE `t_jawaban_mahasiswa`
  ADD PRIMARY KEY (`jawaban_mahasiswa_id`);

--
-- Indexes for table `t_jawaban_ortu`
--
ALTER TABLE `t_jawaban_ortu`
  ADD PRIMARY KEY (`jawaban_ortu_id`);

--
-- Indexes for table `t_jawaban_tendik`
--
ALTER TABLE `t_jawaban_tendik`
  ADD PRIMARY KEY (`jawaban_tendik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_survey`
--
ALTER TABLE `m_survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_survey_soal`
--
ALTER TABLE `m_survey_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `t_jawaban_alumni`
--
ALTER TABLE `t_jawaban_alumni`
  MODIFY `jawaban_alumni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `t_jawaban_dosen`
--
ALTER TABLE `t_jawaban_dosen`
  MODIFY `jawaban_dosen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `t_jawaban_industri`
--
ALTER TABLE `t_jawaban_industri`
  MODIFY `jawaban_industri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `t_jawaban_mahasiswa`
--
ALTER TABLE `t_jawaban_mahasiswa`
  MODIFY `jawaban_mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `t_jawaban_ortu`
--
ALTER TABLE `t_jawaban_ortu`
  MODIFY `jawaban_ortu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `t_jawaban_tendik`
--
ALTER TABLE `t_jawaban_tendik`
  MODIFY `jawaban_tendik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
