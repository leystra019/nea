<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <a href="/neatest/scripts/php/staff/staffhome.php"><i class="fa-solid fa-home" style="margin-top: 32px; margin-left: 16px; font-size: 31px; color: #FFFFFF;"></i></a>
        </nav>
        <div class="bg">
            <main>
                <div class="card">
                    <div style="z-index: 1;" class="taskbarcontainer">
                        <h1>Orders</h1>
                        <!-- we need to create a function that searches for orders -->
                        <input type="text" id ="tasksrch" onkeyup="searchorderFunction()" placeholder="Search for order(s)...">
                    </div>
                    <div class="orders_table" >
                        <table id="orders_table" width="95%">
                            <thead style="justify-items: centre">
                                <tr class="tablehead_box">
                                    <th>Order ID</th>
                                    <th>Email</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>price</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <div id="no-order-matches-message" style="display: none; margin-left: 20px; margin-top: 10px; color: red;">Sorry. No Order matches what you have searched for.</div>
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
                                // If the connection and query has been succesful we want to publish the data to our table
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
                           <!-- This is the modal that appears when the staff member wants to mange a customers order -->
                            <div class="product-modal">
                                <div class="modal-content">
                                    <!-- We are calling another script when the form is submitted in order for the customer's order to update -->
                                    <form action="/neatest/scripts/php/staff/buttons/editorder.php" method="post">
                                        <div class="order-input-container">
                                            <label for="order_id">Order ID:</label>
                                            <input type="text" placeholder="order_id(s)" name="order_id" readonly class="order-input-fields" id="order_id">
                                        </div>

                                        <div class="order-input-container">
                                            <label for="username">Email:</label>
                                            <input type="text" placeholder="email" name="username" readonly class="order-input-fields" id="username">
                                        </div>

                                        <div class="order-input-container">
                                            <label for="product_id">Product ID:</label>
                                            <input type="text" placeholder="product_id" name="product_id" class="order-input-fields" id="product_id">
                                        </div>

                                        <div class="order-input-container">
                                            <label for="quantity">Quantity:</label>
                                            <input type="text" placeholder="quantity" name="quantity" class="order-input-fields" id="quantity">
                                        </div>

                                        <div class="order-input-container">
                                            <label for="price">Price:</label>
                                            <input type="text" placeholder="price" name="price" class="order-input-fields" id="price">
                                        </div>

                                        <div class="order-input-container">
                                            <label for="status">Status:</label>
                                            <input type="text" placeholder="status" name="status" class="order-input-fields" id="status">
                                        </div>

                                        <input type="submit" value="Confirm Changes" class="order-submit-button">

                                    </form>
                                    <!-- a close button needs to appear if the staff member has misclicked and does not want to update a specific order-->
                                    <div class="close">+</div>

                                </div>
                            </div>
                    </table>

                </div>
            </div>
            <script src="/neatest/scripts/js/order.js"></script>
        
                

    
</body>
</html>