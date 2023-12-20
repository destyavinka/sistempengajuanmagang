-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 02:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simaskot`
--

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE `instansis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `nama_instansi`, `created_at`, `updated_at`) VALUES
(1, 'UNS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sertifikasis`
--

CREATE TABLE `jenis_sertifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_sertifikasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_sertifikasis`
--

INSERT INTO `jenis_sertifikasis` (`id`, `jenis_sertifikasi`, `created_at`, `updated_at`) VALUES
(1, 'Internasional', NULL, NULL),
(2, 'Nasional', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `magangs`
--

CREATE TABLE `magangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topik_magang` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `tgl_penerbitan` date NOT NULL,
  `masa_berlaku` date DEFAULT NULL,
  `status_seumur_hidup` int(11) NOT NULL DEFAULT 0,
  `status_magang` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `instansi_id` bigint(20) UNSIGNED NOT NULL,
  `skema_id` bigint(20) UNSIGNED NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magangs`
--

INSERT INTO `magangs` (`id`, `topik_magang`, `tgl_daftar`, `tgl_pelaksanaan`, `sertifikat`, `tgl_penerbitan`, `masa_berlaku`, `status_seumur_hidup`, `status_magang`, `user_id`, `instansi_id`, `skema_id`, `periode_id`) VALUES
(1, 'Oracle', '2023-07-25', '2023-07-26', 'rincian.pdf', '2023-07-27', '2023-07-25', 0, 'Pengajuan Disetujui', 2, 1, 1, 1),
(2, 'Laravel', '2023-07-25', '2023-07-26', 'revisi.pdf', '2023-07-29', '2023-08-23', 0, 'Pengajuan Disetujui', 2, 1, 1, 1),
(6, 'Laravel', '2023-07-26', '2023-07-28', 'LEMBAR REVISI UJIAN TUGAS AKHIR.pdf', '2023-07-28', '2024-07-26', 0, 'Belum Disetujui', 2, 1, 1, 2),
(7, 'Oracle', '2023-07-24', '2023-07-24', NULL, '2023-07-24', '2023-07-24', 0, 'Belum Disetujui', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_01_01_050101_create_units_table', 1),
(3, '2023_01_01_154821_create_roles_table', 1),
(4, '2023_01_01_161351_create_users_table', 1),
(5, '2023_03_28_064012_create_periodes_table', 1),
(6, '2023_03_29_063442_create_skemas_table', 1),
(7, '2023_03_29_063920_create_instansis_table', 1),
(8, '2023_03_29_072431_create_penyelenggaras_table', 1),
(9, '2023_03_29_072516_create_jenis_sertifikasis_table', 1),
(10, '2023_03_29_072606_create_pengajuan_magangs_table', 1),
(11, '2023_03_29_073638_create_magangs_table', 1),
(12, '2023_03_29_073737_create_pengajuan_serkoms_table', 1),
(13, '2023_03_29_074109_create_serkoms_table', 1),
(14, '2023_06_20_052718_create_pekertis_table', 1),
(15, '2023_06_21_084330_create_pekertians_table', 1),
(16, '2023_06_30_134115_create_users_verify_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pekertians`
--

CREATE TABLE `pekertians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_sertifikat` varchar(255) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `tgl_penerbitan` date NOT NULL,
  `status_pekerti` varchar(255) DEFAULT NULL,
  `status_seumur_hidup` int(11) NOT NULL DEFAULT 0,
  `masa_berlaku` date DEFAULT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekertians`
--

INSERT INTO `pekertians` (`id`, `nomor_sertifikat`, `tgl_pelaksanaan`, `sertifikat`, `tgl_penerbitan`, `status_pekerti`, `status_seumur_hidup`, `masa_berlaku`, `user_id`) VALUES
(1, '37649287', '2023-07-25', 'revisi.pdf', '2023-07-20', 'Pengajuan Disetujui', 1, NULL, '2'),
(2, '2563527', '2023-07-28', 'Revisi_Destya Vinka Wahyu Rosa Adinda.pdf', '2023-07-27', 'Belum Disetujui', 1, NULL, '2'),
(3, '12301823', '2023-07-24', NULL, '2023-07-24', 'Belum Disetujui', 0, '2023-07-24', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_magangs`
--

CREATE TABLE `pengajuan_magangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topik_magang` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `pengajuan_anggaran` varchar(255) NOT NULL,
  `keterangan_anggaran` varchar(255) NOT NULL,
  `dokumen_dukung` varchar(255) NOT NULL,
  `anggaran_disetujui` varchar(255) DEFAULT NULL,
  `surat_tugas` varchar(255) DEFAULT NULL,
  `status_pengajuanmagang` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `instansi_id` bigint(20) UNSIGNED NOT NULL,
  `skema_id` bigint(20) UNSIGNED NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_magangs`
--

INSERT INTO `pengajuan_magangs` (`id`, `topik_magang`, `tgl_daftar`, `tgl_pelaksanaan`, `pengajuan_anggaran`, `keterangan_anggaran`, `dokumen_dukung`, `anggaran_disetujui`, `surat_tugas`, `status_pengajuanmagang`, `user_id`, `instansi_id`, `skema_id`, `periode_id`, `created_at`, `updated_at`) VALUES
(1, 'Oracle', '2023-07-25', '2023-07-26', '3.000.000', 'Transportasi', 'rincian.pdf', '1000000', 'revisi.pdf', 'Pengajuan Disetujui', 2, 1, 1, 1, NULL, NULL),
(2, 'Laravel', '2023-07-25', '2023-07-28', '1.000.000', 'trasnportasi', 'rincian.pdf', '100000', 'docs2.pdf', 'Pengajuan Disetujui', 2, 1, 1, 1, NULL, NULL),
(3, 'Phyton', '2023-07-25', '2023-07-27', '1.000.000', 'Transportasi', 'rincian.pdf', '900000', 'LEMBAR REVISI UJIAN TUGAS AKHIR.pdf', 'Pengajuan Disetujui', 2, 1, 1, 1, NULL, NULL),
(4, 'tes', '2023-07-26', '2023-07-27', '4.000.000', 'eetr', 'LEMBAR REVISI UJIAN TUGAS AKHIR.pdf', NULL, NULL, 'Menunggu Validasi', 2, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_serkoms`
--

CREATE TABLE `pengajuan_serkoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sertifikasi` varchar(255) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `anggaran` varchar(255) NOT NULL,
  `status_pengajuanserkom` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `penyelenggara_id` bigint(20) UNSIGNED NOT NULL,
  `skema_id` bigint(20) UNSIGNED NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_sertifikasi_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_serkoms`
--

INSERT INTO `pengajuan_serkoms` (`id`, `nama_sertifikasi`, `tgl_pelaksanaan`, `anggaran`, `status_pengajuanserkom`, `user_id`, `penyelenggara_id`, `skema_id`, `periode_id`, `jenis_sertifikasi_id`) VALUES
(1, 'Oracle', '2023-07-27', '2.000.000', 'Pengajuan Disetujui', 2, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggaras`
--

CREATE TABLE `penyelenggaras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyelenggaras`
--

INSERT INTO `penyelenggaras` (`id`, `penyelenggara`, `created_at`, `updated_at`) VALUES
(1, 'UNS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periodes`
--

INSERT INTO `periodes` (`id`, `semester`, `tahun`) VALUES
(1, 'Ganjil', 2023),
(2, 'Genap', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Tenaga Pendidik', NULL, NULL),
(2, 'Tenaga Kependidikan', NULL, NULL),
(3, 'Kaprodi', NULL, NULL),
(4, 'Admin Sekolah Vokasi', NULL, NULL),
(5, 'Dekan', NULL, NULL),
(6, 'Super Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serkoms`
--

CREATE TABLE `serkoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sertifikasi` varchar(255) NOT NULL,
  `tgl_penerbitan` date NOT NULL,
  `masa_berlaku` date DEFAULT NULL,
  `status_seumur_hidup` int(11) NOT NULL DEFAULT 0,
  `sertifikat` varchar(255) DEFAULT NULL,
  `status_serkom` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `penyelenggara_id` bigint(20) UNSIGNED NOT NULL,
  `skema_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serkoms`
--

INSERT INTO `serkoms` (`id`, `nama_sertifikasi`, `tgl_penerbitan`, `masa_berlaku`, `status_seumur_hidup`, `sertifikat`, `status_serkom`, `user_id`, `penyelenggara_id`, `skema_id`) VALUES
(1, 'Oracle', '2023-07-25', NULL, 1, 'LEMBAR REVISI UJIAN TUGAS AKHIR.pdf', 'Pengajuan Disetujui', 2, 1, 1),
(3, 'Laravel', '2023-07-24', '2023-07-24', 0, NULL, 'Belum Disetujui', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skemas`
--

CREATE TABLE `skemas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_skema` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skemas`
--

INSERT INTO `skemas` (`id`, `nama_skema`, `created_at`, `updated_at`) VALUES
(1, 'Programming', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama_unit`, `created_at`, `updated_at`) VALUES
(1, 'Sekolah Vokasi', NULL, NULL),
(2, 'D4 Keselamatan dan Kesehatan Kerja', NULL, NULL),
(3, 'D4 Demografi dan Pencatatan Sipil', NULL, NULL),
(4, 'D3 Teknik Informatika', NULL, NULL),
(5, 'D3 Kebidanan', NULL, NULL),
(6, 'D3 Perpustakaan', NULL, NULL),
(7, 'D3 Farmasi', NULL, NULL),
(8, 'D3 Agribisnis', NULL, NULL),
(9, 'D3 Akutansi', NULL, NULL),
(10, 'D3 Teknologi Hasil Pertanian', NULL, NULL),
(11, 'D3 Usaha Perjalanan Wisata', NULL, NULL),
(12, 'D3 Keuangan Perbankan', NULL, NULL),
(13, 'D3 Budidaya Ternak', NULL, NULL),
(14, 'D3 Komunikasi Terapan', NULL, NULL),
(15, 'D3 Manajemen Bisnis', NULL, NULL),
(16, 'D3 Teknik Mesin', NULL, NULL),
(17, 'D3 Desain Komunikasi Visual', NULL, NULL),
(18, 'D3 Manajemen Pemasaran', NULL, NULL),
(19, 'D3 Bahasa Mandarin', NULL, NULL),
(20, 'D3 Manajemen Perdagangan', NULL, NULL),
(21, 'D3 Teknik Sipil', NULL, NULL),
(22, 'D3 Bahasa Inggris', NULL, NULL),
(23, 'D3 Perpajakan', NULL, NULL),
(24, 'D3 Teknik Kimia', NULL, NULL),
(25, 'D3 Manajemen Administrasi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nip`, `email`, `password`, `level`, `unit`, `created_at`, `updated_at`, `is_email_verified`) VALUES
(1, 'Super Admin', '00000000', 'superadmin@staff.uns.ac.id', '$2y$10$L6UZkxoP4H7/4e2B8FkFL.vScQ8nbgfL0D7Qh4c4nl90r4NEsrTZe', 'Super Admin', 'umum', '2023-07-24 15:42:44', '2023-07-24 15:42:44', 1),
(2, 'Destya', '34562782098', 'destya@staff.uns.ac.id', '$2y$10$5IEoOpWPZ7Erkt8IqgIofuLlurTg2ERYnqMynOAmGJ.EcTaEosEzO', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-24 15:43:44', '2023-07-24 15:43:44', 1),
(8, 'Dekanat', '198502062015041003', 'dekan@staff.uns.ac.id', '$2y$10$iUJl3aQtfpVYWv6gODuMoODnMrwl7dSkIBP2C4l3Jklqi4t2sc0e.', 'Dekan', 'umum', '2023-07-25 00:09:53', '2023-07-26 07:31:37', 1),
(25, 'Kaprodi D3 Teknik Informatika', '1950206543821', 'kaprodi@staff.uns.ac.id', '$2y$10$e4C7bfWFhnm8WFVbQV.axulWUrFLo3I0c2YNK6BI88gJQuIT2ixN6', 'Kaprodi', 'D3 Teknik Informatika', '2023-07-25 00:28:22', '2023-07-25 00:28:22', 1),
(26, 'Eko Harry Pratisto, S.T., M.Info.Tech., Ph.D.', '19850206201', 'ekoharry0@staff.uns.ac.id', '$2y$10$8JZ0OdqWDL.SwReimQfCe.ZAYIbI/bdMXNRr354Exo0bpExc.9vMq', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:33', '2023-07-25 00:51:33', 0),
(27, 'Mohammad Asrie Safi’i S.Si., M.Kom.', '19850206202', 'safiie990@staff.uns.ac.id', '$2y$10$F7T4tkL3OIkIES8Wpn0K9.K6RUGuQx6I/ViNk8BRdrgb5vBCLifzC', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:33', '2023-07-25 00:51:33', 0),
(28, 'Nurul Firdaus, S.Kom., M.Info.Tech.', '19850206203', 'nurul.firdaus0@staff.uns.ac.id', '$2y$10$GthGV6X9y4xhGalFadMqBOYekb/LoTekvNDh7L0nDT9IgRw5fnwqa', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:33', '2023-07-25 00:51:33', 0),
(29, 'Agus Purbayu, S.Si.,M.Kom.', '19850206204', 'bayoe0@staff.uns.ac.id', '$2y$10$IrwkcNE/OqldKbcFzmPsVebgjnSmJisfcBpAp.gwAn1lel1v9ftCG', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:33', '2023-07-25 00:51:33', 0),
(30, 'Fiddin Yusfida A’La, S.T., M.Eng.', '19850206205', 'fiddin0@staff.uns.ac.id', '$2y$10$xAbTY7DycieUkCaJofxNYeL35MolsdEBe15VdYOrYG0Qr/ogz8zhe', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:33', '2023-07-25 00:51:33', 0),
(31, 'Taufiqurrakhman Nur Hidayat, S.Kom., M.Cs.', '19850206206', 'taufiqurrakhman.nh0@staff.uns.ac.id', '$2y$10$cp.5wKzDFPdGigv9f9lIX.VEZ4Et9fjyPinYcG6.k7qUoWNJBMfjW', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(32, 'Hartatik, S.Si., M.Si.', '19850206207', 'hartatik1190@staff.uns.ac.id', '$2y$10$bgw3tbEPFBWVqEIODdVFPe.M1wJCPEQ05nwXNhYlhMNPilois4k1O', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(33, 'Abdul Aziz, S.Kom., M.Cs.', '19850206208', 'aaziz0@staff.uns.ac.id', '$2y$10$TZhvSeyjrocgw/KsEkrZaeVV.Ik2ofVBJcXCWgM8G75XSyVzddSRW', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(34, 'Fendi Aji Purnomo, S.SI., M.Eng.', '19850206209', 'fendi_aji0@staff.uns.ac.id', '$2y$10$t8v3pAKMWkM5PVmriC/wu.vS36VyO/JI8c6Gql4Mc21/zaQxud3s.', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(35, 'Rudi Hartono, S.Si., M.Eng.', '19850206210', 'rudi.hartono0@staff.uns.ac.id', '$2y$10$9kDQ8tDbHb.RK2TFODWjJ.iTcsBN4Ar4XtE.VEo.QVKJ/YDNvMV7W', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(36, 'Berliana Kusuma Riasti, S.T., M.Eng.', '19850206211', 'berliana0@staff.uns.ac.id', '$2y$10$7zmaFUDGdI2IgAtn2XBEDuYuF0USLsIgJe7EjeOYGMRf6uRrCP53u', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(37, 'Sahirul Alim Tri Bawono, S.Kom., M.Eng.', '19850206212', 'sahirul0@staff.uns.ac.id', '$2y$10$9aNDO9cm9JrW.Ij/M41O1.qihSqN/4KVWT6j9q8dAp6EW6eMMXgGa', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:34', '2023-07-25 00:51:34', 0),
(38, 'Nanang Maulana Yoeseph, S.Si., M.Cs.', '19850206213', 'nanang.my0@staff.uns.ac.id', '$2y$10$.9a6cLqIpQHYDdwo8uZxn.wEaF90oKELt9NLWoKBnOROz4/TgmeMi', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:35', '2023-07-25 00:51:35', 0),
(39, 'Ovide Decroly Wisnu Ardhi, S.T., M.Eng.', '19850206214', 'ovide0@staff.uns.ac.id', '$2y$10$Dnf7UAwBm5M5D11kc4Dxr.WqL/EGixxj81Xl3vRtfKppb8d2UAQkC', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:35', '2023-07-25 00:51:35', 0),
(40, 'Yudho Yudhanto, S.Kom., M.Kom.', '19850206215', 'yyudhanto0@staff.uns.ac.id', '$2y$10$QTe99VV0Cgt448wNQdUrhu1fZWU7R0pKfc6Z0oAkUbwr0ELqmQ2bu', 'Tenaga Pendidik', 'D3 Teknik Informatika', '2023-07-25 00:51:35', '2023-07-25 00:51:35', 0),
(41, 'Nurlaily Purnama Sari, S.Kom.', '19850206216', 'nurlailypurnama0@staff.uns.ac.id', '$2y$10$Pifdz8wTBA7PCBc./LvdoeeETD8DKGEaW8yNIyZmrR2mMHUCD4n5q', 'Tenaga Kependidikan', 'D3 Teknik Informatika', '2023-07-25 00:51:35', '2023-07-25 00:51:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_verify`
--

CREATE TABLE `users_verify` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_verify`
--

INSERT INTO `users_verify` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 'XPkCNW4xcQU1Eegu2nUVA5p1vfUMO80yh6WNk9KYN5S7kLnRb4mS8oznHppkFbPX', '2023-07-24 15:42:44', '2023-07-24 15:42:44'),
(2, 'Afw1ui8b7bCVBQgHFIQ2tWU5640CxWCZz2CdyWLkQBCL5pHEo1q5k83OoacbYP23', '2023-07-24 15:43:44', '2023-07-24 15:43:44'),
(4, 'TRzICENTBkyMdQ6KJDpYPEtEx2kOrPHmjuk090st4G4Kru2P3FzR7uNao18LU95a', '2023-07-24 16:05:09', '2023-07-24 16:05:09'),
(7, 'DNPZbwKMAZJyN6pL4tmrYdYoAPJk2d1q0EdbpL87GUEf7WlSDgPlSKZEraRQ6CbU', '2023-07-25 00:08:46', '2023-07-25 00:08:46'),
(8, 'lmBe4ft6mGHNgME9MtzLhyZiSN3BxHH0ScTigQuO76Wr8y4jtDslEQi4Z5BmPuRo', '2023-07-25 00:09:53', '2023-07-25 00:09:53'),
(25, 'J9LKFXSauuSsMviPwluK7OUvlzuBrRdJ1L7FKG5hM50btudTbZcfv61gbnyIEqlE', '2023-07-25 00:28:22', '2023-07-25 00:28:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_sertifikasis`
--
ALTER TABLE `jenis_sertifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magangs`
--
ALTER TABLE `magangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `magangs_instansi_id_foreign` (`instansi_id`),
  ADD KEY `magangs_skema_id_foreign` (`skema_id`),
  ADD KEY `magangs_periode_id_foreign` (`periode_id`),
  ADD KEY `magangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekertians`
--
ALTER TABLE `pekertians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_magangs`
--
ALTER TABLE `pengajuan_magangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_magangs_instansi_id_foreign` (`instansi_id`),
  ADD KEY `pengajuan_magangs_skema_id_foreign` (`skema_id`),
  ADD KEY `pengajuan_magangs_periode_id_foreign` (`periode_id`),
  ADD KEY `pengajuan_magangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengajuan_serkoms`
--
ALTER TABLE `pengajuan_serkoms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_serkoms_penyelenggara_id_foreign` (`penyelenggara_id`),
  ADD KEY `pengajuan_serkoms_skema_id_foreign` (`skema_id`),
  ADD KEY `pengajuan_serkoms_periode_id_foreign` (`periode_id`),
  ADD KEY `pengajuan_serkoms_user_id_foreign` (`user_id`),
  ADD KEY `pengajuan_serkoms_jenis_sertifikasi_id_foreign` (`jenis_sertifikasi_id`);

--
-- Indexes for table `penyelenggaras`
--
ALTER TABLE `penyelenggaras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serkoms`
--
ALTER TABLE `serkoms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serkoms_penyelenggara_id_foreign` (`penyelenggara_id`),
  ADD KEY `serkoms_skema_id_foreign` (`skema_id`);

--
-- Indexes for table `skemas`
--
ALTER TABLE `skemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_nama_unit_unique` (`nama_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_sertifikasis`
--
ALTER TABLE `jenis_sertifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `magangs`
--
ALTER TABLE `magangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pekertians`
--
ALTER TABLE `pekertians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan_magangs`
--
ALTER TABLE `pengajuan_magangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuan_serkoms`
--
ALTER TABLE `pengajuan_serkoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyelenggaras`
--
ALTER TABLE `penyelenggaras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `serkoms`
--
ALTER TABLE `serkoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skemas`
--
ALTER TABLE `skemas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `magangs`
--
ALTER TABLE `magangs`
  ADD CONSTRAINT `magangs_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magangs_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magangs_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_magangs`
--
ALTER TABLE `pengajuan_magangs`
  ADD CONSTRAINT `pengajuan_magangs_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_magangs_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_magangs_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_magangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_serkoms`
--
ALTER TABLE `pengajuan_serkoms`
  ADD CONSTRAINT `pengajuan_serkoms_jenis_sertifikasi_id_foreign` FOREIGN KEY (`jenis_sertifikasi_id`) REFERENCES `jenis_sertifikasis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_serkoms_penyelenggara_id_foreign` FOREIGN KEY (`penyelenggara_id`) REFERENCES `penyelenggaras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_serkoms_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_serkoms_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_serkoms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `serkoms`
--
ALTER TABLE `serkoms`
  ADD CONSTRAINT `serkoms_penyelenggara_id_foreign` FOREIGN KEY (`penyelenggara_id`) REFERENCES `penyelenggaras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serkoms_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
