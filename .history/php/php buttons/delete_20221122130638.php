<?php
    ini_set('display_errors', 1);

    

    ini_set('display_startup_errors', 1);

    

    error_reporting(E_ALL);
    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phporders';

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if($conn->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    } else {
        $order_id = $_POST['order_id'];
        $qry = "select * from orders where order_id = "$order_id";
        $run = $db  -> query($qry);
        (if $run -> num_rows > 0){
            $order_id = $row['order_id';
            $product_id = $row['product_id';
            $quantity_id = $row['quantity_id';
            $status = $row['status';
    // header("location: /neatest/php/main php/order test.php");
    exit;
?>