
<?php
    session_start();
	
	$username = $_SESSION["name"];
	$userid = $_SESSION["id"];
	$user_num = $_SESSION["user_num"];
	$product_type = empty($_REQUEST["product_type"]) ? '' : $_REQUEST["product_type"];
	
	require("db_connect.php");
	
		$bid = empty($_REQUEST["bid"]) ? "products" : $_REQUEST["bid"]; //여러 게시판 만들기?  게시판 이름
	
		//defind("NUM_LINES",5); // 리스트 한 페이지에 나올 행 수 (글의 수)
		$numLines = 20; // 행의 수
		$numLinks = 3; // 한 페이지에 표시할 페이지 링크개수
	
		$page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
		$start = ($page - 1) * $numLines; // 몇 번 레코드부터 보이게 할 지
		
		$c_numLines = 5; // 행의 수
		$c_numLinks = 3; // 한 페이지에 표시할 페이지 링크개수
		
		$c_page = empty($_REQUEST["c_page"]) ? 1 : $_REQUEST["c_page"];
		$c_start = ($c_page - 1) * $c_numLines; // 몇 번 레코드부터 보이게 할 지
		
		$o_numLines = 5; // 행의 수
		$o_numLinks = 3; // 한 페이지에 표시할 페이지 링크개수
		
		$o_page = empty($_REQUEST["o_page"]) ? 1 : $_REQUEST["o_page"];
		$o_start = ($o_page - 1) * $o_numLines; // 몇 번 레코드부터 보이게 할 지
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/order.css">
	<style>
	</style>
</head>
<body>
	
	<div id="page">
        <header>
			<div class="headers_left">
				<input class="burger-check" type="checkbox" id="burger-check" /><label class="burger-icon" for="burger-check"><span class="burger-sticks"></span></label>
			<div class="menu">
				<div style="width: 200px;">
					<ul class="menu_wrap">
						<li><a href="order_main.php">주문하기</a></li>
						<li><a href="product_manage.php">제품관리</a></li>
						<li><a href="payment_manage.php">주문내역</a></li>
						<li><a href="#">매출확인</a></li>
					</ul>
				</div>
			</div>
			<div style="width :200px;">주문내역</div>
			</div>
			<div class="headers_right">
				<form action="logout.php" method="post">
					<?=$_SESSION["name"]?>님 로그인
					<input type="submit" value="로그아웃">
					<input type="button" value="회원정보 수정" 
						   onclick="location.href='member_write_form.php?username=<?=$username?>&userid=<?=$userid?>'">
				</form>
			</div>
				<div class="sidebar">
				</div>
		</header>
		
			

		<main>
			
			<section class="menus">
			<form action="order_main_choice.php" method="post">
				<table>
					<tr>
						<th  style="width : 130px;">번호</th>
						<th  style="width : 130px;">판매 날짜</th>
						<th  style="width : 130px;">제품명</th>
						<th  style="width : 130px;">결제 방법</th>
						<th  style="width : 130px;">구입 방식</th>
						<th  style="width : 130px;">가격</th>
					</tr> 
					<?php
			
					$query = $db->query("select * from sale where user_num = $user_num order by sell_date desc limit $start, $numLines");
					while($row = $query->fetch()) {
					?>
					<tr class="items" style="font-size : 18px; height :170px;">
						<td><?=$row["sale_num"]?></td>
						<td><?=$row["sell_date"]?></td>
						<td><?=$row["product_name"]?></td>
						<td><?=$row["payment_method"]?></td>
						<td><?=$row["payment_packing​"]?></td>
						<td><?=$row["sale​_price"]?></td>
					</tr>
			
					<?php
						}
						?>
				</table>
				
				<br>
				<?php
				$firstLink = floor(($page - 1) / $numLinks) * $numLinks + 1;
				$lastLink = $firstLink + $numLinks - 1;
				
				$numRecords = $db->query("select count(*) from sale where user_num = $user_num")->fetchColumn();
				$numPages = ceil($numRecords/$numLines);//ceil (올림) 게시판 테이블의 레코드 수 / $numLines;
				if ($lastLink > $numPages) {
					$lastLink = $numPages;
				}
				?>
				<div class = "paging">
				<?php
					if ($firstLink > 1) {
				?>
					<a href = "payment_manage.php?bid=<?=$bid?>&page=<?=$firstLink - $numLinks?>"><</a>
				<?php
					}
					for ($i = $firstLink; $i <= $lastLink; $i++) {
				?>	
					<a href = "payment_manage.php?bid=<?=$bid?>&page=<?=$i?>"><?=($i == $page) ? "<u><b>$i</b></u>" : $i?></a>
				<?php
					}
					if ($lastLink < $numPages) {
				?>
					<a href = "payment_manage.php?bid=<?=$bid?>&page=<?=$firstLink + $numLinks?>">></a>

				<?php
					}
				?>
				</div>
	
				
		</section>
		

		</main>
		<div class="clear"></div>
		<footer>
		rkdalswl1203@g.shingu.ac.kr
		</footer>
	</div>
	<?php        
		
?>
</body>
</html>
