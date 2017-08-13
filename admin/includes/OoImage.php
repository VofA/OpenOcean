<?php

/**
* OoImage class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/OoFile.php");

class OoImage {
	private $width;
	private $height;

	private $OoFile;

	private $file;

	public function __construct($file) {
		$this->file = $file;
		$this->OoFile = new OoFile($file);
	}

	public function check() : bool {
		if (!$this->OoFile->check()) {
			return false;
		}

		$imageSize = getimagesize($this->file['tmp_name']);

		if ($imageSize) {
			$this->width = $imageSize[0];
			$this->height = $imageSize[1];
		}

		if ($this->width < 64 || $this->width > 512 ||
			$this->height < 64 || $this->height > 512) {

			return false;
		}

		return true;
	}

	public function errorGet() {
		return $this->OoFile->errorGet();
	}

	public function getImage() {
		return $this->OoFile->getFile();
	}
}
?>