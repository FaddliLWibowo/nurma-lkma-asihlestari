-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2015 at 12:34 
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2015_lkma`
--

-- --------------------------------------------------------

--
-- Table structure for table `aksiSimpanan`
--

CREATE TABLE IF NOT EXISTS `aksiSimpanan` (
`id_aksi` int(11) NOT NULL,
  `id_simpanan` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `status` enum('penarikan','setoran') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aksiSimpanan`
--

INSERT INTO `aksiSimpanan` (`id_aksi`, `id_simpanan`, `tgl`, `jumlah`, `status`) VALUES
(1, 2, '2015-03-21 19:59:17', 10000, 'setoran'),
(2, 2, '2015-03-21 21:01:16', 250000, 'setoran'),
(4, 2, '2015-03-21 15:53:03', 100000, 'penarikan'),
(5, 11, '2015-03-23 02:11:47', 250000, 'setoran');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
`no_anggota` int(12) NOT NULL,
  `no_identitas` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `telepon` varchar(12) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_anggota`, `no_identitas`, `nama`, `alamat`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `telepon`) VALUES
(5, '768987', 'dwi putri kurniawati', 'jamus', 'pria', 'Kulon Progo', '2011-11-21', '2147483647'),
(23, '111154678902', 'Anggit Dwi Hartanto', 'Candi Gebang, CC, Sleman DIY', 'pria', 'Yogyakarta', '2015-03-07', '08123456789'),
(6, '12345678', 'dpkaa', 'jamus', 'wanita', 'westprog', '2011-11-21', '1234'),
(7, '8909809', 'nurma', 'ngento', 'pria', 'kp', '2011-08-06', '9890'),
(8, '98098098', 'rahmanto', 'ngento', 'pria', 'kp', '1998-12-12', '876765909'),
(10, '12345690', 'nurmayanti', 'kp', 'pria', 'kp', '2015-03-19', '7689876'),
(24, '11115284', 'Yusuf Akhsan Hidayat', 'Jalan lele 1 Sleman, DIY', 'pria', 'Ponorogo', '2015-04-26', '085645777298');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE IF NOT EXISTS `angsuran` (
`id_angsuran` int(15) NOT NULL,
  `id_pinjaman` int(15) NOT NULL,
  `tgl_angsur` date NOT NULL,
  `angsuran_pokok` int(15) NOT NULL,
  `denda` int(15) NOT NULL,
  `total_angsur` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `id_pinjaman`, `tgl_angsur`, `angsuran_pokok`, `denda`, `total_angsur`) VALUES
(1, 12, '2015-03-23', 2083333, 0, 2083333),
(2, 13, '2015-03-23', 8334, 0, 8334),
(3, 11, '2015-03-23', 869566, 0, 869566);

-- --------------------------------------------------------

--
-- Table structure for table `jaminan`
--

CREATE TABLE IF NOT EXISTS `jaminan` (
`id_jaminan` int(15) NOT NULL,
  `id_pinjaman` int(15) NOT NULL,
  `jenis_jaminan` varchar(15) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `alamat_pemilik` varchar(50) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jaminan`
--

INSERT INTO `jaminan` (`id_jaminan`, `id_pinjaman`, `jenis_jaminan`, `nama_pemilik`, `alamat_pemilik`, `keterangan`) VALUES
(2, 11, 'Jenis Jaminans', 'Nama Pemilik ', 'Alamat', 'Keterangan'),
(3, 12, 'Kampus', 'Prof H M Suyanto', 'Yogyakarta', 'Kampus STMIK Amikom Yogyakarta'),
(4, 13, '-', '-', '-', '-'),
(5, 14, 'Motor', 'Yusuf Akhsan Hidayat', 'Jalan Lele, Maguwoharjo, Sleman', 'Motor');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
`id_pinjaman` int(15) NOT NULL,
  `no_anggota` int(12) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `besar_pinjaman` int(15) NOT NULL,
  `jatuh_tempo` datetime NOT NULL,
  `status` enum('pinjam','lunas','telat') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `no_anggota`, `tgl_pinjam`, `besar_pinjaman`, `jatuh_tempo`, `status`) VALUES
(8, 7, '2014-12-17 00:00:00', 2000000, '2015-04-01 00:00:00', 'pinjam'),
(9, 10, '2014-12-18 00:00:00', 1000000, '2015-05-01 00:00:00', 'pinjam'),
(11, 5, '2015-03-23 10:22:21', 20000000, '2017-03-02 00:00:00', 'pinjam'),
(12, 23, '2015-03-23 19:32:38', 25000000, '2016-03-23 00:00:00', 'pinjam'),
(13, 5, '2015-03-23 21:30:34', 100000, '2016-03-23 00:00:00', 'pinjam'),
(14, 24, '2015-04-14 18:05:20', 20000000, '2016-04-14 00:00:00', 'pinjam');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
`id_simpanan` int(11) NOT NULL,
  `no_anggota` int(12) NOT NULL,
  `tgl_simpan` date NOT NULL,
  `jenis_simpanan` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `no_anggota`, `tgl_simpan`, `jenis_simpanan`) VALUES
(1, 5, '1999-12-12', '0'),
(2, 6, '2013-12-12', '0'),
(5, 7, '2014-12-12', '0'),
(6, 8, '2014-12-12', '0'),
(10, 10, '2014-11-11', '0'),
(11, 23, '2015-03-23', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(10) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat_pegawai` varchar(100) NOT NULL,
  `jk_pegawai` text NOT NULL,
  `tempatlahir_pegawai` varchar(20) NOT NULL,
  `tgllahir_pegawai` date NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `telp_pegawai` int(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_pegawai`, `alamat_pegawai`, `jk_pegawai`, `tempatlahir_pegawai`, `tgllahir_pegawai`, `pendidikan`, `jabatan`, `telp_pegawai`, `username`, `password`, `level`) VALUES
(1, 'Nurmayan-T', 'alamat nurma', '', '', '0000-00-00', '', '', 0, 'nurma', 'ac43724f16e9241d990427ab7c8f4228', 'user'),
(2, 'Yusuf A.H', 'dimana-mana', '', '', '0000-00-00', 'Strata 1', '', 0, 'yussan', 'ac43724f16e9241d990427ab7c8f4228', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aksiSimpanan`
--
ALTER TABLE `aksiSimpanan`
 ADD PRIMARY KEY (`id_aksi`), ADD KEY `id_simpanan` (`id_simpanan`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
 ADD PRIMARY KEY (`no_anggota`), ADD UNIQUE KEY `no_identitas` (`no_identitas`);

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
 ADD PRIMARY KEY (`id_angsuran`), ADD KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indexes for table `jaminan`
--
ALTER TABLE `jaminan`
 ADD PRIMARY KEY (`id_jaminan`), ADD KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
 ADD PRIMARY KEY (`id_pinjaman`), ADD KEY `no_anggota` (`no_anggota`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
 ADD PRIMARY KEY (`id_simpanan`), ADD KEY `no_anggota` (`no_anggota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aksiSimpanan`
--
ALTER TABLE `aksiSimpanan`
MODIFY `id_aksi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
MODIFY `no_anggota` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
MODIFY `id_angsuran` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jaminan`
--
ALTER TABLE `jaminan`
MODIFY `id_jaminan` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
MODIFY `id_pinjaman` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aksiSimpanan`
--
ALTER TABLE `aksiSimpanan`
ADD CONSTRAINT `aksiSimpanan_ibfk_1` FOREIGN KEY (`id_simpanan`) REFERENCES `simpanan` (`id_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `angsuran`
--
ALTER TABLE `angsuran`
ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jaminan`
--
ALTER TABLE `jaminan`
ADD CONSTRAINT `jaminan_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
