<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);



  error_reporting(E_ALL);
  session_start();
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = 'neatest';



  $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
  if($conn->connect_error){
      die('Connection failed : ' .$conn->connect_error);
  }
  if ($save_info) {
    // Get form data
    setcookie("phone", $phone, time() + (86400 * 30));
    setcookie("residence", $residence, time() + (86400 * 30));
    setcookie("billingad", $billingad, time() + (86400 * 30));
    setcookie("shippingad", $shippingad, time() + (86400 * 30));
    setcookie("city", $city, time() + (86400 * 30));
    setcookie("postcode", $postcode, time() + (86400 * 30));
  }
  if(isset($_POST)) {
    $user_id = 'user_id'; // Replace with actual user ID
    $sql = "INSERT INTO users where $user_id = '?' (phone, residence, billingad, shippingad, city, postcode)
            VALUES ('$residence')
            ON DUPLICATE KEY UPDATE firstname='$firstname', lastname='$lastname', email='$email', residence='$residence'";
    if (mysqli_query($conn, $sql)) {
      echo "Values inserted/updated successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    };
  }
?>