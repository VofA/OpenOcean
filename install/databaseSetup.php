<?php

require_once('../admin/includes/OoMySQLi.php');
require_once("../admin/includes/OoConfigEditor.php");

foreach ($_POST as $key => $value) {
	if ($value == '') {
		$_POST[$key] = null;
	}
}

$port = $_POST["port"] ?? null;

$sql = new OoMySQLi();
$config = new OoConfigEditor();

if (isset($_POST["create"])) {
	$connectResult = $sql->connect($_POST["host"], $_POST["username"], $_POST["password"], '', $port);

	$sql->databaseCreate($_POST["name"]);
} else {
	$connectResult = $sql->connect($_POST["host"], $_POST["username"], $_POST["password"], $_POST["name"], $port);
}

if ($connectResult) {
	$config = new OoConfigEditor();
	$config->load();

	$config->change('DB_HOST', $_POST["host"]);
	$config->change('DB_USERNAME', $_POST["username"]);
	$config->change('DB_PASSWORD', $_POST["password"]);
	$config->change('DB_NAME', $_POST["name"]);
	$config->change('DB_PORT', $port);

	$config->save();

	// $sql->execute("");
}

echo $connectResult ? 'true' : 'false';

?>