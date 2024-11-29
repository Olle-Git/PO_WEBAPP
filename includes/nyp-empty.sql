-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 nov 2024 om 13:12
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `positie`
--

CREATE TABLE `positie` (
  `id` int(11) NOT NULL,
  `positie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `positie`
--

INSERT INTO `positie` (`id`, `positie`) VALUES
(0, 'kant'),
(1, 'bezorger'),
(2, 'manager');

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
(2, 'milkshake banaan', 'banaan milkshare medium', 400, 255),
(3, 'milkshake chocola', 'chocolade milkshake medium', 400, 255),
(4, 'Margherita', 'De basis van elke pizza', 1200, 255),
(5, 'Pepperoni', 'Een pizza met knapperige pepperoni plakjes', 1300, 255),
(6, '4 kazen', 'Een heerlijke 4 kazen pizza', 1400, 255),
(7, 'BBQ Bacon', 'Een pittige BBQ pizza met sappige bacon', 1500, 255),
(8, 'BBQ Meat Lovers', 'Een ultieme BBQ pizza met een mix van vlees', 1600, 255),
(9, 'Buffalo Chicken', 'Een pittige pizza met gekruide buffalo-kip', 1550, 255),
(10, 'Californian', 'Een frisse pizza met een mix van Calafornische smaken', 1450, 255),
(11, 'Vegan Shoarma', 'Een stevige pizza met shoarma en knoflooksaus', 1400, 255),
(12, 'Zwarte Truffel', 'Een luxe pizza met de verfijnde smaak van zwarte truffel', 1600, 255),
(13, 'Hawaii', 'Bah, nee', 6969, 255),
(14, 'Mexican hot and spicy', 'Een kruidige pizza met Mexicaanse smaken ', 1450, 255),
(15, 'Double Pepperoni', 'Een extra volle pizza met rijkelijk veel pepperoni', 1400, 255),
(16, 'New York ', 'Een traditionele New York-style pizza', 1600, 255),
(17, 'Hete kip', 'Een pittige pizza met gekruide kip en zoete saus', 1600, 255),
(18, 'Downtown Döner', 'Een hartige pizza met heerlijke döner', 1400, 255),
(19, 'Salami', 'Een eenvoudige maar smaakvolle pizza met salami', 1300, 255),
(20, 'Brooklyn style', 'Een echte New Yorkse pizza met een klassieke twist', 1300, 255),
(21, 'East Side Shoarma', 'Een pizza geïnspireerd door de smaken van de East Side', 1400, 255),
(22, 'Teriyaki Chicken', 'Een exotische pizza met hete kip, broccoli en teriyakki-saus', 1500, 255);

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
(1, 'bezorger', 'wachtwoord', 'bezorger@nyp.nl', 1);

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
-- Indexen voor tabel `positie`
--
ALTER TABLE `positie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos` (`pos`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelregels`
--
ALTER TABLE `bestelregels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`pos`) REFERENCES `positie` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`pos`) REFERENCES `positie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
