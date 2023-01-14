<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Connect to the database and retrieve the product data
    $conn = mysqli_connect('localhost', 'root', '', 'neatest');
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    else{
        $sql = "select * from bag";
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
                <a href="/neatest/html/ulogin.html"class="blue-link">login</a>
            </div>
            <div class="ordslink">
                <a href="/neatest/html/slogin.html"class="blue-link">orders</a>
            </div>
            <div class="baglink">
                <a href="/neatest/html/bag.html"class="blue-link">bag</a>
            </div>
            <h1>Shopping Cart</h1>
            

            <table class="table-bordered">
                <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>action</th>
                </tr>
                <?php
                    $total = 0;
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['image'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td><a class='button' href='/neatest/php/update.php'>update</a></td>";
                        echo "<td><a class='button'  href='/neatest/php/php buttons/delete.php'>delete</a></td>";
                        echo "</tr>";
                        $total = $total + ($row['quantity'] * $row['price']);
                    }
                ?>
            </table>

            <tbody>
                <?php
                    // ini_set('display_errors', 1);
                    // ini_set('display_startup_errors', 1);
                    // error_reporting(E_ALL);
                    
                    // // Connect to the database and retrieve the product data
                    // $conn = mysqli_connect('localhost', 'root', '', 'neatest');
                    // if ($conn->connect_error) {
                    //   die('Connection failed: ' . $conn->connect_error);
                    // }
                    // else{
                    //     $sql = "select * from bag";
                    //     $result = $conn->query($sql);
                    
                    //     while($row = mysqli_fetch_array($result)) {
                    //         echo "<tr>
                    //             <td>" . $row["title"] . "</td>
                    //             <td>" . $row["price"] . "</td>
                    //             <td>" . $row["image"] . "</td>
                    //             <td>" . $row["quantity"] . "</td>
                    //             <td>
                    //                 <a class='button' href='/neatest/php/update.php'>update</a>
                    //                 <a class='button'  href='/neatest/php/php buttons/delete.php'>delete</a>
                    //             </td>
                    //         </tr>";
                    // }}
                ?>
                
                    



</body>
</html>