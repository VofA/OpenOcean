<?php

/**
* OoLog class
*
* @copyright 2017 Danil Dumkin
*/

class OoLog {
	private $logType;

	function __construct() {
		$this->logType = array(
			'DB' => 'database.log'
		);
	}

	function write($type, $text) {
		$_file = __DIR__ . "/../logs/" . $this->logType[$type];
		$_date = "[" . date('H:i:s d.m.Y') . "]";

		file_put_contents($_file, "$_date $text\n", FILE_APPEND);
	}
}
?>