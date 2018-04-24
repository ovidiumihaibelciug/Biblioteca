<?php
$alert = 0;
session_start();
$_SESSION['logged'] = 0;
if (isset($_POST['submit'])) {
    if ($_POST['password'] == 'biblioteca123') {
        header('Location: main.php');
        $_SESSION['logged'] = 1;
    } else {
        $alert = 1;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="main">
        <div>
            <div class="col-md-4 col-md-offset-4 login-box well">
                <div class="title">Log in</div>
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div>
                        <input type="submit" name="submit" class="btn btn-success btn-block" value="Sign in" >
                    </div>
                </form>
            <br>
                <?php
                    if ($alert == 1 && isset($alert)): ?>
                        <div class="alert alert-danger">
                            Parola introdusa nu e corecta!
                        </div>
                    <?php endif; ?>
            </div>
        </div>

    </div>
</body>
</html>