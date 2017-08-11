<?php

require_once('../admin/includes/OoTemplate.php');

$languagesAvailableJson = file_get_contents('languages/available.json');
$languagesAvailable = (array) json_decode($languagesAvailableJson);

$languagesDefault = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if (!in_array($languagesDefault, $languagesAvailable)){
    $languagesDefault = 'en';
}

$languageSelect = "";
foreach ($languagesAvailable as $key => $value) {
	if ($value != $languagesDefault) {
		$languageSelect .= "<option>$key</option>";
	} else {
		$languageSelect .= "<option selected>$key</option>";
	}
}

$templateData = array(
	'languageSelect' => $languageSelect,
	'languagesDefault' => $languagesDefault,
	'languagesAvailableJson' => $languagesAvailableJson
	);

$templateFile = file_get_contents('assets/html/index.html');
$template = new OoTemplate($templateFile, $templateData);
$template->parse();
echo($template->get());

?>