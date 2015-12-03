<?php
    //start php session and attempt to connect to db only once
session_start();
include_once 'dbconnect.php';

//redirect to main menu if user is not logged inn
if(isset($_SESSION['user']) != "")
{
 header("Location: MainMenu.php");
}

//if user clicked on sign-in button...
if(isset($_POST['btn-login']))
{
    //returns the email and password from the database
 $email = mysqli_real_escape_string($connection, $_POST['email']);
 $upass = mysqli_real_escape_string($connection, $_POST['pass']);
 $res = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
 $row = mysqli_fetch_array($res);

 //check the password
 if($row['password'] == $upass)
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: MainMenu.php");
 }
 else
 {
  ?>
        <script>alert('Incorrect username or password');</script>
  <?php
 }
 
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            <td><input type="text" name="email" placeholder="Your Email" required /></td>
        </tr>
        <tr>
            <td><input type="password" name="pass" placeholder="Your Password" required /></td>
        </tr>
        <tr>
            <td><button type="submit" name="btn-login">Sign In</button></td>
        </tr>
        <tr>
            <td align="center"><a href="register.php">Sign Up Here</a></td>
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