-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 26. Jan 2014 um 18:29
-- Server Version: 5.6.14
-- PHP-Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `cms`
--

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`categoryID`, `bezeichnung`, `creatorID`, `dateCreated`, `beschreibung`, `groupID`) VALUES
(1, 'Standardblog', 1, NULL, 'Der Standardblog des CMS!', NULL);

--
-- Daten für Tabelle `entries`
--

INSERT INTO `entries` (`entryID`, `authorID`, `URL`, `dateCreated`, `titel`, `inhalt`, `dateEdited`, `editorID`, `anhangID`, `categoryID`, `locked`, `lockedBy`) VALUES
(1, 1, '', '2014-01-14 23:00:00', 'asdf', '<p>dasdfasdfasf</p>\r\n', '2014-01-26 17:27:43', NULL, NULL, 1, '2014-01-26 17:27:43', 1);

--
-- Daten für Tabelle `rights`
--

INSERT INTO `rights` (`rechtID`, `bezeichnung`) VALUES
(1, 'Kategorien erstellen'),
(2, 'Kategorien löschen'),
(3, 'Kategorien bearbeiten'),
(4, 'Seiten erstellen'),
(5, 'Seiten bearbeiten'),
(6, 'Seiten löschen'),
(7, 'Seiten lesen'),
(8, 'Dokumente hochladen'),
(9, 'Dokumente herunterladen'),
(10, 'Dokumente löschen'),
(11, 'Rechte editieren'),
(12, 'Gruppen erstellen');

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userID`, `username`, `email`, `password`, `create_time`, `passwordEncrypted`, `sessiontoken`) VALUES
(1, 'adminadmin', 'admin@cms.com', 'adminadmin', NULL, 0, 'QbX7nWdeCQ3pM1AV');

--
-- Daten für Tabelle `userrights`
--

INSERT INTO `userrights` (`userID`, `rechtID`, `recht`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 1),
(1, 11, 1),
(1, 12, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
