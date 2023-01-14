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
        } else {
            echo 'Invalid password.';
        }
    }
?>
