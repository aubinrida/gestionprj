-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 30 Janvier 2013 à 00:59
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;gchshjszhjedzbnesghhedg

--
-- Base de données: `gestion_projet_db`
--
CREATE DATABASE `gestion_projet_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestion_projet_db`;

-- --------------------------------------------------------

--
-- Structure de la table `chef de projet`
--

CREATE TABLE IF NOT EXISTS `chef de projet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `Tel` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Login` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `chef de projet`
--

INSERT INTO `chef de projet` (`ID`, `Nom`, `Tel`, `Email`, `Adresse`, `Login`, `Password`) VALUES
(1, 'Ahmed Gazimi', '0666-876545', 'ahmed.gazimi@gmail.com', '32, rue 502 cité BAHARA, Agadir', 'ahmedgazimi', 'ahmedgazimi'),
(2, 'Khalid El Mensouri', '0667-765433', 'khalid.mensouri@gmail.com', '45, rue 390, Marrakech', 'khalidmensouri', 'khalidmensouri'),
(3, 'Walid Bouni', '0679-656798', 'walidbouni@gmail.com', '76, El Ouelfa, Casablanca', 'walidbouni', 'walidbouni'),
(4, 'Mohamed Maatouki', '0672-554328', 'mohamed.maatouki@gmail.com', '56, Bouargane, Agadir', 'mohamedmaatouki', 'mohamedmaatouki'),
(5, 'Rachid Esakhi', '0668-654533', 'rachid.esakhi@gmail.com', '21, Hay SALAM, Agadir', 'rachidesakhi', 'rachidesakhi');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `Tel` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Login` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`ID`, `Nom`, `Tel`, `Email`, `Adresse`, `Login`, `Password`) VALUES
(1, 'Net Solutions', '0528-232123', 'contact@net-solutions.ma', 'Net Solutions sarl, rue 200, Agadir', 'netsolutions', 'netsolutions'),
(2, 'Association Aragane Oil', '0528-232123', 'contact@aragane-oil.ma', 'Association Aragane Oil, rue Al Massira, Tiznit', 'araganeoil', 'araganeoil'),
(3, 'Agri Data', '0528-232123', 'contact@agri-data.com', 'Agri Data sarl, Talborjt, Agadir', 'agridata', 'agridata'),
(4, 'Location de voiture Rachidi', '0528-232123', 'contact@rachidi-car-renting.com', 'Location de voiture Rachidi, Charaf, Agadir', 'rachidicarrenting', 'rachidicarrenting');

-- --------------------------------------------------------

--
-- Structure de la table `compte de récompence`
--

CREATE TABLE IF NOT EXISTS `compte de récompence` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Membre equipeID` int(11) NOT NULL,
  `Points` int(11) NOT NULL,
  `salaire` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `compte_membre` (`Membre equipeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `compte de récompence`
--

INSERT INTO `compte de récompence` (`ID`, `Membre equipeID`, `Points`, `salaire`) VALUES
(1, 1, 3, 6219),
(2, 2, 3, 5267),
(3, 3, -4, 5657),
(4, 4, 7, 7360),
(5, 5, -5, 4955),
(6, 6, 5, 8535),
(7, 7, 2, 5490),
(8, 8, 0, 6020),
(9, 9, 0, 6240),
(10, 10, 12, 8220),
(11, 11, 6, 8210),
(12, 12, 9, 7370),
(13, 13, 1, 5000),
(14, 14, -4, 3000),
(15, 15, 2, 4421),
(16, 16, 2, 5628),
(17, 17, -7, 3717),
(18, 18, -1, 5257),
(19, 19, 0, 4350),
(20, 20, -1, 4420),
(21, 21, 8, 7530);

-- --------------------------------------------------------

--
-- Structure de la table `membre equipe`
--

CREATE TABLE IF NOT EXISTS `membre equipe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Chef de projetID` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Tel` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `date_embauche` date NOT NULL,
  `Login` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `chef de` (`Chef de projetID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `membre equipe`
--

INSERT INTO `membre equipe` (`ID`, `Chef de projetID`, `Nom`, `Tel`, `Email`, `Adresse`, `date_embauche`, `Login`, `Password`) VALUES
(1, 1, 'Saad Taghi', '0677-876654', 'saad.taghi@gmail.com', '24, Les amicales, Agadir', '2011-01-20', 'saadtaghi', 'saadtaghi'),
(2, 1, 'Mohamed Assaad', '0676-776588', 'mohamed.assaad@gmail.com', '66, Les amicales, Agadir', '2012-01-22', 'mohamedassaad', 'mohamedassaad'),
(3, 1, 'Mohamed Bouanas', '0676-787765', 'mohamed.bouanas@gmail.com', '91, Hay SALAM, Agadir', '2010-06-02', 'mohamedbouanas', 'mohamedbouanas'),
(4, 2, 'Said Mounib', '0662-657780', 'said.mounib@gmail.com', '133, Hay SALAM, Agadir', '2012-08-13', 'saidmounib', 'saidmounib'),
(5, 2, 'Baddre Yassine', '0663-659987', 'baddre.yassine@gmail.com', '56, Charaf, Agadir', '2009-08-11', 'baddreyassine', 'baddreyassine'),
(6, 2, 'Mohamed Rafik', '0662-690977', 'mohamed.rafik@gmail.com', '93, Hay SALAM, Agadir', '2006-11-17', 'mohamedrafik', 'mohamedrafik'),
(7, 3, 'Ahmed Rakib', '0666-549987', 'ahmed.rakib@yahoo.com', '97, Hay SALAM, Agadir', '2011-10-29', 'ahmedrakib', 'ahmedrakib'),
(8, 3, 'Yassine Boudelfa', '0666-654322', 'boudelfa.yassine@gmail.com', '87, Hay SALAM, Agadir', '2011-02-11', 'boudelfayassine', 'boudelfayassine'),
(9, 3, 'Khalid Salhi', '0676-665799', 'khalid.salhi@gmail.com', '67, Charaf, Agadir', '2009-04-24', 'khalidsalhi', 'khalidsalhi'),
(10, 3, 'Brahim Mountassir', '0663-989987', 'brahim.mountassir@gmail.com', '87, Dakhla, Agadir', '2012-08-24', 'brahimmountassir', 'brahimmountassir'),
(11, 4, 'Ahmed Sajid', '0666-223755', 'ahmed.sajid@yahoo.com', '48, El Houda, Agadir', '2013-01-02', 'ahmedsajid', 'ahmedsajid'),
(12, 4, 'Abdlekrim El Hamadani', '0666-564327', 'abdlekrim.hamadani@gmail.com', '32, Ihchache, Agadir', '2011-03-04', 'abdlekrimhamadani', 'abdlekrimhamadani'),
(13, 4, 'Moustafa Lehrech', '0666-556096', 'moustafa.lehrech@gmail.com', '76, El Houda, Agadir', '2013-01-04', 'moustafalehrech', 'moustafalehrech'),
(14, 5, 'Jamal Haggouni', '0666-658876', 'jamal.haggouni@gmail.com', '34, Talborjt, Agadir', '2019-08-04', 'jamalhaggouni', 'jamalhaggouni'),
(15, 1, 'Mohamed Rahib', '0626-764533', 'mohamed.rahib@gmail.com', '34, rue 502 Salam, Agadir', '2010-11-09', 'mohamedrahib', 'mohamedrahib'),
(16, 1, 'Rachid Bataal', '0663-876554', 'rachid.bataal@gmail.com', '34, Hay el fath, Rabat', '2010-05-03', 'rachidbataal', 'rachidbataal'),
(17, 2, 'Mohamed Chakir', '0666-565438', 'mohamed.chakir@gmail.com', '45, Hay Riad, Rabat', '2012-01-03', 'mohamedchakir', 'mohamedchakir'),
(18, 2, 'Saad Benbani', '0668-875434', 'saad.benbani@gmail.com', '56, Hay SALAM, Agadir', '2010-05-23', 'saadbenbani', 'saadbenbani'),
(19, 3, 'Ahmed Sadiki', '0668-097754', 'ahmed.sadiki@gmail.com', '34, Hay Ryad, Rabat', '2009-03-23', 'ahmedsadiki', 'ahmedsadiki'),
(20, 3, 'Khalid Morabih', '0677-098875', 'khalid.morabih@gmail.com', '78, Hay Salama, Casablanca', '2009-08-23', 'khalidmorabih', 'khalidmorabih'),
(21, 4, 'Mohamed Goraizim', '0677-766753', 'mohamed.goraizim@gmail.com', '74, Hay el massira, Agadir', '2009-09-23', 'mohamedgoraizim', 'mohamedgoraizim');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientID` int(11) NOT NULL,
  `Chef de projetID` int(11) NOT NULL,
  `Nom_projet` varchar(255) DEFAULT NULL,
  `Desc_projet` varchar(255) DEFAULT NULL,
  `Date_debut` date DEFAULT NULL,
  `Date_fin` date DEFAULT NULL,
  `Durrée_estimé` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `responsable sur` (`Chef de projetID`),
  KEY `client_projet` (`ClientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`ID`, `ClientID`, `Chef de projetID`, `Nom_projet`, `Desc_projet`, `Date_debut`, `Date_fin`, `Durrée_estimé`) VALUES
(1, 1, 1, 'Site web de l''agence Net Solutions ', 'Site web de l''agence Net Solutions, PHP/MySQL HTML/CSS', '2013-01-25', NULL, 30),
(2, 2, 3, 'Site web de l''Association Aragane Oil', 'Site web de l''Association Aragane Oil, Joomla', '2013-01-17', NULL, 20),
(3, 3, 4, 'Agri Data GRH', 'Logiciel de GRH pour la société Agri Data, JAVA/SWING UML Oracle', '2013-01-08', NULL, 90),
(4, 4, 2, 'Rachidi App', 'Application web pour la gestion de Location de voiture Rachidi, JEE(Hibernate JSF) UML PostgreSQL', '2013-01-07', NULL, 50);

-- --------------------------------------------------------

--
-- Structure de la table `super administrateur`
--

CREATE TABLE IF NOT EXISTS `super administrateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `Tel` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Login` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `super administrateur`
--

INSERT INTO `super administrateur` (`ID`, `Nom`, `Tel`, `Email`, `Adresse`, `Login`, `Password`) VALUES
(1, 'Super Administrateur', '070-665432', 'admin@gprojet.com', NULL, 'admin', 'password');

-- --------------------------------------------------------

--
-- Structure de la table `tache critique`
--

CREATE TABLE IF NOT EXISTS `tache critique` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Membre equipeID` int(11) DEFAULT NULL,
  `ProjetID` int(11) NOT NULL,
  `Nom_tache` varchar(255) DEFAULT NULL,
  `Desc_tache` varchar(255) DEFAULT NULL,
  `Date_debut` date DEFAULT NULL,
  `Date_fin` date DEFAULT NULL,
  `Date_critique` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `contient2` (`ProjetID`),
  KEY `membre_tache_critique` (`Membre equipeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `tache critique`
--

INSERT INTO `tache critique` (`ID`, `Membre equipeID`, `ProjetID`, `Nom_tache`, `Desc_tache`, `Date_debut`, `Date_fin`, `Date_critique`) VALUES
(1, 2, 1, 'Réalisation de la Charte Graphique', 'Couleurs, logos, maquette,...', '2013-01-25', '2013-01-31', '2013-01-30'),
(2, 10, 2, 'Réalisation de la Charte Graphique', 'Couleurs, logos, maquette,...', '2013-01-17', '2013-01-27', '2013-01-29'),
(3, 7, 2, 'Choix de la bonne template', 'Choisir une bonne template qui va avec la charte graphique', '2013-01-29', '2013-01-29', '2013-01-31'),
(4, NULL, 3, 'Réalisation du cahier des charges du Logiciel de GRH pour la société Agri Data', 'Définir les spécéfications techniques et fonctionnelles du Logiciel de GRH dans le cahier des charges', '2013-01-08', NULL, '2013-01-16'),
(5, NULL, 3, 'Modélisation de la base de donnée du Logiciel de GRH', 'Modélisation de la base de donnée avec UML sous l''outil Visual Paradigm', '2013-01-16', NULL, '2013-01-30'),
(7, 6, 4, 'Réalisation du cahier des charges de l''application web pour la gestion de Location de voiture Rachidi', 'Définir les spécéfications techniques et fonctionnelles de l''application web pour la gestion de Location de voiture Rachidi dans le cahier des charges', '2013-01-07', '2011-01-14', '2013-01-16'),
(9, 4, 4, 'Modélisation de la base de donnée de l''application web pour la gestion de Location de voiture Rachidi', 'Modélisation de la base de donnée avec UML sous l''outil Visual Paradigm', '2013-01-16', '2013-01-28', '2013-01-28'),
(10, 16, 1, 'Développement de la Frontend', 'Développement de la Frontend, PHP/MySQL, HTML/CSS', '2013-01-30', NULL, '2013-02-21'),
(11, 15, 1, 'Tests Frontend', 'Tests des differents pages de la Frontend', '2013-02-21', '2013-02-25', '2013-02-23'),
(12, 1, 1, 'Tests Backend', 'Tests des differents fonctionalités de la Backend', '2013-02-18', NULL, '2013-02-22'),
(13, NULL, 2, 'Tests Frontend', 'Tests des differents pages de la Frontend', '2013-02-01', NULL, '2013-02-03'),
(14, NULL, 3, 'Tests fonctionnels', 'Tests des fonctionnels du Logiciel de GRH pour la société Agri Data', '2013-03-24', NULL, '2013-03-30'),
(15, NULL, 3, 'Tests structurels', 'Tests des structurels du Logiciel de GRH pour la société Agri Data', '2013-03-24', NULL, '2013-03-30'),
(16, 18, 4, 'Tests fonctionnels', 'Tests des fonctionnels de l''application web pour la gestion de Location de voiture Rachidi', '2013-03-10', NULL, '2013-03-16'),
(17, NULL, 4, 'Tests structurels', 'Tests des structurels de l''application web pour la gestion de Location de voiture Rachidi', '2013-03-10', NULL, '2013-03-15');

--
-- Déclencheurs `tache critique`
--
DROP TRIGGER IF EXISTS `raise_points_tache_critique`;
DELIMITER //
CREATE TRIGGER `raise_points_tache_critique` BEFORE UPDATE ON `tache critique`
 FOR EACH ROW BEGIN 
		IF (NEW.`Date_fin` <= NEW.`Date_critique`) THEN
			UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;
		IF (NEW.`Date_fin` > NEW.`Date_critique`) THEN
			UPDATE  `compte de récompence` SET  Points = Points-3 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;
		
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tache non critique`
--

CREATE TABLE IF NOT EXISTS `tache non critique` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Membre equipeID` int(11) DEFAULT NULL,
  `ProjetID` int(11) NOT NULL,
  `Nom_tache` varchar(255) DEFAULT NULL,
  `Desc_tache` varchar(255) DEFAULT NULL,
  `Date_debut` date DEFAULT NULL,
  `Date_fin` date DEFAULT NULL,
  `Date_plustard` date DEFAULT NULL,
  `Date_plustot` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `contient` (`ProjetID`),
  KEY `membre_tache_non_critique` (`Membre equipeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `tache non critique`
--

INSERT INTO `tache non critique` (`ID`, `Membre equipeID`, `ProjetID`, `Nom_tache`, `Desc_tache`, `Date_debut`, `Date_fin`, `Date_plustard`, `Date_plustot`) VALUES
(1, 3, 1, 'Développement de la Backend', 'Développement de la Backend, PHP/MySQL, HTML/CSS', '2013-01-25', '2013-02-19', '2013-02-18', '2013-02-12'),
(3, NULL, 2, 'Création des différents modules et articles sous Joomla', 'Création des langues, menus, articles, installations des exenions sous Joomla', '2013-01-17', NULL, '2013-02-01', '2013-01-30'),
(4, NULL, 3, 'Design des interfaces graphiques du Logiciel de GRH', 'Couleurs, polices, mise en forme,...', '2013-01-16', NULL, '2013-01-30', '2013-01-27'),
(5, NULL, 3, 'Développement de la partie métier du Logiciel de GRH', 'Développement de la partie métier avec JAVA/SWING sous NetBeans', '2013-02-01', NULL, '2013-03-24', '2013-03-10'),
(6, NULL, 3, 'Rédaction du manuel du Logiciel de GRH', 'Rédaction du manuel qui explique en détails les différentes fonctionnalités du logiciel', '2013-03-24', NULL, '2013-04-03', '2013-03-31'),
(7, NULL, 4, 'Design des interfaces graphiques de l''application web pour la gestion de Location de voiture Rachidi', 'Couleurs, polices, mise en forme,...', '2013-01-07', NULL, '2013-01-21', '2013-01-17'),
(8, NULL, 4, 'Développement de la partie métier de l''application web pour la gestion de Location de voiture Rachidi', 'Développement de la partie métier avec JEE(Hibernate, JSF) sous NetBeans', '2013-01-28', NULL, '2013-03-10', '2013-03-05'),
(9, NULL, 4, 'Rédaction du manuel de l''application web pour la gestion de Location de voiture Rachidi', 'Rédaction du manuel qui explique en détails les différentes fonctionnalités de l''application', '2013-03-05', NULL, '2013-03-12', '2013-03-10');

--
-- Déclencheurs `tache non critique`
--
DROP TRIGGER IF EXISTS `raise_points_tache_nn_critique`;
DELIMITER //
CREATE TRIGGER `raise_points_tache_nn_critique` BEFORE UPDATE ON `tache non critique`
 FOR EACH ROW BEGIN 
	IF (NEW.`Date_fin` <= NEW.`Date_plustot`) THEN
		UPDATE  `compte de récompence` SET  Points = Points+2 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;
	IF ((NEW.`Date_fin` > NEW.`Date_plustot`) AND (NEW.`Date_fin` <= NEW.`Date_plustard`)) THEN
		UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;
	IF (NEW.`Date_fin` > NEW.`Date_plustard`) THEN
		UPDATE  `compte de récompence` SET  Points = Points-1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;		
END
//
DELIMITER ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `compte de récompence`
--
ALTER TABLE `compte de récompence`
  ADD CONSTRAINT `compte_membre` FOREIGN KEY (`Membre equipeID`) REFERENCES `membre equipe` (`ID`);

--
-- Contraintes pour la table `membre equipe`
--
ALTER TABLE `membre equipe`
  ADD CONSTRAINT `chef de` FOREIGN KEY (`Chef de projetID`) REFERENCES `chef de projet` (`ID`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `client_projet` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ID`),
  ADD CONSTRAINT `responsable sur` FOREIGN KEY (`Chef de projetID`) REFERENCES `chef de projet` (`ID`);

--
-- Contraintes pour la table `tache critique`
--
ALTER TABLE `tache critique`
  ADD CONSTRAINT `contient2` FOREIGN KEY (`ProjetID`) REFERENCES `projet` (`ID`),
  ADD CONSTRAINT `membre_tache_critique` FOREIGN KEY (`Membre equipeID`) REFERENCES `membre equipe` (`ID`);

--
-- Contraintes pour la table `tache non critique`
--
ALTER TABLE `tache non critique`
  ADD CONSTRAINT `contient` FOREIGN KEY (`ProjetID`) REFERENCES `projet` (`ID`),
  ADD CONSTRAINT `membre_tache_non_critique` FOREIGN KEY (`Membre equipeID`) REFERENCES `membre equipe` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
