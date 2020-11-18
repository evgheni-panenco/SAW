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

if ($_SESSION['login'] == "" || $_SESSION['role'] == "") {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/sign-in.php');
}

write_logs("menu");
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
<div class="container">
    <h1 class="text-center">Привет, <?php echo $_SESSION['login'] ?></h1>
    <p class="text-center">
        <a class="btn btn-danger" href="sign-out.php">Выход</a>
    </p>
</div>
<div class="container pt-3">
    <div class="row justify-content-sm-center">
        <div class="col-sm-8 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <form action="send-message.php" method="POST">
                        <h5 class="text-center">Введите свое сообщение:</h5>
                        <textarea name="message" class="form-control" id="exampleFormControlTextarea1"
                                  rows="5"></textarea> <br>
                        <input class="btn btn-primary btn-block" type="submit">
                        <br> <br><a href="index.php">Главная страница</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>