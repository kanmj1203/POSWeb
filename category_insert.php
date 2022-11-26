
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
	
        require("db_connect.php");
    
        if ($category_name) {
            
            $db->exec("insert into categorys (category_name, user_num) values ('$category_name', $user_num)");
			
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
