<?php

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
    </div>
</body>