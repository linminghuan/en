/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-24 14:27:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for recommends
-- ----------------------------
DROP TABLE IF EXISTS `recommends`;CREATE TABLE `recommends` (`id` tinyint(4) NOT NULL AUTO_INCREMENT,`name` varchar(255) DEFAULT NULL,`url` varchar(255) NOT NULL,`cover` longtext NOT NULL,`discription` varchar(255) DEFAULT NULL,`update_at` datetime DEFAULT NULL,`status` tinyint(4) DEFAULT '1',`sort` tinyint(4) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
