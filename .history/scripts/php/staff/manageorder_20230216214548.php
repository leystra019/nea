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
        <nav class="navbar">
            <ul>
                <li><a href="#">search</a></li>
                <li><a href="#">notis</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
        </nav>
        <nav class="sidebar">
            <ul>
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
                    <div class="table" >
                        <table style= "border-collapse: collapse" border= "1" width="80%">
                            <form action = "/neatest/php/testing.php" method="post">
                                <thead style="justify-items: centre">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product ID</th>
                                        <th>Quantity</th>
                                        <th>status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody style="width: 80%;">

                                <?php
                                ini_set('display_errors', 1);
                                ini_set('display_startup_errors', 1);
                                error_reporting(E_ALL);
                                session_start();
                            
                                // Connect to the database and retrieve the product data
                                $conn = mysqli_connect('localhost', 'root', '', 'neatest');
                                if ($conn->connect_error) {
                                die('Connection failed: ' . $conn->connect_error);
                                }
                                else {
                                    // Retrieve the product data from the database
                                    $query = "SELECT * FROM orders where status = 1";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            $row = mysqli_fetch_assoc($result);
                                            echo "<tr>";
                                            echo "<td>" . $row['order_id'] . "</td>";
                                            echo "<td>" . $row['product_id'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                                ?>
                                </tbody>

                            </form>
                        
                            <div class="bg-modal">
                                <div class="modal-content">
                                    <form action="/neatest/scripts/php/staff/changeorder.php" method="post">
                                        <input type="text" placeholder="order_id(s)" name="order_id">
                                        <input type="text" placeholder="product_id" name="product_id">
                                        <input type="text" placeholder="quantity" name="quantity">
                                        <input type="text" placeholder="status" name="status">
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