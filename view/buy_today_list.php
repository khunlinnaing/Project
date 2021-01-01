<?php
$date=date("Y-m-d");
?>
<h2 class="text-center my-2"><b><?php echo $lang["buy_tea_today"]."(".date("d-m-Y").")"; ?></b></h2>
<div class="container bg-light">
	<input type="hidden" class="today_date_buy_today" value="<?php echo $date; ?>">
		<h3 class="text-center my-3"><?php echo $lang["search"] ?></h3>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label class="form-control border-0 bg-light"><?php echo $lang["customer_name"];?></label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="<?php echo $lang["search_customer_name"];?>">
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
							<select class="form-control select_tea_type">
								<?php
								$i=0;
								foreach ($lang["tea_type_choosen"] as $tea) {
									echo "<option value='".$i++."'>".$tea."</option>";
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
		      <th scope="col"><?php echo $lang["customer_name"];?></th>
		      <th scope="col"><?php echo $lang["product_type"];?></th>
		      <th scope="col"><?php echo $lang["vali_name"];?></th>
		      <th scope="col"><?php echo $lang["product_amount"];?></th>
		      <th scope="col"><?php echo $lang["product_price"];?></th>
		      <th scope="col"><?php echo $lang["total_price"];?></th>
		    </tr>
		  </thead>
		  <tbody class="product_buy_today_all">
		    
		  </tbody>
		</table>
	</div>
</div>
<nav aria-label="Page navigation">
	<ul class="pagination justify-content-end today_buy_paginnation">
	</ul>
</nav>
<script type="text/javascript">

	$.ajax({
		url:"../ajax/create_product.php",
		type:"POST",
		data:{"action":"auto select by today","today_date":$(".today_date_buy_today").val(),"page":"1"},
		success: function(data){
			$(".product_buy_today_all").children("tr").remove();
			$(".today_buy_paginnation").children("li").remove();
			var all_result=$.parseJSON(data);
			var result=all_result.result;
			var pagination=all_result.pagnation;
			var count_number=all_result.page;
			Pagination_For_Today_Buy(result,pagination,count_number);
		}
	});
	$(document).on('click','.page_no', function(){
			$(".today_buy_paginnation").children("li").removeClass("active");
			$(this).parent("li").addClass("active");
			$.ajax({
				url:"../ajax/create_product.php",
				type:"POST",
				data:{"action":"auto select by today","today_date":$(".today_date_buy_today").val(),"page":$(this).text()},
				success:function(data){
					$(".product_buy_today_all").children("tr").remove();
					$(".today_buy_paginnation").children("li").remove();
					var all_result=$.parseJSON(data);
					var result=all_result.result;
					var pagination=all_result.pagnation;
					var count_number=all_result.page;
					Pagination_For_Today_Buy(result,pagination,count_number);
				}
			});
		});
	function Pagination_For_Today_Buy(result,pagination,count_number){
		if(count_number==1){
					var count=1;
				}else{
					var count=(parseInt(count_number)*10)-9;
				}
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
				

				$(".product_buy_today_all").append("<tr><td>"+(count++)+"</td><td>"+result[i].customer_name+"</td><td>"+tea_type+"</td><td>"+valiage_name+"</td><td>"+result[i].product_amount+"</td><td>"+result[i].product_price+"</td><td>"+result[i].total+"</td></tr>");
			}
			if(pagination){
				$(".today_buy_paginnation").append('<li class="page-item previous"><a class="page-link" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
				for(j=1; j <= pagination; j++){
					if(count_number==j){
						$(".today_buy_paginnation").append('<li class="page-item active"><a class="page-link page_no">'+j+'</a></li>')
					}else{
						$(".today_buy_paginnation").append('<li class="page-item"><a class="page-link page_no">'+j+'</a></li>')
					}
					
				}
				$(".today_buy_paginnation").append('<li class="page-item"><a class="page-link" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>');
			}
		
	}
</script>