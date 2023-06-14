<!DOCTYPE html>
    <head>
        <title>Days of Week</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>

<?php
    $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $fdays = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    
?>

    <body>
        <h1>Days of the Week - Arrays</h1>
    
        <p><b> The Days of the week in English are: </b><br>  
        <?php echo implode(", ", $days); ?></p>

        <p><b> The Days of the week in French are: </b><br>
        <?php echo implode(", ", $fdays); ?></p>

        <p><b> Today is: </b><br>
        <?php echo $days[date('w')]; ?>/ <?php echo $fdays[date('w')]; ?>
        </p> 

    </body>

