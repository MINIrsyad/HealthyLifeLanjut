-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2026 at 05:59 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthylife`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `image`, `published_at`, `created_at`, `updated_at`) VALUES
(1, '6 Penyebab Pusing Setelah Olahraga dan Cara Mengatasinya', 'Pernakah kamu pusing saat makan di waktu olahraga', '1779168850_cdc2e45e465ffe9dfa1574e7fa32a0e7.jpg', '2026-05-19 00:00:00', '2026-05-19 05:34:10', '2026-05-19 10:39:32'),
(2, 'I like you', 'HALOOOO', NULL, '2026-05-19 00:00:00', '2026-05-19 10:22:11', '2026-05-19 10:42:49'),
(3, 'HAAHSHSHAHAHHAHA', 'HAYOOOO', '1779186151_8d54e7a2b6c9192b5cea7ea4fb33e2f6.jpg', '2026-05-19 00:00:00', '2026-05-19 10:22:31', '2026-05-19 10:22:31'),
(6, 'Ilham', 'Basudara', '1779186551_7e8c5428403c944a886a5f49324acdfb.jpg', '2026-05-19 00:00:00', '2026-05-19 10:29:11', '2026-05-19 10:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_logs`
--

CREATE TABLE `daily_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `log_date` date NOT NULL,
  `type` enum('food','water','exercise','sleep') COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_logs`
--

INSERT INTO `daily_logs` (`id`, `user_id`, `log_date`, `type`, `data`, `created_at`, `updated_at`) VALUES
(2, 2, '2026-05-16', 'food', '{\"fat\": \"15\", \"carbs\": \"60\", \"protein\": \"12\", \"calories\": \"450\", \"food_name\": \"Nasi Goreng\", \"meal_type\": \"Sarapan\"}', '2026-05-16 05:02:14', '2026-05-16 05:02:14'),
(3, 2, '2026-05-17', 'food', '{\"fat\": \"20\", \"carbs\": \"60\", \"protein\": \"10\", \"calories\": \"500\", \"food_name\": \"Nasi Goreng\", \"meal_type\": \"Sarapan\"}', '2026-05-17 01:05:47', '2026-05-17 01:05:47'),
(4, 2, '2026-05-18', 'food', '{\"fat\": \"11.7\", \"carbs\": \"35\", \"protein\": \"20\", \"calories\": \"350\", \"food_name\": \"Bubur ayam\", \"meal_type\": \"Sarapan\"}', '2026-05-18 05:12:28', '2026-05-18 05:12:28'),
(5, 2, '2026-05-18', 'water', '{\"time\": \"12:12\", \"amount\": \"250\", \"drink_type\": \"Air Putih\"}', '2026-05-18 05:12:35', '2026-05-18 05:12:35'),
(6, 2, '2026-05-18', 'exercise', '{\"burned\": \"200\", \"duration\": \"30\", \"intensity\": \"Ringan\", \"exercise_type\": \"Lari\"}', '2026-05-18 05:12:44', '2026-05-18 05:12:44'),
(7, 2, '2026-05-18', 'sleep', '{\"notes\": \"ZZZZZZ\", \"bedtime\": \"20:00\", \"quality\": \"8\", \"waketime\": \"03:00\"}', '2026-05-18 05:13:09', '2026-05-18 05:13:09'),
(8, 2, '2026-05-19', 'food', '{\"fat\": \"13\", \"carbs\": \"50\", \"protein\": \"25\", \"calories\": \"330\", \"food_name\": \"Nasi padang\", \"meal_type\": \"Sarapan\"}', '2026-05-19 14:45:13', '2026-05-19 14:45:13'),
(9, 2, '2026-05-19', 'food', '{\"fat\": \"13\", \"carbs\": \"50\", \"protein\": \"25\", \"calories\": \"330\", \"food_name\": \"Nasi padang\", \"meal_type\": \"Sarapan\"}', '2026-05-19 14:45:33', '2026-05-19 14:45:33'),
(10, 2, '2026-05-19', 'water', '{\"time\": \"22:00\", \"amount\": \"200\", \"drink_type\": \"Jus Buah\"}', '2026-05-19 14:48:40', '2026-05-19 14:48:40'),
(11, 2, '2026-05-19', 'water', '{\"time\": \"22:00\", \"amount\": \"200\", \"drink_type\": \"Jus Buah\"}', '2026-05-19 14:49:59', '2026-05-19 14:49:59'),
(12, 2, '2026-05-19', 'exercise', '{\"burned\": \"250\", \"duration\": \"50\", \"intensity\": \"Sedang\", \"exercise_type\": \"Yoga\"}', '2026-05-19 14:51:36', '2026-05-19 14:51:36'),
(13, 2, '2026-05-19', 'exercise', '{\"burned\": \"250\", \"duration\": \"50\", \"intensity\": \"Sedang\", \"exercise_type\": \"Yoga\"}', '2026-05-19 14:51:54', '2026-05-19 14:51:54'),
(14, 2, '2026-05-19', 'sleep', '{\"notes\": \"Nyenyak\", \"bedtime\": \"07:00\", \"quality\": \"1\", \"waketime\": \"12:00\"}', '2026-05-19 14:52:56', '2026-05-19 14:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_01_01_000001_create_users_table', 1),
(4, '2026_01_01_000002_create_daily_logs_table', 1),
(5, '2026_01_01_000003_create_quiz_results_table', 1),
(6, '2026_05_18_140642_create_personal_access_tokens_table', 2),
(7, '2026_05_18_200000_create_articles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'tawkto-chatbot', '3131445a432abb1bcd1b83eee125348063e7baf6bcc1e643ea33501c4190ba8a', '[\"*\"]', NULL, NULL, '2026-05-18 07:07:00', '2026-05-18 07:07:00'),
(2, 'App\\Models\\User', 2, 'tawkto-chatbot', '966b64ecf30c3f024bce39402a30e52adb31d400b3b60c9e9439e80450af007e', '[\"*\"]', NULL, NULL, '2026-05-18 07:32:16', '2026-05-18 07:32:16'),
(3, 'App\\Models\\User', 2, 'tawkto-chatbot', '60b64c5a81709032cbf3b9a1f159f17821592a055d1a6f458558389d0e16c1db', '[\"*\"]', NULL, NULL, '2026-05-18 07:51:28', '2026-05-18 07:51:28'),
(4, 'App\\Models\\User', 2, 'tawkto-chatbot', '4fcbd7ff00688947afa2cc1640417afe5abf0a07df7c52c25898654e08d9ef5a', '[\"*\"]', NULL, NULL, '2026-05-18 12:26:14', '2026-05-18 12:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `quiz_type` enum('obesity','mental') COLLATE utf8mb4_unicode_ci NOT NULL,
  `result_data` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `quiz_type`, `result_data`, `created_at`, `updated_at`) VALUES
(1, 2, 'obesity', '{\"bmi\": 24.2, \"level\": \"Low Risk\", \"score\": 4, \"message\": \"Bagus! Pertahankan gaya hidup sehat Anda.\"}', '2026-05-16 05:03:15', '2026-05-16 05:03:15'),
(2, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 10, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-16 05:04:01', '2026-05-16 05:04:01'),
(3, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 12, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-16 05:53:02', '2026-05-16 05:53:02'),
(4, 2, 'mental', '{\"level\": \"Low Risk\", \"score\": 5, \"message\": \"Kesehatan mental Anda baik! Pertahankan istirahat dan aktivitas positif.\"}', '2026-05-17 00:06:45', '2026-05-17 00:06:45'),
(5, 2, 'obesity', '{\"bmi\": 24.2, \"level\": \"Low Risk\", \"score\": 3, \"message\": \"Bagus! Pertahankan gaya hidup sehat Anda.\"}', '2026-05-17 01:06:46', '2026-05-17 01:06:46'),
(6, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 10, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 10:45:51', '2026-05-19 10:45:51'),
(7, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 10, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 10:46:10', '2026-05-19 10:46:10'),
(8, 2, 'obesity', '{\"bmi\": 21.5, \"level\": \"Low Risk\", \"score\": 5, \"message\": \"Bagus! Pertahankan gaya hidup sehat Anda.\"}', '2026-05-19 14:54:23', '2026-05-19 14:54:23'),
(9, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 11, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 14:55:47', '2026-05-19 14:55:47'),
(10, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 11, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 14:56:06', '2026-05-19 14:56:06'),
(11, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 11, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 14:59:58', '2026-05-19 14:59:58'),
(12, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 11, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 15:01:26', '2026-05-19 15:01:26'),
(13, 2, 'mental', '{\"level\": \"Moderate Risk\", \"score\": 11, \"message\": \"Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.\"}', '2026-05-19 15:03:04', '2026-05-19 15:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@healthylife.id', NULL, '$2y$12$igMfXEns5iEIR9co4RIl7ef1Lub4Yuyor.4/wFu2f1u7/mb69AH2q', 'admin', NULL, '2026-05-15 14:09:15', '2026-05-15 14:09:15'),
(2, 'User Demo', 'user@healthylife.id', NULL, '$2y$12$O74IrgDtAzk1M8/y83uujuS1g1asE1TdFhBxBRklFOawLQpZAJOkK', 'user', NULL, '2026-05-15 14:09:15', '2026-05-15 14:09:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_logs_user_id_log_date_type_index` (`user_id`,`log_date`,`type`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_results_user_id_quiz_type_index` (`user_id`,`quiz_type`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daily_logs`
--
ALTER TABLE `daily_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD CONSTRAINT `daily_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
