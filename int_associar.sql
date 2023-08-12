-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12-Ago-2023 às 15:23
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `associaçao_40ribas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `int_associar`
--

DROP TABLE IF EXISTS `int_associar`;
CREATE TABLE IF NOT EXISTS `int_associar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apelido` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sobrenome` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cpf` varchar(12) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `nascimento` date NOT NULL,
  `cid_natal` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uf` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `celular1` varchar(15) NOT NULL,
  `celular2` varchar(15) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `nu` varchar(15) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `email` varchar(140) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `senha` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `observaçao` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `int_associar`
--

INSERT INTO `int_associar` (`id`, `admin`, `apelido`, `nome`, `sobrenome`, `cpf`, `rg`, `nascimento`, `cid_natal`, `uf`, `celular1`, `celular2`, `endereco`, `nu`, `bairro`, `email`, `senha`, `data`, `status`, `observaçao`) VALUES
(41, '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', 'joaf@hotmail.com', '$2y$10$W4EdNAv.N', '2023-08-02 17:37:50', '', ''),
(40, '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', 'joaf@hotmail.com', '$2y$10$BpHnt8mTJ', '2023-08-02 17:35:26', '', ''),
(39, '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', 'joaf@hotmail.com', '$2y$10$4RCx/bHP5', '2023-08-02 17:29:09', '', ''),
(38, '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', '8a59540e0a@mymaily.lol', '$2y$10$2B56yroBf', '2023-08-02 17:28:50', '', ''),
(36, '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', 'joaf@hotmail.com', '$2y$10$ZJhGgQ3Tb', '2023-08-01 21:33:50', '', ''),
(37, '', '', 'ju', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', 'ffffff@hotmail.com', '$2y$10$Lkyp/O.uj', '2023-08-02 09:24:32', '', ''),
(70, '', '', 'Jones', '', '0', '0', '0000-00-00', '', '', '0', '0', '', '', '', 'batatajonesrodrigues@gmail.com', '$2y$10$4LuiefwGJ', '2023-08-10 12:12:07', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
