<?php

require_once('core/init/init.php');
require_once('core/mvc/model/entities/User.php');

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

$authFailed = FALSE;
if(!isset($_SESSION['user']) && !$controller->getIsPublic()) {
    if(isset($_COOKIE['userid']) && isset($_COOKIE['logintoken'])){
        $user = new ITC\CMS\User();
        if($user->load($_COOKIE['userid']) == 0){
            if($user->getSessionToken() == $_COOKIE['logintoken']) {
                $_SESSION['user'] = $_COOKIE['userid'];
            } else {
                $authFailed = TRUE;
            }
        } else {
            $authFailed = TRUE;
        }
    } else {
        $authFailed = TRUE;
    }
}
if($authFailed){
    header('Location: '.BACKENDURL.'index.php?page=login');
    die();
}
$controller->start();
 
?>