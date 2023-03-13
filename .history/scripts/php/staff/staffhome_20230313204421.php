<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
    }

    // // check it is a staff that has logged on
    // if ($_SESSION['session_auth'] == 0 || $_SESSION['session_auth'] == 2) {
    //     // if it is a regular user or the staff hasn't logged on we need to send the user to staff login
    //     header('location: /neatest/scripts/php/login/slogin.php');
    // }    

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <a href="/neatest/scripts/php/staff/staffhome.php"><i class="fa-solid fa-home" style="margin-top: 32px; margin-left: 16px; font-size: 31px; color: #FFFFFF;"></i></a>
            <a href="/neatest/scripts/php/staff/manageorder.php"><i class="fa-solid fa-receipt" style="margin-top: 42px; margin-left: 20px; font-size: 31px; color: #FFFFFF;"></i></a>
            <a href="/neatest/scripts/php/staff/manageinventory.php"><i class="fa-solid fa-box" style="margin-top: 42px; margin-left: 16px; font-size: 31px; color: #FFFFFF;"></i></a>
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
                        <span>Stock Held</span>
                        <div class="stockn_icon">
                        <i class="fa-solid fa-home" style="margin-top: 28px; margin-left: 24px; font-size: 31px; color: #FFFFFF;"></i>
                    </div>
                    <div class="Stock-sold">
                        <span>Stock sold</span>
                    </div>
                    <div class="Spent">
                        <span>Inventory cost</span>
                    </div>
                    <div class="Profit">
                        <span>Profit</span>
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
