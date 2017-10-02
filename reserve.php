<!DOCTYPE html>
<html>

<head>

<body align="middle">

<img src="DIT_logo.jpg" alt="DIT logo" style="width:304px;height:228px;">
<link rel="stylesheet" type="text/css" href="css.css">
</head>

<body>


<?php  
	$con = mysqli_connect("localhost", "root","","webdev_assignment");
	
	if(mysqli_connect_errno($con))
	{
		echo "Failed to connect to mySQL: " . mysqli_connect_error();
	}
	
	echo"<br>";
	echo"<p>Reserve Page</p>";
	mysqli_close($con);
?>  

</body>
</html>