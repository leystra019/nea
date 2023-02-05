<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo $_COOKIE['bag'];
    



    // Connect to the database and retrieve the product data
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    if (!isset($_COOKIE['cookie_auth'])) {
        header('location: /neatest/html/ulogin.php');
    }

    else{
        if(isset($_COOKIE['user_id'])) {
            $user_id = $_COOKIE['user_id'];

            $stmt = $conn->prepare('SELECT * FROM bag WHERE id = ?');
            $stmt->bind_param('i', $user_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result !== null) {
                    while ($row = $result->fetch_assoc()) {
                        // do something with the row
                    }
                }
            }
        } else {
            echo "not working";
        }


        // $sql = "select * from bag";
        if(isset($_GET['remove'])){
            // which item do we want to remove?
            $remove_item = $_GET['remove'];
            // give entire contents of bag
            $current_bag = json_decode($_COOKIE['bag'], true);
            // remove selected item from list
            unset($current_bag[$remove_item]);
            // update the cookie with the new list
            setcookie('bag',json_encode($current_bag), time() + 86400);
            mysqli_query($conn, "DELETE FROM `bag` WHERE product_id = '$remove_item'");
            header("Refresh:10");

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
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <link rel="stylesheet" href="/neatest/css/bagview.css">
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
                                $sql = "SELECT * FROM bag";
                                $grand_total = 0;
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr class='tableprod_box'>";
                                    echo "<td>" . $row['image'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" . $row['quantity'] . "</td>";
                                    echo "<td><a class='button' href='/neatest/php/php buttons/updatebag.php'>update</a><a class='button' href='/neatest/html/shop/bagview.php?remove=".$row['product_id']."' onclick='return confirm(\"remove item from bag?\")'>delete</a></td>";
                                    echo "</tr>";
                                    $sub_total = $row['price'] * $row['quantity'];
                                    $grand_total += $sub_total;
                                }
                            ?>
                        </tbody>
                    </table>
                            </div>

                <?php
                    if ($row) {

                        // Calculate the sub total
                        $sub_total = number_format($row['price'] * $row['quantity']);
                        
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
                        <a href="/neatest/html/shop/checkout.php">Checkout</a>
                    </div>
                    <div class="continueshop-btn">
                        <a href=" ">Continue Shop</a>
                        
                </div>
                </div>

            </div>

        </div>
    </div>
</body>
</html>