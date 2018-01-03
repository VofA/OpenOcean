<?php

/**
* OoLog class
*
* @copyright 2017 Danil Dumkin
*/

class OoLog {
	private $fileName;

	public function __construct($type) {
		$logType = array(
			'DB' => 'database',
			'UK' => 'unknown'
		);

		if (!array_key_exists($type, $logType)){
			$type = 'UK';
		}

		$this->fileName = __DIR__ . '/../logs/' . $logType[$type] . '.log';
	}

	public function log($text) {
		$date = '[' . date('H:i:s d.m.Y') . ']';

		file_put_contents($this->fileName, $date . " " . $text . "\n", FILE_APPEND);
	}
}