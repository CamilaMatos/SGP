-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Out-2023 às 03:07
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sgp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`) VALUES
(1, 'Bebidas'),
(2, 'Limpeza'),
(3, 'Tecnologia'),
(4, 'Elétrica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `centrocusto`
--

CREATE TABLE `centrocusto` (
  `idCentroCusto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `idStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `centrocusto`
--

INSERT INTO `centrocusto` (`idCentroCusto`, `nome`, `descricao`, `idStatus`) VALUES
(2, 'Administrativo', 'Escritórios', 1),
(3, 'Gerencia', 'Dono/Gerente', 2),
(8, 'Teste', 'Teste Conecta', 1),
(9, 'Teste', 'Teste Conecta', 1),
(10, 'Cozinha', 'Preparação', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada`
--

CREATE TABLE `entrada` (
  `idEntrada` int(11) NOT NULL,
  `idLote` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`idEntrada`, `idLote`, `idUsuario`, `data`) VALUES
(1, 1, 1, '2023-09-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `idEstoque` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `idStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`idEstoque`, `nome`, `descricao`, `idStatus`) VALUES
(1, 'Cozinha', 'Cozinha quente e de finalização', 1),
(2, 'Restaurante', 'Restaurante principal', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `idItem` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `unidadeMedia` float NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `idUnidadeMedida` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`idItem`, `nome`, `unidadeMedia`, `idCategoria`, `idMarca`, `idUnidadeMedida`, `idStatus`) VALUES
(1, 'Chocolate Quente', 1, 1, 1, 2, 1),
(2, 'Leite', 1, 1, 1, 2, 1),
(3, 'Detergente', 1, 2, 2, 2, 1),
(7, 'Arroz', 5, 1, 1, 1, 1),
(8, 'Veja Limpeza Profunda', 0.6, 1, 2, 1, 1),
(9, 'Veja Limpeza Profunda', 0.6, 1, 2, 1, 1),
(12, 'teste 1', 0.6, 3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenscompra`
--

CREATE TABLE `itenscompra` (
  `idSolicitacao` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensmovimentacao`
--

CREATE TABLE `itensmovimentacao` (
  `idSolicitacao` int(11) NOT NULL,
  `idLote` int(11) NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `itensmovimentacao`
--

INSERT INTO `itensmovimentacao` (`idSolicitacao`, `idLote`, `quantidade`) VALUES
(1, 7, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenssolicitacao`
--

CREATE TABLE `itenssolicitacao` (
  `idSolicitacao` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lote`
--

CREATE TABLE `lote` (
  `idLote` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `idEstoque` int(11) NOT NULL,
  `quantidadeInicial` float NOT NULL,
  `quantidadeAtual` float NOT NULL,
  `validade` date NOT NULL,
  `valorUnitario` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `lote`
--

INSERT INTO `lote` (`idLote`, `idItem`, `idEstoque`, `quantidadeInicial`, `quantidadeAtual`, `validade`, `valorUnitario`) VALUES
(1, 1, 1, 10, 7, '2023-11-10', 15),
(2, 2, 1, 10, 6, '2023-11-12', 15),
(3, 3, 1, 30, 21, '2023-11-12', 15),
(4, 1, 1, 1, 2, '2023-11-10', 15),
(5, 2, 1, 1, 1, '2023-11-12', 15),
(6, 3, 1, 1, 1, '2023-11-12', 15),
(7, 1, 2, 1, 2, '2023-11-10', 15),
(8, 2, 2, 1, 1, '2023-11-12', 15),
(9, 3, 2, 1, 1, '2023-11-12', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`idMarca`, `nome`) VALUES
(1, 'Nestle'),
(2, 'Ipê'),
(3, 'Dell');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `idMovimentacao` int(11) NOT NULL,
  `idSolicitacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacaomovimentacao`
--

CREATE TABLE `solicitacaomovimentacao` (
  `idSolicitacaoMovimentacao` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idCentroCusto` int(11) NOT NULL,
  `idEstoque` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `idSolicitante` int(11) NOT NULL,
  `data` date NOT NULL,
  `necessidade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `solicitacaomovimentacao`
--

INSERT INTO `solicitacaomovimentacao` (`idSolicitacaoMovimentacao`, `idTipo`, `idCentroCusto`, `idEstoque`, `idStatus`, `idSolicitante`, `data`, `necessidade`) VALUES
(1, 2, 2, 2, 1, 1, '2023-09-11', '2023-09-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`idStatus`, `nome`) VALUES
(1, 'Ativo'),
(2, 'Inativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`idTipo`, `nome`) VALUES
(1, 'Administrativo'),
(2, 'Requisição'),
(3, 'Transferência de estoque'),
(4, 'Perda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidademedida`
--

CREATE TABLE `unidademedida` (
  `idUnidadeMedida` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `unidademedida`
--

INSERT INTO `unidademedida` (`idUnidadeMedida`, `nome`, `descricao`) VALUES
(1, 'KG', 'Quilogramas '),
(2, 'L', 'Litros'),
(3, 'Un.', 'Unidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dataNasc` date NOT NULL,
  `documento` varchar(20) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `dataNasc`, `documento`, `idTipo`, `login`, `senha`) VALUES
(1, 'Camila Matos de Souza', '2002-10-19', '10503326950', 1, 'camila.matos', '$2y$10$4yN4FFsrlH5c6PRP6D0pfu9NfR6czLiQ6u9TzTm8inYuJ04qV/Nyu'),
(6, 'Alexis Lopes Filho', '2002-11-06', '09516372902', 1, 'aleque', '$2y$10$tyyvQWzlaAu8I83z38FYrO4VQa2.INCTTSMV8o0dAMpexBB9Tli1K'),
(7, 'Paola', '2003-04-01', '123123123', 1, 'hortaliça', '$2y$10$tUERUDhbEQirfdZVhBR/M.pnwCPw6ELTQJmnkZu//NA/nMZsKlGu2');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices para tabela `centrocusto`
--
ALTER TABLE `centrocusto`
  ADD PRIMARY KEY (`idCentroCusto`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Índices para tabela `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `idLote` (`idLote`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`idEstoque`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idMarca` (`idMarca`),
  ADD KEY `idUnidadeMedida` (`idUnidadeMedida`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Índices para tabela `itenscompra`
--
ALTER TABLE `itenscompra`
  ADD PRIMARY KEY (`idSolicitacao`,`idItem`),
  ADD KEY `idItem` (`idItem`);

--
-- Índices para tabela `itensmovimentacao`
--
ALTER TABLE `itensmovimentacao`
  ADD PRIMARY KEY (`idSolicitacao`,`idLote`),
  ADD KEY `idLote` (`idLote`);

--
-- Índices para tabela `itenssolicitacao`
--
ALTER TABLE `itenssolicitacao`
  ADD PRIMARY KEY (`idSolicitacao`,`idItem`),
  ADD KEY `idSolicitacao` (`idSolicitacao`),
  ADD KEY `idLote` (`idItem`);

--
-- Índices para tabela `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`idLote`),
  ADD KEY `idItem` (`idItem`),
  ADD KEY `idEstoque` (`idEstoque`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Índices para tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`idMovimentacao`),
  ADD KEY `idSolicitacao` (`idSolicitacao`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Índices para tabela `solicitacaomovimentacao`
--
ALTER TABLE `solicitacaomovimentacao`
  ADD PRIMARY KEY (`idSolicitacaoMovimentacao`),
  ADD KEY `idTipo` (`idTipo`),
  ADD KEY `idCentroCusto` (`idCentroCusto`),
  ADD KEY `idEstoque` (`idEstoque`),
  ADD KEY `idStatus` (`idStatus`),
  ADD KEY `idSolicitante` (`idSolicitante`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- Índices para tabela `unidademedida`
--
ALTER TABLE `unidademedida`
  ADD PRIMARY KEY (`idUnidadeMedida`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idTipo` (`idTipo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `centrocusto`
--
ALTER TABLE `centrocusto`
  MODIFY `idCentroCusto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `entrada`
--
ALTER TABLE `entrada`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `idEstoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `lote`
--
ALTER TABLE `lote`
  MODIFY `idLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `idMovimentacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacaomovimentacao`
--
ALTER TABLE `solicitacaomovimentacao`
  MODIFY `idSolicitacaoMovimentacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `unidademedida`
--
ALTER TABLE `unidademedida`
  MODIFY `idUnidadeMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `centrocusto`
--
ALTER TABLE `centrocusto`
  ADD CONSTRAINT `centrocusto_ibfk_1` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`);

--
-- Limitadores para a tabela `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`idLote`) REFERENCES `lote` (`idLote`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`);

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`),
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `item_ibfk_4` FOREIGN KEY (`idUnidadeMedida`) REFERENCES `unidademedida` (`idUnidadeMedida`);

--
-- Limitadores para a tabela `itenscompra`
--
ALTER TABLE `itenscompra`
  ADD CONSTRAINT `itenscompra_ibfk_1` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`);

--
-- Limitadores para a tabela `itensmovimentacao`
--
ALTER TABLE `itensmovimentacao`
  ADD CONSTRAINT `itensmovimentacao_ibfk_1` FOREIGN KEY (`idLote`) REFERENCES `lote` (`idLote`),
  ADD CONSTRAINT `itensmovimentacao_ibfk_2` FOREIGN KEY (`idSolicitacao`) REFERENCES `solicitacaomovimentacao` (`idSolicitacaoMovimentacao`);

--
-- Limitadores para a tabela `itenssolicitacao`
--
ALTER TABLE `itenssolicitacao`
  ADD CONSTRAINT `itenssolicitacao_ibfk_1` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`),
  ADD CONSTRAINT `itenssolicitacao_ibfk_2` FOREIGN KEY (`idSolicitacao`) REFERENCES `solicitacaomovimentacao` (`idSolicitacaoMovimentacao`);

--
-- Limitadores para a tabela `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`idEstoque`) REFERENCES `estoque` (`idEstoque`),
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`);

--
-- Limitadores para a tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`idSolicitacao`) REFERENCES `solicitacaomovimentacao` (`idSolicitacaoMovimentacao`),
  ADD CONSTRAINT `movimentacao_ibfk_2` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `movimentacao_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Limitadores para a tabela `solicitacaomovimentacao`
--
ALTER TABLE `solicitacaomovimentacao`
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_1` FOREIGN KEY (`idCentroCusto`) REFERENCES `centrocusto` (`idCentroCusto`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_2` FOREIGN KEY (`idEstoque`) REFERENCES `estoque` (`idEstoque`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_3` FOREIGN KEY (`idSolicitante`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_4` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_5` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
