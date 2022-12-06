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
    if($con->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    }

    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    
    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
        exit('uh oh');
    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    else {
        $stmt = $con->prepare('SELECT id, staff FROM users WHERE name = ? AND password = ?');
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // Verification success! User has logged-in!
            session_regenerate_id();
            $stmt->bind_result($id, $staff);
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $stmt->fetch();
            if ($staff) {
                header('Location: /neatest/html/staffhome.html');
            } else {
                header('Location: /neatest/html/sfff.html');
            }
        } else {
            echo '<script>alert("Welcome to Geeks for Geeks"); window.location: /neatest/html/sfff.html </script>';

        }
    }
?>
