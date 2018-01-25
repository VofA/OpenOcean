<?php

if (!isset($_GET['list'])) $_GET['list'] = 0;

	$raw = $MySQLi->execute("SELECT * FROM `izh_image` ORDER BY `ID` LIMIT {$_GET['list']},100");

	$table = '';
	
	while($result = $MySQLi->fetch_assoc($raw)) {
		$MEDIA = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `MEDIA_ORDER` FROM `izh_users` WHERE `login` = '{$user['login']}'"));
		if ($MEDIA['MEDIA_ORDER']) {
			$table = $table . "<div class='preview'><img  src='{$result['SRC']}'><div class='alt'><center>ID: {$result['ID']}<br /><br /><a href='index.php?page=image_edit&id={$result['ID']}' class='btn'>Свойства</a></center></div></div>";
		}
		else
		{
			$table = "<div class='preview'><img  src='{$result['SRC']}'><div class='alt'><center>ID: {$result['ID']}<br /><br /><a href='index.php?page=image_edit&id={$result['ID']}' class='btn'>Свойства</a></center></div></div>" . $table;
		}
		
	}

include("html/index.php");
?>
<h1>Картинки</h1>
<form method='POST' action='index.php?page=image_edit'>
	<p>
		<label for="id">ID:</label>
		<input class="form-control" type="text" name="id" id="id" value="" required>
		<input type='submit' value='Редактировать'>
	</p>
</form>
<br />
<form method='POST' action='index.php?page=image_edit&do=new'>
	<p>
		<input type='submit' value='Добавить новую картинку'>
	</p>
</form>
<div class="pagination">
  <ul>
  	<li><a href="index.php?page=image_list&list=0">0-99</a></li>
    <li><a href="index.php?page=image_list&list=100">100-199</a></li>
    <li><a href="index.php?page=image_list&list=200">200-299</a></li>
    <li><a href="index.php?page=image_list&list=300">300-399</a></li>
    <li><a href="index.php?page=image_list&list=400">400-499</a></li>
    <li><a href="index.php?page=image_list&list=500">500-599</a></li>
    <li><a href="index.php?page=image_list&list=600">600-699</a></li>
    <li><a href="index.php?page=image_list&list=700">700-799</a></li>
  </ul>
</div>
<br />
<?php echo($table); ?>
</div></body></html>