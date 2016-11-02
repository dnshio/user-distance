SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `repository`;
CREATE TABLE `repository` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `repository` (`id`, `name`) VALUES
(1,	'serializer'),
(2,	'composer'),
(3,	'guzzle'),
(4,	'phpunit'),
(5,	'imagine');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`) VALUES
(1,	'dnshio'),
(2,	'jms'),
(3,	'Seldaek'),
(4,	'lonewolf'),
(5,	'adder');

DROP TABLE IF EXISTS `user_repository`;
CREATE TABLE `user_repository` (
  `user_id` int(5) NOT NULL,
  `repository_id` int(5) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `repository_id` (`repository_id`),
  CONSTRAINT `user_repository_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_repository_ibfk_2` FOREIGN KEY (`repository_id`) REFERENCES `repository` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_repository` (`user_id`, `repository_id`) VALUES
(1,	1),
(1,	2),
(2,	2),
(2,	3),
(3,	3),
(4,	4),
(2,	5),
(3,	5),
(5,	5);