<?php

/*
 * class.Model
 * created: 02/11/2013
 * last edit: 02/11/2013
 * author: DD
 */

namespace ITC\CMS;

use PDO;

class Model
{
    protected static $db;

    public function __construct()
    {
        if(!isset(self::$db))
        {
            self::$db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
        }
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
           "SELECT * FROM categories;"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
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

    public static function getData()
    {



        $st = self::$db->prepare(
               "SELECT * FROM uploadedData"
            );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEntries()
    {
        $st = self::$db->prepare("SELECT * FROM entries");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUsers()
    {
        $st = self::$db->prepare("SELECT * FROM user");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}