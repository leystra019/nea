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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="/neatest/scripts/css/main.css">
    <link rel="stylesheet" href="/neatest/scripts/css/staff/order.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" style="font-size: 31px; color: #FFFFFF;"></i>
            <ul class="sidebar-list" id="sidebar-list">
                <li><a href="/neatest/scripts/php/staffhome.php">home</a></li>
                <li><a href="#">email server</a></li>
                <li><a href="/neatest/html/order.html">order</a></li>
                <li><a href="#">management</a></li>
            </ul>
        </nav>
        <div class="bg">
            <main>
                <div class="card">
                    <div style="z-index: 1;" class="taskbarcontainer">
                        <h1>Tasks</h1>
                        <input type="text" id ="tasksrch" onkeyup="myFunction()" placeholder="Search for task(s)...">
                        <div class="dateadd">
                            <h2>Date added</h2>
                        </div>
                        <div class="prodtype">
                            <h2>Product type</h2>
                        </div>
                        <div class="reordlvl">
                            <h2>Reorder level</h2>
                        </div>
                        <div class="cost">
                            <h2>Cost</h2>
                        </div>
                        <div class="status">
                            <h2>Status</h2>
                        </div>
                    </div>
                    <div class="right-sideb">
                        <a href="#" id="cbutton" class="button">Click Me</a>
                    </div>
                    <div class="orders_table" >
                        <table id="orders_table" width="95%">
                            <thead style="justify-items: centre">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Email</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>price</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                // Retrieve the product data from the database
                                // We are using multiple left joins to get all the data that we need
                                $query = "
                                SELECT orders.order_id, users.username, orders.product_id, orders.quantity, orders.price, orders.status 
                                FROM orders 
                                LEFT JOIN customer_order ON orders.order_id = customer_order.order_id 
                                LEFT JOIN users ON customer_order.user_id = users.id
                                LEFT JOIN product_stock ON orders.product_id = product_stock.product_id 
                                ";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='orders_table'>";

                                        echo "<td>" . $row['order_id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['product_id'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo  "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td> <button class='button' id='edit_order_button' data-order-id='" . $row['order_id'] . "' data-product-id='" . $row['product_id'] . "' data-quantity='" . $row['quantity'] . "' data-price='" . $row['price'] . "' data-status='" . $row['status'] . "'>Edit</button> <button class='button'  id='change_order_status'>Update status</button>  <button class='button'  id='delete_order_button'>Delete</button></td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                            </tbody>
                            <div class="product-modal">
                                <div class="modal-content">

                                    <form action="/neatest/scripts/php/staff/buttons/editorder.php" method="post">
                                        <input type="text" placeholder="order_id(s)" name="order_id" readonly>
                                        <input type="text" placeholder="email" name="username" readonly>
                                        <input type="text" placeholder="product_id" name="product_id">
                                        <input type="text" placeholder="quantity" name="quantity">
                                        <input type="text" placeholder="price" name="price">
                                        <input type="text" placeholder="status" name="status">
                                        <input type="submit"  placeholder="confirm changes">
                                        <button class='button' id='change_user_details'>Change to User details</button>
                                    </form>
                                    <div class="close">+</div>

                                </div>
                                <div class="customer-modal" hidden>
                                    <form action="/neatest/scripts/php/staff/changeorder.php" method="post">
                                        <input type="text" placeholder="order_id" name="order_id">
                                        <input type="text" placeholder="username" name="email">
                                        <input type="text" placeholder="address_line_1" name="product_id">
                                        <input type="text" placeholder="address_line_2" name="quantity">
                                        <input type="text" placeholder="postcode" name="postcode">
                                        <input type="submit"  placeholder="confirm changes">
                                    </form>
                                    <div class="close">+</div>
                                </div>
                            </div>
                    </table>

                </div>
            </div>
            <script src="/neatest/scripts/js/order.js"></script>
        
                

    
</body>
</html>