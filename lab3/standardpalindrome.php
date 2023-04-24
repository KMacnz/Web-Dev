<!DOCTYPE html>
<html>
    <head>
        <title>String Processing Result</title>
    </head>
    <body>
        <h1>Standard Palindrome - Practicing string functions</h1>
        <?php





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
        ?>
    </body>
</html>