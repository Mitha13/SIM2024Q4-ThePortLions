-- create database and table
Create database car_database;
USE car_database;

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `mileage` int NOT NULL,
  `color` varchar(50) NOT NULL,
  `seller` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)