<?php

define('OPEN_OCEAN_VERSION', '0.0.1');
define('OPEN_OCEAN_INSTALLED', true);

define('HEADERS_X_POWERED_BY', false);

define('TELEMETRY_ENABLE', false);

define('PATH_ROOT', __DIR__ . '/../'); {
	define('PATH_CORE', PATH_ROOT . 'core/'); {
		define('PATH_LIBRARIES', PATH_CORE . 'libraries/');
	}
	define('PATH_LOGS', PATH_ROOT . 'logs/');
	define('PATH_THEMES', PATH_ROOT . 'themes/');
	define('PATH_PUBLIC_HTML', PATH_ROOT . 'public_html/'); {
		define('PATH_INSTALL', PATH_PUBLIC_HTML . 'install/');
	}
}

define('DEBUG_ENABLE', true);

define('DATABASE_HOST', 'localhost');
define('DATABASE_USERNAME', 'root');
define('DATABASE_PASSWORD', null);
define('DATABASE_PREFIX', 'oo_');
define('DATABASE_NAME', null);
define('DATABASE_PORT', null);

/**
 * Security guarantors
 */
define('SG_USE_IP', true);