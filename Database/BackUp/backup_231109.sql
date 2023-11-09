-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-11-09 04:01:50
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `acsystem`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('attend','absent','lateness','leave_early','official_absence') DEFAULT NULL,
  `comment` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `timestamp`, `status`, `comment`) VALUES
(87, 76, '2023-11-07 04:57:01', 'attend', 'カードによる出席'),
(88, 76, '2023-11-08 02:44:12', 'absent', ''),
(89, 81, '2023-11-08 02:50:47', 'attend', 'カードによる出席'),
(90, 81, '2023-11-09 02:51:21', 'attend', NULL),
(91, 81, '2023-11-10 02:51:21', 'attend', NULL),
(92, 81, '2023-11-13 02:51:21', 'attend', NULL),
(93, 81, '2023-11-14 02:51:21', 'attend', NULL),
(94, 81, '2023-11-15 02:51:21', 'attend', NULL),
(95, 81, '2023-11-16 02:51:21', 'attend', NULL),
(96, 81, '2023-11-17 02:51:21', 'attend', NULL),
(97, 81, '2023-11-18 02:51:21', 'attend', NULL),
(98, 81, '2023-11-08 05:34:22', 'attend', 'カードによる出席'),
(99, 81, '2023-11-08 05:35:09', 'attend', 'カードによる出席'),
(100, 82, '2023-11-08 05:38:21', 'attend', 'カードによる出席'),
(101, 82, '2023-11-08 06:27:44', 'lateness', NULL),
(102, 76, '2023-11-09 02:22:56', 'leave_early', 'health_issues'),
(103, 76, '2023-11-09 02:36:48', 'leave_early', 'scheduled_appointment'),
(104, 76, '2023-11-09 02:45:42', 'absent', '病気'),
(105, 76, '2023-11-09 02:45:48', 'absent', '事故'),
(106, 76, '2023-11-09 02:46:07', 'lateness', ''),
(107, 76, '2023-11-09 02:46:12', 'lateness', ''),
(108, 76, '2023-11-09 02:46:19', 'lateness', '家庭の事情'),
(109, 76, '2023-11-09 02:47:12', 'lateness', '交通の問題'),
(110, 76, '2023-11-09 02:47:17', 'lateness', '体調不要'),
(111, 76, '2023-11-09 02:47:31', 'lateness', '忘れ物'),
(112, 76, '2023-11-09 02:47:37', 'leave_early', '体調不要'),
(113, 76, '2023-11-09 02:47:46', 'leave_early', '家庭の事情'),
(114, 76, '2023-11-09 02:47:57', 'leave_early', '必要な予定'),
(115, 76, '2023-11-09 02:48:07', 'official_absence', '企業に関する事情'),
(116, 76, '2023-11-09 02:48:29', 'official_absence', '学校行事'),
(117, 76, '2023-11-09 02:48:34', 'absent', '病気');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `card_id` varchar(16) NOT NULL,
  `class` enum('1B','2B') NOT NULL,
  `name` varchar(16) NOT NULL,
  `email` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `card_id`, `class`, `name`, `email`, `password`, `role`) VALUES
(76, '111', '2B', 'bbbb', 'bancardsme@gmail', 'nahayama', 'student'),
(81, '1228533300', '2B', 'tester', 'test@sample.com', '12345678', 'student'),
(82, '1292110232', '1B', 'yayaya', 'shikouyihong@gma', 'gggggggg', 'student');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
