/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-03-02 15:31:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comm_ID` int(11) NOT NULL AUTO_INCREMENT,
  `comm_LogID` int(11) DEFAULT NULL,
  `comm_IsChecking` tinyint(1) DEFAULT NULL,
  `comm_RootID` int(11) DEFAULT NULL,
  `comm_ParentID` int(11) DEFAULT NULL,
  `comm_AuthorID` int(11) DEFAULT NULL,
  `comm_Name` varchar(50) DEFAULT '',
  `comm_Email` varchar(50) DEFAULT '',
  `comm_HomePage` varchar(255) DEFAULT NULL,
  `comm_Content` text,
  `comm_PostTime` int(11) DEFAULT NULL,
  `comm_IP` varchar(15) DEFAULT NULL,
  `comm_Agent` text,
  `comm_Meta` longtext,
  PRIMARY KEY (`comm_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
