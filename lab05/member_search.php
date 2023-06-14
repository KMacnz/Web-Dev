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

        <h1>Searching Table Data</h1>

        <form action="member_search.php" method="get">
            Search <input type="text" name="search" id="search" required></p>
            <p><input type="submit" value="Submit" /></p>
        </form>

        <p>
            <?php
                require_once("/home/hvm1158/public_html/config/settings.php");
                // Create connection
                $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
                // Check connection
                if ($conn->connect_error) {
                    //if connection fails make an error
                    die("Connection Failed: " . $conn->connect_error) . "<br>";
                }

                // Check if the table exists
                $exists = $conn->query("SHOW TABLES LIKE 'vipmember'");
                $exists->num_rows > 0 ? $exists = TRUE : $exists = FALSE;

                // Get the search string from the form
                $searchString = $_GET['search'];

                // Check if the search string is empty or null
                if (trim($searchString) == "" || trim($searchString) == NULL) {
                    echo "The search string is empty. Please enter a keyword to search. ";
                } else {
                    // Query the table for the search string
                    $sql = "SELECT * FROM vipmember WHERE lname LIKE '%$searchString%'";
                    $result = $conn->query($sql);

                    // If there is a result, display it
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='rescon'>";
                            echo "<hr>";
                            echo "<b>Member ID: </b>" . $row["member_id"] . "<br>";
                            echo "<b>First Name: </b>" . $row["fname"] . "<br>";
                            echo "<b>Last Name: </b>" . $row["lname"] . "<br>";
                            echo "<b>Email: </b>" . $row["email"] . "<br>";
                        }
                    // If there is no result, display a message
                    } else {
                        echo "No Members found with the keyword: <b>" . $searchString . "</b>";
                    }
                }
                // Close connection
                $conn->close();
            ?>
        </p>
    </body>
</html>


