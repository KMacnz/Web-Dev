 <?php
    require_once("/home/hvm1158/public_html/config/settings.php");
    // Create connection
    $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
    // Check connection
    if ($conn->connect_error) {
        //if connection fails make an error
        die("Connection Failed: " . $conn->connect_error);
    }

    // Connects the details from the form in poststatusform.php to php variables
    $fmstatcode = $_POST['statuscode'];
    $fmstat = $_POST['status'];
    $fmshare = $_POST['share'];
    $fmdate = $_POST['date'];
    $fmperm = empty($_POST['perm']) ? null : implode(',', $_POST['perm']);  
    
    // check if table exists and create if not
    $sql = "CREATE TABLE IF NOT EXISTS `statuses` (
        `statuscode` varchar(5) NOT NULL,
        `status` varchar(500) NOT NULL,
        `share` enum('public','private','friends') NOT NULL,
        `date` date NOT NULL,
        `perm` set('like','comment','share') NOT NULL,
        PRIMARY KEY (`statuscode`)
    )";
        // Execute query
        $conn ->query($sql);

    print_r($_POST);

    // !!! Validating form entry !!!
    // check if status code is invalid
    if (!preg_match('/^S\d{4}$/', $fmstatcode)) {
        // not valid, display error message 
        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php?codeerr');
    }

    // check if status code already exists
    $id_checker = "SELECT COUNT(*) FROM statuses WHERE statuscode = '$fmstatcode'";
    $result = $conn->query($id_checker);
    $row = $result->fetch_row();
    $count = $row[0];

    if ($count > 0) {
        echo "Status code already exists! <br>";
        // status code already exists, display error message
        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php?matcherr');
    } 

    // The status can only contain alphanumericals and spaces, comma, period, exclamation point and question mark and cannot be blank! 
    if (!preg_match('/^[a-zA-Z0-9 ,.!?]+$/', $fmstat)) {
        echo "Status is invalid! <br>";
        // not valid, display error message 
        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php?staterr');
    }

    // if date is set to today, set it to the current date
    if ($fmdate == "") {
        $fmdate = date("d-m-Y");
    }

    // convert date to correct format
    $fmdate = date("Y-m-d", strtotime($fmdate));

    // Query that inserts all the data from the form into the database table
    $sql = "INSERT INTO statuses (`statuscode`, `status`, `share`, `date`, `perm`) VALUES ('$fmstatcode', '$fmstat', '$fmshare', '$fmdate', '$fmperm')";
    print_r($sql);
    if ($conn->query($sql) === TRUE) {
        // Redirect to poststatusform.php and display success message on page
        header('Location: http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php?success');
    } else {
        echo "Error with insert query: " . $sql . "<br>" . $conn->error;
    }

    //Close connection
    $conn->close();
?>