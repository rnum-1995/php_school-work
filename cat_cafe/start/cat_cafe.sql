-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-03-13 02:11:30
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
-- データベース: `cat_cafe`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_id` char(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `branches`
--

INSERT INTO `branches` (`id`, `branch_id`, `name`, `address`, `tel`, `created_at`, `updated_at`) VALUES
(1, 'B-01', '本店', '福岡県福岡市中央区天神1-1-1', '092-123-4567', '2026-03-12 15:09:53', '2026-03-12 15:09:53'),
(2, 'B-02', '駅前店', '福岡県福岡市博多区博多駅前2-2-2', '092-234-5678', '2026-03-12 15:09:53', '2026-03-12 15:09:53'),
(3, 'B-03', '郊外店', '福岡県福岡市早良区藤崎3-3-3', '092-345-6789', '2026-03-12 15:09:53', '2026-03-12 15:09:53');

-- --------------------------------------------------------

--
-- テーブルの構造 `breeds`
--

CREATE TABLE `breeds` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `breeds`
--

INSERT INTO `breeds` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ミックス', '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(2, 'マンチカン', '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(3, 'スコティッシュフォールド', '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(4, 'アメリカンショートヘア', '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(5, 'ラグドール', '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(6, 'ベンガル', '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(7, 'ロシアンブルー', '2026-03-09 10:23:54', '2026-03-09 10:23:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `breed_id` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1:おとこのこ 2:おんなのこ',
  `age` int(11) NOT NULL,
  `profile` text DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `cats`
--

INSERT INTO `cats` (`id`, `name`, `breed_id`, `gender`, `age`, `profile`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 'たまみ', 4, 2, 6, 'のんびり屋でいつも日向ぼっこをしています。\r\nげんきいっぱい！\r\nうぇいうぇい', 'cat_01_2.png', '2026-03-09 10:23:54', '2026-03-09 15:40:54'),
(2, 'ミケ', 1, 2, 2, '好奇心旺盛！おもちゃが大好きです。', NULL, '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(3, 'レオ', 2, 1, 4, '短い足で一生懸命走る姿がキュートです。', NULL, '2026-03-09 10:23:54', '2026-03-09 10:23:54'),
(4, 'モモ', 3, 2, 1, '甘えん坊で人懐っこい性格です。', NULL, '2026-03-09 10:23:54', '2026-03-09 10:23:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu_id` char(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'M-01', 'アイスコーヒー', 400, '2026-03-12 15:32:03', '2026-03-12 15:32:03'),
(2, 'M-02', 'カフェラテ', 500, '2026-03-12 15:32:03', '2026-03-12 15:32:03'),
(3, 'M-05', '猫用ちゅーる', 300, '2026-03-12 15:32:03', '2026-03-12 15:32:03'),
(4, 'M-06', '猫じゃらしレンタル', 200, '2026-03-12 15:32:03', '2026-03-12 15:32:03');

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `receipt_no` char(6) NOT NULL,
  `register_date` datetime NOT NULL DEFAULT current_timestamp(),
  `branch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `orders`
--

INSERT INTO `orders` (`id`, `receipt_no`, `register_date`, `branch_id`, `staff_id`, `created_at`, `updated_at`) VALUES
(1, 'R-1001', '2026-06-15 14:30:00', 1, 1, '2026-03-12 15:39:06', '2026-03-12 15:39:06'),
(2, 'R-1002', '2026-06-15 15:00:00', 2, 2, '2026-03-12 15:39:55', '2026-03-12 15:39:55'),
(3, 'R-1003', '2026-06-15 16:15:00', 1, 3, '2026-03-12 15:39:55', '2026-03-12 15:39:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `receipt_no` char(6) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `qty` int(2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `order_details`
--

INSERT INTO `order_details` (`id`, `receipt_no`, `menu_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'R-1001', 1, 1, '2026-03-12 15:49:05', '2026-03-12 15:49:05'),
(2, 'R-1001', 3, 2, '2026-03-12 15:49:05', '2026-03-12 15:49:05'),
(3, 'R-1002', 2, 1, '2026-03-12 15:49:05', '2026-03-12 15:49:05'),
(4, 'R-1003', 2, 1, '2026-03-12 15:49:05', '2026-03-12 15:49:05'),
(5, 'R-1003', 4, 1, '2026-03-12 15:49:05', '2026-03-12 15:49:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `order_details_options`
--

CREATE TABLE `order_details_options` (
  `id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `menu_option` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `order_details_options`
--

INSERT INTO `order_details_options` (`id`, `order_detail_id`, `menu_option`, `created_at`, `updated_at`) VALUES
(7, 1, '氷少なめ', '2026-03-12 16:08:13', '2026-03-12 16:08:13'),
(8, 1, 'シロップ', '2026-03-12 16:08:13', '2026-03-12 16:08:13'),
(9, 3, 'ホイップ追加', '2026-03-12 16:08:13', '2026-03-12 16:08:13'),
(10, 3, 'チョコソース', '2026-03-12 16:08:13', '2026-03-12 16:08:13'),
(11, 5, '新品交換', '2026-03-12 16:08:13', '2026-03-12 16:08:13'),
(12, 5, 'マタタビスプレー', '2026-03-12 16:08:13', '2026-03-12 16:08:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `name`, `branch_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'S-001', '佐藤', 1, '店長', '2026-03-12 15:20:55', '2026-03-12 15:20:55'),
(2, 'S-002', '鈴木', 2, 'アルバイト', '2026-03-12 15:20:55', '2026-03-12 15:20:55'),
(3, 'S-003', '高橋', 3, 'アルバイト', '2026-03-12 15:20:55', '2026-03-12 15:20:55');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branch_id` (`branch_id`);

--
-- テーブルのインデックス `breeds`
--
ALTER TABLE `breeds`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`),
  ADD KEY `fk_breed_id` (`breed_id`);

--
-- テーブルのインデックス `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_id` (`menu_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt_no` (`receipt_no`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- テーブルのインデックス `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `receipt_no` (`receipt_no`);

--
-- テーブルのインデックス `order_details_options`
--
ALTER TABLE `order_details_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_id` (`order_detail_id`);

--
-- テーブルのインデックス `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `breeds`
--
ALTER TABLE `breeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `order_details_options`
--
ALTER TABLE `order_details_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `cats_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `breeds` (`id`);

--
-- テーブルの制約 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- テーブルの制約 `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`receipt_no`) REFERENCES `orders` (`receipt_no`);

--
-- テーブルの制約 `order_details_options`
--
ALTER TABLE `order_details_options`
  ADD CONSTRAINT `order_details_options_ibfk_1` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`);

--
-- テーブルの制約 `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
