

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <i class="fa-sharp fa-solid fa-bars" id="btn" style="font-size: 31px; color: #FFFFFF;"></i>
                <ul class="sidebar-list" id="sidebar-list">
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">All</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">New Items</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">Hats</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">Outerwear</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">Sweatshirts</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">Shirts</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/bottomwear.php" class="item-link">Bottomwear</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">Socks</a>
                    </li>
                    <li>
                        <a href="/neatest/html/shop/allproducts.php" class="item-link">Footwear</a>
                    </li>
                </ul>
        </nav>
        <div class="bg">
            <div class="loginlink">
                <?php 
                    if (isset($_COOKIE['cookie_auth'])) { 
                        if ($_COOKIE['cookie_auth'] == 1){
                            echo '<a href="/neatest/html/ulogin.php" class="blue-link">Login</a>';
                        } else {
                            echo '<a href="/neatest/html/shop/landingpage.php" class="blue-link">Logout</a>';
                        }
                    }
                    else {
                        setcookie ()
                        echo '<a href="/neatest/html/ulogin.php" class="blue-link">Login</a>';
                    }
                ?>
            </div>
            <div class="baglink">
                <a href="/neatest/html/shop/bagview.php"class="blue-link">bag</a>
            </div>
            <h1></h1>
            <div class="container2">
                <div class="top-box">
                    <h7>Latest items</h7>
                </div>
                <div class="itemboxes">
                    <div class="topsbox">
                        <h7>Tops</h7>
                    </div>
                    <div class="trousersbox">
                        <h7>Bottomwear</h7>
                    </div>
                    <div class="otheritemsbox">
                        <h7>Other</h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/neatest/js/sidebar.js"></script>
</body>