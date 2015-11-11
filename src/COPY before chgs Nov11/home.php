<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}

$res = mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);
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
         hi' <?php echo $userRow['email']; ?>$nbsp;<a href="profile.php?profile">Profile</a>&nbsp;<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</body>
</html>