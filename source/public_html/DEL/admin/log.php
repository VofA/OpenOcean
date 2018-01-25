<?php
if (isset($_GET['do']) and $_GET['do'] == 'clear') {
	fopen('log.txt', "w");
	exit(header('Location: http://iz-article.ru/admin/index.php?page=log'));
}

$log = file('log.txt');
if($log != NULL) {
	$table = '<table class="articles-list"><tr><th>Строка</th><th>Лог</th></tr>';
	foreach ($log as $key => $value) {
		$table .= "		<tr>
				<td>{$key}</td>
				<td>{$value}</td>
			</tr>";
	}
	$table .= "</table><form method='POST' action='index.php?page=log&do=clear'><input type='submit' value='Очистить лог'></form>";
} else $table = '<p>Лог чист</p>';
include("html/index.php");
?>
<h1>Лог</h1>
<?php echo($table); ?>
</div></body></html>