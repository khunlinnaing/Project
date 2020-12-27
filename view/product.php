<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
if(isset($_SESSION['user_id'])){
	echo $_SESSION["user_id"];
?>
<div class="container">
	
	<div class="row d-flex justify-content-center">
		<img src="../image/logo.png" class="rounded-circle" style="width: 168px;">
	</div>
	<h3 class="text-center my-1"><?php echo $lang["buy_tea"];?></h3>
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
		<div class="col-lg-12 col-md-12">
			<input type="button" class="btn form-control prodcut submit bg-success text-white" value="Submit Product">
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
	})
</script>
<?php
	require "footer.php";
	}else{
		echo "<script>window.location.href='login.php';</script>";
	}
?>