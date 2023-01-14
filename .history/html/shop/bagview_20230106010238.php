<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Connect to the database and retrieve the product data
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    else{
        $sql = "select * from bag";
        if(isset($_GET['remove'])){
            $remove_item = $_GET['remove'];
            mysqli_query($conn, "DELETE FROM `bag` WHERE product_id = '$remove_item'");
            header("Refresh:0");

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
                <a href="/neatest/html/ulogin.html"class="blue-link">login</a>
            </div>
            <div class="ordslink">
                <a href="/neatest/html/slogin.html"class="blue-link">orders</a>
            </div>
            <div class="baglink">
                <a href="/neatest/html/bag.html"class="blue-link">bag</a>
            </div>
            <h1>Shopping Cart</h1>
            

            <table class="table-bordered">
                <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>action</th>
                </tr>
                <?php
                    $total = 0;
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['image'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td><a class='button' href='/neatest/php/php buttons/updatebag.php'>update</a></td>";
                        echo "<td><a class='button' href='bagview.php?remove=<?php echo $row['product_id']; ?>' onclick='return confirm(\"remove item from cart?\")'>delete</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            <div class="checkout-btn">
                <button onclick="checkoutItem($product_id)">Checkout</button>
                <!-- This will create a button that, when clicked, will send an AJAX request to the checkout_script.php script with product_id set to 123. -->
            </div>
        </div>
    </div>
</body>
</html>