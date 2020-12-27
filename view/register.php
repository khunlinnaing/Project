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
			image=image[1];
		}else{
			var image='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';
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
			$.ajax({
					url:"../ajax/register.php",
					type:"POST",
					data:{"first_name":first_name,"last_name":last_name,"email":email,"state_no":state_no,"district_name":district_name,"naing_other":naing_other,"nrc_no":nrc_no,"birthday":birthday,"phone_no":phone_no,"mobile_no":mobile_no,"gender":gender,"address":address,"password":password,"profile":image,"register":"register form"},
					success: function(data){
						console.log(data);
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