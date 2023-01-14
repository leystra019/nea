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
        // check if the passwords are the same
        if ($html_password1 == $html_password2) {
            echo "Success";
        } else {
            echo "Passwords don't match! Please try again"
        }
        echo  $html_username;
    }




?>