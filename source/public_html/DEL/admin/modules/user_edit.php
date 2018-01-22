<?php

if(isset($_GET['user'])) {
	$prefix = $database->stringSafe(DATABASE_PREFIX);
	$user = $_GET['user'];
	$message = 'Редактирование';
	$button = 'Изменить';
	$ip = $database->associativeArrayGet($database->execute("SELECT * FROM `{$prefix}users` WHERE `login` = '{$user}'"));
	$ip = $ip['ip'];
	$param = "index.php?page=user_edit&user=$user&submit=yes&type=edit";
	$message2 = '';
} else {
	$message = 'Создание';
	$user = '';
	$button = 'Создать';
	$ip = $_SERVER['REMOTE_ADDR'];
	$param = "index.php?page=user_edit&submit=yes&type=create";
	$message2 = '';
}

if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'edit') {
	$message2 = $auth->changePassword($_POST['login'], $_POST['password']);
	//exit(header('Location: index.php?page=users'));
}
if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'create') {
	$message2 = $auth->register($_POST['login'], $_POST['password'], "");
	//exit(header('Location: index.php?page=users'));
}
include("html/index.php");
?>
<h1><?php echo($message); ?> пользователя <?php echo($user); ?></h1>
<form method='POST' action='<?php echo($param); ?>'>
	<p>
		<label for="login">Логин:</label>
		<input class="form-control" type="text" name="login" id="login" value="<?php echo($user); ?>">
	</p>
	<p>
		<label for="ip">IP:</label>
		<input class="form-control" type="text" name="ip" id="ip" value="<?php echo($ip); ?>">
	</p>
	<p>
		<label for="password">Пароль:</label>
		<input class="form-control" type="text" name="password" id="password" placeholder="СКРЫТ">
	</p>
	<br>
	<p>
		<input type='submit' value='<?php echo($button); ?>'>
	</p>
</form>
<?php echo($message2); ?>
</div></body></html>