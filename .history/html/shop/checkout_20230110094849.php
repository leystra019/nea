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
                                echo '<input type="text" class="short-form" placeholder="Name" name="name" required title="This field is required" value="' . htmlspecialchars($_COOKIE['name']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" required title="This field is required" placeholder="Name" name="name">';
                              }
                              if (isset($_COOKIE['email'])) {
                                echo '<input type="text" class="short-form" placeholder="Email" required title="This field is required" name="email" value="' . htmlspecialchars($_COOKIE['email']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" placeholder="Email" required title="This field is required" name="email">';
                              }
                              if (isset($_COOKIE['phone'])) {
                                echo '<input type="text" class="short-form" placeholder="Phone Number" required title="This field is required" name="phone" value="' . htmlspecialchars($_COOKIE['phone']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" placeholder="Phone Number" required title="This field is required" name="phone">';
                              }
                              if (isset($_COOKIE['residence'])) {
                                echo  '<input type="text" class="short-form" placeholder="Residence" required title="This field is required" name="residence" value="' . htmlspecialchars($_COOKIE['residence']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" placeholder="Residence" required title="This field is required" name="residence">';
                              }
                              if (isset($_COOKIE['Billingad'])) {
                                echo '<input type="option" class="long-form" placeholder="Billing Adress" required title="This field is required" name="billingad" value="' . htmlspecialchars($_COOKIE['billingad']) . '">';
                              } else {
                                echo '<input type="text" class="long-form" placeholder="Billing Adress" required title="This field is required" name="billingad">';
                              }
                              if (isset($_COOKIE['Shippingad'])) {
                                echo ' <input type="text" class="long-form" placeholder="Shipping Adress" name="shippingad" required title="This field is required" value="' . htmlspecialchars($_COOKIE['shippingad']) . '">';
                              } else {
                                echo ' <input type="text" class="long-form" placeholder="Shipping Adress" required title="This field is required" name="shippingad">';
                              }
                              if (isset($_COOKIE['city'])) {
                                echo '<input type="text" class="short-form" placeholder="City" name="city"  required title="This field is required" value="' . htmlspecialchars($_COOKIE['shippingad']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" placeholder="City" name="city">';
                              }
                              if (isset($_COOKIE['postcode'])) {
                                echo '<input type="text" class="short-form" placeholder="Postcode" name="postcode" required title="This field is required" value="' . htmlspecialchars($_COOKIE['postcode']) . '">';
                              } else {
                                echo '<input type="text" class="short-form" placeholder="postcode" required title="This field is required" name="postcode">';
                              }
                              if (isset($_COOKIE['save_info'])) {
                                echo 'Info saved';
                                echo '<input type="Checkbox" value="1" checked="checked">';
                              } else {
                                echo 'Save info? ';
                                echo '<input type="Checkbox" name="save_info" value="0">';
                              }
                            ?>
                        </form>
                        <div class="finalch_container">
                            <div class="checkout-btn">
                                <a href="/neatest/html/shop/checkout.php" value="submit">Checkout</a>
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
                      <div class="flex-selectedpayment">
                        <input type="checkbox" id="paymentnotreq" name="paymentnotrequired" value="1" checked>
                        <a> Payment not required<a>
                      </div>
                    </div>

        
                </div>



        </div>
    </div>
</body>  