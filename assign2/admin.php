<?php
    /*
        Name: Keanna Mackereth
        Email: hvm1158@autuni.ac.nz
        ID: 20119705
    */

    require_once("/home/hvm1158/public_html/assign2/config/settings.php");
    // Create connection
    $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
    // Check connection
    if ($conn->connect_error) {
        //if connection fails make an error
        header("HTTP/1.1 500 Internal Server Error");
        die("Connection Failed: " . $conn->connect_error) . "<br>";
    }

    // check if the table exists
    $exists = $conn->query("SHOW TABLES LIKE 'bookingrequest'");
    if ($exists->num_rows == 0) {
        echo "<h5>Table does not exist, try adding a booking</h5>";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $bookingNumber = $_POST['bSearch'];

        // remove the first 3 characters from the booking number for the database search
        $bookingNumber = substr($bookingNumber, 3);

        if ($bookingNumber == "") {

            // get the current date and time
            $date = date("Y-m-d");
            $time = date("H:i");

            // select where the pickup within 2 hours from the current time on the current date
            $sql = "SELECT `bookingnumber`, `cname`, `phone`,  `sbname`, `dsbname`, `date`, `time`, `assignmentstatus` FROM `bookingrequest` WHERE `date` = '$date' AND `time` BETWEEN '$time' AND ADDTIME('$time', '02:00:00')";
            $result = $conn->query($sql);

            if (!$result) {
                echo $conn->error;
                header("HTTP/1.1 500 Internal Server Error");
                return;
            }

            echo '<h3>Bookings within 2 hours from now:</h3>';

        } else {
            // get all the bookings that match the booking number
            $sql = "SELECT `bookingnumber`, `cname`, `phone`,  `sbname`, `dsbname`, `date`, `time`, `assignmentstatus` FROM `bookingrequest` WHERE `bookingnumber` = '$bookingNumber'";
            $result = $conn->query($sql);
        }

        // if the result is empty 
        if ($result->num_rows == 0) {
            echo '<h5>No bookings found</h5>';
            return;
        }

        echo '<div class="phptable">';
            echo '<table>';
                // set all the colums sizes to the same
                echo '<col width="10%">';
                echo '<col width="10%">';
                echo '<col width="10%">';
                echo '<col width="10%">';
                echo '<col width="10%">';
                echo '<col width="10%">';
                echo '<col width="10%">';
                echo '<col width="10%">';

                // make the table header
                echo '<thead>';
                    echo '<tr><b>';
                        echo '<th>Booking reference number</th>';
                        echo '<th>Customer name</th>';
                        echo '<th>Phone</th>';
                        echo '<th>Pickup suburb</th>';
                        echo '<th>Destination suburb</th>';
                        echo '<th>Pickup date and time</th>';
                        echo '<th>Status</th>';
                        echo '<th>Assign</th>';
                    echo '</b></tr>';
                echo '</thead>';

                // make the table body
                echo '<tbody>';
                    // loop through the results and make a row for each result
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . 'BRN' . $row['bookingnumber'] . '</td>';
                            echo '<td>' . $row['cname'] . '</td>';
                            echo '<td>' . $row['phone'] . '</td>';
                            echo '<td>' . $row['sbname'] . '</td>';
                            echo '<td>' . $row['dsbname'] . '</td>';
                            echo '<td>' . $row['date'] . ' ' . $row['time'] . '</td>';
                            echo '<td id="BRN' . $row['bookingnumber'] . '">' . $row['assignmentstatus'] . '</td>';
                            // make a button that calls the assignBtn function
                            echo '<td><button type="button" id="assignBtn-' . $row['bookingnumber'] . '" 
                                onclick="assignBtn(\'admin.php\',\'alert\', \'' . $row['bookingnumber'] . '\')"' . ($row['assignmentstatus'] == 'assigned' ? 'disabled' : '') . '
                                >Assign</button></td>';
                        echo '</tr>';
                    }
                echo '</tbody>';
            echo '</table>';
        echo '</div>';

        //  make a function that assigns a driver to a booking
    } else if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
        $data = [];
        // get the data from the request
        parse_str(file_get_contents('php://input'), $data);
        $assignNum = $data['number'];

        //$assignNum = $_REQUEST['number'];
        $sql = "UPDATE `bookingrequest` SET `assignmentstatus` = 'assigned' WHERE `bookingnumber` = '$assignNum'";
        $result = $conn->query($sql);

        // if the query fails make an error
        if (!result) {
            echo $conn->error;
            header("HTTP/1.1 500 Internal Server Error");
            return;
        }

        echo "Booking number BRN" . $assignNum . " has been assigned to a driver.";
    }
?>