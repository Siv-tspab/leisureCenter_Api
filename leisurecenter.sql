-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 25 sep. 2021 à 13:32
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leisurecenter`
--

-- --------------------------------------------------------

--
-- Structure de la table `leisure_category`
--

CREATE TABLE `leisure_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leisure_category`
--

INSERT INTO `leisure_category` (`id`, `name`) VALUES
(1, 'Kitesurf'),
(2, 'Canoë'),
(3, 'Wakeboard'),
(4, 'Accrobranche'),
(5, 'Escalade');
(6, 'VTT');
(7, 'Via Ferrata');
(8, 'Randonnée');
(9, 'Battle Tag');
(10, 'Surf');

-- --------------------------------------------------------

--
-- Structure de la table `leisure_center`
--

CREATE TABLE `leisure_center` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additionnal_infos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leisure_center`
--

INSERT INTO `leisure_center` (`id`, `name`, `description`, `address`, `link`, `additionnal_infos`) VALUES
(1, 'Solo Escalade', 'SOLO Escalade est une salle de sport pour une remise en forme ludique ou pour un entraînement intensif. Dans une ambiance lumineuse et colorée, bougez en 3 dimensions !', '131, chemin du Sang de Serp 31200 Toulouse', 'http://www.soloescalade.fr/', NULL),
(2, 'WAM PARK - Toulouse - Sesquières', 'Une base de loisirs nouvelle génération : grand et petit téléski, terrasse, water games et bien plus!', 'Allée des foulques 31200 Toulouse', 'http://www.wampark.fr/', NULL),
(3, 'Canoë Kayak Toulousain', "Le CKT est une association dont l'activité principale est l'enseignement du Canoë-Kayak. Les adhérents disposent de cours réguliers pour acquérir les techniques dans différentes formes de pratique.", '16 chemin de la Loge 31400 Toulouse', 'http://www.cktoulousain.fr/', NULL),
(4, 'Biarritz Surf Training', 'Situé à Biarritz au Pays basque, à 300 m de la plage à pied, le surf camp de Surftraining est une école de surf ouverte à tous quelque soit votre niveau, débutant ou confirmé.', 'Plage de la cote des basques Boulevard du prince de Galles 64200 Biarritz', 'http://www.surftraining.com/', NULL),
(5, 'VTT Pyrénées Plaisir', "Encadrement VTT dans les Pyrénées Française et Espagnole: stage pilotage VTT tous niveaux, Stage VTT Enduro Navette, Raids All Mountain, Préparation suspension terrain. Nous gérons toute la logistique, vous n'avez qu'à profiter.", '3 lotissement peruilhet 64570 Issor', 'http://pyreneesplaisir.com/', NULL);
(6, "Block'Out Toulouse", "Salle d'escalade de bloc et restaurant ouverts 7 jours sur 7 à Toulouse dans le Languedoc-Roussillon-Midi-Pyrénées, avec salle de musculation, sauna et hammam.", "2 rue de l'Égalité 31200 Toulouse", 'https://www.blockout.fr/bo-toulouse', NULL),
(7, "Auterive Adventures", "Implanté sur un site de 9 hectares sur les deux berges de l'Ariège, ce parc d'aventures est ouvert 'tous les week-ends' et 'tous les jours' pendant toutes les vacances scolaires... Il vous donnera des 'sensations fortes' dans ses parcours très variés dont certains 'très engageants'..", "auterive 31190", 'https://www.auterive-adventures.com/', NULL),

-- --------------------------------------------------------

--
-- Structure de la table `leisure_center_leisure_category`
--

CREATE TABLE `leisure_center_leisure_category` (
  `leisure_center_id` int(11) NOT NULL,
  `leisure_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leisure_center_leisure_category`
--

INSERT INTO `leisure_center_leisure_category` (`leisure_center_id`, `leisure_category_id`) VALUES
(1, 5),
(2, 3),
(3, 2),
(4, 10),
(5, 6);
(6, 5);
(7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'samsepiol@mail.com', '[]', '$2y$13$BDWjve3xKtnWtNWQ5mP74eu25NJnOsNcA6Cj9KVGvwsVwLvMT2FQe');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `leisure_category`
--
ALTER TABLE `leisure_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `leisure_center`
--
ALTER TABLE `leisure_center`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `leisure_center_leisure_category`
--
ALTER TABLE `leisure_center_leisure_category`
  ADD PRIMARY KEY (`leisure_center_id`,`leisure_category_id`),
  ADD KEY `IDX_1788261C77458AFB` (`leisure_center_id`),
  ADD KEY `IDX_1788261CACA9AD4A` (`leisure_category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `leisure_category`
--
ALTER TABLE `leisure_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `leisure_center`
--
ALTER TABLE `leisure_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `leisure_center_leisure_category`
--
ALTER TABLE `leisure_center_leisure_category`
  ADD CONSTRAINT `FK_1788261C77458AFB` FOREIGN KEY (`leisure_center_id`) REFERENCES `leisure_center` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1788261CACA9AD4A` FOREIGN KEY (`leisure_category_id`) REFERENCES `leisure_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
