<?php

require_once(PATH_CLASSES . 'Image.php');
require_once(PATH_CLASSES . 'Database.php');
require_once(PATH_CLASSES . 'Auth.php');
require_once(PATH_CLASSES . 'Config.php');

$data['login']    = $_POST["login"]    ?? '';
$data['password'] = $_POST["password"] ?? '';
$data['email']    = $_POST["email"]    ?? '';

$database = new OoDatabase();

$result = $database->connect();

if (!$result) {
	$data = array(
		'status' => false,
		'error' => 'Database connection error'
	);
	exit(json_encode($data));
}

$user = new OoAuth($database);

$result = $user->register($data['login'], $data['password'], $data['email']);

if (!$result) {
	$data = array(
		'status' => false,
		'error' => $user->errorGet()
	);
	exit(json_encode($data));
}

$config = new OoConfig();
$config->load();
$config->change('OPEN_OCEAN_INSTALLED', true);
$config->save();

// $image = new OoImage($_FILES['photo']);

// if (!$image->errorCheck()) {
// 	$data = array(
// 		'status' => false,
// 		'error' => $image->errorGet() /*== 'File not select' ? 'true' : 'false'*/
// 	);
// 	exit(json_encode($data));
// }

// if (!is_dir(PATH_PUBLIC_HTML . 'theme/pictures/users/')) {
// 	mkdir(PATH_PUBLIC_HTML . 'theme/pictures/users/');
// }

// $image->fileMove(PATH_PUBLIC_HTML . 'theme/pictures/users/' . $data['login'] . ".png");

$data = array(
	'status' => true
);
exit(json_encode($data));