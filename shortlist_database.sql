-- create database and tables
Create database shortlist_database;
USE shortlist_database;

DROP TABLE IF EXISTS `shortlist`;
CREATE TABLE IF NOT EXISTS `shortlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `car_id` int NOT NULL,
  `seller` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`)
)