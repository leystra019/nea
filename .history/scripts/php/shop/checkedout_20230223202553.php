<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    



    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    // check if the connection works
    if ($conn->connect_error) {
        //if the connection doesn't work report error
      die('Connection failed: ' . $conn->connect_error);
    }
    // check user has logged in
    if ($_SESSION['session_auth'] = 0) {
        // if the user hasn't logged in already, send them back to the login page
        header('location: /neatest/scripts/php/login/ulogin.php');
    }

    else{
        // if logged in with bag
        if(isset($_COOKIE['checkedout_bag'])) {
            //get the contents of the bag
            $current_bag = json_decode($_COOKIE['checkedout_bag'], true);
            // set the contents of the bag to a variable
            $current_bag_keys = array_keys($current_bag);
            //run a statement for if the user has clicked on a product
            if (!empty($current_bag_keys)) {
                // get everything from product_stock table where the stored product_id is
                $stmt = $conn->prepare("SELECT * FROM product_stock WHERE product_id in (" . implode(',', $current_bag_keys) . ")");
            } else {
                // if the bag isn't empty, select everything from product stock
                $stmt = $conn->prepare("SELECT * FROM product_stock");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bag</title>
    <link rel="stylesheet" href="/neatest/scripts/css/shop/shop.css">
    <link rel="stylesheet" href="/neatest/scripts/css/shop/bagview.css">
    <link rel="stylesheet" href="/neatest/scripts/css/shop/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" style="font-size: 31px; color: #FFFFFF;"></i>
            <ul class="sidebar-list" id="sidebar-list">
                <li>
                    <a href="/neatest/scripts/php/shop/allproducts.php" class="item-link">All</a>
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
            <div class="loginlink">
                <a href="/neatest/scripts/php/login/ulogin.php" onclick="remove_cookie()" class="blue-link">logout</a>
            </div>
            <div class="baglink">
                <a href="/neatest/scripts/php/shop/bagview.php"class="blue-link">bag</a>
            </div>
            <h1> Order Confirmation</h1>
            <div class = "checkedoutcontainer">
                <div class="bag-card-2">
                    <?php
                    // Check the name of the person shopping is stored
                    if (isset( $_SESSION['name'])) {
                        // If the name of the person shopping is stored in the database embed their name into the subject of the form
                        echo "<p1> Dear " .  $_SESSION['name'] . "</p1>";
                    } else {
                        echo "Cookie 'name' is not set!";
                    }
                    ?>
                    <br></br>
                    <?php
                        if (isset($_COOKIE['button_press_time'])) {
                            // if the date of the persons order being processed is stored embed their name into the subject of the form
                            echo "<p2> Your order has been succesfully submitted on <strong>" . $_COOKIE['last_visit_date'] .  "</strong> at <strong>" . $_COOKIE['button_press_time'] . "</strong></p1>";
                        } else {
                            echo "Cookie 'name' is not set!";
                        }
                    ?>
                    <p2> Once we have processed your order,
                    <br><p2>you will receive your shipping confirmation</p2></br>
                    <br><div class="line"></div>
                    <br>
                    <p3> Your Order: </p3>
                    <br>
                    <div id="orderedprods">
                    <table class="small-table-bordered">
                        <tr class="smallthead">
                            
                        </tr>
                        <tbody>
                            <?php
                                // we need to decode what is in the checkedout_bag so it can be read_
                                $current_bag = json_decode($_COOKIE['checkedout_bag'], true);
                                // we need to create an array of the product ids that have been added to the bag
                                $current_bag_keys = array_keys($current_bag);
                                // If the array is empty we need to set -1 in order to avoid syntax issues
                                if(empty($current_bag_keys)) {
                                    $current_bag_keys[] = -1;
                                }
                                // This sql statement will get us more information of a product from by using a where clause and we use thePHP implode() function to convert the $current_bag_keys array into a comma-separated string
                                $sql = "SELECT * FROM product_stock WHERE product_id in (" . implode(',', $current_bag_keys) . ")";
                                if ($conn) {
                                    // Before we run the code we need to set grand total otherwise the code won't work
                                    $grand_total = 0;
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<tr class='smalltable'>";
                                            echo "<td><img src='" . $row['image'] . "' width='100' height='100'></td>";
                                            echo "<td>" . $row['title'] . "</td> <td>" . $row['description'] . "</td> <td>" . $row['size'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            // Get the quantity from the cookie instead of the database, this corresponds to the productid we are looking
                                            echo "<td>" . $current_bag[$row['product_id']] . "</td>";
                                            echo "</tr>";
                                            // calculate subtotal and grand total
                                            $sub_total = $row['price'] * $current_bag[$row['product_id']];
                                            $grand_total += $sub_total;
                                        }
                                    }
                            }
                            ?>
                        </tbody>
                    </div>
                    <div class="tax-box">
                        <div class="costbox">
                            <a2>Bag Total: £<?php echo $grand_total ?></a2>
                        </div>
                        <div class="costbox">
                            <a2>Shipping tax: £5</a2>
                        </div>
                        <div class="costbox">
                            <a2>Other taxes: £0</a2>
                        </div>
                        <div class="costbox">
                            <a2>Order Total: £<?php echo $grand_total + 5 ?></a2>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- These are the scripts we are using -->
    <script src="/neatest/scripts/js/checkout.js"></script>
    <script src="/neatest/scripts/js/sidebar.js"></script>
</body>