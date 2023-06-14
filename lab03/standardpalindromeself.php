<!DOCTYPE html>
<html>
    <head>
        <title>Standard Self Contained Palindrome</title>
    </head>
    <body>
    <h1>Standard Palindrome - Practicing string functions in a self contained file</h1>
    <form action="standardpalindromeself.php" method="post">
        <label for="string">Enter a String:</label>
        <input type="text" name="string" id="string">
        <input type="submit" value="Submit">
    </form>
  </body>
</html>

<?php
    if(isset($_POST)){
        if (isset($_POST["string"])) {
            $input = $_POST["string"];
            $reverse_input = strrev($input); // Reverse the input string

            if ($input === $reverse_input) {
                echo "<p>$input is a perfect palindrome!</p>";
            } else {
                $inputnew = strtolower(preg_replace("/[^a-zA-Z0-9\s]/", "", $input)); // remove non-alphabetic and non-numeric characters and convert to lowercase
                $inputnew = str_replace(' ', '', $inputnew); // Remove all spaces from the input string
                $reverse_input = strrev($inputnew); // Reverse the input string
                if ($inputnew === $reverse_input) {
                    echo "<p>$input is a standard palindrome!</p>";
                } else {
                    echo "<p>$input is not a palindrome.</p>";
                }
            }
        }
    }
?>