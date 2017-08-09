<?php

/**
 * OoTemplate class
 *
 * @copyright 2017 Danil Dumkin
 */

class OoTemplate {
	private $content = "";
	private $data = array();

	function __construct($string, $data) {
		$this->content = $string;
		$this->data = $data;
	}

	function parse() {
		foreach ($this->data as $key => $value) {
			$this->content = str_replace('{' . $key . '}', $value , $this->content);
		}
	}

	function get() {
		return $this->content;
	}
}
?>