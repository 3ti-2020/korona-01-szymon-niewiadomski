-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Maj 2020, 12:52
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `3ti`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text COLLATE utf8mb4_polish_ci NOT NULL,
  `email` text COLLATE utf8mb4_polish_ci NOT NULL,
  `name` text COLLATE utf8mb4_polish_ci NOT NULL,
  `lastname` text COLLATE utf8mb4_polish_ci NOT NULL,
  `city` text COLLATE utf8mb4_polish_ci NOT NULL,
  `post_code` text COLLATE utf8mb4_polish_ci NOT NULL,
  `address` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `email`, `name`, `lastname`, `city`, `post_code`, `address`) VALUES
(1, 'guest', '$2y$10$rzyvhob7yShvoTFYDpXhIuXBjSJnObIINW2siY33HxrCqj20LKRTm', 'guest@guest.com', 'Guest', 'Guestly', 'Knurów', '44-194', 'Kilińskiego 16c/11'),
(2, 'propsu', '$2y$10$rP74zpqrTwA2l37EQA9e1.b9c2PhFEZcWnWL/bfLRFz/0a6WCVPRW', 'niewiadomski.szymon@gmail.com', 'Szymon', 'Niewiadomski', 'Knurów', '44-193', 'J. Kilińskiego'),
(3, 'violet', '$2y$10$3lF/oEfqLGAxSvxraEWMeOtSeSmhTntNpqOiYy5CkXSBI9Bqo7rRi', 'violan3@wp.pl', 'Violetta', 'Niewiadomska', 'Knurów', '44-193', 'Kiilńskiego 16c/12'),
(4, 'niewiado', '$2y$10$LIhKEBx7TN9bnhGLRAsC5eBqt0i76AwhiNhBDQ/5te9p5Cw06M33a', 'niewiadoms2ki.szymon@gmail.com', 'Szymon', 'Niewiadomski', 'Knurów', '44-193', 'J. Kilińskiego 16c/12'),
(5, 'hubiskus', '$2y$10$RZItVLo9EijlLsDQDVoqlOD2rmLNFNzVXe/t9ZIZOsCWuaIEO2C/W', 'ad@Sasd.com', 'Hubert', 'Urbański', 'Katowice', '01-233', 'Potocka 69a/1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
