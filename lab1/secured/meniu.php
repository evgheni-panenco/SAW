<?php
	//$onclick_delete_confirm = "if (!(confirm('Are you sure you want to delete this student?'))) return false;";

	session_start();
	if ($_SESSION['id_user'] == "") {
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/secured');
	}

	if(isset($_POST['itemid']) and is_numeric($_POST['itemid']))
	{
		require('connection.php');

	  $delete_id = $_POST['itemid'];
	  $sql = "DELETE FROM `produse` where `id_prod` = '$delete_id'";
		mysqli_query($conn, $sql);

		mysqli_close($conn);
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="exemplu" />
	<title>Departament comenzi, panou administrare</title>
	<link rel="shortcut icon" href="image/flower.png">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/stiluri.css">
</head>
<body>

<div class="w3-container w3-sand corp w3-padding-16">
	<header class="w3-container w3-sand">
		<h1  id="sus" class="w3-container w3-card-16 w3-padding-8 w3-green w3-xxxlarge w3-text-white w3-opacity">Lista produselor...</h1>
		<h3>Este posibila cautarea dupa denumirea produsului</h3>
		<div class="w3-container w3-xlarge w3-padding-8 w3-right w3-text-green w3-card-16 w3-yellow w3-hover-green">
		<a href="sign-out.php">Iesire</a>
		</div>
	</header>
	<section class="w3-container w3-text-dark-grey w3-sand">
		<div>
			<form method="get" class="date_form w3-container w3-border w3-round-xlarge w3-card-8 w3-hover-border-green">
				<label>Afla mai multe detalii referitoare la produsele noastre
					<input type="text" name="cauta" title = "Introdu doar litere - de la 1 la 20 maximum!" class="linie" />
				</label>
				<input type="submit" value="Cauta detalii" name ="ok" class="w3-container w3-border w3-padding-8 w3-round-xlarge w3-card-8 w3-green w3-hover-border-orange" />
			</form>
		</div>

		<form method="post">
		<?php
			if ($_GET['ok']) {
			$sir_cautat = strtoupper("".$_GET['cauta']);
			require('connection.php');
			$sqlQwer=mysqli_query($conn, "SELECT id_prod, denumire, descriere, pret_unitar, imagine FROM produse WHERE UPPER(denumire) LIKE '%$sir_cautat%'");
			if ($sqlQwer) {
				echo '<div class="date_form w3-container w3-border w3-round-xlarge w3-card-8 w3-hover-border-green"><table>';
				while($rows=mysqli_fetch_array($sqlQwer)){
				echo '<tr>';
				echo '<td  class="w3-border w3-padding-16"><img width="55" height="47" border="1" src="'.$rows['imagine'].'"</td>';
				echo '<td  class="w3-border w3-padding-16">'.$rows['denumire']." - ".$rows['pret_unitar']." lei</td>";
				echo '<td  class="w3-border w3-padding-16">'.$rows['descriere']."</td>";
				$id = $rows['id_prod'];
				echo "<input type='hidden' name='itemid' value='$id'>";
				echo '<td  class="w3-border w3-padding-16"><input type="submit" name="deleteItem" value="Delete" /></td>"';
				echo '</tr>';
			}
			mysqli_close($conn);
			echo '</table></div>';
			}
			}
		?>
		</form>
	</section>
</div>
</body>
</html>
