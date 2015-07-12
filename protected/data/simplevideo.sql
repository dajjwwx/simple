-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-02-26 21:25:21
-- 服务器版本： 5.5.29
-- PHP Version: 5.5.0alpha2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simplevideo`
--

-- --------------------------------------------------------

--
-- 替换视图以便查看 `sv_cateogry`
--
CREATE TABLE IF NOT EXISTS `sv_cateogry` (
`id` int(11)
,`name` varchar(50)
,`weight` int(11)
,`type` int(11)
,`description` varchar(500)
,`pid` int(11)
,`uid` int(11)
);
-- --------------------------------------------------------

--
-- 表的结构 `sv_comment`
--

CREATE TABLE IF NOT EXISTS `sv_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `pid` int(11) NOT NULL COMMENT '视频ID',
  `author` varchar(32) NOT NULL COMMENT '留言人昵称',
  `email` varchar(32) NOT NULL COMMENT '邮箱',
  `url` varchar(256) NOT NULL COMMENT '留言地址',
  `ip` varchar(32) NOT NULL COMMENT '留言时间',
  `pubdate` int(11) NOT NULL,
  `content` varchar(256) NOT NULL COMMENT '是否公布',
  `approved` tinyint(1) NOT NULL COMMENT '浏览器信息',
  `agent` varchar(256) NOT NULL COMMENT '回复的文章ID',
  `uid` int(11) NOT NULL COMMENT '留言用户ID',
  PRIMARY KEY (`id`),
  KEY `aid` (`pid`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 替换视图以便查看 `sv_user`
--
CREATE TABLE IF NOT EXISTS `sv_user` (
`id` int(11)
,`username` varchar(50)
,`password` varchar(128)
,`salt` varchar(50)
,`role` tinyint(4)
,`created` int(11)
,`lastlogin` int(11)
);
-- --------------------------------------------------------

--
-- 表的结构 `sv_video`
--

CREATE TABLE IF NOT EXISTS `sv_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `flashvar` varchar(255) NOT NULL COMMENT '视频ID',
  `flashimg` varchar(255) NOT NULL COMMENT '视频网站缩略图',
  `videoimg` varchar(255) NOT NULL COMMENT '视频本地缩略图',
  `host` varchar(50) NOT NULL COMMENT '视频来源',
  `title` varchar(255) NOT NULL COMMENT '视频标题',
  `group` int(11) DEFAULT NULL COMMENT '视频分类',
  `order` int(11) DEFAULT NULL COMMENT '视频播放顺序',
  `frequency` int(11) NOT NULL COMMENT '分享次数',
  `pubdate` int(11) NOT NULL COMMENT '发布时间',
  `moddate` int(11) NOT NULL COMMENT '修改时间',
  `description` text COMMENT '视频简介',
  PRIMARY KEY (`id`),
  KEY `group` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收藏视频' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 视图结构 `sv_cateogry`
--
DROP TABLE IF EXISTS `sv_cateogry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sv_cateogry` AS (select `simplebase`.`sb_category`.`id` AS `id`,`simplebase`.`sb_category`.`name` AS `name`,`simplebase`.`sb_category`.`weight` AS `weight`,`simplebase`.`sb_category`.`type` AS `type`,`simplebase`.`sb_category`.`description` AS `description`,`simplebase`.`sb_category`.`pid` AS `pid`,`simplebase`.`sb_category`.`uid` AS `uid` from `simplebase`.`sb_category`);

-- --------------------------------------------------------

--
-- 视图结构 `sv_user`
--
DROP TABLE IF EXISTS `sv_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sv_user` AS (select `simplebase`.`sb_user`.`id` AS `id`,`simplebase`.`sb_user`.`username` AS `username`,`simplebase`.`sb_user`.`password` AS `password`,`simplebase`.`sb_user`.`salt` AS `salt`,`simplebase`.`sb_user`.`role` AS `role`,`simplebase`.`sb_user`.`created` AS `created`,`simplebase`.`sb_user`.`lastlogin` AS `lastlogin` from `simplebase`.`sb_user`);

--
-- 限制导出的表
--

--
-- 限制表 `sv_comment`
--
ALTER TABLE `sv_comment`
  ADD CONSTRAINT `sv_comment_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `sv_video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sv_comment_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `simplebase`.`sb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sv_video`
--
ALTER TABLE `sv_video`
  ADD CONSTRAINT `sv_video_ibfk_1` FOREIGN KEY (`group`) REFERENCES `simplebase`.`sb_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
