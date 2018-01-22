<?php

/**
* OpenOcean - Telemetry class
*
* @copyright 2018 Danil Dumkin
*/

require_once(PATH_CLASSES . 'Log.php');

class OoTelemetry {
	public function __construct() {
		$this->_log = new OoLog('TM', true);

		$this->_ip = $this->getIp();
	}

	public function getIpData($ip = "default") {
		if ($ip === "default") {
			$ip = $this->_ip;

			if ($this->_cache) {
				return $this->_data;
			}

			$this->_cache = true;
		}
		
		$data = json_decode(file_get_contents('https://freegeoip.net/json/' . $ip));

		if ($ip == $this->_ip && $this->_cache) {
			$this->_data = $data;
		}

		return $data;
	}

	public function getIp() {
		return $_SERVER['REMOTE_ADDR'];
	}

	private $_log;
	private $_ip;
	private $_data;
	private $_cache = false;
}

?>