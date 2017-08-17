<?php

/**
* OoUser class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/OoDatabase.php");

class OoUser {
	private $handler;

	public function __construct() {
		$this->handler = new OoDatabase();
		$this->handler->connect();
	}

	public function userCreate($login, $password, $email) {
		if (!$this->handler->connected()) {
			return false;
		}

		$login = $this->handler->safe($login);
		$email = $this->handler->safe($email);
		$password = hash('sha256', $password);

		$result = $this->handler->execute("INSERT INTO `" . DB_PREFIX . "users` (`id`, `login`, `password`, `email`) VALUES (NULL, '" . $login . "', '" . $password . "', '" . $email . "')");

		return $result;
	}
}