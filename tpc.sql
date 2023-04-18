-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: tpc
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','$2y$10$UgY87D51w.zA9mK7HkOCfef/DhEVmCJei0dkWelPTZ9oP5K72vVGK');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `CPI` decimal(5,2) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `ctc` decimal(10,2) NOT NULL,
  `area` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `working_tenure` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES (1,'alumni@gmail.com','$2y$10$AO98FOEH/alMf.Autw3g5.5z101Br1kdXUtMjSzh5aziu3zPKTioy','Rakesh Kumar',9.00,'Google',120.00,'Web','SDE','London','3'),(5,'alumni@gmail.co','$2y$10$OBXQPmYRQvMNPEsgWwHdXOkrcml76QHNKX9OfdrrDDORkg7HW9mFS','Rakesh',9.00,'Amazon',12.00,'Android','SDE','India','3'),(10,'rk@gmail.com','$2y$10$JuQ2gpthwZW7ji2naIgWA.BgNf39QuuPozIS06hBBYnjOEUdEhf8u','iitp_rakesh',9.00,'Meta',100.00,'Cloud','SDE','Mumbai','2'),(12,'rani@gmail.com','$2y$10$KSeXh4UUrkaGMcilCWUDlOEhNOgWsqqMXnc6yaBxZ.TYZ15BorLYm','Rani',8.00,'Apple',46.00,'SDE','SDE','Pune','3');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `jobid` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `minimum_cpi` varchar(255) NOT NULL,
  `roles` varchar(50) NOT NULL,
  `ctc` decimal(10,2) NOT NULL,
  `interview_mode` enum('Online','Offline') NOT NULL,
  `interview_type` enum('Written','Interview') NOT NULL,
  `recruitment_since_year` int NOT NULL,
  PRIMARY KEY (`jobid`),
  KEY `email_2` (`email`),
  CONSTRAINT `company_ibfk_2` FOREIGN KEY (`email`) REFERENCES `company_credentials` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (46,'google@gmail.com','Google','7','SDE',120.00,'Offline','Written',2000),(47,'google@gmail.com','Google','7','w',120.00,'Online','Interview',2000),(48,'google@gmail.com','Google','7','Web',100.00,'Online','Interview',2000),(49,'google@gmail.com','Google','9','cloud',20.00,'Online','Written',2023),(50,'amazon@amz.in','Amazon','5','SDE',120.00,'Offline','Interview',2000);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_credentials`
--

DROP TABLE IF EXISTS `company_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_credentials` (
  `company_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_credentials`
--

LOCK TABLES `company_credentials` WRITE;
/*!40000 ALTER TABLE `company_credentials` DISABLE KEYS */;
INSERT INTO `company_credentials` VALUES (1,'alumni@gmail.co','$2y$10$yL5JIOCa1G4UxPFklTmuA.rqQIcnpSRo8ssIQpjbwfeZydhorYrnS','Google'),(4,'amazon@amz.in','$2y$10$SfbgRFgVMgno80b/KVsRouDgRUNAvL6xZbnyKBvK22rPhAqEftouO','Amazon'),(3,'google@gmail.com','$2y$10$xEr53ekl9IIXpMnKPfpkKOl3EQYZ9SCNSD44ezp9elQTpjSwO2Ek2','Google');
/*!40000 ALTER TABLE `company_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_applied`
--

DROP TABLE IF EXISTS `student_applied`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_applied` (
  `student_id` int NOT NULL,
  `company_id` int NOT NULL,
  `job_id` int NOT NULL,
  PRIMARY KEY (`student_id`,`job_id`),
  KEY `job_id` (`job_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `student_applied_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `student_applied_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `company` (`jobid`),
  CONSTRAINT `student_applied_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `company_credentials` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_applied`
--

LOCK TABLES `student_applied` WRITE;
/*!40000 ALTER TABLE `student_applied` DISABLE KEYS */;
INSERT INTO `student_applied` VALUES (3,3,46),(3,3,47),(3,3,48),(3,3,49),(4,3,49),(3,4,50);
/*!40000 ALTER TABLE `student_applied` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` int NOT NULL,
  `Mobile` decimal(10,0) NOT NULL,
  `specialisation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `semester` int NOT NULL,
  `percentage10` float NOT NULL,
  `percentage12` float NOT NULL,
  `CPI` float NOT NULL,
  `year` int NOT NULL,
  `placed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emailId` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (3,'rakesh','iitprakesh@gmail.com','$2y$10$8lJf8jRdJ6hWtQ5nHxMGHOGTfsQhEfnFi7JpGNrh6V7mV9xkpTP2e',12,8409014282,'ai',4,99,99,9,2021,'YES'),(4,'Raju ji','rk@gmail.com','$2y$10$L3O215KgvyMo.y2es.wiY.lqrVS3m4QlmZ04qb4LHiKKyaMfdFHuS',11,8409014282,'ml',4,78,87,9,2021,'YES'),(5,'Raj','raj@gmail.com','$2y$10$bN6rBqEPTvTZOA8/FyYeLOeyRmP5j3OgtYrI5z4c2YdtWFjXjW9ri',21,6788687686,'lpoip',7,88,88,8,2021,'YES');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-18 23:57:02
