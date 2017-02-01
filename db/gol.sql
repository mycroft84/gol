/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : gol

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-02-01 15:41:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for boards
-- ----------------------------
DROP TABLE IF EXISTS `boards`;
CREATE TABLE `boards` (
  `bo_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_name` varchar(255) DEFAULT NULL,
  `bo_width` int(11) DEFAULT NULL,
  `bo_height` int(11) DEFAULT NULL,
  PRIMARY KEY (`bo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of boards
-- ----------------------------
INSERT INTO `boards` VALUES ('2', 'test', '50', '50');
INSERT INTO `boards` VALUES ('4', 'max', '64', '52');
INSERT INTO `boards` VALUES ('5', 'tndrbird', '20', '18');

-- ----------------------------
-- Table structure for board_alives
-- ----------------------------
DROP TABLE IF EXISTS `board_alives`;
CREATE TABLE `board_alives` (
  `boal_id` int(11) NOT NULL AUTO_INCREMENT,
  `boal_bo_id` int(11) DEFAULT NULL,
  `boal_x` int(11) DEFAULT NULL,
  `boal_y` int(11) DEFAULT NULL,
  PRIMARY KEY (`boal_id`),
  KEY `boal_bo_id` (`boal_bo_id`),
  CONSTRAINT `boal_bo_id` FOREIGN KEY (`boal_bo_id`) REFERENCES `boards` (`bo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of board_alives
-- ----------------------------
INSERT INTO `board_alives` VALUES ('2', '2', '25', '22');
INSERT INTO `board_alives` VALUES ('3', '2', '26', '22');
INSERT INTO `board_alives` VALUES ('4', '2', '27', '22');
INSERT INTO `board_alives` VALUES ('5', '4', '11', '9');
INSERT INTO `board_alives` VALUES ('6', '4', '10', '10');
INSERT INTO `board_alives` VALUES ('7', '4', '12', '10');
INSERT INTO `board_alives` VALUES ('8', '4', '9', '11');
INSERT INTO `board_alives` VALUES ('9', '4', '12', '11');
INSERT INTO `board_alives` VALUES ('10', '4', '10', '12');
INSERT INTO `board_alives` VALUES ('11', '4', '11', '12');
INSERT INTO `board_alives` VALUES ('12', '4', '7', '5');
INSERT INTO `board_alives` VALUES ('13', '4', '8', '5');
INSERT INTO `board_alives` VALUES ('14', '4', '9', '5');
INSERT INTO `board_alives` VALUES ('15', '4', '10', '5');
INSERT INTO `board_alives` VALUES ('16', '4', '11', '5');
INSERT INTO `board_alives` VALUES ('17', '4', '6', '6');
INSERT INTO `board_alives` VALUES ('18', '4', '11', '6');
INSERT INTO `board_alives` VALUES ('19', '4', '5', '7');
INSERT INTO `board_alives` VALUES ('20', '4', '8', '7');
INSERT INTO `board_alives` VALUES ('21', '4', '5', '8');
INSERT INTO `board_alives` VALUES ('22', '4', '7', '8');
INSERT INTO `board_alives` VALUES ('23', '4', '8', '8');
INSERT INTO `board_alives` VALUES ('24', '4', '5', '9');
INSERT INTO `board_alives` VALUES ('25', '4', '5', '10');
INSERT INTO `board_alives` VALUES ('26', '4', '5', '11');
INSERT INTO `board_alives` VALUES ('27', '4', '6', '11');
INSERT INTO `board_alives` VALUES ('28', '4', '9', '1');
INSERT INTO `board_alives` VALUES ('29', '4', '8', '2');
INSERT INTO `board_alives` VALUES ('30', '4', '10', '2');
INSERT INTO `board_alives` VALUES ('31', '4', '9', '3');
INSERT INTO `board_alives` VALUES ('32', '4', '2', '8');
INSERT INTO `board_alives` VALUES ('33', '4', '1', '9');
INSERT INTO `board_alives` VALUES ('34', '4', '3', '9');
INSERT INTO `board_alives` VALUES ('35', '4', '2', '10');
INSERT INTO `board_alives` VALUES ('36', '4', '4', '17');
INSERT INTO `board_alives` VALUES ('37', '4', '7', '17');
INSERT INTO `board_alives` VALUES ('38', '4', '4', '18');
INSERT INTO `board_alives` VALUES ('39', '4', '3', '19');
INSERT INTO `board_alives` VALUES ('40', '4', '8', '19');
INSERT INTO `board_alives` VALUES ('41', '4', '2', '20');
INSERT INTO `board_alives` VALUES ('42', '4', '4', '20');
INSERT INTO `board_alives` VALUES ('43', '4', '7', '20');
INSERT INTO `board_alives` VALUES ('44', '4', '8', '20');
INSERT INTO `board_alives` VALUES ('45', '4', '0', '21');
INSERT INTO `board_alives` VALUES ('46', '4', '1', '21');
INSERT INTO `board_alives` VALUES ('47', '4', '3', '21');
INSERT INTO `board_alives` VALUES ('48', '4', '0', '24');
INSERT INTO `board_alives` VALUES ('49', '4', '3', '24');
INSERT INTO `board_alives` VALUES ('50', '4', '2', '25');
INSERT INTO `board_alives` VALUES ('51', '4', '3', '25');
INSERT INTO `board_alives` VALUES ('52', '4', '21', '0');
INSERT INTO `board_alives` VALUES ('53', '4', '24', '0');
INSERT INTO `board_alives` VALUES ('54', '4', '21', '1');
INSERT INTO `board_alives` VALUES ('55', '4', '20', '2');
INSERT INTO `board_alives` VALUES ('56', '4', '25', '2');
INSERT INTO `board_alives` VALUES ('57', '4', '19', '3');
INSERT INTO `board_alives` VALUES ('58', '4', '21', '3');
INSERT INTO `board_alives` VALUES ('59', '4', '24', '3');
INSERT INTO `board_alives` VALUES ('60', '4', '25', '3');
INSERT INTO `board_alives` VALUES ('61', '4', '17', '4');
INSERT INTO `board_alives` VALUES ('62', '4', '18', '4');
INSERT INTO `board_alives` VALUES ('63', '4', '20', '4');
INSERT INTO `board_alives` VALUES ('64', '4', '17', '7');
INSERT INTO `board_alives` VALUES ('65', '4', '20', '7');
INSERT INTO `board_alives` VALUES ('66', '4', '19', '8');
INSERT INTO `board_alives` VALUES ('67', '4', '20', '8');
INSERT INTO `board_alives` VALUES ('68', '4', '43', '0');
INSERT INTO `board_alives` VALUES ('69', '4', '42', '2');
INSERT INTO `board_alives` VALUES ('70', '4', '42', '3');
INSERT INTO `board_alives` VALUES ('71', '4', '43', '3');
INSERT INTO `board_alives` VALUES ('72', '4', '46', '0');
INSERT INTO `board_alives` VALUES ('73', '4', '46', '1');
INSERT INTO `board_alives` VALUES ('74', '4', '47', '2');
INSERT INTO `board_alives` VALUES ('75', '4', '46', '3');
INSERT INTO `board_alives` VALUES ('76', '4', '48', '3');
INSERT INTO `board_alives` VALUES ('77', '4', '47', '4');
INSERT INTO `board_alives` VALUES ('78', '4', '49', '4');
INSERT INTO `board_alives` VALUES ('79', '4', '50', '4');
INSERT INTO `board_alives` VALUES ('80', '4', '47', '7');
INSERT INTO `board_alives` VALUES ('81', '4', '50', '7');
INSERT INTO `board_alives` VALUES ('82', '4', '47', '8');
INSERT INTO `board_alives` VALUES ('83', '4', '48', '8');
INSERT INTO `board_alives` VALUES ('84', '4', '58', '1');
INSERT INTO `board_alives` VALUES ('85', '4', '57', '2');
INSERT INTO `board_alives` VALUES ('86', '4', '59', '2');
INSERT INTO `board_alives` VALUES ('87', '4', '58', '3');
INSERT INTO `board_alives` VALUES ('88', '4', '56', '5');
INSERT INTO `board_alives` VALUES ('89', '4', '57', '5');
INSERT INTO `board_alives` VALUES ('90', '4', '58', '5');
INSERT INTO `board_alives` VALUES ('91', '4', '59', '5');
INSERT INTO `board_alives` VALUES ('92', '4', '60', '5');
INSERT INTO `board_alives` VALUES ('93', '4', '56', '6');
INSERT INTO `board_alives` VALUES ('94', '4', '61', '6');
INSERT INTO `board_alives` VALUES ('95', '4', '59', '7');
INSERT INTO `board_alives` VALUES ('96', '4', '62', '7');
INSERT INTO `board_alives` VALUES ('97', '4', '59', '8');
INSERT INTO `board_alives` VALUES ('98', '4', '60', '8');
INSERT INTO `board_alives` VALUES ('99', '4', '62', '8');
INSERT INTO `board_alives` VALUES ('100', '4', '65', '8');
INSERT INTO `board_alives` VALUES ('101', '4', '56', '9');
INSERT INTO `board_alives` VALUES ('102', '4', '62', '9');
INSERT INTO `board_alives` VALUES ('103', '4', '64', '9');
INSERT INTO `board_alives` VALUES ('104', '4', '66', '9');
INSERT INTO `board_alives` VALUES ('105', '4', '55', '10');
INSERT INTO `board_alives` VALUES ('106', '4', '57', '10');
INSERT INTO `board_alives` VALUES ('107', '4', '62', '10');
INSERT INTO `board_alives` VALUES ('108', '4', '65', '10');
INSERT INTO `board_alives` VALUES ('109', '4', '55', '11');
INSERT INTO `board_alives` VALUES ('110', '4', '58', '11');
INSERT INTO `board_alives` VALUES ('111', '4', '61', '11');
INSERT INTO `board_alives` VALUES ('112', '4', '62', '11');
INSERT INTO `board_alives` VALUES ('113', '4', '56', '12');
INSERT INTO `board_alives` VALUES ('114', '4', '57', '12');
INSERT INTO `board_alives` VALUES ('115', '4', '60', '17');
INSERT INTO `board_alives` VALUES ('116', '4', '59', '19');
INSERT INTO `board_alives` VALUES ('117', '4', '59', '20');
INSERT INTO `board_alives` VALUES ('118', '4', '60', '20');
INSERT INTO `board_alives` VALUES ('119', '4', '63', '17');
INSERT INTO `board_alives` VALUES ('120', '4', '63', '18');
INSERT INTO `board_alives` VALUES ('121', '4', '64', '19');
INSERT INTO `board_alives` VALUES ('122', '4', '63', '20');
INSERT INTO `board_alives` VALUES ('123', '4', '65', '20');
INSERT INTO `board_alives` VALUES ('124', '4', '64', '21');
INSERT INTO `board_alives` VALUES ('125', '4', '66', '21');
INSERT INTO `board_alives` VALUES ('126', '4', '67', '21');
INSERT INTO `board_alives` VALUES ('127', '4', '64', '24');
INSERT INTO `board_alives` VALUES ('128', '4', '67', '24');
INSERT INTO `board_alives` VALUES ('129', '4', '64', '25');
INSERT INTO `board_alives` VALUES ('130', '4', '65', '25');
INSERT INTO `board_alives` VALUES ('131', '4', '57', '29');
INSERT INTO `board_alives` VALUES ('132', '4', '58', '29');
INSERT INTO `board_alives` VALUES ('133', '4', '57', '30');
INSERT INTO `board_alives` VALUES ('134', '4', '58', '30');
INSERT INTO `board_alives` VALUES ('135', '4', '57', '31');
INSERT INTO `board_alives` VALUES ('136', '4', '58', '31');
INSERT INTO `board_alives` VALUES ('137', '4', '58', '32');
INSERT INTO `board_alives` VALUES ('138', '4', '57', '33');
INSERT INTO `board_alives` VALUES ('139', '4', '59', '33');
INSERT INTO `board_alives` VALUES ('140', '4', '58', '34');
INSERT INTO `board_alives` VALUES ('141', '4', '57', '35');
INSERT INTO `board_alives` VALUES ('142', '4', '52', '34');
INSERT INTO `board_alives` VALUES ('143', '4', '53', '34');
INSERT INTO `board_alives` VALUES ('144', '4', '54', '34');
INSERT INTO `board_alives` VALUES ('145', '4', '56', '34');
INSERT INTO `board_alives` VALUES ('146', '4', '52', '35');
INSERT INTO `board_alives` VALUES ('147', '4', '53', '35');
INSERT INTO `board_alives` VALUES ('148', '4', '54', '35');
INSERT INTO `board_alives` VALUES ('149', '4', '55', '35');
INSERT INTO `board_alives` VALUES ('150', '4', '56', '36');
INSERT INTO `board_alives` VALUES ('151', '4', '9', '29');
INSERT INTO `board_alives` VALUES ('152', '4', '10', '29');
INSERT INTO `board_alives` VALUES ('153', '4', '9', '30');
INSERT INTO `board_alives` VALUES ('154', '4', '10', '30');
INSERT INTO `board_alives` VALUES ('155', '4', '9', '31');
INSERT INTO `board_alives` VALUES ('156', '4', '10', '31');
INSERT INTO `board_alives` VALUES ('157', '4', '9', '32');
INSERT INTO `board_alives` VALUES ('158', '4', '8', '33');
INSERT INTO `board_alives` VALUES ('159', '4', '10', '33');
INSERT INTO `board_alives` VALUES ('160', '4', '9', '34');
INSERT INTO `board_alives` VALUES ('161', '4', '11', '34');
INSERT INTO `board_alives` VALUES ('162', '4', '13', '34');
INSERT INTO `board_alives` VALUES ('163', '4', '14', '34');
INSERT INTO `board_alives` VALUES ('164', '4', '15', '34');
INSERT INTO `board_alives` VALUES ('165', '4', '10', '35');
INSERT INTO `board_alives` VALUES ('166', '4', '12', '35');
INSERT INTO `board_alives` VALUES ('167', '4', '13', '35');
INSERT INTO `board_alives` VALUES ('168', '4', '14', '35');
INSERT INTO `board_alives` VALUES ('169', '4', '15', '35');
INSERT INTO `board_alives` VALUES ('170', '4', '11', '36');
INSERT INTO `board_alives` VALUES ('171', '4', '33', '19');
INSERT INTO `board_alives` VALUES ('172', '4', '34', '19');
INSERT INTO `board_alives` VALUES ('173', '4', '33', '20');
INSERT INTO `board_alives` VALUES ('174', '4', '34', '20');
INSERT INTO `board_alives` VALUES ('175', '4', '33', '30');
INSERT INTO `board_alives` VALUES ('176', '4', '34', '30');
INSERT INTO `board_alives` VALUES ('177', '4', '33', '31');
INSERT INTO `board_alives` VALUES ('178', '4', '34', '31');
INSERT INTO `board_alives` VALUES ('179', '4', '33', '41');
INSERT INTO `board_alives` VALUES ('180', '4', '34', '41');
INSERT INTO `board_alives` VALUES ('181', '4', '33', '42');
INSERT INTO `board_alives` VALUES ('182', '4', '34', '42');
INSERT INTO `board_alives` VALUES ('183', '4', '26', '46');
INSERT INTO `board_alives` VALUES ('184', '4', '27', '46');
INSERT INTO `board_alives` VALUES ('185', '4', '26', '47');
INSERT INTO `board_alives` VALUES ('186', '4', '27', '47');
INSERT INTO `board_alives` VALUES ('187', '4', '26', '48');
INSERT INTO `board_alives` VALUES ('188', '4', '27', '48');
INSERT INTO `board_alives` VALUES ('189', '4', '26', '49');
INSERT INTO `board_alives` VALUES ('190', '4', '25', '50');
INSERT INTO `board_alives` VALUES ('191', '4', '27', '50');
INSERT INTO `board_alives` VALUES ('192', '4', '26', '51');
INSERT INTO `board_alives` VALUES ('193', '4', '28', '51');
INSERT INTO `board_alives` VALUES ('194', '4', '30', '51');
INSERT INTO `board_alives` VALUES ('195', '4', '31', '51');
INSERT INTO `board_alives` VALUES ('196', '4', '32', '51');
INSERT INTO `board_alives` VALUES ('197', '4', '27', '52');
INSERT INTO `board_alives` VALUES ('198', '4', '29', '52');
INSERT INTO `board_alives` VALUES ('199', '4', '30', '52');
INSERT INTO `board_alives` VALUES ('200', '4', '31', '52');
INSERT INTO `board_alives` VALUES ('201', '4', '32', '52');
INSERT INTO `board_alives` VALUES ('202', '4', '28', '53');
INSERT INTO `board_alives` VALUES ('203', '4', '40', '46');
INSERT INTO `board_alives` VALUES ('204', '4', '41', '46');
INSERT INTO `board_alives` VALUES ('205', '4', '40', '47');
INSERT INTO `board_alives` VALUES ('206', '4', '41', '47');
INSERT INTO `board_alives` VALUES ('207', '4', '40', '48');
INSERT INTO `board_alives` VALUES ('208', '4', '41', '48');
INSERT INTO `board_alives` VALUES ('209', '4', '41', '49');
INSERT INTO `board_alives` VALUES ('210', '4', '40', '50');
INSERT INTO `board_alives` VALUES ('211', '4', '42', '50');
INSERT INTO `board_alives` VALUES ('212', '4', '41', '51');
INSERT INTO `board_alives` VALUES ('213', '4', '40', '52');
INSERT INTO `board_alives` VALUES ('214', '4', '35', '51');
INSERT INTO `board_alives` VALUES ('215', '4', '36', '51');
INSERT INTO `board_alives` VALUES ('216', '4', '37', '51');
INSERT INTO `board_alives` VALUES ('217', '4', '39', '51');
INSERT INTO `board_alives` VALUES ('218', '4', '35', '52');
INSERT INTO `board_alives` VALUES ('219', '4', '36', '52');
INSERT INTO `board_alives` VALUES ('220', '4', '37', '52');
INSERT INTO `board_alives` VALUES ('221', '4', '38', '52');
INSERT INTO `board_alives` VALUES ('222', '4', '39', '53');
INSERT INTO `board_alives` VALUES ('223', '4', '17', '42');
INSERT INTO `board_alives` VALUES ('224', '4', '18', '42');
INSERT INTO `board_alives` VALUES ('225', '4', '16', '43');
INSERT INTO `board_alives` VALUES ('226', '4', '19', '43');
INSERT INTO `board_alives` VALUES ('227', '4', '17', '44');
INSERT INTO `board_alives` VALUES ('228', '4', '19', '44');
INSERT INTO `board_alives` VALUES ('229', '4', '18', '45');
INSERT INTO `board_alives` VALUES ('230', '4', '12', '43');
INSERT INTO `board_alives` VALUES ('231', '4', '13', '43');
INSERT INTO `board_alives` VALUES ('232', '4', '12', '44');
INSERT INTO `board_alives` VALUES ('233', '4', '12', '45');
INSERT INTO `board_alives` VALUES ('234', '4', '12', '46');
INSERT INTO `board_alives` VALUES ('235', '4', '14', '46');
INSERT INTO `board_alives` VALUES ('236', '4', '15', '46');
INSERT INTO `board_alives` VALUES ('237', '4', '12', '47');
INSERT INTO `board_alives` VALUES ('238', '4', '15', '47');
INSERT INTO `board_alives` VALUES ('239', '4', '13', '48');
INSERT INTO `board_alives` VALUES ('240', '4', '18', '48');
INSERT INTO `board_alives` VALUES ('241', '4', '14', '49');
INSERT INTO `board_alives` VALUES ('242', '4', '15', '49');
INSERT INTO `board_alives` VALUES ('243', '4', '16', '49');
INSERT INTO `board_alives` VALUES ('244', '4', '17', '49');
INSERT INTO `board_alives` VALUES ('245', '4', '18', '49');
INSERT INTO `board_alives` VALUES ('246', '4', '9', '44');
INSERT INTO `board_alives` VALUES ('247', '4', '8', '45');
INSERT INTO `board_alives` VALUES ('248', '4', '10', '45');
INSERT INTO `board_alives` VALUES ('249', '4', '9', '46');
INSERT INTO `board_alives` VALUES ('250', '4', '16', '51');
INSERT INTO `board_alives` VALUES ('251', '4', '15', '52');
INSERT INTO `board_alives` VALUES ('252', '4', '17', '52');
INSERT INTO `board_alives` VALUES ('253', '4', '16', '53');
INSERT INTO `board_alives` VALUES ('254', '4', '49', '42');
INSERT INTO `board_alives` VALUES ('255', '4', '50', '42');
INSERT INTO `board_alives` VALUES ('256', '4', '48', '43');
INSERT INTO `board_alives` VALUES ('257', '4', '51', '43');
INSERT INTO `board_alives` VALUES ('258', '4', '54', '43');
INSERT INTO `board_alives` VALUES ('259', '4', '55', '43');
INSERT INTO `board_alives` VALUES ('260', '4', '48', '44');
INSERT INTO `board_alives` VALUES ('261', '4', '50', '44');
INSERT INTO `board_alives` VALUES ('262', '4', '55', '44');
INSERT INTO `board_alives` VALUES ('263', '4', '58', '44');
INSERT INTO `board_alives` VALUES ('264', '4', '49', '45');
INSERT INTO `board_alives` VALUES ('265', '4', '55', '45');
INSERT INTO `board_alives` VALUES ('266', '4', '57', '45');
INSERT INTO `board_alives` VALUES ('267', '4', '59', '45');
INSERT INTO `board_alives` VALUES ('268', '4', '52', '46');
INSERT INTO `board_alives` VALUES ('269', '4', '53', '46');
INSERT INTO `board_alives` VALUES ('270', '4', '55', '46');
INSERT INTO `board_alives` VALUES ('271', '4', '58', '46');
INSERT INTO `board_alives` VALUES ('272', '4', '52', '47');
INSERT INTO `board_alives` VALUES ('273', '4', '55', '47');
INSERT INTO `board_alives` VALUES ('274', '4', '49', '48');
INSERT INTO `board_alives` VALUES ('275', '4', '54', '48');
INSERT INTO `board_alives` VALUES ('276', '4', '49', '49');
INSERT INTO `board_alives` VALUES ('277', '4', '50', '49');
INSERT INTO `board_alives` VALUES ('278', '4', '51', '49');
INSERT INTO `board_alives` VALUES ('279', '4', '52', '49');
INSERT INTO `board_alives` VALUES ('280', '4', '53', '49');
INSERT INTO `board_alives` VALUES ('281', '4', '51', '51');
INSERT INTO `board_alives` VALUES ('282', '4', '50', '52');
INSERT INTO `board_alives` VALUES ('283', '4', '52', '52');
INSERT INTO `board_alives` VALUES ('284', '4', '51', '53');
INSERT INTO `board_alives` VALUES ('285', '4', '16', '38');
INSERT INTO `board_alives` VALUES ('286', '4', '18', '38');
INSERT INTO `board_alives` VALUES ('287', '4', '16', '39');
INSERT INTO `board_alives` VALUES ('288', '4', '17', '39');
INSERT INTO `board_alives` VALUES ('289', '4', '17', '40');
INSERT INTO `board_alives` VALUES ('290', '4', '23', '43');
INSERT INTO `board_alives` VALUES ('291', '4', '21', '44');
INSERT INTO `board_alives` VALUES ('292', '4', '22', '44');
INSERT INTO `board_alives` VALUES ('293', '4', '22', '45');
INSERT INTO `board_alives` VALUES ('294', '4', '23', '45');
INSERT INTO `board_alives` VALUES ('295', '4', '44', '43');
INSERT INTO `board_alives` VALUES ('296', '4', '45', '44');
INSERT INTO `board_alives` VALUES ('297', '4', '46', '44');
INSERT INTO `board_alives` VALUES ('298', '4', '44', '45');
INSERT INTO `board_alives` VALUES ('299', '4', '45', '45');
INSERT INTO `board_alives` VALUES ('300', '5', '3', '0');
INSERT INTO `board_alives` VALUES ('301', '5', '4', '0');
INSERT INTO `board_alives` VALUES ('302', '5', '5', '0');
INSERT INTO `board_alives` VALUES ('303', '5', '1', '1');
INSERT INTO `board_alives` VALUES ('304', '5', '7', '1');
INSERT INTO `board_alives` VALUES ('305', '5', '1', '2');
INSERT INTO `board_alives` VALUES ('306', '5', '7', '2');
INSERT INTO `board_alives` VALUES ('307', '5', '9', '2');
INSERT INTO `board_alives` VALUES ('308', '5', '10', '2');
INSERT INTO `board_alives` VALUES ('309', '5', '11', '2');
INSERT INTO `board_alives` VALUES ('310', '5', '1', '3');
INSERT INTO `board_alives` VALUES ('311', '5', '7', '3');
INSERT INTO `board_alives` VALUES ('312', '5', '3', '5');
INSERT INTO `board_alives` VALUES ('313', '5', '4', '5');
INSERT INTO `board_alives` VALUES ('314', '5', '5', '5');
INSERT INTO `board_alives` VALUES ('315', '5', '18', '1');
INSERT INTO `board_alives` VALUES ('316', '5', '18', '2');
INSERT INTO `board_alives` VALUES ('317', '5', '18', '3');
INSERT INTO `board_alives` VALUES ('318', '5', '20', '7');
INSERT INTO `board_alives` VALUES ('319', '5', '20', '8');
INSERT INTO `board_alives` VALUES ('320', '5', '20', '9');
INSERT INTO `board_alives` VALUES ('321', '5', '19', '16');
INSERT INTO `board_alives` VALUES ('322', '5', '20', '16');
INSERT INTO `board_alives` VALUES ('323', '5', '21', '16');
INSERT INTO `board_alives` VALUES ('324', '5', '6', '17');
INSERT INTO `board_alives` VALUES ('325', '5', '6', '18');
INSERT INTO `board_alives` VALUES ('326', '5', '6', '19');

-- ----------------------------
-- Table structure for metadata
-- ----------------------------
DROP TABLE IF EXISTS `metadata`;
CREATE TABLE `metadata` (
  `met_id` int(11) NOT NULL AUTO_INCREMENT,
  `met_url` varchar(255) DEFAULT NULL,
  `met_title` varchar(255) DEFAULT NULL,
  `met_desc` text,
  `met_keys` varchar(255) DEFAULT NULL,
  `met_og_title` varchar(255) DEFAULT NULL,
  `met_og_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`met_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of metadata
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT,
  `set_name` text,
  `set_value` text,
  `set_display` tinyint(1) DEFAULT '0',
  `set_add_js` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'frontendLangs', '[\"hu\"]', '0', '0');
INSERT INTO `settings` VALUES ('2', 'adminLangs', '[\"hu\"]', '0', '0');
INSERT INTO `settings` VALUES ('3', 'userManagement', '[\"users\"]', '0', '0');
INSERT INTO `settings` VALUES ('4', 'adminManagement', '[\"users\"]', '0', '0');
INSERT INTO `settings` VALUES ('5', 'enableLanguagesSettings', 'false', '0', '0');
INSERT INTO `settings` VALUES ('6', 'commonLimit', '40', '0', '0');
INSERT INTO `settings` VALUES ('7', 'companyEmail', 'test@test.hu', '1', '0');
INSERT INTO `settings` VALUES ('8', 'siteName', 'gol', '1', '0');
INSERT INTO `settings` VALUES ('9', 'analysticEmail', 'analytics.d2c@gmail.com', '0', '0');
INSERT INTO `settings` VALUES ('10', 'analyticsPassword', 'hVM2Z244B5YTS53', '0', '0');
INSERT INTO `settings` VALUES ('11', 'analyticsReportID', '66790470', '0', '0');
INSERT INTO `settings` VALUES ('12', 'analyticsProfilID', 'UA-36819657-1', '0', '0');
INSERT INTO `settings` VALUES ('13', 'analyticsProfilName', 'krizisstratega.hu', '0', '0');
INSERT INTO `settings` VALUES ('14', 'analyticsCode', 'var _gaq = _gaq || [];\n_gaq.push([\'_setAccount\', \'UA-36819657-1\']);\n_gaq.push([\'_trackPageview\']);\n\n(function() {\nvar ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;\nga.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\') + \'stats.g.doubleclick.net/dc.js\';\nvar s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);\n})();', '0', '0');
INSERT INTO `settings` VALUES ('15', 'relatedWeightTitle', '1', '0', '0');
INSERT INTO `settings` VALUES ('16', 'relatedDeadLine', '100', '0', '0');
INSERT INTO `settings` VALUES ('17', 'relatedWeightLead', '1', '0', '0');
INSERT INTO `settings` VALUES ('18', 'contactAddress', '8800 Nagykanizsa Csengery u. 10/b.', '0', '0');
INSERT INTO `settings` VALUES ('19', 'contactAddressMore', '8774 Gelse, Dózsa u. 36. (térségen belül)', '0', '0');
INSERT INTO `settings` VALUES ('20', 'contactMobil', '+36 30 237 86 45', '0', '0');
INSERT INTO `settings` VALUES ('21', 'contactEmail', 'info@zalanka.hu', '0', '0');
INSERT INTO `settings` VALUES ('22', 'contactEmailMore', 'zsuzsanna.kocsi@zalanka.hu', '0', '0');
INSERT INTO `settings` VALUES ('23', 'contactEmailMore2', 'zsuzsanna.kocsi@tersegfejlesztes.hu', '0', '0');
INSERT INTO `settings` VALUES ('24', 'invoiceName', 'Kis Pista', '0', '0');
INSERT INTO `settings` VALUES ('25', 'invoiceZip', '9791', '0', '0');
INSERT INTO `settings` VALUES ('26', 'invoiceCity', 'Torony', '0', '0');
INSERT INTO `settings` VALUES ('27', 'invoiceStreet', 'Felszabadulás út 34.', '0', '0');
INSERT INTO `settings` VALUES ('28', 'invoiceTaxnumber', '76040300-2-49', '0', '0');
INSERT INTO `settings` VALUES ('29', 'showOwnLogo', '1', '0', null);

-- ----------------------------
-- Table structure for staticpage
-- ----------------------------
DROP TABLE IF EXISTS `staticpage`;
CREATE TABLE `staticpage` (
  `stp_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_met_id` int(11) DEFAULT NULL,
  `stp_url` varchar(255) DEFAULT NULL,
  `stp_page` text,
  PRIMARY KEY (`stp_id`),
  KEY `stp_met_id` (`stp_met_id`),
  CONSTRAINT `staticpage_ibfk_1` FOREIGN KEY (`stp_met_id`) REFERENCES `metadata` (`met_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of staticpage
-- ----------------------------
INSERT INTO `staticpage` VALUES ('1', null, 'adatvedelem', '<div id=\"lipsum\">\n<p>:) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae nisi nec dui malesuada pellentesque sed sed enim. Etiam fringilla, est vitae posuere mattis, tortor nibh ornare mauris, tempus sagittis dolor odio id turpis. Nulla dictum libero at vulputate euismod. Sed dignissim aliquet urna, eu porta nisl. Suspendisse potenti. Pellentesque nec adipiscing dui. Sed in erat sed quam hendrerit sodales in sit amet nunc.</p>\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam commodo eu ipsum et egestas. Pellentesque quis placerat tellus, blandit semper erat. Duis sapien metus, suscipit sed molestie ut, lobortis sit amet metus. Donec vitae pharetra libero, eget volutpat ante. Mauris sit amet gravida felis. In hac habitasse platea dictumst. Suspendisse sit amet justo mollis massa venenatis porta. Sed dignissim ligula eu hendrerit tincidunt.</p>\n<p>Suspendisse ut dictum quam. Mauris aliquet nunc nec eros sodales volutpat. Nullam tempus, arcu eget lobortis ultrices, quam purus varius lectus, sit amet malesuada quam velit mollis sapien. Fusce pellentesque eros eros, a lobortis ipsum dictum ut. Maecenas venenatis quis risus in egestas. Integer sed porta magna, ac facilisis elit. Integer vitae vehicula libero. Sed a odio nec lorem ultricies dapibus a quis justo. Sed tristique felis in mi consequat pulvinar.</p>\n<p>Donec porta hendrerit mattis. Aliquam tristique nisl ligula, et consectetur augue tincidunt in. Etiam rutrum commodo magna. Vivamus ultrices magna id dolor scelerisque sodales. Fusce id ultrices lacus. Curabitur accumsan nisl et tincidunt pharetra. Nullam laoreet id metus quis ornare. Suspendisse nec adipiscing turpis.</p>\n<p>Quisque eget eros molestie, lacinia ipsum in, sollicitudin sapien. Nunc non tortor felis. In sapien urna, aliquet facilisis malesuada a, condimentum ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pellentesque vestibulum quam, hendrerit commodo tortor condimentum sed. Duis dapibus eros aliquet sem vehicula molestie. Mauris vehicula dui libero, ut venenatis felis porta nec. Aenean felis est, suscipit non sem tincidunt, rutrum lobortis neque. Nulla eu lacus id augue mollis aliquam. Vestibulum vitae lacus nisl. Nullam vel velit ac lectus facilisis aliquet ac a urna. Fusce aliquam porttitor nisi eget ultricies. Proin ut blandit odio. Sed lobortis, massa sed facilisis tempor, ipsum tellus tempus dolor, quis tempus nibh nisi non lectus. Aliquam odio leo, ullamcorper ac dui eu, pharetra luctus justo. Vivamus pretium lectus vel augue sagittis sodales.</p>\n</div>');
INSERT INTO `staticpage` VALUES ('4', null, 'bemutatkozas', '<div id=\"lipsum\">\r\n<p>:) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae nisi nec dui malesuada pellentesque sed sed enim. Etiam fringilla, est vitae posuere mattis, tortor nibh ornare mauris, tempus sagittis dolor odio id turpis. Nulla dictum libero at vulputate euismod. Sed dignissim aliquet urna, eu porta nisl. Suspendisse potenti. Pellentesque nec adipiscing dui. Sed in erat sed quam hendrerit sodales in sit amet nunc.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam commodo eu ipsum et egestas. Pellentesque quis placerat tellus, blandit semper erat. Duis sapien metus, suscipit sed molestie ut, lobortis sit amet metus. Donec vitae pharetra libero, eget volutpat ante. Mauris sit amet gravida felis. In hac habitasse platea dictumst. Suspendisse sit amet justo mollis massa venenatis porta. Sed dignissim ligula eu hendrerit tincidunt.</p>\r\n<p>Suspendisse ut dictum quam. Mauris aliquet nunc nec eros sodales volutpat. Nullam tempus, arcu eget lobortis ultrices, quam purus varius lectus, sit amet malesuada quam velit mollis sapien. Fusce pellentesque eros eros, a lobortis ipsum dictum ut. Maecenas venenatis quis risus in egestas. Integer sed porta magna, ac facilisis elit. Integer vitae vehicula libero. Sed a odio nec lorem ultricies dapibus a quis justo. Sed tristique felis in mi consequat pulvinar.</p>\r\n<p>Donec porta hendrerit mattis. Aliquam tristique nisl ligula, et consectetur augue tincidunt in. Etiam rutrum commodo magna. Vivamus ultrices magna id dolor scelerisque sodales. Fusce id ultrices lacus. Curabitur accumsan nisl et tincidunt pharetra. Nullam laoreet id metus quis ornare. Suspendisse nec adipiscing turpis.</p>\r\n<p>Quisque eget eros molestie, lacinia ipsum in, sollicitudin sapien. Nunc non tortor felis. In sapien urna, aliquet facilisis malesuada a, condimentum ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pellentesque vestibulum quam, hendrerit commodo tortor condimentum sed. Duis dapibus eros aliquet sem vehicula molestie. Mauris vehicula dui libero, ut venenatis felis porta nec. Aenean felis est, suscipit non sem tincidunt, rutrum lobortis neque. Nulla eu lacus id augue mollis aliquam. Vestibulum vitae lacus nisl. Nullam vel velit ac lectus facilisis aliquet ac a urna. Fusce aliquam porttitor nisi eget ultricies. Proin ut blandit odio. Sed lobortis, massa sed facilisis tempor, ipsum tellus tempus dolor, quis tempus nibh nisi non lectus. Aliquam odio leo, ullamcorper ac dui eu, pharetra luctus justo. Vivamus pretium lectus vel augue sagittis sodales.</p>\r\n</div>');
INSERT INTO `staticpage` VALUES ('5', null, 'impresszum', '<div id=\"lipsum\">\r\n<p>:) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae nisi nec dui malesuada pellentesque sed sed enim. Etiam fringilla, est vitae posuere mattis, tortor nibh ornare mauris, tempus sagittis dolor odio id turpis. Nulla dictum libero at vulputate euismod. Sed dignissim aliquet urna, eu porta nisl. Suspendisse potenti. Pellentesque nec adipiscing dui. Sed in erat sed quam hendrerit sodales in sit amet nunc.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam commodo eu ipsum et egestas. Pellentesque quis placerat tellus, blandit semper erat. Duis sapien metus, suscipit sed molestie ut, lobortis sit amet metus. Donec vitae pharetra libero, eget volutpat ante. Mauris sit amet gravida felis. In hac habitasse platea dictumst. Suspendisse sit amet justo mollis massa venenatis porta. Sed dignissim ligula eu hendrerit tincidunt.</p>\r\n<p>Suspendisse ut dictum quam. Mauris aliquet nunc nec eros sodales volutpat. Nullam tempus, arcu eget lobortis ultrices, quam purus varius lectus, sit amet malesuada quam velit mollis sapien. Fusce pellentesque eros eros, a lobortis ipsum dictum ut. Maecenas venenatis quis risus in egestas. Integer sed porta magna, ac facilisis elit. Integer vitae vehicula libero. Sed a odio nec lorem ultricies dapibus a quis justo. Sed tristique felis in mi consequat pulvinar.</p>\r\n<p>Donec porta hendrerit mattis. Aliquam tristique nisl ligula, et consectetur augue tincidunt in. Etiam rutrum commodo magna. Vivamus ultrices magna id dolor scelerisque sodales. Fusce id ultrices lacus. Curabitur accumsan nisl et tincidunt pharetra. Nullam laoreet id metus quis ornare. Suspendisse nec adipiscing turpis.</p>\r\n<p>Quisque eget eros molestie, lacinia ipsum in, sollicitudin sapien. Nunc non tortor felis. In sapien urna, aliquet facilisis malesuada a, condimentum ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pellentesque vestibulum quam, hendrerit commodo tortor condimentum sed. Duis dapibus eros aliquet sem vehicula molestie. Mauris vehicula dui libero, ut venenatis felis porta nec. Aenean felis est, suscipit non sem tincidunt, rutrum lobortis neque. Nulla eu lacus id augue mollis aliquam. Vestibulum vitae lacus nisl. Nullam vel velit ac lectus facilisis aliquet ac a urna. Fusce aliquam porttitor nisi eget ultricies. Proin ut blandit odio. Sed lobortis, massa sed facilisis tempor, ipsum tellus tempus dolor, quis tempus nibh nisi non lectus. Aliquam odio leo, ullamcorper ac dui eu, pharetra luctus justo. Vivamus pretium lectus vel augue sagittis sodales.</p>\r\n</div>');

-- ----------------------------
-- Table structure for statictext
-- ----------------------------
DROP TABLE IF EXISTS `statictext`;
CREATE TABLE `statictext` (
  `stt_id` int(11) NOT NULL AUTO_INCREMENT,
  `stt_target` varchar(255) DEFAULT NULL,
  `stt_explain` text,
  `stt_text` text,
  PRIMARY KEY (`stt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of statictext
-- ----------------------------
INSERT INTO `statictext` VALUES ('1', 'co_sender', null, 'Név');
INSERT INTO `statictext` VALUES ('2', 'co_email', null, 'E-mail');
INSERT INTO `statictext` VALUES ('3', 'co_text', null, 'Hozzászólás');
INSERT INTO `statictext` VALUES ('4', 'main', null, 'Főoldal');
INSERT INTO `statictext` VALUES ('5', 'footerText', null, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.</p>');
INSERT INTO `statictext` VALUES ('6', 'email', null, 'Email');
INSERT INTO `statictext` VALUES ('7', 'username', null, 'Felhasználónév');
INSERT INTO `statictext` VALUES ('8', 'password', null, 'Jelszó');
INSERT INTO `statictext` VALUES ('9', 'password_confirm', null, 'Jelszó újra');
INSERT INTO `statictext` VALUES ('10', 'to_title', null, 'Cím');
INSERT INTO `statictext` VALUES ('11', 'to_desc', null, 'Összefoglaló');
INSERT INTO `statictext` VALUES ('12', 'top_text', null, null);
INSERT INTO `statictext` VALUES ('13', 'mainPageTitle', null, 'Ballonpolis');
INSERT INTO `statictext` VALUES ('14', 'aboutText', null, '<p>aboutText</p>');
