-- phpMyAdmin SQL Dump
-- version 5.1.1deb3+bionic1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 05 déc. 2022 à 21:16
-- Version du serveur : 5.7.40
-- Version de PHP : 7.2.24-0ubuntu0.18.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dutinfopw201625`
--

-- --------------------------------------------------------

--
-- Structure de la table `Abonner`
--

CREATE TABLE `Abonner` (
  `idUserAbonne` bigint(20) UNSIGNED NOT NULL,
  `idUserAbonnement` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Abonner`
--

INSERT INTO `Abonner` (`idUserAbonne`, `idUserAbonnement`) VALUES
(8, 6),
(9, 6),
(10, 6),
(11, 6),
(12, 6),
(13, 6),
(6, 8),
(6, 9),
(10, 9),
(9, 10),
(12, 10),
(6, 11),
(6, 12),
(10, 12),
(6, 13);

-- --------------------------------------------------------

--
-- Structure de la table `Appartenir`
--

CREATE TABLE `Appartenir` (
  `idPost` bigint(20) UNSIGNED NOT NULL,
  `idCollection` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Appartenir`
--

INSERT INTO `Appartenir` (`idPost`, `idCollection`) VALUES
(74, 1),
(100, 18);

-- --------------------------------------------------------

--
-- Structure de la table `Apprecier`
--

CREATE TABLE `Apprecier` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idTag` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Apprecier`
--

INSERT INTO `Apprecier` (`idUser`, `idTag`) VALUES
(6, 1),
(6, 3),
(6, 4),
(6, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `AttribuerCollection`
--

CREATE TABLE `AttribuerCollection` (
  `idTag` bigint(20) UNSIGNED NOT NULL,
  `idCollection` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `AttribuerCollection`
--

INSERT INTO `AttribuerCollection` (`idTag`, `idCollection`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `AttribuerPost`
--

CREATE TABLE `AttribuerPost` (
  `idPost` bigint(20) UNSIGNED NOT NULL,
  `idTag` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `AttribuerPost`
--

INSERT INTO `AttribuerPost` (`idPost`, `idTag`) VALUES
(33, 1),
(35, 1),
(66, 2),
(74, 2),
(105, 2),
(33, 3),
(74, 3),
(100, 3),
(33, 5),
(35, 5),
(66, 5),
(74, 5),
(54, 6),
(66, 6);

-- --------------------------------------------------------

--
-- Structure de la table `Collections`
--

CREATE TABLE `Collections` (
  `idCollection` bigint(20) UNSIGNED NOT NULL,
  `titreCollection` varchar(50) NOT NULL,
  `descriptionCollection` varchar(500) NOT NULL,
  `prive` tinyint(1) NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Collections`
--

INSERT INTO `Collections` (`idCollection`, `titreCollection`, `descriptionCollection`, `prive`, `idUser`) VALUES
(1, 'rap', 'que du sal', 1, 9),
(6, 'yttykty', 'iktkk-Ã¨i', 1, 9),
(7, 'test', 'testtt', 1, 9),
(17, 'ok', '', 1, 6),
(18, 'Rap', 'j\'adore', 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `CommenterCollection`
--

CREATE TABLE `CommenterCollection` (
  `idCommentaire` int(11) NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idCollection` bigint(20) UNSIGNED NOT NULL,
  `avis` varchar(500) NOT NULL,
  `dateCom` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `CommenterCollection`
--

INSERT INTO `CommenterCollection` (`idCommentaire`, `idUser`, `idCollection`, `avis`, `dateCom`) VALUES
(1, 9, 1, 'yhfuizeyfzoe\r\n', '2022-12-04 18:35:55'),
(2, 9, 1, 'hrtyy', '2022-12-04 18:42:04'),
(3, 9, 1, 'gefze', '2022-12-04 18:42:53'),
(4, 9, 6, 'gggggg', '2022-12-04 18:43:27'),
(5, 9, 1, 'ddd', '2022-12-04 18:44:02'),
(6, 9, 6, 'gg', '2022-12-04 18:45:18'),
(7, 9, 6, 'dd', '2022-12-04 18:46:46');

-- --------------------------------------------------------

--
-- Structure de la table `CommenterPost`
--

CREATE TABLE `CommenterPost` (
  `idCommentaire` bigint(20) UNSIGNED NOT NULL,
  `idPost` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `avis` varchar(500) NOT NULL,
  `dateCom` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `CommenterPost`
--

INSERT INTO `CommenterPost` (`idCommentaire`, `idPost`, `idUser`, `avis`, `dateCom`) VALUES
(7, 35, 10, 'aaaaaaaaaa', '2022-11-16 11:12:02'),
(8, 35, 10, 'lala', '2022-11-16 11:16:01'),
(9, 35, 10, 'eee', '2022-11-16 11:18:45'),
(10, 30, 10, 'ceci est un autre test', '2022-11-16 11:59:02'),
(11, 54, 10, 'test test', '2022-11-16 11:59:38'),
(12, 54, 10, 'test test', '2022-11-16 11:59:41'),
(13, 54, 10, 'laaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2022-11-16 12:02:47'),
(15, 54, 10, 'pp', '2022-11-23 11:18:03'),
(16, 63, 6, 'ok\r\n', '2022-11-24 16:57:04'),
(17, 65, 6, 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2022-11-30 16:34:07');

-- --------------------------------------------------------

--
-- Structure de la table `PartagerCollection`
--

CREATE TABLE `PartagerCollection` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idCollection` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `PartagerPost`
--

CREATE TABLE `PartagerPost` (
  `idPost` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Permissions`
--

CREATE TABLE `Permissions` (
  `idPermission` bigint(20) UNSIGNED NOT NULL,
  `nomPermission` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Permissions`
--

INSERT INTO `Permissions` (`idPermission`, `nomPermission`) VALUES
(3, 'inserer'),
(1, 'mettreAjour'),
(4, 'selectionner'),
(2, 'supprimer');

-- --------------------------------------------------------

--
-- Structure de la table `PossederPermission`
--

CREATE TABLE `PossederPermission` (
  `idRoles` bigint(20) UNSIGNED NOT NULL,
  `idPermission` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `PossederPermission`
--

INSERT INTO `PossederPermission` (`idRoles`, `idPermission`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Posts`
--

CREATE TABLE `Posts` (
  `idPost` bigint(20) UNSIGNED NOT NULL,
  `lien` varchar(150) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `descriptionPost` varchar(1200) DEFAULT NULL,
  `datePost` datetime DEFAULT CURRENT_TIMESTAMP,
  `idUser` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Posts`
--

INSERT INTO `Posts` (`idPost`, `lien`, `titre`, `descriptionPost`, `datePost`, `idUser`) VALUES
(15, 'http://localhost/~hcohen/AudioDope/AudioDope/index.php?module=post&amp;action=form_redaction', 'z', '', '2022-10-26 15:35:29', 10),
(16, '', '', '', '2022-10-26 15:35:43', 10),
(20, '', 'zdzdz', '', '2022-10-26 15:40:29', 10),
(24, '', 'sere', '', '2022-10-26 15:43:22', 10),
(25, '', 'zeze', '', '2022-10-26 15:43:38', 10),
(26, '', 'srgsdrgsdfhsfr', '', '2022-10-26 15:46:30', 10),
(27, '', 'azerazqrefsdfsdf', '', '2022-10-26 15:46:55', 10),
(28, '', 'fhfgh', '', '2022-10-26 15:47:16', 10),
(29, '', 'hip', '', '2022-10-26 15:48:34', 10),
(30, '', 'Test Tag', '', '2022-10-26 16:01:16', 10),
(31, '', 'qsdqsdqsd', '', '2022-10-26 16:02:36', 10),
(32, '', 'zdzdzdzdqfqzfzq', '', '2022-10-26 16:03:00', 10),
(33, '', 'qehsrtjhsrjrjrjj', '', '2022-10-26 16:07:25', 10),
(34, '', 'fgfg', '', '2022-10-26 16:23:05', 10),
(35, '', 'rgertgerbgvdfgdgr', '', '2022-10-26 16:24:11', 10),
(49, 'http://localhost/~syang/sae/AudioDope/index.php?module=post&amp;action=form_redaction', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In laoreet sodales ullamcorper. Aliquam orci dui, eleifend eget ex ut, volutpat rhoncus ex. Phasellus bibendum laoreet nisl, non malesuada arcu ullamcorper eget. Vivamus et consectetur mauris, et vestibulum nisl. Aliquam luctus rutrum ante at aliquam. Duis id porttitor tellus, eget elementum neque. Aliquam erat volutpat.\r\n\r\nNulla ullamcorper leo sed vestibulum finibus. Nullam et sapien ultrices, facilisis enim sed, congue massa. Curabitur sodales lectus sit amet risus ullamcorper, id dignissim nulla scelerisque. Curabitur aliquam elit sit amet hendrerit iaculis. Mauris metus tellus, euismod ac semper eget, cursus sit amet orci. Proin eget bibendum tortor, efficitur lobortis felis. Nam eleifend luctus massa. Nunc sed iaculis felis. Donec non lorem non erat maximus tempor nec ultricies urna. Ut ut sapien orci. Quisque nec risus sit amet lorem tincidunt efficitur et et mauris. Pellentesque viverra nisi in velit luctus, nec fermentum', '2022-11-09 10:18:13', 6),
(54, 'http://localhost/~hcohen/AudioDope/AudioDope/index.php?module=post&amp;action=form_redaction', 'Test d\'un merge', 'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', '2022-11-16 11:59:32', 10),
(57, 'http://localhost/~hcohen/AudioDope/AudioDope/index.php?module=post&amp;action=form_redaction', 'rere', 'ef', NULL, 10),
(61, 'http://localhost/~syang/sae/AudioDope/index.php?module=post&amp;action=form_redaction', 'd', '', '2022-11-23 11:49:09', 6),
(62, 'http://localhost/~syang/sae/AudioDope/index.php?module=profil&amp;action=voir_profil&amp;idUser=6#', 'ok', '', '2022-11-23 12:12:04', 6),
(63, 'http://localhost/~syang/sae/AudioDope/index.php?module=profil&amp;action=voir_profil&amp;idUser=6#', 'g', '', '2022-11-23 12:13:31', 6),
(65, 'http://localhost/~hcohen/AudioDope/AudioDope/index.php?module=post&amp;action=form_redaction', 'ts', 'tete', '2022-11-23 16:59:10', 10),
(66, 'https://open.spotify.com/track/1OubIZ0ARYCUq5kceYUQiO?si=47157bff25244d55', 'CONGRATULATION', '', '2022-11-27 17:08:07', 6),
(67, 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redaction', 'hugo', '', '2022-11-28 21:33:48', 6),
(68, 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redaction', 'zz', '', '2022-11-28 22:04:41', 6),
(73, 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redaction', 'http://localhost/Aud', 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/Aud', '2022-11-28 22:18:49', 6),
(74, 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redaction', 'http://localhost/AudioDope/index.php?module=post&amp;a', 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/AudioDope/index.php?module=post&amp;action=form_redactionhttp://localhost/Aud', '2022-11-28 22:19:41', 6),
(83, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '1', NULL, '2022-11-30 16:02:51', 6),
(85, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '4', NULL, '2022-11-30 16:04:00', 6),
(86, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '5', NULL, '2022-11-30 16:04:00', 6),
(87, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '6', NULL, '2022-11-30 16:04:00', 6),
(88, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '7', NULL, '2022-11-30 16:04:00', 6),
(89, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '8', NULL, '2022-11-30 16:04:00', 6),
(90, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '9', NULL, '2022-11-30 16:04:00', 6),
(91, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '10', NULL, '2022-11-30 16:04:00', 6),
(92, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '11', NULL, '2022-11-30 16:05:07', 6),
(94, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '13', NULL, '2022-11-30 16:05:08', 6),
(95, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '14', NULL, '2022-11-30 16:05:08', 6),
(96, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '15', NULL, '2022-11-30 16:05:08', 6),
(97, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '16', NULL, '2022-11-30 16:05:08', 6),
(98, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '17', NULL, '2022-11-30 16:05:08', 6),
(99, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '18', NULL, '2022-11-30 16:05:08', 6),
(100, 'https://github.com/DUT-Info-Montreuil/AudioDope/network', 'Salut c\'est Hugo', 'Salut c git', '2022-11-30 16:58:38', 10),
(105, 'http://localhost/AudioDope/index.php?module=post&amp;action=form_redaction', 'aaaaaaaa', '', '2022-12-02 21:29:29', 20),
(106, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '100', NULL, '2022-12-02 22:28:27', 20),
(108, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '101', NULL, '2022-12-02 22:28:58', 20),
(109, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '102', NULL, '2022-12-02 22:28:59', 20),
(110, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '103', NULL, '2022-12-02 22:28:59', 20),
(111, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '104', NULL, '2022-12-02 22:28:59', 20),
(112, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '105', NULL, '2022-12-02 22:28:59', 20),
(113, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '106', NULL, '2022-12-02 22:28:59', 20),
(114, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '107', NULL, '2022-12-02 22:28:59', 20),
(115, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '108', NULL, '2022-12-02 22:28:59', 20),
(116, 'https://database-etudiants.iut.univ-paris8.fr/phpmyadmin/index.php?route=/table/change&db=dutinfopw201625&table=Posts', '109', NULL, '2022-12-02 22:28:59', 20);

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE `Roles` (
  `idRoles` bigint(20) UNSIGNED NOT NULL,
  `nomRoles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Roles`
--

INSERT INTO `Roles` (`idRoles`, `nomRoles`) VALUES
(2, 'admin'),
(1, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `Tags`
--

CREATE TABLE `Tags` (
  `idTag` bigint(20) UNSIGNED NOT NULL,
  `typeTag` varchar(50) NOT NULL,
  `nomTag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Tags`
--

INSERT INTO `Tags` (`idTag`, `typeTag`, `nomTag`) VALUES
(1, 'genre', 'Hip-Hop'),
(2, 'genre', 'Punk Rock'),
(3, 'annee', '2010'),
(4, 'annee', '1990'),
(5, 'artiste', 'Alpha Wann'),
(6, 'artiste', 'The Mamas & The Papas');

-- --------------------------------------------------------

--
-- Structure de la table `TypeTag`
--

CREATE TABLE `TypeTag` (
  `typeTag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TypeTag`
--

INSERT INTO `TypeTag` (`typeTag`) VALUES
('annee'),
('artiste'),
('genre');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verifie` tinyint(1) NOT NULL,
  `idRoles` bigint(20) UNSIGNED NOT NULL,
  `pfp` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUser`, `login`, `email`, `password`, `verifie`, `idRoles`, `pfp`) VALUES
(6, 'steven', 'steven@gmail.com', '$2y$10$SgSw6zc3T9hp4crjB6OI3exTFg9Hxb/cVqupXHMvbTCBEhSthnMV2', 0, 1, 'ressources/pfp/6.jpg'),
(8, 'ay', '', '$2y$10$1zMVi0Gq8E6ETvum9YI1VuzymEMdDCLcU8HRX/fPjtN17yI3QGfC2', 0, 1, 'ressources/pfp/pfp.jpg'),
(9, 'ayoub', '', '$2y$10$g7Y780GLRvnHOBNuQZoiiuY0Nf7nutjoJV2t98dGagSyb7FVKCtE6', 0, 2, 'ressources/pfp/pfp.jpg'),
(10, 'hugo', 'monmail@mail.mail', '$2y$10$8Z6j/8cXu/ztviBt9fqKjOVrIapDxu5JvOCA5HNzbVkWC/iBMT7m2', 0, 2, 'ressources/pfp/10.jpg'),
(11, 'dz', '', '$2y$10$feOFIVWKG2hEiOp5NffQY.S6n4Rl/qD85ttwaknoikvMQY3vKneuu', 0, 1, 'ressources/pfp/pfp.jpg'),
(12, 'winstonred', '', '$2y$10$OKU96MursrIM8AiXTrsm2uWHhEEf1nN3Heb6YPxm/CNxjnPwvyiWO', 0, 1, 'ressources/pfp/pfp.jpg'),
(13, 'priyank', '', '$2y$10$2HXunk8NkWBhCBX42icCAOsSzS7b0l9u3Qals8d60qsNmnjpzn..a', 0, 1, 'ressources/pfp/pfp.jpg'),
(20, 'aaaaaaaaaaaaaaaaaaaa', '', '$2y$10$JyxyGSlrhHeljtLuZoqNKej4XWof4dWeEeGRYyM1R4N2Zvc4QMqwG', 0, 1, 'ressources/pfp/pfp.jpg'),
(23, 's', 'test@gmail.com', '$2y$10$DPgFJEUKlgBYx9cuDmQZ2uEJCtxxtYoyLoLLkA6TDqFvR5FM4u3/S', 0, 1, 'ressources/pfp/pfp.jpg'),
(24, 'aa', 'steven.yang@gmail.com', '$2y$10$9NM3xOaoGYY0f5gIP1Piruqus6fjAna0uH2ImKmg5Q3IQNRogXp5e', 0, 1, 'ressources/pfp/pfp.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `VoterCollection`
--

CREATE TABLE `VoterCollection` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `vote` tinyint(1) NOT NULL,
  `idCollection` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `VoterPost`
--

CREATE TABLE `VoterPost` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `vote` tinyint(1) NOT NULL,
  `idPost` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `VoterPost`
--

INSERT INTO `VoterPost` (`idUser`, `vote`, `idPost`) VALUES
(6, -1, 15),
(6, -1, 20),
(6, 1, 26),
(6, 1, 27),
(6, 1, 30),
(6, 1, 32),
(6, 1, 33),
(6, -1, 34),
(6, -1, 35),
(6, 1, 49),
(6, 1, 63),
(6, 1, 74),
(10, 1, 25),
(10, -1, 30),
(10, 1, 49),
(10, 1, 63),
(10, 1, 74),
(10, 1, 100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Abonner`
--
ALTER TABLE `Abonner`
  ADD PRIMARY KEY (`idUserAbonne`,`idUserAbonnement`),
  ADD KEY `idUserAbonnement` (`idUserAbonnement`);

--
-- Index pour la table `Appartenir`
--
ALTER TABLE `Appartenir`
  ADD PRIMARY KEY (`idPost`,`idCollection`),
  ADD KEY `idCollection` (`idCollection`);

--
-- Index pour la table `Apprecier`
--
ALTER TABLE `Apprecier`
  ADD PRIMARY KEY (`idUser`,`idTag`),
  ADD KEY `idTag` (`idTag`);

--
-- Index pour la table `AttribuerCollection`
--
ALTER TABLE `AttribuerCollection`
  ADD PRIMARY KEY (`idTag`,`idCollection`),
  ADD KEY `idCollection` (`idCollection`);

--
-- Index pour la table `AttribuerPost`
--
ALTER TABLE `AttribuerPost`
  ADD PRIMARY KEY (`idPost`,`idTag`),
  ADD KEY `idTag` (`idTag`);

--
-- Index pour la table `Collections`
--
ALTER TABLE `Collections`
  ADD PRIMARY KEY (`idCollection`),
  ADD UNIQUE KEY `idCollection` (`idCollection`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `CommenterCollection`
--
ALTER TABLE `CommenterCollection`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `CommenterCollection_ibfk_1` (`idUser`),
  ADD KEY `CommenterCollection_ibfk_2` (`idCollection`);

--
-- Index pour la table `CommenterPost`
--
ALTER TABLE `CommenterPost`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD UNIQUE KEY `idCommentaire` (`idCommentaire`),
  ADD KEY `CommenterPost_ibfk_1` (`idPost`),
  ADD KEY `CommenterPost_ibfk_2` (`idUser`);

--
-- Index pour la table `PartagerCollection`
--
ALTER TABLE `PartagerCollection`
  ADD PRIMARY KEY (`idUser`,`idCollection`),
  ADD KEY `idCollection` (`idCollection`);

--
-- Index pour la table `PartagerPost`
--
ALTER TABLE `PartagerPost`
  ADD PRIMARY KEY (`idPost`,`idUser`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`idPermission`),
  ADD UNIQUE KEY `idPermission` (`idPermission`),
  ADD UNIQUE KEY `nomPermission` (`nomPermission`);

--
-- Index pour la table `PossederPermission`
--
ALTER TABLE `PossederPermission`
  ADD PRIMARY KEY (`idRoles`,`idPermission`),
  ADD KEY `idPermission` (`idPermission`);

--
-- Index pour la table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`idPost`),
  ADD UNIQUE KEY `idPost` (`idPost`),
  ADD UNIQUE KEY `titre` (`titre`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`idRoles`),
  ADD UNIQUE KEY `idRoles` (`idRoles`),
  ADD UNIQUE KEY `nomRoles` (`nomRoles`);

--
-- Index pour la table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`idTag`),
  ADD UNIQUE KEY `idTag` (`idTag`),
  ADD UNIQUE KEY `nomTag` (`nomTag`),
  ADD KEY `typeTag` (`typeTag`) USING BTREE;

--
-- Index pour la table `TypeTag`
--
ALTER TABLE `TypeTag`
  ADD PRIMARY KEY (`typeTag`),
  ADD UNIQUE KEY `typeTag` (`typeTag`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `idRoles` (`idRoles`);

--
-- Index pour la table `VoterCollection`
--
ALTER TABLE `VoterCollection`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD KEY `idCollection` (`idCollection`);

--
-- Index pour la table `VoterPost`
--
ALTER TABLE `VoterPost`
  ADD PRIMARY KEY (`idUser`,`idPost`),
  ADD KEY `idPost` (`idPost`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Collections`
--
ALTER TABLE `Collections`
  MODIFY `idCollection` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `CommenterCollection`
--
ALTER TABLE `CommenterCollection`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `CommenterPost`
--
ALTER TABLE `CommenterPost`
  MODIFY `idCommentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `idPermission` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `idPost` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `idRoles` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `idTag` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `VoterCollection`
--
ALTER TABLE `VoterCollection`
  MODIFY `idUser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Abonner`
--
ALTER TABLE `Abonner`
  ADD CONSTRAINT `Abonner_ibfk_1` FOREIGN KEY (`idUserAbonne`) REFERENCES `Utilisateurs` (`idUser`),
  ADD CONSTRAINT `Abonner_ibfk_2` FOREIGN KEY (`idUserAbonnement`) REFERENCES `Utilisateurs` (`idUser`);

--
-- Contraintes pour la table `Appartenir`
--
ALTER TABLE `Appartenir`
  ADD CONSTRAINT `Appartenir_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `Posts` (`idPost`) ON DELETE CASCADE,
  ADD CONSTRAINT `Appartenir_ibfk_2` FOREIGN KEY (`idCollection`) REFERENCES `Collections` (`idCollection`);

--
-- Contraintes pour la table `Apprecier`
--
ALTER TABLE `Apprecier`
  ADD CONSTRAINT `Apprecier_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`),
  ADD CONSTRAINT `Apprecier_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `Tags` (`idTag`);

--
-- Contraintes pour la table `AttribuerCollection`
--
ALTER TABLE `AttribuerCollection`
  ADD CONSTRAINT `AttribuerCollection_ibfk_1` FOREIGN KEY (`idTag`) REFERENCES `Tags` (`idTag`),
  ADD CONSTRAINT `AttribuerCollection_ibfk_2` FOREIGN KEY (`idCollection`) REFERENCES `Collections` (`idCollection`);

--
-- Contraintes pour la table `AttribuerPost`
--
ALTER TABLE `AttribuerPost`
  ADD CONSTRAINT `AttribuerPost_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `Posts` (`idPost`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `AttribuerPost_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `Tags` (`idTag`);

--
-- Contraintes pour la table `Collections`
--
ALTER TABLE `Collections`
  ADD CONSTRAINT `Collections_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`);

--
-- Contraintes pour la table `CommenterCollection`
--
ALTER TABLE `CommenterCollection`
  ADD CONSTRAINT `CommenterCollection_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `CommenterCollection_ibfk_2` FOREIGN KEY (`idCollection`) REFERENCES `Collections` (`idCollection`) ON DELETE CASCADE;

--
-- Contraintes pour la table `CommenterPost`
--
ALTER TABLE `CommenterPost`
  ADD CONSTRAINT `CommenterPost_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `Posts` (`idPost`) ON DELETE CASCADE,
  ADD CONSTRAINT `CommenterPost_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`) ON DELETE CASCADE;

--
-- Contraintes pour la table `PartagerCollection`
--
ALTER TABLE `PartagerCollection`
  ADD CONSTRAINT `PartagerCollection_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`),
  ADD CONSTRAINT `PartagerCollection_ibfk_2` FOREIGN KEY (`idCollection`) REFERENCES `Collections` (`idCollection`);

--
-- Contraintes pour la table `PartagerPost`
--
ALTER TABLE `PartagerPost`
  ADD CONSTRAINT `PartagerPost_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `Posts` (`idPost`),
  ADD CONSTRAINT `PartagerPost_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`);

--
-- Contraintes pour la table `PossederPermission`
--
ALTER TABLE `PossederPermission`
  ADD CONSTRAINT `PossederPermission_ibfk_1` FOREIGN KEY (`idRoles`) REFERENCES `Roles` (`idRoles`),
  ADD CONSTRAINT `PossederPermission_ibfk_2` FOREIGN KEY (`idPermission`) REFERENCES `Permissions` (`idPermission`);

--
-- Contraintes pour la table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`);

--
-- Contraintes pour la table `Tags`
--
ALTER TABLE `Tags`
  ADD CONSTRAINT `Tags_ibfk_1` FOREIGN KEY (`typeTag`) REFERENCES `TypeTag` (`typeTag`);

--
-- Contraintes pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD CONSTRAINT `Utilisateurs_ibfk_1` FOREIGN KEY (`idRoles`) REFERENCES `Roles` (`idRoles`);

--
-- Contraintes pour la table `VoterCollection`
--
ALTER TABLE `VoterCollection`
  ADD CONSTRAINT `VoterCollection_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`),
  ADD CONSTRAINT `VoterCollection_ibfk_2` FOREIGN KEY (`idCollection`) REFERENCES `Collections` (`idCollection`);

--
-- Contraintes pour la table `VoterPost`
--
ALTER TABLE `VoterPost`
  ADD CONSTRAINT `VoterPost_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `VoterPost_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `Posts` (`idPost`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
