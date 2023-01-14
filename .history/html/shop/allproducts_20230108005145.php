<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (!isset($_COOKIE['cookie_auth'])) {
        header('location: /neatest/html/ulogin.php');
    }

    function remove_cookie() {
        $cookie_value = false;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <link rel="stylesheet" href="/neatest/css/shopallitems.css">
    <script> 
        history.pushState({page: 'allproducts'}, 'All Products', '/neatest/html/shop/allproducts.php'); 
    </script>
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="/neatest/html/home.html">=</a></li>
            </ul>
        </nav>
        <div class="bg">
            <div class="loginlink">
                <a href="/neatest/html/ulogin.php" onclick="remove_cookie()" class="blue-link">logout</a>
            </div>
            <div class="ordslink">
                <a href="/neatest/html/slogin.html"class="blue-link">orders</a>
            </div>
            <div class="baglink">
                <a href="/neatest/html/shop/bagview.php"class="blue-link">bag</a>
            </div>
            <h1>All Products</h1>
            
            <div class="scroller" id="pcontainer">
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
                            echo "<a href='product.php?id=$product_id'>";
                            echo "<img src='uploaded_img/$product_image' width='150px' height='150px' margin-right= '62px !important' alt=''>";
                            echo "</a>";
                        }
                    }
                }
            ?>


            </div>

            </div>
        </div>
    </div>
</body>