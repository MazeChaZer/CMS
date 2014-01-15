<?php
namespace ITC\CMS;

use ITC\CMS\Entity;
use PDO;

/**
 * Description of entry
 *
 * @author Lukas
 */
class Entry extends Model {
    
    private $entryID = 0;
    private $authorID;
    private $URL;
    private $titel;
    private $inhalt;
    private $dateEdited;
    private $dateCreated;
    private $editorID;
    private $anhangID;
    private $categoryID;
    
    public function getEntryID() {
        return $this->entryID;
    }

    public function getAuthorID() {
        return $this->authorID;
    }

    public function getURL() {
        return $this->URL;
    }

    public function getTitel() {
        return $this->titel;
    }

    public function getInhalt() {
        return $this->inhalt;
    }

    public function getDateEdited() {
        return $this->dateEdited;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getEditorID() {
        return $this->editorID;
    }

    public function getAnhangID() {
        return $this->anhangID;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }


    public function setURL($URL) {
        $this->URL = $URL;
    }

    public function setTitel($titel) {
        $this->titel = $titel;
    }

    public function setInhalt($inhalt) {
        $this->inhalt = $inhalt;
    }

    public function setEditorID($editorID) {
        $this->editorID = $editorID;
    }

    public function setAnhangID($anhangID) {
        $this->anhangID = $anhangID;
    }

    public function setCategoryID($categoryID) {
        $this->categoryID = $categoryID;
    }
    
    private function getNewID()
    {
        $SQL = "SELECT MAX(entryID) AS maxID FROM entries;";
        $stmt = self::$db->query($SQL);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['maxID'] + 1;
    }
    
    public function load($entryID)
    {
            $st = self::$db->prepare(
               "SELECT * FROM entries
                   WHERE entryID = :entryID"
            );
            $st->execute(array(
               ':entryID' => $entryID)
            );
            $result = $st->fetch(PDO::FETCH_ASSOC);
            if(!empty($result))
            {
                $this->authorID = $result['authorID'];
                $this->URL = $result['URL'];
                $this->titel = $result['titel'];
                $this->inhalt = $result['inhalt'];
                $this->dateEdited = $result['dateEdited'];
                $this->dateCreated = $result['dateCreated'];
                $this->editorID = $result['editorID'];
                $this->anhangID = $result['anhangID'];
                $this->categoryID = $result['categoryID'];
                $this->entryID = $result['entryID'];
                return 0;   // Entry successfully loaded!
            }
            else
            {
                return 1; // Entry not found!
            }
    }
    
    public function save()  //update or create the entry
    {
        if($this->entryID == 0)
        {
            $this->entryID = $this->getNewID();
            $st = self::$db->prepare(
                "INSERT INTO entries
                    ( entryID, authorID, URL, dateCreated, titel, inhalt, dateEdited, editorID, anhangID, categoryID)
                 VALUES 
                    ( :entryID, :authorID, :URL, :dateCreated, :titel, :inhalt, :dateEdited, :editorID, :anhangID, :categoryID )"
            );
            $st->execute(array(
                ':entryID' => $this->entryID,
                ':authorID' => $this->authorID,
                ':URL' => $this->URL,
                ':dateCreated' => date("Y-m-d H:i:s",time()),
                ':titel' => $this->titel,                
                ':inhalt' => $this->inhalt,
                ':dateEdited' => NULL,
                ':editorID' => NULL,
                ':anhangID' => $this->anhangID,
                ':categoryID' => $this->categoryID)
            );
            return 0;
        }
        else
        {
            $st = self::$db->prepare(
                "UPDATE entries
                    SET  
                        URL = :URL,
                        titel = :titel,
                        inhalt = :inhalt,
                        dateEdited = :dateEdited,
                        editorID = :editorID,
                        anhangID = :anhangID,
                        categoryID = :categoryID
                     WHERE entryID = :entryID"
             );
            $st->execute(array(
                ':entryID' => $this->entryID,
                ':URL' => $this->URL,
                ':titel' => $this->titel,                
                ':inhalt' => $this->inhalt,
                ':dateEdited' => date("Y-m-d H:i:s",time()),
                ':editorID' => $this->editorID,
                ':anhangID' => $this->anhangID,
                ':categoryID' => $this->categoryID)
            );
            return 0;
        }
    } 
    
    public function delete()
    {
        if($this->entryID != 0)
        {
            $st = self::$db->prepare(
               "DELETE FROM entries
                   WHERE entryID = :entryID"
            );
            $st->execute(array(
               ':entryID' => $this->entryID)
            );
        }
        return 0;
    }  
}
