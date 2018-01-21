<?php

//$tree = $MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_category`"));
/*
function delete_tree($ID) {
	$result = $MySQLi->execute("SELECT * FROM `izh_category` WHERE `PARENT_ID` = '$ID'");
	/while($cat = $MySQLi->fetch_assoc($result))
		delete_tree($cat['ID'])/
	$MySQLi->execute("DELETE FROM `izh_category` WHERE `ID` = '$ID'");
}

delete_tree($_GET['id']);
*/

$tree123 = $MySQLi->fetch_assoc($MySQLi->execute("SELECT COUNT(*) FROM `izh_category` WHERE `PARENT_ID` = '2'"));
var_dump($tree123["COUNT(*)"]);
include("html/index.php");
?>



</div></body></html>