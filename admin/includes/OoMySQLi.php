<?php

/**
* OoMySQLi class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/OoLog.php");

class OoMySQLi {
	private $handler;
	private $log;

	function __construct() {
		$this->log = new OoLog();
	}

	function connect($host = null, $user = null, $password = null, $name = null, $port = null, $socket = null) : bool {
		$this->handler = @new mysqli($host, $user, $password, $name, $port, $socket);

		if ($this->handler->connect_errno) {
			$this->log->write("DB", $this->handler->connect_error);
			return false;
		}

		if (!$this->handler->set_charset("utf8")) {
			$this->log->write("DB", $this->handler->error);
			return false;
		}

		return true;
	}

	function execute($query) {
		$query = $this->safe($query);

		$result = $this->handler->query($query);

		if (!$result) {
			$this->log->write("DB", $this->handler->error);
		}

		return $result;
	}

	function fetch_assoc($query) {
		return $query->fetch_assoc();
	}

	function fetch_array($query) {
		return $query->fetch_array();
	}

	function databaseSelect($name) {
		return $this->handler->select_db($name);
	}

	function databaseCreate($name) {
		return $this->execute('CREATE DATABASE ' . $name . ';');
	}

	function databaseCheck($name) {
		$result = $this->databaseSelect($name);
		if (!$result) {
			$this->log->write("DB", $this->handler->error);
			return false;
		}

		return true;
	}

	function safe($string) {
		return $this->handler->real_escape_string($string);
	}

	function close() {
		return $this->handler->close();
	}
}
?>