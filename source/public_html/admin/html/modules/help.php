<?php include("html/index.php"); ?>
<h1>Вставка по центру</h1>
<p><label for="center">Код:</label><br /><input type="search" name="center" id="center" value=""></p>
<div class="code"><code id="center-code">Введите все данные для отображения кода</code></div>

<h1>Вставка картинки</h1>
<p><label for="img-src">ID картинки: (Пример: 1)</label><br /><input type="search" name="img-src" id="img-src" value=""></p>
<br />
<div class="code"><code id="img-code">Введите все данные для отображения кода</code></div>

<h1>Вставка рекламы</h1>
<p>Чтобы вставить рекламу надо написать '~ad~'</p>
<div class="code"><code id="img-code">~ad~</code></div>

<h1>Передвинуть на левую сторону</h1>
<p><label for="side-left">Что поместить на левую сторону:</label><br /><input type="search" name="side-left" id="side-left" value=""></p>
<div class="code"><code id="side-left-code">Введите все данные для отображения кода</code></div>

<h1>Передвинуть на правую сторону</h1>
<p><label for="side-right">Что поместить на правую сторону:</label><br /><input type="search" name="side-right" id="side-right" value=""></p>
<div class="code"><code id="side-right-code">Введите все данные для отображения кода</code></div>

<h1>Размещение с двух сторон</h1>
<p><label for="half-right">Что поместить на правую сторону:</label><br /><input type="search" name="half-right" id="half-right" value=""></p>
<p><label for="half-left">Что поместить на левую сторону:</label><br /><input type="search" name="half-left" id="half-left" value=""></p>
<div class="code"><code id="half-code">Введите все данные для отображения кода</code></div>

<h1>Размещение кнопки</h1>
<p><label for="button-href">Ссылка: (Пример: http://domen.reg/page1.html)</label><br /><input type="search" name="button-href" id="button-href" value=""></p>
<p><label for="button-value">Надпись: (Пример: Перейти)</label><br /><input type="search" name="button-value" id="button-value" value=""></p>
<p><label for="button-title">Подсказка: (Пример: Перейти)</label><br /><input type="search" name="button-title" id="button-title" value=""></p>
<div class="code"><code id="button-code">Введите все данные для отображения кода</code></div>

<h1>Размещение ссылки</h1>
<p><label for="href-href">Ссылка: (Пример: http://domen.reg/page1.html)</label><br /><input type="search" name="href-href" id="href-href" value=""></p>
<p><label for="href-value">Надпись: (Пример: Ссылка)</label><br /><input type="search" name="href-value" id="href-value" value=""></p>
<p><label for="href-title">Подсказка: (Пример: Клик)</label><br /><input type="search" name="href-title" id="href-title" value=""></p>
<div class="code"><code id="href-code">Введите все данные для отображения кода</code></div>


<script>

	var center = document.getElementById("center");
	center.oninput = function() {
		document.getElementById('center-code').innerHTML = text_replace('&lt;center&gt;' + center.value + '&lt;/center&gt;');
	};

	function text_replace(text){
		text = text.replace( /</g, "&lt;" );
		text = text.replace( />/g, "&gt;" );
		return text;
	}

	var img_src = document.getElementById("img-src");
	var img_alt = document.getElementById("img-alt");
	var img_title = document.getElementById("img-title");

	img_src.oninput = function() {
		document.getElementById('img-code').innerHTML = text_replace('~img:' + img_src.value + '~');
	};

	var side_left = document.getElementById("side-left");
	side_left.oninput = function() {
		document.getElementById('side-left-code').innerHTML = text_replace('&lt;div class="left"&gt;' + side_left.value + '&lt;/div&gt;');
	};

	var side_right = document.getElementById("side-right");
	side_right.oninput = function() {
		document.getElementById('side-right-code').innerHTML = text_replace('&lt;div class="right"&gt;' + side_right.value + '&lt;/div&gt;');
	};

	var half_left = document.getElementById("half-left");
	var half_right = document.getElementById("half-right");
	half_left.oninput = function() {
		document.getElementById('half-code').innerHTML = text_replace('&lt;ul class="half"&gt;&lt;li&gt;' + half_left.value + '&lt;/li&gt;&lt;li&gt;' + half_right.value + '&lt;/li&gt;&lt;/ul&gt;');
	};
	half_right.oninput = function() {
		document.getElementById('half-code').innerHTML = text_replace('&lt;ul class="half"&gt;&lt;li&gt;' + half_left.value + '&lt;/li&gt;&lt;li&gt;' + half_right.value + '&lt;/li&gt;&lt;/ul&gt;');
	};

	var button_href = document.getElementById("button-href");
	var button_value = document.getElementById("button-value");
	var button_title = document.getElementById("button-title");
	button_href.oninput = function() {
		document.getElementById('button-code').innerHTML = text_replace('&lt;a href="' + button_href.value + '"&gt;&lt;input class="button" type="button" value="' + button_value.value + '" title="' + button_title.value + '"&gt;&lt;/a&gt;');
	};
	button_value.oninput = function() {
		document.getElementById('button-code').innerHTML = text_replace('&lt;a href="' + button_href.value + '"&gt;&lt;input class="button" type="button" value="' + button_value.value + '" title="' + button_title.value + '"&gt;&lt;/a&gt;');
	};
	button_title.oninput = function() {
		document.getElementById('button-code').innerHTML = text_replace('&lt;a href="' + button_href.value + '"&gt;&lt;input class="button" type="button" value="' + button_value.value + '" title="' + button_title.value + '"&gt;&lt;/a&gt;');
	};

	var href_href = document.getElementById("href-href");
	var href_value = document.getElementById("href-value");
	var href_title = document.getElementById("href-title");
	href_href.oninput = function() {
		document.getElementById('href-code').innerHTML = text_replace('&lt;a href="' + href_href.value + '" title="' + href_title.value + '"&gt;' + href_value.value + '&lt;/a&gt;');
	};
	href_value.oninput = function() {
		document.getElementById('href-code').innerHTML = text_replace('&lt;a href="' + href_href.value + '" title="' + href_title.value + '"&gt;' + href_value.value + '&lt;/a&gt;');
	};
	href_title.oninput = function() {
		document.getElementById('href-code').innerHTML = text_replace('&lt;a href="' + href_href.value + '" title="' + href_title.value + '"&gt;' + href_value.value + '&lt;/a&gt;');
	};
</script>
</div></body></html>