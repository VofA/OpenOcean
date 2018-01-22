<?php

$user = $auth->loginGet();
if (isset($_GET['user'])) {
	$user = $_GET['user'];
}

$prefix = $database->stringSafe(DATABASE_PREFIX);
$data = $database->associativeArrayGet($database->execute("SELECT `id`, `login`, `email`, `ip` FROM `{$prefix}users` WHERE `login` = '{$user}'"));

$message = '';
if (isset($_GET['submit']) AND $_GET['submit'] == 'yes') {
	$message = $auth->changePassword($_POST['login'], $_POST['password']);
}

?>
<h1>Редактирование пользователя <?php echo($user); ?></h1>
<form method='POST' action='index.php?page=users-edit&user=<?php echo($user); ?>&submit=yes'>
	<p>
		<label for="login">Логин:</label>
		<input class="form-control" type="text" name="login" id="login" value="<?php echo($user); ?>">
	</p>
	<p>
		<label for="ip">IP:</label>
		<input class="form-control" type="text" name="ip" id="ip" value="<?php echo(long2ip($data['ip'])); ?>">
	</p>
	<p>
		<label for="password">Пароль:</label>
		<input class="form-control" type="text" name="password" id="password" placeholder="СКРЫТ">
	</p>
	<br>
	<p>
		<input type='submit' value='Сохранить'>
	</p>
</form>
<?php echo($message); ?>