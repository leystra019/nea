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
    <script src="/neatest/js/checkout.js"></script>
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
            <h1> Order Confirmation</h1>
            <div class = "checkedoutcontainer">
                <div class="bag-card-2">
                    <?php
                    // check the name of the person shopping is stored
                    if (isset($_COOKIE['name'])) {
                        // if the name of the person shopping is stored embed their name into the subject of the form
                        echo "<p1> Dear " . $_COOKIE['name'] . "</p1>";
                    } else {
                        echo "Cookie 'name' is not set!";
                    }
                    ?>
                    <br></br>
                    <p2> Your order has been succesfully submitted. Once we have processed your order,
                    <br><p2>you will receive your shipping confirmation</p2></br>
                    <br><div class="line"></div>
                    <br>
                    <p3> Your Order:</p3>
                    <br>
                    <div id="orderedprods">
                    <table class="small-table-bordered">
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
                                    echo "<tr class='orderedprod_box'>";
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
                    </div>
                    <div class="tax-box">
                        <div class="costbox">
                            <a2>Bag Total: </a2>
                        </div>
                        <div class="costbox">
                            <a2>Shipping tax: </a2>
                        </div>
                        <div class="costbox">
                            <a2>Other taxes: </a2>
                        </div>
                        <div class="costbox">
                            <a2>Order Total: </a2>
                        </div>
                    </div>


                </div>
            </div>
            </div>