CREATE SCHEMA IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `cms`.`categoryGroups` (
  `groupID` INT(11) NOT NULL,
  `bezeichnung` VARCHAR(45) NULL,
  PRIMARY KEY (`groupID`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cms`.`rights` (
  `rechtID` INT(11) NOT NULL,
  `bezeichnung` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`rechtID`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `cms`.`user` (
  `userID` INT(11) NOT NULL,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(512) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `passwordEncrypted` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userID`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cms`.`uploadedData` (
  `dataID` INT(11) NOT NULL,
  `name` VARCHAR(16) NOT NULL,
  `ablageort` VARCHAR(45) NULL,
  `uploaderID` INT(11) NULL,
  PRIMARY KEY (`dataID`),
  INDEX `uploaderID_idx` (`uploaderID` ASC),
  CONSTRAINT `uploaderID`
    FOREIGN KEY (`uploaderID`)
    REFERENCES `cms`.`user` (`userID`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cms`.`categories` (
  `categoryID` INT(11) NOT NULL,
  `bezeichnung` VARCHAR(16) NOT NULL,
  `creatorID` INT(11) NULL,
  `dateCreated` TIMESTAMP NULL,
  `beschreibung` TEXT NULL,
  `groupID` INT(11) NULL,
  PRIMARY KEY (`categoryID`),
  INDEX `groupID_idx` (`groupID` ASC),
  INDEX `creatorID_idx` (`creatorID` ASC),
  CONSTRAINT `groupID`
    FOREIGN KEY (`groupID`)
    REFERENCES `cms`.`categoryGroups` (`groupID`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `creatorID`
    FOREIGN KEY (`creatorID`)
    REFERENCES `cms`.`user` (`userID`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `cms`.`userRights` (
  `userID` INT(11) NOT NULL,
  `rechtID` INT(11) NOT NULL,
  `recht` INT(11) NULL DEFAULT 0,
  PRIMARY KEY (`userID`, `rechtID`),
  INDEX `RechtID_idx` (`rechtID` ASC),
  CONSTRAINT `UserID`
    FOREIGN KEY (`userID`)
    REFERENCES `cms`.`user` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `RechtID`
    FOREIGN KEY (`rechtID`)
    REFERENCES `cms`.`rights` (`rechtID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cms`.`userGroups` (
  `userID` INT(11) NOT NULL,
  `groupID` INT(11) NOT NULL,
  PRIMARY KEY (`userID`, `groupID`),
  INDEX `groupID_idx` (`groupID` ASC),
  CONSTRAINT `userIDgroup`
    FOREIGN KEY (`userID`)
    REFERENCES `cms`.`user` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `groupIDuser`
    FOREIGN KEY (`groupID`)
    REFERENCES `cms`.`categoryGroups` (`groupID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `cms`.`entries` (
  `entryID` INT(11) NOT NULL,
  `authorID` INT(11) NOT NULL,
  `URL` VARCHAR(16) NULL,
  `dateCreated` TIMESTAMP NULL,
  `titel` VARCHAR(16) NULL,
  `inhalt` TEXT NULL,
  `dateEdited` TIMESTAMP NULL,
  `editorID` INT(11) NULL,
  `anhangID` INT(11) NULL,
  `categoryID` INT(11) NULL,
  PRIMARY KEY (`entryID`),
  INDEX `authorID_idx` (`authorID` ASC),
  INDEX `anhangID_idx` (`anhangID` ASC),
  INDEX `blogID_idx` (`categoryID` ASC),
  CONSTRAINT `authorID`
    FOREIGN KEY (`authorID`)
    REFERENCES `cms`.`user` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `anhangID`
    FOREIGN KEY (`anhangID`)
    REFERENCES `cms`.`uploadedData` (`dataID`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `categoryID`
    FOREIGN KEY (`categoryID`)
    REFERENCES `cms`.`categories` (`categoryID`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

ALTER TABLE `cms`.`entries` 
ADD CONSTRAINT `editorID`
  FOREIGN KEY (`editorID`)
  REFERENCES `cms`.`user` (`userID`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
