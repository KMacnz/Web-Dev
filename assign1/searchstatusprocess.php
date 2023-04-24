<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="COMP721 Assignment 1">
        <meta name="keywords" content="Web Development, Assignment 1">
        <link rel="stylesheet" href="styles.css">
        <title>Web Dev Assignment 1</title>
    </head>
    <body>
        <div class="tab">
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/index.html">Home</a>
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/about.html">About the Assignment</a>
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php">Post a new Status</a>
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/searchstatusform.html">Search Status</a>
        </div>

        <div class="main">
            <h1>Search Results</h1>

            <div class="findcon">
                <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/searchstatusform.html">Back to Search</a><p>

                <?php
                    require_once("./conf/sqlinfo.inc.php");
                    // Create connection
                    $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
                    // Check connection
                    if ($conn->connect_error) {
                        //if connection fails make an error
                        die("Connection Failed: " . $conn->connect_error);
                    }

                    // Check if the table exists
                    $exists = $conn->query("SHOW TABLES LIKE 'statuses'");
                    $exists->num_rows > 0 ? $exists = TRUE : $exists = FALSE;

                    // Get the search string from the form
                    $searchString = $_GET['search'];

                    // Check if the search string is empty or null
                    if (trim($searchString) == "" || trim($searchString) == NULL) {
                        echo "The search string is empty. Please enter a keyword to search. ";
                    // Check if the table exists
                    } else if (!$exists) {
                        // not valid, display error message 
                        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php?tableerr');
                    // Otherwise search the table for result
                    } else {
                        // Query the table for the search string
                        $sql = "SELECT * FROM statuses WHERE status LIKE '%$searchString%'";
                        $result = $conn->query($sql);

                        // If there is a result, display it
                        if ($result->num_rows > 0) {
                            echo "Search results for: <b>" . $searchString . "</b><em style='opacity:0.5'> as of: " . date("d/m h:i") ."</em><br>";
                            while($row = $result->fetch_assoc()) {
                                echo "<div class='rescon'>";
                                    echo "<hr>";
                                    echo "<b>Status: </b>" . $row["status"] . "<br>";
                                    echo "<b>Status Code: </b>" . $row["statuscode"] . "<br>";
                                    // display the date in a more readable format using the date() function
                                    echo "<b>Date: </b>" . date("d M, Y", strtotime($row["date"])) . "<br>";
                                    echo "<b>Share: </b>" . $row["share"] . "<br>";

                                   // if $row["perm"] is null, display "No permissions set"
                                    if ($row["perm"] == NULL) {
                                        echo "<b>Permissions: </b> <em>No permissions set</em>";
                                    // otherwise, display the permissions
                                    } else {
                                        // Split the values in the SET field into an array
                                        $perm_values = explode(",", $row["perm"]); 
                                        // Concatenate the values with a comma separator
                                        echo "<b>Permissions: </b>"  . implode(", ", $perm_values); 
                                    }
                                echo "</div>";
                            }
                        // If there is no result, display a message
                        } else {
                            echo "Status not found. Please try a different keyword";
                        }
                    }
                    // Close connection
                    $conn->close();
                ?></p>
            </div>
        </div>
    </body>

    <footer>
        <p>Keanna Mackereth 20119705<p>
    </footer>
</html>