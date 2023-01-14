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
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
?>