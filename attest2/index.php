<?php
require_once 'connection.php';

try {
    if (!file_exists("logging.php")) {
        throw new Exception('logging.php does not exist!');
    } else {
        include_once 'logging.php';
    }
} catch (Exception $exception) {
    error_log($exception->getMessage()."\t\t".date("d/m/y H:i:s")."\t\t".$_SERVER['PHP_SELF']."\r\n", 3, "..\\error_log.txt");
    header('Location: http://' . $_SERVER['SERVER_NAME']  . '/error-page.html');
}

function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!empty($_POST['userEmail'])) {
  $userEmail = clean($_POST['userEmail']);

  if (preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $userEmail)) {
    $query = "INSERT INTO email VALUES (NULL, '$userEmail', NULL);";

    try {
        mysqli_query($conn, $query);
        write_logs("new_subscriber");
    } catch (Exception $exception) {
        error_log($exception->getMessage()."\t\t".date("d/m/y H:i:s")."\t\t".$_SERVER['PHP_SELF']."\r\n", 3, "..\\error_log.txt");
    }
  }

  header('Location: http://' . $_SERVER['SERVER_NAME']  . '/index.php');
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
      <a class="btn btn-primary" href="sign-in.php">Вход</a>
    </p>
  </div>

  <br>
  <div class="container">
    <h2>Введите свой email для подключения к рассылке</h2>
    <form action="index.php" method="POST" autocomplete="off" onsubmit="return validation();">
      Ваш email:
      <input id="email" class="form-control" type="email" name="userEmail" 
          pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" 
          title="Please enter valid email!">
      <span class="text-danger" id="errorMessage"></span> <br>
      <input class="btn btn-primary" type="submit" value="Отправить"> <br>
    </form>
  </div>


  <!-- <script type="text/javascript">
    function validation() {
      var email = document.getElementById('email');
      var errorMessage = "";
      var err = false;

      if (!(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email))) {
        errorMessage += "Please enter valid email!<br>";
        err = true;
      }

      document.getElementById('errorMessage').innerHTML = errorMessage;

      return err;
    }
  </script> -->
</body>

</html>