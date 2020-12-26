<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
?>
<div class="container">
		<h3 class="text-center text-success p-4"><?php echo $lang["login_pag"]; ?></h3>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<img src="../image/logo.png" class="w-100">
		</div>
		<div class="col-lg-6 col-md-6 pt-5">
			<div class="form-group">
				<label for="login_email"><?php echo $lang["email"]; ?></label>
				<input type="text" class="form-control login_email" placeholder="<?php echo $lang['enter_email']; ?>">
			</div>
			<div class="form-group">
				<label for="login_password"><?php echo $lang["password"]; ?></label>
				<input type="password" class="form-control login_password" id="password" placeholder="<?php echo $lang['enter_password']; ?>">
			</div>
			<div class="form-group">
				<input type="checkbox" onclick="ShowPassword()">&#160;&#160;<?php echo $lang['show_password']; ?>
			</div>
			<div class="form-group">
				<button class="btn bg-success form-control login_submit text-white"><?php echo $lang['login']; ?></button>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<a href="register.php" class="class_link text-primary"><b><?php echo $lang['not_account']; ?></b></a>
					</div>
					<div class="col-lg-6 col-md-6" style="text-align: right;">
						<a href="forget_password.php" class="class_link text-primary mr-auto" ><b><?php echo $lang['forget_password']; ?></b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once "footer.php";
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".login_submit").on("click",function(){
			$(".login_password,.login_email").parent("div").children("p").remove();
			$(".login_password,.login_email").removeClass("border border-danger");
			var email=$(".login_email").val();
			var password=$(".login_password").val();
			var email_format=/^[a-z0-9]+@([a-z]+\.)+[a-z]{2,5}$/;
			var check_error={"email":"","password":""};

			if(email=="" ){
				$(".login_email").parent("div").append("<p class='text-danger'><?php echo $lang["email_error"];?></p>");
				$(".login_email").addClass("border border-danger");
				check_error["email"]="error";
			}else{
				if(!email_format.test(email)){
					$(".login_email").parent("div").append("<p class='text-danger'><?php echo $lang["email_format_error"];?></p>");
					$(".login_email").addClass("border border-danger");
					check_error["email"]="error";
				}else{
					$(".login_email").parent("div").children("p").remove();
					$(".login_email").removeClass("border border-danger");
					check_error["email"]="";
				}
			}
			if(!password){
				$(".login_password").parent("div").append("<p class='text-danger'><?php echo $lang["password_error"];?></p>");
				$(".login_password").addClass("border border-danger");
				check_error["password"]="error";
			}else{
				if(password.length<8){
					$(".login_password").parent("div").append("<p class='text-danger'><?php echo $lang["password_length_error"];?></p>");
					$(".login_password").addClass("border border-danger");
					check_error["password"]="error";
				}else{
					$(".login_password").parent("div").children("p").remove();
					$(".login_password").removeClass("border border-danger");
					check_error["password"]="";
				}
			}
			if(check_error["email"]=="" && check_error["password"]==""){
				$.ajax({
		    	url:"../ajax/register.php",
		    	type:"POST",
		    	data:{"login":'login value',"email":email,"password":password},
		    	success: function(data){
		    		console.log(data);
		    		if(data==2){
		    			$(".login_password").parent("div").append("<p class='text-danger'><?php echo $lang["password_incorrect"];?></p>");
						$(".login_password").addClass("border border-danger");
		    		}else if(data==3){
		    			$(".login_email").parent("div").append("<p class='text-danger'><?php echo $lang["email_incorrect"];?></p>");
						$(".login_email").addClass("border border-danger");
		    		}else{
		    			window.location.href="product.php";
		    		}
		    	}
		    });
			}
		});
	});
</script>