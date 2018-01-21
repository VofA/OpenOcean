<?php
if (isset($_GET['id'])) {
	$raw = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `ENABLED` FROM `izh_article` WHERE `ID` = '{$_GET['id']}'"));
	if($raw['ENABLED'] == 'true')
		$MySQLi->execute("UPDATE `izh_article` SET `ENABLED`= 'false' WHERE `ID` = '{$_GET['id']}'");
	else
		$MySQLi->execute("UPDATE `izh_article` SET `ENABLED`= 'true' WHERE `ID` = '{$_GET['id']}'");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=article_list&typemsg=success&msg=Статус статьи успешно изменён!'));
}
exit(header('Location: http://iz-article.ru/admin/index.php?page=article_list&typemsg=danger&msg=Ошибка! (Не правильно введён ID статьи)'));
?>