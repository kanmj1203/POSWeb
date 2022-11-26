
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
		
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<?php
	$username = empty($_REQUEST["username"]) ? "" : $_REQUEST["username"];
	
	$userid = empty($_REQUEST["userid"]) ? "" : $_REQUEST["userid"];
	
	$usertel = empty($_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"]) ?
	"" : 
	$_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"];
	
	$useremail = empty($_REQUEST["useremail"])? "" : $_REQUEST["useremail"];
	
	if ($username && $usertel && $useremail){

	require("db_connect.php");
	$check = $db->query("select * from member where username = '$username' and usertel = $usertel and useremail = '$useremail'");
	$row = $check->fetch();
		if ($row) {
?>
 <main id="login_box">
	<div><h1 class = "title">비밀번호 변경</h1></div>
	<form action = "member_pw_change.php?userid=<?=$userid?>" method="post">
	<table id="member_main3">
			<tr class="col3">
				 <th>새 비밀번호</th>
				 <td><input type="password" name="userpw"></td>
			 </tr>
			 <tr class="col3">
				 <th>비밀번호 확인</th>
				 <td><input type="password" name="pwCheck"></td>
			 </tr>
			 </table>
				<div id="member_bottom_button">
				<input type="submit" value="확인" id="left">
				<input type="button" value="취소" onclick="history.back()">
			</div>
		 
	</form>
	</main>
<?php
		} else {
		?>
		<script>
			alert("등록된 회원 정보가 존재하지 않거나 일치하지 않습니다.");
			history.back();
		</script>
<?php
		}
	}	else if (empty($username && $usertel && $useremail)) {
		?>		
		<script>
			alert("빈 칸 없이 입력해주세요.");
			history.back();
		</script>
<?php	
	} 
	?>

</body>
</html>
