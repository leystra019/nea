<!DOCTYPE html>
<html lang="en">
    <body>
        <table border = 1px>
            <tr>
            
            <th>ID</th>
            
            <th>OrderID</th>
            
            <th>ProdudctId</th>
            
            <th>Quantity</th>

            <th>Price</th>
            
            </tr>

        </table>

        <a href="#" id="buttontest" class="button" action = "/neatest/php/test.php">Test</a>
        <?php








            ini_set('display_errors', 1);

            

            ini_set('display_startup_errors', 1);

            

            error_reporting(E_ALL);
            session_start();
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = '';
            $DATABASE_NAME = 'phporders';

            $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            if($conn->connect_error){
                die('Connection failed : ' .$conn->connect_error);
            } 
            else {
                $sql = "select * from orderline";
                $result = $conn->query($sql);
                /*echo $result;*/

                if(!$result -> num_rows > 0) {
                    echo "yes";
                    while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["order_id"] . "</td>
                        <td>" . $row["product_id"] . "</td>
                        <td>" . $row["Quantity"] . "</td>
                        <td>" . $row["Price"] . "</td>
                        
                        <td>
                            <a class='button' href='duplicate'>Duplicate</a>
                            <a class='button' href='update'>Update</a>
                            <a class='button' href='Delete'>Delete</a>
                        </td>
                    </tr>";

                }
                }
            }

        ?>

    </body>
</html>