<?php

/**
* OoFile class
*
* @copyright 2017 Danil Dumkin
*/

class OoFile {
	private $_FILE;
	private $error;

	private $file;
	private $fileSize;

	public function __construct($file) {
		$this->_FILE = $file;
	}

	public function check() : bool {
		$this->error = isset($this->_FILE['error']) ? $this->_FILE['error'] : UPLOAD_ERR_NO_FILE;

		if ($this->error) {
			return false;
		} else {
			$this->file = $this->_FILE['tmp_name'];
			$this->fileSize = $this->_FILE['size'];

			if ($this->fileSize > 5242880) {
				$this->error = UPLOAD_ERR_FORM_SIZE;
				return false;
			}
		}

		return true;
	}

	private function errorParse() : string {
		switch ($this->error) {
			case UPLOAD_ERR_NO_FILE:
				return "File not select";
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				return  "File too big";
			case UPLOAD_ERR_PARTIAL:
				return  "Upload not complete";
			case UPLOAD_ERR_EXTENSION:
				return  "Bad file extension";
			case UPLOAD_ERR_NO_TMP_DIR:
			case UPLOAD_ERR_CANT_WRITE:
				return  "Internal upload error";
			default:
				return  "Unknown upload error";
		}
	}

	public function errorGet() : string {
		return $this->errorParse();
	}

	public function getFile() {
		return file_get_contents($this->file);
	}
}
?>