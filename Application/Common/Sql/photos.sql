/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-19 23:50:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for photos
-- ----------------------------
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `editor` varchar(255) NOT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `update_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `catogory_id` int(4) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of photos
-- ----------------------------
