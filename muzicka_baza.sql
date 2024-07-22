-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 06:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muzicka_baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sifra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `ime`, `prezime`, `email`, `sifra`) VALUES
(1, 'Ana', 'Grubacic', 'grubacicana@gmail.com', '$2y$10$PS8dHkbTOmPA6L0JP1'),
(3, 'Aleksa', 'Aleksic', 'aleksic.aleksa@yahoo.com', '$2y$10$PHkbTOmPA6L0JP1rxT5GcOg'),
(6, 'Jovan', 'Jovic', 'jovan@gmail.com', '$2y$10$wFdWB/94z3lbBI9G7I4hL.5');

-- --------------------------------------------------------

--
-- Table structure for table `cas`
--

CREATE TABLE `cas` (
  `ID_cas` int(11) NOT NULL,
  `uciteljID` int(11) NOT NULL,
  `nazivCasa` varchar(50) NOT NULL,
  `cena` int(11) NOT NULL,
  `dostupniTermin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cas`
--

INSERT INTO `cas` (`ID_cas`, `uciteljID`, `nazivCasa`, `cena`, `dostupniTermin`) VALUES
(1111, 11, 'Solfeđo', 2900, '2023-01-09'),
(1112, 11, 'Harmonija', 3900, '2024-04-10'),
(1113, 12, 'Etnomuzikologija', 1300, '2023-11-16'),
(1114, 12, 'Muzički oblici', 2900, '2024-01-23'),
(1115, 13, 'Istorija muzike', 1000, '2023-01-01'),
(1117, 14, 'Muzički instrumenti', 10000, '2023-01-01'),
(1121, 14, 'Dirigovanje', 1900, '2024-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

CREATE TABLE `ocene` (
  `ID` int(11) NOT NULL,
  `IDucenik` int(11) NOT NULL,
  `IDucitelj` int(11) NOT NULL,
  `IDCas` int(11) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ocene`
--

INSERT INTO `ocene` (`ID`, `IDucenik`, `IDucitelj`, `IDCas`, `ocena`) VALUES
(1, 112, 11, 1113, 8),
(2, 117, 11, 1112, 5),
(3, 111, 11, 1111, 10);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `ID_rez` int(11) NOT NULL,
  `ID_cas` int(11) NOT NULL,
  `ID_ucenik` int(11) NOT NULL,
  `datumRezervacije` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`ID_rez`, `ID_cas`, `ID_ucenik`, `datumRezervacije`, `status`) VALUES
(123, 1112, 113, '2023-09-21', 'Slobodno'),
(1562, 1113, 111, '2023-09-06', 'Rezervisano'),
(1598, 1115, 113, '2023-09-11', 'Rezervisano'),
(875871, 1117, 112, '2023-09-07', 'Rezervisano'),
(875880, 1111, 111, '2024-04-11', 'Rezervisano');

-- --------------------------------------------------------

--
-- Table structure for table `ucenik`
--

CREATE TABLE `ucenik` (
  `IDucenika` int(11) NOT NULL,
  `imeUcenika` varchar(30) NOT NULL,
  `prezimeUcenika` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `sifra` varchar(30) NOT NULL,
  `nazivInstrumenta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`IDucenika`, `imeUcenika`, `prezimeUcenika`, `email`, `sifra`, `nazivInstrumenta`) VALUES
(111, 'Milica', 'Milic', 'm.milic@gmail.com', 'milicaa1122', 'Klavir'),
(112, 'Pera', 'Peric', 'p.peric@hotmail.com', '123pera123', 'Violina'),
(113, 'Nikola', 'Hadzic', 'nikola.ha994@gmail.com', '1320', 'Harfa'),
(117, 'Dragan', 'Dragic', 'dragan.dragic@yahoo.com', '$2y$10$z.ME0e5uGxLmmtykiMT31uw', 'Klavir');

-- --------------------------------------------------------

--
-- Table structure for table `ucitelj`
--

CREATE TABLE `ucitelj` (
  `IDucitelja` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `sifra` varchar(30) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ucitelj`
--

INSERT INTO `ucitelj` (`IDucitelja`, `ime`, `prezime`, `email`, `sifra`, `gender`) VALUES
(11, 'Aleksandar', 'Nikolic', 'anikolic@yahoo.com', '$2y$10$qKA2me8rTMv37z2lhnRLaux', 'Male'),
(12, 'Andjela', 'Dragic', 'andjela@yahoo.com', '$2y$10$Fk3iHcATWpFH5KePKkLxAOx', 'Female'),
(13, 'Anja', 'Zdravkovic', 'anja.zdravkovic@gmail.com', '$2y$10$ZCR6X2PK6yAo7cqDqKPSTOs', 'Female'),
(14, 'Jovica', 'Radovanovic', 'jovica.r123@hotmail.com', '$2y$10$hWR5yJeT0XJxfKtmOEvT7ek', 'Male'),
(15, 'Miloš', 'Stanojević', 'milos.s@yahoo.com', '$2y$10$dewDDGTnn9bZDU12EfLzRec', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cas`
--
ALTER TABLE `cas`
  ADD PRIMARY KEY (`ID_cas`),
  ADD KEY `uciteljID` (`uciteljID`);

--
-- Indexes for table `ocene`
--
ALTER TABLE `ocene`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDCas` (`IDCas`),
  ADD KEY `IDucenik` (`IDucenik`),
  ADD KEY `IDucitelj` (`IDucitelj`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`ID_rez`),
  ADD KEY `ID_cas` (`ID_cas`),
  ADD KEY `ID_ucenik` (`ID_ucenik`);

--
-- Indexes for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD PRIMARY KEY (`IDucenika`);

--
-- Indexes for table `ucitelj`
--
ALTER TABLE `ucitelj`
  ADD PRIMARY KEY (`IDucitelja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cas`
--
ALTER TABLE `cas`
  MODIFY `ID_cas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1123;

--
-- AUTO_INCREMENT for table `ocene`
--
ALTER TABLE `ocene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `ID_rez` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=875881;

--
-- AUTO_INCREMENT for table `ucenik`
--
ALTER TABLE `ucenik`
  MODIFY `IDucenika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `ucitelj`
--
ALTER TABLE `ucitelj`
  MODIFY `IDucitelja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cas`
--
ALTER TABLE `cas`
  ADD CONSTRAINT `cas_ibfk_1` FOREIGN KEY (`uciteljID`) REFERENCES `ucitelj` (`IDucitelja`);

--
-- Constraints for table `ocene`
--
ALTER TABLE `ocene`
  ADD CONSTRAINT `ocene_ibfk_1` FOREIGN KEY (`IDCas`) REFERENCES `cas` (`ID_cas`),
  ADD CONSTRAINT `ocene_ibfk_2` FOREIGN KEY (`IDucenik`) REFERENCES `ucenik` (`IDucenika`),
  ADD CONSTRAINT `ocene_ibfk_3` FOREIGN KEY (`IDucitelj`) REFERENCES `ucitelj` (`IDucitelja`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `rezervacija_ibfk_1` FOREIGN KEY (`ID_cas`) REFERENCES `cas` (`ID_cas`),
  ADD CONSTRAINT `rezervacija_ibfk_2` FOREIGN KEY (`ID_ucenik`) REFERENCES `ucenik` (`IDucenika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
