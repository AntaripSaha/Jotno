-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 10:15 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jotno`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoinments`
--

CREATE TABLE `appoinments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appoinment_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appoinment_date` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('Pending','Confirm','Complete','Cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `payment_status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_initial_tests`
--

CREATE TABLE `appoinment_initial_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appoinment_id` bigint(20) UNSIGNED NOT NULL,
  `initial_test_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_notes`
--

CREATE TABLE `appoinment_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appoinment_id` bigint(20) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `type` enum('MA','DOCTOR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_infos`
--

CREATE TABLE `app_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fav` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_infos`
--

INSERT INTO `app_infos` (`id`, `logo`, `fav`, `footer_text`, `footer_logo`, `address`, `email`, `phone`, `facebook_url`, `twitter_url`, `linkedin_url`, `created_at`, `updated_at`) VALUES
(1, '16329929097eNjxHXB7bxM.jpg', '1634789084gGkG88oDH792.png', 'We are always ready to give you medical home service, Contact now to get any of your medical services at you home.', '1634789101BK7pexb65Ya1.png', 'uttara', 'info@jotno.xyz', '01715050507', 'https://zaman-it.com/', 'tw/jotno', 'in/jotno', NULL, '2021-10-21 08:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_models`
--

CREATE TABLE `blog_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('super_admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_models`
--

INSERT INTO `blog_models` (`id`, `title`, `description`, `slug`, `image`, `created_by`, `is_active`, `type`, `created_at`, `updated_at`) VALUES
(3, 'Blog 1', 'Blog 1', 'blog-1', '16347874602oMwlLLFzZh3.jpg', '1', 1, 'super_admin', '2021-10-21 03:37:40', '2021-10-21 03:37:40'),
(4, 'Blog 2', 'Blog 2', 'blog-2', '1634787476RqFWb9HTO5IM.jpg', '1', 1, 'super_admin', '2021-10-21 03:37:56', '2021-10-21 08:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `type`, `amount`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'MBBS', 1000, 1, '2021-09-23 03:12:38', '2021-09-23 03:33:15'),
(2, 'Consultant', 1000, 1, '2021-09-23 03:12:41', '2021-09-23 03:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `chief_complaints`
--

CREATE TABLE `chief_complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chief_complaints`
--

INSERT INTO `chief_complaints` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'BURST FRACTURE L1 L2', 1, NULL, NULL),
(2, 'BURST FRACTURE D12', 1, NULL, NULL),
(3, 'BILATERAL CERVICAL HIP', 1, NULL, NULL),
(4, 'BACK PAIN', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_forms`
--

INSERT INTO `contact_forms` (`id`, `name`, `email`, `phone`, `subject`, `message`, `reply`, `created_at`, `updated_at`) VALUES
(2, 'Md Sehirul Islam Rehi', 'mdsehirulislamrehi@gmail.com', '01858361812', 'XYZ', 'Hello', 'Thanks for with us', '2021-09-25 09:06:05', '2021-09-25 09:06:34'),
(3, 'Md Sehirul Islam Rehi', 'rehi.zamanit@gmail.com', '01858361812', 'XYZ', 'Hello', NULL, '2021-09-25 09:07:44', '2021-09-25 09:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Friday', NULL, NULL),
(2, 'Saturday', NULL, NULL),
(3, 'Sunday', NULL, NULL),
(4, 'Monday', NULL, NULL),
(5, 'Tuesday', NULL, NULL),
(6, 'Wednesday', NULL, NULL),
(7, 'Thursday', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `chamber` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speciality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `out` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `doctor_id`, `name`, `designation`, `chamber`, `location`, `email`, `phone`, `image`, `password`, `gender`, `degree`, `speciality`, `nid`, `in`, `out`, `is_available`, `is_active`, `month`, `year`, `charge_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'D-783172', 'Md Ferdous Khan', 'Cardiologist', 'Medi Aid Hospital', '70/C, Lake Circus, Kalabagan, Dolphin Goli, Mirpur Rd, Dhaka 1205', 'doctor-one@gmail.com', '01858361812', '16323676333rJRSqor6vf4.jpg', '$2y$10$6rdwbej462xu/eOP8ijf6.SemHE3CD27gWz7.O5ZksIeaIsSkDc0O', 'Male', 'MBBS', 'No', '769531659765495', '09:15', '21:15', 1, 1, '9', '2021', 1, 'Uxi5kESqvq0JX9lVo33RszwHlisH8BzSa8CryX6D2yPAIaFTbgiTW3IjTFHV', '2021-09-23 03:16:06', '2021-10-11 10:19:10'),
(2, 'D-43922', 'Md Tarif Khan', 'Cardiologist', 'Medi Aid Hospital', '70/C, Lake Circus, Kalabagan, Dolphin Goli, Mirpur Rd, Dhaka 1205', 'doctor-two@gmail.com', '01858361813', '16323676531Gp19JZTzPu3.jpg', '$2y$10$sJN8QIPyzqtLMdItlDM0FuBcFIlrG8kBE92iXs0CjrzfovABkfIqS', 'Male', '', NULL, NULL, '09:15', '21:15', 1, 1, '9', '2021', 2, 'xPPuvNZHpKmjvTzAo7zPx6ClZCpOgR6WK5JLA6Y0q3lX7lhZXXJNccNa1m6U', '2021-09-23 03:16:24', '2021-09-23 03:27:33'),
(3, 'D-645043', 'Md Sakib Khan', 'Cardiologist', 'Medi Aid Hospital', '70/C, Lake Circus, Kalabagan, Dolphin Goli, Mirpur Rd, Dhaka 1205', 'doctor-three@gmail.com', '01858361814', '1632367669eeFdvi8aUQ8e.jpg', '$2y$10$hCalIoDdLH5GSZxqnPzB0.vumyTK4JmQYN5KoUdPzg7prZFlLWudW', 'Male', '', NULL, NULL, '09:15', '21:15', 1, 1, '9', '2021', 2, '5LEzR0bSwzvMVZVTbVIxXMUxQFL7mojPTZN6SJzAc6i2cDo5sOSV9PSjsSvd', '2021-09-23 03:16:35', '2021-09-23 03:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_days`
--

CREATE TABLE `doctor_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_days`
--

INSERT INTO `doctor_days` (`id`, `doctor_id`, `day_id`, `created_at`, `updated_at`) VALUES
(13, 2, 3, '2021-09-23 03:27:33', '2021-09-23 03:27:33'),
(14, 2, 5, '2021-09-23 03:27:33', '2021-09-23 03:27:33'),
(15, 2, 7, '2021-09-23 03:27:33', '2021-09-23 03:27:33'),
(16, 3, 3, '2021-09-23 03:27:49', '2021-09-23 03:27:49'),
(17, 3, 5, '2021-09-23 03:27:49', '2021-09-23 03:27:49'),
(18, 3, 7, '2021-09-23 03:27:49', '2021-09-23 03:27:49'),
(34, 1, 3, '2021-10-16 06:00:25', '2021-10-16 06:00:25'),
(35, 1, 5, '2021-10-16 06:00:25', '2021-10-16 06:00:25'),
(36, 1, 7, '2021-10-16 06:00:25', '2021-10-16 06:00:25'),
(37, 1, 2, '2021-10-16 06:00:25', '2021-10-16 06:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satisfied_patient` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_per_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `title`, `sub_title`, `description`, `image`, `about_title`, `about_description`, `about_image`, `satisfied_patient`, `patient_per_year`, `created_at`, `updated_at`) VALUES
(1, 'Be Hear Healthy', 'Find The Best Medical Assistant Near By You.', 'We are always ready to give you medical home service, Contact now to get any of your medical services at you home.', '1632993001cuUTGZVq03AH.jpg', 'We are Achieve the Success of Medical Services', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1632993292QWfWyq7VP1pz.jpg', '1210', '100', NULL, '2021-09-30 09:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `initial_tests`
--

CREATE TABLE `initial_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `initial_tests`
--

INSERT INTO `initial_tests` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Weight', 1, '2021-09-23 03:28:45', '2021-09-23 03:28:45'),
(2, 'height', 1, '2021-09-23 03:28:52', '2021-09-23 03:28:52'),
(3, 'Temp', 1, '2021-09-23 03:28:58', '2021-09-23 03:28:58'),
(4, 'BP', 1, '2021-09-23 03:29:04', '2021-09-23 03:29:04'),
(5, 'Pulse', 1, '2021-09-23 03:29:08', '2021-09-23 03:29:08'),
(6, 'BMI', 1, '2021-09-23 03:29:12', '2021-09-23 03:29:12'),
(7, 'BSA', 1, '2021-09-23 03:29:16', '2021-09-23 03:29:16'),
(8, 'RR', 1, '2021-09-23 03:29:19', '2021-09-23 03:29:19'),
(9, 'SPO2', 1, '2021-09-23 03:29:26', '2021-09-23 03:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `medical_assistants`
--

CREATE TABLE `medical_assistants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medical_assistant_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bmdc_reg_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_assistants`
--

INSERT INTO `medical_assistants` (`id`, `medical_assistant_id`, `name`, `email`, `phone`, `image`, `password`, `is_active`, `month`, `year`, `present_address`, `permanent_address`, `nid`, `bmdc_reg_no`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'M-163343', 'Md Roni Ahmed', 'assistant-one@gmail.com', '01858361812', NULL, '$2y$10$D45YeZQIWS3ZpGwhRzPt3O63mLgf/mh2c1MrHivjbPqfPxTmWww4q', 1, '9', '2021', 'Mohakhali tb gate', 'Mohakhali tb gate', '1', '1', 'f6iLVpKnwc9cDDE91xMxeIEBY6sAVM6l275xXdZ2NRXmrvYjB6km8Vl5U0qm', '2021-09-23 03:17:22', '2021-10-11 10:59:21'),
(2, 'M-528376', 'Md Karim Ahmed', 'assistant-two@gmail.com', '01858361813', NULL, '$2y$10$HKNU/xBLNxO/S41HTyAR4OW4Q3E1TUkv/q5PO0ISkjFq7yqV2dUCu', 1, '9', '2021', '', '', '2', '2', 'RRZvWiIphTOUQbiRCSY4dUTs7zo0OSTL0c5l6dnMAdHfeBb7X7Lij5nIPRhI', '2021-09-23 03:17:38', '2021-09-23 03:17:38'),
(3, 'M-747088', 'Md Nur Ahmed', 'assistant-three@gmail.com', '01858361814', NULL, '$2y$10$I054rAqF1arZj8Yf59vDJOmevaffHGwCc3os2i/Qu84ejlGVgzxiC', 1, '9', '2021', 'Mohakhali tb gate', 'Sylhet', '4561515', '12313212', NULL, '2021-09-23 03:17:48', '2021-10-11 10:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ACIFIX', 'acifix', 1, '2021-09-23 03:23:28', '2021-09-23 03:23:28'),
(2, 'ALSTOMIN', 'alstomin', 1, '2021-09-23 03:23:33', '2021-09-23 03:23:33'),
(3, 'ALOXIF', 'aloxif', 1, '2021-09-23 03:23:39', '2021-09-23 03:23:39'),
(4, 'ALEN-D', 'alen-d', 1, '2021-09-23 03:23:45', '2021-09-23 03:23:45'),
(5, 'AFUN VT', 'afun-vt', 1, '2021-09-23 03:23:51', '2021-09-23 03:23:51'),
(6, 'AD-ALL', 'ad-all', 1, '2021-09-23 03:23:57', '2021-09-23 03:23:57'),
(7, 'ALNEED Plus', 'alneed-plus', 1, '2021-09-23 03:24:03', '2021-09-23 03:24:03'),
(8, 'ACTONEL', 'actonel', 1, '2021-09-23 03:24:09', '2021-09-23 03:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_24_161700_create_modules_table', 1),
(5, '2021_04_24_161711_create_permissions_table', 1),
(6, '2021_04_24_161719_create_permission_roles_table', 1),
(7, '2021_04_24_161733_create_roles_table', 1),
(8, '2021_04_24_161742_create_sub_modules_table', 1),
(9, '2021_04_24_161757_create_super_admins_table', 1),
(11, '2021_08_21_095520_create_medical_assistants_table', 1),
(12, '2021_08_21_095613_create_charges_table', 1),
(13, '2021_08_21_095614_create_doctors_table', 1),
(14, '2021_08_21_095620_create_patients_table', 1),
(15, '2021_08_21_112630_create_test_types_table', 1),
(16, '2021_08_21_112641_create_test_type_lists_table', 1),
(17, '2021_08_23_060244_create_appoinments_table', 1),
(18, '2021_08_28_055503_create_medicines_table', 1),
(19, '2021_08_31_065717_create_appoinment_notes_table', 1),
(20, '2021_09_04_035504_create_initial_tests_table', 1),
(21, '2021_09_04_040409_create_timings_table', 1),
(22, '2021_09_06_093916_create_prescriptions_table', 1),
(23, '2021_09_06_093925_create_prescription_medicines_table', 1),
(24, '2021_09_06_093932_create_prescription_reports_table', 1),
(25, '2021_09_06_093939_create_prescription_tests_table', 1),
(26, '2021_09_06_110147_create_days_table', 1),
(27, '2021_09_06_111100_create_doctor_days_table', 1),
(28, '2021_09_12_101320_create_appoinment_initial_tests_table', 1),
(29, '2021_09_21_101707_create_banners_table', 1),
(30, '2021_09_22_143937_create_contact_forms_table', 1),
(31, '2021_09_27_170000_create_homes_table', 2),
(32, '2021_09_27_170727_create_qualities_table', 2),
(33, '2021_09_29_155554_create_new_pages_table', 2),
(34, '2021_08_19_102916_create_app_infos_table', 3),
(35, '2021_10_16_115536_create_chief_complaints_table', 4),
(36, '2021_10_16_121250_create_prescription_chief_complaints_table', 5),
(37, '2021_10_12_172150_create_blog_models_table', 6),
(38, '2021_10_16_115830_create_services_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `key`, `icon`, `position`, `route`, `created_at`, `updated_at`) VALUES
(1, 'User Module', 'user_module', 'fas fa-users', '1', NULL, NULL, NULL),
(2, 'Setting Module', 'settings', 'fas fa-cog', '6', NULL, NULL, NULL),
(3, 'Test Module', 'test_module', 'fas fa-vial', '2', NULL, NULL, NULL),
(4, 'Appointment Module', 'appointment', 'far fa-calendar-check', '3', NULL, NULL, NULL),
(5, 'Apps Module', 'apps', 'fas fa-mobile-alt', '4', NULL, NULL, NULL),
(6, 'Contact Module', 'all_messege', 'far fa-address-book', '5', NULL, NULL, NULL),
(7, 'All Page Module', 'all_pages', 'fas fa-file', '7', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `new_pages`
--

CREATE TABLE `new_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_pages`
--

INSERT INTO `new_pages` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', '<p><span style=\"color: rgb(116, 116, 116); font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif; font-size: 14px; letter-spacing: -0.144px; text-align: left; background-color: rgb(255, 255, 255)\">What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</span><br /></p>\r\n<p><span style=\"color: rgb(116, 116, 116); font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif; font-size: 14px; letter-spacing: -0.144px; text-align: left; background-color: rgb(255, 255, 255)\"><br /></span></p>\r\n<div style=\"text-align: center;\"><img style=\"max-width: 80%;\" src=\"data:image/png;base64,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\" /></div>', '2021-09-30 09:17:45', '2021-10-16 09:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `blood_group` enum('A-','A+','B-','B+','AB-','AB+','O-','O+') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female','Others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_id`, `name`, `email`, `phone`, `date_of_birth`, `blood_group`, `gender`, `address`, `city`, `district`, `password`, `image`, `is_active`, `month`, `year`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'P-542400', 'Md Sehirul Islam Rehi', 'mdsehirulislamrehi@gmail.com', '01858361812', '2000-02-18', 'O+', 'Male', 'Mohakhali tb gate', 'Inside Dhaka', 'Dhaka', '$2y$10$iR8.JLMuNxTK0sj0tJgLpe61ooKLUGiTQx7aMb/DSnCpHXwVRtqKq', '1632367605PhFKyYlCoFhF.jpg', 1, '9', '2021', 'WOp5blNrZSoRIzr6RUOHSvbXaDTnR6dd34yeoxw9NZGcyWd1vFO7iMH5B8u4', '2021-09-23 03:18:27', '2021-09-23 03:26:45'),
(2, 'P-733831', 'Md Manirul Islam', 'manirul@gmail.com', '01608728677', '2021-09-23', 'O+', 'Male', 'Uttara', 'Dhaka', 'Dhaka', '$2y$10$sa9zI//Nerd6EVzp9QHIu.nX1J0BgiPOvvaL0ZQtXDmhsDpqa.2/i', '1632367620XirIeEflFPLG.jpg', 1, '9', '2021', 'npzgYdVR6usqNrXCMkaePtXSLeHmvXTzNlPbp81PYu9syxAolKNMqmPTOmOE', '2021-09-23 03:18:58', '2021-09-23 03:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `display_name`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 'user_module', 'User Module', 1, NULL, NULL),
(2, 'all_user', 'All User', 1, NULL, NULL),
(3, 'add_user', '-- Add User', 1, NULL, NULL),
(4, 'edit_user', '-- Edit User', 1, NULL, NULL),
(5, 'reset_password', '-- Reset Password', 1, NULL, NULL),
(6, 'settings', 'Setting Module', 2, NULL, NULL),
(7, 'app_info', '-- App Info', 2, NULL, NULL),
(8, 'test_module', 'Test Module', 3, NULL, NULL),
(9, 'all_test', 'All Test', 3, NULL, NULL),
(10, 'add_test', '-- Add Test', 3, NULL, NULL),
(11, 'edit_test', '-- Edit Test', 3, NULL, NULL),
(12, 'doctor', 'Doctor', 1, NULL, NULL),
(13, 'add_doctor', '-- Add Doctor', 1, NULL, NULL),
(14, 'edit_doctor', '-- Edit Doctor', 1, NULL, NULL),
(15, 'doctor_reset_password', '-- Reset Password', 1, NULL, NULL),
(16, 'view_doctor', '-- View Doctor', 1, NULL, NULL),
(17, 'medical_assistant', 'Medical Assistant', 1, NULL, NULL),
(18, 'add_medical_assistant', '-- Add Assistant', 1, NULL, NULL),
(19, 'edit_medical_assistant', '-- Edit Assistant', 1, NULL, NULL),
(20, 'medical_assistant_reset_password', '-- Reset Password', 1, NULL, NULL),
(21, 'medicine', 'All Medicine', 3, NULL, NULL),
(22, 'add_medicine', '-- Add Medicine', 3, NULL, NULL),
(23, 'edit_medicine', '-- Edit Medicine', 3, NULL, NULL),
(24, 'initial_test', 'All Initial Test', 3, NULL, NULL),
(25, 'add_initial_test', '-- Add Initial Test', 3, NULL, NULL),
(26, 'edit_initial_test', '-- Edit Initial Test', 3, NULL, NULL),
(27, 'patient', 'All Patient', 1, NULL, NULL),
(28, 'edit_patient', '-- Edit Patient', 1, NULL, NULL),
(29, 'patient_reset_password', '-- Reset Password', 1, NULL, NULL),
(30, 'appointment', 'Appointment Module', 4, NULL, NULL),
(31, 'all_appointment', '-- All Appointment', 4, NULL, NULL),
(32, 'apps', 'App Module', 5, NULL, NULL),
(33, 'all_banner', 'All Banner', 5, NULL, NULL),
(34, 'add_banner', '-- Add Banner', 5, NULL, NULL),
(35, 'edit_banner', '-- Edit Banner', 5, NULL, NULL),
(36, 'delete_banner', '-- Delete Banner', 5, NULL, NULL),
(37, 'all_messege', 'All Messege', 6, NULL, NULL),
(38, 'reply_messege', '-- Reply Messege', 6, NULL, NULL),
(39, 'delete_messege', '-- Delete Messege', 6, NULL, NULL),
(40, 'all_charge', 'All Charge', 4, NULL, NULL),
(41, 'add_charge', '-- Add Charge', 4, NULL, NULL),
(42, 'edit_charge', '-- Edit Charge', 4, NULL, NULL),
(43, 'all_pages', 'All Page', 7, NULL, NULL),
(44, 'home_page', '-- Home Page', 7, NULL, NULL),
(45, 'quality_page', '-- Quality Page', 7, NULL, NULL),
(46, 'new_page', '-- Create New Page', 7, NULL, NULL),
(47, 'all_blog', 'All Blog', 7, NULL, NULL),
(48, 'view_blog', '-- View Blog', 7, NULL, NULL),
(49, 'add_blog', '-- Add Blog', 7, NULL, NULL),
(50, 'edit_blog', '-- Edit Blog', 7, NULL, NULL),
(51, 'delete_blog', '-- Delete Blog', 7, NULL, NULL),
(52, 'service_page', '-- Create Service', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appoinment_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `type` enum('MA','Doctor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `advice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_chief_complaints`
--

CREATE TABLE `prescription_chief_complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `chief_complaint_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicines`
--

CREATE TABLE `prescription_medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Mark','OR','Drop') COLLATE utf8mb4_unicode_ci NOT NULL,
  `timing` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_reports`
--

CREATE TABLE `prescription_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_tests`
--

CREATE TABLE `prescription_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `test_type_id` bigint(20) UNSIGNED NOT NULL,
  `test_type_list` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE `qualities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualities`
--

INSERT INTO `qualities` (`id`, `position`, `image`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, '16329933656P5DRi2iZfMn.png', 'Personalized Healthcare', '2021-09-30 09:16:05', '2021-09-30 09:16:05'),
(2, 2, '1632993372uFJNLTFqiDq9.png', 'Professional Team', '2021-09-30 09:16:12', '2021-09-30 09:16:12'),
(4, 3, '1632993384rbdnfSfwvome.png', 'Latest Technology', '2021-09-30 09:16:24', '2021-09-30 09:16:24'),
(5, 4, '16329942472NKBI3gX76F3.png', 'Regularly checkup', '2021-09-30 09:30:47', '2021-09-30 09:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `is_active`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Service 1', '1634788569uWmtHvOJRyvb.jpg', 1, 2, '2021-10-21 03:56:09', '2021-10-21 03:58:06'),
(2, 'Service 2', '1634788617VqBqDNOnXskO.jpg', 1, 1, '2021-10-21 03:56:57', '2021-10-21 03:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `sub_modules`
--

CREATE TABLE `sub_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_modules`
--

INSERT INTO `sub_modules` (`id`, `name`, `key`, `position`, `route`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 'All User', 'all_user', '1', 'user.all', 1, NULL, NULL),
(2, 'Roles', 'roles', '2', 'role.all', 1, NULL, NULL),
(3, 'App Info', 'app_info', '1', 'app.info.all', 2, NULL, NULL),
(4, 'All Test', 'all_test', '1', 'test.all', 3, NULL, NULL),
(5, 'Doctor', 'doctor', '3', 'doctor.all', 1, NULL, NULL),
(6, 'Medical Assistant', 'medical_assistant', '4', 'medical_assistant.all', 1, NULL, NULL),
(7, 'All Medicine', 'medicine', '2', 'medicine.all', 3, NULL, NULL),
(8, 'All Initial Test', 'all_initial_test', '3', 'initial_test.all', 3, NULL, NULL),
(9, 'All Patient', 'patient', '5', 'patient.all', 1, NULL, NULL),
(10, 'All Appointment', 'all_appointment', '1', 'appointment.all', 4, NULL, NULL),
(11, 'All Charge', 'all_charge', '2', 'charge.all', 4, NULL, NULL),
(12, 'All Banner', 'all_banner', '1', 'banner.all', 5, NULL, NULL),
(13, 'All Messege', 'all_messege', '1', 'messege.all', 6, NULL, NULL),
(14, 'Home Page', 'home_page', '1', 'home.page', 7, NULL, NULL),
(15, 'Create New Page', 'new_page', '3', 'new.page', 7, NULL, NULL),
(16, 'Service Page', 'service_page', '2', 'all.service', 7, NULL, NULL),
(17, 'All Blog Page', 'all_blog', '4', 'blog.page', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `name`, `email`, `image`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', NULL, '1858361812', NULL, '$2y$10$3ML4e6egal8KScToIQZhS.sx5OnKWowsvEPEJsu3lV/zSvDHpeh/G', '1ah9o0hd1aAS979sdSKhnUu8NsjeOCd7tgg3kPrTPevefXvSdmHlFFJYcZ7X', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_types`
--

CREATE TABLE `test_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_types`
--

INSERT INTO `test_types` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Examination Finding', 'examination-finding', 1, '2021-09-23 03:21:37', '2021-09-23 03:22:32'),
(3, 'Clinical Diagnosis', 'clinical-diagnosis', 1, '2021-09-23 03:23:15', '2021-09-23 03:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `test_type_lists`
--

CREATE TABLE `test_type_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_type_lists`
--

INSERT INTO `test_type_lists` (`id`, `test_type_id`, `name`, `slug`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 2, 'ADAMS TEST (', 'adams-test', 500, 1, '2021-09-23 03:21:37', '2021-09-23 03:21:37'),
(9, 2, 'ANT. DRAWER TEST POSITIVE RIGHT', 'ant-drawer-test-positive-right', 400, 1, '2021-09-23 03:21:37', '2021-09-23 03:21:37'),
(10, 2, 'Active ROM of R Elbow- Flexion-67  deg      ;Extension- 155 deg', 'active-rom-of-r-elbow-flexion-67-deg-extension-155-deg', 1800, 1, '2021-09-23 03:21:37', '2021-09-23 03:21:37'),
(12, 2, 'ASOM RT', 'asom-rt', 500, 1, '2021-09-23 03:22:32', '2021-09-23 03:22:32'),
(13, 2, 'ASOM Lt', 'asom-lt', 3600, 1, '2021-09-23 03:22:32', '2021-09-23 03:22:32'),
(14, 3, 'ACL INJURY', 'acl-injury', 2400, 1, '2021-09-23 03:23:15', '2021-09-23 03:23:15'),
(15, 3, 'ACL MEDIAL MENISCUS INJURY LEFT KNEE', 'acl-medial-meniscus-injury-left-knee', 3500, 1, '2021-09-23 03:23:15', '2021-09-23 03:23:15'),
(16, 3, 'ANKLE SPRAIN LEFT', 'ankle-sprain-left', 9000, 1, '2021-09-23 03:23:15', '2021-09-23 03:23:15'),
(17, 3, 'AIS WITH COXANGLE 50*', 'ais-with-coxangle-50', 1400, 1, '2021-09-23 03:23:15', '2021-09-23 03:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

CREATE TABLE `timings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Morning','Noon','Night','Time','Running') COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` enum('Mark','Drop') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timings`
--

INSERT INTO `timings` (`id`, `value`, `type`, `group`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '0', 'Morning', 'Mark', 1, NULL, NULL),
(2, '1', 'Morning', 'Mark', 1, NULL, NULL),
(3, '2', 'Morning', 'Mark', 1, NULL, NULL),
(4, '0', 'Noon', 'Mark', 1, NULL, NULL),
(5, '1', 'Noon', 'Mark', 1, NULL, NULL),
(6, '2', 'Noon', 'Mark', 1, NULL, NULL),
(7, '0', 'Night', 'Mark', 1, NULL, NULL),
(8, '1', 'Night', 'Mark', 1, NULL, NULL),
(9, '2', 'Night', 'Mark', 1, NULL, NULL),
(10, 'Before Food', 'Time', 'Mark', 1, NULL, NULL),
(11, 'After Food', 'Time', 'Mark', 1, NULL, NULL),
(12, '0', 'Morning', 'Drop', 1, NULL, NULL),
(13, '1', 'Morning', 'Drop', 1, NULL, NULL),
(14, '2', 'Morning', 'Drop', 1, NULL, NULL),
(15, '0', 'Noon', 'Drop', 1, NULL, NULL),
(16, '1', 'Noon', 'Drop', 1, NULL, NULL),
(17, '2', 'Noon', 'Drop', 1, NULL, NULL),
(18, '0', 'Night', 'Drop', 1, NULL, NULL),
(19, '1', 'Night', 'Drop', 1, NULL, NULL),
(20, '2', 'Night', 'Drop', 1, NULL, NULL),
(21, 'Before Food', 'Time', 'Drop', 1, NULL, NULL),
(22, 'After Food', 'Time', 'Drop', 1, NULL, NULL),
(23, '1 Month', 'Running', NULL, 1, NULL, NULL),
(24, '2 Month', 'Running', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoinments`
--
ALTER TABLE `appoinments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appoinments_appoinment_no_unique` (`appoinment_no`),
  ADD KEY `appoinments_patient_id_foreign` (`patient_id`),
  ADD KEY `appoinments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `appoinment_initial_tests`
--
ALTER TABLE `appoinment_initial_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appoinment_initial_tests_appoinment_id_foreign` (`appoinment_id`),
  ADD KEY `appoinment_initial_tests_initial_test_id_foreign` (`initial_test_id`);

--
-- Indexes for table `appoinment_notes`
--
ALTER TABLE `appoinment_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appoinment_notes_appoinment_id_foreign` (`appoinment_id`);

--
-- Indexes for table `app_infos`
--
ALTER TABLE `app_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_position_unique` (`position`);

--
-- Indexes for table `blog_models`
--
ALTER TABLE `blog_models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_models_title_unique` (`title`),
  ADD UNIQUE KEY `blog_models_slug_unique` (`slug`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `charges_type_unique` (`type`);

--
-- Indexes for table `chief_complaints`
--
ALTER TABLE `chief_complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chief_complaints_name_unique` (`name`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `days_name_unique` (`name`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_doctor_id_unique` (`doctor_id`),
  ADD UNIQUE KEY `doctors_email_unique` (`email`),
  ADD UNIQUE KEY `doctors_phone_unique` (`phone`),
  ADD KEY `doctors_charge_id_foreign` (`charge_id`);

--
-- Indexes for table `doctor_days`
--
ALTER TABLE `doctor_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_days_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_days_day_id_foreign` (`day_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `initial_tests`
--
ALTER TABLE `initial_tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `initial_tests_name_unique` (`name`);

--
-- Indexes for table `medical_assistants`
--
ALTER TABLE `medical_assistants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medical_assistants_medical_assistant_id_unique` (`medical_assistant_id`),
  ADD UNIQUE KEY `medical_assistants_email_unique` (`email`),
  ADD UNIQUE KEY `medical_assistants_phone_unique` (`phone`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD UNIQUE KEY `bmdc_reg_no` (`bmdc_reg_no`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicines_name_unique` (`name`),
  ADD UNIQUE KEY `medicines_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_name_unique` (`name`),
  ADD UNIQUE KEY `modules_key_unique` (`key`),
  ADD UNIQUE KEY `modules_position_unique` (`position`);

--
-- Indexes for table `new_pages`
--
ALTER TABLE `new_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `new_pages_name_unique` (`name`),
  ADD UNIQUE KEY `new_pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_patient_id_unique` (`patient_id`),
  ADD UNIQUE KEY `patients_email_unique` (`email`),
  ADD UNIQUE KEY `patients_phone_unique` (`phone`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_key_unique` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prescriptions_prescription_no_unique` (`prescription_no`),
  ADD KEY `prescriptions_appoinment_id_foreign` (`appoinment_id`);

--
-- Indexes for table `prescription_chief_complaints`
--
ALTER TABLE `prescription_chief_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_chief_complaints_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_chief_complaints_chief_complaint_id_foreign` (`chief_complaint_id`);

--
-- Indexes for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_medicines_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_medicines_medicine_id_foreign` (`medicine_id`);

--
-- Indexes for table `prescription_reports`
--
ALTER TABLE `prescription_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_reports_prescription_id_foreign` (`prescription_id`);

--
-- Indexes for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_tests_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_tests_test_type_id_foreign` (`test_type_id`);

--
-- Indexes for table `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `position` (`position`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`),
  ADD UNIQUE KEY `services_position_unique` (`position`);

--
-- Indexes for table `sub_modules`
--
ALTER TABLE `sub_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_modules_name_unique` (`name`),
  ADD UNIQUE KEY `sub_modules_key_unique` (`key`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `super_admins_email_unique` (`email`);

--
-- Indexes for table `test_types`
--
ALTER TABLE `test_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_types_name_unique` (`name`),
  ADD UNIQUE KEY `test_types_slug_unique` (`slug`);

--
-- Indexes for table `test_type_lists`
--
ALTER TABLE `test_type_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_type_lists_name_unique` (`name`),
  ADD UNIQUE KEY `test_type_lists_slug_unique` (`slug`),
  ADD KEY `test_type_lists_test_type_id_foreign` (`test_type_id`);

--
-- Indexes for table `timings`
--
ALTER TABLE `timings`
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
-- AUTO_INCREMENT for table `appoinments`
--
ALTER TABLE `appoinments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appoinment_initial_tests`
--
ALTER TABLE `appoinment_initial_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appoinment_notes`
--
ALTER TABLE `appoinment_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_infos`
--
ALTER TABLE `app_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_models`
--
ALTER TABLE `blog_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chief_complaints`
--
ALTER TABLE `chief_complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_days`
--
ALTER TABLE `doctor_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `initial_tests`
--
ALTER TABLE `initial_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medical_assistants`
--
ALTER TABLE `medical_assistants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `new_pages`
--
ALTER TABLE `new_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescription_chief_complaints`
--
ALTER TABLE `prescription_chief_complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescription_reports`
--
ALTER TABLE `prescription_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_modules`
--
ALTER TABLE `sub_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_types`
--
ALTER TABLE `test_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test_type_lists`
--
ALTER TABLE `test_type_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `timings`
--
ALTER TABLE `timings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinments`
--
ALTER TABLE `appoinments`
  ADD CONSTRAINT `appoinments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appoinments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `appoinment_initial_tests`
--
ALTER TABLE `appoinment_initial_tests`
  ADD CONSTRAINT `appoinment_initial_tests_appoinment_id_foreign` FOREIGN KEY (`appoinment_id`) REFERENCES `appoinments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appoinment_initial_tests_initial_test_id_foreign` FOREIGN KEY (`initial_test_id`) REFERENCES `initial_tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appoinment_notes`
--
ALTER TABLE `appoinment_notes`
  ADD CONSTRAINT `appoinment_notes_appoinment_id_foreign` FOREIGN KEY (`appoinment_id`) REFERENCES `appoinments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_days`
--
ALTER TABLE `doctor_days`
  ADD CONSTRAINT `doctor_days_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_days_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_appoinment_id_foreign` FOREIGN KEY (`appoinment_id`) REFERENCES `appoinments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_chief_complaints`
--
ALTER TABLE `prescription_chief_complaints`
  ADD CONSTRAINT `prescription_chief_complaints_chief_complaint_id_foreign` FOREIGN KEY (`chief_complaint_id`) REFERENCES `chief_complaints` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_chief_complaints_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  ADD CONSTRAINT `prescription_medicines_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_medicines_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_reports`
--
ALTER TABLE `prescription_reports`
  ADD CONSTRAINT `prescription_reports_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD CONSTRAINT `prescription_tests_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_tests_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_type_lists`
--
ALTER TABLE `test_type_lists`
  ADD CONSTRAINT `test_type_lists_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
