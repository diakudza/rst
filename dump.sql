-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: example_app
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_title_uindex` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `title`, `start_time`, `status`, `created_at`, `updated_at`) VALUES (1,'group1',NULL,0,'2022-08-09 15:04:39','2022-08-09 15:04:39'),(2,'group2','2022-08-09 15:20:39',1,'2022-08-09 15:04:39','2022-08-09 21:28:24'),(3,'group3','2022-08-09 15:04:39',0,'2022-08-09 15:04:39','2022-08-09 21:23:03'),(32,'г1',NULL,0,'2022-08-09 17:03:51','2022-08-09 17:03:51'),(33,'г11',NULL,0,'2022-08-09 17:05:06','2022-08-09 17:05:06'),(34,'г112',NULL,0,'2022-08-09 17:05:59','2022-08-09 17:05:59');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `frequency` int NOT NULL DEFAULT '1000',
  `string` varchar(100) DEFAULT NULL,
  `repetitions` int NOT NULL DEFAULT '0',
  `salt` varchar(100) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `group_id` int DEFAULT '0',
  `start_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `frequency`, `string`, `repetitions`, `salt`, `status`, `group_id`, `start_time`, `created_at`, `updated_at`) VALUES (1,100,'test',10,'asdfgh',0,0,NULL,'2022-08-09 14:01:10','2022-08-09 16:59:22'),(2,200,'test2',5,'asdsdafgh',0,34,NULL,'2022-08-09 14:01:10','2022-08-09 21:41:29'),(3,100,'test3',14,'sadSDDSA',0,34,NULL,'2022-08-09 14:01:10','2022-08-09 20:45:13'),(4,100,'test4',11,'qwegxcs',0,34,NULL,'2022-08-09 14:01:10','2022-08-09 20:34:44'),(5,100,'test5',12,'qweqew',0,0,NULL,'2022-08-09 14:01:10','2022-08-09 14:29:41'),(6,500,'test6',9,'sadasd1',0,0,NULL,'2022-08-09 14:01:10','2022-08-09 14:29:41'),(7,2000,'test7',3,'asdabnn',0,3,NULL,'2022-08-09 14:01:10','2022-08-09 21:06:46'),(8,100,'test8',4,'sdzv',0,1,NULL,'2022-08-09 14:01:10','2022-08-09 14:29:41'),(9,100,'test9',1,'vvxcz',0,1,NULL,'2022-08-09 14:01:10','2022-08-09 14:29:41'),(10,1000,'test10',4,'asdad',0,2,NULL,'2022-08-09 14:01:10','2022-08-09 21:17:20'),(11,100,'test11',7,'qwetvv',0,2,NULL,'2022-08-09 14:01:10','2022-08-09 21:17:20'),(12,4000,'hello',2,'qwe',0,3,NULL,'2022-08-09 14:29:43','2022-08-09 21:06:46');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-10  1:27:32
