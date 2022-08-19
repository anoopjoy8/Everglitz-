-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 19, 2022 at 08:44 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `start_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL COMMENT 'username',
  `user_type` enum('admin','staff') NOT NULL COMMENT 'admin type',
  `password` varchar(255) NOT NULL COMMENT 'formatted password',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT ' active or inactive particular user\r\n\r\n',
  `created` datetime NOT NULL COMMENT 'track user joined datetime\r\n',
  `last_logged_in` datetime DEFAULT NULL,
  `last_logged_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `user_name`, `user_type`, `password`, `status`, `created`, `last_logged_in`, `last_logged_out`) VALUES
(1, 'admin', 'admin', '$2y$10$/V/Hy42/anxcfwCgTDfPd.keAcEStcKD9.quEIr/RL3Jm1sCXasSu', 'active', '2022-07-19 19:52:02', '2022-08-19 12:26:47', '2022-08-19 12:26:40'),
(3, 'staff1', 'staff', '$2y$10$u0VyleHJlqrrNa04CXjAtudzr2ss35wf1SoBHufoH7mk6e1NcriUy', 'active', '2022-08-16 11:28:03', '2022-08-19 11:07:19', '2022-08-19 11:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `left_main_menu`
--

DROP TABLE IF EXISTS `left_main_menu`;
CREATE TABLE IF NOT EXISTS `left_main_menu` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'auto increment id',
  `menu_id` int NOT NULL DEFAULT '0' COMMENT 'parent menu id',
  `name` varchar(100) NOT NULL COMMENT 'menu name',
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'menu url',
  `menu_order` int NOT NULL COMMENT 'menu order',
  `menu_table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'menu db name',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'fa -icon\r\n',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `active_url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `menu_color` varchar(50) NOT NULL,
  `show_home` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `left_main_menu`
--

INSERT INTO `left_main_menu` (`id`, `menu_id`, `name`, `url`, `menu_order`, `menu_table`, `icon`, `date_created`, `date_modified`, `active_url`, `menu_color`, `show_home`) VALUES
(11, 0, 'Admin Users', 'list-admin', 2, 'admin_users', 'users', '2022-07-22 10:52:27', '2022-08-13 10:46:11', 'list-admin,add-admin', '#0099CC', 'yes'),
(12, 0, 'Manage Pages', 'list-page', 1, 'pages', 'pager', '2022-07-22 12:24:16', '2022-08-08 22:08:36', 'list-page,add-page,update-page', '#3F729B', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `left_sub_menu`
--

DROP TABLE IF EXISTS `left_sub_menu`;
CREATE TABLE IF NOT EXISTS `left_sub_menu` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'auto increment id',
  `menu_id` int NOT NULL COMMENT 'parent menu id',
  `name` varchar(100) NOT NULL COMMENT 'menu name',
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'menu url',
  `menu_order` int NOT NULL COMMENT 'menu order',
  `menu_table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'menu db name',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'fa -icon\r\n',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `active_url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `left_sub_menu`
--

INSERT INTO `left_sub_menu` (`id`, `menu_id`, `name`, `url`, `menu_order`, `menu_table`, `icon`, `date_created`, `date_modified`, `active_url`) VALUES
(12, 12, 'List Pages', 'list-page', 1, 'pages', 'pager', '2022-07-22 12:29:06', '2022-07-22 12:29:15', NULL),
(11, 11, 'List Admin', 'list-admin', 1, NULL, 'users', '2022-07-22 10:53:22', '2022-07-22 11:11:16', 'list-admin,add-admin'),
(13, 12, 'Add Pages', 'add-pages', 2, 'ppages', 'sa', '2022-08-19 10:32:19', NULL, 'add-pages');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Title of the page',
  `description` text COMMENT 'Description',
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Main Image Name',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `image`, `created`) VALUES
(1, 'Page1', 'test description of 1st page', '1658830038-404-pages.webp', '0000-00-00 00:00:00'),
(10, 'Page2', 'description of page2', '1658895607-download.webp', '2022-07-27 09:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `page_images`
--

DROP TABLE IF EXISTS `page_images`;
CREATE TABLE IF NOT EXISTS `page_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int NOT NULL COMMENT 'parent_id',
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'image_name',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `page_images`
--

INSERT INTO `page_images` (`id`, `page_id`, `image`) VALUES
(7, 1, '1658893675-sub-Corner-Floating-TV-Stand-with-Open-Shelving-and-Cord-Management-600x746.webp'),
(11, 10, '1658895416-sub-pjimage-2-6-1-1.webp'),
(5, 1, '1658836378-sub-1200x1200bb.webp'),
(6, 1, '1658836380-sub-180869.webp'),
(12, 10, '1658895419-sub-wood-grain1.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
