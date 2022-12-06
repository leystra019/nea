<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="/neatest/css/main.css">
    <link rel="stylesheet" href="/neatest/css/order.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
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
                        <table style="border-collapse: collapse"  width= "80%">
                            <form action = "/neatest/php/testing.php" method="post">
                                <thead style="justify-items: centre">
                                    <tr>
                                        <th>Id</th>
                                        <th>Order ID</th>
                                        <th>Product ID</th>
                                        <th>Quantity</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody style="width: 80%;">
                                    <tr>
                                    <?php
                                        ini_set('display_errors', 1);
                                
                                        
                                
                                        ini_set('display_startup_errors', 1);
                                
                                        
                                
                                        error_reporting(E_ALL);
                                        session_start();
                                        $DATABASE_HOST = 'localhost';
                                        $DATABASE_USER = 'root';
                                        $DATABASE_PASS = '';
                                        $DATABASE_NAME = 'phpordersupdate';
                                
                                        $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                        if($conn->connect_error){
                                            die('Connection failed : ' .$conn->connect_error);
                                        } 
                                        else{
                                            $sql = "select * from orders";
                                            $result = $conn->query($sql);
                                        
                                            while($row = mysqli_fetch_array($result)) {
                                                echo "<tr>
                                                    <td>" . $row["order_id"] . "</td>
                                                    <td>" . $row["product_id"] . "</td>
                                                    <td>" . $row["quantity"] . "</td>
                                                    <td>" . $row["customer_id"] . "</td>
                                                    <td>" . $row["status"] . "</td>
                                                    <td>
                                                        <a class='button' href='/neatest/php/duplicate.php'>update</a>
                                                        <a class='button'  href='/neatest/php/duplicate.php'>Duplicate</a>
                                                        <a class='button'  href='/neatest/php/php buttons/delete.php'>delete</a>
                                                    </td>
                                                </tr>";
                                            }
                                        }
                                    
                                
                                    ?>
                                </tbody>

                            </form>
                        
                        <div class="bg-modal">
                            <div class="modal-content">
                                <form action="/neatest/php/main php/changeorder.php" method="post">
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
            <script src="/neatest/js/order.js"></script>
        
                

    
</body>
</html>