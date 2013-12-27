<?php

session_start();
date_default_timezone_set("Europe/Berlin");
if(!@include_once('core/init/settings.php')){
    die('Bitte lege eine settings.php im Ordner /backend/core/init/ an.');
}
require_once('core/mvc/controller.php');
require_once('core/mvc/view.php');

?>
