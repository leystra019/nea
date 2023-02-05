<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  if (!isset($_COOKIE['cookie_auth'])) {
      header('location: /neatest/html/ulogin.php');
      $user_id = $_COOKIE['user_id'];
  }
  $conn = mysqli_connect('localhost', 'root', '', 'neatest');
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  function remove_cookie() {
    $cookie_value = false;
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

    //create a cookie that records the time the user clicks the button
    $current_time = time();
    setcookie("button_press_time", $current_time, time() + (30 * 24 * 60 * 60));

    //use sql to update the user with id = ?
    $sql = "UPDATE users SET name='$name', username='$email', phone='$phone', country='$residence', address_line_1='$billingad', address_line_2='$shippingad', city='$city', postcode='$postcode' WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
      header('location: /neatest/html/shop/checkedout.php');
    } else {
      echo "<script>alert('Sorry. But you have been un-able to checkout this time');</script>";
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
                  $query = "SELECT name, username, phone, address_line_1, address_line_2, city, postcode, country FROM users WHERE id = ?";

                  $stmt = mysqli_prepare($conn, $query);
                  mysqli_stmt_bind_param($stmt, "i", $user_id);
                  if (mysqli_stmt_execute($stmt)) {
                    echo '1';
                      $result = mysqli_stmt_get_result($stmt);
                      if(mysqli_num_rows($result) > 0){
                        echo '2';
                          while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <input type="text" id="name" value="<?php echo $row['name']; ?>">
                          <?php 
                          }
                        }
                      }
                ?>

                </form>
                    <div class="continueshop-btn">
                        <a href="">View-bag</a>
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
      </div> 
    </div>                
  </div>                     
</body>
</html>