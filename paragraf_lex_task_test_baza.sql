-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 01:30 AM
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
-- Database: `paragraf_lex`
--

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `passport_number` varchar(50) NOT NULL,
  `phone_number` int(25) DEFAULT NULL,
  `travel_date_from` date NOT NULL,
  `travel_date_to` date NOT NULL,
  `insurance_type` varchar(30) NOT NULL DEFAULT 'individualno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`id`, `first_name`, `last_name`, `email`, `birthdate`, `passport_number`, `phone_number`, `travel_date_from`, `travel_date_to`, `insurance_type`) VALUES
(1, 'Aleksa', 'Aleksic', 'test@test.com', '1980-02-10', '564651', 6545613, '2024-05-16', '2024-05-23', 'individualno'),
(9, 'Milanka', 'Milankovic', 'milankamil@ptt.rs', '1976-02-02', '45646126', 2147483647, '2024-05-17', '2024-05-22', 'grupno'),
(10, 'Denis', 'Bergkamp', 'dsabb@sda.com', '1970-02-17', '27278', NULL, '2024-05-16', '2024-05-31', 'individualno'),
(11, 'Rud', 'Gulit', 'gulitbulit@nederlns.com', '1968-03-17', '7887213123', NULL, '2024-05-15', '2024-05-30', 'individualno'),
(12, 'Mica', 'Trofrtaljka', 'sweetmica@trftlj.com', '1980-02-17', '2572872', 668727278, '2024-05-15', '2024-05-30', 'individualno'),
(13, 'Abraham', 'Linkoln', 'otrovaseme@lincoln.com', '1945-02-17', '4324234', 2147483647, '2024-05-22', '2024-06-07', 'individualno'),
(14, 'Marko', 'Kon', 'makon@kon.rs', '1975-02-10', '456465', 2147483647, '2024-05-16', '2024-05-30', 'individualno'),
(16, 'Marwin', 'Martian', 'mwartmarw@mars.sd', '1964-12-22', '23114', 12124142, '2024-05-20', '2024-05-30', 'grupno'),
(17, 'Jacob', 'Rotchild', 'ad@sadasd.ewr', '1920-01-15', '21231', 43253532, '2024-05-16', '2024-05-24', 'individualno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
