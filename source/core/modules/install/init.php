<?php

if (OPEN_OCEAN_INSTALLED) {
	header('Location: error/404/');
	exit;
}

if (isset($_GET['module'])) {
	require_once(PATH_MODULES . 'install/' . $_GET['module'] . '.php');
	exit;
}

require_once(PATH_CLASSES . 'Template.php');

$languagesAvailableJson = file_get_contents(PATH_PUBLIC_HTML . 'theme/languages/available.json');
$languagesAvailable = (array) json_decode($languagesAvailableJson);

$languagesDefault = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if (!in_array($languagesDefault, $languagesAvailable)){
	$languagesDefault = 'en';
}

$languageSelect = "";
foreach ($languagesAvailable as $key => $value) {
	if ($value != $languagesDefault) {
		$languageSelect .= "<option value='$value'>$key</option>";
	} else {
		$languageSelect .= "<option value='$value' selected>$key</option>";
	}
}

$templateData = array(
	'languageSelect' => $languageSelect
);

$templateFile = file_get_contents(PATH_PUBLIC_HTML . 'theme/templates/index.html');
$template = new OoTemplate($templateFile, $templateData, PATH_PUBLIC_HTML . "theme/languages/" . $languagesDefault . ".json");
$template->parse();

echo($template->get());