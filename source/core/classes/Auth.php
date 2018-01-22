<?php

/**
* OpenOcean - Auth class
*
* @copyright 2018 Danil Dumkin
*/

require_once(PATH_CLASSES . 'Database.php');

class OoAuth {
	private $_database;

	private $id = null;
	private $login = null;
	private $email = null;
	private $ip = null;

	private $error = '';

	public function __construct($_database) {
		$this->_database = $_database;
	}

	public function check() : bool {
		if (!$this->_database->connected()) {
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

		$prefix = $this->_database->stringSafe(DATABASE_PREFIX);
		$token = $this->_database->stringSafe($_SESSION['auth']['token']);

		$result = $this->_database->execute("SELECT * FROM `{$prefix}users` WHERE `token` = '{$token}'");

		if ($result->num_rows  !== 1) {
			$this->error = "Token not found";
			$this->logout();
			return false;
		}

		$result = $this->_database->associativeArrayGet($result);

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

	public function register($login, $password, $email, $loginAuto = true) : bool {
		if (!$this->_database->connected()) {
			$this->error = "Connect error";
			return false;
		}

		$prefix = $this->_database->stringSafe(DATABASE_PREFIX);
		$login = $this->_database->stringSafe($login);
		$salt = $this->saltGenerate();
		$passwordSecure = $this->passwordSecure($password, $salt);
		$email = $this->_database->stringSafe($email);

		$result = $this->_database->execute("SELECT * FROM `{$prefix}users` WHERE `login` = '{$login}'");
		if ($result->num_rows !== 0) {
			$this->error = "User already exists";
			return false;
		}

		$result = $this->_database->execute("INSERT INTO `{$prefix}users` (`id`, `login`, `password`, `email`, `salt`) VALUES (NULL, '{$login}', '{$passwordSecure}', '{$email}', '{$salt}')");

		if ($loginAuto) {
			$result = $this->login($login, $password);
		}

		return $result;
	}

	public function changePassword($login, $password, $loginAuto = true) : bool {
		if (!$this->check()) {
			$this->error = "Token not select";
			return false;
		}

		$prefix = $this->_database->stringSafe(DATABASE_PREFIX);
		$login = $this->_database->stringSafe($login);
		$salt = $this->saltGenerate();
		$passwordSecure = $this->passwordSecure($password, $salt);
		
		$result = $this->_database->execute("UPDATE `{$prefix}users` SET `password` = '{$passwordSecure}', `salt` = '{$salt}' WHERE `oo_users`.`login` = '{$login}';");

		if ($loginAuto) {
			$result = $this->login($login, $password);
		}

		return $result;
	}

	public function login($login, $password) : bool {
		if (!$this->_database->connected()) {
			$this->error = "Connect error";
			$this->logout();
			return false;
		}

		$prefix = $this->_database->stringSafe(DATABASE_PREFIX);
		$login = $this->_database->stringSafe($login);
		$password = $this->_database->stringSafe($password);

		$result = $this->_database->execute("SELECT * FROM `{$prefix}users` WHERE `login` = '{$login}'");
		if ($result->num_rows !== 1) {
			$this->error = "Incorrect login or password (l)";
			$this->logout();
			return false;
		}

		$result = $this->_database->associativeArrayGet($result);

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

		$token = $this->_database->stringSafe($_SESSION['auth']['token']);
		$ip = ip2long($_SERVER['REMOTE_ADDR']);
		$id = $this->_database->stringSafe($this->id);

		$result = $this->_database->execute("UPDATE `{$prefix}users` SET `token`='{$token}', `ip`='{$ip}' WHERE `id` = '{$id}'");
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

//		$result = $this->_database->execute("UPDATE `{$prefix}users` SET `token`='', `ip`='{$ip}' WHERE `id` = '{$id}'");

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