
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
		
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<?php
	$userpw = empty($_REQUEST["userpw"]) ? "" : $_REQUEST["userpw"];
	$pwCheck = empty($_REQUEST["pwCheck"]) ? "" : $_REQUEST["pwCheck"];
	$userid = $_REQUEST["userid"];
	if ($userpw && $pwCheck) {
		if ($userpw == $pwCheck) {
		require("db_connect.php");
		$db->exec("update member set userpw='$userpw' where userid='$userid'");
        
?>
				<div id="login_box">
					<div class = "title">비밀번호 변경 완료</div>
					<table id="member_main2">
					<tr>
						<td id="member_complete"><input type="button" value="확인" onclick="location.href='login_main.php'"></td>
					</tr>
					</table>
				</div>      				
<?php
		} else if ($pwCheck != $userpw) {
?>		
		<script>
			alert("비밀번호가 일치하지 않습니다.");
			history.back();
		</script>
<?php	
		}
	} else {
?>
	<script>
		alert('빈 칸 없이 입력해주세요.');
		history.back();
	</script>
<?php
	} 
?>
</body>
</html>
