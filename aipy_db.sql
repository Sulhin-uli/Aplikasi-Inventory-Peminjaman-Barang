-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 09:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aipy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int(11) UNSIGNED NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `kondisi` varchar(5) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `tanggal_register` date DEFAULT NULL,
  `id_ruang` int(11) DEFAULT NULL,
  `kode_inventaris` varchar(20) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `asal_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nama`, `kondisi`, `keterangan`, `jumlah`, `jenis`, `tanggal_register`, `id_ruang`, `kode_inventaris`, `id_petugas`, `asal_barang`) VALUES
(93, 'Lenovo thinkpad', 'Baik', '-', 8, 'Elektronik', '2021-02-27', 24, '-', 0, 'Hibah');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `nik` int(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `telepon` int(15) DEFAULT NULL,
  `posisi` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nik`, `alamat`, `jenis_kelamin`, `telepon`, `posisi`, `tgl_lahir`) VALUES
(26, 'Taufiq Hidayat ,A.md', 1223, '--', 'Laki-laki', 123456, 'Guru', '1993-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `id_inventaris` int(11) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jam_pinjam` time DEFAULT NULL,
  `jam_kembali` time DEFAULT NULL,
  `status_peminjaman` varchar(20) NOT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `keperluan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_pegawai`, `nama_siswa`, `id_inventaris`, `jumlah_pinjam`, `tanggal_pinjam`, `tanggal_kembali`, `jam_pinjam`, `jam_kembali`, `status_peminjaman`, `waktu_kembali`, `keperluan`) VALUES
(47, 15, 'iugy', 59, 1, '2021-01-02', '2021-01-02', '14:36:46', '14:37:59', 'Dikembalikan', NULL, ''),
(48, 19, '', 63, 1, '2021-01-04', '2021-01-04', '08:30:27', '08:32:56', 'Dikembalikan', NULL, ''),
(49, 19, 'Rifki ', 63, 1, '2021-01-04', '2021-01-05', '00:00:00', '05:27:55', 'Dikembalikan', NULL, ''),
(50, 19, 'io', 63, 1, '2021-01-05', '2021-01-05', '00:00:00', '05:36:36', 'Dikembalikan', NULL, ''),
(51, 19, 'Rifki ', 63, 1, '2021-01-05', '2021-01-05', '00:00:00', '05:37:27', 'Dikembalikan', NULL, ''),
(53, 19, 'genandra', 72, 1, '2021-01-05', '2021-01-05', '05:46:18', '06:03:13', 'Dikembalikan', NULL, ''),
(77, 24, 'qwqwq', 73, 2, '2021-01-12', '2021-01-12', '16:05:00', '15:05:00', 'Dikembalikan', '2021-01-11 15:05:56', 'wew');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `id_inventaris` int(11) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jam_pinjam` time DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jam_kembali` time DEFAULT NULL,
  `status_peminjaman` varchar(20) NOT NULL,
  `keperluan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `id_pegawai`, `nama_siswa`, `id_inventaris`, `jumlah_pinjam`, `tanggal_pinjam`, `jam_pinjam`, `tanggal_kembali`, `jam_kembali`, `status_peminjaman`, `keperluan`) VALUES
(114, 26, '-', 93, 1, '2021-02-05', '08:31:00', '2021-02-04', '08:30:00', 'Sedang dipinjam', '-');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) UNSIGNED NOT NULL,
  `nama_ruang` varchar(20) DEFAULT NULL,
  `kode_ruang` varchar(20) DEFAULT NULL,
  `keterangan_ruang` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`, `keterangan_ruang`) VALUES
(24, 'Lab Multimedia', 'R002', '-'),
(25, 'Lab RPL', 'R003', '-'),
(26, 'Lab TSM', 'R004', '-');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `id_level`) VALUES
(30, 'admin123', '$2y$10$aNKd9G8/wFsLZulYfPvlSekTjv9eOAvtpI0KKaS.3bBd.8gvr4uTS', 'Administrator', 1),
(31, 'kepalasekolah', '$2y$10$WrbF4j6DWNv.ThaCo1NU8e/F3HqJruc8c1BD2v01UcTKyMf/xguou', 'kepalasekolah', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
