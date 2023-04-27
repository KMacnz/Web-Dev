<!DOCTYPE>

<?php

    session_start();
    if (!isset ($_SESSION["number"])) {
        $_SESSION["number"] = 0;
    }

    $num = $_SESSION["number"];
    ?>

<html>
    <head>
        <title>Managing State Information</title>
    </head>
    <body>
        <h1>Guessing Game</h1>
        
        <p style="color:blue">The hidden number was: <?php echo $num ?></p>

        <br><a href="startover.php" >Start Over</a>
    </body>
