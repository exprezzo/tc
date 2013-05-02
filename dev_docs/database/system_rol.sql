/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : tc

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-05-01 19:20:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `system_rol`
-- ----------------------------
DROP TABLE IF EXISTS `system_rol`;
CREATE TABLE `system_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_rol
-- ----------------------------
INSERT INTO `system_rol` VALUES ('1', 'Super Admin');
INSERT INTO `system_rol` VALUES ('2', 'System Admin');
INSERT INTO `system_rol` VALUES ('3', 'Gerente');
INSERT INTO `system_rol` VALUES ('4', 'Almacenista');
