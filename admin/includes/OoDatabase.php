<?php

/**
* OoDatabase class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/OoLog.php");

class OoDatabase extends OoLog {
	private $handler;
	private $connected = false;

	public function __construct() {
		parent::__construct('DB');
	}
	public function connect() : bool {
		$this->handler = @new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

		if ($this->handler->connect_errno) {
			$this->log($this->handler->connect_error);
			return false;
		}

		$this->connected = true;
		return true;
	}
	public function connectCustom($host, $username, $password, $port) : bool {
		$this->handler = @new mysqli($host, $username, $password, null, $port);

		if ($this->handler->connect_errno) {
			$this->log($this->handler->connect_error);
			return false;
		}

		$this->connected = true;
		return true;
	}
	public function connected() : bool {
		return $this->connected;
	}
	public function charsetSelect($charset = 'utf8') {
		if (!$this->connected) {
			$this->log("charsetSelect: connection not established");
			return false;
		}

		if (!$this->handler->set_charset($charset)) {
			$this->log($this->handler->error);
			return false;
		}

		return true;
	}
	public function close() : bool {
		return $this->handler->close();
	}

	public function execute($query) {
		if (!$this->connected) {
			$this->log("execute: connection not established");
			return false;
		}

		$result = $this->handler->query($query);

		if (!$result) {
			$this->log($this->handler->error);
		}

		return $result;
	}
	public function stringSafe($string) {
		if (!$this->connected) {
			$this->log("stringSafe: connection not established");
			return false;
		}

		return $this->handler->real_escape_string($string);
	}
	public function associativeArrayGet($query) {
		return $query->fetch_assoc();
	}

	public function tableCreate($databaseName, $tableName, $columns) {
		if (!$this->connected) {
			$this->log("tableCreate: connection not established");
			return false;
		}

		$databaseName = $this->stringSafe($databaseName);
		$tableName = $this->stringSafe($tableName);
		$columns = implode(',', $columns);

		$result = $this->execute("CREATE TABLE `$databaseName`.`$tableName`($columns) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;");

		return $result;
	}

	public function databaseSet($name) : bool {
		if (!$this->connected) {
			$this->log("databaseSet: connection not established");
			return false;
		}

		return $this->handler->select_db($name);
	}
	public function databaseGet() {
		if (!$this->connected) {
			$this->log("databaseGet: connection not established");
			return false;
		}

		$result = $this->execute('SELECT database()');
		$result = $this->associativeArrayGet($result)['database()'];

		return $result;
	}
	public function databaseCreate($name) : bool {
		if (!$this->connected) {
			$this->log("databaseCreate: connection not established");
			return false;
		}

		return $this->execute('CREATE DATABASE ' . $name . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
	}
	public function databaseCheck($name) : bool {
		if (!$this->connected) {
			$this->log("databaseCheck: connection not established");
			return false;
		}

		return $this->databaseGet() === $name;
	}
}