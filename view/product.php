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
	<h3 class="text-center my-1">hello world</h3>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0">Customer Name</label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control customer" placeholder="Please enter your customer name">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0">Product type</label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<select class="form-control select_tea_type">
					<option>wet tea</option>
					<option>dry tea</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0">Valiage Name</label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<select class="form-control valiage_name">
					<option>wet tea</option>
					<option>dry tea</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0">Product Amount</label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control product_amount" placeholder="Please enter product amount">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0">Product Price</label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control product_price" placeholder="Please enter product price" >
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<div class="form-group">
				<label  class="form-control border-0">Total Price</label>
			</div>
		</div>
		<div class="col-lg-10 col-md-10">
			<div class="form-group">
				<input type="text" class="form-control product_price" value="0" readonly >
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<input type="button" class="btn form-control prodcut submit bg-success text-white" value="Submit Product">
		</div>
	</div>
</div>
<?php
	require "footer.php";
	}else{
		echo "<script>window.location.href='login.php';</script>";
	}
?>