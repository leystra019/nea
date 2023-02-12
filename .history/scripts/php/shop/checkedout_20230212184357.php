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
                    <a href="/neatest/scripts/php/shop/allproducts.php" class="item-link">Footwear</a>
                </li>
            </ul>
        </nav>
        <div class="bg">
            <div class="loginlink">
                <a href="/neatest/scripts/php/login/ulogin.php" onclick="remove_cookie()" class="blue-link">logout</a>
            </div>
            <div class="baglink">
                <a href="/neatest/scripts/php/shop/bag.php"class="blue-link">bag</a>
            </div>
            <h1> Order Confirmation</h1>
            <div class = "checkedoutcontainer">
                <div class="bag-card-2">
                    <?php
                    // check the name of the person shopping is stored
                    if (isset( $_SESSION['name'])) {
                        // if the name of the person shopping is stored embed their name into the subject of the form
                        echo "<p1> Dear " .  $_SESSION['name'] . "</p1>";
                    } else {
                        echo "Cookie 'name' is not set!";
                    }
                    ?>
                    <br></br>
                    <?php
                        // Define your query to retrieve the order number
                        $sql = "SELECT order_id FROM orders WHERE user_id = ?";
                        $order_number = $row["order_id"];
                        if (isset($_COOKIE['button_press_time'])) {
                            // if the name of the person shopping is stored embed their name into the subject of the form
                            echo "<p2>Your order " . $order_number . " has been successfully submitted on <strong>" . $_COOKIE['last_visit_date'] . "</strong> at <strong>" . $_COOKIE['button_press_time'] . "</strong></p1>";
                        } else {
                            echo "order 'id' has not been set!";
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
                            <!-- <th>Image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th> -->
                        </tr>
                        <tbody>
                            <?php
                                $current_bag = json_decode($_COOKIE['checkedout_bag'], true);
                                $current_bag_keys = array_keys($current_bag);
                                if(empty($current_bag_keys)) {
                                    $current_bag_keys[] = -1;
                                }
                                $sql = "SELECT * FROM product_stock WHERE product_id in (" . implode(',', $current_bag_keys) . ")";
                                if ($conn) {
                                    $grand_total = 0;
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<tr class='smalltable'>";
                                            echo "<td>" . $row['image'] . "</td>";
                                            echo "<td>" . $row['title'] . "</td> <td>" . $row['description'] . "</td> <td>" . $row['size'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            // Get the quantity from the cookie instead of the database, this corresponds to the productid we are looking
                                            echo "<td>" . $current_bag[$row['product_id']] . "</td>";
                                            echo "</tr>";
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
    <script src="/neatest/scripts/js/checkout.js"></script>
    <script src="/neatest/js/sidebar.js"></script>
</body>