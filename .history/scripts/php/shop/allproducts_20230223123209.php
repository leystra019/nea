

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="/neatest/scripts/css/shop/shop.css">
    <link rel="stylesheet" href="/neatest/css/shshopallitems.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
    <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" style="font-size: 31px; color: #FFFFFF;"></i>
            <ul class="sidebar-list" id="sidebar-list">
                <li>
                    <a href="/neatest/scripts/php/shop/allproducts.php" class="item-link">All</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/newproducts.php" class="item-link">New Items</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/hats.php" class="item-link">Hats</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/outerwear.php" class="item-link">Outerwear</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/sweatshirts.php" class="item-link">Sweatshirts</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/shirts.php" class="item-link">Shirts</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/socks.php" class="item-link">Bottomwear</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/socks.php" class="item-link">Socks</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/footwear.php" class="item-link">Footwear</a>
                </li>
            </ul>
        </nav>
        <div class="bg">
            <div class="baglink">
                <a href="/neatest/scripts/php/shop/bagview.php"class="blue-link">bag</a>
            </div>
            <h1>All</h1>
            
            <div class="scroller" id="pcontainer">
            <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                // 
                session_start();

                $DATABASE_HOST = 'localhost';
                $DATABASE_USER = 'root';
                $DATABASE_PASS = '';
                $DATABASE_NAME = 'neatest';

                // As we haven't already. We need to create a connection to the database
                $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                } else {
                    // we need to get all products from product_stock table before displaying
                    $query = "SELECT * FROM product_stock";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($product = mysqli_fetch_assoc($result)) {
                            // access data for the product using the keys of the $product array
                            $product_id = $product['product_id'];
                            $product_image = $product['image'];
                    
                            // we need the product_id echoes
                            echo "<a href='product.php?id=$product_id'>";
                            // output the product image on the website
                            echo "<img src=$product_image width='150px' class='product-image' height='150px' margin-right='62px !important' alt=''>";
                        }
                    }
                    
                }
            ?>


            </div>

            </div>
        </div>
    </div>
    <script src="/neatest/scripts/js/sidebar.js"></script>
</body>