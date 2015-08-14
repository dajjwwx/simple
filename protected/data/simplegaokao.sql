/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50153
Source Host           : localhost:3306
Source Database       : simplegaokao

Target Server Type    : MYSQL
Target Server Version : 50153
File Encoding         : 65001

Date: 2015-08-14 13:56:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gk_coursepaper
-- ----------------------------
DROP TABLE IF EXISTS `gk_coursepaper`;
CREATE TABLE `gk_coursepaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` int(11) NOT NULL COMMENT '省份ID',
  `course` int(11) NOT NULL COMMENT '科目',
  `paper` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`paper`),
  KEY `paper` (`paper`),
  CONSTRAINT `gk_coursepaper_ibfk_1` FOREIGN KEY (`province`) REFERENCES `simplebase`.`sb_region` (`id`),
  CONSTRAINT `gk_coursepaper_ibfk_2` FOREIGN KEY (`paper`) REFERENCES `gk_paper` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gk_coursepaper
-- ----------------------------
INSERT INTO `gk_coursepaper` VALUES ('1', '17', '1', '8', '2015');
INSERT INTO `gk_coursepaper` VALUES ('2', '17', '2', '8', '2015');
INSERT INTO `gk_coursepaper` VALUES ('3', '17', '3', '8', '2015');
INSERT INTO `gk_coursepaper` VALUES ('4', '17', '4', '8', '2015');
INSERT INTO `gk_coursepaper` VALUES ('5', '17', '6', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('6', '17', '5', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('7', '18', '1', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('8', '18', '2', '9', '2015');
INSERT INTO `gk_coursepaper` VALUES ('9', '18', '3', '9', '2015');
INSERT INTO `gk_coursepaper` VALUES ('10', '18', '4', '9', '2015');
INSERT INTO `gk_coursepaper` VALUES ('11', '18', '5', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('12', '18', '6', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('13', '21', '9', '5', '2015');
INSERT INTO `gk_coursepaper` VALUES ('14', '21', '8', '5', '2015');
INSERT INTO `gk_coursepaper` VALUES ('15', '21', '7', '5', '2015');
INSERT INTO `gk_coursepaper` VALUES ('16', '21', '10', '5', '2015');
INSERT INTO `gk_coursepaper` VALUES ('17', '21', '11', '5', '2015');
INSERT INTO `gk_coursepaper` VALUES ('18', '21', '12', '5', '2015');
INSERT INTO `gk_coursepaper` VALUES ('19', '21', '1', '2', '2015');
INSERT INTO `gk_coursepaper` VALUES ('20', '21', '2', '2', '2015');
INSERT INTO `gk_coursepaper` VALUES ('21', '21', '3', '2', '2015');
INSERT INTO `gk_coursepaper` VALUES ('22', '21', '4', '2', '2015');
INSERT INTO `gk_coursepaper` VALUES ('23', '27', '2', '13', '2015');
INSERT INTO `gk_coursepaper` VALUES ('24', '27', '3', '13', '2015');
INSERT INTO `gk_coursepaper` VALUES ('25', '27', '4', '13', '2015');
INSERT INTO `gk_coursepaper` VALUES ('26', '27', '1', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('27', '27', '5', '1', '2015');
INSERT INTO `gk_coursepaper` VALUES ('28', '27', '6', '1', '2015');

-- ----------------------------
-- Table structure for gk_gaokao
-- ----------------------------
DROP TABLE IF EXISTS `gk_gaokao`;
CREATE TABLE `gk_gaokao` (
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gk_gaokao
-- ----------------------------
INSERT INTO `gk_gaokao` VALUES ('1', '1', '2015', '1', '40', '0');
INSERT INTO `gk_gaokao` VALUES ('2', '1', '2015', '2', '42', '0');
INSERT INTO `gk_gaokao` VALUES ('3', '2', '2015', '3', '43', '0');
INSERT INTO `gk_gaokao` VALUES ('4', '2', '2015', '4', '43', '0');
INSERT INTO `gk_gaokao` VALUES ('5', '2', '2015', '5', '43', '0');
INSERT INTO `gk_gaokao` VALUES ('6', '2', '2015', '6', '43', '0');
INSERT INTO `gk_gaokao` VALUES ('7', '1', '2014', '7', '44', '0');
INSERT INTO `gk_gaokao` VALUES ('8', '5', '2014', '8', '45', '0');

-- ----------------------------
-- Table structure for gk_paper
-- ----------------------------
DROP TABLE IF EXISTS `gk_paper`;
CREATE TABLE `gk_paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `year` varchar(4) NOT NULL,
  `provinces` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gk_paper
-- ----------------------------
INSERT INTO `gk_paper` VALUES ('1', '新课标全国Ⅰ卷', '2015', '3,4,14,16');
INSERT INTO `gk_paper` VALUES ('2', '新课标全国Ⅱ卷', '2015', '5,6,7,8,20,24,25,26,28,29,30,31');
INSERT INTO `gk_paper` VALUES ('3', '安徽卷', '2015', '12');
INSERT INTO `gk_paper` VALUES ('4', '北京卷', '2015', '1');
INSERT INTO `gk_paper` VALUES ('5', '重庆卷', '2015', '22');
INSERT INTO `gk_paper` VALUES ('6', '福建卷', '2015', '13');
INSERT INTO `gk_paper` VALUES ('7', '海南卷', '2015', '21');
INSERT INTO `gk_paper` VALUES ('8', '湖北卷', '2015', '17');
INSERT INTO `gk_paper` VALUES ('9', '湖南卷', '2015', '18');
INSERT INTO `gk_paper` VALUES ('10', '江苏卷', '2015', '10');
INSERT INTO `gk_paper` VALUES ('11', '山东卷', '2015', '15');
INSERT INTO `gk_paper` VALUES ('12', '上海卷', '2015', '9');
INSERT INTO `gk_paper` VALUES ('13', '陕西卷', '2015', '27');
INSERT INTO `gk_paper` VALUES ('14', '四川卷', '2015', '23');
INSERT INTO `gk_paper` VALUES ('15', '天津卷', '2015', '2');
INSERT INTO `gk_paper` VALUES ('16', '浙江卷', '2015', '11');
INSERT INTO `gk_paper` VALUES ('17', '四川卷', '2014', '23');
INSERT INTO `gk_paper` VALUES ('18', '上海卷', '2014', '9');
INSERT INTO `gk_paper` VALUES ('19', '新课标全国Ⅰ卷', '2014', '3,4,16');
INSERT INTO `gk_paper` VALUES ('20', '新课标全国Ⅱ卷', '2014', '5,24,26,28,29');
