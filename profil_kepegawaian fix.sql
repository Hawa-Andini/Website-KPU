-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2026 at 07:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profil_kepegawaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_agama`
--

CREATE TABLE `master_agama` (
  `id_agama` int UNSIGNED NOT NULL,
  `agama` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_agama`
--

INSERT INTO `master_agama` (`id_agama`, `agama`, `keterangan`) VALUES
(1, 'Islam', NULL),
(2, 'Kristen Protestan', NULL),
(3, 'Katolik', NULL),
(4, 'Hindu', NULL),
(5, 'Buddha', NULL),
(6, 'Konghucu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_diklat`
--

CREATE TABLE `master_diklat` (
  `id_jenis_diklat` int UNSIGNED NOT NULL,
  `jenis_diklat` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_divisi`
--

CREATE TABLE `master_divisi` (
  `id_unit_kerja` int UNSIGNED NOT NULL,
  `unit_kerja` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_divisi`
--

INSERT INTO `master_divisi` (`id_unit_kerja`, `unit_kerja`, `keterangan`) VALUES
(1, 'Sekretariat', NULL),
(2, 'Divisi Keuangan, Umum dan Logistik', NULL),
(3, 'Divisi Sosdiklih, Parmas dan SDM', NULL),
(4, 'Divisi Perencanaan, Data dan Informasi', NULL),
(5, 'Divisi Teknis Penyelenggaraan', NULL),
(6, 'Divisi Hukum dan Pengawasan', NULL),
(8, 'Subbag SDM', NULL),
(9, 'Divisi JS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_golongan`
--

CREATE TABLE `master_golongan` (
  `id_gol` int UNSIGNED NOT NULL,
  `nama_pangkat` varchar(100) NOT NULL,
  `kode_gol` varchar(10) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_golongan`
--

INSERT INTO `master_golongan` (`id_gol`, `nama_pangkat`, `kode_gol`, `keterangan`) VALUES
(1, 'Juru Muda', 'Ia', NULL),
(2, 'Juru Muda Tingkat I', 'Ib', NULL),
(3, 'Juru', 'Ic', NULL),
(4, 'Juru Tingkat I', 'Id', NULL),
(5, 'Pengatur Muda', 'IIa', NULL),
(6, 'Pengatur Muda Tingkat I', 'IIb', NULL),
(7, 'Pengatur', 'IIc', NULL),
(8, 'Pengatur Tingkat I', 'IId', NULL),
(9, 'Penata Muda', 'IIIa', NULL),
(10, 'Penata Muda Tingkat I', 'IIIb', NULL),
(11, 'Penata', 'IIIc', NULL),
(12, 'Penata Tingkat I', 'IIId', NULL),
(13, 'Pembina', 'IVa', NULL),
(14, 'Pembina Tingkat I', 'IVb', NULL),
(15, 'Pembina Utama Muda', 'IVc', NULL),
(16, 'Pembina Utama Madya', 'IVd', NULL),
(17, 'Pembina Utama', 'IVe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_hub_kel`
--

CREATE TABLE `master_hub_kel` (
  `id_hub_kel` int UNSIGNED NOT NULL,
  `hub_kel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_hub_kel`
--

INSERT INTO `master_hub_kel` (`id_hub_kel`, `hub_kel`, `keterangan`) VALUES
(1, 'Suami', ''),
(2, 'Istri', ''),
(3, 'Anak', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_jabatan`
--

CREATE TABLE `master_jabatan` (
  `id_jabatan` int UNSIGNED NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `jenis_jabatan` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_jabatan`
--

INSERT INTO `master_jabatan` (`id_jabatan`, `nama_jabatan`, `jenis_jabatan`, `keterangan`) VALUES
(1, 'Struktural', 'Sekretaris', NULL),
(2, 'Fungsional Tertentu', 'Pranata Komputer', NULL),
(3, 'Fungsional Umum', 'Staf Subbagian KUL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_kelamin`
--

CREATE TABLE `master_jenis_kelamin` (
  `id_jenis_kelamin` int UNSIGNED NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_jenis_kelamin`
--

INSERT INTO `master_jenis_kelamin` (`id_jenis_kelamin`, `jenis_kelamin`, `keterangan`) VALUES
(1, 'Perempuan', NULL),
(2, 'Laki-Laki', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jenjang_pend`
--

CREATE TABLE `master_jenjang_pend` (
  `id_jenjang_pend` int UNSIGNED NOT NULL,
  `jenjang_pend` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_jenjang_pend`
--

INSERT INTO `master_jenjang_pend` (`id_jenjang_pend`, `jenjang_pend`, `keterangan`) VALUES
(1, 'SD/MI', NULL),
(2, 'SMP/MTS', NULL),
(3, 'SMA/SMK/MA', NULL),
(4, 'S1', NULL),
(5, 'D4', NULL),
(6, 'S2', NULL),
(7, 'S3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_kabupaten`
--

CREATE TABLE `master_kabupaten` (
  `id_kabupaten` int NOT NULL,
  `nama_kabupaten` varchar(100) NOT NULL,
  `jenis` enum('Kabupaten','Kota') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_kabupaten`
--

INSERT INTO `master_kabupaten` (`id_kabupaten`, `nama_kabupaten`, `jenis`) VALUES
(1, 'Aceh Selatan', 'Kabupaten'),
(2, 'Aceh Tenggara', 'Kabupaten'),
(3, 'Aceh Timur', 'Kabupaten'),
(4, 'Aceh Tengah', 'Kabupaten'),
(5, 'Aceh Barat', 'Kabupaten'),
(6, 'Aceh Besar', 'Kabupaten'),
(7, 'Pidie', 'Kabupaten'),
(8, 'Aceh Utara', 'Kabupaten'),
(9, 'Simeulue', 'Kabupaten'),
(10, 'Aceh Singkil', 'Kabupaten'),
(11, 'Bireuen', 'Kabupaten'),
(12, 'Aceh Barat Daya', 'Kabupaten'),
(13, 'Gayo Lues', 'Kabupaten'),
(14, 'Aceh Jaya', 'Kabupaten'),
(15, 'Nagan Raya', 'Kabupaten'),
(16, 'Aceh Tamiang', 'Kabupaten'),
(17, 'Bener Meriah', 'Kabupaten'),
(18, 'Pidie Jaya', 'Kabupaten'),
(19, 'Tapanuli Tengah', 'Kabupaten'),
(20, 'Tapanuli Utara', 'Kabupaten'),
(21, 'Tapanuli Selatan', 'Kabupaten'),
(22, 'Nias', 'Kabupaten'),
(23, 'Langkat', 'Kabupaten'),
(24, 'Karo', 'Kabupaten'),
(25, 'Deli Serdang', 'Kabupaten'),
(26, 'Simalungun', 'Kabupaten'),
(27, 'Asahan', 'Kabupaten'),
(28, 'Labuhanbatu', 'Kabupaten'),
(29, 'Dairi', 'Kabupaten'),
(30, 'Toba Samosir', 'Kabupaten'),
(31, 'Mandailing Natal', 'Kabupaten'),
(32, 'Nias Selatan', 'Kabupaten'),
(33, 'Pakpak Bharat', 'Kabupaten'),
(34, 'Humbang Hasundutan', 'Kabupaten'),
(35, 'Samosir', 'Kabupaten'),
(36, 'Serdang Bedagai', 'Kabupaten'),
(37, 'Batu Bara', 'Kabupaten'),
(38, 'Padang Lawas Utara', 'Kabupaten'),
(39, 'Padang Lawas', 'Kabupaten'),
(40, 'Labuhanbatu Selatan', 'Kabupaten'),
(41, 'Labuhanbatu Utara', 'Kabupaten'),
(42, 'Nias Utara', 'Kabupaten'),
(43, 'Nias Barat', 'Kabupaten'),
(44, 'Mahakam Ulu', 'Kabupaten'),
(45, 'Pangandaran', 'Kabupaten'),
(46, 'Pesisir Barat', 'Kabupaten'),
(47, 'Penukal Abab Lematang Ilir', 'Kabupaten'),
(48, 'Musi Rawas Utara', 'Kabupaten'),
(49, 'Buton Selatan', 'Kabupaten'),
(50, 'Buton Tengah', 'Kabupaten'),
(51, 'Muna Barat', 'Kabupaten'),
(52, 'Konawe Kepulauan', 'Kabupaten'),
(53, 'Kolaka Timur', 'Kabupaten'),
(54, 'Banggai Laut', 'Kabupaten'),
(55, 'Morowali Utara', 'Kabupaten'),
(56, 'Deiyai', 'Kabupaten'),
(57, 'Dogiyai', 'Kabupaten'),
(58, 'Intan Jaya', 'Kabupaten'),
(59, 'Puncak', 'Kabupaten'),
(60, 'Nduga', 'Kabupaten'),
(61, 'Lanny Jaya', 'Kabupaten'),
(62, 'Yalimo', 'Kabupaten'),
(63, 'Mamberamo Tengah', 'Kabupaten'),
(64, 'Tambrauw', 'Kabupaten'),
(65, 'Maybrat', 'Kabupaten'),
(66, 'Pesisir Selatan', 'Kabupaten'),
(67, 'Solok', 'Kabupaten'),
(68, 'Sijunjung', 'Kabupaten'),
(69, 'Tanah Datar', 'Kabupaten'),
(70, 'Padang Pariaman', 'Kabupaten'),
(71, 'Agam', 'Kabupaten'),
(72, 'Lima Puluh Kota', 'Kabupaten'),
(73, 'Pasaman', 'Kabupaten'),
(74, 'Kepulauan Mentawai', 'Kabupaten'),
(75, 'Dharmasraya', 'Kabupaten'),
(76, 'Solok Selatan', 'Kabupaten'),
(77, 'Pasaman Barat', 'Kabupaten'),
(78, 'Kampar', 'Kabupaten'),
(79, 'Indragiri Hulu', 'Kabupaten'),
(80, 'Bengkalis', 'Kabupaten'),
(81, 'Indragiri Hilir', 'Kabupaten'),
(82, 'Pelalawan', 'Kabupaten'),
(83, 'Rokan Hulu', 'Kabupaten'),
(84, 'Rokan Hilir', 'Kabupaten'),
(85, 'Siak', 'Kabupaten'),
(86, 'Kuantan Singingi', 'Kabupaten'),
(87, 'Kerinci', 'Kabupaten'),
(88, 'Merangin', 'Kabupaten'),
(89, 'Sarolangun', 'Kabupaten'),
(90, 'Batanghari', 'Kabupaten'),
(91, 'Muaro Jambi', 'Kabupaten'),
(92, 'Tanjung Jabung Barat', 'Kabupaten'),
(93, 'Tanjung Jabung Timur', 'Kabupaten'),
(94, 'Bungo', 'Kabupaten'),
(95, 'Tebo', 'Kabupaten'),
(96, 'Ogan Komering Ulu', 'Kabupaten'),
(97, 'Ogan Komering Ilir', 'Kabupaten'),
(98, 'Muara Enim', 'Kabupaten'),
(99, 'Lahat', 'Kabupaten'),
(100, 'Musi Rawas', 'Kabupaten'),
(101, 'Musi Banyuasin', 'Kabupaten'),
(102, 'Banyuasin', 'Kabupaten'),
(103, 'Oku Timur', 'Kabupaten'),
(104, 'Oku Selatan', 'Kabupaten'),
(105, 'Ogan Ilir', 'Kabupaten'),
(106, 'Bengkulu Selatan', 'Kabupaten'),
(107, 'Rejang Lebong', 'Kabupaten'),
(108, 'Bengkulu Utara', 'Kabupaten'),
(109, 'Kaur', 'Kabupaten'),
(110, 'Seluma', 'Kabupaten'),
(111, 'Muko Muko', 'Kabupaten'),
(112, 'Lebong', 'Kabupaten'),
(113, 'Kepahiang', 'Kabupaten'),
(114, 'Lampung Selatan', 'Kabupaten'),
(115, 'Lampung Tengah', 'Kabupaten'),
(116, 'Lampung Utara', 'Kabupaten'),
(117, 'Lampung Barat', 'Kabupaten'),
(118, 'Tulang Bawang', 'Kabupaten'),
(119, 'Tanggamus', 'Kabupaten'),
(120, 'Lampung Timur', 'Kabupaten'),
(121, 'Way Kanan', 'Kabupaten'),
(122, 'Bangka', 'Kabupaten'),
(123, 'Belitung', 'Kabupaten'),
(124, 'Bangka Selatan', 'Kabupaten'),
(125, 'Bangka Tengah', 'Kabupaten'),
(126, 'Bangka Barat', 'Kabupaten'),
(127, 'Bangka Timur', 'Kabupaten'),
(128, 'Kepulauan Riau', 'Kabupaten'),
(129, 'Karimun', 'Kabupaten'),
(130, 'Natuna', 'Kabupaten'),
(131, 'Lingga', 'Kabupaten'),
(132, 'Bogor', 'Kabupaten'),
(133, 'Sukabumi', 'Kabupaten'),
(134, 'Cianjur', 'Kabupaten'),
(135, 'Bandung', 'Kabupaten'),
(136, 'Garut', 'Kabupaten'),
(137, 'Tasikmalaya', 'Kabupaten'),
(138, 'Ciamis', 'Kabupaten'),
(139, 'Kuningan', 'Kabupaten'),
(140, 'Cirebon', 'Kabupaten'),
(141, 'Majalengka', 'Kabupaten'),
(142, 'Sumedang', 'Kabupaten'),
(143, 'Indramayu', 'Kabupaten'),
(144, 'Subang', 'Kabupaten'),
(145, 'Purwakarta', 'Kabupaten'),
(146, 'Karawang', 'Kabupaten'),
(147, 'Bekasi', 'Kabupaten'),
(148, 'Cilacap', 'Kabupaten'),
(149, 'Banyumas', 'Kabupaten'),
(150, 'Purbalingga', 'Kabupaten'),
(151, 'Banjarnegara', 'Kabupaten'),
(152, 'Kebumen', 'Kabupaten'),
(153, 'Purworejo', 'Kabupaten'),
(154, 'Wonosobo', 'Kabupaten'),
(155, 'Magelang', 'Kabupaten'),
(156, 'Boyolali', 'Kabupaten'),
(157, 'Klaten', 'Kabupaten'),
(158, 'Sukoharjo', 'Kabupaten'),
(159, 'Wonogiri', 'Kabupaten'),
(160, 'Karanganyar', 'Kabupaten'),
(161, 'Sragen', 'Kabupaten'),
(162, 'Grobogan', 'Kabupaten'),
(163, 'Blora', 'Kabupaten'),
(164, 'Rembang', 'Kabupaten'),
(165, 'Pati', 'Kabupaten'),
(166, 'Kudus', 'Kabupaten'),
(167, 'Jepara', 'Kabupaten'),
(168, 'Demak', 'Kabupaten'),
(169, 'Semarang', 'Kabupaten'),
(170, 'Temanggung', 'Kabupaten'),
(171, 'Kendal', 'Kabupaten'),
(172, 'Batang', 'Kabupaten'),
(173, 'Pekalongan', 'Kabupaten'),
(174, 'Pemalang', 'Kabupaten'),
(175, 'Tegal', 'Kabupaten'),
(176, 'Brebes', 'Kabupaten'),
(177, 'Kulon Progo', 'Kabupaten'),
(178, 'Bantul', 'Kabupaten'),
(179, 'Gunung Kidul', 'Kabupaten'),
(180, 'Sleman', 'Kabupaten'),
(181, 'Pacitan', 'Kabupaten'),
(182, 'Ponorogo', 'Kabupaten'),
(183, 'Trenggalek', 'Kabupaten'),
(184, 'Tulungagung', 'Kabupaten'),
(185, 'Blitar', 'Kabupaten'),
(186, 'Kediri', 'Kabupaten'),
(187, 'Malang', 'Kabupaten'),
(188, 'Lumajang', 'Kabupaten'),
(189, 'Jember', 'Kabupaten'),
(190, 'Banyuwangi', 'Kabupaten'),
(191, 'Bondowoso', 'Kabupaten'),
(192, 'Situbondo', 'Kabupaten'),
(193, 'Probolinggo', 'Kabupaten'),
(194, 'Pasuruan', 'Kabupaten'),
(195, 'Sidoarjo', 'Kabupaten'),
(196, 'Mojokerto', 'Kabupaten'),
(197, 'Jombang', 'Kabupaten'),
(198, 'Nganjuk', 'Kabupaten'),
(199, 'Madiun', 'Kabupaten'),
(200, 'Magetan', 'Kabupaten'),
(201, 'Ngawi', 'Kabupaten'),
(202, 'Bojonegoro', 'Kabupaten'),
(203, 'Tuban', 'Kabupaten'),
(204, 'Lamongan', 'Kabupaten'),
(205, 'Gresik', 'Kabupaten'),
(206, 'Bangkalan', 'Kabupaten'),
(207, 'Sampang', 'Kabupaten'),
(208, 'Pamekasan', 'Kabupaten'),
(209, 'Sumenep', 'Kabupaten'),
(210, 'Pandeglang', 'Kabupaten'),
(211, 'Lebak', 'Kabupaten'),
(212, 'Tangerang', 'Kabupaten'),
(213, 'Serang', 'Kabupaten'),
(214, 'Jembrana', 'Kabupaten'),
(215, 'Tabanan', 'Kabupaten'),
(216, 'Badung', 'Kabupaten'),
(217, 'Gianyar', 'Kabupaten'),
(218, 'Klungkung', 'Kabupaten'),
(219, 'Bangli', 'Kabupaten'),
(220, 'Karangasem', 'Kabupaten'),
(221, 'Buleleng', 'Kabupaten'),
(222, 'Lombok Barat', 'Kabupaten'),
(223, 'Lombok Tengah', 'Kabupaten'),
(224, 'Lombok Timur', 'Kabupaten'),
(225, 'Sumbawa', 'Kabupaten'),
(226, 'Dompu', 'Kabupaten'),
(227, 'Bima', 'Kabupaten'),
(228, 'Sumbawa Barat', 'Kabupaten'),
(229, 'Kupang', 'Kabupaten'),
(230, 'Timor Tengah Selatan', 'Kabupaten'),
(231, 'Timor Tengah Utara', 'Kabupaten'),
(232, 'Belu', 'Kabupaten'),
(233, 'Alor', 'Kabupaten'),
(234, 'Flores Timur', 'Kabupaten'),
(235, 'Sikka', 'Kabupaten'),
(236, 'Ende', 'Kabupaten'),
(237, 'Ngada', 'Kabupaten'),
(238, 'Manggarai', 'Kabupaten'),
(239, 'Sumba Timur', 'Kabupaten'),
(240, 'Sumba Barat', 'Kabupaten'),
(241, 'Lembata', 'Kabupaten'),
(242, 'Rote Ndao', 'Kabupaten'),
(243, 'Manggarai Barat', 'Kabupaten'),
(244, 'Sambas', 'Kabupaten'),
(245, 'Pontianak', 'Kabupaten'),
(246, 'Sanggau', 'Kabupaten'),
(247, 'Ketapang', 'Kabupaten'),
(248, 'Sintang', 'Kabupaten'),
(249, 'Kapuas Hulu', 'Kabupaten'),
(250, 'Bengkayang', 'Kabupaten'),
(251, 'Landak', 'Kabupaten'),
(252, 'Melawi', 'Kabupaten'),
(253, 'Sekadau', 'Kabupaten'),
(254, 'Kotawaringin Barat', 'Kabupaten'),
(255, 'Kotawaringin Timur', 'Kabupaten'),
(256, 'Kapuas', 'Kabupaten'),
(257, 'Barito Selatan', 'Kabupaten'),
(258, 'Barito Utara', 'Kabupaten'),
(259, 'Katingan', 'Kabupaten'),
(260, 'Seruyan', 'Kabupaten'),
(261, 'Sukamara', 'Kabupaten'),
(262, 'Lamandau', 'Kabupaten'),
(263, 'Gunung Mas', 'Kabupaten'),
(264, 'Pulang Pisau', 'Kabupaten'),
(265, 'Murung Raya', 'Kabupaten'),
(266, 'Barito Timor', 'Kabupaten'),
(267, 'Tanah Laut', 'Kabupaten'),
(268, 'Kotabaru', 'Kabupaten'),
(269, 'Banjar', 'Kabupaten'),
(270, 'Barito Kuala', 'Kabupaten'),
(271, 'Tapin', 'Kabupaten'),
(272, 'Hulu Sungai Selatan', 'Kabupaten'),
(273, 'Hulu Sungai Tengah', 'Kabupaten'),
(274, 'Hulu Sungai Utara', 'Kabupaten'),
(275, 'Tabalong', 'Kabupaten'),
(276, 'Tanah Bumbu', 'Kabupaten'),
(277, 'Balangan', 'Kabupaten'),
(278, 'Pasir', 'Kabupaten'),
(279, 'Kutai Kertanegara', 'Kabupaten'),
(280, 'Berau', 'Kabupaten'),
(281, 'Bulungan', 'Kabupaten'),
(282, 'Nunukan', 'Kabupaten'),
(283, 'Malinau', 'Kabupaten'),
(284, 'Kutai Barat', 'Kabupaten'),
(285, 'Kutai Timur', 'Kabupaten'),
(286, 'Penajam Paser Utara', 'Kabupaten'),
(287, 'Bolaang Mongondow', 'Kabupaten'),
(288, 'Minahasa', 'Kabupaten'),
(289, 'Kepulauan Sangihe', 'Kabupaten'),
(290, 'Kepulauan Talaut', 'Kabupaten'),
(291, 'Minahasa Selatan', 'Kabupaten'),
(292, 'Minahasa Utara', 'Kabupaten'),
(293, 'Banggai', 'Kabupaten'),
(294, 'Poso', 'Kabupaten'),
(295, 'Donggala', 'Kabupaten'),
(296, 'Toli Toli', 'Kabupaten'),
(297, 'Buol', 'Kabupaten'),
(298, 'Morowali', 'Kabupaten'),
(299, 'Banggai Kepulauan', 'Kabupaten'),
(300, 'Parigi Moutong', 'Kabupaten'),
(301, 'Tojo Una Una', 'Kabupaten'),
(302, 'Selayar', 'Kabupaten'),
(303, 'Bulukumba', 'Kabupaten'),
(304, 'Bantaeng', 'Kabupaten'),
(305, 'Jeneponto', 'Kabupaten'),
(306, 'Takalar', 'Kabupaten'),
(307, 'Gowa', 'Kabupaten'),
(308, 'Sinjai', 'Kabupaten'),
(309, 'Bone', 'Kabupaten'),
(310, 'Maros', 'Kabupaten'),
(311, 'Pangkajene dan Kepulauan', 'Kabupaten'),
(312, 'Barru', 'Kabupaten'),
(313, 'Soppeng', 'Kabupaten'),
(314, 'Wajo', 'Kabupaten'),
(315, 'Sidenreng Rapang', 'Kabupaten'),
(316, 'Pinrang', 'Kabupaten'),
(317, 'Enrekang', 'Kabupaten'),
(318, 'Luwu', 'Kabupaten'),
(319, 'Tana Toraja', 'Kabupaten'),
(320, 'Polewali Mamasa', 'Kabupaten'),
(321, 'Majene', 'Kabupaten'),
(322, 'Mamuju', 'Kabupaten'),
(323, 'Luwu Utara', 'Kabupaten'),
(324, 'Mamasa', 'Kabupaten'),
(325, 'Luwu Timur', 'Kabupaten'),
(326, 'Mamuju Utara', 'Kabupaten'),
(327, 'Kolaka', 'Kabupaten'),
(328, 'Konawe', 'Kabupaten'),
(329, 'Muna', 'Kabupaten'),
(330, 'Buton', 'Kabupaten'),
(331, 'Konawe Selatan', 'Kabupaten'),
(332, 'Bombana', 'Kabupaten'),
(333, 'Wakatobi', 'Kabupaten'),
(334, 'Kolaka Utara', 'Kabupaten'),
(335, 'Gorontalo', 'Kabupaten'),
(336, 'Boalemo', 'Kabupaten'),
(337, 'Bone Bolango', 'Kabupaten'),
(338, 'Pohuwato', 'Kabupaten'),
(339, 'Maluku Tengah', 'Kabupaten'),
(340, 'Maluku Tenggara', 'Kabupaten'),
(341, 'Maluku Tenggara Barat', 'Kabupaten'),
(342, 'Buru', 'Kabupaten'),
(343, 'Seram Bagian Timur', 'Kabupaten'),
(344, 'Seram Bagian Barat', 'Kabupaten'),
(345, 'Kepulauan Aru', 'Kabupaten'),
(346, 'Halmahera Barat', 'Kabupaten'),
(347, 'Halmahera Tengah', 'Kabupaten'),
(348, 'Halmahera Utara', 'Kabupaten'),
(349, 'Halmahera Selatan', 'Kabupaten'),
(350, 'Kepulauan Sula', 'Kabupaten'),
(351, 'Halmahera Timur', 'Kabupaten'),
(352, 'Merauke', 'Kabupaten'),
(353, 'Jayawijaya', 'Kabupaten'),
(354, 'Jayapura', 'Kabupaten'),
(355, 'Nabire', 'Kabupaten'),
(356, 'Yapen Waropen', 'Kabupaten'),
(357, 'Biak Numfor', 'Kabupaten'),
(358, 'Puncak Jaya', 'Kabupaten'),
(359, 'Paniai', 'Kabupaten'),
(360, 'Mimika', 'Kabupaten'),
(361, 'Sarmi', 'Kabupaten'),
(362, 'Keerom', 'Kabupaten'),
(363, 'Pegunungan Bintang', 'Kabupaten'),
(364, 'Yahukimo', 'Kabupaten'),
(365, 'Tolikara', 'Kabupaten'),
(366, 'Waropen', 'Kabupaten'),
(367, 'Boven Digoel', 'Kabupaten'),
(368, 'Mappi', 'Kabupaten'),
(369, 'Asmat', 'Kabupaten'),
(370, 'Supiori', 'Kabupaten'),
(371, 'Sorong', 'Kabupaten'),
(372, 'Manokwari', 'Kabupaten'),
(373, 'Fakfak', 'Kabupaten'),
(374, 'Sorong Selatan', 'Kabupaten'),
(375, 'Teluk Bintuni', 'Kabupaten'),
(376, 'Teluk Wondama', 'Kabupaten'),
(377, 'Kaimana', 'Kabupaten'),
(378, 'Banda Aceh', 'Kota'),
(379, 'Sabang', 'Kota'),
(380, 'Lhokseumawe', 'Kota'),
(381, 'Langsa', 'Kota'),
(382, 'Medan', 'Kota'),
(383, 'Pematang Siantar', 'Kota'),
(384, 'Sibolga', 'Kota'),
(385, 'Tanjung Balai', 'Kota'),
(386, 'Binjai', 'Kota'),
(387, 'Tebing Tinggi', 'Kota'),
(388, 'Padang Sidempuan', 'Kota'),
(389, 'Padang', 'Kota'),
(390, 'Solok', 'Kota'),
(391, 'Sawahlunto', 'Kota'),
(392, 'Padang Panjang', 'Kota'),
(393, 'Bukittinggi', 'Kota'),
(394, 'Payakumbuh', 'Kota'),
(395, 'Pariaman', 'Kota'),
(396, 'Pekanbaru', 'Kota'),
(397, 'Dumai', 'Kota'),
(398, 'Jambi', 'Kota'),
(399, 'Palembang', 'Kota'),
(400, 'Pagar Alam', 'Kota'),
(401, 'Lubuk Linggau', 'Kota'),
(402, 'Prabumulih', 'Kota'),
(403, 'Bengkulu', 'Kota'),
(404, 'Bandar Lampung', 'Kota'),
(405, 'Metro', 'Kota'),
(406, 'Pangkal Pinang', 'Kota'),
(407, 'Batam', 'Kota'),
(408, 'Tanjung Pinang', 'Kota'),
(409, 'Jakarta Pusat', 'Kota'),
(410, 'Jakarta Utara', 'Kota'),
(411, 'Jakarta Barat', 'Kota'),
(412, 'Jakarta Selatan', 'Kota'),
(413, 'Jakarta Timur', 'Kota'),
(414, 'Bogor', 'Kota'),
(415, 'Sukabumi', 'Kota'),
(416, 'Bandung', 'Kota'),
(417, 'Cirebon', 'Kota'),
(418, 'Bekasi', 'Kota'),
(419, 'Depok', 'Kota'),
(420, 'Cimahi', 'Kota'),
(421, 'Tasikmalaya', 'Kota'),
(422, 'Banjar', 'Kota'),
(423, 'Magelang', 'Kota'),
(424, 'Surakarta', 'Kota'),
(425, 'Salatiga', 'Kota'),
(426, 'Semarang', 'Kota'),
(427, 'Pekalongan', 'Kota'),
(428, 'Tegal', 'Kota'),
(429, 'Yogyakarta', 'Kota'),
(430, 'Kediri', 'Kota'),
(431, 'Blitar', 'Kota'),
(432, 'Malang', 'Kota'),
(433, 'Probolinggo', 'Kota'),
(434, 'Pasuruan', 'Kota'),
(435, 'Mojokerto', 'Kota'),
(436, 'Madiun', 'Kota'),
(437, 'Surabaya', 'Kota'),
(438, 'Batu', 'Kota'),
(439, 'Tangerang', 'Kota'),
(440, 'Cilegon', 'Kota'),
(441, 'Denpasar', 'Kota'),
(442, 'Mataram', 'Kota'),
(443, 'Bima', 'Kota'),
(444, 'Kupang', 'Kota'),
(445, 'Pontianak', 'Kota'),
(446, 'Singkawang', 'Kota'),
(447, 'Palangkaraya', 'Kota'),
(448, 'Banjarmasin', 'Kota'),
(449, 'Banjarbaru', 'Kota'),
(450, 'Balikpapan', 'Kota'),
(451, 'Samarinda', 'Kota'),
(452, 'Tarakan', 'Kota'),
(453, 'Bontang', 'Kota'),
(454, 'Manado', 'Kota'),
(455, 'Bitung', 'Kota'),
(456, 'Tomohon', 'Kota'),
(457, 'Palu', 'Kota'),
(458, 'Makassar', 'Kota'),
(459, 'Pare Pare', 'Kota'),
(460, 'Palopo', 'Kota'),
(461, 'Kendari', 'Kota'),
(462, 'Bau Bau', 'Kota'),
(463, 'Gorontalo', 'Kota'),
(464, 'Ambon', 'Kota'),
(465, 'Ternate', 'Kota'),
(466, 'Tidore Kepulauan', 'Kota'),
(467, 'Jayapura', 'Kota'),
(468, 'Sorong', 'Kota'),
(469, 'Kepulauan Anambas', 'Kabupaten'),
(470, 'Gunungsitoli', 'Kota'),
(471, 'Serang', 'Kota'),
(472, 'Tangerang Selatan', 'Kota'),
(473, 'Pesawaran', 'Kabupaten'),
(474, 'Pringsewu', 'Kabupaten'),
(475, 'Mesuji', 'Kabupaten'),
(476, 'Tulang Bawang Barat', 'Kabupaten'),
(477, 'Belitung Timur', 'Kabupaten'),
(478, 'Konawe Utara', 'Kabupaten'),
(479, 'Buton Utara', 'Kabupaten'),
(480, 'Gorontalo Utara', 'Kabupaten'),
(481, 'Bolaang Mongondow Selatan', 'Kabupaten'),
(482, 'Bolaang Mongondow Timur', 'Kabupaten'),
(483, 'Mamuju Tengah', 'Kabupaten'),
(484, 'Toraja Utara', 'Kabupaten'),
(485, 'Buru Selatan', 'Kabupaten'),
(486, 'Maluku Barat Daya', 'Kabupaten'),
(487, 'Kepulauan Tanimbar', 'Kabupaten'),
(488, 'Pulau Morotai', 'Kabupaten'),
(489, 'Pulau Taliabu', 'Kabupaten'),
(490, 'Manokwari Selatan', 'Kabupaten'),
(491, 'Pegunungan Arfak', 'Kabupaten'),
(492, 'Raja Ampat', 'Kabupaten'),
(493, 'Mamberamo Raya', 'Kabupaten');

-- --------------------------------------------------------

--
-- Table structure for table `master_predikat_skp`
--

CREATE TABLE `master_predikat_skp` (
  `id_predikat_skp` int UNSIGNED NOT NULL,
  `predikat_skp` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_predikat_skp`
--

INSERT INTO `master_predikat_skp` (`id_predikat_skp`, `predikat_skp`, `keterangan`) VALUES
(1, 'Sangat Baik', NULL),
(2, 'Baik', NULL),
(3, 'Cukup', NULL),
(4, 'Kurang', NULL),
(5, 'Sangat Kurang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_status_perkawinan`
--

CREATE TABLE `master_status_perkawinan` (
  `id_status_perkawinan` int UNSIGNED NOT NULL,
  `status_perkawinan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_status_perkawinan`
--

INSERT INTO `master_status_perkawinan` (`id_status_perkawinan`, `status_perkawinan`, `keterangan`) VALUES
(1, 'Kawin', NULL),
(2, 'Belum Kawin', NULL),
(3, 'Cerai Mati', NULL),
(4, 'Cerai Hidup', NULL),
(5, 'Cerai Tercatat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id_reset` int UNSIGNED NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired_at` datetime NOT NULL,
  `used_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_pegawai` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tmt_cpns` date DEFAULT NULL,
  `tmt_pns` date DEFAULT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_jenis_kelamin` int UNSIGNED NOT NULL,
  `id_agama` int UNSIGNED NOT NULL,
  `id_status_perkawinan` int UNSIGNED NOT NULL,
  `id_gol` int UNSIGNED NOT NULL,
  `id_unit_kerja` int UNSIGNED NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipe_karyawan` varchar(10) NOT NULL,
  `instansi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `tmt_cpns`, `tmt_pns`, `no_telp`, `created_at`, `updated_at`, `id_jenis_kelamin`, `id_agama`, `id_status_perkawinan`, `id_gol`, `id_unit_kerja`, `foto`, `tipe_karyawan`, `instansi`) VALUES
('19170912409801217', 'Bagas Putra', 'Asahan', '2026-04-14', 'Jalan Cendrawasih No 20', '2026-04-20', '2026-04-23', '085790374923', '2026-04-19 08:06:53', '2026-04-19 08:06:53', 2, 1, 1, 2, 3, 'uploads/default.png', 'PNS', 'KPU Kota Surabaya'),
('195709144020121061', 'Hawa Andini Hadi', 'Sidoarjo', '2018-02-13', 'Jl. Pahlawan No 200', '2025-07-22', '2026-04-13', '08693273735329', '2026-04-13 04:14:31', '2026-04-14 03:24:02', 1, 1, 2, 1, 5, 'uploads/1776137042_pass3.jpeg', 'PNS', 'KPU Kota Surabaya'),
('195709144020121900', 'ariniy', 'Aceh Timur', '2026-04-09', 'Jl. Pahlawan No 10', '2026-04-01', '2026-04-02', '086932737359', '2026-04-14 07:03:56', '2026-04-14 07:03:56', 1, 1, 2, 7, 3, 'uploads/foto_69dde6dc569fd6.60885228.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('196709144020127777', 'Rossie Jennie Lisa', 'Bantul', '2026-04-04', 'Jl. Pahlawan No 200', '2026-04-01', '2026-04-02', '089778876655', '2026-04-22 02:26:21', '2026-04-22 02:29:14', 1, 3, 3, 4, 2, 'uploads/foto_69e83218986cf5.17766588.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020109876', 'Kendal Gibrani', 'Aceh Besar', '2026-04-03', 'Jl. Pahlawan No 200', '2026-04-09', '2026-04-03', '085790374923', '2026-04-29 07:38:04', '2026-04-29 07:39:47', 1, 1, 1, 2, 2, 'uploads/foto_69f1b55c2a9190.01960933.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020121001', 'Arini Rahmatya Putri', 'Magetan', '2017-03-08', 'Jalan Cendrawasih No 17', '2026-03-11', '2026-03-28', '08363543636', '2026-03-27 06:27:30', '2026-04-15 06:49:44', 1, 1, 4, 13, 6, 'uploads/69d7188eb3906.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020121009', 'Siti Nur Jannah', 'Aceh Barat', '2026-04-29', 'Jalan Cendrawasih No 20', NULL, NULL, '0836-3543-636', '2026-05-04 08:31:36', '2026-05-04 08:31:36', 1, 1, 2, 1, 2, 'uploads/foto_69f859683c95d7.14140842.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020121099', 'Bernard Bear', 'Boalemo', '2026-04-03', 'Jl. Pahlawan No 19', '2026-04-01', '2026-04-02', '0857-9037-4999', '2026-04-22 03:40:18', '2026-04-22 03:40:18', 1, 3, 2, 13, 4, 'uploads/default.png', 'CPNS', 'KPU Kota Surabaya'),
('198709122020121444', 'Budibako', 'Aceh Barat', '2026-04-21', 'Jalan Cendrawasih No 17', '2026-04-23', '2026-04-28', '0836-3543-636', '2026-04-28 01:56:44', '2026-04-28 01:56:44', 2, 2, 2, 1, 2, 'uploads/foto_69f013dc84ec80.98138749.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020121777', 'Jinni', 'Asmat', '2026-04-03', 'Jl. Pahlawan No 19', '2026-04-01', '2026-04-02', '085790374923', '2026-04-14 08:00:26', '2026-04-14 08:00:26', 1, 2, 3, 17, 2, 'uploads/foto_69ddf41aa6ae64.39768409.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020121881', 'Indah Sari', 'Jakarta Utara', '2026-04-10', 'Jalan Cendrawasih No 17', '2026-04-03', '2026-04-11', '0836-3543-6368', '2026-04-30 02:28:06', '2026-04-30 02:28:06', 1, 3, 2, 8, 2, 'uploads/foto_69f2be36d7d346.09655598.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020121888', 'Arini', 'Brebes', '2026-04-04', 'Jalan Cendrawasih No 17', '2026-04-11', '2026-04-12', '083635436369', '2026-04-14 06:45:45', '2026-04-14 06:45:45', 2, 2, 2, 10, 1, 'uploads/foto_69dde29939b198.08187536.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020121899', 'Do Kyungsoo', 'Banjar', '2005-04-02', 'Jl. Pahlawan No 200', '2020-03-23', '2021-05-24', '089778876633', '2026-04-14 07:34:01', '2026-05-05 07:18:13', 2, 3, 1, 15, 3, 'uploads/foto_69def29f75cdc5.91435563.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020121908', 'Andana Hidayat', 'Bekasi', '2026-04-11', 'Jalan Cendrawasih No 17', '2026-04-03', '2026-04-04', '089778876443', '2026-04-30 03:23:51', '2026-04-30 06:59:43', 2, 2, 2, 1, 2, 'uploads/foto_69f2cb47c57af2.97410322.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020121990', 'Andana Putra Rahmat', 'Aceh Besar', '2026-04-10', 'Jalan Cendrawasih No 17', '2026-04-01', '2026-04-02', '086932737350', '2026-04-16 06:56:49', '2026-04-17 05:26:18', 2, 1, 2, 5, 2, 'uploads/foto_69e08831ca0e97.58188036.jpg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020121999', 'Dio', 'Surakarta', '2001-04-03', 'Jl. Pahlawan No. 333', NULL, '2023-03-22', '0857-9037-4909', '2026-05-05 07:11:29', '2026-05-05 07:11:29', 2, 3, 2, 1, 4, 'uploads/foto_69f99821a6a643.76060539.jpeg', 'PPPK', 'KPU Kota Surabaya'),
('198709122020125643', 'Bilha Ulya', 'Aceh Tenggara', '2026-04-04', 'Jl. Pahlawan No 200', '2026-04-02', '2026-04-03', '0857903749234', '2026-04-29 04:06:17', '2026-04-30 08:34:36', 1, 1, 2, 15, 2, 'uploads/foto_69f183b9af9ab3.78568213.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020134567', 'Baim Wong', 'Bangka Selatan', '2026-04-06', 'Jalan Cendrawasih No 17', '2026-04-01', '2026-04-02', '085790374923', '2026-05-04 07:51:51', '2026-05-04 07:59:42', 1, 3, 2, 9, 2, 'uploads/foto_69f8501769b498.86636686.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020144445', 'Jenn Hawa Putri', 'Aceh Selatan', '2026-04-03', 'Jl. Pahlawan', '2026-04-01', '2026-04-02', '0869-3273-7359', '2026-04-23 02:40:50', '2026-04-23 02:40:50', 1, 3, 1, 8, 2, 'uploads/foto_69e986b295c7a4.32592799.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122020190871', 'Ahdana Dwi Putra', 'Ambon', '2026-04-23', 'Jalan Cendrawasih No 17', '2026-04-01', '2026-04-03', '0869-3273-7353', '2026-04-30 06:58:22', '2026-04-30 06:58:22', 2, 2, 3, 17, 3, 'uploads/foto_69f2fd8eb90b71.90122195.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122020190876', 'Hailey Bieber', 'Ambon', '2026-04-04', 'Jalan Cendrawasih No 20', '2026-04-03', '2026-04-03', '086932737353', '2026-04-29 07:29:33', '2026-04-29 07:31:00', 1, 1, 1, 15, 4, 'uploads/foto_69f1b35d659562.04734468.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122026789054', 'Andini Zakkiya Putri', 'Bantaeng', '2026-04-03', 'Jalan Cendrawasih No 17', '2026-04-01', '2026-04-02', '086932737353', '2026-04-29 03:59:07', '2026-04-29 03:59:07', 1, 3, 2, 2, 1, 'uploads/foto_69f1820b751a57.17113289.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122026789666', 'Anggia Winata', 'Bantaeng', '2026-04-03', 'Jalan Cendrawasih No 17', '2026-04-01', '2026-04-02', '086932737353', '2026-04-29 03:59:50', '2026-04-29 03:59:50', 1, 3, 2, 2, 1, 'uploads/foto_69f18236793072.09811897.jpeg', 'CPNS', 'KPU Kota Surabaya'),
('198709122027687954', 'Aditya Nur Cahyo', 'Jombang', '2026-04-09', 'Jl. Pahlawan No 200', NULL, NULL, '0897788766550', '2026-04-29 04:21:05', '2026-05-06 06:31:11', 2, 5, 1, 12, 8, 'uploads/foto_69f99553774de0.44657772.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198709122028796547', 'Daffa Ganteng', 'Semarang', '2001-03-02', 'Jalan Cendrawasih No 17, Surabaya, Jawa Timur', '2026-05-01', '2026-05-06', '083635436369', '2026-05-06 06:23:26', '2026-05-06 06:37:19', 2, 1, 1, 9, 1, 'uploads/1778049439_chanyeol pass.jpeg', 'PNS', 'KPU Kota Surabaya'),
('198809122020121030', 'Zakkiya Yumna', 'Madiun', '2005-04-01', 'Jalan Majapahit RT 05 RW 03', '2020-04-08', '2026-04-01', '08374678934', '2026-04-09 01:45:49', '2026-04-29 07:33:52', 1, 1, 2, 1, 4, 'uploads/foto_69f1b460d5db14.44865751.jpeg', 'CPNS', '0');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_diklat`
--

CREATE TABLE `riwayat_diklat` (
  `id_riwayat_diklat` int UNSIGNED NOT NULL,
  `nip` char(18) NOT NULL,
  `nama_diklat` varchar(100) NOT NULL,
  `penyelenggara_diklat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tp_awal` date DEFAULT NULL,
  `tp_akhir` date DEFAULT NULL,
  `jp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_diklat`
--

INSERT INTO `riwayat_diklat` (`id_riwayat_diklat`, `nip`, `nama_diklat`, `penyelenggara_diklat`, `tp_awal`, `tp_akhir`, `jp`) VALUES
(1, '198709122020121001', 'Diklat', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(3, '195709144020121061', 'Diklat', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(4, '198709122020121888', 'Diklat', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(5, '195709144020121900', 'Diklat', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(8, '198709122020121777', 'Diklat', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(13, '198709122020121899', 'Diklat Pimpinan', 'BUMN', '2026-04-24', '2026-05-01', '4'),
(14, '198709122020121990', 'Diklat Pimpinan', 'KPU', '2026-04-24', '2026-04-24', '4'),
(15, '19170912409801217', 'Diklat Pimpinan', '0', '2026-04-24', '2026-04-24', '2'),
(16, '196709144020127777', 'Diklat Pimpinan', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(17, '198709122020121099', 'Diklat Pimpinan', '0', '2026-04-24', '2026-04-24', '00:00:00'),
(19, '198709122020144445', 'Diklat Pimpinan', '0', '2026-04-24', '2026-04-24', '5'),
(20, '198709122020121899', 'Diklat', 'KPU', '2026-04-24', '2026-04-25', '6'),
(21, '198709122020121444', 'Diklat', 'BUMN', NULL, NULL, NULL),
(23, '198709122026789054', 'Diklat Pimpinan', 'BUMN', NULL, NULL, NULL),
(24, '198709122026789666', 'Diklat Pimpinan', 'BUMN', NULL, NULL, NULL),
(25, '198709122020125643', 'Diklat Pimpinan', 'KPU', NULL, NULL, NULL),
(26, '198709122027687954', 'Diklat Pimpinan', 'KPU', '2026-05-04', '2026-05-21', '30'),
(27, '198709122020190876', 'Diklat Pimpinan', 'BUMN', NULL, NULL, NULL),
(28, '198709122020109876', 'Diklat Pimpinan', 'BUMN', NULL, NULL, NULL),
(29, '198709122020121908', 'Diklat Pimpinan 1', 'KPU', NULL, NULL, NULL),
(30, '198709122027687954', 'Diklat Pimpinan', 'BUMN', '2026-05-02', '2026-05-05', '3'),
(31, '198709122020134567', 'Diklat Pimpinan', 'KPU', NULL, NULL, NULL),
(32, '198709122020134567', 'Diklat Pimpinan', 'BUMN', '2026-04-01', '2026-05-04', '23:12'),
(33, '198709122027687954', 'Diklat Keamanan Data dan Informasi', 'Kominfo', '2026-05-05', '2026-05-12', '20'),
(35, '198709122020121899', 'Diklat Keamanan Data dan Informasi', 'Kominfo', '2026-05-05', '2026-05-09', '10'),
(36, '198709122028796547', 'Diklat Kepemimpinan', 'BUMN', '2026-05-01', '2026-05-06', '20');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_golongan`
--

CREATE TABLE `riwayat_golongan` (
  `id_riwayat_gol` int UNSIGNED NOT NULL,
  `nip` char(18) NOT NULL,
  `id_gol` int UNSIGNED NOT NULL,
  `tmt_golongan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_golongan`
--

INSERT INTO `riwayat_golongan` (`id_riwayat_gol`, `nip`, `id_gol`, `tmt_golongan`) VALUES
(1, '198709122020121001', 7, '2023-03-01'),
(2, '198709122020121001', 1, '2026-04-16'),
(4, '195709144020121061', 1, '2026-04-13'),
(5, '198709122020121888', 10, '2026-04-10'),
(6, '195709144020121900', 7, '2026-04-03'),
(9, '198709122020121777', 17, '2026-04-09'),
(16, '198709122020121990', 5, '2026-04-03'),
(17, '198709122020121990', 8, '2026-04-02'),
(22, '198709122020121899', 7, '2022-06-16'),
(24, '19170912409801217', 2, '2026-04-20'),
(25, '196709144020127777', 4, '2026-04-02'),
(26, '198709122020121099', 13, '2026-04-04'),
(28, '198709122020144445', 8, '2026-04-18'),
(51, '198709122020121444', 1, '2026-04-28'),
(52, '198709122026789054', 2, '2026-04-04'),
(53, '198709122026789666', 2, '2026-04-04'),
(54, '198709122020125643', 3, '2026-04-03'),
(56, '198709122020190876', 15, '2026-04-01'),
(57, '198709122020109876', 2, '2026-04-11'),
(58, '198709122020121881', 8, '2026-04-04'),
(59, '198709122020121908', 6, '2026-04-06'),
(60, '198709122020190871', 17, '2026-04-11'),
(61, '198709122020125643', 11, '2026-04-03'),
(62, '198709122020125643', 14, '2026-04-30'),
(63, '198709122020125643', 1, '2026-04-01'),
(64, '198709122020125643', 15, '2026-04-30'),
(65, '198709122020134567', 15, '2026-05-01'),
(66, '198709122020121009', 1, '2026-05-05'),
(67, '198709122027687954', 1, '2023-03-07'),
(69, '198709122027687954', 6, '2024-03-03'),
(70, '198709122020121899', 10, '2026-08-07'),
(72, '198709122027687954', 12, '2024-03-03'),
(73, '198709122020121999', 1, '2023-04-23'),
(74, '198709122028796547', 9, '2026-06-09'),
(75, '198709122028796547', 1, '2026-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_jabatan`
--

CREATE TABLE `riwayat_jabatan` (
  `id_riwayat_jabatan` int UNSIGNED NOT NULL,
  `nip` char(18) NOT NULL,
  `id_jabatan` int UNSIGNED NOT NULL,
  `id_unit_kerja` int UNSIGNED NOT NULL,
  `tmt_jabatan` date NOT NULL,
  `unit_kerja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_jabatan`
--

INSERT INTO `riwayat_jabatan` (`id_riwayat_jabatan`, `nip`, `id_jabatan`, `id_unit_kerja`, `tmt_jabatan`, `unit_kerja`) VALUES
(1, '198709122020121001', 1, 3, '2026-03-18', ''),
(3, '195709144020121061', 2, 5, '2024-01-15', ''),
(4, '198709122020121888', 1, 1, '2026-04-10', ''),
(5, '195709144020121900', 1, 3, '2026-04-04', ''),
(8, '198709122020121777', 1, 2, '2026-04-04', ''),
(11, '198709122020121899', 2, 1, '2021-01-16', 'KPU Kota Sorong'),
(12, '198709122020121990', 1, 2, '2026-04-04', ''),
(13, '19170912409801217', 1, 3, '2026-04-20', ''),
(14, '196709144020127777', 1, 2, '2026-04-04', ''),
(15, '198709122020121099', 2, 4, '2026-04-03', ''),
(17, '198709122020144445', 3, 2, '2026-04-17', ''),
(18, '198709122020121990', 3, 2, '2026-04-24', 'bagian C'),
(21, '198709122020121444', 1, 2, '2026-04-28', 'KPU Kota Sorong'),
(22, '198709122026789054', 2, 1, '2026-04-11', 'KPU Kota Sorong'),
(23, '198709122026789666', 2, 1, '2026-04-11', 'KPU Kota Sorong'),
(25, '198709122027687954', 2, 5, '2025-04-10', 'KPU Kota Madiun'),
(26, '198709122020109876', 2, 2, '2026-04-11', 'bagian C'),
(27, '198709122020121881', 2, 2, '2026-04-10', 'bagian C'),
(28, '198709122020121908', 1, 2, '2026-04-06', 'bagian C'),
(29, '198709122020190871', 2, 3, '2026-04-03', 'bagian C'),
(35, '198709122027687954', 1, 5, '2026-04-23', 'KPU Jatim'),
(36, '198709122020134567', 1, 2, '2026-04-06', 'KPU Kota Sorong'),
(37, '198709122020121009', 2, 2, '2026-04-30', 'KPU Kota Sorong'),
(38, '198709122020121899', 1, 1, '2022-02-05', 'KPU Jatim'),
(39, '198709122027687954', 3, 1, '2025-06-10', 'KPU Kota Sorong'),
(41, '198709122020121899', 3, 1, '2026-05-08', 'KPU Kota Madiun'),
(43, '198709122020121999', 1, 4, '2023-04-23', '-'),
(45, '198709122028796547', 1, 1, '2026-05-06', 'KPU Kota Madiun');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kehormatan`
--

CREATE TABLE `riwayat_kehormatan` (
  `id_riwayat_kehormatan` int UNSIGNED NOT NULL,
  `nip` char(18) NOT NULL,
  `nama_penghargaan` varchar(100) NOT NULL,
  `tahun` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_kehormatan`
--

INSERT INTO `riwayat_kehormatan` (`id_riwayat_kehormatan`, `nip`, `nama_penghargaan`, `tahun`) VALUES
(1, '198709122020121001', 'Pegawai Terbaik', 2026),
(3, '195709144020121061', 'Pegawai Terbaik', 2025),
(4, '198709122020121888', 'Pegawai Terbaik', 2023),
(5, '195709144020121900', 'Pegawai Terbaik', 2023),
(8, '198709122020121777', 'Pegawai Terbaik', 2024),
(12, '198709122020121990', 'Winarama I', 2024),
(14, '198709122020121888', 'Winarama I', 2024),
(15, '19170912409801217', 'Pegawai Terbaik', 2025),
(16, '196709144020127777', 'Winarama I', 2012),
(17, '198709122020121099', 'Pegawai Ter', 2024),
(18, '198709122020121990', 'Pegawai Terbaik', 2025),
(19, '198709122020121899', 'Penghargaan Produktivitas Tinggi', 2023),
(20, '198709122020144445', 'Winarama I', 2024),
(21, '198709122020144445', 'Pegawai Terbaik', 2024),
(22, '198709122020121444', 'Pegawai Terbaik', 2022),
(23, '198709122026789054', 'Pegawai Terbaik', 2024),
(24, '198709122026789666', 'Pegawai Terbaik', 2024),
(25, '198709122020125643', 'Pegawai Terbaik', 2025),
(27, '198709122020134567', 'Pegawai Terbaik', 2024),
(28, '198709122027687954', 'Penghargaan Produktivitas Tinggi', 2021),
(29, '198709122020121899', 'Pegawai Terbaik', 2022),
(30, '198709122027687954', 'Pegawai Terbaik', 2022),
(31, '198709122028796547', 'Pegawai Terbaik', 2026);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_keluarga`
--

CREATE TABLE `riwayat_keluarga` (
  `id_riwayat_kel` int UNSIGNED NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nip` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_hub_kel` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_keluarga`
--

INSERT INTO `riwayat_keluarga` (`id_riwayat_kel`, `nama`, `no_telp`, `alamat`, `nip`, `id_hub_kel`) VALUES
(1, 'Hawa', '08693273735329', 'Jl. Pahlawan', '198709122020121001', 3),
(2, 'Hawa Andini Hadi', '0898287766554', 'Jalan Manggis No 90', '195709144020121061', 3),
(3, 'Arini', '089828776655', 'Jalan Manggis No 90', '198709122020121888', 3),
(4, 'ariniy', '089828776699', 'Jalan Manggis No 90', '195709144020121900', 3),
(6, 'Mimi', '089828776655', 'Jalan Manggis No 90', '198709122020121777', 3),
(9, 'Mba Jen', '0836-3543-636', 'Jalan Cendrawasih No 17', '198709122020121899', 2),
(12, 'Hawa', '08363543636', 'Jalan Cendrawasih No 20', '198709122020121888', 1),
(13, 'hawa12', '08363543636', 'Jalan Cendrawasih No 20', '198709122020121888', 3),
(14, 'Indah Melati', '0898287766554', 'Jalan Manggis No 90', '19170912409801217', 2),
(15, 'Mimi', '089828776655', 'Jalan Teratai No 90', '196709144020127777', 3),
(16, 'Mimi', '0898-2877-8976', 'Jalan Teratai No 90', '198709122020121099', 1),
(17, 'Arini', '0836-3543-6365', 'Jalan Cendrawasih No 17', '198709122020121899', 3),
(18, 'Mimi', '0898-2877-6699', 'Jalan Manggis No 90', '198709122020144445', 3),
(20, 'Mba Jen', '0869-3273-735329', 'Jalan Cendrawasih No 20', '198709122020121990', 3),
(21, 'Indah Melati', '0898-2877-6655', 'Jalan Manggis No 90', '198709122020121444', 1),
(22, 'Justin Bieber', '0898-2877-6655', 'Jalan Manggis No 90', '198709122020190876', 1),
(24, 'Indah Melati', '0898-2877-6655', 'Jalan Manggis No 90', '198709122020134567', 2),
(25, 'Arini P', '0869-3273-7353', 'Jl. Pahlawan No 200', '198709122027687954', 2),
(26, 'Youngji', '0869-3273-73532', 'Jalan Cendrawasih No 17', '198709122020121899', 3),
(27, 'Youngjiyyy', '0836-3543-636', 'Jalan Cendrawasih No 17', '198709122020121899', 3),
(28, 'Hawaa ', '0898-2877-6655', 'Jalan Manggis No 90, Sidoarjo', '198709122028796547', 2);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendidikan`
--

CREATE TABLE `riwayat_pendidikan` (
  `id_riwayat_pend` int UNSIGNED NOT NULL,
  `nip` char(18) NOT NULL,
  `id_jenjang_pend` int UNSIGNED NOT NULL,
  `institusi` varchar(100) NOT NULL,
  `tahun_lulus` year NOT NULL,
  `jurusan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_pendidikan`
--

INSERT INTO `riwayat_pendidikan` (`id_riwayat_pend`, `nip`, `id_jenjang_pend`, `institusi`, `tahun_lulus`, `jurusan`) VALUES
(1, '198709122020121001', 4, 'Universitas Negeri Surabaya', 2022, ''),
(3, '195709144020121061', 4, 'Universitas Negeri Surabaya', 2020, ''),
(4, '195709144020121900', 4, 'Universitas Negeri Surabaya', 2024, ''),
(7, '198709122020121777', 4, 'Universitas Negeri Malang', 2024, ''),
(10, '198709122020121990', 4, 'Universitas Negeri Malang', 2023, 'Hukum'),
(11, '19170912409801217', 4, 'Universitas Negeri Malang', 2019, ''),
(12, '196709144020127777', 4, 'Universitas Negeri Surabaya', 2025, ''),
(13, '198709122020121099', 4, 'Universitas Negeri Surabaya', 2025, ''),
(15, '198709122020144445', 3, 'SMA Bangsa', 2024, ''),
(16, '198709122020144445', 4, 'Universitas Negeri Malang', 2020, ''),
(17, '198709122020121990', 2, 'SMP Bangsa', 2019, NULL),
(20, '198709122020121444', 4, 'Universitas Negeri Malang', 2020, NULL),
(21, '198709122026789054', 4, 'Universitas Negeri Malang', 2024, NULL),
(22, '198709122026789666', 4, 'Universitas Negeri Malang', 2024, NULL),
(23, '198709122020125643', 4, 'Universitas Negeri Surabaya', 2024, NULL),
(24, '198709122027687954', 4, 'Universitas Negeri Malang', 2008, 'Sistem Informasi'),
(25, '198709122020190876', 4, 'Universitas Negeri Malang', 2023, NULL),
(26, '198709122020109876', 1, 'Universitas Negeri Surabaya', 2023, NULL),
(27, '198709122020121881', 4, 'Universitas Negeri Malang', 2025, NULL),
(28, '198709122020121908', 4, 'Universitas Negeri Surabaya', 2025, NULL),
(29, '198709122020190871', 3, 'SMAN 1 Sidoarjo', 2022, NULL),
(30, '198709122020134567', 4, 'Universitas Negeri Surabaya', 2023, 'Hukum'),
(31, '198709122020121009', 3, 'SMAN 1 Surabaya', 2000, NULL),
(32, '198709122027687954', 1, 'SDN 1 Surabaya', 1999, '-'),
(34, '198709122027687954', 2, 'SMP Bangsa', 2000, '-'),
(35, '198709122020121899', 2, 'SMP Bangsa 5', 2000, '-'),
(36, '198709122020121899', 1, 'SDN 1 Surabaya', 1999, '-'),
(37, '198709122027687954', 3, 'SMAN 1 Sidoarjo', 2004, 'MIPA'),
(38, '198709122020121999', 4, 'Universitas Negeri Surabaya', 2019, 'Sistem Informasi'),
(39, '198709122028796547', 4, 'Universitas Negeri Malang', 2019, 'Hukum'),
(40, '198709122028796547', 3, 'SMAN 1 Surabaya', 2016, 'MIPA');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_skp`
--

CREATE TABLE `riwayat_skp` (
  `id_riwayat_skp` int UNSIGNED NOT NULL,
  `nip` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_predikat_skp` int UNSIGNED NOT NULL,
  `rerata_nilai` decimal(5,2) DEFAULT NULL,
  `tahun` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_skp`
--

INSERT INTO `riwayat_skp` (`id_riwayat_skp`, `nip`, `id_predikat_skp`, `rerata_nilai`, `tahun`) VALUES
(1, '198709122020121001', 1, '90.00', 2024),
(2, '195709144020121061', 2, '81.00', 2026),
(3, '198709122020121888', 3, '90.00', 2022),
(4, '195709144020121900', 2, '89.00', 2024),
(6, '198709122020121777', 2, '89.00', 2025),
(9, '198709122020121899', 3, NULL, 2025),
(11, '198709122020121990', 2, '90.00', 2025),
(12, '19170912409801217', 2, '80.77', 2025),
(13, '196709144020127777', 2, '90.00', 2025),
(14, '198709122020121099', 1, '90.00', 2025),
(16, '198709122020144445', 2, '89.00', 2026),
(17, '198709122020144445', 1, '90.00', 2025),
(18, '198709122020121444', 4, '70.99', 2020),
(19, '198709122026789054', 3, '78.00', 2024),
(20, '198709122026789666', 3, '78.00', 2024),
(21, '198709122020125643', 4, '67.00', 2025),
(22, '198709122027687954', 2, '80.99', 2025),
(23, '198709122020134567', 3, '78.00', 2024),
(25, '198709122020121899', 2, '89.00', 2026),
(26, '198709122020121899', 2, NULL, 2020),
(28, '198709122027687954', 3, '77.90', 2024),
(29, '198709122028796547', 2, NULL, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int UNSIGNED NOT NULL,
  `nip` char(18) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('admin','pegawai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pegawai',
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nip`, `username`, `email`, `password`, `role`, `last_login`, `is_active`, `created_at`) VALUES
(1, '198709122020121001', 'Ariniy', 'arini2004@gmail.com', '$2b$12$F7UfiGfRWo7fzj5zSO4wOeLK.mEJZj0qS2w90V.mXyVjYMoHHpiTO', 'pegawai', '2026-04-15 09:52:19', 1, '2026-03-27 06:31:49'),
(2, '198809122020121030', 'yumna', 'zakkiyayumna@gmail.com', '$2y$10$udJVQlbj/S0/wOFEIGON0.rs1EJsjX01rHlTuOATCmlEtpI8VAswu', 'admin', '2026-04-30 13:42:55', 1, '2026-04-09 01:46:36'),
(3, '195709144020121061', 'hawa', 'hawaandini205@gmail.com', '$2y$10$5EscpLu5uTKexs3miH2YV.9VugywRwWhm9CiNlQzdz3OktxgqBfSW', 'admin', '2026-05-06 13:50:38', 1, '2026-04-13 04:20:37'),
(4, '195709144020121061', 'andini', 'andin4227@gmail.com', '$2y$10$5EscpLu5uTKexs3miH2YV.9VugywRwWhm9CiNlQzdz3OktxgqBfSW', 'pegawai', '2026-04-14 10:43:21', 0, '2026-04-13 04:33:50'),
(5, '198709122020121899', 'kyungsoo', 'dokyungsoo2000@gmail.com', '$2y$10$rMaMwITMK4a8IityAILBqe4SDb7XQvr9feObUZqJdX8fSEfFl8YVy', 'pegawai', '2026-05-05 14:16:41', 1, '2026-04-14 07:36:07'),
(6, '198709122020144445', 'Jennie', 'jennie@gmail.com', '$2y$10$dJNGHsRKeQtUXXiLhMWEAuOMAk3G9Q8xl6Y5tfq.8WM/658pwfjJS', 'pegawai', NULL, 0, '2026-04-23 02:49:51'),
(7, '198709122020134567', 'Baim', 'Baimwong@gmail.com', '$2y$10$jJzsLg.vBluAz711rrawpuiDOrykgUYsTojmQXIIhf5JEnqOwbyd.', 'pegawai', '2026-05-05 09:33:00', 0, '2026-05-05 02:31:31'),
(8, '198709122028796547', 'daffa', 'daffa12@gmail.com', '$2y$10$xkcKMCgqrfEGs301P7cEneDNVHTAW7iJ3.9mTOy9RMC8/ajpfEFgS', 'pegawai', '2026-05-06 13:42:51', 0, '2026-05-06 06:28:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_agama`
--
ALTER TABLE `master_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `master_diklat`
--
ALTER TABLE `master_diklat`
  ADD PRIMARY KEY (`id_jenis_diklat`);

--
-- Indexes for table `master_divisi`
--
ALTER TABLE `master_divisi`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indexes for table `master_golongan`
--
ALTER TABLE `master_golongan`
  ADD PRIMARY KEY (`id_gol`);

--
-- Indexes for table `master_hub_kel`
--
ALTER TABLE `master_hub_kel`
  ADD PRIMARY KEY (`id_hub_kel`);

--
-- Indexes for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `master_jenis_kelamin`
--
ALTER TABLE `master_jenis_kelamin`
  ADD PRIMARY KEY (`id_jenis_kelamin`);

--
-- Indexes for table `master_jenjang_pend`
--
ALTER TABLE `master_jenjang_pend`
  ADD PRIMARY KEY (`id_jenjang_pend`);

--
-- Indexes for table `master_kabupaten`
--
ALTER TABLE `master_kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `master_predikat_skp`
--
ALTER TABLE `master_predikat_skp`
  ADD PRIMARY KEY (`id_predikat_skp`);

--
-- Indexes for table `master_status_perkawinan`
--
ALTER TABLE `master_status_perkawinan`
  ADD PRIMARY KEY (`id_status_perkawinan`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id_reset`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `UNIQUE` (`nip`) USING BTREE,
  ADD KEY `id_jenis_kelamin` (`id_jenis_kelamin`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_status_perkawinan` (`id_status_perkawinan`),
  ADD KEY `id_gol` (`id_gol`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`);

--
-- Indexes for table `riwayat_diklat`
--
ALTER TABLE `riwayat_diklat`
  ADD PRIMARY KEY (`id_riwayat_diklat`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `riwayat_golongan`
--
ALTER TABLE `riwayat_golongan`
  ADD PRIMARY KEY (`id_riwayat_gol`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_gol` (`id_gol`);

--
-- Indexes for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD PRIMARY KEY (`id_riwayat_jabatan`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`);

--
-- Indexes for table `riwayat_kehormatan`
--
ALTER TABLE `riwayat_kehormatan`
  ADD PRIMARY KEY (`id_riwayat_kehormatan`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `riwayat_keluarga`
--
ALTER TABLE `riwayat_keluarga`
  ADD PRIMARY KEY (`id_riwayat_kel`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_hub_kel` (`id_hub_kel`);

--
-- Indexes for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD PRIMARY KEY (`id_riwayat_pend`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_jenjang_pend` (`id_jenjang_pend`);

--
-- Indexes for table `riwayat_skp`
--
ALTER TABLE `riwayat_skp`
  ADD PRIMARY KEY (`id_riwayat_skp`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_predikat_skp` (`id_predikat_skp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `UNIQUE` (`username`) USING BTREE,
  ADD UNIQUE KEY `UNIQUE1` (`email`) USING BTREE,
  ADD KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_agama`
--
ALTER TABLE `master_agama`
  MODIFY `id_agama` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_diklat`
--
ALTER TABLE `master_diklat`
  MODIFY `id_jenis_diklat` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_divisi`
--
ALTER TABLE `master_divisi`
  MODIFY `id_unit_kerja` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_golongan`
--
ALTER TABLE `master_golongan`
  MODIFY `id_gol` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master_hub_kel`
--
ALTER TABLE `master_hub_kel`
  MODIFY `id_hub_kel` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  MODIFY `id_jabatan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_jenis_kelamin`
--
ALTER TABLE `master_jenis_kelamin`
  MODIFY `id_jenis_kelamin` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_jenjang_pend`
--
ALTER TABLE `master_jenjang_pend`
  MODIFY `id_jenjang_pend` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_kabupaten`
--
ALTER TABLE `master_kabupaten`
  MODIFY `id_kabupaten` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT for table `master_predikat_skp`
--
ALTER TABLE `master_predikat_skp`
  MODIFY `id_predikat_skp` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_status_perkawinan`
--
ALTER TABLE `master_status_perkawinan`
  MODIFY `id_status_perkawinan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id_reset` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_diklat`
--
ALTER TABLE `riwayat_diklat`
  MODIFY `id_riwayat_diklat` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `riwayat_golongan`
--
ALTER TABLE `riwayat_golongan`
  MODIFY `id_riwayat_gol` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  MODIFY `id_riwayat_jabatan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `riwayat_kehormatan`
--
ALTER TABLE `riwayat_kehormatan`
  MODIFY `id_riwayat_kehormatan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `riwayat_keluarga`
--
ALTER TABLE `riwayat_keluarga`
  MODIFY `id_riwayat_kel` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  MODIFY `id_riwayat_pend` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `riwayat_skp`
--
ALTER TABLE `riwayat_skp`
  MODIFY `id_riwayat_skp` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jenis_kelamin`) REFERENCES `master_jenis_kelamin` (`id_jenis_kelamin`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_agama`) REFERENCES `master_agama` (`id_agama`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`id_status_perkawinan`) REFERENCES `master_status_perkawinan` (`id_status_perkawinan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pegawai_ibfk_4` FOREIGN KEY (`id_gol`) REFERENCES `master_golongan` (`id_gol`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pegawai_ibfk_5` FOREIGN KEY (`id_unit_kerja`) REFERENCES `master_divisi` (`id_unit_kerja`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_diklat`
--
ALTER TABLE `riwayat_diklat`
  ADD CONSTRAINT `riwayat_diklat_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_golongan`
--
ALTER TABLE `riwayat_golongan`
  ADD CONSTRAINT `riwayat_golongan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `riwayat_golongan_ibfk_2` FOREIGN KEY (`id_gol`) REFERENCES `master_golongan` (`id_gol`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD CONSTRAINT `riwayat_jabatan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `riwayat_jabatan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `master_jabatan` (`id_jabatan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `riwayat_jabatan_ibfk_3` FOREIGN KEY (`id_unit_kerja`) REFERENCES `master_divisi` (`id_unit_kerja`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_kehormatan`
--
ALTER TABLE `riwayat_kehormatan`
  ADD CONSTRAINT `riwayat_kehormatan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_keluarga`
--
ALTER TABLE `riwayat_keluarga`
  ADD CONSTRAINT `riwayat_keluarga_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `riwayat_keluarga_ibfk_2` FOREIGN KEY (`id_hub_kel`) REFERENCES `master_hub_kel` (`id_hub_kel`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD CONSTRAINT `riwayat_pendidikan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `riwayat_pendidikan_ibfk_2` FOREIGN KEY (`id_jenjang_pend`) REFERENCES `master_jenjang_pend` (`id_jenjang_pend`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `riwayat_skp`
--
ALTER TABLE `riwayat_skp`
  ADD CONSTRAINT `riwayat_skp_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `riwayat_skp_ibfk_2` FOREIGN KEY (`id_predikat_skp`) REFERENCES `master_predikat_skp` (`id_predikat_skp`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
