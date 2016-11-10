CREATE DATABASE  IF NOT EXISTS `frota` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `frota`;
-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: frota
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.10.1

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
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Departamento Pessoal','2016-11-10 19:07:19','2016-11-10 19:07:19'),(2,'Coordenador de Transporte','2016-11-10 19:13:27','2016-11-10 19:13:27');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos_funcionarios`
--

DROP TABLE IF EXISTS `cargos_funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos_funcionarios` (
  `cargos_id` int(11) NOT NULL,
  `funcionarios_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fk_table1_cargos_idx` (`cargos_id`),
  KEY `fk_user_cargo_users1_idx` (`funcionarios_id`),
  CONSTRAINT `fk_table1_cargos` FOREIGN KEY (`cargos_id`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_cargo_users1` FOREIGN KEY (`funcionarios_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos_funcionarios`
--

LOCK TABLES `cargos_funcionarios` WRITE;
/*!40000 ALTER TABLE `cargos_funcionarios` DISABLE KEYS */;
INSERT INTO `cargos_funcionarios` VALUES (1,1,'2016-11-10 20:07:58','2016-11-10 20:07:58'),(2,2,'2016-11-10 20:13:23','2016-11-10 20:13:23');
/*!40000 ALTER TABLE `cargos_funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carteira_motorista`
--

DROP TABLE IF EXISTS `carteira_motorista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carteira_motorista` (
  `categoria` varchar(1) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carteira_motorista`
--

LOCK TABLES `carteira_motorista` WRITE;
/*!40000 ALTER TABLE `carteira_motorista` DISABLE KEYS */;
INSERT INTO `carteira_motorista` VALUES ('A',1,'2016-11-10 19:39:02','2016-11-10 19:39:02');
/*!40000 ALTER TABLE `carteira_motorista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cidade` (
  `cidade` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES ('Imbé','2016-11-10 19:42:36','2016-11-10 19:42:36',1);
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cnh_funcionario`
--

DROP TABLE IF EXISTS `cnh_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cnh_funcionario` (
  `tipo_cnh_id` int(11) NOT NULL,
  `funcionarios_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fk_cnh_funcionario_cateira_motorista1_idx` (`tipo_cnh_id`),
  KEY `fk_cnh_funcionario_funcionarios1_idx` (`funcionarios_id`),
  CONSTRAINT `fk_cnh_funcionario_cateira_motorista1` FOREIGN KEY (`tipo_cnh_id`) REFERENCES `carteira_motorista` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cnh_funcionario_funcionarios1` FOREIGN KEY (`funcionarios_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cnh_funcionario`
--

LOCK TABLES `cnh_funcionario` WRITE;
/*!40000 ALTER TABLE `cnh_funcionario` DISABLE KEYS */;
INSERT INTO `cnh_funcionario` VALUES (1,1,'2016-11-10 20:07:58','2016-11-10 20:07:58'),(1,2,'2016-11-10 20:13:23','2016-11-10 20:13:23');
/*!40000 ALTER TABLE `cnh_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endereco` varchar(45) DEFAULT NULL,
  `cnh` varchar(45) DEFAULT NULL,
  `aniversario` date DEFAULT NULL,
  `cidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funcionarios_cidade1_idx` (`cidade_id`),
  CONSTRAINT `fk_funcionarios_cidade1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Mirian Falconi','(51) 9836-1093','$2y$10$DzAies2XNDS2OSIGkienee5sdgb93KZtOUtKi37sscBZ8HAaTtSym','IyY8p56eiZoJ6SsWcuwDCWwav1gjfkzjgs76eREiGTvXjYFG60sq9QXL5iwH','2016-11-10 20:13:27','2016-11-10 20:07:58','Atlantico 2345','1234567890',NULL,1),(2,'Tiago Merlo','(12) 3456-7890','$2y$10$KO8My8fG.iZIIMN7beMsC.5fJhxzgP7EYt1MKM8o0i.gDZxcjGeDi','lCckHGr3Zw5B9xquBCy8gnkS03DcXq0Ec8ZtBLdCAbPPbq4L3pEEGJBlRsRJ','2016-11-10 20:13:46','2016-11-10 20:13:23','Atlantico 2345','1234567890',NULL,1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manutencoes`
--

DROP TABLE IF EXISTS `manutencoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manutencoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manutencao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manutencoes`
--

LOCK TABLES `manutencoes` WRITE;
/*!40000 ALTER TABLE `manutencoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `manutencoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manutencoes_veiculos`
--

DROP TABLE IF EXISTS `manutencoes_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manutencoes_veiculos` (
  `veiculos_id` int(11) NOT NULL,
  `manutencoes_id` int(11) NOT NULL,
  `funcionarios_id` int(10) NOT NULL,
  KEY `fk_manutencoes_veiculos1_idx` (`veiculos_id`),
  KEY `fk_manutencoes_veiculos_manutencoes1_idx` (`manutencoes_id`),
  KEY `fk_manutencoes_veiculos_funcionarios1_idx` (`funcionarios_id`),
  CONSTRAINT `fk_manutencoes_veiculos1` FOREIGN KEY (`veiculos_id`) REFERENCES `veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_manutencoes_veiculos_funcionarios1` FOREIGN KEY (`funcionarios_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_manutencoes_veiculos_manutencoes1` FOREIGN KEY (`manutencoes_id`) REFERENCES `manutencoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manutencoes_veiculos`
--

LOCK TABLES `manutencoes_veiculos` WRITE;
/*!40000 ALTER TABLE `manutencoes_veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `manutencoes_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) CHARACTER SET utf8 NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_nota` varchar(45) DEFAULT NULL,
  `icms` tinyint(4) DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `data_emissao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota`
--

LOCK TABLES `nota` WRITE;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_rotas`
--

DROP TABLE IF EXISTS `notas_rotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas_rotas` (
  `nota_id` int(11) NOT NULL,
  `rota_id` int(11) NOT NULL,
  KEY `fk_notas_rotas_nota1_idx` (`nota_id`),
  KEY `fk_notas_rotas_rota1_idx` (`rota_id`),
  CONSTRAINT `fk_notas_rotas_nota1` FOREIGN KEY (`nota_id`) REFERENCES `nota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notas_rotas_rota1` FOREIGN KEY (`rota_id`) REFERENCES `rota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_rotas`
--

LOCK TABLES `notas_rotas` WRITE;
/*!40000 ALTER TABLE `notas_rotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas_rotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencia`
--

DROP TABLE IF EXISTS `ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rotas_funcionarios_id` int(11) NOT NULL,
  `ocorrencia` varchar(1024) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocorrencia_rotas_funcionarios1_idx` (`rotas_funcionarios_id`),
  CONSTRAINT `fk_ocorrencia_rotas_funcionarios1` FOREIGN KEY (`rotas_funcionarios_id`) REFERENCES `rotas_funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencia`
--

LOCK TABLES `ocorrencia` WRITE;
/*!40000 ALTER TABLE `ocorrencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rota`
--

DROP TABLE IF EXISTS `rota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destino` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rota`
--

LOCK TABLES `rota` WRITE;
/*!40000 ALTER TABLE `rota` DISABLE KEYS */;
/*!40000 ALTER TABLE `rota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rotas_funcionarios`
--

DROP TABLE IF EXISTS `rotas_funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rotas_funcionarios` (
  `rota_id` int(11) NOT NULL,
  `veiculos_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horario_saida` timestamp NULL DEFAULT NULL,
  `horario_chegada` timestamp NULL DEFAULT NULL,
  `auxiliar_id` int(10) NOT NULL,
  `motorista_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rotas_funcionarios_rota1_idx` (`rota_id`),
  KEY `fk_rotas_funcionarios_veiculos1_idx` (`veiculos_id`),
  KEY `fk_rotas_funcionarios_funcionarios1_idx` (`auxiliar_id`),
  KEY `fk_rotas_funcionarios_funcionarios2_idx` (`motorista_id`),
  CONSTRAINT `fk_rotas_funcionarios_funcionarios1` FOREIGN KEY (`auxiliar_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rotas_funcionarios_funcionarios2` FOREIGN KEY (`motorista_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rotas_funcionarios_rota1` FOREIGN KEY (`rota_id`) REFERENCES `rota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rotas_funcionarios_veiculos1` FOREIGN KEY (`veiculos_id`) REFERENCES `veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rotas_funcionarios`
--

LOCK TABLES `rotas_funcionarios` WRITE;
/*!40000 ALTER TABLE `rotas_funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `rotas_funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-10 16:16:22
