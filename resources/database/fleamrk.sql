-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: fleamrk
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `bilder`
--

DROP TABLE IF EXISTS `bilder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bilder` (
  `bildeID` int(11) NOT NULL AUTO_INCREMENT,
  `bildenavn` varchar(255) NOT NULL,
  `gjenstandID` int(11) NOT NULL,
  PRIMARY KEY (`bildeID`),
  KEY `FK_bilde_item_idx` (`gjenstandID`),
  CONSTRAINT `FK_bilde_item` FOREIGN KEY (`gjenstandID`) REFERENCES `item` (`itemID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bilder`
--

LOCK TABLES `bilder` WRITE;
/*!40000 ALTER TABLE `bilder` DISABLE KEYS */;
INSERT INTO `bilder` VALUES (1,'IMG_0300.jpg',1),(10,'960x0.jpg',68),(11,'le-36200-0074_2_of_2_.jpg',69),(12,'750_1190017851.jpg',70),(13,'703_702676129.jpg',71),(15,'22204b5b3c04463986c6feb303e2519b.webp',73),(16,'8595ef41ca99424ea30d904b733614a4.webp',74),(17,'1024px-2006_Berliner_Dom_Front.jpg',75),(18,'18357huge.jpg',76),(60,'yqXACsbeXg.png',84),(61,'HCrMFdBMJk.png',85),(62,'S14tk8PGG4.png',86),(64,'8ZkNZko6XP.jpg',88);
/*!40000 ALTER TABLE `bilder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bruker`
--

DROP TABLE IF EXISTS `bruker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bruker` (
  `brukerID` int(11) NOT NULL AUTO_INCREMENT,
  `brukernavn` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passord` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fornavn` varchar(45) NOT NULL,
  `etternavn` varchar(45) NOT NULL,
  `telefonnummer` int(11) DEFAULT NULL,
  PRIMARY KEY (`brukerID`),
  UNIQUE KEY `brukernavn_UNIQUE` (`brukernavn`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bruker`
--

LOCK TABLES `bruker` WRITE;
/*!40000 ALTER TABLE `bruker` DISABLE KEYS */;
INSERT INTO `bruker` VALUES (12,'Herman','nepleherman@gmail.com','$2y$10$501kLjBZFcNccS0ElcQlQ.pObe3gtB0i435.QhyNVFBNlc3/OybUi','2021-04-08 08:34:59','Herman','Neple',93803297),(14,'pederbr','peder.brennum@gmail.com','$2y$10$jAykjm/qef9f1GhKLOd01.rfslkP2wEwOo9dR2GUSd4IyxVZvd.iC','2021-04-08 09:12:54','peder','brennum',46515848),(53,'Kreikrei','kristianbrataas@gmail.com','$2y$10$uvULj52px7Fgr/eUl368QeTGXJzP2Wjex8kJlZl4mAeNVkia3ud/y','2021-04-09 08:15:00','Kristian','Brataas',95919676),(54,'matiasve','matias.uten.h@gmail.com','$2y$10$ICo09UMYW6HWSX./b7RuSeuKvHVzKtoZqrqquJiFCpWFMkNmotpyG','2021-04-09 12:37:55','Matias Altern','Vedal',41564402),(57,'siljebre','silje@brennum.com','$2y$10$ucHfUVkyeVEO4SGfdIIkS.CUfVx45DEshQXWdoizCrnCHuOiwUdbG','2021-04-29 19:17:11','silje','Brennum',90155101),(58,'Melkmeg','69@gmail.com','$2y$10$ZctlmEXl4RIH1hVnhn2q5.JxNr5ijP8Jr3PtBTRIHeU15Qq2kDKbS','2021-05-03 09:06:18','melk','meg',123245678),(59,'test69','test@test.com','$2y$10$4teBESj.Fp/W5BVnNaLyPObyiFSpQQOFfXChhXR1nmu/lnYv9xkt2','2021-05-03 09:08:09','test','test',1234),(60,'sexytime','69@gmail.com','$2y$10$71OpbFHHFfzkcgCmWWz6GOfo2YyHpUnX02C.GGmIR51JRjJAR.tVS','2021-05-04 08:58:29','DNUMA','gay',12345678),(61,'test100','test@test.com','$2y$10$PMafRNq7qFxp2qg55pBVeOKWo789O4GFxWJO7IsIVVsRRsOruTkX2','2021-05-06 08:11:59','test','test',12345678),(62,'testesen','test@test.com','$2y$10$lvwLlGlZd4g8kxjY7srafuANeQmSIjJdb4QVC5zMItT9bc9P3bmtu','2021-05-20 11:37:48','test','testesen',1234),(63,'pÃ¦der','test@test.com','$2y$10$ROJcDcAujVm1njXaifLN9eg681MGLm9t0ByVrMEdC3yX/Wk88nHhC','2021-05-20 11:40:41','pÃ¦der','brÃ¦nnum',12345848),(64,'test112','test@test.com','$2y$10$h./YJbB.Dz.hRFzeUOEEy.LJW3uHz1BMB80.cYX.Q3QWhtFKgiZIq','2021-05-20 11:44:01','tesst','test',1234);
/*!40000 ALTER TABLE `bruker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritt`
--

DROP TABLE IF EXISTS `favoritt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favoritt` (
  `itemID` int(11) NOT NULL,
  `brukerID` int(11) NOT NULL,
  PRIMARY KEY (`itemID`,`brukerID`),
  KEY `FK_favoritt_bruker_idx` (`brukerID`),
  CONSTRAINT `FK_favoritt_bruker` FOREIGN KEY (`brukerID`) REFERENCES `bruker` (`brukerID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Fk_favoritt_item` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritt`
--

LOCK TABLES `favoritt` WRITE;
/*!40000 ALTER TABLE `favoritt` DISABLE KEYS */;
INSERT INTO `favoritt` VALUES (1,14),(68,14),(70,14),(71,14),(75,14),(86,14),(76,60),(1,61);
/*!40000 ALTER TABLE `favoritt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `navn_item` varchar(255) NOT NULL,
  `beskrivelse` text NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `selgerID` int(11) NOT NULL,
  `solgt` tinyint(4) NOT NULL,
  `pris` int(11) NOT NULL,
  `merkeID` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemID`),
  KEY `FK_selger_bruker_idx` (`selgerID`),
  KEY `FK_item_merke_idx` (`merkeID`),
  CONSTRAINT `FK_item_merke` FOREIGN KEY (`merkeID`) REFERENCES `merke` (`merkeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_selger_bruker` FOREIGN KEY (`selgerID`) REFERENCES `bruker` (`brukerID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Nike dub zero','Nye sko til god pris!','45',14,0,750,1,'2022-04-20 21:00:00'),(68,'Hus til salgs!','stort og romslig InnendÃ¸rs og utendÃ¸rs badebaseng','100 m2',54,0,1000000,2,'2021-04-26 10:43:15'),(69,' Levis 501 Crop ',' Klassikeren i cropped versjon!\r\n\r\nDen ikoniske 501 Jeansen i en cropped variant - DET kan vi like! Ikonisk modell fra Leviâ€™s! Den er mellomhÃ¸y i livet og gÃ¥r ca. til navlen. Bena har rett passform og gir en litt mer baggy og stilig lookâ™¥ Det fantastiske med 501 at du bÃ¦rer den sÃ¥nn som du Ã¸nsker, pÃ¥ hoftekammen, lenger ned, baggy, ettersittende! Skap din egne 501-stilâ™¥','flere mulige',53,0,1099,18,'2021-04-26 14:16:25'),(70,'Vintage genser i 100% lamme ull','Vintage genser i 100% lamme ull','M - 38',12,0,650,2,'2021-04-26 15:25:59'),(71,'Vintage/ Retro ankel bukser','Rutete ankel bukse i ull kr 145','S - 36',54,0,145,2,'2021-04-27 20:25:59'),(73,'Kjole',' Nesten ren, lite brukt sommerkjole fra Vila','M - 38',57,0,500,2,'2021-04-29 21:22:49'),(74,'UNISEX - Sweatshirt','Overmateriale: 100% bomull\r\nMateriale: Sweat\r\nVedlikeholdsrÃ¥d: Kan ikke tÃ¸rkes i tÃ¸rketrommel, Maskinvask pÃ¥ 30Â°C\r\nHals/utringning: Rund hals\r\nMÃ¸nster: Print\r\nDetaljer: Elastisk linning\r\nArtikkelnummer: KAI22S011-Q11\r\nModellhÃ¸yde: Modellen er 186 cm hÃ¸y og har pÃ¥ seg stÃ¸rrelse L\r\nPassform: Normal\r\nLengde: Normal lengde\r\nErmelengde: Langermet\r\nErmelengde: 65 cm i stÃ¸rrelse L\r\nTotallengde: 75 cm i stÃ¸rrelse L','alt fra XXS-XXL',12,0,649,19,'2021-05-01 14:07:46'),(75,'En kirke',' Det er en kirke ass, hadde kjÃ¸pt den om jeg var deg.\r\nVar ikke sÃ¥ jÃ¦vla dyr heller','Ganske stor',14,0,10000000,20,'2021-05-03 11:18:37'),(76,'Tongatruse a la Scottern',' Godt brukt tongatruse, brukt av selveste Scottern Blottern.','XXXXL',14,0,69,2,'2021-05-04 08:31:06'),(84,'testet',' test','test',14,1,10000,20,'2021-05-05 11:07:09'),(85,'test','test ','test',14,1,100,21,'2021-05-05 11:08:34'),(86,'test','test ','test',14,1,100,1,'2021-05-05 11:28:34'),(88,'\"mel\"','1 gram = 1200 kr\r\n10 gram = 10 000 kr','0.1 gram',14,0,150,2,'2021-05-10 15:23:51');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merke`
--

DROP TABLE IF EXISTS `merke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `merke` (
  `merkeID` int(11) NOT NULL AUTO_INCREMENT,
  `merke_navn` varchar(45) NOT NULL,
  `merke_info` text NOT NULL,
  `merke_link` varchar(255) NOT NULL,
  PRIMARY KEY (`merkeID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merke`
--

LOCK TABLES `merke` WRITE;
/*!40000 ALTER TABLE `merke` DISABLE KEYS */;
INSERT INTO `merke` VALUES (1,'Nike','populært sko / treningsmerke','https://www.nike.com/no/en/'),(2,'Ikke definert / ukjent','-','-'),(6,'Adidas','produserer bla. sko og jakker','https://www.adidas.no/'),(17,'supreme','Hypebeast klÃ¦r','https://www.supremenewyork.com/'),(18,'Levis','Classic American Style and Effortless Cool. Shop Now At The Official Levi\'sÂ® Online Store. Explore The Best Selection Of Jeans, Jackets And Clothing For Men, Women And Kids.','https://www.levi.com/NO/en/'),(19,'Kaotiko','-','https://www.kaotikobcn.com/en'),(20,'Jesus','det er jesus','https://www.bible.com/no'),(21,'melkeknappen','Old town road','http://hulingshulings.xyz/');
/*!40000 ALTER TABLE `merke` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-20 13:57:03
