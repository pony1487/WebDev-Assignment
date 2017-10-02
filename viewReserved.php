<!DOCTYPE html>
<html>

<head>

<body align="middle">

<img src="DIT_logo.jpg" alt="DIT logo" style="width:304px;height:228px;">
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<h3>Books on Reserve Page</h3>

<?php  
	session_start();
	$con = mysqli_connect("localhost", "root","","webdev_assignment");
	
	if(mysqli_connect_errno($con))
	{
		echo "Failed to connect to mySQL: " . mysqli_connect_error($con);
	}
	
	$user = $_SESSION["user"];
	
	echo "$user";
	
	$result = mysqli_query($con, "SELECT * FROM reservations WHERE reservations.UserName = '$user' ");
	
	echo '<table border="1" align="center">'."\n";
	echo "<tr><th>User</th><th>ISBN</th><th>Rented</th><th>Return Book</th></tr>";
	
	if (!$result) 
	{ 
		die('Invalid query: ' . mysql_error());
	}
	else
	{
			while($row = mysqli_fetch_array($result))
			{
				if($row['UserName'] == $user)
				{
					echo "<tr><td>";
					echo(htmlentities($row['UserName']));
					echo("</td>\n");
					
					echo "<td>";
					echo(htmlentities($row['ISBN']));
					echo("</td>\n");
					
					echo "<td>";
					echo(htmlentities($row['ReserverDate']));
					echo("</td>\n");
					
					echo "<td>";
						
						//return book form
						echo('<form method="post"> ');
						echo(' <input type="hidden" name="id" value="'.$row["ISBN"].'">'."\n");//get book title to insert into reservations table
						echo('<input type="submit" value="Return" name="Return">');
						echo("\n</form>\n");
						echo "</td>";
				}
			}//end while
	}//end else
		
		
	//return book
	//reserve book
	if ( isset($_POST['Return']) )
	{
		$reserveISBN = $_POST["id"];
		
		// sql to delete a record
		$sql = "DELETE FROM reservations WHERE ISBN = $reserveISBN";
		$updateBookTableSQL = "UPDATE books SET RESERVERED=0 WHERE ISBN = $reserveISBN";
		
		if( !mysqli_query($con, $sql))
		{
			die ('Error: ' . mysqli_error($con)); 
		}
		else
		{
			echo"<br>Reservation table updated";
		}
		
		if( !mysqli_query($con, $updateBookTableSQL))
		{
			die ('Error: ' . mysqli_error($con)); 
		}
		else
		{
			echo"<br>Books table updated";
		}
	}//end if
		
	echo"<br><br>";
	//echo"<a href='search.php' id='footer_link'>Return to Search Page</a>";
	echo"<form action ='search.php' method='post'>";
	echo"<input type='submit' value='Search Page' name='SearchPage'>";
	echo"</form>";
	echo"<br><br>";
	mysqli_close($con);
?>  



</body>
</html>