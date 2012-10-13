-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

TRUNCATE `task`;
INSERT INTO `task` (`id`, `name`) VALUES
(1,	'task 1'),
(2,	'task 2');

TRUNCATE `task_event`;
INSERT INTO `task_event` (`id`, `task_id`, `time`, `event`) VALUES
(1,	1,	1349905648,	'start'),
(2,	1,	1349905851,	'stop'),
(3,	1,	1349905895,	'start'),
(4,	1,	1349905901,	'stop'),
(5,	1,	1349905918,	'start'),
(6,	2,	1349905923,	'start'),
(7,	2,	1349905929,	'stop'),
(8,	1,	1349905934,	'stop'),
(9,	2,	1349905995,	'start'),
(10,	2,	1349905998,	'stop');

-- 2012-10-10 23:56:07
