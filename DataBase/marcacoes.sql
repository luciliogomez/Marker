-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 28/12/2021 às 20:20
-- Versão do servidor: 10.4.19-MariaDB
-- Versão do PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `marcacoes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estudantes`
--

CREATE TABLE `estudantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_de_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `estudantes`
--

INSERT INTO `estudantes` (`id`, `nome`, `email`, `data_de_nascimento`) VALUES
(1, 'Lucílio Gomes', 'luciliodetales@gmail.com', '1999-06-01'),
(2, 'Eliúde Carvalho', 'eliude@gmail.com', '2000-02-21'),
(3, 'Pedro Domingos', 'pedro@gmail.com', '1998-06-01'),
(4, 'Ludmilo Cambambi', 'ludmilo@gmail.com', '1998-10-01'),
(5, 'Edson Chauvunge', 'edson@gmail.com', '1999-03-29'),
(6, 'Yuri Rego', 'yuri@gmail.com', '1999-12-31'),
(7, 'Rogerio Tuzolana', 'rogerio@gmail.com', '2000-04-24'),
(8, 'Isabel José', 'isabels@gmail.com', '2001-02-10'),
(9, 'Lussevádio Manuel', 'lussevadio@gmail.com', '1997-09-10'),
(10, 'Julio Manuel', 'julio@gmail.com', '2000-05-01'),
(11, 'Jacinto Malungo', 'jacinto@gmail.com', '1996-07-07'),
(12, 'Fátima Daniel', 'fatima@gmail.com', '1999-03-01'),
(13, 'Elizabeth Cristina', 'elizabeth@gmail.com', '2000-08-01'),
(14, 'Lando Garcia', 'lando@gmail.com', '0000-00-00'),
(15, 'Victor Daniel', 'victor@gmail.com', '1999-01-08'),
(16, 'Joana Cassinda', 'joana@gmail.com', '1999-05-12'),
(17, 'Joana Cassinda', 'joana@gmail.com', '0000-00-00'),
(18, 'Lucilio Gomes', 'lucilio@gmail.com', '2021-12-01'),
(19, 'Lucilio Gomes', 'lucilio@gmail.com', '2021-12-02'),
(20, 'Mario', 'lucilio@gmail.com', '2021-12-02'),
(21, 'Emanuel Carvalho', 'emanuel@gmail.com', '2021-08-03'),
(22, 'Godofredo Costa', 'godo@gmail.com', '2007-02-07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estudante_na_turma`
--

CREATE TABLE `estudante_na_turma` (
  `id` int(11) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `estudante_na_turma`
--

INSERT INTO `estudante_na_turma` (`id`, `id_estudante`, `id_turma`) VALUES
(10, 8, 2),
(11, 10, 2),
(12, 11, 2),
(13, 12, 2),
(14, 13, 2),
(17, 16, 11),
(23, 2, 11),
(24, 3, 11),
(25, 5, 11),
(26, 1, 11),
(27, 6, 14),
(28, 13, 14),
(29, 22, 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcacao_estudante`
--

CREATE TABLE `marcacao_estudante` (
  `id` int(11) NOT NULL,
  `id_marcacao` int(11) NOT NULL,
  `id_estudante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `marcacao_estudante`
--

INSERT INTO `marcacao_estudante` (`id`, `id_marcacao`, `id_estudante`) VALUES
(1, 1, 8),
(2, 2, 10),
(3, 3, 11),
(4, 4, 12),
(5, 5, 13),
(6, 6, 16),
(7, 7, 3),
(8, 8, 13),
(9, 9, 22),
(10, 10, 12),
(11, 11, 3),
(12, 12, 2),
(13, 13, 16),
(14, 14, 13),
(15, 15, 6),
(16, 16, 8),
(17, 17, 12),
(18, 18, 11),
(19, 19, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcacoes`
--

CREATE TABLE `marcacoes` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `id_turma` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `marcacoes`
--

INSERT INTO `marcacoes` (`id`, `data`, `id_turma`, `estado`) VALUES
(1, '2021-12-27', 2, 1),
(2, '2021-12-27', 2, 0),
(3, '2021-12-27', 2, 1),
(4, '2021-12-27', 2, 0),
(5, '2021-12-27', 2, 1),
(6, '2021-12-27', 11, 1),
(7, '2021-12-27', 11, 0),
(8, '2021-12-27', 14, 1),
(9, '2021-12-27', 11, 1),
(10, '2021-12-26', 2, 0),
(11, '2021-12-28', 11, 0),
(12, '2021-12-28', 11, 1),
(13, '2021-12-28', 11, 0),
(14, '2021-12-28', 14, 1),
(15, '2021-12-28', 14, 0),
(16, '2021-12-28', 2, 0),
(17, '2021-12-28', 2, 0),
(18, '2021-12-28', 2, 0),
(19, '2021-12-28', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id`, `descricao`, `id_user`) VALUES
(2, 'CC_POO', 2),
(11, 'CC-AC', 1),
(14, 'CC-FBD', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `acess` varchar(10) NOT NULL DEFAULT 'docente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `name`, `email`, `password`, `acess`) VALUES
(1, 'Lucílio Gomes', 'lucilio@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'docente'),
(2, 'Lufialuizo Sampaio', 'sampaio@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'docente'),
(3, 'Amândio Almada', 'amandio@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'docente'),
(4, 'Vicente Lopes', 'vicente@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'docente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estudantes`
--
ALTER TABLE `estudantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `estudante_na_turma`
--
ALTER TABLE `estudante_na_turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudante` (`id_estudante`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `marcacao_estudante`
--
ALTER TABLE `marcacao_estudante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marcacao` (`id_marcacao`);

--
-- Índices de tabela `marcacoes`
--
ALTER TABLE `marcacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estudantes`
--
ALTER TABLE `estudantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `estudante_na_turma`
--
ALTER TABLE `estudante_na_turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `marcacao_estudante`
--
ALTER TABLE `marcacao_estudante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `marcacoes`
--
ALTER TABLE `marcacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `estudante_na_turma`
--
ALTER TABLE `estudante_na_turma`
  ADD CONSTRAINT `estudante_na_turma_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `estudantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudante_na_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `marcacao_estudante`
--
ALTER TABLE `marcacao_estudante`
  ADD CONSTRAINT `marcacao_estudante_ibfk_1` FOREIGN KEY (`id_marcacao`) REFERENCES `marcacoes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `marcacoes`
--
ALTER TABLE `marcacoes`
  ADD CONSTRAINT `marcacoes_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
