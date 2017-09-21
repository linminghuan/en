/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-21 20:03:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (`id` int(8) NOT NULL AUTO_INCREMENT,`name` varchar(255) NOT NULL,`password` varchar(255) NOT NULL,`ip` varchar(255) DEFAULT NULL,`status` tinyint(4) NOT NULL DEFAULT '1',`log_in` datetime DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'user', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '1', '2017-09-21 10:42:07');
