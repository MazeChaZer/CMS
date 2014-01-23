<?php

require_once('backend/core/init/settings.php');

$db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
$st = $db->prepare("SELECT * FROM entries WHERE URL=:URL;");
$st->execute(array(":URL" => $_GET['request']));
$result = $st->fetch(PDO::FETCH_ASSOC);
if(!empty($result)){
    $data['title'] = $result['titel'];
    require_once 'frontend/templates/head.php';
    echo $result['inhalt'];
    require_once 'frontend/templates/footer.php';
} else {
    header("HTTP/1.0 404 Not Found");
    require_once('frontend/templates/404.php');
    die();
}

?>