-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18-Ago-2023 às 18:55
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
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apelido` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sobrenome` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cpf` varchar(12) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `nascimento` date NOT NULL,
  `uf` varchar(100) NOT NULL,
  `cid_natal` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mae` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pai` varchar(100) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `uf_atual` varchar(100) NOT NULL,
  `cid_atual` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `nu` varchar(15) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `celular1` varchar(15) NOT NULL,
  `celular2` varchar(15) NOT NULL,
  `email` varchar(140) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `senha` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `motivo` varchar(1000) NOT NULL,
  `termos` varchar(10000) NOT NULL,
  `observaçao` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `int_associar`
--

INSERT INTO `int_associar` (`id`, `data`, `admin`, `apelido`, `nome`, `sobrenome`, `cpf`, `rg`, `nascimento`, `uf`, `cid_natal`, `mae`, `pai`, `sexo`, `uf_atual`, `cid_atual`, `endereco`, `nu`, `bairro`, `celular1`, `celular2`, `email`, `senha`, `status`, `motivo`, `termos`, `observaçao`) VALUES
(41, '2023-08-18 14:47:07', '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'joaf@hotmail.com', '$2y$10$W4EdNAv.N', '', '', '', ''),
(40, '2023-08-18 14:47:07', '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'joaf@hotmail.com', '$2y$10$BpHnt8mTJ', '', '', '', ''),
(39, '2023-08-18 14:47:07', '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'joaf@hotmail.com', '$2y$10$4RCx/bHP5', '', '', '', ''),
(38, '2023-08-18 14:47:07', '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '8a59540e0a@mymaily.lol', '$2y$10$2B56yroBf', '', '', '', ''),
(36, '2023-08-18 14:47:07', '', '', 'ggg', '', '0', '0', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'joaf@hotmail.com', '$2y$10$ZJhGgQ3Tb', '', '', '', ''),
(37, '2023-08-18 14:47:07', '', '', 'ju', '', '0', '0', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'ffffff@hotmail.com', '$2y$10$Lkyp/O.uj', '', '', '', ''),
(72, '2023-08-18 14:47:07', '', '', 'jones', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 'batatajonesrodrigues@gmail.com', '$2y$10$bAN1r/TobU7VzraT9ecQF.NwVRa1Af.prujzs5GvsJ7vQ2HEjdQ9W', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
