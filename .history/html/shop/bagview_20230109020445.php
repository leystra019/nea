<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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
            $remove_item = $_GET['remove'];
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
                <div class="scroller" id="bagcontainer">
                <table class="table-bordered">
                    <tr class="tablehead_box">
                        <th>Product image</th>
                        <th>Product name</th>
                        <th>Product price</th>
                        <th>Product quantity</th>
                        <th>Product action</th>
                    </tr>
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
                            echo "</div></td>";
                            echo "</tr>";
                            $sub_total = $row['price'] * $row['quantity'];
                            $grand_total += $sub_total;
                        }
                    ?>
                    <tr>
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
                            <!-- <a href="/neatest/php/php buttons/deletefrombag.php" class = "deleteall_btn" onclick='return confirm(\"Are you sure you want to delete all items from bag?")</a>Delete All</td>
                    </tr> -->
                </table>
                <div class="grandtotal_container">
                    grand total: £
                    <?php echo $grand_total; ?>
                </div>
                <div class="final_container">
                <div class="checkout-btn">
                    <button type="button" id="button" href = ' '>Continue Shopping</button>
                </div>
                <div class="continueshop-btn">
                    <button type="button" class="backbtn" id="button" onclick="history.back()">Continue Shopping</button>
                </div>
                </div>

            </div>

        </div>
    </div>
</body>
</html>