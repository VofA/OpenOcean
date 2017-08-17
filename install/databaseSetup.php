<?php

require_once('../admin/includes/OoDatabase.php');
require_once("../admin/includes/OoConfigEditor.php");

foreach ($_POST as $key => $value) {
	if ($value === '') {
		$_POST[$key] = null;
	}
}

$port = $_POST["port"] ?? null;

$sql = new OoDatabase();

if (isset($_POST["createDatabase"])) {
	$connectResult = $sql->connectCustom($_POST["host"], $_POST["username"], $_POST["password"], null, $port);
} else {
	$connectResult = $sql->connectCustom($_POST["host"], $_POST["username"], $_POST["password"], $_POST["name"], $port);
}

if ($connectResult) {
	$config = new OoConfigEditor();
	$config->load();

	$config->change('DB_HOST', $_POST["host"]);
	$config->change('DB_USERNAME', $_POST["username"]);
	$config->change('DB_PASSWORD', $_POST["password"]);
	$config->change('DB_PREFIX', $_POST["prefix"]);
	$config->change('DB_NAME', $_POST["name"]);
	$config->change('DB_PORT', $port);

	$config->save();

	if (isset($_POST["createDatabase"])) {
		$sql->databaseCreate($_POST["name"]);
	}

	$tablesColumns = array(
		'users' => '`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `login` VARCHAR(64) NOT NULL , `password` VARCHAR(64) NOT NULL , `email` VARCHAR(254) NOT NULL , PRIMARY KEY (`id`), INDEX (`login`), INDEX (`email`)'
	);

	$prefix = $sql->safe($_POST["prefix"]);
	$name = $sql->safe($_POST["name"]);

	$sql->tableCreate($name, $prefix . 'users', $tablesColumns['users']);
}

echo($connectResult ? 'true' : 'false');