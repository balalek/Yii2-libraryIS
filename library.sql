-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pon 16. říj 2023, 12:03
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `library`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `isbn` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `isbn`) VALUES
(1, 'Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', 'ISBN-13: 978-0-13-468599-1'),
(2, 'The Art of Computer Programming, Volume 1: Fundamental Algorithms', 'Donald E. Knuth', 'ISBN-13: 978-0-7619-6971-5'),
(3, 'Artificial Intelligence: A Modern Approach', 'Stuart Russell, Peter Norvig', 'ISBN-13: 978-1-4398-4086-3'),
(4, 'The Da Vinci Code', 'Dan Brown', 'ISBN-13: 978-0-7432-3493-4'),
(5, 'The Catcher in the Rye', 'J.D. Salinger', 'ISBN-13: 978-0-385-34134-6'),
(6, 'Angels & Demons', 'Dan Brown', 'ISBN-13: 978-0-7432-2671-8'),
(7, 'A Game of Thrones (A Song of Ice and Fire, Book 1)', 'George R.R. Martin', 'ISBN-13: 978-0-8129-7730-7'),
(8, 'Freakonomics: A Rogue Economist Explores the Hidden Side of Everything', 'Steven D. Levitt, Stephen J. Dubner', 'ISBN-13: 978-0-14-303995-2'),
(9, 'The Road', 'Cormac McCarthy', 'ISBN-13: 978-0-375-71180-6'),
(10, 'Divergent', 'Veronica Roth', 'ISBN-13: 978-1-250-00005-0'),
(11, 'To Kill a Mockingbird', 'Harper Lee', 'ISBN-13: 978-0-06-112008-4');

-- --------------------------------------------------------

--
-- Struktura tabulky `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `loans`
--

INSERT INTO `loans` (`loan_id`, `user_id`, `book_id`, `loan_date`, `return_date`) VALUES
(1, 1, 10, '2023-10-13', '2023-10-26'),
(2, 4, 7, '2023-10-12', '2023-11-10'),
(3, 4, 1, '2023-10-12', '2023-11-17'),
(4, 5, 9, '2023-10-11', '2023-10-31'),
(5, 1, 3, '2022-10-08', '2023-01-06'),
(6, 1, 6, '2021-10-09', '2022-02-03'),
(7, 1, 1, '2022-10-07', '2022-12-10'),
(8, 2, 1, '2021-06-01', '2021-10-09'),
(9, 3, 1, '2021-10-15', '2022-01-27'),
(10, 5, 1, '2023-01-05', '2023-06-17');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `name`, `phone`, `email`) VALUES
(1, 'Alice Johnson', 530640892, 'alice.johnson@example.com'),
(2, 'Bob Smith', 123654852, 'bob.smith@example.com'),
(3, 'Emily Davis', 963357741, 'emily.davis@example.com'),
(4, 'John Miller', 159263487, 'john.miller@example.com'),
(5, 'Sarah White', 968537421, 'sarah.white@example.com');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexy pro tabulku `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
