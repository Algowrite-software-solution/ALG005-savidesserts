-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: alg005_db
-- ------------------------------------------------------
-- Server version	8.0.31

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'0710902997','123123'),(2,'0766773539','19780528NADEE1981dineth#$');
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
  `user_user_id` int NOT NULL,
  `weight_id` int NOT NULL,
  `extra_id` int NOT NULL,
  `product_product_id` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_card_user1_idx` (`user_user_id`),
  KEY `fk_card_weight1_idx` (`weight_id`),
  KEY `fk_card_extra1_idx` (`extra_id`),
  KEY `fk_card_product1_idx` (`product_product_id`),
  CONSTRAINT `fk_card_extra1` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`),
  CONSTRAINT `fk_card_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `fk_card_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_card_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (157,1,2,1,2,'909861');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (11,'Watalappan'),(14,'Puddings'),(15,'Other');
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
INSERT INTO `extra` VALUES (1,1,'No Toppings',0),(2,1,'Chocolate Chips',150),(3,1,'Dry Graps',70),(4,1,'Cashew',90),(5,1,'katarolu',40),(6,1,'black chocolate syrup',250);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_item`
--

LOCK TABLES `extra_item` WRITE;
/*!40000 ALTER TABLE `extra_item` DISABLE KEYS */;
INSERT INTO `extra_item` VALUES (9,2,'909861');
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
  `qty` int NOT NULL,
  `total_product_items_price` double NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `extra_item_price` double NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `extra_item_name` varchar(45) NOT NULL,
  PRIMARY KEY (`invoice_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item`
--

LOCK TABLES `invoice_item` WRITE;
/*!40000 ALTER TABLE `invoice_item` DISABLE KEYS */;
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
INSERT INTO `product_item` VALUES (29,7,1760,1,'909861',1),(30,15,250,1,'221944',9),(31,2,250,1,'230434',9),(32,19,150,1,'442403',9),(33,20,150,1,'344791',9),(34,15,250,1,'224940',9);
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
INSERT INTO `promotion` VALUES ('696071','2023-11-13 14:22:13','2023-11-17 00:00:00',2,'452276',1);
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
-- Table structure for table `review_status`
--

DROP TABLE IF EXISTS `review_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rv_status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_status`
--

LOCK TABLES `review_status` WRITE;
/*!40000 ALTER TABLE `review_status` DISABLE KEYS */;
INSERT INTO `review_status` VALUES (1,'Active'),(2,'Deactive');
/*!40000 ALTER TABLE `review_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `rev_id` int NOT NULL AUTO_INCREMENT,
  `review` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `review_status_id` int NOT NULL,
  `user_user_id` int NOT NULL,
  PRIMARY KEY (`rev_id`),
  KEY `fk_reviews_review_status1_idx` (`review_status_id`),
  KEY `fk_reviews_user1_idx` (`user_user_id`),
  CONSTRAINT `fk_reviews_review_status1` FOREIGN KEY (`review_status_id`) REFERENCES `review_status` (`id`),
  CONSTRAINT `fk_reviews_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (2,'That\'s Watallappan powder is quality product , perfect smell and unique taste',1,23);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
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
INSERT INTO `user` VALUES (2,'armadushapravinda@gmail.com','Madusha Pravinda','38a43fa2b98b70e65e5317513af2f9fd','05b22a20ad21e06137457a02228431db4ea55e37d049f3c9fadf22ada4c0723a4d955b54f16386243958c92de941d814c1c7ffaa7ddbcf04e885cc96cdb8ccba',627385,1,'2023-08-23',2,1),(20,'barthiyathissera@gmail.com','bathiya hora','c4eee8b13a6a27286d04d7893bea9e59','9014bcf70c290b8c9e0af01d711e4bfa4faa17fb9f32befafe875f7438f020215323c093c2edb95ffa7eb9b18d094f8bc26b0b0acf8f9721178ef77cadfd59d4',0,1,'2023-10-09',2,1),(21,'samanedirimuni@gmail.com','Edirimuni Soisa','55407930737a43f243031886a2bcf2a4','00150657966799fb1de406fa0867f7a51891f0a086c1ff840c08a7c5aaf1d0436a17e6ba8e600a4dae14b58466b9dbfe05a7d2de1cdc338e04b2332acb0c9d23',0,3,'2023-10-12',1,1),(23,'ceylonecraft@gmail.com','Namal Perera','cce4a197453cbea209b0c6ee5451bc47','bdbb59dfabe206c6db980578bb120b756de383f10c6c554f950448c1bbbb5cfeff6b964100c647f1cb83c75332cff9e26969fe2e18b059235590a124d02b0e47',0,2,'2023-11-06',1,1);
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
  `user_user_id` int NOT NULL,
  `weight_id` int NOT NULL,
  `product_product_id` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_user1_idx` (`user_user_id`),
  KEY `fk_watchlist_weight1_idx` (`weight_id`),
  KEY `fk_watchlist_product1_idx` (`product_product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_watchlist_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
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

-- Dump completed on 2023-11-28 18:44:16
