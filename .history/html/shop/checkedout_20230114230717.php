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
                    <p1> Dear </p1>
                    <br></br>
                    <p2> Your order has been succesfully submitted on  at  . Once we have processed your order,
                    <br><p2>you will receive your shipping confirmation</p2></br>
                    <br><div class="line"></div>
                    <br>
                    <p3> Your Order </p3>
                    <br>
                    <div id="orderedprods">
                        <tbody>

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