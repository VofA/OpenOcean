<?php

/**
* OoConfigEditor class
*
* @copyright 2017 Danil Dumkin
*/

class OoConfigEditor {
	private $config = "";

	function load() {
		$this->config = file_get_contents(__DIR__ . "/../config.php");
	}

	function change($key, $value) {
		$newValue = '';

		if ($value === null) {
			$newValue = 'null';
		} else {
			$newValue = "'$value'";
		}

		$this->config = preg_replace('~(.*)' . $key . '(.*);~', "define('$key', $newValue);", $this->config);
	}

	function save() {
		file_put_contents(__DIR__ . "/../config.php", $this->config);
	}
}
?>