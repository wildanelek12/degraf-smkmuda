-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 04:42 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinaumarketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id_forum` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `isi` longtext NOT NULL,
  `tgl_forum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id_forum`, `username`, `isi`, `tgl_forum`) VALUES
(1, '123', 'yok bisa yok', '2021-01-01 15:56:47'),
(2, '123', 'yok bisa yok', '2021-01-01 15:57:37'),
(3, '890', 'monggo pak', '2021-01-01 16:21:07'),
(4, '890', 'perkenalkan saya murid baru', '2021-01-01 16:21:20'),
(5, '098', 'saya juga murid baru pak', '2021-01-01 16:26:32'),
(6, '321', 'saya tidak pak', '2021-01-01 16:27:32'),
(9, '098', 'coba', '2021-01-10 16:59:28'),
(10, '098', 'lagi', '2021-01-10 16:59:36'),
(11, '098', 'again', '2021-01-10 16:59:58'),
(12, '123', 'gggggggggggggggggggggggggggggggggggggggggggggggggggggulkjgkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj11111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111122222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222221', '2021-02-23 22:37:17'),
(13, '123', '7777777777777777777777777777777777777777777777777777777777777777777777777777777777777777', '2021-02-23 22:46:57'),
(14, '098', 'dsdsgsfgfdjhfkhkhk', '2021-03-02 20:33:50'),
(15, '123', 'dfffffffffffffffffffffffffffffffffffffffdddddddddddddddddddddddddddddddddddddddddddddddddddddddfgggggggggggggggggggggggggggggggggDGFDSGDWGDW2HHHHHHHHHHHHHHHHHHHHHHHH', '2021-04-05 22:42:46'),
(16, '123', 'tes', '2021-04-06 13:35:17'),
(17, '123', 'tes\r\ncoba lagi', '2021-04-06 13:35:27'),
(18, '098', 'bossss\r\n', '2021-04-06 13:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kuis`
--

CREATE TABLE `hasil_kuis` (
  `id_hasil` int(11) NOT NULL,
  `id_kuis` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `soal` longtext NOT NULL,
  `jawaban` longtext NOT NULL,
  `benar` varchar(4) NOT NULL,
  `nilai` varchar(4) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_kuis`
--

INSERT INTO `hasil_kuis` (`id_hasil`, `id_kuis`, `username`, `soal`, `jawaban`, `benar`, `nilai`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, 1, '321', '1,3,4', '1:b,3:b,4:b', '1', '33.3', '2021-01-09 15:25:25', '2021-01-09 15:25:44'),
(2, 2, '321', '5,9,7,11,12,6,2,8,10,13', '5:a,9:b,7:c,11:d,12:b,6:c,2:a,8:d,10:a,13:d', '5', '50', '2021-01-09 15:34:59', '2021-01-09 15:35:53'),
(6, 1, '098', '1,3,4', '1:,3:,4:', '0', '0', '2021-01-10 01:09:01', '2021-01-10 01:10:02'),
(7, 4, '098', '16,17', '16:c,17:c', '1', '50', '2021-03-02 20:32:42', '2021-03-02 20:32:54'),
(8, 5, '098', '19,18,20', '19:a,18:b,20:b', '3', '100', '2021-04-06 02:18:43', '2021-04-06 02:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id_kuis` int(11) NOT NULL,
  `nama_kuis` varchar(50) NOT NULL,
  `tgl_buka` datetime NOT NULL,
  `tgl_tutup` datetime NOT NULL,
  `waktu` varchar(3) NOT NULL,
  `jenis` enum('Urut','Acak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id_kuis`, `nama_kuis`, `tgl_buka`, `tgl_tutup`, `waktu`, `jenis`) VALUES
(1, 'try out', '2021-03-02 20:30:00', '2021-03-02 21:30:00', '1', 'Urut'),
(2, 'uas', '2021-01-07 19:32:00', '2021-01-09 16:02:00', '5', 'Acak'),
(3, 'lagi dan lagi', '2021-01-07 21:46:00', '2021-01-14 21:46:00', '3', 'Urut'),
(4, 'tugas 3', '2021-03-02 20:32:00', '2021-03-02 21:31:00', '10', 'Acak'),
(5, 'TO 4', '2021-04-06 02:16:00', '2021-04-08 02:16:00', '400', 'Acak');

-- --------------------------------------------------------

--
-- Table structure for table `kumpul_tugas`
--

CREATE TABLE `kumpul_tugas` (
  `id_kumpul` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `isi_kumpul` longtext DEFAULT NULL,
  `file_kumpul` varchar(255) DEFAULT NULL,
  `tgl_kumpul` datetime NOT NULL,
  `nilai` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kumpul_tugas`
--

INSERT INTO `kumpul_tugas` (`id_kumpul`, `id_tugas`, `username`, `isi_kumpul`, `file_kumpul`, `tgl_kumpul`, `nilai`) VALUES
(2, 1, '321', '', '10_Jan_2021_kumpul_tugas_BAGAN_STRUKTUR_HMJ_TE_2020.png', '2021-01-10 16:18:45', '75'),
(3, 1, '098', '', '10_Jan_2021_kumpul_tugas_098_BAGAN_STRUKTUR_HMJ_TE_2020.png', '2021-01-10 16:26:43', '77'),
(4, 4, '098', 'Tugas 4', '06_Apr_2021_kumpul_tugas_098_SCRIPT.docx', '2021-04-06 02:15:31', ''),
(5, 5, '098', '', '06_Apr_2021_kumpul_tugas_098_Tak_berjudul3_20200903084608.png', '2021-04-06 20:50:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `nama_materi` varchar(50) DEFAULT NULL,
  `isi_materi` longtext DEFAULT NULL,
  `file_materi` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `nama_materi`, `isi_materi`, `file_materi`, `tanggal`) VALUES
(5, 'BAGAN STRUKTUR HMJ TE 2020', 'ini isi materi yang sangat amat panjang banget sekali', '10_Jan_2021_materi_BAGAN_STRUKTUR_HMJ_TE_2020.png', '2020-12-31'),
(7, 'BAGAN STRUKTUR HMJ TE 2020', 'coba coba', '10_Jan_2021_materi_BAGAN_STRUKTUR_HMJ_TE_20201.png', '2021-01-10'),
(8, '10703-26531-1-SM', 'mencoba\r\n', '23_Feb_2021_materi_10703-26531-1-SM.pdf', '2021-02-23'),
(14, 'vxvv', 'aaa', '31_Mar_2021_materi_vxvv.docx', '2021-03-31'),
(17, 'SCRIPT', 'wwwwwww', '05_Apr_2021_materi_SCRIPT.docx', '2021-04-05'),
(18, 'Tak berjudul3_20200903084608', '', '06_Apr_2021_materi_Tak_berjudul3_20200903084608.png', '2021-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `h1` varchar(5) DEFAULT NULL,
  `h2` varchar(5) DEFAULT NULL,
  `h3` varchar(5) DEFAULT NULL,
  `h4` varchar(5) DEFAULT NULL,
  `h5` varchar(5) DEFAULT NULL,
  `h6` varchar(5) DEFAULT NULL,
  `h7` varchar(5) DEFAULT NULL,
  `h8` varchar(5) DEFAULT NULL,
  `h9` varchar(5) DEFAULT NULL,
  `h10` varchar(5) DEFAULT NULL,
  `h11` varchar(5) DEFAULT NULL,
  `h12` varchar(5) DEFAULT NULL,
  `h13` varchar(5) DEFAULT NULL,
  `h14` varchar(5) DEFAULT NULL,
  `h15` varchar(5) DEFAULT NULL,
  `h16` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `username`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`) VALUES
(1, '321', 'Hadir', 'Alpha', 'Ijin', 'Hadir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '098', 'Hadir', 'Sakit', 'Ijin', 'Alpha', 'Ijin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_kuis` int(11) NOT NULL,
  `soal` longtext NOT NULL,
  `a` longtext NOT NULL,
  `b` longtext NOT NULL,
  `c` longtext NOT NULL,
  `d` longtext NOT NULL,
  `benar` varchar(2) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_kuis`, `soal`, `a`, `b`, `c`, `d`, `benar`, `tgl_input`) VALUES
(1, 1, 'siapa?', 'iya', 'benar', 'tidak', 'salah', 'd', '2021-01-07 15:27:34'),
(3, 1, 'dimana?', 'sini', 'sana', 'situ', 'sono', 'b', '2021-01-07 22:25:02'),
(4, 1, 'kenapa?', 'tidak', 'iya', 'hem', 'hehe', 'c', '2021-01-07 22:25:30'),
(5, 2, 'soal 2', 'asd', 'sad', 'ds', 'as', 'a', '2021-01-08 22:19:15'),
(6, 2, 'soal 3', 'asd', 'asd', 'asd', 'asd', 'c', '2021-01-08 22:20:18'),
(7, 2, 'soal 4', 'asd', 'asd', 'asd', 'asd', 'b', '2021-01-08 22:20:35'),
(8, 2, 'soal 5', 'asd', 'asd', 'asd', 'asd', 'd', '2021-01-08 22:21:03'),
(9, 2, 'soal 6', 'qwe', 'qwe', 'qwe', 'qwe', 'b', '2021-01-08 22:21:17'),
(10, 2, 'soal 7', 'qwe', 'qwe', 'qwe', 'qwe', 'c', '2021-01-08 22:21:32'),
(11, 2, 'soal 8', 'qwe', 'qwe', 'qwe', 'qwe', 'a', '2021-01-08 22:22:02'),
(12, 2, 'soal 9', 'qwe', 'qwe', 'qwe', 'qwe', 'b', '2021-01-08 22:22:20'),
(13, 2, 'soal 10', 'qwe', 'qwe', 'qwe', 'qwe', 'a', '2021-01-08 22:22:39'),
(15, 1, 'siapa lagi?', 'iya a', 'benar b', 'tidak c', 'siapa lagi?', 'b', '2021-01-10 20:59:16'),
(16, 4, 'saya siapa?', 'q', 'q', 'w', 'e', 'd', '2021-03-02 20:32:07'),
(17, 4, 'aaaaaaaaa', 's', 'd', 'f', 'g', 'c', '2021-03-02 20:32:22'),
(18, 5, 'SSSSSSSSSSSSSSS', 'A', 'D', 'E', 'Q', 'b', '2021-04-06 02:17:36'),
(19, 5, 'DDDDDDDDDD', 'A', 'S', 'D', 'G', 'a', '2021-04-06 02:17:49'),
(20, 5, 'GGGGGGGGGGGGGGGG', 'S', 'B', 'A', 'E', 'b', '2021-04-06 02:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `nama_tugas` varchar(100) DEFAULT NULL,
  `isi_tugas` longtext DEFAULT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `tgl_buka` datetime NOT NULL,
  `tgl_tutup` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `nama_tugas`, `isi_tugas`, `file_tugas`, `tgl_buka`, `tgl_tutup`) VALUES
(1, 'tugas satu', 'isi tugas', '29_Dec_2020_tugas_bukti_coba_submit.jpg', '2020-12-29 14:26:40', '2021-01-13 14:27:50'),
(2, 'tugas lagi', 'Tugas 4s', '06_Apr_2021_tugas_Screenshot_8.png', '2021-01-14 15:41:00', '2021-01-21 15:41:00'),
(4, 'Tugas 4', 'aaaa', '05_Apr_2021_tugas_vxvv.docx', '2021-04-05 23:06:00', '2021-04-13 23:06:00'),
(5, 'QQ', 'Q', '06_Apr_2021_tugas_Tak_berjudul3_20200903084608.png', '2021-04-06 20:49:00', '2021-04-06 20:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL COMMENT 'nomor induk',
  `nama` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role` enum('1','2') NOT NULL COMMENT '1=guru; 2=murid',
  `status` enum('0','1') NOT NULL COMMENT '0=tidak aktif; 1=aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `nama`, `password`, `email`, `token`, `role`, `status`) VALUES
('098', 'murid baru', '$2y$10$Wvl8feLYJQp.iyG9YMJpq.5zATkftTmh92Erxg7Hq0iZe3rnSXYdS', 'murid@baru.com', '', '2', '1'),
('123', 'coba guru', '$2y$10$NSnfT6CMNx696eO20AYoouXWiMreOx0v7mpSrtY9MO98MpFvpjVa.', 'saedes.info@gmail.com', '', '1', '1'),
('170533628537', 'wigih tama', '$2y$10$RykhYwV6vdTQM2dzfKIJcuMesXLfr.kV/IXEcbt.HjnxmI.jnW0Ba', 'tamawigih@gmail.com', 'yVss5CvF9M5KGxlCV1dwHwDuMVHA0+jMBJZl+io8dfo=', '2', '0'),
('321', 'coba murid', '$2y$10$ccqiSWA.1ZfXCDORPUitkuLe7uCTm7S75U9ttcdkE0USzKXaJkK5G', 'coba@murid.com', '', '2', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id_forum`);

--
-- Indexes for table `hasil_kuis`
--
ALTER TABLE `hasil_kuis`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id_kuis`);

--
-- Indexes for table `kumpul_tugas`
--
ALTER TABLE `kumpul_tugas`
  ADD PRIMARY KEY (`id_kumpul`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_forum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hasil_kuis`
--
ALTER TABLE `hasil_kuis`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id_kuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kumpul_tugas`
--
ALTER TABLE `kumpul_tugas`
  MODIFY `id_kumpul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
