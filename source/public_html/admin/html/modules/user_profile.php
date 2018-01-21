<?php

$url = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_users` WHERE `login` = '{$user['login']}'"));

if (isset($_GET['do']) AND $_GET['do'] == 'submit') {
	$MySQLi->execute("UPDATE `izh_users` SET `url` = '{$_POST['url']}',`MEDIA_ORDER` = '{$_POST['MEDIA_ORDER']}' WHERE `login` = '{$user['login']}'");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=main'));
}

include("html/index.php");
?>
<h1>Редактирование профиля</h1>
<form method='POST' action='index.php?page=user_profile&do=submit'>
	<p>
		<label for="url">Ваши страницы:</label>
		<textarea name="url"><?=$url['url']?></textarea>
	</p>
	<p>
		<label for="MEDIA_ORDER">С чего начинать отсчёт в медиа-ресурсах? (0 - С последнего ID, 1 - С начала)</label>
		<textarea name="MEDIA_ORDER"><?=$url['MEDIA_ORDER']?></textarea>
	</p>
	<input type="submit" value="Сохранить">
</form>
</div></body></html>