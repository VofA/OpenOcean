<?php

$list = array(
	'0-99' => 100, 
	'100-199' => 200, 
	'200-299' => 300, 
	'300-399' => 400, 	
	);

if(isset($_GET['id']) or isset($_POST['id'])) {
	if (isset($_GET['id']))
		$ID = @$_GET['id'];
	else
		$ID = @$_POST['id'];
	$message = 'Редактирование';
	$button = 'Изменить';
	$ARTICLE = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_image` WHERE `ID` = '{$ID}'"));
	$param = "index.php?page=image_edit&id=$ID&submit=yes&type=edit";
} else {
	$message = 'Создание';
	$button = 'Создать';
	$param = "index.php?page=image_edit&submit=yes&type=create";
}

if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'edit') {

	foreach ($list as $key => $value) {
		if ($ID <= $value) {
			$folder = $key;
			break;
		}
	}

	$filename = explode("/", $ARTICLE["SRC"]);
	$count = count($filename) - 1;
	$filename = $filename[$count];

	$expansion = explode('.', $_FILES['PICTURE']['name']);
	$count = count($expansion) - 1;
	$expansion = $expansion[$count];
	$filenameID = $ID . '.' . $expansion;

	if ($_FILES['PICTURE']['size'] != 0) {
		if (move_uploaded_file($_FILES['PICTURE']['tmp_name'], "../html/img/" . $folder . "/" . /*$_FILES['PICTURE']['name']*/$filenameID)) {
			unlink("../html/img/" . $folder . "/" . $filename);
			$MySQLi->execute("UPDATE `izh_image` SET `SRC` = '" . "http://iz-article.ru/html/img/" . $folder . "/" . /*$_FILES['PICTURE']['name']*/$filenameID . "',`TITLE`='{$_POST['TITLE']}',`ALT`='{$_POST['ALT']}' WHERE `ID` = '{$ID}'");
		}
		else {
			exit(header('Location: http://iz-article.ru/admin/index.php?page=image_list&typemsg=danger&msg=Ошибка!'));
		}
	}

	$MySQLi->execute("UPDATE `izh_image` SET `TITLE`='{$_POST['TITLE']}',`ALT`='{$_POST['ALT']}' WHERE `ID` = '{$ID}'");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=image_list&typemsg=success&msg=Свойства картинки успешно изменены!'));



}
if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'create') {



	$lastID = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `ID` FROM `izh_image` ORDER BY `ID` DESC LIMIT 1"));
	$ID = $lastID['ID'] + 1;
	foreach ($list as $key => $value) {
		if ($ID <= $value) {
			$folder = $key;
			break;
		}
	}

	$expansion = explode('.', $_FILES['PICTURE']['name']);
	$count = count($expansion) - 1;
	$expansion = $expansion[$count];
	$filenameID = $ID . '.' . $expansion;

	if (!move_uploaded_file($_FILES['PICTURE']['tmp_name'], "../html/img/" . $folder . "/" . /*$_FILES['PICTURE']['name']*/ $filenameID )) {
		exit(header('Location: http://iz-article.ru/admin/index.php?page=image_list&typemsg=danger&msg=Ошибка!'));
	}



	$MySQLi->execute("INSERT INTO `izh_image`(`SRC`, `TITLE`, `ALT`) VALUES ('" . "http://iz-article.ru/html/img/" . $folder . "/" . /*$_FILES['PICTURE']['name']*/$filenameID . "','{$_POST['TITLE']}','{$_POST['ALT']}')");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=image_list&typemsg=success&msg=Картинка успешно создана!'));
}

include("html/index.php");
?>

<h1><?php echo($message); ?> картинки</h1>
<form method='POST' action='<?php echo($param); ?>' enctype="multipart/form-data">
	<p>
		<label for="SRC">Файл</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<!-- Название элемента input определяет имя в массиве $_FILES -->
		<input name="PICTURE" type="file"/>
	</p>
	<p>
		<label for="TITLE">Название картинки</label>
		<input class="form-control" type="text" name="TITLE" id="TITLE" value="<?=$ARTICLE['TITLE']?>" required>
	</p>
	<p>
		<label for="ALT">Описание картинки</label>
		<input class="form-control" type="text" name="ALT" id="ALT" value="<?=$ARTICLE['ALT']?>" required>
	</p>
	<input type='submit' value='<?php echo($button); ?>'>
</p>
</form>

</div></body></html>