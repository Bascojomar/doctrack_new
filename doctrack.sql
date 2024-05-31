-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: doctrack
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `tbl_allowed`
--

DROP TABLE IF EXISTS `tbl_allowed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_allowed` (
  `AllowedID` int unsigned NOT NULL AUTO_INCREMENT,
  `Menu` varchar(100) NOT NULL DEFAULT '-',
  `AllowedOffice` varchar(250) NOT NULL DEFAULT '-',
  PRIMARY KEY (`AllowedID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_allowed`
--

LOCK TABLES `tbl_allowed` WRITE;
/*!40000 ALTER TABLE `tbl_allowed` DISABLE KEYS */;
INSERT INTO `tbl_allowed` VALUES (1,'NEW','ACCOUNTING'),(2,'NEW','ADMIN'),(3,'NEW','RECORDS'),(5,'INCOMING','PRESIDENT'),(6,'INCOMING','VPAA'),(7,'INCOMING','VPABM'),(8,'INCOMING','VPRET'),(10,'INCOMING','RECORDS'),(11,'CHANGESTATUS','PRESIDENT'),(12,'CHANGESTATUS','VPAA'),(13,'CHANGESTATUS','VPABM'),(14,'CHANGESTATUS','VPRET'),(16,'OUTGOING','PRESIDENT'),(17,'OUTGOING','VPAA'),(18,'OUTGOING','VPABM'),(19,'OUTGOING','VPRET'),(20,'OUTGOING','RECORDS'),(21,'NEW','ALUMNI'),(22,'NEW','ATC');
/*!40000 ALTER TABLE `tbl_allowed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_campus`
--

DROP TABLE IF EXISTS `tbl_campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_campus` (
  `campus_id` int DEFAULT NULL,
  `campus_code` text,
  `campus_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_campus`
--

LOCK TABLES `tbl_campus` WRITE;
/*!40000 ALTER TABLE `tbl_campus` DISABLE KEYS */;
INSERT INTO `tbl_campus` VALUES (1,'sic','San Isidro'),(2,'sum','Sumacab'),(3,'gen','General Tinio'),(4,'gab','Gabaldon'),(5,'atate','Atate'),(6,'fort','Fort Magsaysay');
/*!40000 ALTER TABLE `tbl_campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_channel`
--

DROP TABLE IF EXISTS `tbl_channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_channel` (
  `ChannelID` int unsigned NOT NULL AUTO_INCREMENT,
  `Channel` varchar(250) NOT NULL DEFAULT '-',
  PRIMARY KEY (`ChannelID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_channel`
--

LOCK TABLES `tbl_channel` WRITE;
/*!40000 ALTER TABLE `tbl_channel` DISABLE KEYS */;
INSERT INTO `tbl_channel` VALUES (1,'PRESIDENT'),(2,'VPAA'),(3,'VPABM'),(4,'VPRET'),(5,'PROCUREMENT');
/*!40000 ALTER TABLE `tbl_channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_department` (
  `dept_id` int DEFAULT NULL,
  `dept_name` text,
  `dept_code` text,
  `campus_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` VALUES (1,'COED','co',1),(2,'CICT','ci',1),(3,'CMBT','cm',1),(4,'ADMISSION','ad',1),(5,'ALUMNI','al',1),(6,'LIBRARY','li',1),(7,'SPORTS','sp',1),(8,'NSTP','n',1),(9,'CURRICULUM','cu',1),(10,'MIS','mis',1),(11,'USG','usg',1),(12,'CASHIER','cr',1),(13,'REGISTRAR','rr',1),(14,'OTHERS','o',0),(15,'COAS','ca',3),(16,'COED','coed',3),(17,'CIT','cit',3),(18,'CON','con',3),(19,'GS','gs',3),(20,'LIBRARY','l',3),(21,'ADMISSION','a',3),(22,'ALUMNI','a',3),(23,'SPORTS','s',3),(24,'NSTP','n',3),(25,'CURRICULUM','c',3),(26,'MIS','m',3),(27,'USG','u',3),(28,'CASHIER','c',3),(29,'REGISTRAR','r',3),(30,'COA','ca',2),(31,'COE','ce',2),(32,'COED','cd',2),(33,'CICT','cc',2),(34,'COC','coc',2),(35,'CMBT','cmb',2),(36,'COPADM','cpm',2),(37,'COARCH','ch',2),(38,'LIBRARY','lii',2),(39,'PLANNING','pl',2),(40,'DATA CENTER','dc',2),(41,'GEN SERVICES','gs',2),(42,'ADMISSION','am',2),(43,'ALUMNI','alu',2),(44,'SPORTS','spt',2),(45,'NSTP','nstp',2),(46,'MIS','mis',2),(47,'USG','usg',2),(48,'CASHIER','cashir',2),(49,'REGISTRAR','rtr',2),(50,'COED','c',4),(51,'CICT','CI',4),(52,'CMBT','CM',4),(53,'COA','CO',4),(54,'LIBRARY','L',4),(55,'ADMISSION','AD',4),(56,'ALUMNI','A',4),(57,'SPORTS','S',4),(58,'NSTP','N',4),(59,'CURRICULUM','C',4),(60,'MIS','M',4),(61,'USG','U',4),(62,'CASHIER','C',4),(63,'REGISTRAR','R',4),(64,'CICT','IT',5),(65,'CMBT','BT',5),(66,'LIBRARY','LIB',5),(67,'ADMISSION','ADD',5),(68,'ALUMNI','ALL',5),(69,'SPORTS','SS',5),(70,'NSTP','NN',5),(71,'CURRICULUM','CRR',5),(72,'MIS','MM',5),(73,'USG','UU',5),(74,'CASHIER','CC',5),(75,'REGISTRAR','RR',5),(76,'CMBT','CCC',6),(77,'LIBRARY','LIL',6),(78,'CURRICULUM','CCU',6),(79,'ADMISSION','ADDD',6),(80,'ALUMNI','ALU',6),(81,'SPORTS','SPO',6),(82,'NSTP','NSS',6),(83,'MIS','MM',6),(84,'USG','IUS',6),(85,'CASHIER','CAS',6),(86,'REGISTRAR','RRT',6);
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_docutype`
--

DROP TABLE IF EXISTS `tbl_docutype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_docutype` (
  `DocuID` int unsigned NOT NULL AUTO_INCREMENT,
  `DocuType` varchar(250) NOT NULL DEFAULT '-',
  PRIMARY KEY (`DocuID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_docutype`
--

LOCK TABLES `tbl_docutype` WRITE;
/*!40000 ALTER TABLE `tbl_docutype` DISABLE KEYS */;
INSERT INTO `tbl_docutype` VALUES (1,'COMMUNICATION'),(2,'VOUCHER/P.O'),(3,'-');
/*!40000 ALTER TABLE `tbl_docutype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inout`
--

DROP TABLE IF EXISTS `tbl_inout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_inout` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `DocInOut` varchar(50) NOT NULL DEFAULT '-',
  `Reference` varchar(100) NOT NULL DEFAULT '-',
  `Channel` varchar(100) NOT NULL DEFAULT '-',
  `FromOffice` varchar(250) NOT NULL DEFAULT '-',
  `Subject` varchar(250) NOT NULL DEFAULT '-',
  `DocuType` varchar(100) NOT NULL DEFAULT '-',
  `CDate` varchar(50) NOT NULL DEFAULT '-',
  `DocStatus` varchar(100) NOT NULL DEFAULT '-',
  `ActionTaken` varchar(100) NOT NULL DEFAULT '-',
  `Remarks` varchar(250) NOT NULL DEFAULT '-',
  `PresidentRemarks` varchar(45) NOT NULL DEFAULT '-',
  `Upload` varchar(255) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `Gmail` varchar(45) NOT NULL,
  `Campus` varchar(255) NOT NULL,
  `VoucherType` varchar(255) DEFAULT NULL,
  `VoucherNo` varchar(100) NOT NULL,
  `VoucherAmt` varchar(100) NOT NULL,
  `Received` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6915 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inout`
--

LOCK TABLES `tbl_inout` WRITE;
/*!40000 ALTER TABLE `tbl_inout` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_inout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_login` (
  `ID` int DEFAULT NULL,
  `activity` text,
  `user_id` int DEFAULT NULL,
  `time_stamp` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_login`
--

LOCK TABLES `tbl_login` WRITE;
/*!40000 ALTER TABLE `tbl_login` DISABLE KEYS */;
INSERT INTO `tbl_login` VALUES (2,'records',1,'2024-04-15 12:38:57'),(3,'admin',1,'2024-04-15 12:39:25'),(4,'admin',1,'2024-04-15 12:46:48'),(5,'vpaa',1,'2024-04-15 12:51:44'),(6,'admin',1,'2024-04-15 12:51:54'),(7,'records',1,'2024-04-15 12:55:08'),(8,'admin',1,'2024-04-15 12:55:16'),(9,'records',1,'2024-04-15 13:03:01'),(10,'vpabmstaff1',1,'2024-04-15 13:14:06'),(11,'Russell@gmail.com',1,'2024-04-17 08:49:40'),(12,'Russell@gmail.com',1,'2024-04-17 14:36:26'),(13,'bascojomar@gmail.com',1,'2024-04-17 15:05:48'),(14,'Russell@gmail.com',1,'2024-04-17 15:06:23'),(15,'admin',1,'2024-04-18 07:53:24'),(16,'admin',1,'2024-04-18 08:26:32'),(17,'admin',1,'2024-04-18 12:08:05'),(18,'records',1,'2024-04-23 08:27:55'),(19,'vpaastaff1',1,'2024-04-23 08:37:58'),(20,'records',1,'2024-04-23 08:55:32'),(21,'admin',1,'2024-04-27 08:29:51'),(22,'vpaastaff1',1,'2024-04-27 08:37:17'),(23,'records',1,'2024-04-27 08:39:18'),(24,'records',1,'2024-04-27 08:43:30'),(25,'vpabmstaff2',1,'2024-04-27 08:44:50'),(26,'vpretstaff1',1,'2024-04-27 08:49:00'),(27,'presstaff1',1,'2024-04-27 08:54:55'),(28,'VPRETSTAFF1',1,'2024-04-27 09:03:23'),(29,'pro',1,'2024-04-27 09:07:11'),(30,'admin',1,'2024-04-29 20:33:23'),(31,'admin',1,'2024-04-29 20:36:19'),(32,'records',1,'2024-04-30 14:09:24'),(33,'admin',1,'2024-04-30 14:10:03'),(34,'records',1,'2024-04-30 17:26:30'),(35,'vpabmstaff1',1,'2024-04-30 17:36:03'),(36,'records',1,'2024-04-30 17:36:50'),(37,'vpabmstaff1',1,'2024-04-30 17:47:07'),(38,'vpabmstaff1',1,'2024-04-30 18:25:25'),(39,'PRO',1,'2024-04-30 18:32:33'),(40,'VPAASTAFF1',1,'2024-04-30 18:34:05'),(41,'VPABMSTAFF1',1,'2024-04-30 18:35:33'),(42,'admin',1,'2024-04-30 20:45:35'),(43,'MARVIN',1,'2024-05-02 07:39:21'),(44,'records',1,'2024-05-02 07:54:42'),(45,'admin',1,'2024-05-02 13:52:14'),(46,'records',1,'2024-05-02 13:53:21'),(47,'records',1,'2024-05-02 13:56:10'),(48,'admin',1,'2024-05-02 13:57:00'),(49,'records',1,'2024-05-02 13:57:43'),(50,'admin',1,'2024-05-02 14:00:11'),(51,'records',1,'2024-05-02 14:02:06'),(52,'records',1,'2024-05-02 14:24:31'),(53,'records',1,'2024-05-02 14:36:13'),(54,'vpaastaff1',1,'2024-05-06 07:45:06'),(55,'vpaa',1,'2024-05-06 07:45:36'),(56,'vpaa',1,'2024-05-06 07:45:52'),(57,'vpaa',1,'2024-05-06 07:58:45'),(58,'vpabm',1,'2024-05-06 09:28:59'),(59,'vpaastaff1',1,'2024-05-06 09:59:44'),(60,'pro',1,'2024-05-06 10:24:48'),(61,'admin',1,'2024-05-18 13:56:06'),(62,'admin',1,'2024-05-22 11:54:20'),(63,'MARVIN',1,'2024-05-22 11:55:01'),(64,'records',1,'2024-05-22 14:10:22'),(65,'records',1,'2024-05-22 14:26:34');
/*!40000 ALTER TABLE `tbl_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_numbering`
--

DROP TABLE IF EXISTS `tbl_numbering`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_numbering` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `CDate` varchar(50) NOT NULL,
  `Numbers` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_numbering`
--

LOCK TABLES `tbl_numbering` WRITE;
/*!40000 ALTER TABLE `tbl_numbering` DISABLE KEYS */;
INSERT INTO `tbl_numbering` VALUES (1,'202003911','878');
/*!40000 ALTER TABLE `tbl_numbering` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_office`
--

DROP TABLE IF EXISTS `tbl_office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_office` (
  `OfficeID` int unsigned NOT NULL AUTO_INCREMENT,
  `OfficeName` varchar(250) NOT NULL DEFAULT '-',
  PRIMARY KEY (`OfficeID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_office`
--

LOCK TABLES `tbl_office` WRITE;
/*!40000 ALTER TABLE `tbl_office` DISABLE KEYS */;
INSERT INTO `tbl_office` VALUES (1,'PRESIDENT'),(2,'VPAA'),(3,'VPABM'),(4,'VPRET');
/*!40000 ALTER TABLE `tbl_office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `ID` int DEFAULT NULL,
  `UserName` text,
  `Password` text,
  `Email` text,
  `Position` text,
  `Office` text,
  `Privilege` text,
  `Image` text,
  `Owner` text,
  `Suffix` text,
  `Letter` text,
  `Request` text,
  `Campus` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'admin','Admin1234','Russell@gmail.com','ADMIN','SITE ADMIN','FULL','../file/russelle.jpg','RUSSEL MENDOZA','','','','San Isidro'),(2,'presstaff1','staff1','lharenceandrade@gmail.com','PRES STAFF','PRESIDENT1','FULL','../file/lharence.jpg','LHARENCE SORIAGA','','','','San Isidro'),(4,'vpabmstaff1','staff1','bascojomar03@gmail.com','VPABM STAFF','VPABM1','FULL','../file/meyere.jpeg','MEYER CASTRO','','','','San Isidro'),(5,'vpretstaff1','staff1','narfdeleon@gmail.com','VPRET STAFF','VPRET1','FULL','../file/tvene.jpeg','ZYRUS VARONA','','','','San Isidro'),(6,'recordsstaff1','staff1','bascojomar04@gmail.com','RECORDS','RECORDS1','FULL','../file/franzee.jpeg','FRANZE DELEON','','','','San Isidro'),(8,'president','president','Lharence@gmail.com','PRESIDENT','PRESIDENT','FULL','../file/lharence.jpg','LHARENCE SORIAGA','','','','San Isidro'),(10,'vpaa','vpaa','Jomar@gmail.com','VPAA','VPAA','FULL','../file/jomare.jpeg','JOMAR BASCO','','','','San Isidro'),(12,'vpabm','vpabm','Meyer@gmail.com','VPABM','VPABM','FULL','../file/meyere.jpeg','MEYER CASTRO','','','','San Isidro'),(14,'vpret','vpret','Zyrus@gmail.com','VPRET','VPRET','FULL','../file/tvene.jpeg','ZYRUS VARONA','','','','San Isidro'),(16,'records','records','Franze@gmail.com','RECORDS','RECORDS','FULL','../file/franzee.jpeg','FRANZE DELEON','','','','San Isidro'),(17,'pro','procurement','Basco@gmail.com','PROCUREMENT','PROCUREMENT','FULL','../file/jomare.jpeg','JOMAR BASCO','','','','San Isidro'),(122,'vpaastaff1','staff1','bascojomar05@gmail.com','VPAA STAFF','VPAA1','FULL','../file/jomare.jpeg','JOMAR BASCO','','','','San Isidro'),(125,'vpaastaff2','staff2','bascojomar07@gmail.com','VPAA STAFF','VPAA2','FULL','','JOMS BASCO','','','','San Isidro'),(126,'vpabmstaff2','staff2','bascojomar08@gmail.com','VPABM STAFF','VPABM2','FULL','','STEVEN MENDOZA','','','','San Isidro'),(127,'vpretstaff2','staff2','bascojomar09@gmail.com','VPRET STAFF','VPRET2','FULL','','DARREN ACUÃ‘A','','jkn','jkj','Sumacab Campus'),(128,'presstaff2','staff2','bascojomar10@gmail.com','PRESIDENT STAFF','PRESIDENT2','FULL','','LHARENCE SORIAGA','','','','San Isidro'),(131,'MARVIN','JOMAr123','bascojomar@gmail.com','CHAIRMAN','CICT','FULL','file/','MARVIN GARCIA','','','','San Isidro'),(132,'ADMINN','Jbascki11','bascojomar0@gmail.com','CICT','CICT','-','file/jomare.jpeg','JOMAR BASCO','','','','San Isidro');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_vouchertype`
--

DROP TABLE IF EXISTS `tbl_vouchertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_vouchertype` (
  `VoucherID` int DEFAULT NULL,
  `VoucherType` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_vouchertype`
--

LOCK TABLES `tbl_vouchertype` WRITE;
/*!40000 ALTER TABLE `tbl_vouchertype` DISABLE KEYS */;
INSERT INTO `tbl_vouchertype` VALUES (1,'MDS'),(2,'CASH ADVANCE'),(3,'ICT EQUIPMENT'),(4,'HONORARIA'),(5,'-');
/*!40000 ALTER TABLE `tbl_vouchertype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-31 13:48:02
