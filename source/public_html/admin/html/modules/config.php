<?php
if (isset($_POST['config'])) {
	file_put_contents('../config.php', $_POST['config']);
	exit(header('Location: http://iz-article.ru/admin/index.php?page=config&typemsg=success&msg=Настройки успешно сохранены!'));
}
include("html/index.php");
?>
<h1>Глобальные настройки</h1>
<form method="POST">
	<div class="code"><textarea rows='30' name="config"><?=file_get_contents('../config.php')?></textarea></div>
	<input type="submit" value="Сохранить">
</form>
</div></body></html>