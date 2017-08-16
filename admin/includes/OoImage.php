<?php

/**
* OoImage class
*
* @copyright 2017 Danil Dumkin
*/

require_once(__DIR__ . "/OoFile.php");

class OoImage extends OoFile {
	private $imageWidth;
	private $imageHeight;

	private $error = null;

	public function errorCheck() : bool {
		if (parent::errorCheck() === false) {
			return false;
		}

		$imageSize = getimagesize($this->getFileName());

		if ($imageSize) {
			$this->imageWidth = $imageSize[0];
			$this->imageHeight = $imageSize[1];
		}

		if ($this->imageWidth < 64 || $this->imageWidth > 512 ||
			$this->imageHeight < 64 || $this->imageHeight > 512) {

			$this->error = "Invalid image size";

			return false;
		}

		return true;
	}

	public function errorGet() : string {
		if ($this->error !== null) {
			return $this->error;
		}
		return parent::errorGet();
	}

	public function imageWidthGet() {
		return $this->imageWidth;
	}

	public function imageHeightGet() {
		return $this->imageHeight;
	}

	public function imageWidthSet($value) {
		$this->imageWidth = $value;
	}

	public function imageHeightSet($value) {
		$this->imageHeight = $value;
	}

}
?>