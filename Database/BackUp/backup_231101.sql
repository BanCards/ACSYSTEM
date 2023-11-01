-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-11-01 02:58:58
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
(19, 65, '2023-10-31 07:45:42', 'attend', 'カードによる出席'),
(20, 65, '2023-10-31 07:46:26', 'attend', 'カードによる出席'),
(21, 65, '2023-10-31 07:50:57', 'attend', 'カードによる出席'),
(22, 65, '2023-10-31 07:51:25', 'attend', 'カードによる出席'),
(23, 65, '2023-10-31 07:51:28', 'attend', 'カードによる出席'),
(24, 65, '2023-10-31 07:52:33', 'attend', 'カードによる出席'),
(25, 66, '2023-10-31 07:52:43', 'attend', 'カードによる出席'),
(26, 67, '2023-10-31 07:52:47', 'attend', 'カードによる出席'),
(27, 65, '2023-11-01 00:55:44', 'attend', 'カードによる出席'),
(28, 65, '2023-11-01 00:58:37', 'attend', 'カードによる出席'),
(29, 65, '2023-11-01 01:03:06', 'attend', 'カードによる出席'),
(30, 67, '2023-11-01 01:07:43', 'attend', 'カードによる出席'),
(31, 67, '2023-11-01 01:08:19', 'attend', 'カードによる出席'),
(32, 66, '2023-11-01 01:11:52', 'attend', 'カードによる出席'),
(33, 65, '2023-11-01 01:11:57', 'attend', 'カードによる出席'),
(34, 67, '2023-11-01 01:12:01', 'attend', 'カードによる出席'),
(35, 65, '2023-11-01 01:19:49', 'attend', 'カードによる出席'),
(36, 65, '2023-11-01 01:20:59', 'attend', 'カードによる出席'),
(37, 65, '2023-11-01 01:21:06', 'attend', 'カードによる出席');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `card_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `card_id`, `name`, `email`, `password`, `role`) VALUES
(65, '1233627700', 'BanCards', 'bancardsme@gmail.com', 'nahayama', 'student'),
(66, '3444668414', 'test', 'test@sample.com', '12345678', 'student'),
(67, '1228533300', 'えばこ', 'ebabako@gmail.com', 'ebaebako', 'student');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

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
