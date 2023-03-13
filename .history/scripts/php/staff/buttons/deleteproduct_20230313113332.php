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

    // we need to check that the product_id exist
    if (isset($_POST['product_id'])) {
        // Here we are setting the variables to use later
        $product_id = $_POST['product_id'];
      
        // This is where we perform the deletion query using values of product_id
        // To avoid sql injection we need to bind the parameters
        $query = "DELETE FROM product_stock WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
    }
      
    
?>