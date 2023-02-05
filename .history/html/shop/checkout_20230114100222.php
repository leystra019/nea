<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  if (!isset($_COOKIE['cookie_auth'])) {
      header('location: /neatest/html/ulogin.php');
  }
  $conn = mysqli_connect('localhost', 'root', '', 'neatest');
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }
  // check if the data was sent via AJAX
  if(isset($_POST) && !empty($_POST)){
    // get the data
    $user_id = $_COOKIE['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $residence = $_POST['residence'];
    $billingad = $_POST['billingad'];
    $shippingad = $_POST['shippingad'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
      
    // set the cookies with the data
    setcookie("name", $name, time() + (86400 * 30));
    setcookie("email", $email, time() + (86400 * 30));
    setcookie("phone", $phone, time() + (86400 * 30));
    setcookie("residence", $residence, time() + (86400 * 30));
    setcookie("billingad", $billingad, time() + (86400 * 30));
    setcookie("shippingad", $shippingad, time() + (86400 * 30));
    setcookie("city", $city, time() + (86400 * 30));
    setcookie("postcode", $postcode, time() + (86400 * 30));

    //use sql to update the user with id = ?
    $sql = "UPDATE users SET name='$name', username='$email', phone='$phone', country='$residence', billingad='$billingad', shippingad='$shippingad', city='$city', postcode='$postcode' WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Values inserted/updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }}
?>
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
            <h1> Checkout</h1>
            <div class="bag-card">
                <div class = "checkoutcontainer">
                    <div class ="left-head">
                        <a>Shipping Information</a>
                    </div>
                    <div class="left-content">
                      <form action=" " id="checkout-form" method="post">
                        <?php
                          if (isset($_COOKIE['name'])) {
                            echo '<input type="name" class="short-form" placeholder="Name" name="name" required title="This field is required" value="' . htmlspecialchars($_COOKIE['name']) . '">';
                          } else {
                            echo '<input type="name" class="short-form" required title="This field is required" placeholder="Name" name="name">';
                          }
                          if (isset($_COOKIE['email'])) {
                            echo '<input type="email" class="short-form" placeholder="Email" required title="This field is required" name="email" value="' . htmlspecialchars($_COOKIE['email']) . '">';
                          } else {
                            echo '<input type="email" class="short-form" placeholder="Email" required title="This field is required" name="email">';
                          }
                          if (isset($_COOKIE['phone'])) {
                            echo '<input type="text" class="short-form" placeholder="Phone Number" required title="This field is required" name="phone" maxlength="14" value="' . htmlspecialchars($_COOKIE['phone']) . '">';
                          } else {
                            echo '<input type="text" class="short-form" placeholder="Phone Number" required title="This field is required" maxlength="14" name="phone">';
                          }
                          if (isset($_COOKIE['residence'])) {
                            echo  '<input type="text" class="short-form" placeholder="Residence" required title="This field is required" name="residence" value="' . htmlspecialchars($_COOKIE['residence']) . '">';
                          } else {
                            echo '<input type="text" class="short-form" placeholder="Residence" required title="This field is required" name="residence">';
                          }
                          if (isset($_COOKIE['billingad'])) {
                            echo '<input type="text" class="long-form" placeholder="Billing Adress" required title="This field is required" name="billingad" value="' . htmlspecialchars($_COOKIE['billingad']) . '">';
                          } else {
                            echo '<input type="text" class="long-form" placeholder="Billing Adress" required title="This field is required" name="billingad">';
                          }
                          if (isset($_COOKIE['shippingad'])) {
                            echo ' <input type="text" class="long-form" placeholder="Shipping Adress" name="shippingad" required title="This field is required" value="' . htmlspecialchars($_COOKIE['shippingad']) . '">';
                          } else {
                            echo ' <input type="text" class="long-form" placeholder="Shipping Adress" required title="This field is required" name="shippingad">';
                          }
                          if (isset($_COOKIE['city'])) {
                            echo '<input type="text" class="short-form" placeholder="City" name="city"  required title="This field is required" value="' . htmlspecialchars($_COOKIE['shippingad']) . '">';
                          } else {
                            echo '<input type="text" class="short-form" placeholder="City" name="city">';
                          }
                          if (isset($_COOKIE['postcode'])) {
                            echo '<input type="text" class="short-form" placeholder="Postcode" name="postcode" max length = "6" required title="This field is required" value="' . htmlspecialchars($_COOKIE['postcode']) . '">';
                          } else {
                            echo '<input type="text" class="short-form" placeholder="postcode" maxlength = "6" required title="This field is required" name="postcode">';
                          }
                          // if (isset($_COOKIE['save_info'])) {
                          //   echo 'Info saved';
                          //   echo '<input type="Checkbox" value="1" checked="checked">';
                          // } else {
                          //   echo '<label for="saveinfo" class="saveinfotxt">Save info? </label><input type="checkbox" id="saveinfo">';
                          // }
                        ?>

                        <div class="saveinfotxt">
                          <?php echo '<label for="saveinfo" onclick = "saveinfo()" class="saveinfotxt">Save info? </label><input type="checkbox" id="saveinfo">'; ?>
                        </div>
                        <div class="finalch_container">
                            <div class="checkout-btn">
                                <input type ="submit" id="checkout"></input>
                            </div>
                        </form>
                            <div class="continueshop-btn">
                                <a href=" ">Continue Shop</a>
                            </div>
                        </div>    
                    </div>
                    <div class ="right-head">
                        <a>Payment Information</a>
                    </div>
                    <div class="right-content">
                      <div class="flex-selectedpayment">
                        <input type="checkbox" id="paymentnotreq" name="paymentnotrequired" value="1" checked>
                        <a> Payment not required<a>
                      </div>
                    </div>

        
                </div>



        </div>
    </div>
</body>  