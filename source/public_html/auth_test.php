<?php

require_once('../core/config.php');

require_once(PATH_CLASSES . 'Database.php');
require_once(PATH_CLASSES . 'Auth.php');

$database = new OoDatabase();
$database->connect();

$auth = new OoAuth($database);

$result = '';

if (isset($_GET['type']) and $_GET['type'] == 'login') {
	$result = $auth->login($_GET['login'], $_GET['password']);
} else if (isset($_GET['type']) and $_GET['type'] == 'logout') {
	$result = $auth->logout();
} else if (isset($_GET['type']) and $_GET['type'] == 'check') {
	$result = $auth->check();
} else if (isset($_GET['type']) and $_GET['type'] == 'change') {
	$auth->check();
	$result = $auth->changePassword($auth->loginGet(), $_GET['password']);
}

if (!$result) {
	$result = $auth->errorGet();
}

$ipLong = ip2long($_SERVER['REMOTE_ADDR']);
$ip = $_SERVER['REMOTE_ADDR'];

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<div>
		<h1>login</h1>
		<form action="auth_test.php" method="get">
			<input type="text" name="login" placeholder="login">
			<input type="text" name="password" placeholder="password">
			<input type="hidden" name="type" value="login">
			<input type="submit">
		</form>
	</div>
	<div>
		<h1>logout</h1>
		<form action="auth_test.php" method="get">
			<input type="hidden" name="type" value="logout">
			<input type="submit">
		</form>
	</div>
	<div>
		<h1>check</h1>
		<form action="auth_test.php" method="get">
			<input type="hidden" name="type" value="check">
			<input type="submit">
		</form>
	</div>
	<div>
		<h1>change password</h1>
		<form action="auth_test.php" method="get">
			<input type="text" name="password" placeholder="password">
			<input type="hidden" name="type" value="change">
			<input type="submit">
		</form>
	</div>
	<div><?php var_dump($result); ?></div>
</body>
</html>