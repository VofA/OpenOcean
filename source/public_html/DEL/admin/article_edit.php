<?php

if(isset($_GET['id']) or isset($_POST['id'])) {
	if (isset($_GET['id']))
		$ID = @$_GET['id'];
	else
		$ID = @$_POST['id'];
	$message = 'Редактирование';
	$button = 'Изменить';
	$ARTICLE = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_article` WHERE `ID` = '{$ID}'"));
	$param = "index.php?page=article_edit&id=$ID&submit=yes&type=edit";
} else {
	$message = 'Создание';
	$button = 'Создать';
	$url = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `url` FROM `izh_users` WHERE `login` = '{$user['login']}'"));
	$url = explode('~', $url['url']);
	$ARTICLE['URL'] = '<select name="url">';
	foreach ($url as $key => $value) {
		$ARTICLE['URL'] .= '<option name="'.$key.'">'.$value.'</option>';
	}
	$ARTICLE['AUTHOR'] = $user['login'];
	$ARTICLE['URL'] .= '</select>';
	$param = "index.php?page=article_edit&submit=yes&type=create";
}

$CATEGORY = $MySQLi->execute("SELECT * FROM `izh_category`");
$select = '';
while($result = $MySQLi->fetch_assoc($CATEGORY)) {
	if ($button == 'Изменить' and $ARTICLE['CATEGORY'] == $result['ID']) {
		$select .= "<option value='{$result['NAME']}' selected>{$result['NAME']}</option>";
	}
	else
	{
		$select .= "<option value='{$result['NAME']}'>{$result['NAME']}</option>";
	}
	
}

if (!isset($_POST['AUTHOR_URL'])) {
	$_POST['AUTHOR_URL'] = $_POST['url'];
}

if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'edit') {
	$MySQLi->execute("UPDATE `izh_article` SET `AUTHOR` = '{$_POST['AUTHOR']}',`AUTHOR_URL`='{$_POST['AUTHOR_URL']}',`CATEGORY`='{$_POST['CATEGORY']}',`DATE`='{$_POST['DATE']}',`TITLE`='{$_POST['TITLE']}',`RELATED` = '{$_POST['RELATED']}',`KEYWORDS`='{$_POST['KEYWORDS']}',`ARTICLE`='{$_POST['ARTICLE']}',`MAIN_IMG` = '{$_POST['MAIN_IMG']}' WHERE `ID` = '{$ID}'");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=article_list&typemsg=success&msg=Статья успешно изменена!'));
}
if (isset($_GET['submit']) AND $_GET['submit'] == 'yes' and $_GET['type'] == 'create') {
	$lastID = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `ID` FROM `izh_article` ORDER BY `ID` DESC LIMIT 1"));
	$ID = $lastID['ID'] + 1;
	$MySQLi->execute("INSERT INTO `izh_article`(`AUTHOR`, `AUTHOR_URL`, `DATE`, `TITLE`, `RELATED`, `KEYWORDS`, `ARTICLE`, `ENABLED`,`MAIN_IMG`,`CATEGORY`) VALUES ('{$_POST['AUTHOR']}','{$_POST['AUTHOR_URL']}','{$_POST['DATE']}','{$_POST['TITLE']}','{$_POST['RELATED']}','{$_POST['KEYWORDS']}','{$_POST['ARTICLE']}','true','{$_POST['MAIN_IMG']}','{$_POST['CATEGORY']}')");
	mkdir("../article/" . $ID);
	exit(header('Location: http://iz-article.ru/admin/index.php?page=article_list&typemsg=success&msg=Статья успешно создана!'));
}

$ARTICLE['DATE'] = date('d.m.Y_H:i');
include("html/index.php");
?>

<h1><?php echo($message); ?> статьи</h1>
<form method='POST' action='<?php echo($param); ?>' enctype="multipart/form-data">
	<p>
		<label for="AUTHOR">Автор:</label>
		<input class="form-control" type="text" name="AUTHOR" id="AUTHOR" value="<?=$ARTICLE['AUTHOR']?>" required>
	</p>
	<p>
		<label for="AUTHOR_URL">Ссылка на автора:</label>
		<?php
		if (!isset($ARTICLE['AUTHOR_URL'])) {
			echo($ARTICLE['URL']);
		} else {
			echo('<input class="form-control" type="text" name="AUTHOR_URL" id="AUTHOR_URL" value="'.$ARTICLE['AUTHOR_URL'].'" required>');
		}
		?>
	</p>
	<p>
		<label for="DATE">Дата:</label>
		<input class="form-control" type="text" name="DATE" id="DATE" value="<?=$ARTICLE['DATE']?>" required>
	</p>
	<p>
		<label for="TITLE">Заголовок:</label>
		<input class="form-control" type="text" name="TITLE" id="TITLE" value="<?=$ARTICLE['TITLE']?>" required>
	</p>
	<p>
		<label for="CATEGORY">Категория:</label>
		<select size="1" name="CATEGORY" required>
			<?=$select?>
		</select>
	</p>
	<p>
		<label for="RELATED">Похожие статьи (В формате Кол-воСтатейВТопе_ID:ID:ID:ID_Кол-воСтатейВБлоге Например: 1_32:2_4) Если надо выключить написать DISABLE:</label>
		<input class="form-control" type="text" name="RELATED" id="RELATED" value="<?=$ARTICLE['RELATED']?>" required>
	</p>
	<p>
		<label for="KEYWORDS">Ключевые слова:</label>
		<input class="form-control" type="text" name="KEYWORDS" id="KEYWORDS" value="<?=$ARTICLE['KEYWORDS']?>" required>
	</p>
	<p>
		<label for="MAIN_IMG">Главная картинка:</label>
		<input class="form-control" type="text" name="MAIN_IMG" id="MAIN_IMG" value="<?=$ARTICLE['MAIN_IMG']?>" required>
	</p>
	<br>
	<p>
		<label for="ARTICLE">Статья:</label>
		<p><textarea rows="20" name="ARTICLE"><?=$ARTICLE['ARTICLE']?></textarea></p>
	</p>
	<br>
	<p>
		<input type='submit' value='<?php echo($button); ?>'>
	</p>
</form>

</div></body></html>