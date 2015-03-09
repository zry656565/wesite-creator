-- MySQL dump 10.13  Distrib 5.6.21, for osx10.8 (x86_64)
--
-- Host: localhost    Database: wesite
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `asset`
--

DROP TABLE IF EXISTS `asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(200) NOT NULL,
  `width` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `top` varchar(10) NOT NULL,
  `left_margin` varchar(10) NOT NULL,
  `slide_id` int(11) NOT NULL,
  `isDeleted` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset`
--

/*!40000 ALTER TABLE `asset` DISABLE KEYS */;
INSERT INTO `asset` VALUES (2,'http://women-image.b0.upaiyun.com/2015-03/a9f24ff708a615297ed993d3e75b64d7.png','30','20','15','15',18,'\0'),(3,'http://women-image.b0.upaiyun.com/2015-03/a9f24ff708a615297ed993d3e75b64d7.png','30','30','','10',23,'\0'),(4,'http://women-image.b0.upaiyun.com/2015-03/3a00d2d8ac32d337d014fee2b7641779.png','40','20','30','30',24,'\0'),(5,'http://women-image.b0.upaiyun.com/2015-03/66facb3725902089840d7fa0a94c6293.jpeg','30','','50','20',24,'\0'),(6,'http://women-image.b0.upaiyun.com/2015-03/88fbd7e529e82bcb8ccf6fa1c9ac6fb7.jpg','30','','50','60',24,'\0'),(7,'http://women-image.b0.upaiyun.com/2015-03/31cce22231015f448abbc356cda3715e.jpg','24','','30','50',25,'\0');
/*!40000 ALTER TABLE `asset` ENABLE KEYS */;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageName` varchar(45) DEFAULT NULL,
  `backgroundMusic` varchar(150) DEFAULT NULL,
  `defaultBackground` varchar(150) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `isDeleted` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (4,'测试页面','http://women-music.b0.upaiyun.com//2015-02/08dd11347ec58b9271f4f3f81357ca17.mp3','http://women-image.b0.upaiyun.com//2015-02/03354a10fa39aca63f06e13ec683be25.jpg','测试描述','\0'),(44,'中洲测试','http://women-music.b0.upaiyun.com/2015-03/08dd11347ec58b9271f4f3f81357ca17.mp3','http://women-image.b0.upaiyun.com/2015-03/60b70cb3a2e91ac3234773187e04745c.jpg','test','\0');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background` varchar(100) DEFAULT NULL,
  `pageId` int(11) NOT NULL,
  `isDeleted` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
INSERT INTO `slide` VALUES (24,'http://women-image.b0.upaiyun.com/2015-03/31cce22231015f448abbc356cda3715e.jpg',44,'\0'),(25,'',44,'\0'),(26,'',44,'\0');
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(45) NOT NULL DEFAULT 'admin',
  `password` varchar(45) DEFAULT 'admin123',
  `isDeleted` bit(1) DEFAULT b'0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-09 20:09:06
