<?php

/**
* OpenOcean - Security class
*
* @copyright 2018 Danil Dumkin
*/

///declare(strict_types = 1);

class OoSecurity {
	public static function safeBackticks(/*string*/ $value) /*: string*/ {
		return /*"'" . str_replace("'", "\'",*/ $value/*) . "'"*/;
	}
}