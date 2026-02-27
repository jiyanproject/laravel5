-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 04:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betterwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_statements`
--

CREATE TABLE `account_statements` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(50,2) DEFAULT NULL,
  `balance` decimal(50,2) DEFAULT NULL,
  `tax_reference` int(10) DEFAULT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posted_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_statements`
--

INSERT INTO `account_statements` (`id`, `transaction_date`, `reference_no`, `payee`, `total`, `balance`, `tax_reference`, `status_id`, `created_by`, `checked_by`, `approved_by`, `posted_by`, `created_at`, `updated_at`) VALUES
('30d3c304-7008-4b5b-ba59-552d419a6354', '2021-01-06', NULL, 'Biznet', '3000000.00', '-8000000.00', 0, 'e6cb9165-131e-406c-81c8-c2ba9a2c567e', NULL, NULL, NULL, NULL, '2021-01-16 15:01:58', '2021-01-16 15:03:47'),
('e59dbb59-3a7b-40f6-903a-6bfc205cc871', '2021-01-21', 'A00001', 'Heru Wibowo', '15000000.00', '-23000000.00', 0, '1f2967a5-9a88-4d44-a66b-5339c771aca0', '907d17c4-bb3a-4cf6-b123-a93c5d698557', NULL, NULL, NULL, '2021-01-20 19:33:50', '2021-01-20 19:33:50'),
('e7788501-de52-42e7-b669-f3e036ef6a4c', '2021-01-04', NULL, 'PLN', '5000000.00', '-5000000.00', 0, 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6', NULL, NULL, NULL, NULL, '2021-01-16 15:01:15', '2021-01-17 16:15:10'),
('fd9df07b-5b02-4d4a-b5fd-27137fa12cdb', '2021-01-21', 'A00002', 'Rob Reiner', '15000000.00', '-23000000.00', 0, '1f2967a5-9a88-4d44-a66b-5339c771aca0', '907d17c4-bb3a-4cf6-b123-a93c5d698557', NULL, NULL, NULL, '2021-01-20 19:33:50', '2021-01-20 19:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_additional_roles`
--

CREATE TABLE `appraisal_additional_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_comments`
--

CREATE TABLE `appraisal_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_data`
--

CREATE TABLE `appraisal_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indicator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_soft_goals`
--

CREATE TABLE `appraisal_soft_goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competency` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_targets`
--

CREATE TABLE `appraisal_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_weight` int(11) NOT NULL,
  `target_real` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_real` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

CREATE TABLE `asset_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chart_of_account_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depreciation_account_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_depreciations`
--

CREATE TABLE `asset_depreciations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depreciate_period` date NOT NULL,
  `opening_value` decimal(50,2) NOT NULL,
  `closing_value` decimal(50,2) NOT NULL,
  `depreciate_value` decimal(50,2) NOT NULL,
  `accumulate_value` decimal(50,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_managements`
--

CREATE TABLE `asset_managements` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `warranty_expire` date NOT NULL,
  `purchase_price` decimal(50,2) NOT NULL,
  `book_value` decimal(50,2) DEFAULT NULL,
  `purchase_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depreciation_start` date NOT NULL,
  `estimate_time` int(11) NOT NULL,
  `residual_value` decimal(50,2) NOT NULL,
  `method_id` int(11) NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_transactions`
--

CREATE TABLE `attendance_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_in` datetime NOT NULL,
  `clock_out` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chart_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(50,2) NOT NULL,
  `opening_date` date NOT NULL,
  `active` tinyint(2) NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_name`, `account_no`, `chart_id`, `opening_balance`, `opening_date`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a7490e93-6105-4293-a049-423fe1f64448', 'Bank Mandiri', '12125552161616', '3e9cd125-8012-4ff7-972f-de5ab2c9adec', '150000000.00', '2021-01-01', 1, '55efdc6c-4253-47ef-adf1-b82c578d8731', NULL, '2021-01-15 16:42:33', '2021-01-15 16:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `bank_statements`
--

CREATE TABLE `bank_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_account_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_statement_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `payee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(50,2) NOT NULL,
  `balance` decimal(50,2) NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_statements`
--

INSERT INTO `bank_statements` (`id`, `bank_account_id`, `account_statement_id`, `transaction_date`, `payee`, `description`, `amount`, `balance`, `type`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'a7490e93-6105-4293-a049-423fe1f64448', NULL, '2021-01-01', NULL, 'Saldo Awal', '150000000.00', '150000000.00', 'Debit', 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6', '2021-01-15 16:42:33', '2021-01-15 16:42:33'),
(25, 'a7490e93-6105-4293-a049-423fe1f64448', 'e7788501-de52-42e7-b669-f3e036ef6a4c', '2021-01-04', 'PLN', 'Biaya Listrik Desember 2020', '5000000.00', '5000000.00', 'Spend', 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6', '2021-01-16 15:02:13', '2021-01-17 16:15:10'),
(26, 'a7490e93-6105-4293-a049-423fe1f64448', NULL, '2021-01-05', 'Telkom', 'Biaya Telepon', '3000000.00', '3000000.00', 'Spend', 'e6cb9165-131e-406c-81c8-c2ba9a2c567e', '2021-01-16 15:02:13', '2021-01-16 15:02:13'),
(27, 'a7490e93-6105-4293-a049-423fe1f64448', NULL, '2021-01-06', 'Biznet', 'Biaya Internet', '3000000.00', '3000000.00', 'Spend', 'e6cb9165-131e-406c-81c8-c2ba9a2c567e', '2021-01-16 15:02:13', '2021-01-16 15:02:13'),
(28, 'a7490e93-6105-4293-a049-423fe1f64448', NULL, '2021-01-07', 'Pertamina', 'Biaya Bensin', '3000000.00', '3000000.00', 'Spend', 'e6cb9165-131e-406c-81c8-c2ba9a2c567e', '2021-01-16 15:02:13', '2021-01-16 15:02:13'),
(29, 'a7490e93-6105-4293-a049-423fe1f64448', NULL, '2021-01-08', 'Blue Bird', 'Biaya Taksi', '3000000.00', '3000000.00', 'Spend', 'e6cb9165-131e-406c-81c8-c2ba9a2c567e', '2021-01-16 15:02:13', '2021-01-16 15:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `budget_details`
--

CREATE TABLE `budget_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_category` int(11) NOT NULL,
  `budget_period` date NOT NULL,
  `budget_amount` decimal(50,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_periods`
--

CREATE TABLE `budget_periods` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_start` date NOT NULL,
  `budget_end` date NOT NULL,
  `budget_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_periods`
--

INSERT INTO `budget_periods` (`id`, `budget_start`, `budget_end`, `budget_title`, `status_id`, `created_by`, `updated_by`, `approved_by`, `created_at`, `updated_at`) VALUES
('e8e894fb-f752-435d-8a16-c837cbe7872c', '2021-01-01', '2021-12-31', 'tes', '1f2967a5-9a88-4d44-a66b-5339c771aca0', '907d17c4-bb3a-4cf6-b123-a93c5d698557', NULL, NULL, '2021-01-21 16:59:04', '2021-01-21 16:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `bulletins`
--

CREATE TABLE `bulletins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `content_id` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_category` int(11) NOT NULL,
  `opening_balance` decimal(50,2) DEFAULT 0.00,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `account_id`, `account_name`, `account_category`, `opening_balance`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0e71b34a-bae5-44a2-8e0b-8098ad7add91', 40200, 'Pendapatan Lainnya', 4, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:15:22', '2021-01-15 16:15:22'),
('18745691-20f6-44c7-bc39-191f0c3a015e', 10201, 'Peralatan Kantor', 2, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:12:13', '2021-01-15 16:12:13'),
('222981c5-755f-4ed8-a750-5992f68fd7de', 10204, 'Akumulasi Penyusutan Komputer', 2, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:13:02', '2021-01-15 16:13:02'),
('2534af83-4631-4ec1-959a-2f0c6aae0369', 10101, 'Kas', 1, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:10:31', '2021-01-15 16:10:31'),
('3c08a435-5944-428c-82ef-fd6490c6ad1f', 50103, 'Biaya ATK', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:17:45', '2021-01-15 16:17:45'),
('3e18a0d1-93c1-476e-bfbd-4419ab0c2a8c', 50200, 'Biaya Karyawan', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:17:58', '2021-01-15 16:17:58'),
('3e9cd125-8012-4ff7-972f-de5ab2c9adec', 10102, 'Bank Mandiri', 1, '150000000.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:10:42', '2021-01-15 16:42:33'),
('4fcb5f8c-40b4-4d0d-8c95-2f49cf3aeb89', 40201, 'Pendapatan Bunga', 4, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:15:36', '2021-01-15 16:15:36'),
('54226fa4-e72b-4d85-85ea-034a141bcda8', 50202, 'Biaya BPJS', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:18:25', '2021-01-15 16:18:25'),
('572d2d32-a3f8-4a66-b1a4-103929eff28b', 50101, 'Biaya Listrik', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:16:35', '2021-01-15 16:16:35'),
('57d74b60-4c57-4032-bce1-a9fdb4c7bec3', 10203, 'Komputer', 2, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:12:49', '2021-01-15 16:12:49'),
('670a1732-775b-4a63-b668-cbe40cc94655', 40100, 'Pendapatan Yayasan', 4, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:15:07', '2021-01-15 16:15:07'),
('718f7832-e3c7-4bdb-8d89-38868e01a3d0', 50203, 'Biaya Reimbursment', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:18:39', '2021-01-15 16:18:39'),
('8346fdcd-1ae7-4e8e-a043-ab39fad49e88', 10200, 'Aktiva Tetap', 2, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:11:43', '2021-01-15 16:11:43'),
('a4ee33ac-92ee-433d-8b40-aed14183f316', 10202, 'Akumulasi Penyusutan Peralatan Kantor', 2, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:12:35', '2021-01-15 16:12:35'),
('a70ff859-17d0-4f11-950f-93c95b444a42', 50201, 'Biaya Gaji', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:18:12', '2021-01-15 16:18:12'),
('a8752602-359f-4162-9244-5e5a8071dd6f', 50102, 'Biaya Internet', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:16:51', '2021-01-15 16:16:51'),
('ae0c4f5c-c7fc-4a64-96d4-a8e39a0ac157', 50100, 'Biaya Kantor', 5, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:16:23', '2021-01-15 16:16:23'),
('e5db9c20-eca2-4bca-8144-0e6c7e979da6', 10100, 'Aktiva Lancar', 1, '0.00', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', NULL, '2021-01-15 16:10:18', '2021-01-15 16:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'Banda Aceh', 1, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(2, 'Langsa', 1, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(3, 'Lhokseumawe', 1, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(4, 'Meulaboh', 1, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(5, 'Sabang', 1, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(6, 'Subulussalam', 1, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(7, 'Denpasar', 2, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(8, 'Pangkalpinang', 3, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(9, 'Cilegon', 4, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(10, 'Serang', 4, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(11, 'Tangerang Selatan', 4, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(12, 'Tangerang', 4, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(13, 'Bengkulu', 5, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(14, 'Gorontalo', 6, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(15, 'Kota Administrasi Jakarta Barat', 7, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(16, 'Kota Administrasi Jakarta Pusat', 7, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(17, 'Kota Administrasi Jakarta Selatan', 7, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(18, 'Kota Administrasi Jakarta Timur', 7, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(19, 'Kota Administrasi Jakarta Utara', 7, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(20, 'Sungai Penuh', 8, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(21, 'Jambi', 8, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(22, 'Bandung', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(23, 'Bekasi', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(24, 'Bogor', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(25, 'Cimahi', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(26, 'Cirebon', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(27, 'Depok', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(28, 'Sukabumi', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(29, 'Tasikmalaya', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(30, 'Banjar', 9, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(31, 'Magelang', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(32, 'Pekalongan', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(33, 'Purwokerto', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(34, 'Salatiga', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(35, 'Semarang', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(36, 'Surakarta', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(37, 'Tegal', 10, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(38, 'Batu', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(39, 'Blitar', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(40, 'Kediri', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(41, 'Madiun', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(42, 'Malang', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(43, 'Mojokerto', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(44, 'Pasuruan', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(45, 'Probolinggo', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(46, 'Surabaya', 11, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(47, 'Pontianak', 12, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(48, 'Singkawang', 12, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(49, 'Banjarbaru', 13, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(50, 'Banjarmasin', 13, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(51, 'Palangkaraya', 14, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(52, 'Balikpapan', 15, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(53, 'Bontang', 15, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(54, 'Samarinda', 15, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(55, 'Tarakan', 16, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(56, 'Batam', 17, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(57, 'Tanjungpinang', 17, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(58, 'Bandar Lampung', 18, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(59, 'Metro', 18, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(60, 'Ternate', 19, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(61, 'Tidore Kepulauan', 19, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(62, 'Ambon', 20, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(63, 'Tual', 20, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(64, 'Bima', 21, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(65, 'Mataram', 21, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(66, 'Kupang', 22, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(67, 'Sorong', 23, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(68, 'Jayapura', 24, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(69, 'Dumai', 25, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(70, 'Pekanbaru', 25, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(71, 'Makassar', 26, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(72, 'Palopo', 26, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(73, 'Parepare', 26, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(74, 'Palu', 27, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(75, 'Bau-Bau', 28, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(76, 'Kendari', 28, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(77, 'Bitung', 29, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(78, 'Kotamobagu', 29, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(79, 'Manado', 29, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(80, 'Tomohon', 29, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(81, 'Bukittinggi', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(82, 'Padang', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(83, 'Padangpanjang', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(84, 'Pariaman', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(85, 'Payakumbuh', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(86, 'Sawahlunto', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(87, 'Solok', 30, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(88, 'Lubuklinggau', 31, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(89, 'Pagaralam', 31, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(90, 'Palembang', 31, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(91, 'Prabumulih', 31, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(92, 'Binjai', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(93, 'Medan', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(94, 'Padang Sidempuan', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(95, 'Pematangsiantar', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(96, 'Sibolga', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(97, 'Tanjungbalai', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(98, 'Tebingtinggi', 32, '2020-02-20 20:25:29', '2020-02-20 20:25:29'),
(99, 'Yogyakarta', 33, '2020-02-20 20:25:29', '2020-02-20 20:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `coa_categories`
--

CREATE TABLE `coa_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coa_categories`
--

INSERT INTO `coa_categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Current Asset', '2020-12-29 02:36:09', '2020-12-29 02:36:09'),
(2, 'Fixed Asset', '2020-12-29 02:36:09', '2020-12-29 02:36:09'),
(3, 'Current Liability', '2020-12-29 02:36:09', '2020-12-29 02:36:09'),
(4, 'Revenue', '2020-12-29 02:36:09', '2020-12-29 02:36:09'),
(5, 'Expense', '2020-12-29 02:36:09', '2020-12-29 02:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `depreciation_methods`
--

CREATE TABLE `depreciation_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depreciation_methods`
--

INSERT INTO `depreciation_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Straight Line', '2020-03-09 20:50:27', '2020-03-09 20:50:27'),
(3, 'Declining Balance(150%)', '2020-03-09 20:50:27', '2020-03-09 20:50:27'),
(4, 'Declining Balance(200%)', '2020-03-09 20:50:27', '2020-03-09 20:50:27'),
(5, 'Full Depreciation at Purchase', '2020-03-09 20:50:27', '2020-03-09 20:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division_name`, `created_at`, `updated_at`) VALUES
(1, 'Human Resources', '2021-01-01 06:03:59', '2021-01-01 06:03:59'),
(2, 'General Affair', '2021-01-01 06:22:38', '2021-01-01 06:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

CREATE TABLE `document_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education_degree`
--

CREATE TABLE `education_degree` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `degree_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education_degree`
--

INSERT INTO `education_degree` (`id`, `degree_name`, `created_at`, `updated_at`) VALUES
(1, 'SMA', NULL, NULL),
(2, 'Ahli Madya', NULL, NULL),
(3, 'Sarjana', NULL, NULL),
(4, 'Magister', NULL, NULL),
(5, 'Doktor', NULL, NULL),
(6, 'Professor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `marital_status` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_category` int(11) NOT NULL,
  `tax_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2207ac0e-71a0-41ae-897b-b49efb016d6e',
  `contract_status` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_no`, `first_name`, `last_name`, `date_of_birth`, `place_of_birth`, `sex`, `marital_status`, `picture`, `address`, `phone`, `mobile`, `email`, `id_card`, `tax_category`, `tax_no`, `availability`, `contract_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('19c7f01c-cfec-46a2-bb17-633fa7e82a82', 'A00004', 'Jack', 'Lone', '2004-03-17', 'Singapore', 1, 1, 'A00004.jpg', 'Jakarta', NULL, '0812121515156156', 'jack@local.com', '317771556151616', 1, '2252266949169497', '2207ac0e-71a0-41ae-897b-b49efb016d6e', '2e9731fd-6544-44a1-b832-aab293e8804a', '06b92448-2215-4dd3-b439-687e86381f95', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:06:10', '2021-01-15 16:06:25'),
('55efdc6c-4253-47ef-adf1-b82c578d8731', 'A00003', 'John', 'Doe', '1996-05-06', 'Singapore', 1, 1, 'A00003.jpg', 'Jakarta', NULL, '0812121515156156', 'john@local.com', '317771556151616', 1, '2252266949169497', '2207ac0e-71a0-41ae-897b-b49efb016d6e', '2e9731fd-6544-44a1-b832-aab293e8804a', '06b92448-2215-4dd3-b439-687e86381f95', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:04:59', '2021-01-15 16:06:35'),
('5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 'A00001', 'Heru', 'Wibowo', '1983-02-17', 'Jakarta', 1, 2, 'A00001.jpg', 'Depok', NULL, '0812121515156156', 'heru@local.com', '317771556151616', 6, '2252266949169497', '2207ac0e-71a0-41ae-897b-b49efb016d6e', '2e9731fd-6544-44a1-b832-aab293e8804a', '06b92448-2215-4dd3-b439-687e86381f95', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 15:49:18', '2021-01-15 15:54:31'),
('907d17c4-bb3a-4cf6-b123-a93c5d698557', 'A00002', 'Rob', 'Reiner', '2003-08-08', 'Singapore', 1, 1, 'A00002.jpg', 'Jakarta', NULL, '0812121515156156', 'rob@local.com', '317771556151616', 1, '2252266949169497', '2207ac0e-71a0-41ae-897b-b49efb016d6e', '2e9731fd-6544-44a1-b832-aab293e8804a', '06b92448-2215-4dd3-b439-687e86381f95', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:02:25', '2021-01-15 16:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `employee_appraisals`
--

CREATE TABLE `employee_appraisals` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appraisal_type` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appraisal_period` date NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendances`
--

CREATE TABLE `employee_attendances` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hour` decimal(10,2) DEFAULT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_education`
--

CREATE TABLE `employee_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_graduate` date DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpa` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_families`
--

CREATE TABLE `employee_families` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relations` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_grievances`
--

CREATE TABLE `employee_grievances` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` int(11) NOT NULL,
  `leave_amount` decimal(10,2) NOT NULL,
  `leave_usage` decimal(10,2) DEFAULT NULL,
  `leave_remaining` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`id`, `employee_id`, `period`, `leave_amount`, `leave_usage`, `leave_remaining`, `created_at`, `updated_at`) VALUES
('30771d0b-9a8d-4e39-8b23-4e7ea232e2df', '55efdc6c-4253-47ef-adf1-b82c578d8731', 2021, '12.00', NULL, NULL, '2021-01-15 16:04:59', '2021-01-15 16:06:35'),
('7dd62df9-a440-46a3-aebc-35036b511c0f', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', 2021, '12.00', NULL, NULL, '2021-01-15 16:06:10', '2021-01-15 16:06:25'),
('c9d7f985-9083-4b4c-87f7-7a99f24372e2', '5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 2021, '12.00', NULL, NULL, '2021-01-15 15:49:18', '2021-01-15 15:57:37'),
('f027c244-233e-449c-85a3-bde41dcad40a', '907d17c4-bb3a-4cf6-b123-a93c5d698557', 2021, '12.00', NULL, NULL, '2021-01-15 16:02:25', '2021-01-15 16:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `employee_positions`
--

CREATE TABLE `employee_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_positions`
--

INSERT INTO `employee_positions` (`id`, `position_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Officer', '06b92448-2215-4dd3-b439-687e86381f95', NULL, '2020-01-31 04:14:38', '2020-01-31 04:14:38'),
(2, 'Director', '06b92448-2215-4dd3-b439-687e86381f95', NULL, '2020-02-04 14:40:24', '2020-02-04 14:40:24'),
(3, 'Manager', '06b92448-2215-4dd3-b439-687e86381f95', NULL, '2020-02-04 14:40:30', '2020-02-04 14:40:30'),
(4, 'Supervisor', '06b92448-2215-4dd3-b439-687e86381f95', NULL, '2020-02-04 14:40:38', '2020-02-04 14:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `employee_reimbursments`
--

CREATE TABLE `employee_reimbursments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `amount` decimal(50,2) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_reimbursments`
--

INSERT INTO `employee_reimbursments` (`id`, `employee_id`, `transaction_date`, `type_id`, `amount`, `notes`, `status_id`, `files`, `created_at`, `updated_at`) VALUES
('09727801-7d56-4bd6-bd0b-f2826d14d603', '907d17c4-bb3a-4cf6-b123-a93c5d698557', '2021-01-21', 1, '50000.00', 'Bensin Motor', 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be', NULL, '2021-01-20 19:43:07', '2021-01-20 19:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coa_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payroll_period` date NOT NULL,
  `employee_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nett_salary` decimal(50,2) NOT NULL,
  `jkk` decimal(50,2) NOT NULL,
  `jkm` decimal(50,2) NOT NULL,
  `leave_balance` decimal(50,2) NOT NULL,
  `rewards` decimal(50,2) NOT NULL,
  `expense` decimal(50,2) NOT NULL,
  `bpjs_c` decimal(50,2) NOT NULL,
  `bpjs_e` decimal(50,2) NOT NULL,
  `jht_c` decimal(50,2) NOT NULL,
  `jht_e` decimal(50,2) NOT NULL,
  `jp_c` decimal(50,2) NOT NULL,
  `jp_e` decimal(50,2) NOT NULL,
  `dplk` decimal(50,2) DEFAULT NULL,
  `income_tax` decimal(50,2) NOT NULL,
  `receive_payroll` decimal(50,2) NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1f2967a5-9a88-4d44-a66b-5339c771aca0',
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_salaries`
--

INSERT INTO `employee_salaries` (`id`, `coa_id`, `payroll_period`, `employee_no`, `employee_name`, `nett_salary`, `jkk`, `jkm`, `leave_balance`, `rewards`, `expense`, `bpjs_c`, `bpjs_e`, `jht_c`, `jht_e`, `jp_c`, `jp_e`, `dplk`, `income_tax`, `receive_payroll`, `status_id`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 'a70ff859-17d0-4f11-950f-93c95b444a42', '2021-01-01', 'A00001', 'Heru Wibowo', '85000000.00', '36000.00', '45000.00', '0.00', '0.00', '500000.00', '480000.00', '120000.00', '555000.00', '300000.00', '170248.00', '85124.00', '0.00', '1288795.83', '15000000.00', 'ca52a2ce-5c37-48ce-a7f2-0fd5311860c2', '907d17c4-bb3a-4cf6-b123-a93c5d698557', '907d17c4-bb3a-4cf6-b123-a93c5d698557', '2021-01-20 19:33:45', '2021-01-20 19:33:50'),
(2, 'a70ff859-17d0-4f11-950f-93c95b444a42', '2021-01-01', 'A00002', 'Rob Reiner', '45000000.00', '36000.00', '45000.00', '0.00', '0.00', '10256.20', '480000.00', '120000.00', '555000.00', '300000.00', '170248.00', '85124.00', '0.00', '1288795.83', '15000000.00', 'ca52a2ce-5c37-48ce-a7f2-0fd5311860c2', '907d17c4-bb3a-4cf6-b123-a93c5d698557', '907d17c4-bb3a-4cf6-b123-a93c5d698557', '2021-01-20 19:33:45', '2021-01-20 19:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `employee_services`
--

CREATE TABLE `employee_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_id` smallint(2) NOT NULL,
  `office_id` smallint(2) NOT NULL,
  `division_id` smallint(2) NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date DEFAULT NULL,
  `salary` decimal(50,2) NOT NULL,
  `contract` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_services`
--

INSERT INTO `employee_services` (`id`, `employee_id`, `position`, `report_to`, `org_id`, `office_id`, `division_id`, `grade`, `from`, `to`, `salary`, `contract`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 'HR Director', NULL, 1, 1, 1, 'Director', '1999-06-16', NULL, '85000000.00', NULL, 1, '2021-01-15 15:49:18', '2021-01-15 15:49:18'),
(2, '907d17c4-bb3a-4cf6-b123-a93c5d698557', 'HR Manager', '5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 2, 1, 1, 'Manager', '2009-06-23', NULL, '45000000.00', NULL, 1, '2021-01-15 16:02:25', '2021-01-15 16:02:46'),
(3, '55efdc6c-4253-47ef-adf1-b82c578d8731', 'Finance Manager', NULL, 2, 1, 2, 'Manager', '2013-02-05', NULL, '45000000.00', NULL, 1, '2021-01-15 16:04:59', '2021-01-15 16:04:59'),
(4, '19c7f01c-cfec-46a2-bb17-633fa7e82a82', 'Finance Controller', '55efdc6c-4253-47ef-adf1-b82c578d8731', 2, 1, 2, 'Supervisor', '2020-02-04', NULL, '15000000.00', NULL, 1, '2021-01-15 16:06:10', '2021-01-15 16:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `employee_trainings`
--

CREATE TABLE `employee_trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_from` date DEFAULT NULL,
  `training_to` date DEFAULT NULL,
  `status` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_outcome` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reports` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materials` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grievance_categories`
--

CREATE TABLE `grievance_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grievance_comments`
--

CREATE TABLE `grievance_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grievance_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holiday_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_start` date NOT NULL,
  `holiday_end` date NOT NULL,
  `leave_status` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '13ca0601-de87-4d58-8ccd-d1f01dba78d8',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_statement_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `unit_price` decimal(50,2) NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` int(10) DEFAULT NULL,
  `tax_amount` decimal(50,2) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(50,2) NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `account_statement_id`, `transaction_date`, `item`, `description`, `quantity`, `unit_price`, `account_name`, `trans_type`, `tax_rate`, `tax_amount`, `file`, `amount`, `source`, `created_at`, `updated_at`) VALUES
(1, 'e7788501-de52-42e7-b669-f3e036ef6a4c', '2021-01-04', 'Biaya Listrik', 'Biaya Listrik Desember 2020', 1, '5000000.00', '572d2d32-a3f8-4a66-b1a4-103929eff28b', 'Debit', NULL, NULL, NULL, '5000000.00', 'User', '2021-01-16 15:01:15', '2021-01-16 15:01:15'),
(2, 'e7788501-de52-42e7-b669-f3e036ef6a4c', '2021-01-04', 'Biaya Listrik', 'Biaya Listrik Desember 2020', 1, '5000000.00', '3e9cd125-8012-4ff7-972f-de5ab2c9adec', 'Credit', NULL, NULL, NULL, '5000000.00', 'Bank', '2021-01-16 15:01:15', '2021-01-16 15:01:15'),
(3, '30d3c304-7008-4b5b-ba59-552d419a6354', '2021-01-06', 'Biaya Internet', 'Internet Desember 2020', 1, '3000000.00', 'a8752602-359f-4162-9244-5e5a8071dd6f', 'Debit', NULL, NULL, NULL, '3000000.00', 'User', '2021-01-16 15:01:58', '2021-01-16 15:01:58'),
(4, '30d3c304-7008-4b5b-ba59-552d419a6354', '2021-01-06', 'Biaya Internet', 'Internet Desember 2020', 1, '3000000.00', '3e9cd125-8012-4ff7-972f-de5ab2c9adec', 'Credit', NULL, NULL, NULL, '3000000.00', 'Bank', '2021-01-16 15:01:58', '2021-01-16 15:01:58'),
(9, 'e59dbb59-3a7b-40f6-903a-6bfc205cc871', '2021-01-21', 'Pembayaran Gaji Heru Wibowo', 'Pembayaran Gaji Heru Wibowo Bulan2021-01-01', 1, '15000000.00', 'a70ff859-17d0-4f11-950f-93c95b444a42', 'Debit', NULL, NULL, NULL, '15000000.00', 'User', '2021-01-20 19:33:50', '2021-01-20 19:33:50'),
(10, 'e59dbb59-3a7b-40f6-903a-6bfc205cc871', '2021-01-21', 'Pembayaran Gaji Heru Wibowo', 'Pembayaran Gaji Heru Wibowo Bulan2021-01-01', 1, '15000000.00', '3e9cd125-8012-4ff7-972f-de5ab2c9adec', 'Credit', NULL, NULL, NULL, '15000000.00', 'Bank', '2021-01-20 19:33:50', '2021-01-20 19:33:50'),
(11, 'fd9df07b-5b02-4d4a-b5fd-27137fa12cdb', '2021-01-21', 'Pembayaran Gaji Rob Reiner', 'Pembayaran Gaji Rob Reiner Bulan2021-01-01', 1, '15000000.00', 'a70ff859-17d0-4f11-950f-93c95b444a42', 'Debit', NULL, NULL, NULL, '15000000.00', 'User', '2021-01-20 19:33:50', '2021-01-20 19:33:50'),
(12, 'fd9df07b-5b02-4d4a-b5fd-27137fa12cdb', '2021-01-21', 'Pembayaran Gaji Rob Reiner', 'Pembayaran Gaji Rob Reiner Bulan2021-01-01', 1, '15000000.00', '3e9cd125-8012-4ff7-972f-de5ab2c9adec', 'Credit', NULL, NULL, NULL, '15000000.00', 'Bank', '2021-01-20 19:33:50', '2021-01-20 19:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_bases`
--

CREATE TABLE `knowledge_bases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_transactions`
--

CREATE TABLE `leave_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeoff_type` smallint(2) NOT NULL,
  `leave_type` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_start` date DEFAULT NULL,
  `leave_end` date DEFAULT NULL,
  `schedule_in` time DEFAULT NULL,
  `schedule_out` time DEFAULT NULL,
  `amount_requested` decimal(10,2) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_name`, `created_at`, `updated_at`) VALUES
(1, 'Sakit Dengan Surat Dokter', '2020-12-24 19:43:27', '2020-12-24 19:43:27'),
(2, 'Perjalanan Dinas', '2020-12-24 19:43:27', '2020-12-24 19:43:27'),
(3, 'Cuti Ibadah', '2020-12-24 19:43:27', '2020-12-24 19:43:27'),
(4, 'Izin', '2020-12-24 19:43:27', '2020-12-24 19:43:27'),
(5, 'Izin Keadaan Kahar (Force Majeur)', '2020-12-24 19:43:27', '2020-12-24 19:43:27'),
(6, 'Cuti Tahunan', '2020-12-24 19:43:27', '2020-12-24 19:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `city`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', '2020-02-01 16:23:25', '2020-02-01 16:23:25'),
(2, 'Bandung', '2020-02-01 16:23:25', '2020-02-01 16:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `subject`, `url`, `method`, `ip`, `agent`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Employee Heru Wibowo Created', 'http://betterwork.local/apps/human-resources/employee/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 15:49:18', '2021-01-15 15:49:18'),
(2, 'Employee Heru Wibowo Edited', 'http://betterwork.local/apps/human-resources/employee/update/5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 15:54:31', '2021-01-15 15:54:31'),
(3, 'Employee Heru Wibowo Edited', 'http://betterwork.local/apps/human-resources/employee/update/5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 15:57:16', '2021-01-15 15:57:16'),
(4, 'Employee Heru Wibowo Edited', 'http://betterwork.local/apps/human-resources/employee/update/5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 15:57:37', '2021-01-15 15:57:37'),
(5, 'Employee Rob Reiner Created', 'http://betterwork.local/apps/human-resources/employee/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:02:25', '2021-01-15 16:02:25'),
(6, 'Employee Rob Reiner Edited', 'http://betterwork.local/apps/human-resources/employee/update/907d17c4-bb3a-4cf6-b123-a93c5d698557', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:02:32', '2021-01-15 16:02:32'),
(7, 'Employee Service Data Updated', 'http://betterwork.local/apps/human-resources/employee/service/update/2', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:02:46', '2021-01-15 16:02:46'),
(8, 'Employee John Doe Created', 'http://betterwork.local/apps/human-resources/employee/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:04:59', '2021-01-15 16:04:59'),
(9, 'Employee Jack Lone Created', 'http://betterwork.local/apps/human-resources/employee/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:06:10', '2021-01-15 16:06:10'),
(10, 'Employee Service Data Updated', 'http://betterwork.local/apps/human-resources/employee/service/update/4', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:06:21', '2021-01-15 16:06:21'),
(11, 'Employee Jack Lone Edited', 'http://betterwork.local/apps/human-resources/employee/update/19c7f01c-cfec-46a2-bb17-633fa7e82a82', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:06:25', '2021-01-15 16:06:25'),
(12, 'Employee John Doe Edited', 'http://betterwork.local/apps/human-resources/employee/update/55efdc6c-4253-47ef-adf1-b82c578d8731', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:06:35', '2021-01-15 16:06:35'),
(13, 'Employee Service Data Updated', 'http://betterwork.local/apps/human-resources/employee/service/update/4', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:07:56', '2021-01-15 16:07:56'),
(14, 'Access Role Finance Created', 'http://betterwork.local/apps/configuration/access-roles/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:09:11', '2021-01-15 16:09:11'),
(15, 'User Jack Lone Berhasil diubah', 'http://betterwork.local/apps/configuration/users/update/cfe7d210-466c-4390-8974-1a517cbfd29e', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:09:19', '2021-01-15 16:09:19'),
(16, 'User John Doe Berhasil diubah', 'http://betterwork.local/apps/configuration/users/update/b5201a49-efb0-436a-90a6-14f3bf42d488', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-15 16:09:28', '2021-01-15 16:09:28'),
(17, 'Category Aktiva Lancar Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:10:18', '2021-01-15 16:10:18'),
(18, 'Category Kas Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:10:31', '2021-01-15 16:10:31'),
(19, 'Category Bank Mandiri Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:10:42', '2021-01-15 16:10:42'),
(20, 'Category Aktiva Tetap Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:11:43', '2021-01-15 16:11:43'),
(21, 'Category Peralatan Kantor Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:12:13', '2021-01-15 16:12:13'),
(22, 'Category Akumulasi Penyusutan Peralatan Kantor Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:12:35', '2021-01-15 16:12:35'),
(23, 'Category Komputer Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:12:49', '2021-01-15 16:12:49'),
(24, 'Category Akumulasi Penyusutan Komputer Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:13:02', '2021-01-15 16:13:02'),
(25, 'Category Pendapatan Yayasan Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:15:07', '2021-01-15 16:15:07'),
(26, 'Category Pendapatan Lainnya Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:15:22', '2021-01-15 16:15:22'),
(27, 'Category Pendapatan Bunga Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:15:36', '2021-01-15 16:15:36'),
(28, 'Category Biaya Kantor Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:16:23', '2021-01-15 16:16:23'),
(29, 'Category Biaya Listrik Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:16:35', '2021-01-15 16:16:35'),
(30, 'Category Biaya Internet Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:16:51', '2021-01-15 16:16:51'),
(31, 'Category Biaya ATK Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:17:45', '2021-01-15 16:17:45'),
(32, 'Category Biaya Karyawan Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:17:58', '2021-01-15 16:17:58'),
(33, 'Category Biaya Gaji Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:18:12', '2021-01-15 16:18:12'),
(34, 'Category Biaya BPJS Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:18:25', '2021-01-15 16:18:25'),
(35, 'Category Biaya Reimbursment Created', 'http://betterwork.local/apps/finance/accounting/chart-of-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:18:39', '2021-01-15 16:18:39'),
(36, 'Bank Record For Bank Mandiri Created', 'http://betterwork.local/apps/configuration/bank-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'cfe7d210-466c-4390-8974-1a517cbfd29e', '2021-01-15 16:19:03', '2021-01-15 16:19:03'),
(37, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:28:04', '2021-01-15 16:28:04'),
(38, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:33:40', '2021-01-15 16:33:40'),
(39, 'Bank Record For Bank Mandiri Created', 'http://betterwork.local/apps/configuration/bank-account/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:42:33', '2021-01-15 16:42:33'),
(40, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:43:10', '2021-01-15 16:43:10'),
(41, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:45:43', '2021-01-15 16:45:43'),
(42, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:49:24', '2021-01-15 16:49:24'),
(43, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 16:55:45', '2021-01-15 16:55:45'),
(44, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 17:20:00', '2021-01-15 17:20:00'),
(45, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 17:25:38', '2021-01-15 17:25:38'),
(46, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 17:27:11', '2021-01-15 17:27:11'),
(47, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'b5201a49-efb0-436a-90a6-14f3bf42d488', '2021-01-15 17:34:28', '2021-01-15 17:34:28'),
(48, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-16 14:44:18', '2021-01-16 14:44:18'),
(49, 'Bank Statement Successfully Import', 'http://betterwork.local/apps/finance/bank/bank-statement/import/process', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-16 15:02:13', '2021-01-16 15:02:13'),
(50, 'User Rob Reiner Berhasil diubah', 'http://betterwork.local/apps/configuration/users/update/c0999cc4-c18d-4f1b-a3ba-aab04cafa08e', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-20 19:10:13', '2021-01-20 19:10:13'),
(51, 'User Heru Wibowo Berhasil diubah', 'http://betterwork.local/apps/configuration/users/update/17882d09-40e3-4159-a8e3-4792e105d983', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-20 19:10:19', '2021-01-20 19:10:19'),
(52, 'Access Role HR Officer Updated', 'http://betterwork.local/apps/configuration/access-roles/update/3', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-20 19:13:19', '2021-01-20 19:13:19'),
(53, 'Salary File Successfully Uploaded', 'http://betterwork.local/apps/human-resources/salary/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'c0999cc4-c18d-4f1b-a3ba-aab04cafa08e', '2021-01-20 19:31:58', '2021-01-20 19:31:58'),
(54, 'Salary File Successfully Uploaded', 'http://betterwork.local/apps/human-resources/salary/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'c0999cc4-c18d-4f1b-a3ba-aab04cafa08e', '2021-01-20 19:33:45', '2021-01-20 19:33:45'),
(55, 'Type Uang Bensin Created', 'http://betterwork.local/apps/configuration/reimburstment-type/store', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-20 19:42:37', '2021-01-20 19:42:37'),
(56, 'Access Role HR Officer Updated', 'http://betterwork.local/apps/configuration/access-roles/update/3', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '06b92448-2215-4dd3-b439-687e86381f95', '2021-01-20 19:43:59', '2021-01-20 19:43:59');

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
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_30_131620_create_permission_tables', 1),
(4, '2020_01_30_143121_create_statuses_table', 2),
(5, '2020_01_30_150055_create_employee_positions_table', 3),
(6, '2020_01_30_222019_create_log_activities_table', 4),
(7, '2020_01_31_112616_create_leave_types_table', 5),
(8, '2020_02_01_033144_create_reimburs_types_table', 6),
(9, '2020_02_01_034311_create_document_categories_table', 7),
(10, '2020_02_01_035124_create_grievance_categories_table', 8),
(12, '2020_02_01_040015_create_chart_of_accounts_table', 9),
(14, '2020_02_01_141430_create_employees_table', 10),
(15, '2020_02_01_223103_create_employee_families_table', 11),
(16, '2020_02_01_223326_create_employee_education_table', 12),
(19, '2020_02_01_223842_create_employee_services_table', 15),
(20, '2020_02_01_225154_create_locations_table', 16),
(22, '2020_02_01_223504_create_employee_trainings_table', 17),
(23, '2020_02_03_001723_create_employee_attendances_table', 18),
(24, '2020_02_03_014115_create_employee_leaves_table', 19),
(26, '2020_02_03_022530_create_employee_reimbursments_table', 20),
(27, '2020_02_03_030357_create_employee_grievances_table', 21),
(28, '2020_02_03_030411_create_grievance_comments_table', 21),
(29, '2020_02_04_004029_create_education_degree', 22),
(32, '2020_02_04_075222_create_tax_base', 24),
(33, '2020_02_04_215232_create_bulletins_table', 25),
(34, '2020_02_04_215255_create_knowledge_bases_table', 25),
(35, '2020_02_05_213538_create_leave_transactions_table', 26),
(36, '2020_02_05_214347_create_attendance_transactions_table', 27),
(39, '2020_02_06_030802_create_employee_appraisals_table', 28),
(40, '2020_02_06_030816_create_appraisal_data_table', 28),
(41, '2020_02_06_080704_create_appraisal_targets_table', 29),
(42, '2020_02_07_010011_create_appraisal_soft_goals_table', 30),
(43, '2020_02_07_010028_create_appraisal_comments_table', 30),
(44, '2020_02_07_010132_create_appraisal_additional_roles_table', 30),
(45, '2020_02_04_025042_create_employee_salaries_table', 31),
(46, '2020_02_11_005407_create_target_data_table', 32),
(63, '2020_02_18_043932_create_bank_accounts_table', 36),
(64, '2020_02_18_043944_create_bank_statements_table', 36),
(65, '2020_02_20_102933_create_organizations_table', 37),
(66, '2020_02_20_105102_create_offices_table', 38),
(67, '2020_02_20_105912_create_provinces_table', 39),
(68, '2020_02_20_105923_create_cities_table', 39),
(71, '2020_02_27_222110_create_asset_categories_table', 42),
(72, '2020_02_27_230719_create_asset_managements_table', 43),
(73, '2020_02_27_230740_create_asset_depreciations_table', 43),
(74, '2020_02_18_043958_create_account_statements_table', 44),
(75, '2020_02_26_083707_create_journal_entries_table', 44),
(76, '2020_03_04_013122_create_budget_periods_table', 45),
(77, '2020_03_04_013203_create_budget_details_table', 45),
(79, '2020_03_04_193054_create_coa_categories_table', 46),
(80, '2020_03_07_213816_create_holidays_table', 47),
(81, '2014_10_00_000000_create_settings_table', 48),
(82, '2014_10_00_000001_add_group_column_on_settings_table', 48),
(83, '2020_03_10_034321_create_depreciation_methods_table', 49),
(84, '2020_12_31_125550_create_divisions_table', 50);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'iteos\\Models\\User', '06b92448-2215-4dd3-b439-687e86381f95'),
(2, 'iteos\\Models\\User', '14c41229-60f8-4db2-908d-76d1bce7b175'),
(2, 'iteos\\Models\\User', '3e6399ff-abce-48c4-a7f4-7e78917ffa40'),
(2, 'iteos\\Models\\User', '77bead59-a71a-49eb-a2d6-19846292e2cc'),
(2, 'iteos\\Models\\User', '9bf420ce-47f4-47e2-8d2e-9e07d1a389f0'),
(2, 'iteos\\Models\\User', 'f116b5c3-d26e-4669-ab18-0d447fdb7f8b'),
(3, 'iteos\\Models\\User', 'c0999cc4-c18d-4f1b-a3ba-aab04cafa08e'),
(4, 'iteos\\Models\\User', '17882d09-40e3-4159-a8e3-4792e105d983'),
(5, 'iteos\\Models\\User', 'b5201a49-efb0-436a-90a6-14f3bf42d488'),
(5, 'iteos\\Models\\User', 'cfe7d210-466c-4390-8974-1a517cbfd29e');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` smallint(5) NOT NULL,
  `city` smallint(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `office_address`, `province`, `city`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Pusat', 'Menara Thamrin', 7, 16, '2020-02-20 20:44:37', '2020-02-20 20:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'Board Yayasan', NULL, '2020-02-20 03:43:12', '2020-02-20 03:43:12'),
(2, 'Management', 'Board Yayasan', '2020-02-20 03:43:25', '2020-02-20 03:43:25'),
(3, 'Support', 'Management', '2020-02-20 03:48:21', '2020-02-20 03:48:21');

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
('heru.palomino@gmail.com', '$2y$10$H21uZDPfsGE75qHhiKjKDe84aFIHX36J4dB4SFHOGqC949J33P9nq', '2020-02-09 06:53:36'),
('budi@local.com', '$2y$10$.mDBS1sT2cp5YDthK0zWBu/52MjG6OGbGMUXh28AzhVetIjAb0Dna', '2020-12-20 21:07:30'),
('eko@local.com', '$2y$10$p3mDX/wrLLB7B1Gbvv2wfOpAnePRxLHMM/NRASnGBKC0HG2jfDE1i', '2021-01-01 06:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Access Configuration', 'web', '2020-01-30 16:51:24', '2020-01-30 16:51:24'),
(2, 'Access Human Resources', 'web', '2020-01-30 16:51:24', '2020-01-30 16:51:24'),
(3, 'Access Grievance', 'web', '2020-01-30 16:51:24', '2020-01-30 16:51:24'),
(4, 'Access Accounting', 'web', '2020-01-30 16:51:24', '2020-01-30 16:51:24'),
(5, 'Create User', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(6, 'Edit User', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(7, 'Remove User', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(8, 'Create Role', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(9, 'Edit Role', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(10, 'Create HR Master Data', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(11, 'Edit HR Master Data', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(12, 'Delete HR Master Data', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(13, 'Create Accounting Master Data', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(14, 'Edit Accounting Master Data', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(15, 'Delete Accounting Master Data', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(16, 'Create Employee', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(17, 'Edit Employee', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(18, 'Remove Employee', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(19, 'Process Request', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(20, 'Create Payroll', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(21, 'Edit Payroll', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(22, 'Process Payroll', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(23, 'Create Reimburs', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(24, 'Edit Reimburs', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(25, 'Delete Reimburs', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(26, 'Process Reimburs', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(27, 'Create Appraisal', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(28, 'Edit Appraisal', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(29, 'Process Appraisal', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(30, 'Create Training', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(31, 'Edit Training', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(32, 'Process Training', 'web', '2020-01-30 18:38:26', '2020-01-30 18:38:26'),
(33, 'Create Application Setting', 'web', '2020-01-30 18:41:11', '2020-01-30 18:41:11'),
(34, 'Access Employee Attendance', 'web', '2020-02-09 02:00:14', '2020-02-09 02:00:14'),
(35, 'Process Leave', 'web', '2020-02-09 02:00:14', '2020-02-09 02:00:14'),
(36, 'Edit All Grievance', 'web', '2020-02-17 08:05:48', '2020-02-17 08:05:48'),
(37, 'Delete Grievance', 'web', '2020-02-17 08:05:48', '2020-02-17 08:05:48'),
(38, 'Create Grievance Reports', 'web', '2020-02-17 08:05:48', '2020-02-17 08:05:48'),
(39, 'Edit Application Setting', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(40, 'Create Grievance Master Data', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(41, 'Edit Grievance Master Data', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(42, 'Delete Grievance Master Data', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(43, 'Create Bulletin Board', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(44, 'Edit Bulletin Board', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(45, 'Delete Bulletin Board', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(46, 'Create Manual Grievance', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(47, 'Edit Grievance', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(48, 'Process Grievance', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(49, 'Comment Grievance', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32'),
(50, 'Create Reports', 'web', '2020-02-17 01:32:32', '2020-02-17 01:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province_name`, `created_at`, `updated_at`) VALUES
(1, 'Aceh', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(2, 'Bali', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(3, 'Bangka Belitung', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(4, 'Banten', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(5, 'Bengkulu', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(6, 'Gorontalo', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(7, 'Jakarta', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(8, 'Jambi', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(9, 'Jawa Barat', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(10, 'Jawa Tengah', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(11, 'Jawa Timur', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(12, 'Kalimantan Barat', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(13, 'Kalimantan Selatan', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(14, 'Kalimantan Tengah', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(15, 'Kalimantan Timur', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(16, 'Kalimantan Utara', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(17, 'Kepulauan Riau', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(18, 'Lampung', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(19, 'Maluku Utara', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(20, 'Maluku', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(21, 'Nusa Tenggara Barat', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(22, 'Nusa Tenggara Timur', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(23, 'Papua Barat', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(24, 'Papua', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(25, 'Riau', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(26, 'Sulawesi Selatan', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(27, 'Sulawesi Tengah', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(28, 'Sulawesi Tenggara', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(29, 'Sulawesi Utara', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(30, 'Sumatra Barat', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(31, 'Sumatra Selatan', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(32, 'Sumatra Utara', '2020-02-20 04:06:23', '2020-02-20 04:06:23'),
(33, 'Yogyakarta', '2020-02-20 04:06:23', '2020-02-20 04:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `reimburs_types`
--

CREATE TABLE `reimburs_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reimburs_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reimburs_types`
--

INSERT INTO `reimburs_types` (`id`, `reimburs_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Uang Bensin', '06b92448-2215-4dd3-b439-687e86381f95', NULL, '2021-01-20 19:42:37', '2021-01-20 19:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', 'web', '2020-01-31 02:39:05', '2020-01-31 02:39:05'),
(3, 'HR Officer', 'web', '2020-02-09 17:41:40', '2020-02-09 17:41:40'),
(4, 'Director', 'web', '2020-02-10 02:53:48', '2020-02-10 02:53:48'),
(5, 'Finance', 'web', '2021-01-15 16:09:11', '2021-01-15 16:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(2, 3),
(2, 4),
(3, 2),
(3, 4),
(4, 2),
(4, 4),
(4, 5),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(13, 5),
(14, 2),
(14, 5),
(15, 2),
(15, 5),
(16, 2),
(16, 3),
(17, 2),
(17, 3),
(18, 2),
(19, 2),
(20, 2),
(20, 3),
(21, 2),
(21, 3),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(24, 2),
(25, 2),
(26, 2),
(26, 3),
(27, 2),
(28, 2),
(28, 4),
(29, 2),
(29, 4),
(30, 2),
(30, 3),
(31, 2),
(31, 3),
(32, 2),
(33, 2),
(34, 2),
(34, 3),
(34, 4),
(45, 4),
(46, 4),
(48, 4),
(50, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
('04bab8fc-d977-4469-adde-7c123c953848', 'Integrity and Transparancy', '2020-02-07 01:11:25', '2020-02-07 01:11:25'),
('04d751d7-6da3-4a0f-b561-7dd3fefe6915', 'Collaboration', '2020-02-07 01:11:25', '2020-02-07 01:11:25'),
('053b307f-8157-4adf-aa3b-c92903bf9007', 'On Leave', '2020-02-03 18:14:25', '2020-02-03 18:14:25'),
('085a1099-2a05-4fd7-8019-242c2ac87a0f', 'Leave Reduction', '2020-03-07 14:42:44', '2020-03-07 14:42:44'),
('13ca0601-de87-4d58-8ccd-d1f01dba78d8', 'Active', '2020-01-30 07:35:18', '2020-01-30 07:35:18'),
('1576a2f1-4b5d-433e-b022-39fe930cc1f8', 'Inactive', '2020-03-07 14:55:45', '2020-03-07 14:55:45'),
('16f30bee-5db5-472d-b297-926f5c8e4d21', 'Published', '2020-02-03 01:38:38', '2020-02-03 01:38:38'),
('1f2967a5-9a88-4d44-a66b-5339c771aca0', 'Submitted', '2020-02-02 21:05:27', '2020-02-02 21:05:27'),
('1f698ac5-9340-4223-a870-a79e6562fb5b', 'Resign', '2021-01-15 15:51:49', '2021-01-15 15:51:49'),
('2207ac0e-71a0-41ae-897b-b49efb016d6e', 'Available', '2020-02-03 18:14:25', '2020-02-03 18:14:25'),
('2dc764a0-f110-4985-922d-0ffb81363899', 'Attendance Out', '2020-02-02 17:39:22', '2020-02-02 17:39:22'),
('2e9731fd-6544-44a1-b832-aab293e8804a', 'Permanent', '2020-02-03 18:33:50', '2020-02-03 18:33:50'),
('33486784-509a-45bc-9833-b021ad5d4441', '1 Year Contract', '2020-02-05 22:16:12', '2020-02-05 22:16:12'),
('389c150b-01d4-4b07-8c65-aacd1cec7946', 'Orientation to learning and sharing knowledge', '2020-02-07 01:11:25', '2020-02-07 01:11:25'),
('663c8ca5-206f-4426-a1c5-610f903eb142', '6 Month Probation', '2020-02-05 22:16:12', '2020-02-05 22:16:12'),
('67bb8175-d7c2-430f-a8b0-382aee2fa33f', 'Attendance Incomplete', '2020-02-02 17:39:22', '2020-02-02 17:39:22'),
('6840ffe5-600b-4109-8abf-819bf77b24cf', 'Rejected', '2020-02-02 19:10:49', '2020-02-02 19:10:49'),
('6a787298-14f6-4d19-a7ee-99a3c8ed6466', 'Closed', '2020-02-03 01:38:38', '2020-02-03 01:38:38'),
('6a792ef2-9002-414e-80f6-05f01adc3875', '3 Month Probation', '2020-02-05 22:16:12', '2020-02-05 22:16:12'),
('81828ad9-fea7-41ff-b6d2-769fbc47c3fa', 'Depreciation', '2020-03-10 18:21:13', '2020-03-10 18:21:13'),
('97904ce7-87e2-4c61-b16e-c52a3c9f8b6d', 'Complete', '2020-02-01 20:23:42', '2020-02-01 20:23:42'),
('99d1e6f4-51be-4fef-a82f-16b86ca9f086', 'End of Life Value', '2020-03-10 18:21:13', '2020-03-10 18:21:13'),
('a8e93354-3040-45c0-aace-4484919bbfa5', 'Responded', '2020-02-02 21:05:27', '2020-02-02 21:05:27'),
('ac349559-1e12-4f1c-95be-1fd8d55b84a0', 'Takes responsibility for performance', '2020-02-07 01:11:25', '2020-02-07 01:11:25'),
('b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be', 'Requested', '2020-02-02 19:10:49', '2020-02-02 19:10:49'),
('bca5aaf9-c7ff-4359-9d6c-28768981b416', 'Suspend', '2020-01-30 07:35:18', '2020-01-30 07:35:18'),
('c0bfb25c-b965-4972-95fd-ed5803318d93', 'Contract', '2020-02-03 18:33:50', '2020-02-03 18:33:50'),
('c0c2bde9-b149-489c-9e0d-a10e4d2fd661', 'On Going', '2020-02-01 20:23:42', '2020-02-01 20:23:42'),
('c64ca24c-78c6-4026-ac65-e6dc3de288ac', 'Propose', '2020-02-01 20:23:42', '2020-02-01 20:23:42'),
('c6d904f6-8eb5-4085-81ce-f6e69aa8162e', 'No Reduction', '2020-03-07 14:42:44', '2020-03-07 14:42:44'),
('ca52a2ce-5c37-48ce-a7f2-0fd5311860c2', 'Approved', '2020-02-02 19:10:49', '2020-02-02 19:10:49'),
('caf3f6a0-3aef-4984-8a87-1684579c5e45', 'Completed', '2020-02-10 15:13:31', '2020-02-10 15:13:31'),
('d5ffb222-419f-4f4f-a968-1677d08617ca', 'Client Orientation', '2020-02-07 01:11:25', '2020-02-07 01:11:25'),
('e6cb9165-131e-406c-81c8-c2ba9a2c567e', 'Unreconcile', '2020-02-17 22:33:20', '2020-02-17 22:33:20'),
('edcb2ad8-df07-4854-8260-383aaec4a061', 'Checked', '2020-03-01 02:17:49', '2020-03-01 02:17:49'),
('f4f23f41-0588-4111-a881-a043cf355831', 'Attendance In', '2020-02-02 17:39:22', '2020-02-02 17:39:22'),
('f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6', 'Reconcile', '2020-02-17 22:33:20', '2020-02-17 22:33:20'),
('fe6f8153-a433-4a4d-a23d-201811778733', 'Open', '2020-02-03 15:55:27', '2020-02-03 15:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `target_data`
--

CREATE TABLE `target_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `target_id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_base`
--

CREATE TABLE `tax_base` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_limit` decimal(50,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_base`
--

INSERT INTO `tax_base` (`id`, `tax_code`, `amount_limit`, `created_at`, `updated_at`) VALUES
(1, 'S0', '54000000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(2, 'S1', '58500000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(3, 'S2', '63000000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(4, 'S3', '67500000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(5, 'M0', '58500000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(6, 'M1', '63000000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(7, 'M2', '67500000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02'),
(8, 'M3', '72000000.00', '2020-02-04 00:58:02', '2020-02-04 00:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_comments`
--

CREATE TABLE `transaction_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '13ca0601-de87-4d58-8ccd-d1f01dba78d8',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lockout_time` int(11) NOT NULL DEFAULT 30,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `name`, `email`, `email_verified_at`, `password`, `status_id`, `avatar`, `lockout_time`, `last_login_at`, `last_login_from`, `remember_token`, `created_at`, `updated_at`) VALUES
('06b92448-2215-4dd3-b439-687e86381f95', NULL, 'Eko Heru', 'eko@local.com', NULL, '$2y$10$KrqpddH7pt3whuMIfRzgL.g4KAiv47s34q0SycNFJo2hpASK6sBr2', '13ca0601-de87-4d58-8ccd-d1f01dba78d8', NULL, 30, '2021-01-21 23:49:49', '127.0.0.1', NULL, '2020-12-20 19:28:36', '2021-01-21 16:49:49'),
('17882d09-40e3-4159-a8e3-4792e105d983', '5a0a6dcd-4b9a-47fc-ab5c-094f17403f73', 'Heru Wibowo', 'heru@local.com', NULL, '$2y$10$Ugyz.jLz0vul3hW/xj4p/epfcLePPiuvAs5lromqnxytU.J/R7LLy', '13ca0601-de87-4d58-8ccd-d1f01dba78d8', 'A00001.jpg', 30, '2021-01-21 02:12:14', '127.0.0.1', NULL, '2021-01-15 15:49:18', '2021-01-20 19:12:14'),
('b5201a49-efb0-436a-90a6-14f3bf42d488', '55efdc6c-4253-47ef-adf1-b82c578d8731', 'John Doe', 'john@local.com', NULL, '$2y$10$i4y1uPbX01bhBP2UQj7LPuK5Uy5wdl.jvzVs3DT5gEeJhKjznQN/W', '13ca0601-de87-4d58-8ccd-d1f01dba78d8', 'A00003.jpg', 30, '2021-01-17 23:09:05', '127.0.0.1', NULL, '2021-01-15 16:04:59', '2021-01-17 16:09:05'),
('c0999cc4-c18d-4f1b-a3ba-aab04cafa08e', '907d17c4-bb3a-4cf6-b123-a93c5d698557', 'Rob Reiner', 'rob@local.com', NULL, '$2y$10$s/19L.XYjOlm/btZ.Ow7FuoRcQ9WzkG7rfBPTTtNqB42wPqUDJ1Gq', '13ca0601-de87-4d58-8ccd-d1f01dba78d8', 'A00002.jpg', 30, '2021-01-21 02:45:08', '127.0.0.1', NULL, '2021-01-15 16:02:25', '2021-01-20 19:45:08'),
('cfe7d210-466c-4390-8974-1a517cbfd29e', '19c7f01c-cfec-46a2-bb17-633fa7e82a82', 'Jack Lone', 'jack@local.com', NULL, '$2y$10$bFcAvehJ7SbkHVrTxAo7..Jn9p38xBu2bZgBJhtUnVC3T1N4wQ56.', '13ca0601-de87-4d58-8ccd-d1f01dba78d8', 'A00004.jpg', 30, '2021-01-15 23:09:40', '127.0.0.1', NULL, '2021-01-15 16:06:10', '2021-01-15 16:09:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_statements`
--
ALTER TABLE `account_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_additional_roles`
--
ALTER TABLE `appraisal_additional_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appraisal_additional_roles_appraisal_id_foreign` (`appraisal_id`);

--
-- Indexes for table `appraisal_comments`
--
ALTER TABLE `appraisal_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appraisal_comments_appraisal_id_foreign` (`appraisal_id`);

--
-- Indexes for table `appraisal_data`
--
ALTER TABLE `appraisal_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appraisal_data_appraisal_id_foreign` (`appraisal_id`);

--
-- Indexes for table `appraisal_soft_goals`
--
ALTER TABLE `appraisal_soft_goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appraisal_soft_goals_appraisal_id_foreign` (`appraisal_id`);

--
-- Indexes for table `appraisal_targets`
--
ALTER TABLE `appraisal_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appraisal_targets_data_id_foreign` (`data_id`);

--
-- Indexes for table `asset_categories`
--
ALTER TABLE `asset_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_depreciations`
--
ALTER TABLE `asset_depreciations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_depreciations_asset_id_foreign` (`asset_id`);

--
-- Indexes for table `asset_managements`
--
ALTER TABLE `asset_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_transactions`
--
ALTER TABLE `attendance_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_transactions_attendance_id_foreign` (`attendance_id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_statements`
--
ALTER TABLE `bank_statements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_statements_bank_account_id_foreign` (`bank_account_id`);

--
-- Indexes for table `budget_details`
--
ALTER TABLE `budget_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_details_budget_id_foreign` (`budget_id`);

--
-- Indexes for table `budget_periods`
--
ALTER TABLE `budget_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulletins`
--
ALTER TABLE `bulletins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_province_id_foreign` (`province_id`);

--
-- Indexes for table `coa_categories`
--
ALTER TABLE `coa_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depreciation_methods`
--
ALTER TABLE `depreciation_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_categories`
--
ALTER TABLE `document_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_degree`
--
ALTER TABLE `education_degree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `employee_appraisals`
--
ALTER TABLE `employee_appraisals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_appraisals_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_education`
--
ALTER TABLE `employee_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_education_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_families`
--
ALTER TABLE `employee_families`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_families_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_grievances`
--
ALTER TABLE `employee_grievances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_grievances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_leaves_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_positions`
--
ALTER TABLE `employee_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_reimbursments`
--
ALTER TABLE `employee_reimbursments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_reimbursments_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_services`
--
ALTER TABLE `employee_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_services_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_trainings`
--
ALTER TABLE `employee_trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_trainings_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `grievance_categories`
--
ALTER TABLE `grievance_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grievance_comments`
--
ALTER TABLE `grievance_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grievance_comments_grievance_id_foreign` (`grievance_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_entries_account_statement_id_foreign` (`account_statement_id`);

--
-- Indexes for table `knowledge_bases`
--
ALTER TABLE `knowledge_bases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_transactions`
--
ALTER TABLE `leave_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_transactions_leave_id_foreign` (`leave_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
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
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reimburs_types`
--
ALTER TABLE `reimburs_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_data`
--
ALTER TABLE `target_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target_data_target_id_foreign` (`target_id`);

--
-- Indexes for table `tax_base`
--
ALTER TABLE `tax_base`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_comments`
--
ALTER TABLE `transaction_comments`
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
-- AUTO_INCREMENT for table `appraisal_additional_roles`
--
ALTER TABLE `appraisal_additional_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_comments`
--
ALTER TABLE `appraisal_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_data`
--
ALTER TABLE `appraisal_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_soft_goals`
--
ALTER TABLE `appraisal_soft_goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_targets`
--
ALTER TABLE `appraisal_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_depreciations`
--
ALTER TABLE `asset_depreciations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_transactions`
--
ALTER TABLE `attendance_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_statements`
--
ALTER TABLE `bank_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `budget_details`
--
ALTER TABLE `budget_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bulletins`
--
ALTER TABLE `bulletins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `coa_categories`
--
ALTER TABLE `coa_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `depreciation_methods`
--
ALTER TABLE `depreciation_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_categories`
--
ALTER TABLE `document_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education_degree`
--
ALTER TABLE `education_degree`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_education`
--
ALTER TABLE `employee_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_families`
--
ALTER TABLE `employee_families`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_positions`
--
ALTER TABLE `employee_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_services`
--
ALTER TABLE `employee_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_trainings`
--
ALTER TABLE `employee_trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grievance_categories`
--
ALTER TABLE `grievance_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grievance_comments`
--
ALTER TABLE `grievance_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `knowledge_bases`
--
ALTER TABLE `knowledge_bases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_transactions`
--
ALTER TABLE `leave_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reimburs_types`
--
ALTER TABLE `reimburs_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `target_data`
--
ALTER TABLE `target_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_base`
--
ALTER TABLE `tax_base`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction_comments`
--
ALTER TABLE `transaction_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appraisal_additional_roles`
--
ALTER TABLE `appraisal_additional_roles`
  ADD CONSTRAINT `appraisal_additional_roles_appraisal_id_foreign` FOREIGN KEY (`appraisal_id`) REFERENCES `employee_appraisals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appraisal_comments`
--
ALTER TABLE `appraisal_comments`
  ADD CONSTRAINT `appraisal_comments_appraisal_id_foreign` FOREIGN KEY (`appraisal_id`) REFERENCES `employee_appraisals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appraisal_data`
--
ALTER TABLE `appraisal_data`
  ADD CONSTRAINT `appraisal_data_appraisal_id_foreign` FOREIGN KEY (`appraisal_id`) REFERENCES `employee_appraisals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appraisal_soft_goals`
--
ALTER TABLE `appraisal_soft_goals`
  ADD CONSTRAINT `appraisal_soft_goals_appraisal_id_foreign` FOREIGN KEY (`appraisal_id`) REFERENCES `employee_appraisals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appraisal_targets`
--
ALTER TABLE `appraisal_targets`
  ADD CONSTRAINT `appraisal_targets_data_id_foreign` FOREIGN KEY (`data_id`) REFERENCES `appraisal_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_depreciations`
--
ALTER TABLE `asset_depreciations`
  ADD CONSTRAINT `asset_depreciations_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `asset_managements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance_transactions`
--
ALTER TABLE `attendance_transactions`
  ADD CONSTRAINT `attendance_transactions_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `employee_attendances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_statements`
--
ALTER TABLE `bank_statements`
  ADD CONSTRAINT `bank_statements_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `budget_details`
--
ALTER TABLE `budget_details`
  ADD CONSTRAINT `budget_details_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budget_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_appraisals`
--
ALTER TABLE `employee_appraisals`
  ADD CONSTRAINT `employee_appraisals_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  ADD CONSTRAINT `employee_attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_education`
--
ALTER TABLE `employee_education`
  ADD CONSTRAINT `employee_education_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_families`
--
ALTER TABLE `employee_families`
  ADD CONSTRAINT `employee_families_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_grievances`
--
ALTER TABLE `employee_grievances`
  ADD CONSTRAINT `employee_grievances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD CONSTRAINT `employee_leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_reimbursments`
--
ALTER TABLE `employee_reimbursments`
  ADD CONSTRAINT `employee_reimbursments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_services`
--
ALTER TABLE `employee_services`
  ADD CONSTRAINT `employee_services_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_trainings`
--
ALTER TABLE `employee_trainings`
  ADD CONSTRAINT `employee_trainings_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grievance_comments`
--
ALTER TABLE `grievance_comments`
  ADD CONSTRAINT `grievance_comments_grievance_id_foreign` FOREIGN KEY (`grievance_id`) REFERENCES `employee_grievances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `journal_entries_account_statement_id_foreign` FOREIGN KEY (`account_statement_id`) REFERENCES `account_statements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_transactions`
--
ALTER TABLE `leave_transactions`
  ADD CONSTRAINT `leave_transactions_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `employee_leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `target_data`
--
ALTER TABLE `target_data`
  ADD CONSTRAINT `target_data_target_id_foreign` FOREIGN KEY (`target_id`) REFERENCES `appraisal_targets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
