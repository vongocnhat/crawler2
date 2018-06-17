-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 06:42 PM
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
  `pubDate` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_websites`
--

CREATE TABLE `detail_websites` (
  `id` int(11) NOT NULL,
  `domainName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `containerTag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleTag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptionTag` text COLLATE utf8mb4_unicode_ci,
  `updateTimeTag` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_websites`
--

INSERT INTO `detail_websites` (`id`, `domainName`, `containerTag`, `titleTag`, `descriptionTag`, `updateTimeTag`, `active`) VALUES
(3, 'http://www.24h.com.vn', '.boxDoi-sub-Item-trangtrong', '.news-title a', '.news-sapo', '.update-time', 1),
(4, 'https://vnexpress.net', '.sidebar_1 > .list_news', '.title_news > a', '.description', '', 1),
(5, 'http://www.24h.com.vn', '#home-sum-1', '.news-title16-G', '.news-sapo', '.update-time', 1);

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
(16, 2, 'bộ', 1),
(17, 1, 'nữ', 1),
(18, 2, 'csgt', 1);

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
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(11) NOT NULL,
  `domainName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuTag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numberPage` int(11) NOT NULL,
  `limitOfOnePage` int(11) NOT NULL,
  `stringFirstPage` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stringLastPage` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `domainName`, `menuTag`, `numberPage`, `limitOfOnePage`, `stringFirstPage`, `stringLastPage`, `active`) VALUES
(1, 'http://www.24h.com.vn', '#zone_footer > ul > li > a', 2, 14, '?vpage=', NULL, 1),
(2, 'https://vnexpress.net', '#main_menu > a', 2, 20, '/page/', '.html', 1);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_websites`
--
ALTER TABLE `detail_websites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domainname` (`domainName`);

--
-- Indexes for table `key_words`
--
ALTER TABLE `key_words`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `r_s_s_e_s`
--
ALTER TABLE `r_s_s_e_s`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_websites`
--
ALTER TABLE `detail_websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `key_words`
--
ALTER TABLE `key_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `r_s_s_e_s`
--
ALTER TABLE `r_s_s_e_s`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_websites`
--
ALTER TABLE `detail_websites`
  ADD CONSTRAINT `detail_websites_ibfk_1` FOREIGN KEY (`domainName`) REFERENCES `websites` (`domainName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `key_words`
--
ALTER TABLE `key_words`
  ADD CONSTRAINT `key_words_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
