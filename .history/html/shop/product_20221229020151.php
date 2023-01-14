<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase item</title>
    <link rel="stylesheet" href="/neatest/css/shop.css">
    <script src="/neatest/js/purchaseitem.js"></script>
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
            <div class="divide">
                <div class="product">

                </div>
                <div class="extrap">

                </div>
                <div class="pdescription">
                    <h4 id="product-name"><?php echo $title; ?></h4>
                    <h5><?php echo $brand; ?></h5>
                    <p id="product-description"><?php echo $description; ?></p>
                    <div class="size">
                        size: <?php echo $size; ?>
                    </div>
                    <div class="material">
                        material: <?php echo $material; ?>
                    </div>
                <div id="product-price"><?php echo $price; ?>
                
            </div>

                    <br>
                    <form action="" method="post">

                        <input type="submit" value="Add to bag" class="bagbtn" id="button">
                        <button class="backbtn" id="button">Head Back</button>
                    </form>
                </div>
            </div>

            

        </div>
    </div>
    
    
</body>
</html>