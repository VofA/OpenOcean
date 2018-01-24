<?php

require_once("config.php");

if (!OPEN_OCEAN_INSTALLED) {
	header('Location: install/');
	exit;
}

require_once(PATH_CLASSES . 'Header.php');
require_once(PATH_CLASSES . 'Telemetry.php');
require_once(PATH_CLASSES . 'Debug.php');
require_once(PATH_CLASSES . 'Semantic.php');

OoHeader::safe();

$telemetry = new OoTelemetry();
$data = $telemetry->getIpData();

$semantic = new OoSemantic();
$url = $semantic->prepare($_SERVER['REQUEST_URI']);

OoDebug::print($data);

OoDebug::print($_SERVER['REQUEST_URI']);
OoDebug::print($url);

include($url);

?>