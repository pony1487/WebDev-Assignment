
<html>
<head>
<title>Book Reservation</title>

<!--PUT CSS HERE -->
</head>
<body align="middle">

<img src="DIT_logo.jpg" alt="DIT logo" style="width:304px;height:228px;">

<br>
<h2>Welcome to DIT Library </h2>
<p>Logged in as: </p>
<?php
	session_start();
	echo "$_SESSION[user]<br>";
?>
<br>

<form action="search_book.php" method="post">
	SEARCH:
	<input type="text" name="userSearch" value="Title or Author">
	<br>
	<br>
	<input type="submit" value="Submit">

</form>

<br><br>
<p>Search by Category</p>
<form action="search_book.php" method="post">
  <select name="Category">
    <option value="Health">Health</option>
    <option value="Business">Business</option>
    <option value="Biography">Biography</option>
    <option value="Technology">Technology</option>
	<option value="Travel">Travel</option>
	<option value="Self Help">Self Help</option>
	<option value="Cookery">Cookery</option>
	<option value="Fiction">Fiction</option>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>

<p>-------------------------------------</p>
<form action ="viewReserved.php" method="post">
<input type="submit" value="View books on Loan" name="View books on Loan">
</form>

<p>-------------------------------------</p>
<p>RESET RESERVED BOOKS</p>
<form action ="search_book.php" method="post">
<input type="submit" value="RESET" name="RESET">
</form>






<!--Footer-->
<br><br>
<footer>
Made by Ronan Connolly<br>
<a href="http://ronanconnollydit.weebly.com/" id="footer_link">Visit my blog!</a>
<br>
<!--log out-->
<form action="logout.php">
<input type="submit" value="Log Out">
</form>

</footer>
</body>
</html>