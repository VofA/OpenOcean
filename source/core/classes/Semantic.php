<?php

/**
* OpenOcean - Semantic class
*
* @copyright 2018 Danil Dumkin
*/

class OoSemantic {
	public function prepare($url) {
		//$url = $this->addIndex($url);

		$url = explode('?', $url)[0];

		$url = str_replace(URL_ROOT, '', $url);

		if ($url === 'install') {
			return PATH_MODULES . 'install/init.php';
		}
		if ($url === 'admin') {
			return PATH_MODULES . 'admin/init.php';
		}

		$url = PATH_PUBLIC_HTML . $url;

		return $url;
	}

	public function addIndex($url) {
		if (substr($url, -1) == '/') {
			$url .= 'index.php';
		}

		return $url;
	}
}