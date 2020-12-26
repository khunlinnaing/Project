<?php
	session_start();
	if(!isset($_SESSION['lang'])){
		$_SESSION['lang']='my';
	}else if(isset($_POST["language"]) && $_POST["language"] != $_SESSION['lang']&& !empty($_POST["language"])){
		if($_POST["language"]=="en"){
			$_SESSION['lang']='en';
		}else{
			$_SESSION['lang']='my';
		}
	}
	require $_SESSION['lang'].".php";
	
?>