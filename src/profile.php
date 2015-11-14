<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: changemail.php");
}

$res = mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

if(isset($_POST['btn-changemail']))
{    
    header("Location: changemail.php");
}
else if (isset($_POST['btn-changepass']))
{   
    header("Location: changepass.php");
}

?>

<!DOCTYPE html>
<html>
<header>
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA=screen>
<a href="MainMenu.php" class="company">We Play Cards Inc.</a><BR>
</header>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome - <?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>

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

<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
    <tr>
        <td><button type="submit" name="btn-changemail">Change E-Mail</button></td>
    </tr>
    <tr>
        <td><button type="submit" name="btn-changepass">Change Password</button></td>
    </tr>
</table>
</form>
</div>
</center>
</body>
<BR><BR><BR><BR><BR><BR>

<footer>
<div id="fbox1">
SOCIAL
</div>
<a href="https://instagram.com/officialbicyclecards/"><img class="imgIcons" src="images/instagramicon.png"></a>
<a href="https://www.facebook.com/bicyclecards"><img class="imgIcons" src="images/facebook.png"></a>
<a href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/twittericon.png" </a>
</footer>

</html>