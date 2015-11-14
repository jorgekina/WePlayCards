<?php
    $connection = mysqli_connect("127.0.0.1", "root", "");
if (!$connection)
{
	die('connection problem! -->'.mysql_error());
}

if (!mysqli_select_db($connection, "WPCDB"))
{
	die('database selction failed! -->'.mysql_error());
}
?>