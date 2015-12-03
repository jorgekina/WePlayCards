<?php
    $connection = mysqli_connect("127.0.0.1", "root", "<3ofthecards", "WPCDB");
 
if (!$connection)
{
	die('connection problem! -->'.mysql_error());
}
?>