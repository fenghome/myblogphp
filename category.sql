/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-02-14 15:16:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cate_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_Name` varchar(255) NOT NULL DEFAULT '',
  `cate_Order` int(11) NOT NULL DEFAULT '0',
  `cate_Count` int(11) NOT NULL DEFAULT '0',
  `cate_Alias` varchar(255) DEFAULT '',
  `cate_Intro` text,
  `cate_Pid` int(11) NOT NULL,
  `cate_Path` varchar(255) NOT NULL,
  `cate_Level` int(11) NOT NULL,
  PRIMARY KEY (`cate_ID`),
  KEY `cate_Order` (`cate_Order`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '分类1', '1', '0', '', null, '0', '1', '1');
INSERT INTO `category` VALUES ('2', '分类2', '5', '0', '', null, '0', '2', '1');
INSERT INTO `category` VALUES ('3', '分类3', '0', '0', '', null, '1', '1,3', '2');
INSERT INTO `category` VALUES ('4', '分类4', '0', '0', '', null, '0', '4', '1');
INSERT INTO `category` VALUES ('5', '分类5', '2', '0', '', null, '2', '2,5', '2');
INSERT INTO `category` VALUES ('6', '分类6', '0', '0', '', null, '3', '1,3,6', '3');
