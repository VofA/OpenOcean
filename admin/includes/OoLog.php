<?php

/**
 * OoLog class
 *
 * @copyright 2017 Danil Dumkin
 */

class OoLog {
	function write($text) {
		file_put_contents(__DIR__ . "/../log.txt", "[" . date("H:i:s d.m.Y") . "] : " . $string . "\n", FILE_APPEND);
	}
}
?>