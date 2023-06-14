<!DOCTYPE html>
<html>
    <head>
        <title>MySQL Databases with PHP</title>
    </head>
    <body>
    <h1>Databases and MySQL</h1>
    <h2>Task 1: Retrieve and display records from the table</h2>

    <p>
      CREATE TABLE IF NOT EXISTS `car` (
      `car_id` int(5) NOT NULL AUTO_INCREMENT,
      `make` varchar(50) NOT NULL,
      `model` varchar(50) NOT NULL,
      `price` int(6) NOT NULL,
      `yom` int(4) NOT NULL,
      PRIMARY KEY (`car_id`));
    </p>

    <p>
      INSERT INTO `car` (`car_id`, `make`, `model`, `price`, `yom`) VALUES
      (1, 'Holden', 'Astra', 14000, 2005),
      (2, 'BMW', 'G71', 35000, 2021),
      (3, 'Ford', 'Falcon', 39000, 2010),
      (4, 'Toyota', 'Corolla', 20000, 2018),
      (5, 'Holden', 'Commodore', 13500, 2005),
      (6, 'Holden', 'Astra', 8000, 2001),
      (7, 'Holden', 'Commodore', 28000, 2009),
      (8, 'Ford', 'Falcon', 14000, 2019),
      (9, 'Ford', 'Falcon', 7000, 2003),
      (10, 'Ford', 'Laser', 10000, 2001),
      (11, 'Mazda', 'RX-7', 26000, 2000),
      (12, 'Toyota', 'Corolla', 12000, 2020),
      (13, 'Mazda', '3', 14500, 2007);
    </p>


    <h2>Task 2: Querying the table</h2>

        <p>
            SELECT * FROM `car`;
            <br>
            SELECT `make`, `model`, `price` FROM `car` ORDER BY `make`, `model`;
            <br>
            SELECT `make`, `model` FROM `car` WHERE `price` >= '20000’;
            <br>
            SELECT `make`, `model` FROM `car` WHERE `price` < '15000’;
            <br>
            SELECT AVG(`price`), `model` FROM `car` GROUP BY `model`;
        </p>



        <?php
            require_once("/home/hvm1158/public_html/config/settings.php");
            // Create connection
            $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
            // Check connection
            if ($conn->connect_error) {
                //if connection fails make an error
                die("Connection Failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM car";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Car ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Year of Manufacture</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['yom'] . "</td>";
                }
            }

            $sql = "SELECT make, model, price FROM car ORDER BY make, model";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Price</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                }
            }

            $sql = "SELECT make, model FROM car WHERE price >= '20000'";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Make</th>
                    <th>Model</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                }
            }

            $sql = "SELECT make, model FROM car WHERE price < '15000'";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Make</th>
                    <th>Model</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                }
            }

            $sql = "SELECT AVG(price), model FROM car GROUP BY model";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Average Price</th>
                    <th>Model</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['AVG(price)'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                }
            }

            // Close connection
            $conn->close();
        ?>
    </body>
</html>
