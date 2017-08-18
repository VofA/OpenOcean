<?php

/**
* OoAuth class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/../config.php");

require_once(OO_INCLUDES . "OoDatabase.php");

class OoAuth {
	private $database;

	private $id = null;
	private $login = null;
	private $email = null;
	private $ip = null;

	private $error = '';

	public function __construct($database) {
		$this->database = $database;
	}

	public function check() : bool {
		if (!$this->database->connected()) {
			$this->error = "Connect error";
			$this->logout();
			return false;
		}

		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		if (!isset($_SESSION['auth']['token'])) {
			$this->error = "Token not select";
			$this->logout();
			return false;
		}

		$prefix = $this->database->stringSafe(DB_PREFIX);
		$token = $this->database->stringSafe($_SESSION['auth']['token']);

		$result = $this->database->execute("SELECT * FROM `{$prefix}users` WHERE `token` = '{$token}'");

		if ($result->num_rows  !== 1) {
			$this->error = "Token not found";
			$this->logout();
			return false;
		}

		$result = $this->database->associativeArrayGet($result);

		$this->id = $result['id'];
		$this->login = $result['login'];
		$this->email = $result['email'];

		return true;
	}

	public function idGet() : string {
		return $this->id;
	}

	public function loginGet() : string {
		return $this->login;
	}

	public function emailGet() : string {
		return $this->email;
	}

	public function errorGet() : string {
		return $this->error;
	}

	public function register($login, $password, $email) : bool {
		if (!$this->database->connected()) {
			$this->error = "Connect error";
			return false;
		}

		$prefix = $this->database->stringSafe(DB_PREFIX);
		$login = $this->database->stringSafe($login);
		$salt = $this->saltGenerate();
		$password = $this->passwordSecure($password, $salt);
		$email = $this->database->stringSafe($email);

		$result = $this->database->execute("SELECT * FROM `{$prefix}users` WHERE `login` = '{$login}'");
		if ($result->num_rows !== 0) {
			$this->error = "User already exists";
			return false;
		}

		$result = $this->database->execute("INSERT INTO `{$prefix}users` (`id`, `login`, `password`, `email`, `salt`) VALUES (NULL, '{$login}', '{$password}', '{$email}', '{$salt}')");

		return $result;
	}

	public function login($login, $password) : bool {
		if (!$this->database->connected()) {
			$this->error = "Connect error";
			$this->logout();
			return false;
		}

		$prefix = $this->database->stringSafe(DB_PREFIX);
		$login = $this->database->stringSafe($login);
		$password = $this->database->stringSafe($password);

		$result = $this->database->execute("SELECT * FROM `{$prefix}users` WHERE `login` = '{$login}'");
		if ($result->num_rows !== 1) {
			$this->error = "Incorrect login or password (l)";
			$this->logout();
			return false;
		}

		$result = $this->database->associativeArrayGet($result);

		$passwordSecure = $this->passwordSecure($password, $result['salt']);

		if ($passwordSecure != $result['password']) {
			$this->error = "Incorrect login or password (p)";
			$this->logout();
			return false;
		}

		$this->id = $result['id'];
		$this->login = $result['login'];
		$this->email = $result['email'];
		$this->ip = $result['ip'];

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$_SESSION['auth']['token'] = $this->tokenGenerate($login, $password);

		$token = $this->database->stringSafe($_SESSION['auth']['token']);
		$ip = ip2long($_SERVER['REMOTE_ADDR']);
		$id = $this->database->stringSafe($this->id);

		$result = $this->database->execute("UPDATE `{$prefix}users` SET `token`='{$token}', `ip`='{$ip}' WHERE `id` = '{$id}'");
		if (!$result) {
			$this->error = "Don't update token";
			$this->logout();
			return false;
		}

		return true;
	}

	public function logout() : bool {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		session_destroy();

//		$result = $this->database->execute("UPDATE `{$prefix}users` SET `token`='', `ip`='{$ip}' WHERE `id` = '{$id}'");

		$this->id = null;
		$this->login = null;
		$this->email = null;

		return true;
	}

	private function tokenGenerate($login, $password) : string {
		$salt = $this->saltGenerate();
		$passwordSecure = $this->passwordSecure($password, $salt);

		$token = hash('sha512', $login . $passwordSecure);

		if (SG_USE_IP) {
			$ip = ip2long($_SERVER['REMOTE_ADDR']);

			$token = hash('sha512', $ip . $token);
		}

		return $token;
	}

	private function passwordSecure($password, $salt) : string {
		return hash('sha512', $salt . $password);
	}

	private function saltGenerate() : string {
		$randomBytes = random_bytes(64);
		$randomString = bin2hex($randomBytes);

		return hash('sha512', $randomString);
	}
}