-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2018 at 11:53 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crawler`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Category Name 1', NULL),
(2, 'Category 2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `pubDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sourceOfNews` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_websites`
--

CREATE TABLE `detail_websites` (
  `id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `containerTag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleTag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptionTag` text COLLATE utf8mb4_unicode_ci,
  `pubDateTag` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_websites`
--

INSERT INTO `detail_websites` (`id`, `website_id`, `containerTag`, `titleTag`, `descriptionTag`, `pubDateTag`, `active`) VALUES
(4, 1, '.list_news', '.title_news > a', '.description', NULL, 1),
(8, 2, '.dot-brdr', '.caption-ucan > h3 > a', '.caption-ucan > p + p', '.date-indo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `key_words`
--

CREATE TABLE `key_words` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `key_words`
--

INSERT INTO `key_words` (`id`, `category_id`, `name`, `active`) VALUES
(16, 2, 'nam', 1),
(17, 1, 'nữ', 1),
(18, 2, 'CICM', 1),
(19, 1, 'công an', 1),
(21, 1, 'bị', 1);

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
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$nQWcWJmW4sOMuAuvGo5JUeChCDtscifk/2X49JBGoryDYIjHqkhWW', '2018-06-16 17:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `r_s_s_e_s`
--

CREATE TABLE `r_s_s_e_s` (
  `id` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ignoreRSS` text COLLATE utf8mb4_unicode_ci,
  `website` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `r_s_s_e_s`
--

INSERT INTO `r_s_s_e_s` (`id`, `link`, `ignoreRSS`, `website`) VALUES
(13, 'https://www.24h.com.vn/guest/RSS/', '//24h.com.vn/upload/rss/euro2016.rss', NULL),
(14, 'https://vnexpress.net/rss', NULL, 'https://vnexpress.net');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'admin@gmail.com', '$2y$10$00wkObG.g/iNVNU2L1z2eeZHV9zhEaiUNVDA4lxTEKXGVlVcydBxq', 'lcaVTvPww1lxenKQJSi1NEsqC6fJcMF6zo0F8qvSPA91zHtRwhaDZ04l3u1z', '2018-06-16 16:18:05', '2018-06-17 05:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(11) NOT NULL,
  `domainName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuTag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numberPage` int(11) NOT NULL,
  `limitOfOnePage` int(11) DEFAULT NULL,
  `stringFirstPage` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stringLastPage` text COLLATE utf8mb4_unicode_ci,
  `ignoreWebsite` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `domainName`, `menuTag`, `numberPage`, `limitOfOnePage`, `stringFirstPage`, `stringLastPage`, `ignoreWebsite`, `active`) VALUES
(1, 'https://vnexpress.net', '#main_menu > a', 2, 20, '/page/', '.html', NULL, 1),
(2, 'http://vietnam.ucanews.com/', '.navestyle > li > a', 5, 0, '/page/', NULL, 'http://vietnam.ucanews.com;\r\nhttp://vietnam.ucanews.com/about-us/;\r\nhttp://vietnam.ucanews.com/multimedia/;\r\nhttp://directory.ucanews.com/country/vietnam/34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `detail_websites`
--
ALTER TABLE `detail_websites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domainname` (`website_id`);

--
-- Indexes for table `key_words`
--
ALTER TABLE `key_words`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

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
-- Indexes for table `r_s_s_e_s`
--
ALTER TABLE `r_s_s_e_s`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domainname` (`domainName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_websites`
--
ALTER TABLE `detail_websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `key_words`
--
ALTER TABLE `key_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `r_s_s_e_s`
--
ALTER TABLE `r_s_s_e_s`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `detail_websites`
--
ALTER TABLE `detail_websites`
  ADD CONSTRAINT `detail_websites_ibfk_1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`);

--
-- Constraints for table `key_words`
--
ALTER TABLE `key_words`
  ADD CONSTRAINT `key_words_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
