-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 12:03 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandelis`
--

-- --------------------------------------------------------

--
-- Table structure for table `busena`
--

CREATE TABLE `busena` (
  `id` int(11) NOT NULL,
  `busena` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `busena`
--

INSERT INTO `busena` (`id`, `busena`) VALUES
(1, 'Siūloma'),
(2, 'Priimta'),
(3, 'Atmesta');

-- --------------------------------------------------------

--
-- Table structure for table `pardavimas`
--

CREATE TABLE `pardavimas` (
  `id` int(11) NOT NULL,
  `kiekis` int(11) NOT NULL,
  `suma` double NOT NULL,
  `vadybininkoid` int(11) NOT NULL,
  `prekes_kodas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pardavimas`
--

INSERT INTO `pardavimas` (`id`, `kiekis`, `suma`, `vadybininkoid`, `prekes_kodas`) VALUES
(2, 5, 0.99, 153441509, 68),
(3, 25, 1.72, 0, 75);

-- --------------------------------------------------------

--
-- Table structure for table `pasiulymai`
--

CREATE TABLE `pasiulymai` (
  `kodas` int(11) NOT NULL,
  `pavadinimas` varchar(25) NOT NULL,
  `kiekis` int(11) NOT NULL,
  `kaina` double NOT NULL,
  `busena` int(11) NOT NULL,
  `tiekejoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasiulymai`
--

INSERT INTO `pasiulymai` (`kodas`, `pavadinimas`, `kiekis`, `kaina`, `busena`, `tiekejoid`) VALUES
(1, 'Bananai', 50, 0.11, 3, 153441509),
(2, 'Obuoliai', 504, 0.25, 2, 153441509),
(3, 'Vynas', 454, 1.54, 2, 4731),
(4, 'Gira', 454, 2.54, 2, 4731),
(5, 'Lego', 465, 2.45, 2, 4731),
(6, 'Vynas', 10, 2, 2, 4731),
(7, 'Kokosai', 45, 2, 3, 4731),
(9, 'Iphone', 787, 547.99, 1, 4731);

-- --------------------------------------------------------

--
-- Table structure for table `preke`
--

CREATE TABLE `preke` (
  `kodas` int(11) NOT NULL,
  `pavadinimas` varchar(25) NOT NULL,
  `kiekis` int(11) NOT NULL,
  `kaina` double NOT NULL,
  `tiekejoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preke`
--

INSERT INTO `preke` (`kodas`, `pavadinimas`, `kiekis`, `kaina`, `tiekejoid`) VALUES
(67, 'Obuoliai', 6033, 0.21, 153441509),
(68, 'Fanta', 910, 0.83, 153441509),
(69, 'Braškės', 50, 0.68, 153441509),
(70, 'Bananai', 170, 0.11, 153441509),
(75, 'Vynas', 5561, 1.54, 4731),
(77, 'Kokosai', 40, 2, 4731);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `pavadinimas`) VALUES
(1, 'Administratorius'),
(2, 'Vadybininkas'),
(3, 'Sandėlininkas'),
(4, 'Tiekėjas');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojas`
--

CREATE TABLE `vartotojas` (
  `vartotojo_id` int(11) NOT NULL,
  `slapyvardis` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `slaptazodis` varchar(40) NOT NULL,
  `vardas` varchar(25) NOT NULL,
  `pavarde` varchar(25) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vartotojas`
--

INSERT INTO `vartotojas` (`vartotojo_id`, `slapyvardis`, `email`, `slaptazodis`, `vardas`, `pavarde`, `roles_id`) VALUES
(0, 'vadyb', 'asdasd@gmail.com', 'be2aaa13ec4111b1716c9a18acaf96fe', 'Tomas', 'adsasd', 2),
(74, 'sandel', 'petras@gmail.com', '388c87eb3775b67019812d83fe6af289', 'Petras', 'Petraitis', 3),
(4731, 'tiekejas', 'gytis@gmail.com', '9ad65f42e8639badc03d6477be835812', 'Gytis', 'Petraitis', 4),
(153441509, 'admin', 'email@gmail.com', '6e5b5410415bde908bd4dee15dfb167a', 'Rytis', 'Kačinskis', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `busena`
--
ALTER TABLE `busena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pardavimas`
--
ALTER TABLE `pardavimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vadybininkoid` (`vadybininkoid`),
  ADD KEY `prekes_kodas` (`prekes_kodas`);

--
-- Indexes for table `pasiulymai`
--
ALTER TABLE `pasiulymai`
  ADD PRIMARY KEY (`kodas`),
  ADD KEY `pasiulymo_tiekejas` (`tiekejoid`),
  ADD KEY `pasiulymo_busena` (`busena`);

--
-- Indexes for table `preke`
--
ALTER TABLE `preke`
  ADD PRIMARY KEY (`kodas`),
  ADD KEY `tiekejoid` (`tiekejoid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD PRIMARY KEY (`vartotojo_id`),
  ADD KEY `role` (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `busena`
--
ALTER TABLE `busena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pardavimas`
--
ALTER TABLE `pardavimas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasiulymai`
--
ALTER TABLE `pasiulymai`
  MODIFY `kodas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `preke`
--
ALTER TABLE `preke`
  MODIFY `kodas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pardavimas`
--
ALTER TABLE `pardavimas`
  ADD CONSTRAINT `pardavimo_preke` FOREIGN KEY (`prekes_kodas`) REFERENCES `preke` (`kodas`),
  ADD CONSTRAINT `pardavimo_vadybininkas` FOREIGN KEY (`vadybininkoid`) REFERENCES `vartotojas` (`vartotojo_id`);

--
-- Constraints for table `pasiulymai`
--
ALTER TABLE `pasiulymai`
  ADD CONSTRAINT `pasiulymo_busena` FOREIGN KEY (`busena`) REFERENCES `busena` (`id`),
  ADD CONSTRAINT `pasiulymo_tiekejas` FOREIGN KEY (`tiekejoid`) REFERENCES `vartotojas` (`vartotojo_id`);

--
-- Constraints for table `preke`
--
ALTER TABLE `preke`
  ADD CONSTRAINT `prekes_tiekejas` FOREIGN KEY (`tiekejoid`) REFERENCES `vartotojas` (`vartotojo_id`);

--
-- Constraints for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD CONSTRAINT `vartotojo_role` FOREIGN KEY (`roles_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
