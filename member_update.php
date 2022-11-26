
<?php 
    session_start();
?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <meta charset="utf-8">
</head>
<body>

<?php 
	$username =  empty($_REQUEST["username"]) ? "" : $_REQUEST["username"];
    $userpw   =  empty($_REQUEST["userpw"]) ? "" : $_REQUEST["userpw"];
	$pwCheck = empty($_REQUEST["pwCheck"]) ? "" : $_REQUEST["pwCheck"];
	$userid =  empty($_REQUEST["userid"]) ? "" : $_REQUEST["userid"];
	$useremail =  empty($_REQUEST["useremail"]) ? "" : $_REQUEST["useremail"];
	$usertel =  empty($_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"]) ? "" : $_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"];
    
	if ($username && $userpw && $pwCheck && $userid && $useremail && $_REQUEST["tel1"] && $_REQUEST["tel2"] && $_REQUEST["tel3"]) {
		if ($userpw == $pwCheck){
		require("db_connect.php");
		$db->exec("update member set username='$username', userpw='$userpw', useremail='$useremail', usertel='$usertel' where userid='$userid'");
            
            $_SESSION["name"] = $username;
?>   
				<div id="login_box">
					<div class = "title">회원정보 수정 완료</div>
					<table id="member_main2">
					<tr>
						<td id="member_complete"><input type="button" value="확인" onclick="location.href='order_main.php'"></td>
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
