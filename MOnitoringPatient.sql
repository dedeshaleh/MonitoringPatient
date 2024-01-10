/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.22-MariaDB : Database - monitoringpatient
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`monitoringpatient` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `monitoringpatient`;

/*Table structure for table `aplikasi` */

DROP TABLE IF EXISTS `aplikasi`;

CREATE TABLE `aplikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `aplikasi` */

insert  into `aplikasi`(`id`,`nama_owner`,`alamat`,`tlp`,`title`,`nama_aplikasi`,`logo`,`copy_right`,`versi`,`tahun`,`update_date`,`update_by`) values 
(1,'PT Bethsaida Hospitas International','JL. Boulevard Raya','21','Aplikasi Patient','Patient Information','logo_beth1.png','Dev IT','1.0.0.0',2022,'2022-11-22 07:59:10','1');

/*Table structure for table `aplikasi_log` */

DROP TABLE IF EXISTS `aplikasi_log`;

CREATE TABLE `aplikasi_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `aplikasi_log` */

/*Table structure for table `tbl_akses_menu` */

DROP TABLE IF EXISTS `tbl_akses_menu`;

CREATE TABLE `tbl_akses_menu` (
  `id_user` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_akses_menu` */

insert  into `tbl_akses_menu`(`id_user`,`id_menu`,`view_level`,`add_level`,`edit_level`,`delete_level`,`print_level`,`upload_level`) values 
(1,1,'Y','','','','N','N'),
(1,2,'Y','','','','N','N'),
(1,3,'','','','','N','N'),
(1,4,'','','','','N','N'),
(1,5,'Y','','','','N','N'),
(1,7,'Y','','','','N','N'),
(1,43,'','','','','N','N'),
(1,45,'','','','','N','N'),
(1,46,'','','','','N','N'),
(1,48,'','','','','N','N'),
(1,49,'','','','','N','N'),
(1,50,'Y','Y','','','N','N'),
(1,51,'Y','','Y','Y','N','N'),
(1,52,'','','','','N','N'),
(1,53,'','','','','N','N'),
(1,54,'','','','','N','N'),
(7,1,'','','','','N','N'),
(7,2,'Y','','','','N','N'),
(7,3,'Y','','','','N','N'),
(7,4,'','','','','N','N'),
(7,5,'Y','','','','N','N'),
(7,7,'','Y','','','N','N'),
(7,43,'','','','','N','N'),
(7,45,'','','','','N','N'),
(7,46,'','','','','N','N'),
(7,48,'','','','','N','N'),
(7,49,'','','','','N','N'),
(7,50,'','','','','N','N'),
(7,51,'Y','','','','N','N'),
(7,52,'','','','','N','N'),
(7,53,'','','','','N','N'),
(7,54,'','','','','N','N'),
(5,1,'','','','','N','N'),
(5,2,'Y','','','','N','N'),
(5,3,'Y','','','','N','N'),
(5,4,'Y','','','','N','N'),
(5,5,'Y','','','','N','N'),
(5,7,'Y','','','','N','N'),
(5,43,'','','','','N','N'),
(5,45,'','','','','N','N'),
(5,46,'','','','','N','N'),
(5,48,'Y','','','','N','N'),
(5,49,'','','','','N','N'),
(5,50,'Y','Y','','','N','N'),
(5,51,'Y','','','','N','N'),
(5,52,'Y','','','','N','N'),
(5,53,'','','','','N','N'),
(5,54,'','','','','N','N'),
(1,57,'Y','','','','N','N'),
(1,58,'Y','Y','Y','Y','N','N'),
(1,59,'Y','Y','Y','Y','N','N');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(20) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y',
  `status_menu` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`id_menu`,`nama_menu`,`link`,`icon`,`urutan`,`is_active`,`parent`,`status_menu`,`parent_id`,`create_date`,`create_by`,`update_date`,`update_by`) values 
(1,'Dashboard','dashboard','fas fa-tachometer-alt',1,'Y','','1',0,NULL,NULL,NULL,NULL),
(2,'System','Sys','fas fa-cogs',2,'Y','Y','1',1,NULL,NULL,NULL,NULL),
(3,'Data Master','Master','fas fa-database',3,'Y','Y','1',0,NULL,NULL,NULL,NULL),
(5,'Aplikasi','Aplikasi','fas fa-wrench',1,'Y','Y','2',2,NULL,NULL,NULL,NULL),
(7,'Menu','Menu','far fa-folder',2,'Y','Y','2',2,NULL,NULL,NULL,NULL),
(45,'Master Users','Users','fas fa-user',1,'Y','Y','2',3,NULL,NULL,NULL,NULL),
(46,'Master Level','level','fas fa-cogs',4,'Y','Y','2',3,NULL,NULL,NULL,NULL),
(51,'Hak Akses','Akses','fas fa-user-lock',3,'Y','Y','2',2,NULL,NULL,NULL,NULL),
(57,'Reports','Reports','fas fa-info',3,'Y','Y','1',0,NULL,NULL,NULL,NULL),
(58,'Laporan Patient','LapPatient','fas fa-user',1,'Y','Y','2',57,NULL,NULL,NULL,NULL),
(59,'Laporan Patient Tidak Sesuai','LapPatientAno','fas fa-user',2,'Y','Y','2',57,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`username`,`full_name`,`password`,`id_level`,`image`,`is_active`,`create_date`,`create_by`,`update_date`,`update_by`) values 
(1,'admin','Administrator','$2y$05$GQIUPI1UU4a0Zps6q3J61ufkJjHJ/VaFk0oeJcXIWbBslzLRK2Gcm',1,'tesss2.png','Y','2022-10-25 16:44:20','7',NULL,NULL),
(4,'Staff','Anom','$2y$05$1U7NtNqYtTcYOjbngVzeyOcZKCGS/HDHnMZAUd2TSHazuAWJyGTwW',2,'staff1.jpg','Y',NULL,NULL,NULL,NULL),
(5,'Supervisor','Dwi Anggra','$2y$05$4dyUnDXuM6JRsOPke3jwpuESSJKM7Vdy8TTr2adKqtNOJEpJUjMGu',3,'supervisor1.JPG','Y',NULL,NULL,NULL,NULL),
(7,'TEST','TEST','$2y$05$ypOtBOzv6G.qIukY1f36ceVnbujZ.Mjr/iI8wu4NB6rrfY3MAhDQO',2,'27089.JPG','Y','2022-10-25 16:43:41','7',NULL,NULL);

/*Table structure for table `tbl_userlevel` */

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_userlevel` */

insert  into `tbl_userlevel`(`id_level`,`nama_level`) values 
(1,'admin'),
(2,'Staff'),
(3,'Supervisor');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
