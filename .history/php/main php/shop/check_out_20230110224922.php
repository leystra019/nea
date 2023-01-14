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
    if (isset($_POST['submit'])) {
        // Get form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $residence = $_POST['residence'];
        $save_info = isset($_POST['save_info']) ? 1 : 0;

        // Set cookies if 'save info' checkbox is checked
    if ($save_info) {
      setcookie('firstname', $firstname, time() + 86400);
      setcookie('email', $email, time() + 86400);
      setcookie('residence', $residence, time() + 86400);
    };

    // Insert missing values into MySQL table
    $user_id = ?; // Replace with actual user ID
    $sql = "INSERT INTO users (user_id, firstname, lastname, email, residence)
            VALUES ($user_id, '$firstname', '$lastname', '$email', '$residence')
            ON DUPLICATE KEY UPDATE firstname='$firstname', lastname='$lastname', email='$email', residence='$residence'";
    if (mysqli_query($conn, $sql)) {
      echo "Values inserted/updated successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    };
  };

?>