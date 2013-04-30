/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : tc

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-04-30 11:22:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tiendas`
-- ----------------------------
DROP TABLE IF EXISTS `tiendas`;
CREATE TABLE `tiendas` (
  `clave` varchar(6) DEFAULT NULL,
  `tienda` varchar(20) DEFAULT NULL,
  KEY `clave` (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tiendas
-- ----------------------------
INSERT INTO `tiendas` VALUES ('000001', 'ALMACEN');
INSERT INTO `tiendas` VALUES ('000002', 'CTO');
INSERT INTO `tiendas` VALUES ('000003', 'C33');
INSERT INTO `tiendas` VALUES ('000004', 'R1');
INSERT INTO `tiendas` VALUES ('000005', 'R2');
INSERT INTO `tiendas` VALUES ('000006', 'Q8');
INSERT INTO `tiendas` VALUES ('000007', 'D9');
INSERT INTO `tiendas` VALUES ('000008', 'AQUILES');
INSERT INTO `tiendas` VALUES ('000009', 'SORIANA');
