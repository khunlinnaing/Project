<?php
	require "../data_config/config.php";
	require "../classes/monthly_product.class";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$monthly_buy_product=new Monly_Buy_Tea($db);
if(isset($_POST["action_day_by_day"])){
	$data=array("month_name"=>((int)$_POST["month"]+1),"tea_type"=>$_POST["product_type"],"page"=>$_POST["page"]);
	$result=$monthly_buy_product->Select_Daily_Products_Monthly($data);
	$value=json_encode($result);
	print_r($value);
}

?>