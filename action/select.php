<?php 
	require "../languages/config.php";
	if(isset($_POST["state"])){
		$district_name=$lang["district_names"];
		foreach ($district_name[$_POST["state"]] as $district_state) {
			echo "<option>".$district_state."</option>";
		}
	}
?>