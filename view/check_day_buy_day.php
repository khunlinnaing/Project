<?php
if($_SESSION['lang']=='en'){

?>
<h2 class="text-center my-2"><b><?php echo $lang["buy_tea_daily_list_in"]." ".$lang["month_name"][date("m")-1] ;?></b></h2>
<?php }else{ ?>
	<h2 class="text-center my-2"><b><?php echo $lang["month_name"][((integer)date("m"))-1]." ".$lang["buy_tea_daily_list_in"] ;?></b></h2>
<?php } ?>
<div class="container bg-light">
	<input type="hidden" value="<?php echo date("m"); ?>">
		<h3 class="text-center my-3"><?php echo $lang["search"] ?></h3>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label class="form-control border-0 bg-light"><?php echo $lang["month_label"] ?></label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="form-group">
							<select class="form-control select_monthly">
								<?php
								$i=0;
								$month=date('m');
								foreach ($lang["month_name"] as $month_name) {
									if(($month-1)==$i){
										echo "<option value='".$i++."' selected>".$month_name."</option>";
									}else{
											echo "<option value='".$i++."'>".$month_name."</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label  class="form-control border-0 bg-light"><?php echo $lang["product_type"];?></label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="form-group">
							<select class="form-control select_tea_type_during_monthly">
								<?php
								$i=0;
								foreach ($lang["tea_type_choosen"] as $tea_type_choosen) {
									echo "<option value='".$i++."'>".$tea_type_choosen."</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label class="form-control border-0 bg-light"><?php echo $lang["year"] ?></label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="form-group">
							<select class="form-control select_yearly">
								<option><?php echo date("Y") ?></option>
								<option><?php echo date("Y")-1 ?></option>
								<option><?php echo date("Y")-2 ?></option>
								<option><?php echo date("Y")-3 ?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<button class="btn bg-success text-white form-control"><?php echo $lang["save"] ?></button>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row my-2">
		<button class="btn bg-success text-white"><?php echo $lang["download_report"];?></button>
	</div>
	<div class="row">
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col"><?php echo $lang["no"];?></th>
		      <th scope="col"><?php echo $lang["product_type"];?></th>
		      <th scope="col"><?php echo $lang["product_amount"];?></th>
		      <th scope="col"><?php echo $lang["total_price"];?></th>
		      <th scope="col"><?php echo $lang["date"];?></th>
		      <th scope="col"><?php echo $lang["action"]; ?></th>
		    </tr>
		  </thead>
		  <tbody class="result_check_day_buy_day">
		   
		  </tbody>
		</table>
	</div>
</div>
<div class="row total_day_buy_day">
</div>
<nav aria-label="Page navigation">
	<ul class="pagination justify-content-end day_buy_day_paginnation">
	</ul>
</nav>
<script type="text/javascript">
	$.ajax({
		url:"../ajax/day_by_day.php",
		type:"POST",
		data:{"action_day_by_day":"product in day buy day","month":$(".select_monthly").val(),"product_type":$(".select_tea_type_during_monthly").val(),"page":1,"year":$(".select_yearly").val()},
		success: function(data){
			$(".result_check_day_buy_day").children("tr").remove();
			$(".total_day_buy_day").children("div").remove();
			$(".day_buy_day_paginnation").children("li").remove();
			var result=$.parseJSON(data);
			var data=result.result;
			var page=result.page;
			var total=result.total;
			var type=result.type;
			var pagination_no=result.pagination;
			if(data !=0){
				Pagination_Check_Day_Buy_Day(data,page,total,type,pagination_no);
			}else{
				$(".result_check_day_buy_day").append("<tr><td colspan='6' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td>");
			}			
		}
	});
	$(".select_monthly,.select_tea_type_during_monthly,.select_yearly").on("change",function(){
		$.ajax({
			url:"../ajax/day_by_day.php",
			type:"POST",
			data:{"action_day_by_day":"product in day buy day","month":$(".select_monthly").val(),"product_type":$(".select_tea_type_during_monthly").val(),"page":1,"year":$(".select_yearly").val()},
			success: function(data){
				$(".result_check_day_buy_day").children("tr").remove();
				$(".total_day_buy_day").children("div").remove();
				$(".day_buy_day_paginnation").children("li").remove();
				var result=$.parseJSON(data);
				var data=result.result;
				var page=result.page;
				var total=result.total;
				var type=result.type;
				var pagination_no=result.pagination;
				if(data !=0){
					Pagination_Check_Day_Buy_Day(data,page,total,type,pagination_no);
				}else{
					$(".result_check_day_buy_day").append("<tr><td colspan='6' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td>");
				}
			}
		});
	});
	$(document).on("click",".page_no_day_by_day",function(){
		//$(".day_buy_day_paginnation").children("li").removeClass("active");
		$.ajax({
			url:"../ajax/day_by_day.php",
			type:"POST",
			data:{"action_day_by_day":"product in day buy day","month":$(".select_monthly").val(),"product_type":$(".select_tea_type_during_monthly").val(),"page":$(this).val(),"year":$(".select_yearly").val()},
			success: function(data){
				$(this).parent("li").addClass("active");
				$(".result_check_day_buy_day").children("tr").remove();
				$(".total_day_buy_day").children("div").remove();
				$(".day_buy_day_paginnation").children("li").remove();
				var result=$.parseJSON(data);
				var data=result.result;
				var page=result.page;
				var total=result.total;
				var type=result.type;
				var pagination_no=result.pagination;
				if(data !=0){
					Pagination_Check_Day_Buy_Day(data,page,total,type,pagination_no);
				}else{
					$(".result_check_day_buy_day").append("<tr><td colspan='6' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td>");
				}
			}
		});
	});
	$(document).on("click",".edit_day_by_day_val",function(){
		var date=$(this).parent("div").parent("td").parent("tr").children("td:eq(4)").text();
		var product_type=$(this).parent("div").parent("td").parent("tr").children("td:eq(1)").children("input").val();
		$(".type_detail_product").val(product_type);
		$(".date_select_detail").val(date);

		$.ajax({
				url:"../ajax/day_by_day.php",
				type:"POST",
				data:{"action_detail_daily":"select detail product","today_date":date,"page":"1","product_type":product_type},
				success: function(data){
					$(".total_day_by_day_detail,.detail_list_day_by_day,.day_by_day_detail_pagination").children().remove();
					var all_result=$.parseJSON(data);
					var result=all_result.result;
					var pagination=all_result.pagnation;
					var count_number=all_result.page;
					var total_people=all_result.total;
					var total_value=all_result.sum_value;
					if(result !=""){
						Day_by_Day_Product_detail(result,pagination,count_number,total_people,total_value);
					}else{
						$(".detail_list_day_by_day").append("<tr></tr><tr></tr><tr><td colspan='7' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td></tr><tr></tr><tr></tr>");
					}
				}
			});
		$("#update_modal_day_by_day").modal("show");
	});
	$(document).on("click",".page_no_day_by_day_detail",function(){
		var page_no=$(this).text();
		
		$.ajax({
				url:"../ajax/day_by_day.php",
				type:"POST",
				data:{"action_detail_daily":"select detail product","today_date":$(".date_select_detail").val(),"page":page_no,"product_type":$(".type_detail_product").val()},
				success: function(data){
					$(".total_day_by_day_detail,.detail_list_day_by_day,.day_by_day_detail_pagination").children().remove();
					var all_result=$.parseJSON(data);
					var result=all_result.result;
					var pagination=all_result.pagnation;
					var count_number=all_result.page;
					var total_people=all_result.total;
					var total_value=all_result.sum_value;
					if(result !=""){
						Day_by_Day_Product_detail(result,pagination,count_number,total_people,total_value);
					}else{
						$(".detail_list_day_by_day").append("<tr></tr><tr></tr><tr><td colspan='7' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td></tr><tr></tr><tr></tr>");
					}
				}
			});
	});

	$(document).on("click",".confirm_delete_day_by_day_product",function(){
		$.ajax({
			url:"../ajax/day_by_day.php",
			type:"POST",
			data:{"action_day_by_day_del":"delete day by day","product_id":$(".delete_by_product_id_day_by_day").val()},
			success: function(data){
				if(data==1){
					alert("<?php echo $lang["delete_success"]?>");
					window.location.reload(true);
				}else{
					alert("<?php echo $lang["delete_not_success"]?>");
				}
			}
		});
	});
	function Pagination_Check_Day_Buy_Day(data,page,total,type,pagination){
		if(type){
			var d_type="<?php echo $lang['tea_type_choosen'][0] ?>";
			var type_val=0;
		}
		for(i=0; i < data.length; i++){
			if(!type){
				var button="";
				if(data[i].d_type==0){
					var d_type="<?php echo $lang['tea_type_choosen'][1] ?>";
					var type_val=1;
				}else{
					var d_type="<?php echo $lang['tea_type_choosen'][2] ?>";
					var type_val=2;
				}
			}
			$(".result_check_day_buy_day").append("<tr><td>"+(i+1)+"</td><td><input type='hidden' value='"+type_val+"'>"+d_type+"</td><td>"+(data[i].d_product_amount).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+(data[i].d_todal_price).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+data[i].daily_create+"</td><td><div class='row'><input type='hidden' value='"+data[i].id+"'><button class='btn edit_day_by_day_val bg-success text-white w-50'>detail</button><button class='btn delete_day_by_day_val bg-danger text-white w-50'><?php echo $lang['delete']; ?></button></div></td></tr>");
		}
		
		$(".total_day_buy_day").append("<div class='col-lg-4 col-md-4'><div class='form-group'><div class='row'><div class='col-lg-6 col-md-6'><?php echo $lang["number_of_people"]?></div><div class='col-lg-6 col-md-6'><input type='text' class='form-control' value='"+data.length+"' readonly></div></div></div></div>");
		$(".total_day_buy_day").append("<div class='col-lg-4 col-md-4'><div class='form-group'><div class='row'><div class='col-lg-6 col-md-6'><?php echo $lang["total_amount"]?></div><div class='col-lg-6 col-md-6'><input type='text' class='form-control' value='"+(total[0]["total_amount"]).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"' readonly></div></div></div></div>");
		$(".total_day_buy_day").append("<div class='col-lg-4 col-md-4'><div class='form-group'><div class='row'><div class='col-lg-6 col-md-6'><?php echo $lang["total_price"]?></div><div class='col-lg-6 col-md-6'><input type='text' class='form-control' value='"+(total[0]["total_price"]).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"' readonly></div></div></div></div>");
		for(j=1; j <= pagination; j++){
					if(page==j){
						$(".day_buy_day_paginnation").append('<li class="page-item active"><a class="page-link page_no_day_by_day">'+j+'</a></li>')
					}else{
						$(".day_buy_day_paginnation").append('<li class="page-item"><a class="page-link page_no_day_by_day">'+j+'</a></li>')
					}
					
				}
	}

	function Day_by_Day_Product_detail(result,pagination,count_number,number_people,total_value){
		if(count_number==1){
					var count=1;
				}else{
					var count=((parseInt(count_number)-1)*10)+1;
				}
		$(".total_day_by_day_detail").append("<table class='table w-100'><tr><td><?php echo $lang["number_of_people"]?></td><td><b>"+number_people+"</b></td></tr></table>");
		$(".total_day_by_day_detail").append("<table class='table w-100'><tr><td><?php echo $lang["total_amount"]?></td><td><b>"+(total_value.total_amount).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</b></td></tr></table>");
		$(".total_day_by_day_detail").append("<table class='table w-100'><tr><td><?php echo $lang["total_price"]?>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</td><td><b>"+(total_value.total_price).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</b></td></tr></table>");
		for(i=0; i < result.length; i++){
				if(result[i].product_type==0){
					var tea_type="<?php echo $lang["tea_type"][0] ?>";
				}else{
					var tea_type="<?php echo $lang["tea_type"][1] ?>";
				}
				if(result[i].valliage_name==0){
					var valiage_name="<?php echo $lang["vali_value"][0] ?>";
				}else if(result[i].valliage_name==1){
					var valiage_name="<?php echo $lang["vali_value"][1] ?>";
				}else if(result[i].valliage_name==2){
					var valiage_name="<?php echo $lang["vali_value"][2] ?>";
				}else if(result[i].valliage_name==3){
					var valiage_name="<?php echo $lang["vali_value"][3] ?>";
				}else if(result[i].valliage_name==4){
					var valiage_name="<?php echo $lang["vali_value"][4] ?>";
				}else{
					var valiage_name="<?php echo $lang["vali_value"][5] ?>";
				}
				$(".detail_list_day_by_day").append("<tr><td>"+(count++)+"</td><td>"+result[i].customer_name+"</td><td><input type='hidden' class='modual_product_type' value='"+result[i].product_type+"'>"+tea_type+"</td><td><input type='hidden' class='customer_valiage_name' value='"+result[i].valliage_name+"'>"+valiage_name+"</td><td>"+(result[i].product_amount).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+(result[i].product_price).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+(result[i].total).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td></tr>");
			}
			if(pagination){
				for(j=1; j <= pagination; j++){
					if(count_number==j){
						$(".day_by_day_detail_pagination").append('<li class="page-item active"><a class="page-link page_no_day_by_day_detail">'+j+'</a></li>')
					}else{
						$(".day_by_day_detail_pagination").append('<li class="page-item"><a class="page-link page_no_day_by_day_detail">'+j+'</a></li>')
					}
					
				}
			}
		
	}
</script>
<!-- Delete Modal -->
<div class="modal fade" id="delete_modal_day_by_day" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<h4 class="text-center"><?php echo $lang["delete_sure"]; ?></h4>
      	<input type="hidden" class="delete_by_product_id_day_by_day">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success confirm_delete_day_by_day_product"><?php echo $lang["submit_btn"]; ?></button>
        <button type="button" class="btn" data-dismiss="modal"><?php echo $lang["close"]; ?></button>
      </div>
    </div>
  </div>
</div>

<!-- update Modal -->
<div class="modal fade" id="update_modal_day_by_day" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center w-100 text-success"><?php echo $lang["check_list"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" class="type_detail_product">
      	<input type="hidden" class="date_select_detail">
      	<table class="table table-responsive">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col"><?php echo $lang["no"];?></th>
		      <th scope="col"><?php echo $lang["customer_name"];?></th>
		      <th scope="col"><?php echo $lang["product_type"];?></th>
		      <th scope="col"><?php echo $lang["vali_name"];?></th>
		      <th scope="col"><?php echo $lang["product_amount"];?></th>
		      <th scope="col"><?php echo $lang["product_price"];?></th>
		      <th scope="col"><?php echo $lang["total_price"];?></th>
		     </tr>
		  </thead>
		  <tbody class="detail_list_day_by_day">
		    
		  </tbody>
		</table>
		<div class="row total_day_by_day_detail">

		</div>
		<nav aria-label="Page navigation">
			<ul class="pagination justify-content-end day_by_day_detail_pagination">
			</ul>
		</nav>
      </div>
      <div class="modal-footer">
      	<form action="../action/today_report_excel.php" method="post">
			<input type="hidden" class="date_select_detail">
			<button class="btn bg-success text-white download_today_report"><?php echo $lang["download_report"];?></button>
		</form>
        <button type="button" class="btn" data-dismiss="modal"><?php echo $lang["close"]; ?></button>
      </div>
    </div>
  </div>
</div>