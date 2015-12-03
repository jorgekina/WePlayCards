<?php
//starts the php session
session_start();
include_once 'dbconnect.php';
//attach the header to the mainpage
if (!isset($_SESSION['user']))
{
 header("Location: index.php");
}
//selects the user row from the database
$res = mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

?>


<!DOCTYPE html> <!--defines the document type-->
<html><!--starts the html code-->
<head><!--it contains information about the document-->
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
        <a href="profile.php" class="padRight">Profile</a>
        <a href="logout.php?logout" class="padRight">Sign Out</a>
        </div>
    </div>
</div>


 <!--lists buttons in the body of the webpage-->                           
<body>
<!--keyword div defines the section of the document-->
<div id="mainpage">

       <center> <a href="conquian.php"><img src="images/conquian2.png" class="conquianGraphic" ></a>
        <a href="blackjack.php"><img src="images/blackjack.png" class="blackjackGraphic"></a><BR>
        <!--clicking the conquain button takes the user to the new page containing the conquain game-->
        <submit onclick="window.location.href='conquian.php';" class="conquianButton"> <img src="images/playConquian.png"></submit>
                <!--clicking blackjackButton button takes the user to the new page containing the blackjack game-->
        <submit onclick="window.location.href='blackjack.php';" class="blackjackButton"> <img src="images/playBlackjack.png"></submit>
        </center>
</div>

</body>
<--links to the facebook and twitter at the bottom of the main page-->                     
<footer>
    <div id="fbox1"> SOCIAL </div>
    <a href="https://instagram.com/officialbicyclecards/"><img class="imgIcons" src="images/instagramicon.png"></a>
    <a href="https://www.facebook.com/bicyclecards"><img class="imgIcons" src="images/facebook.png"></a>
    <a href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/twittericon.png" </a>
</footer>
                            
</html>











