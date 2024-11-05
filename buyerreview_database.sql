-- create database and tables
Create database buyerreview_database;
USE buyerreview_database;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `car_id` int NOT NULL,
  `comment` text NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)