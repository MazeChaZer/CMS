INSERT INTO `cms`.`user` (`userID`, `username`, `email`, `password`, `create_time`) VALUES (1, 'admin', 'admin@cms.com', 'admin', NULL);

INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (1, 'Kategorien erstellen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (2, 'Kategorien löschen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (3, 'Kategorien bearbeiten');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (4, 'Seiten erstellen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (5, 'Seiten bearbeiten');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (6, 'Seiten löschen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (7, 'Seiten lesen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (8, 'Dokumente hochladen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (9, 'Dokumente herunterladen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (10, 'Dokumente löschen');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (11, 'Rechte editieren');
INSERT INTO `cms`.`rights` (`rechtID`, `bezeichnung`) VALUES (12, 'Gruppen erstellen');

INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 1, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 2, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 3, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 4, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 5, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 6, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 7, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 8, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 9, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 10, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 11, 1);
INSERT INTO `cms`.`userRights` (`userID`, `rechtID`, `recht`) VALUES (1, 12, 1);

INSERT INTO `cms`.`categories` (`categoryID`, `bezeichnung`, `creatorID`, `dateCreated`, `beschreibung`, `groupID`) VALUES (1, 'Standardblog', 1, NULL, 'Der Standardblog des CMS!', NULL);

INSERT INTO `cms`.`entries` (`entryID`, `authorID`, `URL`, `dateCreated`, `titel`, `inhalt`, `dateEdited`, `editorID`, `anhangID`, `categoryID`) VALUES (1, 1, 'Test', NULL, 'erster Eintrag!', 'Dies ist der erste Eintrag im Standardblog Ihres neuen CMS!', NULL, NULL, NULL, 1);

