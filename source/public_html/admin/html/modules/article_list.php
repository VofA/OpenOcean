<?php
if (!isset($_GET['list'])) $_GET['list'] = 0;

	$raw = $MySQLi->execute("SELECT `ID`,`AUTHOR`,`DATE`,`VIEWS`,`TITLE`,`ENABLED`,`CATEGORY` FROM `izh_article` ORDER BY `ID` DESC LIMIT {$_GET['list']},50");

	$table = '';
	while($result = $MySQLi->fetch_assoc($raw)) {
		$Date = explode("_", $result['DATE']);
		$pubdate = $Date[0];
		$pubtime = $Date[1];
		$time = strtotime( "{$pubdate} {$pubtime}" );
		$labelTime = date( 'd.m.Y', $time );
		$arrM = array(
			'01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
			'05' => 'мая', '06' =>'июня', '07' => 'июля', '08' => 'августа',
			'09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
			);
		if ( $labelTime == date( 'd.m.Y' ) )
			$result['DATE'] = "сегодня в " . date( 'H:i', $time );	
		elseif ( $labelTime == ( date( 'd' ) - 1 ) . '.' . date( 'm.Y' ) )
			$result['DATE'] = "вчера в " . date( 'H:i', $time );
		elseif ( date( 'Y', $time ) == date( 'Y' ) )
			$result['DATE'] = date( 'd', $time ) . ' ' . $arrM[date( 'm', $time )] . ' в ' . date( 'H:i', $time );
		else
			$result['DATE'] = date( 'd', $time ) . ' ' . $arrM[date( 'm', $time )] . ' ' . date( 'Y', $time ) . ' в ' . date( 'H:i', $time );
		if ($result['ENABLED'] == 'true')
			$line = "<a href='index.php?page=article_lock_toggle&id={$result['ID']}''><i class='fa fa-unlock' style='color:green'></i></a>";
		else
			$line = "<a href='index.php?page=article_lock_toggle&id={$result['ID']}''><i class='fa fa-lock' style='color:red'></i></a>";
		$table .= "		<tr>
		<td>{$result['ID']}</td>
		<td><a href='http://iz-article.ru/article/{$result['ID']}/'>{$result['TITLE']}</a></td>
		<td>{$result['CATEGORY']}</td>
		<td>{$result['AUTHOR']}</td>
		<td>{$result['DATE']}</td>
		<td>{$result['VIEWS']}</td>
		<td class='table-action'>
			<a href='index.php?page=article_edit&id={$result['ID']}''><i class='fa fa-pencil'></i></a>
			$line
		</td>
		</tr>";
	}
include("html/index.php");
?>
<h1>Статьи</h1>
<form method='POST' action='http://iz-article.ru/admin/index.php?page=article_edit'>
	<p>
		<label for="id">ID:</label>
		<input class="form-control" type="text" name="id" id="id" value="" required>
		<input type='submit' value='Редактировать'>
	</p>
</form>
<div class="pagination">
  <ul>
  	<li><a href="index.php?page=article_list&list=1">1-50</a></li>
    <li><a href="index.php?page=article_list&list=51">51-100</a></li>
    <li><a href="index.php?page=article_list&list=101">101-150</a></li>
  </ul>
</div>
<table class="articles-list">
	<tr>
		<th>ID</th>
		<th>Заголовок</th>
		<th>Категория</th>
		<th>Автор</th>
		<th>Дата</th>
		<th>Просмотры</th>
		<th>Действия</th>
	</tr>
	<?php echo($table); ?>
</table>
</div></body></html>