/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50153
Source Host           : localhost:3306
Source Database       : simplegaokao

Target Server Type    : MYSQL
Target Server Version : 50153
File Encoding         : 65001

Date: 2015-08-08 11:55:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gk_gaokao
-- ----------------------------
DROP TABLE IF EXISTS `gk_gaokao`;
CREATE TABLE `gk_gaokao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` tinyint(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `province` varchar(32) NOT NULL,
  `fid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`),
  KEY `pid` (`pid`) USING BTREE,
  CONSTRAINT `gk_gaokao_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `simplebase`.`sb_file` (`id`),
  CONSTRAINT `gk_gaokao_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `gk_gaokao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gk_gaokao
-- ----------------------------
INSERT INTO `gk_gaokao` VALUES ('1', '1', '2013', '1,22,43', '58', null);
INSERT INTO `gk_gaokao` VALUES ('2', '1', '2013', '1,22,43', '58', null);
INSERT INTO `gk_gaokao` VALUES ('3', '7', '2010', '1256,2492', '60', null);
INSERT INTO `gk_gaokao` VALUES ('4', '2', '2013', '2448,2492', '66', null);
INSERT INTO `gk_gaokao` VALUES ('5', '4', '2013', '221', '67', null);
INSERT INTO `gk_gaokao` VALUES ('6', '1', '2015', '3,4', '68', null);
INSERT INTO `gk_gaokao` VALUES ('7', '1', '2015', '5,18', '69', null);
INSERT INTO `gk_gaokao` VALUES ('8', '1', '2015', '3,6', '70', null);
INSERT INTO `gk_gaokao` VALUES ('9', '3', '2015', '3,16', '71', null);
INSERT INTO `gk_gaokao` VALUES ('10', '3', '2015', '7,16,18', '72', null);
INSERT INTO `gk_gaokao` VALUES ('11', '3', '2015', '7,16,18', '72', null);
