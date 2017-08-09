<?php

require_once('../admin/includes/OoTemplate.php');

$languagesAvailableJson = file_get_contents('languages/available.json');
$languagesAvailable = (array) json_decode($languagesAvailableJson);

$languageSelect = "";
foreach ($languagesAvailable as $key => $value) {
	$languageSelect .= "<option value='$key'>$key</option>";
}

$templateData = array(
	'languageSelect' => $languageSelect,
	'languagesAvailableJson' => $languagesAvailableJson
	);

$templateFile = file_get_contents('assets/html/index.html');
$template = new OoTemplate($templateFile, $templateData);
$template->parse();
echo($template->get());

?>