-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: coffee_db
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `re_users`
--

DROP TABLE IF EXISTS `re_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_users`
--

LOCK TABLES `re_users` WRITE;
/*!40000 ALTER TABLE `re_users` DISABLE KEYS */;
INSERT INTO `re_users` VALUES (1,'maitri19','maitrifulpawar19@gamil.com','Ruchi1919'),(2,'Meena Fulpawar','Meenafulpawar01@gmail.com','8306499'),(3,'Aashish Mistry','ashishmistry23@gamil.com','8306499'),(4,'priyanki panchal','priyankipanchal20@gamil.com','123987'),(5,'hitesh Patel','hiteshpatel96@gamil.com','800075'),(6,'Harshil Fulpawar','Harshilfulpawar18@gamil.com','182005'),(7,'jignasha pawar','jignashapawar22@gamil.com','159159'),(8,'Pragati Warule','Pragatiwarule09@gamil.com','159753'),(9,'Priyanka shukala','Priyankashukala18@gmail.com','1918'),(10,'dhyan panchal','dhyanpanchal01@gmail.com','369369'),(11,'neha pawar','Nehapawar123@gmail.com','123456'),(12,'Pragati patel','Pragatipatel19@gmail.com','123456'),(13,'jignasha Vankar','jignashaVankar26@gmail.com','1234567890'),(14,'heta patel','hetapatel01@gmail.com','456');
/*!40000 ALTER TABLE `re_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-07 10:28:33
