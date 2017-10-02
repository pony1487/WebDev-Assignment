<html>
<head>
<title>Login</title>

</head>
<body align="middle">

<?php
session_start();
?>

<img src="DIT_logo.jpg" alt="DIT logo" style="width:304px;height:228px;">

<p>You muse register to use this service. </p>

<form action="register_user.php" method="post">
  
  Full Name:<br>
  <input type="text" name="FullName">
  <br>
  User name:<br>
  <input type="text" name="Username">
  <br>
  Password:<br>
  <input type="Password" name="Password">
  <br>
  Email:<br>
  <input type="Email" name="Email">
  <br>
  Phone:<br>
  <input type="text" name="Phone">
  <br><br>
  <input type="radio" name="gender" value="male" checked> Male
  <input type="radio" name="gender" value="female"> Female
  <input type="radio" name="gender" value="other"> Other
  
  <br><br>
  <input type="submit" value="Submit">
</form>

<!--Footer-->
<br><br>
<footer>
Made by Ronan Connolly<br>
<a href="http://ronanconnollydit.weebly.com/" id="footer_link">Visit my blog!</a>
</footer>
</body>
</html>