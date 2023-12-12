-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-12-08 04:03:51
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
  `is_request` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('attend','absent','lateness','leave_early','official_absence','other') DEFAULT NULL,
  `comment` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `mailbox`
--

CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` varchar(32) DEFAULT NULL,
  `message` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `mailbox`
--

INSERT INTO `mailbox` (`id`, `from_user_id`, `to_user_id`, `is_read`, `timestamp`, `title`, `message`) VALUES
(33, 1, 280, 0, '2023-12-08 02:41:12', 'アカウント作成のご完了お知らせ', 'こんにちは 岡部 賢 様,\r\n\r\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\r\n            以下は、ご登録いただいたアカウント情報です。\r\n\r\n            ユーザー名: 岡部 賢\r\n            メールアドレス: kanefrendrex@gmail.com\r\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\r\n\r\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\r\n            ログイン情報は第三者に漏れないようにご注意ください。\r\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\r\n\r\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\r\n\r\n\r\n\r\n            ACSystem Teamより'),
(34, 1, 280, 0, '2023-12-08 02:41:29', 'アカウント情報の更新が完了しました', '\r\n    こんにちは 岡部 賢 様,\r\n\r\n    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。\r\n\r\n    アカウント情報の変更が正常に完了しました。\r\n    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。\r\n\r\n    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。\r\n\r\n    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。\r\n\r\n    どうぞよろしくお願いいたします。\r\n\r\n\r\n\r\n    ACSystem Teamより'),
(35, 1, 280, 0, '2023-12-08 02:41:38', 'アカウント情報の更新が完了しました', '\r\n    こんにちは 岡部 賢 様,\r\n\r\n    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。\r\n\r\n    アカウント情報の変更が正常に完了しました。\r\n    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。\r\n\r\n    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。\r\n\r\n    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。\r\n\r\n    どうぞよろしくお願いいたします。\r\n\r\n\r\n\r\n    ACSystem Teamより');

-- --------------------------------------------------------

--
-- テーブルの構造 `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` enum('News','Notification','Update','Maintenance') NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `notifications`
--

INSERT INTO `notifications` (`id`, `timestamp`, `category`, `title`) VALUES
(1, '2023-09-30 15:00:00', 'Update', 'ver 1.0.0が公開されました。'),
(2, '2023-10-23 15:00:00', 'Update', 'ver 1.1.0が公開されました。'),
(3, '2023-10-23 15:00:00', 'Notification', '出欠履歴が見れるようになりました。'),
(4, '2023-11-10 15:00:00', 'Update', 'ver 1.2.0が公開されました。'),
(5, '2023-12-03 15:00:00', 'Notification', 'メールボックスが見れるようになりました。'),
(6, '2023-12-04 15:00:00', 'News', 'http://mtdacsystem.starfree.jp でサイトが公開されました。'),
(7, '2023-12-04 15:00:00', 'Update', 'ver 2.0.0が公開されました。');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `card_id` varchar(16) NOT NULL,
  `class` enum('1B','2B') NOT NULL,
  `name` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `card_id`, `class`, `name`, `email`, `password`, `role`) VALUES
(1, '1', '2B', 'ACSystem Team', 'bancardsme@gmail.com', 'activateloginadmin', 'admin'),
(280, '3216390547', '2B', '岡部 賢', 'kanefrendrex@gmail.com', '05961cbd33daee45959e30a1f5a658ca', 'student');

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
-- テーブルのインデックス `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- テーブルのインデックス `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- テーブルの AUTO_INCREMENT `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- テーブルの AUTO_INCREMENT `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `mailbox`
--
ALTER TABLE `mailbox`
  ADD CONSTRAINT `mailbox_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mailbox_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
