<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    // check if the connection works
    if ($conn->connect_error) {
        //if the connection doesn't work report error
        die('Connection failed: ' . $conn->connect_error);
    }


    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
    
        // Prepare the query
        $query = "UPDATE orders SET status = 2 WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $order_id);
    
        // Execute the statement
        mysqli_stmt_execute($stmt);
    }
    
?>
