-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2017 at 04:44 PM
-- Server version: 5.7.17-log
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `partenaire`
--

-- --------------------------------------------------------

--
-- Table structure for table `affectation`
--

CREATE TABLE `affectation` (
  `idDonation` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `montant` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `affectation`
--

INSERT INTO `affectation` (`idDonation`, `idProjet`, `montant`) VALUES
(5, 2, 10000),
(5, 1, 5000),
(6, 1, 2000),
(7, 1, 200),
(8, 1, 100),
(10, 1, 50),
(11, 1, 2650),
(14, 1, 1000),
(15, 1, 1000),
(16, 1, 100),
(17, 1, 7000),
(18, 1, 10),
(19, 1, 100),
(20, 1, 1),
(21, 3, 5000),
(21, 1, 250),
(22, 1, 1),
(23, 1, 10),
(24, 1, 10),
(25, 1, 10),
(26, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `idDonation` int(11) NOT NULL,
  `montant` float NOT NULL,
  `idPartenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`idDonation`, `montant`, `idPartenaire`) VALUES
(5, 15000, 8),
(6, 2000, 9),
(7, 200, 10),
(8, 100, 11),
(10, 50, 13),
(11, 2650, 14),
(14, 1000, 14),
(15, 1000, 8),
(16, 100, 2),
(17, 7000, 14),
(18, 10, 8),
(19, 100, 2),
(20, 1, 2),
(21, 5250, 2),
(22, 1, 2),
(23, 10, 15),
(24, 10, 15),
(25, 10, 16),
(26, 10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `idPartenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idNotification`, `libelle`, `ip`, `idPartenaire`) VALUES
(1, 'Tentatives excédées', '127.0.0.1', 2),
(2, 'Tentatives excédées', '127.0.0.1', 8),
(3, 'Tentatives excédées', '127.0.0.1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `partenaire`
--

CREATE TABLE `partenaire` (
  `idPartenaire` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `motDePasse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partenaire`
--

INSERT INTO `partenaire` (`idPartenaire`, `nom`, `login`, `motDePasse`) VALUES
(2, 'user', 'user', 'password'),
(8, 'Apple', 'Apple195', 'V3%5ene4u6'),
(9, 'Microsoft', 'Micros896', 'T3£31osatm'),
(10, 'Motorola', 'Motoro210', 'D3$69kzjkq'),
(11, 'Nokia', 'Nokia427', 'I0%qgs3!!5'),
(13, 'Instagram', 'Instag980', 'Z7%#ysmz35'),
(14, 'TF1', 'TF1306', 'Z0$£208b!s'),
(15, 'testorg', 'Testor59', 'G5#noyp£kc'),
(16, 'Saint-Gabriel', 'Saint-855', 'D8@x39%%!u');

-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

CREATE TABLE `projet` (
  `idProjet` int(11) NOT NULL,
  `nomProjet` varchar(100) NOT NULL,
  `couverture` varchar(255) NOT NULL,
  `descriptionProjet` varchar(500) NOT NULL,
  `montantAPayer` float NOT NULL,
  `montantActuel` float NOT NULL,
  `importance` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`idProjet`, `nomProjet`, `couverture`, `descriptionProjet`, `montantAPayer`, `montantActuel`, `importance`) VALUES
(1, 'Egalité pour tous', 'egalite.png', 'Ce projet vise à apporter des soins aux plus démunis.', 20000, 498, 1),
(2, 'Opération cancer', 'cancer.jpg', 'Solide étude visant à mettre à jour des découvertes importantes sur le cancer.', 10000, 0, 2),
(3, 'Sauvetage des animaux d\'Afrique', 'animaux.jpg', 'Initiative lancée par la SPA dans le but d\'adopter un maximum d\'animaux (principalement des chiens et de chats) abandonnés par leur famille.', 5000, 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectation`
--
ALTER TABLE `affectation`
  ADD KEY `idDonation` (`idDonation`),
  ADD KEY `idProjet` (`idProjet`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`idDonation`),
  ADD KEY `idPartenaire` (`idPartenaire`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `idPartenaire` (`idPartenaire`);

--
-- Indexes for table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`idPartenaire`);

--
-- Indexes for table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`idProjet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `idDonation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `idPartenaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `projet`
--
ALTER TABLE `projet`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affectation_ibfk_1` FOREIGN KEY (`idDonation`) REFERENCES `donation` (`idDonation`),
  ADD CONSTRAINT `affectation_ibfk_2` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`);

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`idPartenaire`) REFERENCES `partenaire` (`idPartenaire`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`idPartenaire`) REFERENCES `partenaire` (`idPartenaire`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
