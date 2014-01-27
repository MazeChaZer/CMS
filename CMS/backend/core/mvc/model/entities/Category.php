<?php

namespace ITC\CMS;

use ITC\CMS\Entity;
use PDO;

/**
 * Description of Data
 *
 * @author Lukas
 */
class Category extends Model {

    private $categoryID = 0;
	private $bezeichnung;
	private $creatorID;
	private $dateCreated;

	public function getCategoryID(){
		return $this->categoryID;
	}

	public function getBezeichnung(){
		return $this->bezeichnung;
	}

	public function getCreatorID(){
		return $this->creatorID;
	}

	public function getDateCreated(){
		return $this->dateCreated;
	}

	public function setBezeichnung($bezeichnung){
		$this->bezeichnung = $bezeichnung;
	}

	public function setCreatorID($creatorID){
		$this->creatorID = $creatorID;
	}

    private function getNewID() {
        $SQL = "SELECT MAX(categoryID) AS maxID FROM categories;";
        $stmt = self::$db->query($SQL);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['maxID'] + 1;
    }

    public function load($categoryID) {
        $st = self::$db->prepare(
                "SELECT * FROM categories
                 WHERE categoryID = :categoryID"
        );
        $st->execute(array(
            ':categoryID' => $categoryID)
        );
        $result = $st->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $this->categoryID = $result['categoryID'];
            $this->bezeichnung = $result['bezeichnung'];
            $this->creatorID = $result['creatorID'];
            $this->dateCreated = $result['dateCreated'];
            return 0;   // Data successfully loaded!
        } else {
            return 1; // Data not found!
        }
    }

    public function save() {  //update or create the Dataentry
        if ($this->categoryID == 0) {
            $this->categoryID = $this->getNewID();
            $st = self::$db->prepare(
                    "INSERT INTO categories
                    ( categoryID, bezeichnung, creatorID, dateCreated )
                 VALUES
                    ( :categoryID, :bezeichnung, :creatorID, :dateCreated )"
            );
            $st->execute(array(
                ':categoryID' => $this->categoryID,
                ':bezeichnung' => $this->bezeichnung,
                ':creatorID' => $this->creatorID,
                ':dateCreated' => date("Y-m-d H:i:s",time()))
            );
            return 0;
        } else {
            $st = self::$db->prepare(
                    "UPDATE categories
                    SET
                        bezeichnung = :bezeichnung
                     WHERE categoryID = :categoryID"
            );
            $st->execute(array(
                ':categoryID' => $this->categoryID,
                ':bezeichnung' => $this->bezeichnung)
            );
            return 0;
        }
    }

    public function delete() {
        if ($this->categoryID != 0) {
            $st = self::$db->prepare(
                    "DELETE FROM categories
                   WHERE categoryID = :categoryID"
            );
            $st->execute(array(
                ':categoryID' => $this->categoryID)
            );
        }
        return 0;
    }

}
