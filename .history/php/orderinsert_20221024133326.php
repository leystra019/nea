<?php
    ini_set('display_errors', 1);

    

    ini_set('display_startup_errors', 1);

    

    error_reporting(E_ALL);
    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phporders';

    $id = $_POST[''];
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if($con->connect_error){
        die('Connection failed : ' .$conn->connect_error);
    }
    $sql = " * FROM orderline";
    $result = $connection->query($sql);

    if(!$result) {
        die("Invalid query: " . $connection->error);
    }

    while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row["id"] . "</td>
        <td>" . $row["order_id"] . "</td>
        <td>" . $row["product_id"] . "</td>
        <td>" . $row["Quantity"] . "</td>
        <td>" . $row["Price"] . "</td>
        <td>
            <a class='button' href='duplicate'>Duplicate</a>
            <a class='button' href='update'>Update</a>
            <a class='button' href='Delete'>Delete</a>
        </td>
    </tr>";
    }
    ?>

    