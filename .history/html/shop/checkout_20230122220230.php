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

    //create a cookie that records the time the user clicks the button
    $current_time = time();
    setcookie("button_press_time", $current_time, time() + (30 * 24 * 60 * 60));

    //use sql to update the user with id = ?
    $sql = "UPDATE users SET name='$name', username='$email', phone='$phone', country='$residence', address_line_1='$billingad', address_line_2='$shippingad', city='$city', postcode='$postcode' WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
      header('location: /neatest/html/shop/checkedout.php');
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
                  <!-- Here I am using php to gather the user info that is already stored on my database with the table users -->
                  <?php
                    $query = "SELECT name, username, phone, address_line_1, address_line_2, city, postcode FROM users WHERE id = ?";

                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        $name = $row['name'];
                        $email = $row['username'];
                        $phone = $row['phone'];
                        $billingad = $row['address_line_1'];
                        $shippingad = $row['address_line_2'];
                        $city = $row['city'];
                        $postcode = $row['postcode'];
                      }
                    }

                  ?>

                      <input type="name" class="short-form" placeholder="Name" name="name" required title="This field is required" value="<?php if(isset($name) && !empty($name)){echo $name;} ?>">
                      <input type="email" class="short-form" placeholder="Email" required title="This field is required" name="email" value="<?php if(isset($email) && !empty($email)){echo $email;} ?>">
                      <input type="text" class="short-form" placeholder="Phone Number" required title="This field is required" name="phone" maxlength="14" value="<?php if(isset($phone) && !empty($phone)){echo $phone;} ?>">
                      <input type="text" class="short-form" placeholder="Residence" required title="This field is required" name="residence" value="<?php if(isset($residence) && !empty($residence)){echo $residence;} ?>">
                      <input type="text" class="long-form" placeholder="Billing Adress" required title="This field is required" name="billingad" value="<?php if(isset($) && !empty($billingad)){echo $biillingad;} ?>">
                      <input type="text" class="long-form" placeholder="Shipping Adress" required title="This field is required" name="shippingad" value="<?php if(isset($) && !empty($billingad)){echo $shippingad;} ?>">
                      <input type="text" class="short-form" placeholder="City" required title="This field is required" name="city" maxlength="14" value="<?php if(isset($city) && !empty($city)){echo $city;} ?>">
                      <input type="text" class="short-form" placeholder="Postcode" required title="This field is required" name="city"  value="<?php if(isset($postcode) && !empty($postcode)){echo $postcode;} ?>">


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
            
</body> 