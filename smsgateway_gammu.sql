/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : smsgateway_gammu

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-27 00:43:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activations
-- ----------------------------
DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of activations
-- ----------------------------
INSERT INTO `activations` VALUES ('1', '1', '2KjSWVtvt9pdkgO95JS76xalWO00VJDK', '1', '2016-04-25 15:20:30', '2016-04-25 15:20:29', '2016-04-25 15:20:30');
INSERT INTO `activations` VALUES ('2', '2', '1jfKGIfO76IhsBApKQQV3g4qLCpYJgkA', '1', '2016-04-25 15:20:30', '2016-04-25 15:20:30', '2016-04-25 15:20:30');

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('A','N') DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact
-- ----------------------------
INSERT INTO `contact` VALUES ('2', 'Budi', 'Buah Batu - Bandung', '1990-09-22', '26', 'budi@gmail.com', 'A');
INSERT INTO `contact` VALUES ('3', 'John Due', 'Garut', '1989-02-23', '27', 'johndue@gmail.com', 'A');
INSERT INTO `contact` VALUES ('4', 'Tarno', 'Solo', '1979-06-21', '37', 'test@email.com', 'A');

-- ----------------------------
-- Table structure for contact_phone
-- ----------------------------
DROP TABLE IF EXISTS `contact_phone`;
CREATE TABLE `contact_phone` (
  `phone` varchar(255) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `status` enum('A','N') DEFAULT 'A',
  PRIMARY KEY (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact_phone
-- ----------------------------
INSERT INTO `contact_phone` VALUES ('6209898989891', '2', 'A');
INSERT INTO `contact_phone` VALUES ('6285624039377', '4', 'A');
INSERT INTO `contact_phone` VALUES ('6287812344321', '3', 'A');
INSERT INTO `contact_phone` VALUES ('62895338982586', '2', 'N');
INSERT INTO `contact_phone` VALUES ('6289545676765', '2', 'N');

-- ----------------------------
-- Table structure for daemons
-- ----------------------------
DROP TABLE IF EXISTS `daemons`;
CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of daemons
-- ----------------------------

-- ----------------------------
-- Table structure for gammu
-- ----------------------------
DROP TABLE IF EXISTS `gammu`;
CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gammu
-- ----------------------------
INSERT INTO `gammu` VALUES ('13');

-- ----------------------------
-- Table structure for inbox
-- ----------------------------
DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of inbox
-- ----------------------------
INSERT INTO `inbox` VALUES ('2016-04-26 18:03:24', '2016-04-26 18:03:22', '0054006500730073', '+6285624039377', 'Default_No_Compression', '', '+62816124', '-1', 'Tess', '7', '', 'false');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_07_02_230147_migration_cartalyst_sentinel', '1');

-- ----------------------------
-- Table structure for outbox
-- ----------------------------
DROP TABLE IF EXISTS `outbox`;
CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of outbox
-- ----------------------------

-- ----------------------------
-- Table structure for outbox_multipart
-- ----------------------------
DROP TABLE IF EXISTS `outbox_multipart`;
CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of outbox_multipart
-- ----------------------------

-- ----------------------------
-- Table structure for pbk
-- ----------------------------
DROP TABLE IF EXISTS `pbk`;
CREATE TABLE `pbk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pbk
-- ----------------------------

-- ----------------------------
-- Table structure for pbk_groups
-- ----------------------------
DROP TABLE IF EXISTS `pbk_groups`;
CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pbk_groups
-- ----------------------------

-- ----------------------------
-- Table structure for persistences
-- ----------------------------
DROP TABLE IF EXISTS `persistences`;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of persistences
-- ----------------------------

-- ----------------------------
-- Table structure for phones
-- ----------------------------
DROP TABLE IF EXISTS `phones`;
CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phones
-- ----------------------------
INSERT INTO `phones` VALUES ('', '2016-04-27 00:43:56', '2016-04-26 17:56:37', '2016-04-27 00:44:06', 'yes', 'yes', '865456015681446', 'Gammu 1.33.0, Windows Server 2007, GCC 4.7, MinGW 3.11', '0', '36', '12', '1');

-- ----------------------------
-- Table structure for reminders
-- ----------------------------
DROP TABLE IF EXISTS `reminders`;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reminders
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'super-admin', 'Super Admin', null, '2016-04-25 15:20:29', '2016-04-25 15:20:29');
INSERT INTO `roles` VALUES ('2', 'supervisor', 'SPV', null, '2016-04-25 15:20:30', '2016-04-25 15:20:30');

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_users
-- ----------------------------
INSERT INTO `role_users` VALUES ('1', '1', '2016-04-25 15:20:30', '2016-04-25 15:20:30');
INSERT INTO `role_users` VALUES ('2', '2', '2016-04-25 15:20:30', '2016-04-25 15:20:30');

-- ----------------------------
-- Table structure for sentitems
-- ----------------------------
DROP TABLE IF EXISTS `sentitems`;
CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sentitems
-- ----------------------------
INSERT INTO `sentitems` VALUES ('2016-04-26 23:40:20', '2016-04-26 23:39:59', '2016-04-26 23:40:20', null, '007400650073007400200062007500640069', '0895338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'test budi', '1', '', '1', 'SendingOKNoReport', '-1', '15', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-26 23:42:24', '2016-04-26 23:42:11', '2016-04-26 23:42:24', null, '0070006100640061002000640061007300610072006E00790061002000640065006E00670061006E002000470061006D006D00750020006B006900740061002000620069007300610020006D0065006E0067006900720069006D00200070006500730061006E00200053004D0053002000640061006C0061006D0020003200200063006100720061002000790061006900740075002000640065006E00670061006E0020006D0065006E006700670075006E0061006B0061006E00200063006F006D006D0061006E006400200069006E006A006500630074002000790061006E006700200073007500640061006800200064006900730065006400690061006B0061006E0020006F006C00650068002000470061006D006D0075002C00200061007400610075002000630061007200610020', '0895338982586,085721', 'Default_No_Compression', '050003870401', '+6289644000001', '-1', 'pada dasarnya dengan Gammu kita bisa mengirim pesan SMS dalam 2 cara yaitu dengan menggunakan command inject yang sudah disediakan oleh Gammu, atau cara ', '2', '', '1', 'SendingError', '-1', '-1', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-26 23:45:33', '2016-04-26 23:45:19', '2016-04-26 23:45:33', null, '00740065007300740020006C006100670069', '0895338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'test lagi', '4', '', '1', 'SendingOKNoReport', '-1', '16', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-26 23:47:39', '2016-04-26 23:47:11', '2016-04-26 23:47:39', null, '0074006500730074002000620072006F006100640063006100730074', '0895338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'test broadcast', '5', '', '1', 'SendingOKNoReport', '-1', '17', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-26 23:47:42', '2016-04-26 23:47:11', '2016-04-26 23:47:42', null, '0074006500730074002000620072006F006100640063006100730074', '085721110222', 'Default_No_Compression', '', '+6289644000001', '-1', 'test broadcast', '6', '', '1', 'SendingOKNoReport', '-1', '18', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-27 00:00:50', '2016-04-27 00:00:22', '2016-04-27 00:00:50', null, '0042007500740075006800200053006F00660074007700610072006500200053004D005300200047006100740065007700610079002000790061006E006700200073007500700070006F007200740020004D0075006C007400690020004D006F00640065006D00200075006E00740075006B00200053004D00530020004D0061007300610061006C0020006100740061007500200053004D0053002000500072006F006D006F00730069002E', '0895338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'Butuh Software SMS Gateway yang support Multi Modem untuk SMS Masaal atau SMS Promosi.', '7', '', '1', 'SendingOKNoReport', '-1', '19', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-27 00:00:54', '2016-04-27 00:00:23', '2016-04-27 00:00:54', null, '0042007500740075006800200053006F00660074007700610072006500200053004D005300200047006100740065007700610079002000790061006E006700200073007500700070006F007200740020004D0075006C007400690020004D006F00640065006D00200075006E00740075006B00200053004D00530020004D0061007300610061006C0020006100740061007500200053004D0053002000500072006F006D006F00730069002E', '085721110222', 'Default_No_Compression', '', '+6289644000001', '-1', 'Butuh Software SMS Gateway yang support Multi Modem untuk SMS Masaal atau SMS Promosi.', '8', '', '1', 'SendingOKNoReport', '-1', '20', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-27 00:03:26', '2016-04-27 00:03:20', '2016-04-27 00:03:26', null, '0062007500640069', '0895-338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'budi', '9', '', '1', 'SendingError', '-1', '-1', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-27 00:04:59', '2016-04-27 00:04:51', '2016-04-27 00:04:59', null, '006300610075', '0895-338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'cau', '10', '', '1', 'SendingError', '-1', '-1', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-27 00:09:05', '2016-04-27 00:08:43', '2016-04-27 00:09:05', null, '00740065007300740020006C006100670069002000640061006E0020006C006100670069', '0895-338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'test lagi dan lagi', '11', '', '1', 'SendingError', '-1', '-1', '255', 'Gammu 1.33.0');
INSERT INTO `sentitems` VALUES ('2016-04-27 00:12:40', '2016-04-27 00:12:31', '2016-04-27 00:12:40', null, '007A007A', '0895338982586', 'Default_No_Compression', '', '+6289644000001', '-1', 'zz', '12', '', '1', 'SendingOKNoReport', '-1', '21', '255', 'Gammu 1.33.0');

-- ----------------------------
-- Table structure for throttle
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------
INSERT INTO `throttle` VALUES ('1', null, 'global', null, '2016-04-25 16:22:50', '2016-04-25 16:22:50');
INSERT INTO `throttle` VALUES ('2', null, 'ip', '::1', '2016-04-25 16:22:50', '2016-04-25 16:22:50');
INSERT INTO `throttle` VALUES ('3', null, 'global', null, '2016-04-25 16:24:44', '2016-04-25 16:24:44');
INSERT INTO `throttle` VALUES ('4', null, 'ip', '::1', '2016-04-25 16:24:44', '2016-04-25 16:24:44');
INSERT INTO `throttle` VALUES ('5', null, 'global', null, '2016-04-25 16:24:59', '2016-04-25 16:24:59');
INSERT INTO `throttle` VALUES ('6', null, 'ip', '::1', '2016-04-25 16:24:59', '2016-04-25 16:24:59');
INSERT INTO `throttle` VALUES ('7', null, 'global', null, '2016-04-25 16:25:11', '2016-04-25 16:25:11');
INSERT INTO `throttle` VALUES ('8', null, 'ip', '::1', '2016-04-25 16:25:11', '2016-04-25 16:25:11');
INSERT INTO `throttle` VALUES ('9', null, 'global', null, '2016-04-27 00:42:23', '2016-04-27 00:42:23');
INSERT INTO `throttle` VALUES ('10', null, 'ip', '::1', '2016-04-27 00:42:24', '2016-04-27 00:42:24');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'suadmin@email.com', 'suadmin', '$2y$10$ehfDpHrYSR4mTj3aZvNzxuojWJ.FCMtn9O92EbqQqs.wbKgEeFspm', null, '2016-04-27 00:42:43', 'Budi', 'Suryana', '2016-04-25 15:20:29', '2016-04-27 00:42:43');
INSERT INTO `users` VALUES ('2', 'spv@email.com', 'spv', '$2y$10$avaRv0Exc6l9C4kWqSjMT.Y/lHoWoKFuUrRKV1WD..LzV6S6bWwou', null, null, 'John', 'Doe', '2016-04-25 15:20:30', '2016-04-25 15:20:30');
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER ;;
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox` FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `outbox_timestamp`;
DELIMITER ;;
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `phones_timestamp`;
DELIMITER ;;
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `sentitems_timestamp`;
DELIMITER ;;
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
;;
DELIMITER ;
