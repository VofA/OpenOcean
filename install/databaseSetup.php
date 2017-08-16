<?php

require_once('../admin/includes/OoDatabase.php');
require_once("../admin/includes/OoConfigEditor.php");

foreach ($_POST as $key => $value) {
	if ($value == '') {
		$_POST[$key] = null;
	}
}

$port = $_POST["port"] ?? null;

$sql = new OoDatabase();

if (isset($_POST["create"])) {
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

	if (isset($_POST["create"])) {
		$sql->databaseCreate($_POST["name"]);
	}

	$tablesColumns = array(
		'users' => '`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `login` CHAR(64) NOT NULL , `password` CHAR(64) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`login`)'
	);

	$sql->tableCreate($_POST["name"], $_POST["prefix"] . 'users', $tablesColumns['users']);
}

echo $connectResult ? 'true' : 'false';

?>