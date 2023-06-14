<!DOCTYPE html>
<html>
  <head>
    <title>String Processing Result</title>
  </head>
  <body>
    <h1>Number Input Form - Understanding string functions </h1>
    <?php
            // Get the input string from the form
            $input = $_POST['string'];
        
            // Check if the input contains only letters and spaces
            if (preg_match("/^[A-Za-z\s]+$/", $input)) {
                // Remove all the vowels from the input string
                $output = preg_replace("/[aeiouAEIOU]/", "", $input);
    
                // Output the resulting string
                echo "<p>The processed string without vowels is: $output</p>";
            } else if (empty($input)) {
                echo "<p>Please enter a string.</p>";
            } else {
                // Generate an error message if the input contains invalid characters
                echo "<p>Invalid input. Please enter only letters and spaces.";
            }
    ?>
  </body>
</html>