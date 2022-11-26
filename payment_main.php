
<?php
    session_start();
	
	$user_num = $_SESSION["user_num"];
	$product_type = empty($_REQUEST["product_type"]) ? '' : $_REQUEST["product_type"];
	$total_price = $_REQUEST["total_price"];
	$packing = empty($_REQUEST["packing"]) ? '' : $_REQUEST["packing"];
	$method =  empty($_REQUEST["method"]) ? '' : $_REQUEST["method"];
	$pay_money = empty($_REQUEST["pay_money"]) ? '' : $_REQUEST["pay_money"];
	
	if($total_price && $packing && $method && $pay_money){
		header("Location:payment_calcu.php?total_price=$total_price&method=$method&packing=$packing&pay_money=$pay_money");
		exit;
	}
	require("db_connect.php");

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
						<li><a href="order_manage.php">주문내역</a></li>
						<li><a href="sales_check.php">매출확인</a></li>
					</ul>
				</div>
			</div>
			
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

		<main class=" c_m_2 c_2 ">
		<section class="payment_products c_m_7 c_7">
			<div class="order_text"  style="height : 50px;">현재 주문</div>
				<?php
					$choice_in = $db->query("select count(*), payment_price, product_name from payment where user_num = $user_num group by product_name, payment_price");
					while ($row = $choice_in->fetch()) {
						?>
						<div>
							<ul class="order_li">
								<li><?= $row["product_name"]?>&nbsp&nbsp<?= $row["payment_price"]?></li>
								<li><?=$row["count(*)"]?>개</li>
							</ul>
						</div>
						<?php
					}

					$payment = $db->query("select * from payment where user_num = $user_num order by total_price​ desc limit 1");
					if ($row = $payment->fetch()) {
					?>
					<div class="total_price_payment">총 가격 : <?=$row["total_price​"]?> 원</div>
					<?php
					}
					?>
			</section>
			
			<section class="menus c_m_8 c_8">
			<form action="payment_main.php" method="get">
				<table>
					<tr>
						<th class="balance">잔액<input class="balance" readonly type="text" name="total_price" value="<?=$total_price?>"></input></th>
					</tr> 
					<tr class="items">
						<td><button class="options" type="submit" name="method" value="카드결제">카드 결제</button></td>
					</tr>
					<tr class="items">
						<td><button class="options" type="submit" name="method" value="현금결제">현금 결제</button></td>
					</tr>
					<tr class="items">
						<td><button class="options" type="submit" name="method" value="포인트결제">포인트 결제</button></td>
					</tr>
					<tr class="items">
						<td><button class="options" type="submit" name="method" value="쿠폰">쿠폰</button></td>
					</tr>
					<tr class="items">
						<td><button class="options" type="submit" name="method" value="포인트결제">상품권</button></td>
					</tr>
					
					<tr><td><br><br><td></tr>
					<?php
					if($packing == '매장'){
					?>
					<tr class="payment_method">
						<td><input class="payment_options" type="radio" name="packing" value="포장">포장</input></td>
					</tr>
					<tr class="payment_method">
						<td><input class="payment_options" type="radio" name="packing" value="매장" checked >매장</input></td>
					</tr>
					<?php
					} else {
					?>
					<tr class="payment_method">
						<td><input class="payment_options" type="radio" name="packing" value="포장" checked>포장</input></td>
					</tr>
					<tr class="payment_method">
						<td><input class="payment_options" type="radio" name="packing" value="매장">매장</input></td>
					</tr>
					<?php
					}
					if($method){
					?>
					<tr><td><br><br><td></tr>
						<tr>
							<td><input class="pay_money" type="text" name="pay_money" placeholder="금액" value=""></td>
						</tr>
						<tr>
							<td><input class="pay_money_button" type="submit" name="method" value="<?=$method?>" 
							></td>
						</tr>
					<?php
					}
					?>

				</table>
				</form>
				

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
