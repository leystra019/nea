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
        if ($html_password1 == $html_password2) {
            // send the user to the login page if succesfull
            // header('Location: /neatest/html/user login.html');
            $sql = "select * from users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                // put all the emails into an array and check if the usernames match
                    $new_array[] = $html_username;
                    
                    
                }
              } else {
                    echo "this email/username already exists! You need to input a different email/username!";
              }
        } else {

            echo "Passwords don't match! Please try again";
        }
    }
?>