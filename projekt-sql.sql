-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Lis 2022, 15:25
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt-sql`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kandydaci`
--

CREATE TABLE `kandydaci` (
  `id_wyborow` int(11) DEFAULT NULL,
  `nr_indeksu` int(11) DEFAULT NULL,
  `liczba_glosow` int(11) DEFAULT NULL,
  `czy_wygral` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `kandydaci`
--

INSERT INTO `kandydaci` (`id_wyborow`, `nr_indeksu`, `liczba_glosow`, `czy_wygral`) VALUES
(1, 111, 3, 0),
(1, 112, 2, 0),
(2, 113, 2, 0),
(1, 114, 5, 0),
(2, 116, 0, 0),
(1, 117, 7, 0),
(1, 118, 2, 0),
(2, 119, 10, 0),
(2, 120, 3, 0),
(2, 121, 11, 0),
(2, 124, 0, 0),
(1, 123, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komisja`
--

CREATE TABLE `komisja` (
  `id_komisja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `komisja`
--

INSERT INTO `komisja` (`id_komisja`) VALUES
(1),
(1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyborcy`
--

CREATE TABLE `wyborcy` (
  `nr_indeksu` int(11) NOT NULL,
  `imie` tinytext DEFAULT NULL,
  `nazwisko` tinytext DEFAULT NULL,
  `haslo` tinytext DEFAULT NULL,
  `czy_glosowal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `wyborcy`
--

INSERT INTO `wyborcy` (`nr_indeksu`, `imie`, `nazwisko`, `haslo`, `czy_glosowal`) VALUES
(1, 'komisja', 'wyborcza', 'komisja', 0),
(111, 'Szymon', 'Szymonowski', 'szymon', 1),
(112, 'Barbara', 'Barbarowska', 'barbara', 1),
(113, 'Anna', 'Annowska', 'anna', 0),
(114, 'Mariusz', 'Mariuszowski', 'mariusz', 0),
(115, 'Hanna', 'Hannowska', 'hanna', 0),
(116, 'Rafal', 'Rafalowski', 'rafal', 0),
(117, 'Beata', 'Beatowska', 'beata', 0),
(118, 'Julia', 'Juliowska', 'julia', 0),
(119, 'Damian', 'Damianowski', 'damian', 1),
(120, 'Slawomir', 'Slawomirowski', 'slawomir', 0),
(121, 'Zuzanna', 'Zuzannowska', 'zuzanna', 0),
(123, 'Agata', 'Agatowska', 'agata', 0),
(124, 'Bartosz', 'Bartoszewski', 'bartosz', 0),
(129, 'Lech', 'Lechowski', 'lech', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wybory`
--

CREATE TABLE `wybory` (
  `id_wyborow` int(11) NOT NULL,
  `id_komisja` int(11) DEFAULT NULL,
  `liczba_posad` int(11) DEFAULT NULL,
  `rozpoczecie` date DEFAULT NULL,
  `zakonczenie` date DEFAULT NULL,
  `termin_zglasz` date DEFAULT NULL,
  `nazwa_wyborow` tinytext DEFAULT NULL,
  `wyniki` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `wybory`
--

INSERT INTO `wybory` (`id_wyborow`, `id_komisja`, `liczba_posad`, `rozpoczecie`, `zakonczenie`, `termin_zglasz`, `nazwa_wyborow`, `wyniki`) VALUES
(1, 1, 1, '2022-11-01', '2023-01-01', '2023-01-01', 'rada', 1),
(2, 1, 3, '2022-10-01', '2023-01-14', '2023-01-07', 'samorzad', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kandydaci`
--
ALTER TABLE `kandydaci`
  ADD KEY `id_wyborow` (`id_wyborow`),
  ADD KEY `nr_indeksu` (`nr_indeksu`);

--
-- Indeksy dla tabeli `wyborcy`
--
ALTER TABLE `wyborcy`
  ADD PRIMARY KEY (`nr_indeksu`);

--
-- Indeksy dla tabeli `wybory`
--
ALTER TABLE `wybory`
  ADD PRIMARY KEY (`id_wyborow`),
  ADD KEY `id_komisja` (`id_komisja`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kandydaci`
--
ALTER TABLE `kandydaci`
  ADD CONSTRAINT `kandydaci_ibfk_1` FOREIGN KEY (`id_wyborow`) REFERENCES `wybory` (`id_wyborow`),
  ADD CONSTRAINT `kandydaci_ibfk_2` FOREIGN KEY (`nr_indeksu`) REFERENCES `wyborcy` (`nr_indeksu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
