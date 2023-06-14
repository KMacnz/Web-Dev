<!DOCTYPE html>
<html>
    <head>
        <title>MySQL Databases with PHP</title>
    </head>
    <body>

        <a href="vip_member.php">Home   |</a>
        <a href="member_add_form.php">Add New Member    |</a>
        <a href="member_display.php"> Display All Members   |</a>
        <a href="member_search.php"> Search Member  |</a>

    <h1>Displaying Table Data</h1>

        <?php
            require_once("/home/hvm1158/public_html/config/settings.php");
            // Create connection
            $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
            // Check connection
            if ($conn->connect_error) {
                //if connection fails make an error
                die("Connection Failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT member_id, fname, lname FROM vipmember ";
            $result = $conn->query($sql);

            // If there is a result, display it
            if ($result->num_rows > 0) {
                echo "<table border='2'>
                    <tr>
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['member_id'] . "</td>";
                    echo "<td>" . $row['fname'] . "</td>";
                    echo "<td>" . $row['lname'] . "</td>";
                }
            }

            // Close connection
            $conn->close();
        ?>
    </body>
</html>
