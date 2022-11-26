
<?php
    session_start();
	
	$name = "";
	$id = "";
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<style>

	</style>
</head>
<body>
	<main id="login_box">
		<div><h1 class = "title">LOGIN</h1></div>
        <form action="login.php" method="post">
		<table id="login_main">
				<tr class = "col1">
					<td><input type="text" name="userid" placeholder="아이디" value=""></td>
				</tr>
				<tr class = "col1">
					<td><input type="password" name="userpw" placeholder="비밀번호" value=""></td>
				</tr>
				<tr class = "col2">
					<td><input type="checkbox" name ="idSaveCheck" id="idSave"></td>
					<td><label for="idSave">아이디 저장</label></td>
					
				</tr>
				<tr id = "login_button">
					<td><input type="submit" value="로그인"></td>
				</tr>
				<tr id = "login_bottom_button">
					<td><input type="button" value="회원 가입" onclick="location.href='member_write_form.php?name=<?=$name?>&id=<?=$id?>'" id="left"></td>
					<td><input type="button" value="아이디/비밀번호 찾기" onclick="location.href='member_find_form.php'"></td>
				</tr>
			</table>
		</form>
		</main>
</body>
</html>
