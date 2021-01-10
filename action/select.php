<?php 
	require "../languages/config.php";
	if(isset($_POST["state"])){
		$district_name=$lang["district_names"];
		$i=0;
		foreach ($district_name[$_POST["state"]] as $district_state) {
			echo "<option value='".$i++."'>".$district_state."</option>";
		}
	}
?>