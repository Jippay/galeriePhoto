-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 10 avr. 2019 à 18:05
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `photon18`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `id_PHOTO` int(11) NOT NULL,
  `id_THEME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droitdiffusion`
--

CREATE TABLE `droitdiffusion` (
  `id_Droit` int(11) NOT NULL,
  `nom_Droit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droitdiffusion`
--

INSERT INTO `droitdiffusion` (`id_Droit`, `nom_Droit`) VALUES
(1, 'interne'),
(2, 'toute utilisation'),
(3, 'toute utilisation sauf reseaux');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_PHOTO` int(11) NOT NULL,
  `nom_PHOTO` varchar(250) DEFAULT NULL,
  `resume_PHOTO` varchar(250) DEFAULT NULL,
  `date_PHOTO` datetime DEFAULT NULL,
  `id_PHOTOGRAPHE` int(11) DEFAULT NULL,
  `id_Droit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `photographe`
--

CREATE TABLE `photographe` (
  `id_PHOTOGRAPHE` int(11) NOT NULL,
  `nom_PHOTOGRAPHE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photographe`
--

INSERT INTO `photographe` (`id_PHOTOGRAPHE`, `nom_PHOTOGRAPHE`) VALUES
(1, 'Seb BRUNET'),
(2, 'Fabrice SOULON'),
(3, 'Michele THEVENIN'),
(4, 'Jean-Luc COUPEAU'),
(5, 'Thierry VEAU'),
(6, 'Daniele BOONE'),
(7, 'JEAN-Luc MEROT'),
(8, 'NATURE 18');

-- --------------------------------------------------------

--
-- Structure de la table `represente`
--

CREATE TABLE `represente` (
  `id_PHOTO` int(11) NOT NULL,
  `id_SUJET` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id_SUJET` int(11) NOT NULL,
  `nom_SUJET` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id_THEME` int(11) NOT NULL,
  `nom_THEME` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_THEME`, `nom_THEME`) VALUES
(1, 'actions-animations'),
(2, 'amphibiens'),
(3, 'araignées'),
(4, 'autres insectes'),
(5, 'champignons'),
(6, 'flore'),
(7, 'mammifères'),
(8, 'mollusques'),
(9, 'odonates'),
(10, 'oiseaux'),
(11, 'orthoptères'),
(12, 'papillons de jour'),
(13, 'papillon de nuit'),
(14, 'paysages'),
(15, 'poissons'),
(16, 'reptiles');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`id_PHOTO`,`id_THEME`),
  ADD KEY `FK_appartient_id_THEME` (`id_THEME`);

--
-- Index pour la table `droitdiffusion`
--
ALTER TABLE `droitdiffusion`
  ADD PRIMARY KEY (`id_Droit`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_PHOTO`),
  ADD KEY `FK_PHOTO_id_PHOTOGRAPHE` (`id_PHOTOGRAPHE`),
  ADD KEY `FK_PHOTO_id_DROIT` (`id_Droit`);

--
-- Index pour la table `photographe`
--
ALTER TABLE `photographe`
  ADD PRIMARY KEY (`id_PHOTOGRAPHE`);

--
-- Index pour la table `represente`
--
ALTER TABLE `represente`
  ADD PRIMARY KEY (`id_PHOTO`,`id_SUJET`),
  ADD KEY `FK_represente_id_SUJET` (`id_SUJET`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id_SUJET`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_THEME`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartient`
--
ALTER TABLE `appartient`
  MODIFY `id_PHOTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `droitdiffusion`
--
ALTER TABLE `droitdiffusion`
  MODIFY `id_Droit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_PHOTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `photographe`
--
ALTER TABLE `photographe`
  MODIFY `id_PHOTOGRAPHE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `represente`
--
ALTER TABLE `represente`
  MODIFY `id_PHOTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id_SUJET` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_THEME` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `FK_appartient_id_PHOTO` FOREIGN KEY (`id_PHOTO`) REFERENCES `photo` (`id_PHOTO`),
  ADD CONSTRAINT `FK_appartient_id_THEME` FOREIGN KEY (`id_THEME`) REFERENCES `theme` (`id_THEME`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_PHOTO_id_PHOTOGRAPHE` FOREIGN KEY (`id_PHOTOGRAPHE`) REFERENCES `photographe` (`id_PHOTOGRAPHE`),
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`id_Droit`) REFERENCES `droitdiffusion` (`id_Droit`);

--
-- Contraintes pour la table `represente`
--
ALTER TABLE `represente`
  ADD CONSTRAINT `FK_represente_id_PHOTO` FOREIGN KEY (`id_PHOTO`) REFERENCES `photo` (`id_PHOTO`),
  ADD CONSTRAINT `FK_represente_id_SUJET` FOREIGN KEY (`id_SUJET`) REFERENCES `sujet` (`id_SUJET`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
