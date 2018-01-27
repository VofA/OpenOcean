<?php

/**
* OpenOcean - File class
*
* @copyright 2018 Danil Dumkin
*/

class OoFile {
	private $data;
	private $error;

	private $fileName;
	private $fileSize;
	private $fileType;

	// Default 1 megabyte
	private $maxSize = 1048576;

	public function __construct($data) {
		$this->data = $data;

		$this->fileName = $this->data['tmp_name'];
		$this->fileSize = $this->data['size'];
		$this->fileType = $this->data['type'];
	}

	public function maxSizeSet($size) {
		$this->maxSize = $size;
	}

	public function errorCheck() : bool {
		$this->error = isset($this->data['error']) ? $this->data['error'] : UPLOAD_ERR_NO_FILE;

		if ($this->error) {
			return false;
		}

		if ($this->fileSize > $this->maxSize) {
			$this->error = UPLOAD_ERR_FORM_SIZE;
			return false;
		}

		return true;
	}

	public function errorGet() : string {
		return $this->errorParse();
	}

	public function getFile() {
		return file_get_contents($this->fileName);
	}

	public function getFileName() : string {
		return $this->fileName;
	}

	public function getFileSize() : string {
		return $this->fileSize;
	}

	public function getFileType() : string {
		return $this->fileType;
	}

	public function fileMove($path) : bool {
		return move_uploaded_file($this->fileName, PATH_PUBLIC_HTML . $path);
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
}