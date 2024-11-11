-- create database and tables
Create database review_database;
USE review_database;

DROP TABLE IF EXISTS `buyerreviews`;
CREATE TABLE IF NOT EXISTS `buyerreviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `car_id` int NOT NULL,
  `comment` text NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `sellerreviews`;
CREATE TABLE IF NOT EXISTS `sellerreviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);