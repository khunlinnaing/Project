<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
?>

<div class="container">
	<h4 class="text-center text-success my-2"><?php echo $lang["register_page"]?></h4>
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row d-flex justify-content-center">
			<input type="file" name="profile" class="profile_upload">
			<img src="" class="image_upload">
			<img src="../image/delete.png" class="change_profile">
		</div>
		<h3 class="w-100 text-center py-2"><b><?php echo $lang["profile"]?></b></h3>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label><?php echo $lang["first_name"]?></label>
					<input type="text" name="first_name" class="form-control first_name" placeholder="<?php echo $lang["enter_first_name"]?>">
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label><?php echo $lang["last_name"]?></label>
					<input type="text" name="last_name" class="form-control last_name" placeholder="<?php echo $lang["enter_last_name"]?>">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="form-group">
					<label><?php echo $lang["email"]; ?></label>
					<input type="text" name="email" class="form-control email" placeholder="<?php echo $lang["enter_email"]; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["state_no"]; ?></label>
					<select class="form-control state_no" name="state_no">
					<?php  
						$state_value=$lang["state_names"];
						$i=1;
						foreach ($state_value as $value) {
						  echo "<option value='".$i++."'>".$value."</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["district"]; ?></label>
					<select class="form-control district_name" name="district">
						<?php
							$district_value=$lang["district_names"]["1"];
							foreach ($district_value as $value) {
							  echo "<option>".$value."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["naing_other"]; ?></label>
					<input type="text" name="national" class="form-control naing_other" value="<?php echo $lang["naing"]; ?>" readonly>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["register_no"]; ?></label>
					<input type="text" name="nrc_no" class="form-control nrc_no" placeholder="<?php echo $lang["enter_register_no"]; ?>">
					
				</div>
			</div>
		</div> 
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="form-group">
					<label><?php echo $lang["birthday"]; ?></label>
					<input type="date" name="birthday" class="form-control birthday">
				</div>
			</div>
		</div> 
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label><?php echo $lang["phone_no"]; ?></label>
					<input type="text" name="phone_no" class="form-control phone_no" placeholder="<?php echo $lang["enter_phone_no"]; ?>">
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label><?php echo $lang["mobile_no"]; ?></label>
					<input type="text" name="mobile_no" class="form-control mobile_no" placeholder="<?php echo $lang["enter_mobile_no"]; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="form-group">
					<b><?php echo $lang["gender"]; ?></b>
					<input type="hidden" name="gender" class="gender" value="male">
					<input type="radio" name="name" id="male" value="male" checked>
					<label for="male"><?php echo $lang["male"]; ?></label>
					<input type="radio" name="name" id="female" value="female">
					<label for="female"><?php echo $lang["female"]; ?></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="form-group">
					<label><?php echo $lang["address"]; ?></label>
					<input type="text" name="address" class="form-control address" placeholder="<?php echo $lang["enter_address"]; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label><?php echo $lang["password"]; ?></label>
					<input type="password" name="password" class="form-control" id="password" placeholder="<?php echo $lang['enter_password']; ?>">
				</div>
				<input type="checkbox" onclick="ShowPassword()">&#160;&#160;<?php echo $lang['show_password']; ?>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label><?php echo $lang["confirm_password"]; ?></label>
					<input type="password" name="confirm_password" class="form-control confirm_password" placeholder="<?php echo $lang["enter_confirm_password"]; ?>">
				</div>
			</div>
		</div> 
		<div class="row">
			<div class="col-lg-12 col-md-12 mt-3">
				<div class="form-group">
					<input type="button" class="form-control btn bg-success text-white register_btn" value="<?php echo $lang["register"]; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<a href="login.php" class="class_link text-primary mr-auto" ><b><?php echo $lang["already_acc"]; ?></b></a>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var error="<?php echo $lang["already_exit"]; ?>";
		$(".nrc_no").on("change",function(){
		var nrc_no=$(".state_no").val()+"/"+$(".district_name").val()+"("+$(".naing_other").val()+")"+$(this).val();
		$.ajax({
	    	url:"../ajax/register.php",
	    	type:"POST",
	    	data:{"check_nrc":"check nrc number","nrc_no":nrc_no},
	    	success: function(data){
	    		if(data==1){
	    			$(".nrc_no").parent("div").append('<p class="text-danger">'+error+'</p>')
	    			$(".nrc_no").val("");
	    			console.log("already exist")
	    		}else{
	    			$(".nrc_no_already").remove();
	    		}
	    	}
	    });
	});
	$(".email").on("change",function(){
		var email=$(this).val();
		$.ajax({
	    	url:"../ajax/register.php",
	    	type:"POST",
	    	data:{"email":email,"check_email":"check email"},
	    	success: function(data){
	    		if(data==1){
	    			$(".email").parent("div").append('<p class="text-danger">'+error+'</p>');
	    			$(".email").val("");
	    			console.log("already exist")
	    		}else{
	    			$(".email_already_exit").remove();
	    		}
	    	}
	    });
	});
	$(".register_btn").click(function(){
		$(".first_name,.last_name,.email,.nrc_no,.birthday,.phone_no,.mobile_no,.address,#password,.confirm_password").parent("div").children("p").remove();
		$(".first_name,.last_name,.email,.nrc_no,.birthday,.phone_no,.mobile_no,.address,#password,.confirm_password").removeClass("border border-danger");
		var first_name=$(".first_name").val();
		var last_name=$(".last_name").val();
		var email=$(".email").val();
		var state_no=$(".state_no").val();
		var district_name=$(".district_name").val();
		var naing_other=$(".naing_other").val();
		var nrc_no=$(".nrc_no").val();
		var birthday=$(".birthday").val();
		var phone_no=$(".phone_no").val();
		var mobile_no=$(".mobile_no").val();
		var gender=$(".gender").val();
		var address=$(".address").val();
		var password=$("#password").val();
		var con_password=$(".confirm_password").val();
		var email_format=/^[a-z0-9]+@([a-z]+\.)+[a-z]{2,5}$/;
		var profile=$(".image_upload").attr("src");
		if(profile){
			var image=profile.split(",");
		}else{
			var image='';
		}
		var check={"first_name":"","last_name":"","email":"","nrc_no":"","phone_no":"","mobile_no":"","address":"","password":"","confirm_password":""}
		if(!first_name){
			$(".first_name").parent("div").append("<p class='text-danger'><?php echo $lang["first_error"];?></p>");
			$(".first_name").addClass("border border-danger");
			check["first_name"]="error";
		}else{
			$(".first_name").parent("div").children("p").remove();
			$(".first_name").removeClass("border border-danger");
			check["first_name"]="";
		}
		
		if(!last_name){
			$(".last_name").parent("div").append("<p class='text-danger'><?php echo $lang["last_error"];?></p>");
			$(".last_name").addClass("border border-danger");
			check["last_name"]="error";
		}else{
			$(".last_name").parent("div").children("p").remove();
			$(".last_name").removeClass("border border-danger");
			check["last_name"]="";			
		}
		if(email=="" ){
			$(".email").parent("div").append("<p class='text-danger'><?php echo $lang["email_error"];?></p>");
			$(".email").addClass("border border-danger");
			check["email"]="error";
		}else if(!email_format.test(email)){
			$(".email").parent("div").append("<p class='text-danger'><?php echo $lang["email_format_error"];?></p>");
			$(".email").addClass("border border-danger");
			check["email"]="error";
		}else{
			$(".email").parent("div").children("p").remove();
			$(".email").removeClass("border border-danger");
			check["email"]="";
		}
		if(!nrc_no){
			$(".nrc_no").parent("div").append("<p class='text-danger'><?php echo $lang["nrc_no_error"];?></p>");
			$(".nrc_no").addClass("border border-danger");
			check["nrc_no"]="error";
		}else{
			if(nrc_no.length !=6){
				$(".nrc_no").parent("div").append("<p class='text-danger'><?php echo $lang["nrc_length_error"];?></p>");
				$(".nrc_no").addClass("border border-danger");
				check["nrc_no"]="error";
			}else{
				$(".nrc_no").parent("div").children("p").remove();
				$(".nrc_no").removeClass("border border-danger");
				check["nrc_no"]="";
			}
		}
		if(!phone_no){
			$(".phone_no").parent("div").append("<p class='text-danger'><?php echo $lang["phone_no_error"];?></p>");
			$(".phone_no").addClass("border border-danger");
			check["phone_no"]="error";
		}else{
			if(phone_no.length> 11 || phone_no.length<9){
				$(".phone_no").parent("div").append("<p class='text-danger'><?php echo $lang["phone_length_error"];?></p>");
				$(".phone_no").addClass("border border-danger");
				check["phone_no"]="error";
			}else{
				$(".phone_no").parent("div").children("p").remove();
				$(".phone_no").removeClass("border border-danger");
				check["phone_no"]="";
			}
		}
		if(!birthday){
			$(".birthday").parent("div").append("<p class='text-danger'><?php echo $lang["birthday_error"];?></p>");
			$(".birthday").addClass("border border-danger");
			check["birthday"]="error";
		}else{
			var current_time=new Date().getTime();
			var birthday_date=new Date(birthday).getTime();
			var age=current_time-birthday_date;
			var calculate_age=Math.floor(age/1000/60/60/24/365.25);
			if(calculate_age < 18){
				$(".birthday").parent("div").append("<p class='text-danger'><?php echo $lang["under_18_year"];?></p>");
				$(".birthday").addClass("border border-danger");
				check["birthday"]="error";
			}else{
				$(".birthday").parent("div").children("p").remove();
				$(".birthday").removeClass("border border-danger");
				check["birthday"]="";
			}
		}
		if(mobile_no){
			if(mobile_no.length> 11 || mobile_no.length<9){
				$(".mobile_no").parent("div").append("<p class='text-danger'><?php echo $lang["phone_length_error"];?></p>");
				$(".mobile_no").addClass("border border-danger");
				check["mobile_no"]="error";
			}else{
				$(".mobile_no").parent("div").children("p").remove();
				$(".mobile_no").removeClass("border border-danger");
				check["mobile_no"]="";
			}
		}
		if(!address){
			$(".address").parent("div").append("<p class='text-danger'><?php echo $lang["address_error"];?></p>");
			$(".address").addClass("border border-danger");
			check["address"]="error";
		}else{
			$(".address").parent("div").children("p").remove();
			$(".address").removeClass("border border-danger");
			check["address"]="";
		}
		if(!password){
			$("#password").parent("div").append("<p class='text-danger'><?php echo $lang["password_error"];?></p>");
			$("#password").addClass("border border-danger");
			check["password"]="error";
		}else{
			if(password.length<8){
				$("#password").parent("div").append("<p class='text-danger'><?php echo $lang["password_length_error"];?></p>");
				$("#password").addClass("border border-danger");
				check["password"]="error";
			}else{
				$("#password").parent("div").children("p").remove();
				$("#password").removeClass("border border-danger");
				check["password"]="";
			}
		}
		if(!con_password){
			$(".confirm_password").parent("div").append("<p class='text-danger'><?php echo $lang["con_password_error"];?></p>");
			$(".confirm_password").addClass("border border-danger");
			check["confirm_password"]="error";
		}else{
			if(password != con_password){
				$(".confirm_password").parent("div").append("<p class='text-danger'><?php echo $lang["not_compare"];?></p>");
				$(".confirm_password").addClass("border border-danger");
				check["confirm_password"]="error";
			}else{
				$(".confirm_password").parent("div").children("p").remove();
				$(".confirm_password").removeClass("border border-danger");
				check["confirm_password"]="";
			}
		}
		if(check["first_name"]=="" && check["last_name"]=="" && check["email"]=="" && check["nrc_no"]=="" && check["phone_no"]=="" && check["mobile_no"]=="" && check["address"]=="" && check["password"]=="" && check["confirm_password"]=="" && check["birthday"]==""){

		var last_name=$(".last_name").val();
		var email=$(".email").val();
		var state_no=$(".state_no").val();
		var district_name=$(".district_name").val();
		var naing_other=$(".naing_other").val();
		var nrc_no=$(".nrc_no").val();
		var birthday=$(".birthday").val();
		var phone_no=$(".phone_no").val();
		var mobile_no=$(".mobile_no").val();
		var gender=$(".gender").val();
		var address=$(".address").val();
		var password=$("#password").val();
		var con_password=$(".confirm_password").val();
		var email_format=/^[a-z0-9]+@([a-z]+\.)+[a-z]{2,5}$/;
		var profile=$(".image_upload").attr("src");
			$.ajax({
					url:"../ajax/register.php",
					type:"POST",
					data:{"first_name":first_name,"last_name":last_name,"email":email,"state_no":state_no,"district_name":district_name,"naing_other":naing_other,"nrc_no":nrc_no,"birthday":birthday,"phone_no":phone_no,"mobile_no":mobile_no,"gender":gender,"address":address,"password":password,"profile":image[1],"register":"register form"},
					success: function(data){
						if(data==1){
							window.location.href="login.php";
						}else{
							alert("error");
						}
					}
			});
		}else{
			
		}
		
	});
	})
</script>