-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Set-2022 às 03:59
-- Versão do servidor: 10.6.5-MariaDB
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `taskmanager_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions_id` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `password`, `email`, `phone`, `permissions_id`) VALUES
(5, 'Artur', '$argon2i$v=19$m=65536,t=4,p=1$bXNtNzQwd3NTSklYMnByRg$r17JpZC8En2eBZT32X5l8Rq3Z/wWZKIFa6TMhxFqG2s', 'artur.fb.95@gmail.com', '(31) 99220-0299', NULL),
(6, 'Artur', '$argon2i$v=19$m=65536,t=4,p=1$NUdnemY5M1V0dFVTSHp5Qw$3mKW2fTw6RVMAVv+A2nKaozBxpbgWaNFdvGKSQOsUb0', 'artur@ajung.com.br', '(31) 99220-0299', NULL),
(20, 'Artur', '$argon2i$v=19$m=65536,t=4,p=1$azFDOGJBTWRFYTIuTjVlbQ$1K27qcQhI5bFfYZaHBwM9pDprBoXgoU4vqH+VHsQklU', 'artur.fd.95@gmail.com', '(31) 99220-0299', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `account_permissions`
--

DROP TABLE IF EXISTS `account_permissions`;
CREATE TABLE IF NOT EXISTS `account_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `account_permissions`
--

INSERT INTO `account_permissions` (`id`, `user_id`, `permission_id`) VALUES
(1, 5, 1),
(2, 6, 2),
(3, 6, 3),
(4, 6, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `permission`) VALUES
(1, 'admin'),
(2, 'view'),
(3, 'edit'),
(4, 'insert'),
(5, 'delete'),
(6, 'print');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `conclusion_date` date DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT 'Pendente',
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `creation_date`, `conclusion_date`, `status`, `account_id`) VALUES
(13, 'Produto teste', 'teste', '2022-09-14', '2022-09-15', 'Concluido', 5),
(14, 'tarefa teste', 'descriÃ§Ã£o teste', '2022-09-15', NULL, 'Pendente', 19),
(16, 'teste', 'teste', '2022-09-15', NULL, 'Pendente', 6),
(20, 'TEste de yusyarui', 'descriÃ§Ã£o', '2022-09-15', NULL, 'Pendente', 20),
(18, 'teeste', 'teste', '2022-09-15', NULL, 'Pendente', 6),
(19, 'tese', 'teste', '2022-09-15', NULL, 'Pendente', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
