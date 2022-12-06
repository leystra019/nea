<?php
    $order_id = $_POST['id(s)'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $conn = new mysqli('localhost', 'root', 'phporders');
    if($conn->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    }
    else{
        $stmt= $conn->prepare("insert into orderline(id, product_id, quantity, price) values(?, ?, ?, ?)");
        $stmt ->bind_param("iiii", $id, $product_id, $quantity, $price);
        $stmt ->execute();
        echo "order has been changed...";
        $stmt ->close();
    }
    