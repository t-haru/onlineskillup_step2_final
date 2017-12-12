-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017 年 12 朁E12 日 10:43
-- サーバのバージョン： 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `follower_id`) VALUES
(1, 4, 2),
(2, 1, 3),
(3, 1, 2),
(4, 1, 4),
(5, 3, 1),
(19, 1, 11),
(20, 1, 12),
(23, 1, 21),
(24, 7, 1),
(25, 7, 21),
(26, 1, 7),
(27, 1, 20),
(30, 1, 10);

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tweet` char(140) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `tweet`, `created`) VALUES
(20, 3, 'good', '2017-12-09 08:40:01'),
(3, 1, 'Hello', '2017-12-03 18:36:36'),
(19, 1, 'I am A', '2017-12-05 00:54:37'),
(18, 1, 'Nice', '2017-12-05 00:51:44'),
(17, 1, 'Thanks', '2017-12-05 00:50:22'),
(16, 1, 'Hi', '2017-12-05 00:49:49'),
(15, 3, 'Thank you', '2017-12-04 18:19:13'),
(14, 2, 'Good', '2017-12-04 18:18:51'),
(24, 3, 'hello', '2017-12-09 09:42:20'),
(25, 3, 'abcdefg\r\nhijklmn\r\nopqrstu\r\nvwxyz', '2017-12-09 09:45:44'),
(26, 1, 'good night', '2017-12-09 11:06:10'),
(27, 1, 'http://localhost/cakephp/posts/index', '2017-12-09 11:11:53'),
(29, 4, 'nice to meet you', '2017-12-09 23:10:52'),
(30, 2, 'good', '2017-12-10 09:11:46'),
(31, 11, 'K', '2017-12-11 10:03:47'),
(32, 12, 'L', '2017-12-11 10:04:00'),
(33, 7, 'zzz', '2017-12-11 14:33:18');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` char(255) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created`) VALUES
(1, 'AAAA', 'AAAA', '2e1f7b0492d0c798c746068554989bba9fb838e9', 'AAA@aaa.mail', '2017-11-30 15:00:00'),
(2, 'BBBB', 'BBBB', 'edb37b3d8aab96ace11c6851ec8273c357d17c4b', 'BBB@bbb.mail', '2017-12-02 03:00:00'),
(3, 'CCCC', 'CCCC', 'dca5c2667be9ac877f6780897ece84ad37bcb706', 'CCC@ccc.mail', '2017-12-02 15:00:00'),
(4, 'DDDD', 'DDDD', '3faea26ac0ca4e1ac506d43436301e5e1ed1080b', 'DDD@ddd.mail', '2017-12-03 15:00:00'),
(5, 'EEEE', 'EEEE', 'd98ead44634a53bcaf9329e1aba57e5e66321978', 'EEE@eee.mail', '2017-12-05 11:00:00'),
(6, 'FFFF', 'FFFF', '77289caf85db66322a088765885882e106517c3d', 'FFF@fff.mail', '2017-12-04 15:00:00'),
(7, 'GGGG', 'GGGG', '2e1650ecfc05fa586704f00528e20a99dded2fac', 'GGG@ggg.mail', '2017-12-05 15:00:00'),
(8, 'HHHH', 'HHHH', 'f469fae2b82d676ec23cd0795ceb55c9c028da34', 'HHH@hhh.mail', '2017-12-06 15:00:00'),
(9, 'IIII', 'IIII', '7ad2ef73700c5ecfa5cd4a7027174bcfecbcca5d', 'III@iii.mail', '2017-12-07 15:00:00'),
(10, 'JJJJ', 'JJJJ', 'bf3ad81b8f25559a4e17ba37de5b909d4c8aaf5a', 'JJJ@jjj.mail', '2017-12-08 15:00:00'),
(11, 'KKKK', 'KKKK', 'b8b24a368b66bf4eb2f4c6172e23fbd04cc467c9', 'KKK@kkk.mail', '2017-12-09 18:00:00'),
(12, 'LLLL', 'LLLL', '0af6e3443cb164a0406fed2b14c604f4c43b7266', 'LLL@lll.mail', '2017-12-11 12:00:00'),
(13, 'MMMM', 'MMMM', '71a672a4df61041a544665b08d8b8df842d1e321', 'MMM@mmm.mail', '2017-12-11 15:00:00'),
(20, 'NNNN', 'NNNN', '7029e716f7930b000cc4c4baf5d7e889a7f60939', 'NNN@nnn.mail', '2017-12-11 17:00:00'),
(21, 'ABCD', 'ABCD', 'aba9d3e7c19284a383b97c03e1531373a0d1da8f', 'ABCD@abcd.mail', '2017-12-11 13:15:16'),
(22, 'ã´ã‚ˆ', 'piyo', '84bb3fd67adcd91b38105b870eee3a5f89835308', 'piyo@piyo.mail', '2017-12-11 23:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`,`user_id`,`follower_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
