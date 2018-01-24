<!DOCTYPE html>
<html>
<head>
	<title>Material Components for the web</title>
	<link rel="stylesheet" href="theme/styles/material-components-web.min.css">
	<link rel="stylesheet" href="theme/styles/material-icons.css">
</head>
<body class="mdc-typography">
	<h2 class="mdc-typography--display2">Hello, Material Components!</h2>
	<div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
		<input type="text" class="mdc-text-field__input" id="demo-input">
		<label for="demo-input" class="mdc-text-field__label">Tell us how you feel!</label>
	</div>
	<a href="auth_test.php">Auth test</a>
	<div class="mdc-switch">
		<input class="mdc-switch__native-control" type="checkbox">
		<div class="mdc-switch__background">
			<div class="mdc-switch__knob"></div>
		</div>
	</div>
	<i class="material-icons">account_box</i>


<details class="mdl-expansion">
  <summary class="mdl-expansion__summary">
    <span class="mdl-expansion__header">Trip name</span>
    <span class="mdl-expansion__secondary-content">Caribbean Cruise</span>
  </summary>
</details>
<details class="mdl-expansion">
  <summary class="mdl-expansion__summary">
    <span class="mdl-expansion__header">Location</span>
    <span class="mdl-expansion__secondary-content">Barbados</span>
  </summary>
  
  <div class="mdl-expansion__content">
    <select>
      <option>One</option>
      <option>two</option>
    </select>
  </div>
  <div class="mdl-expansion__actions">
    <button class="mdl-expansion__action">Save</button>
    <button class="mdl-expansion__action">Cancel</button>
  </div>
</details>

<details class="mdl-expansion">
  <summary class="mdl-expansion__summary">
    <span class="mdl-expansion__header">Carrier</span>
    <span class="mdl-expansion__secondary-content">The best cruise line</span>
  </summary>
</details>
<details class="mdl-expansion">
  <summary class="mdl-expansion__summary">
    <span class="mdl-expansion__header">
      Meal preferences
      <span class="mdl-expansion__subheader">
        Optional
      </span>
    </span>
    <span class="mdl-expansion__secondary-content">
      Vegetarian
    </span>
  </summary>
</details>

	<script src="theme/styles/material-components-web.min.js"></script>
	<script>mdc.autoInit()</script>
</body>
</html>