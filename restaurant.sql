-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 20, 2018 at 02:48 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id`     int(11)      NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) NOT NULL,
  `email`  varchar(100) NOT NULL,
  `mdp`    varchar(255) NOT NULL,
  `nom`    varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id`         int(11)  NOT NULL AUTO_INCREMENT,
  `id_user`    int(11)  NOT NULL,
  `prix_total` int(11)  NOT NULL,
  `date`       datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ligne_de_commande`
--

DROP TABLE IF EXISTS `ligne_de_commande`;
CREATE TABLE IF NOT EXISTS `ligne_de_commande` (
  `id`            int(11) NOT NULL AUTO_INCREMENT,
  `id_meal`       int(11) NOT NULL,
  `quantité`      int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

DROP TABLE IF EXISTS `meal`;
CREATE TABLE IF NOT EXISTS `meal` (
  `id`          int(11)      NOT NULL AUTO_INCREMENT,
  `name`        varchar(255) NOT NULL,
  `categories`  text         NOT NULL,
  `description` text         NOT NULL,
  `prix_achat`  float        NOT NULL,
  `prix_vente`  float        NOT NULL,
  `stock`       int(11)      NOT NULL,
  `photo`       text         NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`id`, `name`, `categories`, `description`, `prix_achat`, `prix_vente`, `stock`, `photo`) VALUES
(1, 'Coca-Cola', 'Boisson', 'Mmmm, le Coca-Cola avec 10 morceaux de sucres et tout plein de caféine', 1, 3, 50, 'coca.jpg'),
(2, 'Bagel Thon', 'burger', 'Notre bagel est constitué d\'un pain moelleux avec des grains de sésame et du thon albacore, accompagné de feuilles de salade fraîche du jour et d\'une sauce renversante.', 1, 6, 10, 'bagel_thon.jpg'),
(5, 'Bacon cheeseBurger', 'burger', 'Ce délicieux cheeseburger contient un steak haché viande française de 150g ainsi que  d\'un buns grillé juste comme il faut, le tout accompagné de frites fraîche maison!', 2, 13, 40, 'bacon_cheeseburger.jpg'),
(6, 'Cookie', 'gateau', 'Nos cookies sont delicieux', 0.5, 7.5, 100, 'cookies.jpg'),
(7, 'Dr.Pepper', 'Boisson', 'son goût sucré avec de l\'amande vous ravira !', 1, 5, 600, 'drpepper.jpg'),
(8, 'Milkshake', 'boisson', 'Notre milkshake bien crémeux contient des morceaux d\'Oréos et est accompagné de crème chantilly et de smarties en guise de topping il éblouira vos papilles ! ', 3, 37, 100, 'milkshake.jpg'),
(9, 'Donut Chocolat', 'gateau', 'Les donuts sont fabriqués le matin même et sont recouvert d\'une délicieuse sauce au chocolat ! ', 2, 15, 42, 'chocolate_donut.jpg'),
(10, 'Carrot Cake', 'gateau', 'Le carrot cake maison ravira les plus gourmands et les puristes : tous les ingrédients sont naturels ! A consommer sans modération', 13, 27, 20, 'carrot_cake.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id`          int(11)  NOT NULL AUTO_INCREMENT,
  `id_user`     int(11)  NOT NULL,
  `date`        datetime NOT NULL,
  `nb_couverts` int(11)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id`                int(11)      NOT NULL AUTO_INCREMENT,
  `nom`               varchar(150)          DEFAULT NULL,
  `prenom`            varchar(150)          DEFAULT NULL,
  `email`             varchar(255) NOT NULL,
  `date_de_naissance` date                  DEFAULT NULL,
  `mdp`               varchar(255) NOT NULL,
  `adresse`           text,
  `code_postal`       int(11)               DEFAULT NULL,
  `ville`             varchar(255)          DEFAULT NULL,
  `phone`             varchar(60)  NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`,
                    `nom`,
                    `prenom`,
                    `email`,
                    `date_de_naissance`,
                    `mdp`,
                    `adresse`,
                    `code_postal`,
                    `ville`,
                    `phone`)
VALUES (1,
        'Kherbache',
        'Yacine',
        'yaci016@hotmail.fr',
        '1939-01-01',
        'san019',
        '85 rue remi caughe',
        59100,
        'ROUBAIX',
        '617421138'),
       (2,
        'Kherbache',
        'Yacine',
        'yacinekherbache@yaci.fr',
        '1939-01-01',
        'yacinekherbache@yaci.fr1',
        '85 rue remi caughe',
        59100,
        'ROUBAIX',
        '617421131'),
       (4,
        '',
        '',
        'yacinekherbache1@yaci.fr',
        '1939-01-01',
        '$2y$10$WzCUPG6YOoalZ5X6pqGfaeiJ.vkUK7bejivPwMWPnOSjVDgiEl07G',
        '',
        0,
        '',
        '06 17 42 11 38'),
       (5,
        'Kherbache',
        'Yacine',
        'yacinekherbache3@yaci.fr',
        '1939-01-01',
        '$2y$10$LpBI7J0tNKg2PBWww6GaUerHugmjmPDI5wbNiqcSd2LcHnCkvXbPa',
        '85 rue remi caughe',
        59100,
        'ROUBAIX',
        '05 17 42 11 38'),
       (6,
        'Kherbache',
        'Yacine',
        'yacinekherbache4@yaci.fr',
        '1939-01-01',
        '$2y$10$KSXU4RNYR8uYYaKH32zXsuaNB1Lhc6lcQun/dH2LsZGSDJaq35U5m',
        '85 rue remi caughe',
        59100,
        'ROUBAIX',
        '05 17 42 11 37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
