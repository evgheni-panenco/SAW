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

session_start();

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!empty($_POST['login']) & !empty($_POST['password'])) {
    $login = clean($_POST["login"]);
    $parola = clean($_POST["password"]);
    $hashPassword = md5($parola);

    if (preg_match("/^[A-Za-z0-9]{4,20}$/", $login) && preg_match("/^[A-Za-z0-9]{4,20}$/", $parola)) {
        $query = "SELECT * FROM users JOIN roles USING (role_id) WHERE login='$login' AND password='$hashPassword'";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($res);
        if (mysqli_num_rows($res) == 1) {
            $_SESSION['login'] = $row['login'];
            $_SESSION['role'] = $row['role_description'];

            write_logs("signed in");

            if ($_SESSION['role'] == 'admin') {
                header('Location: http://' . $_SERVER['SERVER_NAME'] . '/admin-menu.php');
            } else {
                header('Location: http://' . $_SERVER['SERVER_NAME'] . '/menu.php');
            }
        } else {
            write_logs("auth. fail");
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/sign-in.php');
        }
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

    <h1 class="text-center">ВХОД</h1>
    <div class="container pt-3">
        <div class="row justify-content-sm-center">
            <div class="col-sm-6 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <form action="sign-in.php" method="POST" autocomplete="off">
                            <h5 class="text-center">Логин</h5>
                            <input type="text" class="form-control mb-2" name="login" maxlength="20" 
                            pattern="^[A-Za-z0-9]{4,20}$" title="Login must be 4 to 20 chars, without spec. chars">
                            <h5 class="text-center">Пароль</h5>
                            <input type="password" class="form-control mb-2" name="password" maxlength="20" 
                            pattern="^[A-Za-z0-9]{4,20}$" title="Password must be 4 to 20 chars, without spec. chars">
                            <br>
                            <input value="Войти" class="btn btn-lg btn-primary btn-block mb-1" type="submit">
                            <a href="index.php">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>