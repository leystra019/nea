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
    
        $productid = 'product_id';
        echo 'product_id';

        // Check if the product with the specified ID exists in the bag table
        $query = "SELECT bag WHERE product_id = ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // The product exists in the bag table, so we can delete it
            $delete_query = "DELETE FROM bag WHERE product_id = $productid";
            $delete_result = mysqli_query($conn, $delete_query);

            // Check if the delete operation was successful
            if ($delete_result) {
                header('Location: /neatest/html/shop/bagview.php');
            } else {
                echo "There was an error deleting the product from the bag table: " . mysqli_error($conn);
            }
        }
    }
        

?>
