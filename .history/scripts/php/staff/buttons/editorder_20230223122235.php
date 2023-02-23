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

    // Before we begin, we are checking our form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Here we are creating variables with the details posted to use later
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $order_id = $_POST['order_id'];

        // This is where we are updating the details of an order, but we have left the users email out of it because it is read only/not editable
        // To avoid sql injection we need to bind the parameters
        $query = "UPDATE orders SET quantity = ?, price = ?, status = ? WHERE order_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "idiii", $quantity, $price, $status, $order_id, $product_id);
        mysqli_stmt_execute($stmt);        

        // Once this is done we want to redirect the user to the manage order page (their previous location)
        header('Location: /neatest/scripts/php/staff/manageorder.php');
        exit;
    }
?>
