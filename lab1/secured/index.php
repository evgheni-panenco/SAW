<?php
	session_start();
	require_once 'connection.php';

	function clean($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$login = $parola = "";
	if ($_POST['ok']) {
		if (!empty($_POST["login"]) && !empty($_POST["password"])) {
			$login = clean($_POST["login"]);
			$parola = clean($_POST["password"]);

			if (preg_match("/^[A-Za-z0-9]{4,20}$/", $login) && preg_match("/^[A-Za-z0-9]{4,20}$/", $parola)) {
				$query = "SELECT * FROM users WHERE login='$login' AND password='$parola'";
				$res = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($res);
				if(mysqli_num_rows($res) == 1) {
					$_SESSION['id_user'] = $row['id_user'];
					header('Location: http://'.$_SERVER['SERVER_NAME'].'/secured'.'/meniu.php');
				} else {
					header('Location: http://'.$_SERVER['SERVER_NAME'].'/secured'.'/index.php');
				}

				mysqli_close($conn);
			}
		}
	}

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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="w3-container w3-center">
	<header class="w3-container w3-green">
		<h1  id="sus" class="w3-xxlarge w3-text-white w3-opacity">Autentifica-te pentru acces!</h1>
	</header>

	<div class="date_form w3-container w3-border w3-round-xlarge w3-card-8 w3-hover-border-green">
		<form action="<?php $_SERVER['SCRIPT_NAME']?>" method="post" autocomplete="off" onsubmit="return validation();">
			<label>Login <input type="text" id="login" class="linie"
				 name="login" maxlength="20" pattern="^[A-Za-z0-9]{4,20}$"
				 title="Login must be 4 to 20 chars, without spec. chars"/> </label><br />

			<label>Parola <input type="password" id="password"  class="linie"
				name="password" maxlength="20" pattern="^[A-Za-z0-9]{4,20}$"
			 	title="Password must be 4 to 20 chars, without spec. chars"/> </label><br />
			<input type="submit" name='ok' class="w3-container w3-border w3-round-xlarge w3-card-16 w3-green w3-padding-16 w3-hover-border-green" value="Intra" />
		</form>

		<span id="errorMessage" class="text-danger"></span>
	</div>
</div>

<script type="text/javascript">
		function validation() {
			var login = document.getElementById('login');
			var password = document.getElementById('password');
			var errorMessage = "";
			var err = false;

			if (!/^[A-Za-z0-9]{4,20}$/.test(login)) {
				errorMessage += "Login must be 4 to 20 chars, without spec. chars<br>";
				err = true;
			}

			if (!/^[A-Za-z0-9]{4,20}$/.test(password)) {
				errorMessage += "Password must be 4 to 20 chars, without spec. chars<br>";
				err = true;
			}

			document.getElementById('errorMessage').innerHTML = errorMessage;

			return err;
		}
</script>

</body>
</html>
