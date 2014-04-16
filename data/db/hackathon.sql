-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 16 Avril 2014 à 10:21
-- Version du serveur: 5.5.35
-- Version de PHP: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hackathon`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dcp`
--

CREATE TABLE IF NOT EXISTS `dcp` (
  `id` int(11) NOT NULL,
  `casClinique` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `son` varchar(255) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `propositionQuestionDcp`
--

CREATE TABLE IF NOT EXISTS `propositionQuestionDcp` (
  `id` int(11) NOT NULL,
  `idDcp` int(11) NOT NULL DEFAULT '0',
  `idQuestionDcp` int(11) NOT NULL DEFAULT '0',
  `nbPoint` int(11) DEFAULT NULL,
  `intitule` text,
  `effetSurPoint` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`idDcp`,`idQuestionDcp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questionDcp`
--

CREATE TABLE IF NOT EXISTS `questionDcp` (
  `id` int(11) NOT NULL,
  `idDcp` int(11) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `intitule` text,
  `nbPoint` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`idDcp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questionIndependante`
--

CREATE TABLE IF NOT EXISTS `questionIndependante` (
  `id` int(11) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `nbPoint` int(11) DEFAULT NULL,
  `intitule` text,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reponseqi`
--

CREATE TABLE IF NOT EXISTS `reponseqi` (
  `id` int(11) NOT NULL,
  `idQuestionIndependante` int(11) NOT NULL,
  `intitule` text,
  `nbPoint` int(11) DEFAULT NULL,
  `effetSurPoint` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`idQuestionIndependante`),
  KEY `idQuestionIndependante` (`idQuestionIndependante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `mail` varchar(70) DEFAULT NULL,
  `pwd` varchar(40) DEFAULT NULL,
  `nom` varchar(35) DEFAULT NULL,
  `prenom` varchar(35) DEFAULT NULL,
  `anneeDetude` int(11) DEFAULT NULL,
  `faculte` varchar(255) DEFAULT NULL,
  `dateDerniereConnexion` date DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `pseudo`, `mail`, `pwd`, `nom`, `prenom`, `anneeDetude`, `faculte`, `dateDerniereConnexion`) VALUES
(1, 'ffff', 'matthieu.derache@gmail.com', 'ff', 'ffffff', 'fffff', 10, 'ffff', NULL),
(2, 'fffff', 'matthieu.derache@insset.fr', 'f', 'fff', 'fff', 20, 'ffff', '2014-04-16');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `dcp`
--
ALTER TABLE `dcp`
  ADD CONSTRAINT `dcp_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `questionIndependante`
--
ALTER TABLE `questionIndependante`
  ADD CONSTRAINT `questionIndependante_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `reponseqi`
--
ALTER TABLE `reponseqi`
  ADD CONSTRAINT `reponseqi_ibfk_1` FOREIGN KEY (`idQuestionIndependante`) REFERENCES `questionIndependante` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
