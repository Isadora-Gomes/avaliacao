-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/05/2025 às 17:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `task_sync`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefa` int(11) NOT NULL,
  `descricao_tarefa` text NOT NULL,
  `setor_empresa` text NOT NULL,
  `prioridade_tarefa` enum('baixa','média','alta') NOT NULL,
  `data_cadastrada` datetime NOT NULL,
  `status_tarefa` enum('a fazer','fazendo','concluído') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefa`, `descricao_tarefa`, `setor_empresa`, `prioridade_tarefa`, `data_cadastrada`, `status_tarefa`, `id_usuario`) VALUES
(3, 'Finalizar projeto', 'RH', 'alta', '2025-05-20 15:18:07', 'a fazer', 1),
(4, 'nao sei', 'produção', 'média', '2025-05-20 12:07:00', 'a fazer', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` text NOT NULL,
  `email_usuario` text NOT NULL,
  `senha_usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`) VALUES
(1, 'marcos', 'mar@gmail.com', '$2y$10$lo9Bx2ROvhAF3astbDx0IOdoFZeHerm1SYU7rnIP0rM/QiVKkjGWi'),
(2, 'ana livia', 'livia@gmail', '$2y$10$Ug9E9M7TRDjJKe3QOGd1xO7BuW2TkOxM23eDw/ATTpdU6w/3fkjpK'),
(3, 'isadora', 'isa@gmail.com', '$2y$10$QUzOw.d9QzBJ6DjBWYWbMucEW/Z5KeS0dTYsFnpnHeOrJfMX/xLAK'),
(4, 'mario', 'mario@gmail.com', '$2y$10$ejQE1mA3h69v8JVIo1GR7..V6IAY.lV1Nk3vXgAliI7nm3wPYOqEe'),
(5, 'oie', 'teste@gmail.com', '$2y$10$BQTUdDB2WvQjgcdT1v2qVu48JCTg1tNiPCoTyr4yS.1Rr7j1BUqse'),
(6, 'Bruna', 'brucpv@gmail.com', '$2y$10$HmGfxvTOnJNVaXKchgddiOH7Idi0.CS2ty4W.xF7sUnKzALHD9LpG');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefa`),
  ADD KEY `fk_user_tarefa` (`id_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_user_tarefa` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
