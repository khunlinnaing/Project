<?php
	require "../data_config/config.php";
	require "../classes/products.class";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$create_products=new Create_Products($db);
if (isset($_POST["create_product"])) {
	$data=array("user_id"=>$_POST["user_id"],"customer_name"=>$_POST["custer_name"],"product_type"=>$_POST["product_type"],"valliage_name"=>$_POST["valliage_name"],"product_amount"=>str_replace(",","",$_POST["product_amount"]),"product_price"=>str_replace(",","",$_POST["product_price"]),"total_price"=>str_replace(",","",$_POST["total_price"]));
	$result=$create_products->Create_Products_Buy_Daily($data);
	print_r($result);
}
if(isset($_POST["action"])){
	$data=array("create_date"=>$_POST["today_date"],"page"=>$_POST["page"],"product_type"=>$_POST["product_type"],"customer_name"=>$_POST["customer_name"]);
	$result=$create_products->Select_By_Today_Date($data);
	$result_value_encode=json_encode($result);
	print_r($result_value_encode);
}
if(isset($_POST["action_save"])){
	$data=array("user_id"=>$_POST["user_id"],"date"=>$_POST["date"]);
	$result=$create_products->Save_To_Daily_Table($data);
	print_r($result);
}
?>