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
    <title>View Bag</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <link rel="stylesheet" href="/neatest/css/bagview.css">
    <link rel="stylesheet" href="/neatest/css/checkout.css">
</head>
<body>
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
                <a href="/neatest/html/bag.html"class="blue-link">bag</a>
            </div>
            <h1> Checkout</h1>
            <div class="bag-card">
                <div class = "checkoutcontainer">
                    <div class ="left-head">
                        <a>Shipping Information</a>
                    </div>
                    <div class="left-content">
                        <form action="/neatest/php/main php/check_out.php" method="post">
                            <?php
                              if (isset($_COOKIE['name'])) {
                                echo '<input type="text" class="short-form" placeholder="Name" name="name" value="' . htmlspecialchars($_COOKIE['name']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" placeholder="Name" name="name">';
                              }
                            ?>
                            
                            <input type="text" class="short-form" placeholder="Email" name="email">
                            <input type="text" class="short-form" placeholder="Phone Number" name="phone">
                            <input type="text" class="short-form" placeholder="Residence" name="residence">

                            <input type="text" class="long-form" placeholder="Billing Adress" name="Billingad">
                            <input type="text" class="long-form" placeholder="Shipping Adress" name="Shippingad">
                            <!-- Have something to say if the user has same billing/shipping adress -->
                            <input type="text" class="short-form" placeholder="City" name="city">
                            <input type="text" class="short-form" placeholder="Postcode" name="postcode">
                        </form>
                        <div class="finalch_container">
                            <div class="checkout-btn">
                                <a href="/neatest/html/shop/checkout.php">Checkout</a>
                            </div>
                            <div class="continueshop-btn">
                                <a href=" ">Continue Shop</a>
                            </div>
                        </div>    
                    </div>
                    <div class ="right-head">
                        <a>Payment Information</a>
                    </div>
                    <div class="right-content">
                    </div>

        
                </div>



        </div>
    </div>
</body>  