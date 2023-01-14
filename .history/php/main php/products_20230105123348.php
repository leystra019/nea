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


    $sql = "SELECT * FROM users WHERE id = 1";
    $result = mysqli_query($conn, $sql);

    // Fetch the data from the database
    $row = mysqli_fetch_assoc($result);

    // Output the data into the HTML header
    echo "<h1>" . $row['name'] . "</h1>";
    echo "<p>" . $row['email'] . "</p>";

    // Close the connection to the database
    mysqli_close($conn);
    }
?>