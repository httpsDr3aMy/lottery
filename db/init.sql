-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Dec 03, 2024 at 05:08 PM
-- Wersja serwera: 9.0.0
-- Wersja PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lottery`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lottery_history`
--

CREATE TABLE `lottery_history` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_numbers` varchar(255) NOT NULL,
  `lotto_numbers` varchar(255) NOT NULL,
  `draw_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lottery_history`
--

INSERT INTO `lottery_history` (`id`, `username`, `user_numbers`, `lotto_numbers`, `draw_date`) VALUES
(1, 'test', '1,2,3,4,5,6', '4,18,19,23,24,33', '2024-12-03 17:06:36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` decimal(10,2) DEFAULT '100.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `balance`) VALUES
(1, 'test', '$2y$10$resXqga7hR0adCvefvV7/.oIDXZbH37nIs8.fvN6Mv70jSIhABwxi', '2024-12-03 14:36:31', 90.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lottery_history`
--
ALTER TABLE `lottery_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lottery_history`
--
ALTER TABLE `lottery_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lottery_history`
--
ALTER TABLE `lottery_history`
  ADD CONSTRAINT `lottery_history_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
