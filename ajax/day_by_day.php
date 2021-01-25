<?php
	require "../data_config/config.php";
	require "../classes/monthly_product.class";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$monthly_buy_product=new Monly_Buy_Tea($db);
if(isset($_POST["action_day_by_day"])){
	$data=array("month_name"=>((int)$_POST["month"]+1),"tea_type"=>$_POST["product_type"],"page"=>$_POST["page"],"year"=>$_POST["year"]);
	$result=$monthly_buy_product->Select_Daily_Products_Monthly($data);
	$value=json_encode($result);
	print_r($value);
}
if(isset($_POST["action_day_by_day_del"])){
	$data=array("prodcut_id"=>$_POST["product_id"]);
	$result=$monthly_buy_product->Delete_Product_Monthly($data);
	print_r($result);
}
if(isset($_POST["action_detail_daily"])){
	$data=array("date"=>$_POST["today_date"],"product_type"=>$_POST["product_type"],"page"=>$_POST["page"]);
	$result=$monthly_buy_product->Detail_Product_By_Daily($data);
	$result_value_encode=json_encode($result);
	print_r($result_value_encode);
}

?>