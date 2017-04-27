-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 05:24 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `defttech_revenue`
--

-- --------------------------------------------------------

--
-- Table structure for table `deft_migrations`
--

DROP TABLE IF EXISTS `deft_migrations`;
CREATE TABLE `deft_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deft_migrations`
--

INSERT INTO `deft_migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2017_04_18_100910_create_revenues_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deft_password_resets`
--

DROP TABLE IF EXISTS `deft_password_resets`;
CREATE TABLE `deft_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deft_revenues`
--

DROP TABLE IF EXISTS `deft_revenues`;
CREATE TABLE `deft_revenues` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_for` date NOT NULL,
  `desktop_spend` double(8,2) NOT NULL,
  `desktop_mod` double(8,2) NOT NULL,
  `mobile_spend` double(8,2) NOT NULL,
  `mobile_mod` double(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deft_revenues`
--

INSERT INTO `deft_revenues` (`id`, `user_id`, `entry_for`, `desktop_spend`, `desktop_mod`, `mobile_spend`, `mobile_mod`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-04-02', 0.09, 0.13, 0.11, 0.13, 1, '2017-04-18 07:26:20', '2017-04-18 07:26:20'),
(2, 1, '2017-04-03', 0.13, 0.15, 0.38, 0.11, 1, '2017-04-18 07:33:15', '2017-04-18 07:33:15'),
(3, 1, '2017-04-04', 0.16, 0.16, 0.21, 0.27, 1, '2017-04-18 07:34:33', '2017-04-18 07:34:33'),
(4, 1, '2017-04-05', 0.20, 0.46, 0.21, 0.17, 1, '2017-04-18 07:35:03', '2017-04-18 07:35:03'),
(5, 1, '2017-04-06', 0.19, 0.17, 0.21, 0.17, 1, '2017-04-18 07:36:21', '2017-04-18 07:36:21'),
(6, 1, '2017-04-07', 0.19, 0.17, 0.21, 0.17, 1, '2017-04-18 07:37:13', '2017-04-18 07:37:13'),
(7, 1, '2017-04-08', 0.19, 0.17, 0.21, 0.17, 1, '2017-04-18 07:37:23', '2017-04-18 07:37:23'),
(8, 1, '2017-04-09', 0.26, 0.17, 0.33, 0.20, 1, '2017-04-18 07:37:40', '2017-04-18 07:37:40'),
(9, 1, '2017-04-10', 0.26, 0.17, 0.33, 0.22, 1, '2017-04-18 07:37:52', '2017-04-18 07:37:52'),
(10, 1, '2017-04-10', 0.26, 0.17, 0.33, 0.22, 1, '2017-04-18 08:18:59', '2017-04-18 08:18:59'),
(11, 1, '2017-04-10', 0.26, 0.17, 0.33, 0.22, 1, '2017-04-18 08:19:19', '2017-04-18 08:19:19'),
(12, 1, '2017-04-10', 0.26, 0.17, 0.33, 0.22, 1, '2017-04-18 08:20:47', '2017-04-18 08:20:47'),
(13, 1, '2017-04-15', 0.13, 0.11, 0.19, 0.24, 1, '2017-04-19 07:41:13', '2017-04-19 07:41:13'),
(14, 1, '2017-04-16', 0.13, 0.11, 0.19, 0.24, 1, '2017-04-19 07:45:16', '2017-04-19 07:45:16'),
(15, 1, '2017-04-17', 0.18, 0.22, 0.77, 1.34, 1, '2017-04-19 08:50:24', '2017-04-19 08:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `deft_users`
--

DROP TABLE IF EXISTS `deft_users`;
CREATE TABLE `deft_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deft_users`
--

INSERT INTO `deft_users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Almas', 'kutsnalmas@gmail.com', '$2y$10$VZ1k9vnww.zTpdbnL6z5iOVIttyxfoknzu5RGKyMDAd6X/jaFsUGi', 'MiGoPAX1d1uXjvUuN8vCiTb80fBWu2U5ejoVr0smqJukwDIiMD3hf5dA6t5z', '2017-04-18 07:24:13', '2017-04-18 07:24:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deft_migrations`
--
ALTER TABLE `deft_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deft_password_resets`
--
ALTER TABLE `deft_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `deft_revenues`
--
ALTER TABLE `deft_revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deft_users`
--
ALTER TABLE `deft_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deft_migrations`
--
ALTER TABLE `deft_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `deft_revenues`
--
ALTER TABLE `deft_revenues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `deft_users`
--
ALTER TABLE `deft_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
