-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Abr-2024 às 21:01
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `notaaluno`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `Id` int(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Funcao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`Id`, `Nome`, `usuario`, `Senha`, `Funcao`) VALUES
(1, 'Manuel', 'manuelAdmin', '123', 'Admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `Funcao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`Id`, `Nome`, `turma_id`, `Senha`, `usuario`, `Funcao`) VALUES
(28, 'Manuel Fula', 15, '123', 'ALUNOS000001', 'Aluno'),
(29, 'Gerson Antó', 15, '123', 'ALUNOS000029', 'Aluno'),
(30, 'Dev', 15, '123', 'ALUNOS000030', 'Aluno'),
(31, 'Manuel Fula', 18, '123', 'ALUNOS000031', 'Aluno'),
(34, 'Manuel Fula', 21, '123', 'ALUNOS000032', 'Aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `Id` int(11) NOT NULL,
  `Curso` varchar(60) DEFAULT NULL,
  `Abreviacao` varchar(10) DEFAULT NULL,
  `Area` varchar(60) DEFAULT NULL,
  `Tipo` varchar(10) DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`Id`, `Curso`, `Abreviacao`, `Area`, `Tipo`, `descricao`) VALUES
(32, 'Informática De Gestão', 'IG', 'Gestão', 'Punível', NULL),
(33, 'PHP', 'PH', 'GG', 'Técnico', NULL),
(37, 'Mate-Física', 'MF', 'ggg', 'Selecione ', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `Id` int(255) NOT NULL,
  `Disciplina` varchar(255) NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `curso_id` int(255) NOT NULL,
  `id_professor` int(255) NOT NULL,
  `id_disciplina` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`Id`, `Disciplina`, `Descricao`, `curso_id`, `id_professor`, `id_disciplina`) VALUES
(15, 'Tecnologias', '', 32, 16, 0),
(16, 'iag', 'gg', 32, 17, 0),
(17, 'Sinf', '', 32, 18, 0),
(18, 'Matematica', 'gg', 35, 0, 0),
(19, 'Matematica', '', 37, 20, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas_alunos`
--

CREATE TABLE `notas_alunos` (
  `Id` int(255) NOT NULL,
  `id_disciplina` int(255) NOT NULL,
  `id_aluno` int(255) NOT NULL,
  `i_nota_um` varchar(30) NOT NULL,
  `i_nota_dois` varchar(30) NOT NULL,
  `i_nota_tres` varchar(30) NOT NULL,
  `ii_nota_um` varchar(30) NOT NULL,
  `ii_nota_dois` varchar(30) NOT NULL,
  `ii_nota_tres` varchar(30) NOT NULL,
  `iii_nota_um` varchar(30) NOT NULL,
  `iii_nota_dois` varchar(30) NOT NULL,
  `iii_nota_tres` varchar(30) NOT NULL,
  `i_media` varchar(255) NOT NULL,
  `ii_media` int(255) NOT NULL,
  `iii_media` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `Id` int(11) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `disciplina_id` int(255) NOT NULL,
  `turma_id` int(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Funcao` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`Id`, `professor`, `disciplina_id`, `turma_id`, `Senha`, `Funcao`, `usuario`) VALUES
(16, 'Manuel Manuel', 15, 0, '123', 'Professor', 'PROF000001'),
(17, 'isabel', 16, 0, '123', 'Professor', 'PROF000017'),
(18, 'Baptista', 17, 0, '123', 'Professor', 'PROF000018'),
(20, 'Gerson António', 19, 0, '123', 'Professor', 'PROF000019');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `Id` int(11) NOT NULL,
  `Curso_id` int(11) DEFAULT NULL,
  `classe` varchar(10) DEFAULT NULL,
  `turno` varchar(60) DEFAULT NULL,
  `sala` varchar(6) DEFAULT NULL,
  `ano` varchar(60) DEFAULT NULL,
  `turma` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`Id`, `Curso_id`, `classe`, `turno`, `sala`, `ano`, `turma`) VALUES
(16, 33, '10', 'Matinal', '1', 'gg', 'dd'),
(18, 32, '10', 'Matinal', '1', '22', 'ig'),
(20, 36, '10', 'Matinal', '1', '2024', 'MF10A'),
(21, 37, '10', 'Matinal', '1', '2024', 'MF10A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_acesso`
--

CREATE TABLE `turma_acesso` (
  `Id` int(255) NOT NULL,
  `id_turma` int(255) NOT NULL,
  `id_professor` int(255) NOT NULL,
  `disciplina_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma_acesso`
--

INSERT INTO `turma_acesso` (`Id`, `id_turma`, `id_professor`, `disciplina_id`) VALUES
(23, 15, 16, 15),
(24, 15, 16, 15),
(25, 16, 16, 15),
(31, 18, 17, 16),
(32, 21, 20, 19),
(33, 21, 17, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `Id` int(11) DEFAULT NULL,
  `Nome` varchar(60) DEFAULT NULL,
  `Utilizador` varchar(60) DEFAULT NULL,
  `Senha` varchar(240) DEFAULT NULL,
  `Funcao` varchar(20) DEFAULT NULL,
  `Turma` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`Id`, `Nome`, `Utilizador`, `Senha`, `Funcao`, `Turma`) VALUES
(1, 'ManuelFula', 'fula', '123', 'Admin', 'G12b'),
(2, 'Gerson', 'Gerson', '123', 'Aluno', 'gbf'),
(1, 'ManuelFula', 'fula', '123', 'Admin', 'G12b'),
(2, 'Gerson', 'Gerson', '123', 'Aluno', 'gbf'),
(1, 'Gersonzinho', 'Gzinho', '123', 'Secretaria', 'G12b'),
(2, 'Gerson', 'Gerson', NULL, 'Aluno', 'gbf');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `notas_alunos`
--
ALTER TABLE `notas_alunos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `turma_acesso`
--
ALTER TABLE `turma_acesso`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `notas_alunos`
--
ALTER TABLE `notas_alunos`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `turma_acesso`
--
ALTER TABLE `turma_acesso`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
