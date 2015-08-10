-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-10 21:54:58
-- 服务器版本： 5.5.29
-- PHP Version: 5.5.0alpha2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simplegaokao`
--

-- --------------------------------------------------------

--
-- 表的结构 `gk_coursepaper`
--

CREATE TABLE IF NOT EXISTS `gk_coursepaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` int(11) NOT NULL COMMENT '省份ID',
  `course` int(11) NOT NULL COMMENT '科目',
  `paper` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`paper`),
  KEY `paper` (`paper`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gk_gaokao`
--

CREATE TABLE IF NOT EXISTS `gk_gaokao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` tinyint(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `paper` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`),
  KEY `pid` (`pid`),
  KEY `paper` (`paper`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `gk_gaokao`
--

INSERT INTO `gk_gaokao` (`id`, `course`, `year`, `paper`, `fid`, `pid`) VALUES
(1, 1, '2015', 1, 40, 0),
(2, 1, '2015', 1, 42, 0),
(3, 2, '2015', 1, 43, 0),
(4, 2, '2015', 1, 43, 0),
(5, 2, '2015', 1, 43, 0),
(6, 2, '2015', 1, 43, 0),
(7, 1, '2014', 1, 44, 0),
(8, 5, '2014', 1, 45, 0);

-- --------------------------------------------------------

--
-- 表的结构 `gk_paper`
--

CREATE TABLE IF NOT EXISTS `gk_paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `year` varchar(4) NOT NULL,
  `provinces` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
(18, '上海卷', '2014', '9');

--
-- 限制导出的表
--

--
-- 限制表 `gk_coursepaper`
--
ALTER TABLE `gk_coursepaper`
  ADD CONSTRAINT `gk_coursepaper_ibfk_1` FOREIGN KEY (`province`) REFERENCES `simplebase`.`sb_region` (`id`),
  ADD CONSTRAINT `gk_coursepaper_ibfk_2` FOREIGN KEY (`paper`) REFERENCES `gk_paper` (`id`);

--
-- 限制表 `gk_gaokao`
--
ALTER TABLE `gk_gaokao`
  ADD CONSTRAINT `gk_gaokao_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `simplebase`.`sb_file` (`id`),
  ADD CONSTRAINT `gk_gaokao_ibfk_2` FOREIGN KEY (`paper`) REFERENCES `gk_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
