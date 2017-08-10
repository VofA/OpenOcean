<?php

require_once('../admin/includes/OoMySQLi.php');
require_once("../admin/includes/OoConfigEditor.php");

foreach ($_POST as $key => $value) {
	if ($value == '') {
		$_POST[$key] = null;
	}
}

$db = new OoMySQLi();
$result = $db->connect($_POST["host"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["port"], $_POST["socket"]);

if ($result) {
	//$db->execute('CREATE DATABASE ' + $_POST["name"]);

	$q = new OoConfigEditor();
	$q->load();

	$q->change('DB_HOST', $_POST["host"]);
	$q->change('DB_USERNAME', $_POST["username"]);
	$q->change('DB_PASSWORD', $_POST["password"]);
	$q->change('DB_NAME', $_POST["name"]);
	$q->change('DB_PORT', $_POST["port"]);
	$q->change('DB_SOCKET', $_POST["socket"]);

	$q->save();
}

echo($result);

?>