-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2025 at 07:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gaming_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game_name`) VALUES
(1, 'Rock Paper Scissors'),
(2, 'Color Play');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `user_id`, `game_id`, `score`, `date`) VALUES
(15, 8, 1, 10, '2024-10-01 11:53:28'),
(16, 8, 1, 10, '2024-10-01 11:58:15'),
(17, 8, NULL, 0, '2024-10-09 05:43:36'),
(18, 8, NULL, 0, '2024-10-09 05:55:30'),
(19, 8, NULL, 0, '2024-10-09 05:56:01'),
(20, 8, NULL, 0, '2024-10-09 06:01:51'),
(21, 9, 1, 10, '2024-10-09 02:34:16'),
(22, 10, 1, 10, '2024-10-09 02:50:22'),
(23, 10, 1, 10, '2024-10-09 02:51:16'),
(24, 10, NULL, 0, '2024-10-09 06:22:00'),
(25, 8, 1, 10, '2024-10-17 02:32:03'),
(26, 8, 1, 10, '2024-10-17 02:32:07'),
(27, 8, NULL, 0, '2024-10-17 06:03:27'),
(28, 8, NULL, 0, '2024-10-17 06:04:48'),
(33, 12, 1, 10, '2024-10-22 02:03:53'),
(34, 8, NULL, 0, '2024-10-22 05:58:14'),
(35, 8, 1, 10, '2024-10-22 02:28:22'),
(36, 8, NULL, 0, '2024-10-22 05:59:18'),
(37, 13, 1, 10, '2025-03-01 01:23:30'),
(38, 13, NULL, 0, '2025-03-01 05:53:37'),
(39, 13, NULL, 0, '2025-03-01 05:53:44'),
(40, 13, NULL, 0, '2025-03-01 05:53:58'),
(41, 13, NULL, 0, '2025-03-01 05:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `win_count` int(11) DEFAULT 0,
  `total_points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `age`, `gender`, `win_count`, `total_points`) VALUES
(8, 'Ulka', 'patelulka@gmail.com', '$2y$10$Lt21YEQitBSaMvQ/9fBpAerwumlgTF.W8cdg8Bxuhnxyp.MVE/fmq', 23, 'male', 5, 50),
(9, 'Ak', 'ak@gmail.com', '$2y$10$2ffdGMnBNgDvxRbc4D11Buo5gmaBhmBghlPGDpGCWFPEsxs5XjwgW', 20, 'female', 1, 10),
(10, 'Yesha', 'yesha@gmail.com', '$2y$10$/d/xEpZZpKH1/V8ep0H12eKjqfo7RC09xurfdZhDvtFpYauGc/9ou', 20, 'female', 2, 20),
(12, 'dhwani', 'dhwani@gmail.com', '$2y$10$uFYYA3SBNc8fKPcXqm.QrOtjMrDXaALsUGA8SCwS95GWZa5X1.Fqa', 24, 'female', 1, 10),
(13, 'P', 'p@gmail.com', '$2y$10$FEzEECoptNuMyKihVTR45.iIAmvgQvaoStIRVI4Sp9Sq1rqi0D35a', 20, 'male', 1, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
