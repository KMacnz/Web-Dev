
<?php
    require_once("/home/hvm1158/public_html/config/settings.php");
    // Create connection
    $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
    // Check connection
    if ($conn->connect_error) {
        //if connection fails make an error
        die("Connection Failed: " . $conn->connect_error) . "<br>";
    }

    // Connects the details from the form in member_add_form.php to php variables;
    $fmfname = $_POST['fname'];
    $fmlname = $_POST['lname'];
    $fmgender = $_POST['gender'];
    $fmemail = $_POST['email'];   
    $fmphone = $_POST['phone']; 

    // check if table exists and create if not
    $sql = "CREATE TABLE IF NOT EXISTS `vipmember` (
        `member_id` int(11) NOT NULL AUTO_INCREMENT,
        `fname` varchar(40) NOT NULL,
        `lname` varchar(40) NOT NULL,
        `gender` varchar(1) NOT NULL,
        `email` varchar(40) NOT NULL,
        `phone` varchar(20) NOT NULL,
        PRIMARY KEY (`member_id`)
      )";

      $conn ->query($sql);

    // Query that inserts all the data from the form into the database table
    $sql = "INSERT INTO vipmember (fname, lname, gender, email, phone) VALUES ('$fmfname', '$fmlname', '$fmgender', '$fmemail', '$fmphone')";
    if ($conn->query($sql) === TRUE) {
        // if the query is successful, redirect to the index page
        header("Location: member_add_form.php?success");
    } else {
        echo "Error with insert query: " . $sql . "<br>" . $conn->error . "<br>";
    }

    //Close connection
    $conn->close();
?>