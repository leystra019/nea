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
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    /// if user allow to login
    if (isset($_POST['login'])) {
         // if user hasn't error
         if($conn->connect_error){
            die('Connection failed : ' .$conn->connect_error);
        }

    } else {
        $stmt = $conn->prepare('SELECT password_hash FROM staff WHERE username = ?');
        // Bind parameters, in this case the username is a string so we use "s"
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
        // set password variable to the user's input on the login form
        $password = $_POST['password'];
        // Verify that the user-provided password matches the stored hash
        if (password_verify($password, $hashed_password)) {
            // this is if the password has been succesful
            // the sql statement is going to find the logged in user's id from table users
            $sql = "SELECT id, name FROM staff WHERE username = ? and id = ?";
            //prepare the statemnt
            $stmt = mysqli_prepare($conn, $sql);
            //set the username variable to the username posted in the form
            $username = $_POST['username'];
            $id = $_POST['id'];
            setcookie('email', $username, time() + 86400);
            // bind s to username because it is a string
            mysqli_stmt_bind_param($stmt, 's', $username);
            // execute the above statement
            mysqli_stmt_execute($stmt);
            // get a result from executing the statement
            $result = mysqli_stmt_get_result($stmt);
            // find the array
            $row = mysqli_fetch_array($result);
            // get the value of the user's id and name, set variables to both
            $user_id = $row['id'];
            $user_name = $row['name'];

    }}






    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    
    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    else {
        $stmt = $con->prepare('SELECT id FROM staff WHERE username = ? AND id = ? AND password_hash = ?');
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('sis', $_POST['username'], $_POST['id'], $_POST['password']);
        // execute the sql statement above
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // Verification success! User has logged-in!
            
            session_regenerate_id();
            $stmt->bind_result($id);
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $stmt->fetch(); 
            header('Location: /neatest/scripts/php/staff/staffhome.php');
        } else {
            echo "<script>alert('1 or 2 of your details were incorrect - please try again');window.location = '/neatest/html/slogin.php' </script>";

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
                <input type="password" name="password" class="logbox" id="password" required title="This field is required">
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