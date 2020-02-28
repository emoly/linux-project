CREATE DATABASE IF NOT EXISTS `emily`;

CREATE TABLE `emily`.`users` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(32) NOT NULL DEFAULT '' UNIQUE,
	`password` varchar(32) NOT NULL DEFAULT '',
	`salt` varchar(10) NOT NULL DEFAULT ''
);
