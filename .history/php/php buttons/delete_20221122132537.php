<?php
function deleteorder() {
    $order_id = $_POST['order_id'];
    $qry = "delete from orders where order_id = "$order_id";
    if($mysqli_query($db, $qry){
        header('location: /php/ main php/ order test.php');
    }else{
        echo $mysqli_error($db)
    }
}
?>