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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,0,'Java Chip Frappuccino',441.00,1,'2025-06-19 17:10:21'),(2,0,'Caramel Macchiato',380.00,1,'2025-06-19 17:14:08'),(3,0,'Picco Cappuccino',410.00,2,'2025-06-19 17:14:40'),(4,0,'Java Chip Frappuccino',441.00,1,'2025-06-20 03:46:37'),(5,0,'Java Chip Frappuccino',441.00,1,'2025-06-20 03:48:29'),(6,0,'Java Chip Frappuccino',441.00,2,'2025-06-21 04:51:20'),(7,0,'Java Chip Frappuccino',441.00,2,'2025-06-21 17:59:52'),(8,0,'Java Chip Frappuccino',441.00,2,'2025-06-21 18:05:05'),(9,0,'Java Chip Frappuccino',441.00,2,'2025-06-21 18:05:22'),(10,0,'Java Chip Frappuccino',441.00,2,'2025-06-21 18:14:52'),(11,0,'Java Chip Frappuccino',441.00,3,'2025-06-21 18:25:27'),(12,0,'Java Chip Frappuccino',441.00,2,'2025-06-22 05:29:09'),(13,0,'Caramel Macchiato',380.00,2,'2025-06-22 05:29:41'),(14,0,'Java Chip Frappuccino',441.00,1,'2025-06-22 06:49:50'),(15,0,'Strawberry Milkshake',399.00,4,'2025-06-23 03:21:22'),(16,0,'Java Chip Frappuccino',441.00,4,'2025-06-23 06:48:09'),(17,6,'Caramel Macchiato',380.00,1,'2025-06-25 17:05:56'),(18,4,'Caramel Macchiato',380.00,1,'2025-06-25 17:35:36'),(19,4,'Picco Cappuccino',441.00,2,'2025-06-25 17:40:13'),(20,4,'Classic Garlic Bread',120.00,1,'2025-06-25 17:51:30'),(21,4,'Oreo Mousse Cup',135.00,2,'2025-06-25 17:53:07'),(22,7,'Cold Coffee',360.00,1,'2025-06-25 17:56:01'),(23,7,'Rainbow Milkshake',399.00,1,'2025-06-25 17:56:19'),(24,7,'Sweet Lime Juice',85.00,1,'2025-06-25 17:56:30'),(25,7,'Veg Club Sandwich',190.00,1,'2025-06-25 17:56:43'),(26,8,'Java Chip Frappuccino',441.00,1,'2025-06-26 03:42:12'),(27,8,'Chocolate Cappuccino',441.00,2,'2025-06-26 03:42:24'),(28,8,'Strawberry Milkshake',399.00,1,'2025-06-26 03:42:36'),(29,8,'Doppio Espresso',399.00,1,'2025-06-26 03:42:43'),(30,8,'ABC Juice',100.00,2,'2025-06-26 03:43:06'),(31,8,'Cheese Maggi',110.00,1,'2025-06-26 03:43:20'),(32,8,'Choco Lava Cake',130.00,1,'2025-06-26 03:43:27'),(33,10,'Java Chip Frappuccino',441.00,1,'2025-06-30 04:46:59'),(34,10,'Blonde Almond Latte',441.00,2,'2025-06-30 04:47:18'),(35,10,'Cold Coffee',360.00,1,'2025-06-30 05:19:38'),(36,11,'Java Chip Frappuccino',441.00,1,'2025-06-30 05:21:41'),(37,12,'Java Chip Frappuccino',441.00,1,'2025-06-30 15:34:09'),(38,13,'Caramel Macchiato',380.00,1,'2025-07-06 08:59:58'),(39,14,'Caramel Macchiato',380.00,1,'2025-07-07 04:55:07'),(40,14,'Caramel Macchiato',441.00,2,'2025-07-07 04:55:24');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
