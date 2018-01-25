<?php

require_once(PATH_CLASSES . 'Database.php');
require_once(PATH_CLASSES . 'Auth.php');

$database = new OoDatabase();
$database->connect();

$auth = new OoAuth($database);

if (isset($_GET['do']) and $_GET['do'] == 'login') {
	$auth->login($_POST['login'], $_POST['password']);
} elseif (isset($_GET['do']) and $_GET['do'] == 'logout') {
	$auth->logout();
}

if ($auth->check()) {
	require_once(PATH_MODULES . 'admin/menu.php');

	$page = 'main';

	if (isset($_GET['page'])) {
		if (file_exists(PATH_MODULES . "admin/{$_GET['page']}.php")) {
			$page = $_GET['page'];
		} else {
			$page = 'error';
		}
	}

	require_once(PATH_MODULES . 'admin/' . $page . '.php');
	echo("</div></body></html>");

	exit;
} else {
	$message = '<div id="message" style="background-color:red">✖ ' . $auth->errorGet() . '</div>';
}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Авторизация</title>
</head>
<body>
	<div id='auth'>
		<div class='form-auth'>
			<h1>Авторизация на сайте</h1>
			<fieldset>
				<form method='POST' action='admin?do=login'>
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