<?php 
    /*
        Name: Keanna Mackereth
        Email: hvm1158@autuni.ac.nz
        ID: 20119705
    */
    
    require_once("/home/hvm1158/public_html/assign2/config/settings.php");
    // Including the settings file which likely contains database connection details

    // Create connection
    $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
    // Creating a new MySQLi connection using the provided database credentials

    // Check connection
    if ($conn->connect_error) {
        // Checking if the connection to the database fails
        die("Connection Failed: " . $conn->connect_error) . "<br>";
        // Displaying an error message and stopping the script execution
    } 

    // Retrieving values from the form using the POST method
    $cName = $_POST['cName'];
    $phone = $_POST['phone'];
    $uNumber = $_POST['uNumber'];
    $sNumber = $_POST['sNumber'];
    $stName = $_POST['stName'];
    $sbName = $_POST['sbName'];
    $dsbName = $_POST['dsbName'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $bookingNumber;

    // Creating a table named 'bookingrequest' if it doesn't already exist
    $sql = "CREATE TABLE IF NOT EXISTS `bookingrequest` (
        `bookingnumber` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
        `cname` varchar(75) NOT NULL,
        `phone` varchar(12) NOT NULL,
        `unumber` varchar(4) DEFAULT NULL,
        `snumber` varchar(4) NOT NULL,
        `stname` varchar(100) NOT NULL,
        `sbname` varchar(100) DEFAULT NULL,
        `dsbname` varchar(100) DEFAULT NULL,
        `date` date NOT NULL,
        `time` time NOT NULL,
        `bookingdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `assignmentstatus` enum('assigned','unassigned') NOT NULL DEFAULT 'unassigned',
        PRIMARY KEY (`bookingnumber`))";

    $conn->query($sql);

    // Inserting form data into the 'bookingrequest' table
    $sql = "INSERT INTO `bookingrequest`(`cname`, `phone`, `unumber`, `snumber`, `stname`, `sbname`, `dsbname`, `date`, `time`) VALUES ('$cName', '$phone', '$uNumber', '$sNumber', '$stName', '$sbName', '$dsbName', '$date', '$time')";
    if ($conn->query($sql) === TRUE) {

        // Retrieving the booking number for the inserted record
        $sql = "SELECT `bookingnumber` FROM bookingrequest WHERE `cname` LIKE '$cName' AND `date` LIKE '$date' AND TIME(`time`) = TIME('$time')";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $bookingNumber = $row['bookingnumber'];

        // Calling the confirmMessage function with the necessary parameters
        confirmMessage($cName, $uNumber, $sNumber, $stName, $sbName, $dsbName, $date, $time, $bookingNumber);
    } else {
        echo "Error with insert query: " . $sql . "<br>" . $conn->error;
        // Displaying an error message if the insert query fails
    }

    // Function to display a confirmation message on booking.html
    function confirmMessage($cName, $uNumber, $sNumber, $stName, $sbName, $dsbName, $date, $time, $bookingNumber) {
        echo "<div class='confirmCon'>";
            echo "<h2>Thank you for your booking!</h2>";
            echo "<table>";
                echo "<tr>";
                    echo "<td>Booking Number</td>";

                    // Checking the booking number length and adding leading zeros if necessary
                    $bookingNumber = sprintf("%05d", $bookingNumber);
                    echo "<td>BRN$bookingNumber</td>";

                echo "</tr>";
                echo "<tr>";
                    echo "<td>Pickup Time</td>";
                    echo "<td>$time</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>Pickup Date</td>";
                    // Changing the date format to DDMMYYYY
                    $date = date("d-m-Y", strtotime($date));
                    echo "<td>$date</td>";

                echo "</tr>";
            echo "</table>";
            // Displaying a link to go back, centered and with some styling
            echo "<a href='booking.html' style='text-align: center; display: block; margin-top: 20px;'>Book Again</a>";
        echo "</div>";
    }
?>
