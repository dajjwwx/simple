-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-24 04:18:04
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplegaokao`
--

-- --------------------------------------------------------

--
-- 表的结构 `gk_coursepaper`
--

CREATE TABLE IF NOT EXISTS `gk_coursepaper` (
  `id` int(11) NOT NULL,
  `province` int(11) NOT NULL COMMENT '省份ID',
  `course` int(11) NOT NULL COMMENT '科目',
  `paper` int(11) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gk_coursepaper`
--

INSERT INTO `gk_coursepaper` (`id`, `province`, `course`, `paper`, `year`) VALUES
(1, 17, 1, 8, '2015'),
(2, 17, 2, 8, '2015'),
(3, 17, 3, 8, '2015'),
(4, 17, 4, 8, '2015'),
(5, 17, 6, 1, '2015'),
(6, 17, 5, 1, '2015'),
(7, 18, 1, 1, '2015'),
(8, 18, 2, 9, '2015'),
(9, 18, 3, 9, '2015'),
(10, 18, 4, 9, '2015'),
(11, 18, 5, 1, '2015'),
(12, 18, 6, 1, '2015'),
(13, 21, 9, 5, '2015'),
(14, 21, 8, 5, '2015'),
(15, 21, 7, 5, '2015'),
(16, 21, 10, 5, '2015'),
(17, 21, 11, 5, '2015'),
(18, 21, 12, 5, '2015'),
(19, 21, 1, 2, '2015'),
(20, 21, 2, 2, '2015'),
(21, 21, 3, 2, '2015'),
(22, 21, 4, 2, '2015'),
(23, 27, 2, 13, '2015'),
(24, 27, 3, 13, '2015'),
(25, 27, 4, 13, '2015'),
(26, 27, 1, 1, '2015'),
(27, 27, 5, 1, '2015'),
(28, 27, 6, 1, '2015');

-- --------------------------------------------------------

--
-- 表的结构 `gk_gaokao`
--

CREATE TABLE IF NOT EXISTS `gk_gaokao` (
  `id` int(11) NOT NULL,
  `course` tinyint(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `paper` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gk_gaokao`
--

INSERT INTO `gk_gaokao` (`id`, `course`, `year`, `paper`, `fid`, `pid`) VALUES
(1, 1, '2015', 1, 40, 0),
(3, 2, '2015', 3, 43, 0),
(4, 2, '2015', 4, 43, 0),
(5, 2, '2015', 5, 43, 0),
(6, 2, '2015', 6, 43, 0),
(7, 1, '2014', 7, 44, 0),
(8, 5, '2014', 8, 45, 0),
(15, 5, '2015', 1, 79, 0),
(17, 2, '2015', 14, 81, 0),
(18, 2, '2015', 14, 82, 0),
(19, 1, '2015', 1, 83, 1),
(20, 1, '2015', 14, 86, 0),
(23, 1, '2015', 13, 100, 0),
(26, 1, '2015', 14, 107, 20);

-- --------------------------------------------------------

--
-- 表的结构 `gk_paper`
--

CREATE TABLE IF NOT EXISTS `gk_paper` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` varchar(4) NOT NULL,
  `provinces` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gk_paper`
--

INSERT INTO `gk_paper` (`id`, `name`, `year`, `provinces`) VALUES
(1, '新课标全国Ⅰ卷', '2015', '3,4,14,16'),
(2, '新课标全国Ⅱ卷', '2015', '5,6,7,8,20,24,25,26,28,29,30,31'),
(3, '安徽卷', '2015', '12'),
(4, '北京卷', '2015', '1'),
(5, '重庆卷', '2015', '22'),
(6, '福建卷', '2015', '13'),
(7, '海南卷', '2015', '21'),
(8, '湖北卷', '2015', '17'),
(9, '湖南卷', '2015', '18'),
(10, '江苏卷', '2015', '10'),
(11, '山东卷', '2015', '15'),
(12, '上海卷', '2015', '9'),
(13, '陕西卷', '2015', '27'),
(14, '四川卷', '2015', '23'),
(15, '天津卷', '2015', '2'),
(16, '浙江卷', '2015', '11'),
(17, '四川卷', '2014', '23'),
(18, '上海卷', '2014', '9'),
(19, '新课标全国Ⅰ卷', '2014', '3,4,16'),
(20, '新课标全国Ⅱ卷', '2014', '5,24,26,28,29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gk_coursepaper`
--
ALTER TABLE `gk_coursepaper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province` (`province`,`paper`),
  ADD KEY `paper` (`paper`);

--
-- Indexes for table `gk_gaokao`
--
ALTER TABLE `gk_gaokao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fid` (`fid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `paper` (`paper`);

--
-- Indexes for table `gk_paper`
--
ALTER TABLE `gk_paper`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gk_coursepaper`
--
ALTER TABLE `gk_coursepaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `gk_gaokao`
--
ALTER TABLE `gk_gaokao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `gk_paper`
--
ALTER TABLE `gk_paper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- 限制导出的表
--

--
-- 限制表 `gk_coursepaper`
--
ALTER TABLE `gk_coursepaper`
  ADD CONSTRAINT `gk_coursepaper_ibfk_1` FOREIGN KEY (`province`) REFERENCES `qdm165430425`.`sb_region` (`id`),
  ADD CONSTRAINT `gk_coursepaper_ibfk_2` FOREIGN KEY (`paper`) REFERENCES `gk_paper` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
