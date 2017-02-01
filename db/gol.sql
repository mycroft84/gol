/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : gol

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-02-01 09:55:02
*/

SET FOREIGN_KEY_CHECKS=0;

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
