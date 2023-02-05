<?php
    ini_set('display_errors', 1);

    

    ini_set('display_startup_errors', 1);

    

    error_reporting(E_ALL);
    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'neatest';

    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if($conn->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    }
    else{ // Get the product ID of the item to be checked out
        $product_id = $_POST['product_id'];
        
        // Delete the item from the bag table
        $sql = "DELETE FROM bag WHERE product_id = $product_id";
        $result = mysqli_query($conn, $sql);
        
        // Check if the DELETE statement was successful
        if (!$result) {
            die('Error: ' . mysqli_error($conn));
        }
        
        // Delete the item from the products table
        $sql = "DELETE FROM products WHERE product_id = $product_id";
        $result = mysqli_query($conn, $sql);
        
        // Check if the DELETE statement was successful
        if (!$result) {
            die('Error: ' . mysqli_error($conn));
        }
        
        // Close the connection to the database
        mysqli_close($conn);
    }
?>