<?php
	ini_set("mysql.connection_timeout",300);
	ini_set("default_socket_timeout",300);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
	</br>
	<input type="file" name="profile">
	<br /><br/>
	<input type="submit" name="submit" value="Upload">
</form>
<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "zaybanproject";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$select = "SELECT * FROM res_partner";
		$result = $conn->query($select);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    // echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<img src='data:image;base64," .$row["image"]. "'><br>";
		    echo $row["profile"];
		  }
		} else {
		  echo "0 results";
		}
		$conn->close();
		die();
	if(isset($_POST['submit'])){
		if(getimagesize($_FILES['profile']['tmp_name'])== FALSE){
			echo "please select an image";
		}else{
			$image= addslashes($_FILES['profile']['tmp_name']);
			$name=addslashes($_FILES['profile']['name']);
			$image=file_get_contents($image);
			$image=base64_encode($image);
			echo strlen($image);
			saveimage($name,$image);
		}
	}
	function saveimage($name,$image){
		
		
		$sql = "insert into images (name,image) values ('$name','$image')";
		if ($conn->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
			// select 
		$select = "SELECT * FROM images";
		$result = $conn->query($select);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<img src='data:image;base64," .$row["image"]. "'><br>";
		  }
		} else {
		  echo "0 results";
		}
		$conn->close();
	}
?>
</body>
</html>