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
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_polish_ci NOT NULL,
  `description` text COLLATE utf8mb4_polish_ci NOT NULL,
  `category` text COLLATE utf8mb4_polish_ci NOT NULL,
  `price` float NOT NULL,
  `img` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category`, `price`, `img`) VALUES
(1, 'Sztanga prosta', 'Prosta sztanga, waga 10kg', 'weights', 30, 'sztanga-prosta'),
(2, 'Sztanga łamana', 'Sztanga łamana, waga 7kg', 'weights', 35, 'sztanga-lamana'),
(3, 'Ciężar żeliwny 2.5kg', 'Ciężar wykonany z żeliwa o wadze 2.5kg', 'weights', 12, 'ciezar-2-5'),
(4, 'Ciężar żeliwny 5kg', 'Ciężar wykonany z żeliwa o wadze 5kg', 'weights', 22, 'ciezar-5'),
(5, 'Ciężar żeliwny 10kg', 'Ciężar wykonany z żeliwa o wadze 10kg', 'weights', 40, 'ciezar-10'),
(6, 'Ciężar żeliwny 15kg', 'Ciężar wykonany z żeliwa o wadze 15kg', 'weights', 52, 'ciezar-15'),
(7, 'Ciężar żeliwny 1.25kg', 'Ciężar wykonany z żeliwa o wadze 1.25kg', 'weights', 10, 'ciezar-1-25'),
(8, 'Ciężar żeliwny 20kg', 'Ciężar wykonany z żeliwa o wadze 20kg', 'weights', 62, 'ciezar-20'),
(9, 'Atlas wielofunkcyjny', 'Maszyna na której można zrobić 10 różnych ćwiczeń na każdą partie ciała', 'machines', 1290, 'atlas'),
(10, 'Maszyna do przysiadów', 'Maszyna do przysiadów z prowadnicami', 'machines', 950, 'maszyna-do-przysiadow'),
(11, 'Ławka z regulacją pochyłości', 'Ławka z możliwością regulacji stopnia pochyłości. Od płaskiej do 90 stopni.', 'machines', 400, 'lawka'),
(12, 'Gumy do ćwiczeń', 'Zestaw 3 gum do ćwiczeń o różnej sile napięcia', 'accessories', 16, 'zestaw-gum'),
(13, 'Roller', 'Roller służący do masowania spiętych mięśni', 'accessories', 30, 'roller'),
(14, 'Mata do ćwiczeń', 'Mata do ćwiczeń wykonana z materiału anty poślizgowego', 'accessories', 17, 'mata'),
(15, 'Koszulka do ćwiczeń Adidas', 'Koszulka marki Adidas z materiału regulującego przepływ powietrza.', 'clothes', 79, 'koszulka-adidas'),
(16, 'Spodnie dresowe Adidas', 'Długie spodnie dresowe marki Adidas', 'clothes', 99, 'spodnie-adidas'),
(17, 'koszulka Nike', 'Koszulka sportowa marki Nike', 'clothes', 70, 'koszulka-nike'),
(18, 'Buty do biegania Nike', 'Buty do biegania marki Nike. Posiada technologie usztywniającą stopę', 'clothes', 130, 'buty-nike'),
(19, 'Koszulka do wyciskania', 'Specjalna koszulka poprawiająca wynik w wyciskaniu na płaskiej ławce', 'clothes', 120, 'koszulka-do-wyciskania');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
