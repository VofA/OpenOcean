<?php

/**
* OpenOcean - Debug class
*
* @copyright 2018 Danil Dumkin
*/

class OoDebug {
	public static function print($var) {
		if (DEBUG_ENABLE) {
			$style = 
			"white-space: pre-wrap;" .
			"margin: 5px;" .
			"box-sizing: content-box;" .
			"border: 1px solid black;" .
			"padding: 5px;" .
			"display: block;" .
			"font-family: monospace;";

			echo '<pre style="' . $style . '">';
			var_dump($var);
			echo '</pre>';
		}
	}
}

?>