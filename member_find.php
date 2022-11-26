
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
	
	$usertel = empty($_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"]) ?
	"" : 
	$_REQUEST["tel1"].$_REQUEST["tel2"].$_REQUEST["tel3"];
	
	$useremail = empty($_REQUEST["useremail"])? "" : $_REQUEST["useremail"];
	
	if ($username && $usertel && $useremail){

	require("db_connect.php");
	$check = $db->query("select * from member where username = '$username' and usertel = $usertel and useremail = '$useremail'");

		if ($row = $check->fetch()) {
?>
	<div id="login_box">
		<div id="name"><h2><?=$row["username"]?>님의 보유 아이디입니다.</h2></div>	
		<div id="id_box">
<?php	
		$query = $db->query("select * from member where usertel = $usertel and username = '$username'");
			while ($id = $query->fetch()) {	
				$userid = $id["userid"];
?>
				<div id="id"><?=$userid?></div>
<?php	
			}	
?>
</div>
		<div id="member_complete"><input type="button" value="확인" onclick="location.href='login_main.php'"></div>
		</div>
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
