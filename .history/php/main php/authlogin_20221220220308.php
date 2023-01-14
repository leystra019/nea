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
        // execute the sql statement above
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        // We need to get the password hash out of the result (database)
        // figure out how the next line works
        // $hashed_password1 = ['password_hash'];
        // $password = $_POST['password'];
        // if ($stmt->num_rows > 0) {
             
        //     // Verify that the user-provided password matches the stored hash
        //     if (password_verify($password, $hashed_password1)) {
        //         // password matches stored hash so is valid
        //         echo 'Password is valid!';
        //     } else {
        //         // password does not match stored hash so is not valid
        //         echo 'Invalid password.';
        //     }
        // Bind result variables
        $stmt->bind_result($hashed_password);

        // Fetch the result
        $stmt->fetch();

        // Check the password
        $password = $_POST['password'];
        if (password_verify($password, $hashed_password)) {
        echo 'Password is valid!';
        } else {
        echo 'Invalid password.';

            session_regenerate_id();
            $stmt->bind_result($id);
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $stmt->fetch();
            header('Location: /neatest/html/ulogin.html');
        } else {
            echo "<script>alert('1 or 2 of your details were incorrect - please try again');
            window.location = '/neatest/html/u
            
            
            // +-                                         login.html' </script>";

        }
    }
?>
