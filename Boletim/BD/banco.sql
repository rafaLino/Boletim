-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Nov-2016 às 01:21
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `sigla` char(4) DEFAULT NULL,
  `nome` varchar(25) NOT NULL,
  `curso` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`id`, `sigla`, `nome`, `curso`) VALUES
(5, 'ddt', 'como derrotar destruidor ', 'kung fu'),
(6, 'nj', 'ninja', 'kung fu'),
(7, 'cm', 'combater o mal', 'kung fu'),
(8, 'dv', 'derrotar vilão I', 'ninja'),
(9, 'dv', 'derrotar vilão II', 'ninja');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(12) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `faltas` int(11) NOT NULL DEFAULT '0',
  `p1` float NOT NULL DEFAULT '0',
  `p2` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `notas`
--

INSERT INTO `notas` (`id`, `id_usuario`, `id_materia`, `faltas`, `p1`, `p2`) VALUES
(1, 'leonardo', 5, 2, 5, 7),
(2, 'donatelo', 6, 2, 5, 7),
(3, 'rafael', 5, 0, 0, 0),
(4, 'donatelo', 5, 0, 0, 0),
(5, 'michelangelo', 6, 0, 0, 0),
(6, 'rafael', 8, 0, 0, 0),
(7, 'michelangelo', 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `login` varchar(12) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `ativo` smallint(6) DEFAULT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`login`, `nome`, `email`, `tipo`, `ativo`, `senha`) VALUES
('admin', 'admin', 'admin@admin', 0, 1, 'admin'),
('donatelo', 'donatelo', 'donatelo@donatelo', 2, 1, '123'),
('leonardo', 'leonardo', 'leonardo@leonardo', 2, 1, 'leonardo'),
('michelangelo', 'michelangelo', 'michelangelo@michelangelo', 2, 1, '123'),
('rafael', 'rafael', 'rafael@rafael', 2, 1, 'rafael'),
('splinter', 'splinter', 'splinter@splinter', 1, 1, 'splinter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `indexemail` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`login`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
