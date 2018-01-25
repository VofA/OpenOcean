<?php

/**
* OpenOcean - Compile class
*
* @copyright 2018 Danil Dumkin
*/
/*
class OoCompile {
	public function buildAll() {
		if (!is_dir(PATH_CACHE_STYLES)) {
			mkdir(PATH_CACHE_STYLES);
		}

		if (!is_dir(PATH_CACHE_SCRIPTS)) {
			mkdir(PATH_CACHE_SCRIPTS);
		}

		if (!is_dir(PATH_CACHE_PICTURES)) {
			mkdir(PATH_CACHE_PICTURES);
		}

		$this->minifyStyles();

		$this->prepareTemplates();
	}

	private function minifyStyles() {
		$filePaths = glob(PATH_STYLES . "*.css");
		dDebug::print($filePaths);

		foreach ($filePaths as $filePath) {
			$this->minifyStyle($filePath);
		}
	}

	private function minifyStyle($filePath) {
		$fileName = str_replace(PATH_STYLES, '', $filePath);
		dDebug::print($fileName);

		$data = file_get_contents($filePath);

		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => 'https://cssminifier.com/raw',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"],
			CURLOPT_POSTFIELDS => http_build_query([ "input" => $data ])
		]);

		$result = curl_exec($curl);

		curl_close($curl);

		if (!is_dir(PATH_CACHE_STYLES)) {
			mkdir(PATH_CACHE_STYLES);
		}

		file_put_contents(PATH_CACHE_STYLES . $fileName, $result, LOCK_EX);
	}

	private function prepareTemplates() {
		$filePaths = glob(PATH_TEMPLATES . "*.php");
		dDebug::print($filePaths);

		foreach ($filePaths as $filePath) {
			$this->prepareTemplate($filePath);
		}
	}

	private function prepareTemplate($filePath) {
		$fileName = str_replace(PATH_TEMPLATES, '', $filePath);
		dDebug::print($fileName);

		$data = file_get_contents($filePath);

		preg_match_all('*~template;styles;([^~]+)~*', $data, $stylesName);
		dDebug::print($stylesName);

		$stylesData = [];

		foreach ($stylesName[1] as $key => $value) {
			$stylesData[$key] = file_get_contents(PATH_THEMES . 'styles/' . $value . '.css');
		}
		
		foreach ($stylesName[0] as $key => $value) {
			$data = str_replace($value, '<style>' . $stylesData[$key] . '</style>', $data);
		}

		file_put_contents(PATH_PUBLIC_HTML . $fileName, $data, LOCK_EX);
	}
}
*/