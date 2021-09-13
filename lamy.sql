-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 13. zář 2021, 09:24
-- Verze serveru: 10.4.17-MariaDB
-- Verze PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `lamy`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `fotky`
--

CREATE TABLE `fotky` (
  `id` int(10) UNSIGNED NOT NULL,
  `original_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `id_slozka` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `likes` int(50) NOT NULL,
  `star` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `fotky`
--

INSERT INTO `fotky` (`id`, `original_name`, `extension`, `title`, `id_slozka`, `created_at`, `likes`, `star`) VALUES
(7, 'Happy 1.jpg', 'jpg', 'happy lama 1', 2, '2020-11-19 10:03:32', 2, 0),
(8, 'happy 2x.jpg', 'jpg', 'happy lama 2', 2, '2020-11-19 10:03:48', 0, 5),
(9, 'happy 3.jpg', 'jpg', 'happy lama 3', 2, '2020-11-19 10:03:58', 2, 0),
(15, 'angry 1.jpg', 'jpg', 'Lama 1', 4, '2020-11-19 10:06:07', 0, 2),
(16, 'angry 2.jpg', 'jpg', 'Lama 2', 4, '2020-11-19 10:06:14', 10, 4),
(17, 'angry 3.jpg', 'jpg', 'Lama 3', 4, '2020-11-19 10:06:22', 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `slozka`
--

CREATE TABLE `slozka` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `slozka`
--

INSERT INTO `slozka` (`id`, `title`, `created_at`) VALUES
(2, 'Happy lama', '2020-11-19 09:56:49'),
(4, 'Angry Lama', '2020-11-19 10:05:54');

-- --------------------------------------------------------

--
-- Struktura tabulky `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `avg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `fotky`
--
ALTER TABLE `fotky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_slozka` (`id_slozka`);

--
-- Klíče pro tabulku `slozka`
--
ALTER TABLE `slozka`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `fotky`
--
ALTER TABLE `fotky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pro tabulku `slozka`
--
ALTER TABLE `slozka`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `fotky`
--
ALTER TABLE `fotky`
  ADD CONSTRAINT `fotky_ibfk_1` FOREIGN KEY (`id_slozka`) REFERENCES `slozka` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
