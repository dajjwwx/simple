-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-02-26 21:24:43
-- 服务器版本： 5.5.29
-- PHP Version: 5.5.0alpha2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simpleexam`
--

-- --------------------------------------------------------

--
-- 表的结构 `se_course`
--

CREATE TABLE IF NOT EXISTS `se_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '课程',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `se_panduan`
--

CREATE TABLE IF NOT EXISTS `se_panduan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(512) NOT NULL COMMENT '问题',
  `answerA` int(11) NOT NULL COMMENT 'A选项',
  `answerB` int(11) NOT NULL COMMENT 'B选项',
  `answerC` int(11) NOT NULL COMMENT 'C选项',
  `answerD` int(11) NOT NULL COMMENT 'D选项',
  `course` int(11) NOT NULL COMMENT '科目',
  `owner` int(11) NOT NULL COMMENT '添加人',
  `difficulty` int(11) NOT NULL COMMENT '难度系数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
