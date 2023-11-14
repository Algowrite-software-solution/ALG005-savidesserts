-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: savi_dessert_shop
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'0710902997','123123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL,
  `product_item_id` int NOT NULL,
  `user_user_id` int NOT NULL,
  `weight_id` int NOT NULL,
  `extra_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_card_user1_idx` (`user_user_id`),
  KEY `fk_card_product_item1_idx` (`product_item_id`),
  KEY `fk_card_weight1_idx` (`weight_id`),
  KEY `fk_card_extra1_idx` (`extra_id`),
  CONSTRAINT `fk_card_extra1` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`),
  CONSTRAINT `fk_card_product_item1` FOREIGN KEY (`product_item_id`) REFERENCES `product_item` (`id`),
  CONSTRAINT `fk_card_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_card_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (155,1,29,2,1,4);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (11,'Watalappan'),(14,'Pudding'),(15,'Ingredients');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_details`
--

DROP TABLE IF EXISTS `delivery_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address_line_1` text NOT NULL,
  `address_line_2` text,
  `user_user_id` int NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `province_province_id` int NOT NULL,
  `distric_distric_id` int NOT NULL,
  `city` varchar(45) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_user_idx` (`user_user_id`),
  KEY `fk_delivery_details_distric1_idx` (`distric_distric_id`),
  KEY `fk_delivery_details_province1_idx` (`province_province_id`) USING BTREE,
  CONSTRAINT `fk_address_user` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_delivery_details_distric1` FOREIGN KEY (`distric_distric_id`) REFERENCES `distric` (`distric_id`),
  CONSTRAINT `fk_delivery_details_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_details`
--

LOCK TABLES `delivery_details` WRITE;
/*!40000 ALTER TABLE `delivery_details` DISABLE KEYS */;
INSERT INTO `delivery_details` VALUES (1,'No:31/A/1/10 makewita','No:31/A/1/10 makewita',2,'0711388634',1,1,'Marassana','113580'),(3,'No:89/B Ekala,Ja-ela','',23,'0773982712',1,1,'Ekala','11389');
/*!40000 ALTER TABLE `delivery_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distric`
--

DROP TABLE IF EXISTS `distric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distric` (
  `distric_id` int NOT NULL AUTO_INCREMENT,
  `distric_name` varchar(45) NOT NULL,
  PRIMARY KEY (`distric_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distric`
--

LOCK TABLES `distric` WRITE;
/*!40000 ALTER TABLE `distric` DISABLE KEYS */;
INSERT INTO `distric` VALUES (1,'	Ampara'),(2,'	Anuradhapura'),(3,'	Badulla'),(4,'	Batticaloa'),(5,'	Colombo'),(6,'	Galle'),(7,'	Gampaha'),(8,'	Hambantota'),(9,'	Jaffna'),(10,'	Kalutara'),(11,'	Kandy'),(12,'Kegalle'),(13,'	Kilinochchi'),(14,'	Kurunegala'),(15,'	Mannar'),(16,'	Matale'),(17,'	Matara'),(18,'	Moneragala'),(19,'	Mullaitivu'),(20,'	Nuwara Eliya'),(21,'	Polonnaruwa'),(22,'	Puttalam'),(23,'Ratnapura'),(24,'	Trincomalee'),(25,'	Vavuniya');
/*!40000 ALTER TABLE `distric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra`
--

DROP TABLE IF EXISTS `extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `extra_status_id` int NOT NULL,
  `fruit` varchar(50) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_extra_extra_status1_idx` (`extra_status_id`),
  CONSTRAINT `fk_extra_extra_status1` FOREIGN KEY (`extra_status_id`) REFERENCES `extra_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra`
--

LOCK TABLES `extra` WRITE;
/*!40000 ALTER TABLE `extra` DISABLE KEYS */;
INSERT INTO `extra` VALUES (1,1,'Cashew',90),(2,1,'Chocolate Chips',150),(3,1,'Dry Graps',70),(4,1,'No fruit',0),(5,1,'katarolu',40),(6,1,'black chocolate syrup',250);
/*!40000 ALTER TABLE `extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra_item`
--

DROP TABLE IF EXISTS `extra_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extra_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `extra_id` int NOT NULL,
  `product_product_id` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_extra_item_product1_idx` (`product_product_id`),
  KEY `fk_extra_item_extra1_idx` (`extra_id`),
  CONSTRAINT `fk_extra_item_extra1` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`),
  CONSTRAINT `fk_extra_item_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_item`
--

LOCK TABLES `extra_item` WRITE;
/*!40000 ALTER TABLE `extra_item` DISABLE KEYS */;
INSERT INTO `extra_item` VALUES (9,2,'909861'),(10,3,'452276'),(11,3,'452276');
/*!40000 ALTER TABLE `extra_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra_status`
--

DROP TABLE IF EXISTS `extra_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extra_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_status`
--

LOCK TABLES `extra_status` WRITE;
/*!40000 ALTER TABLE `extra_status` DISABLE KEYS */;
INSERT INTO `extra_status` VALUES (1,'In stock'),(2,'No stock');
/*!40000 ALTER TABLE `extra_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `pay_amout` double NOT NULL,
  `shipping_price` double NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `user_user_id` int NOT NULL,
  `invoice_status_invoice_status_id` int NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_user1_idx` (`user_user_id`),
  KEY `fk_invoice_invoice_status1_idx` (`invoice_status_invoice_status_id`),
  CONSTRAINT `fk_invoice_invoice_status1` FOREIGN KEY (`invoice_status_invoice_status_id`) REFERENCES `invoice_status` (`invoice_status_id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (16,'2023-10-15',7300,200,'#828871',2,1),(18,'2023-10-16',3200,200,'#353540',2,1),(19,'2023-10-17',1200,200,'#565233',2,1),(20,'2023-10-30',5200,200,'#110354',2,1),(21,'2023-10-30',4020,200,'#393427',2,1),(22,'2023-10-30',4020,200,'#611021',2,1),(23,'2023-10-30',700,200,'#269768',2,1),(24,'2023-10-30',2030,200,'#276847',2,1),(25,'2023-10-30',1240,200,'#235137',2,1),(26,'2023-10-30',10310,200,'#528179',2,1),(27,'2023-10-30',4290,200,'#386884',2,1),(28,'2023-10-30',4840,200,'#620628',2,1),(29,'2023-10-31',3720,200,'#360821',2,1),(30,'2023-10-31',3720,200,'#489180',2,1),(31,'2023-10-31',650,200,'#957623',2,1),(32,'2023-10-31',1960,200,'#783418',2,1),(33,'2023-10-31',450,200,'#675207',2,1),(34,'2023-10-31',1960,200,'#760638',2,1),(35,'2023-10-31',450,200,'#136526',2,1),(36,'2023-10-31',2110,200,'#599269',2,1),(37,'2023-10-31',1960,200,'#873861',2,1),(38,'2023-11-06',4570,200,'#483407',2,1),(39,'2023-11-06',1960,200,'#850242',2,1),(40,'2023-11-06',450,200,'#889881',2,1),(41,'2023-11-06',450,200,'#867127',2,1),(42,'2023-11-06',7120,200,'#202193',23,1),(43,'2023-11-06',1960,200,'#276168',23,1),(44,'2023-11-07',4110,200,'#484727',23,1),(45,'2023-11-07',450,200,'#730658',23,1),(46,'2023-11-07',450,200,'#615124',23,1);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_item`
--

DROP TABLE IF EXISTS `invoice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_item` (
  `invoice_item_id` int NOT NULL AUTO_INCREMENT,
  `product_item_id` int NOT NULL,
  `extra_id` int NOT NULL,
  `weight_id` int NOT NULL,
  `qty` int NOT NULL,
  `total_product_items_price` double NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `extra_item_price` double NOT NULL,
  PRIMARY KEY (`invoice_item_id`),
  KEY `fk_invoice_item_product_item1_idx` (`product_item_id`),
  KEY `fk_invoice_item_extra1_idx` (`extra_id`),
  KEY `fk_invoice_item_weight1_idx` (`weight_id`),
  CONSTRAINT `fk_invoice_item_extra1` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`),
  CONSTRAINT `fk_invoice_item_product_item1` FOREIGN KEY (`product_item_id`) REFERENCES `product_item` (`id`),
  CONSTRAINT `fk_invoice_item_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item`
--

LOCK TABLES `invoice_item` WRITE;
/*!40000 ALTER TABLE `invoice_item` DISABLE KEYS */;
INSERT INTO `invoice_item` VALUES (16,24,4,1,1,3500,'#828871',0),(17,28,4,2,1,100,'#828871',0),(18,29,4,1,1,3500,'#828871',0),(19,26,4,6,2,1500,'#353540',0),(20,31,4,9,4,250,'#565233',0),(21,24,4,1,1,1760,'#110354',0),(22,27,4,7,1,3240,'#110354',0),(23,29,2,1,2,1760,'#393427',150),(24,29,2,1,2,1760,'#611021',150),(25,31,4,9,2,250,'#269768',0),(26,24,3,1,1,1760,'#276847',70),(27,26,3,6,2,450,'#235137',70),(28,27,3,7,3,3240,'#528179',70),(29,28,4,2,1,180,'#528179',0),(30,24,3,1,1,1760,'#386884',70),(31,30,4,9,2,250,'#386884',0),(32,29,4,1,1,1760,'#386884',0),(33,29,2,1,1,1760,'#620628',150),(34,24,3,1,1,1760,'#620628',70),(35,31,4,9,1,250,'#620628',0),(36,34,4,9,1,250,'#620628',0),(37,30,4,9,1,250,'#620628',0),(38,32,4,9,1,150,'#620628',0),(39,29,4,1,2,1760,'#360821',0),(40,24,4,1,2,1760,'#489180',0),(41,26,4,6,1,450,'#957623',0),(42,24,4,1,1,1760,'#783418',0),(43,30,4,9,1,250,'#675207',0),(44,24,4,1,1,1760,'#760638',0),(45,30,4,9,1,250,'#136526',0),(46,29,2,1,1,1760,'#599269',150),(47,24,4,1,1,1760,'#873861',0),(48,29,4,1,1,1760,'#483407',0),(49,24,4,1,1,1760,'#483407',0),(50,25,4,4,1,850,'#483407',0),(51,29,4,1,1,1760,'#850242',0),(52,34,4,9,1,250,'#889881',0),(53,34,4,9,1,250,'#867127',0),(54,27,3,7,1,3240,'#202193',70),(55,25,4,4,2,850,'#202193',0),(56,29,2,1,1,1760,'#202193',150),(57,24,4,1,1,1760,'#276168',0),(58,31,4,9,1,250,'#484727',0),(59,24,3,1,2,1760,'#484727',70),(60,34,4,9,1,250,'#730658',0),(61,34,4,9,1,250,'#615124',0);
/*!40000 ALTER TABLE `invoice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_status`
--

DROP TABLE IF EXISTS `invoice_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_status` (
  `invoice_status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`invoice_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_status`
--

LOCK TABLES `invoice_status` WRITE;
/*!40000 ALTER TABLE `invoice_status` DISABLE KEYS */;
INSERT INTO `invoice_status` VALUES (1,'Accept'),(2,'Packaging'),(3,'Delivered'),(4,'Cancel');
/*!40000 ALTER TABLE `invoice_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_email_validation`
--

DROP TABLE IF EXISTS `marketing_email_validation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marketing_email_validation` (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `m_validation` varchar(15) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_email_validation`
--

LOCK TABLES `marketing_email_validation` WRITE;
/*!40000 ALTER TABLE `marketing_email_validation` DISABLE KEYS */;
INSERT INTO `marketing_email_validation` VALUES (1,'Agreed'),(2,'Disagreed');
/*!40000 ALTER TABLE `marketing_email_validation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `product_id` varchar(16) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_description` text NOT NULL,
  `category_id` int NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('221944','Sawee Special Watalappan Powder','Ingredients: Cardamom,Cloves,Cinnamon,Nutmeg Including Secret Natural Ingredients',15,'2023-10-14'),('224940','Cinnamon','ingredients',15,'2023-10-14'),('230434','8mm Cardamom','ingredients',15,'2023-10-14'),('344791','Nutmeg','ingredients',15,'2023-10-14'),('442403','Cloves','ingredients',15,'2023-10-14'),('452276','Sawee Special Watalappan','This product is a very delirious food made according to our own recipe',11,'2023-10-14'),('909861','Special Biscuit Pudding','This product is a very delicious food made according to our own recipe',14,'2023-10-14');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_item`
--

DROP TABLE IF EXISTS `product_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `product_status_id` int NOT NULL,
  `product_product_id` varchar(16) NOT NULL,
  `weight_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_item_product_status1_idx` (`product_status_id`),
  KEY `fk_product_item_product1_idx` (`product_product_id`),
  KEY `fk_product_item_weight1_idx` (`weight_id`),
  CONSTRAINT `fk_product_item_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `fk_product_item_product_status1` FOREIGN KEY (`product_status_id`) REFERENCES `product_status` (`id`),
  CONSTRAINT `fk_product_item_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_item`
--

LOCK TABLES `product_item` WRITE;
/*!40000 ALTER TABLE `product_item` DISABLE KEYS */;
INSERT INTO `product_item` VALUES (24,6,1760,1,'452276',1),(25,17,850,1,'452276',4),(26,15,450,1,'452276',6),(27,15,3240,1,'452276',7),(28,198,180,1,'452276',2),(29,7,1760,1,'909861',1),(30,15,250,1,'221944',9),(31,2,250,1,'230434',9),(32,19,150,1,'442403',9),(33,20,150,1,'344791',9),(34,15,250,1,'224940',9);
/*!40000 ALTER TABLE `product_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_status`
--

DROP TABLE IF EXISTS `product_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_status`
--

LOCK TABLES `product_status` WRITE;
/*!40000 ALTER TABLE `product_status` DISABLE KEYS */;
INSERT INTO `product_status` VALUES (1,'In a Stock'),(2,'Out of Stock');
/*!40000 ALTER TABLE `product_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotion` (
  `promotion_id` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `promotion_status_promotion_status_id` int NOT NULL,
  `product_product_id` varchar(16) NOT NULL,
  `weight_id` int NOT NULL,
  PRIMARY KEY (`promotion_id`),
  KEY `fk_promotion_promotion_status1_idx` (`promotion_status_promotion_status_id`),
  KEY `fk_promotion_product1_idx` (`product_product_id`),
  KEY `fk_promotion_weight1_idx` (`weight_id`),
  CONSTRAINT `fk_promotion_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `fk_promotion_promotion_status1` FOREIGN KEY (`promotion_status_promotion_status_id`) REFERENCES `promotion_status` (`promotion_status_id`),
  CONSTRAINT `fk_promotion_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion`
--

LOCK TABLES `promotion` WRITE;
/*!40000 ALTER TABLE `promotion` DISABLE KEYS */;
INSERT INTO `promotion` VALUES ('6','2023-11-12 17:02:53','2023-11-12 17:02:54',1,'452276',7),('7','2023-11-12 17:20:39','2023-11-12 17:20:40',1,'909861',1);
/*!40000 ALTER TABLE `promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion_status`
--

DROP TABLE IF EXISTS `promotion_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotion_status` (
  `promotion_status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`promotion_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion_status`
--

LOCK TABLES `promotion_status` WRITE;
/*!40000 ALTER TABLE `promotion_status` DISABLE KEYS */;
INSERT INTO `promotion_status` VALUES (1,'active'),(2,'deactive');
/*!40000 ALTER TABLE `promotion_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province` varchar(45) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Central province'),(2,'Eastern province'),(3,'North Central province'),(4,'Northern province'),(5,'Northwest province'),(6,'Sabaragamuwa province'),(7,'Southern province'),(8,'Uva province'),(9,'Western province');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_price`
--

DROP TABLE IF EXISTS `shipping_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_price` (
  `shipping_price_id` int NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  PRIMARY KEY (`shipping_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_price`
--

LOCK TABLES `shipping_price` WRITE;
/*!40000 ALTER TABLE `shipping_price` DISABLE KEYS */;
INSERT INTO `shipping_price` VALUES (1,200);
/*!40000 ALTER TABLE `shipping_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms_and_condition`
--

DROP TABLE IF EXISTS `terms_and_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terms_and_condition` (
  `ta_id` int NOT NULL AUTO_INCREMENT,
  `t_and_c` varchar(15) NOT NULL,
  PRIMARY KEY (`ta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms_and_condition`
--

LOCK TABLES `terms_and_condition` WRITE;
/*!40000 ALTER TABLE `terms_and_condition` DISABLE KEYS */;
INSERT INTO `terms_and_condition` VALUES (1,'Agreed'),(2,'Disagreed');
/*!40000 ALTER TABLE `terms_and_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password_salt` varchar(240) NOT NULL,
  `password_hash` varchar(240) NOT NULL,
  `confomation_code` int NOT NULL DEFAULT '0',
  `status_id` int NOT NULL,
  `register_date` date NOT NULL,
  `marketing_email_validation_m_id` int NOT NULL,
  `terms_and_condition_ta_id` int NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_status1_idx` (`status_id`),
  KEY `fk_user_marketing_email_validation1_idx` (`marketing_email_validation_m_id`),
  KEY `fk_user_terms_and_condition1_idx` (`terms_and_condition_ta_id`),
  CONSTRAINT `fk_user_marketing_email_validation1` FOREIGN KEY (`marketing_email_validation_m_id`) REFERENCES `marketing_email_validation` (`m_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_id`) REFERENCES `user_status` (`id`),
  CONSTRAINT `fk_user_terms_and_condition1` FOREIGN KEY (`terms_and_condition_ta_id`) REFERENCES `terms_and_condition` (`ta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'madusha@gmail.com','Madusha Pravinda','111112222','111112222',0,1,'2023-08-22',0,0),(2,'armadushapravinda@gmail.com','Madusha Pravinda','38a43fa2b98b70e65e5317513af2f9fd','05b22a20ad21e06137457a02228431db4ea55e37d049f3c9fadf22ada4c0723a4d955b54f16386243958c92de941d814c1c7ffaa7ddbcf04e885cc96cdb8ccba',627385,1,'2023-08-23',0,0),(3,'kamalmadushapravinda@gmail.com','maduwa','aaeeb73c5fa27e8db8302cabb5854f84','1a000d41ece16bda6ac1000a5aa981f729e3be1151e65bfc19fb4876627a54962dbe5f5f380e5d3bb6552df3481d79900d24af98347fefb6145ba45899fdaa6d',0,1,'2023-08-23',0,0),(4,'nimalmadushapravinda@gmail.com','maduwa','0d14670b47112767adbf180c93ac6bee','3a4347f65db6b934a0a04f4b8c933a88863685035c507a52cc82961ed4c7b1c53159d5b65a5a8e8570f702a3100ab244201b899fa8e74c2fb5a03997011e4637',0,1,'2023-08-23',0,0),(5,'sirilmadushapravinda@gmail.com','maduwa','6898e6df9303e667b1ecaeb37c9b6ccf','46ae7aafdf5aa844113ffbbacc2187dd261921f5bb4ff56b8e06886f088ef9d9b514d289b2fb31535223ca97c8ea793960c3e7135c52dcf7f9a9247ce9d91651',0,1,'2023-08-23',0,0),(6,'marusira@gmail.com','maduwa','11267714ab2c9cc2cc996e4c8aa26338','f7f4c947a808244921d0d9bd0a5c0616ceff6a08924f1b72b646fc40cf5cc6d39588d082774001f4ab572b382cd4f45f97d843f282067375b39bd2a1a76748ed',0,1,'2023-08-23',0,0),(7,'saranadarmakirthi@gmail.com','maduwa','a74efe9739197e89dca052abd2886f54','af37d687b4c6446062e83aaa9d4732e1da8330d45b174f3fbfa84479e814ec7dd283c4974c346eb479aefe1d37a17f1afb4a03afcaf15cb9213ed6eb2a5063df',0,1,'2023-08-23',0,0),(8,'supundarmakirthi@gmail.com','Supun Silva','7dc46b32d4dfe718079b11a845f35e68','6e1aeccbdd3795d4ae438ff1ce1b37cf089b8431f5b6b4450fffd52ee1643152621e985e3d72419e40ad2bc579e8f702a430db8dc99898172d7a11e9aaa42e90',0,1,'2023-08-23',0,0),(9,'palakore@gmail.com','Supun Silva','cb91381c9a6170adace37079011db19d','387cae1230294438fe68b7880fde54159546539a72407aa94224a6f5a9dbe5f84aef939cda36b18deca02b6a2255762d4f2ba596bda95e8fed8381a77ddcbf30',0,1,'2023-08-23',0,0),(10,'anurada@gmail.com','Anura Kumara','16836811c164462d4a46c9bc3ec82deb','5b3f253f1b8cbbfbc839e57e0fc4c4ef11e1936b9f76b36b6af45e15b5ff1640283bb1feb8cc1feb2b42af3bee8ac4e3d27e95da5a56c078a662e964bac3a235',0,1,'2023-09-18',0,0),(11,'minakavi@gmail.com','Mia Khalifa','ef8f10841e583577bb7e8a1c54815269','3c7e1ab334ad94a23e1a455370e91b22544bcfe559e430b6377e2bd3a5b3adfd9804bba8f4f8cd1dbf085980a9ff60471462375f5596285b119b218bcce5e81e',0,1,'2023-09-18',0,0),(12,'kusalmendis@gmail.com','Kusal Mendis','58584b11b6e0501470c5797aa1e136d2','03cbe9cef127e806beca79af915b59ae7a7a4621ebe5c070458704030a9bcf34302d83e181b64c1b71d30d690c52d26e83b080e20932ecc1d55a887c725068cc',0,1,'2023-09-18',0,0),(13,'kusalmendisgmail.com','Kusal Mendis','0629e064f35d2f8f2787c2e11b5692d6','425547b29b579efa5878857d9e6249c02b7659b3b36a5892626cd902be2c773ac86bc6363f7be439ee76e3fac6a229b33080a84bd609d7ffa81bc94a6cb336cb',0,1,'2023-09-18',0,0),(14,'kavidusas@gmail.com','Kavindu Sasanka','e0eaf519e50b0784b8388620d8fe9ba1','b60159242011f3107d3e343f4ef96b51d5f737e48a3ee4756624db3c84974d4174ab31857b76dd192ef942ac662d6e4dbb62d5d62089a5793f1535abe5ee858d',0,1,'2023-09-18',0,0),(15,'kavisas@gmail.com','Kavi Dewmi','7ac8de85f40f2e7b7db52b4c88573789','d7bd6634c92d6b27b985485c3acb7223ea84942ab36e82b9182c6ae4296577cffe4818b632e719a2bd3fdf29d2a73290893c1fe8580858482238d9b9175ef58d',0,1,'2023-09-18',0,0),(16,'kavisasxxx@gmail.com','Lasantha Perera','c79c4b80d46f305135380f1524606d47','4367bb57bff9eea5be11df54f9b58ff8c7ea795cfd8afe84160a47b1c86751b8a3997f81365a1d7d602aad7227dad61ee0a28c82cba2540432842c77ba49a3ee',0,1,'2023-09-18',0,0),(17,'vimasiri@gmail.com','Vimal Silva','a3d417402d9b125ec64714e9b017a507','8c49d5207b91c7a7d012399bcb45e47e51d7d0f7edd9de3405cad438e56d4442f1ff2187dd1be1c58e0cd97a21965fa922c0347697d5e9f37a2da40455552e0c',0,1,'2023-09-21',0,0),(18,'kotuwepodi@gmail.com','kotuwe','6b0ee8987b4e995967b22c06c1755a50','30d3f65c470209b3bbf89a78686aa3e2c9cc2c9decb2fea9dce01af7ed0e1fa400d9c9b8eebf29fa4e841c61f1eb1209c313c31bc41b4ee86a4d8ec97a0d1d53',0,1,'2023-10-09',0,0),(19,'kalusuda@gmail.com','kotuwe kaluwa','9d863d202c605dcdde6c13105c335776','4eae40ba5dad6ea99357bdc67442a596bb0850f37b84201f97b2ed4438ff3d59f13446ac6361fe94c804699c8b87e7fe4fafa12747b0a4e83f02091f19007d54',0,1,'2023-10-09',0,0),(20,'barthiyathissera@gmail.com','bathiya hora','c4eee8b13a6a27286d04d7893bea9e59','9014bcf70c290b8c9e0af01d711e4bfa4faa17fb9f32befafe875f7438f020215323c093c2edb95ffa7eb9b18d094f8bc26b0b0acf8f9721178ef77cadfd59d4',0,1,'2023-10-09',0,0),(21,'samanedirimuni@gmail.com','Edirimuni Soisa','55407930737a43f243031886a2bcf2a4','00150657966799fb1de406fa0867f7a51891f0a086c1ff840c08a7c5aaf1d0436a17e6ba8e600a4dae14b58466b9dbfe05a7d2de1cdc338e04b2332acb0c9d23',0,1,'2023-10-12',0,0),(22,'miakalifa@gmail.com','Meena Kaveeshani','f25ae6af564df0e9b1dae35339958f5c','14db5e3f66e602ebebf164b007e29e71f1990b30657df37d1d005209eacd027d4ea7bce5d5135d3d326c7b7a094bb9294ab3d644924ed651a18084d5bf720a74',0,1,'2023-10-12',1,1),(23,'ceylonecraft@gmail.com','Namal Perera','cce4a197453cbea209b0c6ee5451bc47','bdbb59dfabe206c6db980578bb120b756de383f10c6c554f950448c1bbbb5cfeff6b964100c647f1cb83c75332cff9e26969fe2e18b059235590a124d02b0e47',0,1,'2023-11-06',1,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` VALUES (1,'active'),(2,'no active'),(3,'block');
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_item_id` int NOT NULL,
  `user_user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_user1_idx` (`user_user_id`),
  KEY `fk_watchlist_product_item1_idx` (`product_item_id`),
  CONSTRAINT `fk_watchlist_product_item1` FOREIGN KEY (`product_item_id`) REFERENCES `product_item` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
INSERT INTO `watchlist` VALUES (24,24,2),(25,29,23);
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weight`
--

DROP TABLE IF EXISTS `weight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `weight` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weight`
--

LOCK TABLES `weight` WRITE;
/*!40000 ALTER TABLE `weight` DISABLE KEYS */;
INSERT INTO `weight` VALUES (1,'1kg'),(2,'90g'),(3,'3kg'),(4,'500g'),(5,'750g'),(6,'250g'),(7,'2kg'),(8,'4kg'),(9,'100g'),(10,'150g'),(11,'5kg'),(12,'50g'),(13,'6kg'),(14,'7kg');
/*!40000 ALTER TABLE `weight` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-12 23:38:45
