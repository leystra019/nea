<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="/neatest/css/main.css">
    <link rel="stylesheet" href="/neatest/css/order.css">
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
                <li><a href="/neatest/html/home.html">home</a></li>
                <li><a href="#">email server</a></li>
                <li><a href="/neatest/html/order.html">order</a></li>
                <li><a href="#">management</a></li>
            </ul>
        </nav>
        <main>
            <div class="bg">
                <a href="#" id="button" class="button">Click Me</a>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order ID</th>
                                <th>Product ID</th>
                                <th>Quantity</th>
                                <th>Order Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                ini_set('display_errors', 1);



                                ini_set('display_startup_errors', 1);
                                
                                    
                                
                                error_reporting(E_ALL);
                                session_start();
                                $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                if($con->connect_error){
                                    die('Connection failed : ' .$conn->connect_error);
                                }else{
                                    $sql = " SELECT * FROM orderline";
                                    $result = $conn->query($sql);
                                
                                    if(!$result -> num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>" . $row["id"] . "</td>
                                            <td>" . $row["order_id"] . "</td>
                                            <td>" . $row["product_id"] . "</td>
                                            <td>" . $row["Quantity"] . "</td>
                                            <td>" . $row["Price"] . "</td>
                                            
                                            <td>
                                                <a class='button' href='duplicate'>Duplicate</a>
                                                <a class='button' href='update'>Update</a>
                                                <a class='button' href='Delete'>Delete</a>
                                            </td>
                                        </tr>";
                                    }

                            
                            ?>

                        </tbody>
                    </table>                 
                    
                    <div class="bg-modal">
                        <div class="modal-content">
                            <form action="/neatest/php/changeorder.php" method="post">
                                <input type="text" placeholder="order_id" name="id">
                                <input type="text" placeholder="order_id(s)" name="order_id">
                                <input type="text" placeholder="product_id" name="product_id">
                                <input type="text" placeholder="quantity" name="quantity">
                                <input type="text" placeholder="price" name="price">
                                <input type="submit"  placeholder="confirm changes">
                            </form>
                            <div class="close">+</div>

                        </div>

                </div>
            </div>
            <script src="/neatest/js/order.js"></script>
                

    
</body>
</html>