-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2017 at 12:18 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `finish` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rev_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buys`
--

INSERT INTO `buys` (`id`, `user_id`, `order_id`, `buy_price`, `finish`, `created_at`, `updated_at`, `rev_id`) VALUES
(1, 1, 1, 5, 0, '2017-06-03 20:12:08', '2017-06-03 20:12:08', 2),
(2, 1, 2, 30, 0, '2017-06-03 20:12:11', '2017-06-03 20:12:11', 2),
(3, 1, 3, 5, 0, '2017-06-03 20:12:16', '2017-06-03 20:12:16', 2),
(4, 1, 4, 30, 1, '2017-06-03 20:12:23', '2017-06-03 20:15:11', 2),
(5, 1, 5, 20, 1, '2017-06-03 20:12:26', '2017-06-03 20:14:03', 2),
(6, 2, 6, 5, 0, '2017-06-03 20:12:47', '2017-06-03 20:12:47', 1),
(7, 2, 7, 5, 0, '2017-06-03 20:12:50', '2017-06-03 20:12:50', 1),
(8, 2, 8, 10, 1, '2017-06-03 20:12:53', '2017-06-04 20:07:15', 1),
(9, 2, 9, 5, 1, '2017-06-03 20:12:55', '2017-06-03 20:17:30', 1),
(10, 2, 10, 30, 1, '2017-06-03 20:12:56', '2017-06-03 20:16:22', 1),
(11, 2, 11, 10, 2, '2017-06-04 21:24:39', '2017-06-06 20:29:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `des`, `created_at`, `updated_at`) VALUES
(1, 'برمجه', 'برمجه', NULL, NULL),
(2, 'desigin', 'bbbbbb', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `order_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'mmmmmmmmmmmm', 19, 1, '2017-02-13 11:24:05', '2017-02-13 11:24:05'),
(2, 'السلام عليكم ', 19, 1, '2017-02-13 11:28:29', '2017-02-13 11:28:29'),
(3, 'السلام عليكم ', 19, 1, '2017-02-13 11:28:33', '2017-02-13 11:28:33'),
(4, 'السلام عليكم ', 19, 1, '2017-02-13 11:28:53', '2017-02-13 11:28:53'),
(5, 'السلام عليكم ', 19, 1, '2017-02-13 11:28:56', '2017-02-13 11:28:56'),
(6, 'mmmmmm', 19, 1, '2017-02-13 12:53:35', '2017-02-13 12:53:35'),
(7, 'mmmmmmm', 16, 1, '2017-02-13 12:54:24', '2017-02-13 12:54:24'),
(8, 'mmmmmmm', 16, 1, '2017-02-13 13:02:02', '2017-02-13 13:02:02'),
(9, 'mmmmmmm', 16, 1, '2017-02-13 13:02:07', '2017-02-13 13:02:07'),
(10, 'vvvvvvvvv', 18, 1, '2017-02-13 13:05:07', '2017-02-13 13:05:07'),
(11, 'هذا النص هو مثال لنص يمكن أن يستبدل', 18, 1, '2017-02-13 13:11:54', '2017-02-13 13:11:54'),
(12, 'mmmmmmmmmmmmmmmmmmmmmm\r\n', 19, 1, '2017-02-13 19:26:44', '2017-02-13 19:26:44'),
(13, 'السلام عليكم ورحمه الله', 12, 1, '2017-02-13 21:59:24', '2017-02-13 21:59:24'),
(14, 'bbbbbbbb', 12, 1, '2017-02-13 22:06:04', '2017-02-13 22:06:04'),
(15, 'nnnnnnnnnn', 12, 1, '2017-02-13 22:09:05', '2017-02-13 22:09:05'),
(16, 'bbbbbbbb', 12, 1, '2017-02-13 22:17:03', '2017-02-13 22:17:03'),
(17, 'mmmmmmm\r\n', 12, 1, '2017-02-13 22:19:25', '2017-02-13 22:19:25'),
(18, 'كل عام وانتم بخير', 12, 1, '2017-02-13 22:22:23', '2017-02-13 22:22:23'),
(19, 'كل سنه وانتم طيبين\r\n', 12, 1, '2017-02-13 22:22:48', '2017-02-13 22:22:48'),
(20, 'ةةةةةةة\r\n', 12, 1, '2017-02-13 22:24:20', '2017-02-13 22:24:20'),
(21, 'ةةةةةةةةةةةةةةةةةةةةةةةة', 12, 1, '2017-02-13 22:26:57', '2017-02-13 22:26:57'),
(22, 'mmmmmm', 12, 1, '2017-02-13 22:30:15', '2017-02-13 22:30:15'),
(23, 'mmmmmm', 12, 1, '2017-02-13 22:30:37', '2017-02-13 22:30:37'),
(24, 'mmmmmmm', 12, 1, '2017-02-13 22:30:59', '2017-02-13 22:30:59'),
(25, 'nnnnnnn', 12, 1, '2017-02-13 22:31:22', '2017-02-13 22:31:22'),
(26, 'mmmmmmmmmmmmmm', 15, 1, '2017-02-13 22:34:36', '2017-02-13 22:34:36'),
(27, 'mmmmmmmmmmmmmmmmmmmmmm', 13, 1, '2017-02-13 22:34:56', '2017-02-13 22:34:56'),
(28, 'mmmmmmmmmmmm', 13, 1, '2017-02-13 22:35:57', '2017-02-13 22:35:57'),
(29, 'mmmmmmmmmmmmmmm', 13, 1, '2017-02-13 23:33:24', '2017-02-13 23:33:24'),
(30, 'السلام عليكم يا اهل الخير\n', 16, 2, '2017-02-14 12:56:07', '2017-02-14 12:56:07'),
(31, 'ازيك ياباشا اخبارك ايه', 16, 2, '2017-02-14 12:56:35', '2017-02-14 12:56:35'),
(32, 'bbbbbb', 18, 1, '2017-02-14 18:22:41', '2017-02-14 18:22:41'),
(33, 'هل هذه الخدمه جيده ', 30, 1, '2017-04-22 13:36:28', '2017-04-22 13:36:28'),
(34, 'ببببببببببببببب', 30, 1, '2017-04-23 12:44:54', '2017-04-23 12:44:54'),
(35, 'السلام عليكم ياهل الخير', 30, 1, '2017-04-23 12:45:07', '2017-04-23 12:45:07'),
(36, 'mmmmmmmmmmmmmmmmmmmm', 56, 2, '2017-04-26 10:59:00', '2017-04-26 10:59:00'),
(37, 'ffffffffffffffff', 56, 2, '2017-04-26 10:59:30', '2017-04-26 10:59:30'),
(38, 'ggggggggggggggggg', 56, 1, '2017-04-26 10:59:48', '2017-04-26 10:59:48'),
(39, 'hgsbl \n', 58, 2, '2017-04-26 13:06:20', '2017-04-26 13:06:20'),
(40, 'ةةةةةةةةةةةةةةةةةةةة', 61, 2, '2017-04-26 18:31:44', '2017-04-26 18:31:44'),
(41, 'ييييييييييييييييي', 61, 1, '2017-04-26 18:36:05', '2017-04-26 18:36:05'),
(42, 'ddddddddddddddddd', 61, 2, '2017-04-26 18:53:21', '2017-04-26 18:53:21'),
(43, 'ddddddddddddd', 61, 2, '2017-04-26 18:53:26', '2017-04-26 18:53:26'),
(44, 'ddddddd', 61, 2, '2017-04-26 18:53:31', '2017-04-26 18:53:31'),
(45, 'lhan mmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 61, 1, '2017-04-26 18:56:27', '2017-04-26 18:56:27'),
(46, 'ddddddddddddddddddd', 61, 1, '2017-04-26 18:56:36', '2017-04-26 18:56:36'),
(47, 'ddddddddddddddddddddd', 61, 1, '2017-04-26 18:56:41', '2017-04-26 18:56:41'),
(53, 'fffffffffffffffffffffff', 62, 2, '2017-05-01 14:06:27', '2017-05-01 14:06:27'),
(54, 'ffffffffffffffffffff', 62, 2, '2017-05-01 14:06:32', '2017-05-01 14:06:32'),
(55, 'ffffffffffffff', 62, 2, '2017-05-01 14:06:36', '2017-05-01 14:06:36'),
(56, 'mmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:11:07', '2017-05-01 14:11:07'),
(57, 'mmmmmmmmmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:11:11', '2017-05-01 14:11:11'),
(58, 'mmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:11:16', '2017-05-01 14:11:16'),
(59, 'mmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:12:09', '2017-05-01 14:12:09'),
(60, 'mmmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:12:13', '2017-05-01 14:12:13'),
(61, 'mmmmmmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:21:24', '2017-05-01 14:21:24'),
(62, 'mmmmmmmmmmmmmm', 62, 2, '2017-05-01 14:21:29', '2017-05-01 14:21:29'),
(63, 'ةةةةةةةةةةةةةةةةةةة', 62, 2, '2017-05-01 19:34:51', '2017-05-01 19:34:51'),
(64, 'ةةةةةةةةةةةةة', 62, 2, '2017-05-01 19:34:55', '2017-05-01 19:34:55'),
(65, 'ةةةةةةةةةةةةةةةةةةةةةةةةةةةة', 62, 2, '2017-05-01 19:35:00', '2017-05-01 19:35:00'),
(66, 'ةةةةةةةةة', 62, 2, '2017-05-01 19:39:39', '2017-05-01 19:39:39'),
(68, 'ةةةةةةةةةةةة\r\n', 62, 2, '2017-05-01 19:45:58', '2017-05-01 19:45:58'),
(69, 'ىىىىىىىىىىىىىىىىىىى', 62, 2, '2017-05-01 19:46:03', '2017-05-01 19:46:03'),
(70, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 62, 2, '2017-05-01 19:54:49', '2017-05-01 19:54:49'),
(71, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 62, 2, '2017-05-01 19:54:54', '2017-05-01 19:54:54'),
(72, 'bbbbbbbbbbbbbbbbbbbbbbbbbbb', 62, 2, '2017-05-01 19:54:59', '2017-05-01 19:54:59'),
(73, 'mmmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 20:04:24', '2017-05-01 20:04:24'),
(74, 'mmmmmmmmmmmmmmmmmmmmmmmmm', 62, 2, '2017-05-01 20:04:30', '2017-05-01 20:04:30'),
(75, 'ةةةةةةةةةةةةةةةةة', 51, 2, '2017-05-02 12:17:27', '2017-05-02 12:17:27'),
(76, 'ةةةةةةةةةةةةةةةةةةةةةةة', 51, 2, '2017-05-02 12:17:37', '2017-05-02 12:17:37'),
(77, 'ةةةةةةةةةةةةةةةةةةةةةةةةةةةة\r\n', 51, 2, '2017-05-02 12:17:45', '2017-05-02 12:17:45'),
(78, 'ةةةةةةةة\r\n', 51, 2, '2017-05-02 12:17:53', '2017-05-02 12:17:53'),
(79, 'الكشف عن اللغة. العربية. الكشف عن اللغة. ترجمة المزيد من النصوص. السجلّمميّزة بنجمة. تحسين الترجمة. تم ', 62, 2, '2017-05-13 17:56:29', '2017-05-13 17:56:29'),
(81, 'To move the uploaded file to a new location, you should use the move method. This method will move the file from its temporary upload location (as determined by your PHP configuration) to a more permanent destination of your choosing:', 62, 2, '2017-05-13 18:52:22', '2017-05-13 18:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `service_id`, `created_at`, `updated_at`, `user_service`) VALUES
(6, 2, 11, '2017-03-16 09:50:29', '2017-03-16 09:50:29', 1),
(10, 3, 11, '2017-03-21 13:58:39', '2017-03-21 13:58:39', 1),
(11, 3, 7, '2017-03-21 13:58:56', '2017-03-21 13:58:56', 2),
(12, 3, 4, '2017-03-21 14:09:11', '2017-03-21 14:09:11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `user_message_you` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `message`, `user_message_you`, `user_id`, `seen`, `created_at`, `updated_at`) VALUES
(1, 'السلام عليكم', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', 1, 2, 0, '2017-02-15 13:23:55', '2017-02-15 13:23:55'),
(2, 'السلام عليكم', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', 1, 2, 0, '2017-02-15 13:29:13', '2017-02-15 13:29:13'),
(3, 'عمليه حذف', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 1, 2, 1, '2017-02-15 13:29:39', '2017-03-13 07:08:46'),
(4, 'ةةةةةةةةة', 'ةةةةةةةةةةةةةةةةةةةةةةةة', 1, 2, 1, '2017-02-18 12:55:47', '2017-03-13 07:33:20'),
(5, 'السلام عليكم ورحمه الله', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', 1, 2, 1, '2017-02-18 13:06:15', '2017-03-13 07:31:52'),
(6, 'mmmmmmmm', 'mmmmmmm', 1, 2, 1, '2017-02-18 13:20:08', '2017-03-13 07:31:42'),
(7, 'السلام عليكم ', 'السلام عليكم السلام عليكم السلام عليكم السلام عليكم السلام عليكم رر', 2, 1, 1, '2017-02-18 18:01:10', '2017-03-12 09:35:27'),
(8, 'ةةةةةةةةة', 'ةةةةةةةةةةةةةة', 1, 2, 1, '2017-03-12 07:12:51', '2017-03-13 07:08:39'),
(9, 'hgsbl ', 'hgscl ugd;l', 1, 2, 1, '2017-03-12 07:16:48', '2017-03-12 11:14:55'),
(10, 'nnnnnnnnnnnnnnn', 'nnnnnnnnnnn', 1, 2, 1, '2017-03-12 07:19:59', '2017-03-12 09:40:15'),
(11, 'جديدلللللللللللللل', 'لللللللللللللللل', 2, 1, 1, '2017-03-12 11:15:05', '2017-03-12 12:40:35'),
(12, 'كل سنه وامنت', 'بببببببب', 1, 2, 1, '2017-03-13 07:23:34', '2017-03-13 07:30:57'),
(13, 'جديدggggggggg', 'gggggggggggggggggggggggggggg', 2, 1, 1, '2017-03-13 07:44:15', '2017-03-16 08:48:15'),
(14, 'رساله بعنوان  ', '/SendMessage/SendMessage/SendMessage/SendMessage/SendMessage', 1, 2, 0, '2017-04-26 09:43:27', '2017-04-26 09:43:27'),
(15, 'رساله بعنوان  ', 'ةةةةةةةة', 1, 2, 0, '2017-04-26 09:43:42', '2017-04-26 09:43:42'),
(16, 'رساله بعنوان  ', 'ةةةةةةةة', 1, 2, 0, '2017-04-26 09:44:14', '2017-04-26 09:44:14'),
(17, 'ةةةةةةةةةة', 'ىىىىىىىىىى', 1, 2, 0, '2017-04-26 09:49:16', '2017-04-26 09:49:16'),
(18, 'Reacvemessage', 'ReacvemessageReacvemessageReacvemessageReacvemessageReacvemessageReacvemessageر', 2, 1, 1, '2017-04-26 09:56:07', '2017-04-26 10:04:06'),
(19, 'vvvvvvvvv', 'vvvvvvvvvvvv', 1, 2, 0, '2017-04-26 10:13:05', '2017-04-26 10:13:05'),
(20, 'fffffff', 'fffffffffffffff', 1, 2, 1, '2017-04-26 10:14:00', '2017-04-26 10:17:33'),
(21, 'mmmmmmmm', 'mmmmmmmmmmmmm', 1, 2, 1, '2017-04-26 10:34:07', '2017-04-26 10:34:55'),
(22, 'mmmmmmmmmmmmmmmmmmmmm', 'mmmmmmmmmmmmmmmmmmmmmm', 1, 2, 1, '2017-04-26 10:34:14', '2017-04-26 10:41:00'),
(23, 'mmmmmmmmmmmm', 'mmmmmmmmmmmmmmmmmmmmmm', 2, 1, 1, '2017-04-26 10:35:48', '2017-04-26 10:43:38'),
(24, 'mmmmmmmmmmmmmmmmm', 'mmmmmmmmmmmm', 2, 1, 1, '2017-04-26 10:35:54', '2017-04-26 10:36:29'),
(25, 'mmmmmmmmmm', 'mmmmmmmmmmm', 2, 1, 1, '2017-04-26 10:36:00', '2017-04-26 11:35:12'),
(26, 'mmmmmmmm', 'mmmmmmmmmmmmmm', 2, 1, 1, '2017-04-26 17:56:38', '2017-05-01 13:59:27'),
(27, 'mmmmmmmmmmmmmm', 'mmmmmmmmmmmmmm', 2, 1, 1, '2017-04-26 17:57:29', '2017-04-29 20:24:26'),
(28, 'mmmmmmmmmm', 'mmmmmmmmmmmmmmm', 2, 1, 1, '2017-04-27 12:57:17', '2017-04-27 16:22:15'),
(29, 'السلام عليكم', '很多人都知道，除暴安良、維持治安是警察的職責，但原來警察也站在防止自殺的最前線！一般人都以為，負責與企圖自殺者談判的是談判專家。不過，香港警務處警察談判專家小組劉達強警司指出，在談判專家奉召到場前，前線警員已開始與企圖自殺者交談。故此，警方於「防止自毀——東區社區共融計劃」所扮演的角色，遠比一般人所想全面和廣泛。\r\n', 2, 1, 0, '2017-05-02 12:18:55', '2017-05-02 12:18:55'),
(30, 'ةةةةةةةةةةةة', '很多人都知道，除暴安良、維持治安是警察的職責，但原來警察也站在防止自殺的最前線！一般人都以為，負責與企圖自殺者談判的是談判專家。不過，香港警務處警察談判專家小組劉達強警司指出，在談判專家奉召到場前，前線警員已開始與企圖自殺者交談。故此，警方於「防止自毀——東區社區共融計劃」所扮演的角色，遠比一般人所想全面和廣泛。\r\n', 2, 1, 1, '2017-05-02 12:19:32', '2017-05-12 18:30:50');

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
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_01_22_125817_create_cats_table', 1),
('2017_01_22_125849_create_orders_table', 1),
('2017_01_22_125939_create_notifications_table', 1),
('2017_01_22_130003_create_messages_table', 1),
('2017_01_22_130029_create_services_table', 1),
('2017_01_22_130058_create_comments_table', 1),
('2017_01_22_130136_create_votes_table', 1),
('2017_02_06_130100_create_views_table', 2),
('2017_03_14_112041_create_favorites_table', 3),
('2017_04_04_122831_create_pay_infos_table', 4),
('2017_04_20_151035_create_buys_table', 5),
('2017_05_17_111858_create_profits_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `notify_id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_notify_you` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notify_id`, `type`, `user_notify_you`, `user_id`, `seen`, `url`, `created_at`, `updated_at`) VALUES
(2, 51, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 09:32:46', '2017-04-26 10:31:52'),
(3, 52, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 09:32:56', '2017-04-26 10:18:01'),
(4, 53, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 09:36:19', '2017-04-26 10:32:57'),
(5, 54, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 09:36:23', '2017-04-26 10:19:18'),
(6, 20, 'Reacvemessage', 1, 2, 1, '', '2017-04-26 10:14:00', '2017-04-26 10:17:33'),
(7, 21, 'Reacvemessage', 1, 2, 1, '', '2017-04-26 10:34:07', '2017-04-26 10:34:55'),
(8, 22, 'Reacvemessage', 1, 2, 1, '', '2017-04-26 10:34:14', '2017-04-26 10:41:00'),
(9, 55, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 10:34:29', '2017-04-26 10:35:11'),
(10, 56, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 10:34:33', '2017-04-26 10:58:50'),
(11, 57, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 10:35:35', '2017-04-26 10:37:18'),
(12, 58, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 10:35:37', '2017-04-26 11:31:18'),
(13, 23, 'Reacvemessage', 2, 1, 1, '', '2017-04-26 10:35:48', '2017-04-26 10:43:38'),
(14, 24, 'Reacvemessage', 2, 1, 1, '', '2017-04-26 10:35:54', '2017-04-26 10:36:29'),
(15, 25, 'Reacvemessage', 2, 1, 1, '', '2017-04-26 10:36:00', '2017-04-26 11:35:12'),
(16, 56, 'ComplateOrder', 1, 2, 1, '', '2017-04-26 11:24:37', '2017-04-26 13:40:23'),
(17, 58, 'ComplateOrder', 2, 1, 1, '', '2017-04-26 11:31:49', '2017-04-26 11:35:02'),
(18, 57, 'DoneOrder', 1, 2, 1, '', '2017-04-26 13:28:26', '2017-04-26 13:40:33'),
(19, 54, 'RejectOrder', 1, 2, 1, '', '2017-04-26 13:28:57', '2017-04-26 17:50:40'),
(20, 59, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 13:47:30', '2017-04-26 19:06:09'),
(21, 60, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 13:48:54', '2017-04-26 13:49:17'),
(22, 60, 'DoneOrder', 1, 2, 1, '', '2017-04-26 13:49:35', '2017-04-26 13:53:41'),
(23, 53, 'RejectOrder', 1, 2, 1, '', '2017-04-26 13:49:59', '2017-04-26 18:04:11'),
(24, 61, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 13:50:01', '2017-04-26 13:51:12'),
(25, 61, 'RejectOrder', 1, 2, 1, '', '2017-04-26 13:51:19', '2017-04-26 18:29:12'),
(26, 62, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 13:52:24', '2017-04-26 13:52:44'),
(27, 62, 'RejectOrder', 1, 2, 1, '', '2017-04-26 13:52:50', '2017-05-01 13:53:22'),
(28, 60, 'ComplateOrder', 2, 1, 1, '', '2017-04-26 13:53:48', '2017-04-26 17:50:11'),
(29, 63, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 13:54:49', '2017-04-26 17:17:33'),
(30, 64, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 17:15:22', '2017-04-26 18:04:21'),
(31, 65, 'ReacveOrder', 1, 2, 1, '', '2017-04-26 17:15:28', '2017-04-26 18:05:15'),
(32, 63, 'RejectOrder', 1, 2, 1, '', '2017-04-26 17:17:44', '2017-05-01 13:56:50'),
(33, 66, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 17:49:14', '2017-04-26 17:49:47'),
(34, 67, 'ReacveOrder', 2, 1, 1, '', '2017-04-26 17:49:19', '2017-04-26 18:58:20'),
(35, 26, 'Reacvemessage', 2, 1, 1, '', '2017-04-26 17:56:38', '2017-05-01 13:59:27'),
(36, 27, 'Reacvemessage', 2, 1, 1, '', '2017-04-26 17:57:29', '2017-04-29 20:24:26'),
(37, 64, 'RejectOrder', 2, 1, 1, '', '2017-04-26 18:04:29', '2017-04-26 18:04:58'),
(38, 65, 'DoneOrder', 2, 1, 1, '', '2017-04-26 18:05:24', '2017-04-26 19:04:31'),
(39, 61, 'AddComment', 2, 1, 1, '', '2017-04-26 18:31:44', '2017-04-26 18:35:36'),
(40, 61, 'AddComment', 1, 2, 1, '', '2017-04-26 18:36:06', '2017-04-26 18:36:19'),
(41, 61, 'AddComment', 2, 1, 1, '', '2017-04-26 18:53:21', '2017-04-26 18:55:54'),
(42, 61, 'AddComment', 2, 1, 1, '', '2017-04-26 18:53:26', '2017-04-26 18:55:54'),
(43, 61, 'AddComment', 2, 1, 1, '', '2017-04-26 18:53:31', '2017-04-26 18:55:54'),
(44, 61, 'AddComment', 1, 2, 1, '', '2017-04-26 18:56:28', '2017-04-26 18:56:52'),
(45, 61, 'AddComment', 1, 2, 1, '', '2017-04-26 18:56:37', '2017-04-26 18:56:52'),
(46, 61, 'AddComment', 1, 2, 1, '', '2017-04-26 18:56:41', '2017-04-26 18:56:52'),
(47, 67, 'DoneOrder', 1, 2, 1, '', '2017-04-26 18:58:27', '2017-04-26 18:58:49'),
(48, 59, 'DoneOrder', 2, 1, 1, '', '2017-04-26 19:06:14', '2017-04-26 19:06:59'),
(49, 55, 'DoneOrder', 2, 1, 1, '', '2017-04-26 19:10:26', '2017-04-26 19:10:40'),
(50, 55, 'ComplateOrder', 1, 2, 1, '', '2017-04-26 19:10:44', '2017-04-26 19:11:08'),
(51, 28, 'Reacvemessage', 2, 1, 1, '', '2017-04-27 12:57:17', '2017-04-27 16:22:15'),
(52, 68, 'ReacveOrder', 2, 1, 1, '', '2017-04-27 13:49:40', '2017-04-29 20:30:06'),
(53, 69, 'ReacveOrder', 1, 2, 1, '', '2017-04-30 00:44:06', '2017-05-01 13:57:57'),
(54, 62, 'AddComment', 1, 2, 1, '', '2017-05-01 13:54:07', '2017-05-01 13:54:56'),
(55, 62, 'AddComment', 1, 2, 1, '', '2017-05-01 13:54:29', '2017-05-01 13:54:56'),
(56, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 13:55:02', '2017-05-01 13:59:12'),
(57, 62, 'AddComment', 1, 2, 1, '', '2017-05-01 13:56:22', '2017-05-01 13:58:11'),
(58, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:06:08', '2017-05-01 14:06:17'),
(59, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:06:27', '2017-05-01 14:06:55'),
(60, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:06:32', '2017-05-01 14:06:55'),
(61, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:06:36', '2017-05-01 14:06:55'),
(62, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:11:07', '2017-05-01 14:11:31'),
(63, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:11:11', '2017-05-01 14:11:31'),
(64, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:11:16', '2017-05-01 14:11:31'),
(65, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:12:09', '2017-05-01 14:12:28'),
(66, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:12:13', '2017-05-01 14:12:28'),
(67, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:21:24', '2017-05-01 14:21:50'),
(68, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 14:21:29', '2017-05-01 14:21:51'),
(69, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:34:51', '2017-05-01 19:35:02'),
(70, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:34:56', '2017-05-01 19:35:03'),
(71, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:35:00', '2017-05-01 19:35:03'),
(72, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:39:39', '2017-05-01 19:40:19'),
(73, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:39:43', '2017-05-01 19:40:19'),
(74, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:45:58', '2017-05-01 19:46:12'),
(75, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:46:03', '2017-05-01 19:46:12'),
(76, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:54:49', '2017-05-01 19:55:20'),
(77, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:54:54', '2017-05-01 19:55:20'),
(78, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 19:54:59', '2017-05-01 19:55:20'),
(79, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 20:04:24', '2017-05-01 20:24:51'),
(80, 62, 'AddComment', 2, 1, 1, '', '2017-05-01 20:04:30', '2017-05-01 20:24:51'),
(81, 68, 'RejectOrder', 1, 2, 1, '', '2017-05-01 20:39:16', '2017-05-13 17:56:00'),
(82, 70, 'ReacveOrder', 2, 1, 1, '', '2017-05-01 20:39:32', '2017-05-01 20:39:52'),
(83, 70, 'RejectOrder', 1, 2, 1, '', '2017-05-01 20:39:57', '2017-05-13 17:56:01'),
(84, 69, 'RejectOrder', 2, 1, 1, '', '2017-05-01 20:41:04', '2017-05-02 12:19:07'),
(85, 52, 'RejectOrder', 2, 1, 1, '', '2017-05-01 20:41:22', '2017-05-02 12:19:07'),
(86, 51, 'RejectOrder', 2, 1, 1, '', '2017-05-01 20:42:03', '2017-05-02 12:19:07'),
(87, 71, 'ReacveOrder', 1, 2, 1, '', '2017-05-01 20:42:25', '2017-05-13 17:56:01'),
(88, 51, 'AddComment', 2, 1, 1, '', '2017-05-02 12:17:27', '2017-05-02 12:19:07'),
(89, 51, 'AddComment', 2, 1, 1, '', '2017-05-02 12:17:37', '2017-05-02 12:19:07'),
(90, 51, 'AddComment', 2, 1, 1, '', '2017-05-02 12:17:45', '2017-05-02 12:19:07'),
(91, 51, 'AddComment', 2, 1, 1, '', '2017-05-02 12:17:53', '2017-05-02 12:19:07'),
(92, 29, 'Reacvemessage', 2, 1, 1, '', '2017-05-02 12:18:56', '2017-05-02 12:19:07'),
(93, 30, 'Reacvemessage', 2, 1, 1, '', '2017-05-02 12:19:32', '2017-05-02 12:19:44'),
(94, 72, 'ReacveOrder', 1, 2, 1, '', '2017-05-02 12:51:24', '2017-05-13 17:56:01'),
(95, 73, 'ReacveOrder', 1, 2, 1, '', '2017-05-02 12:54:35', '2017-05-13 17:56:01'),
(96, 74, 'ReacveOrder', 1, 2, 1, '', '2017-05-02 13:04:30', '2017-05-13 17:56:01'),
(97, 75, 'ReacveOrder', 3, 1, 1, '', '2017-05-13 14:03:09', '2017-05-13 17:20:07'),
(98, 76, 'ReacveOrder', 3, 2, 1, '', '2017-05-13 14:10:44', '2017-05-13 17:56:01'),
(99, 77, 'ReacveOrder', 3, 1, 1, '', '2017-05-13 14:28:39', '2017-05-13 17:20:07'),
(100, 62, 'AddComment', 2, 1, 1, '', '2017-05-13 17:56:29', '2017-05-14 14:33:16'),
(101, 62, 'AddComment', 2, 1, 1, '', '2017-05-13 18:42:24', '2017-05-14 14:33:16'),
(102, 62, 'AddComment', 2, 1, 1, '', '2017-05-13 18:52:22', '2017-05-14 14:33:16'),
(103, 5, 'AdminRejectServices', 1, 1, 1, '', '2017-05-14 14:32:54', '2017-05-14 14:33:16'),
(104, 5, 'AdminRejectServices', 1, 1, 1, '', '2017-05-14 14:32:56', '2017-05-14 14:33:16'),
(105, 5, 'AdminAccepteServices', 1, 1, 1, '', '2017-05-14 14:34:12', '2017-05-14 14:34:18'),
(106, 51, 'AdminMakeNew', 1, 1, 1, '', '2017-05-14 19:23:37', '2017-05-14 19:24:02'),
(107, 51, 'AdminMakeNew', 1, 1, 1, '', '2017-05-14 19:35:30', '2017-05-14 19:35:58'),
(108, 51, 'AdminMakeNew', 1, 2, 1, '', '2017-05-14 19:35:30', '2017-05-14 19:51:58'),
(109, 51, 'AdminMakeNew', 1, 1, 1, '', '2017-05-14 19:41:11', '2017-05-14 19:47:49'),
(110, 51, 'AdminMakeNew', 1, 2, 1, '', '2017-05-14 19:41:11', '2017-05-14 19:51:58'),
(111, 51, 'AdminMakeNew', 1, 1, 1, '', '2017-05-14 19:41:45', '2017-05-14 19:47:49'),
(112, 51, 'AdminMakeNew', 1, 2, 1, '', '2017-05-14 19:41:45', '2017-05-14 19:51:58'),
(113, 51, 'AdminMakeNew', 1, 1, 1, '', '2017-05-14 19:46:50', '2017-05-14 19:47:50'),
(114, 51, 'AdminMakeNew', 1, 2, 1, '', '2017-05-14 19:46:50', '2017-05-14 19:51:58'),
(115, 51, 'AdminMakeFinsh', 1, 1, 1, '', '2017-05-14 19:46:59', '2017-05-14 19:47:50'),
(116, 51, 'AdminMakeFinsh', 1, 2, 1, '', '2017-05-14 19:46:59', '2017-05-14 19:51:58'),
(117, 51, 'AdminMakeNew', 1, 1, 1, '', '2017-05-14 19:47:18', '2017-05-14 19:47:50'),
(118, 51, 'AdminMakeNew', 1, 2, 1, '', '2017-05-14 19:47:18', '2017-05-14 19:51:58'),
(119, 51, 'AdminMakeFinsh', 1, 1, 1, '', '2017-05-14 20:13:38', '2017-05-16 01:34:23'),
(120, 51, 'AdminMakeFinsh', 1, 2, 1, '', '2017-05-14 20:13:38', '2017-06-03 20:06:29'),
(121, 1, 'ReacveOrder', 1, 2, 0, '', '2017-06-03 20:12:08', '2017-06-03 20:12:08'),
(122, 2, 'ReacveOrder', 1, 2, 0, '', '2017-06-03 20:12:11', '2017-06-03 20:12:11'),
(123, 3, 'ReacveOrder', 1, 2, 0, '', '2017-06-03 20:12:16', '2017-06-03 20:12:16'),
(124, 4, 'ReacveOrder', 1, 2, 1, '', '2017-06-03 20:12:23', '2017-06-03 20:14:49'),
(125, 5, 'ReacveOrder', 1, 2, 1, '', '2017-06-03 20:12:26', '2017-06-03 20:13:37'),
(126, 6, 'ReacveOrder', 2, 1, 1, '', '2017-06-03 20:12:47', '2017-06-04 20:16:19'),
(127, 7, 'ReacveOrder', 2, 1, 1, '', '2017-06-03 20:12:50', '2017-06-04 20:16:19'),
(128, 8, 'ReacveOrder', 2, 1, 1, '', '2017-06-03 20:12:53', '2017-06-04 20:06:55'),
(129, 9, 'ReacveOrder', 2, 1, 1, '', '2017-06-03 20:12:55', '2017-06-03 20:16:53'),
(130, 10, 'ReacveOrder', 2, 1, 1, '', '2017-06-03 20:12:56', '2017-06-03 20:15:46'),
(131, 5, 'DoneOrder', 2, 1, 1, '', '2017-06-03 20:13:44', '2017-06-03 20:13:58'),
(132, 5, 'ComplateOrder', 1, 2, 0, '', '2017-06-03 20:14:03', '2017-06-03 20:14:03'),
(133, 4, 'DoneOrder', 2, 1, 1, '', '2017-06-03 20:14:55', '2017-06-03 20:15:07'),
(134, 4, 'ComplateOrder', 1, 2, 1, '', '2017-06-03 20:15:11', '2017-06-03 20:15:21'),
(135, 10, 'DoneOrder', 1, 2, 1, '', '2017-06-03 20:16:09', '2017-06-03 20:16:17'),
(136, 10, 'ComplateOrder', 2, 1, 1, '', '2017-06-03 20:16:22', '2017-06-04 20:16:19'),
(137, 9, 'DoneOrder', 1, 2, 1, '', '2017-06-03 20:17:11', '2017-06-03 20:17:26'),
(138, 9, 'ComplateOrder', 2, 1, 1, '', '2017-06-03 20:17:30', '2017-06-04 20:16:19'),
(139, 8, 'DoneOrder', 1, 2, 1, '', '2017-06-04 20:07:02', '2017-06-04 20:07:11'),
(140, 8, 'ComplateOrder', 2, 1, 1, '', '2017-06-04 20:07:15', '2017-06-04 20:16:19'),
(141, 11, 'ReacveOrder', 2, 1, 1, '', '2017-06-04 21:24:39', '2017-06-06 20:29:11'),
(142, 11, 'RejectOrder', 1, 2, 0, '', '2017-06-06 20:29:29', '2017-06-06 20:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `services_id` int(11) NOT NULL,
  `user_order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `services_id`, `user_order`, `user_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, 0, 0, '2017-06-03 20:12:08', '2017-06-03 20:12:08'),
(2, 14, 1, 2, 0, 0, '2017-06-03 20:12:11', '2017-06-03 20:12:11'),
(3, 3, 1, 2, 0, 0, '2017-06-03 20:12:16', '2017-06-03 20:12:16'),
(4, 13, 1, 2, 0, 4, '2017-06-03 20:12:22', '2017-06-03 20:15:11'),
(5, 12, 1, 2, 0, 4, '2017-06-03 20:12:26', '2017-06-03 20:14:03'),
(6, 8, 2, 1, 0, 0, '2017-06-03 20:12:47', '2017-06-03 20:12:47'),
(7, 10, 2, 1, 0, 0, '2017-06-03 20:12:50', '2017-06-03 20:12:50'),
(8, 5, 2, 1, 0, 4, '2017-06-03 20:12:53', '2017-06-04 20:07:15'),
(9, 2, 2, 1, 0, 4, '2017-06-03 20:12:55', '2017-06-03 20:17:30'),
(10, 15, 2, 1, 0, 4, '2017-06-03 20:12:56', '2017-06-03 20:16:22'),
(11, 5, 2, 1, 0, 3, '2017-06-04 21:24:39', '2017-06-06 20:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_infos`
--

CREATE TABLE `pay_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_pay` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payerID` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pay_infos`
--

INSERT INTO `pay_infos` (`id`, `user_id`, `id_pay`, `payment_method`, `state`, `price`, `created_at`, `updated_at`, `payerID`) VALUES
(1, 1, 'PAY-31R657436J820252NLEZTJCY', 'paypal', 'created', 200, '2017-06-03 20:09:57', '2017-06-03 20:09:57', 'N22BHDH8TSZTE'),
(2, 2, 'PAY-2V902398E5653783YLEZTJWQ', 'paypal', 'created', 100, '2017-06-03 20:11:37', '2017-06-03 20:11:37', 'G7A9STZNGCPLA');

-- --------------------------------------------------------

--
-- Table structure for table `profits`
--

CREATE TABLE `profits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `profit_price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `time` int(11) NOT NULL,
  `payout_item_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `webite_profit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profits`
--

INSERT INTO `profits` (`id`, `user_id`, `profit_price`, `created_at`, `updated_at`, `status`, `time`, `payout_item_id`, `webite_profit`) VALUES
(1, 1, 8, '2017-06-03 20:18:40', '2017-06-03 20:19:03', 1, 1496528320, 'MTTSHBHUX28PU', 2),
(2, 1, 8, '2017-06-04 19:39:23', '2017-06-04 19:39:23', 0, 1496612363, '', 2),
(3, 1, 13, '2017-06-04 19:52:34', '2017-06-04 19:53:27', 1, 1496613154, 'PDY2A86MZGDNJ', 2),
(4, 1, 8, '2017-06-04 20:15:07', '2017-06-04 20:15:07', 0, 1496614507, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `des`, `cat_id`, `image`, `price`, `views`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'الخدمه الاولى ', 'الخدمه الاولى  الخدمه الاولى ', 1, '1485714188_mohamed mounir6.PNG', 5, 0, 2, '2017-01-29 16:23:08', '2017-01-29 16:23:08', 1),
(2, 'الخدمه الاولى ', 'الخدمه الاولى  الخدمه الاولى ', 1, '1485714248_mohamed mounir6.PNG', 5, 0, 1, '2017-01-29 16:24:08', '2017-01-29 16:24:08', 1),
(3, 'الخدمه الاولى ', 'الخدمه الاولى  الخدمه الاولى ', 1, '1485714452_mohamed mounir6.PNG', 5, 0, 2, '2017-01-29 16:27:32', '2017-01-29 16:27:32', 1),
(4, 'الخدمه الاولى ', 'الخدمه الاولى  الخدمه الاولى ', 1, '1485714626_mohamed mounir6.PNG', 5, 0, 2, '2017-01-29 16:30:26', '2017-01-29 16:30:26', 1),
(5, 'sara', 'الخدمه الاولى  الخدمه الاولى ', 2, '1485714781_mohamed mounir6.PNG', 10, 0, 1, '2017-01-29 16:33:01', '2017-05-14 14:34:13', 1),
(8, 'ccccccccc', 'ccccc', 1, '1485775055_mohamed mounir5.PNG', 5, 0, 1, '2017-01-30 09:17:36', '2017-01-30 09:17:36', 1),
(10, 'خدمه ثانيه', 'يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 1, '1485787019_mohamed mounir6.PNG', 5, 0, 1, '2017-01-30 12:36:59', '2017-01-30 12:36:59', 1),
(12, 'ssssssssssss', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 1, '1486396122_mohamed mounir14794069_1301307916555025_1280658500_n.jpg', 20, 0, 2, '2017-02-06 13:48:43', '2017-02-06 13:48:43', 1),
(13, 'new serivices', 'يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.\nومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.\nهذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير ', 1, '1487463105_admin14794069_1301307916555025_1280658500_n.jpg', 30, 0, 2, '2017-02-18 22:11:48', '2017-02-18 22:11:48', 1),
(14, 'web serivcs', 'webhook listener URL and a list of events for which to listen. You can configure up to ten webhooks. Each webhook can subscribe to either specific events or all events. To learn more about webhooks, see  webh', 1, '1491332791_admin1962749_10152302819774556_2088700501_n.jpg', 30, 0, 2, '2017-04-04 17:06:32', '2017-04-04 17:06:32', 1),
(15, 'وظائف خالية للمهندسين حديثي ', 'وظائف خالية للمهندسين حديثي التخرج في عدة تخصصات باحدى شركات خدمات الاتصالات والتقديم الكترونيا\r\nمطلوب مندوبين مبيعات للعمل بالسعودية براتب شهري واقامة وبدل سكن 5000 ريال والتقديم 22/4/2017\r\nاعلان وظائف شركة رايه لجميع المحافظات " للمؤهلات العليا والمتوسطة " - التسجيل على الانترنت\r\nالإعلان الرسمى لوظائف الشركة القابضة لمياة الشرب " رقم 3 لسنة 2017 " بمحافظة الدقهلية - التقديم على الانترنت', 1, '1493152752_mohamed large.jpg', 30, 0, 1, '2017-04-25 18:39:13', '2017-04-25 18:39:13', 1),
(16, ' nnnnnnnnnnnnnnn', 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 2, '1494456007_admin15139364_1266925040030757_2109989679_n.jpg', 10, 0, 2, '2017-05-05 21:48:09', '2017-05-10 21:39:40', 1),
(17, 'Moving Uploaded Files', 'To move the uploaded file to a new location, you should use the move method. This method will move the file from its temporary upload location (as determined by your PHP configuration) to a more permanent destination of your choosing:\r\n\r\n', 1, '1494642365_sara16809683_1870903636462372_1298128314_n.jpg', 30, 0, 3, '2017-05-13 00:26:06', '2017-05-13 00:26:06', 0),
(18, 'HTTP messages', 'The PSR-7 standard specifies interfaces for HTTP messages, including requests and responses. If you would like to obtain an instance of a PSR-7 request, you will first need to install a few libraries. Laravel uses the Symfony HTTP Message Bridge component to convert typical Laravel requests and responses into PSR-7 compatible implementations:\r\n\r\nThe PSR-7 standard specifies interfaces for HTTP messages, including requests and responses. If you would like to obtain an instance of a PSR-7 request, you will first need to install a few libraries. Laravel uses the Symfony HTTP Message Bridge component to convert typical Laravel requests and responses into PSR-7 compatible implementations:\r\n\r\nThe PSR-7 standard specifies interfaces for HTTP messages, including requests and responses. If you would like to obtain an instance of a PSR-7 request, you will first need to install a few libraries. Laravel uses the Symfony HTTP Message Bridge component to convert typical Laravel requests and responses into PSR-7 compatible implementations:\r\n\r\n', 1, '1495023009_admin17861492_1678017055545187_7349422138252668058_n.jpg', 30, 0, 2, '2017-05-17 10:10:10', '2017-05-17 10:10:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `image`) VALUES
(1, 'mohamed ', 'mohamedmounir703@gmail.com', '$2y$10$lpCYawpxEhBJZMGZ/CifTeLCYxy2nUhWUV5HM9Dj65bCINbiB/pBO', 'D8gOLaD5RLuo3jtUAHtGUpaLegAHkTSQAJ347vChEGip1dJSjlEizI6aJrcD', '2017-01-23 10:26:14', '2017-05-31 18:38:49', 1, '1494915724_mohamed 14794069_1301307916555025_1280658500_n.jpg'),
(2, 'admin', 'admin22@admin.com', '$2y$10$Z2o6I5BSj.onmnFCIhwY8ephKCvsEwjtPPPAbh3OvXk2q3TTMXJ7W', 'xy4TJ4lZtglYLzOatCXQWAckXAmi2coA7StJEgJ7XWNttkkwOFwnvv2EYfks', '2017-02-04 13:41:47', '2017-05-31 19:53:06', 0, ''),
(3, 'sara', 'mohamed@yahoo.com', '$2y$10$HHP8SKUfADYBtZ/NOha8yOvmEl5YaTOqSijfF3SsgZYp0SE1wiW8i', 'd52yY2uw6AhG6IJcfq5cR82FiMD7BSXLAcJKy6gtWHy1JIsEWo3lmKPKCgDt', '2017-03-21 13:22:08', '2017-03-28 20:04:37', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `user_id`, `service_id`, `ip`, `created_at`, `updated_at`) VALUES
(6, 1, 10, '::1', '2017-02-06 13:34:23', '2017-02-06 13:34:23'),
(7, 2, 8, '::22', '2017-03-21 13:10:59', '2017-03-21 13:10:59'),
(8, 1, 12, '::1', '2017-03-21 13:11:23', '2017-03-21 13:11:23'),
(9, 3, 11, '::1', '2017-03-21 13:23:34', '2017-03-21 13:23:34'),
(10, 2, 7, '::1', '2017-03-21 13:25:51', '2017-03-21 13:25:51'),
(11, 2, 8, '::1', '2017-03-21 13:59:31', '2017-03-21 13:59:31'),
(12, 1, 1, '::1', '2017-03-21 14:08:24', '2017-03-21 14:08:24'),
(13, 3, 4, '::1', '2017-03-21 14:09:13', '2017-03-21 14:09:13'),
(14, 3, 8, '::1', '2017-03-21 18:09:55', '2017-03-21 18:09:55'),
(15, 1, 14, '::1', '2017-04-04 17:11:00', '2017-04-04 17:11:00'),
(16, 2, 15, '::1', '2017-04-26 09:55:53', '2017-04-26 09:55:53'),
(17, 1, 3, '::1', '2017-04-26 10:51:04', '2017-04-26 10:51:04'),
(18, 1, 2, '::1', '2017-04-26 19:01:25', '2017-04-26 19:01:25'),
(19, 1, 13, '::1', '2017-04-29 20:03:40', '2017-04-29 20:03:40'),
(20, 1, 5, '::1', '2017-04-29 20:11:43', '2017-04-29 20:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `vote` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `vote`, `services_id`, `user_id`, `created_at`, `updated_at`) VALUES
(30, 5, 11, 2, '2017-03-21 11:24:13', '2017-03-21 11:24:13'),
(31, 3, 9, 2, '2017-03-21 11:24:44', '2017-03-21 11:24:44'),
(32, 5, 7, 3, '2017-03-21 13:59:01', '2017-03-21 13:59:01'),
(33, 2, 11, 3, '2017-03-21 13:59:58', '2017-03-21 13:59:58'),
(34, 5, 10, 3, '2017-03-21 14:02:14', '2017-03-21 14:02:14'),
(35, 5, 10, 2, '2017-03-21 14:02:29', '2017-03-21 14:02:29'),
(36, 4, 9, 3, '2017-03-21 14:03:45', '2017-03-21 14:03:45'),
(37, 5, 4, 3, '2017-03-21 14:09:18', '2017-03-21 14:09:18'),
(47, 5, 4, 1, '2017-03-21 16:17:34', '2017-03-21 16:17:34'),
(48, 5, 7, 1, '2017-03-21 16:18:09', '2017-03-21 16:18:09'),
(49, 5, 7, 1, '2017-03-21 16:24:11', '2017-03-21 16:24:11'),
(50, 1, 7, 1, '2017-03-21 16:24:50', '2017-03-21 16:24:50'),
(51, 5, 7, 1, '2017-03-21 16:26:21', '2017-03-21 16:26:21'),
(52, 5, 7, 1, '2017-03-21 16:26:59', '2017-03-21 16:26:59'),
(53, 2, 7, 1, '2017-03-21 16:27:28', '2017-03-21 16:27:28'),
(54, 5, 7, 1, '2017-03-21 16:28:20', '2017-03-21 16:28:20'),
(55, 5, 7, 1, '2017-03-21 16:29:03', '2017-03-21 16:29:03'),
(56, 5, 7, 1, '2017-03-21 16:39:03', '2017-03-21 16:39:03'),
(57, 5, 7, 1, '2017-03-21 16:41:40', '2017-03-21 16:41:40'),
(58, 1, 7, 1, '2017-03-21 16:42:08', '2017-03-21 16:42:08'),
(59, 5, 8, 3, '2017-03-21 18:10:01', '2017-03-21 18:10:01'),
(60, 5, 8, 2, '2017-03-21 18:10:37', '2017-03-21 18:10:37'),
(61, 5, 12, 1, '2017-03-22 09:29:54', '2017-03-22 09:29:54'),
(62, 5, 14, 1, '2017-04-04 17:17:51', '2017-04-04 17:17:51'),
(63, 5, 3, 1, '2017-05-05 21:48:34', '2017-05-05 21:48:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pay_infos`
--
ALTER TABLE `pay_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profits`
--
ALTER TABLE `profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buys`
--
ALTER TABLE `buys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pay_infos`
--
ALTER TABLE `pay_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profits`
--
ALTER TABLE `profits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
