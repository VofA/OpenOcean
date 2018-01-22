<?php

$message = '';
if (isset($_GET['submit']) AND $_GET['submit'] == 'yes') {
	$message = $auth->register($_POST['login'], $_POST['password'], $_POST['email']);
}

?>
<h1>Создание пользователя</h1>
<form method='POST' action='index.php?page=users-new&submit=yes'>
	<p>
		<label for="login">Логин:</label>
		<input class="form-control" type="text" name="login" id="login">
	</p>
	<p>
		<label for="email">Почта:</label>
		<input class="form-control" type="text" name="email" id="email">
	</p>
	<p>
		<label for="password">Пароль:</label>
		<input class="form-control" type="text" name="password" id="password">
	</p>
	<br>
	<p>
		<input type='submit' value='Создать'>
	</p>
</form>
<?php echo($message); ?>