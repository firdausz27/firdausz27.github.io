-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2014 at 11:19 AM
-- Server version: 5.5.18
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `id_jadual` varchar(12) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  `status_kehadiran` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `fk_absensi_jadual1` (`id_jadual`),
  KEY `fk_absensi_personal1` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_history`
--

INSERT INTO `education_history` (`id_education`, `level_pendidikan`, `tahun_mulai`, `tahun_selesai`, `institusi`, `nilai_rata`, `no_ijazah`, `negara`, `propinsi`, `kota`, `tgl_ijazah`, `personal_id`) VALUES
('EH0000000001', 'TK', 1948, 1952, 'TK berkah abadai', 0, '121313', 'indonesia', '', '', '2014-05-21', 'PS0000000001'),
('EH0000000002', 'SD', 1988, 1989, 'SD Makmur', 0, '121313', 'indonesia', '', '', '2014-05-21', 'PS0000000001');

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
  `propinsi` varchar(45) DEFAULT NULL,
  `negara` varchar(45) DEFAULT NULL,
  `hubungan` varchar(45) DEFAULT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`id_family`),
  KEY `fk_family_personal1` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id_family`, `nama`, `telepon`, `alamat`, `kota`, `propinsi`, `negara`, `hubungan`, `personal_id`) VALUES
('F00000000001', 'asep komarudin', '', 'jakarta', '', '', 'indonesia', 'kaka', 'PS0000000001'),
('F00000000002', 'dede', '', 'jl.plamboyan no.21', '', '', 'indonesia', 'adik', 'PS0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `jadual`
--

CREATE TABLE IF NOT EXISTS `jadual` (
  `id_jadual` varchar(12) NOT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `jam_mulai` varchar(45) DEFAULT NULL,
  `jam_selesai` varchar(45) DEFAULT NULL,
  `id_ruangan` varchar(10) NOT NULL,
  `id_pelajaran` varchar(10) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  PRIMARY KEY (`id_jadual`),
  KEY `fk_jadual_rungan1` (`id_ruangan`),
  KEY `fk_jadual_pelajaran1` (`id_pelajaran`),
  KEY `fk_jadual_personal1` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pelajaran`
--

CREATE TABLE IF NOT EXISTS `kategori_pelajaran` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pelajaran`
--

INSERT INTO `kategori_pelajaran` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
('K000000001', 'Muatan Local', 'Pelajaran terapan dari daerah'),
('K000000002', 'lkadjfafda', 'ajfdajafaf  asjaja');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL,
  `kategori_nilai` varchar(45) DEFAULT NULL,
  `id_pelajaran` varchar(10) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  `nilai_angka` int(11) DEFAULT NULL,
  `nilai_huruf` varchar(45) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `dibuat_oleh` varchar(45) DEFAULT NULL,
  `smester` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `fk_nilai_pelajaran1` (`id_pelajaran`),
  KEY `fk_nilai_personal1` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_smester`
--

CREATE TABLE IF NOT EXISTS `nilai_smester` (
  `id_nilai_smester` int(11) NOT NULL,
  `tanggal` varchar(45) DEFAULT NULL,
  `id_pelajaran` varchar(10) NOT NULL,
  `personal_id` varchar(12) NOT NULL,
  `smester` varchar(45) DEFAULT NULL,
  `nilai_huruf` varchar(45) DEFAULT NULL,
  `nilai_angka` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai_smester`),
  KEY `fk_nilai_smester_pelajaran1` (`id_pelajaran`),
  KEY `fk_nilai_smester_personal1` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pelajaran`, `nama_pelajaran`, `sks`, `kategori_pelajaran`) VALUES
('PL00000001', 'Bahasa Sunda', '2', 'K000000001');

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id_siswa` varchar(12) NOT NULL,
  `nis` varchar(45) DEFAULT NULL,
  `nama_awal` varchar(100) DEFAULT NULL,
  `nama_tengah` varchar(100) DEFAULT NULL,
  `nama_akhir` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` datetime DEFAULT NULL,
  `telepon` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `propinsi` varchar(100) DEFAULT NULL,
  `negara` varchar(100) DEFAULT NULL,
  `personal_type` varchar(45) DEFAULT NULL,
  `tgl_gabung` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`id_siswa`, `nis`, `nama_awal`, `nama_tengah`, `nama_akhir`, `tempat_lahir`, `tgl_lahir`, `telepon`, `alamat`, `kota`, `propinsi`, `negara`, `personal_type`, `tgl_gabung`, `foto`) VALUES
('PS0000000001', '1213', 'asep', '', 'Komarudin', 'ciamis', '2014-05-16 00:00:00', '123131313', 'jl.plamboyan no.21', '', 'dki jakarta', 'indonesia', 'Guru', '2014-05-28', 'images2.jpg'),
('PS0000000002', '1213', 'asadea', '', '', 'jakarta', '2014-05-15 00:00:00', '', 'jl.plamboyan no.21', '', 'dki jakarta', 'indonesia', 'Guru', '2014-05-30', 'PS0000000002_images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_didik`
--

CREATE TABLE IF NOT EXISTS `peserta_didik` (
  `personal_id` varchar(12) NOT NULL,
  `id_jadual` varchar(12) NOT NULL,
  `jumlah` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`personal_id`,`id_jadual`),
  KEY `fk_personal_has_jadual_jadual1` (`id_jadual`),
  KEY `fk_personal_has_jadual_personal1` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rungan`
--

CREATE TABLE IF NOT EXISTS `rungan` (
  `id_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `personal_id`, `pertanyaan`, `jawaban`) VALUES
('U00000000001', 'asep Komarudin', 'dc855efb0dc7476760afaa1b281665f1', 'Admin', 'PS0000000001', 'siapa nama anda', 'asep'),
('U00000000002', 'asep', 'dc855efb0dc7476760afaa1b281665f1', 'Admin', 'PS0000000002', 'siapa nama anda', 'asep');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_jadual1` FOREIGN KEY (`id_jadual`) REFERENCES `jadual` (`id_jadual`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_absensi_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `education_history`
--
ALTER TABLE `education_history`
  ADD CONSTRAINT `fk_education_history_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `fk_family_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadual`
--
ALTER TABLE `jadual`
  ADD CONSTRAINT `fk_jadual_pelajaran1` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadual_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jadual_rungan1` FOREIGN KEY (`id_ruangan`) REFERENCES `rungan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_nilai_pelajaran1` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nilai_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_smester`
--
ALTER TABLE `nilai_smester`
  ADD CONSTRAINT `fk_nilai_smester_pelajaran1` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nilai_smester_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD CONSTRAINT `fk_pelajaran_kategori_pelajaran` FOREIGN KEY (`kategori_pelajaran`) REFERENCES `kategori_pelajaran` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `peserta_didik`
--
ALTER TABLE `peserta_didik`
  ADD CONSTRAINT `fk_personal_has_jadual_jadual1` FOREIGN KEY (`id_jadual`) REFERENCES `jadual` (`id_jadual`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personal_has_jadual_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_personal1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
