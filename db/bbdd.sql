CREATE DATABASE  IF NOT EXISTS `2122_ruanodaniel` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `2122_ruanodaniel`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: 2122_ruanodaniel
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `tbl_lugar`
--

DROP TABLE IF EXISTS `tbl_lugar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_lugar` (
  `id_lugar` int NOT NULL AUTO_INCREMENT,
  `nom_lugar` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_id_tipo_lugar` int DEFAULT NULL,
  `img_lugar` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_lugar`),
  KEY `fk_id_tipo_lugar_idx` (`fk_id_tipo_lugar`),
  CONSTRAINT `fk_id_tipo_lugar` FOREIGN KEY (`fk_id_tipo_lugar`) REFERENCES `tbl_tipo_lugar` (`id_tipo_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lugar`
--

LOCK TABLES `tbl_lugar` WRITE;
/*!40000 ALTER TABLE `tbl_lugar` DISABLE KEYS */;
INSERT INTO `tbl_lugar` VALUES (1,'Terraza Norte',1,'terrace_n.png'),(2,'Terraza Sur',1,'terrace_s.png'),(3,'Terraza Este',1,'terrace_e.png'),(4,'Terraza Oeste',1,'terrace_o.png'),(5,'Comedor Muñoz',2,'comedor_m.png'),(6,'Comedor Frantzen',2,'comedor_f.png'),(7,'Sala Privada 1',3,'sala_privada.png'),(11,'Sala Privada 2',3,'sala_privada.png');
/*!40000 ALTER TABLE `tbl_lugar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mesa`
--

DROP TABLE IF EXISTS `tbl_mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_mesa` (
  `id_mesa` int NOT NULL AUTO_INCREMENT,
  `numero_mesa` int DEFAULT NULL,
  `id_lugar` int DEFAULT NULL,
  `estado_mesa` tinyint DEFAULT NULL,
  `num_sillas_mesa` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_mesa`),
  KEY `fk_lugar_mesa_idx` (`id_lugar`),
  CONSTRAINT `fk_lugar_mesa` FOREIGN KEY (`id_lugar`) REFERENCES `tbl_lugar` (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mesa`
--

LOCK TABLES `tbl_mesa` WRITE;
/*!40000 ALTER TABLE `tbl_mesa` DISABLE KEYS */;
INSERT INTO `tbl_mesa` VALUES (1,1,1,1,'12'),(2,1,2,1,'12'),(3,2,1,1,'12'),(4,1,5,1,'22'),(5,1,6,1,'22'),(6,1,7,1,'24'),(7,3,1,1,'12'),(8,4,1,1,'12'),(9,2,2,1,'12'),(10,3,2,1,'12'),(11,4,2,1,'12'),(12,1,3,1,'12'),(13,2,3,1,'12'),(14,3,3,1,'12'),(15,4,3,1,'12'),(16,1,4,1,'12'),(17,2,4,1,'12'),(18,3,4,1,'12'),(19,4,4,1,'12'),(20,2,5,1,'22'),(21,2,6,1,'22'),(22,1,11,1,'24'),(23,5,1,1,'12'),(24,5,2,1,'12'),(25,5,3,1,'12'),(26,5,4,1,'12');
/*!40000 ALTER TABLE `tbl_mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perfil`
--

DROP TABLE IF EXISTS `tbl_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_usuario` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perfil`
--

LOCK TABLES `tbl_perfil` WRITE;
/*!40000 ALTER TABLE `tbl_perfil` DISABLE KEYS */;
INSERT INTO `tbl_perfil` VALUES (1,'Admin'),(2,'Camarero'),(4,'Mantenimiento');
/*!40000 ALTER TABLE `tbl_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reserva`
--

DROP TABLE IF EXISTS `tbl_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_reserva` (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `fecha_ini_reserva` time DEFAULT NULL,
  `id_mesa` int DEFAULT NULL,
  `fecha_fin_reserva` time DEFAULT NULL,
  `nom_cliente_reserva` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_reserva` date DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_fecha_mesa_idx` (`id_mesa`),
  CONSTRAINT `fk_fecha_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reserva`
--

LOCK TABLES `tbl_reserva` WRITE;
/*!40000 ALTER TABLE `tbl_reserva` DISABLE KEYS */;
INSERT INTO `tbl_reserva` VALUES (1,'14:00:00',1,'10:00:00','Miguel','2021-12-25'),(2,'14:30:00',2,'10:00:00','Alfredo','2021-12-25'),(3,'18:00:00',12,'15:11:41','Alfredo','2021-12-16'),(6,'13:00:00',12,'15:11:41','Alfredo','2021-12-16'),(11,'20:00:00',12,'22:00:00','David','2021-12-16'),(12,'14:00:00',12,'16:00:00','David','2021-12-24'),(13,'15:00:00',12,'17:00:00','Alfredo','2021-12-29'),(16,'16:00:00',12,'18:00:00','Pol','2021-12-25'),(18,'20:00:00',12,'22:00:00','Alfredo','2021-12-17'),(19,'18:00:00',12,'20:00:00','Xavi','2021-12-20');
/*!40000 ALTER TABLE `tbl_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_lugar`
--

DROP TABLE IF EXISTS `tbl_tipo_lugar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_tipo_lugar` (
  `id_tipo_lugar` int NOT NULL AUTO_INCREMENT,
  `tipo_lugar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_tipo_lugar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_lugar`
--

LOCK TABLES `tbl_tipo_lugar` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_lugar` DISABLE KEYS */;
INSERT INTO `tbl_tipo_lugar` VALUES (1,'Terraza','terraza.png'),(2,'Comedor','comedor.png'),(3,'Sala Privada','vip.png');
/*!40000 ALTER TABLE `tbl_tipo_lugar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido_usuario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_usuario` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contra_usuario` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_perfil_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_usuario_UNIQUE` (`correo_usuario`),
  KEY `fk_perfil_usuario_idx` (`id_perfil_usuario`),
  CONSTRAINT `fk_perfil_usuario` FOREIGN KEY (`id_perfil_usuario`) REFERENCES `tbl_perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'Daniel','Ruano','druano@admin.com','1fa3356b1eb65f144a367ff8560cb406',1),(2,'Mark','Díaz','mdiaz@experia.com','1fa3356b1eb65f144a367ff8560cb406',2);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-20 16:54:05
