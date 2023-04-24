<!DOCTYPE html>
<html>
    <head>
        <title>MySQL Databases with PHP</title>
    </head>
    <body>
    <h1>Databases and MySQL</h1>
    <h2>Task 1: Retrieve and display records from the table</h2>

        <?php
            require_once("/home/hvm1158/public_html/config/settings.php");
            // Create connection
            $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
            // Check connection
            if ($conn->connect_error) {
                //if connection fails make an error
                die("Connection Failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT car_id, make, model, price FROM car ";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Car ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Price</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                }
            }

            // Close connection
            $conn->close();
        ?>
    </body>
</html>
