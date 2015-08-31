-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-31 15:35:26
-- 服务器版本： 5.5.29
-- PHP Version: 5.5.0alpha2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simplepreparation`
--

-- --------------------------------------------------------

--
-- 表的结构 `sp_catalog`
--

CREATE TABLE IF NOT EXISTS `sp_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '章节目录ID',
  `name` varchar(128) NOT NULL COMMENT '章节目录名称',
  `pid` int(11) NOT NULL COMMENT '章节父目录',
  `course` int(11) NOT NULL COMMENT '科目',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='章节目录' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `sp_catalog`
--

INSERT INTO `sp_catalog` (`id`, `name`, `pid`, `course`) VALUES
(1, 'sfas', 2, 1),
(2, '2sdfas', 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `sp_preparation`
--

CREATE TABLE IF NOT EXISTS `sp_preparation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '章节目录ID',
  `fid` int(11) NOT NULL COMMENT '文件ID',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`fid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `sp_preparation`
--
ALTER TABLE `sp_preparation`
  ADD CONSTRAINT `sp_preparation_ibfk_3` FOREIGN KEY (`cid`) REFERENCES `sp_catalog` (`id`),
  ADD CONSTRAINT `sp_preparation_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `simplebase`.`sb_file` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
