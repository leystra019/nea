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
        // Get the product ID from the query string
        $id = $_GET['id'];

        // Validate the ID to prevent SQL injection attacks
        if (!is_numeric($id)) {
            // If the ID is not numeric, display an error message and exit
            echo 'Invalid product ID';
            exit();
        }
        $query = "SELECT * FROM product_stock where id = $id";
        $result = mysqli_query;

        // Check for a query error
        if (!$result) {
            // If there is an error, display an error message and exit
            echo 'An error occurred: ' . mysqli_error($conn);
            exit();
        }

        // Check for a result
        if (mysqli_num_rows($result) > 0) {
            // If there is a result, fetch the product data
            $product = mysqli_fetch_assoc($result);

            // Encode the product data as a JSON object and return it
            echo json_encode($product);
    }}
?>
