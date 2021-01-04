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
		data:{"action_day_by_day":"product in day buy day","month":$(".select_monthly").val(),"product_type":$(".select_tea_type_during_monthly").val(),"page":1},
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
	$(".select_monthly,.select_tea_type_during_monthly").on("change",function(){
		$.ajax({
			url:"../ajax/day_by_day.php",
			type:"POST",
			data:{"action_day_by_day":"product in day buy day","month":$(".select_monthly").val(),"product_type":$(".select_tea_type_during_monthly").val(),"page":1},
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
	function Pagination_Check_Day_Buy_Day(data,page,total,type,pagination){
		console.log(page);
		console.log(total);
		console.log(pagination);
		if(type){
			var d_type="<?php echo $lang['tea_type_choosen'][0] ?>";
		}
		for(i=0; i < data.length; i++){
			if(!type){
				if(data[i].d_type==0){
					var d_type="<?php echo $lang['tea_type_choosen'][1] ?>";
				}else{
					var d_type="<?php echo $lang['tea_type_choosen'][2] ?>";
				}
			}
			$(".result_check_day_buy_day").append("<tr><td>"+(i+1)+"</td><td>"+d_type+"</td><td>"+(data[i].d_product_amount).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+(data[i].d_todal_price).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+data[i].daily_create+"</td><td><div class='row'><input type='hidden' value='"+data[i].id+"'><button class='btn edit_day_by_day_val bg-success text-white w-50'><?php echo $lang['edit']; ?></button><button class='btn delete_day_by_day_val bg-danger text-white w-50'><?php echo $lang['delete']; ?></button></div></td></tr>");
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
</script>