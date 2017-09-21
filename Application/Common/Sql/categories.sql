/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-21 20:10:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (`id` int(11) NOT NULL AUTO_INCREMENT,`pid` int(11) NOT NULL,`name` varchar(255) NOT NULL,`sort` tinyint(4) DEFAULT NULL,`update_at` datetime DEFAULT NULL,`status` tinyint(4) NOT NULL DEFAULT '1',`navigation` tinyint(4) DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
