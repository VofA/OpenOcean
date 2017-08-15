<?php

require_once('../admin/includes/OoDatabase.php');
require_once("../admin/includes/OoConfigEditor.php");

foreach ($_POST as $key => $value) {
	if ($value == '') {
		$_POST[$key] = null;
	}
}

$sql = new OoDatabase();
$config = new OoConfigEditor();

if (isset($_POST["create"])) {
	$connectResult = $sql->connectCustom($_POST["host"], $_POST["username"], $_POST["password"], $_POST["port"]);

	$sql->databaseCreate($_POST["name"]);
} else {
	$connectResult = $sql->connectCustom($_POST["host"], $_POST["username"], $_POST["password"], $_POST["port"]);
}

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

	// $sql->execute("");
}

echo $connectResult ? 'true' : 'false';

?>