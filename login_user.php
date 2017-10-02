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
	
	//select everything in userDatabase
	$result = mysqli_query($con, "SELECT * FROM user");
	
	//store info from form here
	$userName =  mysql_real_escape_string( $_POST["username"] );
	$password =  mysql_real_escape_string ( $_POST["Password"] );
	
	//loop through array and see if user name and password are there.
	while($row = mysqli_fetch_array($result))
	{
		if( ($row['UserName'] == $userName) && ($row['Password'] == $password) )
		{
				//echo "Same";
				//store user name for current login so It can be used to reserve books
				$_SESSION["user"] = $row['UserName'];
				header("location:search.php");	
		}
		else
		{
				echo "<p>Incorrect Login: Please ensure you are registered!!!!</p>";
				echo "<a href=\"login.php\">Click here to return to login page.</a><br><br>";
				echo "<a href=\"register.php\">Click here to register.</a>";
				
		}
	}
	mysqli_close($con);
?>  

</body>
</html>