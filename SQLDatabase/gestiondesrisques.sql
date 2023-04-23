-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 08:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestiondesrisques`
--

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `idpersorisque` int(11) NOT NULL,
  `idpersonnel` int(11) NOT NULL,
  `idtyperisque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`idpersorisque`, `idpersonnel`, `idtyperisque`) VALUES
(1, 2, 1),
(2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `idpersonnel` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`idpersonnel`, `role`, `nom`, `prenom`, `user`, `password`) VALUES
(1, 1, 'AMAADOR', 'OMAR', 'admin', 'admin'),
(2, 2, 'AMAADOR', 'ALAL', 'manager', 'manager'),
(3, 3, 'AMAADOR', 'MUSTAPHA', 'employe', 'employe'),
(4, 3, 'RACHA', 'AL', 'racha', 'racha'),
(5, 2, 'DAHMAD', 'SAAD', 'manager2', 'manager2'),
(6, 3, 'AMA', 'OM', 'personnel1', 'personnel1');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `idprojet` int(11) NOT NULL,
  `nom` text NOT NULL,
  `description` text NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`idprojet`, `nom`, `description`, `datedebut`, `datefin`) VALUES
(2, 'eShopping', 'Un site de vente en ligne', '2022-06-01', '2022-07-21'),
(3, 'Hotel SA', 'Un site web de réservation en ligne', '2022-05-12', '2022-07-29'),
(4, 'Forum IA est l\'avenir', 'organisation d\'un forum de discussion sur l\'IA', '2022-05-31', '2022-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `status`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'employe');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `idtache` int(11) NOT NULL,
  `idprojet` int(11) NOT NULL,
  `idpersonnel` int(11) NOT NULL,
  `priorite` int(11) NOT NULL,
  `idtyperisque` int(11) NOT NULL,
  `description` text NOT NULL,
  `probabilite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`idtache`, `idprojet`, `idpersonnel`, `priorite`, `idtyperisque`, `description`, `probabilite`) VALUES
(1, 2, 3, 4, 1, 'Implementation d\'un Payment Gateway', 4),
(2, 3, 3, 4, 1, 'Conception d\'un API adapté pour tout type de plateforme', 3),
(3, 2, 4, 4, 1, 'Implementation de VueJS et NodeJS', 2),
(11, 2, 6, 1, 1, 'Development Frontend du Page Login/Logout', 1),
(13, 4, 6, 2, 1, 'Installation des cameras de surveillance', 4);

-- --------------------------------------------------------

--
-- Table structure for table `typerisque`
--

CREATE TABLE `typerisque` (
  `idtype` int(11) NOT NULL,
  `nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `typerisque`
--

INSERT INTO `typerisque` (`idtype`, `nom`) VALUES
(1, 'Techniques'),
(2, 'Humaines'),
(3, 'Juridiques'),
(4, 'Délais'),
(5, 'Interinsèques');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`idpersorisque`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`idpersonnel`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`idprojet`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`idtache`),
  ADD KEY `idprojet` (`idprojet`),
  ADD KEY `idpersonnel` (`idpersonnel`),
  ADD KEY `idtyperisque` (`idtyperisque`);

--
-- Indexes for table `typerisque`
--
ALTER TABLE `typerisque`
  ADD PRIMARY KEY (`idtype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `idpersorisque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `idpersonnel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `idprojet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `idtache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `typerisque`
--
ALTER TABLE `typerisque`
  MODIFY `idtype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`idrole`);

--
-- Constraints for table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`idprojet`) REFERENCES `projects` (`idprojet`),
  ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`idpersonnel`) REFERENCES `personnel` (`idpersonnel`),
  ADD CONSTRAINT `tache_ibfk_3` FOREIGN KEY (`idtyperisque`) REFERENCES `typerisque` (`idtype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
