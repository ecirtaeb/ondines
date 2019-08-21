-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 20 août 2019 à 15:20
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ondines`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

DROP TABLE IF EXISTS `calendrier`;
CREATE TABLE IF NOT EXISTS `calendrier` (
  `annee` char(4) NOT NULL COMMENT 'type de l''info',
  `vactoussaint` char(50) NOT NULL,
  `vacnoel` char(50) NOT NULL,
  UNIQUE KEY `annee` (`annee`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`annee`, `vactoussaint`, `vacnoel`) VALUES
('2018', '', ''),
('2019', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `calendrierdetail`
--

DROP TABLE IF EXISTS `calendrierdetail`;
CREATE TABLE IF NOT EXISTS `calendrierdetail` (
  `annee` char(4) NOT NULL COMMENT 'annee',
  `id_logement` char(1) NOT NULL COMMENT 'logement',
  `icalresa` varchar(250) DEFAULT NULL COMMENT 'lien calendrier des réservations',
  `icaltarif` varchar(200) DEFAULT NULL COMMENT 'lien calendrier des tarifs',
  PRIMARY KEY (`annee`,`id_logement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `calendrierdetail`
--

INSERT INTO `calendrierdetail` (`annee`, `id_logement`, `icalresa`, `icaltarif`) VALUES
('2019', 'A', 'http://www.vacances-ondines.info/calendriers/fusionCal-A.ics', NULL),
('2019', 'G', 'http://www.vacances-ondines.info/calendriers/fusionCal-G.ics', NULL),
('2019', 'I', 'http://www.vacances-ondines.info/calendriers/fusionCal-I.ics', NULL),
('2019', 'B', 'http://www.vacances-ondines.info/calendriers/fusionCal-B.ics', NULL),
('2019', 'D', 'http://www.vacances-ondines.info/calendriers/fusionCal-D.ics', NULL),
('2019', 'C', 'http://www.vacances-ondines.info/calendriers/fusionCal-C.ics', NULL),
('2019', 'J', 'http://www.vacances-ondines.info/calendriers/fusionCal-J.ics', NULL),
('2019', 'E', 'http://www.vacances-ondines.info/calendriers/fusionCal-E.ics', NULL),
('2019', 'F', 'http://www.vacances-ondines.info/calendriers/fusionCal-F.ics', NULL),
('2019', 'H', 'http://www.vacances-ondines.info/calendriers/fusionCal-H.ics', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categdiapo`
--

DROP TABLE IF EXISTS `categdiapo`;
CREATE TABLE IF NOT EXISTS `categdiapo` (
  `id` char(30) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Flag catégorie active ou pas',
  `libelle` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categdiapo`
--

INSERT INTO `categdiapo` (`id`, `actif`, `libelle`) VALUES
('residence', 1, 'La résidence en photos'),
('logement', 1, 'Quelques photos du logement'),
('general', 1, 'Photos'),
('damgan', 1, 'DAMGAN'),
('environs', 1, 'Les environs'),
('morbihan', 0, 'dans le Morbihan'),
('A', 1, 'Appartement A'),
('B', 1, 'Appartement B'),
('C', 1, 'Appartement C'),
('D', 1, 'Appartement D'),
('E', 1, 'Appartement E'),
('F', 1, 'Appartement F'),
('G', 1, 'Appartement G'),
('H', 1, 'Appartement H'),
('I', 1, 'Appartement I'),
('J', 1, 'Appartement J');

-- --------------------------------------------------------

--
-- Structure de la table `dateperiode`
--

DROP TABLE IF EXISTS `dateperiode`;
CREATE TABLE IF NOT EXISTS `dateperiode` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `id_periode` int(2) NOT NULL,
  `datedebut` datetime NOT NULL,
  `datefin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dateperiode`
--

INSERT INTO `dateperiode` (`id`, `id_periode`, `datedebut`, `datefin`) VALUES
(7, 1, '2019-09-28 00:00:00', '2020-03-28 00:00:00'),
(8, 2, '2019-03-30 00:00:00', '2019-06-28 00:00:00'),
(9, 3, '2019-06-29 00:00:00', '2019-07-12 00:00:00'),
(10, 3, '2019-08-24 00:00:00', '2019-08-30 00:00:00'),
(11, 4, '2019-07-13 00:00:00', '2019-08-23 00:00:00'),
(12, 2, '2019-08-31 00:00:00', '2019-09-27 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `diapo`
--

DROP TABLE IF EXISTS `diapo`;
CREATE TABLE IF NOT EXISTS `diapo` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `categorie` char(30) NOT NULL COMMENT 'Catégorie diaporama',
  `type` char(50) NOT NULL,
  `urlDiapo` varchar(256) NOT NULL COMMENT 'chemin accès diaporama',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx2` (`categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `diapo`
--

INSERT INTO `diapo` (`id`, `categorie`, `type`, `urlDiapo`) VALUES
(1, 'ondines', 'residence', 'vues/img/diaporesidence/'),
(2, 'accueil', 'general', 'vues/img/diapoaccueil/'),
(3, 'A', 'logement', 'vues/img/diapofiche/A/'),
(4, 'B', 'logement', 'vues/img/diapofiche/B/'),
(5, 'C', 'logement', 'vues/img/diapofiche/C/'),
(6, 'D', 'logement', 'vues/img/diapofiche/D/'),
(7, 'E', 'logement', 'vues/img/diapofiche/E/'),
(8, 'F', 'logement', 'vues/img/diapofiche/F/'),
(9, 'G', 'logement', 'vues/img/diapofiche/G/'),
(10, 'H', 'logement', 'vues/img/diapofiche/H/'),
(11, 'I', 'logement', 'vues/img/diapofiche/I/'),
(12, 'J', 'logement', 'vues/img/diapofiche/J/'),
(13, 'damgan', 'tourisme', 'vues/img/diapotourisme/damgan/'),
(14, 'environs', 'tourisme', 'vues/img/diapotourisme/environs/'),
(15, 'morbihan', 'tourisme', 'vues/img/diapotourisme/morbihan/');

-- --------------------------------------------------------

--
-- Structure de la table `diapodetail`
--

DROP TABLE IF EXISTS `diapodetail`;
CREATE TABLE IF NOT EXISTS `diapodetail` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_diapo` int(4) NOT NULL,
  `rang` int(4) NOT NULL DEFAULT '99',
  `actif` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Flag photo active ou pas',
  `titre` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `nomphoto` varchar(250) NOT NULL,
  PRIMARY KEY (`id`,`id_diapo`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=254 DEFAULT CHARSET=utf8 COMMENT='description loisirs';

--
-- Déchargement des données de la table `diapodetail`
--

INSERT INTO `diapodetail` (`id`, `id_diapo`, `rang`, `actif`, `titre`, `description`, `nomphoto`) VALUES
(1, 1, 10, 1, 'Les appartements', '2 studios et 5 T2', 'ondines1.jpg'),
(2, 1, 80, 1, '2 maisons mitoyennes', 'T3 avec terrasse', 'ondines2.jpg'),
(3, 1, 50, 1, 'Parking privé', '', 'parking.jpg'),
(4, 1, 99, 0, 'plage à 250 mètres', '', 'plage250m.jpg'),
(201, 13, 99, 1, 'Damgan', 'plage', 'Damgan-plage-3.jpg'),
(202, 13, 99, 1, 'Damgan', 'plage', 'Damgan-plage-4.jpg'),
(206, 13, 99, 1, 'Damgan', 'sentier côtier', 'Damgan-sentier-3.jpg'),
(205, 13, 99, 1, 'Damgan', 'sentier côtier', 'Damgan-sentier-2.jpg'),
(204, 13, 99, 1, 'Damgan', 'Grande Plage', 'Damgan-plage.jpg'),
(203, 13, 99, 1, 'Damgan', 'Grande Plage', 'Damgan-plage-5.jpg'),
(243, 2, 5, 1, 'Plage à 250m de la résidence', '', 'plage300m.jpg'),
(197, 13, 24, 1, 'Damgan', 'Eglise Notre-Dame-de-la-Paix', 'Damgan-2.jpg'),
(196, 13, 99, 1, 'Damgan', 'rue Fidel Habert', 'Damgan-1.jpg'),
(195, 13, 22, 1, 'Damgan', 'rue de la Plage', 'Damgan-3.jpg'),
(16, 14, 99, 1, 'La Roche Bernard', 'pont suspendu (1960)', 'larochebernard/lrb3.jpg'),
(17, 14, 99, 1, 'La Roche Bernard', 'pont du Morbihan (1995)', 'larochebernard/lrb8.jpg'),
(18, 14, 99, 1, 'La Roche Bernard', 'Le port', 'larochebernard/lrb5.jpg'),
(233, 13, 80, 1, 'Damgan', '', 'Programme-ete2019-1.jpg'),
(20, 14, 99, 1, 'La Roche Bernard', 'Circuits découverte', 'larochebernard/lrb10.jpg'),
(21, 14, 99, 1, 'La Roche Bernard', 'premier pont (1839 détruit en 1852)', 'larochebernard/pont1.jpg'),
(22, 14, 99, 1, 'Billiers', 'Sentier côtier', 'billiers/bil1.jpg'),
(23, 14, 99, 1, 'Billiers', 'Sentier côtier', 'billiers/bil2.jpg'),
(24, 14, 99, 1, 'Belle île en Mer', 'Le port', 'belleile/belleile1.jpg'),
(25, 14, 99, 1, 'Belle île en Mer', 'Le port', 'belleile/belleile2.jpg'),
(26, 14, 99, 1, 'Le Golfe du Morbihan', 'Départ pour les îles', 'golfe/golfe1.jpg'),
(27, 14, 99, 1, 'Le Golfe du Morbihan', 'Les vieux gréments', 'golfe/golfe2.jpg'),
(28, 15, 99, 1, 'Le Golfe du Morbihan', 'En route vers les îles', 'golfe/mrb1.jpg'),
(29, 15, 99, 1, 'Le Golfe du Morbihan', 'La Roche Bernard', 'golfe/mrb2.jpg'),
(30, 14, 99, 1, 'La Roche Bernard', 'canon du vaisseau Le Juste (XVIIIème siècle)', 'larochebernard/lrb13.jpg'),
(200, 13, 10, 1, 'Damgan', 'plage', 'Damgan-plage-2.jpg'),
(199, 13, 12, 1, 'Damgan', 'plage', 'Damgan-plage-1.jpg'),
(198, 13, 14, 1, 'Damgan', 'Voile', 'Damgan-Voile-1.jpg'),
(36, 4, 99, 1, 'Chambre', '2 lits doubles', 'T2BF-1.jpg'),
(37, 4, 99, 1, 'Cuisine', 'ouverte sur le salon', 'T2BF-2.jpg'),
(38, 4, 99, 1, 'Salle d\'eau', 'douche, toilettes', 'T2BF-3.jpg'),
(39, 4, 99, 1, 'Mezzanine', 'avec 2 lits simples', 'T2BF-4.jpg'),
(40, 4, 99, 1, 'Salon/séjour', 'avec canapé convertible', 'T2BF-5.jpg'),
(41, 5, 99, 1, 'Chambre', 'avec 2 lits doubles', 'T2C-1.jpg'),
(42, 5, 99, 1, 'Cuisine', 'ouverte sur le salon', 'T2C-2.jpg'),
(145, 9, 99, 1, 'Coin couchage', 'avec 1 lit double', 'G-Coin-Couchage-Lit-double-1.JPG'),
(191, 12, 99, 1, 'Salon', 'avec canapé convertible', 'J-Salon-1.JPG'),
(190, 12, 99, 1, 'Salle d\'eau', 'douche, WC', 'J-SDB-1.JPG'),
(189, 12, 99, 1, 'Maison mitoyenne', '', 'J-Maison.JPG'),
(188, 12, 99, 1, 'Cuisine', 'ouvert sur salon', 'J-Cuisine-2.JPG'),
(187, 12, 99, 1, 'Cuisine', 'ouvert sur salon', 'J-Cuisine-1.JPG'),
(186, 12, 99, 1, 'Point d\'eau à l\'étage', '+ WC', 'J-Coin-d\'eau-WC-Etage.JPG'),
(183, 12, 99, 1, 'Chambre à l\'étage', 'avec 2 lits doubles', 'J-Chambre-Etage-1.JPG'),
(182, 11, 99, 0, 'Terrasse', '', 'I-Terrasse-2.JPG'),
(172, 11, 99, 1, 'Chambre 1er étage', 'avec 1 lit double et 1 lit simple', 'I-Chambre-Etage-1.JPG'),
(185, 12, 99, 1, 'Chambre rez-de-chaussee', 'avec 1 lit double', 'J-Chambre-RDC-2.JPG'),
(146, 9, 99, 1, 'Coin couchage', 'avec 1 lit double', 'G-Coin-Couchage-Lit-double-2.JPG'),
(171, 10, 99, 1, 'Terrasse', 'avec mobilier et parasol', 'H-Terrasse-1.JPG'),
(170, 10, 99, 1, 'Salon', '', 'H-Salon-4.JPG'),
(169, 10, 99, 1, 'Salon', 'avec canapé convertible', 'H-Salon-3.JPG'),
(168, 10, 99, 1, 'Salon', '', 'H-Salon-1.JPG'),
(167, 10, 99, 1, 'Salle d\'eau', 'douche, WC', 'H-SDB-1.JPG'),
(166, 10, 1, 1, 'Cuisine', '', 'H-Cuisine-2.JPG'),
(165, 10, 99, 1, 'Cuisine', '', 'H-Cuisine-1.JPG'),
(164, 10, 99, 1, 'Chambre', '', 'H-Chambre-1.JPG'),
(163, 9, 99, 1, 'Salon', '', 'G-Salon-2.JPG'),
(162, 9, 1, 1, 'Salon', '', 'G-Salon-1.JPG'),
(161, 9, 99, 1, 'SDB', '', 'G-SDB-1.JPG'),
(160, 9, 99, 1, 'Cuisine', '', 'G-Cuisine-1.JPG'),
(159, 9, 99, 1, 'Coin jardin', 'avec mobilier et parasol', 'G-Coin-Jardin.JPG'),
(180, 11, 99, 1, 'Salon', '', 'I-Salon-3.JPG'),
(181, 11, 99, 1, 'Terrasse', 'avec mobilier et parasol', 'I-Terrasse-1.JPG'),
(178, 11, 99, 1, 'Salon', 'cuisine', 'I-Salon-1.JPG'),
(179, 11, 99, 1, 'Salon', 'avec canapé convertible', 'I-Salon-2.JPG'),
(89, 5, 99, 1, 'Chambre', '', 'C-Chambre-1.JPG'),
(90, 5, 99, 1, 'Chambre', '', 'C-Chambre-2.JPG'),
(91, 5, 99, 1, 'Cuisine', 'ouverte sur salon', 'C-Cuisine-1.JPG'),
(92, 5, 99, 1, 'SDB', '', 'C-SDB-1.JPG'),
(93, 5, 99, 1, 'SDB', '', 'C-SDB-2.JPG'),
(94, 5, 1, 1, 'Salon', '', 'C-Salon-1.jpg'),
(95, 5, 99, 1, 'Salon', '', 'C-Salon-2.jpg'),
(96, 5, 99, 1, 'Salon', '', 'C-Salon-3.jpg'),
(97, 5, 99, 1, 'Salon', '', 'C-Salon-4.jpg'),
(98, 5, 99, 1, 'Terrasse', 'salon de jardin, parasol', 'C-Terrasse.jpg'),
(99, 3, 99, 1, 'Chambre', '', 'A-Chambre-1.jpg'),
(100, 3, 99, 1, 'Chambre', '', 'A-Chambre-2.jpg'),
(101, 3, 99, 1, 'Chambre', '', 'A-Chambre-3.JPG'),
(102, 3, 99, 1, 'Cuisine', '', 'A-Cuisine-1.JPG'),
(103, 3, 99, 1, 'Mezzanine', '', 'A-Mezzanine.jpg'),
(104, 3, 99, 1, 'SDB', '', 'A-SDB-1.JPG'),
(105, 3, 99, 1, 'SDB', '', 'A-SDB-2.JPG'),
(106, 3, 1, 1, 'Salon', '', 'A-Salon-1.JPG'),
(107, 3, 99, 1, 'Salon', '', 'A-Salon-2.JPG'),
(108, 3, 99, 1, 'Salon', '', 'A-Salon-3.JPG'),
(109, 4, 99, 1, 'Chambre', '', 'B-Chambre-1.jpg'),
(110, 4, 99, 1, 'Chambre', '', 'B-Chambre-2.jpg'),
(111, 4, 99, 1, 'Chambre', '', 'B-Chambre-3.jpg'),
(112, 4, 99, 1, 'Cuisine', '', 'B-Cuisine-1.JPG'),
(113, 4, 99, 1, 'Mezzanine', '', 'B-Mezzanine-1.JPG'),
(114, 4, 99, 1, 'Mezzanine', '', 'B-Mezzanine-2.JPG'),
(115, 4, 99, 1, 'SDB', '', 'B-SDB-1.JPG'),
(116, 4, 99, 1, 'SDB', '', 'B-SDB-2.JPG'),
(117, 4, 99, 1, 'Salon', '', 'B-Salon-1.JPG'),
(118, 4, 1, 1, 'Salon', '', 'B-Salon-2.JPG'),
(119, 4, 99, 1, 'Salon', '', 'B-Salon-3.JPG'),
(120, 6, 99, 1, 'Cuisine', 'ouverte sur salon', 'D-Cuisine-1.JPG'),
(121, 6, 99, 1, 'Cuisine', '', 'D-Cuisine-2.JPG'),
(122, 6, 99, 0, 'Salle d\'eau', 'douche, toilettes', 'D-SDB-1.JPG'),
(123, 6, 99, 1, 'Coin cuisine', 'douche, toilettes', 'D-SDB-2.JPG'),
(124, 6, 1, 1, 'Salon', 'coin couchage', 'D-Salon-1.JPG'),
(125, 6, 99, 1, 'Coin salon', '', 'D-Salon-2.JPG'),
(126, 6, 99, 1, 'Partie salon', '', 'D-Salon-3.JPG'),
(127, 6, 99, 1, 'Terrasse', '', 'D-Terrasse.jpg'),
(128, 7, 99, 1, 'Chambre', '', 'E-Chambre-1.JPG'),
(129, 7, 99, 1, 'Chambre', '', 'E-Chambre-2.JPG'),
(130, 7, 99, 1, 'Chambre', '', 'E-Chambre-3.JPG'),
(131, 7, 99, 1, 'Mezzanine', '', 'E-Mezzanine.JPG'),
(132, 7, 99, 1, 'Salle d\'eau', '', 'E-Salle d\'eau-1.JPG'),
(133, 7, 1, 1, 'Salon', '', 'E-Salon-1.JPG'),
(134, 7, 99, 1, 'Salon', '', 'E-Salon-2.JPG'),
(135, 7, 99, 1, 'Salon', '', 'E-Salon-3.JPG'),
(136, 8, 99, 1, 'Chambre', '', 'F-Chambre-1.JPG'),
(137, 8, 99, 1, 'Chambre', '', 'F-Chambre-2.JPG'),
(138, 8, 99, 1, 'Chambre', '', 'F-Chambre-3.JPG'),
(139, 8, 99, 1, 'Cuisine', '', 'F-Cuisine-1.JPG'),
(140, 8, 99, 1, 'SDB', '', 'F-SDB-1.JPG'),
(141, 8, 1, 1, 'Salon', '', 'F-Salon-1.JPG'),
(142, 8, 99, 1, 'Salon', '', 'F-Salon-2.JPG'),
(143, 8, 99, 1, 'Salon', '', 'F-Salon-3.JPG'),
(144, 8, 99, 1, 'Salon', '', 'F-Salon-4.JPG'),
(177, 11, 99, 1, 'Salle d\'eau', 'douche, WC', 'I-SDB-1.JPG'),
(176, 11, 1, 1, 'Maison', 'avec terrasse', 'I-Maison-1.JPG'),
(175, 11, 99, 1, 'Cuisine', 'ouverte sur salon', 'I-Cuisine-1.JPG'),
(174, 11, 99, 1, 'Chambre rez-de-chaussée', 'avec 1 lit double', 'I-Chambre-RDC-2.JPG'),
(173, 11, 99, 1, 'Chambre rez-de-chaussée', 'avec 1 lit double', 'I-Chambre-RDC-1.JPG'),
(184, 12, 99, 1, 'Chambre rez-de-chaussee', 'avec 1 lit double', 'J-Chambre-RDC-1.JPG'),
(192, 12, 99, 1, 'Salon', 'avec canapé convertible', 'J-Salon-2.JPG'),
(193, 12, 1, 1, 'Terrasse', 'avec mobilier et parasol', 'J-Terrasse-1.JPG'),
(194, 12, 99, 1, 'Chambre à l\'étage', 'avec 2 lits doubles', 'J-chambre-Etage-2.JPG'),
(207, 13, 26, 1, 'Damgan', 'sentier cyclable et piéton', 'Damgan-sentier.jpg'),
(208, 13, 16, 1, 'Damgan', 'Coucher de soleil sur la Grande Plage', 'Damgan.jpg'),
(209, 13, 99, 1, 'Kervoyal', '', 'Kervoyal-1.jpg'),
(210, 13, 18, 1, 'Kervoyal', 'la Petite Plage', 'Kervoyal-2.jpg'),
(211, 13, 99, 1, 'Kervoyal', 'table d\'orientation', 'Kervoyal-3.jpg'),
(212, 13, 99, 1, 'Kervoyal', 'Chapelle Notre-Dame-de-la-Paix', 'Kervoyal-Eglise.jpg'),
(213, 13, 99, 1, 'Kervoyal', 'espace du Loch', 'Kervoyal-Loch-1.jpg'),
(214, 13, 99, 1, 'Kervoyal', 'espace du Loch', 'Kervoyal-Loch-2.jpg'),
(215, 13, 99, 1, 'Kervoyal', 'plage', 'Kervoyal-plage-1.jpg'),
(216, 13, 99, 1, 'Kervoyal', 'plage', 'Kervoyal-plage-2.jpg'),
(217, 13, 20, 1, 'Pénerf', 'Tour des Anglais', 'Penerf-Tour.jpg'),
(244, 2, 15, 1, 'Studio D', '', 'stD-2.JPG'),
(242, 2, 55, 1, 'Maisons mitoyennes', 'T3', 'ondines2.jpg'),
(241, 2, 10, 1, 'Les appartements', 'du studio au T2', 'ondines1.jpg'),
(240, 2, 65, 1, 'Maison mitoyenne J', 'avec terrasse', 'mJ-1.jpg'),
(239, 2, 60, 1, 'Maison mitoyenne I', 'avec terrasse', 'mI-1.jpg'),
(238, 2, 25, 1, 'T2 C', 'avec terrasse', 'T2-C.jpg'),
(237, 2, 35, 1, 'T2 A', '', 'T2-A.JPG'),
(236, 2, 30, 1, 'T2 H', '', 'T2-H.jpg'),
(222, 14, 99, 1, 'Penestin', '', 'penestin/pnst1.jpg'),
(223, 14, 99, 1, 'Penestin', 'plage de la Mine d\'or', 'penestin/pnst2.jpg'),
(224, 14, 99, 1, 'Penestin', 'plage de la Mine d\'or', 'penestin/pnst3.jpg'),
(225, 14, 99, 1, 'Penestin', 'plage de la Mine d\'or', 'penestin/pnst4.jpg'),
(226, 14, 99, 1, 'Penestin', 'plage de la Mine d\'or', 'penestin/pnst5.jpg'),
(227, 14, 99, 1, 'Penestin', 'plage de la Mine d\'or', 'penestin/pnst6.jpg'),
(228, 14, 99, 1, 'Arzal', 'barrage', 'arzal/Arzal-barrage.jpg'),
(229, 13, 28, 1, 'Ecole de voile', '', 'ecolevoile1.jpg'),
(230, 13, 30, 1, 'Ecole de voile', '', 'ecolevoile2.jpg'),
(231, 13, 32, 1, 'Coucher de soleil', 'en hiver', 'couchersoleilhiver.jpg'),
(232, 13, 34, 1, 'Halloween', '', 'LoisirsH-G18.gif'),
(234, 13, 81, 1, 'Damgan', 'Programme été 2019', 'Programme-aout2019-2.pdn'),
(235, 13, 82, 1, 'Damgan', 'Programme été 2019', 'Programme-ete2019-3.jpg'),
(245, 2, 20, 1, 'Studio G', '', 'studio-G.jpg'),
(246, 2, 40, 1, 'T2 E', '', 'E-Salon-1.JPG'),
(247, 2, 45, 1, 'T2 F', '', 'F-Salon-2.JPG'),
(248, 2, 50, 1, 'T2 B', '', 'B-Salon-2.JPG'),
(249, 1, 40, 1, 'Le porche d\'entrée', '', 'porche1.jpg'),
(250, 1, 20, 1, 'La résidence', 'rue des Ondines', 'rueondines1.jpg'),
(251, 1, 30, 1, 'La résidence', 'rue des Ondines', 'rueondines2.jpg'),
(252, 1, 0, 1, 'plage à 250 mètres', '', 'plage.jpg'),
(253, 1, 60, 1, 'Le porche vu du parking', '', 'porche2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id` char(1) NOT NULL COMMENT 'Identifiant logement',
  `id_type_logement` int(2) NOT NULL COMMENT 'identifiant type de logement',
  `surface_utile` decimal(5,2) DEFAULT NULL COMMENT 'Surface utile',
  `surface_habitable` decimal(5,2) DEFAULT NULL COMMENT 'Surface habitable',
  `capacite` tinyint(2) DEFAULT NULL COMMENT 'Capacité d''accueil en nombre de personnes',
  `commentaire` varchar(1000) DEFAULT NULL COMMENT 'Commentaire',
  `vignette1` varchar(150) NOT NULL,
  `vignette2` varchar(150) NOT NULL,
  `nblit1` int(2) NOT NULL,
  `nblit2` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Logements';

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id`, `id_type_logement`, `surface_utile`, `surface_habitable`, `capacite`, `commentaire`, `vignette1`, `vignette2`, `nblit1`, `nblit2`) VALUES
('G', 1, '30.45', '27.79', 4, 'Grand studio + terrasse non attenante. Cuisine ouverte sur salon/séjour avec canapé convertible et coin nuit avec 1 lit double.', 'vues/img/diapofiche/G/mini/stG-1.JPG', 'vues/img/diapofiche/G/mini/stG-2.JPG', 0, 1),
('B', 2, '45.10', '18.72', 4, 'T2 au premier étage avec 1 chambre avec lit double, une mezzanine avec 2 lits simples, une kitchenette, un salon/séjour avec canapé convertible et coin repas', 'vues/img/diapoFiche/B/mini/T2BF-1.jpg', 'vues/img/diapoFiche/B/mini/T2BF-2.jpg', 2, 1),
('A', 2, '47.94', '37.77', 6, 'T2 au premier étage avec 1 chambre avec lit double, une mezzanine avec 2 lits simples, une cuisine ouverte sur un salon/séjour avec canapé convertible. Cellier au RdC.\r\n', 'vues/img/diapoFiche/A/mini/T2AE-1.JPG', 'vues/img/diapoFiche/A/mini/T2AE-2.JPG', 2, 1),
('I', 4, '45.89', '40.20', 6, 'Maison mitoyenne avec 1 chambre avec 2 lits doubles, 1 chambre avec 1 lit simple, salon-sejour-cuisine + une terrasse de 15 m²\r\n\r\n', 'vues/img/diapofiche/I/mini/mI-1.jpg', 'vues/img/diapofiche/I/mini/mI-2.jpg', 1, 2),
('C', 3, '49.12', '45.14', 6, 'Appartement T2, une chambre avec 2 lits doubles, cuisine ouvert sur salon avec 1 canapé convertible + terrasse de 30m²', 'vues/img/diapoFiche/C/mini/T2C-1.jpg', 'vues/img/diapoFiche/C/mini/T2C-2.jpg', 0, 2),
('E', 2, '50.12', '30.93', 6, 'T2 au premier étage avec 1 chambre avec lit double, une mezzanine avec 2 lits simples, une cuisine ouverte sur un salon/séjour avec canapé convertible. Cellier au RdC.', 'vues/img/diapofiche/E/mini/T2AE-1.JPG', 'vues/img/diapofiche/E/mini/T2AE-2.JPG', 2, 1),
('J', 4, '47.10', '43.89', 6, 'Maison mitoyenne avec 1 chambre avec 1 lit double + 1 lit simple, 1 chambre avec 1 lit simple, salon-sejour-cuisine + une terrasse de 15 m²', 'vues/img/diapofiche/J/mini/mJ-1.jpg', 'vues/img/diapofiche/J/mini/mJ-2.jpg', 0, 3),
('F', 2, '51.00', '27.00', 4, 'T2 à l\'étage, 1 chambre avec lit double, cuisine ouverte sur salon avec 1 canapé convertible, mezzanine avec 2 matelas simples + cellier  au rez-de-chaussée.', 'vues/img/diapofiche/F/mini/T2BF-1.jpg', 'vues/img/diapofiche/F/mini/T2BF-2.jpg', 2, 1),
('H', 3, '36.00', '36.00', 4, 'T2 RdC, 1 chambre avec  lit double, cuisine ouverte sur salon avec canapé convertible + terrasse de 12m²', 'vues/img/diapofiche/H/mini/T2H-1.jpg', 'vues/img/diapofiche/H/mini/T2H-2.jpg', 0, 1),
('D', 1, '30.45', '30.45', 4, 'Grand studio + terrasse attenante de 33m². Cuisine ouverte sur salon/séjour avec canapé convertible et coin nuit avec 1 lit double.', 'vues/img/diapofiche/D/mini/stD-1.JPG', 'vues/img/diapofiche/D/mini/stD-2.JPG', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `logementdetail`
--

DROP TABLE IF EXISTS `logementdetail`;
CREATE TABLE IF NOT EXISTS `logementdetail` (
  `id_logement` char(1) NOT NULL COMMENT 'Identifiant logement',
  `id_type_desc` char(50) NOT NULL COMMENT 'Type de description',
  `rang` int(4) NOT NULL COMMENT 'Rang pour affichage',
  `infos` varchar(256) NOT NULL,
  PRIMARY KEY (`id_logement`,`id_type_desc`(10)) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logementdetail`
--

INSERT INTO `logementdetail` (`id_logement`, `id_type_desc`, `rang`, `infos`) VALUES
('A', 'cuisine', 20, 'cafetière;bouilloire;grille-pain;micro-ondes;four;plaques vitro céramique'),
('B', 'cuisine', 20, 'cafetière;bouilloire;grille-pain;micro-ondes'),
('G', 'salon', 30, 'Canapé convertible;TV;table'),
('B', 'salon', 30, 'Canapé convertible;TV;table;climatiseur'),
('E', 'cuisine', 20, 'réfrigérateur/congélateur;lave-vaisselle;cafetière;bouilloire;grille-pain;micro-ondes;four;plaques vitro céramique'),
('I', 'salon', 30, 'clic-clac;TV écran plat'),
('I', 'cuisine', 20, 'réfrigérateur/congélateur;misro-ondes;plaques à induction;lave-vaisselle'),
('I', 'couchage', 10, 'Une chambre rdc : 1 lit double;Une chambre à l\\\'étage : 1 lit double et 1 lit simple;Canapé convertible dans le salon'),
('D', 'cuisine', 20, 'cafetière;bouilloire;grille-pain;micro-ondes;four;plaques vitro céramique'),
('F', 'cuisine', 20, 'cafetière;bouilloire;grille-pain;micro-ondes;plaques'),
('C', 'cuisine', 20, 'réfrigérateur/congélateur;lave-vaisselle;cafetière;bouilloire;grille-pain;micro-ondes;four;plaques vitro céramique'),
('G', 'cuisine', 20, 'cafetière;bouilloire;grille-pain;micro-ondes;plaques'),
('H', 'cuisine', 20, 'réfrigérateur/congélateur;lave-vaisselle;cafetière;bouilloire;grille-pain;micro-ondes;four;plaques vitro céramique'),
('J', 'couchages', 10, 'Une chambre rdc : 1 lit double;Une chambre à l\'étage : 1 lit double + 1 lit simple;Canapé convertible dans le salon'),
('G', 'coin couchage', 10, '1 lit double;placard'),
('H', 'couchages', 10, 'Une chambre avec 1 lit double;Canapé convertible dans le salon'),
('H', 'terrasse', 50, 'Salon de jardin;parasol'),
('I', 'terrasse', 50, 'Salon de jardin;parasol'),
('J', 'terrasse', 50, 'Salon de jardin;parasol'),
('C', 'terrasse', 50, 'Salon de jardin;parasol'),
('D', 'terrasse', 50, 'Salon de jardin;parasol'),
('G', 'terrasse non attenante', 50, 'Salon de jardin;parasol'),
('D', 'coin couchage', 10, '1 lit double;placard'),
('C', 'couchages', 10, 'Une chambre avec 2 lits doubles;Canapé convertible dans le salon'),
('A', 'couchages', 10, 'Une chambre avec 1 lit double;Mezzanine avec 2 lits simples;Canapé convertible dans le salon'),
('E', 'couchages', 10, 'Une chambre avec 1 lit double;Mezzanine avec 2 lits simples;Canapé convertible dans le salon'),
('B', 'couchages', 10, 'Une chambre avec 1 lit double;Mezzanine avec 2 lits simples;Canapé convertibledans le salon'),
('F', 'couchages', 10, 'Une chambre avec 1 lit double;Mezzanine avec 2 lits simples;Canapé convertible dans le salon'),
('D', 'salon', 30, 'Canapé convertible;TV écran plat;table'),
('J', 'cuisine', 20, 'réfrigérateur/congélateur;misro-ondes;plaques à induction;lave-vaisselle'),
('E', 'salon', 30, 'Canapé convertible;TV;table;climatiseur'),
('H', 'salon', 30, 'clic-clac;TV;table'),
('J', 'salon', 30, 'clic-clac;TV écran plat'),
('A', 'salon', 30, 'Canapé convertible;TV;table'),
('C', 'salon', 30, 'Canapé convertible;TV écran plat;table'),
('F', 'salon', 30, 'Canapé convertible;TV;table'),
('A', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('B', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('C', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('D', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('E', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('F', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('G', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('H', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('I', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('J', 'salle d\'eau', 40, 'Douche;Lavabo;Toilettes;Lave-linge;Sèche-serviettes'),
('A', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('B', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('C', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('D', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('E', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('F', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('G', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('H', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('I', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne'),
('J', 'divers', 60, 'parking privé gratuit;local à vélos à disposition;wifi gratuit;location des draps/serviettes : 15€ par personne');

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`id`, `libelle`) VALUES
(1, 'basse saison'),
(2, 'moyenne saison'),
(3, 'haute saison'),
(4, 'très haute saison');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) NOT NULL,
  `lienadmin` varchar(50) DEFAULT NULL,
  `info` varchar(200) DEFAULT NULL,
  `tauxtarif` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id`, `libelle`, `lienadmin`, `info`, `tauxtarif`) VALUES
(1, 'Ondines', NULL, 'Site Ondines by nous', '-0.01'),
(2, 'Airbnb', NULL, 'Airbnb', '0.15');

-- --------------------------------------------------------

--
-- Structure de la table `sitelogement`
--

DROP TABLE IF EXISTS `sitelogement`;
CREATE TABLE IF NOT EXISTS `sitelogement` (
  `id_site` int(2) NOT NULL,
  `id_logement` int(2) NOT NULL,
  `refannonce` varchar(30) NOT NULL,
  PRIMARY KEY (`id_site`,`id_logement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `id_logement` char(1) NOT NULL,
  `id_periode` int(2) NOT NULL,
  `tarif_jour` decimal(6,2) DEFAULT NULL,
  `tarif_vs` decimal(6,2) DEFAULT NULL,
  `tarif_semaine` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `logeper` (`id_logement`,`id_periode`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id`, `id_logement`, `id_periode`, `tarif_jour`, `tarif_vs`, `tarif_semaine`) VALUES
(1, 'A', 1, '41.00', '62.00', '290.00'),
(2, 'A', 2, '46.00', '69.00', '322.00'),
(3, 'A', 3, '59.00', '118.00', '414.00'),
(46, 'J', 1, '57.00', '86.00', '400.00'),
(5, 'A', 4, '89.00', NULL, '626.00'),
(7, 'B', 1, '35.00', '53.00', '245.00'),
(8, 'B', 2, '39.00', '58.00', '272.00'),
(9, 'B', 3, '50.00', '100.00', '350.00'),
(45, 'J', 2, '69.00', '103.00', '480.00'),
(11, 'B', 4, '70.00', NULL, '490.00'),
(13, 'I', 1, '52.00', '78.00', '363.00'),
(14, 'I', 2, '58.00', '86.00', '403.00'),
(15, 'I', 3, '74.00', '148.00', '518.00'),
(43, 'J', 4, '114.00', NULL, '799.00'),
(17, 'I', 4, '104.00', NULL, '725.00'),
(44, 'J', 3, '80.00', '160.00', '559.00'),
(19, 'C', 1, '63.00', '80.00', '373.00'),
(20, 'C', 2, '64.00', '96.00', '447.00'),
(21, 'C', 3, '75.00', '149.00', '522.00'),
(22, 'C', 4, '106.00', NULL, '745.00'),
(23, 'D', 1, '45.00', '67.00', '313.00'),
(24, 'D', 2, '54.00', '81.00', '376.00'),
(25, 'D', 3, '63.00', '125.00', '438.00'),
(26, 'D', 4, '89.00', NULL, '626.00'),
(27, 'E', 1, '45.00', '67.00', '313.00'),
(28, 'E', 2, '54.00', '81.00', '376.00'),
(29, 'E', 3, '63.00', '125.00', '438.00'),
(30, 'E', 4, '89.00', NULL, '626.00'),
(31, 'F', 1, '40.00', '60.00', '281.00'),
(32, 'F', 2, '48.00', '78.00', '337.00'),
(33, 'F', 3, '56.00', '112.00', '393.00'),
(34, 'F', 4, '80.00', NULL, '562.00'),
(35, 'G', 1, '45.00', '67.00', '313.00'),
(36, 'G', 2, '51.00', '76.00', '356.00'),
(37, 'G', 3, '59.00', '119.00', '416.00'),
(38, 'G', 4, '85.00', NULL, '594.00'),
(39, 'H', 1, '50.00', '75.00', '351.00'),
(40, 'H', 2, '60.00', '90.00', '421.00'),
(41, 'H', 3, '70.00', '140.00', '491.00'),
(42, 'H', 4, '100.00', NULL, '702.00');

-- --------------------------------------------------------

--
-- Structure de la table `typelogement`
--

DROP TABLE IF EXISTS `typelogement`;
CREATE TABLE IF NOT EXISTS `typelogement` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant type logement',
  `libelle` varchar(255) NOT NULL COMMENT 'Libellé type de logement',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typelogement`
--

INSERT INTO `typelogement` (`id`, `libelle`) VALUES
(1, 'Studio'),
(2, 'T2 étage'),
(3, 'T2 avec terrasse'),
(4, 'Maison T3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
