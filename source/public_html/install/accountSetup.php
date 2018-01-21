<?php

if (!isset($_POST["login"], $_POST["email"], $_POST["password"])) {
	exit("Insufficient data");
}

require_once("../../core/config.php");

require_once(PATH_LIBRARIES . 'OpenOcean/Image.php');
require_once(PATH_LIBRARIES . 'OpenOcean/Database.php');
require_once(PATH_LIBRARIES . 'OpenOcean/Auth.php');

$database = new OoDatabase();

$result = $database->connect();
if (!$result) {
	echo('false connect error');
	exit;
}

$login = urldecode($_POST["login"]);
$email = urldecode($_POST["email"]);
$password = urldecode($_POST["password"]);

$user = new OoAuth($database);

$result = $user->register($login, $password, $email);
if (!$result) {
	echo($user->errorGet());
	exit;
}

$image = new OoImage($_FILES['photo']);

if (!$image->errorCheck()) {
	echo($image->errorGet() == 'File not select' ? 'true' : 'false');
	exit;
}

if (!is_dir(PATH_PUBLIC_HTML . 'admin/assets/img/users/')) {
	mkdir(PATH_PUBLIC_HTML . 'admin/assets/img/users/');
}

$image->fileMove('admin/assets/img/users/' . $_POST['login'] . ".png");

echo("true");