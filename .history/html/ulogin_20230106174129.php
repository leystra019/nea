<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'neatest';
    // Try and connect using the info above.
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (isset($_POST['login'])) {
        /// if user allow to login
        if($conn->connect_error){
            die('Connection failed : ' .$conn->connect_error);
        }


        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        else {
            $stmt = $conn->prepare('SELECT password_hash FROM users WHERE username = ?');
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['username']);
            // execute the sql statements above
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            // We need to get the password hash out of the result (database)
            // Bind result variables
            $stmt->bind_result($hashed_password);

            // Fetch the result
            $stmt->fetch();

            // Verify that the user-provided password matches the stored hash
            $password = $_POST['password'];
            if (password_verify($password, $hashed_password)) {
                echo 'Password is valid!';
                //set a cookie to say to the website we are logged in for the session
                $cookie_name = 'cookie_auth';
                $cookie_value = true;
                setcookie ($cookie_name, $cookie_value, time() + 86400)
                echo $cookie_value;
            } else {
                echo 'Invalid password.';
            }
        }

    }

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
            <form method="post">
                <header>Email</header>
                <input type="username" name="username" id="username" class="logbox" placeholder="me@email.com">
                <header>Password</header>
                <input type="password" name="password" class="logbox" id="password" placeholder="••••••••">
                <input type="submit" name="login" id="login" class="submbtn" value = "Login">
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