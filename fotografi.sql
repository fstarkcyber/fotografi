/*
SQLyog Enterprise v12.5.1 (32 bit)
MySQL - 10.4.22-MariaDB : Database - fotografi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fotografi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `fotografi`;

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `parrent_id` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `sequence` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `role_menus` (`role_id`),
  CONSTRAINT `role_menus` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`slug`,`icon`,`parrent_id`,`role_id`,`sequence`,`created_at`,`updated_at`) values 
(1,'Dashboard','dashboard','ni ni-tv-2',0,1,1,'2022-06-08 18:44:14','2022-06-08 18:56:51'),
(2,'Master Data','master-data','ni ni-diamond',0,1,2,'2022-06-08 18:55:17','2022-06-08 18:56:52'),
(3,'Daftar Paket','paket','ni ni-bag-17',2,1,1,'2022-06-08 18:56:50','2022-06-14 16:17:53'),
(4,'Daftar User','users','ni ni-circle-08',0,1,4,'2022-06-09 17:56:30','2022-06-09 18:09:05'),
(5,'Pesanan','pesanan','ni ni-money-coins',0,1,3,'2022-06-09 17:58:57','2022-06-09 18:03:41'),
(6,'Dashboard','dashboard','ni ni-tv-2',0,3,1,'2022-06-09 17:58:57','2022-06-09 18:03:41'),
(7,'Daftar Paket','paket-c','ni ni-bag-17',0,3,2,'2022-06-09 17:58:57','2022-06-09 18:03:41'),
(8,'Daftar Transaksi','transaksi-c','ni ni-money-coins',0,3,3,'2022-06-09 17:58:57','2022-06-09 18:03:41'),
(9,'Jadwal','jadwal-c','ni ni-calendar-grid-58',0,3,4,'2022-06-09 17:58:57','2022-06-09 18:03:41');

/*Table structure for table `packet_images` */

DROP TABLE IF EXISTS `packet_images`;

CREATE TABLE `packet_images` (
  `id_packet_images` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `packet_id` bigint(20) unsigned DEFAULT NULL,
  `image_name` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id_packet_images`),
  KEY `id_packet_fk` (`packet_id`),
  CONSTRAINT `id_packet_fk` FOREIGN KEY (`packet_id`) REFERENCES `packets` (`id_packet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `packet_images` */

insert  into `packet_images`(`id_packet_images`,`packet_id`,`image_name`) values 
(1,1,'paket-1.jpeg'),
(2,2,'paket-2.jpeg'),
(3,3,'paket-3.jpeg'),
(4,4,'paket-4.jpeg'),
(5,5,'paket-5.jpeg'),
(6,6,'paket-6.jpeg'),
(18,1,'1.png'),
(19,1,'2.png');

/*Table structure for table `packets` */

DROP TABLE IF EXISTS `packets`;

CREATE TABLE `packets` (
  `id_packet` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `packet_name` varchar(150) DEFAULT NULL,
  `packet_duration` varchar(150) DEFAULT NULL,
  `packet_price` int(10) unsigned DEFAULT NULL,
  `packet_description` text DEFAULT NULL,
  `membership` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_packet`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `packets` */

insert  into `packets`(`id_packet`,`packet_name`,`packet_duration`,`packet_price`,`packet_description`,`membership`,`created_at`,`updated_at`) values 
(1,'Paket 1','3 Hours of Usage',500000,'Kostum, 1 Backround. 15 Foto (Original Photo), 7 Foto Edit, Tidak Cetak','no','2022-06-14 17:02:38','2022-06-14 17:03:45'),
(2,'Paket 2','6 Hours of Usage',800000,'Kostum, 3 Background, 27 Foto, (Original Photo), 15 Foto Edit, 3 Cetak','no','2022-06-14 17:03:43',NULL),
(3,'Paket 3','10 Hours of Usage',1200000,'Kostum, 5 Background, 40 Foto (Original Photo), 20 Foto Edit, 10 Cetak','no','2022-06-14 17:04:46',NULL),
(4,'Paket 4','10 Hours of Usage',1800000,'Kostum, 7 Background, 50 Foto (Original Photo), 25 Foto Edit, Cetak Album','no','2022-06-14 17:05:35',NULL),
(5,'Paket 5','Unlimited Shoot',2500000,'Kostum, Make up, All Background, 80 Foto (Full HD), 40 Foto Edit, Album Jumbo','no','2022-06-14 17:06:46',NULL),
(6,'Paket 6','Unlimited Shoot',5000000,'Kostum, Make up, All Background, 110 Foto (Full HD), 60 Foto Edit, Album Jumbo','no','2022-06-14 17:07:33',NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`slug`,`created_at`,`updated_at`) values 
(1,'Administrator','admin','2022-06-08 15:41:40',NULL),
(2,'Fotografer','fotografer','2022-06-09 18:06:46',NULL),
(3,'Customer','customer','2022-06-09 18:06:55',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `status` bigint(20) DEFAULT 0,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `roles_users` (`role_id`),
  CONSTRAINT `roles_users` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`role_id`,`status`,`images`,`created_at`,`updated_at`) values 
(84,'Ahmad Fatoni','admin@mindotek.com',NULL,'$2y$10$UFcHvhQLBZxdLT69jXnc3uQ94yDw1EiD4zA7/o5.ZTS4UMFPtlsqW',NULL,1,1,NULL,'2022-06-08 15:42:08',NULL),
(85,'Customer','customer@mindotek.com',NULL,'$2y$10$UFcHvhQLBZxdLT69jXnc3uQ94yDw1EiD4zA7/o5.ZTS4UMFPtlsqW',NULL,3,1,NULL,'2022-06-08 15:42:08',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
