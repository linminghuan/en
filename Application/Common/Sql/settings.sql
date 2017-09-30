/*
Navicat MySQL Data Transfer

Source Server         : wampserver
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ywev

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-24 14:27:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;CREATE TABLE `settings` (`id` tinyint(4) NOT NULL AUTO_INCREMENT,`user_id` int(11) DEFAULT NULL,`telephone` varchar(255) DEFAULT NULL,`email` varchar(255) DEFAULT NULL,`address` varchar(255) DEFAULT NULL,`poweredby` varchar(255) DEFAULT NULL,`codeimg` longtext,`banner` longtext,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `en`.`settings` (`id`, `user_id`, `telephone`, `email`, `address`, `poweredby`, `codeimg`, `banner`) VALUES ('1', '1', '020-85281887 38297891', 'zhxy@scau.edu.cn', '', 'The College of Natural Resources and Environment of South China Agricultural University', NULL, NULL);