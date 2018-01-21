<?php

/**
* OpenOcean - Semantic class
*
* @copyright 2018 Danil Dumkin
*/

class OoSemantic {
	public function prepare($path) {
		$path = PATH_PUBLIC_HTML . $path;

		if (substr($path, -1) == '/') {
			$path .= 'index.php';
		}

		return $path;
	}
}