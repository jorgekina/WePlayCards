<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: changepass.php");
}

$res = mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

if (isset($_POST['btn-chpass']))
{   //used to create legal sql string
    $newPassword = mysqli_real_escape_string($connection, $_POST['newPass']);

    if (mysqli_query($connection, "UPDATE `WPCDB`.`users` SET password='$newPassword' WHERE user_id=".$_SESSION['user']))
    {
        ?><script>alert('Password changed successfully.');</script><?php
    }
    else
    {
        ?><script>alert('Password change failed.')</script><?php
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
    <div id="right">
        <div id="content">
        <b class="padRight">Hello <?php echo $userRow['email'];?></b>
        <b class="padRight">Points:<?php echo $userRow['points'];?></b>
        <a href="MainMenu.php" class="padRight">Home</a>
        <a href="logout.php?logout" class="padRight">Sign Out</a>
        </div>
    </div>
</div>

<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="newPass" placeholder="New Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-chpass">Update Password</button></td>
</tr>
<tr>
<td align="center"><a href="profile.php">Back to Profile</a></td>
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