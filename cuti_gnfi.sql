-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2017 at 04:18 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuti_gnfi`
--

-- --------------------------------------------------------

--
-- Table structure for table `coment`
--

CREATE TABLE `coment` (
  `id_comen` int(5) NOT NULL,
  `id_pcuti` int(10) DEFAULT NULL,
  `id_pegawai` varchar(10) DEFAULT NULL,
  `komentar` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coment`
--

INSERT INTO `coment` (`id_comen`, `id_pcuti`, `id_pegawai`, `komentar`) VALUES
(1, 1, 'p09', 'Nyobak'),
(2, 1, 'p06', 'oppoooo......?'),
(3, 1, 'p09', 'Nyobak Ae....'),
(4, 1, 'p06', 'oo.....');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(3, 'Web Development'),
(5, 'Creative Designer'),
(6, 'Motion Graphic Animator'),
(7, 'Admin Coordinator'),
(8, 'Content Writer / Editor'),
(9, 'General Affair Staff'),
(10, 'Freelance Writer'),
(11, 'Social Media Administrative'),
(12, 'Freelance Videographer'),
(13, 'Founder And Editor In Chief'),
(14, 'Content Management Officer'),
(15, 'Content Development Assistant'),
(16, 'Executive Editor'),
(17, 'Creative Director'),
(18, 'Community & Merchandise Executive'),
(19, 'Chief Executive Officer'),
(20, 'Chief Operation Officer'),
(21, 'Social Media Manager'),
(22, 'Chief Technology Officer');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cuti`
--

CREATE TABLE `jenis_cuti` (
  `id_jcuti` int(10) NOT NULL,
  `nama_cuti` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id_jcuti`, `nama_cuti`) VALUES
(2, 'Tahunan'),
(3, 'Khusus');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(10) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `kategori`) VALUES
(3, 'Elektronik'),
(4, 'Perabotan'),
(5, 'Anggaran Dana');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_bergabung` date DEFAULT NULL,
  `alamat_pegawai` varchar(100) DEFAULT NULL,
  `telpon_pegawai` varchar(12) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jatah_cuti` int(11) DEFAULT NULL,
  `status_pegawai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `id_jabatan`, `jenis_kelamin`, `email`, `tgl_lahir`, `tgl_bergabung`, `alamat_pegawai`, `telpon_pegawai`, `foto`, `username`, `password`, `jatah_cuti`, `status_pegawai`) VALUES
('p02', 'Akhyari Hananto', 8, 'Laki-Laki', 'akhyaree@goodnews.id', NULL, NULL, '', '08113051846', 'cowok.png', 'Akhyari', '$2y$10$LoUa/IiEB2tc9mvusKj99uz1xHvJ5C.6PTuf9HaR4AkRuiepYyjRq', 14, ''),
('p03', 'R. Andini Ratu F', 7, 'Perempuan', 'andiniratu@goodnews.id', NULL, NULL, 'Jl. Selong Permai Blok E/04 RT.003 RW.009 Desa/Kelurahan Gunung Sekar Kecamatan Sampang Kabupaten Sa', '08123502236', 'female.png', 'Andini', '$2y$10$nQuCy9pQhsUTLoUJ4PS.gOppMP6UWoGxJs96aBZITFdw.PqaKIftm', 14, 'admin'),
('p04', 'Wahyu Aji ', 19, 'Laki-Laki', 'aji@goodnews.id', '0000-00-00', '0000-00-00', 'Surabaya', '0811971261', 'cowok.png', 'Wahyu', '$2y$10$Fq6GRdkKbNkT.2htQyJcPe7XuTRSTAz5x2bMQfq4Pjfu4iuDDumx2', 14, 'pegawai'),
('p05', 'Shinta Soebijandono', 20, 'Perempuan', 'shinta@goodnews.id', NULL, NULL, '', '08179315129', 'female.png', 'Shinta', '$2y$10$1OAwukJQVt2duYgC8IpMoOrU6sOVqfeqt3AVZT1h6HX9WsDmNFJ/S', 14, 'pegawai'),
('p06', 'Imam Muttaqin', 22, 'Laki-Laki', 'im@goodnews.id', '1992-07-15', '0000-00-00', '', '081331052911', 'cowok.png', 'Imam', '$2y$10$0IV0ev1Bdzidt2GdtbdoQ.W46laLp8M68P3sxZ7ULeEtpABr1E6OS', 14, 'pegawai'),
('p07', 'Dwina Henti Rahmawati', 21, 'Perempuan', 'dwina@goodnews.id', NULL, NULL, 'Bumi Ilalang Indah RT.003 RW.001 Desa/Kelurahan Jabon Kecamatan Mojoanyar Mojokerto', '081335560747', 'female.png', 'Dwina', '$2y$10$9nENJYOpYZ4G/B5FYBFXe.funrwGjJvLqYMJfOCdL9dI940.rTmgK', 14, 'pegawai'),
('p08', 'Bagus Dovyanto Ramadhan', 14, 'Laki-Laki', 'bagusdr@goodnews.id', NULL, NULL, 'Jl. Danau Maninjau Raya 81-B1 G38 RT.002 RW.008 Desa/Kelurahan Sawojajar Kecamatan Kedungkandang Mal', '082225253427', 'cowok.png', 'Bagus', '$2y$10$UrowwYpNW8ajSFa0nSARnOMrtHiwUTTlQiC4UzRbFA./OBLHeMpNC', 14, 'pegawai'),
('p09', 'Yufi Eko Firmansyah', 3, 'Laki-Laki', 'yufieko@goodnews.id', NULL, NULL, 'Dusun Ngijingan RT.001 RW.002 Desa/Kelurahan Purwojati Kecamatan Ngoro Mojokerto', '08993766637', 'cowok.png', 'Yufi', '$2y$10$rt9iI/szhyiqR3o.6ZTRa.jZxw.tJcyTLyQQXqBBpd2tFZsPL6je6', 14, 'pegawai'),
('p10', 'Juang M Nugraha', 17, 'Laki-Laki', 'djoeank@goodnews.id', NULL, NULL, 'Blok Sukajadi RT.023 RW.009 Desa/Kelurahan Sukajati Kecamatan Haurgeulis Indramayu', '08996259519', 'cowok.png', 'Juang', '$2y$10$RWIuuc8iG0gaaEcDVs5Y3uok7oasG1213xoLicfUuQkvVR0c1KqOm', 14, 'pegawai'),
('p11', 'Muchamad Dwi Roma Nursita', 6, 'Laki-Laki', 'dwiroma@goodnews.id', NULL, NULL, 'Somowiharjo 34 RT.003 RW.013 Desa/Kelurahan Babat Kecamatan Babat Lamongan', '087853640716', 'cowok.png', 'Muchamad', '$2y$10$dp6Vwu/o5smE1tFBPBU/fu7ju/CxurgHr5lKeQ/Bm4HACXp9VEFii', 14, 'pegawai'),
('p12', 'Aldila Dwiki Himawan', 5, 'Laki-Laki', 'aldiladwikihimawan@gmail.com', NULL, NULL, 'Jl. Lamongan 01/18 RT.005 RW.005 Desa/kelurahan Yosowilangun Kecamatan Manyar Gresik', '089677411243', 'cowok.png', 'Aldila', '$2y$10$vnpyfE4834RudYNWDDRAWOsuLBDyJuFNm1P99vyWrZGMxr4iB2tSu', 14, 'pegawai'),
('p13', 'Arifina Budi Aswati', 8, 'Perempuan', 'arifina@goodnews.id', NULL, NULL, 'Jl. Arwana No.12 RT.031 RW.005 Desa/Kelurahan Minomartani Kecamatan Ngaglik Kabupaten Sleman DIY', '', 'female.png', 'Arifina', '$2y$10$S2fp9nZEsqrRZnHE5QVIte5Cl.WotIpeK2jQClLR/ONng0Jb1pv2m', 14, 'pegawai'),
('p14', 'Antok Kurniawan', 9, 'Laki-Laki', 'goul.hanami@gmail.com', NULL, NULL, 'Jl. Dukuh Menanggal 8/27 RT.001 RW.005 Kel. Dukuh Menanggal Kec. Gayungan Surabaya', '85853071737', 'cowok.png', 'Antok', '$2y$10$83Hf0OywD4f5aEm5bitcs.KAPaSrprOvqdhV3crFIAn3j.sxsDv5m', 14, 'pegawai'),
('p15', 'Akhmad Rianor Asrari Puadi', 10, 'Laki-Laki', 'asraripuadi@goodnews.id', NULL, NULL, 'Jl. Ir H Juanda 28 Komp. Pasar RT.028 RW.001 Desa/Kelurahan Ketapang Kecamatan Mentawa Baru Ketapang', '085651257278', 'cowok.png', 'Akhmad', '$2y$10$WVYvFFKEbgyU3t/wQSX8YOunqBecAJiZg9KsaGiT8EpJpS5ThLIfK', 14, 'pegawai'),
('p16', 'Imama Lavi Insani', 10, 'Perempuan', 'imalavins@goodnews.id', NULL, NULL, 'Kepatihan RT.004 RW.002 Desa/Kelurahan Kepatihan Kecamatan Tulangan Sidoarjo', '085852711572', 'female.png', 'Imama', '$2y$10$doKQfpvudNtPjUITm.wpc.0HNtQmMLPlmXJisXIoyRXQDevBZFXnq', 14, 'pegawai'),
('p17', 'Mochamad Fachrezy Zulfikar', 11, 'Laki-Laki', 'fachrezybisnis@gmail.com', NULL, NULL, 'Kupang Krajan 2 No.34A Kelurahan Kupang Krajan Kecamatan Sawahan Surabaya', '083849194848', 'cowok.png', 'Mochamad', '$2y$10$GUzPd3PRAuzq1JKTXwWdp.P0sM2kula0FE2JamXMgUolCgodJY/U2', 14, 'pegawai'),
('p18', 'Al Hamdani', 12, 'Laki-Laki', '', NULL, NULL, 'Jl. Masjid RT.002 RW.002 Desa/Kelurahan Bagan Melibur Kecamatan Merbau Kabupaten Kepulauan Meranti P', '', 'cowok.png', 'Al', '$2y$10$p402ffu6vdwyqbPYj24/B.Um1r6Er42QWSaiSPeQMgT.V13BwXnn2', 14, 'pegawai'),
('p19', 'Isniyah Zulfah', 10, 'Perempuan', '', NULL, NULL, 'Jl. Gubeng Kertajaya gang 5C No.39A Surabaya', '', 'female.png', 'Isniyah', '$2y$10$p7n9m9htxWUSDZEp.RoSTuPuy0jGoYvAwZafE9qQkb68kgzgWgTc.', 14, 'pegawai'),
('p20', 'Widya Lestari', 10, 'Perempuan', '', NULL, NULL, 'Jl. Dharmawangsa IV nomor 23 Surabaya', '', 'female.png', 'Widya', '$2y$10$7sBPXGwIU7HfersDe6XZ6e6H4W2YikqNnQUrq4jnCKJwa9UYi4uWe', 14, 'pegawai'),
('p21', 'Agustina Suminar', 10, 'Perempuan', '', NULL, NULL, 'Jl. Karamenjangan 8 No.7 Surabaya', '', 'female.png', 'Agustina', '$2y$10$kCQPmJ8miKoGwIN6/HM10OBkNY52IsCHPRDy.vuC9otsLhRMrUPbS', 14, 'pegawai'),
('p22', 'yuan', 3, 'Laki-Laki', 'yuaneko95@gmail.com', '2017-03-15', '2017-03-25', 'PPI', '0897765', 'ar2.jpg', 'yuaneko', '$2y$10$cVsDJsw/3f8Lk4tJQCWrdOXwUSePv0PcqmjXuA.eNpkKFBwW9CV0y', 14, ''),
('p23', 'Yatim', 17, 'Laki-Laki', 'yr@gmail.com', '1995-06-14', '2017-03-10', 'Kenjeran', '098763456789', 'ar2.jpg', 'yatim', '$2y$10$upZyF.nZsmi8W067CzDDY.Me28uoGHRVNGi3y.OF.fwRped6Aiy0W', 14, 'pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_approval`
--

CREATE TABLE `pegawai_approval` (
  `id` int(11) NOT NULL,
  `id_pegawai` varchar(10) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai_approval`
--

INSERT INTO `pegawai_approval` (`id`, `id_pegawai`, `created`) VALUES
(2, 'p04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_approval_list`
--

CREATE TABLE `pegawai_approval_list` (
  `id` int(11) NOT NULL,
  `approval_id` varchar(10) NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `type` varchar(21) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `is_approval` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai_approval_list`
--

INSERT INTO `pegawai_approval_list` (`id`, `approval_id`, `object_id`, `type`, `created`, `is_approval`) VALUES
(1, 'p06', 1, 'cuti', '2017-03-10', 1),
(2, 'p04', 1, 'cuti', '2017-03-10', 0),
(3, 'p06', 1, 'barang', '2017-03-10', 1),
(4, 'p04', 1, 'barang', '2017-03-10', 1),
(5, 'p06', 2, 'cuti', '2017-03-11', 0),
(6, 'p04', 2, 'cuti', '2017-03-11', 0),
(7, 'p06', 2, 'barang', '2017-03-11', 0),
(8, 'p04', 2, 'barang', '2017-03-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_group`
--

CREATE TABLE `pegawai_group` (
  `id` int(11) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `grup` varchar(15) DEFAULT NULL,
  `is_coordinator` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai_group`
--

INSERT INTO `pegawai_group` (`id`, `id_pegawai`, `grup`, `is_coordinator`) VALUES
(1, 'p09', 'TECHINNO', 0),
(2, 'p06', 'TECHINNO', 1),
(7, 'p22', 'ADMIN', 2),
(8, 'p02', 'REDAKSI', 1),
(9, 'p13', 'REDAKSI', 0),
(10, 'p08', 'REDAKSI', 0),
(11, 'p05', 'OPERASIONAL', 1),
(12, 'p03', 'OPERASIONAL', 0),
(13, 'p04', 'OPERASIONAL', 2),
(14, 'p10', 'CREATIVE', 1),
(15, 'p12', 'CREATIVE', 0),
(16, 'p11', 'CREATIVE', 0),
(19, 'p07', 'MEDSOS', 1),
(20, 'p17', 'MEDSOS', 0),
(21, 'p23', 'ADMIN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_barang`
--

CREATE TABLE `pengadaan_barang` (
  `id_pbarang` int(10) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `berkas` varchar(50) NOT NULL,
  `alasan` text NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `note` text,
  `tgl_sah` date DEFAULT NULL,
  `disahkan` varchar(20) DEFAULT NULL,
  `note2` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_barang`
--

INSERT INTO `pengadaan_barang` (`id_pbarang`, `id_pegawai`, `id_kategori`, `nama_barang`, `tgl_pengajuan`, `berkas`, `alasan`, `status`, `note`, `tgl_sah`, `disahkan`, `note2`) VALUES
(1, 'p09', 5, 'uang', '2017-03-10', 'Daftar Nilai Mahasiswa.docx', 'Liputan', 'disetujui', 'nyobak', '2017-03-12', 'wahyu', ''),
(2, 'p09', 4, 'nyobak', '2017-03-11', 'Daftar Nilai Mahasiswa.docx', 'nyobak', 'Belum dikonfirmasi', '', '0000-00-00', '', 'mboh jon');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_cuti`
--

CREATE TABLE `permohonan_cuti` (
  `id_pcuti` int(10) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `id_jcuti` int(10) NOT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `lama_cuti` int(4) NOT NULL,
  `tgl_mulai_cuti` date NOT NULL,
  `tgl_akhir_cuti` date NOT NULL,
  `alasan` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `note` text,
  `tgl_sah` date DEFAULT NULL,
  `disahkan` varchar(20) DEFAULT NULL,
  `note2` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permohonan_cuti`
--

INSERT INTO `permohonan_cuti` (`id_pcuti`, `id_pegawai`, `id_jcuti`, `tgl_pengajuan`, `lama_cuti`, `tgl_mulai_cuti`, `tgl_akhir_cuti`, `alasan`, `status`, `note`, `tgl_sah`, `disahkan`, `note2`) VALUES
(1, 'p09', 3, '2017-03-10', 3, '2017-03-15', '2017-03-18', 'sakit', 'disetujui 1 approvel', 'nyobak 1', '2017-03-11', 'imam', 'sip men gwhjeklop wiu345,w;pkgs[lezdvofhlu'),
(2, 'p09', 3, '2017-03-11', 3, '2017-03-14', '2017-03-17', 'nikah', 'Belum dikonfirmasi', 'nyobak 2', '0000-00-00', '', 'sip jon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coment`
--
ALTER TABLE `coment`
  ADD KEY `id_comen` (`id_comen`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_cuti`
--
ALTER TABLE `jenis_cuti`
  ADD PRIMARY KEY (`id_jcuti`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `fk_jabatan` (`id_jabatan`),
  ADD KEY `nama_pegawai` (`nama_pegawai`);

--
-- Indexes for table `pegawai_approval`
--
ALTER TABLE `pegawai_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pegawai_approval` (`id_pegawai`);

--
-- Indexes for table `pegawai_approval_list`
--
ALTER TABLE `pegawai_approval_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_approval` (`approval_id`);

--
-- Indexes for table `pegawai_group`
--
ALTER TABLE `pegawai_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pegawai_group` (`id_pegawai`);

--
-- Indexes for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD PRIMARY KEY (`id_pbarang`),
  ADD KEY `fk_kategori` (`id_kategori`),
  ADD KEY `fk_pegawai1` (`id_pegawai`);

--
-- Indexes for table `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  ADD PRIMARY KEY (`id_pcuti`),
  ADD KEY `fk_pegawai` (`id_pegawai`),
  ADD KEY `fk_jenis_cuti` (`id_jcuti`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coment`
--
ALTER TABLE `coment`
  MODIFY `id_comen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `jenis_cuti`
--
ALTER TABLE `jenis_cuti`
  MODIFY `id_jcuti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pegawai_approval`
--
ALTER TABLE `pegawai_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pegawai_approval_list`
--
ALTER TABLE `pegawai_approval_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pegawai_group`
--
ALTER TABLE `pegawai_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  MODIFY `id_pbarang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  MODIFY `id_pcuti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_approval`
--
ALTER TABLE `pegawai_approval`
  ADD CONSTRAINT `fk_pegawai_approval` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_approval_list`
--
ALTER TABLE `pegawai_approval_list`
  ADD CONSTRAINT `fk_approval` FOREIGN KEY (`approval_id`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_group`
--
ALTER TABLE `pegawai_group`
  ADD CONSTRAINT `fk_pegawai_group` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawai1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  ADD CONSTRAINT `fk_jenis_cuti` FOREIGN KEY (`id_jcuti`) REFERENCES `jenis_cuti` (`id_jcuti`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `jatah_cuti_sch` ON SCHEDULE EVERY 1 YEAR STARTS '2018-01-01 00:00:00' ENDS '2026-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE pegawai SET jatah_cuti = '14'$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
