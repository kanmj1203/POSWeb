<?php
	session_start();
	
	$username = empty($_REQUEST["username"]) ? "" : $_REQUEST["username"];
	$userid = empty($_REQUEST["userid"]) ? "" : $_REQUEST["userid"];
	$userpw = "";
	$userpwCheck = "";
	$useremail = "";
	$tel1 = "";
	$tel2 = "";
	$tel3 = "";
	$usertel = $tel1.$tel2.$tel3;
	$titleText = "회원 가입";
	$idOption = "";
	$action = "member_join.php?username=$username&userid=$userid&userpw=$userpw&useremail=$useremail&usertel=$usertel";
	
		
	if($userid) {
		require("db_connect.php");
		$query = $db->query("select * from member where username = '$username' and userid = '$userid'");
		if ($row = $query->fetch()){
			$action = "member_update.php?username=$username&userpw=$userpw&useremail=$useremail&usertel=$usertel";
			$userpw = $row["userpw"];
			$useremail = $row["useremail"];
			$tel1 = substr($row["usertel"], 0, 3);
			$tel2 = substr($row["usertel"], 3, 4);
			$tel3 = substr($row["usertel"], 7, 4);
			$usertel = $tel1.$tel2.$tel3;
			$titleText = "회원 정보 수정";
			$idOption = "readonly";
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
				 <th>이름</th>
				 <td class="right"><input type="text" name="username" value="<?=$username?>"></td>
			 </tr>
			 <?php
				 if ($userid){
					 ?>
			 <tr class="col4">
				 <th>아이디</th>
				 <td><input type="text" name="userid" readonly id="id" value="<?=$userid?>"></td>
			 </tr>
				 <?php
				 } else {
					 ?>
				 <tr class="col3">
					<th>아이디</th>
					<td><input type="text" name="userid" id="id" value="<?=$userid?>"></td>
					<td><input type="button" value="중복확인" id="overlapCheck"></td>
				</tr>
				 <?php
				 }
				 ?>
				 
			 <tr class="col3">
				 <th>비밀번호</th>
				 <td><input type="password" name="userpw"  value="<?=$userpw?>"></td>
			 </tr>
			 <tr class="col3">
				 <th>비밀번호 확인</th>
				 <td><input type="password" name="pwCheck"></td>
			 </tr>
			 <tr class="col3">
				 <th>이메일</th>
				 <td><input type="text" name="useremail"  value="<?=$useremail?>"></td>
			 </tr>
			 <tr class="col3">
				 <th>전화번호</th>
				 <td><input type="text" name="tel1"  value="<?=$tel1?>" class="phone"></td>
				 <td> - <input type="text" name="tel2"  value="<?=$tel2?>" class="phone"></td>
				 <td> - <input type="text" name="tel3"  value="<?=$tel3?>" class="phone"></td>
			 </tr>
		</table>
			<div id="member_bottom_button">
				<input type="submit" value="확인" id="left">
				<input type="button" value="취소" onclick="history.back()">
			</div>
		
	 </form>
</main>
 </body>
 </html>
