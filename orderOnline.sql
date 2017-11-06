/*
 Navicat Premium Data Transfer

 Source Server         : lee
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : orderOnline

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 11/06/2017 20:01:23 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `category`
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES ('1', 'food'), ('2', 'drink'), ('3', 'promotion');
COMMIT;

-- ----------------------------
--  Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_name` varchar(100) DEFAULT NULL,
  `post_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `content`
-- ----------------------------
BEGIN;
INSERT INTO `content` VALUES ('1', 'chease food', '2017-10-18 15:54:18', '2017-10-19 15:54:26', '2017-10-19 15:54:29', 'tea', 'Read restaurants reviews, browse restaurants menus and easily order online from any restaurant with no extra charge!!! The best way to find Sushi delivery restaurants that deliver to you', '3.jpg', ''), ('2', 'pizza', '2017-11-05 19:43:21', '2017-11-05 19:43:25', '2017-11-30 19:43:29', 'promotion', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.\n The best way to find Chinese delivery restaurants that de', '1.jpg', null), ('3', 'Thai', '2017-11-05 20:00:04', '2017-11-05 20:00:08', '2017-12-31 20:00:12', 'promotion', 'Read restaurants reviews, browse restaurants menus and easily order online from any restaurant with no extra charge!!! The best way to find Sushi delivery restaurants that deliver to you', '4.jpg', null), ('4', 'Sushi', '2017-11-05 20:01:08', '2017-11-05 20:01:11', '2017-12-31 20:01:15', 'promotion', 'Read restaurants reviews, browse restaurants menus and easily order online from any restaurant with no extra charge!!! The best way to find Sushi delivery restaurants that deliver to you', '8b.jpg', null), ('5', 'India', '2017-11-05 20:03:26', '2017-11-05 20:03:29', '2017-12-31 20:03:32', 'promotion', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', '9b.jpg', null), ('6', 'Chease', '2017-11-05 20:04:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Share', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', '10b.jpg', ''), ('7', 'Chease', '2017-11-05 20:04:12', '2017-11-05 20:03:29', '2017-12-31 20:03:32', 'promotion', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', 'pic1.jpg', null), ('8', 'India', '2017-11-06 11:38:32', '2017-11-06 11:38:35', '2018-03-31 11:38:37', 'tea', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', 'pic2.jpg', null), ('9', 'Sushi', '2017-11-06 11:39:10', '2017-11-06 11:39:12', '2018-05-31 11:39:15', 'promotion', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', 'pic3.jpg', null), ('10', 'pizza', '2017-11-06 11:39:50', '2017-11-06 11:39:53', '2018-04-27 11:39:55', 'drink', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', 'pic4.jpg', null), ('11', 'india', '2017-11-06 11:40:32', '2017-11-06 11:40:35', '2018-04-25 11:40:37', 'tea', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', 'pic5.jpg', null), ('12', 'Thai', '2017-11-06 11:41:03', '2017-10-05 11:41:07', '2019-07-29 11:41:15', 'promotion', ' The best way to find Chinese delivery restaurants that deliver to you, is by entering your address in the search box above, and making a search. You can also click on one of the city links below.', 'pic6.jpg', null);
COMMIT;

-- ----------------------------
--  Table structure for `email`
-- ----------------------------
DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `email`
-- ----------------------------
BEGIN;
INSERT INTO `email` VALUES ('1', 'doris.douzi@gmail.com'), ('2', 'jingjing1@gmail.com');
COMMIT;

-- ----------------------------
--  Table structure for `item`
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `item_name` varchar(200) DEFAULT NULL,
  `item_price` decimal(10,0) DEFAULT NULL,
  `item_category` varchar(100) DEFAULT NULL,
  `item_desc` varchar(100) DEFAULT NULL,
  `item_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item`
-- ----------------------------
BEGIN;
INSERT INTO `item` VALUES ('1', '1', 'pizza', '30', '3', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'food2.png'), ('2', '2', 'chinese', '40', '1', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'img1.jpg'), ('3', '3', 'sushi', '50', '2', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'img2.jpg'), ('4', '4', 'thai', '60', '3', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'img3.jpg'), ('5', '5', 'chines', '70', '2', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'img4.jpg'), ('6', '6', 'thai', '80', '1', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'img5.jpg'), ('7', '7', 'india', '10', '3', ' The best way to find Sushi delivery restaurants that deliver to you, is by entering your address in', 'img6.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `log`
-- ----------------------------
BEGIN;
INSERT INTO `log` VALUES ('1', 'order', 'sdfwersxxcvw', '2017-11-06 11:25:52', 'user', '2017-11-06 11:26:03');
COMMIT;

-- ----------------------------
--  Table structure for `order_item`
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `order_item`
-- ----------------------------
BEGIN;
INSERT INTO `order_item` VALUES ('1', '1', '4', '2'), ('2', '2', '4', '2'), ('3', '3', '4', '2'), ('4', '4', '2', '1'), ('5', '5', '6', '1'), ('6', '6', '2', '1'), ('7', '7', '2', '1'), ('8', '8', '2', '1'), ('9', '9', '2', '1'), ('10', '10', '2', '1'), ('11', '11', '1', '1'), ('12', '12', '1', '1'), ('13', '12', '4', '1'), ('14', '13', '3', '1'), ('15', '13', '5', '1');
COMMIT;

-- ----------------------------
--  Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL COMMENT '// delivery',
  `state` varchar(100) DEFAULT NULL COMMENT '// Accepted, Ready_for_collection, collected, cancelled',
  `address` varchar(100) DEFAULT NULL,
  `reservation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `orders`
-- ----------------------------
BEGIN;
INSERT INTO `orders` VALUES ('1', '0', '2017-11-06 09:58:00', '2017-11-07 09:56:00', '205', 'delivery', 'Accepted', 'sdfdsfsdf ', null), ('2', '0', '2017-11-06 10:03:00', '2017-11-06 10:02:00', '200', 'self_collection', 'Accepted', null, null), ('3', '0', '2017-11-06 10:46:00', '2017-11-07 10:36:00', '280', 'self_collection', 'Accepted', null, null), ('4', '1', '2017-11-06 11:09:00', '2017-11-06 14:07:00', '40', 'self_collection', 'Accepted', null, null), ('5', '11', '2017-11-06 17:07:00', '2017-11-06 20:07:00', '80', 'self_collection', 'Accepted', null, null), ('6', '11', '2017-11-06 17:13:00', '2017-11-06 20:13:00', '120', 'self_collection', 'Accepted', null, null), ('7', '11', '2017-11-06 17:21:00', '2017-11-06 20:13:00', '120', 'self_collection', 'Accepted', null, null), ('8', '11', '2017-11-06 17:27:00', '2017-11-06 20:27:00', '120', 'self_collection', 'Accepted', null, null), ('9', '11', '2017-11-06 18:47:00', '2017-11-06 19:46:00', '125', 'delivery', 'Accepted', 'aadfasdf ', null), ('10', '11', '2017-11-06 18:53:00', '2017-11-07 18:52:00', '120', 'self_collection', 'Accepted', null, null), ('11', '11', '2017-11-06 19:59:00', '2017-11-06 21:58:00', '90', 'self_collection', 'Accepted', null, null), ('12', '11', '2017-11-06 19:59:00', '2017-11-06 21:58:00', '90', 'self_collection', 'Accepted', null, null), ('13', '11', '2017-11-06 20:01:00', '2017-11-07 20:00:00', '125', 'delivery', 'Accepted', 'sdfsdf ', null);
COMMIT;

-- ----------------------------
--  Table structure for `reservation`
-- ----------------------------
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `current` datetime DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `people` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`reservation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `reservation`
-- ----------------------------
BEGIN;
INSERT INTO `reservation` VALUES ('1', '2017-11-06 20:56:00', '2017-11-05 20:56:00', 'Pending', '3', '1', 'sdfsadf'), ('2', '2017-11-06 21:07:00', '2017-11-05 21:07:00', 'Pending', '3', '1', 'asdfdsf'), ('3', '2017-11-06 21:31:00', '2017-11-05 21:31:00', 'Pending', '3', '1', 'asdfsdf'), ('4', '2017-11-06 21:41:00', '2017-11-05 21:41:00', 'Pending', '3', '1', 'asdfasdf'), ('5', '2017-11-06 21:53:00', '2017-11-05 21:54:00', 'Pending', '3', '1', 'asdsddv');
COMMIT;

-- ----------------------------
--  Table structure for `rule`
-- ----------------------------
DROP TABLE IF EXISTS `rule`;
CREATE TABLE `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limits` varchar(100) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT '//reservation_a, reservation_b, order_a, order_b',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `rule`
-- ----------------------------
BEGIN;
INSERT INTO `rule` VALUES ('1', '4', '08:00:03', 'order_a'), ('2', '4', '08:00:03', 'order_b'), ('3', '8', '00:00:03', 'reservation_b'), ('4', '8', '08:00:03', 'reservation_a');
COMMIT;

-- ----------------------------
--  Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '// operation_time, order_crtoff, no_reservation',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `setting`
-- ----------------------------
BEGIN;
INSERT INTO `setting` VALUES ('1', 'operationtime', '08:00:08', '23:00:24'), ('2', 'order_cutoff', '08:00:08', '23:00:24'), ('3', 'no_reservation', '01:00:00', '08:00:08');
COMMIT;

-- ----------------------------
--  Table structure for `slide_show`
-- ----------------------------
DROP TABLE IF EXISTS `slide_show`;
CREATE TABLE `slide_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `slide_show`
-- ----------------------------
BEGIN;
INSERT INTO `slide_show` VALUES ('1', 'dessert', 'icecream.jpg', '1', '1', '2017-10-23 17:27:25'), ('2', 'drink', 'banner3.jpg', '2', '2', '2017-11-05 11:59:37');
COMMIT;

-- ----------------------------
--  Table structure for `terms_conditions`
-- ----------------------------
DROP TABLE IF EXISTS `terms_conditions`;
CREATE TABLE `terms_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL COMMENT '// order, reservation',
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `terms_conditions`
-- ----------------------------
BEGIN;
INSERT INTO `terms_conditions` VALUES ('1', 'order', '• The rates quoted are based on your period of stay. Rates are subject to change as a result of chan'), ('2', 'reservation', '• The rates quoted are based on your period of stay. Rates are subject to change as a result of chan');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `nric` varchar(100) DEFAULT NULL,
  `firstname` varchar(40) DEFAULT NULL,
  `lastname` varchar(40) DEFAULT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone_number` int(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `user_img` varchar(100) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'a249834096', 'E123456', 'lee', 'liangze', '2017-10-02 00:00:00', '1', 'liangzelee@gmail.com', '35f300e5c5aff672fb9e6210565b983634bff6ca', '87258379', 'Nanyang Technological University hall of residence 14-67-1381, 34 Nanyang Crescent, Singapore 637634', 'defaultpic.jpg', 'Active', null), ('4', '234234234', 'p12312312', 'asdf', 'asdfasdf', '2017-11-04 00:00:00', '3', '23234@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '234234234', 'wqerwer', 'defaultpic.jpg', 'Active', null), ('3', 'a403474396', 'E321789', 'li', 'liangze', '0000-00-00 00:00:00', '3', '249834096@qq.com', '7c222fb2927d828af22f592134e8932480637c0d', '86233256', 'sdfsdf', 'defaultpic.jpg', 'Active', null), ('5', 'wsdfdsf', 'q1123123', 'asdfsd', 'adfasdf', '2017-11-04 00:00:00', '3', 'asdfasd@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '234234234', 'adfasdf', 'defaultpic.jpg', 'Active', null), ('6', '2332423', 'asdfsadf23', 'adsfsdf', 'adfsdf', '2017-11-01 00:00:00', '3', 'adf@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '324234234', 'sadfsadf', 'defaultpic.jpg', 'Active', null), ('7', 'afsdf123123', 'sdfsdfds', 'sdfsdf', 'werewr', '2017-11-01 00:00:00', '3', 'wfesdf@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '234234234', 'sadffsd', 'defaultpic.jpg', 'Active', null), ('8', 'sdfaawf345', 'ew23423423', 'sdfsafasdf', 'asdfxcv', '2017-11-02 00:00:00', '3', '234@gmial.com', '7c222fb2927d828af22f592134e8932480637c0d', '543534534', 'adfsdvxc', 'defaultpic.jpg', 'Active', null), ('9', '2343sf', 'sdfsa23123', 'sdfaf', 'sdafsdaf', '2017-11-01 00:00:00', '3', '234sdf@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '234324234', 'dfgdfa', 'logo.png', 'Active', null), ('10', '2sdfsdf', 'ds234', 'asdfasd', 'asdf', '2012-11-12 00:00:00', '3', 'asdf@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2147483647', 'adfsdaf', 'defaultpic.jpg', 'Active', null), ('11', 'douzi888', 'E321321', 'dou', 'zi', '2010-11-02 00:00:00', '1', 'doris.douzi@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '83891612', 'asdfwe asdxcvs', 'defaultpic.jpg', 'Active', null), ('12', 'jingjing', 'q123321', 'jing', 'jing', '2012-11-05 00:00:00', '1', 'jingjing@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '83891723', 'asdf', 'defaultpic.jpg', 'Active', null);
COMMIT;

-- ----------------------------
--  Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user_group`
-- ----------------------------
BEGIN;
INSERT INTO `user_group` VALUES ('1', 'admin'), ('3', 'user');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
