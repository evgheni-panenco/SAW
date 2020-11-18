<?php
	$servername = "localhost";
	$username = "mysql";
	$password = "mysql";
	$db_name = "email_service";

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	try {
		$conn = mysqli_connect($servername, $username, $password, $db_name);
	} catch (Exception $exception) {
		error_log($exception->getMessage()."\t\t".date("d/m/y H:i:s")."\t\t".$_SERVER['PHP_SELF']."\r\n", 3, "..\\error_log.txt");
		header('Location: http://' . $_SERVER['SERVER_NAME']  . '/error-page.html');
	}
?>
