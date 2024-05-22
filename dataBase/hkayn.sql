-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2024 at 11:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hkayn`
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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendship_id` int(11) NOT NULL,
  `user1_id` int(20) UNSIGNED NOT NULL,
  `user2_id` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friendship_id`, `user1_id`, `user2_id`) VALUES
(3, 29, 45),
(2, 65, 48),
(9, 89, 29),
(8, 89, 33),
(6, 89, 83),
(5, 89, 84),
(4, 89, 86),
(19, 90, 82),
(18, 90, 83),
(12, 90, 84),
(11, 90, 86),
(10, 90, 89),
(24, 91, 83),
(23, 91, 84),
(22, 91, 86),
(21, 91, 89),
(20, 91, 90),
(37, 93, 47),
(36, 93, 52),
(35, 93, 82),
(30, 93, 83),
(29, 93, 84),
(28, 93, 86),
(27, 93, 89),
(26, 93, 90),
(25, 93, 91),
(42, 94, 80),
(43, 94, 82),
(41, 94, 89),
(40, 94, 90),
(39, 94, 91),
(38, 94, 93),
(46, 97, 93),
(45, 97, 94),
(44, 97, 95),
(49, 98, 91),
(48, 98, 93),
(47, 98, 94),
(53, 99, 94),
(52, 99, 95),
(51, 99, 97),
(50, 99, 98);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `id_user` int(20) UNSIGNED NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `id_user`, `password`) VALUES
(1, 20, 'mennoun'),
(2, 97, '$2y$10$Blt0RX4428V9gB5Oe7.ORu5NUaUSFBpN3pxKwFC177X72kQlXBtym'),
(3, 98, '$2y$10$zk3J4LYtpL9HCm.js4vpgOZXdyKHl1/8AJVFqFmZZdDnNJ7qhO2ua'),
(4, 99, '$2y$10$aDgVg1csTenOWQhXG121I..GCBekdMHc9KvZMqM6Izp2P9pSY2fYq');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(20) UNSIGNED NOT NULL,
  `receiver_id` int(20) UNSIGNED NOT NULL,
  `message_text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message_text`, `timestamp`) VALUES
(1, 83, 89, 'Hello Man how are you', '2024-02-02 02:02:54'),
(2, 93, 86, 'Hello User 86! Message 1', '2024-02-02 23:28:03'),
(3, 86, 93, 'Hi User 93! Message 2', '2024-02-02 23:28:03'),
(4, 93, 86, 'How are you? Message 3', '2024-02-02 23:28:03'),
(5, 86, 93, 'I am good, thanks! Message 4', '2024-02-02 23:28:03'),
(6, 93, 86, 'What are you up to? Message 5', '2024-02-02 23:28:03'),
(7, 86, 93, 'Just working on some projects. Message 6', '2024-02-02 23:28:03'),
(8, 93, 86, 'That sounds interesting! Message 7', '2024-02-02 23:28:03'),
(9, 86, 93, 'Yes, it is. Message 8', '2024-02-02 23:28:03'),
(10, 93, 86, 'Let\'s catch up later. Message 9', '2024-02-02 23:28:03'),
(11, 86, 93, 'Sure! Message 10', '2024-02-02 23:28:03'),
(12, 93, 83, 'Hello User 86! Message 1', '2024-02-02 23:46:58'),
(13, 83, 93, 'Hi User 93! Message 2', '2023-12-31 23:46:58'),
(14, 93, 83, 'How are you? Message 3', '2024-02-02 23:46:58'),
(15, 83, 93, 'I am good, thanks! Message 4', '2024-02-02 23:46:58'),
(16, 93, 83, 'What are you up to? Message 5', '2024-02-02 23:46:58'),
(17, 83, 93, 'Just working on some projects. Message 6', '2024-02-02 23:46:58'),
(18, 93, 83, 'That sounds interesting! Message 7', '2024-02-02 23:46:58'),
(19, 83, 93, 'Yes, it is. Message 8', '2024-02-02 23:46:58'),
(20, 93, 83, 'Let\'s catch up later. Message 9', '2024-02-02 23:46:58'),
(21, 83, 93, 'Sure! Message 10', '2024-02-03 00:46:58'),
(22, 94, 80, 'Mennoun', '2024-02-03 10:37:16'),
(23, 94, 80, 'Mennoun', '2024-02-03 10:37:25'),
(24, 94, 80, 'Mennoun', '2024-02-03 10:37:43'),
(25, 94, 80, 'Mennoun is here', '2024-02-03 10:39:38'),
(26, 94, 82, 'Mennoun', '2024-02-03 10:40:55'),
(27, 94, 80, 'Mennoun is here what about you', '2024-02-03 10:42:05'),
(28, 94, 80, 'qq', '2024-02-03 10:43:35'),
(29, 94, 80, 'Mennoun', '2024-02-03 10:45:12'),
(30, 94, 80, 'hiya', '2024-02-03 10:46:51'),
(31, 94, 80, 'Mennoun', '2024-02-03 10:52:13'),
(32, 94, 80, 'fin rack ghaber', '2024-02-03 10:52:38'),
(33, 94, 80, 'Mennoun', '2024-02-03 11:44:59'),
(34, 93, 83, 'hello my friend', '2024-02-03 12:25:47'),
(35, 93, 91, 'het', '2024-02-03 13:00:50'),
(36, 93, 89, 'hey', '2024-02-03 13:02:50'),
(37, 93, 89, 'jt', '2024-02-03 13:03:14'),
(38, 93, 89, 'hello', '2024-02-03 13:03:27'),
(39, 93, 89, 'yes', '2024-02-03 13:03:38'),
(40, 93, 89, 'Noooo', '2024-02-03 13:03:55'),
(41, 93, 89, 'ach kayn', '2024-02-03 13:04:13'),
(42, 93, 89, 'yes', '2024-02-03 13:06:48'),
(43, 93, 89, 'hello', '2024-02-03 13:09:11'),
(44, 93, 89, 'hello', '2024-02-03 13:10:17'),
(45, 93, 89, 'here', '2024-02-03 13:51:03'),
(46, 93, 89, 'Mennoune', '2024-02-03 14:05:43'),
(47, 93, 89, 'last message', '2024-02-03 14:06:27'),
(48, 98, 91, 'hi', '2024-02-03 21:04:21'),
(49, 98, 91, 'hello aya', '2024-02-03 21:35:26'),
(50, 98, 91, 'how are you', '2024-02-03 21:35:43'),
(51, 98, 94, 'Mennoun', '2024-02-03 22:03:25'),
(52, 98, 94, 'hello', '2024-02-03 22:03:33'),
(53, 98, 94, 'how are you', '2024-02-03 22:03:41'),
(54, 99, 94, 'Hello', '2024-02-03 22:34:55'),
(55, 99, 94, 'how are you', '2024-02-03 22:35:10'),
(56, 99, 94, 'ach kayn', '2024-02-03 22:35:18');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `date_of_birth` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirmated_email` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `phone`, `gender`, `date_of_birth`, `created_at`, `updated_at`, `confirmated_email`, `profile_image`) VALUES
(20, 'john_doe', 'John', 'Doe', 'john.doe@example.com', '123-456-7890', 'M', '1990-01-15', '2024-01-21 19:08:24', '2024-01-21 19:08:24', NULL, NULL),
(29, 'lily_martin', 'Lily', 'Martin', 'lily.martin@example.com', '333-444-5555', 'F', '1989-08-08', '2024-01-21 19:08:24', '2024-01-21 19:08:24', NULL, NULL),
(33, 'zoey_clark', 'Zoey', 'Clark', 'zoey.clark@example.com', '444-666-8888', 'F', '1982-03-28', '2024-01-21 19:08:24', '2024-01-21 19:08:24', NULL, NULL),
(39, 'houmen', 'mennoun', 'mennoun', 'email@gmail.com', NULL, 'M', '2024-01-12', '2024-01-28 00:36:48', '2024-01-28 00:36:48', NULL, NULL),
(41, 'kdkkdkd', 'kddjj', 'dkkdkd', 'mekdkd@gmail.com', NULL, 'M', '2024-01-03', '2024-01-28 00:44:18', '2024-01-28 00:44:18', NULL, NULL),
(43, 'jjhshdh', 'ajahh', 'jzhzhzh', 'jshdhdd@mail.com', NULL, 'M', '2024-01-25', '2024-01-28 00:48:00', '2024-01-28 00:48:00', NULL, NULL),
(45, 'h', 'jsshsh', 'hhhshh', 'jhjhjh', NULL, 'M', '2024-01-03', '2024-01-28 00:49:22', '2024-01-28 00:49:22', NULL, NULL),
(46, 'gooo', 'Mennoun', 'hshshsh', 'mennoun@gmail.com', NULL, 'M', '2024-01-11', '2024-01-28 00:53:04', '2024-01-28 00:53:04', NULL, NULL),
(47, 'hdgdg', 'sjdh', 'hdggd', 'email@mail.com', NULL, 'M', '2024-01-12', '2024-01-28 00:56:14', '2024-01-28 00:56:14', NULL, NULL),
(48, 'fhfhfhh', 'djhdfh', 'hdhfh', 'response@email.com', NULL, 'M', '2024-01-15', '2024-01-28 00:56:58', '2024-01-28 00:56:58', NULL, NULL),
(52, 'sgsg', 'jshshh', 'mennoun', 'shshsh', NULL, 'M', '2024-01-19', '2024-01-28 01:03:55', '2024-01-28 01:03:55', NULL, NULL),
(53, 'user', 'mennoun', 'hhdhdhdh', 'emndnddjd@gmail.com', NULL, 'M', '2024-01-12', '2024-01-28 01:08:16', '2024-01-28 01:08:16', NULL, NULL),
(57, 'hfhfdjj', 'Mennoun', 'joune', 'meil@mail', NULL, 'M', '2024-01-20', '2024-01-28 01:26:40', '2024-01-28 01:26:40', NULL, NULL),
(58, 'louk', 'Mennoun', 'jdodjj', 'lokk', NULL, 'M', '2024-01-19', '2024-01-28 01:30:04', '2024-01-28 01:30:04', NULL, NULL),
(60, 'lolo', 'Mennoun', 'koul', 'loizi@mail.com', NULL, 'M', '2024-01-04', '2024-01-28 01:35:59', '2024-01-28 01:35:59', NULL, NULL),
(61, 'mennoun@hoy', 'mennoun', 'abdelfatah', 'email.ciom@user', '', 'M', '2024-01-12', '2024-01-28 13:31:23', '2024-01-28 13:31:23', NULL, NULL),
(65, 'momojoun', 'mennoun', 'abdelfatah', 'email.ciom@user.com', NULL, 'F', '2024-01-12', '2024-01-28 13:35:19', '2024-01-28 13:35:19', NULL, NULL),
(66, 'jounehere', 'Mennoun', 'joune', 'mennoun@email', '', 'M', '2024-01-09', '2024-01-28 13:36:33', '2024-01-28 13:36:33', NULL, NULL),
(72, 'jouneheresscx', 'Mennouns', 'jounes', 'mennoun@email.com', '', 'M', '2024-01-09', '2024-01-28 13:37:30', '2024-01-28 13:37:30', NULL, NULL),
(78, 'sjdhfhf', 'Mennouns', 'jounes', 'mennound@email.com', '', 'M', '2024-01-09', '2024-01-28 13:39:21', '2024-01-28 13:39:21', NULL, NULL),
(80, 'sjdhfhfh', 'Mennouns', 'jounes', 'mennounkl@email.com', '', 'M', '2024-01-09', '2024-01-28 13:53:35', '2024-01-28 13:53:35', NULL, NULL),
(82, 'hiyapo', 'Mennouns', 'jounes', 'mennounklhs@email.com', '', 'M', '2024-01-09', '2024-01-28 14:54:23', '2024-01-28 14:54:23', NULL, NULL),
(83, 'louve', 'Mennouns', 'koul', 'abdelfatah@gmail.com', '', 'M', '2024-02-16', '2024-02-01 14:20:02', '2024-02-01 14:20:02', NULL, NULL),
(84, 'louvekj', 'Mennoup', 'koul', 'abdelfatahj@gmail.com', '', 'M', '2024-02-16', '2024-02-01 15:16:11', '2024-02-01 15:16:11', NULL, NULL),
(86, 'louvo', 'Mennoup', 'koul', 'abdelfatahjh@gmail.com', '', 'M', '2024-02-16', '2024-02-01 15:18:12', '2024-02-01 15:18:12', NULL, NULL),
(89, 'oupil', 'Mennoupq', 'jounes', 'mennoun@gmail.mr', '', 'M', '2024-02-01', '2024-02-01 15:23:51', '2024-02-01 15:23:51', NULL, NULL),
(90, 'elhaj', 'Mennoun', 'keen', 'email@hotmail.com', '', 'M', '2024-01-30', '2024-02-02 15:16:03', '2024-02-02 15:16:03', NULL, NULL),
(91, 'hamza', 'Hamza', 'Mennoun', 'hamza@email.com', '', 'M', '2024-02-16', '2024-02-02 19:12:48', '2024-02-02 19:12:48', NULL, NULL),
(93, 'youme', 'Mennoun', 'joun', 'emailpose@hotmail.com', '', 'M', '2024-02-08', '2024-02-02 23:01:35', '2024-02-02 23:01:35', NULL, NULL),
(94, 'Mennio', 'Abelfatah', 'mennoun', 'mennoun@abdelfath.com', '', 'M', '2024-02-21', '2024-02-03 10:28:50', '2024-02-03 10:28:50', NULL, NULL),
(95, 'aya', 'Aya', 'Aya', 'aya@eamil.com', '', 'M', '2024-02-10', '2024-02-03 17:16:00', '2024-02-03 17:16:00', NULL, NULL),
(97, 'ayapass', 'Mohameed', 'Moul', 'ayajoune@eamil.com', '', 'M', '2024-02-10', '2024-02-03 17:18:11', '2024-02-03 17:18:11', NULL, NULL),
(98, 'lucifer', 'Mennoun', 'Lucifer', 'email@mennoun.com', '', 'M', '2024-02-22', '2024-02-03 19:36:24', '2024-02-03 19:36:24', NULL, NULL),
(99, 'zakaria', 'Zakaria', 'boujmla', 'zakaria@mennoun.com', '', 'M', '2024-02-16', '2024-02-03 22:29:28', '2024-02-03 22:29:28', NULL, '65bebec18fdd2.jpeg');

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
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendship_id`),
  ADD UNIQUE KEY `unique_friendship` (`user1_id`,`user2_id`),
  ADD KEY `friends_ibfk_2` (`user2_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `F_K_user1` (`receiver_id`),
  ADD KEY `F_K_user2` (`sender_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `F_K_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `F_K_user1` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `F_K_user2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
