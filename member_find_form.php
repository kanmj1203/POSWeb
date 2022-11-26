​
<?php
   session_start();
	
	$page = empty($_REQUEST["page"])? "idFind" : $_REQUEST["page"];
	$title = "아이디 찾기";
	
	if ($page == "pwFind") {
		$title = "비밀번호 찾기";
	}
	
?>
​
<!doctype html>
<html>
<head>
   <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<style>
​
	</style>
</head>
<body>
	<main id="login_box">
		<div><h1 class = "title"><?= $title ?></h1></div>
		<div id="member_find_button">
		<ul>
			<li><button type="button" name="idFind" value="아이디 찾기" onClick="location.href='member_find_form.php?page=idFind'"><img src="img/id.png" alt=""></button></li>
			<li><button type="button" name="pwFind" value="비밀번호 찾기" id="left" onClick="location.href='member_find_form.php?page=pwFind'"><img src="img/pw.png" alt=""></li>
		</ul>
		</div>
	
	<?php
		if ($page == "idFind") {
	?>
	<table id="member_find_main">
		<form action="member_find.php" method="post">
			<tr class="col3">
				 <th>이름</th>
				 <td class="right"><input type="text" name="username"></td>
			</tr>
			<tr class="col3">
				 <th>전화번호</th>
				 <td><input type="text" name="tel1" class="phone"></td>
				 <td> - <input type="text" name="tel2" class="phone"></td>
				 <td> - <input type="text" name="tel3" class="phone"></td>
			</tr>
			<tr class="col3">
				 <th>이메일</th>
				 <td><input type="text" name="useremail"></td>
			</tr>
			</table>
			<div id="member_bottom_button">
				<input type="submit" value="확인" id="left">
				<input type="button" value="취소" onclick="location.href='login_main.php'">
			</div>
		</form>
	<?php
		} else {
	?>
	<table id="member_find_main">
		<form action="member_pw_change_form.php" method="post">
			<tr class="col3">
				 <th class="text">이름</th>
				 <td class="right"><input type="text" name="username"></td>
			</tr>
			<tr class="col3">
					<th>아이디</th>
					<td><input type="text" name="userid"></td>
			</tr>
			<tr class="col3">
				 <th>전화번호</th>
				 <td><input type="text" name="tel1" class="phone"></td>
				 <td> - <input type="text" name="tel2" class="phone"></td>
				 <td> - <input type="text" name="tel3" class="phone"></td>
			</tr>
			<tr class="col3">
				 <th>이메일</th>
				 <td><input type="text" name="useremail"></td>
			</tr>
			</table>
			<div id="member_bottom_button">
				<input type="submit" value="확인" id="left">
				<input type="button" value="취소" onclick="location.href='login_main.php'">
			</div>
		</form>
	<?php
		}
	?>
		
		</main>
</body>
</html>
​​