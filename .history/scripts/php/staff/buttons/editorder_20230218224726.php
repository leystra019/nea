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
        $query = "UPDATE orders SET product_id = ?, quantity = ?, price = ?, status = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iidii", $product_id, $quantity, $price, $status, $order_id);
        mysqli_stmt_execute($stmt);
        ?>
        <script>
            window.location.href = "/neatest/scripts/php/staff/manageorder.php";
        </script>
        
        <?php
    }
?>```
