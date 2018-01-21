<?php

require ('../config.php');
require ('../includes/MySQLi.class.php');
require ('../includes/Log.class.php');

function formatDate($Date) {
	$Date = explode("_", $Date);
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
		return "сегодня в " . date( 'H:i', $time );	
	elseif ( $labelTime == ( date( 'd' ) - 1 ) . '.' . date( 'm.Y' ) )
		return "вчера в " . date( 'H:i', $time );
	elseif ( date( 'Y', $time ) == date( 'Y' ) )
		return date( 'd', $time ) . ' ' . $arrM[date( 'm', $time )] . ' в ' . date( 'H:i', $time );
	else
		return date( 'd', $time ) . ' ' . $arrM[date( 'm', $time )] . ' ' . date( 'Y', $time ) . ' в ' . date( 'H:i', $time );
}
function goError($Error) {
	exit(header("Location: http://iz-article.ru/error.php?err=$Error"));
}

// Переадрессация с www на без www (Костыль т.к. без него не работает адаптивная подгрузка остальной страницы)
if (preg_match("~www.~i", $_SERVER['SERVER_NAME'])) {
	exit(header('Location: http://iz-article.ru' . $_SERVER['REQUEST_URI']));
}

// Проверка на SQL иньекцию через GET запрос
if(isset($_GET['id'])) {
	$ARTICLE['ID'] = (integer) preg_replace('/[^0-9]/', '', $_GET['id']);
	if(!is_int($ARTICLE['ID'])) goError('404');
	$url = explode('/', $_SERVER['REQUEST_URI']);
	if (isset($url[3]) and !$url[3] == '') exit(header('Location: http://iz-article.ru/article/' . $ARTICLE['ID'] . '/'));
	unset($url,$_GET);
} else goError('404');

$MySQLi = new CDB;
$MySQLi->connect();

$ARTICLE = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_article` WHERE `ID` = '{$ARTICLE['ID']}'"));

// Проверка на существование статьи и на её статус
if($ARTICLE == NULL) goError('404');
if($ARTICLE['ENABLED'] == 'false') goError('403');

$MAIN_IMG = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `SRC` FROM `izh_image` WHERE `ID` = '{$ARTICLE['MAIN_IMG']}'"));

if (!isset($_COOKIE['VIEW']))  {
	$ARTICLE['VIEWS']++;
	setcookie('VIEW',true, time()+31536000);
	$MySQLi->execute("UPDATE `izh_article` SET `VIEWS`= '{$ARTICLE['VIEWS']}' WHERE `ID` = '{$ARTICLE['ID']}'");
}

$imgArray = explode("~img:", $ARTICLE['ARTICLE']);
foreach ($imgArray as $value) {
	$temp = explode("~", $value);
	$IMG = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_image` WHERE `ID` = '{$temp[0]}'"));
	$ARTICLE['ARTICLE'] = str_replace('~img:' . $temp[0] . '~', '<center><a class="zoom" href="' . $IMG["SRC"] . '" title="' . $IMG["TITLE"] . '"><img alt="' . $IMG["ALT"] . '" src="' . $IMG["SRC"] . '" /></a></center>' , $ARTICLE['ARTICLE']);
}

$MySQLi->close();

$ARTICLE['ARTICLE'] = str_replace('~ad~', "<br /><center><div class='ad'>" . file_get_contents("../html/ads/text.html") . "</div></center><br />", $ARTICLE['ARTICLE']);

$ARTICLE['DESCRIPTION'] = implode(" ", array_slice(explode(" ", $ARTICLE['ARTICLE']), 0, 15)) . '...';
$ARTICLE['DATE'] = formatDate($ARTICLE['DATE']);
include("../html/modules/article.php");

?>