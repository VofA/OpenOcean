<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Админ панель</title>
	<link rel="stylesheet" href="../theme/styles/style_admin.css" type="text/css">
	<link rel="stylesheet" href="../theme/styles/topBar.min_admin.css" type="text/css">
	<link rel="stylesheet" href="../theme/styles/mainMenu.min_admin.css" type="text/css">
	<link rel="stylesheet" href="../theme/styles/material-icons.css">
</head>
<body>
	<div id="topBar">
		<ul id="left">
			<li>
				<a href="">
					<i class="fa fa-diamond fa-lg"></i>
				</a>
			</li>
			<li>
				<a href="">
					<i class="fa fa-bookmark fa-lg"></i>
					<span>Сайт</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class="fa fa-file fa-lg"></i>
					<span>Файл-менеджер</span>
				</a>
			</li>		
			<li>
				<a href="">
					<i class="fa fa-line-chart fa-lg"></i>
					<span>Статистика</span>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="">Яндекс.Метрика</a></li>
						<li><a href="">Mail.ru</a></li>
						<li><a href="">Google Analytics</a></li>
					</ul>
				</div>
			</li>
			<li>
				<a href="">
					<i class="fa fa-database fa-lg"></i>
					<span>База данных</span>
				</a>
			</li>
		</ul>
		<ul id="right">
			<li>
				<a href="index.php?page=user_profile">
					<i class="fa fa-user fa-lg"></i>
					<span><?php echo($auth->loginGet()); ?></span>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="index.php?page=users-edit&user=<?php echo($auth->loginGet()); ?>">Поменять пароль</a></li>
						<li><a href="index.php?do=logout">Выйти</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
	<div id="mainMenu">
		<ul>
			<li>
				<a href="index.php">
					<i class="fa fa-home"></i>
					<span>Главная</span>
				</a>
			</li>
			<li>
				<a href="index.php?page=users-list">
					<i class="fa fa-user"></i>
					<span>Пользователи</span>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="index.php?page=users-list">Список</a></li>
						<li><a href="index.php?page=users-new">Создать</a></li>
					</ul>
				</div>
			</li>
			<li>
				<a href="index.php?page=article_list">
					<i class="fa fa-list"></i>
					<span>Статьи</span>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="index.php?page=article_list">Список</a></li>
						<li><a href="index.php?page=article_edit">Добавить</a></li>
						<li><a href="index.php?page=article_lock_list">Закрытые</a></li>
					</ul>
				</div>
			</li>
			<li>
				<a href="index.php?page=main">
					<i class="fa fa-picture-o"></i>
					<span>Медиа-ресурсы</span>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="index.php?page=image_list">Картинки</a></li>
						<li><a href="index.php?page=main">Видео</a></li>
						<li><a href="index.php?page=main">Аудио</a></li>
					</ul>
				</div>
			</li>
			<li>
				<a href="index.php?page=catalog_list">
					<i class="fa fa-filter"></i>
					<span>Дерево каталогов</span>
				</a>
			</li>
			<li>
				<a href="index.php?page=html">
					<i class="fa fa-code"></i>
					<span>HTML редактор</span>
				</a>
			</li>
			<hr>
			<li>
				<a href="index.php?page=help">
					<i class="fa fa-info-circle"></i>
					<span>Помощь</span>
				</a>
			</li>
			<hr>
			<li>
				<a href="index.php?page=log">
					<?php
				/*$log = file_get_contents('log.txt');
				if ($log == '')*/
					echo ('<i class="fa fa-check-circle"></i>');
				/*else
				echo ('<i class="alertMain fa fa-exclamation-triangle"></i>');*/
				?>
				<span>Лог ошибок</span>
			</a>
		</li>
		<li>
			<a href="index.php?page=config">
				<i class="fa fa-cog"></i>
				<span>Настройки</span>
			</a>
		</li>
		<li>
			<a href="index.php?page=sitemap">
				<i class="fa fa-sitemap"></i>
				<span>Карта сайта</span>
			</a>
		</li>
		<li>
			<a href="index.php?page=update">
				<i class="fa fa-cloud-upload"></i>
				<span>Обновления</span>
			</a>
		</li>
	</ul>
</div>
<div id="container">
	<?php

$typemsg = @$_GET['typemsg'];
if(isset($typemsg)) {
	$msg = @$_GET['msg'];
	switch ($typemsg) {
		case 'success':
			$info = '<div class="alert alert-success" role="alert">' . $msg . '</div>';
			break;
		case 'danger':
			$info = '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
			break;
		default:
			$info = '<div class="alert alert-info" role="alert">' . $msg . '</div>';
			break;
	}
	echo $info;
}

?>