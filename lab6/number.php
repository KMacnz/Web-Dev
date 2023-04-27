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
        <h1>Up and down counter using session</h1>

        <?php
            echo "<b>The number is $num</b>"; 
        ?>

        <p>
        <a href="numberup.php" >Up</a>
        <a href="numberdown.php">Down</a>
        <a href="numberreset.php">Reset</a></p>
    </body>
