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
    // check if user has succesfully submitted login form
    if (isset($_POST['login'])) {
        // if user hasn't error
        if($conn->connect_error){
            die('Connection failed : ' .$conn->connect_error);
        }


        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        else {
            $stmt = $conn->prepare('SELECT password_hash FROM users WHERE username = ?');
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
            if (!$hashed_password) {
                echo "User details do not exist";
                exit;
            }
            // Verify that the user-provided password matches the stored hash
            if (password_verify($password, $hashed_password)) {
                echo "<script>alert('running')</script>";
                // this is if the password has been succesful
                // the sql statement is going to find the logged in user's id from table users
                $sql = "SELECT id, name FROM users WHERE username = ?";
                //prepare the statemnt
                $stmt = mysqli_prepare($conn, $sql);
                //set the username variable to the username posted in the form
                $username = $_POST['username'];
                $_SESSION['email'] = $username;
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
                // set the session variables
                $_SESSION['name'] = $user_name;
                $_SESSION['user_id'] = $user_id;


                // We need to set this cookie to the value of users, in this case it is 1
                // finally set the session variable for authentication
                $_SESSION['session_auth'] = 1;
                
                // take the user to the user's homepage (the shop)
                // header('Location: /neatest/scripts/php/shop/landingpage.php');
            }
            // If the user has not provided the same password as the one on the form
            // echo so they know they haven't put the right password
            else {
                echo 'Invalid password.';
                echo "<script>alert('invalid')</script>";
            }

            if(isset($_POST["logout"])){
                $_SESSION['session_auth'] = 0;
                // You may want to redirect the user to a different page, such as the login page, after they log out.
                header('Location: /neatest/scripts/php/login/ulogin.php');
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
    <!-- <link href="/neatest/scripts/css/login/ulogin.css" rel="stylesheet" type="text/css"> -->
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
                <a href="/neatest/scripts/html/login/registration.html" class="blue-link">register</a>
            </form>
        </div>
        <div class="sloglink">
            <a href="/neatest/scripts/php/login/slogin.php" class="blue-link">staff login</a>
        </div>

        

    </div>
</body>
</html>