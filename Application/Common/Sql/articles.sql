/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-24 14:26:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (`id` bigint(20) NOT NULL AUTO_INCREMENT,`category_id` int(11) NOT NULL,`editor` varchar(255) NOT NULL,`author` varchar(255) NOT NULL,`title` varchar(255) NOT NULL,`content` text,`update_at` datetime DEFAULT NULL,`sort` int(11) DEFAULT NULL,`status` int(11) DEFAULT NULL,`click` bigint(20) DEFAULT NULL,`cover` longtext,`discription` varchar(255) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
