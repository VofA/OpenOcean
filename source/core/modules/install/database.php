<?php

require_once(PATH_CLASSES . 'Database.php');
require_once(PATH_CLASSES . 'Config.php');

$data['host']           = $_POST["host"]           ?? null;
$data['username']       = $_POST["username"]       ?? null;
$data['password']       = $_POST["password"]       ?? null;
$data['name']           = $_POST["name"]           ?? null;
$data['prefix']         = $_POST["prefix"]         ?? null;
$data['port']           = $_POST["port"]           ?? null;
$data['createDatabase'] = $_POST["createDatabase"] ?? null;

foreach ($data as $key => $value) {
	if ($value === '') {
		$data[$key] = null;
	}
}

$database = new OoDatabase();

$result = $database->connectCustom(
	$data['host'],
	$data['username'],
	$data['password'],
	$data['port']
);

if (!$result) {
	$data = array(
		'status' => false,
		'error' => 'Connection error'
	);
	exit(json_encode($data));
}

$config = new OoConfig();
$config->load();

$path = explode('/', $_SERVER['REQUEST_URI']);
unset($path[count($path) - 1]);
$path = implode('/', $path);
$path .= '/';

$config->change('URL_ROOT',          $path);
$config->change('DATABASE_HOST',     $data['host']);
$config->change('DATABASE_USERNAME', $data['username']);
$config->change('DATABASE_PASSWORD', $data['password']);
$config->change('DATABASE_PORT',     $data['port']);
$config->save();

if ($data['createDatabase']) {
	$database->databaseCreate($data['name']);
}

$result = $database->databaseSet($data['name']);

if (!$result) {
	$data = array(
		'status' => false,
		'error' => 'Database does not exist'
	);
	exit(json_encode($data));
}

$config->change('DATABASE_PREFIX', $data['prefix']);
$config->change('DATABASE_NAME', $data['name']);
$config->save();

$columns = array(
	"`id` INT UNSIGNED NOT NULL AUTO_INCREMENT",
	"`login` VARCHAR(64) NOT NULL",
	"`email` VARCHAR(254) NOT NULL",
	"`ip` INT UNSIGNED NOT NULL",
	"`register` TIMESTAMP NOT NULL",
	"`password` VARCHAR(128) NOT NULL",
	"`token` VARCHAR(128)",
	"`salt` VARCHAR(128)",
	"PRIMARY KEY (`id`)",
	"INDEX (`login`)",
	"INDEX (`email`)"
);

$result = $database->tableCreate($data['name'], $data['prefix'] . 'users', $columns);

if (!$result) {
	$data = array(
		'status' => false,
		'error' => 'Table create error'
	);
	exit(json_encode($data));
}

$data = array(
	'status' => true
);
exit(json_encode($data));