-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando dados para a tabela banco1.anexo: ~0 rows (aproximadamente)

-- Copiando dados para a tabela banco1.estagiario: ~3 rows (aproximadamente)
REPLACE INTO `estagiario` (`id_estagiario`, `nome`, `valor_bolsa`, `auxilio`, `email`, `user_name`, `password`, `endereco`, `dados_bancarios`) VALUES
	(1, 'ISAQUE MARLEY VIEIRA BISPO', 900.00, 9.90, 'email01@gmail.com', 'Isaque', 'marley123', 'Rua C3', 'ag:15646, banco: 651651 '),
	(4, 'João Silva', 1500.00, 300.00, 'joao@email.com', 'joaosilva', '12345678', 'Rua das Flores, 123', 'Banco XYZ, Conta: 12345-6'),
	(5, 'marcos', 178.00, 0.00, 'email01@gmail.com', 'marcos', 'marley123', 'Rua C3', 'ag:15646, banco: 651651 ');

-- Copiando dados para a tabela banco1.pagamentos: ~0 rows (aproximadamente)

-- Copiando dados para a tabela banco1.projeto: ~1 rows (aproximadamente)
REPLACE INTO `projeto` (`id_project`, `id_estagiario`, `name`, `description`, `start_date`, `end_date`, `company`, `status_`) VALUES
	(2, 5, 'projeto 60 dias', 'projeto para aprender php', '2025-01-01', '2026-12-01', 'empresa', 0);

-- Copiando dados para a tabela banco1.projetosestagiario: ~0 rows (aproximadamente)
REPLACE INTO `projetosestagiario` (`id_project_estagiario`, `id_project`, `id_estagiario`, `function`, `start_date`, `end_date`) VALUES
	(2, 2, 5, NULL, '2025-01-01', '2026-12-01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
