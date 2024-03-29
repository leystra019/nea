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
            header('Location: /neatest/scripts/php/staffhome.php');
        } else {
            echo "<script>alert('1 or 2 of your details were incorrect - please try again');window.location = '/neatest/html/slogin.html' </script>";

        }
    }
?>
