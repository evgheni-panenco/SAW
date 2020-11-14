<?php
try {
    if (!file_exists("logging.php")) {
        throw new Exception('logging.php does not exist!');
    } else {
        include_once 'logging.php';
    }
} catch (Exception $exception) {
    error_log($exception->getMessage() . "\t\t" . date("d/m/y H:i:s") . "\t\t" . $_SERVER['PHP_SELF'] . "\r\n", 3, "..\\error_log.txt");
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/error-page.html');
}
session_start();

if ($_SESSION['login'] == "") {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/sign-in.php');
}

if ($_SESSION['role'] != 'admin') {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/sign-in.php');
}

write_logs("admin-menu");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Email Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

<br> <br>
<div class="container pt-3">
    <div class="row justify-content-sm-center">
        <div class="col-sm-8 col-md-6">
            <div class="text-center">
                <div class="card-body">
                    <h4 class="alert-heading">Добро пожаловать на пано админа</h4>
                    <a class="btn btn-danger" href="sign-out.php">Выход</a>
                </div>

                <div>
                    <a class="btn btn-success" href="menu.php">Написать сообщение</a> <br><br>
                </div>

            </div>
            <div>
                <h4>Управление персоналом</h4>

                <div class="form-group">
                    <select class="form-control">
                        <?php
                        require('connection.php');

                        $result = mysqli_query($conn, "SELECT login FROM users WHERE role_id > 1");

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option>";
                            echo $row['login'];
                            echo "</option>";
                        }

                        mysqli_close($conn);
                        ?>
                    </select> <br>
                    <button class="btn btn-info">Изменить</button>
                    <button class="btn btn-danger">Удалить</button>
                </div>
            </div>

            <div>
                <h4>Управление подписчиками</h4>

                <div class="form-group">
                    <select class="form-control">
                        <?php
                        require('connection.php');

                        $result = mysqli_query($conn, "SELECT email from email");

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option>";
                            echo $row['email'];
                            echo "</option>";
                        }

                        mysqli_close($conn);
                        ?>
                    </select> <br>
                    <button class="btn btn-info">Изменить</button>
                    <button class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>