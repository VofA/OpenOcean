<?php

require_once("init.php");

?><!DOCTYPE html>
<html>
<head>
	<title>Material Components for the web</title>
	<link rel="stylesheet" href="assets/styles/material-components-web.min.css">
	<link rel="stylesheet" href="assets/styles/material-icons.css">
</head>
<body class="mdc-typography">
	<h2 class="mdc-typography--display2">Hello, Material Components!</h2>
	<div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
		<input type="text" class="mdc-text-field__input" id="demo-input">
		<label for="demo-input" class="mdc-text-field__label">Tell us how you feel!</label>
	</div>
	<div class="mdc-switch">
		<input class="mdc-switch__native-control" type="checkbox">
		<div class="mdc-switch__background">
			<div class="mdc-switch__knob"></div>
		</div>
	</div>
	<i class="material-icons">account_box</i>
	<script src="assets/styles/material-components-web.min.js"></script>
	<script>mdc.autoInit()</script>
</body>
</html>