<?php
if(isset($_POST["product_buy_today"])){
	$page_name=$_POST["product_buy_today"].".php";
}else{
	$page_name="buy_today_list".".php";
}
echo "page ==>".$page_name."<br>";
include "$page_name";
?>
