<?php

require_once("../admin/config.php");
require_once('../admin/includes/OoImage.php');
require_once('../admin/includes/OoDatabase.php');


$sql = new OoDatabase();
$result = $sql->connect();

if (!$result) {
	echo("Database connect error");
	exit;
}

$login = urldecode($_POST["login"]);
$login = $sql->safe($login);

$email = urldecode($_POST["email"]);
$email = $sql->safe($email);

$password = urldecode($_POST["password"]);
$password = hash('sha256', $password);


$sql->execute("INSERT INTO `oo_users` (`id`, `login`, `password`, `email`) VALUES (NULL, '{$login}', '{$email}', '{$password}')");

$image = new OoImage($_FILES['photo']);

if (!$image->imageCheck()) {
	echo($image->errorGet());
	exit;
}

$image->fileMove('admin/assets/img/users/' . $_POST['login'] . ".png");

?>