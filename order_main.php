
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
			<div style="width :200px;">주문하기</div>
			</div>
			<div class="headers_right">
				<form action="logout.php" method="post">
					<?=$_SESSION["name"]?>님 로그인
					<input type="submit" value="로그아웃">
					<input type="button" value="회원정보 수정" 
						   onclick="location.href='member_write_form.php?username=<?=$username?>&userid=<?=$userid?>'">
						   <script>
							
						   </script>
				</form>
			</div>

				<div class="sidebar">
				</div>
		</header>
		<aside class="c_m_1 c_1">
			<?php 
			if ($c_page == 1) { 
			?>
			<nav class="c_m_5 c_5"  onclick="location.href='#'">
				<ul>
					<li class="categorys"><button onclick="location.href='?product_type='">전체</input></li>
				</ul>
			</nav>
			<?php
			}
			$categorys  = $db->query("select * from categorys where user_num = $user_num limit $c_start, $c_numLines");
			while($row = $categorys->fetch()) {
			?>
			<nav class="c_m_5 c_5">
				<ul>
					<li class="categorys"><button onclick="location.href='?product_type=<?=$row["category_name"]?>'"><?= $row["category_name"]?></button></li>
				</ul>
			</nav>
			
			<?php
			}
			?>
			
			
			<div style = "margin-top : 3px;"></div>
			<?php
			$c_firstLink = floor(($c_page - 1) / $c_numLinks) * $c_numLinks + 1;
			$c_lastLink = $c_firstLink + $c_numLinks - 1;// group by product_type
			
			$c_numRecords = $db->query("select count(*) from categorys where user_num = $user_num")->fetchColumn();
			$c_numPages = ceil($c_numRecords/$c_numLines);//ceil (올림) 게시판 테이블의 레코드 수 / $numLines;
			if ($c_lastLink > $c_numPages) {
				$c_lastLink = $c_numPages;
			}
			?>
			<div class = "paging">
			<?php
			if ($c_firstLink > 1) {
			?>
				<a href = "order_main.php?bid=<?=$bid?>&page=<?=$page?>&c_page=<?=$c_firstLink - $c_numLinks?>&o_page=<?=$o_page?>&product_type=<?=$product_type?>"><</a>
			<?php
			}
			for ($i = $c_firstLink; $i <= $c_lastLink; $i++) {
			?>	
				<a href = "order_main.php?bid=<?=$bid?>&page=<?=$page?>&c_page=<?=$i?>&o_page=<?=$o_page?>&product_type=<?=$product_type?>"><?=($i == $c_page) ? "<u><b>$i</b></u>" : $i?></a>
			<?php
			}
			if ($c_lastLink < $c_numPages) {
			?>
				<a href = "order_main.php?bid=<?=$bid?>&page=<?=$page?>&c_page=<?=$c_firstLink + $c_numLinks?>&o_page=<?=$o_page?>&product_type=<?=$product_type?>">></a>
			<?php
			}
			?>
			</div>		
		</aside>	
		<main class=" c_m_2 c_2 ">
			
			<section class="menus c_m_3 c_3">
			<form action="order_main_choice.php" method="get">
				<table>
					<tr>
						<th>menus</th>
					</tr> 
					<?php
					if ($product_type){
						$query = $db->query("select * from products where user_num = $user_num and category_type = '제품' and product_type = '$product_type' limit $start, $numLines");
					} else {
						$query = $db->query("select * from products where user_num = $user_num and category_type = '제품' limit $start, $numLines");
					}
					while($row = $query->fetch()) {
					?>
					<tr class="items">
						<td><button class="menus_list" type="submit" name="menu" value="<?=$row["product_num"]?>">
						<?=$row["product_name"]?><br><?=$row["product_price"]?> 원</input></td>
					</tr>
			
					<?php
						}
						?>
				</table>
				
				<br>
				<?php
				$firstLink = floor(($page - 1) / $numLinks) * $numLinks + 1;
				$lastLink = $firstLink + $numLinks - 1;
				
				$numRecords = $db->query("select count(*) from products where user_num = $user_num")->fetchColumn();
				$numPages = ceil($numRecords/$numLines);//ceil (올림) 게시판 테이블의 레코드 수 / $numLines;
				if ($lastLink > $numPages) {
					$lastLink = $numPages;
				}
				?>
				<div class = "paging">
				<?php
					if ($firstLink > 1) {
				?>
					<a href = "order_main.php?bid=<?=$bid?>&page=<?=$firstLink - $numLinks?>&c_page=<?=$c_page?>&o_page=<?=$o_page?>&product_type=<?=$product_type?>"><</a>
				<?php
					}
					for ($i = $firstLink; $i <= $lastLink; $i++) {
				?>	
					<a href = "order_main.php?bid=<?=$bid?>&page=<?=$i?>&c_page=<?=$c_page?>&o_page=<?=$o_page?>&product_type=<?=$product_type?>"><?=($i == $page) ? "<u><b>$i</b></u>" : $i?></a>
				<?php
					}
					if ($lastLink < $numPages) {
				?>
					<a href = "order_main.php?bid=<?=$bid?>&page=<?=$firstLink + $numLinks?>&c_page=<?=$c_page?>&o_page=<?=$o_page?>&product_type=<?=$product_type?>">></a>
				<?php
					}
				?>
				</div>
	
				<br>
				<table>
					<tr>
						<th>options</th>
					</tr>
					<?php
						$query = $db->query("select * from products where user_num = $user_num and category_type = '옵션' limit $o_start, $o_numLines");
						while($row = $query->fetch()) {
					?>
					<tr class="items">
						<td><button class="options" type="submit" name="menu" value="<?=$row["product_num"]?>">
							<?=$row["product_name"]?><br><?=$row["product_price"]?> 원
						</button></td>
					</tr>
					<?php
						}
						?>
					</tr>
				</table>
				</form>
				<br>
				<?php
				$o_firstLink = floor(($o_page - 1) / $o_numLinks) * $o_numLinks + 1;
				$o_lastLink = $o_firstLink + $o_numLinks - 1;
				
				$o_numRecords = $db->query("select count(*) from products where user_num = $user_num and category_type = '옵션'")->fetchColumn();
				$o_numPages = ceil($o_numRecords/$o_numLines);//ceil (올림) 게시판 테이블의 레코드 수 / $numLines;
				if ($o_lastLink > $o_numPages) {
					$o_lastLink = $o_numPages;
				}
				?>
				<div class = "paging">
				<?php
					if ($o_firstLink > 1) {
				?>
					<a href = "order_main.php?bid=<?=$bid?>&page=<?=$page?>&c_page=<?=$o_page?>&o_page=<?=$o_firstLink - $o_numLinks?>&product_type=<?=$product_type?>"><</a>
				<?php
					}
					for ($i = $o_firstLink; $i <= $o_lastLink; $i++) {
				?>	
					<a href = "order_main.php?bid=<?=$bid?>&page=<?=$page?>&c_page=<?=$c_page?>&o_page=<?=$i?>&product_type=<?=$product_type?>"><?=($i == $o_page) ? "<u><b>$i</b></u>" : $i?></a>
				<?php
					}
					if ($o_lastLink < $o_numPages) {
				?>
					<a href = "order_main.php?bid=<?=$bid?>&page=<?=$page?>&c_page=<?=$c_page?>&o_page=<?=$o_firstLink + $o_numLinks?>&product_type=<?=$product_type?>">></a>
				<?php
					}
				?>
				</div>

		</section>
		<section class="order c_m_4 c_4">
			<div class="order_text">현재 주문</div>
				<div style="height : 70px;"><input class="all_delete" type="button" value="전체삭제" onclick="location.href='order_main_choice.php?select=all_delete'"></div>
				<?php
					$choice_in = $db->query("select count(*), payment_price, product_name from payment where user_num = $user_num group by product_name, payment_price");
					while ($row = $choice_in->fetch()) {
						?>
						<div>
							<ul class="order_li">
								<li><?= $row["product_name"]?>&nbsp&nbsp<?= $row["payment_price"]?></li>
								<li>
									<input type="button" value="-" onclick="location.href='order_main_choice.php?select=one_delete&product_name=<?=$row["product_name"]?>'">
									<?=$row["count(*)"]?>개
									<input type="button" value="+" onclick="location.href='order_main_choice.php?select=add&product_name=<?=$row["product_name"]?>&payment_price=<?=$row["payment_price"]?>'">
								</li>
							</ul>
						</div>
						<?php
					}
					$payment = $db->query("select * from payment where user_num = $user_num order by total_price​ desc limit 1");
					if ($row = $payment->fetch()) {
					?>
					<div class="total_price_order">총 가격 : <?=$row["total_price​"]?> 원</div>
					<div><input class="order_payment_button" type="button" value="결제하기" onclick="location.href='payment_main.php?total_price=<?=$row["total_price​"]?>'"></div>
					<?php
					}
					?>
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
