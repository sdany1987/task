-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 06:32 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtask`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `customers`
--

TRUNCATE TABLE `customers`;
-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `login_logs`
--

TRUNCATE TABLE `login_logs`;
-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_13_075903_create_customers_table', 1),
(6, '2023_04_13_080300_create_risks_table', 1),
(7, '2023_04_13_080933_create_login_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
-- --------------------------------------------------------

--
-- Table structure for table `risks`
--

CREATE TABLE `risks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Creator ID refer user table',
  `created_by` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1->Admin,2->User',
  `assigned_to` int(11) NOT NULL DEFAULT 0 COMMENT 'Refer the user table',
  `assigned_by` int(11) NOT NULL DEFAULT 0 COMMENT 'refer the user table',
  `assigned_type` int(11) NOT NULL DEFAULT 0 COMMENT '1->Admin,2->User,3->Self',
  `status` tinyint(4) DEFAULT NULL COMMENT '1->Active,2->Inactive',
  `deleted_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `risks`
--

TRUNCATE TABLE `risks`;
--
-- Dumping data for table `risks`
--

INSERT INTO `risks` (`id`, `name`, `description`, `user_id`, `created_by`, `assigned_to`, `assigned_by`, `assigned_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Test Risk', 'Test Risk Descriptions', 1, 1, 0, 0, 0, 1, NULL, '2023-04-13 05:41:48', '2023-04-13 08:10:00'),
(2, 'Test  Risk 1111', 'test risk 1111', 2, 2, 2, 0, 0, 1, NULL, '2023-04-13 05:42:11', '2023-04-13 11:40:19'),
(3, 'risk event 1', 'test event risk desc', 1, 1, 0, 0, 0, 1, NULL, '2023-04-13 06:35:19', '2023-04-13 08:21:04'),
(4, 'risk event 2', 'risk event 2', 1, 1, 0, 0, 0, 1, NULL, '2023-04-13 06:35:38', '2023-04-13 06:35:38'),
(5, 'risk message 1', 'risk message 1', 2, 1, 2, 0, 0, 1, NULL, '2023-04-13 08:32:29', '2023-04-13 11:36:03'),
(6, 'test event', 'test event', 2, 1, 0, 0, 0, 1, NULL, '2023-04-13 08:33:14', '2023-04-13 08:33:14'),
(7, 'test risk 123', 'test risk 123', 2, 1, 0, 0, 0, 2, NULL, '2023-04-13 08:35:33', '2023-04-13 10:27:06'),
(8, 'new risk factor', 'new risk factor', 2, 2, 0, 0, 0, 1, NULL, '2023-04-13 09:12:34', '2023-04-13 09:12:34'),
(9, 'new risk factor333', 'new risk factor3333', 2, 2, 2, 0, 0, 1, NULL, '2023-04-13 10:31:33', '2023-04-13 11:29:50'),
(10, 'new risk factor477', 'new risk factor4477', 2, 2, 0, 0, 0, 1, NULL, '2023-04-13 10:32:06', '2023-04-13 10:53:14'),
(11, 'new tst data', 'new tst data new tst data', 2, 2, 0, 0, 0, 1, NULL, '2023-04-13 10:32:38', '2023-04-13 10:32:38'),
(12, 'new risk factor777', 'new risk factor7777', 2, 2, 0, 0, 0, 1, NULL, '2023-04-13 10:39:21', '2023-04-13 10:53:44'),
(13, 'new risk factor777', 'new risk factor7777', 2, 2, 2, 0, 0, 1, NULL, '2023-04-13 11:23:47', '2023-04-13 11:23:47'),
(14, 'New Admin Task', 'New Admin Task', 1, 1, 0, 0, 0, 1, NULL, '2023-04-13 11:37:33', '2023-04-13 11:37:33'),
(15, 'New Admin Task 123', 'New Admin Task 123', 1, 1, 0, 0, 0, 1, NULL, '2023-04-13 11:38:37', '2023-04-13 11:38:37'),
(16, 'User Create Task', 'User Create Task', 2, 2, 2, 0, 0, 1, NULL, '2023-04-13 11:39:18', '2023-04-13 11:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1->Active,2->Inactive',
  `deleted_at` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `status`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@task.com', NULL, 1, '$2y$10$KrZ3J4s3gN.d1J2/jGfzF.7sWGGVsBmZ6nLsWUu/SRvyfCHgrJGg.', NULL, NULL, NULL, '2023-04-13 02:56:38', '2023-04-13 02:56:38'),
(2, 'Daniel', 'daniel@task.com', NULL, 0, '$2y$10$xkvJfzt1lo59MUb1KCStNuqwiHRoyb/s65LSjSsPKtKRNzVTD2MjG', NULL, NULL, NULL, '2023-04-13 02:56:38', '2023-04-13 02:56:38'),
(3, 'User', 'user@task.com', NULL, 0, '$2y$10$tA8tNZ78zWN7DS/p1fLnWO2xgpOIXcn4Gvv0ew/obHIQIXDyLZEw2', NULL, NULL, NULL, '2023-04-13 02:56:38', '2023-04-13 02:56:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `risks`
--
ALTER TABLE `risks`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risks`
--
ALTER TABLE `risks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
