<?php

require_once("../core/config.php");

if (!OPEN_OCEAN_INSTALLED) {
	header('Location: install/');
	exit;
}

require_once("../core/init.php");