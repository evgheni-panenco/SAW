<?php
	$servername = "localhost";
	$username = "mysql";
	$password = "mysql";
	$db_name = "email_service";

	$conn = mysqli_connect($servername, $username, $password, $db_name);
	if (!$conn)
		die("Non connection: " . mysqli_connect_error());
?>
