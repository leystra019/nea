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


    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    else {
        echo "connection succesful"
//        $stmt = $con->prepare ("insert into Test ( userid, email, password) values ( ?, ?, ?)");
//         // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
//         $id = 25
//         $stmt->bind_param('iss', $id, $_POST['username'], $_POST['password1']);
//         // execute the sql statement above
//         $stmt->execute();
//         echo "order has been changed...";
//         $stmt ->close();
//         // Store the result so we can check if the account exists "in the database.
        // $stmt->store_result();
        // if ($stmt->num_rows > 0) {
        //     // Verification success! User has registered!
            
        //     session_regenerate_id();
        //     $stmt->bind_result($id, $staff);
        //     $_SESSION['loggedin'] = TRUE;
        //     $_SESSION['name'] = $_POST['username'];
        //     $_SESSION['id'] = $id;
        //     $stmt->fetch();
        //     if ($staff) {
        //         header('Location: /neatest/html/staffhome.html');
        //     } else {
        //         header('Location: /neatest/html/sfff.html');
        //     }
        // } else {
        //     echo "<script>alert('1 or 2 of your details were incorrect - please try again');window.location = '/neatest/html/login.html' </script>";

        // }
    }
?>
