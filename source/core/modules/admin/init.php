<?php

require_once(PATH_CLASSES . 'Database.php');
require_once(PATH_CLASSES . 'Auth.php');

$database = new OoDatabase();
$database->connect();

$auth = new OoAuth($database);

if (isset($_GET['do']) and $_GET['do'] == 'login') {
	$auth->login($_POST['login'], $_POST['password']);
	header("Location: admin");
	exit;
} elseif (isset($_GET['do']) and $_GET['do'] == 'logout') {
	$auth->logout();
	header("Location: admin");
	exit;
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
	$message = '<span style="background-color:red">' . $auth->errorGet() . '</span>';
}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Авторизация</title>
</head>
<body>
	<h1>Авторизация на сайте</h1>
	<form method='POST' action='admin?do=login'>
		<input type='text' required placeholder='Логин' name="login">
		<input type='password' required placeholder='Пароль' name="password">
		<input type='submit' value='Войти'>
		<?php echo($message); ?>
	</form>
</body>
</html>