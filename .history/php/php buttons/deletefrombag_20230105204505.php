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
        
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Check if the product with the specified ID exists in the bag table
        $query = "SELECT * FROM bag WHERE product_id = $productId";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
        // The product exists in the bag table, so we can delete it
        $delete_query = "DELETE FROM bag WHERE product_id = $productId";
        $delete_result = mysqli_query($conn, $delete_query);
        if ($delete_result) {
            echo Product has been successfully deleted
            // You can redirect the user back to the bag page or display a message
        } else {
            // There was an error deleting the product
        }
        } else {
        // The product does not exist in the bag table
        // You can display an error message or take some other action
        }
    }

?>
        <!-- $delete_from_bag_n_checkout = 'DELETE bag, checkout
        FROM bag
        INNER JOIN checkout ON bag.item_id = checkout.item_id
        WHERE bag.item_id = [value];'
    } -->