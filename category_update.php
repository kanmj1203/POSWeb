
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
	$category_name = $_REQUEST["category_name"];
	$category_num = $_REQUEST["category_num"];
	
        require("db_connect.php");
    
        if ($category_name) {

            $db->exec("update categorys set category_name = '$category_name' where category_num = $category_num");
			
			header("Location:product_manage.php");
			exit();

		}
?>
	<script>
<?php
	if (!($category_name)){
?>		
		alert("빈 칸 없이 입력해주세요.");
		history.back();
<?php	
	} 
	
	?>
	</script>
</body>
</html>
