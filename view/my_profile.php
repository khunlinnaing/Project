<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
require "../data_config/config.php";
	require "../classes/res_partner.class";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$create_user=new Create_Res_Partner($db);
	if(isset($_SESSION["user_id"])){
		$data=array("user_id"=>$_SESSION["user_id"]);
		$result=$create_user->Auto_Select_About_Login($data);
		if(isset($result)){
			$nrc=explode("/",$result[0]["nrc_no"]);
			$station_val=$lang["district_short_name"];
			$birthday_date = new DateTime($result[0]["birthday"]);
			echo '<div class="container">
					<div class="row d-flex justify-content-center my-3">
						<img src="data:image;base64,'.$result[0]["profile"].'" style="width:20%;">
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["full_name"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$result[0]["user_name"].'">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["email"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$result[0]["email"].'">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["nrc_full_no"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$nrc[0].'/'.$station_val[$nrc[0]][$nrc[1]].'('.$lang[$nrc[2]].')'.$nrc[3].'">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["birthday"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$birthday_date->format('d-m-Y').'">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["gender"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$lang[$result[0]["gender"]].'">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["phone_no"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$result[0]["phone_no"].'">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["mobile_no"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$result[0]["mobile_no"].'">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="form-group">
								<label>'.$lang["address"].'</label>
							</div>
						</div>
						<div class="col-lg-10 col-md-10">
							<div class="form-group">
								<input type="text" class="form-control user_name" readonly value="'.$result[0]["address"].'">
							</div>
						</div>
					</div>
					<div class="row">
						<button class="btn bg-success form-control text-white" data-toggle="modal" data-target="#update_profile">'.$lang['edit'].'</button>
					</div>
				</div>	
					';
		}
	}else{
		echo "no data";
	}
?>


<!-- update Profile Modal -->
<div class="modal fade" id="update_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center w-100 text-success">Profile<?php echo $lang["action"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" class="user_id" value="<?php echo $result[0]["id"];?>">
      	<div class="row d-flex justify-content-center my-3">
			<img src="data:image;base64,<?php echo $result[0]["profile"];?>" style="width: 30%;" id="update_profile_image">
			<input type="file" class="upload_image" style="display: none;">

		</div>
		<div class="row"><p class="text-center w-100"><?php echo $lang["upload_update_profile"]; ?></p></div>
		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="form-group">
					<label><?php echo $lang["full_name"] ?></label>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="form-group">
					<input type="text" class="form-control profile_user_name" value="<?php echo $result[0]["user_name"]; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="form-group">
					<label><?php echo $lang["email"]; ?></label>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="form-group">
					<input type="text" class="form-control profile_email" value="<?php echo $result[0]["email"]; ?>">
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
							if($nrc[0]==$i){
								echo "<option value='".$i++."' selected>".$value."</option>";
							}else{
								echo "<option value='".$i++."'>".$value."</option>";
							}
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
						$i=0;
							$district_value=$lang["district_names"][$nrc[0]];
							foreach ($district_value as $value) {
								if($i==$nrc[1]){
									echo "<option value='".$i++."' selected>".$value."</option>";
								}else{
									echo "<option value='".$i++."'>".$value."</option>";
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["naing_other"]; ?></label>
					<input type="text" name="national" class="form-control" value="<?php echo $lang["naing"]; ?>" readonly>
					<input type="hidden" class="profile_naing" value="naing">
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["register_no"]; ?></label>
					<input type="text" name="nrc_no" class="form-control profile_nrc_no" placeholder="<?php echo $lang["enter_register_no"]; ?>" value="<?php echo $nrc[3]; ?>">
					
				</div>
			</div>
		</div> 
		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="form-group">
					<label><?php echo $lang["birthday"];?></label>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="form-group">
					<input type="text" class="form-control profile_birthday" value="<?php echo $birthday_date->format('d-m-Y'); ?>">
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label><?php echo $lang["gender"]; ?></label>
				</div>
			</div>
			<div class="col-lg-9 col-md-9">
				<div class="form-group">
					<input type="hidden" class="form-control profile_gender" data="<?php echo $lang[$result[0]["gender"]];?>" value="<?php echo $result[0]["gender"];?>">
					<input type="radio" name="name" id="update_profile_male" value="male">
					<label for="update_profile_male"><?php echo $lang["male"]; ?></label>
					<input type="radio" name="name" id="update_profile_female" value="female">
					<label for="update_profile_female"><?php echo $lang["female"]; ?></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="form-group">
					<label><?php echo $lang["phone_no"] ?></label>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="form-group">
					<input type="text" class="form-control profile_phone_no" value="<?php echo $result[0]["phone_no"] ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="form-group">
					<label><?php echo $lang["mobile_no"] ?></label>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="form-group">
					<input type="text" class="form-control profile_mobile_no" value="<?php echo $result[0]["mobile_no"] ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="form-group">
					<label><?php echo $lang["address"] ?></label>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="form-group">
					<input type="text" class="form-control profile_address" value="<?php echo $result[0]["address"] ?>">
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_profile_save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var update_profile=$(".profile_gender").attr("data");
	if(update_profile=="<?php echo $lang["male"]; ?>"){
		$('#update_profile_male').attr('checked', true);
	}else{
		$('#update_profile_female').attr('checked', true);
	}
	$(document).on("click","#update_profile_image",function(){
		$('.upload_image').click();
	});
	$(".upload_image").on("input",function(){
		var file_type=$(this).val().split('.').pop().toLowerCase();
		if (file_type=='jpeg' || file_type=='jpg' || file_type=='png') {
			if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			      	$('#update_profile_image').attr('src', e.target.result);
			    }
			    reader.readAsDataURL(this.files[0]);
			  }
        }else{
        	alert("Upload only png,jpeg,jpg");
          $(this).val('');
        }
	});
	$(document).on("click",".update_profile_save",function(){
		$(".profile_user_name,.profile_email,.profile_nrc_no,.profile_birthday,.profile_phone_no,.profile_mobile_no,.profile_address").parent("div").children("p").remove();
		$(".profile_user_name,.profile_email,.profile_nrc_no,.profile_birthday,.profile_phone_no,.profile_mobile_no,.profile_address").removeClass("border border-danger");
		var user_id=$(".user_id").val();
		var p_user_name=$(".profile_user_name").val();
		var p_email=$(".profile_email").val();
		var p_state_no=$(".state_no").val();
		var p_district_name=$(".district_name").val();
		var p_profile_naing=$(".profile_naing").val();
		var p_nrc_no=$(".profile_nrc_no").val();
		var p_birthday=$(".profile_birthday").val();
		var p_gender=$(".profile_gender").val();
		var p_phone_no=$(".profile_phone_no").val();
		var p_mobile_no=$(".profile_mobile_no").val();
		var p_address=$(".profile_address").val();
		var email_format=/^[a-z0-9]+@([a-z]+\.)+[a-z]{2,5}$/;
		var date_format=/^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;
		var profile=$("#update_profile_image").attr("src");
		if(profile){
			var image=profile.split(",");
			image=image[1];
		}
		var check_profile_value={"p_user_name":"","p_email":"","p_nrc_no":"","p_birthday":"","p_phone_no":"","p_mobile_no":"","p_address":""};
		if(p_user_name==""){
			$(".profile_user_name").parent("div").append("<p class='text-danger'><?php echo $lang["enter_your_name"];?></p>");
			$(".profile_user_name").addClass("border border-danger");
			check_profile_value["p_user_name"]="error";
		}else{
			$(".profile_user_name").parent("div").children("p").remove();
			$(".profile_user_name").removeClass("border border-danger");
			check_profile_value["p_user_name"]="";
		}
		if(p_email==""){
			$(".profile_email").parent("div").append("<p class='text-danger'><?php echo $lang["email_error"];?></p>");
			$(".profile_email").addClass("border border-danger");
			check_profile_value["p_email"]="error";
		}else if(!email_format.test(p_email)){
			$(".profile_email").parent("div").append("<p class='text-danger'><?php echo $lang["email_format_error"];?></p>");
			$(".profile_email").addClass("border border-danger");
			check_profile_value["p_email"]="error";
		}else{
			$(".profile_email").parent("div").children("p").remove();
			$(".profile_email").removeClass("border border-danger");
			check_profile_value["p_email"]="";
		}
		if(!p_nrc_no){
			$(".profile_nrc_no").parent("div").append("<p class='text-danger'><?php echo $lang["nrc_no_error"];?></p>");
			$(".profile_nrc_no").addClass("border border-danger");
			check_profile_value["p_nrc_no"]="error";
		}else{
			if(p_nrc_no.length !=6){
				$(".profile_nrc_no").parent("div").append("<p class='text-danger'><?php echo $lang["nrc_length_error"];?></p>");
				$(".profile_nrc_no").addClass("border border-danger");
				check_profile_value["p_nrc_no"]="error";
			}else{
				$(".profile_nrc_no").parent("div").children("p").remove();
				$(".profile_nrc_no").removeClass("border border-danger");
				check_profile_value["p_nrc_no"]="";
			}
		}

		if(!p_birthday){
			$(".profile_birthday").parent("div").append("<p class='text-danger'><?php echo $lang["birthday_error"];?></p>");
			$(".profile_birthday").addClass("border border-danger");
			check_profile_value["p_birthday"]="error";
		}else if(!date_format.test(p_birthday)){
			$(".profile_birthday").parent("div").append("<p class='text-danger'><?php echo $lang["date_format_error"];?></p>");
				$(".profile_birthday").addClass("border border-danger");
				check_profile_value["p_birthday"]="error";
		}else{
			var current_time=new Date().getTime();
			var birthday_date=new Date(p_birthday).getTime();
			var age=current_time-birthday_date;
			var calculate_age=Math.floor(age/1000/60/60/24/365.25);
			if(calculate_age < 18){
				$(".profile_birthday").parent("div").append("<p class='text-danger'><?php echo $lang["under_18_year"];?></p>");
				$(".profile_birthday").addClass("border border-danger");
				check_profile_value["p_birthday"]="error";
			}else{
				$(".profile_birthday").parent("div").children("p").remove();
				$(".profile_birthday").removeClass("border border-danger");
				check_profile_value["p_birthday"]="";
			}
		}
		if(!p_phone_no){
			$(".profile_phone_no").parent("div").append("<p class='text-danger'><?php echo $lang["phone_no_error"];?></p>");
			$(".profile_phone_no").addClass("border border-danger");
			check_profile_value["p_phone_no"]="error";
		}else{
			if(p_phone_no.length> 11 || p_phone_no.length<9){
				$(".profile_phone_no").parent("div").append("<p class='text-danger'><?php echo $lang["phone_length_error"];?></p>");
				$(".profile_phone_no").addClass("border border-danger");
				check_profile_value["p_phone_no"]="error";
			}else{
				$(".profile_phone_no").parent("div").children("p").remove();
				$(".profile_phone_no").removeClass("border border-danger");
				check_profile_value["p_phone_no"]="";
			}
		}
		if(p_mobile_no){
			if(p_mobile_no.length> 11 || p_mobile_no.length<9){
				$(".profile_mobile_no").parent("div").append("<p class='text-danger'><?php echo $lang["phone_length_error"];?></p>");
				$(".profile_mobile_no").addClass("border border-danger");
				check_profile_value["p_mobile_no"]="error";
			}else{
				$(".profile_mobile_no").parent("div").children("p").remove();
				$(".profile_mobile_no").removeClass("border border-danger");
				check_profile_value["p_mobile_no"]="";
			}
		}
		if(!p_address){
			$(".profile_address").parent("div").append("<p class='text-danger'><?php echo $lang["address_error"];?></p>");
			$(".profile_address").addClass("border border-danger");
			check_profile_value["p_address"]="error";
		}else{
			$(".profile_address").parent("div").children("p").remove();
			$(".profile_address").removeClass("border border-danger");
			check_profile_value["p_address"]="";
		}

		if(check_profile_value["p_user_name"] =="" && check_profile_value["p_email"]=="" && check_profile_value["p_nrc_no"] =="" && check_profile_value["p_birthday"] =="" && check_profile_value["p_phone_no"] =="" && check_profile_value["p_mobile_no"] =="" && check_profile_value["p_address"] ==""){
			$.ajax({
				url:"../ajax/register.php",
				type:"POST",
				data:{"update_profile":"update register","user_id":user_id,"user_name":p_user_name,"email":p_email,"state_no":p_state_no,"district_name":p_district_name,"naing_other":p_profile_naing,"nrc_no":p_nrc_no,"birthday":p_birthday,"gender":p_gender,"phone_no":p_phone_no,"mobile_no":p_mobile_no,"address":p_address,"image":image},
				success:function(data){
					if(data==1){
						alert('<?php echo $lang["update_success"]?>');
						window.location.reload(true);
					}else{
						alert("<?php echo $lang["update_not_success"]?>");
					}
				}
			});
		}

	});
</script>