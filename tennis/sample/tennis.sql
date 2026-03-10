-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-02-16 02:22:05
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `tennis`
--
CREATE DATABASE IF NOT EXISTS `tennis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tennis`;

-- --------------------------------------------------------

--
-- テーブルの構造 `bbs`
--

CREATE TABLE `bbs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `pass` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `bbs`
--

INSERT INTO `bbs` (`id`, `name`, `title`, `body`, `date`, `pass`) VALUES
(1, 'ふくもと', 'UPDATEで更新', 'ほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいる\r\n\r\nほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいるほんぶんがはいる', '2026-02-13 12:51:56', '1234'),
(2, 'ふくもと', 'INSERT文練習', 'ほんぶんがはいる本文がはいる', '2026-02-13 12:26:26', '1234'),
(4, 'ふくもと', 'INSERTでまとめて挿入', 'ほんぶんがはいる本文がはいる', '2026-02-13 12:32:44', '1234'),
(6, 'やまだ', 'IDは何番？', 'ほんぶんほんぶん', '2026-02-13 12:57:42', '1234'),
(7, 'ふくもと', 'PDO書きました', 'おにぎりでインスタンス化を説明したけど、あんまりわかってもらえませんでした。辛い。', '2026-02-13 15:22:49', '1234'),
(8, 'ふくふく', '', 'タイトルを空欄にする', '2026-02-13 16:05:49', '1234');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bbs`
--
ALTER TABLE `bbs`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bbs`
--
ALTER TABLE `bbs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
