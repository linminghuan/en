/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-24 14:27:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for photos
-- ----------------------------
DROP TABLE IF EXISTS `photos`;CREATE TABLE `photos` (`id` int(11) NOT NULL AUTO_INCREMENT,`category_id` int(11) NULL,`author` varchar(255) NOT NULL,`editor` varchar(255) NOT NULL,`discription` varchar(255) DEFAULT NULL,`status` tinyint(4) NOT NULL DEFAULT '1',`update_at` datetime NOT NULL,`catogory_id` int(4) DEFAULT NULL,`order` int(11) DEFAULT NULL,`url` longtext,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
