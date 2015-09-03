/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.5.16 : Database - ubn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`ubn` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ubn`;

/*Table structure for table `admin_messages` */

DROP TABLE IF EXISTS `admin_messages`;

CREATE TABLE `admin_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toUserId` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `admin_messages` */

/*Table structure for table `availables` */

DROP TABLE IF EXISTS `availables`;

CREATE TABLE `availables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `availables` */

insert  into `availables`(`id`,`userId`,`startDate`,`endDate`,`active`,`serviceId`) values (1,280,'2013-05-08 08:00:00','2013-05-08 17:00:00',1,0),(2,280,'2013-05-16 03:00:00','2013-05-16 12:00:00',1,0),(3,291,'2013-05-09 07:00:00','2013-05-09 23:00:00',1,0),(4,291,'2013-05-14 04:00:00','2013-05-14 08:00:00',1,0),(5,291,'2013-05-22 02:00:00','2013-05-22 05:00:00',1,0);

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) NOT NULL,
  `toUserId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `additionalInformation` text,
  `additionalDates` varchar(255) DEFAULT NULL,
  `milesFrom` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `questions` text,
  `status` enum('accepted','rejected','pending') DEFAULT 'pending',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `bookings` */

insert  into `bookings`(`id`,`fromUserId`,`toUserId`,`serviceId`,`additionalInformation`,`additionalDates`,`milesFrom`,`created`,`modified`,`questions`,`status`,`active`,`startDate`,`endDate`) values (1,280,291,64,'asdf',NULL,NULL,'2013-05-15 08:38:38','2013-05-16 14:33:31','{\"What are your learning goals?\":[\"Improve grades at school\",\"Prepare for a standardized test\"],\"How Often?\":null,\"I travel to the makeup artist\":null,\"I will travel up to\":\"10 miles\",\"The makeup artist travel to me \":null}','rejected',1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentId` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`parentId`,`title`,`created`,`modified`) values (337,NULL,'Stylists','2013-06-06 10:54:17','0000-00-00 00:00:00'),(338,NULL,'Barbers','2013-06-06 10:54:44','0000-00-00 00:00:00'),(339,NULL,'Salons','2013-06-06 10:54:55','0000-00-00 00:00:00'),(340,NULL,'Make-up Artists','2013-06-06 10:55:02','0000-00-00 00:00:00'),(341,NULL,'Fitness/Wellness Professionals','2013-06-06 10:57:12','0000-00-00 00:00:00'),(342,337,'Blowout','0000-00-00 00:00:00','0000-00-00 00:00:00'),(343,337,'Braiding','0000-00-00 00:00:00','0000-00-00 00:00:00'),(344,337,'Corrective Coloring','0000-00-00 00:00:00','0000-00-00 00:00:00'),(345,337,'Deep Condition','0000-00-00 00:00:00','0000-00-00 00:00:00'),(346,337,'Extensions','0000-00-00 00:00:00','0000-00-00 00:00:00'),(347,337,'Eyebrows','0000-00-00 00:00:00','0000-00-00 00:00:00'),(348,337,'Flat Iron','0000-00-00 00:00:00','0000-00-00 00:00:00'),(349,337,'Formal Bridal (Consultation Required)','0000-00-00 00:00:00','0000-00-00 00:00:00'),(350,337,'Hair Loss ','0000-00-00 00:00:00','0000-00-00 00:00:00'),(351,337,'Lace-Front','0000-00-00 00:00:00','0000-00-00 00:00:00'),(352,337,'Locs','0000-00-00 00:00:00','0000-00-00 00:00:00'),(353,337,'Natural Hair','0000-00-00 00:00:00','0000-00-00 00:00:00'),(354,337,'Permanent Color','0000-00-00 00:00:00','0000-00-00 00:00:00'),(355,337,'Perms','0000-00-00 00:00:00','0000-00-00 00:00:00'),(356,337,'Precision Cuts','0000-00-00 00:00:00','0000-00-00 00:00:00'),(357,337,'Press& Curl','0000-00-00 00:00:00','0000-00-00 00:00:00'),(358,337,'Retouch','0000-00-00 00:00:00','0000-00-00 00:00:00'),(359,337,'Roller Set','0000-00-00 00:00:00','0000-00-00 00:00:00'),(360,337,'Semi-Permanent Color','0000-00-00 00:00:00','0000-00-00 00:00:00'),(361,337,'Shampoo','0000-00-00 00:00:00','0000-00-00 00:00:00'),(362,337,'Trim','0000-00-00 00:00:00','0000-00-00 00:00:00'),(363,337,'Up-Do','0000-00-00 00:00:00','0000-00-00 00:00:00'),(364,337,'Virgin Relaxer','0000-00-00 00:00:00','0000-00-00 00:00:00'),(365,337,'Weaves','0000-00-00 00:00:00','0000-00-00 00:00:00'),(366,338,'Beard Trim','0000-00-00 00:00:00','0000-00-00 00:00:00'),(367,338,'Fades','0000-00-00 00:00:00','0000-00-00 00:00:00'),(368,338,'Kids Cuts','0000-00-00 00:00:00','0000-00-00 00:00:00'),(369,338,'Line-Up','0000-00-00 00:00:00','0000-00-00 00:00:00'),(370,338,'Razor Shave (Face)','0000-00-00 00:00:00','0000-00-00 00:00:00'),(371,338,'Razor Shave (Head)','0000-00-00 00:00:00','0000-00-00 00:00:00'),(372,338,'Women Taper','0000-00-00 00:00:00','0000-00-00 00:00:00'),(373,338,'Jheri Curls','0000-00-00 00:00:00','0000-00-00 00:00:00'),(374,339,'Barbershops','0000-00-00 00:00:00','0000-00-00 00:00:00'),(375,339,'Braiding Salons','0000-00-00 00:00:00','0000-00-00 00:00:00'),(376,339,'Kids Salon','0000-00-00 00:00:00','0000-00-00 00:00:00'),(377,339,'Dominican Salons','0000-00-00 00:00:00','0000-00-00 00:00:00'),(378,339,'Natural Hair Salons','0000-00-00 00:00:00','0000-00-00 00:00:00'),(379,340,'Beauty','0000-00-00 00:00:00','0000-00-00 00:00:00'),(380,340,'Editorial','0000-00-00 00:00:00','0000-00-00 00:00:00'),(381,340,'Fashion','0000-00-00 00:00:00','0000-00-00 00:00:00'),(382,340,'Film/TV','0000-00-00 00:00:00','0000-00-00 00:00:00'),(383,340,'Runway','0000-00-00 00:00:00','0000-00-00 00:00:00'),(384,340,'Special Effect','0000-00-00 00:00:00','0000-00-00 00:00:00'),(385,340,'Weddings','0000-00-00 00:00:00','0000-00-00 00:00:00'),(386,341,'Competitors','0000-00-00 00:00:00','0000-00-00 00:00:00'),(387,341,'Personal Trainers','0000-00-00 00:00:00','0000-00-00 00:00:00'),(388,341,'Nutritionists','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `deals` */

DROP TABLE IF EXISTS `deals`;

CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `listingId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text,
  `description` text,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `liveInHour` tinyint(1) NOT NULL DEFAULT '0',
  `price` float DEFAULT NULL,
  `isFixed` tinyint(1) NOT NULL DEFAULT '0',
  `valueDiscount` float DEFAULT NULL,
  `dealsCount` float DEFAULT NULL,
  `conditions` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `deals` */

insert  into `deals`(`id`,`userId`,`listingId`,`title`,`summary`,`description`,`startDate`,`endDate`,`startTime`,`endTime`,`liveInHour`,`price`,`isFixed`,`valueDiscount`,`dealsCount`,`conditions`,`image`) values (4,291,3,'asdasda','hnbhbhb','hnbhbnhb','2013-06-10','2013-06-29','10:00:00','17:00:00',0,500,0,7,NULL,'hbhbn',NULL);

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(500) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `anotherState` varchar(255) NOT NULL,
  `promotionalCode` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `events` */

/*Table structure for table `listing_photos` */

DROP TABLE IF EXISTS `listing_photos`;

CREATE TABLE `listing_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_place` int(11) unsigned NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo_alt` text CHARACTER SET latin1,
  `location` text CHARACTER SET latin1,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('photo','video') COLLATE utf8_bin NOT NULL DEFAULT 'photo',
  `id_listing` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Refplace1` (`id_place`,`id_user`),
  KEY `id_place` (`id_place`),
  CONSTRAINT `listing_photos_ibfk_1` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `listing_photos` */

insert  into `listing_photos`(`id`,`id_place`,`id_user`,`photo_alt`,`location`,`primary`,`type`,`id_listing`) values (16,217,291,'81e3a96129a854b53b01b78a79a9affd.gif','b91e014450ee643eb09ae5d49600b585.jpg',0,'photo',217),(19,217,291,'975d5515dac1b9c6f3d772e9dbdc6c03.jpg','http://www.youtube.com/watch?v=kY5P9sZqFas',0,'video',217),(20,220,312,'109bb2f98d3edf15931e36cc2605ccf3.jpg','109bb2f98d3edf15931e36cc2605ccf3.jpg',0,'photo',220),(21,220,312,'b160b007175b70adb67af8633826d264.jpg','b160b007175b70adb67af8633826d264.jpg',0,'photo',220);

/*Table structure for table `listing_reports` */

DROP TABLE IF EXISTS `listing_reports`;

CREATE TABLE `listing_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listingId` int(11) NOT NULL,
  `fromUserId` int(11) NOT NULL,
  `reportType` enum('offensive','criminal','bot','spammer','webUser','emailUser','phoneUser','longName','other') NOT NULL,
  `other` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `listing_reports` */

insert  into `listing_reports`(`id`,`listingId`,`fromUserId`,`reportType`,`other`,`created`,`modified`) values (5,211,291,'spammer',NULL,'2013-05-13 15:43:40','2013-05-13 15:43:40');

/*Table structure for table `listing_services` */

DROP TABLE IF EXISTS `listing_services`;

CREATE TABLE `listing_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `listingId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `listing_services` */

/*Table structure for table `listings` */

DROP TABLE IF EXISTS `listings`;

CREATE TABLE `listings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `status` enum('claim','claimed') NOT NULL DEFAULT 'claim',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `listings` */

/*Table structure for table `managers` */

DROP TABLE IF EXISTS `managers`;

CREATE TABLE `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `managers` */

insert  into `managers`(`id`,`email`,`password`,`created`) values (1,'admin@codebnb.me','ca83a27e2e80f838ba540028260d50bd','2011-10-13 00:00:00');

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` bigint(70) unsigned NOT NULL AUTO_INCREMENT,
  `threadId` bigint(60) unsigned DEFAULT NULL,
  `bookingId` int(11) DEFAULT NULL,
  `fromUserId` int(11) unsigned NOT NULL,
  `toUserId` int(11) unsigned NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `deletedFor` bigint(60) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - no one have deleted, Some Number - User with this id have deleted, if both sides have deleted remove this message',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_messages_thread` (`threadId`),
  KEY `FK_messages_sender` (`fromUserId`),
  KEY `FK_messages_receiver` (`toUserId`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`threadId`) REFERENCES `threads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`fromUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`toUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `messages` */

insert  into `messages`(`id`,`threadId`,`bookingId`,`fromUserId`,`toUserId`,`subject`,`message`,`deletedFor`,`deleted`,`created`) values (5,NULL,1,291,280,'re','refresh',0,0,'2013-05-15 08:40:10'),(6,NULL,1,291,280,'asdas','asdasd',0,0,'2013-05-15 08:40:14'),(7,1,NULL,291,280,'asdas','dasdasdasd',0,0,'2013-05-16 08:50:19'),(9,3,NULL,280,291,'fdg','dfg',0,0,'2013-05-16 08:55:34'),(10,4,NULL,280,291,'df','gfdg',0,0,'2013-05-16 08:57:00'),(11,NULL,NULL,280,291,NULL,'dfsdfsd',0,0,'2013-05-20 18:05:03'),(12,NULL,1,291,280,NULL,'asdasd',0,0,'2013-05-20 16:06:10'),(13,NULL,1,291,280,NULL,'asdasd',0,0,'2013-05-20 16:06:16'),(14,NULL,1,291,280,NULL,'sdfsf',0,0,'2013-05-22 13:38:52'),(15,NULL,1,291,280,NULL,'sdf',0,0,'2013-05-22 13:38:55'),(16,NULL,1,291,280,NULL,'sdf',0,0,'2013-05-22 13:38:56'),(17,NULL,1,291,280,NULL,'sdf',0,0,'2013-05-22 13:38:58'),(18,NULL,1,291,280,NULL,'sdf',0,0,'2013-05-22 13:39:00');

/*Table structure for table `newsletters` */

DROP TABLE IF EXISTS `newsletters`;

CREATE TABLE `newsletters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `date_send` datetime NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `newsletters` */

insert  into `newsletters`(`id`,`title`,`description`,`image`,`created`,`modified`,`date_send`,`archive`) values (1,'Samara Beauty Salon','Book your beauty online and save your time','a0430424e4dbd8b8635d71d081b1ae87.jpg','2013-06-07 07:51:09','2013-06-07 13:21:51','2013-06-18 13:21:00',0),(3,'New Service','New service from UBN','6e2b8591ceea3db8bf1669646c45fcac.jpg','2013-06-07 07:52:46','2013-06-07 14:09:57','2013-06-16 14:09:00',0),(11,'Important news','very important news','5957502062dbe40f40c40b77870cfa78.jpg','2013-06-07 07:52:49','2013-06-07 13:18:06','2013-06-14 13:18:00',0),(30,'Some new title','Some new description','303a7c7818968045ce4d2ff30e131b17.jpg','2013-06-07 16:43:21','2013-06-07 16:44:11','2013-06-06 16:43:00',1),(31,'Some new title2','description','ad9cca075775a2d21d0b37d4ea7adbb8.jpg','2013-06-10 09:21:48','2013-06-10 09:22:34','2013-06-07 09:21:00',1);

/*Table structure for table `paypals` */

DROP TABLE IF EXISTS `paypals`;

CREATE TABLE `paypals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `paypal` varchar(500) NOT NULL,
  `check` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `paypals` */

/*Table structure for table `place_photos` */

DROP TABLE IF EXISTS `place_photos`;

CREATE TABLE `place_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_place` int(11) unsigned NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo_alt` text CHARACTER SET latin1,
  `location` text CHARACTER SET latin1,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('photo','video') COLLATE utf8_bin NOT NULL DEFAULT 'photo',
  PRIMARY KEY (`id`),
  KEY `Refplace1` (`id_place`,`id_user`),
  KEY `id_place` (`id_place`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `place_photos` */

insert  into `place_photos`(`id`,`id_place`,`id_user`,`photo_alt`,`location`,`primary`,`type`) values (16,217,291,'81e3a96129a854b53b01b78a79a9affd.gif','b91e014450ee643eb09ae5d49600b585.jpg',0,'photo'),(19,217,291,'975d5515dac1b9c6f3d772e9dbdc6c03.jpg','http://www.youtube.com/watch?v=kY5P9sZqFas',0,'video'),(20,220,312,'109bb2f98d3edf15931e36cc2605ccf3.jpg','109bb2f98d3edf15931e36cc2605ccf3.jpg',0,'photo'),(21,220,312,'b160b007175b70adb67af8633826d264.jpg','b160b007175b70adb67af8633826d264.jpg',0,'photo');

/*Table structure for table `place_reports` */

DROP TABLE IF EXISTS `place_reports`;

CREATE TABLE `place_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placeId` int(11) NOT NULL,
  `fromUserId` int(11) NOT NULL,
  `reportType` enum('offensive','criminal','bot','spammer','webUser','emailUser','phoneUser','longName','other') NOT NULL,
  `other` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `place_reports` */

insert  into `place_reports`(`id`,`placeId`,`fromUserId`,`reportType`,`other`,`created`,`modified`) values (5,211,291,'spammer',NULL,'2013-05-13 15:43:40','2013-05-13 15:43:40');

/*Table structure for table `place_services` */

DROP TABLE IF EXISTS `place_services`;

CREATE TABLE `place_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `placeId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `place_services` */

/*Table structure for table `places` */

DROP TABLE IF EXISTS `places`;

CREATE TABLE `places` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `full_address` text,
  `title` varchar(35) DEFAULT NULL,
  `description` text,
  `property_type` varchar(50) DEFAULT NULL,
  `ll` varchar(500) NOT NULL,
  `availability` longtext NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `zip` varchar(10) NOT NULL,
  `supervision` tinyint(1) DEFAULT NULL,
  `energyTrans` tinyint(1) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Refusers4` (`id_user`),
  CONSTRAINT `places_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `places` */

insert  into `places`(`id`,`id_user`,`full_address`,`title`,`description`,`property_type`,`ll`,`availability`,`approved`,`zip`,`supervision`,`energyTrans`,`created`,`modified`,`email`,`phone`,`categoryId`) values (176,216,'1 Holt Park Avenue\r\nLeeds\r\nLS16 7RA','Mona Lisa','Cheerful Mona','Apartment','','',1,'',0,1,NULL,NULL,NULL,NULL,0),(177,217,'Los-Angeles','Modart Studio','modart','Apartment','34.0522342,-118.2436849','',1,'123',1,0,NULL,NULL,NULL,NULL,0),(190,238,'Yerevan','Title ','Desc','Apartment','','',1,'',1,1,NULL,NULL,NULL,NULL,0),(207,217,'Yerevan','Listing sample','\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','House','40.183333,44.516667','',1,'1254',1,1,NULL,NULL,NULL,NULL,0),(211,291,'Yellowknife, NT, Canada','','asdasdasd','House','40.183333,44.516667','',1,'',1,0,NULL,'2013-05-27 07:26:55',NULL,NULL,0),(216,290,'Amsterdam, The Netherlands','Title','Foo','House','40.7732456,-73.20042519999998','',1,'80003',1,1,NULL,NULL,NULL,NULL,0),(217,280,'Yerevan, Armenia','re41','desc','House','40.183333,44.516667','',1,'0000',1,0,'2013-05-08 07:33:28','2013-05-16 15:57:49',NULL,NULL,0),(218,299,'York, United Kingdom','teeeest','description','','41.87194,12.567379999999957','',1,'0000',1,1,'2013-05-15 13:43:35','2013-05-15 13:43:35',NULL,NULL,0),(219,299,'York, United Kingdom','teeeest','description','','41.87194,12.567379999999957','',1,'0000',1,1,'2013-05-15 13:43:46','2013-05-15 13:43:46',NULL,NULL,0),(220,312,'12B York Place Lets In The City Edinburgh, York Place, Edinburgh, United Kingdom','rrr','rrrrrr','House','41.87194,12.567379999999957','',1,'002',1,1,'2013-06-04 09:47:31','2013-06-05 10:29:00','elya.manoukian@gmail.com','45812102051',0);

/*Table structure for table `recommendations` */

DROP TABLE IF EXISTS `recommendations`;

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `listing_id` int(11) unsigned NOT NULL,
  `by_user_id` int(11) unsigned NOT NULL,
  `service_rate` float DEFAULT NULL,
  `prof_rate` float DEFAULT NULL,
  `comunication_rate` float DEFAULT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `approved` enum('approved','declined','unapproved') CHARACTER SET utf8 NOT NULL DEFAULT 'unapproved',
  `read` enum('read','unread') CHARACTER SET utf8 NOT NULL DEFAULT 'unread',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `value_rate` float DEFAULT NULL,
  `from_friend` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `listing_id` (`listing_id`),
  KEY `by_user_id` (`by_user_id`),
  CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recommendations_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `places` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recommendations_ibfk_3` FOREIGN KEY (`by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `recommendations` */

insert  into `recommendations`(`id`,`user_id`,`listing_id`,`by_user_id`,`service_rate`,`prof_rate`,`comunication_rate`,`content`,`approved`,`read`,`created`,`modified`,`value_rate`,`from_friend`) values (1,291,211,280,5,5,5,'    ','approved','unread','2013-05-21 12:43:23','2013-05-16 16:01:20',5,0);

/*Table structure for table `report_messages` */

DROP TABLE IF EXISTS `report_messages`;

CREATE TABLE `report_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageId` int(11) DEFAULT NULL,
  `threadId` int(11) DEFAULT NULL,
  `fromUserId` int(11) DEFAULT NULL,
  `reportType` enum('offensive','transact','solicit','spam','other') DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `report_messages` */

insert  into `report_messages`(`id`,`messageId`,`threadId`,`fromUserId`,`reportType`,`other`,`created`,`modified`) values (1,NULL,4,291,'solicit',NULL,'2013-05-21 12:09:47','2013-05-21 12:09:47'),(2,NULL,3,291,'solicit',NULL,'2013-05-21 12:10:29','2013-05-21 12:10:29'),(3,NULL,1,291,'spam',NULL,'2013-05-21 12:10:35','2013-05-21 12:10:35');

/*Table structure for table `service_medias` */

DROP TABLE IF EXISTS `service_medias`;

CREATE TABLE `service_medias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `serviceId` int(11) unsigned NOT NULL,
  `mediaType` enum('photo','video') NOT NULL,
  `path` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `serviceId` (`serviceId`),
  CONSTRAINT `service_medias_ibfk_1` FOREIGN KEY (`serviceId`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `service_medias` */

insert  into `service_medias`(`id`,`serviceId`,`mediaType`,`path`,`title`,`created`,`modified`) values (2,72,'photo','8e39af757837dd35795257dc264349c1.jpg','Desert','2013-06-05 10:36:49','2013-06-05 10:36:49'),(4,72,'photo','3672eeab3cd1d741bf41a4b1bbb1b18a.jpg','Tulips','2013-06-05 10:37:11','2013-06-05 10:37:11'),(5,72,'photo','6c580f1aa8350692e045f1d2ecf7bbb5.jpg','Tulips','2013-06-05 13:46:39','2013-06-05 13:46:39'),(6,72,'photo','6dcf87383fcc59530d130bf7859dc662.jpg','Hydrangeas','2013-06-05 13:46:46','2013-06-05 13:46:46');

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `subCategoryId` int(11) DEFAULT NULL,
  `subSubCategoryId` int(11) DEFAULT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `price` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text CHARACTER SET latin1,
  `offer` tinyint(1) DEFAULT NULL,
  `miles` varchar(6) COLLATE utf8_bin DEFAULT '0',
  `state` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_bin NOT NULL,
  `hours` int(3) NOT NULL,
  `property_type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `availability` longtext COLLATE utf8_bin NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `listingId` int(11) NOT NULL,
  `back_end` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `services` */

insert  into `services`(`id`,`userId`,`categoryId`,`subCategoryId`,`subSubCategoryId`,`title`,`price`,`address`,`created`,`modified`,`description`,`offer`,`miles`,`state`,`city`,`zip`,`hours`,`property_type`,`availability`,`approved`,`listingId`,`back_end`) values (64,280,319,1,2,'asdf',5545445,'Toronto, ON, Canada','2013-05-16 15:35:18','0000-00-00 00:00:00','',0,'0',NULL,NULL,'',0,NULL,'',0,0,0),(65,280,328,0,NULL,'asdasd',50880,'Yonge Street, Toronto, ON, Canada','2013-05-16 15:34:21','0000-00-00 00:00:00','',0,'0',NULL,NULL,'',0,NULL,'',0,0,0),(66,280,319,NULL,NULL,'asdasda',50,'Yonge Street, Toronto, ON, Canada','2013-05-16 15:34:24','0000-00-00 00:00:00','asdasd',0,'0',NULL,NULL,'',0,NULL,'',0,0,0),(67,298,321,NULL,NULL,'asd',20,'Yonge Street, Toronto, ON, Canada','0000-00-00 00:00:00','0000-00-00 00:00:00','asdasd',0,'0',NULL,NULL,'',0,NULL,'',0,0,0),(71,291,334,NULL,NULL,'asdasd',50,'Yonge Street, Toronto, ON, Canada','2013-05-21 11:53:27','2013-05-21 09:53:27',NULL,0,'5',NULL,NULL,'',0,NULL,'',0,0,0),(72,312,321,323,NULL,'Drive with pride',5,'Yerevan, Armenia','2013-06-05 12:39:43','2013-06-05 10:39:43',NULL,0,'10','st','Yerevan','00023',0,NULL,'',0,0,0),(73,312,329,0,NULL,'Have your style',5,'Yerevan City, Yerevan, Armenia','2013-06-04 16:14:39','2013-06-04 14:14:39','wswd',1,'5','st','Yerevan','00022',0,NULL,'',0,0,0),(74,312,321,323,NULL,'car driving lessons',15,'Arshakuniats Avenue, Yerevan, Armenia','2013-06-04 16:15:04','2013-06-04 14:15:04',NULL,0,'over30','','Yerevan','0002',0,NULL,'',0,0,0),(75,312,335,NULL,NULL,'Walking',15,'Shengavit, Yerevan, Armenia','2013-06-05 12:53:05','2013-06-05 12:53:05',NULL,1,'5','state','Yerevan','00025',0,NULL,'',0,0,0),(76,312,320,NULL,NULL,'BabyCare',20,'Davtashen, Yerevan, Armenia','2013-06-05 15:03:52','2013-06-05 13:03:52',NULL,1,NULL,'state','Yerevan','00026',0,NULL,'',0,0,0);

/*Table structure for table `threads` */

DROP TABLE IF EXISTS `threads`;

CREATE TABLE `threads` (
  `id` bigint(60) unsigned NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) unsigned NOT NULL,
  `toUserId` int(11) unsigned NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `categoryId` int(11) unsigned DEFAULT NULL,
  `subCategoryId` int(11) unsigned DEFAULT NULL,
  `serviceId` int(11) DEFAULT NULL,
  `canCall` tinyint(1) NOT NULL DEFAULT '0',
  `checkIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checkOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastMessage` text NOT NULL,
  `deletedFor` bigint(60) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - noone have deleted, 1 - receiver deleted, 2 - sender deleted, if both sender and receiver have deleted this just remove this thread',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `unread` bigint(40) NOT NULL DEFAULT '0',
  `reported` bigint(40) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_threads_from` (`fromUserId`),
  KEY `FK_threads_to` (`toUserId`),
  KEY `fromUserId` (`fromUserId`),
  KEY `toUserId` (`toUserId`),
  KEY `subCategoryId` (`subCategoryId`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`fromUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `threads_ibfk_2` FOREIGN KEY (`toUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `threads_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `threads_ibfk_4` FOREIGN KEY (`subCategoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `threads` */

insert  into `threads`(`id`,`fromUserId`,`toUserId`,`subject`,`categoryId`,`subCategoryId`,`serviceId`,`canCall`,`checkIn`,`checkOut`,`lastMessage`,`deletedFor`,`deleted`,`created`,`modified`,`unread`,`reported`) values (1,291,280,'asdas',NULL,NULL,NULL,0,'2013-05-17 09:55:18','0000-00-00 00:00:00','dasdasdasd',0,0,'2013-05-16 08:50:19','2013-05-17 07:55:18',0,0),(3,291,280,'fdg',NULL,NULL,NULL,0,'2013-05-17 09:49:10','0000-00-00 00:00:00','dfg',0,0,'2013-05-16 08:55:34','2013-05-17 07:49:10',0,0),(4,291,280,'df',NULL,NULL,NULL,0,'2013-05-17 09:49:15','0000-00-00 00:00:00','gfdg',0,0,'2013-05-16 08:57:00','2013-05-17 07:49:15',0,0);

/*Table structure for table `topics` */

DROP TABLE IF EXISTS `topics`;

CREATE TABLE `topics` (
  `id` bigint(60) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `topics` */

insert  into `topics`(`id`,`title`,`description`,`image`,`views`) values (1,'Topic title','descrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioptiondescrioption','topic.jpg',16);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activationCode` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `facebookId` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `type` enum('consumer','provider') CHARACTER SET latin1 NOT NULL DEFAULT 'consumer',
  `reg_completed` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `extended` datetime DEFAULT NULL,
  `fbLike` tinyint(1) NOT NULL DEFAULT '0',
  `lastShare` datetime DEFAULT NULL,
  `lastInvite` datetime DEFAULT NULL,
  `language` varchar(50) COLLATE utf8_bin NOT NULL,
  `company` varchar(50) COLLATE utf8_bin NOT NULL,
  `address_line1` varchar(255) COLLATE utf8_bin NOT NULL,
  `address_line2` varchar(255) COLLATE utf8_bin NOT NULL,
  `country` varchar(255) COLLATE utf8_bin NOT NULL,
  `state` varchar(255) COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `zip` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` int(50) NOT NULL,
  `fax` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `about_me` text COLLATE utf8_bin,
  `hear` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `full_address` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `other_hear` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mailing` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users` */

insert  into `users`(`id`,`activationCode`,`active`,`facebookId`,`first_name`,`last_name`,`email`,`password`,`created`,`type`,`reg_completed`,`code`,`points`,`paid`,`extended`,`fbLike`,`lastShare`,`lastInvite`,`language`,`company`,`address_line1`,`address_line2`,`country`,`state`,`city`,`zip`,`phone`,`fax`,`url`,`about_me`,`hear`,`gender`,`birthday`,`full_address`,`photo_path`,`facebook`,`modified`,`other_hear`,`mailing`) values (210,NULL,1,'100000419423743','Arman','Petrosyan','armanpetrosyan9@gmail.com','4161a1208a183218ba6013691d88608e','2013-04-09 19:47:55','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',55,'','',NULL,NULL,NULL,NULL,'Recife - Pernambuco, Brazil',NULL,NULL,'2013-06-06 13:56:30',NULL,0),(215,NULL,1,NULL,'Vladyslava','Podzigun','Vladyslava@codebnb.me','d8ca56f25f0ff27e03c826f1cbae08e3','2013-04-09 21:35:12','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(216,'90966c6bca6da58fba03690925ac86b7',0,NULL,'Lisa','','dream4you4ever@hotmail.com','77beb37ab3a26f9dab9d7a0edf785ba1','2013-04-10 03:28:03','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(217,'8b9db01e141f6ec4d0890c804ae21b96',1,NULL,'Edita','Kirakosyan','edita1008@mail.ru','d87fe85ef743b357bb31c3628f9304a4','2013-04-10 11:06:33','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2013-06-07 08:57:26',NULL,0),(238,'11dcf4ade252dac1e0ddc6ed4572c293',1,NULL,'Lilian','Hairapetian','lilianhairapetina@codebnb.me','d87fe85ef743b357bb31c3628f9304a4','2013-04-10 19:54:26','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(280,'fc5b45ed2e1156874bedcd029ed36b61',1,NULL,'Hovo','Malkhasyan','rainer.pain@gmail.com','ca83a27e2e80f838ba540028260d50bd','2013-04-12 22:20:40','consumer',0,NULL,1,0,'2013-05-19 15:10:35',0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(289,NULL,0,NULL,NULL,NULL,'arm@st-dev.com','c40301deea8f6be01fc51e1524cada5a','2013-04-19 13:00:28','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(290,'3bc5831389616b4eb9923c8696352498',1,NULL,'Arman','Petrosyan','Companyadmin@st-dev.com','c40301deea8f6be01fc51e1524cada5a','2013-05-06 19:12:06','provider',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(291,'7e8960b3de511025968e307e8754b991',1,NULL,'Joe','Rainer','some@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-08 07:31:49','provider',0,NULL,1,0,'2013-06-22 15:57:02',0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(292,NULL,1,NULL,'asdasd','sdf','some__p@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-08 13:26:48','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(293,NULL,0,NULL,'asdasdasdasd','asdasd','some_somich_chamich@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-08 15:35:32','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(294,NULL,0,NULL,'asdasd','sad','some_somich_1@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-08 15:56:19','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(297,NULL,0,NULL,'Johnny','Joe','some__another__me@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-14 10:03:58','provider',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(298,NULL,0,NULL,'asdf','asdasd','some_somich@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-14 16:25:17','provider',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(299,'7068b6aaa753c8044fa3d5a30a636fb2',0,NULL,'Johnny','jhjh','some__pP@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-15 13:41:15','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(300,NULL,0,NULL,'rgtetet','erterter','some__p_04@owesome4.dev','ca83a27e2e80f838ba540028260d50bd','2013-05-15 13:46:47','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'','','','','','','','',0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(308,'e122ae890b64686a31f61b0c47ba7a35',1,NULL,'arm','der','arm@mail.me','73e9dd09492f179507405acdba60efc2','2013-05-30 18:37:05','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'arm','','','','','','','',7,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(309,'7293259a96df75588de760d0481f9de0',1,NULL,'scsac','cassc','arm_dero@mail.ru','7fc85fd09d5869627c0ad382b9494719','2013-05-31 07:49:25','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'csc','','','','','','','',415,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(312,'039c5ab34e750e2d97e70a700cabec67',1,NULL,'Elya','Manoukian','elya.manoukian@gmail.com','acb3c87bba4f02b72920e3a6ffbaac42','2013-06-03 08:53:08','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'Eng','stdev','Address1','Address2','Armenia','','Yerevan','0002',565465465,'1452582565','www.url.ur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2013-06-07 17:14:45',NULL,1),(319,'da541eafe1d78dc9e7a8954b8f664b68',1,NULL,'Elya','Manoukian','candyk.4.7@gmail.com','acb3c87bba4f02b72920e3a6ffbaac42','2013-06-05 15:20:16','consumer',0,NULL,NULL,0,NULL,0,NULL,NULL,'English','stdev','Address1','Address2','Armenia','State','Yerevan','0002',2147483647,'1452582565','www.url.urq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2013-06-05 15:20:16',NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
