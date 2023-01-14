<?php
// Display errors
ini_set('display_errors', 1);

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'neatest');
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Check if the database connection is set
if (!isset($conn)) {
  die("Error: No database connection");
}

// Check if the product_id POST parameter is set
if (isset($_POST['product_id'])) {
  // Get the product_id value from the POST parameter
  $product_id = $_POST['product_id'];

  // Delete the product with the specified product_id from the bag table
  $query = "DELETE FROM bag WHERE product_id = $product_id";
  $result = mysqli_query($conn, $query);;

  // Check if the delete operation was successful
  if ($result) {
    header('Location: /neatest/html/shop/bagview.php');
  } else {
    echo "There was an error deleting the product from the bag table: " . mysqli_error($conn);
  }
}

        

        

?>
