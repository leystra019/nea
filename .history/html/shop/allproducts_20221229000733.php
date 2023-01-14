<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase item</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <link rel="stylesheet" href="/neatest/css/shopallitems.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="/neatest/html/home.html">=</a></li>
            </ul>
        </nav>
        <div class="bg">
            <div class="brandname">
                <a style="margin-top: 61px !important; margin: left 157px;">SneakersnSteals</a>
            </div>
            <div class="loginlink">
                <a href="/neatest/html/ulogin.html"class="blue-link">login</a>
            </div>
            <div class="ordslink">
                <a href="/neatest/html/slogin.html"class="blue-link">orders</a>
            </div>
            <div class="baglink">
                <a href="/neatest/html/bag.html"class="blue-link">bag</a>
            </div>
            <div class="scroller" id="pcontainer">
                <form action="productlist.php" method="post">
                    <article>
                        <div class="inner-article">
                            <a href="product.php?id=1<?php echo $product['product_id']; ?>">
                            <img src="uploaded_img/" width="149px" height="149px" <?php echo $fetch_product['image']; ?> alt = "item">
                            </a>
                        </div>

                    </article>
                </form>


            </div>

            </div>
        </div>
    </div>
</body>