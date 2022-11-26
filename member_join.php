
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<?php 
    $username = $_REQUEST["username"];
    $userid = $_REQUEST["userid"];
    $userpw = $_REQUEST["userpw"];
	$pwCheck = $_REQUEST["pwCheck"];
	$useremail = $_REQUEST["useremail"];
	$usertel = $_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"];
	
        require("db_connect.php");
    
        //$query = $db->query("select * from login where id='$id' and pw='$pw'");
        if ($username && $userid && $userpw && $useremail && $usertel && $userpw == $pwCheck) {
            session_start();
            
            $query = $db->exec("insert into member (username, userid, userpw, useremail, usertel)
			values ('$username', '$userid', '$userpw', '$useremail', '$usertel')");
            
			
?>
				<div id="login_box">
					<div class = "title">회원가입 완료</div>
					<table id="member_join_complete">
					<tr>
						<td id="member_complete"><input type="button" value="확인" onclick="location.href='login_main.php'"></td>
					</tr>
					</table>
				</div>
<?php
	} else
?>
	<script>
<?php
	if (!($username && $userpw && $pwCheck && $useremail && $usertel && $userpw)){
?>		
		alert("빈 칸 없이 입력해주세요.");
		history.back();
<?php	
	} else if ($userpw != $pwCheck){
?>
		alert('비밀번호가 일치하지 않습니다.');
		history.back();
<?php
	} 
?>
	</script>
</body>
</html>
