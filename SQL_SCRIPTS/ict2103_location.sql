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
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `Location_ID` int(11) NOT NULL,
  `Location_name` char(20) DEFAULT NULL,
  `Datetime_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Location_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'Ang Mo Kio\r',NULL),(2,'Bedok\r',NULL),(3,'Bishan\r',NULL),(4,'Boon Lay\r',NULL),(5,'Bukit Batok\r',NULL),(6,'Bukit Merah\r',NULL),(7,'Bukit Panjang\r',NULL),(8,'Bukit Timah\r',NULL),(9,'Central Water Catchm',NULL),(10,'Changi\r',NULL),(11,'Choa Chu Kang\r',NULL),(12,'Clementi\r',NULL),(13,'City\r',NULL),(14,'Geylang\r',NULL),(15,'Hougang\r',NULL),(16,'Jalan Bahar\r',NULL),(17,'Jurong East\r',NULL),(18,'Jurong Island\r',NULL),(19,'Jurong West\r',NULL),(20,'Kallang\r',NULL),(21,'Lim Chu Kang\r',NULL),(22,'Mandai\r',NULL),(23,'Marine Parade\r',NULL),(24,'Novena\r',NULL),(25,'Pasir Ris\r',NULL),(26,'Paya Lebar\r',NULL),(27,'Pioneer\r',NULL),(28,'Pulau Tekong\r',NULL),(29,'Pulau Ubin\r',NULL),(30,'Punggol\r',NULL),(31,'Queenstown\r',NULL),(32,'Seletar\r',NULL),(33,'Sembawang\r',NULL),(34,'Sengkang\r',NULL),(35,'Sentosa\r',NULL),(36,'Serangoon\r',NULL),(37,'Southern Islands\r',NULL),(38,'Sungei Kadut\r',NULL),(39,'Tampines\r',NULL),(40,'Tanglin\r',NULL),(41,'Tengah\r',NULL),(42,'Toa Payoh\r',NULL),(43,'Tuas\r',NULL),(44,'Western Islands\r',NULL),(45,'Western Water Catchm',NULL),(46,'Woodlands\r',NULL),(47,'Yishun\r',NULL);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-09 20:03:32
