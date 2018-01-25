<?php

/**
* OpenOcean - Database class
*
* @copyright 2018 Danil Dumkin
*/

require_once(PATH_CLASSES . 'Log.php');

class OoDatabase extends OoLog {
	public function __construct() {
		parent::__construct('DB');
	}

	public function connect() : bool {
		$this->_handler = @new mysqli(
			DATABASE_HOST,
			DATABASE_USERNAME,
			DATABASE_PASSWORD,
			DATABASE_NAME,
			DATABASE_PORT
		);

		if ($this->_handler->connect_errno) {
			$this->write($this->_handler->connect_error);
			return false;
		}

		$this->_connected = true;
		return true;
	}

	public function connectCustom($host, $username, $password, $port) : bool {
		$this->_handler = @new mysqli($host, $username, $password, null, $port);

		if ($this->_handler->connect_errno) {
			$this->write($this->_handler->connect_error);
			return false;
		}

		$this->_connected = true;
		return true;
	}

	public function connected() : bool {
		return $this->_connected;
	}

	public function charsetSelect($charset = 'utf8') {
		if (!$this->_connected) {
			$this->write("charsetSelect: connection not established");
			return false;
		}

		if (!$this->_handler->set_charset($charset)) {
			$this->write($this->_handler->error);
			return false;
		}

		return true;
	}

	public function close() : bool {
		return $this->_handler->close();
	}

	public function execute($query) {
		if (!$this->_connected) {
			$this->write("execute: connection not established");
			return false;
		}

		$result = $this->_handler->query($query);

		if (!$result) {
			$this->write($this->_handler->error);
		}

		return $result;
	}

	public function stringSafe($string) {
		if (!$this->_connected) {
			$this->write("stringSafe: connection not established");
			return false;
		}

		return $this->_handler->real_escape_string($string);
	}

	public function associativeArrayGet($query) {
		return $query->fetch_assoc();
	}

	public function tableCreate($databaseName, $tableName, $columns) : bool {
		if (!$this->_connected) {
			$this->write("tableCreate: connection not established");
			return false;
		}

		$databaseName = $this->stringSafe($databaseName);
		$tableName = $this->stringSafe($tableName);
		$columns = implode(',', $columns);

		$result = $this->execute("CREATE TABLE `$databaseName`.`$tableName`($columns) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;");

		return $result;
	}

	public function databaseSet($name) : bool {
		if (!$this->_connected) {
			$this->write("databaseSet: connection not established");
			return false;
		}

		return $this->_handler->select_db($name);
	}

	public function databaseGet() {
		if (!$this->_connected) {
			$this->write("databaseGet: connection not established");
			return false;
		}

		$result = $this->execute('SELECT database()');
		$result = $this->associativeArrayGet($result)['database()'];

		return $result;
	}

	public function databaseCreate($name) : bool {
		if (!$this->_connected) {
			$this->write("databaseCreate: connection not established");
			return false;
		}

		$name = $this->stringSafe($name);

		return $this->execute("CREATE DATABASE `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
	}

	public function databaseCheck($name) : bool {
		if (!$this->_connected) {
			$this->write("databaseCheck: connection not established");
			return false;
		}

		return $this->databaseGet() === $name;
	}

	private $_handler;
	private $_connected = false;
}