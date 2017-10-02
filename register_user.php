<!DOCTYPE html>
<html>
<body>

<?php  
	
	session_start();	
	$con = mysqli_connect("localhost", "root","","webdev_assignment");
	
	if(mysqli_connect_errno($con))
	{
		echo "Failed to connect to mySQL: " . mysqli_connect_error();
	}
	//Make sure to not have whitesapce in "Username" ect
	$sql = "INSERT INTO user (FullName, UserName, Password, Email, Phone) VALUES('$_POST[FullName]','$_POST[Username]','$_POST[Password]','$_POST[Email]','$_POST[Phone]')";
	
	if( !mysqli_query($con, $sql))
	{
		die ('Error: ' . mysqli_error()); 
	}
	
	echo "1 Record added";
	echo "<br><a href=\"login.php\">Click here to return to login page.</a><br><br>";
	mysqli_close($con);
?>  

</body>
</html>