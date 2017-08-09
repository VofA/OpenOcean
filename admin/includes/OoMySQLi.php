<?php

/**
 * OoMySQLi class
 *
 * @copyright 2017 Danil Dumkin
 */

class OoMySQLi {
	private $handler;

	function connect($host = null, $user = null, $password = null, $name = null, $port = null, $socket = null) : bool {
		$this->handler = new mysqli($host, $user, $password, $name, $port, $socket);
		// $this->handler = new mysqli("localhost", "root");
		if ($this->handler->connect_errno) {
			//LogWrite("[MySQLi_Connection] " . $this->handler->connect_error);
			//exit("[MySQLi] Не удалось подключится к базе данных.");
			return false;
		}
		if (!$this->handler->set_charset("utf8")) {
			//LogWrite("[MySQLi_Connection] " . $this->handler->error);
			//exit("[MySQLi] Не удалось выбрать кодировку.");
			return false;
		}
		return true;
	}

	function execute($query) {
		$ret = $this->handler->query($query);

		if (!$ret) {
			//LogWrite("[MySQLi Query] " . $this->mysqli->error);
			exit("[MySQLi Query] Error!");
		}
		return $ret;
	}

	function fetch_assoc($query) {
		return $query->fetch_assoc();
	}

	function fetch_array($query) {
		return $query->fetch_array();
	}

	function safe($string) {
		return $this->handler->real_escape_string($string);
	}

	function close() {
		return $this->handler->close();
	}
}
?>