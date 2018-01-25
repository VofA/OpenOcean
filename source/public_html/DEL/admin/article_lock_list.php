<?php
	$raw = $MySQLi->execute("SELECT `ID`,`AUTHOR`,`DATE`,`VIEWS`,`TITLE`,`ENABLED` FROM `izh_article` WHERE `ENABLED` = 'false'");

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
		$table .= "		<tr>
		<td>{$result['ID']}</td>
		<td>{$result['TITLE']}</td>
		<td>{$result['AUTHOR']}</td>
		<td>{$result['DATE']}</td>
		<td>{$result['VIEWS']}</td>
		<td class='table-action'>
			<a href='index.php?page=article_edit&id={$result['ID']}''><i class='fa fa-pencil'></i></a>
			<a href='index.php?page=article_lock_toggle&id={$result['ID']}''><i class='fa fa-lock' style='color:red'></i></a>
		</td>
		</tr>";
	}
include("html/index.php");
?>
<h1>Статьи</h1>
<table class="articles-list">
	<tr>
		<th>ID</th>
		<th>Заголовок</th>
		<th>Автор</th>
		<th>Дата</th>
		<th>Просмотры</th>
		<th>Действия</th>
	</tr>
	<?php echo($table); ?>
</table>
</div></body></html>