-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 18-Mar-2017 às 19:04
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snnoker`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `categoria` char(1) NOT NULL,
  `ativo` char(1) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id_admin`, `nome`, `email`, `senha`, `categoria`, `ativo`, `cadastro`) VALUES
(1, 'Thais MendonÃ§a', 'thaisvmendonca@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'S', 'S', '2017-02-23 23:30:28'),
(2, 'Stella', 'stella@stella.com', '81dc9bdb52d04dc20036dbd8313ed055', 'A', 'S', '2017-02-23 23:02:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exibir_precos`
--

CREATE TABLE `exibir_precos` (
  `exibir` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `exibir_precos`
--

INSERT INTO `exibir_precos` (`exibir`) VALUES
('S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `preco` varchar(9) DEFAULT NULL,
  `categoria` char(1) NOT NULL,
  `publicado` char(1) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `descricao`, `preco`, `categoria`, `publicado`, `cadastro`, `admin_id_admin`) VALUES
(4, 'Skol 600ml', '', 'R$ 7,50', 'C', 'S', '2017-02-22 23:11:13', 1),
(5, 'Tequila', '', 'R$ 20,00', 'D', 'S', '2017-02-24 02:42:05', 1),
(6, 'Fritas com queijo', '', 'R$ 21,00', 'A', 'S', '2017-02-24 02:43:57', 1),
(7, 'Budweiser Long 300ml', '', 'R$ 6,00', 'C', 'S', '2017-02-24 02:45:35', 1),
(8, 'Frango Frito', '', 'R$ 22,00', 'A', 'S', '2017-02-24 03:04:51', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `data_reserva` varchar(10) NOT NULL,
  `horario` varchar(5) NOT NULL,
  `n_pessoas` int(2) NOT NULL,
  `mensagem` text,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_id_admin` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `nome`, `email`, `telefone`, `data_reserva`, `horario`, `n_pessoas`, `mensagem`, `cadastro`, `admin_id_admin`, `status`) VALUES
(1, 'Fernando Rocha', 'fhsrocha@gmail.com', '(29) 18423-4873', '18/03/2017', '20:00', 2, '', '2017-03-18 17:30:29', NULL, 2),
(2, 'Tha', 'thaisvmendonca@gmail.com', '(12) 87372-4523', '18/03/2017', '22:00', 10, '', '2017-03-18 17:30:42', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produtos_admin_idx` (`admin_id_admin`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_reserva_admin1_idx` (`admin_id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_admin` FOREIGN KEY (`admin_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_admin1` FOREIGN KEY (`admin_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
