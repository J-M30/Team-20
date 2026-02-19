-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Isäntä: db
-- Luontiaika: 19.02.2026 klo 12:48
-- Palvelimen versio: 8.0.34
-- PHP-versio 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Tietokanta: `lounas`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `Juomat`
--

CREATE TABLE `Juomat` (
  `juomaId` int NOT NULL,
  `juomaNimi` varchar(50) NOT NULL,
  `juomaHinta` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `Juomat`
--

INSERT INTO `Juomat` (`juomaId`, `juomaNimi`, `juomaHinta`) VALUES
(1, 'Coca-Cola 0.5L', 3.50),
(2, 'Fanta 0.5l', 4.00),
(3, 'maito', 2.00),
(4, 'maitoa', 34.90),
(5, 'juoma', 44.00),
(6, 'rryr', 684.00);

-- --------------------------------------------------------

--
-- Rakenne taululle `Lisukkeet`
--

CREATE TABLE `Lisukkeet` (
  `LisukeId` int NOT NULL,
  `lisukeNimi` varchar(50) NOT NULL,
  `lisukeHinta` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `Lisukkeet`
--

INSERT INTO `Lisukkeet` (`LisukeId`, `lisukeNimi`, `lisukeHinta`) VALUES
(1, 'Ranskalaiset', 4.00),
(3, 'jäätelö', 4.00),
(4, 'kahvi', 3.99),
(5, 'pinaatti', 688.97),
(6, 'pinaatti', 688.97);

-- --------------------------------------------------------

--
-- Rakenne taululle `Ruoka_Lisukkeet`
--

CREATE TABLE `Ruoka_Lisukkeet` (
  `ruokaId` int NOT NULL,
  `lisukeId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `Ruoka_Lisukkeet`
--

INSERT INTO `Ruoka_Lisukkeet` (`ruokaId`, `lisukeId`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `Ruuat`
--

CREATE TABLE `Ruuat` (
  `ruokaId` int NOT NULL,
  `ruokaNimi` varchar(50) NOT NULL,
  `ruokaHinta` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `Ruuat`
--

INSERT INTO `Ruuat` (`ruokaId`, `ruokaNimi`, `ruokaHinta`) VALUES
(1, 'Pekoniburgeri', 12.90),
(3, 'kasvis', 9.00),
(4, 'pizza', 12.00),
(5, 'pihvi', 12.00),
(6, 'makaroonilaatikko', 9.85),
(8, 'pasta', 7.98),
(9, 'pasta', 8.90),
(11, 'SALAATTI', 34.00),
(12, 'salaatti', 34.98),
(13, 'uujuj', 78.00);

-- --------------------------------------------------------

--
-- Rakenne taululle `Tilaukset`
--

CREATE TABLE `Tilaukset` (
  `tilausId` int NOT NULL,
  `ruokaId` int NOT NULL,
  `juomaId` int NOT NULL,
  `tilausaika` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `Tilaukset`
--

INSERT INTO `Tilaukset` (`tilausId`, `ruokaId`, `juomaId`, `tilausaika`) VALUES
(1, 1, 1, '2026-02-16 14:36:37');

--
-- Indexes for dumped tables
--

--
-- Indeksit taulukolle `Juomat`
--
ALTER TABLE `Juomat`
  ADD PRIMARY KEY (`juomaId`);

--
-- Indeksit taulukolle `Lisukkeet`
--
ALTER TABLE `Lisukkeet`
  ADD PRIMARY KEY (`LisukeId`);

--
-- Indeksit taulukolle `Ruoka_Lisukkeet`
--
ALTER TABLE `Ruoka_Lisukkeet`
  ADD PRIMARY KEY (`ruokaId`,`lisukeId`),
  ADD KEY `lisukeId` (`lisukeId`);

--
-- Indeksit taulukolle `Ruuat`
--
ALTER TABLE `Ruuat`
  ADD PRIMARY KEY (`ruokaId`);

--
-- Indeksit taulukolle `Tilaukset`
--
ALTER TABLE `Tilaukset`
  ADD PRIMARY KEY (`tilausId`),
  ADD KEY `ruokaId` (`ruokaId`),
  ADD KEY `juomaId` (`juomaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Juomat`
--
ALTER TABLE `Juomat`
  MODIFY `juomaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Lisukkeet`
--
ALTER TABLE `Lisukkeet`
  MODIFY `LisukeId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Ruuat`
--
ALTER TABLE `Ruuat`
  MODIFY `ruokaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Tilaukset`
--
ALTER TABLE `Tilaukset`
  MODIFY `tilausId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `Ruoka_Lisukkeet`
--
ALTER TABLE `Ruoka_Lisukkeet`
  ADD CONSTRAINT `Ruoka_Lisukkeet_ibfk_1` FOREIGN KEY (`ruokaId`) REFERENCES `Ruuat` (`ruokaId`),
  ADD CONSTRAINT `Ruoka_Lisukkeet_ibfk_2` FOREIGN KEY (`lisukeId`) REFERENCES `Lisukkeet` (`LisukeId`);

--
-- Rajoitteet taululle `Tilaukset`
--
ALTER TABLE `Tilaukset`
  ADD CONSTRAINT `Tilaukset_ibfk_1` FOREIGN KEY (`ruokaId`) REFERENCES `Ruuat` (`ruokaId`),
  ADD CONSTRAINT `Tilaukset_ibfk_2` FOREIGN KEY (`juomaId`) REFERENCES `Juomat` (`juomaId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
