-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2024 at 01:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_survey_dan_soal`
-- (See below for the actual view)
--
CREATE TABLE `detail_survey_dan_soal` (
);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--
-- Error reading structure for table siskepel.m_kategori: #1932 - Table 'siskepel.m_kategori' doesn't exist in engine
-- Error reading data for table siskepel.m_kategori: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`m_kategori`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `m_survey`
--
-- Error reading structure for table siskepel.m_survey: #1932 - Table 'siskepel.m_survey' doesn't exist in engine
-- Error reading data for table siskepel.m_survey: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`m_survey`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `m_survey_soal`
--
-- Error reading structure for table siskepel.m_survey_soal: #1932 - Table 'siskepel.m_survey_soal' doesn't exist in engine
-- Error reading data for table siskepel.m_survey_soal: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`m_survey_soal`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--
-- Error reading structure for table siskepel.m_user: #1932 - Table 'siskepel.m_user' doesn't exist in engine
-- Error reading data for table siskepel.m_user: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`m_user`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `m_user_data`
--
-- Error reading structure for table siskepel.m_user_data: #1932 - Table 'siskepel.m_user_data' doesn't exist in engine
-- Error reading data for table siskepel.m_user_data: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`m_user_data`' at line 1

-- --------------------------------------------------------

--
-- Stand-in structure for view `rank_per_kategori`
-- (See below for the actual view)
--
CREATE TABLE `rank_per_kategori` (
);

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_alumni`
--
-- Error reading structure for table siskepel.t_jawaban_alumni: #1932 - Table 'siskepel.t_jawaban_alumni' doesn't exist in engine
-- Error reading data for table siskepel.t_jawaban_alumni: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_jawaban_alumni`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_dosen`
--
-- Error reading structure for table siskepel.t_jawaban_dosen: #1932 - Table 'siskepel.t_jawaban_dosen' doesn't exist in engine
-- Error reading data for table siskepel.t_jawaban_dosen: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_jawaban_dosen`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_industri`
--
-- Error reading structure for table siskepel.t_jawaban_industri: #1932 - Table 'siskepel.t_jawaban_industri' doesn't exist in engine
-- Error reading data for table siskepel.t_jawaban_industri: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_jawaban_industri`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_mahasiswa`
--
-- Error reading structure for table siskepel.t_jawaban_mahasiswa: #1932 - Table 'siskepel.t_jawaban_mahasiswa' doesn't exist in engine
-- Error reading data for table siskepel.t_jawaban_mahasiswa: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_jawaban_mahasiswa`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_ortu`
--
-- Error reading structure for table siskepel.t_jawaban_ortu: #1932 - Table 'siskepel.t_jawaban_ortu' doesn't exist in engine
-- Error reading data for table siskepel.t_jawaban_ortu: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_jawaban_ortu`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban_tendik`
--
-- Error reading structure for table siskepel.t_jawaban_tendik: #1932 - Table 'siskepel.t_jawaban_tendik' doesn't exist in engine
-- Error reading data for table siskepel.t_jawaban_tendik: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_jawaban_tendik`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_alumni`
--
-- Error reading structure for table siskepel.t_responden_alumni: #1932 - Table 'siskepel.t_responden_alumni' doesn't exist in engine
-- Error reading data for table siskepel.t_responden_alumni: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_responden_alumni`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_dosen`
--
-- Error reading structure for table siskepel.t_responden_dosen: #1932 - Table 'siskepel.t_responden_dosen' doesn't exist in engine
-- Error reading data for table siskepel.t_responden_dosen: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_responden_dosen`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_industri`
--
-- Error reading structure for table siskepel.t_responden_industri: #1932 - Table 'siskepel.t_responden_industri' doesn't exist in engine
-- Error reading data for table siskepel.t_responden_industri: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_responden_industri`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_mahasiswa`
--
-- Error reading structure for table siskepel.t_responden_mahasiswa: #1932 - Table 'siskepel.t_responden_mahasiswa' doesn't exist in engine
-- Error reading data for table siskepel.t_responden_mahasiswa: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_responden_mahasiswa`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_ortu`
--
-- Error reading structure for table siskepel.t_responden_ortu: #1932 - Table 'siskepel.t_responden_ortu' doesn't exist in engine
-- Error reading data for table siskepel.t_responden_ortu: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_responden_ortu`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `t_responden_tendik`
--
-- Error reading structure for table siskepel.t_responden_tendik: #1932 - Table 'siskepel.t_responden_tendik' doesn't exist in engine
-- Error reading data for table siskepel.t_responden_tendik: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `siskepel`.`t_responden_tendik`' at line 1

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

-- --------------------------------------------------------

--
-- Structure for view `rank_per_kategori`
--
DROP TABLE IF EXISTS `rank_per_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `rank_per_kategori`  AS SELECT `average_jawaban_per_kategori_4`.`kategori_id` AS `kategori_id`, avg(`average_jawaban_per_kategori_4`.`average_jawaban`) AS `avg_jawaban` FROM `average_jawaban_per_kategori_4` GROUP BY `average_jawaban_per_kategori_4`.`kategori_id` ORDER BY avg(`average_jawaban_per_kategori_4`.`average_jawaban`) DESC ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
