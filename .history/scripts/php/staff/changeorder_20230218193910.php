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
    else{
        $stmt= $conn->prepare (" orders ( order_id, product_id, quantity, customer_id, status) values ( ?, ?, ?, ?, ?)");
        $stmt ->bind_param("iiiis", $order_id, $product_id, $quantity, $customer_id,  $status);
        $stmt ->execute();
        echo "order has been changed...";
        $stmt ->close();
    }
    
?>
