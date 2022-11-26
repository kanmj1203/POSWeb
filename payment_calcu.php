
<?php
    session_start();
	
	$user_num = $_SESSION["user_num"];
	$product_type = empty($_REQUEST["product_type"]) ? '' : $_REQUEST["product_type"];
	$total_price = $_REQUEST["total_price"];
	$packing = empty($_REQUEST["packing"]) ? '' : $_REQUEST["packing"];
	$method =  empty($_REQUEST["method"]) ? '' : $_REQUEST["method"];
	$pay_money = empty($_REQUEST["pay_money"]) ? '' : $_REQUEST["pay_money"];
	$regtime = date("YmdHis",time());
	$total_price = $total_price - $pay_money;
	
	if($total_price > 0) {
		header("Location:payment_main.php?total_price=$total_price&packing=$packing");
		exit;
	} else {
		 require("db_connect.php");
		 $payment = $db->query("select * from payment where user_num = $user_num");
		while ($row = $payment->fetch()) {
			$product_name = $row["product_name"];
			$payment_price = $row["payment_price"];

			$db->exec("insert into sale (sell_date, product_name, payment_method, payment_packing​, sale​_price, user_num)
			values ($regtime,'$product_name', '$method', '$packing', $payment_price, $user_num)");
			
			$hits = $db->query("select count(*), product_name from payment where user_num = $user_num group by product_name");
					while ($row = $hits->fetch()) {
					$db->exec("update products set product_hits = {$row['count(*)']} where product_name = '$product_name' and user_num = $user_num");
					}
		}
		$db->exec("delete from payment");	
	}
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
		</header>

		<main style="float : none;">
			<div style="margin : 50px; font-size : 36px; color : white;">결제 완료</div>
			<div style="margin : 15px; font-size : 36px; color : white;">거래 일시 : <?=$regtime?></div>
			<?php
				$payment = $db->query("select * from payment where user_num = $user_num order by total_price​ desc limit 1");
				if ($row = $payment->fetch()) {
				?>
			<div style="margin : 15px; font-size : 36px; color : white;">총 가격 : <?=$row["total_price​"]?> 원</div>
				<?php
				}
				?>
			<div style="margin : 15px; font-size : 36px; color : white;">결제 수단 : <?=$method?></div>
			<div style="margin : 15px; font-size : 36px; color : white;"><?=$packing?></div>
			<input style="margin-top : 15px; padding : 15px; width : 20%; font-size : 32px;" type="button" value="확인" onclick="location.href='order_main.php'">
		</main>
		<div class="clear"></div>
	</div>
	<?php        
		
?>
</body>
</html>
