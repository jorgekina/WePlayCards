<?php

session_start();

include_once 'dbconnect.php';
$user = $_SESSION['user'];
$sql = "UPDATE users SET points=points-5 WHERE user_id= $user";
mysqli_query($connection, $sql);


?>