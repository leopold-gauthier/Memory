-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 03 mars 2023 à 11:13
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `memory`
--

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `players`
--

INSERT INTO `players` (`id`, `login`, `password`) VALUES
(4, 'heyboy', '$2y$10$ZWjP0JawX02Eu63XFlnNfOp1NpY5qApcCyema4xuPVKIRGFQ7fJua');

-- --------------------------------------------------------

--
-- Structure de la table `player_score`
--

DROP TABLE IF EXISTS `player_score`;
CREATE TABLE IF NOT EXISTS `player_score` (
  `id` int NOT NULL AUTO_INCREMENT,
  `player_id` int NOT NULL,
  `coups` int NOT NULL,
  `level` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `player_score`
--

INSERT INTO `player_score` (`id`, `player_id`, `coups`, `level`) VALUES
(54, 4, 5, 3),
(53, 4, 7, 3),
(52, 4, 7, 3),
(51, 4, 7, 3),
(50, 4, 5, 3),
(49, 4, 5, 3),
(48, 4, 11, 3),
(47, 4, 11, 3),
(46, 4, 4, 3),
(45, 4, 7, 4),
(44, 4, 4, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
