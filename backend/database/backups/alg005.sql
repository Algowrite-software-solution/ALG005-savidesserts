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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (75,1,12,2,1,4),(76,2,8,2,3,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Watalappan'),(2,'Jelly'),(3,'Pudin'),(4,'Yoget'),(5,'Custud'),(10,'milk');
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
  PRIMARY KEY (`id`),
  KEY `fk_address_user_idx` (`user_user_id`),
  KEY `fk_delivery_details_distric1_idx` (`distric_distric_id`),
  KEY `fk_delivery_details_province1_idx` (`province_province_id`) USING BTREE,
  CONSTRAINT `fk_address_user` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_delivery_details_distric1` FOREIGN KEY (`distric_distric_id`) REFERENCES `distric` (`distric_id`),
  CONSTRAINT `fk_delivery_details_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_details`
--

LOCK TABLES `delivery_details` WRITE;
/*!40000 ALTER TABLE `delivery_details` DISABLE KEYS */;
INSERT INTO `delivery_details` VALUES (1,'dasd','asda',2,'0711388634',1,1,'Makewita');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distric`
--

LOCK TABLES `distric` WRITE;
/*!40000 ALTER TABLE `distric` DISABLE KEYS */;
INSERT INTO `distric` VALUES (1,'Gampaha'),(2,'Colombo'),(3,'Yakkla');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra`
--

LOCK TABLES `extra` WRITE;
/*!40000 ALTER TABLE `extra` DISABLE KEYS */;
INSERT INTO `extra` VALUES (1,1,'corn',90),(2,1,'Chips',150),(3,1,'Dry Graps',70),(4,1,'No fruit',0),(5,1,'katarolu',40);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_item`
--

LOCK TABLES `extra_item` WRITE;
/*!40000 ALTER TABLE `extra_item` DISABLE KEYS */;
INSERT INTO `extra_item` VALUES (1,3,'987662514'),(2,2,'123456789'),(3,1,'123456789'),(4,3,'645645114'),(5,1,'987662514'),(6,2,'534565732'),(7,1,'543467213'),(8,3,'123456789');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'2023-10-03',2000,200,'#123456',2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item`
--

LOCK TABLES `invoice_item` WRITE;
/*!40000 ALTER TABLE `invoice_item` DISABLE KEYS */;
INSERT INTO `invoice_item` VALUES (1,1,2,3,1,1000,'#123456',20),(2,9,3,4,1,800,'#123456',50);
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
INSERT INTO `product` VALUES ('122314522','Bread and butter pudding','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',3,'2023-08-22'),('123456789','Ultimate sticky toffee pudding','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia',3,'2023-08-22'),('534565732','Whole milk Custard','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes',5,'2023-09-19'),('543467213','Fresh raspberry jelly','The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form',2,'2023-09-19'),('635887327','Summer berry & lime jellies','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores ',2,'2023-09-19'),('645645114','Black Watalappan ','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga',1,'2023-09-19'),('748237463','Vanilla extract Custard','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty',5,'2023-09-19'),('753489932','Easy chocolate jelly','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself',2,'2023-09-19'),('853804','Mango Yogurt','Yogurt powder is heat-treated, and heat kills the beneficial bacteria. Yogurt coatings are made of sugar, oil, whey, and yogurt powder.',4,'2023-09-27'),('987662514','Easy chocolate pudding','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.',3,'2023-08-22');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_item`
--

LOCK TABLES `product_item` WRITE;
/*!40000 ALTER TABLE `product_item` DISABLE KEYS */;
INSERT INTO `product_item` VALUES (1,10,1000,1,'122314522',1),(3,20,1500,1,'123456789',2),(7,100,2000,1,'753489932',3),(8,12,1000,1,'645645114',3),(9,30,2500,1,'122314522',3),(10,23,5000,1,'534565732',4),(11,33,7000,1,'635887327',3),(12,45,4577,1,'543467213',3),(13,60,3000,1,'543467213',1),(14,23,2700,1,'635887327',2),(15,23,3000,1,'748237463',1),(16,55,7500,1,'534565732',2),(17,40,5000,1,'534565732',1);
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
  `promotion_id` int NOT NULL AUTO_INCREMENT,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `product_item_id` int NOT NULL,
  `promotion_status_promotion_status_id` int NOT NULL,
  PRIMARY KEY (`promotion_id`),
  KEY `fk_promotion_product_item1_idx` (`product_item_id`),
  KEY `fk_promotion_promotion_status1_idx` (`promotion_status_promotion_status_id`),
  CONSTRAINT `fk_promotion_product_item1` FOREIGN KEY (`product_item_id`) REFERENCES `product_item` (`id`),
  CONSTRAINT `fk_promotion_promotion_status1` FOREIGN KEY (`promotion_status_promotion_status_id`) REFERENCES `promotion_status` (`promotion_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion`
--

LOCK TABLES `promotion` WRITE;
/*!40000 ALTER TABLE `promotion` DISABLE KEYS */;
INSERT INTO `promotion` VALUES (1,'2023-08-28 09:35:18','2023-08-28 09:35:20',1,1),(2,'2023-09-12 22:05:59','2023-09-12 22:06:00',3,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Western');
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
  `weight_id` int NOT NULL,
  PRIMARY KEY (`shipping_price_id`),
  KEY `fk_shipping_price_weight1_idx` (`weight_id`),
  CONSTRAINT `fk_shipping_price_weight1` FOREIGN KEY (`weight_id`) REFERENCES `weight` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_price`
--

LOCK TABLES `shipping_price` WRITE;
/*!40000 ALTER TABLE `shipping_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping_price` ENABLE KEYS */;
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
  PRIMARY KEY (`user_id`),
  KEY `fk_user_status1_idx` (`status_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_id`) REFERENCES `user_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'madusha@gmail.com','Madusha Pravinda','111112222','111112222',0,1,'2023-08-22'),(2,'armadushapravinda@gmail.com','Madusha Silva','8e55a61497b791ff6e22392f79fb0386','7788caaba88ca399937589c8f2b060f0cbf6a7654ae3c659f27c03f01637bf5c4eb06da55acaaafefe362d3b81c8d0238b2b26b9fd13c44d5851391584dea55d',116407,1,'2023-08-23'),(3,'kamalmadushapravinda@gmail.com','maduwa','aaeeb73c5fa27e8db8302cabb5854f84','1a000d41ece16bda6ac1000a5aa981f729e3be1151e65bfc19fb4876627a54962dbe5f5f380e5d3bb6552df3481d79900d24af98347fefb6145ba45899fdaa6d',0,1,'2023-08-23'),(4,'nimalmadushapravinda@gmail.com','maduwa','0d14670b47112767adbf180c93ac6bee','3a4347f65db6b934a0a04f4b8c933a88863685035c507a52cc82961ed4c7b1c53159d5b65a5a8e8570f702a3100ab244201b899fa8e74c2fb5a03997011e4637',0,1,'2023-08-23'),(5,'sirilmadushapravinda@gmail.com','maduwa','6898e6df9303e667b1ecaeb37c9b6ccf','46ae7aafdf5aa844113ffbbacc2187dd261921f5bb4ff56b8e06886f088ef9d9b514d289b2fb31535223ca97c8ea793960c3e7135c52dcf7f9a9247ce9d91651',0,1,'2023-08-23'),(6,'marusira@gmail.com','maduwa','11267714ab2c9cc2cc996e4c8aa26338','f7f4c947a808244921d0d9bd0a5c0616ceff6a08924f1b72b646fc40cf5cc6d39588d082774001f4ab572b382cd4f45f97d843f282067375b39bd2a1a76748ed',0,1,'2023-08-23'),(7,'saranadarmakirthi@gmail.com','maduwa','a74efe9739197e89dca052abd2886f54','af37d687b4c6446062e83aaa9d4732e1da8330d45b174f3fbfa84479e814ec7dd283c4974c346eb479aefe1d37a17f1afb4a03afcaf15cb9213ed6eb2a5063df',0,1,'2023-08-23'),(8,'supundarmakirthi@gmail.com','Supun Silva','7dc46b32d4dfe718079b11a845f35e68','6e1aeccbdd3795d4ae438ff1ce1b37cf089b8431f5b6b4450fffd52ee1643152621e985e3d72419e40ad2bc579e8f702a430db8dc99898172d7a11e9aaa42e90',0,1,'2023-08-23'),(9,'palakore@gmail.com','Supun Silva','cb91381c9a6170adace37079011db19d','387cae1230294438fe68b7880fde54159546539a72407aa94224a6f5a9dbe5f84aef939cda36b18deca02b6a2255762d4f2ba596bda95e8fed8381a77ddcbf30',0,1,'2023-08-23'),(10,'anurada@gmail.com','Anura Kumara','16836811c164462d4a46c9bc3ec82deb','5b3f253f1b8cbbfbc839e57e0fc4c4ef11e1936b9f76b36b6af45e15b5ff1640283bb1feb8cc1feb2b42af3bee8ac4e3d27e95da5a56c078a662e964bac3a235',0,1,'2023-09-18'),(11,'minakavi@gmail.com','Mia Khalifa','ef8f10841e583577bb7e8a1c54815269','3c7e1ab334ad94a23e1a455370e91b22544bcfe559e430b6377e2bd3a5b3adfd9804bba8f4f8cd1dbf085980a9ff60471462375f5596285b119b218bcce5e81e',0,1,'2023-09-18'),(12,'kusalmendis@gmail.com','Kusal Mendis','58584b11b6e0501470c5797aa1e136d2','03cbe9cef127e806beca79af915b59ae7a7a4621ebe5c070458704030a9bcf34302d83e181b64c1b71d30d690c52d26e83b080e20932ecc1d55a887c725068cc',0,1,'2023-09-18'),(13,'kusalmendisgmail.com','Kusal Mendis','0629e064f35d2f8f2787c2e11b5692d6','425547b29b579efa5878857d9e6249c02b7659b3b36a5892626cd902be2c773ac86bc6363f7be439ee76e3fac6a229b33080a84bd609d7ffa81bc94a6cb336cb',0,1,'2023-09-18'),(14,'kavidusas@gmail.com','Kavindu Sasanka','e0eaf519e50b0784b8388620d8fe9ba1','b60159242011f3107d3e343f4ef96b51d5f737e48a3ee4756624db3c84974d4174ab31857b76dd192ef942ac662d6e4dbb62d5d62089a5793f1535abe5ee858d',0,1,'2023-09-18'),(15,'kavisas@gmail.com','Kavi Dewmi','7ac8de85f40f2e7b7db52b4c88573789','d7bd6634c92d6b27b985485c3acb7223ea84942ab36e82b9182c6ae4296577cffe4818b632e719a2bd3fdf29d2a73290893c1fe8580858482238d9b9175ef58d',0,1,'2023-09-18'),(16,'kavisasxxx@gmail.com','Lasantha Perera','c79c4b80d46f305135380f1524606d47','4367bb57bff9eea5be11df54f9b58ff8c7ea795cfd8afe84160a47b1c86751b8a3997f81365a1d7d602aad7227dad61ee0a28c82cba2540432842c77ba49a3ee',0,1,'2023-09-18'),(17,'vimasiri@gmail.com','Vimal Silva','a3d417402d9b125ec64714e9b017a507','8c49d5207b91c7a7d012399bcb45e47e51d7d0f7edd9de3405cad438e56d4442f1ff2187dd1be1c58e0cd97a21965fa922c0347697d5e9f37a2da40455552e0c',0,1,'2023-09-21');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
INSERT INTO `watchlist` VALUES (18,7,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weight`
--

LOCK TABLES `weight` WRITE;
/*!40000 ALTER TABLE `weight` DISABLE KEYS */;
INSERT INTO `weight` VALUES (1,'1kg'),(2,'90g'),(3,'3kg'),(4,'500g');
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

-- Dump completed on 2023-10-06 18:53:37
