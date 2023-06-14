<html>
    <head>
        <title>PHP Functions</title>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <h1>Use of PHP build-in functions</h1>
        <?php
            /*Use of abs() and pow() build-in function, and echo statments*/
            echo "The absolute value of -9 is: " . abs(-9) . "<br />";
            echo "The value of 2 to the power of 5 is: " . pow(2, 5) . "<br />";
        ?>

        <?php
            /*Use of decbin and bindec build-in function*/
            echo "The decimal value of 1101 is: " . bindec(1101) . "<br />";
            echo "The binary value of 14 is: " . decbin(14) . "<br />";
        ?>
    </body>
</html>
