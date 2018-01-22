<?php

/**
* OpenOcean - Template class
*
* @copyright 2018 Danil Dumkin
*/

require_once(PATH_CLASSES . 'Translate.php');

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
		$this->translate->parse();
		$this->content = $this->translate->get();

		foreach ($this->data as $key => $value) {
			$this->content = str_replace('{' . $key . '}', $value , $this->content);
		}
	}

	function get() {
		return $this->content;
	}
}