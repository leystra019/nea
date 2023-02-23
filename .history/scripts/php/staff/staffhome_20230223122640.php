<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
    }

    // check it is a staff that has logged on
    if ($_SESSION['session_auth'] == 0 || $_SESSION['session_auth'] == 2) {
        // if it is a regular user or the staff hasn't logged on we need to send the user to staff login
        header('location: /neatest/scripts/php/login/slogin.php');
    }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="/neatest/scripts/css/main.css">
    <link rel="stylesheet" href="/neatest/scripts/css/staff/homepage.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" style="font-size: 31px; color: #FFFFFF;"></i>
            <ul class="sidebar-list" id="sidebar-list">
                <li>
                    <a href="#">home</a>
                </li>
                <li>
                    <a href="#">email server</a>
                </li>
                <li>
                    <a href="/neatest/html/order.html">order</a>
                </li>
                <li>
                    <a href="#">management</a>
                </li>
            </ul>
        </nav>
        <main>
            <div class="bg">
                <div class="loginlink">
                <?php
                    //Here we are checking if a staff member is logged on and displaying a logout button
                    if (isset($_SESSION['session_auth']) && ($_SESSION['session_auth'] == 2 )) {
                        echo '<a href="/neatest/scripts/php/login/ulogin.php" class="blue-link">Logout</a>';
                    }
                ?>

                <div class="success_cards">
                    <div class="stockn">
                        <a href ="#">Stock Held</a>
                    </div>
                    <div class="Stock-sold">
                        <a href="#">Stock sold</a>
                    </div>
                    <div class="Spent">
                        <a href ="#">Inventory cost</a>
                    </div>
                    <div class="Profit">
                        <a href="#">Profit</a>
                    </div>
                </div>
                <div class="card_container">
                    <div class="graph_card">
                        <header>Sales portfolio</header>
                    </div>
                    <div class="extra_cards">
                        <div class="sale_breakdown">
                        <header>Sales Breakdown</header>
                        </div>
                        <div class="calendar">
                        <header>Calendar tasks</header>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/neatest/scripts/js/sidebar.js"></script>
</body>
