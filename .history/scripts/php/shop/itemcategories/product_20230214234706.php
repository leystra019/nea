<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    // Connect to the database and retrieve the product data
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
    }
    // Retrieve the product ID from the URL query string
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


    // Retrieve the product data from the database
    $query = "SELECT * FROM product_stock WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $id = $product['product_id'];
        $image = $product['image'];
        $title = $product['title'];
        $brand = $product['brand'];
        $description = $product['description'];
        $size = $product['size'];
        $material = $product['material'];
        $price = $product['price'];
    }

    
    

    // Add the product to the shopping bag
    if (isset($_POST['bagbtn'])) {
        if ($_SESSION['session_auth'] != 0) {
            $product_title = $_POST['title'];
            $product_price = $_POST['price'];
            $product_image = $_POST['image'];
            $product_quantity = 1;
        } else {
            setcookie("basket_redirect", 1, time() + 3600);
            ?>
            <script>
                alert("You must be logged in to add products to bag.");
                window.location.href = "/neatest/scripts/php/login/ulogin.php";
            </script>
            <?php
        }

        // Get the bag item from cookie(s)
        if (isset($_COOKIE['bag'])) {
            // If not empty, then append to existing bag new details
            $current_bag = json_decode($_COOKIE['bag'], true);
            // Checking if the product has already been added to the bag
            if (isset($current_bag[$product_id])) {
                // Increase the quantity by 1
                $current_bag[$product_id] += 1;
            } else {
                // If product is not in the bag add 1 of the item to the bag
                $current_bag[$product_id] = 1;
            }
        } else {
            // So create a new array, with the only item in there being the item we first had
            $current_bag = array($product_id => 1);
        }
        // overwrite the cookie with a new bag
        setcookie('bag',json_encode($current_bag), time() + 86400);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase item</title>
    <link rel="stylesheet" href="/neatest/scripts/css/shop/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/neatest/scripts/js/purchaseitem.js"></script>
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" class="barsmenu" style="font-size: 31px; color: #FFFFFF;"></i>
            <ul class="sidebar-list" id="sidebar-list">
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/allproducts.php" class="item-link">All</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/newproducts.php" class="item-link">New Items</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/hats.php" class="item-link">Hats</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/outerwear.php" class="item-link">Outerwear</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/sweatshirts.php" class="item-link">Sweatshirts</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/shirts.php" class="item-link">Shirts</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/socks.php" class="item-link">Bottomwear</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/socks.php" class="item-link">Socks</a>
                </li>
                <li>
                    <a href="/neatest/scripts/php/shop/itemcategories/footwear.php" class="item-link">Footwear</a>
                </li>
            </ul>
        </nav>
        <div class="bg">
            <!-- <div class="ordslink">
                <a href="/neatest/html/slogin.html"class="blue-link">orders</a>
            </div> -->
            <div class="baglink">
                <a href="/neatest/scripts/php/shop/bagview.php"class="blue-link">bag <span></span></a>
            </div>
            <div class="divide">
                <div class="product">
                    <div class="image">
                        <img src="<?php echo $image; ?>" width="570px" height="590px" style="margin-right: 62px !important;">
                    </div>
                </div>
                <div class="extrap">

                </div>
                <div class="pdescription">
                    <h4 id="product-name"><?php echo $title; ?></h4>
                    <h5><?php echo $brand; ?></h5>
                    <p id="product-description"><?php echo $description; ?></p>
                    <div class="size">
                        size: <?php echo $size; ?>
                    </div>
                    <div class="material">
                        material: <?php echo $material; ?>
                    </div>
                    <div class="product-price">
                        £<?php echo $price; ?>
                    </div>

                    <?php
                        $product_out_of_stock = false;

                        // Select the stock level of the product
                        $sql = "SELECT stock_level FROM product_stock WHERE product_id = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $product_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        // Check the result
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            if ($row['stock_level'] == 0) {
                            $product_out_of_stock = true;
                            }
                        } else {
                            echo "No product found";
                        }
                    ?>
                        <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="title" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="image" value="<?php echo $image; ?>">
                        <input type="submit" value="<?php echo ($product_out_of_stock == true) ? 'Out of Stock' : 'Add to Bag'; ?>"  id="bagbtn" class="bagbtn<?php echo ($product_out_of_stock == true) ? ' bagbtn-out-of-stock' : ''; ?>" name="bagbtn" <?php echo ($product_out_of_stock == true) ? 'disabled' : ''; ?>>
                        <button type="button" class="backbtn" id="button" onclick="history.back()">Head Back</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <script src="/neatest/scripts/js/sidebar.js"></script>
    <script src="/neatest/scripts/js/addtobag.js"></script>
</body>
</html>