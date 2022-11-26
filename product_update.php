
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<?php 
	 session_start();
	$user_num = $_SESSION["user_num"];
    $product_name = $_REQUEST["product_name"];
    $product_price = $_REQUEST["product_price"];
    $product_type = $_REQUEST["product_type"];
	$category_type = $_REQUEST["category_type"];
	$product_num = $_REQUEST["product_num"];
	
        require("db_connect.php");
    
        //$query = $db->query("select * from login where id='$id' and pw='$pw'");
        if ($product_name && $product_price && $product_type && $category_type) {

            $query = $db->exec("update products set product_name = '$product_name', product_price=$product_price
			, product_type='$product_type', category_type='$category_type' where product_num = $product_num");
			
			header("Location:product_manage.php");
			exit();

		}
?>
	<script>
<?php
	if (!($product_name && $product_price && $product_type && $category_type)){
?>		
		alert("빈 칸 없이 입력해주세요.");
		history.back();
<?php	
	} 
	
	?>
	</script>
</body>
</html>
