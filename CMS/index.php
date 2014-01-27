<?php
require_once('backend/core/init/settings.php');

$db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
$db->exec("set names utf8");
$st = $db->prepare("SELECT * FROM categories;");
$st->execute();
$data['categories'] = $st->fetchAll(PDO::FETCH_ASSOC);
$st = $db->prepare("SELECT * FROM entries;");
$st->execute();
$data['allarticles'] = $st->fetchAll(PDO::FETCH_ASSOC);
if(substr($_GET['request'], 0, 8) == "category") {
	$categoryID = substr($_GET['request'], 9);
	$st = $db->prepare("SELECT bezeichnung FROM categories WHERE categoryID = :categoryID;");
	$st->execute(array(":categoryID" => $categoryID));
	$result = $st->fetch(PDO::FETCH_ASSOC);
	$data['category'] = $result['bezeichnung'];
	$data['title'] = "Kategorie: ".$result['bezeichnung'];
	$st = $db->prepare(
		"SELECT * FROM entries "
			. "WHERE categoryID = :CategoryID;"
	);
	$st->execute(array(
		':CategoryID' => $categoryID)
	);
	$data['artikel'] = $st->fetchAll(PDO::FETCH_ASSOC);
	require_once 'frontend/templates/head.php';
	require_once 'frontend/templates/categories.php';
	require_once 'frontend/templates/footer.php';

} 
else if(substr($_GET['request'], 0, 10) == "categories") {
	$st = $db->prepare(
		"SELECT * FROM entries"
	);
	$st->execute();
	$data['artikel'] = $st->fetchAll(PDO::FETCH_ASSOC);
	require_once 'frontend/templates/head.php';
	require_once 'frontend/templates/allcategories.php';
	require_once 'frontend/templates/footer.php';

}
else {
	$st = $db->prepare("SELECT * FROM entries WHERE URL=:URL;");
	$st->execute(array(":URL" => $_GET['request']));
	$result = $st->fetch(PDO::FETCH_ASSOC);
	if(!empty($result)){
		$data['title'] = $result['titel'];
		$data['inhalt'] = $result['inhalt'];
		$st = $db->prepare("SELECT bezeichnung FROM categories WHERE categoryID = :categoryID;");
		$st->execute(array(":categoryID" => $result['categoryID']));
		$result2 = $st->fetch(PDO::FETCH_ASSOC);
		$data['category'] = array("categoryID" => $result['categoryID'], "bezeichnung" => $result2['bezeichnung']);
		if($result['anhangID'] != NULL){
			$st = $db->prepare("SELECT * FROM uploadedData WHERE dataID = :dataID;");
			$st->execute(array(":dataID" => $result['anhangID']));
			$data['anhang'] = $st->fetch(PDO::FETCH_ASSOC);
		}
		require_once 'frontend/templates/head.php';
		require_once 'frontend/templates/content.php';
		require_once 'frontend/templates/footer.php';
	} else {
		header("HTTP/1.0 404 Not Found");
		require_once('frontend/templates/404.php');
		die();
	}
}

?>