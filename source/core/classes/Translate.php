<?php

/**
* OpenOcean - Translate class
*
* @copyright 2018 Danil Dumkin
*/

class OoTranslate {
	private $content = "";
	private $language = array();

	function __construct($content, $lang) {
		$this->content = $content;

		$languageJson = file_get_contents($lang);
		$language = (array) json_decode($languageJson);

		$this->language = $language;
	}

	function parse() {
		foreach ($this->language as $key => $value) {
			$this->content = str_replace('{' . $key . '}', $value , $this->content);
		}
	}

	function get() {
		return $this->content;
	}
}