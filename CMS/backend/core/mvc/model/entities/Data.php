<?php

namespace ITC\CMS;

use ITC\CMS\Entity;
use PDO;

/**
 * Description of Data
 *
 * @author Lukas
 */
class Data extends Model {

    private $dataID = 0;
    private $name;
    private $hash;
    private $uploaderID;

    public function getDataID() {
        return $this->dataID;
    }

    public function getName() {
        return $this->name;
    }

    public function getHash() {
        return $this->$hash;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUploaderID() {
        return $this->uploaderID;
    }

    public function setUploaderID($uploaderID) {
        $this->uploaderID = $uploaderID;
    }

    private function getNewID() {
        $SQL = "SELECT MAX(dataID) AS maxID FROM uploadedData;";
        $stmt = self::$db->query($SQL);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['maxID'] + 1;
    }

    public function load($dataID) {
        $st = self::$db->prepare(
                "SELECT * FROM uploadedData
               WHERE dataID = :dataID"
        );
        $st->execute(array(
            ':dataID' => $dataID)
        );
        $result = $st->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $this->dataID = $result['dataID'];
            $this->name = $result['name'];
            $this->hash = $result['hash'];
            $this->uploaderID = $result['uploaderID'];
            return 0;   // Data successfully loaded!
        } else {
            return 1; // Data not found!
        }
    }

    public function save() {  //update or create the Dataentry
        if ($this->dataID == 0) {
            $this->dataID = $this->getNewID();
            $this->hash = uniqid('', true);
            $st = self::$db->prepare(
                    "INSERT INTO uploadedData
                    ( dataID, name, ablageort, uploaderID )
                 VALUES 
                    ( :dataID, :name, :ablageort, :uploaderID )"
            );
            $st->execute(array(
                ':dataID' => $this->dataID,
                ':name' => $this->name,
                ':hash' => $this->hash,
                ':uploaderID' => $this->uploaderID)
            );
            return 0;
        } else {
            $st = self::$db->prepare(
                    "UPDATE uploadedData
                    SET  
                        name = :name,
                        hash = :hash,
                        uploaderID = :uploaderID,
                     WHERE dataID = :dataID"
            );
            $st->execute(array(
                ':dataID' => $this->dataID,
                ':name' => $this->name,
                ':hash' => $this->hash,
                ':uploaderID' => $this->uploaderID)
            );
            return 0;
        }
    }

    public function delete() {
        if ($this->dataID != 0) {
            $st = self::$db->prepare(
                    "DELETE FROM uploadedData
                   WHERE dataID = :dataID"
            );
            $st->execute(array(
                ':dataID' => $this->dataID)
            );

            //unlink("files/".$this->dataID)
        }
        return 0;
    }

}
