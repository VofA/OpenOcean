<?php

if (!isset($_POST["host"], $_POST["username"], $_POST["name"])) {
	exit("Insufficient data");
}

require_once("../../core/config.php");

require_once(PATH_CLASSES . 'Database.php');
require_once(PATH_CLASSES . 'Config.php');

foreach ($_POST as $key => $value) {
	if ($value === '') {
		$_POST[$key] = null;
	}
}

$port = $_POST["port"] ?? null;

$config = new OoConfig();
$config->load();

$config->change('URL_ROOT', $_SERVER['REQUEST_URI']);

$database = new OoDatabase();

$result = $database->connectCustom($_POST["host"], $_POST["username"], $_POST["password"], $port);
if (!$result) {
	echo('false connect error');
	exit;
}

$config->change('DATABASE_HOST', $_POST["host"]);
$config->change('DATABASE_USERNAME', $_POST["username"]);
$config->change('DATABASE_PASSWORD', $_POST["password"]);
$config->change('DATABASE_PORT', $port);
$config->save();

if (isset($_POST["createDatabase"])) {
	$database->databaseCreate($_POST["name"]);
}

$database->databaseSet($_POST["name"]);

if (!$database->databaseCheck($_POST["name"])) {
	echo('false name error');
	exit;
}

$prefix = $database->stringSafe($_POST["prefix"]);
$name = $database->stringSafe($_POST["name"]);

$config->change('DATABASE_PREFIX', $prefix);
$config->change('DATABASE_NAME', $name);
$config->save();

$columns = array(
	"`id` INT UNSIGNED NOT NULL AUTO_INCREMENT",
	"`login` VARCHAR(64) NOT NULL",
	"`email` VARCHAR(254) NOT NULL",
	"`ip` INT UNSIGNED NOT NULL",
	"`register` TIMESTAMP NOT NULL",
	"`password` VARCHAR(128) NOT NULL",
	"`token` VARCHAR(128)",
	"`salt` VARCHAR(128)",
	"PRIMARY KEY (`id`)",
	"INDEX (`login`)",
	"INDEX (`email`)",
);

$result = $database->tableCreate($name, $prefix . 'users', $columns);
if (!$result) {
	echo('false table create error');
	exit;
}

echo('true');