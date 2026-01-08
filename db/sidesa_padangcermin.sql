-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 05:49 PM
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
-- Database: `sidesa_padangcermin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','operator','kades') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin SIDESA', 'admin1', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'Operator Desa', 'operator1', '2407bd807d6ca01d1bcd766c730cec9a', 'operator'),
(3, 'Kepala Desa', 'kades1', '1bd5da988b535455b33007aca5bb5b87', 'kades');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aparat_desa`
--

CREATE TABLE `tb_aparat_desa` (
  `id_aparat` int(11) NOT NULL,
  `nama_aparat` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_aparat_desa`
--

INSERT INTO `tb_aparat_desa` (`id_aparat`, `nama_aparat`, `jabatan`, `periode`, `foto`) VALUES
(1, 'Rintan Zulhaini', 'Sekretaris Desa', '2025 - 2030', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `nomor_dokumen` varchar(50) NOT NULL,
  `file_pdf` varchar(100) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_informasi_desa`
--

CREATE TABLE `tb_informasi_desa` (
  `id_informasi` int(11) NOT NULL,
  `jenis` enum('Berita','Pengumuman','Agenda') NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_informasi_desa`
--

INSERT INTO `tb_informasi_desa` (`id_informasi`, `jenis`, `judul`, `isi`, `tanggal`, `penulis`) VALUES
(1, 'Agenda', 'Pembangunan Jalan Desa', 'Pembangunan jalan sejauh 15KM menggunakan APBD.', '2026-01-08', 'Admin SIDESA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kk`
--

CREATE TABLE `tb_kk` (
  `id_kk` int(11) NOT NULL,
  `nomor_kk` varchar(20) NOT NULL,
  `kepala_keluarga` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `rt` varchar(3) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `kode_pos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kk`
--

INSERT INTO `tb_kk` (`id_kk`, `nomor_kk`, `kepala_keluarga`, `alamat`, `rt`, `rw`, `kode_pos`) VALUES
(1, '1806010101010001', 'Sutrisno', 'Dusun Sukamaju, Desa Padang Cermin', '001', '002', '35371'),
(2, '1806010101010002', 'Nurhayati', 'Dusun Suka Damai, Desa Padang Cermin', '002', '002', '35371'),
(3, '1806010101010003', 'Mulyadi', 'Dusun Pesisir, Desa Padang Cermin', '003', '001', '35371'),
(4, '1806010202010001', 'Sutrisno', 'Dusun Sukamaju, Desa Padang Cermin', '001', '001', '35371'),
(5, '1806010202010002', 'Ahmad Yani', 'Dusun Sukamaju, Desa Padang Cermin', '001', '001', '35371'),
(6, '1806010202010003', 'Nurhayati', 'Dusun Sukamaju, Desa Padang Cermin', '002', '001', '35371'),
(7, '1806010202010004', 'Mulyadi', 'Dusun Suka Damai, Desa Padang Cermin', '002', '001', '35371'),
(8, '1806010202010005', 'Hendra Gunawan', 'Dusun Suka Damai, Desa Padang Cermin', '003', '001', '35371'),
(9, '1806010202010006', 'Rukmini', 'Dusun Suka Damai, Desa Padang Cermin', '003', '001', '35371'),
(10, '1806010202010007', 'Wayan Sudarma', 'Dusun Pesisir, Desa Padang Cermin', '004', '002', '35371'),
(11, '1806010202010008', 'Komang Ayu', 'Dusun Pesisir, Desa Padang Cermin', '004', '002', '35371'),
(12, '1806010202010009', 'Maria Magdalena', 'Dusun Pesisir, Desa Padang Cermin', '005', '002', '35371'),
(13, '1806010202010010', 'Yohanes Sihombing', 'Dusun Pesisir, Desa Padang Cermin', '005', '002', '35371');

-- --------------------------------------------------------

--
-- Table structure for table `tb_layanan`
--

CREATE TABLE `tb_layanan` (
  `id_layanan` int(11) NOT NULL,
  `kode_layanan` varchar(10) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_layanan`
--

INSERT INTO `tb_layanan` (`id_layanan`, `kode_layanan`, `nama_layanan`, `deskripsi`) VALUES
(1, 'SKD', 'Surat Keterangan Domisili', 'Surat keterangan domisili untuk kebutuhan administrasi warga.'),
(2, 'SKU', 'Surat Keterangan Usaha', 'Surat keterangan usaha untuk kebutuhan administrasi/UMKM.'),
(3, 'SKTM', 'Surat Keterangan Tidak Mampu', 'Surat keterangan tidak mampu untuk sekolah/rumah sakit/bantuan.'),
(4, 'SKL', 'Surat Keterangan Kelahiran', 'Surat keterangan kelahiran untuk administrasi kependudukan.'),
(5, 'SKK', 'Surat Keterangan Kematian', 'Surat keterangan kematian untuk administrasi kependudukan.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permohonan`
--

CREATE TABLE `tb_permohonan` (
  `id_permohonan` int(11) NOT NULL,
  `id_warga` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_warga`
--

CREATE TABLE `tb_warga` (
  `id_warga` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gol_darah` enum('A','B','AB','O','-') NOT NULL DEFAULT '-',
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `id_kk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_warga`
--

INSERT INTO `tb_warga` (`id_warga`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `gol_darah`, `agama`, `alamat`, `id_kk`) VALUES
(1, '11111111111111111111', 'Sutrisno1', 'P', 'Pesawaran1', '1975-01-19', 'B', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin1', 12),
(2, '1806010502780001', 'Siti Aminah1', 'P', 'Pesawaran1', '1978-02-05', 'A', 'Islam1', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin1', 12),
(3, '1806011404020003', 'Rizki Pratama', 'L', 'Pesawaran', '2002-04-14', 'O', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin', 1),
(4, '1806010909100017', 'Nadia Putri', 'P', 'Pesawaran', '2010-09-09', 'B', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin', 13),
(5, '1806010303800004', 'Ahmad Yani', 'L', 'Pesawaran', '1980-03-03', 'B', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin', 2),
(6, '1806012208850005', 'Nur Aisyah', 'P', 'Pesawaran', '1985-08-22', 'AB', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin', 2),
(7, '1806010110100006', 'Fauzan Yani', 'L', 'Pesawaran', '2010-10-01', 'B', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin', 13),
(8, '1806011509140018', 'Alya Yani', 'P', 'Pesawaran', '2014-09-15', 'A', 'Islam', 'Dusun Sukamaju RT 001/RW 001, Desa Padang Cermin', 2),
(9, '1806010709720007', 'Nurhayati', 'P', 'Pesawaran', '1972-09-07', 'A', 'Islam', 'Dusun Sukamaju RT 002/RW 001, Desa Padang Cermin', 3),
(10, '1806010906700019', 'Slamet Riyadi', 'L', 'Pesawaran', '1970-06-09', 'O', 'Islam', 'Dusun Sukamaju RT 002/RW 001, Desa Padang Cermin', 3),
(11, '1806010206990008', 'Andi Saputra', 'L', 'Pesawaran', '1999-06-02', 'O', 'Islam', 'Dusun Sukamaju RT 002/RW 001, Desa Padang Cermin', 3),
(12, '1806010612050020', 'Putri Anggraini', 'P', 'Pesawaran', '2005-12-06', 'B', 'Islam', 'Dusun Sukamaju RT 002/RW 001, Desa Padang Cermin', 3),
(13, '1806011804680009', 'Mulyadi', 'L', 'Pesawaran', '1968-04-18', 'O', 'Islam', 'Dusun Suka Damai RT 002/RW 001, Desa Padang Cermin', 4),
(14, '1806011508700010', 'Sri Wahyuni', 'P', 'Pesawaran', '1970-08-15', 'A', 'Islam', 'Dusun Suka Damai RT 002/RW 001, Desa Padang Cermin', 4),
(15, '1806010501000011', 'Dewi Lestari', 'P', 'Pesawaran', '2000-01-05', 'B', 'Islam', 'Dusun Suka Damai RT 002/RW 001, Desa Padang Cermin', 4),
(16, '1806012303080021', 'Bima Prakoso', 'L', 'Pesawaran', '2008-03-23', 'AB', 'Islam', 'Dusun Suka Damai RT 002/RW 001, Desa Padang Cermin', 4),
(17, '1806011105790022', 'Hendra Gunawan', 'L', 'Pesawaran', '1979-05-11', 'B', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 5),
(18, '1806010211820023', 'Rina Oktaviani', 'P', 'Pesawaran', '1982-11-02', 'A', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 5),
(19, '1806011609040024', 'Dimas Gunawan', 'L', 'Pesawaran', '2004-09-16', 'O', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 5),
(20, '1806010401120025', 'Salsa Gunawan', 'P', 'Pesawaran', '2012-01-04', 'B', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 5),
(21, '1806012406760026', 'Rukmini', 'P', 'Pesawaran', '1976-06-24', 'O', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 6),
(22, '1806011706730027', 'Suyanto', 'L', 'Pesawaran', '1973-06-17', 'A', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 6),
(23, '1806012909990028', 'Wahyu Saputra', 'L', 'Pesawaran', '1999-09-29', 'AB', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 6),
(24, '1806010801060029', 'Nisa Safitri', 'P', 'Pesawaran', '2006-01-08', 'B', 'Islam', 'Dusun Suka Damai RT 003/RW 001, Desa Padang Cermin', 6),
(25, '1806010907720012', 'Wayan Sudarma', 'L', 'Pesawaran', '1972-07-09', 'O', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 7),
(26, '1806011405750013', 'Ni Luh Sari', 'P', 'Pesawaran', '1975-05-14', 'A', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 7),
(27, '1806012509030014', 'Kadek Putra', 'L', 'Pesawaran', '2003-09-25', 'O', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 7),
(28, '1806011201120030', 'Made Ariana', 'P', 'Pesawaran', '2012-01-12', 'B', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 7),
(29, '1806010108800031', 'Komang Ayu', 'P', 'Pesawaran', '1980-08-01', 'A', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 8),
(30, '1806011206780032', 'I Putu Gede', 'L', 'Pesawaran', '1978-06-12', 'O', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 8),
(31, '1806011307060033', 'Putu Dwi', 'L', 'Pesawaran', '2006-07-13', 'AB', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 8),
(32, '1806012409090034', 'Komang Sri', 'P', 'Pesawaran', '2009-09-24', 'B', 'Hindu', 'Dusun Pesisir RT 004/RW 002, Desa Padang Cermin', 8),
(33, '1806012006700015', 'Maria Magdalena', 'P', 'Pesawaran', '1970-06-20', 'AB', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 9),
(34, '1806011704680035', 'Fransiskus Yanto', 'L', 'Pesawaran', '1968-04-17', 'O', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 9),
(35, '1806011212980016', 'Yohanes Prakoso', 'L', 'Pesawaran', '1998-12-12', 'B', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 9),
(36, '1806010510050036', 'Melinda Prakoso', 'P', 'Pesawaran', '2005-10-05', 'A', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 9),
(37, '1806010211700037', 'Yohanes Sihombing', 'L', 'Pesawaran', '1970-11-02', 'O', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 10),
(38, '1806010903760038', 'Marta Sihombing', 'P', 'Pesawaran', '1976-03-09', 'A', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 10),
(39, '1806011410010039', 'Samuel Sihombing', 'L', 'Pesawaran', '2001-10-14', 'B', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 10),
(40, '1806012204070040', 'Debora Sihombing', 'P', 'Pesawaran', '2007-04-22', 'AB', 'Kristen', 'Dusun Pesisir RT 005/RW 002, Desa Padang Cermin', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_aparat_desa`
--
ALTER TABLE `tb_aparat_desa`
  ADD PRIMARY KEY (`id_aparat`);

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD UNIQUE KEY `id_permohonan` (`id_permohonan`),
  ADD UNIQUE KEY `nomor_dokumen` (`nomor_dokumen`);

--
-- Indexes for table `tb_informasi_desa`
--
ALTER TABLE `tb_informasi_desa`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `tb_kk`
--
ALTER TABLE `tb_kk`
  ADD PRIMARY KEY (`id_kk`),
  ADD UNIQUE KEY `nomor_kk` (`nomor_kk`);

--
-- Indexes for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `fk_permohonan_warga` (`id_warga`),
  ADD KEY `fk_permohonan_layanan` (`id_layanan`),
  ADD KEY `idx_permohonan_tanggal` (`tanggal_permohonan`);

--
-- Indexes for table `tb_warga`
--
ALTER TABLE `tb_warga`
  ADD PRIMARY KEY (`id_warga`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `fk_warga_kk` (`id_kk`),
  ADD KEY `idx_warga_nama` (`nama_lengkap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_aparat_desa`
--
ALTER TABLE `tb_aparat_desa`
  MODIFY `id_aparat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_informasi_desa`
--
ALTER TABLE `tb_informasi_desa`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kk`
--
ALTER TABLE `tb_kk`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  MODIFY `id_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_warga`
--
ALTER TABLE `tb_warga`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD CONSTRAINT `fk_dokumen_permohonan` FOREIGN KEY (`id_permohonan`) REFERENCES `tb_permohonan` (`id_permohonan`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  ADD CONSTRAINT `fk_permohonan_layanan` FOREIGN KEY (`id_layanan`) REFERENCES `tb_layanan` (`id_layanan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_permohonan_warga` FOREIGN KEY (`id_warga`) REFERENCES `tb_warga` (`id_warga`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_warga`
--
ALTER TABLE `tb_warga`
  ADD CONSTRAINT `fk_warga_kk` FOREIGN KEY (`id_kk`) REFERENCES `tb_kk` (`id_kk`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
