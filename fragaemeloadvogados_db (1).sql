-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/09/2023 às 14:37
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fragaemeloadvogados_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nomecliente` varchar(45) DEFAULT NULL,
  `tipodocumento` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `datanascimento` varchar(45) DEFAULT NULL,
  `datafundacao` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `tipoempresa` varchar(45) DEFAULT NULL,
  `estadocivil` varchar(45) DEFAULT NULL,
  `atividade` varchar(45) DEFAULT NULL,
  `profissao` varchar(45) DEFAULT NULL,
  `inscricao` varchar(45) DEFAULT NULL,
  `nacionalidade` varchar(45) DEFAULT NULL,
  `observacao` varchar(45) DEFAULT NULL,
  `email1` varchar(45) DEFAULT NULL,
  `email2` varchar(45) DEFAULT NULL,
  `email3` varchar(45) DEFAULT NULL,
  `tipocontato1` varchar(45) DEFAULT NULL,
  `ddi1` varchar(45) DEFAULT NULL,
  `ddd1` varchar(45) DEFAULT NULL,
  `numero1` varchar(45) DEFAULT NULL,
  `tipocontato2` varchar(45) DEFAULT NULL,
  `ddi2` varchar(45) DEFAULT NULL,
  `ddd2` varchar(45) DEFAULT NULL,
  `numero2` varchar(45) DEFAULT NULL,
  `tipocontato3` varchar(45) DEFAULT NULL,
  `ddi3` varchar(45) DEFAULT NULL,
  `ddd3` varchar(45) DEFAULT NULL,
  `numero3` varchar(45) DEFAULT NULL,
  `cep1` varchar(45) DEFAULT NULL,
  `endereco1` varchar(45) DEFAULT NULL,
  `numerocasa1` varchar(45) DEFAULT NULL,
  `complemento1` varchar(45) DEFAULT NULL,
  `bairro1` varchar(45) DEFAULT NULL,
  `cidade1` varchar(45) DEFAULT NULL,
  `estado1` varchar(45) DEFAULT NULL,
  `cep2` varchar(45) DEFAULT NULL,
  `endereco2` varchar(45) DEFAULT NULL,
  `numerocasa2` varchar(45) DEFAULT NULL,
  `complemento2` varchar(45) DEFAULT NULL,
  `bairro2` varchar(45) DEFAULT NULL,
  `cidade2` varchar(45) DEFAULT NULL,
  `estado2` varchar(45) DEFAULT NULL,
  `login` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nomecliente`, `tipodocumento`, `cpf`, `cnpj`, `sexo`, `responsavel`, `datanascimento`, `datafundacao`, `rg`, `tipoempresa`, `estadocivil`, `atividade`, `profissao`, `inscricao`, `nacionalidade`, `observacao`, `email1`, `email2`, `email3`, `tipocontato1`, `ddi1`, `ddd1`, `numero1`, `tipocontato2`, `ddi2`, `ddd2`, `numero2`, `tipocontato3`, `ddi3`, `ddd3`, `numero3`, `cep1`, `endereco1`, `numerocasa1`, `complemento1`, `bairro1`, `cidade1`, `estado1`, `cep2`, `endereco2`, `numerocasa2`, `complemento2`, `bairro2`, `cidade2`, `estado2`, `login`, `senha`) VALUES
(43, 'Ciacoop', 'CNPJ', '', '02.423.295/0001-34', 'Masculino', 'Rodrigo Franz Rodrigues ', '', '1998-03-19', '', 'Cooperativa', 'Solteiro(a)', 'Seleção e agenciamento de mão-de-obra', '', 'Não definido', 'brasileiro', 'COOPERATIVA DE TRABALHO DOS PROFISSIONAIS DE ', 'RODRIGO.FRANZ@PRAXISPRO.COM.BR', '', '', 'Telefone', '51', '51', '80558388', 'Telefone', '', '', '', 'Telefone', '', '', '', '90001970', '', '760', '2 Andar  - Centro', 'Centro Histórico', 'Porto Alegre', 'RS', '', '', '', '', '', '', '', 'Ciacoop', 'Ciacoop');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compromisso`
--

CREATE TABLE `compromisso` (
  `id` int(11) NOT NULL,
  `datainicial` varchar(45) DEFAULT NULL,
  `horainicial` varchar(45) DEFAULT NULL,
  `datafinal` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `nomecompromisso` varchar(45) DEFAULT NULL,
  `classificacao` varchar(45) DEFAULT NULL,
  `processo` varchar(45) DEFAULT NULL,
  `locall` varchar(45) DEFAULT NULL,
  `observacoes` varchar(45) DEFAULT NULL,
  `nomeadvogado` varchar(45) DEFAULT NULL,
  `cliente` varchar(45) DEFAULT NULL,
  `mes` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `despesa`
--

CREATE TABLE `despesa` (
  `id` int(11) NOT NULL,
  `datavencimento` varchar(45) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `categoria2` varchar(45) DEFAULT NULL,
  `subcategoria` varchar(45) DEFAULT NULL,
  `subcategoria2` varchar(45) DEFAULT NULL,
  `observacao` varchar(45) DEFAULT NULL,
  `situacao` varchar(45) DEFAULT NULL,
  `datapagamento` varchar(45) DEFAULT NULL,
  `juros` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `repetir` varchar(45) DEFAULT NULL,
  `parcelas` varchar(45) DEFAULT NULL,
  `datacriacao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prazo`
--

CREATE TABLE `prazo` (
  `id` int(11) NOT NULL,
  `datafinal` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `processo` varchar(45) DEFAULT NULL,
  `atendido` varchar(45) DEFAULT NULL,
  `advogado` varchar(45) DEFAULT NULL,
  `cliente` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `processo`
--

CREATE TABLE `processo` (
  `id` int(11) NOT NULL,
  `valorHonorario` varchar(45) DEFAULT NULL,
  `parcelas` varchar(45) DEFAULT NULL,
  `cadreceita` varchar(45) DEFAULT NULL,
  `stat` varchar(45) DEFAULT NULL,
  `privado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `posicaocliente` varchar(45) DEFAULT NULL,
  `observacoes` varchar(150) DEFAULT NULL,
  `nomecliente` varchar(45) DEFAULT NULL,
  `nomeadvogado` varchar(45) DEFAULT NULL,
  `segundoAdvogado` varchar(45) DEFAULT NULL,
  `terceiroAdvogado` varchar(45) DEFAULT NULL,
  `natureza` varchar(45) DEFAULT NULL,
  `ritoProcesso` varchar(45) DEFAULT NULL,
  `nprocesso` varchar(45) DEFAULT NULL,
  `poderjudiciario` varchar(55) DEFAULT NULL,
  `numerovara` varchar(45) DEFAULT NULL,
  `nomedavara` varchar(45) DEFAULT NULL,
  `nomedacomarca` varchar(45) DEFAULT NULL,
  `valorDivida` varchar(45) DEFAULT NULL,
  `valorCausa` varchar(45) DEFAULT NULL,
  `fase` varchar(45) DEFAULT NULL,
  `dataa` date DEFAULT NULL,
  `classe` varchar(45) DEFAULT NULL,
  `falecido` varchar(45) DEFAULT NULL,
  `mes` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `cliente1` varchar(45) DEFAULT NULL,
  `cliente2` varchar(45) DEFAULT NULL,
  `vencimento` varchar(45) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `categoria1` varchar(45) DEFAULT NULL,
  `categoria2` varchar(45) DEFAULT NULL,
  `subcategoria1` varchar(45) DEFAULT NULL,
  `subcategoria2` varchar(45) DEFAULT NULL,
  `observacoes` varchar(45) DEFAULT NULL,
  `statuss` varchar(45) DEFAULT NULL,
  `recebimentodata` varchar(45) DEFAULT NULL,
  `juros` varchar(45) DEFAULT NULL,
  `multa` varchar(45) DEFAULT NULL,
  `datacriacao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `receita`
--

INSERT INTO `receita` (`id`, `cliente1`, `cliente2`, `vencimento`, `valor`, `categoria1`, `categoria2`, `subcategoria1`, `subcategoria2`, `observacoes`, `statuss`, `recebimentodata`, `juros`, `multa`, `datacriacao`) VALUES
(30123, 'Luiz Thiago Evaristo da Silva', '', '2023-08-02', 'R$ 1340,00', 'Recebimentos', '', 'Pensão alimentícia', '', 'Nada a declarar', 'Recebido', '2023-08-02', '100', '200', '02/08/2023'),
(30124, 'Henrique Ferreira da Silva', '', '2023-08-04', 'R$ 1400,00', 'Recebimentos', '', 'Pensão alimentícia', '', 'Nada', 'Recebido', '2023-08-02', '1200', '200', '02/08/2023'),
(30126, 'Vitor Hugo Seron de Fraga', '', '2023-08-31', 'R$ 1900,00', 'Recebimentos', '', 'Transferência', '', 'Nada a declarar', 'Recebido', '2023-08-29', '100', '0', '01/09/2023');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL,
  `tipotarefa` varchar(45) DEFAULT NULL,
  `advogado` varchar(45) DEFAULT NULL,
  `prazo` varchar(45) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `tarefa` varchar(150) DEFAULT NULL,
  `stat` varchar(45) DEFAULT NULL,
  `datacriacao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `funcao` varchar(45) DEFAULT NULL,
  `oab` varchar(45) DEFAULT NULL,
  `estadooab` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `datanascimento` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `estadocivil` varchar(45) DEFAULT NULL,
  `profissao` varchar(45) DEFAULT NULL,
  `observacoes` varchar(45) DEFAULT NULL,
  `email1` varchar(45) DEFAULT NULL,
  `email2` varchar(45) DEFAULT NULL,
  `email3` varchar(45) DEFAULT NULL,
  `telefone1` varchar(45) DEFAULT NULL,
  `numero1` varchar(45) DEFAULT NULL,
  `tipocontato1` varchar(45) DEFAULT NULL,
  `ddi1` varchar(45) DEFAULT NULL,
  `ddd1` varchar(45) DEFAULT NULL,
  `telefone2` varchar(45) DEFAULT NULL,
  `numero2` varchar(45) DEFAULT NULL,
  `tipocontato2` varchar(45) DEFAULT NULL,
  `ddi2` varchar(45) DEFAULT NULL,
  `ddd2` varchar(45) DEFAULT NULL,
  `telefone3` varchar(45) DEFAULT NULL,
  `numero3` varchar(45) DEFAULT NULL,
  `tipocontato3` varchar(45) DEFAULT NULL,
  `ddi3` varchar(45) DEFAULT NULL,
  `ddd3` varchar(45) DEFAULT NULL,
  `cep1` varchar(45) DEFAULT NULL,
  `endereco1` varchar(45) DEFAULT NULL,
  `numerocasa1` varchar(45) DEFAULT NULL,
  `complemento1` varchar(45) DEFAULT NULL,
  `bairro1` varchar(45) DEFAULT NULL,
  `cidade1` varchar(45) DEFAULT NULL,
  `estado1` varchar(45) DEFAULT NULL,
  `cep2` varchar(45) DEFAULT NULL,
  `endereco2` varchar(45) DEFAULT NULL,
  `numerocasa2` varchar(45) DEFAULT NULL,
  `complemento2` varchar(45) DEFAULT NULL,
  `bairro2` varchar(45) DEFAULT NULL,
  `cidade2` varchar(45) DEFAULT NULL,
  `estado2` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `usuario`, `senha`, `funcao`, `oab`, `estadooab`, `cpf`, `sexo`, `datanascimento`, `rg`, `estadocivil`, `profissao`, `observacoes`, `email1`, `email2`, `email3`, `telefone1`, `numero1`, `tipocontato1`, `ddi1`, `ddd1`, `telefone2`, `numero2`, `tipocontato2`, `ddi2`, `ddd2`, `telefone3`, `numero3`, `tipocontato3`, `ddi3`, `ddd3`, `cep1`, `endereco1`, `numerocasa1`, `complemento1`, `bairro1`, `cidade1`, `estado1`, `cep2`, `endereco2`, `numerocasa2`, `complemento2`, `bairro2`, `cidade2`, `estado2`, `status`) VALUES
(16, 'Sandro Carvalho de Fraga', 'sandro@fragaemeloadvogados.adv.br', '31121998vi', 'Advogado', 'OAB/RS 52.230', 'Selecione', '606.580.290-53', 'Masculino', '1970-06-16', '', 'Casado(a)', 'Advogado', 'Advogado escritório Advocacia Fraga e Melo Ad', 'sandro@fragaemeloadvogados.adv.br', '', '', '(51)984026629', '984026629', 'Telefone', '55', '51', '()', '', 'Telefone', '', '', '()', '', 'Telefone', '', '', '88955-000', 'Rua Maçarico Esquina com Perdizes', '292', '1 Quadra do mar', 'Village Dunas', 'Balneário Gaivota', 'SC', '', '', '', '', '', '', 'Selecione', 'Ativo'),
(17, 'Elisete Camargo de Melo', 'elisete@fragaemeloadvogados.adv.br', '07122012', 'Advogado', 'OAB/SC 65356-B', 'SC', '773.478.348-34', 'Feminino', '1980-07-21', '23.672.306-27', 'Casado(a)', 'Advogada', 'Nada a declarar', 'elisete@fragaemeloadvogados.adv.br', '', '', '(51)994156949', '994156949', 'Telefone', '55', '51', '()', '', 'Telefone', '', '', '()', '', 'Telefone', '', '', '88955000', 'Rua Maçarico Esquina com Perdizes', '292', '1 Quadra do mar', 'Village Dunas', 'Balneário Gaivota', 'SC', '', '', '', '', '', '', 'Selecione', 'Ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `compromisso`
--
ALTER TABLE `compromisso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `despesa`
--
ALTER TABLE `despesa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `prazo`
--
ALTER TABLE `prazo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `processo`
--
ALTER TABLE `processo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `compromisso`
--
ALTER TABLE `compromisso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1302;

--
-- AUTO_INCREMENT de tabela `despesa`
--
ALTER TABLE `despesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `prazo`
--
ALTER TABLE `prazo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `processo`
--
ALTER TABLE `processo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30127;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
