-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2020 at 03:13 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `asdasd`
--

DROP TABLE IF EXISTS `asdasd`;
CREATE TABLE IF NOT EXISTS `asdasd` (
  `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `amount` int(128) NOT NULL,
  `bukti` int(128) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asdasd`
--

INSERT INTO `asdasd` (`id_user`, `nama`, `amount`, `bukti`, `pwd`) VALUES
(16, 'Coba Update', 42069, 12312, 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

DROP TABLE IF EXISTS `assignment`;
CREATE TABLE IF NOT EXISTS `assignment` (
  `id_assignment` int(11) NOT NULL AUTO_INCREMENT,
  `id_task` int(11) NOT NULL,
  `id_reviewer` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `tgl_assignment` date DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_assignment` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_assignment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assignment2`
--

DROP TABLE IF EXISTS `assignment2`;
CREATE TABLE IF NOT EXISTS `assignment2` (
  `id_assignment` int(11) NOT NULL AUTO_INCREMENT,
  `id_task` int(11) NOT NULL,
  `id_reviewer` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `review_location` varchar(500) DEFAULT NULL,
  `tgl_assignment` date DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp(),
  `sts_assignment` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_assignment`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment2`
--

INSERT INTO `assignment2` (`id_assignment`, `id_task`, `id_reviewer`, `status`, `review_location`, `tgl_assignment`, `tgl_deadline`, `date_created`, `date_updated`, `sts_assignment`) VALUES
(1, 1, 1, 3, '1589274135_sakis_Reading_strategies_and_Reading_for_detail.pdf', '2020-05-10', '2020-05-13', '2020-05-09 17:01:47', '2020-05-09 17:01:47', 1),
(2, 1, 2, 0, NULL, NULL, NULL, '2020-05-09 17:01:47', '2020-05-09 17:01:47', 1),
(3, 1, 3, 0, NULL, NULL, NULL, '2020-05-09 17:01:47', '2020-05-09 17:01:47', 1),
(4, 1, 4, 0, NULL, NULL, NULL, '2020-05-09 17:01:47', '2020-05-09 17:01:47', 1),
(5, 1, 5, 3, '1589284475_Mr__Reviewer_Reading_strategies_and_Reading_for_detail.docx', '2020-05-12', '2020-05-15', '2020-05-09 17:01:47', '2020-05-09 17:01:47', 1),
(6, 2, 1, 3, NULL, NULL, NULL, '2020-05-09 17:02:01', '2020-05-09 17:02:01', 0),
(7, 2, 2, 0, NULL, NULL, NULL, '2020-05-09 17:02:01', '2020-05-09 17:02:01', 1),
(8, 2, 3, 0, NULL, NULL, NULL, '2020-05-09 17:02:01', '2020-05-09 17:02:01', 1),
(9, 2, 4, 0, NULL, NULL, NULL, '2020-05-09 17:02:01', '2020-05-09 17:02:01', 1),
(10, 2, 5, -1, NULL, NULL, NULL, '2020-05-09 17:02:01', '2020-05-09 17:02:01', 1),
(11, 5, 1, 3, '1589274198_sakis_Organization_Pattern_Writing.pdf', '2020-05-11', '2020-05-21', '2020-05-09 22:23:08', '2020-05-09 22:23:08', 1),
(12, 4, 1, 2, '1589276737_sakis_Hubungan_Modul_dengan_Moduler.pdf', '2020-05-10', '2020-05-13', '2020-05-09 22:24:21', '2020-05-09 22:24:21', 1),
(13, 3, 1, 0, NULL, NULL, NULL, '2020-05-09 22:25:11', '2020-05-09 22:25:11', 1),
(14, 6, 5, 2, '1589284554_Mr__Reviewer_Relasi_a_dengan_b.docx', '2020-05-12', '2020-05-25', '2020-05-12 10:30:36', '2020-05-12 10:30:36', 1),
(15, 7, 5, 0, NULL, NULL, NULL, '2020-05-12 11:08:17', '2020-05-12 11:08:17', 1),
(16, 8, 5, 2, '1589286920_Mr__Reviewer_Pointer_dan_Struct.docx', '2020-05-12', '2020-05-27', '2020-05-12 12:34:36', '2020-05-12 12:34:36', 1),
(17, 5, 5, 0, NULL, NULL, NULL, '2020-05-12 14:19:08', '2020-05-12 14:19:08', 1),
(18, 5, 6, 2, '1589293765_Mr__Google_Organization_Pattern_Writing.docx', '2020-05-12', '2020-05-22', '2020-05-12 14:19:08', '2020-05-12 14:19:08', 1),
(19, 4, 6, 3, '1589312213_Mr__Google_Hubungan_Modul_dengan_Moduler.pdf', '2020-05-13', '2020-05-16', '2020-05-12 18:48:18', '2020-05-13 02:59:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dana`
--

DROP TABLE IF EXISTS `dana`;
CREATE TABLE IF NOT EXISTS `dana` (
  `id_dana` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` tinyint(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount` float NOT NULL,
  `bukti` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_dana` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_dana`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

DROP TABLE IF EXISTS `editor`;
CREATE TABLE IF NOT EXISTS `editor` (
  `id_editor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_editor` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_editor`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id_editor`, `id_user`, `balance`, `date_created`, `date_updated`, `sts_editor`) VALUES
(1, 1, 200000, '2020-05-09 11:51:11', '2020-05-09 11:51:11', 1),
(2, 8, 0, '2020-05-12 10:22:59', '2020-05-12 10:22:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

DROP TABLE IF EXISTS `grup`;
CREATE TABLE IF NOT EXISTS `grup` (
  `id_grup` int(11) NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_grup` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_grup`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`, `date_created`, `date_updated`, `sts_grup`) VALUES
(1, 'editor', '2020-03-12 05:56:17', '2020-03-12 05:58:24', 1),
(2, 'reviewer', '2020-03-12 05:56:17', '2020-03-12 05:58:24', 1),
(3, 'makelaar', '2020-03-12 05:56:43', '2020-03-12 05:58:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `makelaar`
--

DROP TABLE IF EXISTS `makelaar`;
CREATE TABLE IF NOT EXISTS `makelaar` (
  `id_makelaar` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_makelaar` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_makelaar`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `makelaar`
--

INSERT INTO `makelaar` (`id_makelaar`, `id_user`, `date_created`, `date_updated`, `sts_makelaar`) VALUES
(1, 7, '2020-05-12 06:40:34', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_grup` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp(),
  `sts_member` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_member`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `id_grup`, `id_user`, `date_created`, `date_updated`, `sts_member`) VALUES
(1, 1, 1, '2020-05-09 11:51:11', '2020-05-09 11:51:11', 1),
(2, 2, 2, '2020-05-09 11:53:14', '2020-05-09 11:53:14', 1),
(3, 2, 3, '2020-05-09 11:53:48', '2020-05-09 11:53:48', 1),
(4, 2, 4, '2020-05-09 11:54:13', '2020-05-09 11:54:13', 1),
(5, 2, 5, '2020-05-09 11:54:43', '2020-05-09 11:54:43', 1),
(6, 2, 6, '2020-05-09 11:55:39', '2020-05-09 11:55:39', 1),
(7, 3, 7, '2020-05-12 06:40:15', '2020-05-12 06:40:15', 1),
(8, 1, 8, '2020-05-12 10:22:59', '2020-05-12 10:22:59', 1),
(9, 2, 9, '2020-05-12 13:53:12', '2020-05-12 13:53:12', 1),
(10, 2, 10, '2020-05-13 02:17:00', '2020-05-13 02:17:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_assignment` int(11) NOT NULL,
  `amount` float NOT NULL,
  `bukti` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_pembayaran` tinytext NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_assignment`, `amount`, `bukti`, `date_created`, `date_updated`, `sts_pembayaran`) VALUES
(21, 5, 300000, NULL, '2020-05-13 01:52:45', NULL, '0'),
(65, 19, 300000, NULL, '2020-05-13 02:44:46', NULL, '0'),
(93, 19, 300000, NULL, '2020-05-13 02:59:45', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

DROP TABLE IF EXISTS `reviewer`;
CREATE TABLE IF NOT EXISTS `reviewer` (
  `id_reviewer` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `balance` float NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_reviewer` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_reviewer`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`id_reviewer`, `id_user`, `balance`, `date_created`, `date_updated`, `sts_reviewer`) VALUES
(1, 2, 0, '2020-05-09 11:53:14', '2020-05-09 11:53:14', 1),
(2, 3, 0, '2020-05-09 11:53:48', '2020-05-09 11:53:48', 1),
(3, 4, 0, '2020-05-09 11:54:13', '2020-05-09 11:54:13', 1),
(4, 5, 0, '2020-05-09 11:54:43', '2020-05-09 11:54:43', 1),
(5, 6, 300000, '2020-05-09 11:55:39', '2020-05-09 11:55:39', 1),
(6, 9, 1200000, '2020-05-12 13:53:12', '2020-05-12 13:53:12', 1),
(7, 10, 0, '2020-05-13 02:17:00', '2020-05-13 02:17:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) NOT NULL,
  `authors` varchar(300) DEFAULT NULL,
  `jumlah_hal` tinyint(3) DEFAULT 3,
  `keywords` varchar(300) DEFAULT NULL,
  `filelocation` varchar(300) DEFAULT NULL,
  `id_editor` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_task` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_task`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task`, `judul`, `authors`, `jumlah_hal`, `keywords`, `filelocation`, `id_editor`, `date_created`, `date_updated`, `sts_task`) VALUES
(1, 'Reading strategies and Reading for detail', 'Author 1, Author 2, Author 3', 3, 'reading, strategies, details', '1589025438_Reading_strategies_and_Reading_for_detail(1).docx', 1, '2020-05-09 11:57:18', NULL, 1),
(2, 'Analisis Jadwal EAS', 'Author 1, Author 2, Author 3', 3, 'analisis, jadwal, eas', '1589025472_Jadwal_EAS_UPMB_Semester_Genap_2019_2020.pdf', 1, '2020-05-09 11:57:52', NULL, 1),
(3, 'Text Pattern Organization', 'Author 1, author 2, author 3', 3, 'text, patern', '1589025489_Text_Pattern_Organization.docx', 1, '2020-05-09 11:58:09', NULL, 1),
(4, 'Hubungan Modul dengan Moduler', 'sakis', 3, 'Hubungan, Modul, Moduler', '1589025558_Modul3_Syakhisk_Al-Azmi_0003.pdf', 1, '2020-05-09 11:59:18', NULL, 1),
(5, 'Organization Pattern Writing', 'Yanto Lorem, Rahmad Ipsum', 10, 'Organization, Pattern', '1589059829_OrganizationalPatternsinAcademicWriting.pdf', 1, '2020-05-09 21:30:29', NULL, 1),
(6, 'Relasi a dengan b', 'Auth 1, auth 5, auth 6', 13, 'Relasi, a, b', '1589279415_Syakhisk_Al-Azmi_05311940000003_053_1.3.2.pdf', 2, '2020-05-12 10:30:15', NULL, 1),
(7, 'Kursus Persiapan untuk Toefl Test', 'Longman, Phillips', 25, 'Kursus, Persiapan, Toefl', '1589281544_Syakhisk_Al-Azmi_05311940000003_053_2.3.1.pdf', 2, '2020-05-12 11:05:44', NULL, 1),
(8, 'Pointer dan Struct', 'Aiden, Bellatrix', 15, 'Pointer, Struct', '1589286859_Pointer_Struct_ShafiraFirdausi_053_040.pdf', 2, '2020-05-12 12:34:19', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `no_rek` varchar(200) NOT NULL,
  `foto_user` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_user` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `pwd`, `nama`, `email`, `no_rek`, `foto_user`, `date_created`, `date_updated`, `sts_user`) VALUES
(1, 'yanto', '7849816e52e7d1596c51f3e36f21c498', 'Yanto Lorem', 'yanto@yanto.com', '5174840525', '1589025071_yanto.png', '2020-05-09 11:51:11', NULL, 1),
(2, 'sakis', '18206cdcf230e9340e625bfaaede8b14', 'sakis', 'sakis@gmail.com', '3387846219', '1589025194_yanto.png', '2020-05-09 11:53:14', NULL, 1),
(3, 'rahmad', '6878c309268c7bc852fb0f81c6419904', 'rahmad', 'rahmad@gmail.com', '3137905162', '1589025228_yanto.png', '2020-05-09 11:53:48', NULL, 1),
(4, 'yulianto', '7b5adea9f129b861e3291e851a9e15e9', 'yulianto', 'yulianto@yulianto.com', '5812786306', '1589025253_yanto.png', '2020-05-09 11:54:13', NULL, 1),
(5, 'felipe', '7e04da88cbb8cc933c7b89fbfe121cca', 'felipe', 'felipe@felipe.com', '2062924740', '1589025283_yanto.png', '2020-05-09 11:54:43', NULL, 1),
(6, 'mrreviewer', '21f90ab4834f227b6d6f0fe8e4fa044b', 'Mr. Reviewer', 'mrreviewer@mrreviewer.com', '2570738858', '1589025339_yanto.png', '2020-05-09 11:55:39', NULL, 1),
(7, 'mrmakelaar', 'c9d9b98be6cb176723739f15e0c792ec', 'Mr. Makelaar', 'mrmakelaar@makelaar.com', '8540717249', '1589025071_yanto.png', '2020-05-12 06:39:56', NULL, 1),
(8, 'syakhisk', 'b46613f54efeef2975c35b17f3e6a0da', 'Syakhisk Syari Al-Azmi', 'syakhisk.witwicky@gmail.com', '2201601580', '1589278979_yanto_-_Copy.png', '2020-05-12 10:22:59', NULL, 1),
(9, 'google', 'c822c1b63853ed273b89687ac505f9fa', 'Mr. Google', 'google@google.com', '1492064091', 'google_profilepicture.png', '2020-05-12 13:53:12', NULL, 1),
(10, 'ujicoba', '10cf4ce1ce9dcd8f3f7c2c37974d8b84', 'Uji Coba 1', 'uji@coba.com', '6026669999', 'ujicoba_profilepicture.png', '2020-05-13 02:17:00', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
