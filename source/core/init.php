<?php

require_once("config.php");

require_once(PATH_LIBRARIES . 'OpenOcean/Header.php');
require_once(PATH_LIBRARIES . 'OpenOcean/Telemetry.php');
require_once(PATH_LIBRARIES . 'OpenOcean/Debug.php');
require_once(PATH_LIBRARIES . 'OpenOcean/Semantic.php');

OoHeader::safe();

$telemetry = new OoTelemetry();
$data = $telemetry->getIpData();

$semantic = new OoSemantic();
$url = $semantic->prepare($_SERVER['REQUEST_URI']);

OoDebug::print($data);

OoDebug::print($_SERVER['REQUEST_URI']);
OoDebug::print($url);

//require_once($url);

?>