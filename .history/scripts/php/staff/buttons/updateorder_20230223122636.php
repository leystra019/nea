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

    // Before we begin, we are checking an order_id exists for what we are trying to update
    if (isset($_POST['order_id'])) {
        // We need to set a variable to use later
        $order_id = $_POST['order_id'];
    
        // This is where we are updating the details of an order's status, 2 is the number given to an order that has been procesed and set out for delivery
        // To avoid sql injection we need to bind the parameters
        $query = "UPDATE orders SET status = 2 WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $order_id);
    
        // Execute the statement
        mysqli_stmt_execute($stmt);
    }
    
?>
