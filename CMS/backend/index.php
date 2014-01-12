<?php

// namespace ITC\CMS;

require_once('core/init/init.php');

if(empty($_GET['page'])){
    $_GET['page'] = 'home';
}

$controllerPath = 'core/mvc/controller/'.$_GET['page'].'.php';
if(!file_exists($controllerPath) || strpos($_GET['page'],"../") !== False){ // In $_GET['page'] darf nicht "../" vorkommen, da sonst im Verzeichnisbaum nach oben navigiert werden köanfangennnte und man so PHP-Dateien außerhalb des controller-Ordners einbinden könnte (Sicherheitslücke)
    header('HTTP/1.0 404 Not Found');
    die("Diese Seite existiert nicht.");
}

require_once($controllerPath);
    
$classname = "ITC\\CMS\\c_".$_GET['page'];
$controller = new $classname();


if(!isset($_SESSION['user']) && !$controller->getIsPublic()) {
  header('Location: '.BACKENDURL.'index.php?page=login');
  die;
}
$controller->start();
 
?>