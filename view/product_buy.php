<?php
require_once "header.php";
require_once "../ajax/join_ajax.php";
if(isset($_SESSION['user_id'])){
?>

<?php
	require "footer.php";
	}else{
		echo "<script>window.location.href='login.php';</script>";
	}
?>