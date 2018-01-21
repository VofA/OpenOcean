<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?=$ARTICLE['TITLE']?></title>
	<link rel='shortcut icon' href='../../html/img/favicon.ico'>
	<meta name="description" content="<?=$ARTICLE['DESCRIPTION']?>">
	<meta name="keywords" content="<?=$ARTICLE['KEYWORDS']?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="http://iz-article.ru/article/<?=$ARTICLE['ID']?>/">
	<meta property="og:title" content="<?=$ARTICLE['TITLE']?>">
	<meta property="og:image" content="http://iz-article.ru/article/<?=$ARTICLE['ID']?>/<?=$ARTICLE['MAIN_IMG']?>">
	<meta property="og:description" content="<?=$ARTICLE['DESCRIPTION']?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="iz-article.ru">
	<link rel='stylesheet' type='text/css' href='../../html/css/article.min.css'>
	<link rel='stylesheet' type='text/css' href='../../html/css/font-awesome.min.css'>
</head>
<body>
	<div id='preloader' style='position:fixed;left:0;top:0;right:0;bottom:0;background:#fff;z-index:100'><center><i class='fa fa-spinner fa-spin fa-5x' style='position:absolute;top:50%;margin:-40px 0 0 -40px;'></i></center></div>
	<?php include("../html/topBar.php"); ?>
	<div id='container'>
		<header></header>
		<?php include("../html/sideBar.php");	?>
		<div id='raw'>
			<div id="up" style="display:none"><center><i class="fa fa-4x fa-long-arrow-up" title="Всего просмотров"></i></center></div>
			<div class='warning'>Внимание! Это новая версия сайта, если вы заметили баг <a href="http://iz-article.ru/feedback/">сообщите нам</a></div>
			<h1><?=$ARTICLE['TITLE']?></h1>
			<div id="date">
				<a href="<?=$ARTICLE['AUTHOR_URL']?>">@<?=$ARTICLE['AUTHOR']?></a> опубликовал <?=$ARTICLE['DATE']?> <i class="fa fa-eye" title="Всего просмотров"> <?=$ARTICLE['VIEWS']?></i>
				<div class="share right">
					<a href="https://twitter.com/intent/tweet?text=<?=$ARTICLE['TITLE']?> http://iz-article.ru/article/<?=$ARTICLE['ID']?>/ +%23izarticle" title="Опубликовать ссылку в Twitter" onclick="window.open(this.href, 'Опубликовать ссылку в Twitter', 'width=700,height=450'); return false" target="_blank">
						<i class="fa fa-twitter-square fa-2x"></i>
					</a>
					<a href="https://vk.com/share.php?url=http://iz-article.ru/article/<?=$ARTICLE['ID']?>/" title="Опубликовать ссылку во ВКонтакте" onclick="window.open(this.href,'Опубликовать ссылку во Вконтакте','width=1,height=1'); return false" target="_blank">
						<i class="fa fa-vk fa-1x"></i>
					</a>
					<a href="https://www.facebook.com/sharer/sharer.php?u=http://iz-article.ru/article/<?=$ARTICLE['ID']?>/" title="Опубликовать ссылку в Facebook" onclick="window.open(this.href, 'Опубликовать ссылку в Facebook', 'width=1,height=1,toolbar=0,status=0'); return false" target="_blank">
						<i class="fa fa-facebook-square fa-2x"></i>
					</a>
					<a href="https://plus.google.com/share?url=http://iz-article.ru/article/<?=$ARTICLE['ID']?>/" title="Опубликовать ссылку в Google Plus" onclick="window.open(this.href,'Опубликовать ссылку в Google Plus', 'width=500,height=1'); return false" target="_blank">
						<i class="fa fa-google-plus-square fa-2x"></i>
					</a>
					<a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=iz-article.ru/article/<?=$ARTICLE['ID']?>/&st.comments=" title="Опубликовать ссылку в Одноклассниках" onclick="window.open(this.href,'Опубликовать ссылку в Одноклассниках','width=1,height=1,toolbar=0,status=0'); return false" target="_blank">
						<i class="fa fa-odnoklassniki-square fa-2x"></i>
					</a>
				</div>
			</div>
			<br />
			<div id="text">
				<?=$ARTICLE['ARTICLE']?>
			</div>
			<br />
			<?php include('../html/footer.php'); ?>
		</div>
	</div>
	<script type='text/javascript' src='../../html/js/all.min.js'></script>
	<script type="text/javascript">
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter37417870 = new Ya.Metrika({
						id:37417870,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				} catch(e) { }
			});
			var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";
			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/37417870" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</body>
</html>