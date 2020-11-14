<?php
require_once 'connection.php';

if (!empty($_POST['userEmail'])) {
  $userEmail = $_POST['userEmail'];

  $query = "INSERT INTO email VALUES (NULL, '$userEmail', NULL);";

  mysqli_query($conn, $query);

  header('Location: http://'.$_SERVER['SERVER_NAME']. '/not-protected' .'/index.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Email Service</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

  <br>
  <div class="container">
    <p class="text-right">
      <a class="btn btn-primary" href="sign-in.php">Sign in</a>
    </p>
  </div>

  <br>
  <div class="container">
    <form action="index.php" method="POST">
      <h1>Subscribe for mailing</h1>
      Enter your email:
      <input class="form-control" type="text" name="userEmail"> <br>
      <input class="btn btn-primary" type="submit" value="Submit"> <br>
    </form>
  </div>

</body>

</html>