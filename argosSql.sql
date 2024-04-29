-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.1.72-community - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para argos1
CREATE DATABASE IF NOT EXISTS `banco1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `banco1`;

-- Copiando estrutura para tabela argos1.anexo
CREATE TABLE IF NOT EXISTS `anexo` (
  `id_anexo` int(11) NOT NULL AUTO_INCREMENT,
  `id_pagamentos` int(11) NOT NULL,
  `description` text,
  `file` varchar(50) DEFAULT '',
  PRIMARY KEY (`id_anexo`),
  KEY `id_pagamentos` (`id_pagamentos`),
  CONSTRAINT `anexo_ibfk_1` FOREIGN KEY (`id_pagamentos`) REFERENCES `pagamentos` (`id_pagamentos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela argos1.anexo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anexo` DISABLE KEYS */;
/*!40000 ALTER TABLE `anexo` ENABLE KEYS */;

-- Copiando estrutura para tabela argos1.estagiario
CREATE TABLE IF NOT EXISTS `estagiario` (
  `id_estagiario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '0',
  `valor_bolsa` decimal(10,2) NOT NULL DEFAULT '0.00',
  `auxilio` decimal(10,2) DEFAULT '0.00',
  `email` varchar(255) DEFAULT '0',
  `user_name` varchar(255) DEFAULT '0',
  `password` varchar(255) DEFAULT '0',
  `endereco` text,
  `dados_bancarios` text,
  PRIMARY KEY (`id_estagiario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela argos1.estagiario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estagiario` DISABLE KEYS */;
/*!40000 ALTER TABLE `estagiario` ENABLE KEYS */;

-- Copiando estrutura para tabela argos1.pagamentos
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id_pagamentos` int(11) NOT NULL AUTO_INCREMENT,
  `id_estagiario` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `id_project_manager` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enabled` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pagamentos`),
  KEY `id-estagiario` (`id_estagiario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela argos1.pagamentos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;

-- Copiando estrutura para tabela argos1.projeto
CREATE TABLE IF NOT EXISTS `projeto` (
  `id_project` int(11) NOT NULL AUTO_INCREMENT,
  `id_estagiario` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `status_` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela argos1.projeto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `projeto` ENABLE KEYS */;

-- Copiando estrutura para tabela argos1.projetosestagiario
CREATE TABLE IF NOT EXISTS `projetosestagiario` (
  `id_project_estagiario` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `id_estagiario` int(11) NOT NULL DEFAULT '0',
  `function` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id_project_estagiario`),
  KEY `id_project` (`id_project`),
  KEY `id_estagiario` (`id_estagiario`),
  CONSTRAINT `projetosestagiario_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projeto` (`id_project`),
  CONSTRAINT `projetosestagiario_ibfk_2` FOREIGN KEY (`id_estagiario`) REFERENCES `estagiario` (`id_estagiario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela argos1.projetosestagiario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `projetosestagiario` DISABLE KEYS */;
/*!40000 ALTER TABLE `projetosestagiario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
