<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);



    // these variables contain the credentials for the database
    $servername   = "localhost";
    $database = "neatest";
    $username = "root";
    $password = "";
    // create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // check connection
    if (mysqli_connect_error()) {
        // if connection fails, die and tell the user
        echo "Connection failed. Please contact the admin of this website admin@sns.co.uk";
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        // We need to get the largest ID value from the Database in order to create a new user
        // $stmt = $conn->prepare('SELECT MAX(id) AS max FROM users');
        // $stmt->execute();

        $result =mysqli_query($conn, "SELECT  MAX(id) as max , MIN(id) as min FROM users");

        while($res = mysqli_fetch_array($result)) { 



           $max = $res['max']; 
           echo 'Highest Number :'.$max.'<br>'; 



            $min=$res['min'].'<br>'; 
            echo 'Lowest Number :'.$max.'<br>'; 

        }
        // we are taking the input from the user and storing it into variables

    //     $html_name = mysqli_real_escape_string($conn, $_POST['name']);
    //     $html_username = mysqli_real_escape_string($conn, $_POST['username']);
    //     $html_password1 = mysqli_real_escape_string($conn, $_POST['password1']);
    //     $html_password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    //     // check if the passwords are the same
    //     if (empty($_POST["name"])) {
    //         die("Name is required");
    //     }
        
    //     if ( ! filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
    //         die("Valid email is required");
    //     }
        
    //     if (strlen($_POST["password2"]) < 8) {
    //         die("Password must be at least 8 characters");
    //     }
        
    //     if ( ! preg_match("/[a-z]/i", $_POST["password2"])) {
    //         die("Password must contain at least one letter");
    //     }
        
    //     if ( ! preg_match("/[0-9]/", $_POST["password2"])) {
    //         die("Password must contain at least one number");
    //     }
        
    //     if ($_POST["password1"] !== $_POST["password2"]) {
    //         die("Passwords must match");
    //     }
    //     // hash the passwords for security
    //     $password1_hash = password_hash($html_password1, PASSWORD_DEFAULT);
    //     // prepare statement
    //     $stmt = mysqli_prepare($conn, "INSERT INTO users (id, name, username, password_hash) VALUES (?, ?, ?, ?)");
    //     // bind variables to statement
    //     mysqli_stmt_bind_param($stmt, "isss", $newid, $html_name, $html_username, $password1_hash);
    //     // execute statement
    //     if (mysqli_stmt_execute($stmt)) {
    //         // redirect to success page
    //         header("Location: signupsuccess.html");
    //         exit;
    //     } else {
    //     // check if email is already taken
    //         if (mysqli_errno($conn) === 1062) {
    //             die("email already taken");
    //         } else {
    //             die(mysqli_error($conn) . " " . mysqli_errno($conn));
    //         }
    //     }
    }
?>