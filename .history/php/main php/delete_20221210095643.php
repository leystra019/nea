<?php
    if ( isset($_GET["ID"]))
    $id = $_GET["ID"];

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'neatest';

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if($conn->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    }

    else{
        $sql = "Delete from orders where id=$id";
        $result = $conn->query($sql);
    }
    header('Location: /neatest/html/order test.php')
?>
