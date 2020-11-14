<?php
require_once 'connection.php';

if (!empty($_POST['login']) & !empty($_POST['password'])) {
    $login = $_POST["login"];
    $parola = $_POST["password"];
    $query = "SELECT * FROM users WHERE login='$login' AND password='$parola'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res);
    if ($row) {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/not-protected' . '/menu.php');
    } else {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/not-protected' . '/sign-in.php');
    }
    mysqli_close($conn);
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

    <h1 class="text-center">Sign In</h1>
    <div class="container pt-3">
        <div class="row justify-content-sm-center">
            <div class="col-sm-6 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <form action="sign-in.php" method="POST">
                            <h5 class="text-center">Login</h5>
                            <input type="text" class="form-control mb-2" name="login">
                            <h5 class="text-center">Password</h5>
                            <input type="text" class="form-control mb-2" name="password">
                            <input value="Sign in" class="btn btn-lg btn-primary btn-block mb-1" type="submit">
                            <a href="index.php">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>