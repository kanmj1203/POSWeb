
<?php 
    $userid = $_REQUEST["userid"];
    $userpw = $_REQUEST["userpw"];
    
        require("db_connect.php");
    
        $query = $db->query("select * from member where userid='$userid' and userpw='$userpw'");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            session_start();
            
            $_SESSION["id"] = $row["userid"];
            $_SESSION["name"] = $row["username"];
			$_SESSION["user_num"] = $row["usernum"];
            
            header("Location:order_main.php");
            exit;
        }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
	if (empty($userid && $userpw)){
?>
	<script>
		alert('빈 칸 없이 입력해주세요.');
		history.back();
	</script>
<?php
	} else {
?>
	<script>
		alert('아이디 또는 비밀번호가 틀렸습니다.');
		history.back();
	</script>
<?php
	}
?>
</body>
</html>
