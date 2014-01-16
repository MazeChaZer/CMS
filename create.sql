-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2014 at 12:19 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryID` int(11) NOT NULL,
  `bezeichnung` varchar(16) NOT NULL,
  `creatorID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT NULL,
  `beschreibung` text,
  `groupID` int(11) DEFAULT NULL,
  PRIMARY KEY (`categoryID`),
  KEY `groupID_idx` (`groupID`),
  KEY `creatorID_idx` (`creatorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorygroups`
--

CREATE TABLE IF NOT EXISTS `categorygroups` (
  `groupID` int(11) NOT NULL,
  `bezeichnung` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `entryID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `URL` varchar(16) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT NULL,
  `titel` varchar(16) DEFAULT NULL,
  `inhalt` text,
  `dateEdited` timestamp NULL DEFAULT NULL,
  `editorID` int(11) DEFAULT NULL,
  `anhangID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  PRIMARY KEY (`entryID`),
  KEY `authorID_idx` (`authorID`),
  KEY `anhangID_idx` (`anhangID`),
  KEY `blogID_idx` (`categoryID`),
  KEY `editorID` (`editorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `rechtID` int(11) NOT NULL,
  `bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`rechtID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uploadeddata`
--

CREATE TABLE IF NOT EXISTS `uploadeddata` (
  `dataID` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `size` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash` varchar(45) DEFAULT NULL,
  `uploaderID` int(11) DEFAULT NULL,
  PRIMARY KEY (`dataID`),
  KEY `uploaderID_idx` (`uploaderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(512) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `passwordEncrypted` tinyint(1) NOT NULL DEFAULT '0',
  `sessiontoken` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE IF NOT EXISTS `usergroups` (
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`groupID`),
  KEY `groupID_idx` (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userrights`
--

CREATE TABLE IF NOT EXISTS `userrights` (
  `userID` int(11) NOT NULL,
  `rechtID` int(11) NOT NULL,
  `recht` int(11) DEFAULT '0',
  PRIMARY KEY (`userID`,`rechtID`),
  KEY `RechtID_idx` (`rechtID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `groupID` FOREIGN KEY (`groupID`) REFERENCES `categorygroups` (`groupID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `creatorID` FOREIGN KEY (`creatorID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `editorID` FOREIGN KEY (`editorID`) REFERENCES `user` (`userID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `anhangID` FOREIGN KEY (`anhangID`) REFERENCES `uploadeddata` (`dataID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `authorID` FOREIGN KEY (`authorID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryID` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON UPDATE CASCADE;

--
-- Constraints for table `uploadeddata`
--
ALTER TABLE `uploadeddata`
  ADD CONSTRAINT `uploaderID` FOREIGN KEY (`uploaderID`) REFERENCES `user` (`userID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `userIDgroup` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupIDuser` FOREIGN KEY (`groupID`) REFERENCES `categorygroups` (`groupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userrights`
--
ALTER TABLE `userrights`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RechtID` FOREIGN KEY (`rechtID`) REFERENCES `rights` (`rechtID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
