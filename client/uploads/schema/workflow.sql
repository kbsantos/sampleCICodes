/*
SQLyog Community v12.2.4 (64 bit)
MySQL - 5.6.24 : Database - resource_management
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`resource_management` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `resource_management`;

/*Table structure for table `actual_events` */

DROP TABLE IF EXISTS `actual_events`;

CREATE TABLE `actual_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `source` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `actual_events` */

insert  into `actual_events`(`id`,`source_id`,`transaction_id`,`status`,`source`) values 
(1,1,1,'done',NULL),
(2,1,2,NULL,NULL),
(3,1,3,NULL,NULL),
(4,1,0,NULL,NULL);

/*Table structure for table `business_processes` */

DROP TABLE IF EXISTS `business_processes`;

CREATE TABLE `business_processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `next_process_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `business_processes` */

insert  into `business_processes`(`id`,`next_process_id`,`name`,`description`,`create_date`) values 
(1,NULL,'Marketing','Marketing','2017-07-26 12:08:41');

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `next_event_id` int(11) DEFAULT NULL,
  `business_process_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `events` */

insert  into `events`(`id`,`next_event_id`,`business_process_id`,`name`,`description`,`create_date`) values 
(1,NULL,1,'Production Introduction','Production Introduction','2017-07-26 12:13:50');

/*Table structure for table `form` */

DROP TABLE IF EXISTS `form`;

CREATE TABLE `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `form` */

insert  into `form`(`id`,`name`,`description`,`create_date`) values 
(1,'Product Application','Product Application','2017-07-26 12:18:41');

/*Table structure for table `form_actual_event_values` */

DROP TABLE IF EXISTS `form_actual_event_values`;

CREATE TABLE `form_actual_event_values` (
  `actual_event_id` int(11) DEFAULT NULL,
  `form_field_id` int(11) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `form_actual_event_values` */

/*Table structure for table `form_fields` */

DROP TABLE IF EXISTS `form_fields`;

CREATE TABLE `form_fields` (
  `id` int(11) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `element` varchar(128) DEFAULT NULL,
  `default_value` varchar(1024) DEFAULT NULL,
  `name` varchar(512) DEFAULT NULL,
  `label` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `form_fields` */

insert  into `form_fields`(`id`,`form_id`,`element`,`default_value`,`name`,`label`) values 
(NULL,1,'text',NULL,'product_name','Product Name'),
(NULL,1,'text',NULL,'crop_size','Crop Size'),
(NULL,1,'text',NULL,'quantity','Quantity'),
(NULL,1,'text',NULL,'description','Application Description');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`event_id`,`form_id`,`name`,`description`,`create_date`) values 
(1,1,NULL,'Visit farmer','Visit farmer','2017-07-26 12:17:05'),
(2,1,NULL,'Create a demo crop','Create a demo crop','2017-07-26 12:17:19'),
(3,1,1,'Apply product','Apply product','2017-07-26 12:17:42'),
(4,1,NULL,'Harvest','Harvest','2017-07-26 12:17:52');

/*Table structure for table `user_in_actual_event` */

DROP TABLE IF EXISTS `user_in_actual_event`;

CREATE TABLE `user_in_actual_event` (
  `user_id` int(11) DEFAULT NULL,
  `actual_event_id` int(11) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_in_actual_event` */

insert  into `user_in_actual_event`(`user_id`,`actual_event_id`,`start_date`,`end_date`,`status`) values 
(1,1,'2017-07-26 15:02:28','0000-00-00 00:00:00','done'),
(1,2,'2017-07-26 15:02:33','0000-00-00 00:00:00',NULL),
(1,3,'2017-07-26 15:04:12','0000-00-00 00:00:00',NULL),
(1,4,'2017-07-26 15:04:21','0000-00-00 00:00:00',NULL),
(2,2,'2017-07-26 15:20:52','0000-00-00 00:00:00',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
