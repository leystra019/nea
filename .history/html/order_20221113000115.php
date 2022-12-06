<?php include '/neatest/php/testing.php' ?>
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
                        <a href="#" id="buttontest" action=""class="button">Test</a>
                        <a href="#" id="cbutton" class="button">Click Me</a>
                    </div>
                    <div class="table form">
                        <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Order ID</th>
                                        <th>Product ID</th>
                                        <th>Quantity</th>
                                        <th>Order Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <script>
                                        var ajax = new XMLHttpRequest();
                                        var method = "GET";
                                        var url = "neatest/php/testing.php";
                                        var asynchronous = true;

                                        ajax.open(method, url, asynchronous);
                                        ajax.send();

                                        ajax.onreadystatechange = Getdata()
                                    </script>

                                    <td>
                                        <a class='button' href='duplicate'>Duplicate</a>
                                        <a class='button' href='update'>Update</a>
                                        <a class='button' href='Delete'>Delete</a>
                                    </td>
                                </tbody>

                            </form>
                        
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
                    </table>

                </div>
            </div>
            <script src="/neatest/js/order.js"></script>
        
                

    
</body>
</html>