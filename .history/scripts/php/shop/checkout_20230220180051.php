<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    // check user has logged in
    if ($_SESSION['session_auth'] = 0) {
        // if the user hasn't logged in already, send them back to the login page
        header('location: /neatest/scripts/php/login/ulogin.php');
    }

    $user_id = $_SESSION['user_id'];


    function remove_cookie() {
      $cookie_value = false;
    }
    
    // check if the data was sent via AJAX
    if(isset($_POST) && !empty($_POST)){
    // get the data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $residence = $_POST['residence'];
    $billingad = $_POST['billingad'];
    $shippingad = $_POST['shippingad'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];

    // Get the current time
    $current_time = time();
    // Create a cookie that records the time the user clicks the button
    $current_time = date("H:i:s", $current_time);
    setcookie("button_press_time", $current_time, time() + (30 * 24 * 60 * 60));

    $current_date = date("Y-m-d");
    setcookie("last_visit_date", $current_date, time() + (30 * 24 * 60 * 60));

    //use sql to update the user with id = ?
    $sql = "UPDATE users SET name=?, username=?, phone=?, country=?, address_line_1=?, address_line_2=?, city=?, postcode=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $email, $phone, $residence, $billingad, $shippingad, $city, $postcode, $user_id);

    if (mysqli_stmt_execute($stmt)) {
      $bag = json_decode($_COOKIE['bag'], true);
      $order_id = mt_rand();
      $status = 1;
      $product_ids = array_keys($bag);
      $total_quantity = array_sum($bag);
      $created_at = date("Y-m-d H:i:s");
    
      // insert each product in the order
      foreach ($product_ids as $product_id) {
        // Retrieve price of product using its ID
        $get_price_sql = "SELECT price FROM product_stock WHERE product_id = ?";
        $get_price_stmt = mysqli_prepare($conn, $get_price_sql);
        mysqli_stmt_bind_param($get_price_stmt, "i", $product_id);
        mysqli_stmt_execute($get_price_stmt);
        mysqli_stmt_bind_result($get_price_stmt, $price);
        mysqli_stmt_fetch($get_price_stmt);

        // we need to close the statement returned by the previous query before executing the update
        mysqli_stmt_close($get_price_stmt);

        $sql = "INSERT INTO orders (order_id, product_id, created_at, quantity, price, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $product_quantity = $bag[$product_id];
        mysqli_stmt_bind_param($stmt, "iiddi", $order_id, $product_id, $created_at, $product_quantity, $price, $status);
        mysqli_stmt_execute($stmt);

        // update the product stock quantity
        $sql = "UPDATE product_stock SET stock_level = stock_level - ? WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $product_quantity, $product_id);
        mysqli_stmt_execute($stmt);
      }
      // adding the order to the customer order table
      $sql = "INSERT INTO customer_order (order_id, user_id) VALUES (?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ii", $order_id, $user_id);
      mysqli_stmt_execute($stmt);




      setcookie("checkedout_bag", json_encode($bag), time() + 3600);
      // if the order was added successfully, clear the contents of the bag cookie
      setcookie("bag", "", time() - 3600);
      header('location: /neatest/scripts/php/shop/checkedout.php');
    } else {
      echo "<script>alert('Sorry. But you have been un-able to checkout this time');</script>";
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bag</title>
    <link rel="stylesheet" href="/neatest/scripts/css/shop/shop.css">
    <link rel="stylesheet" href="/neatest/scripts/css/shop/bagview.css">
    <link rel="stylesheet" href="/neatest/scripts/css/shop/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/neatest/scripts/js/checkout.js"></script>
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
        <a href="/neatest/scripts/php/login/ulogin.php" onclick="remove_cookie()" class="blue-link">logout</a>
      </div>
      <div class="baglink">
        <a href="/neatest/scripts/php/shop/bag.php"class="blue-link">bag</a>
      </div>
      <h1> Checkout</h1>
      <div class="bag-card">
          <div class = "checkoutcontainer">
              <div class ="left-head">
                  <a>Shipping Information</a>
              </div>
              <div class="left-content">
                <form action=" " id="checkout-form" method="post">
                  <!-- Here I am using php to gather the user info that is already stored on my database with the table users -->
                  <?php
                    $query = "SELECT id FROM users WHERE username = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    if (mysqli_stmt_execute($stmt)) {
                      $result = mysqli_stmt_get_result($stmt);
                      if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                          $user_id = $row['id'];
                        }
                      }
                    }
                    $query = "SELECT name, username, phone, address_line_1, address_line_2, city, postcode, country FROM users WHERE id = ?";

                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    if (mysqli_stmt_execute($stmt)) {
                      $result = mysqli_stmt_get_result($stmt);
                      if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                          $name = $row['name'];
                          $email = $row['username'];
                          $phone = $row['phone'];
                          $residence = $row['country'];
                          $billingad = $row['address_line_1'];
                          $shippingad = $row['address_line_2'];
                          $city = $row['city'];
                          $postcode = $row['postcode'];
                        }
                      }
                    }
                  ?>
                  <input type="name" class="short-form" placeholder="Name" name="name" required title="This field is required" value="<?php echo $name; ?>">
                  <input type="email" class="short-form" placeholder="Email" required title="This field is required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $email; ?>">
                  <input type="text" class="short-form" placeholder="Phone Number" required title="This field is required" name="phone" maxlength="11" value="<?php echo $phone; ?>">
                  <input type="text" class="short-form" placeholder="Residence" required title="This field is required" name="residence" value="<?php echo $residence; ?>">
                  <input type="text" class="long-form" placeholder="Billing Adress" required title="This field is required" name="billingad" value="<?php echo $billingad; ?>">
                  <input type="text" class="long-form" placeholder="Shipping Adress" required title="This field is required" name="shippingad" value="<?php echo $shippingad; ?>">
                  <input type="text" class="short-form" placeholder="City" required title="This field is required" name="city" value="<?php echo $city; ?>">
                  <input type="text" class="short-form" placeholder="Postcode {AA1 AA2}" required title="This field is required" name="postcode" maxlength="7" value="<?php echo $postcode; ?>">




                <div class="saveinfotxt">
                  <!-- Here I am creating a save button for when the user wants to update/save data to the database -->
                  <?php echo '<label for="saveinfo" onclick = "saveinfo()" class="saveinfotxt">Save info? </label><input type="checkbox" id="saveinfo">'; ?>
                </div>
                <div class="finalch_container">
                    <div class="checkout-btn">
                        <input type ="submit" id="checkout"></input>
                    </div>
                </form>
                    <div class="continueshop-btn">
                        <a href="/neatest/scripts/php/shop/bagview.php">View-bag</a>
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
  <script src="/neatest/scripts/js/sidebar.js"></script>                 
</body>
</html>