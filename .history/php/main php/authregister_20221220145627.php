<?php
    // these variables contain the credentials for the database
    $servername   = "localhost";
    $database = "neatest";
    $username = "root";
    $password = "";
    // create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // check connection
    if ($conn->connect_error) {
        // if connection fails, die and tell the user
        echo "Connection failed. Please contact the admin of this website admin@sns.co.uk";
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        // we are taking the input from the user and storing it into variables
        $html_username = $_POST['username'];
        $html_password1 = $_POST['password1'];
        $html_password2 = $_POST['password2'];
        // hash the passwords for security
        $password1_hash = password_hash($html_password1, PASSWORD_DEFAULT);
        // check if the passwords are the same
        if (empty($_POST["name"])) {
            die("Name is required");
        }
        
        if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("Valid email is required");
        }
        
        if (strlen($_POST["password"]) < 8) {
            die("Password must be at least 8 characters");
        }
        
        if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
            die("Password must contain at least one letter");
        }
        
        if ( ! preg_match("/[0-9]/", $_POST["password"])) {
            die("Password must contain at least one number");
        }
        
        if ($_POST["password1"] !== $_POST["password2"]) {
            die("Passwords must match");
        }


        $sql = "insert into users (name, email, password1_hash) values ( ?, ?, ?)";
        $stmt ->bind_param("ss", $password2, $username);
        $stmt ->execute();
        echo "User has succesfully registered..";
    }
?>