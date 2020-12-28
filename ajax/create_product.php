<?php
	require "../data_config/config.php";
	require "../classes/products.class";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$create_products=new Create_Products($db);
if (isset($_POST["create_product"])) {
	$data=array("user_id"=>$_POST["user_id"],"customer_name"=>$_POST["custer_name"],"product_type"=>$_POST["product_type"],"valliage_name"=>$_POST["valliage_name"],"product_amount"=>$_POST["product_amount"],"product_price"=>$_POST["product_price"],"total_price"=>$_POST["total_price"]);
	$result=$create_products->Create_Products_Buy_Daily($data);
	print_r($result);
}
?>