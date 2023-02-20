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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // get the form data
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $order_id = $_POST['order_id'];

        // prepare and execute the SQL statement
        $query = "UPDATE orders SET quantity = ?, price = ?, status = ? WHERE order_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "idiii", $quantity, $price, $status, $order_id, $product_id);
        mysqli_stmt_execute($stmt);        

        // redirect the user to the manage order page
        header('Location: /neatest/scripts/php/staff/manageorder.php');
        exit;
    }
?>
