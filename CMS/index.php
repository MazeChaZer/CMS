Hier kommt mal das Frontend hin.
<pre><?php print_r($_GET); ?></pre>

<?php

require_once('backend/core/init/settings.php');

$db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
$st = $db->prepare("SELECT * FROM entries WHERE URL=:URL;");
$st->execute(array(":URL" => $_GET['request']));
$result = $st->fetch(PDO::FETCH_ASSOC);
if(!empty($result)){
    echo $result['inhalt'];
    echo '<title>' . $result['titel'] . '</title>';
} else {
    header("HTTP/1.0 404 Not Found");
    die("Diese Seite existiert nicht.");
}

?>