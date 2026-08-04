-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 07:25 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurnalharianpegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `kodeagenda` int(10) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `kodeguru` varchar(25) NOT NULL,
  `kodejabatan` varchar(50) NOT NULL,
  `aktivitas` text NOT NULL,
  `tempat` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`kodeagenda`, `hari`, `tanggal`, `waktu`, `kodeguru`, `kodejabatan`, `aktivitas`, `tempat`) VALUES
(248, 'Kamis', '2023-04-13', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Membuka kegiatan sosialisasi tindak kekerasan dari Kemenkumham Wilayah Kalsel', 'SMAN 8 Banjarmasin'),
(249, 'Jumat', '2023-04-14', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Membuka program indahnya berbagi bulan Ramadhan 1444H', 'SMAN 8 Banjarmasin'),
(250, 'Jumat', '2023-03-17', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Serah terima jabatan kepala sekolah secara kolektif. Kepala SMA Negeri 8 dari Plt. Dr. Hj. Djunaidah, M.Pd. kepada H. Sutikno, S.Pd., M.Pd.', 'SMAN 10 Banjarmasin'),
(251, 'Senin', '2023-03-20', '11:15:00', 'sutikno', 'Kepala Sekolah', 'Serah terima jabatan dan pisah sambut kepala SMAN 1 Belawang dari H. Sutikno, S.Pd., M.Pd. kepada H. Kaspul Anwar, S.Pd., M.Pd.', 'SMAN 1 Belawang'),
(252, 'Selasa', '2023-03-21', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Pisah sambut kepala SMA Negeri 8 Banjarmasin', 'SMAN 8 Banjarmasin'),
(253, 'Selasa', '2023-03-21', '11:00:00', 'sutikno', 'Kepala Sekolah', 'Mengikuti Rapat Anggota Tahun (RAT) koperasi pegawai SMA Negeri 6 Banjarmasin', 'SMAN 6 Banjarmasin'),
(254, 'Selasa', '2023-03-21', '14:30:00', 'sutikno', 'Kepala Sekolah', 'Perkenalan kepala sekolah baru dengan warga SMA Negeri 8 Banjarmasin', 'SMAN 8 Banjarmasin'),
(255, 'Rabu', '2023-03-22', '08:30:00', 'sutikno', 'Kepala Sekolah', 'Pertemuan dan perkenalan serta konfirmasi tugas tenaga kependidikan SMA Negeri 8 Banjarmasin', 'SMAN 8 Banjarmasin'),
(256, 'Kamis', '2023-03-23', '10:00:00', 'sutikno', 'Kepala Sekolah', 'Rapat terbatas dengan wakil kepala sekolah untuk menggali informasi sekolah', 'SMAN 8 Banjarmasin'),
(257, 'Senin', '2023-03-27', '08:45:00', 'sutikno', 'Kepala Sekolah', 'Membuka kegiatan pesantren ramadhan 1444H', 'SMAN 8 Banjarmasin'),
(258, 'Selasa', '2023-03-28', '10:00:00', 'sutikno', 'Kepala Sekolah', 'Rapat bersama wakil kepala sekolah dan bendahara sekolah membahas tentang RKAS dan program kerja', 'SMAN 8 Banjarmasin'),
(259, 'Senin', '2023-04-03', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Melakukan pendampingan individu CGP Angkatan 7 (Edi Fakhrin)', 'SMKN 5 Banjarmasin'),
(260, 'Selasa', '2023-04-04', '08:00:00', 'sutikno', 'Kepala Sekolah', 'Melakukan pendampingan individu CGP Angkatan 7 (Jonson Rumapea)', 'SMA Kristen Kanaan Banjarmasin'),
(261, 'Rabu', '2023-04-05', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Melakukan pendampingan individu CGP Angkatan 7 (Kartika Sari)', 'SDN Kelayan Timur 2 Banjarmasin'),
(262, 'Kamis', '2023-04-06', '09:00:00', 'sutikno', 'Kepala Sekolah', 'Melakukan pendampingan individu CGP Angkatan 7 (Sulfiria Effendi)', 'SMAN 2 Banjarmasin'),
(263, 'Sabtu', '2023-04-08', '08:00:00', 'sutikno', 'Kepala Sekolah', 'Mengikuti kegiatan Lokakarya 4 program pendidikan guru penggerak angkat 7', 'SMK ISFI Banjarmasin');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(15) NOT NULL,
  `kodeguru` varchar(35) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `file` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `kodeguru`, `nama_file`, `file`) VALUES
(2, '87654321', 'Buku Bahasa', 'http://localhost/jurnalmengajar/uploads/files/dftqhzjn6u0i93s.pdf'),
(3, '123456', 'Buku Bahasa', 'Notice:  Undefined index: id_user in D:\\xampp\\htdocs\\jurnalmengajar\\admin\\config.php on line 99Notice:  Undefined index: username in D:\\xampp\\htdocs\\jurnalmengajar\\admin\\config.php on line 100http://localhost/jurnalmengajar/admin/uploads/files/ripy3x0gf_hbl7q.pdf'),
(4, '654321', 'Buku Bahasae', 'Notice:  Undefined index: id_user in D:\\xampp\\htdocs\\jurnalmengajar\\admin\\config.php on line 99Notice:  Undefined index: username in D:\\xampp\\htdocs\\jurnalmengajar\\admin\\config.php on line 100http://localhost/jurnalmengajar/admin/uploads/files/f349pxu5d21kva8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `kodeguru` varchar(25) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(40) NOT NULL,
  `tempatlahir` varchar(40) NOT NULL,
  `tanggallahir` date NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `nip` varchar(35) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2021-08-16 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kodeguru`, `password`, `nama`, `tempatlahir`, `tanggallahir`, `alamat`, `email`, `nohp`, `photo`, `nip`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `user_role_id`) VALUES
('admin', '$2y$10$JsphP0M67LmkuEiWlNjdAOJYtOuKqwKYyD281Wq33upbgL6J.XiVG', 'admin', 'Bojonegoro', '1971-03-17', 'Banjarmasin', 'tikno_pgg@yahoo.com', '08115007563', '', '23232', NULL, NULL, '2023-03-22 10:52:51', NULL, 1),
('fahrulraji', '$2y$10$leNezIQyuM3YvySu4mTpwOFIof2bNFUyt3IEiE/SmCxyH/EQT4Tke', 'Fahrul Raji, S.Kom', 'Banjarmasin', '1987-12-09', 'Jl.Nakula II No.21 Blok VIII b Komp BPP', 'raji.stone89@gmail.com', '082152642539', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('marpuah', '$2y$10$FwFC1fUTGsFTC5ZwSQ7q2.7OTrs5bOpnHen38kK2dBxGQdlZbeq06', 'Marpuah, A.Md.', 'Pulau Sewangi', '1993-03-02', 'Komp Persada Raya 4 Jalur 5 No 21', 'marpuah0393@gmail.com', '085820478934', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('mhendy', '$2y$10$zAFDbGNk9afVNRKk20DQUOEWKci2NCnrSRd0XxTAPsjiBlCBBtava', 'Muhammad Hendy Maulana Akbar, S.M.', 'Banjarmasin', '1997-08-02', 'Jl. Pulau Laut Rt.003 Rw.001', 'maulanaakbar897@gmail.com', '082353231070', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('mrivaldi', '$2y$10$43H02Mpl6MnyHKFUtaeGdOaGX7j4NuiXl.ebF2GRzVBvjTpc5eKuO', 'Muhammad Rivaldi Akbar, S.Pd', 'Banjarmasin', '1997-12-01', 'Jl. Sultan Adam Komplek Pondok Kelapa RT 30 N', 'rivaldiakbar31@gmail.com', '085932928066', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('nafilafayruz', '$2y$10$9BcmD/NgHTstEL9.BNYzjOT5dou.dWq8KK6XhZBiD5sowHRlxWTPy', 'Nafila Fayruz, A.Md.Kom', 'Banjarmasin', '2001-01-26', 'Jl. Dalam Rt.06, Komplek Salsabila Mandiri No', 'nafilafayruz@gmail.com', '082148408946', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('ninamasunah', '$2y$10$pudOSuyt6zf8zSrRO0h3/OIO2djii7sfC1PeXeCMjFaxH6CU4IKqS', 'Nina Masunah, M.Pd.', 'Banjarmasin', '1982-03-06', 'Jl. Sultan Adam Komplek Mandiri Lestari Blok ', 'masunah06@yahoo.com', '082148868802', '', '198203062009032003', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('nurliana', '$2y$10$X5evsYXiJ2hfLiZlOXXRL.f1fOeB1lFIWaDwecLW4eJ36VsuxOtMa', 'Hj. Nurliana, S.Sos', 'Banjarmasin', '1968-03-03', 'Jl. Trans Kalimantan Komp. Persada Permai Jal', 'nnurliana83@yahoo.com', '085100466258', '', '196803031990032005', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('risaauliana', '$2y$10$6tzVMSiTCPw0b./895rf3.nkiU2mwU.9CfLdNBWolp6ZfLc40QfPW', 'Risa Auliana, S.M.', 'Banjarmasin', '1997-11-09', 'Jl. AMD Komp.Buana Permai Blok B Rt. 24 Rw.00', 'aulianarisa9@gmail.com', '083125449634', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('sitiaisyah', '$2y$10$YsV7igr3TpIG21cFGQwVUORFEcLxjnTPcKZtqWmLRzV4AZfytF92S', 'Siti Aisyah, S.Pd', 'Surabaya', '1993-01-16', 'Jl. Sutoyo S. GG. Bahagia', 'st.aisyah1601@gmail.com', '087814960455', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('sutikno', '$2y$10$s38rGB/obtnqawY43jZ4LeKrhyA7d9QMAG6StoDvZl7EdrnRghPQG', 'Sutikno, S.Pd., M.Pd.', 'Bojonegoro', '1971-03-17', 'Jl. Lingkar Dalam Selatan Gang Berkat Ibu/AMD', 'bangtikno@gmail.com', '085103852733', '', '197103171997021005', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('weniristiani', '$2y$10$hTmviaGFuKXKk72Aja5zZexYN1GLndvXHD4Wcy1hPJ4fKr45WYK5y', 'Weni Ristiani Wulandari, S.H.', 'Banjarmasin', '1992-01-27', 'Jl. Perdagangan Komp. Perdagangan Permai I No', 'wenirw@gmail.com', '082158549992', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('yanirahman', '$2y$10$ZPFQs7IUTMap4aM6bCUubO5d05u9orQP/myMSjnrz4ivMa8393OvO', 'Yani Rahman, M.Pd.', 'Rantau', '1982-06-10', 'Jl. AMD Komp. Graha Sulfana No. 12', 'yanirahman66@gmail.com', '0811555266', '', '198206102006041008', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('yasib', '$2y$10$FmYGLU/w.nWYPoyIb6Sque5Mh7T9.AL87n6RURW2g3MV6pT58os/6', 'Yasib, S.Pd', 'Jepara', '1968-03-23', 'Jl. Alalak Tengah Gg. SMPN 13 No. 43', 'yasifaljafari@yahoo.co.id', '082339866610', '', '196803231991011002', NULL, NULL, '2021-08-16 00:00:00', NULL, 2),
('yulidwi', '$2y$10$C9nJORe92vFPFhr0VtY8x.LVoj3K0p2pxUanZr3G15Baav7oPABpO', 'Yuli Dwi Prasetyo', 'Banjarmasin', '1976-07-14', 'Jl. Berangas Timur No 107', 'yulidwiprasetyo73@gmail.com', '082251688162', '', '-', NULL, NULL, '2021-08-16 00:00:00', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `kodejabatan` int(10) NOT NULL,
  `namajabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kodejabatan`, `namajabatan`) VALUES
(1, 'Kepala Sekolah'),
(2, 'Kepala TAS'),
(3, 'Wakabid Kurikulum'),
(4, 'Wakabid Kesiswaan'),
(5, 'Wakabid Sarpras'),
(6, 'Wakabid Humas'),
(7, 'Kepala Laboratorium'),
(8, 'Kepala Perpustakaan'),
(9, 'Koordinator BK'),
(10, 'Staf TAS');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(10) NOT NULL,
  `kelas` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X MIPA'),
(2, 'X IPS'),
(3, 'XI MIPA'),
(4, 'XI IPS'),
(5, 'XII MIPA'),
(6, 'XII IPS');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE IF NOT EXISTS `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(882, 1, 'agenda', 'list'),
(883, 1, 'agenda', 'view'),
(884, 1, 'agenda', 'add'),
(885, 1, 'agenda', 'edit'),
(886, 1, 'agenda', 'editfield'),
(887, 1, 'agenda', 'delete'),
(888, 1, 'agenda', 'import_data'),
(889, 1, 'guru', 'list'),
(890, 1, 'guru', 'view'),
(891, 1, 'guru', 'add'),
(892, 1, 'guru', 'edit'),
(893, 1, 'guru', 'editfield'),
(894, 1, 'guru', 'delete'),
(895, 1, 'guru', 'import_data'),
(896, 1, 'jabatan', 'list'),
(897, 1, 'jabatan', 'view'),
(898, 1, 'jabatan', 'add'),
(899, 1, 'jabatan', 'edit'),
(900, 1, 'jabatan', 'editfield'),
(901, 1, 'jabatan', 'delete'),
(902, 1, 'jabatan', 'import_data'),
(903, 1, 'guru', 'userregister'),
(904, 1, 'guru', 'accountedit'),
(905, 1, 'guru', 'accountview'),
(906, 1, 'role_permissions', 'list'),
(907, 1, 'role_permissions', 'view'),
(908, 1, 'role_permissions', 'add'),
(909, 1, 'role_permissions', 'edit'),
(910, 1, 'role_permissions', 'editfield'),
(911, 1, 'role_permissions', 'delete'),
(912, 1, 'roles', 'list'),
(913, 1, 'roles', 'view'),
(914, 1, 'roles', 'add'),
(915, 1, 'roles', 'edit'),
(916, 1, 'roles', 'editfield'),
(917, 1, 'roles', 'delete'),
(918, 1, 'kelas', 'list'),
(919, 1, 'kelas', 'view'),
(920, 1, 'kelas', 'add'),
(921, 1, 'kelas', 'edit'),
(922, 1, 'kelas', 'editfield'),
(923, 1, 'kelas', 'delete'),
(924, 1, 'file', 'list'),
(925, 1, 'file', 'view'),
(926, 1, 'file', 'add'),
(927, 1, 'file', 'edit'),
(928, 1, 'file', 'editfield'),
(929, 1, 'file', 'delete'),
(930, 1, 'rekap_agenda', 'list'),
(931, 1, 'rekap_file', 'list'),
(932, 1, 'rekap_file', 'view'),
(933, 2, 'agenda', 'list'),
(934, 2, 'agenda', 'view'),
(935, 2, 'agenda', 'add'),
(936, 2, 'agenda', 'edit'),
(937, 2, 'agenda', 'editfield'),
(938, 2, 'agenda', 'delete'),
(939, 2, 'guru', 'accountedit'),
(940, 2, 'guru', 'accountview'),
(941, 2, 'file', 'list'),
(942, 2, 'file', 'view'),
(943, 2, 'file', 'add'),
(944, 2, 'file', 'edit'),
(945, 2, 'file', 'editfield'),
(946, 2, 'file', 'delete');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`kodeagenda`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kodeguru`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kodejabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `kodeagenda` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=264;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
