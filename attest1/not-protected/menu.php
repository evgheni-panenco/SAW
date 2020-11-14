<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Email Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <br> <br>
    <div class="container">
        <h1 class="text-center">Hello, admin</h1>
        <p class="text-center">
            <a class="btn btn-danger" href="sign-out.php">Sign out</a>
        </p>
    </div>
    <div class="container pt-3">
        <div class="row justify-content-sm-center">
            <div class="col-sm-8 col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <form action="send-message.php" method="POST">
                            <h5 class="text-center">Enter your message:</h5>
                            <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea> <br>
                            <input class="btn btn-primary btn-block" type="submit">
                            <br> <br><a href="index.php">Main page</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>