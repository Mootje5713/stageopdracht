-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 apr 2022 om 11:41
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stage`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `domain`
--

CREATE TABLE `domain` (
  `id` int(11) NOT NULL,
  `domainname` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `domainswithlastscore`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `domainswithlastscore` (
`domainname` varchar(255)
,`user_id` int(11)
,`id` int(11)
,`score` int(11)
,`speed` int(11)
,`fcp` int(11)
,`tti` int(11)
,`domain_id` int(11)
,`datum` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `lastscore`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `lastscore` (
`domain_id` int(11)
,`score_id` int(11)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `fcp` int(11) NOT NULL,
  `tti` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `wachtwoord` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structuur voor de view `domainswithlastscore`
--
DROP TABLE IF EXISTS `domainswithlastscore`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `domainswithlastscore`  AS SELECT `domain`.`domainname` AS `domainname`, `domain`.`user_id` AS `user_id`, `score`.`id` AS `id`, `score`.`score` AS `score`, `score`.`speed` AS `speed`, `score`.`fcp` AS `fcp`, `score`.`tti` AS `tti`, `score`.`domain_id` AS `domain_id`, `score`.`datum` AS `datum` FROM ((`lastscore` left join `score` on(`lastscore`.`score_id` = `score`.`id`)) left join `domain` on(`domain`.`id` = `lastscore`.`domain_id`)) ;

-- --------------------------------------------------------

--
-- Structuur voor de view `lastscore`
--
DROP TABLE IF EXISTS `lastscore`;

CREATE ALGORITHM=UNDEFINED DEFINER=`latestscoreid`@`%` SQL SECURITY INVOKER VIEW `lastscore`  AS SELECT `score`.`domain_id` AS `domain_id`, max(`score`.`id`) AS `score_id` FROM `score` GROUP BY `score`.`domain_id` ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domainname` (`domainname`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `domain`
--
ALTER TABLE `domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `domain_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
