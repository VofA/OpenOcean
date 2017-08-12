<?php

/**
* OoTemplate class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/OoTranslate.php");

class OoTemplate {
	private $content = "";
	private $lang = "";
	private $data = array();

	private $translate;

	function __construct($content, $data, $lang) {
		$this->content = $content;
		$this->data = $data;
		$this->lang = $lang;

		$this->translate = new OoTranslate($this->content, $this->lang);
	}

	function parse() {
		foreach ($this->data as $key => $value) {
			$this->content = str_replace('{' . $key . '}', $value , $this->content);
		}

		$this->translate->parse();
		$this->content = $this->translate->get();
	}

	function get() {
		return $this->content;
	}
}
?>