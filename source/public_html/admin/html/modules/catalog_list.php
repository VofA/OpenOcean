<?php

$result = $MySQLi->execute("SELECT * FROM `izh_category`");

$cats = array();

while($cat = $MySQLi->fetch_assoc($result))
	$cats[$cat['PARENT_ID']][] = $cat;
function getCountCatalog($ID)
{
	echo "string";
	//$count = $MySQLi->fetch_assoc($MySQLi->execute("SELECT COUNT(*) FROM `izh_category` WHERE `PARENT_ID` = '$ID'"));
	//$count = $MySQLi->fetch_assoc($MySQLi->execute("SELECT COUNT(*) FROM `izh_category`"));
	var_dump($MySQLi->fetch_assoc($MySQLi->execute("SELECT * FROM `izh_category`")));
	echo "string";
	//return $count['COUNT(*)'];
}
function create_tree($cats,$parent_id) {
	if(is_array($cats) and isset($cats[$parent_id])) {
		$tree = '<ul>';
		foreach($cats[$parent_id] as $cat){
			if($cat['TYPE'] == "CATALOG") {
				if(getCountCatalog($cat['ID']) == 0) {
					$delete = "<a href='index.php?page=catalog_delete&id=".$cat['ID']."'><i class='fa fa-trash'></i></a>";
				}
				else {
					$delete = "";
				}
				$tree .= "<li>
						<i class='fa fa-folder-open' aria-hidden='true'></i> <a href='index.php?page=catalog_edit&id=".$cat['ID']."'>".$cat['NAME']."</a>
						<a href='index.php'><i class='fa fa-plus'></i></a> " . $delete;
				$tree .=  create_tree ($cats,$cat['ID']);
				$tree .= '</li>'; 
			} else {
				$tree .= "<li>
						<i class='fa fa-file' aria-hidden='true'></i> <a href='index.php?page=catalog_edit&id=".$cat['ID']."'>".$cat['NAME']."</a>
						<a href='index.php?page=catalog_delete&id=".$cat['ID']."'><i class='fa fa-trash'></i></a>";
				$tree .=  create_tree ($cats,$cat['ID']);
				$tree .= '</li>'; 
			}
			        
		}
		$tree .= '</ul>';
	} 
	else return null;          
	return $tree;        
} 
include("html/index.php");
?>
<h1>Дерево каталогов</h1>

<style>li{list-style-type:none}#catalog ul{padding-left:20px}</style>

<div id="catalog">
	<?=create_tree($cats, 0)?>
</div>

</div></body></html>