/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : tc

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-04-01 16:07:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `inventario`
-- ----------------------------
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` int(11) DEFAULT NULL,
  `t20` int(11) DEFAULT NULL,
  `t25` int(11) DEFAULT NULL,
  `t30` int(11) DEFAULT NULL,
  `t35` int(11) DEFAULT NULL,
  `t40` int(11) DEFAULT NULL,
  `t45` int(11) DEFAULT NULL,
  `t50` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of inventario
-- ----------------------------
INSERT INTO `inventario` VALUES ('1', '1', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `inventario` VALUES ('2', '2', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `inventario` VALUES ('3', '3', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `inventario` VALUES ('4', '4', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `inventario` VALUES ('5', '5', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `codigo` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'tenis deportino Nike', 'nike-01');
INSERT INTO `productos` VALUES ('2', 'Zapato de vestir Cafe', 'zap-ca');
INSERT INTO `productos` VALUES ('3', 'Tenis 03', 'tenis 03');
INSERT INTO `productos` VALUES ('5', 'sandalia 04', 'sand-04');
INSERT INTO `productos` VALUES ('6', 'zapato 05', 'zapa 05');
INSERT INTO `productos` VALUES ('30', 'tenis 06', '');
INSERT INTO `productos` VALUES ('31', 'zapatilla 08', 'zap 08');
INSERT INTO `productos` VALUES ('32', 'zapatilla 09', 'zapa 09');

-- ----------------------------
-- Table structure for `system_catalogos`
-- ----------------------------
DROP TABLE IF EXISTS `system_catalogos`;
CREATE TABLE `system_catalogos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `controlador` char(255) DEFAULT NULL,
  `modelo` char(255) DEFAULT NULL,
  `tabla` char(255) DEFAULT NULL,
  `icono` char(255) DEFAULT NULL,
  `titulo_nuevo` char(255) DEFAULT NULL,
  `titulo_edicion` char(255) DEFAULT NULL,
  `titulo_busqueda` char(255) DEFAULT NULL,
  `msg_creado` char(255) DEFAULT NULL,
  `msg_actualizado` char(255) DEFAULT NULL,
  `pregunta_eliminar` char(255) DEFAULT NULL,
  `msg_eliminado` char(255) DEFAULT NULL,
  `msg_cambios` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_catalogos
-- ----------------------------
INSERT INTO `system_catalogos` VALUES ('8', 'Productos', 'productos', 'Producto', 'productos', '', 'Nuevo Producto', '{nombre}:{id}', 'Buscar Productos', 'Producto Creado ({nombre}:{id})', 'Producto Actualizado ({nombre}:{id})', 'Â¿Desea Eliminar el Producto: {nombre}:{id} ?', 'Producto <b> {nombre}:{id} </b> eliminado', 'Â¿Guardar Producto antes de salir?');
INSERT INTO `system_catalogos` VALUES ('18', 'Usuarios', 'usuarios', 'Usuario', 'system_users', '', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('27', 'Inventarios', 'Inventarios', 'Inventario', 'inventario', '', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `system_users`
-- ----------------------------
DROP TABLE IF EXISTS `system_users`;
CREATE TABLE `system_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` char(255) NOT NULL,
  `pass` blob,
  `email` char(255) NOT NULL,
  `rol` int(11) DEFAULT '1',
  `fbid` int(11) DEFAULT NULL,
  `name` char(255) NOT NULL DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `originalName` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_users
-- ----------------------------
INSERT INTO `system_users` VALUES ('1', 'zesar1', 0xD6638655930D9F75EAD96027EC615F8D, 'cbibriesca@hotmail.com', '2', '0', 'Zesar X', 'pic_1.jpg', 'retro_blue_background.jpg');
INSERT INTO `system_users` VALUES ('21', 'omar', 0xD6638655930D9F75EAD96027EC615F8D, 'omar@gmail.com', '1', '0', '', '', '');
