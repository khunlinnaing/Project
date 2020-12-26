<?php
	require "../data_config/config.php";
	require "../classes/res_partner.class";
	$database=new Database_Connection();
	$db=$database->getConnection();
	$create_user=new Create_Res_Partner($db);
	if(isset($_POST["register"])){
			$name=$_POST["first_name"]." ".$_POST["last_name"];
			$email=$_POST["email"];
			$nrc_no=$_POST["state_no"]."/".$_POST["district"]."(".$_POST["national"].")".$_POST["nrc_no"];
			$birthday=$_POST["birthday"];
			$phone_no=$_POST["phone_no"];
			$mobile_no=$_POST["mobile_no"];
			$address=$_POST["address"];
			$password=password_hash($_POST["password"], PASSWORD_DEFAULT);
			$gender=$_POST["gender"];
			if(isset($_POST["profile"])){
				$profile= addslashes($_FILES['profile']['tmp_name']);
				$profile=file_get_contents($profile);
				$profile=base64_encode($profile);
			}else{
				$profile="";
			}

			$data=array("name"=>$name,"email"=>$email,"nrc_no"=>$nrc_no,"birthday"=>$birthday,"phone_no"=>$phone_no,"mobile_no"=>$mobile_no,"address"=>$address,"password"=>$password,"gender"=>$gender,"profile"=>$profile);
			$result=$create_user->Create_User_Info($data);
			if($result==1){
				echo "<script>window.location.href='login.php';</script>";
			}
	}





if(isset($_POST["check_email"])){
	$data=array("email"=>$_POST["email"]);
	$result=$create_user->Validation_Email($data);
	echo $result;
}

if(isset($_POST["check_nrc"])){
	$data=array("nrc_no"=>$_POST["nrc_no"]);
	$result=$create_user->Validation_Nrc_No($data);
	echo $result;
}
if(isset($_POST["login"])){
	$data=array("email"=>$_POST["email"],"password"=>$_POST["password"]);
	$result=$create_user->Login_Page($data);
	if(isset($result["id"])){
		session_start();
		$_SESSION["user_id"]=$result["id"];
		$_SESSION["user_name"]=$result["user_name"];
		$_SESSION["user_profile"]=$result["profile"];
		echo "1";
	}else{
		echo $result;
	}
}
if(isset($_POST["logout"])){
	session_start();
	$logout=session_destroy();
	echo $logout;
}
?>