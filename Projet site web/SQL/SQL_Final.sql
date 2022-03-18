-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 12 mai 2021 à 13:38
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
