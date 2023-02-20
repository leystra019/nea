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

    else {
        $sql = "UPDATE orders ( order_id, product_id, quantity, price, status) values ( ?, ?, ?, ?, ?)";
        $stmt ->bind_param("iiidi", $order_id, $product_id, $quantity, $price,  $status);
        $stmt ->execute();
        echo "order has been changed...";
        $stmt ->close();

    }
?>