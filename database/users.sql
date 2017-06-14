-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2017 at 09:24 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rajarizq_eproposal`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactive` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latestlogin` timestamp NULL DEFAULT NULL,
  `kode_provinsi` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_kabupaten` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `isactive`, `latestlogin`, `kode_provinsi`, `kode_kabupaten`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Aja', 'admin', 'admin@example.com', '$2y$10$v/dWyG//lS5ituOManPgNuqXF2g8RQwzsAPT26JpiGrFT1FoS5TR.', '1', NULL, '', '', '3BtJ2Kg1F1bgdA0v0betTKK1s0eWjw5iZJklfqThDK4lvS4nbjNddyQGh2f1', '2017-05-31 11:51:43', '2017-06-05 14:17:48'),
(2, 'Manajer Aja', 'manajer', 'manajer@example.com', '$2y$10$vaJE0Sth5aq8Xx22mqvsIuwy.vCCqchtH1NqerllUTHa3EgjGAOzy', '1', NULL, NULL, '', 'uOGV7kKbdugoLarNMvnGKlGXCct78BMLLNTjXB1BxHZgEcfPwGpx7P3c2PrA', '2017-05-31 11:51:44', '2017-06-09 19:15:28'),
(3, 'User Aja', 'user', 'user@example.com', '$2y$10$Ncn1LV56Jab4wzLpNdzGNexy14sTb6hRHBRbNFk5kE2SdLkVj43eu', '1', NULL, '11', '11.08', 'E0PFfkAuiYTSKl7gF9J4CjD5rQooIhVtGv9PB9zj5P1bzMGhTsG1P75q4Ao4', '2017-05-31 11:51:44', '2017-06-05 14:58:14'),
(4, 'Dinas PU Penataan Ruang Kab. Belu', 'piter', 'jonsonpiter80@gmail.com', '$2y$10$V8WIThyCDSrBZWdJhOqEZOrcoUmXzvs5rJBPRv0Aw.LnQhdbW1hv2', '0', NULL, '53', '0', NULL, '2017-06-05 11:32:37', '2017-06-05 12:38:50'),
(7, 'l.m. doddy', 'bappeda', 'lmdoddy_st@yahoo.com', '$2y$10$hSItsjGlOayAe7SAbr6z9elxpUnMBbv8//tK3/OZWVuRgZKYPJLrG', '0', NULL, NULL, NULL, NULL, '2017-06-05 11:39:15', '2017-06-05 12:39:04'),
(8, 'bappeda sintang', 'fery', 'pakfery@yahoo.com', '$2y$10$h8msTOHr.qtpPA73wn9vm.Ydunc2muQOUN8Wgi6oi4LOmQJZisoIO', '1', NULL, '61', '61.07', 'TexvAHu09A1aVORnVWv8Jdiqz74KzaOx8QAIigPcI3V8PApgfq698HpqgDdo', '2017-06-05 12:00:18', '2017-06-05 13:52:45'),
(10, 'bappeda sintang', 'doddy', 'lmdoddy.st@yahoo.com', '$2y$10$5G1gGCUNPXQwC5Fut448Vu3R89AlL/L7vWH2LkRuWONZpAyIgGnWG', '1', NULL, '61', '61.07', 'E0ovSPWbG5vrvLNltMM5ykF9mHpDJvV9U4XAulLtsAg7vOm6hjkar9gJPw2V', '2017-06-05 12:04:31', '2017-06-05 15:47:19'),
(11, 'bapeda raja ampat', 'james', 'warofenjames@yahoo.com', '$2y$10$InnNfxmoNg52k2jU7E44LOcu4UKSbN7PagE8YUNhhnBRNaY19PBAG', '1', NULL, '91', '91.08', 'YH4w5iy8kiJDGL0d9q9B38NTnIvrEgd7KV9H50ysFbM8SMULKL2Ok8ZzZciV', '2017-06-05 12:12:49', '2017-06-05 15:36:40'),
(12, 'bappeda kab. bengkayang', 'bengkayang', 'gurky_man@hotmail.co.id', '$2y$10$dXN0KVzTUYrOsO4ueCrbjuLj74IH/WxcsBoV7R1fjcw2b81mynYvq', '1', NULL, '61', '61.02', 'lZPNYX4acAONrQ2oSIqn0WwnAGqlAU1Qv4SYTV0MCYWZTtzCmLldZtA8jLbl', '2017-06-05 12:17:57', '2017-06-05 13:47:38'),
(13, 'bappeda kapuas hulu', 'kapuas_hulu', 'ekabappeda@gmail.com', '$2y$10$s5g2q2WuNWW88CmctwgkTeLMxRcpesSTFnDTKh4JmUMeBDMk7tNnm', '1', NULL, '61', '61.08', 'N2JJjsAsEuotZPXg8lvV5o22rtJeUFRvKxxdpr5JgUMjAkatmIMmnpguHD6x', '2017-06-05 12:25:05', '2017-06-05 13:46:29'),
(14, 'bapelitbang ttu', 'ttu', 'rickyteammore@yahoo.com', '$2y$10$87tX4nT2MNcnTXSsP0vuveaxo2Q1LMTruohJXkd/n95vGtVRGM/nS', '1', NULL, '53', '53.05', '4XvibNkGzSJ1Q33bJMpTnW8uBXZ9JEFonxxJZioIRknXxvKWoKi2K0ZxdRRR', '2017-06-05 12:27:56', '2017-06-05 15:49:44'),
(15, 'bapelitbang alor', 'alor', 'hatsarduka@gmail.com', '$2y$10$gTWplwA6gtTKY2OybkDXBO8F0BJRwEVbDXgotDKLpVpk5srGWT/Gq', '1', NULL, '53', '53.07', '4gcHKzP7Dh9ReBqi7SyZgWwayOTMpwCWsznrvP9HnfUb9TMzpFIV9oVfBAAy', '2017-06-05 12:29:31', '2017-06-05 13:48:47'),
(17, 'dinas pu belu', 'belu', 'jonsonpiter.80@gmail.com', '$2y$10$v9sPBbcdNyLvTMU5pfBNuO/1oluubOlJGzwmXXYE24KWLk3m2vWyS', '1', NULL, '53', '53.06', 'ppIzvA3HOLJ0TTbgodZOGPCU0HoQydOU01MPKPUSoENEHnQeKkfnBgQx5a7Z', '2017-06-05 12:31:57', '2017-06-05 15:46:13'),
(18, 'adi', 'adi', 'adi@gmail.com', '$2y$10$JG5e7L3WQ6mtb9WmI1oj2.PD3x3qhJtueWPrw/pSr7q49IW6LdAZC', '1', NULL, '31', '0', 'EaErOi7GRMjf2jwaRBzMDP08QOHOeZsnaO647JXIXxJdLyHVbJNwyggUPLLv', '2017-06-05 13:49:37', '2017-06-05 13:55:11'),
(19, 'adit', 'adit', 'adit@gmail.com', '$2y$10$YljmUdHnKfA0Jp32wol15uhduf.tsXUqjMVZRFaG/mQjGHusV9xHG', '1', NULL, '91', '91.08', '6obtbiwMNICIPmyRYnvrMLoezOEa8Ebqeis2xybQ5sHxPnXfLrvwlixktFol', '2017-06-05 15:29:26', '2017-06-09 03:25:38');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
