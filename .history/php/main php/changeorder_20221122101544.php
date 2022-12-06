<?php
    ini_set('display_errors', 1);

    

    ini_set('display_startup_errors', 1);

    

    error_reporting(E_ALL);
    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phpordersupdated';

    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if($conn->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    }
    else{
        $stmt= $conn->prepare ("insert into orders (id, order_id, product_id, quantity, price) values (?, ?, ?, ?, ?)");
        $stmt ->bind_param("siiii", $id, $order_id, $product_id, $quantity, $price);
        $stmt ->execute();
        echo "order has been changed...";
        $stmt ->close();
    }
    
?>