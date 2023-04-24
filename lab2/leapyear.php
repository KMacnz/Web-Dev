<!DOCTYPE html>
    <head>
        <title>Leap Year</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>

    <body>
        <h1>Is Leap Year? - if Statements</h1>

        <?php
            function isLeapYear($year) {
                if ($year % 4 == 0) {
                    if ($year % 100 != 0) {
                        return true;
                    } else {
                        if ($year % 400 == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }


            $year = $_GET['year'];
            if(is_numeric($year)) {
                if(isLeapYear($year)) {
                    echo "<p>$year is a leap year.</p>";
                } else {
                    echo "<p>$year is not a leap year.</p>";
                }
            } else {
                echo "<p>$year is not a number.</p>";
            }
        ?>
    </body>

