<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user']) != "")
{
 header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
 $email = mysqli_real_escape_string($connection, $_POST['email']);
 $upass = mysqli_real_escape_string($connection, $_POST['pass']);
 $res = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
 $row = mysqli_fetch_array($res);

 if($row['password'] == $upass)
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: home.php");
 }
 else
 {
  ?>
        <script>alert('wrong details');</script>
  <?php
 }
 
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>cleartuts - Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</button></td>
</tr>
<tr>
<td><a href="register.php">Sign Up Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>