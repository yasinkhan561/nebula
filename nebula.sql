-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 03:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nebula`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `issue_link` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `criterion` varchar(255) DEFAULT NULL,
  `issue_reference` text DEFAULT NULL,
  `element` varchar(255) DEFAULT NULL,
  `check_type` varchar(255) DEFAULT NULL,
  `responsibility` varchar(255) DEFAULT NULL,
  `severity` varchar(255) DEFAULT NULL,
  `complexity` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `website`, `batch`, `page`, `url`, `issue_link`, `description`, `criterion`, `issue_reference`, `element`, `check_type`, `responsibility`, `severity`, `complexity`, `date`, `created_at`, `updated_at`) VALUES
(1, '1', '3.1', '1', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI26', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'p', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(2, '1', '3.1', '1', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI27', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'span', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(3, '1', '3.1', '1', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI26', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'p', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(4, '1', '3.1', '1', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI27', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'span', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(5, '1', '3.2', '1', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI26', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'p', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(6, '1', '3.2', '2', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI27', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'span', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(7, '1', '3.2', '2', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI26', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'p', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(8, '1', '3.2', '2', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI27', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'span', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(9, '1', '3.2', '2', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI26', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'p', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42'),
(10, '1', '3.2', '2', 'https://devwp.compass-canada.com/resource_centre/oilers-entertainment-group-lance-ice-district-hospitality-avec-le-groupe-compass-canada-et-levy-2/?lang=fr', 'AI27', 'not enough contrast between text and its background', 'Success Criterion 1.4.3', 'Contrast (Minimum) The visual presentation of text and images of text has a contrast ratio of at least 4.5', 'span', 'Automated', 'Design', 'medium', 'average', '2023-11-21 10:30:00', '2024-03-26 11:18:42', '2024-03-26 11:18:42');

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
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(36, '2019_08_19_000000_create_failed_jobs_table', 1),
(37, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(38, '2023_06_03_175649_create_todos_table', 1),
(39, '2024_03_23_182151_create_issues_table', 1),
(40, '2024_03_24_112112_create_websites_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Food Buy', NULL, '2024-03-26 11:17:51', '2024-03-26 11:17:51'),
(2, 'Dev WP', NULL, '2024-03-29 13:04:42', '2024-03-29 13:04:42'),
(3, 'North Dakota', NULL, '2024-03-29 13:28:56', '2024-03-29 13:28:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
