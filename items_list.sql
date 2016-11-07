-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `items_list` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `items_list`;

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `items` (`id`, `title`, `location`, `date_inserted`, `date_updated`, `state`) VALUES
(1,	'Test Item 1',	NULL,	'2016-11-07 13:21:01',	NULL,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `date_ofbirth` date DEFAULT NULL,
  `validator` varchar(42) DEFAULT NULL,
  `utype` int(11) NOT NULL,
  `ustatus` int(11) NOT NULL,
  `date_lastlogin` datetime DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `em_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `pass`, `firstname`, `lastname`, `gender`, `date_ofbirth`, `validator`, `utype`, `ustatus`, `date_lastlogin`, `date_inserted`, `date_updated`, `state`) VALUES
(1,	'admin',	'admin',	'admin',	'user',	'm',	'2010-03-01',	'632667547e7cd3e0466547863e1207a8c0c0c549',	1,	1,	'2016-11-07 12:40:19',	'2010-03-11 04:22:24',	'2010-03-11 04:22:24',	0);

-- 2016-11-07 13:22:24
