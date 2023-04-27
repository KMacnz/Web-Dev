<!DOCTYPE>

<?php
    session_start();

    // generate a random number between 1 and 100
    if (!isset($_SESSION['number'])) {
        $_SESSION['number'] = rand(1, 100);
        $_SESSION['guesses'] = 0;
    }

    // process user input
    $message = '';

    if (isset($_POST['guess'])) {
        $guess = $_POST['guess'];

        if (!is_numeric($guess)) {
            $message = 'Please enter a number';

        } else if ($guess < 1 || $guess > 100) {
            $message = 'Please enter a number between 1 and 100';

        } else {
            $_SESSION['guesses']++;

            if ($guess < $_SESSION['number']) {
                $message = "Your guess is too low.";
            } else if ($guess > $_SESSION['number']) {
                $message = "Your guess is too high.";
            } else if ($guess == $_SESSION['number']) {
                $message = "Congratulations! You guessed the Hidden Number.";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Guessing Game</title>
    </head>
    <body>
        <h1>Guessing Game</h1>

        <form method="post">
            <label for="guess">Guess a number between 1 and 100:</label>
            <input type="text" name="guess" id="guess" value="">
            <input type="submit" value="Guess">
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <p>Number of Guesses: <?php echo $_SESSION['guesses']; ?></p>

        <br><a href="startover.php" >Start Over</a>
        <br><a href="giveup.php">Give Up</a>
    </body>
</html>