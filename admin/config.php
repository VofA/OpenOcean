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
define('SG_SALT_AUTH', '4Y87g9XRN+j=/YqG`|NwC(M=mrX[C OcTY@hsO_>G`?ez$~20Gdz[A<`*NU:Gsay');