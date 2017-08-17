<?php

if (!isset($_POST["login"], $_POST["email"], $_POST["password"])) {
	exit("Insufficient data");
}

require_once('../admin/includes/OoImage.php');
require_once('../admin/includes/OoDatabase.php');
require_once('../admin/includes/OoUser.php');


$database = new OoDatabase();

$result = $database->connect();
if (!$result) {
	echo('false connect error');
	exit;
}

$login = urldecode($_POST["login"]);
$email = urldecode($_POST["email"]);
$password = urldecode($_POST["password"]);

$user = new OoUser();

$result = $user->userCreate($login, $password, $email);
if (!$result) {
	echo('false connect error');
	exit;
}

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