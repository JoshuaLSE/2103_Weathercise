-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: ict2103
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `weather`
--

DROP TABLE IF EXISTS `weather`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weather` (
  `Weather_ID` int(11) NOT NULL,
  `Weather_condition` char(20) DEFAULT NULL,
  `Location_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Weather_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weather`
--

LOCK TABLES `weather` WRITE;
/*!40000 ALTER TABLE `weather` DISABLE KEYS */;
INSERT INTO `weather` VALUES (1,'Fair',1),(2,'Fair & Warm',2),(3,'Partly Cloudly',3),(4,'Cloudy',4),(5,'Hazy',5),(6,'Slightly Hazy',6),(7,'Windy',7),(8,'Mist',8),(9,'Light Rain',9),(10,'Moderate Rain',10),(11,'Heavy Rain',11),(12,'Passing Showers',12),(13,'Light Showers',13),(14,'Showers',14),(15,'Heavy Showers',15),(16,'Thundery Showers',16),(17,'Heavy Thundery Showe',17),(18,'Heavy Thundery Showe',18),(19,'Showers',19),(20,'Showers',20),(21,'Showers',21),(22,'Showers',22),(23,'Showers',23),(24,'Showers',24),(25,'Showers',25),(26,'Showers',26),(27,'Showers',27),(28,'Showers',28),(29,'Showers',29),(30,'Showers',30),(31,'Showers',31),(32,'Showers',32),(33,'Showers',33),(34,'Showers',34),(35,'Showers',35),(36,'Showers',36),(37,'Showers',37),(38,'Showers',38),(39,'Showers',39),(40,'Showers',40),(41,'Showers',41),(42,'Showers',42),(43,'Showers',43),(44,'Showers',44),(45,'Showers',45),(46,'Showers',46),(47,'Showers',47);
/*!40000 ALTER TABLE `weather` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-09 20:03:31
