<?php

if(isset($_GET['id']) or isset($_POST['id'])) {
	if (isset($_GET['id']))
		$ID = @$_GET['id'];
	else
		$ID = @$_POST['id'];
	$message = 'Редактирование';
	$button = 'Изменить';
	$ARTICLE = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_category` WHERE `ID` = '{$ID}'"));
	$param = "index.php?page=category_edit&id=$ID&submit=yes&type=edit";
} else {
	$message = 'Создание';
	$button = 'Создать';
	$param = "index.php?page=category_edit&submit=yes&type=create";
}

if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'edit') {
	$MySQLi->execute("UPDATE `izh_category` SET `NAME` = '{$_POST['NAME']}' WHERE `ID` = '{$ID}'");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=category_list&typemsg=success&msg=Категория успешно изменена!'));
}
if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'create') {
	$MySQLi->execute("INSERT INTO `izh_category`(`NAME`) VALUES ('{$_POST['NAME']}')");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=category_list&typemsg=success&msg=Категория успешно создана!'));
}

include("html/index.php");
?>

<h1><?php echo($message); ?> категории</h1>
<form method='POST' action='<?php echo($param); ?>' enctype="multipart/form-data">
	<p>
		<label for="NAME">Категория:</label>
		<input class="form-control" type="text" name="NAME" id="NAME" value="<?=$ARTICLE['NAME']?>" required>
	</p>
	<br>
	<p>
		<input type='submit' value='<?php echo($button); ?>'>
	</p>
</form>

</div></body></html>