<?php
    $connection = mysqli_connect("127.0.0.1", "root", "");
if (!$connection)
{
	die('connection problem! -->'.mysql_error());
}

if (!mysqli_select_db($connection, "dbtest"))
{
	die('database selction failed! -->'.mysql_error());
}

$sql = "INSERT INTO `dbtest`.`users` (username, email, password)
VALUES ('gaben', 'gaben@valvesoftware.com', '1234')";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

?>