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
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    /// if user allow to login
    if($conn->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    } else {
        if (isset($_COOKIE['user_id'])) {
            $user_id = (int)$_COOKIE['user_id'];
            echo 'The value of the cookie is: ' . $_COOKIE['user_id'];
        } else {
            echo 'The cookie has not been set';
        }
    }
?>
