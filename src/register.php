<?php
    //start current php session
session_start();

//redirect to home.php if user is not logged in
if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
include_once 'dbconnect.php';

//if user clicked on sign up button...
if(isset($_POST['btn-signup']))
{
    //returns the email and password
 $email = mysqli_real_escape_string($connection, $_POST['email']);
 $upass = mysqli_real_escape_string($connection, $_POST['pass']);
 
 //check to see if successfully registered and show appropriate message
 if(mysqli_query($connection, "INSERT INTO users(email,password) VALUES('$email','$upass')"))
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="main.css" type="text/css" />
</head>

<header>
    <a href="MainMenu.php" class="company">We Play Cards Inc.</a><BR>
</header>


<div id="header">
</div>

<body>
<center>
<div id="login-form">
<form method="post">
    <table align="center" width="30%" border="0">
        <tr>
            <td><input type="email" name="email" placeholder="Your Email" required /></td>
        </tr>
        <tr>
            <td><input type="password" name="pass" placeholder="Your Password" required /></td>
        </tr>
        <tr>
            <td><button type="submit" name="btn-signup">Sign Me Up</button></td>
        </tr>
        <tr>
            <td align="center"><a href="index.php">Sign In Here</a></td>
        </tr>
    </table>
</form>
</div>
</center>
</body>

<BR><BR><BR>

<footer>
    <div id="fbox1"> SOCIAL </div>
    <a href="https://instagram.com/officialbicyclecards/"><img class="imgIcons" src="images/instagramicon.png"></a>
    <a href="https://www.facebook.com/bicyclecards"><img class="imgIcons" src="images/facebook.png"></a>
    <a href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/twittericon.png" </a>
</footer>

</html>