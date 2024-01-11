-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2023 às 07:24
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `snoopy`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `raca` varchar(255) NOT NULL,
  `teldono` char(11) NOT NULL,
  `datacadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`id`, `nome`, `raca`, `teldono`, `datacadastro`) VALUES
(1, 'Mel', 'Labrador', '3340-5961', '2023-11-01 00:00:00'),
(2, 'Bella', 'Golden Retriever', '3355-7890', '2023-11-02 00:00:00'),
(3, 'Max', 'Poodle', '3388-1234', '2023-11-03 00:00:00'),
(4, 'Luna', 'Bulldog', '3301-5678', '2023-11-04 00:00:00'),
(5, 'Charlie', 'Beagle', '3312-9876', '2023-11-05 00:00:00'),
(6, 'Coco', 'Dachshund', '3323-1122', '2023-11-06 00:00:00'),
(7, 'Rocky', 'Boxer', '3334-3344', '2023-11-07 00:00:00'),
(8, 'Mia', 'Shih Tzu', '3366-5566', '2023-11-08 00:00:00'),
(9, 'Oliver', 'Husky', '3399-7788', '2023-11-09 00:00:00'),
(10, 'Lucy', 'Chihuahua', '3344-0011', '2023-11-10 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atende`
--

CREATE TABLE `atende` (
  `id` int(11) NOT NULL,
  `idfuncionario` int(11) NOT NULL,
  `idanimal` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atende`
--

INSERT INTO `atende` (`id`, `idfuncionario`, `idanimal`, `data`) VALUES
(1, 1, 1, '2023-11-01 00:00:00'),
(2, 2, 2, '2023-11-02 00:00:00'),
(3, 3, 3, '2023-11-03 00:00:00'),
(4, 4, 4, '2023-11-04 00:00:00'),
(5, 5, 5, '2023-11-05 00:00:00'),
(6, 6, 6, '2023-11-06 00:00:00'),
(7, 7, 7, '2023-11-07 00:00:00'),
(8, 8, 8, '2023-11-08 00:00:00'),
(9, 9, 9, '2023-11-09 00:00:00'),
(10, 10, 10, '2023-11-10 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `datacadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `email`, `datacadastro`) VALUES
(1, 'Lucy', 'lucy_gray@email.com', '2023-11-01 00:00:00'),
(2, 'John editado', 'john_doe@email.com', '2023-11-02 00:00:00'),
(3, 'Alice', 'alice_smith@email.com', '2023-11-03 00:00:00'),
(4, 'Bob', 'bob_jones@email.com', '2023-11-04 00:00:00'),
(5, 'Emma', 'emma_white@email.com', '2023-11-05 00:00:00'),
(6, 'Michael', 'michael_brown@email.com', '2023-11-06 00:00:00'),
(7, 'Sophia', 'sophia_green@email.com', '2023-11-07 00:00:00'),
(8, 'Ethan', 'ethan_taylor@email.com', '2023-11-08 00:00:00'),
(9, 'Ava', 'ava_jackson@email.com', '2023-11-09 00:00:00'),
(10, 'William', 'william_wilson@email.com', '2023-11-10 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `atende`
--
ALTER TABLE `atende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idfuncionario` (`idfuncionario`),
  ADD KEY `idanimal` (`idanimal`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `atende`
--
ALTER TABLE `atende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atende`
--
ALTER TABLE `atende`
  ADD CONSTRAINT `atende_ibfk_1` FOREIGN KEY (`idfuncionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `atende_ibfk_2` FOREIGN KEY (`idanimal`) REFERENCES `animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
