<?php

require_once('core/init/init.php');

if(!isset($_GET['page']) || $_GET['page'] == ''){
    $_GET['page'] = 'home';
}

require_once('core/mvc/controller/'.$_GET['page'].'.php');
$classname = "c_".$_GET['page'];
$controller = new $classname();


if(!isset($_SESSION['user']) && !$controller->getIsPublic()) {
  header('Location: '.BACKENDURL.'index.php?page=login');
  die;
}
$controller->start();
 
?>