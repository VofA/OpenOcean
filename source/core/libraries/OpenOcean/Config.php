<?php

/**
* OpenOcean - Config class
*
* @copyright 2018 Danil Dumkin
*/

class OoConfig {
	private $_config = "";

	function load() {
		$this->_config = file_get_contents(PATH_CORE . "config.php");
	}

	function change($key, $value) {
		if ($value === null) {
			$newValue = 'null';
		} if ($value === true) {
			$newValue = 'true';
		} if ($value === false) {
			$newValue = 'false';
		} else {
			$newValue = "'$value'";
		}

		$this->_config = preg_replace('~(.*)' . $key . '(.*);~', "define('$key', $newValue);", $this->_config);
	}

	function save() {
		file_put_contents(PATH_CORE . "config.php", $this->_config);
	}
}