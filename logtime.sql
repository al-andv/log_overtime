-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 05, 2021 lúc 05:20 AM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `logtime`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendences`
--

CREATE TABLE `attendences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `off_time` int(2) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attendences`
--

INSERT INTO `attendences` (`id`, `user_id`, `date`, `off_time`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(0, 4, '2021-04-16', 8, 'testttt', 1, '2021-04-16 08:48:04', '2021-04-13 03:18:31'),
(1, 4, '2021-04-08', 4, 'aaaafffffffffff', -1, '2021-04-16 09:10:19', '2021-04-16 02:10:19'),
(2, 4, '2021-04-10', 1, 'hhhhhhhhhhh', 1, '2021-04-12 07:42:01', '2021-04-07 01:45:03'),
(3, 4, '2021-04-18', 1, 'qwdes', 1, '2021-04-16 09:11:40', '2021-04-16 02:11:40'),
(4, 6, '2021-04-24', 8, 'hhhhhhhhhhhhh', 1, '2021-04-14 09:18:16', '2021-04-14 02:18:16'),
(6, 4, '2021-04-22', 8, 'ddddddd', 1, '2021-04-18 19:31:25', '2021-04-18 20:01:18'),
(7, 4, '2021-04-30', 8, '1111111', 1, '2021-04-18 19:44:20', '2021-04-18 20:25:03'),
(8, 4, '2021-05-07', 8, 'aaaaaaaaaa', 1, '2021-04-18 19:59:37', '2021-04-18 20:35:21'),
(9, 4, '2021-04-28', 8, 'lllllllll', -1, '2021-04-18 20:38:44', '2021-05-03 20:11:15'),
(10, 4, '2021-04-29', 4, 'test', 1, '2021-04-19 00:04:23', '2021-05-04 02:56:29'),
(11, 4, '2021-04-27', 6, 'tessttttt', 1, '2021-04-19 19:48:24', '2021-05-04 19:24:44'),
(12, 4, '2021-05-15', 8, '\'\'\'\'\'\'\'\'\'\'\'\'\'\'', 0, '2021-05-03 21:42:54', '2021-05-03 21:42:54'),
(14, 4, '2021-05-20', 8, 'asdasda', -1, '2021-05-04 00:04:31', '2021-05-04 19:24:55'),
(15, 4, '2021-05-22', 8, 'ffffffffff', 0, '2021-05-04 19:20:47', '2021-05-04 19:20:47'),
(16, 2, '2021-05-15', 8, 'fff', 0, '2021-05-04 20:14:58', '2021-05-04 20:14:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_to_dos`
--

CREATE TABLE `list_to_dos` (
  `id` int(11) NOT NULL,
  `time` date NOT NULL,
  `work_to_do` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `list_to_dos`
--

INSERT INTO `list_to_dos` (`id`, `time`, `work_to_do`, `created_at`, `updated_at`) VALUES
(1, '2021-03-02', 'Design a nice theme', '2021-03-30 08:51:02', NULL),
(2, '2021-03-03', 'Make the theme responsive', '2021-03-30 08:51:22', NULL),
(3, '2021-03-18', 'Let theme shine like a star', '2021-03-30 08:51:53', NULL),
(4, '2021-03-10', 'Let theme shine like a star', '2021-03-30 08:51:53', NULL),
(5, '2021-03-19', 'Check your messages and notifications', '2021-03-30 08:52:42', NULL),
(6, '2021-03-03', 'Let theme shine like a star ', '2021-02-28 22:24:11', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `user_id_from`, `user_id_to`, `title`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'update status off time', '8', 1, '2021-04-18 20:37:14', '2021-05-05 02:00:44'),
(2, 4, 1, 'add an off time', '2021-04-28 - 8(hours)', 1, '2021-04-18 20:38:44', '2021-04-18 20:40:18'),
(3, 4, 1, 'add an off time', '2021-04-29 - 8(hours)', 1, '2021-04-19 00:04:23', '2021-04-19 19:36:10'),
(4, 1, 4, 'update status off time', '10', 1, '2021-04-19 19:39:04', '2021-05-05 02:00:18'),
(5, 4, 1, 'add an off time', '2021-04-27 - 1(hours)', 1, '2021-04-19 19:48:24', '2021-05-04 19:21:11'),
(8, 4, 1, 'add an off time', '2021-05-20 - 8(hours)', 1, '2021-05-04 00:04:31', '2021-05-04 19:24:51'),
(9, 4, 1, 'add an off time', '2021-05-22 - 8(hours)', 0, '2021-05-04 19:20:47', '2021-05-04 19:20:47'),
(10, 1, 4, 'update status off time', '14', 1, '2021-05-04 19:24:55', '2021-05-04 19:25:17'),
(11, 2, 1, 'add an off time', '2021-05-15 - 8(hours)', 0, '2021-05-04 20:14:58', '2021-05-04 20:14:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `overtimes`
--

CREATE TABLE `overtimes` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_type` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time DEFAULT NULL,
  `work` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `over_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `overtimes`
--

INSERT INTO `overtimes` (`id`, `date`, `date_type`, `user_id`, `time_start`, `time_end`, `work`, `over_time`, `created_at`, `updated_at`) VALUES
(1, '2021-03-03', 1, 6, '11:00:00', '17:00:00', 'aaaaaaaaaaaaaaaaaa', '09:00:00', '2021-04-08 07:44:24', '2021-03-30 21:28:38'),
(2, '2021-04-08', 1, 6, '10:30:00', '11:00:00', 'zzzzzzzzzzzzzzzzzzz', '00:45:00', '2021-04-08 07:44:24', '2021-04-07 03:19:39'),
(3, '2021-04-02', 1, 6, '05:25:00', '17:24:00', '111111111111', '17:58:00', '2021-04-08 07:44:24', '2021-04-02 01:24:18'),
(4, '2021-04-16', 1, 2, '14:00:00', '15:30:00', 'addd', '02:15:00', '2021-04-16 07:26:09', '2021-04-16 00:26:09'),
(8, '2021-03-10', 1, 4, '10:00:00', '11:50:00', '!!!!!!!!!!!!!!!!!!', '02:45:00', '2021-04-08 07:44:24', '2021-05-04 00:53:30'),
(9, '2021-04-08', 1, 4, '05:00:00', '08:10:00', 'aaaaaaaaaa', '04:45:00', '2021-04-08 07:44:24', '2021-04-20 01:22:34'),
(10, '2021-04-08', 1, 4, '16:00:00', '17:30:00', 'ddddddddddddddddddd', '02:15:00', '2021-04-08 07:44:24', '2021-04-06 03:09:31'),
(11, '2021-04-07', 1, 6, '11:00:00', '11:30:00', 'ddddddddddddddddd', '00:45:00', '2021-04-08 07:44:24', '2021-04-07 03:24:14'),
(13, '2021-04-08', 1, 4, '11:00:00', '11:56:00', 'dddddd', '01:24:00', '2021-04-08 07:44:24', '2021-04-07 23:39:54'),
(14, '2021-04-08', 1, 4, '13:34:00', '15:30:00', 'sssssssssssss', '02:54:00', '2021-04-08 07:44:24', '2021-04-07 23:47:11'),
(15, '2021-04-12', 1, 4, '12:00:00', '14:37:00', 'abcdaasssssssss', '03:55:00', '2021-04-08 07:44:24', '2021-04-08 00:38:08'),
(22, '2021-05-05', 1, 2, '10:14:00', '10:14:00', 'sss', '00:00:00', '2021-05-04 20:14:33', '2021-05-04 20:14:40'),
(23, '2021-05-05', 1, 2, '10:15:00', '10:16:00', NULL, '00:01:00', '2021-05-04 20:15:35', '2021-05-04 20:16:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  `phone_number` int(15) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `user_name`, `full_name`, `email`, `password`, `position`, `status`, `role`, `phone_number`, `picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin123', 'AnDinh', 'andv@allogical.com', '$2y$10$dHAvlyzlKZgsNNjPFuuLQ.NR.F2VplHJoqfpP7ptVo79UKoMsdFkW', 'admin', 1, 1, 904007007, 'avatar.png', 'zmnsJ6k8loaRaGchDSVt6j11RBz6EAFXz02XmpRA4TnK5eVNoQzEYIhiCSzl', '2021-04-19 03:00:54', '2021-05-04 19:20:28'),
(2, 'andinh123', 'an van dinh', 'dinhvanan@gmail.com', '$2y$10$4uVnNs561F5dChyThlwGe.NYzLoIB9Wwh6wfMxJq/TdTf/iTmAZOe', 'Interns', 1, 0, NULL, 'avatar4.png', '', '2021-04-16 08:33:34', '2021-05-04 20:14:29'),
(4, 'user123', 'Ấn Đinh', 'dvan.18i@cit.udn.vn', '$2y$10$hXBN7A5M8wxMwPfNvE7zqusM0PWD/MQvgI3/y.6K5Rlz2W.MWQtva', 'Interns', 0, 0, 905841816, 'user1-128x128.jpg', 'yQokadwof3Tuu8FKCUK0owEALN7LvFHCB7gXhvDfGUp0x6bENJUVDuM1Yijw', '2021-04-19 02:14:33', '2021-05-05 03:14:12'),
(5, 'test123', 'test name', 'testuser@gmail.com', '$2y$10$4dWodYq12yZ5lHBQxcw7keRlvhZ8sJQ2tvgEwyipVS0OUSxfOvVQW', 'Interns', 0, 0, NULL, 'default-150x150.png', NULL, '2021-04-12 07:31:21', '2021-04-12 00:31:21'),
(6, 'user1234', 'dinh van an', 'andinh@gmail.com', '$2y$10$wdEg62ZqK2.ljRmnN0JTjebUAstH..sYvtQamM4/cJLO818/Ju.xS', 'Interns', 0, 0, 909090909, 'default-150x150.png', '', '2021-04-16 08:27:16', '2021-04-12 00:30:50'),
(7, 'GlennaGrady', NULL, 'lmohr@example.org', '$2y$10$7Dz7IxZQPYW9wzHsrjqzuOMMhAZ5QMr4lRz8K9ZLTnYV9hK1wKsSq', 'KF4xY35m27', NULL, 0, NULL, NULL, 'adsoqwgHNu', '2021-04-15 01:52:12', '2021-04-14 18:51:19'),
(8, 'hdavis', NULL, 'alexandra50@example.org', '$2y$10$6Irt9WcNsm1zirYM4iBaRuRTuFcgZFSvSyBQXoUHmD0qbf56PvvQK', 'yh1s3KumhQ', NULL, 0, NULL, NULL, '1BNZrdTBZW', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(9, 'timmothy.hickle', NULL, 'berge.dane@example.com', '$2y$10$OdrQjXo84JVFCKDHaDMWv.nK48vc9o2pK0SF2YM5z1tfgOPgFhktG', 'YiaKeWtMbP', NULL, 0, NULL, NULL, 'G0FEPwGxrU', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(10, 'dgottlieb', NULL, 'greta.bergstrom@example.com', '$2y$10$hG/T3iR5XvbZEiK.M0GPN.3X6yOE.6g7QRRiz8pX2D6iuCq3YxwXS', 'xGK6EicKPg', NULL, 0, NULL, NULL, '6N754zW5yR', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(11, 'maggie.quitzon', NULL, 'lukas.waelchi@example.net', '$2y$10$b7n6f.W8JDVsMJ4B49vcZ.q2fbewFsDmcPSstFoLR06MH/AZCgluq', 'M6jqZBAtpj', NULL, 0, NULL, NULL, 'LjNyOmF36l', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(12, 'clakin', NULL, 'isai43@example.com', '$2y$10$zjO9/fEsNlJYdj0VDi92FedAKDPk4erVMvypM42TBTIMVEFi0O6Pa', 'W9AhCfLsv3', NULL, 0, NULL, NULL, 'VNHtoNZQky', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(13, 'evangeline78', NULL, 'furman.reinger@example.org', '', '9mI3p6cnXe', NULL, 0, NULL, NULL, 'sW7t0ANcyt', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(14, 'adams.cecelia', NULL, 'jasen.wolff@example.com', '$2y$10$Qrr8OXwza1.G4Rf7zijCIugmmof1wIiLwFyDtDIH8gx.NctzcNKU2', 'lmhYe2C1Rt', NULL, 0, NULL, NULL, 'CFoofgSM8k', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(15, 'nwelch', NULL, 'wilkinson.florine@example.net', '$2y$10$a/ocgZkU1HRKQ.OMNnb3ou7YYa7Jz27HwRjzZwX/8JG/UuSynVT5G', 'r1RC8nMIKB', NULL, 0, NULL, NULL, 'DMJeDbm9cV', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(16, 'ecummerata', NULL, 'hattie27@example.com', '$2y$10$57UVBSs1NWsACNxmbn8R.usNYDLCy9oXN/f56cB6zaAHSKDKpDDo2', 'Lwg3NmSBfd', NULL, 0, NULL, NULL, '2KwlTI1Mka', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(17, 'sandrine35', NULL, 'fdare@example.com', '$2y$10$Nwl/LLRQeJco2jHOKiRZH.iI7DGKdXuChLqs5F1oAugqvvsKJr.vK', 'NgVzvpcAEK', NULL, 0, NULL, NULL, 'ArS4l1ewcT', '2021-04-14 18:53:00', '2021-04-14 18:53:00'),
(18, 'hintz.lloyd', NULL, 'gbrekke@example.net', '$2y$10$55kTVmHela9oEl..uI9g8uCunQM7RIRx.Db7lg5pmVWUdV7e.LRrm', 'yqwII4BWAp', NULL, 0, NULL, NULL, 'mlHttVk9G1', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(19, 'florence52', NULL, 'sabrina52@example.org', '$2y$10$ibRcPxd92GOj/5.VEIkyOOb9MIx4N0qM4WnqA2WKktZjxkcd841A.', '87GUOfgF7T', NULL, 0, NULL, NULL, 'eGLZapJv5G', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(20, 'shannon.rogahn', NULL, 'trantow.raven@example.net', '$2y$10$R1MWON6mncjDZnHG2R8w5OnNc91m1PXktYzrUyKzhZDT6LfxmK4ee', 'lJlfOkWJpK', NULL, 0, NULL, NULL, 'j71HK0TlRm', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(21, 'tess.runte', NULL, 'nils50@example.net', '$2y$10$KR.4K6xKoB7ijCkl7ug13eB/kovHQjv/pOekM0To9R81wcKSkxkRS', 'aG2uGZaNDy', NULL, 0, NULL, NULL, 'iNQOHuXP7H', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(22, 'sophia.willms', NULL, 'cfunk@example.net', '$2y$10$DLpJYSMwmbHyL/JWYSl3SeIEmzB.zOkVQ0nunYhxQJXmK2MGj0sr2', 'HsYTgcnvDf', NULL, 0, NULL, NULL, 'k5A8mCWMy8', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(23, 'lesly21', NULL, 'huel.ara@example.org', '$2y$10$KnO2//7YiIHIeKcocUEWVuGlLVNoHKP6eEY9HVxLuAh/VxYQzq49K', 'uO4NMkbfnQ', NULL, 0, NULL, NULL, 'Y3CORcVCHR', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(24, 'wprice', NULL, 'dach.sabryna@example.net', '$2y$10$9ViiKPJ3ySV9kilZzHGIhuseH14hUVmbLW.6j7OVTSc0oswseaL7O', 'KMmxIULWqf', NULL, 0, NULL, NULL, 'rhVl9tPhpD', '2021-04-14 18:55:09', '2021-04-14 18:55:09'),
(25, 'rhianna.murray', NULL, 'uschneider@example.net', '$2y$10$l6Nu8ang9//YKwz92xIuhuRSHttUjuiK7vhYZRtggyaUw6nQ777wG', 'JtUtvALNop', NULL, 0, NULL, NULL, 'GBB4nrTxIw', '2021-04-14 18:55:09', '2021-04-27 02:04:11'),
(26, 'maximilian70', NULL, 'skye.zieme@example.org', '$2y$10$cR9lH4T3uapBupvI9CBnIeP1PD4sOWo7KRkoAZZBd0Za7RRiedlma', 'gX45aH7QVt', NULL, 0, NULL, NULL, 'apSad1NnDo', '2021-04-14 18:55:09', '2021-04-14 18:55:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendences`
--
ALTER TABLE `attendences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `list_to_dos`
--
ALTER TABLE `list_to_dos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_from` (`user_id_from`),
  ADD KEY `user_id_to` (`user_id_to`);

--
-- Chỉ mục cho bảng `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendences`
--
ALTER TABLE `attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `list_to_dos`
--
ALTER TABLE `list_to_dos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendences`
--
ALTER TABLE `attendences`
  ADD CONSTRAINT `attendences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id_from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id_to`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `overtimes`
--
ALTER TABLE `overtimes`
  ADD CONSTRAINT `overtimes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
