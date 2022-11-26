<?php
    session_start();

	$user_num = $_SESSION["user_num"];
	
	$select = empty($_REQUEST["select"]) ? '' : $_REQUEST["select"];
	require("db_connect.php");
	$total_price = 0;
	$product_name = empty($_REQUEST["product_name"]) ? '' :  $_REQUEST["product_name"];
	
	if($select == 'all_delete'){
	$query = $db->exec("delete from payment");	
		header("Location:order_main.php");
		exit(); //있어도, 없어도 됨
	} else if ($select == 'one_delete') {
		$query = $db->exec("delete from payment where product_name = '$product_name' limit 1");	
		header("Location:order_main.php");
		exit(); //있어도, 없어도 됨
	} else if ($select == 'add') {
		$payment_price = empty($_REQUEST["payment_price"]) ? 0 : $_REQUEST["payment_price"];
		$payment = $db->query("select * from payment");
			while ($row_t = $payment->fetch()) {
				$total_price = $total_price + $row_t["payment_price"];
			}
		$db->exec("insert into payment(payment_price, product_name, total_price​) values($payment_price,'$product_name', $total_price)");
	}		
	
	$product_num = empty($_REQUEST["menu"]) ? '' : $_REQUEST["menu"];
	if ($product_num) {
		$choice = $db->query("select * from products where product_num = $product_num");
		if ($row = $choice->fetch()) {

			$product_name = $row["product_name"];
			$product_price = $row["product_price"];
			$total_price = $product_price;
			
			$payment = $db->query("select * from payment");
			while ($row_t = $payment->fetch()) {
				$total_price += $row_t["payment_price"];
			}
				//$regtime = date("Y-m-d H:i:s");
			$db->exec("insert into payment(payment_price, product_name, total_price​, user_num) values($product_price,'$product_name', $total_price, $user_num)");
		}
	}
	
?>
		<script>
			history.back();
		</script>
