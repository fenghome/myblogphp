/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-02-19 15:45:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `log_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_CateID` int(11) NOT NULL DEFAULT '0',
  `log_AuthorID` int(11) NOT NULL DEFAULT '0',
  `log_Tag` varchar(255) DEFAULT '',
  `log_Status` tinyint(4) DEFAULT '0',
  `log_Type` tinyint(4) DEFAULT NULL,
  `log_Alias` varchar(255) DEFAULT '',
  `log_IsTop` int(11) DEFAULT '0',
  `log_IsLock` tinyint(1) DEFAULT '0',
  `log_Tile` varchar(255) DEFAULT '',
  `log_Intro` text,
  `log_Content` longtext,
  `log_PostTime` int(11) DEFAULT '0',
  `log_UpdateTime` int(11) DEFAULT '0',
  `log_CommNums` int(11) DEFAULT '0',
  `log_ViewNums` int(11) DEFAULT '0',
  PRIMARY KEY (`log_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------
