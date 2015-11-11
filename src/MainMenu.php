<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['user']))
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
        <a class="padRight">Points:<?php echo $userRow['points'];?></a>
        <a href="MainMenu.php" class="padRight">Main Menu</a>
        <a href="logout.php?logout" class="padRight">Sign Out</a>
        </div>
    </div>
</div>


                            
<body>
<div id="mainpage">
        <a href="conquian.html"><img src="images/conquian2.png" class="conquianGraphic" ></a>
        <a href="blackjack.php"><img src="images/blackjack.png" class="blackjackGraphic"></a><BR>
        <submit onclick="window.location.href='conquian.html';" class="conquianButton"> <img src="images/playConquian.png"></submit>
        <submit onclick="window.location.href='blackjack.html';" class="blackjackButton"> <img src="images/playBlackjack.png"></submit>
</div>

</body>
                            
<footer>
    <div id="fbox1"> SOCIAL </div>
    <a href="https://instagram.com/officialbicyclecards/"><img class="imgIcons" src="images/instagramicon.png"></a>
    <a href="https://www.facebook.com/bicyclecards"><img class="imgIcons" src="images/facebook.png"></a>
    <a href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/twittericon.png" </a>
    <a  href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/youtubeicon.png"</a>
</footer>
                            
</html>











