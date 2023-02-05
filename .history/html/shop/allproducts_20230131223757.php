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
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (!isset($_COOKIE['cookie_auth'])) {
        header('location: /neatest/html/ulogin.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script> 
        history.pushState({page: 'allproducts'}, 'All Products', '/neatest/html/shop/allproducts.php'); 
    </script>
</head>
<body>
    <div class="container">
    <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" style="font-size: 31px; color: #FFFFFF;"></i>
            <ul class="sidebar-list" id="sidebar-list">
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">All</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">New Items</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Hats</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Outerwear</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Sweatshirts</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Shirts</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/bottomwear.php" class="item-link">Bottomwear</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Socks</a>
                </li>
                <li>
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Footwear</a>
                </li>
            </ul>
        </nav>
        <div class="bg">
            <!-- <div class="loginlink"> -->
                <!-- We need an onclick event for the login page, in this case it runs the function that sets the cookie to false -->
                <!-- <a href="/neatest/html/ulogin.php" onclick="remove_cookie()" class="blue-link">logout</a>
            </div> -->
            <div class="baglink">
                <a href="/neatest/html/shop/bagview.php"class="blue-link">bag</a>
            </div>
            <h1>All</h1>
            
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

                // create a connection to the database
                $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                } else {
                    // we need to get all products from product_stock table as this is all prod
                    $query = "SELECT * FROM product_stock";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($product = mysqli_fetch_assoc($result)) {
                            // access data for the product using the keys of the $product array
                            $product_id = $product['product_id'];
                            $product_image = $product['image'];

                            // we need the product_id echoed
                            echo "<a href='product.php?id=$product_id'>";
                            // output the product image in HTML
                            if (file_exists($product_image)) {
                                echo "<img src='$product_image' width='150px' height='150px' margin-right='62px !important' alt=''>";
                            } else {
                                echo "Image file not found.";
                            }
                            
                        }
                    }
                }
            ?>


            </div>

            </div>
        </div>
    </div>
    <script src="/neatest/js/sidebar.js"></script>
</body>