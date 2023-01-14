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
    / Retrieve the products from the bag table
    $query = "SELECT * FROM bag";
    $result = mysqli_query($conn, $query);

    // Loop through the result set and display the data for each product
    while ($product = mysqli_fetch_assoc($result)) {
    $title = $product['title'];
    $price = $product['price'];
    $image = $product['image'];
    $quantity = $product['quantity'];
    
    echo '<div class="product">';
    echo '<img src="' . $image . '" alt="' . $title . '">';
    echo '<h4>' . $title . '</h4>';
    echo '<p>Price: £' . $price . '</p>';
    echo '<p>Quantity: ' . $quantity . '</p>';
    echo '</div>';
    }
}

?>
