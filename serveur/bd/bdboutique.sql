-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2023 at 04:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdboutique`
--
CREATE DATABASE IF NOT EXISTS bdboutique DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE bdboutique;
-- --------------------------------------------------------

--
-- Table structure for table `connexion`
--
DROP TABLE IF EXISTS connexion;
CREATE TABLE `connexion` (
  `idm` int(11) NOT NULL,
  `courriel` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `motdepass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `statut` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`idm`, `courriel`, `motdepass`, `role`, `statut`) VALUES
(1, 'admin@deskmate.com', 'Admin88.', 'A', 'A'),
(2, 'william@gmail.com', 'William8.', 'M', 'A'),
(3, 'john@gmail.com', 'Johnjohn8.', 'M', 'A'),
(4, 'carol@gmail.com', 'Carol8..', 'M', 'A'),
(5, 'tata@gmail.com', 'Tata88..', 'M', 'A'),
(6, 'dodo@gmail.com', 'Dodo88..', 'M', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--
DROP TABLE IF EXISTS membres;
CREATE TABLE `membres` (
  `idm` int(11) NOT NULL,
  `prenom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `courriel` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sexe` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datedenaissance` date DEFAULT NULL,
  `photo` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`idm`, `prenom`, `nom`, `courriel`, `sexe`, `datedenaissance`, `photo`) VALUES
(1, 'admin', 'admin', 'admin@deskmate.com', 'F', '2000-01-01', 'avatar.jpg'),
(2, 'smith', 'william', 'william@gmail.com', 'H', '0000-00-00', 'avatar.jpg'),
(3, 'wick', 'john', 'john@gmail.com', 'H', '0000-00-00', '69eb73aea0a65070d38a5966815c671a150cbd12.jpg'),
(4, 'trembly', 'carol', 'carol@gmail.com', 'H', '0000-00-00', 'avatar.jpg'),
(5, 'tata', 'toto', 'tata@gmail.com', 'H', '0000-00-00', 'avatar.jpg'),
(6, 'dodo', 'didi', 'dodo@gmail.com', 'H', '0000-00-00', 'avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--
DROP TABLE IF EXISTS paniers;
CREATE TABLE `paniers` (
  `idm` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `quantiteChoisie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--
DROP TABLE IF EXISTS produits;
CREATE TABLE `produits` (
  `idp` int(11) NOT NULL,
  `pochette` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `prix` decimal(11,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`idp`, `pochette`, `titre`, `categorie`, `description`, `prix`, `quantite`, `date`) VALUES
(3, 'ac4dc6422fc3463d543eaa2ff86aac861de2c133.png', '3M Post-it Super Sticky Rio de Janeiro Collection, 14-pack', 'Fournitures scolaires', '7.62 cm × 7.62 cm (3 in. × 3 in.), Assorted colours, Twice the sticking power, 1260 total sheets', '14.99', 100, '2023-02-12 11:18:02'),
(4, '2a020b0d221d343acbd34f7b7daa0c15362f5e25.png', 'Fellowes Bankers Box 10-pack Heavy-duty Letter/Legal Records', 'Fournitures de bureau', 'Bankers Box heavy-duty letter/legal record storage boxes, FastFold one-step assembly so boxes set up 4 times faster than basic boxes, Triple-ended, double-sided, double-bottomed construction, Deep locking lid for secure closure, Durable, tear-resistant han', '49.99', 30, '2023-02-12 11:22:14'),
(5, '30f7a96abf5e901b961903bdeb8c3bab34318c49.png', 'Fellowes Spectra 95 Laminator Plus 110 3 Mil Thermal Laminat', 'Equipement affaires', 'Total of 110 thermal laminating pouches, 4-minute Warm-up, 24 cm (9.5 in.) Entry, Auto Shut-off', '72.99', 10, '2023-02-12 11:24:31'),
(6, 'e412c1f46cb93543396663a7f8bd7bbbd9ac2a5b.png', 'BIC Wite-Out, Pack of 8', 'Fournitures scolaires', 'Tear-resistant film-based tape, Pack of 8: 5 EZ Correct correction tapes and 3 mini correction tapes, Corrects instantly', '11.99', 50, '2023-02-12 14:15:54'),
(7, 'fa3b7cbef9887ffa1ce6299e68139f2e28b4a981.png', 'Zebra Z-Grip Flight Pen, 30-pack', 'Fournitures scolaires', '1.2mm retractable ballpoint, Soft rubber grip, Sturdy metal clip, Ultra smooth low viscosity ink, Comfort grip', '11.99', 50, '2023-02-12 14:18:15'),
(8, '31f2f69a37aba4907c19b77669700ab04eba2c41.png', 'Swingline® Low Force 40 Stapler', 'Fournitures de bureau', '40-sheet capacity 50% less effort than traditional staplers at every sheet count Magazine holds full strips of 210 staples', '21.99', 30, '2023-02-12 14:19:02'),
(9, '239a0099568383a20490e639925e0d4594ec8ace.png', 'Scotch MT6 Magic Tape with Reusable Dispenser', 'Fournitures de bureau', 'Package of 6 rolls with reusable dispenser, 19 mm x 27.9 m (0.75 in. x 91.5 ft), Total 167 m (549 ft)', '17.99', 30, '2023-02-12 14:19:42'),
(10, 'bcc823e5bf251d060173bc884abfcb7348e35f1c.png', 'Amano Facial Recognition Real-Time Wi-Fi Clock', 'Equipement affaires', 'No contact with terminal, Eliminate buddy punching, WIFI communication, Calculates employee hours, Provides multiple reports', '599.99', 5, '2023-02-12 14:20:30'),
(11, '3cb0481f3eaa34bca0348f39c91ce5f6353b6c25.png', 'Fellowes Lyra 3 in 1 Binding Center plus 25 Document Binding', 'Equipement affaires', 'Bundle includes bonus 25 Document Binding Kit', '299.99', 10, '2023-02-12 14:20:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
  ADD KEY `connexion_idm_FK` (`idm`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idm`);

--
-- Indexes for table `paniers`
--
ALTER TABLE `paniers`
  ADD KEY `paniers_idm_FK` (`idm`),
  ADD KEY `paniers_idp_FK` (`idp`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);

--
-- Constraints for table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`),
  ADD CONSTRAINT `paniers_idp_FK` FOREIGN KEY (`idp`) REFERENCES `produits` (`idp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
