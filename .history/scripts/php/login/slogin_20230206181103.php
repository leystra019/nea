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
    /// if user allow to login
    if (isset($_POST['login'])) {
         // if user hasn't error
         if($conn->connect_error){
            die('Connection failed : ' .$conn->connect_error);
        }

        else {
            $stmt = $conn->prepare('SELECT password_hash, id FROM staff WHERE username = ?');
            // Bind parameters, in this case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['username']);
            // execute the sql statements above
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            // We need to get the password hash out of the result (database)
            // Bind result variables
            $stmt->bind_result($hashed_password, $id);

            // Fetch the result
            $stmt->fetch();
            // set password variable to the user's input on the login form
            $password = $_POST['password'];
            $staffid = $_POST['staffid'];
            // Verify that the user-provided password matches the stored hash
            if (password_verify($password, $hashed_password) && $staffid == $id) {
                // this is if the password has been succesful
                // the sql statement is going to find the logged in user's id from table users
                $sql = "SELECT name FROM staff WHERE username = ?";
                //prepare the statemnt
                $stmt = mysqli_prepare($conn, $sql);
                //set the username variable to the username posted in the form
                $username = $_POST['username'];
                setcookie('email', $username, time() + 86400);
                // bind s to username because it is a string
                mysqli_stmt_bind_param($stmt, 's', $username);
                // execute the above statement
                mysqli_stmt_execute($stmt);
                // get a result from executing the statement
                $result = mysqli_stmt_get_result($stmt);
                // find the array
                $row = mysqli_fetch_array($result);
                // get the value of the staff's name, set variables to both
                $staff_name = $row['name'];
                //set the cookie using the variables, and set a time (in seconds)
                setcookie('name', $staff_name, time() + 86400);

                //set the cookie using the variables, and set a time (in seconds)
                setcookie('staffid', $staffid, time() + 86400);
                
                // make this cookie boolean
                $cookie_auth = true;
                // finally set the cookie using the variables, and set a time (in seconds)
                setcookie('staff_auth', $cookie_auth, time() + 86400);
                // take the user to the user's homepage (the shop)
                header('Location: /neatest/scripts/php/staff/staffhome.php');

            
            else {
                echo 'Invalid password.';
            }

            if(isset($_POST["logout"])){
                $cookie_auth = false;
                setcookie("auth", 0, time()+3600);
            }
        
}}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_system</title>
    <link href="/neatest/scripts/css/login/slogin.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="background">
        <div class="ln-card">
            <div class="title">Staff Login</div>
            <form method="post">
                <header>Email/ username</header>
                <input type="username" name="username" id="username" class="logbox" placeholder="me@email.com" required title="Email is required">
                <header>Unique ID</header>
                <input type="password" name="staffid" class="logbox" id="staffid" required title="This field is required">
                <header>Password</header>
                <input type="password" name="password" class="logbox" id="password" required title="A password is required" placeholder="••••••••">
                <input type="submit" name="login" id="login" class="submbtn" value = "Login">
            </form>
            <a>Not a staff member?</a>
            <a href="/neatest/scripts/php/login/ulogin.php" class="blue-link">login here</a>
        </div>
        <div class="uloglink">
            <a href="/neatest/scripts/php/login/ulogin.php" class="blue-link">user login</a>
        </div>
    </div>
</body>
</html>