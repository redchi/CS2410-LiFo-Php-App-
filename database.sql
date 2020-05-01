-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2020 at 04:05 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.3.17-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_180050734_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Description` varchar(1000) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Category` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Colour` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `DateFound` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Name`, `Description`, `Category`, `Colour`, `Location`, `DateFound`) VALUES
(17, 'Iphone 8', 'Undamaged, found near a bench at Olton gulf club', 'phone', 'Black ', 'Bordesley Green Birmingham', '2020-03-22'),
(18, 'Iphone X', 'Does not turn on, found on the floor ', 'phone', 'White', 'Saltley Birmingham', '2020-04-12'),
(19, 'Galaxy S10', 'Phone is bricked', 'phone', 'Blue', 'Solihull', '2020-04-05'),
(20, 'Silver round pendant', 'No damage, found near H&M', 'jewellery', 'Silver', 'Fort shopping park Birmingham', '2019-12-12'),
(21, 'Gold chain', 'Cannot be closed, found near SU', 'jewellery', 'Gold ', 'Aston University ', '2020-04-21'),
(22, 'Gold ring ', 'found this near bullring', 'jewellery', 'Gold', 'Birmingham City Centre', '2020-03-05'),
(23, 'Dog', 'Collar says his name is clover.', 'pet', 'light brown', 'Birmingham City Centre', '2020-03-08'),
(24, 'Cat', 'No name but has a collar', 'pet', 'White', 'Star City Birmingham', '2020-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `RequestID` int(11) NOT NULL,
  `Description` varchar(1000) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`RequestID`, `Description`) VALUES
(6, 'I lost a gold ring like that recently and I have the receipt to prove I bought it.'),
(7, 'I wouldn\'t mind adopting the cute pug. '),
(11, 'This is my phone, I think I dropped it. can I have it back?'),
(12, 'I want this dog !!!!'),
(13, 'I bought this, I have a photo of me holding it.');

-- --------------------------------------------------------

--
-- Table structure for table `requeststouseranditem`
--

CREATE TABLE `requeststouseranditem` (
  `RequestID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `requeststouseranditem`
--

INSERT INTO `requeststouseranditem` (`RequestID`, `ItemID`, `UserID`) VALUES
(6, 22, 3),
(7, 23, 3),
(11, 19, 4),
(12, 23, 4),
(13, 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `HashedPassword` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `HashedPassword`) VALUES
(1, 'admin', 'asim1289@gmail.com', '$2y$10$qnrEqlFE6jd5FqWASiqFqeNfAX5WLHRFVRRK6GTuaPFBVCuEMs03u'),
(2, 'asim1289', '180050734@aston.ac.uk', '$2y$10$annVNoQof.FOeb7myNmRIep1F1Wk.5Y6fF0y1wt.liLG0pIuXMjbi'),
(3, 'JohnH', '180105838@aston.ac.uk', '$2y$10$4PRVu00N8YAWl3PFbpQYKepg91pkshxD7Fsc.J/XGi9/AnjnwVpyW'),
(4, 'Shrey', 'patelshrey16@hotmail.co.uk', '$2y$10$Q.45SU9qbWwHWiLimO2OxOfkcT3TCNsr/3VToQgYbdt5vS3nC4UKC');

-- --------------------------------------------------------

--
-- Table structure for table `userstofounditems`
--

CREATE TABLE `userstofounditems` (
  `ItemID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `userstofounditems`
--

INSERT INTO `userstofounditems` (`ItemID`, `UserID`) VALUES
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `requeststouseranditem`
--
ALTER TABLE `requeststouseranditem`
  ADD KEY `ItemID_FK2` (`ItemID`),
  ADD KEY `RequestID_FK` (`RequestID`),
  ADD KEY `UserID_FK2` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `userstofounditems`
--
ALTER TABLE `userstofounditems`
  ADD KEY `ItemID_FK` (`ItemID`),
  ADD KEY `UserID_FK` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `requeststouseranditem`
--
ALTER TABLE `requeststouseranditem`
  ADD CONSTRAINT `ItemID_FK2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`) ON DELETE CASCADE,
  ADD CONSTRAINT `RequestID_FK` FOREIGN KEY (`RequestID`) REFERENCES `requests` (`RequestID`) ON DELETE CASCADE,
  ADD CONSTRAINT `UserID_FK2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `userstofounditems`
--
ALTER TABLE `userstofounditems`
  ADD CONSTRAINT `ItemID_FK` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`) ON DELETE CASCADE,
  ADD CONSTRAINT `UserID_FK` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
