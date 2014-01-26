-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 26. Jan 2014 um 17:34
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
(1, 1, 'Test/ErsterEintrag', '2014-01-14 23:00:00', 'Erster Eintrag!', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.', '2014-01-23 10:36:02', NULL, NULL, 1, NULL, NULL);

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
-- Daten für Tabelle `uploadedData`
--

INSERT INTO `uploadedData` (`dataID`, `name`, `ablageort`, `uploaderID`) VALUES
(0, 'Testdatei', 'Ordner/Datei.txt', 1);

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userID`, `username`, `email`, `password`, `create_time`, `passwordEncrypted`, `sessiontoken`) VALUES
(1, 'adminadmin', 'admin@cms.com', 'adminadmin', NULL, 0, 'QbX7nWdeCQ3pM1AV');

--
-- Daten für Tabelle `userRights`
--

INSERT INTO `userRights` (`userID`, `rechtID`, `recht`) VALUES
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
