<?php

require_once("../../core/config.php");

require_once(PATH_LIBRARIES . 'OpenOcean/Database.php');
require_once(PATH_LIBRARIES . 'OpenOcean/Auth.php');

$database = new OoDatabase();
$database->connect();

$auth = new OoAuth($database);

$result = $auth->check();
if ($result) {
	if (isset($_GET['page']) and file_exists("html/modules/{$_GET['page']}.php")) {
		include("html/modules/{$_GET['page']}.php");
	} else {
		include("html/modules/main.php");
	}
	exit;
}

$result = '';

if (isset($_GET['do']) and $_GET['do'] == 'login') {
	$result = $auth->login($_POST['login'], $_POST['password']);
}

if (!$result) {
	$message = '<div id="message" style="background-color:red">✖ ' . $auth->errorGet() . '</div>';
} else {
	if (isset($_GET['page']) and file_exists("html/modules/{$_GET['page']}.php")) {
		include("html/modules/{$_GET['page']}.php");
	} else {
		include("html/modules/main.php");
	}
	exit;
}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Авторизация</title>
	<link rel='stylesheet' type='text/css' href='html/css/auth.css'>
</head>
<body>
	<div id='auth'>
		<div class='form-auth'>
			<h1>Авторизация на сайте</h1>
			<fieldset>
				<form method='POST' action='index.php?do=login'>
					<input type='text' required placeholder='Логин' name="login">
					<input style='border-top: 0px;' type='password' required placeholder='Пароль' name="password">
					<input type='submit' value='ВОЙТИ'>
					<?php echo($message); ?>
					<a href='#' style='float:left;'>Забыли пароль?</a><a href='#' style='float:right;'>Регистрация</a>
				</form>
			</fieldset>
		</div>
	</div>
</body>
</html>