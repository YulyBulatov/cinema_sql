-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinema_yuly
CREATE DATABASE IF NOT EXISTS `cinema_yuly` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `cinema_yuly`;

-- Listage de la structure de la table cinema_yuly. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_ACTEUR_PERSONNE` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.acteur : ~14 rows (environ)
DELETE FROM `acteur`;
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(3, 4),
	(2, 5),
	(1, 6),
	(4, 7),
	(5, 8),
	(6, 9),
	(7, 10),
	(8, 11),
	(9, 12),
	(11, 14),
	(10, 15),
	(12, 16),
	(14, 17),
	(13, 18);
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `id_personnage` int(11) NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_personnage` (`id_personnage`),
  CONSTRAINT `FK_CASTING_ACTEUR` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK_CASTING_FILM` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_CASTING_PERSONNAGE` FOREIGN KEY (`id_personnage`) REFERENCES `personnage` (`id_personnage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.casting : ~18 rows (environ)
DELETE FROM `casting`;
/*!40000 ALTER TABLE `casting` DISABLE KEYS */;
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_personnage`) VALUES
	(1, 1, 2),
	(1, 2, 3),
	(1, 3, 1),
	(3, 4, 4),
	(3, 5, 6),
	(3, 6, 5),
	(5, 4, 8),
	(5, 7, 7),
	(5, 5, 9),
	(5, 8, 10),
	(6, 9, 14),
	(6, 11, 11),
	(6, 10, 12),
	(6, 12, 13),
	(11, 12, 17),
	(11, 14, 15),
	(11, 13, 16),
	(11, 5, 18);
/*!40000 ALTER TABLE `casting` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre_film` varchar(255) COLLATE utf8_bin NOT NULL,
  `anne_sortie` date NOT NULL,
  `duree_minutes` int(11) NOT NULL,
  `synopsis` text COLLATE utf8_bin,
  `note_film` int(11) NOT NULL,
  `affiche_film` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_realisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_FILM_REALISATEUR` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.film : ~9 rows (environ)
DELETE FROM `film`;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre_film`, `anne_sortie`, `duree_minutes`, `synopsis`, `note_film`, `affiche_film`, `id_realisateur`) VALUES
	(1, 'Star Wars', '1977-10-19', 121, NULL, 5, 'affichefilm.jpg', 1),
	(2, 'Interstellar', '2014-10-26', 169, NULL, 5, 'affichefilm.jpg', 2),
	(3, 'The Dark Knight Rises', '2012-07-20', 165, NULL, 3, 'afffichefilm.jpg', 2),
	(4, 'The Lord of the Rings: The Fellowship of the Ring', '2001-12-19', 178, NULL, 5, 'affichefilm.jpg', 3),
	(5, 'The Prestige', '2006-10-20', 130, NULL, 5, 'affichefilm.jpg', 2),
	(6, 'Harry Potter and the Chamber of Secrets', '2002-11-15', 161, NULL, 5, 'affichefilm.jpg', 5),
	(11, 'Tenet', '2020-08-26', 150, NULL, 4, 'affichefilm.jpg', 2),
	(12, 'Thor', '2011-05-06', 114, NULL, 4, 'affichefilm.jpg', 4),
	(13, 'Death on the Nile', '2022-02-09', 127, NULL, 3, 'affichefilm.jpg', 4);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.genre : ~4 rows (environ)
DELETE FROM `genre`;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(1, 'Science Fiction'),
	(2, 'Action'),
	(3, 'Fantasy'),
	(4, 'Mystery');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. personnage
CREATE TABLE IF NOT EXISTS `personnage` (
  `id_personnage` int(11) NOT NULL AUTO_INCREMENT,
  `nom_personnage` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_personnage`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.personnage : ~18 rows (environ)
DELETE FROM `personnage`;
/*!40000 ALTER TABLE `personnage` DISABLE KEYS */;
INSERT INTO `personnage` (`id_personnage`, `nom_personnage`) VALUES
	(1, 'Luke Skywalker'),
	(2, 'Leia Organa'),
	(3, 'Han Solo'),
	(4, 'Batman'),
	(5, 'Catwoman'),
	(6, 'Alfred'),
	(7, 'The Great Danton'),
	(8, 'The Professor'),
	(9, 'John Cutter'),
	(10, 'Olivia Wenscombe'),
	(11, 'Harry Potter'),
	(12, 'Ron Weasley'),
	(13, 'Hermione Granger'),
	(14, 'Gilderoy Lockhart'),
	(15, 'Protagonist'),
	(16, 'Neil'),
	(17, 'Andrei Sator'),
	(18, 'Sir Michael Crosby');
/*!40000 ALTER TABLE `personnage` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(100) COLLATE utf8_bin NOT NULL,
  `sexe` varchar(50) COLLATE utf8_bin NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.personne : ~18 rows (environ)
DELETE FROM `personne`;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`) VALUES
	(1, 'Lucas', 'George', 'm', '1944-05-14'),
	(2, 'Nolan', 'Christopher', 'm', '1970-07-30'),
	(3, 'Jackson', 'Peter', 'm', '1961-10-31'),
	(4, 'Hammil', 'Mark', 'm', '1951-09-25'),
	(5, 'Ford', 'Harrison', 'm', '1942-07-13'),
	(6, 'Fisher', 'Carrie', 'f', '1956-10-21'),
	(7, 'Bale', 'Christian', 'm', '1974-01-30'),
	(8, 'Caine', 'Michael', 'm', '1933-03-14'),
	(9, 'Hathaway', 'Anne', 'f', '1982-11-12'),
	(10, 'Jackman', 'Hugh', 'm', '1968-10-12'),
	(11, 'Johansson', 'Scarlett', 'f', '1984-11-22'),
	(12, 'Branagh', 'Kenneth', 'm', '1960-12-10'),
	(13, 'Columbus', 'Chris', 'm', '1958-09-10'),
	(14, 'Radcliffe', 'Daniel', 'm', '1989-07-23'),
	(15, 'Grint', 'Rupert', 'm', '1988-08-24'),
	(16, 'Watson', 'Emma', 'f', '1990-04-15'),
	(17, 'Washington', 'John', 'm', '1984-07-28'),
	(18, 'Pattinson', 'Robert', 'm', '1986-05-13');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. posseder
CREATE TABLE IF NOT EXISTS `posseder` (
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK_FILM_POSSEDE` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_GENRE_POSSEDE` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.posseder : ~12 rows (environ)
DELETE FROM `posseder`;
/*!40000 ALTER TABLE `posseder` DISABLE KEYS */;
INSERT INTO `posseder` (`id_film`, `id_genre`) VALUES
	(2, 1),
	(1, 1),
	(3, 2),
	(4, 3),
	(5, 4),
	(6, 3),
	(11, 2),
	(12, 3),
	(13, 4),
	(1, 2),
	(11, 4),
	(12, 2);
/*!40000 ALTER TABLE `posseder` ENABLE KEYS */;

-- Listage de la structure de la table cinema_yuly. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_REALISATEUR_PERSONNE` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table cinema_yuly.realisateur : ~5 rows (environ)
DELETE FROM `realisateur`;
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 12),
	(5, 13);
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
