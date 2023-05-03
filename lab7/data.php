<!--file data.php -->
<?php
	require_once("/home/hvm1158/public_html/config/settings.php");
    // Create connection
    $conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
    // Check connection
    if ($conn->connect_error) {
        //if connection fails make an error
        die("Connection Failed: " . $conn->connect_error) . "<br>";
    }

	// get name and password passed from client
	$name = $_POST['name']; // Get the value of the "name" parameter from the HTTP POST request
	$pwd = $_POST['pwd']; // Get the value of the "pwd" parameter from the HTTP POST request

	// create table if not already there
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
		`name` varchar(50) NOT NULL,
		`password` varchar(50) NOT NULL,
		`email` varchar(50) NOT NULL,
		PRIMARY KEY (`name`))";

	$conn ->query($sql);

	// insert into table if not already there
	$sql = "INSERT IGNORE INTO users(`name`, `password`, `email`) VALUES
		('keanna', 'pass', 'keanna@gmail.com'),
        ('Alice', 'mypassword123', 'alice@example.com'),
        ('Charlie', 'SnoopyRocks', 'charlie@example.com'),
        ('Diana', 'passw0rd', 'diana@example.com'),
        ('Ethan', 'H3ll0W0rld!', 'ethan@example.com')";	

    if ($conn->multi_query($sql) === FALSE) {
        echo "Error with insert query: " . $sql . "<br>" . $conn->error . "<br>";
    }

	// Attempt to retrieve email for given name and password
	$sql = "SELECT email FROM users WHERE name = '$name' AND password = '$pwd'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// Name and password are correct, return email
		$row = $result->fetch_assoc();
		$email = $row["email"];
		echo "Email: $email";
	
	} else {
		// check if name exists and password is wrong
		$sql = "SELECT name FROM users WHERE name = '$name'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Name exists, but password is wrong, return error message
			echo "Invalid password";

		} else {
			// Name and/or password are incorrect, return error message
			echo "Invalid account";
		}
	}
?>
