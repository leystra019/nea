<?php
    $servername   = "localhost";
    $database = "neatest";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
    // if connection fails, die and tell the user
    echo "Connection failed. Please contact the admin of this website admin@sns.co.uk";
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";


?>