-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Out-2020 às 20:00
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_simpleshotel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `data` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`id`, `descricao`, `tipo`, `data`) VALUES
(40, 'Joana Maria foi atualizado!', 'Atualizado', '10-10-2020 04:58:00'),
(41, 'Wagner Ramos Lima foi atualizado!', 'Atualizado', '10-10-2020 15:34:10'),
(42, 'Wagner Ramos foi atualizado!', 'Atualizado', '12-10-2020 14:51:12'),
(43, 'O nome foi atualiza de (Wagner Ramos Lima), para (Wagner Ramos)', 'Atualizado', '12-10-2020 15:28:36'),
(44, 'O email foi atualiza de (wagnerramosl@yahoo.com), para (wagnerramosl@yahoo.com.br)', 'Atualizado', '12-10-2020 15:29:44'),
(45, 'O email foi atualiza de (wagnerramosl@yahoo.com.br), para (wagnerramosl@yahoo.com)', 'Atualizado', '12-10-2020 15:31:36'),
(46, 'O nome foi atualiza de (Mariana Lucia Maria), para (Mariana Lucia)', 'Atualizado', '12-10-2020 15:36:43'),
(47, 'O email foi atualiza de (wagnerramosl@yahoo.com), para (wagnerramosl@yahoo.com.br)', 'Atualizado', '12-10-2020 15:36:55'),
(48, 'O email foi atualiza de (joana@hotmail.com.br), para (joana@hotmail.com) e \n			o nome foi atualiza de (Joana), para (Joana Maria)', 'Atualizado', '12-10-2020 15:37:10'),
(49, 'O email foi atualiza de (wagnerramosl@yahoo.com.br), para (wagnerramosl@yahoo.com) e \n			o nome foi atualiza de (Wagner Ramos Lima), para (Wagner)', 'Atualizado', '12-10-2020 15:43:56'),
(50, 'Guilherme foi excluido!', 'Deletado', '2020-10-12 15:44:52'),
(51, 'O email foi atualiza de (wagnerramosl@yahoo.com), para (wagnerramosl@yahoo.com.br)', 'Atualizado', '12-10-2020 15:48:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `data_cadastro` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `data_cadastro`) VALUES
(24, 'Wagner', 'wagnerramosl@yahoo.com.br', '09-10-2020'),
(25, 'Mariana Lucia', 'maria@hotmail.com.br', '09-10-2020'),
(26, 'Joana Maria', 'joana@hotmail.com', '10-10-2020');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
