<!DOCTYPE html>
<html>
<body>
<style>

ul {
    list-style-type: inline;
    margin: 60px;
    padding: 20px ;
    overflow: hidden;
    
color: #464646;
}


h2
{
background-color: #FEFFED;
padding: 30px 35px;
margin: -10px -50px;
text-align:center;
border-radius: 10px 10px 0 0;
}



div.container{
width: 600px;
height: 610px;
margin:35px auto;
font-family: 'Raleway', sans-serif;

}
div.main{
width: 400px;
padding: 10px 50px 25px;
border: 2px solid gray;
border-radius: 10px;
font-family: raleway;
float:left;
margin-top:100px;
position:absolute;

background-color: yellow;
}


input[type=button]{
font-size: 16px;
background: linear-gradient(#ffbc00 5%, #ffdd7f 100%);
border: 1px solid #e5a900;
color: #4E4D4B;
font-weight: bold;
cursor: pointer;
width: 100%;
border-radius: 5px;
padding: 10px 0;
outline:none;
}
</style>


<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: changemail.php");
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
         HI <?php echo $userRow['email'];?> </a>&nbsp;<a href="profile.php?profile">Profile</a>&nbsp;<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>

</body>
</html>




<html><div id="header">
<body>
<div class="container">
<div class="main">
<h2>We Play Cards Main Menu</h2>
<form id="form_id" method="post" name="myform">
<p>
<ul>
<img src="blackjack.jpg" width="100" height="100" alt="Picture of blackjack">

<img src="conquain.jpeg" width="130" height="100" alt="Picture of conquain">
</p>
<p>
<input type="button" value="Play Blackjack" onclick="window.location.href='blackjack.html';"/>

<input type="button" value="Play Conquain" onclick="window.location.href='conquain.html';"/>
<!--button type="button" onclick="window.location.href='blackjack.html';">Single Player</button>
<button type="button" onclick="window.location.href='conquian.html';">Play Conquain</button-->


</ul>
</p>

</form>
</div>
</div>
</body>
</html>











