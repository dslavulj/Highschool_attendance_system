/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.7.26-0ubuntu0.18.04.1 : Database - Srednja Skola
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`Srednja Skola` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_croatian_ci */;

USE `Srednja Skola`;

/*Table structure for table `Dolasci` */

DROP TABLE IF EXISTS `Dolasci`;

CREATE TABLE `Dolasci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ucenikID` int(11) DEFAULT NULL,
  `rasporedID` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dolasci_ucenik` (`ucenikID`),
  KEY `fk_dolasci_raspored` (`rasporedID`),
  CONSTRAINT `fk_dolasci_raspored` FOREIGN KEY (`rasporedID`) REFERENCES `Raspored` (`id`),
  CONSTRAINT `fk_dolasci_ucenik` FOREIGN KEY (`ucenikID`) REFERENCES `Ucenici` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

/*Data for the table `Dolasci` */

insert  into `Dolasci`(`id`,`ucenikID`,`rasporedID`,`datum`) values 
(1,1,1,'2019-05-25'),
(2,2,1,'2019-05-25'),
(3,3,1,'2019-05-25'),
(4,4,1,'2019-05-25'),
(5,5,1,'2019-05-25'),
(6,6,1,'2019-05-25'),
(7,7,1,'2019-05-25'),
(8,8,1,'2019-05-25'),
(9,10,4,'2019-05-25'),
(10,11,4,'2019-05-25'),
(11,12,4,'2019-05-25'),
(12,13,4,'2019-05-25'),
(13,14,4,'2019-05-25'),
(14,16,4,'2019-05-25'),
(15,17,4,'2019-05-25'),
(16,18,4,'2019-05-25'),
(17,19,4,'2019-05-25'),
(18,20,4,'2019-05-25'),
(19,1,2,'2019-05-25'),
(20,2,2,'2019-05-25'),
(21,3,2,'2019-05-25'),
(22,4,2,'2019-05-25'),
(23,5,2,'2019-05-25'),
(24,6,2,'2019-05-25'),
(25,7,2,'2019-05-25'),
(26,8,2,'2019-05-25'),
(27,10,5,'2019-05-25'),
(28,11,5,'2019-05-25'),
(29,12,5,'2019-05-25'),
(30,13,5,'2019-05-25'),
(31,14,5,'2019-05-25'),
(32,16,5,'2019-05-25'),
(33,17,5,'2019-05-25'),
(34,18,5,'2019-05-25'),
(35,19,5,'2019-05-25'),
(36,20,5,'2019-05-25'),
(37,1,3,'2019-05-25'),
(38,2,3,'2019-05-25'),
(39,3,3,'2019-05-25'),
(40,4,3,'2019-05-25'),
(41,5,3,'2019-05-25'),
(42,6,3,'2019-05-25'),
(43,7,3,'2019-05-25'),
(44,8,3,'2019-05-25'),
(45,10,6,'2019-05-25'),
(46,11,6,'2019-05-25'),
(47,12,6,'2019-05-25'),
(48,13,6,'2019-05-25'),
(49,14,6,'2019-05-25'),
(50,16,6,'2019-05-25'),
(51,17,6,'2019-05-25'),
(52,18,6,'2019-05-25'),
(53,19,6,'2019-05-25'),
(54,20,6,'2019-05-25'),
(55,1,1,'2019-05-26'),
(56,2,1,'2019-05-26'),
(57,3,1,'2019-05-26'),
(58,4,1,'2019-05-26'),
(59,8,1,'2019-05-26'),
(60,10,4,'2019-05-26'),
(61,11,4,'2019-05-26'),
(62,12,4,'2019-05-26'),
(63,13,4,'2019-05-26'),
(64,14,4,'2019-05-26'),
(65,18,4,'2019-05-26'),
(66,19,4,'2019-05-26'),
(67,20,4,'2019-05-26'),
(68,1,2,'2019-05-26'),
(69,2,2,'2019-05-26'),
(70,3,2,'2019-05-26'),
(71,4,2,'2019-05-26'),
(72,8,2,'2019-05-26'),
(73,10,5,'2019-05-26'),
(74,11,5,'2019-05-26'),
(75,12,5,'2019-05-26'),
(76,13,5,'2019-05-26'),
(77,14,5,'2019-05-26'),
(78,18,5,'2019-05-26'),
(79,19,5,'2019-05-26'),
(80,20,5,'2019-05-26'),
(81,1,3,'2019-05-26'),
(82,2,3,'2019-05-26'),
(83,3,3,'2019-05-26'),
(84,4,3,'2019-05-26'),
(85,8,3,'2019-05-26'),
(86,10,6,'2019-05-26'),
(87,11,6,'2019-05-26'),
(88,12,6,'2019-05-26'),
(89,13,6,'2019-05-26'),
(90,19,6,'2019-05-26'),
(91,20,6,'2019-05-26'),
(93,1,1,'2019-06-10'),
(94,2,1,'2019-06-10'),
(95,3,1,'2019-06-10'),
(96,4,1,'2019-06-10'),
(97,5,1,'2019-06-10'),
(98,6,1,'2019-06-10'),
(99,7,1,'2019-06-10'),
(100,8,1,'2019-06-10'),
(101,10,4,'2019-06-10'),
(102,11,4,'2019-06-10'),
(103,12,4,'2019-06-10'),
(104,13,4,'2019-06-10'),
(105,14,4,'2019-06-10'),
(106,16,4,'2019-06-10'),
(107,17,4,'2019-06-10'),
(108,18,4,'2019-06-10'),
(109,19,4,'2019-06-10'),
(110,20,4,'2019-06-10'),
(111,1,2,'2019-06-10'),
(112,2,2,'2019-06-10'),
(113,3,2,'2019-06-10'),
(114,4,2,'2019-06-10'),
(115,5,2,'2019-06-10'),
(116,6,2,'2019-06-10'),
(117,7,2,'2019-06-10'),
(118,8,2,'2019-06-10'),
(119,10,5,'2019-06-10'),
(120,11,5,'2019-06-10'),
(121,12,5,'2019-06-10'),
(122,13,5,'2019-06-10'),
(123,14,5,'2019-06-10'),
(124,16,5,'2019-06-10'),
(125,17,5,'2019-06-10'),
(126,18,5,'2019-06-10'),
(127,19,5,'2019-06-10'),
(128,20,5,'2019-06-10'),
(129,1,3,'2019-06-10'),
(130,2,3,'2019-06-10'),
(131,3,3,'2019-06-10'),
(132,4,3,'2019-06-10'),
(133,5,3,'2019-06-10'),
(134,6,3,'2019-06-10'),
(135,7,3,'2019-06-10'),
(136,8,3,'2019-06-10'),
(137,10,6,'2019-06-10'),
(138,11,6,'2019-06-10'),
(139,12,6,'2019-06-10'),
(140,13,6,'2019-06-10'),
(141,14,6,'2019-06-10'),
(142,16,6,'2019-06-10'),
(143,17,6,'2019-06-10'),
(144,18,6,'2019-06-10'),
(145,19,6,'2019-06-10'),
(146,20,6,'2019-06-10'),
(147,1,1,'2019-06-11'),
(148,2,1,'2019-06-11'),
(149,3,1,'2019-06-11'),
(150,4,1,'2019-06-11'),
(151,5,1,'2019-06-11'),
(152,6,1,'2019-06-11'),
(153,7,1,'2019-06-11'),
(154,8,1,'2019-06-11'),
(155,10,4,'2019-06-11'),
(156,11,4,'2019-06-11'),
(157,12,4,'2019-06-11'),
(158,13,4,'2019-06-11'),
(159,14,4,'2019-06-11'),
(160,16,4,'2019-06-11'),
(161,17,4,'2019-06-11'),
(162,18,4,'2019-06-11'),
(163,19,4,'2019-06-11'),
(164,20,4,'2019-06-11'),
(165,1,2,'2019-06-11'),
(166,2,2,'2019-06-11'),
(167,3,2,'2019-06-11'),
(168,4,2,'2019-06-11'),
(169,5,2,'2019-06-11'),
(170,6,2,'2019-06-11'),
(171,7,2,'2019-06-11'),
(172,8,2,'2019-06-11'),
(173,10,5,'2019-06-11'),
(174,11,5,'2019-06-11'),
(175,12,5,'2019-06-11'),
(176,13,5,'2019-06-11'),
(177,14,5,'2019-06-11'),
(178,16,5,'2019-06-11'),
(179,17,5,'2019-06-11'),
(180,18,5,'2019-06-11'),
(181,19,5,'2019-06-11'),
(182,20,5,'2019-06-11'),
(183,1,3,'2019-06-11'),
(184,2,3,'2019-06-11'),
(185,3,3,'2019-06-11'),
(186,4,3,'2019-06-11'),
(187,5,3,'2019-06-11'),
(188,6,3,'2019-06-11'),
(189,7,3,'2019-06-11'),
(190,8,3,'2019-06-11'),
(191,10,6,'2019-06-11'),
(192,11,6,'2019-06-11'),
(193,12,6,'2019-06-11'),
(194,13,6,'2019-06-11'),
(195,14,6,'2019-06-11'),
(196,16,6,'2019-06-11'),
(197,17,6,'2019-06-11'),
(198,18,6,'2019-06-11'),
(199,19,6,'2019-06-11'),
(200,20,6,'2019-06-11');

/*Table structure for table `Raspored` */

DROP TABLE IF EXISTS `Raspored`;

CREATE TABLE `Raspored` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `skolski_sat` int(11) DEFAULT NULL,
  `uciteljID` int(11) DEFAULT NULL,
  `ucionicaID` int(11) DEFAULT NULL,
  `razredID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_raspored_ucitelj` (`uciteljID`),
  KEY `fk_raspored_ucionica` (`ucionicaID`),
  KEY `fk_raspored_razred` (`razredID`),
  CONSTRAINT `fk_raspored_razred` FOREIGN KEY (`razredID`) REFERENCES `Razred` (`id`),
  CONSTRAINT `fk_raspored_ucionica` FOREIGN KEY (`ucionicaID`) REFERENCES `Ucionice` (`broj_ucionice`),
  CONSTRAINT `fk_raspored_ucitelj` FOREIGN KEY (`uciteljID`) REFERENCES `Ucitelji` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

/*Data for the table `Raspored` */

insert  into `Raspored`(`id`,`naziv`,`skolski_sat`,`uciteljID`,`ucionicaID`,`razredID`) values 
(1,'Matematika',1,1,101,1),
(2,'Fizika',2,2,101,1),
(3,'Hrvatski',3,3,101,1),
(4,'Engleski',1,4,102,2),
(5,'Informatika',2,5,102,2),
(6,'Biologija',3,6,102,2),
(7,'Matematika2',4,1,102,2);

/*Table structure for table `Razred` */

DROP TABLE IF EXISTS `Razred`;

CREATE TABLE `Razred` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(3) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `razrednikID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_razred_ucitelj` (`razrednikID`),
  CONSTRAINT `fk_razred_ucitelj` FOREIGN KEY (`razrednikID`) REFERENCES `Ucitelji` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

/*Data for the table `Razred` */

insert  into `Razred`(`id`,`naziv`,`razrednikID`) values 
(1,'1a',1),
(2,'1b',2);

/*Table structure for table `Ucenici` */

DROP TABLE IF EXISTS `Ucenici`;

CREATE TABLE `Ucenici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `prezime` varchar(50) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `username` varchar(50) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `lozinka` varchar(64) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `razredID` int(11) NOT NULL,
  `UID` varchar(11) COLLATE cp1250_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ucenici_razred` (`razredID`),
  CONSTRAINT `fk_ucenici_razred` FOREIGN KEY (`razredID`) REFERENCES `Razred` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

/*Data for the table `Ucenici` */

insert  into `Ucenici`(`id`,`ime`,`prezime`,`username`,`lozinka`,`razredID`,`UID`) values 
(1,'Tanja','Krog','tkrog','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,'4B 0B C6 1B'),
(2,'Matea','Omanović','momanovic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,'CB 56 C7 1B'),
(3,'Antun','Mandić','amandic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,'27 2C B0 11'),
(4,'Antonio','Pavić','apavic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,'C6 83 16 F0'),
(5,'Borna','Knežević','bknezevic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,NULL),
(6,'Dora','Vidaković','dvidakovic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,NULL),
(7,'Vesna','Đukić','vdukic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,NULL),
(8,'Marina','Zadro','mzadro','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,NULL),
(9,'Antonia','Čoić','acoic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,NULL),
(10,'Biljana','Vidović','bvidovic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',1,NULL),
(11,'David','Vučetić','dvucetic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(12,'Bernarda','Tomić','btomic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(13,'Zvonimir','Žarković','zzarkovic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(14,'Denis','Šapina','dsapina','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(15,'Ana','Radak','aradak','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(16,'Dino','Bošnjak','dbosnjak','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(17,'Kristina','Pešerović','kpeserovic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(18,'Toni','Tošeski','ttoseski','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(19,'Ivan','Horvat','ihorvat','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL),
(20,'Danijel','Zečević','dzecevic','$2y$10$EraGImyxyID0o8TXMG9ng.XZqiiz8uFtn7S.btH.96exnlwLYHPUi',2,NULL);

/*Table structure for table `Ucionice` */

DROP TABLE IF EXISTS `Ucionice`;

CREATE TABLE `Ucionice` (
  `broj_ucionice` int(11) NOT NULL,
  PRIMARY KEY (`broj_ucionice`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

/*Data for the table `Ucionice` */

insert  into `Ucionice`(`broj_ucionice`) values 
(101),
(102);

/*Table structure for table `Ucitelji` */

DROP TABLE IF EXISTS `Ucitelji`;

CREATE TABLE `Ucitelji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `prezime` varchar(50) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `username` varchar(50) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `lozinka` varchar(64) COLLATE cp1250_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

/*Data for the table `Ucitelji` */

insert  into `Ucitelji`(`id`,`ime`,`prezime`,`username`,`lozinka`) values 
(1,'Petra','Jukić','pjukic','$2y$10$yWOgeqx/H6ibEk4sS1oyCuIRnpG.W8kqFnlwOfAwSxjK4RyCqnf2W'),
(2,'Vedran','Grubišić','vgrubisic','$2y$10$yWOgeqx/H6ibEk4sS1oyCuIRnpG.W8kqFnlwOfAwSxjK4RyCqnf2W'),
(3,'Lucija','Brčić','lbrcic','$2y$10$yWOgeqx/H6ibEk4sS1oyCuIRnpG.W8kqFnlwOfAwSxjK4RyCqnf2W'),
(4,'Danijel','Tkalčić','dtkalcic','$2y$10$yWOgeqx/H6ibEk4sS1oyCuIRnpG.W8kqFnlwOfAwSxjK4RyCqnf2W'),
(5,'Anto','Bošnjak','abosnjak','$2y$10$yWOgeqx/H6ibEk4sS1oyCuIRnpG.W8kqFnlwOfAwSxjK4RyCqnf2W'),
(6,'Leona','Vidović','lvidovic','$2y$10$yWOgeqx/H6ibEk4sS1oyCuIRnpG.W8kqFnlwOfAwSxjK4RyCqnf2W');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
