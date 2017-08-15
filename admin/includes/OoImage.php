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

	public function imageCheck() : bool {
		if (!$this->errorCheck()) {
			return false;
		}

		$imageSize = getimagesize($this->getFileName());

		if ($imageSize) {
			$this->imageWidth = $imageSize[0];
			$this->imageHeight = $imageSize[1];
		}

		if ($this->imageWidth < 64 || $this->imageWidth > 512 ||
			$this->imageHeight < 64 || $this->imageHeight > 512) {

			return false;
		}

		return true;
	}

	public function imageWidthGet() {
		return $this->imageWidth;
	}

	public function imageHeightGet() {
		return $this->imageHeight;
	}

}
?>