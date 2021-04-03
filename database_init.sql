-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql1.nuttyabouthosting.co.uk
-- Creato il: Mar 27, 2021 alle 11:40
-- Versione del server: 5.7.17-log
-- Versione PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `y1352_pizzaonline`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `username` varchar(50) NOT NULL,
  `passwordHash` varchar(255) DEFAULT NULL,
  `ruolo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`username`, `passwordHash`, `ruolo`) VALUES
('admin', '$2y$10$uu7UMVBYXtFptEVvwARipux844SfopuW64TuN75TLlTJeUKnrfFJ6', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cognome`, `telefono`, `username`) VALUES
(1, 'Jacopo', 'Beragnoli', '3423243347', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `contiene`
--

CREATE TABLE `contiene` (
  `id_pietanza` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `contiene`
--

INSERT INTO `contiene` (`id_pietanza`, `id_ordine`, `quantita`) VALUES
(3, 1, 1),
(5, 1, 1),
(6, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `nome` varchar(30) NOT NULL,
  `senza_glutine` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`nome`, `senza_glutine`) VALUES
('Acciughe', 1),
('Basilico', 1),
('Bresaola Valtellina', 1),
('Burrata', 1),
('Cipolla', 1),
('Farina 00', 0),
('Farina senza glutine', 1),
('Funghi', 1),
('Mascarpone', 1),
('Mozzarella di Bufala', 1),
('Pomodoro pachino', 1),
('Salame piccante', 1),
('Speck', 1),
('Tonno nostrano', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id_ordine` int(11) NOT NULL,
  `data_ora` datetime DEFAULT NULL,
  `prezzo_tot` float DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `via` varchar(30) DEFAULT NULL,
  `civico` varchar(10) DEFAULT NULL,
  `citta` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`id_ordine`, `data_ora`, `prezzo_tot`, `id_cliente`, `via`, `civico`, `citta`) VALUES
(1, '2021-03-27 11:38:13', 19.97, 1, 'Via delle papere', '33', 'Pistoia');

-- --------------------------------------------------------

--
-- Struttura della tabella `pietanza`
--

CREATE TABLE `pietanza` (
  `id_pietanza` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `prezzo` float DEFAULT NULL,
  `imgpath` varchar(50) DEFAULT NULL,
  `visibile` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `pietanza`
--

INSERT INTO `pietanza` (`id_pietanza`, `nome`, `descrizione`, `tipo`, `prezzo`, `imgpath`, `visibile`) VALUES
(1, 'Pizza Margherita', 'La migliore Pizza Margherita d\'Italia', 'Rossa', 6.99, 'margherita.jpg', 1),
(2, 'Pizza cipolla e acciughe', 'La migliore cipolla rossa di Tropea e le migliori acciughe partenopee', 'Rossa', 7.99, 'acciughe.jpg', 1),
(3, 'Pizza Speck e Mascarpone', 'Il migliore Speck dell\'Alto Adige con il miglior Mascarpone fatto in casa!', 'Rossa', 7.99, 'speak_mascarpone.jpg', 1),
(4, 'Pizza bresaola e burrata', 'La migliore Bresaola Valtellina unita alla nostra burrata fatta in casa!', 'Senza glutine', 6.99, 'breasaola.jpg', 1),
(5, 'Pizza Diavola', 'Pizza con salamino piccante pugliese.', 'Senza glutine', 5.99, 'diavola.jpg', 1),
(6, 'Schiacciatina con cipolla', 'Pizza bianca con cipolla a km0.', 'Bianca', 5.99, 'cipolla.jpg', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ricetta`
--

CREATE TABLE `ricetta` (
  `id_pietanza` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `ricetta`
--

INSERT INTO `ricetta` (`id_pietanza`, `nome`) VALUES
(2, 'Acciughe'),
(1, 'Basilico'),
(2, 'Basilico'),
(3, 'Basilico'),
(4, 'Basilico'),
(4, 'Bresaola Valtellina'),
(4, 'Burrata'),
(2, 'Cipolla'),
(6, 'Cipolla'),
(1, 'Farina 00'),
(2, 'Farina 00'),
(6, 'Farina 00'),
(3, 'Farina senza glutine'),
(4, 'Farina senza glutine'),
(5, 'Farina senza glutine'),
(3, 'Mascarpone'),
(1, 'Mozzarella di Bufala'),
(2, 'Mozzarella di Bufala'),
(3, 'Mozzarella di Bufala'),
(5, 'Mozzarella di Bufala'),
(6, 'Mozzarella di Bufala'),
(1, 'Pomodoro pachino'),
(2, 'Pomodoro pachino'),
(3, 'Pomodoro pachino'),
(4, 'Pomodoro pachino'),
(5, 'Pomodoro pachino'),
(5, 'Salame piccante'),
(3, 'Speck');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
ADD PRIMARY KEY (`id_cliente`),
ADD KEY `username` (`username`);

--
-- Indici per le tabelle `contiene`
--
ALTER TABLE `contiene`
ADD PRIMARY KEY (`id_pietanza`,`id_ordine`,`quantita`),
ADD KEY `id_ordine` (`id_ordine`);

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
ADD PRIMARY KEY (`id_ordine`),
ADD KEY `id_cliente` (`id_cliente`);

--
-- Indici per le tabelle `pietanza`
--
ALTER TABLE `pietanza`
ADD PRIMARY KEY (`id_pietanza`),
ADD KEY `id_pietanza` (`id_pietanza`);

--
-- Indici per le tabelle `ricetta`
--
ALTER TABLE `ricetta`
ADD PRIMARY KEY (`id_pietanza`,`nome`),
ADD KEY `nome` (`nome`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `pietanza`
--
ALTER TABLE `pietanza`
MODIFY `id_pietanza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);

--
-- Limiti per la tabella `contiene`
--
ALTER TABLE `contiene`
ADD CONSTRAINT `contiene_ibfk_1` FOREIGN KEY (`id_pietanza`) REFERENCES `pietanza` (`id_pietanza`),
ADD CONSTRAINT `contiene_ibfk_2` FOREIGN KEY (`id_ordine`) REFERENCES `ordine` (`id_ordine`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limiti per la tabella `ricetta`
--
ALTER TABLE `ricetta`
ADD CONSTRAINT `ricetta_ibfk_1` FOREIGN KEY (`nome`) REFERENCES `ingrediente` (`nome`),
ADD CONSTRAINT `ricetta_ibfk_2` FOREIGN KEY (`id_pietanza`) REFERENCES `pietanza` (`id_pietanza`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
