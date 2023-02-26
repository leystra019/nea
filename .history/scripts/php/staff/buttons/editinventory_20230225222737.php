<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');

    // check if the connection works
    if ($conn->connect_error) {
        //if the connection doesn't work report error
        die('Connection failed: ' . $conn->connect_error);
    }

    // Before we begin, we are checking our form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Here we are creating variables with the details posted to use later
        $id = $_POST['product_id'];
        $title = $_POST['title'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        // This is where we are updating the details of an product, but we have left the users email out of it because it is read only/not editable
        // To avoid sql injection we need to bind the parameters
        $query = "UPDATE product_stock SET title = ?, brand = ?, description = ?, category = ?, subcategory = ?, price = ? and stock_level = ? WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "isssssdi", $id, $title, $brand, $description, $category, $subcategory, $price, $stock);
        mysqli_stmt_execute($stmt);        

        // Once this is done we want to redirect the user to the manage order page (their previous location)
        header('Location: /neatest/scripts/php/staff/manageorder.php');
        exit;
    }
?>
