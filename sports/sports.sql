-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sports
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `idevents` int NOT NULL AUTO_INCREMENT,
  `ename` varchar(450) DEFAULT NULL,
  `edescription` varchar(450) DEFAULT NULL,
  `eprice` varchar(450) DEFAULT NULL,
  `eduration` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `idusers` varchar(45) DEFAULT NULL,
  `eimage` varchar(450) DEFAULT NULL,
  `category` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idevents`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Zumba Class','zumba','123.25','2 months','18','1','1653336942zumba.jpg','Dance');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_equipment`
--

DROP TABLE IF EXISTS `game_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_equipment` (
  `idgame_equipment` int NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `category` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idgame_equipment`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_equipment`
--

LOCK TABLES `game_equipment` WRITE;
/*!40000 ALTER TABLE `game_equipment` DISABLE KEYS */;
INSERT INTO `game_equipment` VALUES (1,'baseball','Baseball is a bat-and-ball game played between two opposing teams, of nine players each, that take turns batting and fielding. EGB.','50','1653345554OIP (1).jpg','Baseball Equipment'),(2,'Swimming luneet','lunette','120.25','1656072209OIP.jpg','Swimming Equipment');
/*!40000 ALTER TABLE `game_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `idquestions` int NOT NULL AUTO_INCREMENT,
  `title` varchar(450) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `file` varchar(450) DEFAULT NULL,
  `idusers` varchar(45) DEFAULT NULL,
  `reply_comment` varchar(450) DEFAULT NULL,
  `reply_file` varchar(450) DEFAULT NULL,
  `reply_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idquestions`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'q1','asdasda','','3','test tst','1653346247young-woman-pharmacist-pharmacy.jpg','1'),(3,'question','about the description','1653383345special-offer.png','3',NULL,NULL,'1');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `subscription_monthly` varchar(450) DEFAULT NULL,
  `role` varchar(450) DEFAULT NULL,
  `approved` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'hoops','hoops@hoops.com','123','130.25','academy','1','','1653334441R.jpg','12345678901'),(2,'admin','admin@admin.com','123',NULL,'admin','1',NULL,'1653382903icon-5359553_1280.png','1234567890123'),(3,'client','client@client.com','123456789','','client','0','18','1653345670icons8-user-32.png','123456');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_equipments`
--

DROP TABLE IF EXISTS `users_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_equipments` (
  `idusers_equiments` int NOT NULL AUTO_INCREMENT,
  `idusers` varchar(45) DEFAULT NULL,
  `idequipments` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusers_equiments`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_equipments`
--

LOCK TABLES `users_equipments` WRITE;
/*!40000 ALTER TABLE `users_equipments` DISABLE KEYS */;
INSERT INTO `users_equipments` VALUES (1,'3','1');
/*!40000 ALTER TABLE `users_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_events`
--

DROP TABLE IF EXISTS `users_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_events` (
  `idusers_events` int NOT NULL AUTO_INCREMENT,
  `idusers` varchar(45) DEFAULT NULL,
  `idevents` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusers_events`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_events`
--

LOCK TABLES `users_events` WRITE;
/*!40000 ALTER TABLE `users_events` DISABLE KEYS */;
INSERT INTO `users_events` VALUES (1,'3','1'),(2,'3','1');
/*!40000 ALTER TABLE `users_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_subscriptions`
--

DROP TABLE IF EXISTS `users_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_subscriptions` (
  `idusers_subscriptions` int NOT NULL AUTO_INCREMENT,
  `idusers` varchar(45) DEFAULT NULL,
  `idsubscriptions` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusers_subscriptions`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_subscriptions`
--

LOCK TABLES `users_subscriptions` WRITE;
/*!40000 ALTER TABLE `users_subscriptions` DISABLE KEYS */;
INSERT INTO `users_subscriptions` VALUES (1,'3','1');
/*!40000 ALTER TABLE `users_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-24 15:27:14
