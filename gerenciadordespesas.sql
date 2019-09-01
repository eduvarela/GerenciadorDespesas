-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Set-2019 às 00:58
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gerenciadordespesas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Alimentação'),
(2, 'Transporte');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `idfavorecido` int(11) NOT NULL,
  `idformapagamento` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `vencimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorecidos`
--

CREATE TABLE `favorecidos` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favorecidos`
--

INSERT INTO `favorecidos` (`id`, `idUsuario`, `nome`) VALUES
(5, 1, 'Uber'),
(6, 1, 'McDonalds');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formapagamento`
--

CREATE TABLE `formapagamento` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formapagamento`
--

INSERT INTO `formapagamento` (`id`, `idUsuario`, `nome`) VALUES
(3, 1, 'Dinheiro'),
(4, 1, 'Cartão de Crédito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(50) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `senha` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dataNascimento` date NOT NULL,
  `dataCadastro` date NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`email`, `nome`, `senha`, `status`, `dataNascimento`, `dataCadastro`, `id`) VALUES
('teste@teste.com', 'teste', 'e10adc3949ba59abbe56e057f20f883e', 1, '1994-08-02', '0000-00-00', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idfavorecido` (`idfavorecido`),
  ADD KEY `idformapagamento` (`idformapagamento`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `favorecidos`
--
ALTER TABLE `favorecidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favorecidos`
--
ALTER TABLE `favorecidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `despesas`
--
ALTER TABLE `despesas`
  ADD CONSTRAINT `despesas_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `despesas_ibfk_2` FOREIGN KEY (`idfavorecido`) REFERENCES `favorecidos` (`id`),
  ADD CONSTRAINT `despesas_ibfk_3` FOREIGN KEY (`idformapagamento`) REFERENCES `formapagamento` (`id`),
  ADD CONSTRAINT `despesas_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `favorecidos`
--
ALTER TABLE `favorecidos`
  ADD CONSTRAINT `favorecidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  ADD CONSTRAINT `formapagamento_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
