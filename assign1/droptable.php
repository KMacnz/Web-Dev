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

    // If the table was dropped, redirect to the about page
    if ($exists) {
        $conn->query("DROP TABLE statuses");
        echo "Table dropped";
        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/about.html');
    // redirect to poststatus page
    } else {
        echo "Table does not exist";
        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php?droperr'); 
    }
?>  