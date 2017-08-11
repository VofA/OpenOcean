<?php

require_once('../admin/includes/OoMySQLi.php');
require_once("../admin/includes/OoConfigEditor.php");

foreach ($_POST as $key => $value) {
	if ($value == '') {
		$_POST[$key] = null;
	}
}

$db = new OoMySQLi();
$connectResult = $db->connect($_POST["host"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["port"], $_POST["socket"]);

if ($connectResult) {
	$config = new OoConfigEditor();
	$config->load();

	$config->change('DB_HOST', $_POST["host"]);
	$config->change('DB_USERNAME', $_POST["username"]);
	$config->change('DB_PASSWORD', $_POST["password"]);
	$config->change('DB_NAME', $_POST["name"]);
	$config->change('DB_PORT', $_POST["port"]);
	$config->change('DB_SOCKET', $_POST["socket"]);

	$config->save();

	// $db->execute("");

}

echo($connectResult);

?>