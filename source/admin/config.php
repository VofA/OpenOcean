<?php

/**
 * OpenOcean constants
 */
define('OO_ROOT', __DIR__ . '/../');
define('OO_ADMIN', OO_ROOT . 'admin/');
define('OO_INCLUDES', OO_ADMIN . 'includes/');

/**
 * Data to connect to the database
 */
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', null);
define('DB_PREFIX', 'oo_');
define('DB_NAME', null);
define('DB_PORT', null);

/**
 * Security guarantors
 */
define('SG_USE_IP', true);