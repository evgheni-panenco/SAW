<?php

include_once 'logging.php';
session_start();

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SESSION['login'] == "") {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/sign-in.php');
}  

// Whoops here should be a huge service for mailing
$message = clean($_POST['message']);

write_logs("send_message");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Email Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <br> <br>
    <div class="container pt-3">
        <div class="row justify-content-sm-center">
            <div class="col-sm-8 col-md-6">
                <div class="text-center">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Хорошо сработано!</h4>
                            <p>Ваше сообщение: <br>
                            <b><?php echo "$message" ?></b> </p>
                            <p>Было отправлено следующим пользователям:</p>
                            <hr>
                            <ul>
                                <?php
                                require('connection.php');

                                $result = mysqli_query($conn, "SELECT email from email");

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<li>";
                                    echo $row['email'];
                                    echo "</li>";
                                }

                                mysqli_close($conn);
                                ?>
                            </ul>
                            <hr>
                            <a class="btn btn-outline-success" href="menu.php">Создать новое сообщение</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>