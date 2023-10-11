-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Out-2023 às 15:05
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
-- Banco de dados: `associacao_40ribas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_admin`
--

-- Estrutura da tabela `config_admin`

DROP TABLE IF EXISTS `config_admin`;
CREATE TABLE IF NOT EXISTS `config_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(15) NOT NULL,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(150) NOT NULL,
  `razao` varchar(50) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `uf` varchar(15) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `presidente` varchar(150) NOT NULL,
  `vice_presidente` varchar(150) NOT NULL,
  `nome_tesoureiro` varchar(30) NOT NULL,
  `email_suporte` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `idade_minima` int NOT NULL,
  `termos_insc` text NOT NULL,
  `estatuto_int` text NOT NULL,
  `validade_insc` int NOT NULL,
  `reg_int` text NOT NULL,
  `dia_fecha_mes` int NOT NULL,
  `valor_mensalidades` int NOT NULL,
  `desconto_mensalidades` int NOT NULL,
  `multa` int NOT NULL,
  `joia` int NOT NULL,
  `parcela_joia` int NOT NULL,
  `meses_vence3` int NOT NULL,
  `meses_vence5` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `em_votacao`
--

DROP TABLE IF EXISTS `em_votacao`;
CREATE TABLE IF NOT EXISTS `em_votacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_socio` int NOT NULL,
  `id_inscrito` int NOT NULL,
  `admin` varchar(20) NOT NULL,
  `voto` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_config_admin`
--

DROP TABLE IF EXISTS `historico_config_admin`;
CREATE TABLE IF NOT EXISTS `historico_config_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(50) NOT NULL,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(150) NOT NULL,
  `razao` varchar(50) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `uf` varchar(30) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `presidente` varchar(150) NOT NULL,
  `vice_presidente` varchar(150) NOT NULL,
  `nome_tesoureiro` varchar(150) NOT NULL,
  `email_suporte` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `idade_minima` int NOT NULL,
  `termos_insc` text NOT NULL,
  `estatuto_int` text NOT NULL,
  `validade_insc` int NOT NULL,
  `reg_int` text NOT NULL,
  `dia_fecha_mes` int NOT NULL,
  `valor_mensalidades` varchar(15) NOT NULL,
  `desconto_mensalidades` int NOT NULL,
  `multa` int NOT NULL,
  `joia` int NOT NULL,
  `parcela_joia` int NOT NULL,
  `meses_vence3` int NOT NULL,
  `meses_vence5` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_joias_receber`
--

DROP TABLE IF EXISTS `historico_joias_receber`;
CREATE TABLE IF NOT EXISTS `historico_joias_receber` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `admin` varchar(100) NOT NULL,
  `id_socio` int NOT NULL,
  `apelido` varchar(100) NOT NULL,
  `nome_completo` varchar(150) NOT NULL,
  `celular1` varchar(50) NOT NULL,
  `celular2` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `valor` varchar(15) NOT NULL,
  `entrada` int NOT NULL,
  `restante` int NOT NULL,
  `num_parcela` int NOT NULL,
  `qt_parcelas` int NOT NULL,
  `valor_parcelas` int NOT NULL,
  `vencimento` date NOT NULL,
  `desconto_parcela` int NOT NULL,
  `recebido` int NOT NULL,
  `data_recebeu` date NOT NULL,
  `a_receber` varchar(15) NOT NULL,
  `status_pagamento` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_mensalidades`
--

DROP TABLE IF EXISTS `historico_mensalidades`;
CREATE TABLE IF NOT EXISTS `historico_mensalidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_socio` int NOT NULL,
  `data` date NOT NULL,
  `admin` varchar(50) NOT NULL,
  `apelido` varchar(20) NOT NULL,
  `nome_completo` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `mensalidade_dia` int NOT NULL,
  `mensalidade_mes` int NOT NULL,
  `mensalidade_ano` int NOT NULL,
  `valor_mensalidade` int NOT NULL,
  `data_vencimento` date NOT NULL,
  `desconto_mensalidade` int NOT NULL,
  `multa_mensalidade` int NOT NULL,
  `valor_receber` int NOT NULL,
  `valor_recebido` int NOT NULL,
  `data_recebida` date NOT NULL,
  `restante` int NOT NULL,
  `status_pagamento` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `int_associar`
--

DROP TABLE IF EXISTS `int_associar`;
CREATE TABLE IF NOT EXISTS `int_associar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `foto` varchar(150) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `nascimento` date NOT NULL,
  `uf` varchar(100) NOT NULL,
  `cid_natal` varchar(40) NOT NULL,
  `mae` varchar(100) NOT NULL,
  `pai` varchar(100) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `uf_atual` varchar(100) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `cid_atual` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `nu` varchar(15) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `celular1` varchar(15) NOT NULL,
  `celular2` varchar(15) NOT NULL,
  `email` varchar(140) NOT NULL,
  `motivo` varchar(1000) NOT NULL,
  `termos` varchar(10000) NOT NULL,
  `validade` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `observacao` varchar(1500) NOT NULL,
  `em_votacao` varchar(5) NOT NULL,
  `admin` varchar(150) NOT NULL,
  `inicio_votacao` date NOT NULL,
  `inicio_hora` time NOT NULL,
  `fim_votacao` date NOT NULL,
  `fim_hora` time NOT NULL,
  `voto_sim` int NOT NULL,
  `voto_nao` int NOT NULL,
  `resultado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `joias_receber`
--

DROP TABLE IF EXISTS `joias_receber`;
CREATE TABLE IF NOT EXISTS `joias_receber` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `admin` varchar(50) NOT NULL,
  `id_socio` int NOT NULL,
  `apelido` varchar(100) NOT NULL,
  `nome_completo` varchar(150) NOT NULL,
  `celular1` varchar(50) NOT NULL,
  `celular2` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `valor` varchar(15) NOT NULL,
  `entrada` int NOT NULL,
  `restante` int NOT NULL,
  `num_parcela` int NOT NULL,
  `qt_parcelas` int NOT NULL,
  `valor_parcelas` int NOT NULL,
  `vencimento` date NOT NULL,
  `desconto_parcela` int NOT NULL,
  `recebido` int NOT NULL,
  `data_recebeu` date NOT NULL,
  `a_receber` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidades`
--

-- Estrutura da tabela `mensalidades`

DROP TABLE IF EXISTS `mensalidades`;
CREATE TABLE IF NOT EXISTS `mensalidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_socio` int NOT NULL,
  `data` date NOT NULL,
  `admin` varchar(50) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `nome_completo` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `mensalidade_dia` int NOT NULL,
  `mensalidade_mes` int NOT NULL,
  `mensalidade_ano` int NOT NULL,
  `valor_mensalidade` int NOT NULL,
  `data_vencimento` date NOT NULL,
  `desconto_mensalidade` int NOT NULL,
  `multa_mensalidade` int NOT NULL,
  `valor_receber` int NOT NULL,
  `valor_recebido` int NOT NULL,
  `data_recebida` date NOT NULL,
  `restante` int NOT NULL,
  `status_pagamento` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidades_geradas`
--

DROP TABLE IF EXISTS `mensalidades_geradas`;
CREATE TABLE IF NOT EXISTS `mensalidades_geradas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `admin` varchar(50) NOT NULL,
  `mensalidade_dia` int NOT NULL,
  `mensalidade_mes` int NOT NULL,
  `mensalidade_ano` int NOT NULL,
  `data_vencimento` date NOT NULL,
  `valor` int NOT NULL,
  `desconto` int NOT NULL,
  `multa` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estrutura da tabela `socios`
--

DROP TABLE IF EXISTS `socios`;
CREATE TABLE IF NOT EXISTS `socios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `nascimento` date NOT NULL,
  `uf` varchar(100) NOT NULL,
  `cid_natal` varchar(40) NOT NULL,
  `mae` varchar(100) NOT NULL,
  `pai` varchar(100) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `uf_atual` varchar(100) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `cid_atual` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `celular1` varchar(15) NOT NULL,
  `celular2` varchar(15) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `motivo` varchar(1000) NOT NULL,
  `termos` varchar(10000) NOT NULL,
  `observacao` varchar(500) NOT NULL,
  `joia` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
