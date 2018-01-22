<?php

$prefix = $database->stringSafe(DATABASE_PREFIX);

$raw = $database->execute("SELECT `login`,`ip` FROM `{$prefix}users`");

$format = <<<'EOD'
<tr>
	<td>%s</td>
	<td>%s</td>
	<td class="table-action">
		<a href="index.php?page=users-edit&user=%1$s">
			<i class="material-icons">mode_edit</i>
		</a>
		<a href="index.php?page=user_delete&user=%1$s">
			<i class="material-icons">delete</i>
		</a>
	</td>
</tr>
EOD;

$table = '';
while($result = $database->associativeArrayGet($raw)) {
	$table .= sprintf($format, $result['login'], long2ip($result['ip']));
}

?><h1>Пользователи</h1>
<table class="articles-list">
	<tr>
		<th>Логин</th>
		<th>IP</th>
		<th>Действия</th>
	</tr>
	<?php echo($table); ?>
</table>