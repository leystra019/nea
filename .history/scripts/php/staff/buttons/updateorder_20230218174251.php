<?php


    if (isset($_POST['order_id'])) {
        var_dump($_POST['order_id']);
        $order_id = $_POST['order_id'];
    
        $query = "UPDATE orders SET status = 2 WHERE order_id = $order_id";
        if(mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Order status updated successfully";
        } else {
            echo "Error updating order status: " . mysqli_error($conn);
        }
    } 
?>
