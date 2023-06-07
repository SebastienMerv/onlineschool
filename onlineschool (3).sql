-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 05 Mai 2023 à 06:51
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `onlineschool`
--

-- --------------------------------------------------------

--
-- Structure de la table `activation`
--

CREATE TABLE IF NOT EXISTS `activation` (
  `code` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `activation`
--

INSERT INTO `activation` (`code`, `user_id`) VALUES
('$2y$10$NuxITXo2D9qxu74P0swCreRO9eETNgQRe./tHwou8lNFM.kji5QOu', 17),
('$2y$10$Xhs89s8REFj1hppBV4BNPuhqGeUbunwz1cdOjmMnVgJiRuUS9bCiC', 17),
('$2y$10$yHpZqvnrYPpmyCR.fyqPNew/eW0TALmnYb28boF4HC7Llq2jJEciK', 17),
('$2y$10$HMEmjURDB.L2KrkUHZ4W9efjJ7Yd/AGqYQ1Tc5SHVSuy9emusyg9S', 17);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
`id` int(255) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `libelle`, `description`, `teacher_id`, `date`) VALUES
(16, 'Cours de mécanique', 'Cours apprenti Mécanique', 6, '2023-06-14'),
(15, 'Cours de français', 'Rattrapage des cours de français', 6, '2023-06-02'),
(13, 'Cours de PHP', 'Cours de PHP pour les apprentis', 6, '2023-06-22'),
(14, 'Examen de mathématique', 'Examen final de mathématique', 6, '2023-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `absence` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`id`, `student_id`, `cours_id`, `absence`) VALUES
(13, 20, 16, 1),
(11, 18, 16, 0),
(10, 17, 16, 1),
(15, 17, 15, 1),
(16, 17, 13, 0),
(17, 18, 13, 0),
(18, 20, 13, 0),
(19, 18, 14, 1),
(21, 19, 16, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `student` tinyint(1) DEFAULT NULL,
  `teacher` tinyint(1) DEFAULT NULL,
  `activation` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `phone`, `student`, `teacher`, `activation`, `active`) VALUES
(6, 'sebastienmerveilleriviere@gmail.com', '$2y$10$RbR3YAGs1qlFDRSduPUDM.qFvJMYf6dGF/Wzn95JYIG0Td2EABdQ.', 'Merveille', 'Sébastien', '085849561', NULL, 1, '', 1),
(17, 'root@root.fr', '', 'Alicia', 'Gomand', '', 1, NULL, '', 1),
(18, 'root@root.fr', '', 'April', 'Ylena', '', 1, NULL, '', 1),
(19, 'root@root.fr', '', 'Jehasse', 'Kevin', '', 1, NULL, '', 1),
(20, 'root@root.fr', '', 'Merveille', 'Sébastien', '', 1, NULL, '', 1),
(21, 'admin', '$2y$10$WK7hNV0u3kCpUk1JfaI/hObHZ1ecjpDeCHc1CkYi7vahlyMouuk/S', 'admin', 'admin', '0000000', NULL, 1, '', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
