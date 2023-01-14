<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'neatest';

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $query = "SELECT * FROM product_stock";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                // access data for the product using the keys of the $product array
                $product_id = $product['product_id'];
                $product_image = $product['image'];

                // output the product data in HTML
                echo "<form action='' method='post'>";
                echo "<article>";
                echo "<div class='inner-article'>";
                echo "<a href='product.php?id=$product_id'>";
                echo "<img src='uploaded_img/$product_image' width='149px' height='149px' alt='item'>";
                echo "</a>";
                echo "</div>";
                echo "</article>";
                echo "</form>";
            }
        }
    }
?>