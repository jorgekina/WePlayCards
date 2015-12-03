<?php
    //connects to the msql database with the database login information
    $connection = mysqli_connect("127.0.0.1", "root", "<3ofthecards", "WPCDB");
<<<<<<< HEAD

//checks if connection has succeeded
=======
 
>>>>>>> origin/master
if (!$connection)
{
	die('connection problem! -->'.mysql_error());
}
?>