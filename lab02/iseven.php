<!DOCTYPE html>
    <head>
        <title></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>

    <body>
        <h1>Is Even & Number? - Conditional Operators</h1>

        <?php
            $number = $_GET['number'];
            
            if (is_numeric($number) && $number == round($number, 0) ) {
                echo "<p>$number is an number.</p>";
                if ($number % 2 == 0) {
                    echo "<p>$number is even.</p>";
                } else {
                    echo "<p>$number is odd.</p>";
                }
            } else {
                echo "<p>$number is not an valid number.</p>";
            }
        ?>
    </body>

