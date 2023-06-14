<!DOCTYPE html>
<html>
    <head>
        <title>String Processing Result</title>
    </head>
    <body>
        <h1>Perfect Palindrome - Practicing string functions</h1>
        <?php
            $input = $_POST["string"];
                
            $reverse_input = strrev($input); // Reverse the input string
            if ($input === $reverse_input) {
                echo "<p>$input is a perfect palindrome!</p>";
            } else {
                echo "<p>$input is NOT a perfect palindrome.</p>";
            }  
        ?>
    </body>
</html>