<!DOCTYPE html>
<html>

<head>

<body align="middle">

<img src="DIT_logo.jpg" alt="DIT logo" style="width:304px;height:228px;">
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<?php  

	//start session and connect to local host
	session_start();
	$con = mysqli_connect("localhost", "root","","webdev_assignment");
	
	if(mysqli_connect_errno($con))
	{
		echo "Failed to connect to mySQL: " . mysqli_connect_error();
	}
	
	//select everything in userDatabase
	$result = mysqli_query($con, "SELECT * FROM books");
	$result2 = mysqli_query($con, "SELECT * FROM books,categories WHERE books.Category = categories.CategoryID");
	$found = 0;
	
	
	
	//check which form is submitted
	if(isset($_POST['Category']))
	{	
		//store the category in a variable
		$categorySearch = $_POST["Category"];
		//display table header
		echo '<table border="1" align="center">'."\n";
		echo "<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Edition</th><th>Year</th><th>Category</th><th>Rented</th><th>Reserve</th></tr>";
		
		while($row = mysqli_fetch_array($result2))
			{
				if( ($row['CategoryDesc'] == $categorySearch) )
				{
						echo "<tr><td>";
						echo(htmlentities($row['ISBN']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['BookTitle']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Author']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Edition']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Year']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Category']));
						echo("</td>\n");
						
						echo "<td>";
						//spelt column wrong when creating database
						echo(htmlentities($row['RESERVERED']));
						echo("</td>\n");
						
						echo "<td>";
						//echo('<a href="reserve.php?id='.htmlentities($row['BookTitle']).'">Click to reserve</a> ');
						
						//form which allows the user to reserve a book
						echo('<form method="post"> ');
						echo(' <input type="hidden" name="id" value="'.$row["BookTitle"].'">'."\n");//get book title to insert into reservations table
						echo(' <input type="hidden" name="id2" value="'.$row["ISBN"].'">'."\n");//get ISBN
						echo(' <input type="hidden" name="id3" value="'.$row["RESERVERED"].'">'."\n");//get RESERVERED value
						echo('<input type="submit" value="Reserve" name="Reserve">');
						echo("\n</form>\n");
						echo "</td>";
				}
					
			}//end while		
	}//end if
	
	//author or title search
	if(isset($_POST['userSearch']))
	{
		$userSearch =  mysql_real_escape_string( $_POST["userSearch"] );
		
			//loop through array and see if book title OR author is there
			while($row = mysqli_fetch_array($result))
			{
				//echo $row['FullName'] . " " . $row['UserName'] . " " . $row['Password'] . " " .$row['Email'] . " " . $row['Phone'];
				//echo "<br/>";
				while( ($row['BookTitle'] == $userSearch)   || ($row['Author'] == $userSearch)  || strpos($row['BookTitle'],$userSearch)!==false || strpos($row['Author'],$userSearch)!==false)
				{
						$found = 1;
						echo '<table border="1" align="center">'."\n";
						
						echo "<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Edition</th><th>Year</th><th>Category</th><th>Rented</th><th>Reserve</th></tr>";
						
						echo "<tr><td>";
						echo(htmlentities($row['ISBN']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['BookTitle']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Author']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Edition']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Year']));
						echo("</td>\n");
						
						echo "<td>";
						echo(htmlentities($row['Category']));
						echo("</td>\n");
						
						echo "<td>";
						//spelt column wrong
						echo(htmlentities($row['RESERVERED']));
						echo("</td>\n");
						
						echo "<td>";
						//echo('<a href="reserve.php?id='.htmlentities($row['BookTitle']).'">Click to reserve</a> ');
						
						echo('<form method="post"> ');
						echo(' <input type="hidden" name="id" value="'.$row["BookTitle"].'">'."\n");//get book title to insert into reservations table
						echo(' <input type="hidden" name="id2" value="'.$row["ISBN"].'">'."\n");//get ISBN
						echo(' <input type="hidden" name="id3" value="'.$row["RESERVERED"].'">'."\n");//get RESERVERED value
						echo('<input type="submit" value="Reserve" name="Reserve">');
						echo("\n</form>\n");
						echo "</td>";
						
						//echo("</td><td>");
						
						

						break;
						//header("location:search.php");
				}
					
			}//end while
			
				//NO MATCH FOUND
				if($found != 1)
				{
				$message = "No match found!";
				echo "<script type='text/javascript'>alert('$message');</script>";
				
				}
				
	}//end if
	
	
	//reserve book
	if ( isset($_POST['Reserve']) )
	{
		
		$reserveTitle = $_POST["id"];
		$reserveISBN = $_POST["id2"];
		$isReserved = $_POST["id3"];
		
		//echo "$reserveTitle <br>";
		//echo "$reserveISBN";
		
		
		if($isReserved == 1)
		{
			echo"<br>WHOOPS!! This book is currently not available for rent<br><br>";
			//echo "<a href=\"search.php\">Click here to return to search page.</a><br><br>";
		}
		else
		{
			
			echo "<br><h2>You have rented the following</h2><br>";
			echo"<p>TITLE: $reserveTitle</p><br>";
			echo "<p>ISBN: $reserveISBN</p><br><br>";

			
			
			//userName from login if login was successful
			echo "<br>Logged in as: ".$_SESSION["user"];
			
			$var = $_SESSION["user"];
			$current_date = date("Y-m-d H:i:s");
			
			
			$reserveSQL = "INSERT INTO reservations (ISBN,UserName,ReserverDate) VALUES ('$reserveISBN','$var','$current_date ')";
			$updateSQL = "UPDATE books SET RESERVERED=1 WHERE ISBN = $reserveISBN";

			//insert record
			if( !mysqli_query($con, $reserveSQL))
			{
				die ('Error: ' . mysqli_error($con)); 
			}
			else
			{
				echo"<br>1 record inserted";
			}
			
			//update record so its "rented"
			if( !mysqli_query($con, $updateSQL))
			{
				die ('Error: ' . mysqli_error($con)); 
			}
			else
			{
				echo"<br>Table updated";
			}
		}//end else
		
	}//end if
	
	//RESET EVERY BOOK TO 0
	if ( isset($_POST['RESET']) )
	{
		
			$resetSQL = "UPDATE books SET RESERVERED = 0 WHERE RESERVERED = 1";
			//Reset record
			if( !mysqli_query($con, $resetSQL))
			{
				die ('Error: ' . mysqli_error($con)); 
			}
			else
			{
				echo"<br>Books reset";
			}
			
			//update record so its NOT "rented"
			if( !mysqli_query($con, $resetSQL))
			{
				die ('Error: ' . mysqli_error($con)); 
			}
			else
			{
				echo"<br>Books reset";
			}
		
		
	}//end if
	echo"<br><br>";
	
	echo"<form action ='search.php' method='post'>";
	echo"<input type='submit' value='Return to Search Page' name='Return to Search Page'>";
	echo"</form>";
	echo"<br><br>";
	
	
	mysqli_close($con);
?>  

</body>
</html>