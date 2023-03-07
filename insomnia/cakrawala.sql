-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2023 at 11:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakrawala`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` int DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `account_officer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_id` int DEFAULT NULL,
  `identity_attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `self_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `type_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `name`, `date_of_birth`, `place_of_birth`, `nik`, `address`, `account_officer`, `market_id`, `identity_attachment`, `self_photo`, `signature_photo`, `status`, `type_account`, `created_at`, `updated_at`) VALUES
(1, 1, 'eko', '1996-01-01', 'Yogyakarta', 123123, 'asdsad', 'asd', 1, '1674616645_146068d941f7f903635f456d9d79aad0-removebg-preview.png', '1674616645_146068d941f7f903635f456d9d79aad0-removebg-preview.png', '1674616645_146068d941f7f903635f456d9d79aad0-removebg-preview.png', 1, '1', '2023-01-24 20:17:25', '2023-01-24 20:17:25'),
(2, 1, 'eko', '1996-01-01', 'Yogyakarta', 123123, 'asdsad', 'asd', 1, '1674616645_146068d941f7f903635f456d9d79aad0-removebg-preview.png', '1674616645_146068d941f7f903635f456d9d79aad0-removebg-preview.png', '1674616645_146068d941f7f903635f456d9d79aad0-removebg-preview.png', 1, '2', '2023-01-24 20:17:25', '2023-01-24 20:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `account_banks`
--

CREATE TABLE `account_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_banks`
--

INSERT INTO `account_banks` (`id`, `name`, `number`, `created_at`, `updated_at`) VALUES
(2, 'BNI', '9032103', '2023-02-02 20:44:39', '2023-02-02 20:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `banner_promos`
--

CREATE TABLE `banner_promos` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_promos`
--

INSERT INTO `banner_promos` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Promo', '312220893775ce14574869b281516cac-removebg-preview.png', '2023-02-02 21:08:25', '2023-02-02 21:14:35'),
(2, '2', '3a551133ddfb28f1f622f6645302a839-removebg-preview.png', '2023-02-02 21:14:48', '2023-02-02 21:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Baju', NULL, '2023-02-08 22:20:11'),
(2, 'Buku', NULL, '2023-02-08 22:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `collaterals`
--

CREATE TABLE `collaterals` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collaterals`
--

INSERT INTO `collaterals` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Rumah', NULL, '2023-02-02 20:52:32'),
(2, 'Mobil', '2023-02-02 20:51:45', '2023-02-02 20:51:45');

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
-- Table structure for table `history_transactions`
--

CREATE TABLE `history_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` int DEFAULT NULL,
  `transaction_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_transaction_approvals`
--

CREATE TABLE `history_transaction_approvals` (
  `id` bigint UNSIGNED NOT NULL,
  `history_transaction_id` int DEFAULT NULL,
  `approval_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `account_id` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `total_loan` int DEFAULT NULL,
  `tenors` int DEFAULT NULL,
  `tenor_type` int DEFAULT NULL,
  `collateral_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `account_id`, `type`, `total_loan`, `tenors`, `tenor_type`, `collateral_id`, `created_at`, `updated_at`, `user_id`, `status`) VALUES
(4, 1, 1, 5000, 6, 2, 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49', 4, 1),
(5, 1, 3, 5000, 10, 2, 1, '2023-02-15 06:14:16', '2023-02-15 06:14:29', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `loan_list_financings`
--

CREATE TABLE `loan_list_financings` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` int DEFAULT NULL,
  `total_installment` int DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_list_financings`
--

INSERT INTO `loan_list_financings` (`id`, `loan_id`, `total_installment`, `due_date`, `status`, `created_at`, `updated_at`) VALUES
(8, 4, 714, '2023-03-04', 2, '2023-02-04 00:08:49', '2023-02-15 06:22:26'),
(9, 4, 714, '2023-04-04', 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49'),
(10, 4, 714, '2023-05-04', 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49'),
(11, 4, 714, '2023-06-04', 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49'),
(12, 4, 714, '2023-07-04', 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49'),
(13, 4, 714, '2023-08-04', 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49'),
(14, 4, 714, '2023-09-04', 1, '2023-02-04 00:08:49', '2023-02-04 00:08:49'),
(15, 5, 473, '2023-03-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(16, 5, 473, '2023-04-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(17, 5, 473, '2023-05-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(18, 5, 473, '2023-06-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(19, 5, 473, '2023-07-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(20, 5, 473, '2023-08-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(21, 5, 473, '2023-09-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(22, 5, 473, '2023-10-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(23, 5, 473, '2023-11-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(24, 5, 473, '2023-12-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16'),
(25, 5, 473, '2024-01-15', 1, '2023-02-15 06:14:16', '2023-02-15 06:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `loan_list_transactions`
--

CREATE TABLE `loan_list_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_list_financing_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `approver_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_list_transactions`
--

INSERT INTO `loan_list_transactions` (`id`, `loan_list_financing_id`, `user_id`, `total`, `approver_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 8, 4, 714, 2, '2023-02-15 06:21:50', '2023-02-15 06:22:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mailbox`
--

CREATE TABLE `mailbox` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mailbox`
--

INSERT INTO `mailbox` (`id`, `user_id`, `name`, `email`, `value`, `created_at`, `updated_at`) VALUES
(2, 1, 'eko', 'ganteng@gmail.com', 'asdasdasd', '2023-01-26 18:15:19', '2023-01-26 18:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pasar Gamping\r\n', NULL, NULL),
(2, 'Pasar Bantul', '2023-02-02 20:26:30', '2023-02-02 20:29:37');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_01_24_040226_alter_users', 1),
(11, '2023_01_24_135035_create_products', 2),
(12, '2023_01_25_013146_create_table_product_orders', 3),
(13, '2023_01_25_024328_account', 4),
(14, '2023_01_25_033139_saving', 5),
(15, '2023_01_25_033848_history_transaction', 5),
(16, '2023_01_25_044850_master', 6),
(17, '2023_01_25_060350_loan', 7),
(18, '2023_01_27_001814_create_permission_tables', 8),
(19, '2023_02_02_071108_alter_user_is_employee', 8),
(20, '2023_02_03_064552_add_user_id', 9),
(21, '2023_02_08_025523_add_statu_loan', 10),
(22, '2023_02_08_041259_loan_list_transaction', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('ad722960dc3d7afa85bdb368bee31560f2d178fd2bb33b1da771177f0e634460bb1efe5894d64425', 4, 1, 'cakrawala', '[]', 0, '2023-02-02 23:55:03', '2023-02-02 23:55:03', '2024-02-03 06:55:03'),
('da03186f273d12ee57654a61c05e3b9c64770813dd4a75714817645c05fac98ae1d7301b0a773744', 1, 1, 'cakrawala', '[]', 0, '2023-01-24 04:15:41', '2023-01-24 04:15:41', '2024-01-24 11:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'zjqnGUVesVC3HalCfqQyYH6mQ5JbtO5VUdpEiEeV', NULL, 'http://localhost', 1, 0, 0, '2023-01-24 04:10:47', '2023-01-24 04:10:47'),
(2, NULL, 'Laravel Password Grant Client', 'qcHVMjaIfuNRh5sxiSY5zsegVs62VfdWWfiWiW0o', 'users', 'http://localhost', 0, 1, 0, '2023-01-24 04:10:47', '2023-01-24 04:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-01-24 04:10:47', '2023-01-24 04:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `total_order` int DEFAULT NULL,
  `payment_id` int DEFAULT NULL,
  `payment_type` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `validate_by` int DEFAULT NULL,
  `finish_order_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `user_id`, `product_id`, `qty`, `total_order`, `payment_id`, `payment_type`, `status`, `validate_by`, `finish_order_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 20000, NULL, 1, 6, NULL, NULL, '2023-01-24 19:01:15', '2023-02-12 06:21:26');

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
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$ttKUl11rgfwwcGEMqmwRyu9UdJgTt6wiWsrK7xQkl/jD3c7n27M8a', '2023-01-26 17:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `payment_orders`
--

CREATE TABLE `payment_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_product_id` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_orders`
--

INSERT INTO `payment_orders` (`id`, `order_product_id`, `type`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '1674612880_9def1d1eb78c80079722264e08ff4e6d-removebg-preview.png', '2023-01-24 19:14:40', '2023-01-24 19:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Baju Cantik', 'deskripsi', 20000, NULL, '2023-02-08 22:20:24'),
(3, 2, 'Al Quran', 'asd', 500000, '2023-02-08 22:20:46', '2023-02-08 22:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_thumbnail` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `attachment`, `is_thumbnail`, `created_at`, `updated_at`) VALUES
(1, 1, 'image-1.png', 1, NULL, NULL),
(2, 1, 'image-1.png', 0, NULL, NULL),
(3, 2, '1675919346_Untitled.png', 1, '2023-02-08 21:41:35', '2023-02-08 22:09:06'),
(10, 2, '1675919358_a1123f53cb3028343830316f1a2f86b4.jfif', 0, '2023-02-08 22:09:18', '2023-02-08 22:09:18'),
(11, 3, '1675920046_57d70db8-f4af-48d1-8d68-d3500b655150.png', 1, '2023-02-08 22:20:46', '2023-02-08 22:20:46'),
(12, 3, '1675920046_57d70db8-f4af-48d1-8d68-d3500b655150.png', 0, '2023-02-08 22:20:46', '2023-02-08 22:20:46'),
(13, 3, '1675920046_62e3375d-679a-43cc-8763-299fb94f8c4e.jpg', 0, '2023-02-08 22:20:46', '2023-02-08 22:20:46'),
(14, 3, '1675920046_a1123f53cb3028343830316f1a2f86b4.jfif', 0, '2023-02-08 22:20:46', '2023-02-08 22:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saving_deposits`
--

CREATE TABLE `saving_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `account_id` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `total_balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `last_update_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saving_deposits`
--

INSERT INTO `saving_deposits` (`id`, `account_id`, `type`, `total_balance`, `last_updated_at`, `last_update_by`, `created_at`, `updated_at`, `user_id`) VALUES
(3, 1, 1, '105000', '2023-02-15 13:10:16', 2, '2023-02-02 23:55:26', '2023-02-15 06:10:16', 4);

-- --------------------------------------------------------

--
-- Table structure for table `saving_deposit_transactions`
--

CREATE TABLE `saving_deposit_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `saving_deposit_id` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `date_transaction` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `confirm_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saving_deposit_transactions`
--

INSERT INTO `saving_deposit_transactions` (`id`, `saving_deposit_id`, `total`, `date_transaction`, `status`, `confirm_by`, `created_at`, `updated_at`) VALUES
(4, 3, 5000, '2023-02-03 06:55:26', 3, 2, '2023-02-02 23:55:26', '2023-02-03 11:31:56'),
(5, 3, 5000, '2023-02-03 18:14:30', 3, 2, '2023-02-03 11:14:30', '2023-02-03 11:31:52'),
(6, 3, 5000, '2023-02-03 18:18:44', 3, 2, '2023-02-03 11:18:44', '2023-02-03 11:31:59'),
(7, 3, 5000, '2023-02-03 18:32:22', 2, 2, '2023-02-03 11:32:22', '2023-02-03 11:46:30'),
(8, 3, 5000, '2023-02-03 18:32:23', 3, 2, '2023-02-03 11:32:23', '2023-02-03 11:46:08'),
(9, 3, 5000, '2023-02-03 18:32:23', 3, 2, '2023-02-03 11:32:23', '2023-02-03 11:46:18'),
(10, 3, 5000, '2023-02-03 18:32:24', 3, 2, '2023-02-03 11:32:24', '2023-02-03 11:45:58'),
(11, 3, 5000, '2023-02-03 18:32:24', 3, 2, '2023-02-03 11:32:24', '2023-02-03 11:46:02'),
(12, 3, 5000, '2023-02-03 18:32:24', 3, 2, '2023-02-03 11:32:24', '2023-02-03 11:46:05'),
(13, 3, 5000, '2023-02-03 18:32:25', 3, 2, '2023-02-03 11:32:25', '2023-02-03 11:45:47'),
(14, 3, 5000, '2023-02-03 18:32:25', 3, 2, '2023-02-03 11:32:25', '2023-02-03 11:45:51'),
(15, 3, 5000, '2023-02-03 18:32:25', 3, 2, '2023-02-03 11:32:25', '2023-02-03 11:45:55'),
(16, 3, 5000, '2023-02-03 18:32:26', 3, 2, '2023-02-03 11:32:26', '2023-02-03 11:45:35'),
(17, 3, 5000, '2023-02-03 18:32:26', 2, 2, '2023-02-03 11:32:26', '2023-02-03 11:45:39'),
(18, 3, 5000, '2023-02-03 18:32:26', 2, 2, '2023-02-03 11:32:26', '2023-02-03 11:45:42'),
(19, 3, 5000, '2023-02-03 18:32:27', 2, 2, '2023-02-03 11:32:27', '2023-02-03 11:44:55'),
(20, 3, 5000, '2023-02-03 18:32:27', 2, 2, '2023-02-03 11:32:27', '2023-02-03 11:45:16'),
(21, 3, 5000, '2023-02-03 18:32:27', 2, 2, '2023-02-03 11:32:27', '2023-02-03 11:45:28'),
(22, 3, 5000, '2023-02-03 18:32:28', 2, 2, '2023-02-03 11:32:28', '2023-02-03 11:44:48'),
(23, 3, 5000, '2023-02-03 18:32:28', 2, 2, '2023-02-03 11:32:28', '2023-02-03 11:44:52'),
(24, 3, 5000, '2023-02-03 18:32:28', 2, 2, '2023-02-03 11:32:28', '2023-02-03 11:36:37'),
(25, 3, 5000, '2023-02-03 18:32:29', 2, 2, '2023-02-03 11:32:29', '2023-02-03 11:44:36'),
(26, 3, 5000, '2023-02-03 18:32:29', 2, 2, '2023-02-03 11:32:29', '2023-02-03 11:44:44'),
(27, 3, 5000, '2023-02-03 18:32:30', 2, 2, '2023-02-03 11:32:30', '2023-02-03 11:37:21'),
(28, 3, 5000, '2023-02-03 18:32:30', 2, 2, '2023-02-03 11:32:30', '2023-02-03 11:44:29'),
(29, 3, 5000, '2023-02-03 18:32:30', 2, 2, '2023-02-03 11:32:30', '2023-02-03 11:44:33'),
(30, 3, 5000, '2023-02-03 18:32:31', 2, 2, '2023-02-03 11:32:31', '2023-02-03 11:37:00'),
(31, 3, 5000, '2023-02-03 18:32:31', 2, 2, '2023-02-03 11:32:31', '2023-02-03 11:37:04'),
(32, 3, 5000, '2023-02-03 18:32:31', 2, 2, '2023-02-03 11:32:31', '2023-02-03 11:37:09'),
(33, 3, 5000, '2023-02-03 18:32:32', 2, 2, '2023-02-03 11:32:32', '2023-02-03 11:36:56'),
(34, 3, 5000, '2023-02-03 18:32:32', 3, 2, '2023-02-03 11:32:32', '2023-02-03 11:36:47'),
(35, 3, 5000, '2023-02-03 18:32:32', 3, 2, '2023-02-03 11:32:32', '2023-02-03 11:36:51'),
(36, 3, 5000, '2023-02-03 18:32:33', 2, 2, '2023-02-03 11:32:33', '2023-02-03 11:36:44'),
(37, 3, 5000, '2023-02-03 18:33:26', 2, 2, '2023-02-03 11:33:26', '2023-02-03 11:36:40'),
(38, 3, 5000, '2023-02-03 18:38:06', 2, 2, '2023-02-03 11:38:06', '2023-02-03 11:44:26'),
(39, 3, 5000, '2023-02-15 13:08:22', 3, 2, '2023-02-15 06:08:22', '2023-02-15 06:10:16');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `otp_code` int DEFAULT NULL,
  `otp_expired` datetime DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_employee` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `nickname`, `is_active`, `otp_code`, `otp_expired`, `phone`, `address`, `is_employee`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$CjDUp2u6PgN2tRPgLO0NA./f5d2F7uroxU0LAzCx5QoZRrvF3Toaa', NULL, '2023-01-24 04:14:41', '2023-01-24 04:16:00', 'admin update', 1, 7589, '2023-01-25 11:14:41', '082377673248', 'Jalan Patimura', 1),
(2, 'cakrawala', 'cakrawala@gmail.com', NULL, '$2y$10$m6eBwC8IbDMXW7.sAXCxTuQ54nywhTbZhui0jC.o65OzmVQtcztjW', 'VdxbvMH4Q6MLcl4c7qbPCI6McpIMzhM56XC5XDDfxm0iQluimyFMWUKbPU2b', '2023-01-26 17:26:48', '2023-01-26 17:26:48', NULL, 1, NULL, NULL, NULL, NULL, 1),
(4, 'user', 'user@gmail.com', NULL, '$2y$10$mpyF0zVVTfZBGfVbDqaIze9dkv89DGe.wcFrHjmN/XTlb6OyNDrZ6', NULL, '2023-02-02 23:54:29', '2023-02-02 23:55:03', 'user', 1, 3176, '2023-02-04 06:54:29', '082377673248', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_banks`
--
ALTER TABLE `account_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_promos`
--
ALTER TABLE `banner_promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaterals`
--
ALTER TABLE `collaterals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_transactions`
--
ALTER TABLE `history_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_transaction_approvals`
--
ALTER TABLE `history_transaction_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_list_financings`
--
ALTER TABLE `loan_list_financings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_list_transactions`
--
ALTER TABLE `loan_list_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_orders`
--
ALTER TABLE `payment_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `saving_deposits`
--
ALTER TABLE `saving_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saving_deposit_transactions`
--
ALTER TABLE `saving_deposit_transactions`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_banks`
--
ALTER TABLE `account_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner_promos`
--
ALTER TABLE `banner_promos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collaterals`
--
ALTER TABLE `collaterals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_transactions`
--
ALTER TABLE `history_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_transaction_approvals`
--
ALTER TABLE `history_transaction_approvals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan_list_financings`
--
ALTER TABLE `loan_list_financings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `loan_list_transactions`
--
ALTER TABLE `loan_list_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_orders`
--
ALTER TABLE `payment_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saving_deposits`
--
ALTER TABLE `saving_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saving_deposit_transactions`
--
ALTER TABLE `saving_deposit_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
