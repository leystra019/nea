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
        if(isset($_COOKIE['bag'])) {
            //get the contents of the bag
            $current_bag = json_decode($_COOKIE['bag'], true);
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

            // check prepared statement has been executed
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                // check if result is empty
                if ($result->num_rows == 0) {
                    // if the result is empty, echo shopping cart is empty
                    echo "Your shopping cart is empty.";
                } else {
                    while ($row = $result->fetch_assoc()) {
                    }
                }
            }
        }
            


        // remove item from bag if remove pressed
        if(isset($_GET['remove'])){
            // which item do we want to remove?
            $remove_item = $_GET['remove'];
            // give entire contents of bag
            $current_bag = json_decode($_COOKIE['bag'], true);
            // if down to last item, remove it completely
            if ($current_bag[$remove_item] <= 1) {
                // remove selected item from list
                unset($current_bag[$remove_item]);
            } else {
                //reduce quantity by 1
                $current_bag[$remove_item] -= 1;
            }
            // update the cookie with the new list
            setcookie('bag',json_encode($current_bag), time() + 86400);
            // refresh the cart page to show the new table of data
            header("Refresh:3");

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
                    <a href="/neatest/html/shop/allproducts.php" class="item-link">Footwear</a>
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
            <h1>Shopping Cart</h1>
            <div class="bag-card">
                <div id="scroller">
                    <table class="table-bordered">
                        <tr class="tablehead_box">
                            <th>Product image</th>
                            <th>Product name</th>
                            <th>Product price</th>
                            <th>Product quantity</th>
                            <th>Product action</th>
                        </tr>
                        <tbody>
                            <?php
                                $current_bag = json_decode($_COOKIE['bag'], true);
                                $current_bag_keys = array_keys($current_bag);
                                if(empty($current_bag_keys)) {
                                    $current_bag_keys[] = -1;
                                }
                                $sql = "SELECT * FROM product_stock WHERE product_id in (" . implode(',', $current_bag_keys) . ")";
                                $grand_total = 0;
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr class='tableprod_box'>";
                                    echo "<td>" . $row['image'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    // Get the quantity from the cookie instead of the database, this corresponds to the productid we are looking
                                    echo "<td>" . $current_bag[$row['product_id']] . "</td>";
                                    echo "<td><a class='button' href='/neatest/scripts/php/shop/buttons/updatebag.php'>update</a><a class='button' href='/neatest/scripts/php/shop/bagview.php?remove=".$row['product_id']."' onclick='return confirm(\"remove item from bag?\")'>delete</a></td>";
                                    echo "</tr>";
                                    $sub_total = $row['price'] * $current_bag[$row['product_id']];
                                    $grand_total += $sub_total;
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>

                    <?php
                        if ($row) {

                            // Calculate the sub total
                            $sub_total = number_format($row['price'] * $current_bag[$row['product_id']]);
                            
                            // Output the sub total
                            echo "<td>" . $sub_total . "/-</td>";
                            
                            // Update the grand total
                            $grand_total += $sub_total;
                        } else {

                        }
                    ?>

                <div class="grandtotal_container">
                    grand total: £
                    <?php echo $grand_total; ?>
                </div>
                <div class="final_container">
                    <div class="checkout-btn">
                        <a href="/neatest/scripts/php/shop/checkout.php">Checkout</a>
                    </div>
                    <div class="continueshop-btn">
                        <a href="/neatest/scripts/php/shop/allproducts.php">Continue Shop</a>
                        
                </div>
                </div>

            </div>

        </div>
    </div>
    <script src="/neatest/scripts/js/sidebar.js"></script>
</body>
</html>