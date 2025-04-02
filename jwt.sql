/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: userjwt
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jurusan` enum('Teknik Mesin','Teknik Informatika','Teknik Elektro') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES
(1,'Ahmad Fauzi','2201001','Teknik Mesin'),
(2,'Budi Santoso','2201002','Teknik Mesin'),
(3,'Citra Dewi','2201003','Teknik Mesin'),
(4,'Dani Saputra','2201004','Teknik Mesin'),
(5,'Eka Prasetya','2201005','Teknik Mesin'),
(6,'Fadli Ramadhan','2202001','Teknik Informatika'),
(7,'Gita Purnama','2202002','Teknik Informatika'),
(8,'Hendra Wijaya','2202003','Teknik Informatika'),
(9,'Indah Lestari','2202004','Teknik Informatika'),
(10,'Joko Purwanto','2202005','Teknik Informatika'),
(11,'Kurniawan Syah','2203001','Teknik Elektro'),
(12,'Lestari Ananda','2203002','Teknik Elektro'),
(13,'Mutiara Sari','2203003','Teknik Elektro'),
(14,'Nugroho Adi','2203004','Teknik Elektro'),
(15,'Oktaviani Rizky','2203005','Teknik Elektro'),
(16,'Putra Mahendra','2201006','Teknik Mesin'),
(17,'Qory Ramadhani','2201007','Teknik Mesin'),
(18,'Rizki Firmansyah','2202006','Teknik Informatika'),
(19,'Siti Aminah','2202007','Teknik Informatika'),
(20,'Taufik Hidayat','2203006','Teknik Elektro');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'zaens@gmail.com','$2y$10$RSWqQUqbj2coFeiK7TFZhuhc5GIzDAURqmVygwfpOQ2pO9koLd362'),
(2,'rizki@gmail.com','$2y$10$U5jRwbzonlW.TyKHT9mdN.NplZJpu6.YlXGPG7EhJs3DRWT2vyBq.'),
(3,'izza@gmail.com','$2y$10$fKzXK6zMBV03o0sivdjw2uhwOiWjcC7vZDHAZZR2p9QhGOT0e5nZu'),
(4,'coba@gmail.com','$2y$10$Kv1QoQshUGEVeId1Y8a/MOhbpj8yJ7Ss1CDIIF/dC8nevDspu722G'),
(5,'indah@gmail.com','$2y$10$Ctbf1g1p3TbtCTCef9jiUOu0Ds7WB6eeuBNDL3RmoC9eKvpGTvOh.');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-02 22:10:46
