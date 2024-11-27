-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 nov 2024 om 15:52
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelregels`
--

CREATE TABLE `bestelregels` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantal` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestelregels`
--

INSERT INTO `bestelregels` (`id`, `order_id`, `product_id`, `aantal`) VALUES
(1, 1, 1, 2),
(2, 1, 4, 1),
(3, 3, 5, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `straat` varchar(255) NOT NULL,
  `huisnummer` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `usr_id`, `plaats`, `straat`, `huisnummer`) VALUES
(1, 35, 'zaandam', 'leegwaterweg', '7');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `besteldatum` datetime DEFAULT current_timestamp(),
  `bezorger_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `klant_id`, `besteldatum`, `bezorger_id`) VALUES
(1, 1, '2024-11-27 12:55:49', 36),
(2, 1, '2024-11-27 14:18:11', 34),
(3, 1, '2024-11-27 15:27:08', 34);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `beschrijfing` mediumtext DEFAULT NULL,
  `prijs` int(255) DEFAULT NULL,
  `beschikbaarheid` int(255) UNSIGNED DEFAULT 255
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`id`, `naam`, `beschrijfing`, `prijs`, `beschikbaarheid`) VALUES
(1, 'milkshake aardbei', 'aardbei milkshake medium', 400, 255),
(2, 'milkshake banaan', NULL, 400, 255),
(3, 'milkshake vanille', NULL, 400, 255),
(4, 'pizza margarita', NULL, 1200, 255),
(5, 'pizza pepperoni', NULL, 1300, 255);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usr` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pos` int(2) NOT NULL COMMENT 'klant = 0\r\nbezorger = 1\r\nmedewerker = 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `usr`, `pwd`, `email`, `pos`) VALUES
(34, 'adrian', '$2y$10$Tnx1vbEq2ColA8wV85cgCOZH13p7MmfTjgglxK37rDKyOjTuTiMgW', '204091@stmichaelcollege.nl', 0),
(35, 'test1', '$2y$10$.INLiCVjO91246zLxdokL.SKKsrr4atJxuZwoOkAnPMnOduxVp.CS', 'test@mail.com', 0),
(36, 'Olle', '$2y$10$HhJVWwkN4QTMEcOpaDypO.0/9fyXT0VA3yEivyR71SJV1LHn3fVVS', 'olle@stmichaelcollege.nl', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelregels`
--
ALTER TABLE `bestelregels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klant_id` (`klant_id`),
  ADD KEY `bezorger_id` (`bezorger_id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelregels`
--
ALTER TABLE `bestelregels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelregels`
--
ALTER TABLE `bestelregels`
  ADD CONSTRAINT `bestelregels_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `bestelregels_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `producten` (`id`);

--
-- Beperkingen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD CONSTRAINT `klanten_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klanten` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`bezorger_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
