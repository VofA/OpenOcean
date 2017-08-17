<?php

require_once("../admin/config.php");
require_once('../admin/includes/OoImage.php');
require_once('../admin/includes/OoDatabase.php');


$sql = new OoDatabase();
$result = $sql->connect();

if (!$result) {
	echo("false");
	exit;
}

$login = urldecode($_POST["login"]);
$email = urldecode($_POST["email"]);
$password = urldecode($_POST["password"]);

$sql->userCreate($login, $password, $email);

$image = new OoImage($_FILES['photo']);

if (!$image->errorCheck()) {
	echo($image->errorGet() == 'File not select' ? 'true' : 'false');
	exit;
}

if (!is_dir(OO_ROOT . 'admin/assets/img/users/')) {
	mkdir(OO_ROOT . 'admin/assets/img/users/');
}

$image->fileMove('admin/assets/img/users/' . $_POST['login'] . ".png");

echo("true");