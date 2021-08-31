
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2016 at 01:40 AM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u145851850_sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_jadual` varchar(12) NOT NULL,
  `pengajar_id` varchar(12) NOT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `fk_absensi_jadual1` (`id_jadual`),
  KEY `fk_absensi_personal1` (`pengajar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `tanggal`, `id_jadual`, `pengajar_id`, `keterangan`) VALUES
('140000000003', '2014-11-23', 'JD0000000001', 'PS0000000001', NULL),
('140000000004', '2014-12-05', 'JD0000000013', 'PS0000000006', NULL),
('140000000005', '2014-12-06', 'JD0000000015', 'PS0000000006', NULL),
('140000000006', '2014-12-07', 'JD0000000001', 'PS0000000006', NULL),
('140000000007', '2014-12-08', 'JD0000000003', 'PS0000000006', NULL),
('140000000008', '2014-12-08', 'JD0000000006', 'PS0000000006', NULL),
('140000000009', '2014-11-25', 'JD0000000005', 'PS0000000018', NULL),
('140000000010', '2014-11-25', 'JD0000000004', 'PS0000000013', NULL),
('140000000011', '2014-11-27', 'JD0000000001', 'PS0000000002', NULL),
('140000000012', '2014-11-30', 'JD0000000001', 'PS0000000018', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `absensi_personal`
--

CREATE TABLE IF NOT EXISTS `absensi_personal` (
  `id_absensi` varchar(12) NOT NULL,
  `id_siswa` varchar(12) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`,`id_siswa`),
  KEY `fk_absensi_has_personal_personal1` (`id_siswa`),
  KEY `fk_absensi_has_personal_absensi1` (`id_absensi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi_personal`
--

INSERT INTO `absensi_personal` (`id_absensi`, `id_siswa`, `status`, `keterangan`) VALUES
('140000000003', 'PS0000000001', 'IJN', 'Halakoh'),
('140000000003', 'PS0000000002', 'IJN', 'halqoh'),
('140000000003', 'PS0000000013', 'IJN', 'halqoh'),
('140000000004', 'PS0000000006', 'IJN', 'Mudik'),
('140000000005', 'PS0000000006', 'IJN', 'Mudik'),
('140000000006', 'PS0000000006', 'IJN', 'Mudik'),
('140000000007', 'PS0000000006', 'IJN', 'Mudik'),
('140000000008', 'PS0000000006', 'IJN', 'Mudik'),
('140000000009', 'PS0000000018', 'SCK', 'giduan'),
('140000000010', 'PS0000000013', 'IJN', 'Halqoh'),
('140000000011', 'PS0000000002', 'IJN', 'halqoh'),
('140000000012', 'PS0000000008', 'SCK', 'Sakit'),
('140000000012', 'PS0000000018', 'IJN', 'halaqoh');

-- --------------------------------------------------------

--
-- Table structure for table `education_history`
--

CREATE TABLE IF NOT EXISTS `education_history` (
  `id_education` varchar(12) NOT NULL,
  `level_pendidikan` varchar(45) DEFAULT NULL,
  `tahun_mulai` year(4) DEFAULT NULL,
  `tahun_selesai` year(4) DEFAULT NULL,
  `institusi` varchar(200) DEFAULT NULL,
  `nilai_rata` int(11) DEFAULT NULL,
  `no_ijazah` varchar(45) DEFAULT NULL,
  `negara` varchar(100) DEFAULT NULL,
  `propinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `tgl_ijazah` date DEFAULT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`id_education`),
  KEY `fk_education_history_personal1` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_history`
--

INSERT INTO `education_history` (`id_education`, `level_pendidikan`, `tahun_mulai`, `tahun_selesai`, `institusi`, `nilai_rata`, `no_ijazah`, `negara`, `propinsi`, `kota`, `tgl_ijazah`, `personal_id`) VALUES
('EH0000000001', 'TK', 1995, 1997, 'TK pelita harapan', 0, '01231313', 'Indonesia', '', '', '1997-05-15', 'PS0000000001'),
('EH0000000004', 'SD', 1932, 1935, 'sadadadad', 0, '', 'indonesia', '', '', NULL, 'PS0000000001'),
('EH0000000005', 'SMP', 2000, 2003, 'Smp N 1 Cigugur', 0, '', 'indonesia', '', '', NULL, 'PS0000000001'),
('EH0000000006', 'SMK', 2003, 2006, 'SMK N 2 Ciamis', 0, '', 'indonesia', '', '', NULL, 'PS0000000001'),
('EH0000000007', 'UNIVERSITAS', 2008, 2013, 'Universitas Satya Negara Indonesia', 0, '', 'indonesia', '', '', NULL, 'PS0000000001'),
('EH0000000008', 'SD', 2000, 2006, 'SDN 1 WIRASABA', 0, '', 'indonesia', 'jawa tengah', 'purbalingga', NULL, 'PS0000000055'),
('EH0000000009', 'SMP', 2007, 2009, 'SMPN 2 BUKATEJA', 0, '', 'indonesia', 'jawa tengah', 'purbalingga', NULL, 'PS0000000055'),
('EH0000000010', 'SMK', 2009, 2010, 'SMKN 1 BUKATEJA', 0, '', 'indonesia', 'jawa tengah', 'purbalingga', NULL, 'PS0000000055'),
('EH0000000011', 'SMK', 2009, 2012, 'smk n 5 malang', 0, '', 'indonesia', '', '', NULL, 'PS0000000005'),
('EH0000000012', 'SMA', 2011, 2012, 'SMAPGRI TEGUH SEMPURNA', 0, '', 'indonesia', 'kalimantan tengah', 'Kotawaringin timur (sampit)', NULL, 'PS0000000055'),
('EH0000000013', 'UNIVERSITAS', 2013, 2016, 'STIE KASIH BANGSA', 0, '', 'INDONESIA', 'DKI JAKARTA', 'JAKARTA BARAT', NULL, 'PS0000000055'),
('EH0000000014', 'TK', 1997, 1998, 'Raudhatul Athfal Melati , Kosambi', 0, '', 'Indonesia', 'DKI Jakarta', 'Jakarta Barat', NULL, 'PS0000000008'),
('EH0000000015', 'SD', 1998, 2000, 'Madrasah Ibtiidaiyah Ds.Sidakmukti', 0, '', 'Indonesia', 'Jawa Tengah', 'Brebes', NULL, 'PS0000000008'),
('EH0000000016', 'SD', 2000, 2004, 'SD Negeri 02 Pagi Kosambi Cengkareng', 0, '', 'Indonesia', 'DKI Jakarta', 'Jakarta Barat', NULL, 'PS0000000008'),
('EH0000000017', 'SMP', 2004, 2007, 'SMP Negeri176 Kosambi', 0, '', 'Indonesia', 'DKI Jakarta', 'Jakarta Barat', NULL, 'PS0000000008'),
('EH0000000018', 'SMA', 2007, 2010, 'SMA Negeri 112 Meruya', 0, '', 'Indonesia', 'DKI Jakarta', 'Jakarta Barat', NULL, 'PS0000000008'),
('EH0000000019', 'UNIVERSITAS', 2011, 2016, 'Universitas Terbuka', 0, '', 'Indonesia', 'Banten', 'Tangerang', NULL, 'PS0000000008'),
('EH0000000020', 'SMK', 2010, 2013, 'SMK Nusantara', 9, '', 'Indonesia', 'DKI Jakarta', 'Jakarta Barat', NULL, 'PS0000000061');

-- --------------------------------------------------------

--
-- Table structure for table `empgroup`
--

CREATE TABLE IF NOT EXISTS `empgroup` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(200) DEFAULT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  `dibuat_oleh` varchar(12) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `empgroup`
--

INSERT INTO `empgroup` (`id_group`, `nama_group`, `tgl_dibuat`, `dibuat_oleh`, `keterangan`) VALUES
(1, 'Penguna Ikhwan', '2014-10-14', NULL, 'ikhwan hanya bisa melihat ikhwan'),
(2, 'Superadmin ', '2014-10-14', NULL, 'Bisa Melihat semua Orang'),
(3, 'Penguna Akhwat', '2014-10-26', NULL, ''),
(4, 'admin Dm', '2014-10-27', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `empgroup_admin`
--

CREATE TABLE IF NOT EXISTS `empgroup_admin` (
  `empgroup_id` int(11) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`empgroup_id`,`personal_id`),
  KEY `fk_empgroup_admin_group_id` (`empgroup_id`),
  KEY `fk_empgroup_id_personal_id` (`personal_id`),
  KEY `fk_empgroup_id_group1` (`empgroup_id`),
  KEY `fk_personal_id_personal_4` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empgroup_admin`
--

INSERT INTO `empgroup_admin` (`empgroup_id`, `personal_id`) VALUES
(1, 'PS0000000001'),
(2, 'PS0000000001'),
(3, 'PS0000000005'),
(3, 'PS0000000006'),
(3, 'PS0000000007'),
(4, 'PS0000000001'),
(4, 'PS0000000004'),
(4, 'PS0000000012'),
(4, 'PS0000000019');

-- --------------------------------------------------------

--
-- Table structure for table `empgroup_data`
--

CREATE TABLE IF NOT EXISTS `empgroup_data` (
  `empgroup_id` int(11) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`empgroup_id`,`personal_id`),
  KEY `fk_empgroup_id_group_id1` (`empgroup_id`),
  KEY `fk_personal_id_personal_fk` (`personal_id`),
  KEY `fk_group_id_group_3` (`empgroup_id`),
  KEY `fk_personal_id_personal_5` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empgroup_data`
--

INSERT INTO `empgroup_data` (`empgroup_id`, `personal_id`) VALUES
(1, 'PS0000000001'),
(1, 'PS0000000002'),
(1, 'PS0000000003'),
(1, 'PS0000000004'),
(1, 'PS0000000009'),
(1, 'PS0000000010'),
(1, 'PS0000000012'),
(1, 'PS0000000013'),
(1, 'PS0000000014'),
(1, 'PS0000000015'),
(1, 'PS0000000016'),
(1, 'PS0000000017'),
(1, 'PS0000000018'),
(1, 'PS0000000019'),
(1, 'PS0000000020'),
(1, 'PS0000000021'),
(1, 'PS0000000022'),
(1, 'PS0000000023'),
(1, 'PS0000000024'),
(1, 'PS0000000025'),
(1, 'PS0000000026'),
(1, 'PS0000000027'),
(1, 'PS0000000028'),
(1, 'PS0000000029'),
(1, 'PS0000000030'),
(1, 'PS0000000031'),
(1, 'PS0000000032'),
(1, 'PS0000000033'),
(1, 'PS0000000034'),
(1, 'PS0000000035'),
(1, 'PS0000000036'),
(1, 'PS0000000037'),
(1, 'PS0000000038'),
(1, 'PS0000000039'),
(1, 'PS0000000040'),
(1, 'PS0000000041'),
(1, 'PS0000000042'),
(1, 'PS0000000043'),
(1, 'PS0000000044'),
(1, 'PS0000000045'),
(1, 'PS0000000046'),
(1, 'PS0000000047'),
(1, 'PS0000000048'),
(1, 'PS0000000049'),
(1, 'PS0000000050'),
(1, 'PS0000000051'),
(1, 'PS0000000052'),
(1, 'PS0000000053'),
(1, 'PS0000000054'),
(1, 'PS0000000062'),
(1, 'PS0000000063'),
(1, 'PS0000000064'),
(1, 'PS0000000065'),
(1, 'PS0000000066'),
(1, 'PS0000000067'),
(1, 'PS0000000080'),
(2, 'PS0000000001'),
(2, 'PS0000000002'),
(2, 'PS0000000003'),
(2, 'PS0000000004'),
(2, 'PS0000000005'),
(2, 'PS0000000006'),
(2, 'PS0000000007'),
(2, 'PS0000000008'),
(2, 'PS0000000009'),
(2, 'PS0000000010'),
(2, 'PS0000000011'),
(2, 'PS0000000012'),
(2, 'PS0000000013'),
(2, 'PS0000000014'),
(2, 'PS0000000015'),
(2, 'PS0000000016'),
(2, 'PS0000000017'),
(2, 'PS0000000018'),
(2, 'PS0000000019'),
(2, 'PS0000000020'),
(2, 'PS0000000021'),
(2, 'PS0000000022'),
(2, 'PS0000000023'),
(2, 'PS0000000024'),
(2, 'PS0000000025'),
(2, 'PS0000000026'),
(2, 'PS0000000027'),
(2, 'PS0000000028'),
(2, 'PS0000000029'),
(2, 'PS0000000030'),
(2, 'PS0000000031'),
(2, 'PS0000000032'),
(2, 'PS0000000033'),
(2, 'PS0000000034'),
(2, 'PS0000000035'),
(2, 'PS0000000036'),
(2, 'PS0000000037'),
(2, 'PS0000000038'),
(2, 'PS0000000039'),
(2, 'PS0000000040'),
(2, 'PS0000000041'),
(2, 'PS0000000042'),
(2, 'PS0000000043'),
(2, 'PS0000000044'),
(2, 'PS0000000045'),
(2, 'PS0000000046'),
(2, 'PS0000000047'),
(2, 'PS0000000048'),
(2, 'PS0000000049'),
(2, 'PS0000000050'),
(2, 'PS0000000051'),
(2, 'PS0000000052'),
(2, 'PS0000000053'),
(2, 'PS0000000054'),
(3, 'PS0000000005'),
(3, 'PS0000000006'),
(3, 'PS0000000007'),
(3, 'PS0000000008'),
(3, 'PS0000000011'),
(3, 'PS0000000055'),
(3, 'PS0000000056'),
(3, 'PS0000000057'),
(3, 'PS0000000058'),
(3, 'PS0000000059'),
(3, 'PS0000000060'),
(3, 'PS0000000061'),
(3, 'PS0000000068'),
(3, 'PS0000000069'),
(3, 'PS0000000070'),
(3, 'PS0000000071'),
(3, 'PS0000000072'),
(3, 'PS0000000073'),
(3, 'PS0000000074'),
(3, 'PS0000000075'),
(3, 'PS0000000076'),
(3, 'PS0000000077'),
(3, 'PS0000000078'),
(3, 'PS0000000079'),
(3, 'PS0000000081'),
(3, 'PS0000000082'),
(3, 'PS0000000083'),
(3, 'PS0000000084'),
(3, 'PS0000000085'),
(3, 'PS0000000086'),
(4, 'PS0000000001'),
(4, 'PS0000000002'),
(4, 'PS0000000003'),
(4, 'PS0000000004'),
(4, 'PS0000000005'),
(4, 'PS0000000006'),
(4, 'PS0000000007'),
(4, 'PS0000000008'),
(4, 'PS0000000009'),
(4, 'PS0000000010'),
(4, 'PS0000000011'),
(4, 'PS0000000012'),
(4, 'PS0000000013'),
(4, 'PS0000000014'),
(4, 'PS0000000015'),
(4, 'PS0000000016'),
(4, 'PS0000000017'),
(4, 'PS0000000018'),
(4, 'PS0000000019'),
(4, 'PS0000000020'),
(4, 'PS0000000021'),
(4, 'PS0000000022'),
(4, 'PS0000000023'),
(4, 'PS0000000024'),
(4, 'PS0000000025'),
(4, 'PS0000000026'),
(4, 'PS0000000027'),
(4, 'PS0000000028'),
(4, 'PS0000000029'),
(4, 'PS0000000030'),
(4, 'PS0000000031'),
(4, 'PS0000000032'),
(4, 'PS0000000033'),
(4, 'PS0000000034'),
(4, 'PS0000000035'),
(4, 'PS0000000036'),
(4, 'PS0000000037'),
(4, 'PS0000000038'),
(4, 'PS0000000039'),
(4, 'PS0000000040'),
(4, 'PS0000000041'),
(4, 'PS0000000042'),
(4, 'PS0000000043'),
(4, 'PS0000000044'),
(4, 'PS0000000045'),
(4, 'PS0000000046'),
(4, 'PS0000000047'),
(4, 'PS0000000048'),
(4, 'PS0000000049'),
(4, 'PS0000000050'),
(4, 'PS0000000051'),
(4, 'PS0000000052'),
(4, 'PS0000000053'),
(4, 'PS0000000054'),
(4, 'PS0000000055'),
(4, 'PS0000000056'),
(4, 'PS0000000057'),
(4, 'PS0000000058'),
(4, 'PS0000000059'),
(4, 'PS0000000060'),
(4, 'PS0000000061'),
(4, 'PS0000000062'),
(4, 'PS0000000063'),
(4, 'PS0000000064'),
(4, 'PS0000000065'),
(4, 'PS0000000066'),
(4, 'PS0000000067'),
(4, 'PS0000000068'),
(4, 'PS0000000069'),
(4, 'PS0000000070'),
(4, 'PS0000000071'),
(4, 'PS0000000072'),
(4, 'PS0000000073'),
(4, 'PS0000000074'),
(4, 'PS0000000075'),
(4, 'PS0000000076'),
(4, 'PS0000000077'),
(4, 'PS0000000078'),
(4, 'PS0000000079'),
(4, 'PS0000000080'),
(4, 'PS0000000081'),
(4, 'PS0000000082'),
(4, 'PS0000000083'),
(4, 'PS0000000084'),
(4, 'PS0000000085'),
(4, 'PS0000000086');

-- --------------------------------------------------------

--
-- Table structure for table `emp_institusi`
--

CREATE TABLE IF NOT EXISTS `emp_institusi` (
  `id_institusi` int(11) NOT NULL,
  `id_personal` varchar(12) NOT NULL,
  PRIMARY KEY (`id_institusi`,`id_personal`),
  KEY `fk_institusi_hs_institusi_id` (`id_institusi`),
  KEY `fk_personal_has_personal_id` (`id_personal`),
  KEY `fk_institusi_id_institusi` (`id_institusi`),
  KEY `fk_personal_id_personal2` (`id_personal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_institusi`
--

INSERT INTO `emp_institusi` (`id_institusi`, `id_personal`) VALUES
(2, 'PS0000000001'),
(2, 'PS0000000002'),
(2, 'PS0000000003'),
(2, 'PS0000000004'),
(2, 'PS0000000005'),
(2, 'PS0000000006'),
(2, 'PS0000000007'),
(2, 'PS0000000008'),
(2, 'PS0000000009'),
(2, 'PS0000000010'),
(2, 'PS0000000011'),
(2, 'PS0000000012'),
(2, 'PS0000000013'),
(2, 'PS0000000014'),
(2, 'PS0000000015'),
(2, 'PS0000000016'),
(2, 'PS0000000017'),
(2, 'PS0000000018'),
(2, 'PS0000000019'),
(2, 'PS0000000020'),
(2, 'PS0000000021'),
(2, 'PS0000000022'),
(2, 'PS0000000023'),
(2, 'PS0000000024'),
(2, 'PS0000000025'),
(2, 'PS0000000026'),
(2, 'PS0000000027'),
(2, 'PS0000000028'),
(2, 'PS0000000029'),
(2, 'PS0000000030'),
(2, 'PS0000000031'),
(2, 'PS0000000032'),
(2, 'PS0000000033'),
(2, 'PS0000000034'),
(2, 'PS0000000035'),
(2, 'PS0000000036'),
(2, 'PS0000000037'),
(2, 'PS0000000038'),
(2, 'PS0000000039'),
(2, 'PS0000000040'),
(2, 'PS0000000041'),
(2, 'PS0000000042'),
(2, 'PS0000000043'),
(2, 'PS0000000044'),
(2, 'PS0000000045'),
(2, 'PS0000000046'),
(2, 'PS0000000047'),
(2, 'PS0000000048'),
(2, 'PS0000000049'),
(2, 'PS0000000050'),
(2, 'PS0000000051'),
(2, 'PS0000000052'),
(2, 'PS0000000053'),
(2, 'PS0000000054'),
(2, 'PS0000000055'),
(2, 'PS0000000056'),
(2, 'PS0000000057'),
(2, 'PS0000000058'),
(2, 'PS0000000059'),
(2, 'PS0000000060'),
(2, 'PS0000000061'),
(2, 'PS0000000062'),
(2, 'PS0000000063'),
(2, 'PS0000000064'),
(2, 'PS0000000065'),
(2, 'PS0000000066'),
(2, 'PS0000000067'),
(2, 'PS0000000068'),
(2, 'PS0000000069'),
(2, 'PS0000000070'),
(2, 'PS0000000071'),
(2, 'PS0000000072'),
(2, 'PS0000000073'),
(2, 'PS0000000074'),
(2, 'PS0000000075'),
(2, 'PS0000000076'),
(2, 'PS0000000077'),
(2, 'PS0000000078'),
(2, 'PS0000000079'),
(2, 'PS0000000080'),
(2, 'PS0000000081'),
(2, 'PS0000000082'),
(2, 'PS0000000083'),
(2, 'PS0000000084'),
(2, 'PS0000000085'),
(2, 'PS0000000086');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `id_family` varchar(12) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `telepon` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `kota` varchar(45) DEFAULT NULL,
  `propinsi` int(11) DEFAULT NULL,
  `negara` int(11) DEFAULT NULL,
  `hubungan` varchar(45) DEFAULT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`id_family`),
  KEY `fk_family_personal1` (`personal_id`),
  KEY `fk_negara_id_negara1` (`negara`),
  KEY `fk_propinsi_id_propinsi1` (`propinsi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id_family`, `nama`, `telepon`, `alamat`, `kota`, `propinsi`, `negara`, `hubungan`, `personal_id`) VALUES
('F00000000001', 'darwati', '', 'Cikoranji cigugur', '', 2, 2, 'Ibu', 'PS0000000001'),
('F00000000003', 'Ubik', '', 'dsn. cikoranji RT.03 RW.07 cigugur ciamis', '', 2, 2, 'Ayah', 'PS0000000001'),
('F00000000004', 'Sarjo', '', 'Bandung jawa baat', '', 2, 2, 'Kaka', 'PS0000000001'),
('F00000000005', 'Saepudin', '', 'dsn. cikoranji RT.03 RW.07 cigugur ciamis', '', 2, 2, 'Kaka', 'PS0000000001'),
('F00000000006', 'Dede Nurhidayat', '', 'dsn. cikoranji RT.03 RW.07 cigugur ciamis', '', 2, 2, 'Adik', 'PS0000000001'),
('F00000000007', 'Imam Manarudin', '087817505949', 'Kotawaringin timur, sampit (PT TEGUH SEMPURNA', 'SAMPIT', 12, 2, 'Ayah', 'PS0000000055'),
('F00000000008', 'Tarminah', '081280175865', 'Ds. Wirasaba', 'Purbalingga', 3, 2, 'Ibu', 'PS0000000058'),
('F00000000009', 'Nahdudin', '', 'Jl. Patal Senayan , Senayan Residance D27', 'Jakarta Selatan', 5, 2, 'Ayah', 'PS0000000008'),
('F00000000010', 'Fariha', '', 'Jl. Patal Senayan , Senayan Residance D27', 'Jakarta Selatan', 5, 2, 'Ibu', 'PS0000000008'),
('F00000000011', 'Umiaytul Mubarakah', '', 'SMK Al Karamah', 'Jombang', 4, 2, 'Adik', 'PS0000000008'),
('F00000000012', 'Uzairul Hukmi', '', 'Pondok Pesantren Al Hikmah ,Sirampog', 'Brebes', 5, 2, 'Adik', 'PS0000000008'),
('F00000000013', 'AmeliaOktaviani', '', 'Pondok Pesantren Al Hikmah ,Sirampog', 'Brebes', 3, 2, 'Adik', 'PS0000000008'),
('F00000000015', 'Dewi Muayanah', '0816401230', 'Perumahan Antasari Permai Krakatau IX Blok H ', 'Bandar Lampung', 7, 2, 'Tante', 'PS0000000006'),
('F00000000016', 'Sandra Maretha', '085768441380', 'Jalan Pulau Bacan Gang Jambu No 47 Jagabaya I', 'Bandar Lampung', 7, 2, 'Kakak', 'PS0000000006'),
('F00000000018', 'Faiza Achmad (Nonie)', '081286521555', 'Cipadu elok blok D no 56 KH Wahid Hasyim,Cile', 'tangerang', 8, 2, 'Teman Kantor', 'PS0000000006'),
('F00000000019', 'Abdul Wahid', '', 'Jatimulya', 'Tegal', 3, 2, 'Bapak', 'PS0000000060'),
('F00000000020', 'Agus Setyawan', '085716294985', 'jl.Mawar', 'jakarta', 5, 2, 'Kakak', 'PS0000000060'),
('F00000000021', 'ERIK SUBHAN', '', 'kampung rambutan', 'Jakarata Timur', 5, 2, 'KAKAK', 'PS0000000061');

-- --------------------------------------------------------

--
-- Table structure for table `groupdata`
--

CREATE TABLE IF NOT EXISTS `groupdata` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(100) DEFAULT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  `dibuat_oleh` varchar(12) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `groupdata`
--

INSERT INTO `groupdata` (`id_group`, `nama_group`, `tgl_dibuat`, `dibuat_oleh`, `keterangan`) VALUES
(1, 'Penguna Umum', '2014-10-14', NULL, 'Pengguna Umum'),
(4, 'Admin Keuangan', '2014-10-08', NULL, ''),
(5, 'Superadmin', '2014-10-09', NULL, 'bisa aksess Semua Menu'),
(6, 'admin DM', '2014-10-26', NULL, ''),
(7, 'Admin Pendidikan', '2014-10-26', NULL, ''),
(8, 'Staff  Pengajar', '2014-10-26', NULL, ''),
(9, 'Admin Pendaftaran', '2014-10-30', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `group_menu`
--

CREATE TABLE IF NOT EXISTS `group_menu` (
  `menu_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`group_id`),
  KEY `fk_menu_group_menu_id` (`group_id`),
  KEY `fk_menu_id_group_menu` (`menu_id`),
  KEY `fk_menu_group_id` (`menu_id`),
  KEY `fk_group_id_group_2` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_menu`
--

INSERT INTO `group_menu` (`menu_id`, `group_id`) VALUES
(2, 1),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 1),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 1),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(5, 5),
(5, 6),
(5, 9),
(6, 5),
(6, 6),
(6, 9),
(7, 1),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 8),
(7, 9),
(8, 1),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(9, 1),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 9),
(10, 1),
(10, 4),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(10, 9),
(11, 1),
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(11, 8),
(11, 9),
(12, 5),
(12, 6),
(12, 7),
(13, 5),
(13, 6),
(13, 7),
(14, 5),
(14, 6),
(14, 7),
(15, 5),
(15, 6),
(15, 7),
(16, 5),
(16, 6),
(16, 7),
(17, 5),
(17, 6),
(17, 7),
(17, 8),
(18, 5),
(18, 6),
(18, 7),
(18, 8),
(19, 5),
(19, 6),
(19, 7),
(19, 8),
(20, 1),
(20, 4),
(20, 5),
(20, 6),
(20, 7),
(20, 8),
(20, 9),
(21, 1),
(21, 4),
(21, 5),
(21, 6),
(21, 7),
(21, 8),
(21, 9),
(22, 1),
(22, 4),
(22, 5),
(22, 6),
(22, 7),
(22, 8),
(22, 9),
(23, 1),
(23, 4),
(23, 5),
(23, 6),
(23, 7),
(23, 8),
(23, 9),
(24, 1),
(24, 4),
(24, 5),
(24, 6),
(24, 7),
(24, 8),
(24, 9),
(25, 4),
(25, 5),
(25, 6),
(26, 4),
(26, 5),
(26, 6),
(27, 4),
(27, 5),
(27, 6),
(28, 4),
(28, 5),
(28, 6),
(29, 4),
(29, 5),
(29, 6),
(30, 1),
(30, 4),
(30, 5),
(30, 6),
(30, 7),
(30, 8),
(30, 9),
(31, 1),
(31, 4),
(31, 5),
(31, 6),
(31, 7),
(31, 8),
(31, 9),
(32, 4),
(32, 5),
(32, 6),
(33, 4),
(33, 5),
(33, 6),
(34, 4),
(34, 5),
(34, 6),
(35, 5),
(36, 5),
(36, 6),
(37, 1),
(37, 4),
(37, 5),
(37, 6),
(37, 7),
(37, 8),
(37, 9),
(38, 5),
(38, 6),
(38, 9),
(39, 5),
(39, 6),
(40, 5),
(40, 6),
(40, 9),
(41, 5),
(41, 6),
(41, 9),
(42, 5),
(42, 6),
(42, 9),
(43, 5),
(44, 1),
(44, 4),
(44, 5),
(44, 6),
(44, 7),
(44, 8),
(44, 9),
(45, 1),
(45, 5),
(45, 6),
(45, 9);

-- --------------------------------------------------------

--
-- Table structure for table `group_personal`
--

CREATE TABLE IF NOT EXISTS `group_personal` (
  `group_id` int(11) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`group_id`,`personal_id`),
  KEY `fk_personal_has_group_personal_id` (`personal_id`),
  KEY `fk_group_id_group_personal` (`group_id`),
  KEY `fk_grouppersonal_id` (`group_id`),
  KEY `fk_peronal_id_personal_3` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_personal`
--

INSERT INTO `group_personal` (`group_id`, `personal_id`) VALUES
(1, 'PS0000000001'),
(1, 'PS0000000002'),
(1, 'PS0000000003'),
(1, 'PS0000000004'),
(1, 'PS0000000005'),
(1, 'PS0000000006'),
(1, 'PS0000000007'),
(1, 'PS0000000008'),
(1, 'PS0000000009'),
(1, 'PS0000000010'),
(1, 'PS0000000011'),
(1, 'PS0000000012'),
(1, 'PS0000000013'),
(1, 'PS0000000014'),
(1, 'PS0000000015'),
(1, 'PS0000000016'),
(1, 'PS0000000017'),
(1, 'PS0000000018'),
(1, 'PS0000000019'),
(1, 'PS0000000020'),
(1, 'PS0000000021'),
(1, 'PS0000000022'),
(1, 'PS0000000023'),
(1, 'PS0000000024'),
(1, 'PS0000000025'),
(1, 'PS0000000026'),
(1, 'PS0000000027'),
(1, 'PS0000000028'),
(1, 'PS0000000029'),
(1, 'PS0000000030'),
(1, 'PS0000000031'),
(1, 'PS0000000032'),
(1, 'PS0000000033'),
(1, 'PS0000000034'),
(1, 'PS0000000035'),
(1, 'PS0000000036'),
(1, 'PS0000000037'),
(1, 'PS0000000038'),
(1, 'PS0000000039'),
(1, 'PS0000000040'),
(1, 'PS0000000041'),
(1, 'PS0000000042'),
(1, 'PS0000000043'),
(1, 'PS0000000044'),
(1, 'PS0000000045'),
(1, 'PS0000000046'),
(1, 'PS0000000047'),
(1, 'PS0000000048'),
(1, 'PS0000000049'),
(1, 'PS0000000050'),
(1, 'PS0000000051'),
(1, 'PS0000000052'),
(1, 'PS0000000053'),
(1, 'PS0000000054'),
(1, 'PS0000000055'),
(1, 'PS0000000056'),
(1, 'PS0000000057'),
(1, 'PS0000000058'),
(1, 'PS0000000059'),
(1, 'PS0000000060'),
(1, 'PS0000000061'),
(1, 'PS0000000062'),
(1, 'PS0000000063'),
(1, 'PS0000000064'),
(1, 'PS0000000065'),
(1, 'PS0000000066'),
(1, 'PS0000000067'),
(1, 'PS0000000068'),
(1, 'PS0000000069'),
(1, 'PS0000000070'),
(1, 'PS0000000071'),
(1, 'PS0000000072'),
(1, 'PS0000000073'),
(1, 'PS0000000074'),
(1, 'PS0000000075'),
(1, 'PS0000000076'),
(1, 'PS0000000077'),
(1, 'PS0000000078'),
(1, 'PS0000000079'),
(1, 'PS0000000080'),
(1, 'PS0000000081'),
(1, 'PS0000000082'),
(1, 'PS0000000083'),
(1, 'PS0000000084'),
(1, 'PS0000000085'),
(1, 'PS0000000086'),
(4, 'PS0000000002'),
(5, 'PS0000000001'),
(6, 'PS0000000004'),
(7, 'PS0000000008'),
(7, 'PS0000000013'),
(7, 'PS0000000019'),
(8, 'PS0000000007'),
(8, 'PS0000000008'),
(8, 'PS0000000017'),
(8, 'PS0000000026'),
(9, 'PS0000000001'),
(9, 'PS0000000005'),
(9, 'PS0000000009'),
(9, 'PS0000000012'),
(9, 'PS0000000019');

-- --------------------------------------------------------

--
-- Table structure for table `jadual`
--

CREATE TABLE IF NOT EXISTS `jadual` (
  `id_jadual` varchar(12) NOT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `id_ruangan` varchar(10) NOT NULL,
  `id_pelajaran` varchar(10) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `kelas_id` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_jadual`),
  KEY `fk_jadual_rungan1` (`id_ruangan`),
  KEY `fk_jadual_pelajaran1` (`id_pelajaran`),
  KEY `fk_kelas_id_keals` (`kelas_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadual`
--

INSERT INTO `jadual` (`id_jadual`, `hari`, `jam_mulai`, `jam_selesai`, `id_ruangan`, `id_pelajaran`, `status`, `kelas_id`) VALUES
('JD0000000001', '7', '20:30:00', '22:00:00', 'R000000002', 'PL00000001', NULL, 'KL0000000004'),
('JD0000000002', '1', '04:30:00', '05:15:00', 'R000000002', 'PL00000002', NULL, 'KL0000000004'),
('JD0000000003', '1', '05:15:00', '06:00:00', 'R000000002', 'PL00000003', NULL, 'KL0000000004'),
('JD0000000004', '2', '04:30:00', '05:15:00', 'R000000002', 'PL00000002', NULL, 'KL0000000004'),
('JD0000000005', '2', '05:15:00', '06:00:00', 'R000000002', 'PL00000005', NULL, 'KL0000000004'),
('JD0000000006', '1', '20:30:00', '22:00:00', 'R000000002', 'PL00000004', NULL, 'KL0000000004'),
('JD0000000007', '2', '20:30:00', '22:00:00', 'R000000002', 'PL00000006', NULL, 'KL0000000004'),
('JD0000000008', '3', '04:30:00', '05:15:00', 'R000000002', 'PL00000002', NULL, 'KL0000000004'),
('JD0000000009', '3', '05:15:00', '06:00:00', 'R000000002', 'PL00000007', NULL, 'KL0000000004'),
('JD0000000010', '3', '20:30:00', '22:00:00', 'R000000002', 'PL00000008', NULL, 'KL0000000004'),
('JD0000000011', '4', '04:30:00', '06:00:00', 'R000000002', 'PL00000002', NULL, 'KL0000000004'),
('JD0000000012', '4', '20:30:00', '22:00:00', 'R000000002', 'PL00000009', NULL, 'KL0000000004'),
('JD0000000013', '5', '20:30:00', '22:00:00', 'R000000002', 'PL00000010', NULL, 'KL0000000004'),
('JD0000000014', '6', '04:30:00', '05:15:00', 'R000000002', 'PL00000002', NULL, 'KL0000000004'),
('JD0000000015', '6', '05:15:00', '06:00:00', 'R000000002', 'PL00000011', NULL, 'KL0000000004'),
('JD0000000016', '5', '04:30:00', '06:00:00', 'R000000002', 'PL00000012', NULL, 'KL0000000004');

-- --------------------------------------------------------

--
-- Table structure for table `jadual_pengajar`
--

CREATE TABLE IF NOT EXISTS `jadual_pengajar` (
  `jadual_id` varchar(12) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`jadual_id`,`personal_id`),
  KEY `fk_jadual_id_jadual` (`jadual_id`),
  KEY `fk_personal_id_personal` (`personal_id`),
  KEY `fk_jadual_id_fk1` (`jadual_id`),
  KEY `fk_personal_id_fk1` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadual_pengajar`
--

INSERT INTO `jadual_pengajar` (`jadual_id`, `personal_id`) VALUES
('JD0000000001', 'PS0000000004'),
('JD0000000001', 'PS0000000007'),
('JD0000000001', 'PS0000000012'),
('JD0000000002', 'PS0000000001'),
('JD0000000003', 'PS0000000004'),
('JD0000000003', 'PS0000000007'),
('JD0000000003', 'PS0000000012'),
('JD0000000004', 'PS0000000004'),
('JD0000000004', 'PS0000000007'),
('JD0000000004', 'PS0000000012'),
('JD0000000005', 'PS0000000004'),
('JD0000000005', 'PS0000000007'),
('JD0000000005', 'PS0000000012'),
('JD0000000006', 'PS0000000004'),
('JD0000000006', 'PS0000000007'),
('JD0000000006', 'PS0000000012'),
('JD0000000007', 'PS0000000004'),
('JD0000000007', 'PS0000000007'),
('JD0000000007', 'PS0000000012'),
('JD0000000008', 'PS0000000004'),
('JD0000000008', 'PS0000000007'),
('JD0000000008', 'PS0000000012'),
('JD0000000009', 'PS0000000004'),
('JD0000000009', 'PS0000000007'),
('JD0000000009', 'PS0000000012'),
('JD0000000010', 'PS0000000004'),
('JD0000000010', 'PS0000000007'),
('JD0000000010', 'PS0000000012'),
('JD0000000011', 'PS0000000004'),
('JD0000000011', 'PS0000000007'),
('JD0000000011', 'PS0000000012'),
('JD0000000012', 'PS0000000004'),
('JD0000000012', 'PS0000000007'),
('JD0000000012', 'PS0000000012'),
('JD0000000013', 'PS0000000004'),
('JD0000000013', 'PS0000000007'),
('JD0000000013', 'PS0000000012'),
('JD0000000014', 'PS0000000004'),
('JD0000000014', 'PS0000000007'),
('JD0000000014', 'PS0000000012'),
('JD0000000015', 'PS0000000004'),
('JD0000000015', 'PS0000000007'),
('JD0000000015', 'PS0000000012'),
('JD0000000016', 'PS0000000004'),
('JD0000000016', 'PS0000000007'),
('JD0000000016', 'PS0000000012');

-- --------------------------------------------------------

--
-- Table structure for table `jadual_personal`
--

CREATE TABLE IF NOT EXISTS `jadual_personal` (
  `personal_id` varchar(12) NOT NULL,
  `id_jadual` varchar(12) NOT NULL,
  `jumlah` varchar(45) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`personal_id`,`id_jadual`),
  KEY `fk_personal_has_jadual_jadual1` (`id_jadual`),
  KEY `fk_personal_has_jadual_personal1` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadual_personal`
--

INSERT INTO `jadual_personal` (`personal_id`, `id_jadual`, `jumlah`, `status`) VALUES
('PS0000000001', 'JD0000000001', NULL, '0'),
('PS0000000001', 'JD0000000003', NULL, '0'),
('PS0000000001', 'JD0000000004', NULL, '0'),
('PS0000000001', 'JD0000000005', NULL, '0'),
('PS0000000001', 'JD0000000006', NULL, '0'),
('PS0000000001', 'JD0000000008', NULL, '0'),
('PS0000000001', 'JD0000000009', NULL, '0'),
('PS0000000001', 'JD0000000010', NULL, '0'),
('PS0000000001', 'JD0000000011', NULL, '0'),
('PS0000000001', 'JD0000000012', NULL, '0'),
('PS0000000001', 'JD0000000013', NULL, '0'),
('PS0000000001', 'JD0000000014', NULL, '0'),
('PS0000000001', 'JD0000000015', NULL, '0'),
('PS0000000001', 'JD0000000016', NULL, '0'),
('PS0000000002', 'JD0000000001', NULL, '0'),
('PS0000000002', 'JD0000000003', NULL, '0'),
('PS0000000002', 'JD0000000004', NULL, '0'),
('PS0000000002', 'JD0000000005', NULL, '0'),
('PS0000000002', 'JD0000000006', NULL, '0'),
('PS0000000002', 'JD0000000007', NULL, '0'),
('PS0000000002', 'JD0000000008', NULL, '0'),
('PS0000000002', 'JD0000000009', NULL, '0'),
('PS0000000002', 'JD0000000010', NULL, '0'),
('PS0000000002', 'JD0000000011', NULL, '0'),
('PS0000000002', 'JD0000000012', NULL, '0'),
('PS0000000002', 'JD0000000013', NULL, '0'),
('PS0000000002', 'JD0000000014', NULL, '0'),
('PS0000000002', 'JD0000000015', NULL, '0'),
('PS0000000002', 'JD0000000016', NULL, '0'),
('PS0000000003', 'JD0000000001', NULL, '0'),
('PS0000000003', 'JD0000000003', NULL, '0'),
('PS0000000003', 'JD0000000004', NULL, '0'),
('PS0000000003', 'JD0000000005', NULL, '0'),
('PS0000000003', 'JD0000000006', NULL, '0'),
('PS0000000003', 'JD0000000007', NULL, '0'),
('PS0000000003', 'JD0000000008', NULL, '0'),
('PS0000000003', 'JD0000000009', NULL, '0'),
('PS0000000003', 'JD0000000010', NULL, '0'),
('PS0000000003', 'JD0000000011', NULL, '0'),
('PS0000000003', 'JD0000000012', NULL, '0'),
('PS0000000003', 'JD0000000013', NULL, '0'),
('PS0000000003', 'JD0000000014', NULL, '0'),
('PS0000000003', 'JD0000000015', NULL, '0'),
('PS0000000003', 'JD0000000016', NULL, '0'),
('PS0000000005', 'JD0000000001', NULL, '0'),
('PS0000000005', 'JD0000000003', NULL, '0'),
('PS0000000005', 'JD0000000004', NULL, '0'),
('PS0000000005', 'JD0000000005', NULL, '0'),
('PS0000000005', 'JD0000000006', NULL, '0'),
('PS0000000005', 'JD0000000007', NULL, '0'),
('PS0000000005', 'JD0000000008', NULL, '0'),
('PS0000000005', 'JD0000000009', NULL, '0'),
('PS0000000005', 'JD0000000010', NULL, '0'),
('PS0000000005', 'JD0000000011', NULL, '0'),
('PS0000000005', 'JD0000000012', NULL, '0'),
('PS0000000005', 'JD0000000013', NULL, '0'),
('PS0000000005', 'JD0000000014', NULL, '0'),
('PS0000000005', 'JD0000000015', NULL, '0'),
('PS0000000005', 'JD0000000016', NULL, '0'),
('PS0000000006', 'JD0000000001', NULL, '0'),
('PS0000000006', 'JD0000000003', NULL, '0'),
('PS0000000006', 'JD0000000004', NULL, '0'),
('PS0000000006', 'JD0000000005', NULL, '0'),
('PS0000000006', 'JD0000000006', NULL, '0'),
('PS0000000006', 'JD0000000007', NULL, '0'),
('PS0000000006', 'JD0000000008', NULL, '0'),
('PS0000000006', 'JD0000000009', NULL, '0'),
('PS0000000006', 'JD0000000010', NULL, '0'),
('PS0000000006', 'JD0000000011', NULL, '0'),
('PS0000000006', 'JD0000000012', NULL, '0'),
('PS0000000006', 'JD0000000013', NULL, '0'),
('PS0000000006', 'JD0000000014', NULL, '0'),
('PS0000000006', 'JD0000000015', NULL, '0'),
('PS0000000006', 'JD0000000016', NULL, '0'),
('PS0000000007', 'JD0000000001', NULL, '0'),
('PS0000000007', 'JD0000000003', NULL, '0'),
('PS0000000007', 'JD0000000004', NULL, '0'),
('PS0000000007', 'JD0000000005', NULL, '0'),
('PS0000000007', 'JD0000000006', NULL, '0'),
('PS0000000007', 'JD0000000007', NULL, '0'),
('PS0000000007', 'JD0000000008', NULL, '0'),
('PS0000000007', 'JD0000000009', NULL, '0'),
('PS0000000007', 'JD0000000010', NULL, '0'),
('PS0000000007', 'JD0000000011', NULL, '0'),
('PS0000000007', 'JD0000000012', NULL, '0'),
('PS0000000007', 'JD0000000013', NULL, '0'),
('PS0000000007', 'JD0000000014', NULL, '0'),
('PS0000000007', 'JD0000000015', NULL, '0'),
('PS0000000007', 'JD0000000016', NULL, '0'),
('PS0000000008', 'JD0000000001', NULL, '0'),
('PS0000000008', 'JD0000000003', NULL, '0'),
('PS0000000008', 'JD0000000004', NULL, '0'),
('PS0000000008', 'JD0000000005', NULL, '0'),
('PS0000000008', 'JD0000000006', NULL, '0'),
('PS0000000008', 'JD0000000007', NULL, '0'),
('PS0000000008', 'JD0000000008', NULL, '0'),
('PS0000000008', 'JD0000000009', NULL, '0'),
('PS0000000008', 'JD0000000010', NULL, '0'),
('PS0000000008', 'JD0000000011', NULL, '0'),
('PS0000000008', 'JD0000000012', NULL, '0'),
('PS0000000008', 'JD0000000013', NULL, '0'),
('PS0000000008', 'JD0000000014', NULL, '0'),
('PS0000000008', 'JD0000000015', NULL, '0'),
('PS0000000008', 'JD0000000016', NULL, '0'),
('PS0000000009', 'JD0000000001', NULL, '0'),
('PS0000000009', 'JD0000000003', NULL, '0'),
('PS0000000009', 'JD0000000004', NULL, '0'),
('PS0000000009', 'JD0000000005', NULL, '0'),
('PS0000000009', 'JD0000000006', NULL, '0'),
('PS0000000009', 'JD0000000007', NULL, '0'),
('PS0000000009', 'JD0000000008', NULL, '0'),
('PS0000000009', 'JD0000000009', NULL, '0'),
('PS0000000009', 'JD0000000010', NULL, '0'),
('PS0000000009', 'JD0000000011', NULL, '0'),
('PS0000000009', 'JD0000000012', NULL, '0'),
('PS0000000009', 'JD0000000013', NULL, '0'),
('PS0000000009', 'JD0000000014', NULL, '0'),
('PS0000000009', 'JD0000000015', NULL, '0'),
('PS0000000009', 'JD0000000016', NULL, '0'),
('PS0000000010', 'JD0000000001', NULL, '0'),
('PS0000000010', 'JD0000000003', NULL, '0'),
('PS0000000010', 'JD0000000004', NULL, '0'),
('PS0000000010', 'JD0000000005', NULL, '0'),
('PS0000000010', 'JD0000000006', NULL, '0'),
('PS0000000010', 'JD0000000007', NULL, '0'),
('PS0000000010', 'JD0000000008', NULL, '0'),
('PS0000000010', 'JD0000000009', NULL, '0'),
('PS0000000010', 'JD0000000010', NULL, '0'),
('PS0000000010', 'JD0000000011', NULL, '0'),
('PS0000000010', 'JD0000000012', NULL, '0'),
('PS0000000010', 'JD0000000013', NULL, '0'),
('PS0000000010', 'JD0000000014', NULL, '0'),
('PS0000000010', 'JD0000000015', NULL, '0'),
('PS0000000010', 'JD0000000016', NULL, '0'),
('PS0000000011', 'JD0000000001', NULL, '0'),
('PS0000000011', 'JD0000000003', NULL, '0'),
('PS0000000011', 'JD0000000004', NULL, '0'),
('PS0000000011', 'JD0000000005', NULL, '0'),
('PS0000000011', 'JD0000000006', NULL, '0'),
('PS0000000011', 'JD0000000007', NULL, '0'),
('PS0000000011', 'JD0000000008', NULL, '0'),
('PS0000000011', 'JD0000000009', NULL, '0'),
('PS0000000011', 'JD0000000010', NULL, '0'),
('PS0000000011', 'JD0000000011', NULL, '0'),
('PS0000000011', 'JD0000000012', NULL, '0'),
('PS0000000011', 'JD0000000013', NULL, '0'),
('PS0000000011', 'JD0000000014', NULL, '0'),
('PS0000000011', 'JD0000000015', NULL, '0'),
('PS0000000011', 'JD0000000016', NULL, '0'),
('PS0000000012', 'JD0000000001', NULL, '0'),
('PS0000000012', 'JD0000000003', NULL, '0'),
('PS0000000012', 'JD0000000004', NULL, '0'),
('PS0000000012', 'JD0000000005', NULL, '0'),
('PS0000000012', 'JD0000000006', NULL, '0'),
('PS0000000012', 'JD0000000007', NULL, '0'),
('PS0000000012', 'JD0000000008', NULL, '0'),
('PS0000000012', 'JD0000000009', NULL, '0'),
('PS0000000012', 'JD0000000010', NULL, '0'),
('PS0000000012', 'JD0000000011', NULL, '0'),
('PS0000000012', 'JD0000000012', NULL, '0'),
('PS0000000012', 'JD0000000013', NULL, '0'),
('PS0000000012', 'JD0000000014', NULL, '0'),
('PS0000000012', 'JD0000000015', NULL, '0'),
('PS0000000012', 'JD0000000016', NULL, '0'),
('PS0000000013', 'JD0000000001', NULL, '0'),
('PS0000000013', 'JD0000000003', NULL, '0'),
('PS0000000013', 'JD0000000004', NULL, '0'),
('PS0000000013', 'JD0000000005', NULL, '0'),
('PS0000000013', 'JD0000000006', NULL, '0'),
('PS0000000013', 'JD0000000007', NULL, '0'),
('PS0000000013', 'JD0000000008', NULL, '0'),
('PS0000000013', 'JD0000000009', NULL, '0'),
('PS0000000013', 'JD0000000010', NULL, '0'),
('PS0000000013', 'JD0000000011', NULL, '0'),
('PS0000000013', 'JD0000000012', NULL, '0'),
('PS0000000013', 'JD0000000013', NULL, '0'),
('PS0000000013', 'JD0000000014', NULL, '0'),
('PS0000000013', 'JD0000000015', NULL, '0'),
('PS0000000013', 'JD0000000016', NULL, '0'),
('PS0000000016', 'JD0000000001', NULL, '0'),
('PS0000000016', 'JD0000000003', NULL, '0'),
('PS0000000016', 'JD0000000004', NULL, '0'),
('PS0000000016', 'JD0000000005', NULL, '0'),
('PS0000000016', 'JD0000000006', NULL, '0'),
('PS0000000016', 'JD0000000007', NULL, '0'),
('PS0000000016', 'JD0000000008', NULL, '0'),
('PS0000000016', 'JD0000000009', NULL, '0'),
('PS0000000016', 'JD0000000010', NULL, '0'),
('PS0000000016', 'JD0000000011', NULL, '0'),
('PS0000000016', 'JD0000000012', NULL, '0'),
('PS0000000016', 'JD0000000013', NULL, '0'),
('PS0000000016', 'JD0000000014', NULL, '0'),
('PS0000000016', 'JD0000000015', NULL, '0'),
('PS0000000016', 'JD0000000016', NULL, '0'),
('PS0000000017', 'JD0000000001', NULL, '0'),
('PS0000000017', 'JD0000000003', NULL, '0'),
('PS0000000017', 'JD0000000004', NULL, '0'),
('PS0000000017', 'JD0000000005', NULL, '0'),
('PS0000000017', 'JD0000000006', NULL, '0'),
('PS0000000017', 'JD0000000007', NULL, '0'),
('PS0000000017', 'JD0000000008', NULL, '0'),
('PS0000000017', 'JD0000000009', NULL, '0'),
('PS0000000017', 'JD0000000010', NULL, '0'),
('PS0000000017', 'JD0000000011', NULL, '0'),
('PS0000000017', 'JD0000000012', NULL, '0'),
('PS0000000017', 'JD0000000013', NULL, '0'),
('PS0000000017', 'JD0000000014', NULL, '0'),
('PS0000000017', 'JD0000000015', NULL, '0'),
('PS0000000017', 'JD0000000016', NULL, '0'),
('PS0000000018', 'JD0000000001', NULL, '0'),
('PS0000000018', 'JD0000000003', NULL, '0'),
('PS0000000018', 'JD0000000004', NULL, '0'),
('PS0000000018', 'JD0000000005', NULL, '0'),
('PS0000000018', 'JD0000000006', NULL, '0'),
('PS0000000018', 'JD0000000007', NULL, '0'),
('PS0000000018', 'JD0000000008', NULL, '0'),
('PS0000000018', 'JD0000000009', NULL, '0'),
('PS0000000018', 'JD0000000010', NULL, '0'),
('PS0000000018', 'JD0000000011', NULL, '0'),
('PS0000000018', 'JD0000000012', NULL, '0'),
('PS0000000018', 'JD0000000013', NULL, '0'),
('PS0000000018', 'JD0000000014', NULL, '0'),
('PS0000000018', 'JD0000000015', NULL, '0'),
('PS0000000018', 'JD0000000016', NULL, '0'),
('PS0000000019', 'JD0000000001', NULL, '0'),
('PS0000000019', 'JD0000000003', NULL, '0'),
('PS0000000019', 'JD0000000004', NULL, '0'),
('PS0000000019', 'JD0000000005', NULL, '0'),
('PS0000000019', 'JD0000000006', NULL, '0'),
('PS0000000019', 'JD0000000007', NULL, '0'),
('PS0000000019', 'JD0000000008', NULL, '0'),
('PS0000000019', 'JD0000000009', NULL, '0'),
('PS0000000019', 'JD0000000010', NULL, '0'),
('PS0000000019', 'JD0000000011', NULL, '0'),
('PS0000000019', 'JD0000000012', NULL, '0'),
('PS0000000019', 'JD0000000013', NULL, '0'),
('PS0000000019', 'JD0000000014', NULL, '0'),
('PS0000000019', 'JD0000000015', NULL, '0'),
('PS0000000019', 'JD0000000016', NULL, '0'),
('PS0000000020', 'JD0000000001', NULL, '0'),
('PS0000000020', 'JD0000000003', NULL, '0'),
('PS0000000020', 'JD0000000004', NULL, '0'),
('PS0000000020', 'JD0000000005', NULL, '0'),
('PS0000000020', 'JD0000000006', NULL, '0'),
('PS0000000020', 'JD0000000007', NULL, '0'),
('PS0000000020', 'JD0000000008', NULL, '0'),
('PS0000000020', 'JD0000000009', NULL, '0'),
('PS0000000020', 'JD0000000010', NULL, '0'),
('PS0000000020', 'JD0000000011', NULL, '0'),
('PS0000000020', 'JD0000000012', NULL, '0'),
('PS0000000020', 'JD0000000013', NULL, '0'),
('PS0000000020', 'JD0000000014', NULL, '0'),
('PS0000000020', 'JD0000000015', NULL, '0'),
('PS0000000020', 'JD0000000016', NULL, '0'),
('PS0000000021', 'JD0000000001', NULL, '0'),
('PS0000000021', 'JD0000000003', NULL, '0'),
('PS0000000021', 'JD0000000004', NULL, '0'),
('PS0000000021', 'JD0000000005', NULL, '0'),
('PS0000000021', 'JD0000000006', NULL, '0'),
('PS0000000021', 'JD0000000007', NULL, '0'),
('PS0000000021', 'JD0000000008', NULL, '0'),
('PS0000000021', 'JD0000000009', NULL, '0'),
('PS0000000021', 'JD0000000010', NULL, '0'),
('PS0000000021', 'JD0000000011', NULL, '0'),
('PS0000000021', 'JD0000000012', NULL, '0'),
('PS0000000021', 'JD0000000013', NULL, '0'),
('PS0000000021', 'JD0000000014', NULL, '0'),
('PS0000000021', 'JD0000000015', NULL, '0'),
('PS0000000021', 'JD0000000016', NULL, '0'),
('PS0000000022', 'JD0000000001', NULL, '0'),
('PS0000000022', 'JD0000000003', NULL, '0'),
('PS0000000022', 'JD0000000004', NULL, '0'),
('PS0000000022', 'JD0000000005', NULL, '0'),
('PS0000000022', 'JD0000000006', NULL, '0'),
('PS0000000022', 'JD0000000007', NULL, '0'),
('PS0000000022', 'JD0000000008', NULL, '0'),
('PS0000000022', 'JD0000000009', NULL, '0'),
('PS0000000022', 'JD0000000010', NULL, '0'),
('PS0000000022', 'JD0000000011', NULL, '0'),
('PS0000000022', 'JD0000000012', NULL, '0'),
('PS0000000022', 'JD0000000013', NULL, '0'),
('PS0000000022', 'JD0000000014', NULL, '0'),
('PS0000000022', 'JD0000000015', NULL, '0'),
('PS0000000022', 'JD0000000016', NULL, '0'),
('PS0000000023', 'JD0000000001', NULL, '0'),
('PS0000000023', 'JD0000000003', NULL, '0'),
('PS0000000023', 'JD0000000004', NULL, '0'),
('PS0000000023', 'JD0000000005', NULL, '0'),
('PS0000000023', 'JD0000000006', NULL, '0'),
('PS0000000023', 'JD0000000007', NULL, '0'),
('PS0000000023', 'JD0000000008', NULL, '0'),
('PS0000000023', 'JD0000000009', NULL, '0'),
('PS0000000023', 'JD0000000010', NULL, '0'),
('PS0000000023', 'JD0000000011', NULL, '0'),
('PS0000000023', 'JD0000000012', NULL, '0'),
('PS0000000023', 'JD0000000013', NULL, '0'),
('PS0000000023', 'JD0000000014', NULL, '0'),
('PS0000000023', 'JD0000000015', NULL, '0'),
('PS0000000023', 'JD0000000016', NULL, '0'),
('PS0000000024', 'JD0000000001', NULL, '0'),
('PS0000000024', 'JD0000000003', NULL, '0'),
('PS0000000024', 'JD0000000004', NULL, '0'),
('PS0000000024', 'JD0000000005', NULL, '0'),
('PS0000000024', 'JD0000000006', NULL, '0'),
('PS0000000024', 'JD0000000007', NULL, '0'),
('PS0000000024', 'JD0000000008', NULL, '0'),
('PS0000000024', 'JD0000000009', NULL, '0'),
('PS0000000024', 'JD0000000010', NULL, '0'),
('PS0000000024', 'JD0000000011', NULL, '0'),
('PS0000000024', 'JD0000000012', NULL, '0'),
('PS0000000024', 'JD0000000013', NULL, '0'),
('PS0000000024', 'JD0000000014', NULL, '0'),
('PS0000000024', 'JD0000000015', NULL, '0'),
('PS0000000024', 'JD0000000016', NULL, '0'),
('PS0000000026', 'JD0000000001', NULL, '0'),
('PS0000000026', 'JD0000000003', NULL, '0'),
('PS0000000026', 'JD0000000004', NULL, '0'),
('PS0000000026', 'JD0000000005', NULL, '0'),
('PS0000000026', 'JD0000000006', NULL, '0'),
('PS0000000026', 'JD0000000007', NULL, '0'),
('PS0000000026', 'JD0000000008', NULL, '0'),
('PS0000000026', 'JD0000000009', NULL, '0'),
('PS0000000026', 'JD0000000010', NULL, '0'),
('PS0000000026', 'JD0000000011', NULL, '0'),
('PS0000000026', 'JD0000000012', NULL, '0'),
('PS0000000026', 'JD0000000013', NULL, '0'),
('PS0000000026', 'JD0000000014', NULL, '0'),
('PS0000000026', 'JD0000000015', NULL, '0'),
('PS0000000026', 'JD0000000016', NULL, '0'),
('PS0000000027', 'JD0000000001', NULL, '0'),
('PS0000000027', 'JD0000000003', NULL, '0'),
('PS0000000027', 'JD0000000004', NULL, '0'),
('PS0000000027', 'JD0000000005', NULL, '0'),
('PS0000000027', 'JD0000000006', NULL, '0'),
('PS0000000027', 'JD0000000007', NULL, '0'),
('PS0000000027', 'JD0000000008', NULL, '0'),
('PS0000000027', 'JD0000000009', NULL, '0'),
('PS0000000027', 'JD0000000010', NULL, '0'),
('PS0000000027', 'JD0000000011', NULL, '0'),
('PS0000000027', 'JD0000000012', NULL, '0'),
('PS0000000027', 'JD0000000013', NULL, '0'),
('PS0000000027', 'JD0000000014', NULL, '0'),
('PS0000000027', 'JD0000000015', NULL, '0'),
('PS0000000027', 'JD0000000016', NULL, '0'),
('PS0000000028', 'JD0000000001', NULL, '0'),
('PS0000000028', 'JD0000000003', NULL, '0'),
('PS0000000028', 'JD0000000004', NULL, '0'),
('PS0000000028', 'JD0000000005', NULL, '0'),
('PS0000000028', 'JD0000000006', NULL, '0'),
('PS0000000028', 'JD0000000007', NULL, '0'),
('PS0000000028', 'JD0000000008', NULL, '0'),
('PS0000000028', 'JD0000000009', NULL, '0'),
('PS0000000028', 'JD0000000010', NULL, '0'),
('PS0000000028', 'JD0000000011', NULL, '0'),
('PS0000000028', 'JD0000000012', NULL, '0'),
('PS0000000028', 'JD0000000013', NULL, '0'),
('PS0000000028', 'JD0000000014', NULL, '0'),
('PS0000000028', 'JD0000000015', NULL, '0'),
('PS0000000028', 'JD0000000016', NULL, '0'),
('PS0000000029', 'JD0000000001', NULL, '0'),
('PS0000000029', 'JD0000000003', NULL, '0'),
('PS0000000029', 'JD0000000004', NULL, '0'),
('PS0000000029', 'JD0000000005', NULL, '0'),
('PS0000000029', 'JD0000000006', NULL, '0'),
('PS0000000029', 'JD0000000007', NULL, '0'),
('PS0000000029', 'JD0000000008', NULL, '0'),
('PS0000000029', 'JD0000000009', NULL, '0'),
('PS0000000029', 'JD0000000010', NULL, '0'),
('PS0000000029', 'JD0000000011', NULL, '0'),
('PS0000000029', 'JD0000000012', NULL, '0'),
('PS0000000029', 'JD0000000013', NULL, '0'),
('PS0000000029', 'JD0000000014', NULL, '0'),
('PS0000000029', 'JD0000000015', NULL, '0'),
('PS0000000029', 'JD0000000016', NULL, '0'),
('PS0000000030', 'JD0000000001', NULL, '0'),
('PS0000000030', 'JD0000000003', NULL, '0'),
('PS0000000030', 'JD0000000004', NULL, '0'),
('PS0000000030', 'JD0000000005', NULL, '0'),
('PS0000000030', 'JD0000000006', NULL, '0'),
('PS0000000030', 'JD0000000007', NULL, '0'),
('PS0000000030', 'JD0000000008', NULL, '0'),
('PS0000000030', 'JD0000000009', NULL, '0'),
('PS0000000030', 'JD0000000010', NULL, '0'),
('PS0000000030', 'JD0000000011', NULL, '0'),
('PS0000000030', 'JD0000000012', NULL, '0'),
('PS0000000030', 'JD0000000013', NULL, '0'),
('PS0000000030', 'JD0000000014', NULL, '0'),
('PS0000000030', 'JD0000000015', NULL, '0'),
('PS0000000030', 'JD0000000016', NULL, '0'),
('PS0000000031', 'JD0000000001', NULL, '0'),
('PS0000000031', 'JD0000000003', NULL, '0'),
('PS0000000031', 'JD0000000004', NULL, '0'),
('PS0000000031', 'JD0000000005', NULL, '0'),
('PS0000000031', 'JD0000000006', NULL, '0'),
('PS0000000031', 'JD0000000007', NULL, '0'),
('PS0000000031', 'JD0000000008', NULL, '0'),
('PS0000000031', 'JD0000000009', NULL, '0'),
('PS0000000031', 'JD0000000010', NULL, '0'),
('PS0000000031', 'JD0000000011', NULL, '0'),
('PS0000000031', 'JD0000000012', NULL, '0'),
('PS0000000031', 'JD0000000013', NULL, '0'),
('PS0000000031', 'JD0000000014', NULL, '0'),
('PS0000000031', 'JD0000000015', NULL, '0'),
('PS0000000031', 'JD0000000016', NULL, '0'),
('PS0000000032', 'JD0000000001', NULL, '0'),
('PS0000000032', 'JD0000000003', NULL, '0'),
('PS0000000032', 'JD0000000004', NULL, '0'),
('PS0000000032', 'JD0000000005', NULL, '0'),
('PS0000000032', 'JD0000000006', NULL, '0'),
('PS0000000032', 'JD0000000007', NULL, '0'),
('PS0000000032', 'JD0000000008', NULL, '0'),
('PS0000000032', 'JD0000000009', NULL, '0'),
('PS0000000032', 'JD0000000010', NULL, '0'),
('PS0000000032', 'JD0000000011', NULL, '0'),
('PS0000000032', 'JD0000000012', NULL, '0'),
('PS0000000032', 'JD0000000013', NULL, '0'),
('PS0000000032', 'JD0000000014', NULL, '0'),
('PS0000000032', 'JD0000000015', NULL, '0'),
('PS0000000032', 'JD0000000016', NULL, '0'),
('PS0000000033', 'JD0000000001', NULL, '0'),
('PS0000000033', 'JD0000000003', NULL, '0'),
('PS0000000033', 'JD0000000004', NULL, '0'),
('PS0000000033', 'JD0000000005', NULL, '0'),
('PS0000000033', 'JD0000000006', NULL, '0'),
('PS0000000033', 'JD0000000007', NULL, '0'),
('PS0000000033', 'JD0000000008', NULL, '0'),
('PS0000000033', 'JD0000000009', NULL, '0'),
('PS0000000033', 'JD0000000010', NULL, '0'),
('PS0000000033', 'JD0000000011', NULL, '0'),
('PS0000000033', 'JD0000000012', NULL, '0'),
('PS0000000033', 'JD0000000013', NULL, '0'),
('PS0000000033', 'JD0000000014', NULL, '0'),
('PS0000000033', 'JD0000000015', NULL, '0'),
('PS0000000033', 'JD0000000016', NULL, '0'),
('PS0000000034', 'JD0000000001', NULL, '0'),
('PS0000000034', 'JD0000000003', NULL, '0'),
('PS0000000034', 'JD0000000004', NULL, '0'),
('PS0000000034', 'JD0000000005', NULL, '0'),
('PS0000000034', 'JD0000000006', NULL, '0'),
('PS0000000034', 'JD0000000007', NULL, '0'),
('PS0000000034', 'JD0000000008', NULL, '0'),
('PS0000000034', 'JD0000000009', NULL, '0'),
('PS0000000034', 'JD0000000010', NULL, '0'),
('PS0000000034', 'JD0000000011', NULL, '0'),
('PS0000000034', 'JD0000000012', NULL, '0'),
('PS0000000034', 'JD0000000013', NULL, '0'),
('PS0000000034', 'JD0000000014', NULL, '0'),
('PS0000000034', 'JD0000000015', NULL, '0'),
('PS0000000034', 'JD0000000016', NULL, '0'),
('PS0000000037', 'JD0000000001', NULL, '0'),
('PS0000000037', 'JD0000000003', NULL, '0'),
('PS0000000037', 'JD0000000004', NULL, '0'),
('PS0000000037', 'JD0000000005', NULL, '0'),
('PS0000000037', 'JD0000000006', NULL, '0'),
('PS0000000037', 'JD0000000007', NULL, '0'),
('PS0000000037', 'JD0000000008', NULL, '0'),
('PS0000000037', 'JD0000000009', NULL, '0'),
('PS0000000037', 'JD0000000010', NULL, '0'),
('PS0000000037', 'JD0000000011', NULL, '0'),
('PS0000000037', 'JD0000000012', NULL, '0'),
('PS0000000037', 'JD0000000013', NULL, '0'),
('PS0000000037', 'JD0000000014', NULL, '0'),
('PS0000000037', 'JD0000000015', NULL, '0'),
('PS0000000037', 'JD0000000016', NULL, '0'),
('PS0000000038', 'JD0000000001', NULL, '0'),
('PS0000000038', 'JD0000000003', NULL, '0'),
('PS0000000038', 'JD0000000004', NULL, '0'),
('PS0000000038', 'JD0000000005', NULL, '0'),
('PS0000000038', 'JD0000000006', NULL, '0'),
('PS0000000038', 'JD0000000007', NULL, '0'),
('PS0000000038', 'JD0000000008', NULL, '0'),
('PS0000000038', 'JD0000000009', NULL, '0'),
('PS0000000038', 'JD0000000010', NULL, '0'),
('PS0000000038', 'JD0000000011', NULL, '0'),
('PS0000000038', 'JD0000000012', NULL, '0'),
('PS0000000038', 'JD0000000013', NULL, '0'),
('PS0000000038', 'JD0000000014', NULL, '0'),
('PS0000000038', 'JD0000000015', NULL, '0'),
('PS0000000038', 'JD0000000016', NULL, '0'),
('PS0000000039', 'JD0000000001', NULL, '0'),
('PS0000000039', 'JD0000000003', NULL, '0'),
('PS0000000039', 'JD0000000004', NULL, '0'),
('PS0000000039', 'JD0000000005', NULL, '0'),
('PS0000000039', 'JD0000000006', NULL, '0'),
('PS0000000039', 'JD0000000007', NULL, '0'),
('PS0000000039', 'JD0000000008', NULL, '0'),
('PS0000000039', 'JD0000000009', NULL, '0'),
('PS0000000039', 'JD0000000010', NULL, '0'),
('PS0000000039', 'JD0000000011', NULL, '0'),
('PS0000000039', 'JD0000000012', NULL, '0'),
('PS0000000039', 'JD0000000013', NULL, '0'),
('PS0000000039', 'JD0000000014', NULL, '0'),
('PS0000000039', 'JD0000000015', NULL, '0'),
('PS0000000039', 'JD0000000016', NULL, '0'),
('PS0000000040', 'JD0000000001', NULL, '0'),
('PS0000000040', 'JD0000000003', NULL, '0'),
('PS0000000040', 'JD0000000004', NULL, '0'),
('PS0000000040', 'JD0000000005', NULL, '0'),
('PS0000000040', 'JD0000000006', NULL, '0'),
('PS0000000040', 'JD0000000007', NULL, '0'),
('PS0000000040', 'JD0000000008', NULL, '0'),
('PS0000000040', 'JD0000000009', NULL, '0'),
('PS0000000040', 'JD0000000010', NULL, '0'),
('PS0000000040', 'JD0000000011', NULL, '0'),
('PS0000000040', 'JD0000000012', NULL, '0'),
('PS0000000040', 'JD0000000013', NULL, '0'),
('PS0000000040', 'JD0000000014', NULL, '0'),
('PS0000000040', 'JD0000000015', NULL, '0'),
('PS0000000040', 'JD0000000016', NULL, '0'),
('PS0000000041', 'JD0000000001', NULL, '0'),
('PS0000000041', 'JD0000000003', NULL, '0'),
('PS0000000041', 'JD0000000004', NULL, '0'),
('PS0000000041', 'JD0000000005', NULL, '0'),
('PS0000000041', 'JD0000000006', NULL, '0'),
('PS0000000041', 'JD0000000007', NULL, '0'),
('PS0000000041', 'JD0000000008', NULL, '0'),
('PS0000000041', 'JD0000000009', NULL, '0'),
('PS0000000041', 'JD0000000010', NULL, '0'),
('PS0000000041', 'JD0000000011', NULL, '0'),
('PS0000000041', 'JD0000000012', NULL, '0'),
('PS0000000041', 'JD0000000013', NULL, '0'),
('PS0000000041', 'JD0000000014', NULL, '0'),
('PS0000000041', 'JD0000000015', NULL, '0'),
('PS0000000041', 'JD0000000016', NULL, '0'),
('PS0000000042', 'JD0000000001', NULL, '0'),
('PS0000000042', 'JD0000000003', NULL, '0'),
('PS0000000042', 'JD0000000004', NULL, '0'),
('PS0000000042', 'JD0000000005', NULL, '0'),
('PS0000000042', 'JD0000000006', NULL, '0'),
('PS0000000042', 'JD0000000007', NULL, '0'),
('PS0000000042', 'JD0000000008', NULL, '0'),
('PS0000000042', 'JD0000000009', NULL, '0'),
('PS0000000042', 'JD0000000010', NULL, '0'),
('PS0000000042', 'JD0000000011', NULL, '0'),
('PS0000000042', 'JD0000000012', NULL, '0'),
('PS0000000042', 'JD0000000013', NULL, '0'),
('PS0000000042', 'JD0000000014', NULL, '0'),
('PS0000000042', 'JD0000000015', NULL, '0'),
('PS0000000042', 'JD0000000016', NULL, '0'),
('PS0000000045', 'JD0000000001', NULL, '0'),
('PS0000000045', 'JD0000000003', NULL, '0'),
('PS0000000045', 'JD0000000004', NULL, '0'),
('PS0000000045', 'JD0000000005', NULL, '0'),
('PS0000000045', 'JD0000000006', NULL, '0'),
('PS0000000045', 'JD0000000007', NULL, '0'),
('PS0000000045', 'JD0000000008', NULL, '0'),
('PS0000000045', 'JD0000000009', NULL, '0'),
('PS0000000045', 'JD0000000010', NULL, '0'),
('PS0000000045', 'JD0000000011', NULL, '0'),
('PS0000000045', 'JD0000000012', NULL, '0'),
('PS0000000045', 'JD0000000013', NULL, '0'),
('PS0000000045', 'JD0000000014', NULL, '0'),
('PS0000000045', 'JD0000000015', NULL, '0'),
('PS0000000045', 'JD0000000016', NULL, '0'),
('PS0000000055', 'JD0000000001', NULL, '0'),
('PS0000000055', 'JD0000000003', NULL, '0'),
('PS0000000055', 'JD0000000004', NULL, '0'),
('PS0000000055', 'JD0000000005', NULL, '0'),
('PS0000000055', 'JD0000000006', NULL, '0'),
('PS0000000055', 'JD0000000007', NULL, '0'),
('PS0000000055', 'JD0000000008', NULL, '0'),
('PS0000000055', 'JD0000000009', NULL, '0'),
('PS0000000055', 'JD0000000010', NULL, '0'),
('PS0000000055', 'JD0000000011', NULL, '0'),
('PS0000000055', 'JD0000000012', NULL, '0'),
('PS0000000055', 'JD0000000013', NULL, '0'),
('PS0000000055', 'JD0000000014', NULL, '0'),
('PS0000000055', 'JD0000000015', NULL, '0'),
('PS0000000055', 'JD0000000016', NULL, '0'),
('PS0000000056', 'JD0000000001', NULL, '0'),
('PS0000000056', 'JD0000000003', NULL, '0'),
('PS0000000056', 'JD0000000004', NULL, '0'),
('PS0000000056', 'JD0000000005', NULL, '0'),
('PS0000000056', 'JD0000000006', NULL, '0'),
('PS0000000056', 'JD0000000007', NULL, '0'),
('PS0000000056', 'JD0000000008', NULL, '0'),
('PS0000000056', 'JD0000000009', NULL, '0'),
('PS0000000056', 'JD0000000010', NULL, '0'),
('PS0000000056', 'JD0000000011', NULL, '0'),
('PS0000000056', 'JD0000000012', NULL, '0'),
('PS0000000056', 'JD0000000013', NULL, '0'),
('PS0000000056', 'JD0000000014', NULL, '0'),
('PS0000000056', 'JD0000000015', NULL, '0'),
('PS0000000056', 'JD0000000016', NULL, '0'),
('PS0000000057', 'JD0000000001', NULL, '0'),
('PS0000000057', 'JD0000000003', NULL, '0'),
('PS0000000057', 'JD0000000004', NULL, '0'),
('PS0000000057', 'JD0000000005', NULL, '0'),
('PS0000000057', 'JD0000000006', NULL, '0'),
('PS0000000057', 'JD0000000007', NULL, '0'),
('PS0000000057', 'JD0000000008', NULL, '0'),
('PS0000000057', 'JD0000000009', NULL, '0'),
('PS0000000057', 'JD0000000010', NULL, '0'),
('PS0000000057', 'JD0000000011', NULL, '0'),
('PS0000000057', 'JD0000000012', NULL, '0'),
('PS0000000057', 'JD0000000013', NULL, '0'),
('PS0000000057', 'JD0000000014', NULL, '0'),
('PS0000000057', 'JD0000000015', NULL, '0'),
('PS0000000057', 'JD0000000016', NULL, '0'),
('PS0000000058', 'JD0000000001', NULL, '0'),
('PS0000000058', 'JD0000000003', NULL, '0'),
('PS0000000058', 'JD0000000004', NULL, '0'),
('PS0000000058', 'JD0000000005', NULL, '0'),
('PS0000000058', 'JD0000000006', NULL, '0'),
('PS0000000058', 'JD0000000007', NULL, '0'),
('PS0000000058', 'JD0000000008', NULL, '0'),
('PS0000000058', 'JD0000000009', NULL, '0'),
('PS0000000058', 'JD0000000010', NULL, '0'),
('PS0000000058', 'JD0000000011', NULL, '0'),
('PS0000000058', 'JD0000000012', NULL, '0'),
('PS0000000058', 'JD0000000013', NULL, '0'),
('PS0000000058', 'JD0000000014', NULL, '0'),
('PS0000000058', 'JD0000000015', NULL, '0'),
('PS0000000058', 'JD0000000016', NULL, '0'),
('PS0000000059', 'JD0000000001', NULL, '0'),
('PS0000000059', 'JD0000000003', NULL, '0'),
('PS0000000059', 'JD0000000004', NULL, '0'),
('PS0000000059', 'JD0000000005', NULL, '0'),
('PS0000000059', 'JD0000000006', NULL, '0'),
('PS0000000059', 'JD0000000007', NULL, '0'),
('PS0000000059', 'JD0000000008', NULL, '0'),
('PS0000000059', 'JD0000000009', NULL, '0'),
('PS0000000059', 'JD0000000010', NULL, '0'),
('PS0000000059', 'JD0000000011', NULL, '0'),
('PS0000000059', 'JD0000000012', NULL, '0'),
('PS0000000059', 'JD0000000013', NULL, '0'),
('PS0000000059', 'JD0000000014', NULL, '0'),
('PS0000000059', 'JD0000000015', NULL, '0'),
('PS0000000059', 'JD0000000016', NULL, '0'),
('PS0000000060', 'JD0000000001', NULL, '0'),
('PS0000000060', 'JD0000000003', NULL, '0'),
('PS0000000060', 'JD0000000004', NULL, '0'),
('PS0000000060', 'JD0000000005', NULL, '0'),
('PS0000000060', 'JD0000000006', NULL, '0'),
('PS0000000060', 'JD0000000007', NULL, '0'),
('PS0000000060', 'JD0000000008', NULL, '0'),
('PS0000000060', 'JD0000000009', NULL, '0'),
('PS0000000060', 'JD0000000010', NULL, '0'),
('PS0000000060', 'JD0000000011', NULL, '0'),
('PS0000000060', 'JD0000000012', NULL, '0'),
('PS0000000060', 'JD0000000013', NULL, '0'),
('PS0000000060', 'JD0000000014', NULL, '0'),
('PS0000000060', 'JD0000000015', NULL, '0'),
('PS0000000060', 'JD0000000016', NULL, '0'),
('PS0000000061', 'JD0000000001', NULL, '0'),
('PS0000000061', 'JD0000000003', NULL, '0'),
('PS0000000061', 'JD0000000004', NULL, '0'),
('PS0000000061', 'JD0000000005', NULL, '0'),
('PS0000000061', 'JD0000000006', NULL, '0'),
('PS0000000061', 'JD0000000007', NULL, '0'),
('PS0000000061', 'JD0000000008', NULL, '0'),
('PS0000000061', 'JD0000000009', NULL, '0'),
('PS0000000061', 'JD0000000010', NULL, '0'),
('PS0000000061', 'JD0000000011', NULL, '0'),
('PS0000000061', 'JD0000000012', NULL, '0'),
('PS0000000061', 'JD0000000013', NULL, '0'),
('PS0000000061', 'JD0000000014', NULL, '0'),
('PS0000000061', 'JD0000000015', NULL, '0'),
('PS0000000061', 'JD0000000016', NULL, '0'),
('PS0000000062', 'JD0000000001', NULL, '0'),
('PS0000000062', 'JD0000000003', NULL, '0'),
('PS0000000062', 'JD0000000004', NULL, '0'),
('PS0000000062', 'JD0000000005', NULL, '0'),
('PS0000000062', 'JD0000000006', NULL, '0'),
('PS0000000062', 'JD0000000007', NULL, '0'),
('PS0000000062', 'JD0000000008', NULL, '0'),
('PS0000000062', 'JD0000000009', NULL, '0'),
('PS0000000062', 'JD0000000010', NULL, '0'),
('PS0000000062', 'JD0000000011', NULL, '0'),
('PS0000000062', 'JD0000000012', NULL, '0'),
('PS0000000062', 'JD0000000013', NULL, '0'),
('PS0000000062', 'JD0000000014', NULL, '0'),
('PS0000000062', 'JD0000000015', NULL, '0'),
('PS0000000062', 'JD0000000016', NULL, '0'),
('PS0000000063', 'JD0000000001', NULL, '0'),
('PS0000000063', 'JD0000000003', NULL, '0'),
('PS0000000063', 'JD0000000004', NULL, '0'),
('PS0000000063', 'JD0000000005', NULL, '0'),
('PS0000000063', 'JD0000000006', NULL, '0'),
('PS0000000063', 'JD0000000007', NULL, '0'),
('PS0000000063', 'JD0000000008', NULL, '0'),
('PS0000000063', 'JD0000000009', NULL, '0'),
('PS0000000063', 'JD0000000010', NULL, '0'),
('PS0000000063', 'JD0000000011', NULL, '0'),
('PS0000000063', 'JD0000000012', NULL, '0'),
('PS0000000063', 'JD0000000013', NULL, '0'),
('PS0000000063', 'JD0000000014', NULL, '0'),
('PS0000000063', 'JD0000000015', NULL, '0'),
('PS0000000063', 'JD0000000016', NULL, '0'),
('PS0000000064', 'JD0000000001', NULL, '0'),
('PS0000000064', 'JD0000000003', NULL, '0'),
('PS0000000064', 'JD0000000004', NULL, '0'),
('PS0000000064', 'JD0000000005', NULL, '0'),
('PS0000000064', 'JD0000000006', NULL, '0'),
('PS0000000064', 'JD0000000007', NULL, '0'),
('PS0000000064', 'JD0000000008', NULL, '0'),
('PS0000000064', 'JD0000000009', NULL, '0'),
('PS0000000064', 'JD0000000010', NULL, '0'),
('PS0000000064', 'JD0000000011', NULL, '0'),
('PS0000000064', 'JD0000000012', NULL, '0'),
('PS0000000064', 'JD0000000013', NULL, '0'),
('PS0000000064', 'JD0000000014', NULL, '0'),
('PS0000000064', 'JD0000000015', NULL, '0'),
('PS0000000064', 'JD0000000016', NULL, '0'),
('PS0000000065', 'JD0000000001', NULL, '0'),
('PS0000000065', 'JD0000000003', NULL, '0'),
('PS0000000065', 'JD0000000004', NULL, '0'),
('PS0000000065', 'JD0000000005', NULL, '0'),
('PS0000000065', 'JD0000000006', NULL, '0'),
('PS0000000065', 'JD0000000007', NULL, '0'),
('PS0000000065', 'JD0000000008', NULL, '0'),
('PS0000000065', 'JD0000000009', NULL, '0'),
('PS0000000065', 'JD0000000010', NULL, '0'),
('PS0000000065', 'JD0000000011', NULL, '0'),
('PS0000000065', 'JD0000000012', NULL, '0'),
('PS0000000065', 'JD0000000013', NULL, '0'),
('PS0000000065', 'JD0000000014', NULL, '0'),
('PS0000000065', 'JD0000000015', NULL, '0'),
('PS0000000065', 'JD0000000016', NULL, '0'),
('PS0000000066', 'JD0000000001', NULL, '0'),
('PS0000000066', 'JD0000000003', NULL, '0'),
('PS0000000066', 'JD0000000004', NULL, '0'),
('PS0000000066', 'JD0000000005', NULL, '0'),
('PS0000000066', 'JD0000000006', NULL, '0'),
('PS0000000066', 'JD0000000007', NULL, '0'),
('PS0000000066', 'JD0000000008', NULL, '0'),
('PS0000000066', 'JD0000000009', NULL, '0'),
('PS0000000066', 'JD0000000010', NULL, '0'),
('PS0000000066', 'JD0000000011', NULL, '0'),
('PS0000000066', 'JD0000000012', NULL, '0'),
('PS0000000066', 'JD0000000013', NULL, '0'),
('PS0000000066', 'JD0000000014', NULL, '0'),
('PS0000000066', 'JD0000000015', NULL, '0'),
('PS0000000066', 'JD0000000016', NULL, '0'),
('PS0000000067', 'JD0000000001', NULL, '0'),
('PS0000000067', 'JD0000000003', NULL, '0'),
('PS0000000067', 'JD0000000004', NULL, '0'),
('PS0000000067', 'JD0000000005', NULL, '0'),
('PS0000000067', 'JD0000000006', NULL, '0'),
('PS0000000067', 'JD0000000007', NULL, '0'),
('PS0000000067', 'JD0000000008', NULL, '0'),
('PS0000000067', 'JD0000000009', NULL, '0'),
('PS0000000067', 'JD0000000010', NULL, '0'),
('PS0000000067', 'JD0000000011', NULL, '0'),
('PS0000000067', 'JD0000000012', NULL, '0'),
('PS0000000067', 'JD0000000013', NULL, '0'),
('PS0000000067', 'JD0000000014', NULL, '0'),
('PS0000000067', 'JD0000000015', NULL, '0'),
('PS0000000067', 'JD0000000016', NULL, '0'),
('PS0000000068', 'JD0000000001', NULL, '0'),
('PS0000000068', 'JD0000000003', NULL, '0'),
('PS0000000068', 'JD0000000004', NULL, '0'),
('PS0000000068', 'JD0000000005', NULL, '0'),
('PS0000000068', 'JD0000000006', NULL, '0'),
('PS0000000068', 'JD0000000007', NULL, '0'),
('PS0000000068', 'JD0000000008', NULL, '0'),
('PS0000000068', 'JD0000000009', NULL, '0'),
('PS0000000068', 'JD0000000010', NULL, '0'),
('PS0000000068', 'JD0000000011', NULL, '0'),
('PS0000000068', 'JD0000000012', NULL, '0'),
('PS0000000068', 'JD0000000013', NULL, '0'),
('PS0000000068', 'JD0000000014', NULL, '0'),
('PS0000000068', 'JD0000000015', NULL, '0'),
('PS0000000068', 'JD0000000016', NULL, '0'),
('PS0000000069', 'JD0000000001', NULL, '0'),
('PS0000000001', 'JD0000000002', NULL, '0'),
('PS0000000069', 'JD0000000003', NULL, '0'),
('PS0000000069', 'JD0000000004', NULL, '0'),
('PS0000000069', 'JD0000000005', NULL, '0'),
('PS0000000069', 'JD0000000006', NULL, '0'),
('PS0000000069', 'JD0000000007', NULL, '0'),
('PS0000000069', 'JD0000000008', NULL, '0'),
('PS0000000069', 'JD0000000009', NULL, '0'),
('PS0000000069', 'JD0000000010', NULL, '0'),
('PS0000000069', 'JD0000000011', NULL, '0'),
('PS0000000069', 'JD0000000012', NULL, '0'),
('PS0000000069', 'JD0000000013', NULL, '0'),
('PS0000000069', 'JD0000000014', NULL, '0'),
('PS0000000069', 'JD0000000015', NULL, '0'),
('PS0000000069', 'JD0000000016', NULL, '0'),
('PS0000000080', 'JD0000000001', NULL, '0'),
('PS0000000002', 'JD0000000002', NULL, '0'),
('PS0000000080', 'JD0000000003', NULL, '0'),
('PS0000000080', 'JD0000000004', NULL, '0'),
('PS0000000080', 'JD0000000005', NULL, '0'),
('PS0000000080', 'JD0000000006', NULL, '0'),
('PS0000000080', 'JD0000000007', NULL, '0'),
('PS0000000080', 'JD0000000008', NULL, '0'),
('PS0000000080', 'JD0000000009', NULL, '0'),
('PS0000000080', 'JD0000000010', NULL, '0'),
('PS0000000080', 'JD0000000011', NULL, '0'),
('PS0000000080', 'JD0000000012', NULL, '0'),
('PS0000000080', 'JD0000000013', NULL, '0'),
('PS0000000080', 'JD0000000014', NULL, '0'),
('PS0000000080', 'JD0000000015', NULL, '0'),
('PS0000000080', 'JD0000000016', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pelajaran`
--

CREATE TABLE IF NOT EXISTS `kategori_pelajaran` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pelajaran`
--

INSERT INTO `kategori_pelajaran` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
('K000000001', 'Kajian Umum', ''),
('K000000002', 'Ibadah Bersama', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` varchar(12) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `keterangan`) VALUES
('KL0000000004', 'Kajian Dewasa', 'Kajian untuk santri dewasa');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_personal`
--

CREATE TABLE IF NOT EXISTS `kelas_personal` (
  `id_kelas` varchar(12) NOT NULL,
  `id_personal` varchar(12) NOT NULL,
  PRIMARY KEY (`id_kelas`,`id_personal`),
  KEY `fk_kelas_id_kelas_fk` (`id_kelas`),
  KEY `fk_personal_has_kelas_personal` (`id_personal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_personal`
--

INSERT INTO `kelas_personal` (`id_kelas`, `id_personal`) VALUES
('KL0000000004', 'PS0000000001'),
('KL0000000004', 'PS0000000002'),
('KL0000000004', 'PS0000000003'),
('KL0000000004', 'PS0000000005'),
('KL0000000004', 'PS0000000006'),
('KL0000000004', 'PS0000000007'),
('KL0000000004', 'PS0000000008'),
('KL0000000004', 'PS0000000009'),
('KL0000000004', 'PS0000000010'),
('KL0000000004', 'PS0000000011'),
('KL0000000004', 'PS0000000012'),
('KL0000000004', 'PS0000000013'),
('KL0000000004', 'PS0000000016'),
('KL0000000004', 'PS0000000017'),
('KL0000000004', 'PS0000000018'),
('KL0000000004', 'PS0000000019'),
('KL0000000004', 'PS0000000020'),
('KL0000000004', 'PS0000000021'),
('KL0000000004', 'PS0000000022'),
('KL0000000004', 'PS0000000023'),
('KL0000000004', 'PS0000000024'),
('KL0000000004', 'PS0000000026'),
('KL0000000004', 'PS0000000027'),
('KL0000000004', 'PS0000000028'),
('KL0000000004', 'PS0000000029'),
('KL0000000004', 'PS0000000030'),
('KL0000000004', 'PS0000000031'),
('KL0000000004', 'PS0000000032'),
('KL0000000004', 'PS0000000033'),
('KL0000000004', 'PS0000000034'),
('KL0000000004', 'PS0000000037'),
('KL0000000004', 'PS0000000038'),
('KL0000000004', 'PS0000000039'),
('KL0000000004', 'PS0000000040'),
('KL0000000004', 'PS0000000041'),
('KL0000000004', 'PS0000000042'),
('KL0000000004', 'PS0000000045'),
('KL0000000004', 'PS0000000055'),
('KL0000000004', 'PS0000000056'),
('KL0000000004', 'PS0000000057'),
('KL0000000004', 'PS0000000058'),
('KL0000000004', 'PS0000000059'),
('KL0000000004', 'PS0000000060'),
('KL0000000004', 'PS0000000061'),
('KL0000000004', 'PS0000000062'),
('KL0000000004', 'PS0000000063'),
('KL0000000004', 'PS0000000064'),
('KL0000000004', 'PS0000000065'),
('KL0000000004', 'PS0000000066'),
('KL0000000004', 'PS0000000067'),
('KL0000000004', 'PS0000000068'),
('KL0000000004', 'PS0000000069'),
('KL0000000004', 'PS0000000080');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_kas`
--

CREATE TABLE IF NOT EXISTS `keuangan_kas` (
  `id_kas` varchar(12) NOT NULL,
  `nama_kas` varchar(100) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `id_personal` varchar(12) DEFAULT NULL,
  `id_kategori` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_kas`),
  KEY `fk_kategori_kategori_uang_id` (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_kas`
--

INSERT INTO `keuangan_kas` (`id_kas`, `nama_kas`, `jumlah`, `id_personal`, `id_kategori`) VALUES
('KS0000000001', 'Kas Besar', 580000, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_kategori`
--

CREATE TABLE IF NOT EXISTS `keuangan_kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_kategori`
--

INSERT INTO `keuangan_kategori` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
('KK00000001', 'Infak Bulanan Santri', 'bayaran bulana santri');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_kembali`
--

CREATE TABLE IF NOT EXISTS `keuangan_kembali` (
  `id_kembali` varchar(12) NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `id_pinjam` varchar(12) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  PRIMARY KEY (`id_kembali`),
  KEY `fk_keuangan_pinjan_id` (`id_pinjam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_kembali`
--

INSERT INTO `keuangan_kembali` (`id_kembali`, `tgl_kembali`, `id_pinjam`, `jumlah`) VALUES
('160000000001', '2016-11-25', '160000000001', 50000),
('160000000002', '2016-11-25', '160000000001', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pemasukan`
--

CREATE TABLE IF NOT EXISTS `keuangan_pemasukan` (
  `pemasukan_id` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kas_id` varchar(12) DEFAULT NULL,
  `kategori_id` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`pemasukan_id`),
  KEY `fk_kas_reperences_kas_id` (`kas_id`),
  KEY `fk_kategori_kategori_id_3` (`kategori_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_pemasukan`
--

INSERT INTO `keuangan_pemasukan` (`pemasukan_id`, `tanggal`, `kas_id`, `kategori_id`) VALUES
('160000000001', '2016-11-25', 'KS0000000001', 'KK00000001');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pemasukan_detail`
--

CREATE TABLE IF NOT EXISTS `keuangan_pemasukan_detail` (
  `pemasukan_id` varchar(12) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`pemasukan_id`,`personal_id`),
  KEY `fk_pemasikan_id_pemasukan` (`pemasukan_id`),
  KEY `fk_personal_id_personal` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_pemasukan_detail`
--

INSERT INTO `keuangan_pemasukan_detail` (`pemasukan_id`, `personal_id`, `jumlah`, `keterangan`) VALUES
('160000000001', 'PS0000000001', 150000, 'Bayar bulanan sahriah'),
('160000000001', 'PS0000000027', 150000, 'bayar sahriah');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `keuangan_pengeluaran` (
  `pengeluaran_id` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kas_id` varchar(12) DEFAULT NULL,
  `kategori_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`pengeluaran_id`),
  KEY `fk_kas_id_pengeluaran_kas` (`kas_id`),
  KEY `fk_kategori_pengeluaran_id` (`kategori_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_pengeluaran`
--

INSERT INTO `keuangan_pengeluaran` (`pengeluaran_id`, `tanggal`, `kas_id`, `kategori_id`) VALUES
('160000000001', '2016-11-25', 'KS0000000001', 'KP00000001');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pengeluaran_detail`
--

CREATE TABLE IF NOT EXISTS `keuangan_pengeluaran_detail` (
  `pengeluaran_detil_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_id` varchar(12) DEFAULT NULL,
  `nama_pengeluaran` varchar(200) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`pengeluaran_detil_id`),
  KEY `fk_pengeluaran_id_as_pengeluaran` (`nama_pengeluaran`),
  KEY `fk_pengeluaran_id` (`pengeluaran_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `keuangan_pengeluaran_detail`
--

INSERT INTO `keuangan_pengeluaran_detail` (`pengeluaran_detil_id`, `pengeluaran_id`, `nama_pengeluaran`, `jumlah`, `keterangan`) VALUES
(1, '160000000001', 'pembelian alat kebersihan Sapu', 100000, 'sari pasar kebayoran'),
(2, '160000000001', 'Pembelian Cat ', 200000, 'untuk ngecet pagar ');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_peng_kategori`
--

CREATE TABLE IF NOT EXISTS `keuangan_peng_kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_peng_kategori`
--

INSERT INTO `keuangan_peng_kategori` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
('KP00000001', 'Pengeluaran Bulanan', 'adadad');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pinjam`
--

CREATE TABLE IF NOT EXISTS `keuangan_pinjam` (
  `id_pinjam` varchar(12) NOT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `kas_id` varchar(12) DEFAULT NULL,
  `personal_id` varchar(12) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`),
  KEY `fk_kas_id_kas` (`kas_id`),
  KEY `fk_personal_id_personal` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_pinjam`
--

INSERT INTO `keuangan_pinjam` (`id_pinjam`, `tgl_pinjam`, `tgl_kembali`, `kas_id`, `personal_id`, `jumlah`, `status`) VALUES
('160000000001', '2016-11-25', '2016-11-25', 'KS0000000001', 'PS0000000001', 500000, 'p');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pinjam_detail`
--

CREATE TABLE IF NOT EXISTS `keuangan_pinjam_detail` (
  `id_pinajm_dtl` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjam` varchar(12) DEFAULT NULL,
  `total_pinjam` double DEFAULT NULL,
  `sisa_pinjam` double DEFAULT NULL,
  `kredit_pinjam` double DEFAULT NULL,
  `tgl_kredit` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pinajm_dtl`),
  KEY `fk_pinjam_id_pinjam` (`id_pinjam`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `keuangan_pinjam_detail`
--

INSERT INTO `keuangan_pinjam_detail` (`id_pinajm_dtl`, `id_pinjam`, `total_pinjam`, `sisa_pinjam`, `kredit_pinjam`, `tgl_kredit`, `status`) VALUES
(1, '160000000001', 500000, 500000, 0, NULL, 0),
(2, '160000000001', 500000, 450000, 50000, '2016-11-25', 0),
(3, '160000000001', 500000, 420000, 80000, '2016-11-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE IF NOT EXISTS `lembaga` (
  `id_lembaga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `visi` varchar(250) DEFAULT NULL,
  `misi` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id_lembaga`, `nama_lembaga`, `telepon`, `alamat`, `visi`, `misi`) VALUES
(2, 'Ma''had Daarul Muwahhid', '12345', 'Jl. flamboyan no 50 A Srengseng Kembangan jakarta Barat', 'Jakarta qolbu dawah ', 'Menjadikan jakarta menjadi central dawah dan syabab');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `taret` varchar(45) DEFAULT NULL,
  `form_id` varchar(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `class` varchar(100) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `fk_form_id_form` (`form_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `parent`, `nama`, `link`, `taret`, `form_id`, `status`, `class`) VALUES
(2, 0, 'Personal', '', '_self', '0000000001', 1, 'personal'),
(3, 0, 'Pendidikan', NULL, '_self', '0000000001', 1, 'pendidikan'),
(4, 0, 'Keuangan', NULL, '_self', '0000000001', 1, 'keuangan'),
(5, 0, 'Setting', NULL, '_self', '0000000001', 1, 'seting'),
(6, 2, 'Personal Data', NULL, '_self', '0000000011', NULL, ''),
(7, 2, 'Data Saya', NULL, '_self', '0000000090', NULL, ''),
(8, 2, 'Laporan Personal', NULL, '_self', '0000000004', 1, 'report'),
(9, 8, 'Data Personal', NULL, '_self', '0000000047', NULL, ''),
(10, 8, 'Data Pengelompokan', NULL, '_self', '0000000048', NULL, ''),
(11, 8, 'Custom Report', NULL, '_self', '0000000049', NULL, ''),
(12, 3, 'Kategori Pelajaran', NULL, '_self', '0000000004', NULL, ''),
(13, 3, 'Mata Ajar', NULL, '_self', '0000000008', NULL, ''),
(14, 3, 'Ruangan', NULL, '_self', '0000000023', NULL, ''),
(15, 3, 'Kelas', NULL, '_self', '0000000053', NULL, ''),
(16, 3, 'Jadual', NULL, '_self', '0000000027', NULL, ''),
(17, 3, 'Absensi', NULL, '_self', '0000000033', NULL, ''),
(18, 3, 'Penilaian', NULL, '_self', '0000000036', NULL, ''),
(19, 3, 'Tutup Kajian', NULL, '_self', '0000000050', NULL, ''),
(20, 3, 'Perijinan', NULL, '_self', '0000000115', 0, ''),
(21, 45, 'Kajian', NULL, '_self', '0000000056', NULL, ''),
(22, 45, 'Absensi Periode', NULL, '_self', '0000000057', NULL, ''),
(23, 45, 'Absensi Perorangan', NULL, '_self', '0000000058', NULL, ''),
(24, 45, 'Nilai', NULL, '_self', '0000000059', NULL, ''),
(25, 4, 'Kategori', NULL, '_self', '0000000039', NULL, ''),
(26, 4, 'Kas', NULL, '_self', '0000000064', NULL, ''),
(27, 4, 'Pemasukan', NULL, '_self', '0000000068', NULL, ''),
(28, 4, 'Pengeluaran', NULL, '_self', '0000000074', NULL, ''),
(29, 4, 'Pinjaman', NULL, '_self', '0000000076', NULL, ''),
(30, 4, 'Laporan Keuangan', NULL, '_self', '0000000001', 1, 'report'),
(31, 30, 'Kas', NULL, '_self', '0000000091', NULL, ''),
(32, 30, 'Pemasukan', NULL, '_self', '0000000092', NULL, ''),
(33, 30, 'Pengeluaran', NULL, '_self', '0000000093', NULL, ''),
(34, 30, 'Pinjaman', NULL, '_self', '0000000094', NULL, ''),
(35, 5, 'Access File', NULL, '_self', '0000000043', NULL, ''),
(36, 5, 'Otorisasi Menu', NULL, '_self', '0000000080', NULL, ''),
(37, 30, 'Pemauskan Personal', NULL, '_self', '0000000095', NULL, ''),
(38, 5, 'Otorisasi Personal', NULL, '_self', '0000000096', NULL, ''),
(39, 5, 'Institusi', NULL, '_self', '0000000104', NULL, ''),
(40, 5, 'Tabel Referensi', NULL, '_self', '0000000001', 1, 'seting'),
(41, 40, 'Negara', NULL, '_self', '0000000107', NULL, ''),
(42, 40, 'Propinsi', NULL, '_self', '0000000111', NULL, ''),
(43, 40, 'Santri Kategori', NULL, '_self', '0000000001', NULL, ''),
(44, 45, 'Absensi Kajian', NULL, '_self', '0000000106', NULL, ''),
(45, 3, 'Laporan Pendidikan', NULL, '_self', '0000000001', 1, 'report');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE IF NOT EXISTS `negara` (
  `id_negara` int(11) NOT NULL AUTO_INCREMENT,
  `nama_negara` varchar(100) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_negara`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id_negara`, `nama_negara`, `keterangan`) VALUES
(2, 'Indonesia', 'negara Indinesia');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_jadual` varchar(12) NOT NULL,
  `pengajar_id` varchar(12) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `fk_nilai_pelajaran1` (`id_jadual`),
  KEY `fk_nilai_personal1` (`pengajar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_personal`
--

CREATE TABLE IF NOT EXISTS `nilai_personal` (
  `id_siswa` varchar(12) NOT NULL,
  `id_nilai` varchar(12) NOT NULL,
  `kesopanan` varchar(10) DEFAULT NULL,
  `kerajinan` varchar(10) DEFAULT NULL,
  `disiplin` varchar(10) DEFAULT NULL,
  `nilai_kajian` double DEFAULT NULL,
  `nilai_huruf` varchar(10) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`,`id_nilai`),
  KEY `fk_personal_has_nilai_nilai1` (`id_nilai`),
  KEY `fk_personal_has_nilai_personal1` (`id_siswa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id_pekerjaan` varchar(12) NOT NULL,
  `nama_pekerjaan` varchar(45) DEFAULT NULL,
  `kategori_pekerjaan` varchar(45) DEFAULT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `telepon_perusahaan` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `personal_id` varchar(12) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pekerjaan`),
  KEY `fk_pekerjaan_personalid` (`personal_id`),
  KEY `fk_pekerjaan_personal_id` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`, `kategori_pekerjaan`, `nama_perusahaan`, `telepon_perusahaan`, `alamat`, `personal_id`, `keterangan`) VALUES
('PK0000000001', 'programmer', 'Teknik', 'indodev niaga internet', '0211231414', 'permata hijau', 'PS0000000001', 'software enginer'),
('PK0000000002', 'Teknisi', 'Teknik', 'PT. OPPO ELEKTRONIK INDONESIA', '0216306230', 'Ruko roxymas jln. kyai tapa ', 'PS0000000022', ''),
('PK0000000003', 'Staff Accounting', 'Keuangan', 'Al Fatih Center', '', 'Jl. Jimbaran , Daan Mogot - Kalideres', 'PS0000000008', ''),
('PK0000000004', 'Editor', 'Lain-Lain', 'PT Teknopreneur Indonesia', '+6221 2904 3923', 'Grand Wijaya Center Blok F No 85 Jl Wijaya II Kebayoran Baru Jakarta Selatan', 'PS0000000006', ''),
('PK0000000005', 'karyawati', 'Pendidikan', '', '', 'jl.mawar', 'PS0000000060', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE IF NOT EXISTS `pelajaran` (
  `id_pelajaran` varchar(10) NOT NULL,
  `nama_pelajaran` varchar(45) DEFAULT NULL,
  `sks` varchar(45) DEFAULT NULL,
  `kategori_pelajaran` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pelajaran`),
  KEY `fk_pelajaran_kategori_pelajaran` (`kategori_pelajaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pelajaran`, `nama_pelajaran`, `sks`, `kategori_pelajaran`) VALUES
('PL00000001', 'riyadussalihin (Al Hadist)', '1.5', 'K000000001'),
('PL00000002', 'Tafsir Jalalain (Quran)', '1.5', 'K000000001'),
('PL00000003', 'Al Ajrumiyyah ( Nahwu)', '1', 'K000000001'),
('PL00000004', 'Minhajut Tholibin (Fikih)', '1.5', 'K000000001'),
('PL00000005', 'Tashrif (Shorof)', '1', 'K000000001'),
('PL00000006', 'Qiroatul Quran, Tajwid, Sirah', '1.5', 'K000000001'),
('PL00000007', 'Min Mukawimat Nafsiyah Islamiyah (Tsaqofah Is', '1', 'K000000001'),
('PL00000008', 'Syarah Al-Hikam (Tauhid)', '1.5', 'K000000001'),
('PL00000009', 'Shalat Tasbih, Sholawat, Dzikir & Doa', '1.5', 'K000000002'),
('PL00000010', 'Irsyadul Ibad (Ibadah & Akhlaqul Karimah)', '1.5', 'K000000001'),
('PL00000011', 'Alfiyah Ibnu malik (Nahwu)', '1.5', 'K000000001'),
('PL00000012', 'Qotrul Gois (Cahaya Iman)', '1.5', 'K000000001');

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id_siswa` varchar(12) NOT NULL,
  `nama_awal` varchar(100) DEFAULT NULL,
  `nama_tengah` varchar(100) DEFAULT NULL,
  `nama_akhir` varchar(100) DEFAULT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tgl_gabung` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `kelamin` tinyint(2) NOT NULL COMMENT '1=laki-laki, 2=prp',
  `kategori_santri` varchar(50) NOT NULL COMMENT 'mukim atau non mukim',
  `negara` int(11) DEFAULT NULL,
  `propinsi` int(11) DEFAULT NULL,
  `status_perkawinan` varchar(45) DEFAULT NULL COMMENT 'Lajang,menikah,duda,janda',
  `kegiatan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  KEY `fk_negara_negara_id` (`negara`),
  KEY `fk_propinsi_propinsi_id` (`propinsi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`id_siswa`, `nama_awal`, `nama_tengah`, `nama_akhir`, `nama_panggilan`, `tempat_lahir`, `tgl_lahir`, `telepon`, `alamat`, `kota`, `email`, `tgl_gabung`, `foto`, `kelamin`, `kategori_santri`, `negara`, `propinsi`, `status_perkawinan`, `kegiatan`) VALUES
('PS0000000001', 'Asep ', '', 'Komarudin', 'Asep', 'Ciamis', '1988-02-24', '', 'Dsn. Cikoranji rt 02 Rw 08 ds. Cimindi di kec. Cigugur kab. Ciamis', '', 'aasseepp@gmail.com', '2014-03-01', 'PS0000000001_asep03.jpg', 1, 'non mukim', 2, 2, 'Lajang', 'Bekerja'),
('PS0000000002', 'Alvin', 'Setyo', 'Tri Yulianto', '', 'Jawa', '2014-10-03', '', 'jawa', '', 'alvin@ymail.com', '2014-10-03', 'images2.jpg', 1, 'mukim', 2, 3, 'Lajang', 'Kerja dan kuliah');

-- --------------------------------------------------------

--
-- Table structure for table `propinsi`
--

CREATE TABLE IF NOT EXISTS `propinsi` (
  `id_propinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_propinsi` varchar(100) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_propinsi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `propinsi`
--

INSERT INTO `propinsi` (`id_propinsi`, `nama_propinsi`, `keterangan`) VALUES
(2, 'Jawa Barat', 'Urang sunda tea'),
(3, 'Jawa Tengah', 'Tengah tenagah pulau jawa'),
(4, 'Jawa Timur', 'Jawa bagian timur'),
(5, 'DKI Jakarta', 'ibukota'),
(7, 'Lampung', 'iku niku niku haga'),
(8, 'Banten', 'Sebelahnya jakarta'),
(10, 'Bengkulu', 'Mukomuko'),
(11, 'Bogor', 'Bogor'),
(12, 'Kalimantan Tengah', ''),
(13, 'Riau', '');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE IF NOT EXISTS `ruangan` (
  `id_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `keterangan`) VALUES
('R000000001', 'Lantai 1', 'asa'),
('R000000002', 'lantai 2', '');

-- --------------------------------------------------------

--
-- Table structure for table `tampil_form`
--

CREATE TABLE IF NOT EXISTS `tampil_form` (
  `form_id` varchar(10) NOT NULL,
  `url` varchar(500) DEFAULT NULL,
  `nama_form` varchar(100) DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `modul` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='untuk menampilkan form';

--
-- Dumping data for table `tampil_form`
--

INSERT INTO `tampil_form` (`form_id`, `url`, `nama_form`, `menu`, `modul`) VALUES
('0000000001', './TabMenu.php', 'kosong', 'Home', '-ewewe'),
('0000000002', 'main.php', ' ', 'Home', 'Home'),
('0000000003', './view/KategoriPelajaran.php', 'KategoriPelajaran', 'Kategori Pelajaran', 'Pendidikan'),
('0000000004', './view/KategoriPelajaranForm.php', 'KategoriPelajaranForm', 'Kategori Pelajaran', 'Pendidikan'),
('0000000005', './action/KategoriPelajaranAction.php', 'KategoriPelajaranAction', 'Kategori Pelajaran', 'Pendidikan'),
('0000000006', './view/KategoriPelajaranEdit.php', 'KategoriPelajaranEdit', 'Kategori Pelajaran', 'Pendidikan'),
('0000000007', './view/Pelajaran.php', 'Pelajran', 'Pelajaran', 'Pendidikan'),
('0000000008', './view/PelajaranForm.php', 'PelajranForm', 'Pelajaran', 'Pendidikan'),
('0000000009', './action/PelajaranAction.php', 'PelajranAction', 'Pelajaran', 'Pendidikan'),
('0000000010', './view/PelajaranEdit.php', 'PelajranEdit', 'Pelajaran', 'Pendidikan'),
('0000000011', './view/personal/PersonalForm.php', 'PersonalForm', 'Personal', 'Personal Data'),
('0000000012', './view/personal/Registrasi.php', 'Personal', 'Personal', 'Personal Data'),
('0000000013', './action/PersonalAction.php', 'PersonalAction', 'Personal', 'Personal Data'),
('0000000014', './action/UserAction.php', 'UserAction', 'User', 'Personal Data'),
('0000000015', './view/personal/RegistrasiEdit.php', 'PersonalEdit', 'Personal', 'Personal Data'),
('0000000016', './view/personal/TabEdit.php', 'TabEdit', 'Personal', 'Personal Data'),
('0000000017', './view/personal/PendidikanInsert.php', 'EduInsert', 'Education', 'Personal Data'),
('0000000018', './action/PendidikanAction.php', 'EduAction', 'Education', 'Personal Data'),
('0000000019', './view/personal/PendidikanEdit.php', 'EduEdit', 'Education', 'Personal Data'),
('0000000020', './view/personal/KeluargaInsert.php', 'FamilyInsert', 'family', 'Personal Data'),
('0000000021', './action/KeluargaAction.php', 'FamilyAction', 'family', 'Personal Data'),
('0000000022', './view/personal/KeluargaEdit.php', 'FamilyEdit', 'family', 'Personal Data'),
('0000000023', './view/ruangan/RuanganForm.php', 'RuaganForm', 'Ruangan', 'Pendidikan'),
('0000000024', './view/ruangan/Ruangan.php', 'Ruagan', 'Ruangan', 'Pendidikan'),
('0000000025', './action/RuanganAction.php', 'RuaganAction', 'Ruangan', 'Pendidikan'),
('0000000026', './view/ruangan/RuanganEdit.php', 'RuaganEdit', 'Ruangan', 'Pendidikan'),
('0000000027', './view/jadual/JadualForm.php', 'JadualForm', 'Jadual', 'Pendidikan'),
('0000000028', './view/jadual/JadualInsert.php', 'JadualInsert', 'Jadual', 'Pendidikan'),
('0000000029', './view/jadual/JadualEdit.php', 'JadualEdit', 'Jadual', 'Pendidikan'),
('0000000030', './action/JadualAction.php', 'JadualAction', 'Jadual', 'Pendidikan'),
('0000000031', './view/addKajian/AddKajian.php', 'AddKajian', 'Kajian', 'Pendidikan'),
('0000000032', './action/addKajianAction.php', 'AddKajianAction', 'Kajian', 'Pendidikan'),
('0000000033', './view/kelas/Absen.php', 'Kelas', 'Absensi', 'Pendidikan'),
('0000000034', './view/kelas/AbsenEdit.php', 'EditKelas', 'Absensi', 'Pendidikan'),
('0000000035', './action/AbsenAction.php', 'AbsenAction', 'Absensi', 'Pendidikan'),
('0000000036', './view/penilaian/Penilaian.php', 'Penilaian', 'Penilian', 'Pendidikan'),
('0000000037', './view/penilaian/PenilaianEdit.php', 'PenilaianEdit', 'Penilaian', 'Pendidikan'),
('0000000038', './action/PenilaianAction.php', 'PenilainAction', 'Penilian', 'Pendidikan'),
('0000000039', './view/keuangan_kategori/TabEdit.php', 'TabEditKategori', 'Keuangan | Kategori', 'Keuangan'),
('0000000040', './view/personal/PekerjaanInsert.php', 'PekerjaanInsert', 'Personal', 'Personal Data'),
('0000000041', './view/personal/PekerjaanEdit.php', 'PekerjaanEdit', 'Personal', 'Personal Data'),
('0000000042', './action/PekerjaanAction.php', 'PekerjaanAction', 'Personal', 'Personal Data'),
('0000000043', './view/tampilForm/TampilForm.php', 'BukaFile', 'BukaFile', 'Setting'),
('0000000044', './view/tampilForm/TampilInsert.php', 'insertFile', 'BukaFile', 'Setting'),
('0000000045', './view/tampilForm/TampilUpdate.php', 'updateFile', 'BukaFile', 'Setting'),
('0000000046', './view/laporan/personal/AllPersonal.php', 'AllPersonal', 'Laporan', 'Personal Data'),
('0000000047', './view/laporan/personal/AllForm.php', 'AllForm', 'laporan', 'personaladata'),
('0000000048', './view/laporan/personal_kelompok/Form.php', 'FilterForm', 'Laporan', 'Personal Data'),
('0000000049', './view/laporan/personal_custom/Form.php', 'CustomForm', 'Laporan', 'Personal Data'),
('0000000050', './view/tutup_kajian/TutupKajian.php', 'TutupKajian', 'Pendidikan | Tutup Kajian', 'Pendidikan'),
('0000000051', './action/TutupKajianAction.php', 'TutupKajianAction', 'Pendidikan | Tutup Kajian', 'Pendidikan'),
('0000000052', './view/kelas/KelasInsert.php', 'KelasInsert', 'Pendidikan | Kelas', 'Pendidikan'),
('0000000053', './view/kelas/KelasForm.php', 'KelasForm', 'Pendidikan | Kelas', 'Pendidikan'),
('0000000054', './action/KelasAction.php', 'KelasAction', 'Pendidikan | Kelas ', 'Pendidikan'),
('0000000055', './view/kelas/KelasUpdate.php', 'KelasUpdate', 'Pendidikan | Kelas', 'Pendidikan'),
('0000000056', './view/laporan/pendidikan_jadual/Form.php', 'LaporanPendidikanForm', 'Pendidikan | Laporan', 'Pendidikan'),
('0000000057', './view/laporan/pendidikan_absen/AbsenForm.php', 'AbsenForm', 'Pendidikan | Laporan', 'Pendidikan'),
('0000000058', './view/laporan/pendidikan_absen/AbsenPersonalForm.php', 'AbsenPersonalForm', 'Pendidikan | Laporan', 'Pendidikan'),
('0000000059', './view/laporan/pendidikan_nilai/NilaiPersonalForm.php', 'NilaiForm', 'Pendidikan | Laporan', 'Pendidikan'),
('0000000060', './view/keuangan_kategori/KategoriKeuanganForm.php', 'KeuanganKategoriForm', 'Keuangan | Kategori', 'Keuangan'),
('0000000061', './action/KeuanganKategoriAction.php', 'KeuanganKategoriAction', 'Keuangan | Kategori', 'Keuangan'),
('0000000062', './view/keuangan_kategori/KategoriKeuangan.php', 'KategoriKeuangan', 'Pendidikan | Kelas', 'Keuangan'),
('0000000063', './view/keuangan_kategori/KategoriKeuanganEdit.php', 'KeuanganKategoriEdit', 'Keuangan | Kategori', 'Keuangan'),
('0000000064', './view/keuangan_kas/KasKeuanganForm.php', 'KasKeuanganForm', 'Keuangan | Kas', 'Keuangan'),
('0000000065', './view/keuangan_kas/KasKeuangan.php', 'KasKeuangan', 'Keuangan | Kas', 'Keuangan'),
('0000000066', './action/KeuanganKasAction.php', 'KeuanganKasAction', 'Keuangan | Kas', 'Keuangan'),
('0000000067', './view/keuangan_kas/KasKeuanganEdit.php', 'KasKeuanganEdit', 'Keuangan | Kas', 'Keuangan'),
('0000000068', './view/keuangan_pemasukan/KeuanganPemasukan.php', 'KeuanganPemasukan', 'Keuangan | Pemasukan', 'Keuangan'),
('0000000069', './action/KeuanganPemasukanAction.php', 'KeuanganPemasukanAction', 'Keuangan | Pemasukan', 'Keuangan'),
('0000000070', './view/keuangan_kategori/KategoriPengKeuanganForm.php', 'KategoriPengKeuanganForm', 'Keuangan | Kategori', 'Keuangan'),
('0000000071', './view/keuangan_kategori/KategoriPengKeuangan.php', 'KategoriPengKeuangan', 'Keuangan | Kategori', 'Keuangan'),
('0000000072', './view/keuangan_kategori/KategoriPengKeuanganEdit.php', 'KategoriPengKeuanganEdit', 'Keuangan | Kategori', 'Keuangan'),
('0000000073', './action/KeuanganPengKategoriAction.php', 'KeuanganPengKategoriAction', 'Keuangan | Action', 'Keuangan'),
('0000000074', './view/keuangan_pengeluaran/KeuanganPengeluaran.php', 'KeuanganPengeluaran', 'Keuangan | Pengeluaran', 'Keuangan'),
('0000000075', './action/KeuanganPengeluaranAction.php', 'KeuanganPengeluaranAction', 'Keuangan | Action', 'Keuangan'),
('0000000076', './view/keuangan_pinjam/TabPinjam.php', 'TabPinjam', 'Keuangan | Pinajm', 'Keuangan'),
('0000000077', './action/KeuanganPinjamAction.php', 'KeuanganPinjamAction', 'Keuangan | Pinjam', 'Keuangan'),
('0000000078', './action/KeuanganKembaliAction.php', 'KeuanganKembaliAction', 'Keuangan | Pinjam', 'Keuangan'),
('0000000079', './view/menu/addMenu.php', 'addMenu', 'Setting | Menu', 'Setting'),
('0000000080', './view/menu/GroupForm.php', 'GroupForm', 'Setting | Menu', 'Setting'),
('0000000081', './view/menu/GroupInsert.php', 'GroupInsert', 'Setting | Group', 'Setting'),
('0000000082', './action/GroupAction.php', 'GroupAction', 'Setting | Group', 'Setting'),
('0000000083', './view/menu/GroupUpdate.php', 'GroupUpdate', 'Setting | Group', 'Setting'),
('0000000084', './view/menu/addMenu.php', 'addMenu', 'Setting | Group', 'Setting'),
('0000000085', './action/MenuAction.php', 'MenuAction', 'Setting | Group', 'Setting'),
('0000000086', './view/menu/addPersonal.php', 'addPersonal', 'Setting | Group', 'Setting'),
('0000000087', './action/AddPersonalAction.php', 'AddPersonalAction', 'Setting | Group', 'Setting'),
('0000000088', './action/LoginAction.php', 'LoginAction', 'Login', 'Login'),
('0000000089', './action/LoginOut.php', 'LoginOut', 'LoginOut', 'LoginOut'),
('0000000090', './view/personal/PersonalData.php', 'PersonalData', 'Personal | Personal Data', 'Personal'),
('0000000091', './view/laporan/keuangan_kas/LapKasForm.php', 'LapKasForm', 'Keuangan | Laporan | Kas', 'Keuangan'),
('0000000092', './view/laporan/keuangan_pemasukan/LapPemasukanForm.php', 'LapPemasukanForm', 'Keuangan | Laporan | Pemasukan', 'Keuangan'),
('0000000093', './view/laporan/keuangan_pengeluaran/LapPengeluaranForm.php', 'LapPengeluaranForm', 'Keuangan | Laporan | Pengeluaran', 'Keuangan'),
('0000000094', './view/laporan/keuangan_pinjaman/LapPinjamForm.php', 'LapPinjamForm', 'Keuangan | Laporan | Pinjmanan', 'Keuangan'),
('0000000095', './view/laporan/keuangan_pemasukan_personal/LapPemasukanEmpForm.php', 'LapPemasukanEmpForm', 'Keuangan | Laporan | Pemasukan', 'Keuangan'),
('0000000096', './view/empgroup/EmpGroupForm.php', 'EmpGroupForm', 'Setting | Group Personal', 'Setting'),
('0000000097', './view/empgroup/EmpGroupInsert.php', 'EmpGroupInsert', 'Setting | Group Personal', 'Setting'),
('0000000098', './action/EmpGroupAction.php', 'EmpGroupAction', 'Setting | Group Personal', 'Setting'),
('0000000099', './view/empgroup/EmpGroupUpdate.php', 'EmpGroupUpdate', 'Setting | Group Personal', 'Setting'),
('0000000100', './action/AddEmpAdminAction.php', 'AddEmpAdminAction', 'Setting | Group Personal', 'Setting'),
('0000000101', './view/empgroup/addEmpAdmin.php', 'addEmpAdmin', 'Setting | Group Personal', 'Setting'),
('0000000102', './view/empgroup/addEmpPersonal.php', 'AddEmpPersonal', 'Setting | Group Personal', 'Setting'),
('0000000103', './action/AddEmpPersonalAction.php', 'AddEmpPersonalAction', 'Setting | Group Personal', 'Setting'),
('0000000104', './view/lembaga/LembagaInsert.php', 'LembagaInsert', 'Setting | Lembaga', 'Setting'),
('0000000105', './action/InstitusiAction.php', 'InstitusiAction', 'Setting | Lembaga', 'Setting'),
('0000000106', './view/laporan/pendidikan_absen_kajian/AbsenKajianForm.php', 'AbsenKajianForm', 'Pendidikan | Laporan | Absensi Kajian', 'Pendidikan'),
('0000000107', './view/negara/NegaraForm.php', 'NegaraForm', 'Setting | Tabel Referensi | Negara', 'Setting'),
('0000000108', './view/negara/NegaraInsert.php', 'NegaraInsert', 'Setting | Tabel Referensi | Negara', 'Setting'),
('0000000109', './action/NegaraAction.php', 'NegaraAction', 'Setting | Tabel Referensi | Negara', 'Setting'),
('0000000110', './view/negara/NegaraEdit.php', 'NegaraEdit', 'Setting | Tabel Referensi | Negara', 'Setting'),
('0000000111', './view/propinsi/PropinsiForm.php', 'PropinsiForm', 'Setting | Tabel Referensi | Propinsi', 'Setting'),
('0000000112', './view/propinsi/PropinsiInsert.php', 'PropinsiInsert', 'Setting | Tabel Referensi | Propinsi', 'Setting'),
('0000000113', './action/PropinsiAction.php', 'PropinsiAction', 'Setting | Tabel Referensi | Propinsi', 'Setting'),
('0000000114', './view/propinsi/PropinsiEdit.php', 'PropinsiEdit', 'Setting | Tabel Referensi | Propinsi', 'Setting'),
('0000000115', './view/ijin/IjinSantri.php', 'IjinSantri', 'pendidikan | Ijin', 'Pendidikan'),
('0000000116', './action/IjinAction.php', 'IjinAction', 'pendidikan | Ijin', 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `tutup_kajian`
--

CREATE TABLE IF NOT EXISTS `tutup_kajian` (
  `id_tutup` int(11) NOT NULL AUTO_INCREMENT,
  `jadual_id` varchar(12) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tutup`),
  KEY `fk_jdadual_id_jadual_fk` (`jadual_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(12) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `personal_id` varchar(12) NOT NULL,
  `pertanyaan` varchar(300) DEFAULT NULL,
  `jawaban` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_user`,`personal_id`),
  KEY `fk_user_personal1` (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `personal_id`, `pertanyaan`, `jawaban`) VALUES
('U00000000001', 'asep', 'ZEIBQ46FpqG/5otMzQTNy2bpy1HCCppC4Xa78SN+5Xc=', '', 'PS0000000001', 'siapa nama anda', 'asep'),
('U00000000002', 'alvin', 'ZEIBQ46FpqG/5otMzQTNy2bpy1HCCppC4Xa78SN+5Xc=', '', 'PS0000000002', 'dm', 'dm'),
('U00000000003', 'ajang', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000003', 'dm', 'dm'),
('U00000000004', 'admindm', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000004', 'dm', 'dm'),
('U00000000005', 'tika', 'mZr7vYuaMNDCE2xTt6p6RhB/9lbHpDfHPzrTLZlsKo4=', '', 'PS0000000005', 'rumah jkt?', 'Rasamala 18'),
('U00000000006', 'nelymerinadm', 'cvI4nwqLT9A7kJdmDzPCYYpGz5/kjJNff/w+xGdDwXo=', '', 'PS0000000006', 'siapa yang bikin akun?', 'prastika'),
('U00000000007', 'khoiron hafizoh', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000007', 'yang bikinin account?', 'prastika'),
('U00000000008', 'NelyRizky', 'ICsOxfjN7w0trXrhitivGvtKYjKtcTFLBjNvo/aXIAM=', '', 'PS0000000008', 'yang bikinin account?', 'prastika'),
('U00000000009', 'khoirie', 'm8CPDHZ70i13RR77EHDVGyQZC1DoIeVj18v7eXzmEXw=', '', 'PS0000000009', 'ha ha ha', 'hi hi hi'),
('U00000000010', 'Unue', 'G5w1CUuSjJsEtOMucplnHrB/ktE7ycODYAkpbNM8J+8=', '', 'PS0000000010', 'pasword anda adalah?', 'unue123'),
('U00000000011', 'amel', 'kbobdNpflVQRoCFV0dn50TblkkXAuTS+3r7kldUj97s=', '', 'PS0000000011', 'apa motivasi mu?', 'mama'),
('U00000000012', 'Rahmadi', 'Woy/AGrplWccwkcEOidTTWGLtjIjD7umB82amt7tE+Q=', '', 'PS0000000012', 'dm', 'dm'),
('U00000000013', 'hamzah', 'pghltsZ7JgLTeIjbVocts7aIN5x6lDeCtdbSTlr5DfU=', '', 'PS0000000013', 'dm', 'dm'),
('U00000000014', 'edyp', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000014', 'dm', 'dm'),
('U00000000015', 'heriyanto', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000015', 'dm', 'dm'),
('U00000000016', 'agungs', 'V9aLSFbBenngD1JGtCLdayRjweymjwmH4a7NEaKFyuM=', '', 'PS0000000016', 'dm', 'dm'),
('U00000000017', 'slamet', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000017', 'dm', 'dm'),
('U00000000018', 'riski', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000018', 'dm', 'dm'),
('U00000000019', 'utomo', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000019', 'dm', 'dm'),
('U00000000020', 'dedy', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000020', 'dm', 'dm'),
('U00000000021', 'romdon', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000021', 'dm', 'dm'),
('U00000000022', 'adisantoso', 'PqB1sjvEXJXc0eYep/OmtkJat0ZUMcMNIwBDAHqGOb4=', '', 'PS0000000022', 'nama ustad kita', 'shoffar mawardi'),
('U00000000023', 'hersa', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000023', 'dm', 'dm'),
('U00000000024', 'kahfi', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000024', 'dm', 'dm'),
('U00000000025', 'parid', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000025', 'dm', 'dm'),
('U00000000026', 'najib', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000026', 'dm', 'dm'),
('U00000000027', 'awal', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000027', 'dm', 'dm'),
('U00000000028', 'ahdy', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000028', 'dm', 'dm'),
('U00000000029', 'anggun', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000029', 'dm', 'dm'),
('U00000000030', 'ahmad putra', 'J2iN8XaGOfjVZkwGI1T1EuWHRPyQIgbjViR3D5P3UAk=', '', 'PS0000000030', 'dm', 'dm'),
('U00000000031', 'ajipamungkas', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000031', 'dm', 'dm'),
('U00000000032', 'didik', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000032', 'dm', 'dm'),
('U00000000033', 'joko', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000033', 'dm', 'dm'),
('U00000000034', 'hafiz', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000034', 'dm', 'dm'),
('U00000000035', 'arief', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000035', 'dm', 'dm'),
('U00000000036', 'tarno', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000036', 'dm', 'dm'),
('U00000000037', 'santoso', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000037', 'dm', 'dm'),
('U00000000038', 'safudin', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000038', 'dm', 'dm'),
('U00000000039', 'harwo', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000039', 'dm', 'dm'),
('U00000000040', 'karsono', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000040', 'dm', 'dm'),
('U00000000041', 'nino', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000041', 'dm', 'dm'),
('U00000000042', 'hono', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000042', 'dm', 'dm'),
('U00000000043', 'sudarmono', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000043', 'dm', 'dm'),
('U00000000044', 'dedi', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000044', 'dm', 'dm'),
('U00000000045', 'anam', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000045', 'dm', 'dm'),
('U00000000046', 'gunawan', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000046', 'dm', 'dm'),
('U00000000047', 'fathur', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000047', 'dm', 'dm'),
('U00000000048', 'alim', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000048', 'dm', 'dm'),
('U00000000049', 'sugiono', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000049', 'dm', 'dm'),
('U00000000050', 'oman', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000050', 'dm', 'dm'),
('U00000000051', 'jupri', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000051', 'dm', 'dm'),
('U00000000052', 'sulaiman', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000052', 'dm', 'dm'),
('U00000000053', 'sodikin', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000053', 'dm', 'dm'),
('U00000000054', 'wahidin', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000054', 'dm', 'dm'),
('U00000000055', 'nunji', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000055', 'sapa yang bikinin account', 'prastika'),
('U00000000056', 'Maryam Jamilah', 'hmfDL22ULEmedAjsdmH/KcW/mGhvKgqPKoDPTgEUxBA=', '', 'PS0000000056', 'sapa yang bikin account', 'prastika'),
('U00000000057', 'sintia', 'vpfXYvQSlFyYGVpQ/4ZtoUaOBZqHYV/UbLjudDnH2zI=', '', 'PS0000000057', 'sapa yang bikin account', 'prastika'),
('U00000000058', 'chusnul', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000058', 'sapa yang bikin account', 'prastika'),
('U00000000059', 'citra', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000059', 'sapa yang bikinin account', 'prastika'),
('U00000000060', 'nur', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000060', 'sapa yang bikin account', 'prastika'),
('U00000000061', 'ningrum', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000061', 'sapa yang bikinin account', 'prastika'),
('U00000000062', 'huda', 'hqpBHSWzPDV08twEASazJEmWrUKYYdu2uyA9rPlo0IE=', '', 'PS0000000062', 'sapa namamu?', 'huda'),
('U00000000063', 'maulana', 'CwdjgnsYwA84q5Wvx56VoXPBmcwtNuRqhJMlqbsPlFE=', '', 'PS0000000063', 'siapa nama saya?', 'hafiz'),
('U00000000064', 'susilo', '33Fiii11YQIuiFF6qympUdagYKTVGtYJfSBNmQwW3pI=', '', 'PS0000000064', 'sapa namamu?', 'joko'),
('U00000000065', 'mulyo', 'CD1OxpugF2bnJ1oUTsxVTEkXmb7CBqMg93mu/czS2A0=', '', 'PS0000000065', 'siapa nama saya?', 'mulyo'),
('U00000000066', 'yusni', '8Hnwl8zzWhTzG6c8tS9OsmObBls/QD6OQr/h1xUajs8=', '', 'PS0000000066', 'siapa nama saya?', 'yusni'),
('U00000000067', 'dede', '8TMXf4KQF4ZXmW1pxaIUQvRtE6ud+CaypLXZeX45NaI=', '', 'PS0000000067', 'siapa nama saya?', 'dede'),
('U00000000068', 'wina', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000068', 'sapa yang bikin account', 'prastika'),
('U00000000069', 'mus', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000069', 'sapa yang bikin account', 'prastika'),
('U00000000070', 'novi', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000070', 'sapa yang bikin account', 'prastika'),
('U00000000071', 'dewi', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000071', 'sapa yang bikin account', 'prastika'),
('U00000000072', 'uni', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000072', 'orang paling ganteng menurut kamu', 'abah parid'),
('U00000000073', 'imah', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000073', 'darisah kamu yang paling kecee', 'prastika'),
('U00000000074', 'isti', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000074', 'pj akhwat input data santri sm', 'prastika'),
('U00000000075', 'inang', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000075', 'pj akhwat input data santri', 'prastika'),
('U00000000076', 'nuraini', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000076', 'pj akhwat input data santri dm', 'prastika'),
('U00000000077', 'dwiana', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000077', 'darisah kamu yang paling kece', 'prastika'),
('U00000000078', 'ika purnamasari', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000078', 'pj akhwat input data santri dm', 'prastika'),
('U00000000079', 'mamay', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000079', 'pj akhwat input data santri dm', 'prastika'),
('U00000000080', 'marully', 'qThGi271nVGAC/bTDSD+gnMlmLXunTK/URmfXn+PJ9s=', '', 'PS0000000080', 'siapa nama saya?', 'marully'),
('U00000000081', 'euishasanah', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000081', 'pj akhwat yang input data santri dm', 'prastika'),
('U00000000082', 'dwi', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000082', 'tante nya ilma yang paling cantik', 'prastika'),
('U00000000083', 'ika p', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000083', 'pj akhwat input data santri dm', 'prastika'),
('U00000000084', 'nhip', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000084', 'pj akhwat input data dm', 'prastik'),
('U00000000085', 'tyas', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000085', 'mba di dm yang paling ceke huruf depan namanya p', 'prastika'),
('U00000000086', 'teh nia', '3dz/HqICfQkx9N5+iNX8r2bZ0O05/6/t4h7js/OnQ2I=', '', 'PS0000000086', 'pj akhwat input data dm', 'prastika');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
