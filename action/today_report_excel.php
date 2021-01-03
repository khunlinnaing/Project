<?php
	require "../data_config/config.php";
	require "../classes/products.class";
	require "../languages/config.php";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$report_with_excel=new Create_Products($db);
	if(isset($_POST["today_date_report"])){
		$data=array("date"=>$_POST["today_date_report"]);
		$output="";
		$result=$report_with_excel->Print_Report_Buy_Today($data);
		if($result){
			$output .='<table class="table">
						  <thead style="background:green;color:white;">
						    <tr>
						      <th scope="col">'.$lang["no"].'</th>
						      <th scope="col">'.$lang["customer_name"].'</th>
						      <th scope="col">'.$lang["product_type"].'</th>
						      <th scope="col">'.$lang["vali_name"].'</th>
						      <th scope="col">'.$lang["product_amount"].'</th>
						      <th scope="col">'.$lang["product_price"].'</th>
						      <th scope="col">'.$lang["total_price"].'</th>
						     </tr>
						     <tr></tr><tr></tr>
						  </thead><tbody>';
			$value=$result['all_list'];
			$i=1;
			foreach($value as $list) {

				$output .="<tr><td>".$i++."</td><td>".$list['customer_name']."</td><td>".$lang['tea_type'][$list['product_type']]."</td><td>".$lang['vali_value'][$list['valliage_name']]."</td><td>".$list["product_amount"]."</td><td>".$list["product_price"]."</td><td>".$list["total"]."</td></tr>";
			}
			$output .="<tr></tr><tr><tr><tr><td colspan='3'><b>".$lang["total_amount"]."</b></td><td><h3>".$result["total"]["total_amount"]."</b></td><td colspan='2'><b>".$lang["total_price"]."</b></td><td><b>".$result["total"]["total_price"]."</b></td></tr>";
			$output .="</tbody></table>";
			
		}else{
			$output .='<td colspan="5"><h4>'.$lang["no_result"].'</h3></td>';
		}
		header("Content-Type:  application/vnd.ms-excel; charset=utf-8");
        header("Content-type:  application/x-msexcel; charset=utf-8");
        header("Content-Disposition: attachment; filename=report(".date('d-m-Y').").xls");
		echo $output;
		
	}
?>