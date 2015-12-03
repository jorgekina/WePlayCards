<?php
    //connects to the msql database with the database login information
    $connection = mysqli_connect("127.0.0.1", "root", "<3ofthecards", "WPCDB");

//checks if connection has succeeded
if (!$connection)
{
	die('connection problem! -->'.mysql_error());
}
?>