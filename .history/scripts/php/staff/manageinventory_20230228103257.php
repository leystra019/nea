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

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="/neatest/scripts/css/main.css">
    <link rel="stylesheet" href="/neatest/scripts/css/staff/order.css">
    <link rel="stylesheet" href="/neatest/scripts/css/staff/inventory.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">

        </nav>
        <div class="bg">
            <main>
                <div class="card">
                    <div style="z-index: 1;" class="taskbarcontainer">
                        <h1>Tasks</h1>
                        <input type="text" id ="tasksrch" onkeyup="myFunction()" placeholder="Search for task(s)...">
                    </div>
                    <div id="inventory_table">
                        <table class="inventory_table" style= "border-collapse: collapse" align="center" width="95%" >
                            <thead style="justify-items: centre">
                                <tr class="tablehead_box"> 
                                    <th>ID</th>
                                    <th>Product title</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                // Retrieve the product data from the database
                                $query = "SELECT product_id, title, brand, description, category, subcategory, price, stock_level FROM product_stock";
                                $result = mysqli_query($conn, $query);
                                // We want to display the product data fetched into our table
                                if ($result) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='tableprod'>";
                                        echo "<td>" . $row['product_id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['brand'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo  "<td>" . $row['category'] . "</td>";
                                        echo  "<td>" . $row['subcategory'] . "</td>";
                                        echo  "<td>" . $row['price'] . "</td>";
                                        echo  "<td>" . $row['stock_level'] . "</td>";
                                        // we need the action buttons to have slightly different names and fields to the orders action buttons, ie. we don't need a status button
                                        echo "<td> <button class='button' id='edit_product_button' data-product-id='" . $row['product_id'] . "' data-title='" . $row['title'] . "' data-brand='" . $row['brand'] . "' data-description='" . $row['description'] . "' data-category='" . $row['category'] . "' data-subcategory='" . $row['subcategory'] . "' data-price='" . $row['price'] . "' data-stock='" . $row['stock_level'] . "'>Edit</button> <button class='button'  id='delete_product_button'>Delete</button></td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                            </tbody>
                            <!-- This is the modal that appears when the staff member wants to edit their inventory -->
                            <div class="product-modal">
                                <div class="modal-content">
                                    <!-- We are calling another script when the form is submitted in order for the inventory to update -->
                                    <form action="/neatest/scripts/php/staff/buttons/editinventory.php" method="post">
                                        <!-- We want data from these fields to update-->
                                        <form action="/neatest/scripts/php/staff/buttons/editinventory.php" method="post">
                                        <div class="product-input-container">
                                            <label for="product_id">Product ID:</label>
                                            <input type="text" placeholder="product_id" name="product_id" readonly class="product-input-fields" id="product_id">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="title">Title of Product:</label>
                                            <input type="text" placeholder="Title of Product" name="title" class="product-input-fields" id="title">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="brand">Brand:</label>
                                            <input type="text" placeholder="product_id" name="brand" class="product-input-fields" id="brand">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="description">Description:</label>
                                            <input type="text" placeholder="Description..." name="description" class="description-input-field" id="description">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="category">Category:</label>
                                            <input type="text" placeholder="Category" name="category" class="product-input-fields" id="category">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="subcategory">Subcategory:</label>
                                            <input type="text" placeholder="Subcategory" name="subcategory" class="product-input-fields" id="subcategory">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="price">Price:</label>
                                            <input type="text" placeholder="Price" name="price" class="product-input-fields" id="price">
                                        </div>

                                        <div class="product-input-container">
                                            <label for="stock">Stock level:</label>
                                            <input type="text" placeholder="Stock level" name="stock" class="product-input-fields" id="stock">
                                        </div>

                                        <input type="submit" value="Confirm Changes" class="product-submit-button">


                                    </form>
                                    <!-- A close button needs to appear if the staff member has misclicked and does not want to update a specific product's inventory-->
                                    <div class="close">+</div>

                                </div>
                            </div>
                    </table>

                </div>
            </div>
            <!-- This script runs all the form submissions/ button clicks -->
            <script src="/neatest/scripts/js/inventory.js"></script>
        
                

    
</body>
</html>