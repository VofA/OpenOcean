<?php

require_once('../admin/includes/OoMySQLi.php');

foreach ($_POST as $key => $value) {
	if ($value == '') {
		$_POST[$key] = null;
	}
}

$db = new OoMySQLi();
$result = $db->connect($_POST["host"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["port"], $_POST["socket"]);

if ($result) {
	//$db->execute('CREATE DATABASE ' + $_POST["name"]);
}

echo($result);

?>