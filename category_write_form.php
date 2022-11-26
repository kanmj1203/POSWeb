<?php
	 session_start();
	
	$user_num = $_SESSION["user_num"];
	$product_type = empty($_REQUEST["product_type"]) ? '' : $_REQUEST["product_type"];

	$titleText = "카테고리 추가하기";
	
	$action = "category_insert.php?category_name=$product_type";
		
	if($product_type) {
		require("db_connect.php");
		$query = $db->query("select * from categorys where category_name = '$product_type' and user_num = $user_num");
		if ($row = $query->fetch()){
			//$action = "member_update.php?username=$username&userpw=$userpw&useremail=$useremail&usertel=$usertel";
			$category_num = $row["category_num"];
			$action = "category_update.php?category_name=$product_type&category_num=$category_num";
			$titleText = "카테고리 수정하기";
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
	<div><h1 class = "title"><?=$titleText?></h1></div>
	 <form action="<?=$action?>" method="post">
		 <table id="member_main">
			 <tr class="col3">
				 <th>카테고리명</th>
				 <td class="right"><input type="text" name="category_name" value="<?=$product_type?>"></td>
			 </tr>	
			 
		</table>
			<div id="member_bottom_button">
				<?php
				if($product_type){
					?>
				<input type="button" value="삭제" onclick="location.href='manage_delete.php?category_num=<?=$category_num?>'" id="left">
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
