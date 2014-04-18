/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : dj

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-04-17 15:43:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(255) NOT NULL,
  `admin_account` varchar(255) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_level` tinyint(4) NOT NULL DEFAULT '0',
  `admin_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `admin_avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_ads`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ads`;
CREATE TABLE `tbl_ads` (
  `ads_id` int(11) NOT NULL AUTO_INCREMENT,
  `ads_image` varchar(255) DEFAULT NULL,
  `ads_position` varchar(255) DEFAULT NULL,
  `ads_name` varchar(255) NOT NULL,
  `image_id` int(11) NOT NULL,
  `ads_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_ads
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_banner`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_banner`;
CREATE TABLE `tbl_banner` (
  `banner_id` int(11) NOT NULL,
  `banner_des` text,
  `banner_name` varchar(255) DEFAULT NULL,
  `banner_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_banner
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  `cate_parent_id` int(11) NOT NULL,
  `cate_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_cms`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cms`;
CREATE TABLE `tbl_cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_name` varchar(255) NOT NULL,
  `cms_content` text NOT NULL,
  `cms_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_cms
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment_date` int(11) DEFAULT NULL,
  `comment_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_image`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_image`;
CREATE TABLE `tbl_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_lable` varchar(255) DEFAULT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  `banner_id` int(11) DEFAULT NULL,
  `ads_id` int(11) DEFAULT NULL,
  `image_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_image
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_logo`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_logo`;
CREATE TABLE `tbl_logo` (
  `logo_id` int(11) NOT NULL AUTO_INCREMENT,
  `logo_name` varchar(255) DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `logo_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`logo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_logo
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_playlist`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_playlist`;
CREATE TABLE `tbl_playlist` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(255) NOT NULL,
  `playlist_des` text,
  `user_id` int(11) NOT NULL,
  `playlist_image` varchar(255) DEFAULT NULL,
  `playlist_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_playlist
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_product`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_des` text,
  `product_author` varchar(255) DEFAULT NULL,
  `product_singer` varchar(255) DEFAULT NULL,
  `product_link` varchar(255) NOT NULL,
  `product_date_upload` int(11) DEFAULT NULL,
  `cate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_count_view` int(11) NOT NULL,
  `product_count_dowload` int(11) NOT NULL,
  `product_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_product_to_playlist`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_to_playlist`;
CREATE TABLE `tbl_product_to_playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_to_playlist
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_top`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_top`;
CREATE TABLE `tbl_top` (
  `top_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `week_moth` varchar(255) NOT NULL,
  `sort_order` tinyint(4) NOT NULL DEFAULT '0',
  `top_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`top_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_top
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `user_gender` tinyint(4) DEFAULT '0',
  `user_level` tinyint(4) NOT NULL DEFAULT '0',
  `user_is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
