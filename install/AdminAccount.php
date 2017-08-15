<?php

require_once("../admin/config.php");
require_once('../admin/includes/OoImage.php');
require_once('../admin/includes/OoDatabase.php');


$sql = new OoDatabase();
$result = $sql->connect();

if (!$result) {
	echo "error1";
	exit;
}

// $result = $sql->execute('');

// if (!$result) {
// 	echo "error1";
// 	exit;
// }
// print_r($_FILES);
// print_r($_POST);


$image = new OoImage($_FILES['avatar']);

if (!$image->imageCheck()) {
	var_dump($image->errorGet());
	exit;
}

$image->fileMove('admin/assets/img/users/' . $_POST['login'] . ".png");

?>