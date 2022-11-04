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


-- Listage de la structure de la base pour forum_primo
CREATE DATABASE IF NOT EXISTS `forum_primo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum_primo`;

-- Listage de la structure de la table forum_primo. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) NOT NULL,
  `orderCategorie` int(11) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_primo.categorie : ~3 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`, `orderCategorie`) VALUES
	(1, 'Fanzines', 1),
	(2, 'Podcasts', 2),
	(3, 'Autre', 3);
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum_primo. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `textePost` longtext NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_primo.post : ~4 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `datePost`, `textePost`, `topic_id`, `user_id`) VALUES
	(1, '2022-11-04 11:23:23', 'Bonsoir tout le monde !\r\nEst-ce que quelqu\'un voudrait échanger des fanzines ?\r\nJ\'ai quelques volumes rares d\'un fanzine norvégien dont je voudrais me débarrasser si ça intéresse du monde !', 1, 1),
	(2, '2022-11-04 11:24:45', 'Mon imprimante fait de grandes traces bleues sur mes images, quelqu\'un saurait d\'où peut venir le problème ? Est-ce réparable ?\r\n', 2, 1),
	(3, '2022-11-04 11:26:20', 'Bonjour tout le monde !\r\nJe viens de voir qu\'Ableton avait un site pas mal fait pour comprendre les rudiments de la MAO, si ça peut vous être utile pour de l\'habillage sonore\r\nhttps://learningmusic.ableton.com/index.html\r\nBonne journée à tous !', 3, 1),
	(4, '2022-11-04 11:28:27', 'Hello tout le monde !\r\nJe manque un peu d\'idées culinairement parlant,\r\nEst-ce que vous auriez des bonnes recettes de quiche à partager ?\r\nMerci d\'avance', 4, 1),
	(5, '2022-11-04 16:45:53', 'Bonsoir, j\'ai le même problème mais avec du orange', 2, 2);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum_primo. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `titreTopic` varchar(255) NOT NULL,
  `dateCreaTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verrouTopic` tinyint(1) NOT NULL DEFAULT '0',
  `categorie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `categorie_id` (`categorie_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_primo.topic : ~4 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `titreTopic`, `dateCreaTopic`, `verrouTopic`, `categorie_id`, `user_id`) VALUES
	(1, 'Echanges de fanzines', '2022-11-04 11:21:00', 0, 1, 1),
	(2, 'Problèmes d\'impression', '2022-11-04 11:21:41', 0, 1, 1),
	(3, 'Tuto Ableton', '2022-11-04 11:21:59', 0, 2, 1),
	(4, 'Vos meilleures recettes de quiche ?', '2022-11-04 11:22:20', 0, 3, 1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum_primo. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `emailUser` varchar(50) NOT NULL,
  `mdpUser` varchar(255) NOT NULL,
  `pseudoUser` varchar(50) NOT NULL,
  `roleUser` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_primo.user : ~1 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `emailUser`, `mdpUser`, `pseudoUser`, `roleUser`) VALUES
	(1, 'martin.grimbert@sogetec.fr', 'pamplemousse67', 'Martin Grimbert', 'Admin'),
	(2, 'anne-so.passereau@sogetec.fr', '544peofjefzo', 'Anne-Sophie Passereau', 'Moderateur');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
