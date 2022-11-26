<?php
	 session_start();
	
	$user_num = $_SESSION["user_num"];
	$product_type = empty($_REQUEST["product_type"]) ? '' : $_REQUEST["product_type"];
	$product_num = empty($_REQUEST["menu"]) ? '' : $_REQUEST["menu"];
	$category_type = empty($_REQUEST["category_type"]) ? '' : $_REQUEST["category_type"];
	//require("db_connect.php");
	$titleText = "추가하기";
	
	$product_name = '';
	$product_price = 0;
	$action = "product_insert.php?product_name=$product_name&product_price=$product_price&product_type=$product_type&category_type=$category_type";

		
	if($product_num) {
		require("db_connect.php");
		$query = $db->query("select * from products where product_num = $product_num and user_num = $user_num");
		if ($row = $query->fetch()){
			//$action = "member_update.php?username=$username&userpw=$userpw&useremail=$useremail&usertel=$usertel";
			$action = "product_update.php?product_name=$product_name&product_price=$product_price&product_type=$product_type&category_type=$category_type&product_num=$product_num";

			$product_name = $row["product_name"];
			$product_price = $row["product_price"];
			$product_type = $row["product_type"];
			$category_type = $row["category_type"];
			$titleText = "수정하기";
		}
	}
?>
 <!doctype html>
 <html>
 <head>
     <meta charset="utf-8">
	 
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
 </head>
 <body>
 
 <main id="login_box">
	<div><h1 class = "title"><?=$category_type , $titleText?></h1></div>
	 <form action="<?=$action?>" method="post">
		 <table id="member_main">
			 <tr class="col3">
				 <th>제품명</th>
				 <td class="right"><input type="text" name="product_name" value="<?=$product_name?>"></td>
			 </tr>	 
			 <tr class="col3">
				 <th>가격</th>
				 <td><input type="text" name="product_price"  value="<?=$product_price?>"></td>
			 </tr>
			 <tr class="col3">
				 <th>카테고리</th>
				 <?php
				 if ($category_type == '옵션'){
					 ?>
					 <td><input readonly type="text" name="product_type" value="추가"></td>
				 <?php
				 } else { 
				 ?>
				 <td><input type="text" name="product_type" value="<?=$product_type?>"></td>
				 <?php
				 }
				 ?>
			 </tr>
			 <tr class="col3">
				 <th>상품 타입</th>
				 <td><input readonly type="text" name="category_type"  value="<?=$category_type?>"></td>
			 </tr>

		</table>
			<div id="member_bottom_button">
				<?php
				if($product_num){
					?>
				<input type="button" value="삭제" onclick="location.href='manage_delete.php?product_num=<?=$product_num?>'" id="left">
				<?php
				}
				?>
				<input type="submit" value="확인" id="left">
				<input type="button" value="취소" onclick="history.back()">
				
			</div>
		
	 </form>
</main>
 </body>
 </html>
