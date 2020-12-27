<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
if(isset($_SESSION['user_id'])){
?>
<div class="container">
	
	<div class="row d-flex justify-content-center">
		<img src="../image/logo.png" class="rounded-circle" style="width: 168px;">
	</div>
	<h3 class="text-center my-1"><?php echo $lang["buy_tea"];?></h3>
	
	<input type="hidden" class="user_id" value="<?php echo $_SESSION['user_id']; ?>">
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0"><?php echo $lang["customer_name"];?></label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control customer" placeholder="<?php echo $lang["enter_customer"];?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0"><?php echo $lang["product_type"];?></label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<select class="form-control select_tea_type">
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
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0"><?php echo $lang["vali_name"];?></label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<select class="form-control valiage_name">
					<?php
					$i=0;
					foreach ($lang["vali_value"] as $valliage) {
						echo "<option value='".$i++."'>".$valliage."</option>";
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0"><?php echo $lang["product_amount"];?></label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control product_amount" placeholder="<?php echo $lang["enter_product_amount"];?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0"><?php echo $lang["product_price"];?></label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control product_price" placeholder="<?php echo $lang["enter_product_price"];?>" >
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0"><?php echo $lang["total_price"];?></label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control total_price" value="0" readonly >
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<input type="button" class="btn form-control check_list_btn bg-success text-white" value="<?php echo $lang["check_list"];?>">
		</div>
		<div class="col-lg-6 col-md-6">
			<input type="button" class="btn form-control prodcut_submit bg-success text-white" value="<?php echo $lang["submit_btn"];?>">
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".customer").on("input",function(){
			$(".customer").parent("div").children("p").remove();
			$(".customer").removeClass("border border-danger");
		});
		$(".prodcut_submit").on("click",function(){
			$(".customer,.product_amount,.product_price").parent("div").children("p").remove();
			$(".customer,.product_amount,.product_price").removeClass("border border-danger");
			var customer=$(".customer").val();
			var product_amount=$(".product_amount").val();
			var product_price=$(".product_price").val();
			var select_tea_type=$(".select_tea_type").val();
			var valiage_name=$(".valiage_name").val();
			var user_id=$(".user_id").val();
			var total_price=$(".total_price").val();
			var check_creat_product={"customer":"","product_amount":"","product_price":""};

			if(!customer){
				$(".customer").parent("div").append("<p class='text-danger'><?php echo $lang["enter_customer"];?></p>");
				$(".customer").addClass("border border-danger");
				check_creat_product["customer"]="error";
			}else{
				$(".customer").parent("div").children("p").remove();
				$(".customer").removeClass("border border-danger");
				check_creat_product["customer"]="";
			}
			if(!product_amount){
				$(".product_amount").parent("div").append("<p class='text-danger'><?php echo $lang["enter_product_amount"];?></p>");
				$(".product_amount").addClass("border border-danger");
				check_creat_product["product_amount"]="error";
			}else{
				$(".product_amount").parent("div").children("p").remove();
				$(".product_amount").removeClass("border border-danger");
				check_creat_product["product_amount"]="";
			}
			if(!product_price){
				$(".product_price").parent("div").append("<p class='text-danger'><?php echo $lang["enter_product_price"];?></p>");
				$(".product_price").addClass("border border-danger");
				check_creat_product["product_price"]="error";
			}else{
				$(".product_price").parent("div").children("p").remove();
				$(".product_price").removeClass("border border-danger");
				check_creat_product["product_price"]="";
			}
			if(check_creat_product["customer"] =="" && check_creat_product["product_amount"] =="" && check_creat_product["product_price"] ==""){
				$.ajax({
					url:"../ajax/create_product.php",
					type:"POST",
					data:{"create_product":"create Product","custer_name":customer,"product_type":select_tea_type,"valliage_name":valiage_name,"product_amount":product_amount,"product_price":product_price,"total_price":total_price,"user_id":user_id},
					success:function(data){
						console.log(data);
						if(data==1){
							$(".user_id").after('<div class="alert alert-success create_success text-center mt-3" role="alert"><?php echo $lang["create_product_success"]?></div>');
							$(".customer").val("");
							$(".product_amount").val("");
							$(".product_price").val("");
							$(".total_price").val(0)
						}else{

						}
					}
				});
			}
		});
	})
</script>
<?php
	require "footer.php";
	}else{
		echo "<script>window.location.href='login.php';</script>";
	}
?>