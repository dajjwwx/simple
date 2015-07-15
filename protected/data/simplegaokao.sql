-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-07-15 18:04:34
-- 服务器版本： 5.1.53-community
-- PHP Version: 5.6.8

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
-- 表的结构 `gk_gaokao`
--

CREATE TABLE IF NOT EXISTS `gk_gaokao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` tinyint(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `province` varchar(32) NOT NULL,
  `fid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `gk_gaokao`
--
ALTER TABLE `gk_gaokao`
  ADD CONSTRAINT `gk_gaokao_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `simplebase`.`sb_file` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
