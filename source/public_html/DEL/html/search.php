<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title><?php echo($ARTICLE['TITLE']); ?></title>
		<link rel='shortcut icon' href='../../html/img/favicon.ico'>
		<link rel='stylesheet' type='text/css' href='../../html/css/article.min.css'>
		<meta property='og:url'           content='http://iz-article.ru/article/<?php echo($ARTICLE['ID']); ?>' />
		<meta property='og:type'          content='website' />
		<meta property='og:title'         content='IZ-article' />
		<meta property='og:description'   content='Удмуртия' />
		<meta property='og:image'         content='http://www.your-domain.com/path/image.jpg' />
		<link rel='stylesheet' type='text/css' href='../../html/css/font-awesome.min.css'>
	</head>
	<body>
		<div id='preloader' style='position:fixed;left:0;top:0;right:0;bottom:0;background:#fff;z-index:11'>
			<center>
				<i class='fa fa-spinner fa-spin fa-5x' style='position:absolute;top:50%;margin:-40px 0 0 -40px;'></i>
			</center>
		</div>
		<div id='form-active-search' style='position:fixed;left:0;top:0;right:0;bottom:0;background:#E2E2E2;z-index:100;display:none'>
			<i class='fa fa-times fa-2x search-close'></i>
		</div>
		<?php include("../html/topBar.php");	?>
		<div id='container'>
			<header style="background: url(http://iz-article.ru/html/backgrounds/5.jpg)"></header>
			<?php include("../html/sideBarArticle.php");	?>
			<div id='raw'>
<div id="ya-site-results" onclick="return {'tld': 'ru','language': 'ru','encoding': 'utf-8'}"></div><script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0];s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Results.init();})})(window,document,'yandex_site_callbacks');</script>
				<?php include('../html/footer.php'); ?>
			</div>
		</div>
	<script type='text/javascript' src='../../html/js/jquery.min.js'></script>
		<script type='text/javascript' src='../../html/js/article.min.js'></script>
		<script type='text/javascript'>
		$(".search").keyup(function(event){
    if(event.keyCode == 13){
    	$('#form-active-search').fadeToggle('slow');
				/*$('#form-active-search').submit();*/
		    }
		});
			$(document).ready(function(){
				$(Up);
			});
			$('.search-close').click(function () {
				$('#form-active-search').fadeToggle('slow');
			});
			$('.search-open').click(function () {
				$('#form-active-search').fadeToggle('slow');
			});
			$(window).on('load', function () {
				var $preloader = $('#preloader'),
				$spinner = $preloader.find('.spinner');
				$spinner.fadeOut();
				$preloader.delay(350).fadeOut('slow');
			});
		</script>
	</body>
</html>