
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
        else(){
            $sql = "select * from orderline";
            $result = $conn->query($sql);
            /*echo $result;*/
            echo "<table>";
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "</tr>";
                }
            echo "</table>";
        }
    

    ?>

</body>
</html>