<?php

/**
* OpenOcean - Header class
*
* @copyright 2018 Danil Dumkin
*/

class OoHeader {
	public static function safe() {
		if (!HEADERS_X_POWERED_BY) {
			header_remove('X-Powered-By');
			header("X-Powered-By: Open Ocean Engine");
		}
	}
}