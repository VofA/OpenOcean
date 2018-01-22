<?php

/**
* OpenOcean - Semantic class
*
* @copyright 2018 Danil Dumkin
*/

class OoSemantic {
	public function prepare($path) {
		$path = PATH_ROOT . "../.." . $path;

		if (substr($path, -1) == '/') {
			$path .= 'index.php';
		}

		$path = explode('?', $path)[0];

		return $path;
	}
}