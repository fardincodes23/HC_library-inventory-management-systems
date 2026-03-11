-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 07:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lims`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `type`, `publisher`, `supplier_id`) VALUES
(1, 'Clean Code', 'Programming', 'Prentice Hall', 1),
(2, 'The Pragmatic Programmer', 'Programming', 'Addison-Wesley', 1),
(3, 'Introduction to Algorithms', 'Academic', 'MIT Press', 2),
(4, 'The Great Gatsby', 'Fiction', 'Scribner', 3),
(5, 'Design Patterns', 'Programming', 'Addison-Wesley', 1),
(6, 'Independent Author Guide', 'Non-Fiction', 'Self-Published', NULL),
(7, 'Refactoring: Improving the Design of Existing Code', 'Programming', 'Addison-Wesley', 4),
(8, 'Computer Networks', 'Academic', 'Pearson', 5),
(9, 'Artificial Intelligence: A Modern Approach', 'Academic', 'Pearson', 5),
(10, 'The Catcher in the Rye', 'Fiction', 'Little, Brown and Company', 6),
(11, 'Deep Learning', 'Academic', 'MIT Press', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Alice Wonderland', 'alice@example.com', '555-1111'),
(2, 'Bob Builder', 'bob@example.com', '555-2222'),
(3, 'Charlie Chaplin', 'charlie@example.com', '555-3333'),
(4, 'Diana Prince', 'diana@example.com', '555-4444'),
(5, 'Ethan Hunt', 'ethan@example.com', '555-5555'),
(6, 'Fiona Gallagher', 'fiona@example.com', '555-6666'),
(7, 'George Martin', 'george@example.com', '555-7777');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `book_id`, `client_id`, `loan_date`, `due_date`, `return_date`) VALUES
(1, 1, 1, '2026-03-01', '2026-03-15', '2026-03-11'),
(2, 4, 2, '2026-02-15', '2026-03-01', '2026-02-28'),
(3, 3, 3, '2026-02-10', '2026-03-01', NULL),
(4, 2, 1, '2026-03-05', '2026-03-20', NULL),
(5, 4, 2, '2026-03-06', '2026-03-21', NULL),
(6, 1, 3, '2026-03-07', '2026-03-22', NULL),
(7, 3, 1, '2026-02-20', '2026-03-05', '2026-03-03'),
(8, 2, 2, '2026-02-15', '2026-03-01', '2026-02-28'),
(9, 4, 3, '2026-02-18', '2026-03-04', NULL),
(10, 1, 2, '2026-03-09', '2026-03-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`) VALUES
(1, 'TechPress Publishing Co.', 'orders@techpress.com', '555-0198'),
(2, 'Global Academic Media', 'dist@globalacademic.org', '555-0233'),
(3, 'Vintage Books Ltd.', 'supply@vintagebooks.co.uk', '555-0991'),
(4, 'Digital Learning Hub', 'contact@digitalhub.com', '555-0444'),
(5, 'Scholarly Distributors Inc.', 'sales@scholarlydist.com', '555-0555'),
(6, 'Modern Education Press', 'info@modernpress.org', '555-0666');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'STAFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_books_supplier` (`supplier_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_loans_book` (`book_id`),
  ADD KEY `fk_loans_client` (`client_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `fk_loans_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `fk_loans_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
