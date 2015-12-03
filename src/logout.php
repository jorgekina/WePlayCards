<?php
    //start php session
session_start();

//redirects to mainmenu if user is not logged in
if(!isset($_SESSION['user']))
{
 header("Location: MainMenu.php");
}
else if(isset($_SESSION['user']) != "")
{
 header("Location: MainMenu.php");
}

//destroy the current session if user clicked on logout and redirects to the mainmenu
if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 header("Location: MainMenu.php");
}
?>