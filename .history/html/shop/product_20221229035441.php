<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database and retrieve the product data
$conn = mysqli_connect('localhost', 'root', '', 'neatest');
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Retrieve the product ID from the URL query string
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Retrieve the product data from the database
$query = "SELECT * FROM product_stock WHERE product_id = $productId";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  $product = mysqli_fetch_assoc($result);
  $title = $product['title'];
  $brand = $product['brand'];
  $description = $product['description'];
  $size = $product['size'];
  $material = $product['material'];
  $price = $product['price'];
}

if(isset($_POST['add_to_bag'])) {
    $product_title = $_POST['title'];
    $product_price = $_POST['price'];
    $product_image = $_POST['image'];
    $product_quantity = 1;

    $select_bag = mysqli_query($conn, "SELECT * FROM bag");
    if(mysqli_num_rows($select_bag) > 0){
        $alert[] = 'product has already been added to bag';
    }else {
        $insert_product = mysqli_query($conn, "INSERT INTO bag (title, price, image, quantity) VALUES ('$product_title', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase item</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <script src="/neatest/js/purchaseitem.js"></script>
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
            <div class="divide">
                <div class="product">

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
                    <form action="" method="post">
                        <input type="hidden" name="title" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="image" value="<?php echo $image; ?>">
                        <input type="submit" value="Add to bag" class="bagbtn" name="add_to_bag">
                        <button class="backbtn" id="button">Head Back</button>
                    </form>
                </div>
                
            </div>

            

        </div>
    </div>
    
    
</body>
</html>