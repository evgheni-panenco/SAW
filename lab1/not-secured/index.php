<?php
	require_once 'connection.php';

	$login = $parola = "";
	if ($_POST['ok']) {
		$login = $_POST["login"];
		$parola = $_POST['password'];
		$query = "SELECT * FROM users WHERE login='$login' AND password='$parola'";
		$res = mysqli_query($conn, $query);
		$row=mysqli_fetch_array($res);
		if($row) {
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/not-secured'.'/meniu.php');
		} else {
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/not-secured');
		}
	mysqli_close($conn);
	}
	//echo md5($parola);
	//echo '<br />';
	//echo strlen(sha1($parola));
	//echo '<br />';
	//echo strlen(hash('sha256', $parola));

	$login = $parola = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Eu" />
	<title>Testare securitate</title>
	<link rel="shortcut icon" href="image/flower.png">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/stiluri.css">
</head>
<body>
<div class="w3-container w3-center">
	<header class="w3-container w3-green">
		<h1  id="sus" class="w3-xxlarge w3-text-white w3-opacity">Autentifica-te pentru acces!</h1>
	</header>

	<div class="date_form w3-container w3-border w3-round-xlarge w3-card-8 w3-hover-border-green">
		<form action="<?php $_SERVER['SCRIPT_NAME']?>" method="post">
			<label>Loghin<input type="text" class="linie" name="login"/> </label><br />
			<label>Parola&nbsp;<input type="password" class="linie" name="password" /> </label><br />
			<input type="submit" name='ok' class="w3-container w3-border w3-round-xlarge w3-card-16 w3-green w3-padding-16 w3-hover-border-green" value="Intra" />
		</form>
	</div>
</div>

</body>
</html>
