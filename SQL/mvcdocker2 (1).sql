-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019-07-08 17:56:37
-- 服务器版本： 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcdocker2`
--

-- --------------------------------------------------------

--
-- 表的结构 `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `addresse` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `address`
--

INSERT INTO `address` (`id`, `name`, `addresse`, `city`, `postal`, `phone`, `date_inserted`, `code`) VALUES
(2, 'WANG', '34 RUE CHARLES GUSTAVE STOSKOPF', 'CRETEIL', '94000', '+33768152335', '2019-07-08 15:10:53', 'c2abb5dc41eff291c7f5f2d34023fd1d'),
(3, 'WANG', '34 RUE CHARLES GUSTAVE STOSKOPF', 'CRETEIL', '94000', '+33768152335', '2019-07-08 15:11:25', '00bd3a4342f7068497e7b158354f1450'),
(4, 'DELETE', '34 RUE CHARLES-GUSTAVE STOSKOPF FR', 'PARIS', '87000', '56446468', '2019-07-08 15:29:38', '51edbe9cec481db95693df9a46492920');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `date_inserted`) VALUES
(1, 'francais', '2019-05-28 20:29:11'),
(2, 'italien', '2019-05-28 20:29:11'),
(3, 'japonais', '2019-05-28 20:29:28'),
(4, 'pizza', '2019-05-28 20:29:28'),
(5, 'chinois', '2019-05-28 20:29:47'),
(6, 'indien', '2019-05-28 20:29:47'),
(7, 'burger', '2019-05-28 20:30:17'),
(8, 'kebab', '2019-05-28 20:30:17'),
(9, 'wok', '2019-05-28 20:30:31'),
(10, 'turc', '2019-05-28 20:30:31'),
(11, 'halal', '2019-05-28 20:31:00'),
(12, 'fruits de mer', '2019-05-28 20:31:00');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  `star` tinyint(4) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `id_restaurant`, `id_plat`, `star`, `id_user`, `contenu`, `date_inserted`) VALUES
(2, 3, 16, 4, 8, 'dqsfqsf', '2019-06-25 15:55:32'),
(5, 3, 16, 4, 7, 'wow', '2019-07-02 10:37:52');

-- --------------------------------------------------------

--
-- 表的结构 `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `id_restaurant` int(11) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `contenu`, `image`, `price`, `status`, `id_restaurant`, `date_inserted`) VALUES
(13, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(16, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(17, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(18, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(19, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(20, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(21, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(22, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(23, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(24, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(25, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(26, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(27, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(28, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 3, '2019-06-17 18:22:34'),
(29, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 3, '2019-06-16 22:02:35'),
(30, 'Fromage', '<p>La description de plat</p>', 'c0e337802ea2ff138e203574f1ca2d8c.jpeg', 5.6, 1, 3, '2019-06-17 20:35:25'),
(32, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 1, '2019-06-16 22:02:35'),
(33, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 1, '2019-06-17 18:22:34'),
(34, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 1, '2019-06-16 22:02:35'),
(35, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 1, '2019-06-16 22:02:35'),
(36, 'Pizza test', '<p>La description de plat for test</p>', 'a8b21adcd34a6b8aa02f26af074562c2.jpeg', 20, 1, 1, '2019-06-17 18:22:34'),
(37, 'Pizza test', 'La description de plat for test', 'b6a5ba2ad232dbba4cb618100b146303.jpeg', 19.5, 1, 1, '2019-06-16 22:02:35');

-- --------------------------------------------------------

--
-- 表的结构 `fonts`
--

CREATE TABLE `fonts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `fonts`
--

INSERT INTO `fonts` (`id`, `name`, `content`) VALUES
(1, 'Arial', 'Arial, Helvetica, sans-serif'),
(2, 'Comic Sans MS', '\'Comic Sans MS\', cursive'),
(3, 'Courier New', '\'Courier New\', Courier, monospace');

-- --------------------------------------------------------

--
-- 表的结构 `list_dishes_delivery`
--

CREATE TABLE `list_dishes_delivery` (
  `id` int(11) NOT NULL,
  `id_dishes` int(11) NOT NULL,
  `code` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `list_dishes_delivery`
--

INSERT INTO `list_dishes_delivery` (`id`, `id_dishes`, `code`) VALUES
(2, 16, '125b01942dd487feeffa07281bdc0b46'),
(3, 13, '125b01942dd487feeffa07281bdc0b46'),
(4, 16, '51edbe9cec481db95693df9a46492920');

-- --------------------------------------------------------

--
-- 表的结构 `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `montant` float NOT NULL,
  `id_method` tinyint(4) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  `code` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `livraison`
--

INSERT INTO `livraison` (`id`, `montant`, `id_method`, `id_restaurant`, `id_client`, `date_inserted`, `status`, `code`) VALUES
(2, 39.5, 4, 3, 7, '2019-07-08 15:01:29', 2, '125b01942dd487feeffa07281bdc0b46'),
(3, 20, 4, 3, 7, '2019-07-08 15:29:38', 2, '51edbe9cec481db95693df9a46492920');

-- --------------------------------------------------------

--
-- 表的结构 `livraison_status`
--

CREATE TABLE `livraison_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `livraison_status`
--

INSERT INTO `livraison_status` (`id`, `name`) VALUES
(1, 'Non Payé'),
(2, 'Payé');

-- --------------------------------------------------------

--
-- 表的结构 `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `method`
--

INSERT INTO `method` (`id`, `name`) VALUES
(1, 'Paypal'),
(2, 'Buyster'),
(3, 'Especes'),
(4, 'Carte Banciare'),
(5, 'Tikets Restaurants'),
(6, 'Cheques'),
(7, 'Corporate');

-- --------------------------------------------------------

--
-- 表的结构 `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `id_category` tinyint(4) NOT NULL,
  `template` tinyint(4) NOT NULL,
  `id_fonts` int(11) NOT NULL,
  `button` varchar(10) CHARACTER SET utf8 NOT NULL,
  `text` varchar(10) CHARACTER SET utf8 NOT NULL,
  `id_user` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `description`, `id_category`, `template`, `id_fonts`, `button`, `text`, `id_user`, `image`, `status`, `date_inserted`) VALUES
(1, 'Chez Julien ', 'Deux crÃªpes Ã©paisses servies accompagnÃ©es de mÃ©lasse et de notre crÃ¨me fouettÃ©e signature infusÃ©e de sassafras.', 1, 1, 1, '#ffd479', '#8efa00', 2, 'df0de238ebcb89ea8d926b4bc139c8a6.jpeg', 1, '2019-06-17 21:16:26'),
(3, 'CrÃªpes Ã‰paisses au Babeurre â€” 10001', 'Petit dÃ©jeuner â€” Servi tous les jours, de 07h00 Ã  11h00.', 1, 1, 2, '#ff2600', '#8efa00', 7, 'bca238475e6169b7c2d10457730999cd.jpeg', 1, '2019-06-17 21:13:19');

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE `role` (
  `id` tinyint(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Client'),
(2, 'Restaurateur'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- 表的结构 `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `template`
--

INSERT INTO `template` (`id`, `name`, `path`) VALUES
(1, 'Template1', 'template1'),
(2, 'Template2', 'template2');

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `accesstoken` varchar(32) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `Users`
--

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `phone`, `email`, `pwd`, `status`, `role`, `accesstoken`, `date_inserted`) VALUES
(2, 'Zhenchao132', 'WANG', NULL, 'wangzhenchao@test.com', '$2y$10$7heMCPLlmEC.ilcN3LXU8eUpKqmGKmxjwQzuEKe0FSOKsv.0B3PJy', 1, 2, '5d68db4187b19b3ec685e426ceb46937', '2019-04-30 13:41:10'),
(6, 'Wang', 'ZHENCHAO', NULL, 'lucien33@live.com', '$2y$10$k.XNPbSQ5/iBl0clmFX.5.kJghQ71OBBx3/eautWvSkpOniJC0u6K', 1, 1, 'e958faade896563e98b721e255a08906', '2019-05-26 22:00:43'),
(7, 'Wang', 'ZHENCHAO', NULL, 'info.lwfr@gmail.com', '$2y$10$sSER1LFU9GOLQPZnGhZj2e7nfSbRA3E83YUjWciG2sYhvRgCut7WO', 1, 2, 'bd1cee6b513c9607f1bc21d7405724f9', '2019-05-26 22:27:16'),
(8, 'Zhenchao', 'WANG', NULL, 'luciend33@live.com', '$2y$10$i8yASRYjxp75TEg4hw/h0ew7q7wlaC9mNOTv0Eg7bfM0SLUB0t.Ym', 0, 1, '62bc1f659bb300b75c2226a3ff9a5772', '2019-06-27 15:47:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_dishes_delivery`
--
ALTER TABLE `list_dishes_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livraison_status`
--
ALTER TABLE `livraison_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- 使用表AUTO_INCREMENT `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `list_dishes_delivery`
--
ALTER TABLE `list_dishes_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `livraison_status`
--
ALTER TABLE `livraison_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `method`
--
ALTER TABLE `method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
