
<?php
	$product_num = empty($_REQUEST["product_num"]) ? '' : $_REQUEST["product_num"];
	$category_num = empty($_REQUEST["category_num"]) ? '' : $_REQUEST["category_num"];
	
	require("db_connect.php");
	if ($product_num){
	$db->exec("delete from products where product_num=$product_num");
		
		header("Location:product_manage.php");
		exit();
	} else if ($category_num) {
		$db->exec("delete from categorys where category_num=$category_num");
		
		header("Location:product_manage.php");
		exit();
	}
	
?>
