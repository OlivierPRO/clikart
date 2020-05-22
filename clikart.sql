-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 05 Mars 2019 à 13:25
-- Version du serveur :  5.7.25-0ubuntu0.18.10.2
-- Version de PHP :  7.2.15-0ubuntu0.18.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `clikart`
--

-- --------------------------------------------------------

--
-- Structure de la table `clik_Comments`
--

CREATE TABLE `clik_Comments` (
  `id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `id_clik_Users` int(11) NOT NULL,
  `id_clik_Users_have5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clik_Departments`
--

CREATE TABLE `clik_Departments` (
  `id` int(11) NOT NULL,
  `depNumbers` int(11) NOT NULL,
  `depName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clik_Departments`
--

INSERT INTO `clik_Departments` (`id`, `depNumbers`, `depName`) VALUES
(1, 1, 'Ain'),
(2, 2, 'Aisne'),
(3, 3, 'Allier'),
(4, 4, 'Alpes-de-Haute-Provence'),
(5, 5, 'Hautes-Alpes'),
(6, 6, 'Alpes-Maritimes'),
(7, 7, 'Ardèche'),
(8, 8, 'Ardennes'),
(9, 9, 'Ariège'),
(10, 10, 'Aube'),
(11, 11, 'Aude'),
(12, 12, 'Aveyron'),
(13, 13, 'Bouches-du-Rhône'),
(14, 14, 'Calvados'),
(15, 15, 'Cantal'),
(16, 16, 'Charente'),
(17, 17, 'Charente-Maritime'),
(18, 18, 'Cher'),
(19, 19, 'Corrèze'),
(20, 20, 'Corse-du-Sud'),
(21, 21, 'Côte-d\'Or'),
(22, 22, 'Côtes-d\'Armor'),
(23, 23, 'Creuse'),
(24, 24, 'Dordogne'),
(25, 25, 'Doubs'),
(26, 26, 'Drôme'),
(27, 27, 'Eure'),
(28, 28, 'Eure-et-Loir'),
(29, 29, 'Finistère'),
(30, 30, 'Gard'),
(31, 31, 'Haute-Garonne'),
(32, 32, 'Gers'),
(33, 33, 'Gironde'),
(34, 34, 'Hérault'),
(35, 35, 'Ille-et-Vilaine'),
(36, 36, 'Indre'),
(37, 37, 'Indre-et-Loire'),
(38, 38, 'Isère'),
(39, 39, 'Jura'),
(40, 40, 'Landes'),
(41, 41, 'Loir-et-Cher'),
(42, 42, 'Loire'),
(43, 43, 'Haute-Loire'),
(44, 44, 'Loire-Atlantique'),
(45, 45, 'Loiret'),
(46, 46, 'Lot'),
(47, 47, 'Lot-et-Garonne'),
(48, 48, 'Lozère'),
(49, 49, 'Maine-et-Loire'),
(50, 50, 'Manche'),
(51, 51, 'Marne'),
(52, 52, 'Haute-Marne'),
(53, 53, 'Mayenne'),
(54, 54, 'Meurthe-et-Moselle'),
(55, 55, 'Meuse'),
(56, 56, 'Morbihan'),
(57, 57, 'Moselle'),
(58, 58, 'Nièvre'),
(59, 59, 'Nord'),
(60, 60, 'Oise'),
(61, 61, 'Orne'),
(62, 62, 'Pas-de-Calais'),
(63, 63, 'Puy-de-Dôme'),
(64, 64, 'Pyrénées-Atlantiques'),
(65, 65, 'Hautes-Pyrénées'),
(66, 66, 'Pyrénées-Orientales'),
(67, 67, 'Bas-Rhin'),
(68, 68, 'Haut-Rhin'),
(69, 69, 'Rhône'),
(70, 70, 'Haute-Saône'),
(71, 71, 'Saône-et-Loire'),
(72, 72, 'Sarthe'),
(73, 73, 'Savoie'),
(74, 74, 'Haute-Savoie'),
(75, 75, 'Paris'),
(76, 76, 'Seine-Maritime'),
(77, 77, 'Seine-et-Marne'),
(78, 78, 'Yvelines'),
(79, 79, 'Deux-Sèvres'),
(80, 80, 'Somme'),
(81, 81, 'Tarn'),
(82, 82, 'Tarn-et-Garonne'),
(83, 83, 'Var'),
(84, 84, 'Vaucluse'),
(85, 85, 'Vendée'),
(86, 86, 'Vienne'),
(87, 87, 'Haute-Vienne'),
(88, 88, 'Vosges'),
(89, 89, 'Yonne'),
(90, 90, 'Territoire de Belfort'),
(91, 91, 'Essonne'),
(92, 92, 'Hauts-de-Seine'),
(93, 93, 'Seine-Saint-Denis'),
(94, 94, 'Val-de-Marne'),
(95, 95, 'Val-d\'Oise'),
(96, 971, 'Guadeloupe'),
(97, 972, 'Martinique'),
(98, 973, 'Guyane'),
(99, 974, 'La Réunion'),
(100, 975, 'St-Pierre-et-Miquelon'),
(101, 976, 'Mayotte'),
(102, 986, 'Wallis et Futuna'),
(103, 987, 'Polynésie Française'),
(104, 988, 'Nouvelle Calédonie');

-- --------------------------------------------------------

--
-- Structure de la table `clik_Eyes`
--

CREATE TABLE `clik_Eyes` (
  `id` int(11) NOT NULL,
  `eyesColor` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clik_Eyes`
--

INSERT INTO `clik_Eyes` (`id`, `eyesColor`) VALUES
(1, 'marrons'),
(2, 'bleus'),
(3, 'verts'),
(4, 'vairons'),
(5, 'gris');

-- --------------------------------------------------------

--
-- Structure de la table `clik_Glasses`
--

CREATE TABLE `clik_Glasses` (
  `id` int(11) NOT NULL,
  `glasses` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clik_Glasses`
--

INSERT INTO `clik_Glasses` (`id`, `glasses`) VALUES
(1, 'oui'),
(2, 'non');

-- --------------------------------------------------------

--
-- Structure de la table `clik_Hair`
--

CREATE TABLE `clik_Hair` (
  `id` int(11) NOT NULL,
  `hairColor` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clik_Hair`
--

INSERT INTO `clik_Hair` (`id`, `hairColor`) VALUES
(1, 'noir'),
(2, 'brun'),
(3, 'chatain'),
(4, 'blond'),
(5, 'blond venitien'),
(6, 'roux'),
(7, 'auburn'),
(8, 'blanc');

-- --------------------------------------------------------

--
-- Structure de la table `clik_Infos`
--

CREATE TABLE `clik_Infos` (
  `id` int(11) NOT NULL,
  `id_clik_Hair` int(11) NOT NULL,
  `id_clik_Glasses` int(11) NOT NULL,
  `id_clik_Eyes` int(11) NOT NULL,
  `id_clik_Users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clik_Roles`
--

CREATE TABLE `clik_Roles` (
  `id` int(11) NOT NULL,
  `roles` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clik_Roles`
--

INSERT INTO `clik_Roles` (`id`, `roles`) VALUES
(1, 'admin'),
(2, 'photographe moderateur'),
(3, 'modèle moderateur'),
(4, 'photographe'),
(5, 'modèle');

-- --------------------------------------------------------

--
-- Structure de la table `clik_Users`
--

CREATE TABLE `clik_Users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `retribution` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `photoProfil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_clik_Roles` int(11) NOT NULL,
  `id_clik_Departments` int(11) NOT NULL,
  `firstconnect` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastConnect` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clik_Users`
--

INSERT INTO `clik_Users` (`id`, `pseudo`, `password`, `mail`, `birthdate`, `retribution`, `description`, `photoProfil`, `id_clik_Roles`, `id_clik_Departments`, `firstconnect`, `lastConnect`) VALUES
(111, 'testPhotograph', '$2y$10$nBoS9IkdinXw7Lbp78NNfetlsakOgpYdxOAy3xS5w9zGMC0GTXL1O', 'testphotograph@test.com', '2017-07-11', 'oui', 'je suis le photographe test', 'assets/members/profilPhoto/default/photographDefault.jpg', 4, 42, '2019-03-03 12:51:03', '2019-03-03 23:23:14'),
(113, 'photographeModerateur', '$2y$10$DbanelmOQFI5bqoRMHAtPeHuhNzdl8vJZyuABfQCL3VZE62w7KtBy', 'testPhotographMod@test.com', '2018-06-12', 'non', 'je suis le photographe moderateur', 'assets/members/profilPhoto/default/photographDefault.jpg', 2, 37, '2019-03-03 12:59:28', '2019-03-03 13:13:05'),
(117, 'olivier', '$2y$10$sk3sbaByiwERacGnzwbYs.MJhoQEdPGV/yQPJEGk0AUeL4b201Zh6', 'admin@admin.com', '1981-05-26', 'non', 'je suis l\'admin', 'assets/members/profilPhoto/117.jpg', 1, 2, '2019-03-04 13:26:34', '2019-03-04 13:27:29'),
(127, 'test', '$2y$10$Q/SEUZNHKlSFeN3KKr0cZeNesamwciOjaR8RVZ1qggtEsRJX76972', 'test@test.test', '2019-03-27', 'oui', 'test', 'assets/members/profilPhoto/default/photographDefault.jpg', 4, 10, '2019-03-05 12:11:44', '2019-03-05 12:11:44'),
(128, 'modeleModerateur', '$2y$10$UVvYOGLiDknjXUmIyekPyezjF1gMa5Q.9z7.KqgHEaiflvrZhYvf6', 'testmodeleModerateur@test.com', '2000-12-29', 'non', 'je suis le model moderateur', 'assets/members/profilPhoto/default/modelDefault.jpg', 3, 48, '2019-03-05 12:18:01', '2019-03-05 12:20:05'),
(129, 'testModel', '$2y$10$i6hBKZZCfw9QjZjbh9S6xOeGRJxPbGHEjOPqY4b/PiCQJB5qEhxje', 'testmodele@test.com', '1995-10-10', 'oui', 'je suis le model test', 'assets/members/profilPhoto/default/modelDefault.jpg', 5, 94, '2019-03-05 12:19:29', '2019-03-05 12:19:29');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clik_Comments`
--
ALTER TABLE `clik_Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clik_Comments_clik_Users0_FK` (`id_clik_Users_have5`),
  ADD KEY `clik_Comments_clik_Users_FK` (`id_clik_Users`);

--
-- Index pour la table `clik_Departments`
--
ALTER TABLE `clik_Departments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clik_Eyes`
--
ALTER TABLE `clik_Eyes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clik_Glasses`
--
ALTER TABLE `clik_Glasses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clik_Hair`
--
ALTER TABLE `clik_Hair`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clik_Infos`
--
ALTER TABLE `clik_Infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clik_Infos_clik_Users_AK` (`id_clik_Users`),
  ADD KEY `clik_Infos_clik_Eyes1_FK` (`id_clik_Eyes`),
  ADD KEY `clik_Infos_clik_Glasses0_FK` (`id_clik_Glasses`),
  ADD KEY `clik_Infos_clik_Hair_FK` (`id_clik_Hair`);

--
-- Index pour la table `clik_Roles`
--
ALTER TABLE `clik_Roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clik_Users`
--
ALTER TABLE `clik_Users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clik_Users_clik_Roles_FK` (`id_clik_Roles`),
  ADD KEY `clik_Users_clik_Departments0_FK` (`id_clik_Departments`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clik_Comments`
--
ALTER TABLE `clik_Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `clik_Departments`
--
ALTER TABLE `clik_Departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT pour la table `clik_Eyes`
--
ALTER TABLE `clik_Eyes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `clik_Glasses`
--
ALTER TABLE `clik_Glasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `clik_Hair`
--
ALTER TABLE `clik_Hair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `clik_Infos`
--
ALTER TABLE `clik_Infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT pour la table `clik_Roles`
--
ALTER TABLE `clik_Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `clik_Users`
--
ALTER TABLE `clik_Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `clik_Comments`
--
ALTER TABLE `clik_Comments`
  ADD CONSTRAINT `clik_Comments_clik_Users0_FK` FOREIGN KEY (`id_clik_Users_have5`) REFERENCES `clik_Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clik_Comments_clik_Users_FK` FOREIGN KEY (`id_clik_Users`) REFERENCES `clik_Users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `clik_Infos`
--
ALTER TABLE `clik_Infos`
  ADD CONSTRAINT `clik_Infos_clik_Eyes1_FK` FOREIGN KEY (`id_clik_Eyes`) REFERENCES `clik_Eyes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clik_Infos_clik_Glasses0_FK` FOREIGN KEY (`id_clik_Glasses`) REFERENCES `clik_Glasses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clik_Infos_clik_Hair_FK` FOREIGN KEY (`id_clik_Hair`) REFERENCES `clik_Hair` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clik_Infos_clik_Users2_FK` FOREIGN KEY (`id_clik_Users`) REFERENCES `clik_Users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `clik_Users`
--
ALTER TABLE `clik_Users`
  ADD CONSTRAINT `clik_Users_clik_Departments0_FK` FOREIGN KEY (`id_clik_Departments`) REFERENCES `clik_Departments` (`id`),
  ADD CONSTRAINT `clik_Users_clik_Roles_FK` FOREIGN KEY (`id_clik_Roles`) REFERENCES `clik_Roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
