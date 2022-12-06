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
    } else
        $order_id = $_POST['order_id'];
        $qry = "delete from orders where order_id = "$order_id";
        if($mysqli_query($db, $qry)){
            header('location: /php/ main php/ order test.php');
        }else{
            echo $mysqli_error($db)
    exit;
?>