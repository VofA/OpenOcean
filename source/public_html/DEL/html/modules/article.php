<?php

$AdBlockDIV = rand(10000,99999);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?=$ARTICLE['TITLE']?></title>
	<link rel='shortcut icon' href='http://iz-article.ru/html/img/favicon.ico'>
	<meta name="description" content="<?=$ARTICLE['DESCRIPTION']?>">
	<meta name="keywords" content="<?=$ARTICLE['KEYWORDS']?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="http://iz-article.ru/article/<?=$ARTICLE['ID']?>/">
	<meta property="og:title" content="<?=$ARTICLE['TITLE']?>">
	<meta property="og:image" content="<?=$MAIN_IMG['SRC']?>">
	<meta property="og:description" content="<?=$ARTICLE['DESCRIPTION']?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="iz-article.ru">

	<link rel="stylesheet" href="http://iz-article.ru/html/css/header.css">
	<link rel="stylesheet" href="http://iz-article.ru/html/css/font-awesome.min.css">
</head>
<body>
	<div id="preloader"><i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i></div>

	<div id="topBar">
		<a href="http://iz-article.ru/">IZ-article</a>
		<a href="#" id="current">Статьи</a>
		<a href="http://iz-article.ru/blog_000_19.php">Блог</a>
		<a href="http://iz-article.ru/y_per_21.php">Турецкий язык</a>
		<a href="http://iz-article.ru/tu__000_16.php">Статьи о Турции</a>
		<a href="http://www.holidayhomesclub.ru/">Аренда в Турции</a>
		<!-- <a href="http://iz-article.ru/">Старая версия сайта</a> -->
	</div>

	<div id="<?=$AdBlockDIV?>" class='warning'></div>

	<center>
		<div id="container">
			<div id="header"><h2>IZ-article</h2> - Информационный сайт по Ижевску, Удмуртской Республике.</div>
			<div id="sideBar">
				<form id="search" action="http://iz-article.ru/search/index.php" method="get">
					<input type="hidden" name="searchid" value="2203405"/>
					<input type="hidden" name="l10n" value="ru"/>
					<input type="hidden" name="reqenc" value="utf-8"/>
					<input type="text" id="search-input" name="text" placeholder="Поиск">
					<i class="fa fa-search fa-lg"><input type="submit" id="search-submit" value=""></i>
				</form>
				<br /><center><div class="ad"><?php include('../html/ads/sidebar.html'); ?></div></center><br />
				<div class="wrapper">
					<div class="tabs">
						<span class="tab active">Похожие</span>
						<span class="tab">Топ</span>
						<span class="tab">Блог</span>        
					</div>
					<div class="tab_content">
						<div class="tab_item" id="related" style="display:block"><center><br /><i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i></center></div>
						<div class="tab_item" id="top" style="display:none"><center><br /><i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i></center></div>
						<div class="tab_item" id="blog" style="display:none"><center><br /><i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i></center></div>
					</div>
				</div>
			</div>
			<div id="raw">
			<!-- Доделать -->
				<ul class="breadcrumb">
					<li><a href="#">Главная</a></li>
					<li class="active">Статьи</li>
				</ul>
			<!-- Доделать -->
				<div class="dropdown">
					<button onclick="Dropdown()" class="dropbtn" id="share"></button>
					<div id="Dropdown" class="dropdown-content">
						<a href="https://twitter.com/intent/tweet?text=<?=$ARTICLE['TITLE']?> http://iz-article.ru/article/<?=$ARTICLE['ID']?>/ +%23izarticle" title="Опубликовать ссылку в Twitter" onclick="window.open(this.href, 'Опубликовать ссылку в Twitter', 'width=700,height=450'); return false" target="_blank">
							<i class="fa fa-twitter-square fa-2x"></i> 
							<div class="text">Twitter</div>
						</a>
						<a href="https://vk.com/share.php?url=http://iz-article.ru/article/<?=$ARTICLE['ID']?>/" title="Опубликовать ссылку во ВКонтакте" onclick="window.open(this.href,'Опубликовать ссылку во Вконтакте','width=1,height=1'); return false" target="_blank">
							<i class="fa fa-vk fa-1x"></i>
							<div class="text" style="top:0">ВКонтакте</div>
						</a>
						<a href="https://www.facebook.com/sharer/sharer.php?u=http://iz-article.ru/article/<?=$ARTICLE['ID']?>/" title="Опубликовать ссылку в Facebook" onclick="window.open(this.href, 'Опубликовать ссылку в Facebook', 'width=1,height=1,toolbar=0,status=0'); return false" target="_blank">
							<i class="fa fa-facebook-square fa-2x"></i>
							<div class="text">Facebook</div>
						</a>
						<a href="https://plus.google.com/share?url=http://iz-article.ru/article/<?=$ARTICLE['ID']?>/" title="Опубликовать ссылку в Google Plus" onclick="window.open(this.href,'Опубликовать ссылку в Google Plus', 'width=500,height=1'); return false" target="_blank">
							<i class="fa fa-google-plus-square fa-2x"></i>
							<div class="text">Google Plus</div>
						</a>
						<a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=iz-article.ru/article/<?=$ARTICLE['ID']?>/&amp;st.comments=" title="Опубликовать ссылку в Одноклассниках" onclick="window.open(this.href,'Опубликовать ссылку в Одноклассниках','width=1,height=1,toolbar=0,status=0'); return false" target="_blank">
							<i class="fa fa-odnoklassniki-square fa-2x"></i>
							<div class="text">Одноклассники</div>
						</a>
					</div>
				</div>
				<br /><br />
				<h1><?=$ARTICLE['TITLE']?></h1>
				<div id="date">Автор: <a href="<?=$ARTICLE['AUTHOR_URL']?>">@<?=$ARTICLE['AUTHOR']?></a> Всего просмотров: <i class="fa fa-eye"> <?=$ARTICLE['VIEWS']?></i></div>
				<br />
				<div id="text">
					<?=$ARTICLE['ARTICLE']?>
					<br /><center><div class="ad"><?php include('../html/ads/text.html'); ?></div></center><br />
				</div>
			</div>
		</div>
	</center>
	<footer><div id="menu"></div><div id="copyrights">IZ-article Copyright © 2016.</div></footer>

	<script src="http://iz-article.ru/html/js/jQuery-1.12.4.min.js"></script>
	<script type="text/javascript">$('#preloader').fadeOut('slow',function(){$(this).remove();});</script>

	<link rel="stylesheet" href="http://iz-article.ru/html/css/main.css">
	<link rel="stylesheet" href="http://iz-article.ru/html/libs/fancybox/fancybox.min.css">
	<script src="http://iz-article.ru/html/libs/fancybox/fancybox.min.js"></script>
	<script src="http://iz-article.ru/html/ads/ad.js"></script>

	<script>
		$("a.zoom").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});
	
		$(".tab_content").load('http://iz-article.ru/includes/getSideBar.php?id=<?=$ARTICLE['ID']?>');

		$(".tab_item").not(":first").hide();
		$(".wrapper .tab").click(function(){$(".wrapper .tab").removeClass("active").eq($(this).index()).addClass("active");$(".tab_item").hide().eq($(this).index()).fadeIn()}).eq(0).addClass("active");
		$("#header").html("<header></header><div class='alt'><h2>IZ-article</h2> - Информационный сайт по Ижевску, Удмуртской Республике.</div>");
		$("#menu").load('http://iz-article.ru/includes/getFooter.php?id=1');

		if(!('adBlock' in window)){$("#<?=$AdBlockDIV?>").html('<a href="#">как отключить</a>Привет, Пользователь. Кажется, ты используешь AdBlock.<br />Наш сайт развивается и существует за счет доходов от рекламы. Добавь нас в исключения.');document.body.style.marginTop="100px";$(".ad").html('<div class="ok">Реклама помогает поддерживать и развивать наш сайт<br><br><a href="/adblock/" target="_blank">[подробнее]</a></div>');}else $('#<?=$AdBlockDIV?>').remove();

		$("#share").html('<i class="fa fa-share" aria-hidden="true"></i> Поделиться');
		function Dropdown(){document.getElementById("Dropdown").classList.toggle("show");}
		window.onclick=function(event){if(!event.target.matches('.dropbtn')){var dropdowns=document.getElementsByClassName("dropdown-content");var i;for(i=0;i<dropdowns.length;i++){var openDropdown=dropdowns[i];if(openDropdown.classList.contains('show')){openDropdown.classList.remove('show');}}}}
	</script>
</body>
</html>