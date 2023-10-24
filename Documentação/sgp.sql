-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Out-2023 às 03:41
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`) VALUES
(1, 'Bebidas'),
(2, 'Limpeza'),
(3, 'Tecnologia'),
(4, 'Teste Conecta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `centrocusto`
--

CREATE TABLE `centrocusto` (
  `idCentroCusto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `idStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `centrocusto`
--

INSERT INTO `centrocusto` (`idCentroCusto`, `nome`, `descricao`, `idStatus`) VALUES
(2, 'Administrativo', 'Escritórios', 1),
(3, 'Gerencia', 'Dono/Gerente', 2),
(8, 'Teste', 'Teste Conecta', 1),
(9, 'Teste', 'Teste Conecta', 1),
(10, 'Teste Conecta', 'Teste Conecta', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada`
--

CREATE TABLE `entrada` (
  `idEntrada` int(11) NOT NULL,
  `idLote` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`idItem`, `nome`, `unidadeMedia`, `idCategoria`, `idMarca`, `idUnidadeMedida`, `idStatus`) VALUES
(1, 'Chocolate Quente', 1, 1, 1, 2, 1),
(2, 'Leite', 1, 1, 1, 2, 1),
(3, 'Detergente', 1, 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenscompra`
--

CREATE TABLE `itenscompra` (
  `idSolicitacao` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensmovimentacao`
--

CREATE TABLE `itensmovimentacao` (
  `idSolicitacao` int(11) NOT NULL,
  `idLote` int(11) NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lote`
--

INSERT INTO `lote` (`idLote`, `idItem`, `idEstoque`, `quantidadeInicial`, `quantidadeAtual`, `validade`, `valorUnitario`) VALUES
(1, 1, 1, 10, 7, '2023-11-10', '15'),
(2, 2, 1, 10, 6, '2023-11-12', '15'),
(3, 3, 1, 30, 21, '2023-11-12', '15'),
(4, 1, 1, 1, 2, '2023-11-10', '15'),
(5, 2, 1, 1, 1, '2023-11-12', '15'),
(6, 3, 1, 1, 1, '2023-11-12', '15'),
(7, 1, 2, 1, 2, '2023-11-10', '15'),
(8, 2, 2, 1, 1, '2023-11-12', '15'),
(9, 3, 2, 1, 1, '2023-11-12', '15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemparametrizacao`
--

CREATE TABLE `ordemparametrizacao` (
  `idReceita` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  `idUnidadeMedida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordemparametrizacao`
--

INSERT INTO `ordemparametrizacao` (`idReceita`, `idItem`, `quantidade`, `idUnidadeMedida`) VALUES
(2, 1, 3, 1),
(2, 2, 9, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemservico`
--

CREATE TABLE `ordemservico` (
  `idOrdemServico` int(11) NOT NULL,
  `idReceita` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `entrega` date NOT NULL,
  `rendimentoEsperado` float NOT NULL,
  `rendimentoReal` float DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `idStatus` int(11) NOT NULL,
  `horarioInicio` time DEFAULT NULL,
  `horarioFim` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordemservico`
--

INSERT INTO `ordemservico` (`idOrdemServico`, `idReceita`, `idUsuario`, `entrega`, `rendimentoEsperado`, `rendimentoReal`, `observacao`, `idStatus`, `horarioInicio`, `horarioFim`) VALUES
(27, 2, 1, '2023-11-10', 2000, NULL, NULL, 1, NULL, NULL),
(28, 2, 1, '2023-11-10', 2000, NULL, NULL, 1, NULL, NULL),
(29, 2, 1, '2023-11-10', 500, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitaparametrizacao`
--

CREATE TABLE `receitaparametrizacao` (
  `idReceita` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `tempo` time DEFAULT NULL,
  `modo` varchar(300) DEFAULT NULL,
  `rendimento` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receitaparametrizacao`
--

INSERT INTO `receitaparametrizacao` (`idReceita`, `nome`, `idCategoria`, `tempo`, `modo`, `rendimento`) VALUES
(2, 'Teste', 1, '01:00:00', NULL, 1000),
(3, 'Teste 2', 1, '01:00:00', NULL, NULL),
(4, 'Teste 2', 1, '01:00:00', NULL, NULL),
(5, 'Teste 2', 1, '01:00:00', NULL, NULL),
(6, 'Teste 2', 1, '01:00:00', NULL, NULL),
(7, 'Teste 2', 1, '01:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitaservico`
--

CREATE TABLE `receitaservico` (
  `idOrdemServico` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantidadeCalculada` float NOT NULL,
  `quantidadeRealizada` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receitaservico`
--

INSERT INTO `receitaservico` (`idOrdemServico`, `idItem`, `quantidadeCalculada`, `quantidadeRealizada`) VALUES
(28, 1, 6, NULL),
(28, 2, 18, NULL),
(29, 1, 1.5, NULL),
(29, 2, 4.5, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacaomovimentacao`
--

CREATE TABLE `solicitacaomovimentacao` (
  `idSolicitacaoMovimentacao` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idCentroCusto` int(11) NOT NULL,
  `idEstoque` int(11) NOT NULL,
  `idOrdem` int(11) DEFAULT NULL,
  `idStatus` int(11) NOT NULL,
  `idSolicitante` int(11) NOT NULL,
  `data` date NOT NULL,
  `necessidade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `solicitacaomovimentacao`
--

INSERT INTO `solicitacaomovimentacao` (`idSolicitacaoMovimentacao`, `idTipo`, `idCentroCusto`, `idEstoque`, `idOrdem`, `idStatus`, `idSolicitante`, `data`, `necessidade`) VALUES
(1, 2, 2, 2, NULL, 1, 1, '2023-09-11', '2023-09-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`idTipo`, `nome`) VALUES
(1, 'Administrativo'),
(2, 'Requisição'),
(3, 'Transferência de estoque'),
(4, 'Perda'),
(5, 'Ordem de Serviço');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidademedida`
--

CREATE TABLE `unidademedida` (
  `idUnidadeMedida` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `unidademedida`
--

INSERT INTO `unidademedida` (`idUnidadeMedida`, `nome`, `descricao`) VALUES
(1, 'KG', 'Quilogramas '),
(2, 'L', 'Litros');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `dataNasc`, `documento`, `idTipo`, `login`, `senha`) VALUES
(1, 'Camila Matos de Souza', '2002-10-19', '10503326950', 1, 'camila.matos', '123'),
(2, 'Camila Matos de Souza', '2002-10-19', '10503326950', 1, 'camila.matos', '$2y$10$Fh0W13sW6dfjry187nkK4.NyGavNZQEfe1m9M7bE6KSuJ2QTOkQXy');

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
-- Índices para tabela `ordemparametrizacao`
--
ALTER TABLE `ordemparametrizacao`
  ADD PRIMARY KEY (`idReceita`,`idItem`),
  ADD KEY `idItem` (`idItem`),
  ADD KEY `idUnidadeMedida` (`idUnidadeMedida`);

--
-- Índices para tabela `ordemservico`
--
ALTER TABLE `ordemservico`
  ADD PRIMARY KEY (`idOrdemServico`),
  ADD KEY `idReceita` (`idReceita`),
  ADD KEY `idStatus` (`idStatus`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `receitaparametrizacao`
--
ALTER TABLE `receitaparametrizacao`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Índices para tabela `receitaservico`
--
ALTER TABLE `receitaservico`
  ADD PRIMARY KEY (`idOrdemServico`,`idItem`),
  ADD KEY `idItem` (`idItem`);

--
-- Índices para tabela `solicitacaomovimentacao`
--
ALTER TABLE `solicitacaomovimentacao`
  ADD PRIMARY KEY (`idSolicitacaoMovimentacao`),
  ADD KEY `idTipo` (`idTipo`),
  ADD KEY `idCentroCusto` (`idCentroCusto`),
  ADD KEY `idEstoque` (`idEstoque`),
  ADD KEY `idStatus` (`idStatus`),
  ADD KEY `idSolicitante` (`idSolicitante`),
  ADD KEY `idOrdem` (`idOrdem`);

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
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de tabela `ordemservico`
--
ALTER TABLE `ordemservico`
  MODIFY `idOrdemServico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `receitaparametrizacao`
--
ALTER TABLE `receitaparametrizacao`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `unidademedida`
--
ALTER TABLE `unidademedida`
  MODIFY `idUnidadeMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Limitadores para a tabela `ordemparametrizacao`
--
ALTER TABLE `ordemparametrizacao`
  ADD CONSTRAINT `ordemparametrizacao_ibfk_1` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`),
  ADD CONSTRAINT `ordemparametrizacao_ibfk_2` FOREIGN KEY (`idReceita`) REFERENCES `receitaparametrizacao` (`idReceita`),
  ADD CONSTRAINT `ordemparametrizacao_ibfk_3` FOREIGN KEY (`idUnidadeMedida`) REFERENCES `unidademedida` (`idUnidadeMedida`);

--
-- Limitadores para a tabela `ordemservico`
--
ALTER TABLE `ordemservico`
  ADD CONSTRAINT `ordemservico_ibfk_1` FOREIGN KEY (`idReceita`) REFERENCES `receitaparametrizacao` (`idReceita`),
  ADD CONSTRAINT `ordemservico_ibfk_2` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `ordemservico_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Limitadores para a tabela `receitaparametrizacao`
--
ALTER TABLE `receitaparametrizacao`
  ADD CONSTRAINT `receitaparametrizacao_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Limitadores para a tabela `receitaservico`
--
ALTER TABLE `receitaservico`
  ADD CONSTRAINT `receitaservico_ibfk_1` FOREIGN KEY (`idOrdemServico`) REFERENCES `ordemservico` (`idOrdemServico`),
  ADD CONSTRAINT `receitaservico_ibfk_2` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`);

--
-- Limitadores para a tabela `solicitacaomovimentacao`
--
ALTER TABLE `solicitacaomovimentacao`
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_1` FOREIGN KEY (`idCentroCusto`) REFERENCES `centrocusto` (`idCentroCusto`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_2` FOREIGN KEY (`idEstoque`) REFERENCES `estoque` (`idEstoque`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_3` FOREIGN KEY (`idSolicitante`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_4` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_5` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`),
  ADD CONSTRAINT `solicitacaomovimentacao_ibfk_6` FOREIGN KEY (`idOrdem`) REFERENCES `ordemservico` (`idOrdemServico`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
