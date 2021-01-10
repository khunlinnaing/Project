<?php
$date=date("Y-m-d");
?>
<h2 class="text-center my-2"><b><?php echo $lang["buy_tea_today"]."(".date("d-m-Y").")"; ?></b></h2>
<div class="container bg-light">
		<h3 class="text-center my-3"><?php echo $lang["search"] ?></h3>
		<input type="hidden" class="user_id" value="<?php echo $_SESSION["user_id"]?>">
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
							<input type="text" class="form-control search_by_customer_name" placeholder="<?php echo $lang["search_customer_name"];?>">
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
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<div class="form-group">
							<label  class="form-control border-0 bg-light"><?php echo $lang["date"];?></label>
						</div>
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="form-group">
							<input type="date" class="form-control search_by_today_date" value="<?php echo date("Y-m-d"); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
				<button class="btn bg-success text-white form-control save_daily_report"><?php echo $lang["save"] ?></button>
			</div>
		</div>
	</div>
</div>
<div class="container">

	<div class="row my-2">
		<form action="../action/today_report_excel.php" method="post">
			<input type="hidden" name="today_date_report" value="<?php echo date("Y-m-d"); ?>">
			<button class="btn bg-success text-white download_today_report"><?php echo $lang["download_report"];?></button>
		</form>
	</div>
	<div class="row alter_successful_delete_update"></div>
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
		      <th scope="cocl p-1"><?php echo $lang["action"]; ?></th>
		     </tr>
		  </thead>
		  <tbody class="product_buy_today_all">
		    
		  </tbody>
		</table>
	</div>
</div>
<div class="row total">

</div>
<nav aria-label="Page navigation">
	<ul class="pagination justify-content-end today_buy_paginnation">
	</ul>
</nav>
<script type="text/javascript">

	$.ajax({
		url:"../ajax/create_product.php",
		type:"POST",
		data:{"action":"auto select by today","today_date":$(".search_by_today_date").val(),"page":"1","product_type":$(".select_tea_type").val(),"customer_name":$(".search_by_customer_name").val()},
		success: function(data){
			$(".product_buy_today_all").children("tr").remove();
			$(".today_buy_paginnation").children("li").remove();
			$(".total").children("div").remove();
			var all_result=$.parseJSON(data);
			
			var result=all_result.result;
			var pagination=all_result.pagnation;
			var count_number=all_result.page;
			var total_people=all_result.total;
			var total_value=all_result.sum_value;
			if(result !=""){
				Pagination_For_Today_Buy(result,pagination,count_number,total_people,total_value);
			}else{
				$(".product_buy_today_all").append("<tr></tr><tr></tr><tr><td colspan='7' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td></tr><tr></tr><tr></tr>");
			}
			
		}
	});
	$.ajax({
		url:"../ajax/create_product.php",
		type:"POST",
		data:{"chcek_daily":"check daily product","date":$(".search_by_today_date").val()},
		success: function(data){
			var result=$.parseJSON(data);
			console.log(result);
			if(result.tea_dat==0 && result.result==1){
				$(".save_daily_report").attr("disabled","disabled");
				$(".save_daily_report").text("<?php echo $lang['finish_save']?>")
			}else if(result.tea_dat==2 && result.result==0 || result.tea_dat==2 && result.result==1){
				$(".save_daily_report").attr("disabled","disabled");
				$(".save_daily_report").text("<?php echo $lang['no_result_today']?>")
			}else{
				$(".save_daily_report").removeClass("disabled");
			}
		}
	});
	$(".save_daily_report").click(function(){
		$.ajax({
			url:"../ajax/create_product.php",
			type:"POST",
			data:{"action_save":"save in daily table","user_id":$(".user_id").val(),"date":$(".search_by_today_date").val()},
			success:function(data){
				console.log(data);
				if(data==1 || data==11){
					window.location.reload(true);
				}else{

				}
			}
		});
	});
	$(document).on('click','.page_no', function(){
			$(".today_buy_paginnation").children("li").removeClass("active");
			$(this).parent("li").addClass("active");
			$.ajax({
				url:"../ajax/create_product.php",
				type:"POST",
				data:{"action":"auto select by today","today_date":$(".search_by_today_date").val(),"page":$(this).text(),"product_type":$(".select_tea_type").val(),"customer_name":$(".search_by_customer_name").val()},
				success:function(data){
					$(".product_buy_today_all").children("tr").remove();
					$(".today_buy_paginnation").children("li").remove();
					$(".total").children("div").remove();
					var all_result=$.parseJSON(data);
					var result=all_result.result;
					var pagination=all_result.pagnation;
					var count_number=all_result.page;
					var total_people=all_result.total;
					var total_value=all_result.sum_value;
					if(result !=""){
						Pagination_For_Today_Buy(result,pagination,count_number,total_people,total_value);
					}else{
						$(".product_buy_today_all").append("<tr></tr><tr></tr><tr><td colspan='7' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td></tr><tr></tr><tr></tr>");
					}
				}
			});
		});
	$(".search_by_customer_name").on("input",function(){
		$(".today_buy_paginnation").children("li").removeClass("active");
		$(this).parent("li").addClass("active");
		$.ajax({
			url:"../ajax/create_product.php",
			type:"POST",
			data:{"action":"auto select by today","today_date":$(".search_by_today_date").val(),"page":"1","product_type":$(".select_tea_type").val(),"customer_name":$(".search_by_customer_name").val()},
			success: function(data){
				$(".product_buy_today_all").children("tr").remove();
				$(".today_buy_paginnation").children("li").remove();
				$(".total").children("div").remove();
				console.log(data);
				var all_result=$.parseJSON(data);
				var result=all_result.result;
				var pagination=all_result.pagnation;
				var count_number=all_result.page;
				var total_people=all_result.total;
				var total_value=all_result.sum_value;
				if(result !=""){
					Pagination_For_Today_Buy(result,pagination,count_number,total_people,total_value);
				}else{
					$(".product_buy_today_all").append("<tr></tr><tr></tr><tr><td colspan='7' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td></tr><tr></tr><tr></tr>");
				}
			}
		});
	});
	$(".select_tea_type,.search_by_today_date").on("change",function(){
		$(".today_buy_paginnation").children("li").removeClass("active");
		$(this).parent("li").addClass("active");
		
		$.ajax({
			url:"../ajax/create_product.php",
			type:"POST",
			data:{"action":"auto select by today","today_date":$(".search_by_today_date").val(),"page":"1","product_type":$(".select_tea_type").val(),"customer_name":$(".search_by_customer_name").val()},
			success: function(data){
				$(".product_buy_today_all").children("tr").remove();
				$(".today_buy_paginnation").children("li").remove();
				$(".total").children("div").remove();
				var all_result=$.parseJSON(data);
				var result=all_result.result;
				var pagination=all_result.pagnation;
				var count_number=all_result.page;
				var total_people=all_result.total;
				var total_value=all_result.sum_value;
				if(result !=""){
					Pagination_For_Today_Buy(result,pagination,count_number,total_people,total_value);
				}else{
					$(".product_buy_today_all").append("<tr></tr><tr></tr><tr><td colspan='7' class='text-center text-danger'><b><?php echo $lang["no_result"]?></b></td></tr><tr></tr><tr></tr>");
				}
			}
		});
	});
	$(document).on("click",".confirm_update_today_product",function(){
		$.ajax({
			url:"../ajax/create_product.php",
			type:"POST",
			data:{"action_update":"update Product value","up_by_id":$(".update_by_product_id").val(),"up_customer_name":$(".update_customer_name").val(),"up_product_type":$(".update_product_type").val(),"up_valiage_name":$(".update_valiage_name").val(),"up_product_amount":$(".update_product_amount").val(),"up_product_price":$(".update_product_price").val(),"up_total_price":$(".updat_total_price").val()},
			success: function(data){
				if(data==1){
					alert('<?php echo $lang["update_success"]?>');
					window.location.reload(true);
				}else{
					alert("<?php echo $lang["update_not_success"]?>");
				}
			}
		});
	});
	$(document).on("click",".confirm_delete_today_product",function(){
		$.ajax({
			url:"../ajax/create_product.php",
			type:"POST",
			data:{"action_delete":"Sure to delete","product_id":$(".delete_by_product_id").val()},
			success: function(data){
				if(data==1){
					alert('<?php echo $lang["delete_success"]?>');
					window.location.reload(true);
				}else{
					alert("<?php echo $lang["delete_not_success"]?>");
				}
			}
		})
	})
	function Pagination_For_Today_Buy(result,pagination,count_number,number_people,total_value){
		if(count_number==1){
					var count=1;
				}else{
					var count=(parseInt(count_number)*10)+1;
				}
		$(".total").append("<div class='col-lg-4 col-md-4'><div class='form-group'><div class='row'><div class='col-lg-6 col-md-6'><?php echo $lang["number_of_people"]?></div><div class='col-lg-6 col-md-6'><input type='text' class='form-control' value='"+number_people+"' readonly></div></div></div></div>");
		$(".total").append("<div class='col-lg-4 col-md-4'><div class='form-group'><div class='row'><div class='col-lg-6 col-md-6'><?php echo $lang["total_amount"]?></div><div class='col-lg-6 col-md-6'><input type='text' class='form-control' value='"+(total_value.total_amount).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"' readonly></div></div></div></div>");
		$(".total").append("<div class='col-lg-4 col-md-4'><div class='form-group'><div class='row'><div class='col-lg-6 col-md-6'><?php echo $lang["total_price"]?></div><div class='col-lg-6 col-md-6'><input type='text' class='form-control' value='"+(total_value.total_price).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"' readonly></div></div></div></div>");
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
				$(".product_buy_today_all").append("<tr><td>"+(count++)+"</td><td>"+result[i].customer_name+"</td><td><input type='hidden' class='modual_product_type' value='"+result[i].product_type+"'>"+tea_type+"</td><td><input type='hidden' class='customer_valiage_name' value='"+result[i].valliage_name+"'>"+valiage_name+"</td><td>"+(result[i].product_amount).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+(result[i].product_price).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td>"+(result[i].total).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,")+"</td><td class='p-1'><div class='row'><input type='hidden' class='product_id' value='"+result[i].id+"'><button class='btn bg-success edit_btn_today text-white'><?php echo $lang['edit']?></button><button class='btn bg-danger delete_btn_today text-white'><?php echo $lang['delete']?></button></div></td></tr>");
			}
			if(pagination){
				// $(".today_buy_paginnation").append('<li class="page-item previous"><a class="page-link" aria-label="Previous" href="javascript:prevPage()"><span aria-hidden="true">&laquo;</span></a></li>');
				for(j=1; j <= pagination; j++){
					if(count_number==j){
						$(".today_buy_paginnation").append('<li class="page-item active"><a class="page-link page_no">'+j+'</a></li>')
					}else{
						$(".today_buy_paginnation").append('<li class="page-item"><a class="page-link page_no">'+j+'</a></li>')
					}
					
				}
				// $(".today_buy_paginnation").append('<li class="page-item"><a class="page-link" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>');
			}
		
	}
</script>
<!-- update Modal -->
<div class="modal fade" id="update_modal_today" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center w-100 text-success"><?php echo $lang["action"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" class="update_by_product_id">
      	<div class="row">
      		<div class="col-lg-4 col-md-4">
      			<div class="form-group">
      				<label><?php echo $lang["customer_name"];?></label>
        		</div>
      		</div>
      		<div class="col-lg-8 col-md-8">
      			<div class="form-group">
      				<input type="text" class="update_customer_name form-control">
        		</div>
      		</div>
        </div>
        <div class="row">
      		<div class="col-lg-4 col-md-4">
      			<div class="form-group">
      				<label><?php echo $lang["product_type"];?></label>
        		</div>
      		</div>
      		<div class="col-lg-8 col-md-8">
      			<div class="form-group">
  					<select class="form-control update_product_type">
						<?php
						$i=0;
						foreach ($lang["tea_type"] as $tea) {
							echo "<option value='".$i++."'>".$tea."</option>";
						}
						?>
					</select> 
        		</div>
      		</div>
        </div>
        <div class="row">
      		<div class="col-lg-4 col-md-4">
      			<div class="form-group">
      				<label><?php echo $lang["vali_name"];?></label>
        		</div>
      		</div>
      		<div class="col-lg-8 col-md-8">
      			<div class="form-group">
      				<!-- <input type="text" class="update_valiage_name form-control"> -->
      				<select class="form-control update_valiage_name">
						<?php
						$i=0;
						foreach ($lang["vali_value"] as $tea) {
							echo "<option value='".$i++."'>".$tea."</option>";
						}
						?>
					</select> 
        		</div>
      		</div>
        </div>
        <div class="row">
      		<div class="col-lg-4 col-md-4">
      			<div class="form-group">
      				<label><?php echo $lang["product_amount"];?></label>
        		</div>
      		</div>
      		<div class="col-lg-8 col-md-8">
      			<div class="form-group">
      				<input type="text" class="update_product_amount form-control">
        		</div>
      		</div>
        </div>
        <div class="row">
      		<div class="col-lg-4 col-md-4">
      			<div class="form-group">
      				<label><?php echo $lang["product_price"];?></label>
        		</div>
      		</div>
      		<div class="col-lg-8 col-md-8">
      			<div class="form-group">
      				<input type="text" class="update_product_price form-control">
        		</div>
      		</div>
        </div>
        <div class="row">
      		<div class="col-lg-4 col-md-4">
      			<div class="form-group">
      				<label><?php echo $lang["total_price"];?></label>
        		</div>
      		</div>
      		<div class="col-lg-8 col-md-8">
      			<div class="form-group">
      				<input type="text" class="form-control updat_total_price" readonly>
        		</div>
      		</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success confirm_update_today_product"><?php echo $lang["submit_btn"]; ?></button>
        <button type="button" class="btn" data-dismiss="modal"><?php echo $lang["close"]; ?></button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal_today" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<h4 class="text-center"><?php echo $lang["delete_sure"]; ?></h4>
      	<input type="hidden" class="delete_by_product_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success confirm_delete_today_product"><?php echo $lang["submit_btn"]; ?></button>
        <button type="button" class="btn" data-dismiss="modal"><?php echo $lang["close"]; ?></button>
      </div>
    </div>
  </div>
</div>