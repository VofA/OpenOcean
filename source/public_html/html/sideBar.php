<div id="sidebar">
	<div>
		<form action="http://iz-article.ru/search/index.php" method="get" target="_self" name="search-form">
			<input type="hidden" name="searchid" value="2203405"/>
			<input type="hidden" name="l10n" value="ru"/>
			<input type="hidden" name="reqenc" value="utf-8"/>
			<div class="form-search">
				<input type="text" name="text" class="search" value="" placeholder='Поиск'/>
				<input type="submit" value=""/>
			</div>
		</form>
		<br />
		<?=$ARTICLE['AD_SIDEBAR']?>
		<br />
		<?php
		if($ARTICLE['RELATED'] != 'DISABLE')
			echo('<div class="menu"><ul class="tabs"><li class=""><a href="javascript:;">Топ</a></li><li class="active"><a href="javascript:;">Похожие</a></li><li class=""><a href="javascript:;">Блог</a></li></ul><div class="tabs__content"><ul class="list">' . $ARTICLE['MENU']['TOP'] . '</ul></div><div class="tabs__content active"><ul class="list">' . $ARTICLE['MENU']['RELATED'] . '</ul></div><div class="tabs__content"><ul class="list">' . $ARTICLE['MENU']['BLOG'] . '</ul></div>
		</div>');
		?>
	</div>
</div>