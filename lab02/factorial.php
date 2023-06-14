<!DOCTYPE html>
    <head>
        <title></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>

    <body>
        <h1>Factorial Calculator - Using if and while statements</h1>
        <?php
            // include mathfunctions.php file
            include 'mathfunctions.php';

            // check if the input is a positive integer
            if(is_numeric($_GET['number']) && $_GET['number'] >= 0 && $_GET['number'] == round($_GET['number'], 0)) {
                $number = $_GET['number'];
                $factorial = factorial($number);
                echo "The factorial of $number is $factorial.";
                echo "<br>$number! = $factorial";
            } else {
                echo "Invalid input. Please enter a positive integer.";
            }
        ?>
    </body>