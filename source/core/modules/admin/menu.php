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
				<a href="index.php">
					<i class="material-icons">home</i>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="">Главная</a></li>
						<li><a href="../install/">Установка</a></li>
					</ul>
				</div>
			</li>
			<li>
				<a href="http://localhost/phpmyadmin">
					<i class="material-icons">view_list</i>
					<span>База данных</span>
				</a>

			</li>
		</ul>
		<ul id="right">
			<li>
				<a href="index.php?page=user_profile">
					<i class="material-icons">account_circle</i>
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
					<i class="material-icons">home</i>
					<span>Главная</span>
				</a>
			</li>
			<li>
				<a href="index.php?page=users-list">
					<i class="material-icons">account_circle</i>
					<span>Пользователи</span>
				</a>
				<div id="submenu">
					<ul>
						<li><a href="index.php?page=users-list">Список</a></li>
						<li><a href="index.php?page=users-new">Создать</a></li>
					</ul>
				</div>
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