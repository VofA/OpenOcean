<?php

require ('../config.php');
require ('MySQLi.class.php');
require ('Log.class.php');
require ('Common.class.php');

DeBug();

$ID = $_GET['id'];
$TYPE = $_GET['type'];

$MySQLi = new CDB;
$MySQLi->connect();

$ARTICLE = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_article` WHERE `ID` = '{$ID}'"));

if($ARTICLE['RELATED'] != 'DISABLE')
{
	$ARTICLE['MENU']['RELATED'] = '';
	$ARTICLE['MENU']['TOP'] = '';
	$ARTICLE['MENU']['BLOG'] = '';

	$MENU = explode('_', $ARTICLE['RELATED']);
	$MENU[1] = explode(':', $MENU[1]);

	$LastBlogPost = $MySQLi->execute('SELECT `VIEWS`,`TITLE`,`DATE`,`ID`,`MAIN_IMG` FROM `izh_blog` ORDER BY `ID` DESC LIMIT ' . $MENU[2]);
	while( $row = $MySQLi->fetch_assoc($LastBlogPost) ) {
		$arrayIMG = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `SRC` FROM `izh_image` WHERE `ID` = '" . $row['MAIN_IMG'] . "'"));
		$ARTICLE['MENU']['BLOG'] .= '<div class="item"><center style="position:relative"><img src="http://iz-article.ru/blog/'.$row['ID'].'/'.$row['MAIN_IMG'].'"><div class="alt"><a href="http://iz-article.ru/blog/'.$row['ID'].'/" class="btn">Подробнее</a></div></center><a href="http://iz-article.ru/blog/'.$row['ID'].'/">'.$row['TITLE'].'</a><div class="views"> Всего просмотров: <i class="fa fa-eye"> '.$row['VIEWS'].'</i></div></div>';
	}
	$TOP = $MySQLi->execute('SELECT `VIEWS`,`TITLE`,`DATE`,`ID`,`MAIN_IMG` FROM `izh_article` ORDER BY `VIEWS` DESC LIMIT ' . $MENU[0]);
	while( $row = $MySQLi->fetch_assoc($TOP) ) {
		if($row['MAIN_IMG'] == "DISABLED") {
			$SRC = '';
		}
		else
		{
			$arrayIMG = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `SRC` FROM `izh_image` WHERE `ID` = '" . $row['MAIN_IMG'] . "'"));
			$SRC = '<center style="position:relative"><img src="' . $arrayIMG["SRC"] . '"><div class="alt"><a href="http://iz-article.ru/article/'.$row['ID'].'/" class="btn">Подробнее</a></div></center>';
		}
		$ARTICLE['MENU']['TOP'] .= '<div class="item">' . $SRC . '<a href="http://iz-article.ru/article/'.$row['ID'].'/">'.$row['TITLE'].'</a><div class="views"> Всего просмотров: <i class="fa fa-eye"> '.$row['VIEWS'].'</i></div></div>';
	}
	foreach ($MENU[1] as $key => $value) {

		$array = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `VIEWS`,`TITLE`,`DATE`,`MAIN_IMG` FROM `izh_article` WHERE `ID` = '$value'"));

		if($array['MAIN_IMG'] == "DISABLED") {
			$SRC = '';
		}
		else
		{
			$arrayIMG = $MySQLi->fetch_assoc($MySQLi->execute("SELECT `SRC` FROM `izh_image` WHERE `ID` = '" . $array['MAIN_IMG'] . "'"));
			$SRC = '<center style="position:relative"><img src="' . $arrayIMG["SRC"] . '"><div class="alt"><a href="http://iz-article.ru/article/'.$array['ID'].'/" class="btn">Подробнее</a></div></center>';
		}

		$ARTICLE['MENU']['RELATED'] .= '<div class="item">' . $SRC . '<a href="http://iz-article.ru/article/'.$value.'/">'.$array['TITLE'].'</a><div class="views"> Всего просмотров: <i class="fa fa-eye"> '.$array['VIEWS'].'</i></div></div>';
	}
}

$MySQLi->close();

?>
<div class="tab_content">
	<div class="tab_item" id="related" style="display:block">
	<?=$ARTICLE['MENU']['RELATED']?>
		<!-- <div class="item"><center style="position:relative"><img src="http://www.iz-article.ru/article/1/main.jpg"><div class="alt"><br><a href="#" class="btn">Подробнее</a></div></center><a href="http://iz-article.ru/article/2/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, eaque.</a><div class="views"><i class="fa fa-eye" title="Всего просмотров"></i> 26 просмотров</div></div> -->
	</div>
	<div class="tab_item" id="top" style="display:none">
		<!-- <div class="item">
			<center style="position:relative">
				<img src="http://www.iz-article.ru/article/1/main.jpg">
				<div class="alt"><br><a href="#" class="btn">Подробнее</a></div>
			</center>
			<a href="http://iz-article.ru/article/2/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, eaque.</a>
			<div class="views"><i class="fa fa-eye" title="Всего просмотров"></i> 26 просмотров</div>
		</div> -->
		<?=$ARTICLE['MENU']['TOP']?>
	</div>
	<div class="tab_item" id="blog" style="display:none">
		<!-- <div class="item">
			<center style="position:relative">
				<img src="http://www.iz-article.ru/article/1/main.jpg">
				<div class="alt"><br><a href="#" class="btn">Подробнее</a></div>
			</center>
			<a href="http://iz-article.ru/article/2/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, eaque.</a>
			<div class="views"><i class="fa fa-eye" title="Всего просмотров"></i> 26 просмотров</div>
		</div> -->
		<?=$ARTICLE['MENU']['BLOG']?>
	</div>
</div>