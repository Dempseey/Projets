-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 30 mai 2021 à 15:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tourney`
--

-- --------------------------------------------------------

--
-- Structure de la table `match_t`
--

DROP TABLE IF EXISTS `match_t`;
CREATE TABLE IF NOT EXISTS `match_t` (
  `matchId` int(11) NOT NULL AUTO_INCREMENT,
  `tourneyId` int(11) NOT NULL,
  `poolId` int(11) DEFAULT NULL,
  `stateM` int(1) NOT NULL DEFAULT '0',
  `teamId1` int(11) DEFAULT NULL,
  `teamId2` int(11) DEFAULT NULL,
  `scoreTeam1` int(11) DEFAULT NULL,
  `scoreTeam2` int(11) DEFAULT NULL,
  `startedDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  `bracketM` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`matchId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `player_t`
--

DROP TABLE IF EXISTS `player_t`;
CREATE TABLE IF NOT EXISTS `player_t` (
  `playerId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `teamId` int(11) NOT NULL,
  `genre` varchar(3) NOT NULL,
  `age` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `team_t`
--

DROP TABLE IF EXISTS `team_t`;
CREATE TABLE IF NOT EXISTS `team_t` (
  `teamId` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(255) NOT NULL,
  `tourneyId` int(11) NOT NULL,
  `levelT` int(3) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `playerList` varchar(255) NOT NULL,
  `validation` int(1) NOT NULL DEFAULT '0',
  `IdProfile` varchar(255) NOT NULL,
  `bracket` int(1) DEFAULT NULL,
  PRIMARY KEY (`teamId`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `team_t`
--

INSERT INTO `team_t` (`teamId`, `teamName`, `tourneyId`, `levelT`, `phone`, `address`, `playerList`, `validation`, `IdProfile`, `bracket`) VALUES
(1, 'LOSC', 1, 5, 0, '', '', 0, '', 0),
(2, 'Racing Club de Lens', 1, 10, 0, '', '', 0, '', 0),
(3, 'Saint-Etienne', 1, 15, 0, '', '', 0, '', 0),
(4, 'OM', 1, 20, 0, '', '', 0, '', 0),
(5, 'Dijon', 1, 25, 0, '', '', 0, '', 0),
(6, 'Reims', 1, 30, 0, '', '', 0, '', 0),
(7, 'Stade rennais Football Club', 1, 35, 0, '', '', 0, '', 0),
(8, 'Stade Brestois', 1, 40, 0, '', '', 0, '', 0),
(9, 'Seville', 1, 45, 0, '', '', 0, '', 0),
(10, 'Celtic', 1, 50, 0, '', '', 0, '', 0),
(11, 'Benfica', 1, 55, 0, '', '', 0, '', 0),
(12, 'Bayern', 1, 60, 0, '', '', 0, '', 0),
(13, 'TFC', 1, 65, 0, '', '', 0, '', 0),
(14, 'MHSC', 1, 70, 0, '', '', 0, '', 0),
(15, 'Galatasaray', 1, 80, 0, '', '', 0, '', 0),
(16, 'Barcelone', 1, 75, 612345678, 'lionnel-messi@gmail.com', '[Lionnel Messi]', 0, '', 0),
(17, 'Chelsea', 2, 5, 0, '', '', 1, '', NULL),
(18, 'PSG', 2, 10, 0, '', '', 1, '', NULL),
(19, 'Liverpool', 2, 15, 0, '', '', 1, '', NULL),
(20, 'Juventus', 2, 20, 0, '', '', 1, '', NULL),
(21, 'Inter Milan', 2, 25, 0, '', '', 1, '', NULL),
(22, 'FDS', 2, 30, 612345678, 'fds.l2.l3@umontpellier.fr', '[S. Bessy, A-M. Arigon]', 1, '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tournament_t`
--

DROP TABLE IF EXISTS `tournament_t`;
CREATE TABLE IF NOT EXISTS `tournament_t` (
  `tourneyId` int(11) NOT NULL AUTO_INCREMENT,
  `manager` varchar(255) NOT NULL,
  `nameT` varchar(255) NOT NULL,
  `tourneyType` varchar(255) NOT NULL,
  `sport` varchar(255) NOT NULL,
  `beginningDate` date NOT NULL,
  `endingDate` date NOT NULL,
  `NbTeam` int(2) NOT NULL,
  `NbPls` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `stateT` int(1) NOT NULL DEFAULT '0',
  `logT` varchar(255) NOT NULL,
  `bracketR` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tourneyId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tournament_t`
--

INSERT INTO `tournament_t` (`tourneyId`, `manager`, `nameT`, `tourneyType`, `sport`, `beginningDate`, `endingDate`, `NbTeam`, `NbPls`, `location`, `stateT`, `logT`, `bracketR`) VALUES
(1, 'FFF', 'Coupe de France 1', '1', 'Football', '2021-05-14', '2021-06-14', 8, NULL, 'Paris', 0, 'Manager', 0),
(2, 'FFF', 'Coupe de France 2', '2', 'Football', '2020-05-14', '2020-06-14', 6, NULL, 'Paris', 1, 'Manager', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_t`
--

DROP TABLE IF EXISTS `user_t`;
CREATE TABLE IF NOT EXISTS `user_t` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `category` int(1) NOT NULL,
  PRIMARY KEY (`idU`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_t`
--

INSERT INTO `user_t` (`idU`, `login`, `password`, `email`, `category`) VALUES
(1, 'Manager', '$2y$10$2zjjkhhaBPERVGqrRHxaDObSYav1eOAJaeYXQ96UDBZ2udrm5Z3w.', 'Manager@outlook.fr', 1),
(2, 'Player', '$2y$10$Jgc4sPwCsd3EkQ0a5hsS2OK9ut8N5NOakDp8zmyHLe2joWejRXwy2', 'Player@outlook.fr', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
