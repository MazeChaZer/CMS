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
        self::$db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
    }
}