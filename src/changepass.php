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
<title>cleartuts - Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
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
<td><a href="profile.php">Back to Profile</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>