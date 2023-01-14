<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase item</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <link rel="stylesheet" href="/neatest/css/shopallitems.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="/neatest/html/home.html">=</a></li>
            </ul>
        </nav>
        <div class="bg">
            <div class="brandname">
                <a style="margin-top: 61px !important; margin: left 157px;">SneakersnSteals</a>
            </div>
            <div class="loginlink">
                <a href="/neatest/html/ulogin.html"class="blue-link">login</a>
            </div>
            <div class="ordslink">
                <a href="/neatest/html/slogin.html"class="blue-link">orders</a>
            </div>
            <div class="baglink">
                <a href="/neatest/html/bag.html"class="blue-link">bag</a>
            </div>
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
                            echo "<img src='uploaded_img/$product_image' width='149px' height='149px' alt=''>";
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