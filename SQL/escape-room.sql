-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 mei 2025 om 16:44
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
-- Database: `escape-room`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `hint`, `roomId`) VALUES
(16, 'Je ziet een melding: “Inbraak gedetecteerd in Firewall Protocol X-9. Herstel het patroon.”\n8, 16, 32, __, 128', '64', 'Denk aan vermenigvuldigen.', 1),
(17, 'Je komt een map tegen genaamd \"UifsfJtOpEpctubdmf\". Decodeer de bestandsnaam.', 'ThereIsNoObstacle', 'Gebruik Caesar Cipher (verschuiving -1).', 1),
(18, 'Welk bestand hoort niet tussen deze systeemonderdelen?\nsysconfig.dll, userdata.exe, malX_virus.exe, kernel32.dll, bootmgr.sys', 'malX_virus.exe', 'Zoek het geïnfecteerde bestand.', 1),
(19, 'De AI stelt een logische vraag:\n\"Als A actief is, is B inactief.\nAls B actief is, is C altijd actief.\nC is momenteel actief.\nWelke modules kunnen actief zijn?\"', 'B en C', 'Denk logisch en sluit uit wat niet kan.', 2),
(20, 'Het virus heeft de klok omgekeerd ingesteld: 13:74. Denk binair. Wat is het geheime wachtwoord?', '8911', 'Zet het binair om en draai het om.', 2),
(21, 'Gebruik de eerste letters van je vorige antwoorden om de reboot-code te kraken.', 'STMBER', 'Gebruik de eerste letter van elk eerder antwoord.', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('player','admin') NOT NULL DEFAULT 'player'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'test', 'HALLO@hallo.com', '$2y$10$ELKOaBYZ1Z5/N9fYuU8npeBD8Xj/oct0L0aFBsfiCgxzLqU8vENj6', 'admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
