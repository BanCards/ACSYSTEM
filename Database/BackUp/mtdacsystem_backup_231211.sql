-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: mysql1.php.starfree.ne.jp
-- Generation Time: 2023 年 12 月 11 日 10:23
-- サーバのバージョン： 5.7.27
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtdacsystem_acsystem`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_request` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('attend','absent','lateness','leave_early','official_absence','other') DEFAULT NULL,
  `comment` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `is_request`, `timestamp`, `status`, `comment`) VALUES
(163, 280, 0, '2023-12-08 03:07:41', 'attend', 'カードによる出席'),
(165, 282, 0, '2023-12-08 06:13:13', 'attend', 'カードによる出席'),
(166, 283, 0, '2023-12-08 06:27:50', 'attend', 'カードによる出席'),
(167, 284, 0, '2023-12-08 06:37:53', 'attend', 'カードによる出席'),
(168, 286, 1, '2023-12-08 06:54:41', 'absent', '事故'),
(169, 287, 0, '2023-12-08 07:09:28', 'attend', 'カードによる出席'),
(170, 288, 0, '2023-12-08 07:12:50', 'attend', 'カードによる出席'),
(171, 289, 0, '2023-12-08 07:33:24', 'attend', 'カードによる出席'),
(172, 291, 0, '2023-12-08 07:51:53', 'attend', 'カードによる出席'),
(173, 290, 0, '2023-12-08 07:52:09', 'attend', 'カードによる出席'),
(174, 280, 0, '2023-12-11 00:52:39', 'attend', 'カードによる出席');

-- --------------------------------------------------------

--
-- テーブルの構造 `mailbox`
--

CREATE TABLE IF NOT EXISTS `mailbox` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(32) DEFAULT NULL,
  `message` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `mailbox`
--

INSERT INTO `mailbox` (`id`, `from_user_id`, `to_user_id`, `is_read`, `timestamp`, `title`, `message`) VALUES
(33, 1, 280, 1, '2023-12-08 02:41:12', 'アカウント作成のご完了お知らせ', 'こんにちは 岡部 賢 様,\r\n\r\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\r\n            以下は、ご登録いただいたアカウント情報です。\r\n\r\n            ユーザー名: 岡部 賢\r\n            メールアドレス: kanefrendrex@gmail.com\r\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\r\n\r\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\r\n            ログイン情報は第三者に漏れないようにご注意ください。\r\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\r\n\r\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\r\n\r\n\r\n\r\n            ACSystem Teamより'),
(34, 1, 280, 1, '2023-12-08 02:41:29', 'アカウント情報の更新が完了しました', '\r\n    こんにちは 岡部 賢 様,\r\n\r\n    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。\r\n\r\n    アカウント情報の変更が正常に完了しました。\r\n    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。\r\n\r\n    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。\r\n\r\n    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。\r\n\r\n    どうぞよろしくお願いいたします。\r\n\r\n\r\n\r\n    ACSystem Teamより'),
(35, 1, 280, 1, '2023-12-08 02:41:38', 'アカウント情報の更新が完了しました', '\r\n    こんにちは 岡部 賢 様,\r\n\r\n    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。\r\n\r\n    アカウント情報の変更が正常に完了しました。\r\n    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。\r\n\r\n    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。\r\n\r\n    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。\r\n\r\n    どうぞよろしくお願いいたします。\r\n\r\n\r\n\r\n    ACSystem Teamより'),
(39, 1, 282, 1, '2023-12-08 06:12:55', 'アカウント作成のご完了お知らせ', 'こんにちは 大竹馬 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 大竹馬\n            メールアドレス: matumotoff14@icloud.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(40, 1, 283, 1, '2023-12-08 06:27:10', 'アカウント作成のご完了お知らせ', 'こんにちは 寺門　梗吾 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 寺門　梗吾\n            メールアドレス: abc@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(41, 1, 284, 0, '2023-12-08 06:37:42', 'アカウント作成のご完了お知らせ', 'こんにちは 野口　海斗 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 野口　海斗\n            メールアドレス: ghdgfguehud@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(42, 1, 285, 0, '2023-12-08 06:40:18', 'アカウント作成のご完了お知らせ', 'こんにちは おがわしゅ 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: おがわしゅ\n            メールアドレス: EG@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(43, 1, 286, 1, '2023-12-08 06:54:20', 'アカウント作成のご完了お知らせ', 'こんにちは 駒田心恵 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 駒田心恵\n            メールアドレス: hhhhhhhhhhhhhhhhh@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(44, 1, 286, 0, '2023-12-08 06:58:08', 'アカウント情報の更新が完了しました', '\n    こんにちは 駒田心恵 様,\n\n    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。\n\n    アカウント情報の変更が正常に完了しました。\n    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。\n\n    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。\n\n    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。\n\n    どうぞよろしくお願いいたします。\n\n\n\n    ACSystem Teamより'),
(45, 1, 287, 0, '2023-12-08 07:00:24', 'アカウント作成のご完了お知らせ', 'こんにちは 郡司博矢 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 郡司博矢\n            メールアドレス: hahahaha@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(46, 1, 288, 1, '2023-12-08 07:12:12', 'アカウント作成のご完了お知らせ', 'こんにちは hiroto 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: hiroto\n            メールアドレス: hiroto@mito.ac.jp\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(47, 1, 289, 1, '2023-12-08 07:33:11', 'アカウント作成のご完了お知らせ', 'こんにちは Mr.俺 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: Mr.俺\n            メールアドレス: oreore@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(48, 1, 290, 0, '2023-12-08 07:46:12', 'アカウント作成のご完了お知らせ', 'こんにちは 佐俣　昴 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 佐俣　昴\n            メールアドレス: subaru@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより'),
(49, 1, 291, 0, '2023-12-08 07:50:20', 'アカウント作成のご完了お知らせ', 'こんにちは 江橋礼恩 様,\n\n            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。\n            以下は、ご登録いただいたアカウント情報です。\n\n            ユーザー名: 江橋礼恩\n            メールアドレス: ebako@gmail.com\n            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。\n\n            パスワードの安全性を確保するため、定期的に変更を行ってください。\n            ログイン情報は第三者に漏れないようにご注意ください。\n            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。\n\n            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。\n\n\n\n            ACSystem Teamより');

-- --------------------------------------------------------

--
-- テーブルの構造 `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` enum('News','Notification','Update','Maintenance') NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `card_id` varchar(16) NOT NULL,
  `class` enum('1B','2B') NOT NULL,
  `name` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `card_id`, `class`, `name`, `email`, `password`, `role`) VALUES
(1, '1', '2B', 'ACSystem Team', 'bancardsme@gmail.com', 'activateloginadmin', 'admin'),
(280, '3216390547', '2B', '岡部 賢', 'kanefrendrex@gmail.com', '05961cbd33daee45959e30a1f5a658ca', 'admin'),
(281, '3219162643', '2B', 'サンプル男', 'sample@sample.com', '05961cbd33daee45959e30a1f5a658ca', 'admin'),
(282, '1295386776', '1B', '大竹馬', 'matumotoff14@icloud.com', '15f100e80f45dc1543a5ac3489375549', 'student'),
(283, '3444525678', '1B', '寺門　梗吾', 'abc@gmail.com', '4c5f86c785947988fd604bf5dbcdf0e2', 'student'),
(284, '0500905086', '1B', '野口　海斗', 'ghdgfguehud@gmail.com', 'fe008700f25cb28940ca8ed91b23b354', 'student'),
(285, '3218432355', '1B', 'おがわしゅ', 'EG@gmail.com', 'd54d1702ad0f8326224b817c796763c9', 'student'),
(286, '3221761715', '1B', '駒田心恵', 'hoeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '6a9d00685f0bae957e024f58cd315080', 'student'),
(287, '1233627700', '1B', '郡司博矢', 'hahahaha@gmail.com', '9c72446df124ddf214b698c1e2312371', 'student'),
(288, '0079529843', '2B', 'hiroto', 'hiroto@mito.ac.jp', '033b560fb9c021f3f49555f736aad28a', 'teacher'),
(289, '3445377438', '2B', 'Mr.俺', 'oreore@gmail.com', 'd261e7e85769410d9130dcae62887777', 'student'),
(290, '3216390323', '2B', '佐俣　昴', 'subaru@gmail.com', 'ecfa6e7e474de8356795308a4f322f1f', 'student'),
(291, '3444668414', '2B', '江橋礼恩', 'ebako@gmail.com', '86c85bd9110e35940c148f063aa192c1', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100000;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
