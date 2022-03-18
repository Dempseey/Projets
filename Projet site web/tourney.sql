-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 02:42 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourney`
--

-- --------------------------------------------------------

--
-- Table structure for table `match_t`
--

CREATE TABLE IF NOT EXISTS `match_t` (
  `matchId` int(11) NOT NULL AUTO_INCREMENT,
  `tourneyId` int(11) NOT NULL,
  `poolId` int(11) DEFAULT NULL,
  `stateM` int(1) NOT NULL DEFAULT '0',
  `teamId1` int(11) NOT NULL,
  `teamId2` int(11) NOT NULL,
  `scoreTeam1` int(11) DEFAULT NULL,
  `scoreTeam2` int(11) DEFAULT NULL,
  `startedDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  `bracketM` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`matchId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `match_t`
--

INSERT INTO `match_t` (`matchId`, `tourneyId`, `poolId`, `stateM`, `teamId1`, `teamId2`, `scoreTeam1`, `scoreTeam2`, `startedDate`, `endDate`, `winner`, `bracketM`) VALUES
(3, 1, NULL, 3, 8, 15, 0, 3, NULL, NULL, 15, 1),
(4, 1, NULL, 3, 5, 3, 0, 1, NULL, NULL, NULL, 1),
(5, 1, NULL, 0, 14, 7, NULL, NULL, NULL, NULL, NULL, 1),
(6, 1, NULL, 0, 2, 6, NULL, NULL, NULL, NULL, NULL, 1),
(7, 1, NULL, 0, 13, 12, NULL, NULL, NULL, NULL, NULL, 1),
(8, 1, NULL, 0, 4, 10, NULL, NULL, NULL, NULL, NULL, 1),
(9, 1, NULL, 0, 9, 1, NULL, NULL, NULL, NULL, NULL, 1),
(10, 1, NULL, 0, 11, 16, NULL, NULL, NULL, NULL, NULL, 1),
(11, 1, NULL, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `player_t`
--

CREATE TABLE IF NOT EXISTS `player_t` (
  `playerId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `teamId` int(11) NOT NULL,
  `genre` varchar(3) NOT NULL,
  `age` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `team_t`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `team_t`
--

INSERT INTO `team_t` (`teamId`, `teamName`, `tourneyId`, `levelT`, `phone`, `address`, `playerList`, `validation`, `IdProfile`, `bracket`) VALUES
(1, 'Les Dragons Jaunes', 1, 0, 0, '', '', 1, '', 1),
(2, 'Les aveugles', 1, 0, 0, '', '', 1, '', 1),
(3, 'Les bebes', 1, 0, 0, '', '', 1, '', 1),
(4, 'Les sacrifices', 1, 0, 0, '', '', 1, '', 1),
(5, 'Les inconnus', 1, 0, 0, '', '', 1, '', 1),
(6, 'Les roues de secours', 1, 0, 0, '', '', 1, '', 1),
(7, 'LEs inconnus', 1, 0, 0, '', '', 1, '', 1),
(8, 'Les lignes', 1, 0, 0, '', '', 1, '', 1),
(9, 'Les Bleus', 1, 0, 0, '', '', 1, '', 1),
(10, 'Les carambars', 1, 0, 0, '', '', 1, '', 1),
(11, 'Les nuls', 1, 0, 0, '', '', 1, '', 1),
(12, 'Les Regis', 1, 0, 0, '', '', 1, '', 1),
(13, 'Les IlsSontLa', 1, 0, 0, '', '', 1, '', 1),
(14, 'Les Dragons du JApon', 1, 0, 0, '', '', 1, '', 1),
(15, 'Les euh...', 1, 0, 0, '', '', 1, '', 1),
(16, 'Les Flanders', 1, 0, 0, '', '', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_t`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tournament_t`
--

INSERT INTO `tournament_t` (`tourneyId`, `manager`, `nameT`, `tourneyType`, `sport`, `beginningDate`, `endingDate`, `NbTeam`, `NbPls`, `location`, `stateT`, `logT`, `bracketR`) VALUES
(1, 'Jean-Marie', 'Ligues Des Champions', '2', 'Football', '2021-05-11', '2021-07-05', 13, NULL, 'Paris', 2, 'Mathieu', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE IF NOT EXISTS `user_t` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `category` int(1) NOT NULL,
  PRIMARY KEY (`idU`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `password` (`password`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
