-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: pasteleria
-- ------------------------------------------------------
-- Server version	9.0.0

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
-- Table structure for table `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingrediente` (
  `ID_ingrediente` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text,
  `Fecha_ingreso` date DEFAULT NULL,
  `Fecha_vencimiento` date DEFAULT NULL,
  PRIMARY KEY (`ID_ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingrediente`
--

LOCK TABLES `ingrediente` WRITE;
/*!40000 ALTER TABLE `ingrediente` DISABLE KEYS */;
INSERT INTO `ingrediente` VALUES (7,'Azucar','aas','2025-01-06','2025-01-15');
/*!40000 ALTER TABLE `ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastel`
--

DROP TABLE IF EXISTS `pastel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pastel` (
  `ID_pastel` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text,
  `Preparado_por` varchar(100) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Fecha_vencimiento` date DEFAULT NULL,
  PRIMARY KEY (`ID_pastel`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastel`
--

LOCK TABLES `pastel` WRITE;
/*!40000 ALTER TABLE `pastel` DISABLE KEYS */;
INSERT INTO `pastel` VALUES (4,'Pastel de chocolate','pastel','Nelson','2025-01-03','2025-01-15');
/*!40000 ALTER TABLE `pastel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastel_ingredientes`
--

DROP TABLE IF EXISTS `pastel_ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pastel_ingredientes` (
  `ID_Pastel_Ingrediente` int NOT NULL AUTO_INCREMENT,
  `ID_pastel` int DEFAULT NULL,
  `ID_ingrediente` int DEFAULT NULL,
  PRIMARY KEY (`ID_Pastel_Ingrediente`),
  KEY `pastel_ingredientes_ibfk_2` (`ID_ingrediente`),
  KEY `pastel_ingredientes_ibfk_1` (`ID_pastel`),
  CONSTRAINT `pastel_ingredientes_ibfk_1` FOREIGN KEY (`ID_pastel`) REFERENCES `pastel` (`ID_pastel`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `pastel_ingredientes_ibfk_2` FOREIGN KEY (`ID_ingrediente`) REFERENCES `ingrediente` (`ID_ingrediente`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastel_ingredientes`
--

LOCK TABLES `pastel_ingredientes` WRITE;
/*!40000 ALTER TABLE `pastel_ingredientes` DISABLE KEYS */;
INSERT INTO `pastel_ingredientes` VALUES (32,4,7);
/*!40000 ALTER TABLE `pastel_ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'pasteleria'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-06 14:38:42
