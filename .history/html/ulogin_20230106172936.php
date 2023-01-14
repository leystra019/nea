<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_system</title>
    <link href="/neatest/css/ulogin.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="background">
        <div class="ln-card">
            <div class="title">User Login</div>
            <form action="/neatest/php/main php/authlogin.php" method="post">
                <header>Email</header>
                <input type="username" name="username" id="username" class="logbox" placeholder="me@email.com">
                <header>Password</header>
                <input type="password" name="password" class="logbox" id="password" placeholder="••••••••">
                <input type="submit" value="login" class="submbtn" id="button">
                <a>Don't have an account?</a>
                <a href="/neatest/html/registration.html" class="blue-link">register</a>
            </form>
        </div>
        <div class="sloglink">
            <a href="/neatest/html/slogin.html" class="blue-link">staff login</a>
        </div>

        

    </div>
</body>
</html>