<?php

$prefix = $database->stringSafe(DATABASE_PREFIX);
$name = $database->stringSafe(DATABASE_NAME);

$raw = $database->execute("SELECT `login`,`ip` FROM `{$prefix}users`");

$table = '';
while($result = $database->associativeArrayGet($raw))
	$table .= "		<tr>
			<td>{$result['login']}</td>
			<td>" . long2ip($result['ip']) . "</td>
			<td class='table-action'>
				<a href='index.php?page=user_edit&user={$result['login']}''><i class='fa fa-pencil'></i></a>
				<a href='index.php?page=user_delete&user={$result['login']}''><i class='fa fa-trash'></i></a>
			</td>
		</tr>";

include("html/index.php");

?><h1>Пользователи</h1>
<table class="articles-list">
	<tr>
		<th>Логин</th>
		<th>IP</th>
		<th>Действия</th>
	</tr>
<?php echo($table); ?>
</table>
</div></body></html>