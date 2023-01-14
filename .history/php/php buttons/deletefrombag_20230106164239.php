<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);



    // these variables contain the credentials for the database
    $servername   = "localhost";
    $database = "neatest";
    $username = "root";
    $password = "";
    // create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // check connection
    if (mysqli_connect_error()) {
        // if connection fails, die and tell the user
        echo "Connection failed. Please contact the admin of this website admin@sns.co.uk";
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        // Get the product ID
        $productid = 'product_id';

        // Delete the product from the bag table
        $delete_query = "DELETE FROM bag WHERE product_id = $productid";
        $delete_result = mysqli_query($conn, $delete_query);

        // Check if the delete operation was successful
        if ($delete_result) {
            // Delete the quantity for the product from the other table
            $delete_quantity_query = "UPDATE product_stock SET quantity = quantity - 1 WHERE product_id = $productid";";
            $delete_quantity_result = mysqli_query($conn, $delete_quantity_query);
            if ($delete_quantity_result) {
                // Redirect to the bagview page
                header('Location: /neatest/html/shop/bagview.php');
            } else {
                echo "There was an error deleting the quantity from the other table: " . mysqli_error($conn);
            }
        } else {
            echo "There was an error deleting the product from the bag table: " . mysqli_error($conn);
        }
        

?>
