<?php

/**
* OpenOcean - Log class
*
* @copyright 2018 Danil Dumkin
*/

class OoLog {
	public function __construct($type = 'UK', $oneDay = false) {
		$logType = array(
			'DB' => 'database',
			'TM' => 'telemetry',
			'UK' => 'unknown'
		);

		if (!array_key_exists($type, $logType)){
			$type = 'UK';
		}

		if ($oneDay) {
			$this->_filename = PATH_LOGS . $type . '_' . date('Y-m-d') . '.log';
		} else {
			$this->_filename = __DIR__ . '/../logs/' . $logType[$type] . '.log';
		}
	}

	public function write($text) {
		$date = '[' . date('H:i:s d.m.Y') . ']';

		file_put_contents($this->_filename, $date . ' ' . $text . "\n", FILE_APPEND);
	}

	private $_filename;
}