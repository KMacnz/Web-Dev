<?php
    session_start();

    session_destroy();
    header('Location: number.php');
    exit;
?>