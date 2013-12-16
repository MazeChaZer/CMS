<?php

/**
 * Description of Entity
 *
 * @author Lukas
 */

namespace ITC\CMS;

use PDO;

class Entity {
    
    public static $db;
   
    public static function init($db)
    {
        self::$db = $db;
    }
    
    public static function getRightName($ID)
    {
        $st = self::$db->prepare(
           "SELECT bezeichnung FROM rights
               WHERE rechtID = :rechtID"
        );
        $st->execute(array(
            ':rechtID' => $ID)
        );
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result['bezeichnung'];
    }
    
    public static function getCategoryName($ID)
    {
        $st = self::$db->prepare(
           "SELECT bezeichnung FROM categories
               WHERE categoryID = :categoryID"
        );
        $st->execute(array(
            ':categoryID' => $ID)
        );
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result['bezeichnung'];
    }
    
    public static function getGroupName($ID)
    {
        $st = self::$db->prepare(
           "SELECT bezeichnung FROM categoryGroups
               WHERE groupID = :groupID"
        );
        $st->execute(array(
            ':groupID' => $ID)
        );
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result['bezeichnung'];
    }
    
    public static function getRights()
    {
        $st = self::$db->prepare(
           "SELECT rechtID FROM rights;"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    
    public static function getCategories()
    {
        $st = self::$db->prepare(
           "SELECT categoryID FROM categories;"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    
    public static function getGroups()
    {
        $st = self::$db->prepare(
           "SELECT groupID FROM categoryGroups;"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    
    public static function getEntriesByCategory($CategoryID)
    {
        if($CategoryID != NULL)
        {
            $st = self::$db->prepare(
               "SELECT * FROM entries "
                    . "WHERE categoryID = :CategoryID;"
            );
            $st->execute(array(
                ':CategoryID' => $CategoryID)
            );
        }
        else 
        {
           $st = self::$db->prepare(
               "SELECT * FROM entries "
                    . "WHERE categoryID IS NULL;"
            ); 
           $st->execute();
        }
        return $st->fetchAll(PDO::FETCH_CLASS, "ITC\CMS\Entry");       
    }
    
}
