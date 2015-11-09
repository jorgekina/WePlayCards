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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
 <div id="left">
    <label>cleartuts</label>
    </div>
    <div id="right">
     <div id="content">
         HI <?php echo $userRow['email'];?> Total Points: <?php echo $userRow['points'];?></a>&nbsp;<a href="home.php">Back to Main Menu</a>&nbsp;<a href="logout.php?logout">Sign Out</a>
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
</html>