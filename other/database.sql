-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 07 Mai 2012 à 17:39
-- Version du serveur: 5.0.91
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pronostics`
--

-- --------------------------------------------------------

--
-- Structure de la table `Championship`
--

CREATE TABLE IF NOT EXISTS `Championship` (
  `Championship_Id` int(11) NOT NULL auto_increment COMMENT '	',
  `GameType_Id` int(11) NOT NULL,
  `Championship_Name` varchar(45) default NULL,
  `Championship_Begin` date default NULL,
  PRIMARY KEY  (`Championship_Id`,`GameType_Id`),
  KEY `fk_Championship_GameType` (`GameType_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Championship`
--

INSERT INTO `Championship` (`Championship_Id`, `GameType_Id`, `Championship_Name`, `Championship_Begin`) VALUES
(1, 1, 'Championnat de France 2011-2012', '2011-10-03'),
(2, 2, 'Coupe du monde 2011', '2011-10-03');

-- --------------------------------------------------------

--
-- Structure de la table `Championship_has_User`
--

CREATE TABLE IF NOT EXISTS `Championship_has_User` (
  `Championship_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  PRIMARY KEY  (`Championship_Id`,`User_Id`),
  KEY `fk_Championship_has_User_User1` (`User_Id`),
  KEY `fk_Championship_has_User_Championship1` (`Championship_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Championship_has_User`
--

INSERT INTO `Championship_has_User` (`Championship_Id`, `User_Id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Day`
--

CREATE TABLE IF NOT EXISTS `Day` (
  `Day_Id` int(11) NOT NULL auto_increment,
  `Championship_Id` int(11) NOT NULL,
  `Day_Name` varchar(45) default NULL,
  `Day_Prognosis_Begin` datetime default NULL,
  `Day_Prognosis_End` datetime default NULL,
  `Day_Status` tinyint(1) default NULL,
  PRIMARY KEY  (`Day_Id`,`Championship_Id`),
  KEY `fk_Day_Championship1` (`Championship_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Day`
--

INSERT INTO `Day` (`Day_Id`, `Championship_Id`, `Day_Name`, `Day_Prognosis_Begin`, `Day_Prognosis_End`, `Day_Status`) VALUES
(1, 1, '11e Journee', '2012-05-07 00:00:00', '2012-05-07 16:59:59', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Game`
--

CREATE TABLE IF NOT EXISTS `Game` (
  `Game_Id` int(11) NOT NULL auto_increment,
  `Day_Id` int(11) NOT NULL,
  `Game_Team1` varchar(45) default NULL,
  `Game_Team2` varchar(45) default NULL,
  PRIMARY KEY  (`Game_Id`,`Day_Id`),
  KEY `fk_Game_Day1` (`Day_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `Game`
--

INSERT INTO `Game` (`Game_Id`, `Day_Id`, `Game_Team1`, `Game_Team2`) VALUES
(1, 1, 'Saint Etienne', 'Valenciennes'),
(2, 1, 'Nancy', 'Nice'),
(4, 1, 'Sochaux', 'Evian Thonon'),
(5, 1, 'Caen', 'Montpellier'),
(6, 1, 'Marseille', 'Ajaccio'),
(7, 1, 'Bordeaux', 'Brest'),
(8, 1, 'Lorient', 'Toulouse'),
(9, 1, 'Paris SG', 'Dijon'),
(10, 1, 'Auxerre', 'Rennes'),
(11, 1, 'Lille', 'Lyon');

-- --------------------------------------------------------

--
-- Structure de la table `GameType`
--

CREATE TABLE IF NOT EXISTS `GameType` (
  `GameType_Id` int(11) NOT NULL auto_increment,
  `GameType_Name` varchar(45) default NULL,
  PRIMARY KEY  (`GameType_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `GameType`
--

INSERT INTO `GameType` (`GameType_Id`, `GameType_Name`) VALUES
(1, 'football'),
(2, 'Rugby');

-- --------------------------------------------------------

--
-- Structure de la table `Prognosis`
--

CREATE TABLE IF NOT EXISTS `Prognosis` (
  `Prognosis_Id` int(11) NOT NULL auto_increment,
  `Game_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Prognosis_Team1` varchar(45) default NULL,
  `Prognosis_Team2` varchar(45) default NULL,
  `Prognosis_Win` varchar(45) default NULL,
  PRIMARY KEY  (`Prognosis_Id`),
  KEY `fk_Prognosis_Game1` (`Game_Id`),
  KEY `fk_Prognosis_User1` (`User_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Contenu de la table `Prognosis`
--

INSERT INTO `Prognosis` (`Prognosis_Id`, `Game_Id`, `User_Id`, `Prognosis_Team1`, `Prognosis_Team2`, `Prognosis_Win`) VALUES
(131, 1, 1, '1', '0', 'Saint Etienne'),
(132, 2, 1, '1', '0', 'Nancy'),
(133, 4, 1, '1', '1', 'Nul'),
(134, 5, 1, '1', '3', 'Montpellier'),
(135, 6, 1, '2', '0', 'Marseille'),
(136, 7, 1, '1', '1', 'Nul'),
(137, 8, 1, '0', '1', 'Toulouse'),
(138, 9, 1, '2', '0', 'Paris SG'),
(139, 10, 1, '0', '1', 'Rennes'),
(140, 11, 1, '3', '1', 'Lille');

-- --------------------------------------------------------

--
-- Structure de la table `Result`
--

CREATE TABLE IF NOT EXISTS `Result` (
  `Game_Id` int(11) NOT NULL,
  `Result_Team1` varchar(45) default NULL,
  `Result_Team2` varchar(45) default NULL,
  `Result_Win` varchar(45) default NULL,
  PRIMARY KEY  (`Game_Id`),
  KEY `fk_Result_Game1` (`Game_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Result`
--

INSERT INTO `Result` (`Game_Id`, `Result_Team1`, `Result_Team2`, `Result_Win`) VALUES
(1, '1', '0', 'Saint Etienne'),
(2, '1', '0', 'Nancy'),
(4, '1', '1', 'Nul'),
(5, '1', '3', 'Montpellier'),
(6, '2', '0', 'Marseille'),
(7, '1', '1', 'Nul'),
(8, '0', '1', 'Toulouse'),
(9, '2', '0', 'Paris SG'),
(10, '0', '1', 'Rennes'),
(11, '3', '1', 'Lille');

-- --------------------------------------------------------

--
-- Structure de la table `Statistic`
--

CREATE TABLE IF NOT EXISTS `Statistic` (
  `Statistic_id` int(11) NOT NULL auto_increment,
  `User_Id` int(11) NOT NULL,
  `Day_Id` int(11) NOT NULL,
  `Statistic_Point` varchar(45) default NULL,
  PRIMARY KEY  (`Statistic_id`,`User_Id`,`Day_Id`),
  KEY `fk_Statistic_User1` (`User_Id`),
  KEY `fk_Statistic_Day1` (`Day_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Statistic`
--

INSERT INTO `Statistic` (`Statistic_id`, `User_Id`, `Day_Id`, `Statistic_Point`) VALUES
(2, 1, 1, '14');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `User_Id` int(11) NOT NULL auto_increment,
  `User_Email` varchar(45) default NULL,
  `User_Password` varchar(45) default NULL,
  `User_Name` varchar(45) default NULL,
  `User_Lastname` varchar(45) default NULL,
  `User_Admin` int(1) NOT NULL default '0',
  `User_Activity` datetime NOT NULL,
  PRIMARY KEY  (`User_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`User_Id`, `User_Email`, `User_Password`, `User_Name`, `User_Lastname`, `User_Admin`, `User_Activity`) VALUES
(1, 'thomaroger@gmail.com', 'c5e96090a1095f85b57e85e18d2270b0', 'Thomas', 'ROGER', 1, '2012-05-07 17:24:19');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Championship`
--
ALTER TABLE `Championship`
  ADD CONSTRAINT `fk_Championship_GameType` FOREIGN KEY (`GameType_Id`) REFERENCES `GameType` (`GameType_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Championship_has_User`
--
ALTER TABLE `Championship_has_User`
  ADD CONSTRAINT `fk_Championship_has_User_Championship1` FOREIGN KEY (`Championship_Id`) REFERENCES `Championship` (`Championship_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Championship_has_User_User1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Day`
--
ALTER TABLE `Day`
  ADD CONSTRAINT `fk_Day_Championship1` FOREIGN KEY (`Championship_Id`) REFERENCES `Championship` (`Championship_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Game`
--
ALTER TABLE `Game`
  ADD CONSTRAINT `fk_Game_Day1` FOREIGN KEY (`Day_Id`) REFERENCES `Day` (`Day_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Prognosis`
--
ALTER TABLE `Prognosis`
  ADD CONSTRAINT `fk_Prognosis_Game1` FOREIGN KEY (`Game_Id`) REFERENCES `Game` (`Game_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Prognosis_User1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Result`
--
ALTER TABLE `Result`
  ADD CONSTRAINT `fk_Result_Game1` FOREIGN KEY (`Game_Id`) REFERENCES `Game` (`Game_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Statistic`
--
ALTER TABLE `Statistic`
  ADD CONSTRAINT `fk_Statistic_Day1` FOREIGN KEY (`Day_Id`) REFERENCES `Day` (`Day_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Statistic_User1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
