-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 09 jun 2023 kl 08:34
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `php_slutprojekt_secondhand`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `sold` tinyint(1) DEFAULT 0,
  `date_sold` date DEFAULT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `items`
--

INSERT INTO `items` (`id`, `description`, `price`, `date`, `sold`, `date_sold`, `seller_id`) VALUES
(6, 'Pink shoes, size 24', 40.00, '2023-06-01 11:18:52', 0, NULL, 2),
(7, 'Dark blue leggings', 38.00, '2023-06-01 00:00:00', 1, '2023-06-07', 8),
(9, 'Vita leggings med döskallar på, stretchigt material. Aldrig använda.', 40.00, '2023-06-02 10:14:03', 0, NULL, 2),
(10, 'Klädpaket för barn, storlek 74, blandade märken (allt från hm till newbie). Kläderna är sparsamt använda och i fint skick. Könsneutrala.', 49.00, '2023-06-02 10:24:03', 0, NULL, 1),
(12, 'Tröja med lång ärm', 299.00, '2023-06-02 11:59:01', 0, NULL, 2),
(18, 'Ljusblå tröja med vit ärm i storlek 40', 500.00, '2023-06-02 12:16:19', 0, NULL, 1),
(19, 'Svart kjol med spetskant, storlek 38', 10000.00, '2023-06-02 12:16:30', 0, NULL, 1),
(21, 'Neonrosa byxa', 5000.00, '2023-06-02 13:27:35', 0, NULL, 1),
(22, 'Vinröd kavaj, storlek M', 100.00, '2023-06-04 18:51:43', 0, NULL, 33),
(23, 'Rosa blus', 49.00, '2023-06-04 19:05:21', 1, '2023-06-05', 5),
(25, 'Svart mössa', 10.00, '2023-06-05 10:02:16', 0, NULL, 5),
(26, 'Blå jacka', 10.00, '2023-06-05 13:32:17', 1, '2023-06-07', 19),
(27, 'Svarta jeans', 200.00, '2023-06-06 13:15:37', 0, NULL, 1),
(28, 'Svart vindjacka i storlek M', 59.00, '2023-06-06 13:20:32', 0, NULL, 13),
(30, 'Halsband', 19.00, '2023-06-07 12:22:57', 0, NULL, 39),
(31, 'Blått skärp', 10.00, '2023-06-08 00:00:00', 1, '2023-06-08', 15),
(32, 'Svart nättröja', 19.00, '2023-06-08 15:08:45', 0, NULL, 19);

--
-- Trigger `items`
--
DELIMITER $$
CREATE TRIGGER `set_date_sold` BEFORE UPDATE ON `items` FOR EACH ROW BEGIN
    IF NEW.sold = 1 THEN
        SET NEW.date_sold = CURRENT_DATE();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellstruktur `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `sellers`
--

INSERT INTO `sellers` (`id`, `firstname`, `lastname`, `phone`) VALUES
(1, 'Tove', 'Lissner', '0735516899'),
(2, 'Alma', 'Lissner', '0735516899'),
(3, 'Mormor', 'Lissner', '0707267385'),
(4, 'Pelle', 'Skoog', '0707123123'),
(5, 'Morgan', 'Dahl', '073 123 456'),
(6, 'Camilla', 'Lissner', '0707252604'),
(7, 'Trubbel', 'Lissner', '0735516899'),
(8, 'Bettina', 'Lissner', '070123123123'),
(9, 'Mattias', 'Björk', '070000000'),
(10, 'Noah', 'Lissner', '070722222'),
(11, 'Sebastian', 'Skoog', '07031111111'),
(12, 'Hannes', 'Lissner', '070888888'),
(13, 'Pluto', 'Lissner', '9090909099090'),
(15, 'Tulla', 'Eriksson', '070123123123'),
(19, 'Spindel', 'Mannen', '0000'),
(21, 'Nathalie', 'Skoog', '123456788'),
(28, 'Felicia', 'Skoog', '12345678910'),
(33, 'Matilda', 'Andersson', '070123123'),
(39, 'Vilda', 'Lissner', '19890212');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Index för tabell `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT för tabell `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
