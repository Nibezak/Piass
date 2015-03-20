-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 17, 2015 at 11:09 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `piassstudent`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `descriptions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `levels` int(11) NOT NULL,
  `faculity_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `descriptions`, `levels`, `faculity_id`, `created_at`, `updated_at`) VALUES
(1, 'Planning ', 'Department of a) Education Planning and Management', 3, 1, '2015-03-09 18:28:25', '2015-03-10 05:38:49'),
(4, 'Computer Science', 'Department of Computer Science\r\n', 2, 3, '2015-03-09 19:01:27', '2015-03-16 19:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `department_module`
--

CREATE TABLE `department_module` (
  `department_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department_module`
--

INSERT INTO `department_module` (`department_id`, `module_id`) VALUES
(4, 6),
(4, 7),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `faculities`
--

CREATE TABLE `faculities` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculities`
--

INSERT INTO `faculities` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Education', 'Faculty of Education', '2015-03-09 18:27:44', '2015-03-09 18:07:48'),
(3, 'Pure Science', 'Faculity of Pure and Applied Science\r\n', '2015-03-09 18:09:13', '2015-03-09 18:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `fee_transactions`
--

CREATE TABLE `fee_transactions` (
`id` int(10) unsigned NOT NULL,
  `debit` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payslip_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `student_id` int(10) unsigned NOT NULL,
  `done_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fee_transactions`
--

INSERT INTO `fee_transactions` (`id`, `debit`, `credit`, `balance`, `description`, `payslip_number`, `receipt_number`, `date`, `student_id`, `done_by`, `created_at`, `updated_at`) VALUES
(5, 420000.00, 0.00, 420000.00, 'School Fees for year 1', '', '', '2015-03-06 08:12:19', 1, 1, '2015-03-06 08:12:19', '2015-03-06 08:12:19'),
(14, 0.00, 100000.00, 320000.00, 'Payment for the last term in the school', '123456789798', '', '2015-03-27 22:00:00', 1, 1, '2015-03-07 10:43:01', '2015-03-07 10:43:01'),
(15, 0.00, 10000.00, -10000.00, 'Fees for registration', '2134568792', '', '2015-03-06 22:00:00', 16, 1, '2015-03-07 10:47:48', '2015-03-07 10:47:48'),
(16, 0.00, 12000.00, 308000.00, 'Payment of the first Term for the academic year 2014', '12000', '', '2015-03-18 22:00:00', 1, 1, '2015-03-07 10:50:23', '2015-03-07 10:50:23'),
(19, 75000.00, 0.00, 383000.00, 'Registerd for 1 modules ', '', '', '0000-00-00 00:00:00', 1, 1, '2015-03-17 20:05:11', '2015-03-17 20:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
`id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `student_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `created_at`, `updated_at`, `name`, `student_id`) VALUES
(1, '2015-03-10 11:06:39', '2015-03-10 11:06:39', 'piass3.png', 18),
(2, '2015-03-10 11:06:40', '2015-03-10 11:06:40', 'piass2.png', 18),
(3, '2015-03-10 11:06:40', '2015-03-10 11:06:40', 'piass1.png', 18),
(4, '2015-03-10 11:09:43', '2015-03-10 11:09:43', 'piass3.png', 18),
(5, '2015-03-10 11:21:37', '2015-03-10 11:21:37', 'Statistics.png', 16),
(6, '2015-03-10 11:21:48', '2015-03-10 11:21:48', 'hugukamobile menu.png', 16),
(7, '2015-03-10 17:50:25', '2015-03-10 17:50:25', 'RecordFeesPerStudent.png', 1),
(8, '2015-03-10 17:50:25', '2015-03-10 17:50:25', 'FeesList.png', 1),
(9, '2015-03-10 17:50:26', '2015-03-10 17:50:26', 'Login.png', 1),
(10, '2015-03-14 18:54:24', '2015-03-14 18:54:24', '3633772.jpeg', 16);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Users', '{"users":1}', '2015-03-03 08:31:40', '2015-03-03 08:31:40'),
(2, 'Admins', '{"admin":1,"users":1}', '2015-03-03 08:31:40', '2015-03-03 08:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1),
('2015_01_14_053439_migration_sentinel_add_username', 1),
('2015_03_05_063758_create_students_table', 2),
('2015_03_06_071505_create_fee_transactions_table', 3),
('2015_03_07_205653_create_files_table', 4),
('2015_03_09_171518_create_faculities_table', 4),
('2015_03_09_171711_create_departments_table', 4),
('2015_03_09_171848_create_modules_table', 4),
('2015_03_09_174642_create_department_module_pivot_table', 4),
('2015_03_10_094708_create_student_educations_table', 5),
('2015_03_16_203940_create_student_modules_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `credits` int(11) NOT NULL,
  `credit_cost` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `department_level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `code`, `credits`, `credit_cost`, `amount`, `department_level`, `created_at`, `updated_at`) VALUES
(1, 'KNOWLEDGE OF THE HUMAN BEING\n', 'KHB101', 20, 5000, 100000.00, 1, '2015-03-09 21:49:01', '2015-03-09 21:49:01'),
(6, 'SOCIAL & HUMAN SCIENCES', 'SSH102', 20, 5000, 100000.00, 1, '2015-03-09 20:53:26', '2015-03-10 06:01:10'),
(7, 'MATHEMATICS AND STATISTICS', 'MAS103', 20, 5000, 100000.00, 1, '2015-03-09 20:54:05', '2015-03-09 20:54:05'),
(8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, '2015-03-10 06:20:08', '2015-03-10 06:20:08'),
(9, 'EDUCATION SECTOR SKILLS', 'ESK104', 20, 5000, 100000.00, 2, '2015-03-10 06:20:54', '2015-03-10 06:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
`id` int(10) unsigned NOT NULL,
  `names` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `martial_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NID` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `residence` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `names`, `DOB`, `gender`, `martial_status`, `NID`, `telephone`, `email`, `occupation`, `residence`, `nationality`, `father_name`, `mother_name`, `created_at`, `updated_at`) VALUES
(1, 'Kamaro Lambert', '2015-03-04 22:00:00', 'Male', 'Single', '1198980007884211', '0722123127', 'kamaroly@gmail.com', 'IT', 'Kigali', 'Rwanda', 'My Father', 'My Mother', '2015-03-05 07:06:45', '2015-03-07 20:51:43'),
(16, 'Nibeza Kevin', '1998-08-13 22:00:00', 'Male', 'Single', '1198980007884211', '0722821231', 'kamaroly@gmail.com', 'Social Studies', 'Kigali', 'Rwanda', 'Papa', 'Mama', '2015-03-05 08:46:30', '2015-03-07 10:46:00'),
(17, 'Undi muntu wiga', '1998-08-13 22:00:00', 'Male', 'Single', '1198980007884211', '0722821231', 'kamaroly@gmail.com', 'Social Studes', 'Kigali', 'Rwanda', 'Papa', 'Mama', '2015-03-05 08:46:49', '2015-03-05 09:52:56'),
(18, 'Bakomeza Mathias', '2015-03-18 22:00:00', 'Female', 'Married', '1198980007884212', '0788514836', 'Bakomeza@email.com', 'Driver', 'Kigali', 'Rwandan', 'Papa we', 'Mama we', '2015-03-05 09:08:33', '2015-03-05 09:08:33'),
(19, 'Kamaro Lambert', '2015-03-05 07:06:45', 'Male', 'Single', '1198980007884211', '0722123127', 'kamaroly@gmail.com', 'IT', 'Kigali', 'Rwanda', 'My Father', 'My Mother', '2015-03-05 07:06:45', '2015-03-05 09:36:11'),
(20, 'Bakomeza Mathias', '2015-03-18 22:00:00', 'Female', 'Married', '1198980007884212', '0788514836', 'Bakomeza@email.com', 'Driver', 'Kigali', 'Rwandan', 'Papa we', 'Mama we', '2015-03-05 09:08:33', '2015-03-05 20:27:18'),
(21, 'Bakomeza Mathias', '2015-03-18 22:00:00', 'Female', 'Married', '1198980007884212', '0788514836', 'Bakomeza@email.com', 'Driver', 'Kigali', 'Rwandan', 'Papa we', 'Mama we', '2015-03-05 09:08:33', '2015-03-05 09:08:33'),
(22, 'Kamaro Lambert', '2015-03-05 07:06:45', 'Male', 'Single', '1198980007884211', '0722123127', 'kamaroly@gmail.com', 'IT', 'Kigali', 'Rwanda', 'My Father', 'My Mother', '2015-03-05 07:06:45', '2015-03-05 09:36:11'),
(23, 'Bakomeza Mathias', '2015-03-18 22:00:00', 'Female', 'Married', '1198980007884212', '0788514836', 'Bakomeza@email.com', 'Driver', 'Kigali', 'Rwandan', 'Papa we', 'Mama we', '2015-03-05 09:08:33', '2015-03-05 09:08:33'),
(24, 'Bakomeza Mathias', '2015-03-18 22:00:00', 'Female', 'Married', '1198980007884212', '0788514836', 'Bakomeza@email.com', 'Driver', 'Kigali', 'Rwandan', 'Papa we', 'Mama we', '2015-03-05 09:08:33', '2015-03-05 09:08:33'),
(25, 'Munyeshuri Eric', '1998-08-13 22:00:00', 'Male', 'Married', '1198980007884211', '0722821231', 'kamaroly@gmail.com', 'COMPUTER SCIENTIST', 'KIGALI', 'Rwanda', 'Papa', 'Mama', '2015-03-05 08:46:30', '2015-03-05 20:27:43'),
(26, 'Bakomeza Mathias', '2015-03-18 22:00:00', 'Female', 'Married', '1198980007884212', '0788514836', 'Bakomeza@email.com', 'Driver', 'Kigali', 'Rwandan', 'Papa we', 'Mama we', '2015-03-05 09:08:33', '2015-03-05 09:08:33'),
(27, 'Umunyeshuri wundi', '1998-08-13 22:00:00', 'Male', 'Single', '1198980007884211', '0722821231', 'kamaroly@gmail.com', 'COMPUTER SCIENTIST', 'KIGALI', 'Rwanda', 'Papa', 'Mama', '2015-03-05 08:46:30', '2015-03-05 08:46:30'),
(29, 'Nibeza Kevin', '2015-03-16 22:00:00', 'Male', 'Single', '1198980007888554', '0722123456', 'kamaro@huguka.com', 'COMPUTER SCIENTIST', 'Kimisagara', 'Rwandan', 'Bakomeza', 'Mukarutabana', '2015-03-07 20:39:32', '2015-03-07 20:39:32'),
(41, 'Umwali', '2014-02-03 22:00:00', 'Female', 'Single', '1199280007884211', '0728303022', 'Umwali@gmail.com', 'Student', 'Kicukiro', 'Rwandese', 'Mathias', 'Appolinarie', '2015-03-10 09:52:34', '2015-03-10 09:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `student_educations`
--

CREATE TABLE `student_educations` (
`id` int(10) unsigned NOT NULL,
  `qualification` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `subjects` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `school_attended` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completion_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_modules`
--

CREATE TABLE `student_modules` (
`id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `credits` int(11) NOT NULL,
  `credit_cost` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `department_level` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_modules`
--

INSERT INTO `student_modules` (`id`, `student_id`, `module_id`, `name`, `code`, `credits`, `credit_cost`, `amount`, `department_level`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 6, 'SOCIAL & HUMAN SCIENCES', 'SSH102', 8, 5000, 40000.00, 1, 1, '2015-03-17 19:27:17', '2015-03-17 19:27:17'),
(3, 1, 7, 'MATHEMATICS AND STATISTICS', 'MAS103', 21, 5000, 105000.00, 1, 1, '2015-03-17 19:27:17', '2015-03-17 19:27:17'),
(4, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 19:59:33', '2015-03-17 19:59:33'),
(5, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 20:00:13', '2015-03-17 20:00:13'),
(6, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 20:01:16', '2015-03-17 20:01:16'),
(7, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 20:02:26', '2015-03-17 20:02:26'),
(8, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 20:03:11', '2015-03-17 20:03:11'),
(9, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 20:03:37', '2015-03-17 20:03:37'),
(10, 1, 8, 'BIOLOGY', 'BIO104', 15, 5000, 75000.00, 1, 1, '2015-03-17 20:05:11', '2015-03-17 20:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, NULL, 0, 0, 0, NULL, NULL, NULL),
(2, 2, NULL, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `username`) VALUES
(1, 'admin@admin.com', '$2y$10$rO92YirjqI3XH6EdJJj0X.TgqXCp7kohy8HSJK1YREbp34ztQeLum', NULL, 1, NULL, NULL, '2015-03-17 16:32:44', '$2y$10$.bkuO.fPEpkNdOHCp2jzyeJfsH34xQ5wdYVCVrIMb31cREvFkO65W', NULL, 'Kamaro', 'Lambert', '2015-03-03 08:31:40', '2015-03-17 16:32:44', 'admin'),
(2, 'user@user.com', '$2y$10$rt2zmrk/MgSDAt4INbhPReUO0dk3eN5nANpgXzFgOks7allynSuia', NULL, 1, NULL, NULL, '2015-03-10 17:47:32', '$2y$10$YHdiRnFDAzR2vUnWV/kKVOKKxOeOVmhSSfN00rxILN.k6bnjfYtzO', NULL, 'User', 'User', '2015-03-03 08:31:41', '2015-03-10 17:47:32', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`), ADD KEY `departments_faculity_id_foreign` (`faculity_id`);

--
-- Indexes for table `department_module`
--
ALTER TABLE `department_module`
 ADD KEY `department_module_department_id_index` (`department_id`), ADD KEY `department_module_module_id_index` (`module_id`);

--
-- Indexes for table `faculities`
--
ALTER TABLE `faculities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
 ADD PRIMARY KEY (`id`), ADD KEY `fee_transactions_student_id_foreign` (`student_id`), ADD KEY `fee_transactions_done_by_foreign` (`done_by`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_educations`
--
ALTER TABLE `student_educations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_modules`
--
ALTER TABLE `student_modules`
 ADD PRIMARY KEY (`id`), ADD KEY `student_modules_student_id_foreign` (`student_id`), ADD KEY `student_modules_module_id_foreign` (`module_id`), ADD KEY `student_modules_user_id_foreign` (`user_id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
 ADD PRIMARY KEY (`id`), ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD UNIQUE KEY `users_username_unique` (`username`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `faculities`
--
ALTER TABLE `faculities`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `student_educations`
--
ALTER TABLE `student_educations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_modules`
--
ALTER TABLE `student_modules`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
ADD CONSTRAINT `departments_faculity_id_foreign` FOREIGN KEY (`faculity_id`) REFERENCES `faculities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department_module`
--
ALTER TABLE `department_module`
ADD CONSTRAINT `department_module_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `department_module_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
ADD CONSTRAINT `fee_transactions_done_by_foreign` FOREIGN KEY (`done_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fee_transactions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_modules`
--
ALTER TABLE `student_modules`
ADD CONSTRAINT `student_modules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `student_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `student_modules_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
